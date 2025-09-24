<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["MobileNo"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 		
   
	   
 $Name = mysqli_real_escape_string($connection, strtoupper($_POST["Name"]));    
 $MobileNo = mysqli_real_escape_string($connection, strtoupper($_POST["MobileNo"]));    
 $Email = mysqli_real_escape_string($connection, strtoupper($_POST["Email"]));    
 $MaritalStatus = mysqli_real_escape_string($connection, strtoupper($_POST["MaritalStatus"]));    
 $Occupation = mysqli_real_escape_string($connection, strtoupper($_POST["Occupation"]));    
 $EnquiryCourse = mysqli_real_escape_string($connection, strtoupper($_POST["EnquiryCourse"]));    
 $Address = mysqli_real_escape_string($connection, strtoupper($_POST["Address"]));    
 $Remarks = mysqli_real_escape_string($connection, strtoupper($_POST["Remarks"]));   
 $WhatsappNo = mysqli_real_escape_string($connection, $_POST["WhatsappNo"]);  
 $DOB = mysqli_real_escape_string($connection, $_POST["DOB"]);  
 $Qualification = mysqli_real_escape_string($connection, $_POST["Qualification"]);  
 $Gender = mysqli_real_escape_string($connection, $_POST["Gender"]);  
 $ImagePath = mysqli_real_escape_string($connection, $_POST["ImagePath"]);  
 $AadharPath = mysqli_real_escape_string($connection, $_POST["AadharPath"]);  
 $OtherDocPath = mysqli_real_escape_string($connection, $_POST["OtherDocPath"]);  
    $FinalImagePath = "CM/StudentImages/". $ImagePath;
	   $FinalAadharPath = "CM/StudentImages/". $AadharPath;
	   $FinalOtherDocPath = "CM/StudentImages/". $OtherDocPath;
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "insert into studentmasterenquiry (studentname ,studentmobileno,studentalternatecontactno,
	studentemailid,	studentdob,studentgender,	studentmaritalstatus,studenttempaddress,studentaddress,
	studentoccupation,studentqualification,enquirycourse,enquiryremarks,studentimagepath,aadharpath,otherdocpath) values 
	('$Name','$MobileNo','$WhatsappNo','$Email','$DOB','$Gender','$MaritalStatus','$Address','$Address',
	'$Occupation','$Qualification','$EnquiryCourse','$Remarks','$FinalImagePath','$FinalAadharPath','$FinalOtherDocPath')"; 
 
mysqli_query($connection, $AddPaymentMode); 
 echo "1";
// echo $AddPaymentMode;

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>