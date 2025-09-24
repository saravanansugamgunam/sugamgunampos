<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Ledger"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $CategoryID = mysqli_real_escape_string($connection, $_POST["CategoryID"]);    
 $Ledger = mysqli_real_escape_string($connection, $_POST["Ledger"]);    
 $LedgerType = mysqli_real_escape_string($connection, $_POST["LedgerType"]);    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "insert into accountingledger (categoryid,ledgername,ledgertype,createdby) values ('$CategoryID','$Ledger','$LedgerType','$userid')"; 
 
 mysqli_query($connection, $AddPaymentMode); 
echo "Added Successfuly";
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