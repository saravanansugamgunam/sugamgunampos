<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["CourierID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	             
 $CourierID = mysqli_real_escape_string($connection, strtoupper($_POST["CourierID"]));    
 $BasicCharge = mysqli_real_escape_string($connection, strtoupper($_POST["BasicCharge"]));    
 $AdditionalCharge = mysqli_real_escape_string($connection, ($_POST["AdditionalCharge"]));    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "update statemaster set basiccharge='$BasicCharge',
     additionalcharge='$AdditionalCharge' where stateid='$CourierID'"; 
 
 mysqli_query($connection, $AddPaymentMode); 
echo "Added Successfuly";

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>