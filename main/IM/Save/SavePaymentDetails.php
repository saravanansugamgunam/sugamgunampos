
<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Invoice"]))
{ 
 // echo "1";
 include("../../../connect.php"); 
  // $currentdate =date("Y-m-d"); 							  
 $Invoice = mysqli_real_escape_string($connection, strtoupper($_POST["Invoice"]));    
 $PaitentCode = mysqli_real_escape_string($connection, strtoupper($_POST["PaitentCode"]));    
 $PaymentMode = mysqli_real_escape_string($connection, strtoupper($_POST["PaymentMode"]));    
 $PaymentAmount = mysqli_real_escape_string($connection, strtoupper($_POST["PaymentAmount"]));    
 $currentdate = mysqli_real_escape_string($connection, strtoupper($_POST["SaleDate"]));    
 $LocationCodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);    
 $GroupID = $_SESSION['SESS_GROUP_ID'];
 
//  if($GroupID==1)
//  {
//     $LocationCode =$LocationCodeAdmin;
//  }
//  else
//  {
    $LocationCode = $_SESSION['SESS_LOCATION'];
//  }
   
  try {
    $AddPaymentMode = "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,clientid) values 
	('$PaitentCode','$PaymentMode','$PaymentAmount','$Invoice','$currentdate','$LocationCode')"; 
 
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