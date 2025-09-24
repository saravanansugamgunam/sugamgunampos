<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PaitentID"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							       
 $PatientEmail = mysqli_real_escape_string($connection, strtoupper($_POST["PatientEmail"]));    
 $Name = mysqli_real_escape_string($connection, strtoupper($_POST["Patient"]));  
 $Sex = mysqli_real_escape_string($connection, $_POST["Sex"]);    
 $DOB = mysqli_real_escape_string($connection, strtoupper($_POST["DOB"]));    
 $Address = mysqli_real_escape_string($connection, strtoupper($_POST["Address"]));    
 $PaitentID = mysqli_real_escape_string($connection, strtoupper($_POST["PaitentID"]));    
 $RelationShip = mysqli_real_escape_string($connection, strtoupper($_POST["RelationShip"]));    
 $MobileNo = mysqli_real_escape_string($connection, strtoupper($_POST["MobileNo"]));    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "insert into paitentmaster (paitentname ,mobileno,email,whatsappno,alternateno,referenceno,
    address,dob,gender,parentid,relationship) values ('$Name', '$MobileNo' ,'$PatientEmail','$MobileNo','$MobileNo',
    'Family','-','$DOB','$Sex','$PaitentID','$RelationShip')"; 
 
 mysqli_query($connection, $AddPaymentMode); 
// echo  $AddPaymentMode;
echo "1";

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>