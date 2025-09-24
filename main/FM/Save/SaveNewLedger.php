<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["ledgerName"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $CategoryID =  '19';    
 $Ledger = mysqli_real_escape_string($connection, $_POST["ledgerName"]);    
 $LedgerType = mysqli_real_escape_string($connection, $_POST["ledgertype"]);    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "insert into accountingledger (categoryid,ledgername,ledgertype,createdby,cashledger)
     values ('$CategoryID','$Ledger','$LedgerType','$userid','Cash')"; 
 
 mysqli_query($connection, $AddPaymentMode); 
echo "1";
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