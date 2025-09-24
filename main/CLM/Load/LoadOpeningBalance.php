<?php
   include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["DayCloseDate"]))
{	
  
 // echo "1"; 
 $DayCloseDate = mysqli_real_escape_string($connection, $_POST["DayCloseDate"]); 
 $Location = mysqli_real_escape_string($connection, $_POST["Location"]); 
   $LocationCode = $_SESSION['SESS_LOCATION'];
   						  
 // $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 // $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 

// if($FromDate=="")
// {
	// $ActualFromDate= date('Y-m-d 00:00:00');
	// $ActualToDate= date('Y-m-d 23:59:59');
	
// }
// else
// {
// $FromDate = explode('/', $FromDate); 
// $ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0].' 00:00:00';
// $ToDate = explode('/', $ToDate); 
// $ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0].' 23:59:59' ;
 
// }



  

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
(SELECT closingbalance FROM dayclosedetails WHERE transactiontype='Clinic' and closingdate =(SELECT MAX(closingdate) FROM dayclosedetails where  transactiontype='Clinic' and clientid ='$Location' ) and clientid ='$Location') AS Opening,



(SELECT IFNULL(ROUND(SUM(amount),0),0) AS Amount FROM salepaymentdetails WHERE transactiontype  IN('DoctorFee')
 AND transactionstatus ='Live' AND paymentmode ='12' AND DATE > (SELECT CONCAT(MAX(closingdate), ' 23:59:59') FROM dayclosedetails where  transactiontype='Clinic' and clientid ='$Location')  AND DATE <= '$DayCloseDate'  and clientid ='$Location' ) AS AmountwithoutRefund,
 
 
  (SELECT IFNULL(MAX(closingdate),1) FROM dayclosedetails  WHERE  transactiontype='Clinic' and closingdate ='$DayCloseDate' and clientid ='$Location') AS Closestatus
 
");
  
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    {  
      $data[] = $row['Opening'];
	  $AvailablaeBalance = $row['AmountwithoutRefund'] - 0;
      $data[] = $AvailablaeBalance; 
	    $data[] = $row['Closestatus'];
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}
else
{
	 echo " NO";
}

?>