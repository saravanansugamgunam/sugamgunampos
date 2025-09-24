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
  

	// echo "  
	// SELECT 	 
	//  (SELECT  IFNULL(ROUND(SUM(amount),0),0)  FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
	// ON a.paymentmode=b.paymentmodecode
	// WHERE  a.date BETWEEN  '$DayCloseDate' AND '$DayCloseDate'  AND a.transactiontype NOT IN 
	// ('SalesReturn')  AND a.clientid LIKE ('$Location') AND transactiontype IN
	//  ('Therapy Share') AND transactionstatus='Live' 
	//  AND b.paymentmodecode  = '12'  AND transactiongroup in('Clinic') 
	//   ) AS ExpenseEntry,
	  
	//   (SELECT 
	// IFNULL(ROUND(SUM(amount),0),0) AS Income FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
	// ON a.`paymentmode`=b.`paymentmodecode`
	// WHERE  a.`date` = '$DayCloseDate' AND a.clientid LIKE ('$Location')  AND transactionstatus ='Live' 
	//  AND transactiongroup ='Clinic' AND transactiontype IN ('Therapy Payment')
	//   AND transactionstatus='Live' 
	//  AND b.paymentmodecode  = '12'  AND 
	//  completionstatus ='1' ) AS Therapy ,
	
	//  (select closingcash  FROM denomination WHERE  
	//  closingdate IN(SELECT MAX(closingdate) FROM denomination WHERE closinggroup='3' ) and  closinggroup='3')  as Opening
	 
	// ";



	$query = mysqli_query($connection, " 
 
SELECT   
 
 (SELECT  IFNULL(ROUND(SUM(amount),0),0)  FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.paymentmode=b.paymentmodecode
WHERE  a.date BETWEEN  '$DayCloseDate' AND '$DayCloseDate'  AND a.transactiontype NOT IN 
('SalesReturn')  AND a.clientid LIKE ('$Location') AND transactiontype IN
 ('Therapy Share') AND transactionstatus='Live' 
 AND b.paymentmodecode  = '12'  AND transactiongroup in('Clinic','Therapy') 
  ) AS ExpenseEntry,
  
  (SELECT 
IFNULL(ROUND(SUM(amount),0),0) AS Income FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.`paymentmode`=b.`paymentmodecode`
WHERE  a.`date` = '$DayCloseDate' AND a.clientid LIKE ('$Location')  AND transactionstatus ='Live' 
 AND transactiongroup ='Clinic' AND transactiontype IN ('Therapy Payment','Therapy PaymentAdvance')
  AND transactionstatus='Live' 
 AND b.paymentmodecode  = '12'  AND 
 completionstatus ='1' ) AS Therapy ,

 
 (select closingcash  FROM denomination WHERE  
 id  IN(  SELECT MAX(id) FROM denomination   WHERE   
 createdon IN (SELECT MAX(createdon) FROM  denomination   ) AND closinggroup='3' ) 
 and  closinggroup='3')  as Opening

 
");
 

	$data = array();

	while ($row = mysqli_fetch_assoc($query)) {
		$data[] = $row['Therapy'];
		$data[] = 0;  
		$data[] = 0;
		$data[] = $row['Therapy'];
		$data[] = $row['Opening'];
	}

	echo json_encode($data); 
	mysqli_close($connection);




} else {
	echo " NO";
 }

 