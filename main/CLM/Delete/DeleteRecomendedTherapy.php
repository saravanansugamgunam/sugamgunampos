<?php
  
session_cache_limiter(FALSE);
session_start();
   $LocationCode = $_SESSION['SESS_LOCATION'];
//insert.php
if(isset($_POST["BookingID"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $BookingID = mysqli_real_escape_string($connection, strtoupper($_POST["BookingID"]));   
 $BookingUniqueID = mysqli_real_escape_string($connection, strtoupper($_POST["BookingUniqueID"]));   
  
 
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
  $AddPaymentMode ='';
  try {
    $AddPaymentMode.= "delete from therapybookingdetails where bookingid='$BookingID';"; 
    $AddPaymentMode.= "delete from timeslotallocation where uniqueid='$BookingUniqueID' and bookingitemid='$BookingID';"; 
  
    if (mysqli_multi_query($connection, $AddPaymentMode)) {
			
      // echo $SaveSaleMaster;
       echo "1";
           } else {
              echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
           } 
  

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>