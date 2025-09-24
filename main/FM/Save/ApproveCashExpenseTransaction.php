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
  
 $currentdate =date("Y-m-d"); 			
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  
  $userid = $_SESSION['SESS_MEMBER_ID'];	
  $AddPaymentMode='';	
    
  try {
    $AddPaymentMode.= "update  accountingtransaction set approvalstatus='1',
     approvedon='$currentdate',approvedby='$userid'  where invoiceno ='$TransactionID';";  


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