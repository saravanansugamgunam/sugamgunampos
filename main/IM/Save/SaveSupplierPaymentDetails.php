
<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Invoice"]))
{ 
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 							  
 $Invoice = mysqli_real_escape_string($connection, strtoupper($_POST["Invoice"]));    
 $SupplierCode = mysqli_real_escape_string($connection, strtoupper($_POST["SupplierCode"]));    
 $PaymentMode = mysqli_real_escape_string($connection, strtoupper($_POST["PaymentMode"]));    
 $PaymentAmount = mysqli_real_escape_string($connection, strtoupper($_POST["PaymentAmount"]));    
  
     $LocationCode = $_SESSION['SESS_LOCATION'];   
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,clientid) values 
	('$SupplierCode','$PaymentMode','$PaymentAmount','$Invoice','$currentdate','$LocationCode')"; 
 
 mysqli_query($connection, $AddPaymentMode); 
echo "Added Successfuly";

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	// echo "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date) values 
	// ('$PaitentCode','$PaymentMode','$PaymentAmount','$Invoice','$currentdate')";
}

?>