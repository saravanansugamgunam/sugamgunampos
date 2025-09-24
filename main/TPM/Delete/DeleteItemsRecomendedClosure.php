<?php
  
session_cache_limiter(FALSE);
session_start();
   $LocationCode = $_SESSION['SESS_LOCATION'];
//insert.php
if(isset($_POST["ItemID"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $ItemID = mysqli_real_escape_string($connection, strtoupper($_POST["ItemID"]));    
 $Invoice = mysqli_real_escape_string($connection, strtoupper($_POST["Invoice"]));    
 $TherapyID = mysqli_real_escape_string($connection, strtoupper($_POST["TherapyID"]));    
 
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "update therapybookingdetails set bookingstatus='R-Closed' where bookingid='$ItemID' and bookinguniqueid='$Invoice';  "; 
    $AddPaymentMode.= "delete from timeslotallocation_temp where bookingitemid='$ItemID' and uniqueid='$Invoice';  ";
    $AddPaymentMode.= "delete from timeslotallocation where bookingitemid='$ItemID' and uniqueid='$Invoice';  ";
    $AddPaymentMode.= "update therapybookingdetails set sitingid=sitingid-1,totalsitings=totalsitings-1
     where therapyid='$TherapyID' and bookinguniqueid='$Invoice' and sitingid > 1 ; "; 
  
    if(mysqli_multi_query($connection, $AddPaymentMode)){
       echo "Item Removed Successfully";
    //  echo $AddPaymentMode;
     } else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
    
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