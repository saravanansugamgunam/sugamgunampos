<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["EnquiryTypeID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $EnquiryTypeID = mysqli_real_escape_string($connection, strtoupper($_POST["EnquiryTypeID"]));    
 $UpdatedEnquiryTypeName = mysqli_real_escape_string($connection, strtoupper($_POST["UpdatedEnquiryTypeName"]));    
 $EnquiryStatus = mysqli_real_escape_string($connection, $_POST["EnquiryStatus"]);    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
	  $AddPaymentMode = "update enquirymaster set enquiry='$UpdatedEnquiryTypeName', enquirystatus='$EnquiryStatus' where enquiryid='$EnquiryTypeID'"; 
	   
 
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