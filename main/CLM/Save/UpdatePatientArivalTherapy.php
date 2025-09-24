<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["TokenID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $TokenID = mysqli_real_escape_string($connection, strtoupper($_POST["TokenID"]));    
 $ArivalStatus = mysqli_real_escape_string($connection, strtoupper($_POST["ArivalStatus"]));    
 
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "update therapybookingdetails set patientarivalstatus='$ArivalStatus', 
    patientarivaltime ='$currentdate' where bookingid='$TokenID' "; 
 
 mysqli_query($connection, $AddPaymentMode); 
echo "1";

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>