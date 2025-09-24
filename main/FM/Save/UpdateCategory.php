<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["CategoryID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $CategoryID = mysqli_real_escape_string($connection, $_POST["CategoryID"]);    
 $CategoryName = mysqli_real_escape_string($connection, $_POST["UpdatedCategoryName"]);    
 $CategoryStatus = mysqli_real_escape_string($connection, $_POST["CategoryStatus"]);    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "update accoutingcategory set categoryname='$CategoryName', categorystatus='$CategoryStatus' where categoryid='$CategoryID'"; 
 
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