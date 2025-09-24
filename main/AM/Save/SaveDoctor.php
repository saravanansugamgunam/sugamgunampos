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
 
 $MaritalStatus = mysqli_real_escape_string($connection, $_POST["MaritalStatus"]);    
 $PreviousOrg = mysqli_real_escape_string($connection, $_POST["PreviousOrg"]);    
 $Qualification = mysqli_real_escape_string($connection, $_POST["Qualification"]);    
 $AlternateNo = mysqli_real_escape_string($connection, $_POST["AlternateNo"]);    
 $Sex = mysqli_real_escape_string($connection, $_POST["Sex"]);    
 $DOB = mysqli_real_escape_string($connection, $_POST["DOB"]);    
 $ReferenceNo = mysqli_real_escape_string($connection, $_POST["ReferenceNo"]);    
 $Address = mysqli_real_escape_string($connection, $_POST["Address"]);    
 $DOJ = mysqli_real_escape_string($connection, $_POST["DOJ"]);    
 $Salary = mysqli_real_escape_string($connection, $_POST["Salary"]);    
 $Biometricid = mysqli_real_escape_string($connection, $_POST["Biometricid"]);    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "insert into usermaster(username,doctorphone,doctoremail,maritalstatus,previousorg,
	qualification,alternateno,gender,dob,referedby,address,doj,salary,biometricid)
	values ('$Doctor','$mobileno','$DoctorEmail','$MaritalStatus','$PreviousOrg','$Qualification','$AlternateNo'
	,'$Sex','$DOB','$ReferenceNo','$Address','$DOJ','$Salary','$Biometricid')"; 
 
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