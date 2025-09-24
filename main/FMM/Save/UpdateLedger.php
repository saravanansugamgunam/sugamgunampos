<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["LedgerID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $LedgerID = mysqli_real_escape_string($connection, strtoupper($_POST["LedgerID"]));    
 $LedgerName = mysqli_real_escape_string($connection, strtoupper($_POST["UpdatedLedgerName"]));    
 $LedgerStatus = mysqli_real_escape_string($connection, ($_POST["LedgerStatus"]));    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "update accountingledger set ledgername='$LedgerName', ledgerstatus='$LedgerStatus' where ledgerid='$LedgerID'"; 
 
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