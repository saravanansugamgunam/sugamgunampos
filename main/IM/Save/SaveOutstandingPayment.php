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
  $PaitentCode = mysqli_real_escape_string($connection, $_POST["PatientCode"]);   
  $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);   
  $PaymentDate = mysqli_real_escape_string($connection, $_POST["PaymentDate"]);   
  $TotalSaleQty = 0;  
  $TotalDiscountAmount = 0;  
  $TotalProfitAmount = 0;  
  $TotalSaleAmount = 0;     
  
  $OldBalance = mysqli_real_escape_string($connection, $_POST["OldBalance"]);  
  $ReceivedAmount = mysqli_real_escape_string($connection, $_POST["Payment"]);  
  $NewBalance = mysqli_real_escape_string($connection, $_POST["NewBalance"]);  

  
  $LocationCodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);

  $GroupID = $_SESSION['SESS_GROUP_ID'];
 
  if($GroupID==1)
  {
     $LocationCode =$LocationCodeAdmin;
  }
  else
  {
     $LocationCode = $_SESSION['SESS_LOCATION'];
  }
  
  
 $InvoicePrefix  = 	substr($LocationCode,0,2);  
 $InvoicePrefix  = 	"L".$InvoicePrefix;  
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddBatch = "insert into salemaster (saledate,invoiceno,saleuniqueno,paitientcode,saleqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,transactiontype) values 
	('$PaymentDate','$InvoicePrefix','$Invoice','$PaitentCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance','$ReceivedAmount','$NewBalance','Outstanding')"; 
  
 mysqli_query($connection, $AddBatch); 
 
  $AddPaymentMode = "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,transactiontype,clientid) values 
	('$PaitentCode','$PaymentMode','$ReceivedAmount','$Invoice','$PaymentDate','OutstandingCollection','$LocationCode');"; 
	
	
  $AddPaymentMode .= "update paitentmaster set
  receipt=receipt+$ReceivedAmount where paitentid = $PaitentCode;"; 
 
 echo $AddPaymentMode;
 
 mysqli_multi_query($connection, $AddPaymentMode);
 
 
 
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>