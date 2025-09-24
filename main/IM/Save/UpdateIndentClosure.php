<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["UniqueID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 
  $userid = $_SESSION['SESS_MEMBER_ID']; 					  
 $UniqueID = mysqli_real_escape_string($connection, strtoupper($_POST["UniqueID"]));     
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
 
   
  try {
    $AddPaymentMode = "update salemaster_stockindent set 
    closuredate='$currentdate', closurestatus='Closed', closedby='$userid' 
    where saleuniqueno='$UniqueID'"; 
 
    if (mysqli_multi_query($connection, $AddPaymentMode)) {

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