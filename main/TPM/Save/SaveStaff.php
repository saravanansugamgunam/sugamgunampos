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
 $DOJ = mysqli_real_escape_string($connection, $_POST["DOJ"]);    
 $Salary = mysqli_real_escape_string($connection, $_POST["Salary"]);    
 $BiometricID = mysqli_real_escape_string($connection, $_POST["BiometricID"]);    
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddTimeLog = "insert into usermaster (clientid,username,dob,doj,gender,maritalstatus,mobileno,altcontact,address1,salary,addedby,activestatus,category,biometricid) values
    ('$ClientID','$Name','$DOB','$DOJ','$Gender','$MaritalStatus','$MobileNo','$AlternateContactNo','$Address','$Salary','$userid','Active','Staff','$BiometricID')"; 
 
 mysqli_query($connection, $AddTimeLog); 
  
 echo  $AddTimeLog ;
 // echo "Added Successfuly";
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>