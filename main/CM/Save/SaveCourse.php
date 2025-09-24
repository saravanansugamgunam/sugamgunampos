<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["CourseName"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $CourseName = mysqli_real_escape_string($connection, $_POST["CourseName"]);    
 $CourseDuration = mysqli_real_escape_string($connection, $_POST["CourseDuration"]);   
 $CourseDurationType = mysqli_real_escape_string($connection, $_POST["CourseDurationType"]);   
 $CourseFee = mysqli_real_escape_string($connection, $_POST["CourseFee"]);   
 $CourseDescription = mysqli_real_escape_string($connection, $_POST["CourseDescription"]);   
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddTimeLog = "insert into coursemaster (clientid,coursename,courseduration,coursedurationtype,coursefee,coursedescription,addedby,addedon,activestatus) values ('$ClientID','$CourseName','$CourseDuration','$CourseDurationType','$CourseFee','$CourseDescription','$userid','$currentdate','Active')"; 
 
 mysqli_query($connection, $AddTimeLog); 
  
 echo "New Course Added Successfuly";
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding new course";
}

?>