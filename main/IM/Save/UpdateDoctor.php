<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["DoctorID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $DoctorID = mysqli_real_escape_string($connection, strtoupper($_POST["DoctorID"]));    
 $DoctorName = mysqli_real_escape_string($connection, strtoupper($_POST["UpdatedDoctorName"]));    
 $DoctorStatus = mysqli_real_escape_string($connection, ($_POST["DoctorStatus"]));    
 $UpdatedMobileNo = mysqli_real_escape_string($connection, ($_POST["UpdatedMobileNo"]));    
 $UpdateEmail = mysqli_real_escape_string($connection, ($_POST["UpdateEmail"]));    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "update usermasterset username='$DoctorName', activestatus='$DoctorStatus',
doctoremail='$UpdateEmail',
doctorphone='$UpdatedMobileNo'	where userid='$DoctorID'"; 
 
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