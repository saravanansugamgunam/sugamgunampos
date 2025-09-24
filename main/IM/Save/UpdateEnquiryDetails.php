<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["EnquiryID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	
 
  
 $EnquiryID = mysqli_real_escape_string($connection, strtoupper($_POST["EnquiryID"]));  
 $EnquiryUpdateMobile = mysqli_real_escape_string($connection, strtoupper($_POST["EnquiryUpdateMobile"]));    
 $EnquiryUpdateEmail = mysqli_real_escape_string($connection, strtoupper($_POST["EnquiryUpdateEmail"]));    
 $EnquiryUpdateAddress = mysqli_real_escape_string($connection, $_POST["EnquiryUpdateAddress"]);   
 $EnquiryUpdateRemarks = mysqli_real_escape_string($connection, $_POST["EnquiryUpdateRemarks"]);   
 $EnquiryStatus = mysqli_real_escape_string($connection, $_POST["EnquiryStatus"]);   

 $EnquiryUpdatedName = mysqli_real_escape_string($connection, $_POST["EnquiryUpdatedName"]); 
 
  $EnquiryUpdateEnquiryFor = mysqli_real_escape_string($connection, $_POST["EnquiryUpdateEnquiryFor"]);   
 $EnquiryUpdateReference = mysqli_real_escape_string($connection, $_POST["EnquiryUpdateReference"]);  
 
 if($EnquiryUpdateEnquiryFor==0)
 {
	 $EnquiryUpdateEnquiryFor="";
 }
 else
 {
	 $EnquiryUpdateEnquiryFor =" , enquiredbyid='$EnquiryUpdateEnquiryFor'";
 }
 
  if($EnquiryUpdateReference==0)
 {
	 $EnquiryUpdateReference="";
 }
 else
	 {
	 $EnquiryUpdateReference=" , enquirytypeid='$EnquiryUpdateReference' ";
 }
 
 
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
	  $AddPaymentMode = "update enquirydetails set name='$EnquiryUpdatedName', mobileno='$EnquiryUpdateMobile', emailid='$EnquiryUpdateEmail', address='$EnquiryUpdateAddress',enquirystatus='$EnquiryStatus', remarks='$EnquiryUpdateRemarks' $EnquiryUpdateReference $EnquiryUpdateEnquiryFor  where id='$EnquiryID'"; 
	   
 
 mysqli_query($connection, $AddPaymentMode); 
echo "Updated Successfuly";
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