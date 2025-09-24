<?php
header('Content-Type: application/json'); 

include("../../../connect.php");
$currentdate = date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
$Location = $_SESSION['SESS_LOCATION'];


$from = mysqli_real_escape_string($connection, $_POST['from'] ?? '');
$to   = mysqli_real_escape_string($connection, $_POST['to'] ?? '');
if (!$from || !$to) { echo json_encode(['success'=>false,'rows'=>[]]); exit; }

/*
  Example sources:
  - Consulting cash from salepayment (cash only) joined to consultation bills
  - Medicine cash from pharmacy sales
  - Therapy cash from therapy billing
  Replace these with your real tables. All grouped by DATE.
*/

$sql = "-- MySQL 5.7/8+
SELECT t.dt        AS `date`,
       t.Con,
       t.Med,
       t.Thy,
       (t.Con + t.Med + t.Thy) AS Total
FROM (
  SELECT 
    DATE(spd.`date`) AS dt,

    -- Consulting bucket
    ROUND(SUM(CASE 
      WHEN spd.transactiontype IN ('Bonus','Diagnosis','DoctorFee','Incentive','IncomeEntry','Salary')
      THEN spd.amount ELSE 0 END), 0) AS Con,

    -- Medicine/Store bucket
    ROUND(SUM(CASE 
      WHEN spd.transactiontype IN ('Advance - PaitentOrder','CashAdvance','ExpenseEntry','OutstandingCollection',
                                   'RefundToCustomer','Sales','Sales2')
      THEN spd.amount ELSE 0 END), 0) AS Med,

    -- Therapy bucket
    ROUND(SUM(CASE 
      WHEN spd.transactiontype IN ('Therapy Payment')
      THEN spd.amount ELSE 0 END), 0) AS Thy

  FROM salepaymentdetails spd
  WHERE spd.transactionstatus = 'Live'
    AND spd.`date` between '$from'    and '$to'  and clientid='$Location'   and spd.paymentmode ='12'    -- cast to DATE if it's DATETIME
  GROUP BY DATE(spd.`date`)
) AS t
ORDER BY t.dt;

";

$rows = [];
if ($res = mysqli_query($connection, $sql)) {
  while ($r = mysqli_fetch_assoc($res)) $rows[] = $r;
}
echo json_encode(['success'=>true, 'rows'=>$rows], JSON_NUMERIC_CHECK);