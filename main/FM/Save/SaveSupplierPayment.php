<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["SupplierCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]);    
 $Group = mysqli_real_escape_string($connection, $_POST["Group"]);    
 $EntryDate = mysqli_real_escape_string($connection, $_POST["EntryDate"]);       
 $Amount = mysqli_real_escape_string($connection, $_POST["Amount"]);    
 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);    
 $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);    
 $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);    
  
      $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
	  
		   $AddPaymentMode = "insert into accountingtransaction (ledgerid,date,transactiongroup,transactiontype,expenseamount,transactionamount,remarks,createdby,
		   clientid,paymentmode,invoiceno) values ('$SupplierCode','$EntryDate','$Group','Supplier Payment','$Amount','$Amount','$Remarks','$userid',
		   '$LocationCode','$PaymentMode','$InvoiceNo');";
		   
		   		   
  $AddPaymentMode .= "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,transactiontype,transactiongroup,clientid) values 
	('$SupplierCode','$PaymentMode','$Amount','$InvoiceNo','$EntryDate','Supplier Payment','$Group','$LocationCode');"; 
	 
  $AddPaymentMode .= "update supliers set paid = paid + '$Amount' where suplier_id='$SupplierCode';"; 
	 
	 
	  
    // echo $AddPaymentMode;
     
 mysqli_multi_query($connection, $AddPaymentMode); 
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