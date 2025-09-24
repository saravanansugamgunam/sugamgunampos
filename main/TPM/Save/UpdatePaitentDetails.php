<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PaitentCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);  
 $DOB = mysqli_real_escape_string($connection, $_POST["DOB"]);  
 $Email = mysqli_real_escape_string($connection, strtoupper($_POST["Email"]));  
 $Gender = mysqli_real_escape_string($connection, $_POST["Gender"]);  
  
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "update paitentmaster set dob='$DOB', email='$Email',
gender='$Gender' where paitentid='$PaitentCode'"; 
 
 mysqli_query($connection, $AddPaymentMode); 
echo "Added Successfuly";
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