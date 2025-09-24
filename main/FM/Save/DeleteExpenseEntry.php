<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["TransactionID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $Fromdate =date("Y-m-d 00:20:00"); 		 
  $Todate =date("Y-m-d 23:50:00"); 		 
 $TransactionID = mysqli_real_escape_string($connection, $_POST["TransactionID"]);   
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;
  $AddPaymentMode='';	
   
  try {
    $AddPaymentMode.= "delete from accountingtransaction where invoiceno ='$TransactionID' and createdate between '$Fromdate' and '$Todate';"; 
    $AddPaymentMode.= "delete from salepaymentdetailsc where invoiceno ='$TransactionID' and addedon  between '$Fromdate' and '$Todate';"; 
 
    if (mysqli_multi_query($connection, $AddPaymentMode)) {

      // echo "Service Requese has been registered, Request ID is " . $last_id;
      echo "1";
      //  echo $SaveSaleMaster;
     } else {
      echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
     }


//  mysqli_query($connection, $AddPaymentMode); 
// echo "1";
// echo $AddPaymentMode;

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>