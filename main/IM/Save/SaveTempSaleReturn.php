<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["ReturnInvoiceNo"]))
{ 
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $ReturnInvoiceNo = mysqli_real_escape_string($connection, strtoupper($_POST["ReturnInvoiceNo"]));    
 $InvoiceNo = mysqli_real_escape_string($connection, strtoupper($_POST["InvoiceNo"]));    
 $Id = mysqli_real_escape_string($connection, strtoupper($_POST["Id"]));    
 $SCode = mysqli_real_escape_string($connection, strtoupper($_POST["SCode"]));    
 $Qty = mysqli_real_escape_string($connection, strtoupper($_POST["Qty"]));     
 $Value = mysqli_real_escape_string($connection, strtoupper($_POST["Value"]));    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "insert into tempsalereturnitems (returninvoice,invoiceno ,itemid,scode,qty,value)
	values ('$ReturnInvoiceNo','$InvoiceNo','$Id','$SCode','$Qty','$Value')"; 
 
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