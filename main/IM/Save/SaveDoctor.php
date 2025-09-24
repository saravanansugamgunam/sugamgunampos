<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Doctor"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $Doctor = mysqli_real_escape_string($connection, strtoupper($_POST["Doctor"]));    
 $mobileno = mysqli_real_escape_string($connection, strtoupper($_POST["mobileno"]));    
 $DoctorEmail = mysqli_real_escape_string($connection, strtoupper($_POST["DoctorEmail"]));    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "insert into usermaster(username,doctorphone,doctoremail)
	values ('$Doctor','$mobileno','$DoctorEmail')"; 
 
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