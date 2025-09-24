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
 $CourierName = mysqli_real_escape_string($connection, strtoupper($_POST["UpdatedCourierName"]));    
 $CourierStatus = mysqli_real_escape_string($connection, ($_POST["CourierStatus"]));    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "update couriermaster set courier='$CourierName', courierstatus='$CourierStatus' where courierid='$CourierID'"; 
 
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