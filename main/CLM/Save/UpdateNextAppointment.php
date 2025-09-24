<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PaitentCode"]))
{
	 date_default_timezone_set("Asia/Kolkata");
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d");  
   $currenttime = date("His"); 
	   
 $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);     
 $NextAppointment = mysqli_real_escape_string($connection, $_POST["NextAppointment"]);     
 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);     
 $FreePaid = mysqli_real_escape_string($connection, $_POST["FreePaid"]);     
 
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
  
  try {
    $UpdateDoctor='';
   $UpdateDoctor.=" insert nextappointmentdetails (paitentid,nextappointmentdate,remarks,freestatus) values
    ('$PaitentCode','$NextAppointment','$Remarks', '$FreePaid') "; 
	 
    

   if(mysqli_multi_query($connection, $UpdateDoctor)){
    echo 1;
   } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
  
   }
 
   
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}
