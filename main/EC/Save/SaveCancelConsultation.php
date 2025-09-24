
<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["InvoiceNo"]))
{ 
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 							  
 $RefundStatus = mysqli_real_escape_string($connection, $_POST["RefundStatus"]);        
 $Remarks = mysqli_real_escape_string($connection, strtoupper($_POST["Remarks"]));    
 $RefundAmount = mysqli_real_escape_string($connection, strtoupper($_POST["RefundAmount"])); 
 $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]); 
 $TokenNo = mysqli_real_escape_string($connection, $_POST["TokenNo"]); 
 $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);  
  
   $LocationCode = $_SESSION['SESS_LOCATION'];
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "update consultingbillmaster set tokenstatus='Cancelled', 
	 closureremarks='$Remarks'  where consultationuniquebill ='$InvoiceNo' and tokennumber='$TokenNo'; ";
	 
	$AddPaymentMode.= "update tokenmaster set tokenstatus='Cancelled' where invoicenumber ='$InvoiceNo' and tokennumber='$TokenNo' "; 
 
 mysqli_multi_query($connection, $AddPaymentMode); 
echo "1";
// echo $AddPaymentMode;

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