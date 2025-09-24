<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PaymentMode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "insert into paymentmodemaster (clientid,paymentmode,addedby,addedon,activestatus) values ('$ClientID','$PaymentMode','$userid','$currentdate','Active')"; 
 
 mysqli_query($connection, $AddPaymentMode); 
echo "New Payment mode added Successfuly";

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding payment mode";
}

?>