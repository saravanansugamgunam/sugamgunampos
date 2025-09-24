<?php
include("../../../connect.php");
$currentdate = date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["DayCloseDate"])) {

	// echo "1"; 
	$DayCloseDate = mysqli_real_escape_string($connection, $_POST["DayCloseDate"]);
// 	$Location = '%'; //mysqli_real_escape_string($connection, $_POST["Location"]);
	// $LocationCode = $_SESSION['SESS_LOCATION'];
	$LocationCode = '%';

	$Location = $_SESSION['SESS_LOCATION'];

	function formatMoney($number, $fractional = false)
	{
		if ($fractional) {
			$number = sprintf('%.2f', $number);
		}
		while (true) {
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
			if ($replaced != $number) {
				$number = $replaced;
			} else {
				break;
			}
		}
		return $number;
	}




	$query = mysqli_query($connection, " 
 
SELECT  

(SELECT  
IFNULL(ROUND(SUM(amount),0),0) AS Income  FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.paymentmode=b.paymentmodecode
WHERE  a.date = '$DayCloseDate'  AND a.clientid LIKE ('$Location') AND
 transactiontype IN ('CashAdvance','IncomeEntry','OutstandingCollection','PaitentOrder' ) AND transactionstatus='Live' 
 AND b.paymentmodecode  = '12' AND transactiongroup in('Clinic')  
  ) AS IncomeEntry,
 
 
 (SELECT  
IFNULL(ROUND(SUM(amount),0),0) AS Income  FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.paymentmode=b.paymentmodecode
WHERE  a.date = '$DayCloseDate'  AND a.clientid LIKE ('$Location') AND
 transactiontype IN ('Sales') AND transactionstatus='Live' 
 AND b.paymentmodecode  = '12'  AND transactiongroup ='Clinic' AND 
 completionstatus ='1' ) AS Sales,
 
 (SELECT  IFNULL(ROUND(SUM(amount),0),0)  FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.paymentmode=b.paymentmodecode
WHERE  a.date BETWEEN  '$DayCloseDate' AND '$DayCloseDate'  AND a.transactiontype NOT IN 
('SalesReturn')  AND a.clientid LIKE ('$Location') AND transactiontype IN
 ('ExpenseEntry','SupplierOrder','RefundToCustomer','Salary','Supplier Payment','Doctor Share') AND transactionstatus='Live' 
 AND b.paymentmodecode  = '12'  AND transactiongroup in('Clinic') 
  ) AS ExpenseEntry,
   

  (SELECT  
IFNULL(ROUND(SUM(amount),0),0) AS Income  FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.`paymentmode`=b.`paymentmodecode`
WHERE  a.`date` = '$DayCloseDate' AND a.clientid LIKE ('$Location')  AND transactionstatus ='Live' 
 AND transactiongroup ='Clinic' AND transactiontype IN ('DoctorFee','Diagnosis')
  AND transactionstatus='Live' 
 AND b.paymentmodecode  = '12'  AND 
 completionstatus ='1' ) AS Consulting ,
 
  
 (select closingcash  FROM denomination WHERE  
 id  IN(  SELECT MAX(id) FROM denomination   WHERE   
 createdon IN (SELECT MAX(createdon) FROM  denomination   ) AND closinggroup='2' ) 
 and  closinggroup='2')  as Opening
 


 
");


	$data = array();

	while ($row = mysqli_fetch_assoc($query)) {
		$data[] = $row['Consulting'] * 1;
		$data[] = $row['IncomeEntry'] * 1;
		$data[] = $row['ExpenseEntry'] * 1;
		$data[] = $row['Consulting'] - $row['ExpenseEntry'];
		$data[] = $row['Opening'];
	}

	echo json_encode($data);


	mysqli_close($connection);
} else {
	echo " NO";
}