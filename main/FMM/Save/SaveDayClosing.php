<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["DayCloseDate"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $DayCloseDate = mysqli_real_escape_string($connection, $_POST["DayCloseDate"]);    
 $OpeningBalance = mysqli_real_escape_string($connection, $_POST["OpeningBalance"]);    
 $AvailableCash = mysqli_real_escape_string($connection, $_POST["AvailableCash"]);    
 $HandoverCash = mysqli_real_escape_string($connection, $_POST["HandoverCash"]);    
 $ClosingBalance = mysqli_real_escape_string($connection, $_POST["ClosingBalance"]);    
 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);    
 $Location = mysqli_real_escape_string($connection, $_POST["Location"]);    
 
  
      $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
	 
		   $AddPaymentMode = "insert into dayclosedetails (closingdate,openingbalance,cashcollection,releasedamount,closingbalance,dayclosedby,clientid,transactiontype) values ('$DayCloseDate','$OpeningBalance','$AvailableCash','$HandoverCash','$ClosingBalance','$userid','$Location','Clinic');";
		   
		   		   
  $AddPaymentMode .= ""; 
	 
	  
	  
    // echo $AddPaymentMode;
 
 mysqli_multi_query($connection, $AddPaymentMode); 
echo "1";
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