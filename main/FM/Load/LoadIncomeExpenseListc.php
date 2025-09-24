<?php
session_cache_limiter(FALSE);
session_start();
include("../../../connect.php");

function formatMoney($number, $fractional=false) {
  if ($fractional) {
    $number = sprintf('%.2f', $number);
  }
  while (true) {
    $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
    if ($replaced != $number) { $number = $replaced; } else { break; }
  }
  return $number;
}

$currentdate = date("Y-m-d");

$Period          = mysqli_real_escape_string($connection, $_POST["Period"] ?? 'Today');
$ToDate          = mysqli_real_escape_string($connection, $_POST["ToDate"] ?? $currentdate);
$FromDate        = mysqli_real_escape_string($connection, $_POST["FromDate"] ?? $currentdate);
$ApprovalStatus  = mysqli_real_escape_string($connection, $_POST["ApprovalStatus"] ?? '%');

if ($Period == 'Today') {
  $FromPeriod = $currentdate;
  $ToPeriod   = $currentdate;
} else if ($Period == 'Tomorrow') {
  $FromPeriod = date('Y-m-d', strtotime('+1 day', strtotime($currentdate)));
  $ToPeriod   = $FromPeriod;
} else if ($Period == 'CurrentMonth') {
  $FromPeriod = date('Y-m-01', strtotime($currentdate));
  $ToPeriod   = date('Y-m-t', strtotime($currentdate));
} else if ($Period == 'Next7Days') {
  $FromPeriod = $currentdate;
  $ToPeriod   = date('Y-m-d', strtotime('+7 day', strtotime($currentdate)));
} else if ($Period == 'Next14Days') {
  $FromPeriod = $currentdate;
  $ToPeriod   = date('Y-m-d', strtotime('+14 day', strtotime($currentdate)));
} else if ($Period == 'Next30Days') {
  $FromPeriod = $currentdate;
  $ToPeriod   = date('Y-m-d', strtotime('+30 day', strtotime($currentdate)));
} else if ($Period == 'Custom') {
  $FromPeriod = $FromDate;
  $ToPeriod   = $ToDate;
} else if ($Period == 'Pending') {
  $FromPeriod = date('Y-m-d', strtotime('-360 day', strtotime($currentdate)));
  $ToPeriod   = $currentdate;
} else if ($Period == 'Yesterday') {
  $FromPeriod = date('Y-m-d', strtotime('-1 day', strtotime($currentdate)));
  $ToPeriod   = $FromPeriod;
} else if ($Period == 'Last7Days') {
  $FromPeriod = date('Y-m-d', strtotime('-7 day', strtotime($currentdate)));
  $ToPeriod   = $currentdate;
} else if ($Period == 'Last14Days') {
  $FromPeriod = date('Y-m-d', strtotime('-14 day', strtotime($currentdate)));
  $ToPeriod   = $currentdate;
} else if ($Period == 'Last30Days') {
  $FromPeriod = date('Y-m-d', strtotime('-30 day', strtotime($currentdate)));
  $ToPeriod   = $currentdate;
}
?>
 

<!-- Your styles (kept + a few additions for responsiveness) -->
<style>
table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 100%;               /* was 40% */
  max-width: 500px;          /* optional cap */
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 2px 2px;
  text-align: center;
}
table.blueTable tbody td { font-size: 13px; text-align: center; }
table.blueTable tr:nth-child(even) { background: #D0E4F5; }
table.blueTable thead {
  background: #83b3e4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 1px solid #444444;
}
table.blueTable thead th {
  font-size: 14px;
  font-weight: normal;
  color: #FFFFFF;
  border-left: 1px solid #D0E4F5;
  padding: 5px 20px;
}
table.blueTable thead th:first-child { border-left: none; }
table.blueTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
}
table.blueTable tfoot td { font-size: 14px; }
table.blueTable tfoot .links { text-align: right; }
table.blueTable tfoot .links a {
  display: inline-block; background: #1C6EA4; color: #FFFFFF;
  padding: 2px 8px; border-radius: 5px;
}

/* ---------- Responsive table helpers ---------- */
.table-responsive {
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

#data-table th, #data-table td { white-space: nowrap; }
#data-table td.remarks-cell { white-space: normal; word-break: break-word; }

#data-table.table-sm th, #data-table.table-sm td { padding: .35rem .5rem; }

@media (max-width: 576px) {
  .hide-sm { display: none !important; }
}

/* simple layout helpers */
.row { display: flex; flex-wrap: wrap; gap: 16px; }
.col { flex: 1 1 auto; min-width: 260px; }
.col-fixed { flex: 0 0 220px; }
.w-100 { width: 100%; }
.btn { display:inline-block; padding:8px 12px; border:0; border-radius:6px; cursor:pointer; }
.btn-warning { background:#f0ad4e; color:#fff; }
.form-group { margin:10px 0; }
.form-control { width:100%; padding:8px; border:1px solid #ccc; border-radius:4px; }
.align-middle td, .align-middle th { vertical-align: middle; }
 
</style>
 
 

<?php
// ----------- SUMMARY (Opening/Income/Expense/Closing) -----------
$TotalStock = mysqli_query($connection, "
WITH
params AS (
  SELECT CAST('$FromPeriod' AS DATE) AS from_dt,
         CAST('$ToPeriod'   AS DATE) AS to_dt
),
opening AS (
  SELECT COALESCE(SUM(a.incomeamount - a.expenseamount), 0) AS opening_balance
  FROM accountingtransaction a
  JOIN accountingledger     b ON a.ledgerid = b.ledgerid
  JOIN accoutingcategory    c ON b.categoryid = c.categoryid
  JOIN params               p
  WHERE b.cashledger = 'Cash'
    AND DATE(a.`date`) < p.from_dt
),
period AS (
  SELECT
    COALESCE(SUM(a.incomeamount), 0)                   AS period_income,
    COALESCE(SUM(a.expenseamount), 0)                  AS period_expense,
    COALESCE(SUM(a.incomeamount - a.expenseamount),0)  AS period_net
  FROM accountingtransaction a
  JOIN accountingledger     b ON a.ledgerid = b.ledgerid
  JOIN accoutingcategory    c ON b.categoryid = c.categoryid
  JOIN params               p
  WHERE b.cashledger = 'Cash'
    AND DATE(a.`date`) BETWEEN p.from_dt AND p.to_dt
)
SELECT
  o.opening_balance AS Opening,
  p.period_income   AS Income,
  p.period_expense  AS Expense,
  p.period_net      AS Total,
  (o.opening_balance + p.period_net) AS Closing
FROM opening o CROSS JOIN period p;
");

// layout row: summary on left, actions on right
echo "<div class='row'>";

// LEFT: summary table
echo "<div class='col'>";
echo "  <div class='table-responsive'>";
echo "    <table id='tblTotalStock' border='1' class='blueTable'>";
echo "      <thead><tr>
              <th>Opening</th>
              <th>Income</th>
              <th>Expense</th>
              <th>Closing Balance</th>
            </tr></thead><tbody>";

while($data = mysqli_fetch_row($TotalStock)) {
  echo "<tr>
          <td>".formatMoney($data[0], false)."</td>
          <td>".formatMoney($data[1], false)."</td>
          <td>".formatMoney($data[2], false)."</td>
          <td><b>".formatMoney($data[4], false)."</b></td>
        </tr>";
}
echo "      </tbody></table>";
echo "  </div>";
echo "</div>";

// RIGHT: action buttons
echo "<div class='col-fixed'>";
echo "  <button class='btn btn-warning w-100' onclick='LoadIncomeExpenseListUnApproved();'>Unapproved Entries</button>";
echo "</div>";

echo "</div>"; // .row

// ----------- DETAILED LIST -----------
$result = mysqli_query($connection, "
SELECT a.invoiceno,
       a.transactiongroup,
       c.categoryname,
       b.ledgername,
       a.incomeamount,
       a.expenseamount,
       (a.incomeamount - a.expenseamount) AS Total,
       a.remarks,
       IF(LENGTH(CONCAT(a.photo_path,a.pdf_path))>10, CONCAT(a.photo_path,a.pdf_path),'No') AS files,
       DATE_FORMAT(a.date, '%d-%m-%Y') AS txndate,
       a.approvalstatus,
       a.tag,
       d.locationshortcode,
       e.username
  FROM accountingtransaction AS a
  JOIN accountingledger      AS b ON a.ledgerid = b.ledgerid
  JOIN accoutingcategory     AS c ON b.categoryid = c.categoryid
  JOIN locationmaster        AS d ON a.clientid  = d.locationcode
  JOIN usermaster            AS e ON a.createdby = e.userid
 WHERE b.cashledger='Cash'
   AND DATE_FORMAT(a.date, '%Y-%m-%d') BETWEEN '$FromPeriod' AND '$ToPeriod'
   AND a.approvalstatus LIKE '$ApprovalStatus'
 ORDER BY a.date
");

echo "<div class='table-responsive'>";
echo "  <table id='data-table' class='table table-bordered table-sm align-middle'>";
echo "    <thead><tr>
            <th>S.No</th>
            <th hidden>ID</th>
            <th>Date</th>
            <th>Account</th>
            <th class='hide-sm' >Group</th> 
            <th>Ledger</th>
            <th class='hide-sm'>Tag</th>
            <th class='hide-sm'>Remarks</th>
            <th class='hide-sm'>Entered By</th>
            <th>Income</th>
            <th>Expense</th>
            <th>Del</th>
            <th>File</th>
            <th>Status</th>
          </tr></thead><tbody>";

$SerialNo = 1;
while($data = mysqli_fetch_row($result)) {
  // $data indices:
  // 0 invoiceno, 1 transactiongroup, 2 categoryname, 3 ledgername, 4 incomeamount,
  // 5 expenseamount, 6 total, 7 remarks, 8 files, 9 txndate, 10 approvalstatus,
  // 11 tag, 12 locationshortcode, 13 username

  echo "<tr>
          <td>{$SerialNo}</td>
          <td hidden>{$data[0]}</td>
          <td>{$data[9]}</td>
          <td>{$data[12]}</td>
          <td >{$data[1]}</td> 
          <td>{$data[3]}</td>
          <td class='hide-sm'>{$data[11]}</td>
          <td class='hide-sm'>{$data[7]}</td>
          <td class='hide-sm'>{$data[13]}</td>
          <td align='right'>".formatMoney($data[4], false)."</td>
          <td align='right'>".formatMoney($data[5], false)."</td>

          <td align='center' style='color:red; cursor:pointer;' onclick='DeleteExpenseEntry({$data[0]});' title='Delete'>
            <i class='fa fa-trash'></i>
          </td>

          <td align='center'>";
  if ($data[8] != 'No') {
    echo "<a href='{$data[8]}' target='_blank' title='Open file'><i class='fa fa-file'></i></a>";
  }
  echo     "</td>

          <td align='center'>";
  if ($data[10] == '1') {
    echo "<i style='color:green' class='fa fa-check-circle' title='Approved'></i>";
  } else {
    echo "<i style='color:red; cursor:pointer;' class='fa fa-exclamation-triangle' title='Approve'
     onclick='ApproveTransaction({$data[0]});'></i>";
  }
  echo   "</td>



        </tr>";
 

  $SerialNo++;
}
echo "  </tbody></table>";
echo "</div>";
?>
 

<script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
  <script src="../assets/js/table-manage-default.demo.min.js"></script>

  <script>
$(document).ready(function() {
    
    TableManageDefault.init();
});
  </script>
