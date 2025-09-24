<?php
session_cache_limiter(false);
session_start();
require_once '../../connect.php'; // adjust path to your connect.php

// --------- INPUTS ----------
$settlement_id = isset($_GET['settlement_id']) ? (int)$_GET['settlement_id'] : 0;
$from = isset($_GET['from']) ? $_GET['from'] : '';
$to   = isset($_GET['to'])   ? $_GET['to']   : '';
$location = isset($_SESSION['SESS_LOCATION']) ? $_SESSION['SESS_LOCATION'] : null;

// --------- HELPERS ----------
function fmt($n){ return number_format((float)$n,0,'.',','); }
function as_ddmmyyyy($d){
  if (!$d) return '';
  $t = strtotime($d);
  return date('d/m/Y', $t);
}

// --------- LOAD MASTER + DENOMS if settlement_id ----------
$master = null; $denoms = [];
if ($settlement_id > 0) {
  $sqlM = "SELECT id, from_date, to_date, system_cash, counted_cash, difference_amt, location_code, created_on
           FROM cash_settlement_master WHERE id=? LIMIT 1";
  $st = mysqli_prepare($connection, $sqlM);
  mysqli_stmt_bind_param($st,'i',$settlement_id);
  mysqli_stmt_execute($st);
  $res = mysqli_stmt_get_result($st);
  $master = mysqli_fetch_assoc($res);
  mysqli_stmt_close($st);

  if ($master) {
    $from = $master['from_date'];
    $to   = $master['to_date'];
    $sqlD = "SELECT denomination, qty, (denomination*qty) AS line_total
             FROM cash_settlement_denoms WHERE settlement_id=? ORDER BY denomination DESC";
    $st2 = mysqli_prepare($connection, $sqlD);
    mysqli_stmt_bind_param($st2,'i',$settlement_id);
    mysqli_stmt_execute($st2);
    $res2 = mysqli_stmt_get_result($st2);
    while($r=mysqli_fetch_assoc($res2)) $denoms[] = $r;
    mysqli_stmt_close($st2);
  }
}

// --------- VALIDATE DATES ----------
if (!$from || !$to) {
  // if still not set, default to today
  $from = $to = date('Y-m-d');
}

// --------- DATEWISE SALES (live from DB) ----------
$sqlSales = "
SELECT 
  DATE(spd.`date`) AS d,
  ROUND(SUM(CASE 
    WHEN spd.transactiontype IN ('Bonus','Diagnosis','DoctorFee','Incentive','IncomeEntry','Salary')
      THEN spd.amount ELSE 0 END),0) AS consulting,
  ROUND(SUM(CASE 
    WHEN spd.transactiontype IN ('Advance - PaitentOrder','CashAdvance','ExpenseEntry','OutstandingCollection',
                                 'RefundToCustomer','Sales','Sales2')
      THEN spd.amount ELSE 0 END),0) AS medicine,
  ROUND(SUM(CASE WHEN spd.transactiontype IN ('Therapy Payment')
      THEN spd.amount ELSE 0 END),0) AS therapy
FROM salepaymentdetails spd
WHERE spd.paymentmode='12' and  spd.transactionstatus='Live'
  AND DATE(spd.`date`) BETWEEN ? AND ?  and clientid='$location'  
GROUP BY DATE(spd.`date`)
ORDER BY DATE(spd.`date`)
";
$rows = [];
$st3 = mysqli_prepare($connection, $sqlSales);
mysqli_stmt_bind_param($st3,'ss',$from,$to);
mysqli_stmt_execute($st3);
$res3 = mysqli_stmt_get_result($st3);
while($r = mysqli_fetch_assoc($res3)) $rows[] = $r;
mysqli_stmt_close($st3);

// Totals
$sumC=$sumM=$sumT=$sumTotal=$cum=0;
foreach($rows as &$r){
  $r['total'] = (int)$r['consulting'] + (int)$r['medicine'] + (int)$r['therapy'];
  $cum += $r['total'];
  $r['cumulative'] = $cum;
  $sumC += (int)$r['consulting']; $sumM += (int)$r['medicine']; $sumT += (int)$r['therapy']; $sumTotal += $r['total'];
}
unset($r);

// System cash: prefer master value if settlement_id given; else use sumTotal
$systemCash = $master ? (float)$master['system_cash'] : (float)$sumTotal;

// If no denoms in DB (printing by date range), leave table empty but keep totals footer consistent
$dnmTotal = 0.0;
foreach($denoms as $d){ $dnmTotal += (float)$d['line_total']; }
$difference = $dnmTotal - $systemCash;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Clinic Cash Settlement</title>
<style>
  :root{ --fs:12px; --border:#777; --muted:#666; --head:#000; --zebra:#f5f9ff; }
  html,body{ font-family:Arial,Helvetica,sans-serif; font-size:var(--fs); color:#111; }
  .print-wrap{ width: 287mm; min-height: 200mm; margin:0 auto; padding:10mm 12mm; box-sizing:border-box; }
  .topbar{ display:flex; align-items:flex-start; }
  .title{ font-size: 16px; font-weight:700; }
  .spacer{ flex:1; }
  .datebox{ font-size:var(--fs); }
  .label{ color:var(--muted); margin-right:6px; }
  .grid{ display:flex; gap: 12mm; margin-top: 6mm; }
  .col{ flex:1; }
  .col.right{ flex:0 0 98mm; } /* right panel width in landscape */
  h3{ font-size:14px; margin:0 0 4mm; }
  table{ width:100%; border-collapse:collapse; }
  th,td{ border:1px solid var(--border); padding:6px 8px; }
  th{ background:#e9eef7; font-weight:700; color:var(--head); }
  tbody tr:nth-child(even) td{ background:var(--zebra); }
  td.num, th.num{ text-align:right; }
  tfoot th, tfoot td{ background:#eef2f7; font-weight:700; }
  .noborder td{ border:0; padding:3px 0; }
  .foot{ margin-top:12mm; }
  .sigline{ border-top:1px solid #000; height:0; margin-top:12mm; width:85%; }
  /* PRINT */
  @media print{
    @page{ size: A4 landscape; margin: 8mm; }
    .print-btn{ display:none !important; }
    .print-wrap{ box-shadow:none; padding:8mm; }
  }
  /* SCREEN shadow */
  @media screen{
    body{ background:#f0f2f5; }
    .print-wrap{ background:#fff; box-shadow:0 0 0 1px #ddd, 0 8px 24px rgba(0,0,0,.08); }
  }
</style>
</head>
<body>
<div class="print-wrap" id="printArea">
  <div class="topbar">
    <div class="title">Clinic Cash Settlement</div>
    <div class="spacer"></div>
    <div class="datebox"><span class="label">Date:</span><span><?= as_ddmmyyyy($to) ?></span></div>
  </div>

  <div class="grid">
    <!-- LEFT -->
    <div class="col">
      <h3>Clinic Cash Settlement</h3>
      <table>
        <thead>
          <tr>
            <th style="width:22%">Date</th>
            <th class="num">Consulting</th>
            <th class="num">Medicine</th>
            <th class="num">Therapy</th>
            <th class="num">Total</th>
            <th class="num">Cumulative Total</th>
          </tr>
        </thead>
        <tbody>
        <?php if (count($rows) === 0): ?>
          <tr><td colspan="6" style="text-align:center;color:#888;">No data</td></tr>
        <?php else: 
          $running = 0;
          foreach($rows as $r):
            $running += (int)$r['total']; ?>
          <tr>
            <td><?= as_ddmmyyyy($r['d']) ?></td>
            <td class="num"><?= fmt($r['consulting']) ?></td>
            <td class="num"><?= fmt($r['medicine']) ?></td>
            <td class="num"><?= fmt($r['therapy']) ?></td>
            <td class="num"><?= fmt($r['total']) ?></td>
            <td class="num"><?= fmt($running) ?></td>
          </tr>
        <?php endforeach; endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th>Total</th>
            <th class="num"><?= fmt($sumC) ?></th>
            <th class="num"><?= fmt($sumM) ?></th>
            <th class="num"><?= fmt($sumT) ?></th>
            <th class="num"><?= fmt($sumTotal) ?></th>
            <th class="num"><?= fmt($cum) ?></th>
          </tr>
        </tfoot>
      </table>
    </div>

    <!-- RIGHT -->
    <div class="col right">
      <h3>Cash Denomination</h3>
      <table>
        <thead>
          <tr>
            <th>Denomination</th>
            <th class="num" style="width:32%">Count</th>
            <th class="num" style="width:38%">Total</th>
          </tr>
        </thead>
        <tbody>
        <?php if (count($denoms) === 0): 
          // print the standard rows (500..1) with blanks
          $std = [500,200,100,50,20,10,5,1];
          foreach($std as $d): ?>
          <tr>
            <td>₹ <?= fmt($d) ?></td>
            <td class="num">-</td>
            <td class="num">-</td>
          </tr>
          <?php endforeach; else:
            foreach($denoms as $d): ?>
          <tr>
            <td>₹ <?= fmt($d['denomination']) ?></td>
            <td class="num"><?= fmt($d['qty']) ?></td>
            <td class="num"><?= fmt($d['line_total']) ?></td>
          </tr>
        <?php endforeach; endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th>Total</th><th></th>
            <th class="num"><?= fmt($dnmTotal) ?></th>
          </tr>
          <tr>
            <th>System Cash</th><th></th>
            <th class="num"><?= fmt($systemCash) ?></th>
          </tr>
          <tr>
            <th>Difference</th><th></th>
            <th class="num"><?= fmt($dnmTotal - $systemCash) ?></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

  <!-- Footer lines -->
  <table class="noborder foot" style="width:100%;">
    <tr>
      <td style="width:50%"><strong>Paid By:</strong><div class="sigline"></div></td>
      <td style="width:50%"><strong>Received By:</strong><div class="sigline"></div></td>
    </tr>
  </table>
</div>

<div style="text-align:center; margin:14px 0;">
  <button class="print-btn" onclick="window.print()">Print</button>
</div>
</body>
</html>
