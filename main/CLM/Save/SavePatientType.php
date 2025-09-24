<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PatientType"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $PatientType = mysqli_real_escape_string($connection, $_POST["PatientType"]);    
 $FeesAmount = mysqli_real_escape_string($connection, $_POST["FeesAmount"]);    
     
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddTimeLog = "insert into patienttypemaster (clientid,patienttype,fees,addedon,addedby) values
    ('$ClientID','$PatientType','$FeesAmount','$currentdate','$userid')"; 
 
 mysqli_query($connection, $AddTimeLog); 
  
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