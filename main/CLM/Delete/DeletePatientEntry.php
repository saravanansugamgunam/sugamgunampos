<?php
   include("../../../connect.php"); 
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PatientEntryID"]))
{
   
 // echo "1";

  $currentdate =date("Y-m-d H:i:s"); 							  
 $PatientEntryID = mysqli_real_escape_string($connection, strtoupper($_POST["PatientEntryID"]));    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "delete from patiententrydetails where entryid='$PatientEntryID'"; 
 
 mysqli_query($connection, $AddPaymentMode); 
echo "Entry Removed Successfuly";

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>