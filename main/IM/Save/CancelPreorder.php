<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["OrderIDforCancel"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 							  
 $OrderIDforCancel = mysqli_real_escape_string($connection, strtoupper($_POST["OrderIDforCancel"]));    
 $Remarks = mysqli_real_escape_string($connection, strtoupper($_POST["Remarks"]));     
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "update preordermaster set orderstatus='Cancelled', 
    cancelremarks='$Remarks',canceldate=' $currentdate' where orderid='$OrderIDforCancel'"; 
 
 mysqli_query($connection, $AddPaymentMode); 
echo "1";
//echo $AddPaymentMode;

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>