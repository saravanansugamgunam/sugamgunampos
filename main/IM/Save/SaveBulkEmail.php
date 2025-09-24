<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Message"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 							  
 $Message = mysqli_real_escape_string($connection, $_POST["Message"]);    
 $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]);    
 $Subject = mysqli_real_escape_string($connection, $_POST["Subject"]);    
 
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "insert into bulkemail (uniqueid,message,subject) values ('$UniqueID','$Message','$Subject')"; 
 
 mysqli_query($connection, $AddPaymentMode); 
echo 1;

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>