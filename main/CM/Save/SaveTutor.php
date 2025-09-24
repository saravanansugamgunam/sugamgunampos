<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["MobileNo"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	 
 $Name = mysqli_real_escape_string($connection, $_POST["Name"]);    
 $DOB = mysqli_real_escape_string($connection, $_POST["DOB"]);   
 $Gender = mysqli_real_escape_string($connection, $_POST["Gender"]);   
 $MaritalStatus = mysqli_real_escape_string($connection, $_POST["MaritalStatus"]);   
 $MobileNo = mysqli_real_escape_string($connection, $_POST["MobileNo"]);   
 $AlternateContactNo = mysqli_real_escape_string($connection, $_POST["AlternateContactNo"]);   
 $Address = mysqli_real_escape_string($connection, $_POST["Address"]);    
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddTimeLog = "insert into tutormaster (tutorclientid,tutorname,tutorDOB,tutorgender,tutormaritalstatus,tutormobileno,tutoralternateno,tutoraddress,tutoraddedon,tutoraddedby,tutorstatus) values ('$ClientID','$Name','$DOB','$Gender','$MaritalStatus','$MobileNo','$AlternateContactNo','$Address','$currentdate','$userid','Active')"; 
 
 mysqli_query($connection, $AddTimeLog); 
  
 echo "New Tutor Added Successfuly";
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding new Tutor";
}

?>