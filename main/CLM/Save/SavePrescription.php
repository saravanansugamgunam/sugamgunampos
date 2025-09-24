<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PaitentID"]))
{
	 date_default_timezone_set("Asia/Kolkata");
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d");  
   $currenttime = date("His"); 
	   
 $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);    
 $Prescription = mysqli_real_escape_string($connection, $_POST["Prescription"]);   
 $DoctorID = mysqli_real_escape_string($connection, $_POST["DoctorID"]);   
  
     
 $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
  
  try {
    $SavePrescription = "insert into prescriptionmaster (paitentid,doctorid,prescription,documentlink ) values 
	('$PaitentID','$DoctorID','$Prescription','-');"; 
	 
 
 mysqli_query($connection, $SavePrescription); 
  
  echo 1;
 // echo  $SavePrescription;
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>