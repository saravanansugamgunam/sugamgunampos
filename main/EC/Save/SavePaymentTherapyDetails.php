
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
 $PaymentMode = mysqli_real_escape_string($connection, strtoupper($_POST["PaymentMode"]));    
 $PaymentAmount = mysqli_real_escape_string($connection, strtoupper($_POST["PaymentAmount"])); 
 $BookingID = mysqli_real_escape_string($connection, $_POST["BookingID"]); 
  
   $LocationCode = $_SESSION['SESS_LOCATION'];
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,clientid,transactiontype,transactiongroup) values 
	((SELECT paitentid FROM therapybookingdetails WHERE bookingid='$BookingID'),'$PaymentMode','$PaymentAmount','$Invoice','$currentdate','$LocationCode','Therapy Payment','Clinic')"; 
 
 mysqli_query($connection, $AddPaymentMode); 
// echo "Added Successfuly";
echo $AddPaymentMode;

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