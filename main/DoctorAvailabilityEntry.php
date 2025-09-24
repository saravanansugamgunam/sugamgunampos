<?php
// admin_availability.php
// Timezone
date_default_timezone_set('Asia/Kolkata');

// DB
require __DIR__ . '/connect.php';

// --- helpers ---
function h($s){ return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
function redirect_self() {
  $url = strtok($_SERVER["REQUEST_URI"],'?');
  header("Location: $url");
  exit;
}

// Load lookups
$doctors = [];
$res = $connection->query("SELECT id, name FROM doctors WHERE is_active=1 ORDER BY name");
while ($r = $res->fetch_assoc()) $doctors[] = $r;
$res->free();

$locations = [];
$res = $connection->query("SELECT id, name FROM locations WHERE is_active=1 ORDER BY name");
while ($r = $res->fetch_assoc()) $locations[] = $r;
$res->free();

// --- actions ---
$errors = [];
$ok = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? '';

  try {
    if ($action === 'add_weekly' || $action === 'update_weekly') {
      $id          = (int)($_POST['id'] ?? 0);
      $doctor_id   = (int)($_POST['doctor_id'] ?? 0);
      $location_id = $_POST['location_id'] === 'NULL' ? null : (int)$_POST['location_id'];
      $dow         = (int)($_POST['dow'] ?? 0); // 0..6
      $slot_type   = $_POST['slot_type'] === 'special' ? 'special' : 'normal';
      $start_time  = $slot_type === 'normal' ? ($_POST['start_time'] ?? null) : null;
      $end_time    = $slot_type === 'normal' ? ($_POST['end_time']   ?? null) : null;
      $active      = isset($_POST['active']) ? 1 : 0;

      if (!$doctor_id) throw new Exception("Doctor is required.");
      if ($dow < 0 || $dow > 6) throw new Exception("Invalid day of week.");
      if ($slot_type === 'normal' && (empty($start_time) || empty($end_time))) {
        throw new Exception("Start and End time are required for normal slots.");
      }

      if ($action === 'add_weekly') {
        $sql = "INSERT INTO weekly_rules (doctor_id, location_id, dow, start_time, end_time, slot_type, active)
                VALUES (?,?,?,?,?,?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param(
          'iiisssi',
          $doctor_id,
          $location_id,
          $dow,
          $start_time,
          $end_time,
          $slot_type,
          $active
        );
        $stmt->execute();
        $stmt->close();
        $ok = "Weekly rule added.";
      } else {
        $sql = "UPDATE weekly_rules SET doctor_id=?, location_id=?, dow=?, start_time=?, end_time=?, slot_type=?, active=? WHERE id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param(
          'iiisssii',
          $doctor_id,
          $location_id,
          $dow,
          $start_time,
          $end_time,
          $slot_type,
          $active,
          $id
        );
        $stmt->execute();
        $stmt->close();
        $ok = "Weekly rule updated.";
      }
    }

    if ($action === 'delete_weekly') {
      $id = (int)($_POST['id'] ?? 0);
      $stmt = $connection->prepare("DELETE FROM weekly_rules WHERE id=?");
      $stmt->bind_param('i',$id);
      $stmt->execute();
      $stmt->close();
      $ok = "Weekly rule deleted.";
    }

    if ($action === 'add_override' || $action === 'update_override') {
      $id          = (int)($_POST['id'] ?? 0);
      $the_date    = $_POST['the_date'] ?? '';
      $doctor_id   = (int)($_POST['doctor_id'] ?? 0);
      $location_id = $_POST['location_id'] === 'NULL' ? null : (int)$_POST['location_id'];
      $slot_type   = $_POST['slot_type'] === 'special' ? 'special' : 'normal';
      $start_time  = $slot_type === 'normal' ? ($_POST['start_time'] ?? null) : null;
      $end_time    = $slot_type === 'normal' ? ($_POST['end_time']   ?? null) : null;
      $note        = trim($_POST['note'] ?? '');

      if (empty($the_date)) throw new Exception("Date is required.");
      if (!$doctor_id) throw new Exception("Doctor is required.");
      if ($slot_type === 'normal' && (empty($start_time) || empty($end_time))) {
        throw new Exception("Start and End time are required for normal slots.");
      }

      if ($action === 'add_override') {
        $sql = "INSERT INTO date_overrides (the_date, doctor_id, location_id, start_time, end_time, slot_type, note)
                VALUES (?,?,?,?,?,?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param(
          'siissss',
          $the_date,
          $doctor_id,
          $location_id,
          $start_time,
          $end_time,
          $slot_type,
          $note
        );
        $stmt->execute();
        $stmt->close();
        $ok = "Date override added.";
      } else {
        $sql = "UPDATE date_overrides SET the_date=?, doctor_id=?, location_id=?, start_time=?, end_time=?, slot_type=?, note=? WHERE id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param(
          'siissssi',
          $the_date,
          $doctor_id,
          $location_id,
          $start_time,
          $end_time,
          $slot_type,
          $note,
          $id
        );
        $stmt->execute();
        $stmt->close();
        $ok = "Date override updated.";
      }
    }

    if ($action === 'delete_override') {
      $id = (int)($_POST['id'] ?? 0);
      $stmt = $connection->prepare("DELETE FROM date_overrides WHERE id=?");
      $stmt->bind_param('i',$id);
      $stmt->execute();
      $stmt->close();
      $ok = "Date override deleted.";
    }

    if ($action === 'toggle_doctor_location') {
      $doctor_id = (int)($_POST['doctor_id'] ?? 0);
      $location_id = (int)($_POST['location_id'] ?? 0);
      $is_active = (int)($_POST['is_active'] ?? 0);

      // Upsert
      // If exists -> update; else insert
      $stmt = $connection->prepare("SELECT 1 FROM doctor_location WHERE doctor_id=? AND location_id=?");
      $stmt->bind_param('ii', $doctor_id, $location_id);
      $stmt->execute();
      $exists = $stmt->get_result()->fetch_row();
      $stmt->close();

      if ($exists) {
        $stmt = $connection->prepare("UPDATE doctor_location SET is_active=? WHERE doctor_id=? AND location_id=?");
        $stmt->bind_param('iii', $is_active, $doctor_id, $location_id);
        $stmt->execute();
        $stmt->close();
      } else {
        $stmt = $connection->prepare("INSERT INTO doctor_location (doctor_id, location_id, is_active) VALUES (?,?,?)");
        $stmt->bind_param('iii', $doctor_id, $location_id, $is_active);
        $stmt->execute();
        $stmt->close();
      }
      $ok = "Doctor–Location mapping updated.";
    }

  } catch (Exception $e) {
    $errors[] = $e->getMessage();
  }
}

// Load current weekly rules & overrides
$weekly = [];
$q = "SELECT wr.id, wr.doctor_id, d.name AS doctor_name,
             wr.location_id, l.name AS location_name,
             wr.dow, wr.start_time, wr.end_time, wr.slot_type, wr.active
      FROM weekly_rules wr
      JOIN doctors d ON d.id=wr.doctor_id
      LEFT JOIN locations l ON l.id=wr.location_id
      ORDER BY d.name, wr.dow, wr.start_time";
$res = $connection->query($q);
while ($r = $res->fetch_assoc()) $weekly[] = $r;
$res->free();

$overrides = [];
$q = "SELECT o.id, o.the_date, o.doctor_id, d.name AS doctor_name,
             o.location_id, l.name AS location_name,
             o.start_time, o.end_time, o.slot_type, o.note
      FROM date_overrides o
      JOIN doctors d ON d.id=o.doctor_id
      LEFT JOIN locations l ON l.id=o.location_id
      ORDER BY o.the_date DESC, d.name";
$res = $connection->query($q);
while ($r = $res->fetch_assoc()) $overrides[] = $r;
$res->free();

// doctor_location grid
$docloc = [];
$q = "SELECT d.id AS doctor_id, d.name AS doctor_name,
             l.id AS location_id, l.name AS location_name,
             COALESCE(dl.is_active,0) AS is_active
      FROM doctors d
      CROSS JOIN locations l
      LEFT JOIN doctor_location dl
        ON dl.doctor_id=d.id AND dl.location_id=l.id
      WHERE d.is_active=1 AND l.is_active=1
      ORDER BY d.name, l.name";
$res = $connection->query($q);
while ($r = $res->fetch_assoc()) $docloc[] = $r;
$res->free();

$dowNames = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Availability Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
  body { background:#f6f8fb; }
  .card { border-radius:14px; }
  .form-switch .form-check-input { cursor:pointer; }
  .select2-container--default .select2-selection--single { height:38px; padding:4px 8px; }
  .select2-container--default .select2-selection__arrow { height:36px; }
  .table thead th { white-space:nowrap; }
  .small-note { color:#6b7280; font-size:12px; }
</style>
</head>
<body>
<div class="container my-4">
  <h3 class="mb-3">Doctor Availability — Admin</h3>

  <?php if ($ok): ?>
    <div class="alert alert-success"><?php echo h($ok); ?></div>
  <?php endif; ?>
  <?php foreach ($errors as $e): ?>
    <div class="alert alert-danger"><?php echo h($e); ?></div>
  <?php endforeach; ?>

  <ul class="nav nav-tabs" id="tabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="weekly-tab" data-bs-toggle="tab" data-bs-target="#weekly" type="button" role="tab">Weekly Rules</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="override-tab" data-bs-toggle="tab" data-bs-target="#override" type="button" role="tab">Date Overrides</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="map-tab" data-bs-toggle="tab" data-bs-target="#mapping" type="button" role="tab">Doctor ↔ Location</button>
    </li>
  </ul>

  <div class="tab-content mt-3">

    <!-- WEEKLY RULES -->
    <div class="tab-pane fade show active" id="weekly" role="tabpanel">
      <div class="row g-3">
        <div class="col-lg-4">
          <div class="card p-3">
            <h6>Add / Edit Weekly Rule</h6>
            <form method="post" id="formWeekly">
              <input type="hidden" name="action" value="add_weekly">
              <input type="hidden" name="id" value="">
              <div class="mb-2">
                <label class="form-label">Doctor</label>
                <select class="form-select select2" name="doctor_id" required>
                  <option value="">Select doctor</option>
                  <?php foreach ($doctors as $d): ?>
                    <option value="<?php echo (int)$d['id']; ?>"><?php echo h($d['name']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label">Location</label>
                <select class="form-select select2" name="location_id">
                  <option value="NULL">All locations (default)</option>
                  <?php foreach ($locations as $l): ?>
                    <option value="<?php echo (int)$l['id']; ?>"><?php echo h($l['name']); ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="small-note">Choose a specific location to override default timings for that location.</div>
              </div>
              <div class="mb-2">
                <label class="form-label">Day of Week</label>
                <select class="form-select" name="dow" required>
                  <?php foreach ($dowNames as $i=>$n): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i.' - '.$n; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label">Slot Type</label>
                <select class="form-select" name="slot_type" id="wr_slot_type">
                  <option value="normal">Normal (time range)</option>
                  <option value="special">Special appointments only</option>
                </select>
              </div>
              <div class="row g-2" id="wr_time_row">
                <div class="col">
                  <label class="form-label">Start Time</label>
                  <input type="time" class="form-control" name="start_time">
                </div>
                <div class="col">
                  <label class="form-label">End Time</label>
                  <input type="time" class="form-control" name="end_time">
                </div>
              </div>
              <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" name="active" id="wr_active" checked>
                <label class="form-check-label" for="wr_active">Active</label>
              </div>
              <div class="d-grid mt-3">
                <button class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card p-3">
            <h6 class="mb-2">Existing Weekly Rules</h6>
            <div class="table-responsive">
              <table class="table table-sm align-middle">
                <thead>
                  <tr>
                    <th>Doctor</th><th>Location</th><th>DOW</th><th>Type</th><th>Start</th><th>End</th><th>Active</th><th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($weekly as $w): ?>
                    <tr>
                      <td><?php echo h($w['doctor_name']); ?></td>
                      <td><?php echo h($w['location_name'] ?? 'All'); ?></td>
                      <td><?php echo (int)$w['dow'].' - '.$dowNames[(int)$w['dow']]; ?></td>
                      <td><?php echo h($w['slot_type']); ?></td>
                      <td><?php echo h($w['start_time']); ?></td>
                      <td><?php echo h($w['end_time']); ?></td>
                      <td><?php echo $w['active'] ? 'Yes' : 'No'; ?></td>
                      <td>
                        <button class="btn btn-sm btn-outline-secondary btn-edit-weekly"
                          data-id="<?php echo (int)$w['id'];?>"
                          data-doctor="<?php echo (int)$w['doctor_id'];?>"
                          data-location="<?php echo h($w['location_id'] ?? 'NULL');?>"
                          data-dow="<?php echo (int)$w['dow'];?>"
                          data-type="<?php echo h($w['slot_type']);?>"
                          data-start="<?php echo h($w['start_time']);?>"
                          data-end="<?php echo h($w['end_time']);?>"
                          data-active="<?php echo (int)$w['active'];?>">
                          Edit
                        </button>
                        <form method="post" style="display:inline" onsubmit="return confirm('Delete this rule?')">
                          <input type="hidden" name="action" value="delete_weekly">
                          <input type="hidden" name="id" value="<?php echo (int)$w['id'];?>">
                          <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; if(empty($weekly)): ?>
                    <tr><td colspan="8" class="text-muted">No rules yet.</td></tr>
                  <?php endif;?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- DATE OVERRIDES -->
    <div class="tab-pane fade" id="override" role="tabpanel">
      <div class="row g-3">
        <div class="col-lg-4">
          <div class="card p-3">
            <h6>Add / Edit Date Override</h6>
            <form method="post" id="formOverride">
              <input type="hidden" name="action" value="add_override">
              <input type="hidden" name="id" value="">
              <div class="mb-2">
                <label class="form-label">Date</label>
                <input type="date" class="form-control" name="the_date" required>
              </div>
              <div class="mb-2">
                <label class="form-label">Doctor</label>
                <select class="form-select select2" name="doctor_id" required>
                  <option value="">Select doctor</option>
                  <?php foreach ($doctors as $d): ?>
                    <option value="<?php echo (int)$d['id']; ?>"><?php echo h($d['name']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label">Location</label>
                <select class="form-select select2" name="location_id">
                  <option value="NULL">All locations (default)</option>
                  <?php foreach ($locations as $l): ?>
                    <option value="<?php echo (int)$l['id']; ?>"><?php echo h($l['name']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label">Slot Type</label>
                <select class="form-select" name="slot_type" id="ov_slot_type">
                  <option value="normal">Normal (time range)</option>
                  <option value="special">Special appointments only</option>
                </select>
              </div>
              <div class="row g-2" id="ov_time_row">
                <div class="col">
                  <label class="form-label">Start Time</label>
                  <input type="time" class="form-control" name="start_time">
                </div>
                <div class="col">
                  <label class="form-label">End Time</label>
                  <input type="time" class="form-control" name="end_time">
                </div>
              </div>
              <div class="mb-2">
                <label class="form-label">Note (optional)</label>
                <input type="text" class="form-control" name="note" placeholder="e.g., Doctor on leave">
              </div>
              <div class="d-grid mt-2">
                <button class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="card p-3">
            <h6 class="mb-2">Existing Overrides</h6>
            <div class="table-responsive">
              <table class="table table-sm align-middle">
                <thead>
                  <tr>
                    <th>Date</th><th>Doctor</th><th>Location</th><th>Type</th><th>Start</th><th>End</th><th>Note</th><th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($overrides as $o): ?>
                    <tr>
                      <td><?php echo h($o['the_date']); ?></td>
                      <td><?php echo h($o['doctor_name']); ?></td>
                      <td><?php echo h($o['location_name'] ?? 'All'); ?></td>
                      <td><?php echo h($o['slot_type']); ?></td>
                      <td><?php echo h($o['start_time']); ?></td>
                      <td><?php echo h($o['end_time']); ?></td>
                      <td><?php echo h($o['note']); ?></td>
                      <td>
                        <button class="btn btn-sm btn-outline-secondary btn-edit-override"
                          data-id="<?php echo (int)$o['id'];?>"
                          data-date="<?php echo h($o['the_date']);?>"
                          data-doctor="<?php echo (int)$o['doctor_id'];?>"
                          data-location="<?php echo h($o['location_id'] ?? 'NULL');?>"
                          data-type="<?php echo h($o['slot_type']);?>"
                          data-start="<?php echo h($o['start_time']);?>"
                          data-end="<?php echo h($o['end_time']);?>"
                          data-note="<?php echo h($o['note']);?>">
                          Edit
                        </button>
                        <form method="post" style="display:inline" onsubmit="return confirm('Delete this override?')">
                          <input type="hidden" name="action" value="delete_override">
                          <input type="hidden" name="id" value="<?php echo (int)$o['id'];?>">
                          <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; if(empty($overrides)): ?>
                    <tr><td colspan="8" class="text-muted">No overrides yet.</td></tr>
                  <?php endif;?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- DOCTOR ↔ LOCATION -->
    <div class="tab-pane fade" id="mapping" role="tabpanel">
      <div class="card p-3">
        <h6>Enable / Disable Doctor per Location</h6>
        <div class="table-responsive">
          <table class="table table-sm align-middle">
            <thead>
              <tr><th>Doctor</th><th>Location</th><th>Active</th><th>Update</th></tr>
            </thead>
            <tbody>
              <?php foreach ($docloc as $dl): ?>
                <tr>
                  <td><?php echo h($dl['doctor_name']); ?></td>
                  <td><?php echo h($dl['location_name']); ?></td>
                  <td>
                    <span class="badge <?php echo $dl['is_active']?'bg-success':'bg-secondary'; ?>">
                      <?php echo $dl['is_active']?'Yes':'No'; ?>
                    </span>
                  </td>
                  <td>
                    <form method="post">
                      <input type="hidden" name="action" value="toggle_doctor_location">
                      <input type="hidden" name="doctor_id" value="<?php echo (int)$dl['doctor_id']; ?>">
                      <input type="hidden" name="location_id" value="<?php echo (int)$dl['location_id']; ?>">
                      <select name="is_active" class="form-select form-select-sm" style="width:auto; display:inline-block">
                        <option value="1" <?php echo $dl['is_active']?'selected':''; ?>>Active</option>
                        <option value="0" <?php echo !$dl['is_active']?'selected':''; ?>>Inactive</option>
                      </select>
                      <button class="btn btn-sm btn-outline-primary">Save</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; if(empty($docloc)): ?>
                <tr><td colspan="4" class="text-muted">No rows.</td></tr>
              <?php endif;?>
            </tbody>
          </table>
        </div>
        <div class="small-note">Only “Active” mappings should be considered valid for scheduling/booking at that location.</div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.full.min.js"></script>
<script>
$(function(){
  $('.select2').select2();

  // Weekly: hide times for special
  function toggleWeeklyTimes(){
    if($('#wr_slot_type').val()==='special'){ $('#wr_time_row').hide(); }
    else { $('#wr_time_row').show(); }
  }
  toggleWeeklyTimes();
  $('#wr_slot_type').on('change', toggleWeeklyTimes);

  // Overrides: hide times for special
  function toggleOverrideTimes(){
    if($('#ov_slot_type').val()==='special'){ $('#ov_time_row').hide(); }
    else { $('#ov_time_row').show(); }
  }
  toggleOverrideTimes();
  $('#ov_slot_type').on('change', toggleOverrideTimes);

  // Fill Weekly form on Edit
  $('.btn-edit-weekly').on('click', function(){
    const f = $('#formWeekly')[0];
    f.action.value = 'update_weekly';
    f.id.value = this.dataset.id;
    $(f.doctor_id).val(this.dataset.doctor).trigger('change');
    $(f.location_id).val(this.dataset.location).trigger('change');
    $(f.dow).val(this.dataset.dow);
    $(f.slot_type).val(this.dataset.type).trigger('change');
    f.start_time.value = this.dataset.start || '';
    f.end_time.value   = this.dataset.end || '';
    f.active.checked   = (this.dataset.active === '1');
    window.scrollTo({top:0, behavior:'smooth'});
  });

  // Fill Override form on Edit
  $('.btn-edit-override').on('click', function(){
    const f = $('#formOverride')[0];
    f.action.value = 'update_override';
    f.id.value = this.dataset.id;
    f.the_date.value = this.dataset.date;
    $(f.doctor_id).val(this.dataset.doctor).trigger('change');
    $(f.location_id).val(this.dataset.location).trigger('change');
    $(f.slot_type).val(this.dataset.type).trigger('change');
    f.start_time.value = this.dataset.start || '';
    f.end_time.value   = this.dataset.end || '';
    f.note.value       = this.dataset.note || '';
    window.scrollTo({top:0, behavior:'smooth'});
  });
});
</script>
</body>
</html>
