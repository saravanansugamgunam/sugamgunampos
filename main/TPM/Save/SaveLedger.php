<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Ledger"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $CategoryID = mysqli_real_escape_string($connection, strtoupper($_POST["CategoryID"]));    
 $Ledger = mysqli_real_escape_string($connection, strtoupper($_POST["Ledger"]));    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "insert into accountingledger (categoryid,ledgername,createdby) values ('$CategoryID','$Ledger','$userid')"; 
 
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