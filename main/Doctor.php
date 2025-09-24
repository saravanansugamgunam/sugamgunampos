<?php
// Timezone (India)
date_default_timezone_set('Asia/Kolkata');

include("connect.php");
 

/** CONFIG **/
$BOOKING_URL     = "https://yourclinic.com/book";   // TODO
$WHATSAPP_NUMBER = "919488228603";                  // TODO (country code + number)

/** INPUTS **/
$doctorId  = isset($_GET['doctor'])   ? (int)$_GET['doctor']   : 0;
$locationQ = $_GET['location'] ?? '*'; // "*" = All
$from      = '2025-09-15'; //$_GET['from']     ?? date('Y-m-d');
$to        = '2025-09-22    '; //$_GET['to']       ?? date('Y-m-d', strtotime('+14 days'));
if (strtotime($from) > strtotime($to)) { $t=$from; $from=$to; $to=$t; }

/** FETCH FILTER DROPDOWNS **/
$doctors = [];
$res = $connection->query("SELECT id, name FROM doctors WHERE is_active=1 ORDER BY name");
while ($r = $res->fetch_assoc()) { $doctors[] = $r; }
$res->free();

$locations = [];
$res = $connection->query("SELECT id, name FROM locations WHERE is_active=1 ORDER BY name");
while ($r = $res->fetch_assoc()) { $locations[] = $r; }
$res->free();

if ($doctorId === 0 && !empty($doctors)) $doctorId = (int)$doctors[0]['id'];

/** HELPER FNS **/
function h($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
function h12($t){ return date('h:i A', strtotime($t)); }
function dmy($d){ return date('d/m/Y', strtotime($d)); }
function weekday_name($d){ return date('l', strtotime($d)); }

/**
 * Get slots for a given date/doctor/location:
 * 1) Pull date_overrides for exact date (location-specific first, then NULL-location)
 *    - If any 'special' rows exist for that date+doctor+loc (or NULL loc), render as special-only (with note)
 *    - Else gather all 'normal' override rows (if ANY exist, they override weekly)
 * 2) If no normal overrides, fall back to weekly_rules for that dow (location-specific first, then NULL)
 */
function get_slots_for($connection, $ymd, $doctorId, $locationId) {
  $dow = (int)date('w', strtotime($ymd));

  // 1) DATE OVERRIDES
  // a) Check for SPECIAL entries (location-specific)
  $sql = "SELECT slot_type, start_time, end_time, note
          FROM date_overrides
          WHERE the_date=? AND doctor_id=? AND (location_id=?)
          ORDER BY id";
  $stmt = $connection->prepare($sql);
  $stmt->bind_param('sii', $ymd, $doctorId, $locationId);
  $stmt->execute();
  $specialsLoc = [];
  $overridesLoc = [];
  $res = $stmt->get_result();
  while ($row = $res->fetch_assoc()) {
    if ($row['slot_type'] === 'special') $specialsLoc[] = $row;
    else $overridesLoc[] = $row;
  }
  $stmt->close();

  // b) Check for SPECIAL/normal entries (NULL location)
  $sql = "SELECT slot_type, start_time, end_time, note
          FROM date_overrides
          WHERE the_date=? AND doctor_id=? AND location_id IS NULL
          ORDER BY id";
  $stmt = $connection->prepare($sql);
  $stmt->bind_param('si', $ymd, $doctorId);
  $stmt->execute();
  $specialsNull = [];
  $overridesNull = [];
  $res = $stmt->get_result();
  while ($row = $res->fetch_assoc()) {
    if ($row['slot_type'] === 'special') $specialsNull[] = $row;
    else $overridesNull[] = $row;
  }
  $stmt->close();

  if (!empty($specialsLoc) || !empty($specialsNull)) {
    // Special-only day
    $note = $specialsLoc[0]['note'] ?? ($specialsNull[0]['note'] ?? null);
    return [['type'=>'special', 'note'=>$note]];
  }

  if (!empty($overridesLoc) || !empty($overridesNull)) {
    $rows = !empty($overridesLoc) ? $overridesLoc : $overridesNull;
    $out = [];
    foreach ($rows as $r) {
      $out[] = ['type'=>'normal', 'start'=>$r['start_time'], 'end'=>$r['end_time']];
    }
    return $out;
  }

  // 2) WEEKLY RULES
  // location-specific first
  $sql = "SELECT slot_type, start_time, end_time
          FROM weekly_rules
          WHERE doctor_id=? AND dow=? AND active=1 AND location_id=?
          ORDER BY id";
  $stmt = $connection->prepare($sql);
  $stmt->bind_param('iii', $doctorId, $dow, $locationId);
  $stmt->execute();
  $res = $stmt->get_result();
  $locRules = $res->fetch_all(MYSQLI_ASSOC);
  $stmt->close();

  // if none, use NULL-location
  if (empty($locRules)) {
    $sql = "SELECT slot_type, start_time, end_time
            FROM weekly_rules
            WHERE doctor_id=? AND dow=? AND active=1 AND location_id IS NULL
            ORDER BY id";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('ii', $doctorId, $dow);
    $stmt->execute();
    $res = $stmt->get_result();
    $locRules = $res->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
  }

  if (empty($locRules)) return [];

  // If ANY special in weekly rules => special-only
  foreach ($locRules as $r) {
    if ($r['slot_type'] === 'special') return [['type'=>'special', 'note'=>null]];
  }

  // Otherwise normal times
  $out = [];
  foreach ($locRules as $r) {
    $out[] = ['type'=>'normal', 'start'=>$r['start_time'], 'end'=>$r['end_time']];
  }
  return $out;
}

/** Build date range **/
$dates = [];
for ($ts=strtotime($from), $end=strtotime($to); $ts <= $end; $ts=strtotime('+1 day',$ts)) {
  $dates[] = date('Y-m-d', $ts);
}

/** Selection helpers **/
$todayYmd = date('Y-m-d');
$nowDT = new DateTime('now');

// Locations to display
$selectedLocationIds = [];
if ($locationQ === '*') {
  foreach ($locations as $L) $selectedLocationIds[] = (int)$L['id'];
} else {
  $selectedLocationIds[] = (int)$locationQ;
}

// Lookup arrays
$doctorName = '';
foreach ($doctors as $d) if ((int)$d['id'] === $doctorId) { $doctorName = $d['name']; break; }
$locNameById = [];
foreach ($locations as $l) $locNameById[(int)$l['id']] = $l['name'];

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Doctor Availability</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  :root { --bg:#f7f8fb; --card:#fff; --ink:#1e293b; --muted:#64748b; --line:#e5e7eb; --brand:#2563eb; --chip:#eef2ff; }
  *{box-sizing:border-box}
  body{margin:0; font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,"Helvetica Neue",Arial; color:var(--ink); background:var(--bg)}
  .wrap{max-width:980px; margin:22px auto; padding:0 12px}
  h1{font-size:22px; margin:0 0 14px}
  .filters{display:grid; grid-template-columns:1fr 1fr 1fr 1fr auto; gap:8px; background:var(--card); border:1px solid var(--line); padding:10px; border-radius:12px}
  .filters select,.filters input,.filters button{font:inherit; padding:10px 12px; border:1px solid var(--line); border-radius:10px; background:#fff}
  .filters button{background:var(--brand); color:#fff; border:none; cursor:pointer}
  .hint{grid-column:1/-1; font-size:12px; color:var(--muted)}
  .legend{margin-top:10px; font-size:12px; color:var(--muted)}
  .day{margin-top:14px; background:var(--card); border:1px solid var(--line); border-radius:14px; overflow:hidden}
  .dayhead{display:flex; justify-content:space-between; align-items:center; padding:12px 14px; background:#fbfcfe; border-bottom:1px solid var(--line)}
  .title{font-weight:600}
  .badge{font-size:12px; padding:4px 8px; border-radius:999px; background:#eef7ee; color:#166534; border:1px solid #dcfce7}
  .locchip{font-size:12px; padding:3px 8px; border-radius:999px; background:#f1f5f9; color:#0f172a; border:1px solid #e2e8f0; margin-left:6px}
  .locwrap{display:flex; flex-wrap:wrap; gap:6px}
  .slots{display:grid; gap:10px; padding:12px; grid-template-columns:repeat(auto-fill,minmax(250px,1fr))}
  .slot{border:1px solid var(--line); border-radius:12px; padding:12px}
  .time{font-size:14px; color:var(--muted)}
  .note{margin-top:6px; font-size:13px; background:var(--chip); padding:6px 8px; border-radius:8px}
  .special{border-style:dashed}
  .btns{display:flex; gap:8px; margin-top:10px}
  .btn{display:inline-block; text-decoration:none; padding:10px 12px; border-radius:10px; border:1px solid var(--line); font-size:14px}
  .btn.primary{background:var(--brand); color:#fff; border:none}
  .btn.whatsapp{background:#25D366; color:#fff; border:none}
  .empty{padding:14px; color:var(--muted)}
  @media (max-width:760px){ .filters{grid-template-columns:1fr 1fr; grid-auto-rows:auto} .filters .wide{grid-column:1/-1} }
</style>
</head>
<body>
<div class="wrap">
  <h1>Doctor Availability</h1>

  <form class="filters" method="get" action="">
    <!-- Doctor -->
    <select name="doctor" title="Doctor" required>
      <?php foreach ($doctors as $d): ?>
        <option value="<?php echo (int)$d['id']; ?>" <?php echo ((int)$d['id']===$doctorId?'selected':''); ?>>
          <?php echo h($d['name']); ?>
        </option>
      <?php endforeach; ?>
    </select>

    <!-- Location (with All) -->
    <select name="location" title="Location">
      <option value="*" <?php echo ($locationQ==='*'?'selected':''); ?>>All locations</option>
      <?php foreach ($locations as $l): ?>
        <option value="<?php echo (int)$l['id']; ?>" <?php echo ((string)$l['id']===$locationQ?'selected':''); ?>>
          <?php echo h($l['name']); ?>
        </option>
      <?php endforeach; ?>
    </select>

    <input type="date" name="from" value="<?php echo h($from); ?>">
    <input type="date" name="to"   value="<?php echo h($to); ?>">
    <button type="submit">Show</button>

    <div class="hint">Wed: 9:00–12:00 • Mon/Tue/Thu/Sat: 10:00–12:00 & 5:00–7:00 • Fri/Sun: Special appointments only.</div>
  </form>

  <div class="legend">
    Doctor: <strong><?php echo h($doctorName); ?></strong> •
    Location: <strong><?php echo ($locationQ==='*' ? 'All locations' : h($locNameById[(int)$locationQ] ?? '-')); ?></strong>
  </div>

  <?php if (empty($dates)): ?>
    <div class="day"><div class="empty">No dates in range.</div></div>
  <?php else: ?>
    <?php foreach ($dates as $ymd): ?>
      <?php
        // Decide which locations to show for this day
        $locIdsForDay = $selectedLocationIds;

        // Build visible slots per location
        $dayBlocks = []; // location_id => array of slot blocks
        foreach ($locIdsForDay as $locId) {
          $slots = get_slots_for($connection, $ymd, $doctorId, $locId);

          // Hide already-ended normal slots for today
          $visible = [];
          foreach ($slots as $s) {
            if ($s['type'] === 'special') { $visible[] = $s; continue; }
            if ($ymd !== $todayYmd) { $visible[] = $s; continue; }

            $endDT = DateTime::createFromFormat('Y-m-d H:i', $ymd.' '.$s['end']);
            if ($endDT && $endDT > $nowDT) $visible[] = $s;
          }
          if (!empty($visible)) $dayBlocks[$locId] = $visible;
        }

        if (empty($dayBlocks)) continue;
      ?>
      <section class="day">
        <div class="dayhead">
          <div class="title"><?php echo weekday_name($ymd) . ' • ' . dmy($ymd); ?></div>
          <div class="locwrap">
            <?php if ($ymd === $todayYmd): ?><span class="badge">Today</span><?php endif; ?>
            <?php foreach ($dayBlocks as $lid => $_): ?>
              <span class="locchip"><?php echo h($locNameById[$lid] ?? ''); ?></span>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="slots">
          <?php foreach ($dayBlocks as $lid => $blocks): ?>
            <?php foreach ($blocks as $b): ?>
              <?php if ($b['type']==='special'): ?>
                <div class="slot special">
                  <div class="time"><strong>Special Appointments Only</strong></div>
                  <div class="note"><?php echo h($doctorName); ?> • <?php echo h($locNameById[$lid] ?? ''); ?> <?php echo !empty($b['note'])? '• '.h($b['note']) : ''; ?></div>
                  <div class="btns">
                    <a class="btn whatsapp" href="<?php
                      $msg = "Hi, I'd like a special appointment with $doctorName at ".($locNameById[$lid] ?? '')." on ".dmy($ymd);
                      echo "https://wa.me/{$WHATSAPP_NUMBER}?text=".rawurlencode($msg);
                    ?>" target="_blank" rel="noopener">WhatsApp</a>
                  </div>
                </div>
              <?php else: ?>
                <div class="slot">
                  <div class="time">Time: <?php echo h12($b['start']); ?> – <?php echo h12($b['end']); ?></div>
                  <div class="note"><?php echo h($doctorName); ?> • <?php echo h($locNameById[$lid] ?? ''); ?></div>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endforeach; ?>
        </div>
      </section>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
</body>
</html>
