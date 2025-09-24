<?php
  
session_cache_limiter(FALSE);
session_start();
   $LocationCode = $_SESSION['SESS_LOCATION'];
//insert.php
if(isset($_POST["SlotID"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $SlotID = mysqli_real_escape_string($connection, strtoupper($_POST["SlotID"]));    
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "delete from timeslotdetails where id='$SlotID'   "; 
  
 mysqli_query($connection, $AddPaymentMode); 
echo "Charges removed Successfully";
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