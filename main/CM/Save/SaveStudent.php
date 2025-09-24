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
 $Gender = mysqli_real_escape_string($connection, $_POST["Gender"]);    
 $MaritalStatus = mysqli_real_escape_string($connection, $_POST["MaritalStatus"]);   
 $Occupation = mysqli_real_escape_string($connection, $_POST["Occupation"]);   
 $GaurdianName = mysqli_real_escape_string($connection, $_POST["GaurdianName"]);   
 $MobileNo = mysqli_real_escape_string($connection, $_POST["MobileNo"]);   
 $AlternateMobileNo = mysqli_real_escape_string($connection, $_POST["AlternateMobileNo"]);   
 $EmailID = mysqli_real_escape_string($connection, $_POST["EmailID"]);   
 $TempAddress = mysqli_real_escape_string($connection, $_POST["TempAddress"]);   
 $Address = mysqli_real_escape_string($connection, $_POST["Address"]);   
 $Referedby = mysqli_real_escape_string($connection, $_POST["Referedby"]);   
 $Qualification = mysqli_real_escape_string($connection, $_POST["Qualification"]);   
 $DOB = mysqli_real_escape_string($connection, $_POST["DOB"]);   
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddBatch = "insert into studentmaster (studentclientid,studentname,studentmobileno,studentalternatecontactno,studentemailid,studentdob,studentgender,studentmaritalstatus,studenttempaddress,studentaddress,studentoccupation,studentgaurdianname,studentreferedby,studentqualification,studentaddedby,studentaddedon,studentstatus) values ('$ClientID','$Name','$MobileNo','$AlternateMobileNo','$EmailID','$DOB','$Gender','$MaritalStatus',
	'$TempAddress','$Address','$Occupation','$GaurdianName','$Referedby','$Qualification','$userid','$currentdate','Active')"; 
 
 mysqli_query($connection, $AddBatch); 
  
 // echo $AddBatch;
 echo "New Student Added Successfuly";
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding new student";
}

?>