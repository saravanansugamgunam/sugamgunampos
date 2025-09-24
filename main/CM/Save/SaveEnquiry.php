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
 $EnquiryType = mysqli_real_escape_string($connection, strtoupper($_POST["EnquiryType"]));    
 $RefferedBy = mysqli_real_escape_string($connection, strtoupper($_POST["RefferedBy"]));    
 $EnquiredBy = mysqli_real_escape_string($connection, strtoupper($_POST["EnquiredBy"]));    
 $Address = mysqli_real_escape_string($connection, strtoupper($_POST["Address"]));    
 $Remarks = mysqli_real_escape_string($connection, strtoupper($_POST["Remarks"]));  
 $Device = mysqli_real_escape_string($connection, $_POST["Device"]);  
 $WhatsappNo = mysqli_real_escape_string($connection, $_POST["WhatsappNo"]);  
     
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "insert into enquirydetails (name ,mobileno,emailid,enquirytypeid,referenceid,enquiredbyid,
	address,remarks,addedby,device,whatsappno) values ('$Name','$MobileNo','$Email','$EnquiryType','$RefferedBy','$EnquiredBy','$Address','$Remarks','1','$Device','$WhatsappNo')"; 
 
 mysqli_query($connection, $AddPaymentMode); 
echo 1;
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