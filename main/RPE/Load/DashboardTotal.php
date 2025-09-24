<?php
   include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Type"]))
{	
  
 // echo "1"; 
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
   $LocationCode = $_SESSION['SESS_LOCATION'];
   						  
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $Location = mysqli_real_escape_string($connection, $_POST["Location"]); 

if($FromDate=="")
{
	$ActualFromDate= date('Y-m-d 00:00:00');
	$ActualToDate= date('Y-m-d 23:59:59');
	
}
else
{
$FromDate = explode('/', $FromDate); 
$ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0].' 00:00:00';
$ToDate = explode('/', $ToDate); 
$ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0].' 23:59:59' ;

// $ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));
}

if($Location=='-')
{
$Location='%';
}



  

function formatMoney($number, $fractional=false) {
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
(SELECT IFNULL(ROUND(SUM(amount),0),0) FROM salepaymentdetails WHERE transactiontype IN('Sales') 
and transactiongroup in('Inventory','Clinic')  and date BETWEEN '$ActualFromDate' AND '$ActualToDate' and 
 transactionstatus ='Live'  and clientid like ('$Location') ) AS Sales, 
 
(SELECT IFNULL(ROUND(SUM(amount),0),0) FROM salepaymentdetails WHERE transactiontype IN('DoctorFee') 
 and date BETWEEN '$ActualFromDate'  AND '$ActualToDate'   AND transactionstatus ='Live'  and 
 transactiongroup in('Inventory','Clinic') 
 and clientid like ('$Location')  ) AS Consultation, 


(SELECT IFNULL(ROUND(SUM(amount)	,0),0) FROM salepaymentdetails WHERE
 transactiontype IN('RefundToCustomer','SupplierOrder','ExpenseEntry',
 'Supplier Payment','Doctor Share','Therapy Share','Advance','Bonus','Consulting Share','Incentive','Salary') 
   and transactiongroup in('Inventory','Clinic')  and transactionstatus ='Live' 
    and date BETWEEN '$ActualFromDate' AND '$ActualToDate'  and clientid like ('$Location')) AS Expenses,

( SELECT  IFNULL(ROUND(SUM(topay)-SUM(receipt),0),0) FROM paitentmaster ) AS Outstanding,

(SELECT  IFNULL(ROUND(SUM(amount),0),0) FROM salepaymentdetails WHERE
 transactiontype IN('CashAdvance','IncomeEntry','PaitentOrder',
 'OutstandingCollection','Sales','Therapy Payment','DoctorFee')
  and clientid like ('$Location') 
 and transactiongroup in('Inventory','Clinic') and transactionstatus ='Live' 
  and date BETWEEN '$ActualFromDate' AND '$ActualToDate' and clientid like ('$Location') ) AS TotalIncome,

  (SELECT IFNULL(ROUND(SUM(amount),0),0) FROM salepaymentdetails WHERE transactiontype IN('Therapy Payment') 
 and date BETWEEN '$ActualFromDate'  AND '$ActualToDate'   AND transactionstatus ='Live'  and 
 transactiongroup in('Inventory','Clinic') 
 and clientid like ('$Location')  ) AS Therapy 
  
 ");
 
   
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    {  
  $NettAmount = $row['TotalIncome'] -$row['Expenses'];

      $data[] = formatMoney($row['Sales'],false);
      $data[] = formatMoney($row['Consultation'],false);
      $data[] = formatMoney($row['Expenses'],false);
      $data[] = formatMoney($row['Outstanding'],false);
      $data[] = formatMoney($row['TotalIncome'],false);  
      $data[] = formatMoney($row['Therapy'],false);  
      $data[] = formatMoney($NettAmount,false);  
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);
	
	// echo "
// SELECT 
// (SELECT IFNULL(ROUND(SUM(amount),0),0) FROM salepaymentdetails WHERE transactiontype IN('Sales')  and date BETWEEN '$ActualFromDate' AND '$ActualToDate' and clientid like ('$Location') ) AS Sales,
// (SELECT IFNULL(ROUND(SUM(amount),0),0) FROM salepaymentdetails WHERE transactiontype IN('PaitentOrder','CashAdvance')  and date BETWEEN '$ActualFromDate' AND '$ActualToDate'  and clientid like ('$Location')) AS Advance,
// (SELECT IFNULL(ROUND(SUM(amount),0),0) FROM salepaymentdetails WHERE transactiontype IN('RefundToCustomer','SupplierOrder')  and date BETWEEN '$ActualFromDate' AND '$ActualToDate'  and clientid like ('$Location')) AS Expenses,
// ( SELECT  IFNULL(ROUND(SUM(topay)-SUM(receipt),0),0) FROM paitentmaster ) AS Outstanding,
// (SELECT  IFNULL(ROUND(SUM(amount),0),0) FROM salepaymentdetails WHERE transactiontype IN('PaitentOrder','CashAdvance','Sales') and clientid like ('$Location') and date BETWEEN '$ActualFromDate' AND '$ActualToDate' and clientid like ('$Location') ) AS TotalIncome,
// (SELECT  IFNULL(ROUND(SUM(amount),0),0) FROM salepaymentdetails WHERE transactiontype IN('RefundToCustomer','SupplierOrder') and date BETWEEN '$ActualFromDate' AND '$ActualToDate'  and clientid like ('$Location')) AS TotalExpenses";

  
}
else
{
	 echo " NO";
}
