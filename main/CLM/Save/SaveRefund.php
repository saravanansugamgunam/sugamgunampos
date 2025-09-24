 <?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["InvoiceNo"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $SaleDate =date("Y-m-d");  
  $currentdate =date("Y-m-d H:i:s");  
   
	   
  $Invoice = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);   
  $RefundInvoiceNo = mysqli_real_escape_string($connection, $_POST["RefundInvoiceNo"]);   
  $PatientCode = mysqli_real_escape_string($connection, $_POST["PatientCode"]);   
  $PaymentDate = mysqli_real_escape_string($connection, $_POST["PaymentDate"]);   
  
  $ReceivedAmount = mysqli_real_escape_string($connection, $_POST["ReceivedAmount"]); 
  $RefundAmount = mysqli_real_escape_string($connection, $_POST["RefundAmount"]); 
  $DiscountAmount = mysqli_real_escape_string($connection, $_POST["DiscountAmount"]); 
  $GrossAmount = mysqli_real_escape_string($connection, $_POST["GrossAmount"]); 
  $OldBalance = mysqli_real_escape_string($connection, $_POST["OldBalance"]); 
  $NewBalance = mysqli_real_escape_string($connection, $_POST["NewBalance"]); 
  $TotalAmount = mysqli_real_escape_string($connection, $_POST["TotalAmount"]); 
 
 $LocationCode = $_SESSION['SESS_LOCATION'];
 $InvoicePrefix  = 	substr($LocationCode,0,2);  
 $InvoicePrefix  = 	"L".$InvoicePrefix;  
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
	  
	if($ReceivedAmount>0)
	{
      $AddBatch = " UPDATE consultingbillmaster SET receivedamount = receivedamount - refundamount,
	discountamount=discountamount+refundamount,oldbalance=oldbalance,newbalance=newbalance 
	WHERE consultationuniquebill ='$RefundInvoiceNo';"; 
	
	 $AddBatch .= " UPDATE consultingdetails SET discount = discount + $RefundAmount,
	consultationtotal=consultationtotal-$RefundAmount  
	WHERE consultationuniquebill ='$RefundInvoiceNo';"; 
	
	 $AddBatch .= " UPDATE salepaymentdetails SET  amount=amount-$RefundAmount  
	WHERE invoiceno ='$RefundInvoiceNo'; "; 
	
	
	 $AddBatch .= " insert into refundregister(invoiceno,date,billamount,receivedamount,refundamount,
	 updatedby,refundstatus) values ('$RefundInvoiceNo','$currentdate','$TotalAmount',
	 '$ReceivedAmount','$RefundAmount','$userid','Completed'); ";
	
	
   mysqli_multi_query($connection, $AddBatch);
	}
	else if($ReceivedAmount==0)
	{
		  $AddBatch = " UPDATE consultingbillmaster SET 
	discountamount=discountamount+refundamount,oldbalance=oldbalance,newbalance=newbalance -$RefundAmount 
	WHERE consultationuniquebill ='$RefundInvoiceNo';"; 
	
	 $AddBatch .= " UPDATE consultingdetails SET discount = discount + $RefundAmount,
	consultationtotal=consultationtotal-$RefundAmount  
	WHERE consultationuniquebill ='$RefundInvoiceNo';"; 
	
	$AddBatch .= " UPDATE paitentmaster SET topay=topay-$RefundAmount where paitentid ='$PatientCode' ;";
	
	 $AddBatch .= " insert into refundregister(invoiceno,date,billamount,receivedamount,refundamount,
	 updatedby,refundstatus) values ('$RefundInvoiceNo','$currentdate','$TotalAmount',
	 '$ReceivedAmount','$RefundAmount','$userid','Adjusted'); ";
	
   mysqli_multi_query($connection, $AddBatch);
	}
	
   
  // $AddPaymentMode = "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,transactiontype,clientid) values 
	// ('$PaitentCode','$PaymentMode','$RefundAmount','$Invoice','$PaymentDate','RefundToCustomer','$LocationCode');"; 
	
	
	
  // $AddPaymentMode .= "update paitentmaster set
  // receipt=receipt-$RefundAmount where paitentid = $PaitentCode;"; 
 
 // echo $AddPaymentMode;
 
 // mysqli_multi_query($connection, $AddPaymentMode);
 
 
 
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>