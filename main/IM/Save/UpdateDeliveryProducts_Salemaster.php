<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["ProductCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 		 

 $ProductCode = mysqli_real_escape_string($connection, strtoupper($_POST["ProductCode"]));    
 $ActualQty = mysqli_real_escape_string($connection, strtoupper($_POST["ActualQty"]));    
 $ModifiedQty = mysqli_real_escape_string($connection, strtoupper($_POST["ModifiedQty"]));    
 $InvoiceNo = mysqli_real_escape_string($connection, strtoupper($_POST["InvoiceNo"]));     
   
  $LocationCode = 3;
  
  $userid = $_SESSION['SESS_MEMBER_ID'];	
  $AddPaymentMode='';
  try {
    
      $AddPaymentMode.= "update salemaster set 
      saleqty =(select sum(saleqty) from  newsaleitemsproduct where invoiceno='$InvoiceNo'),
      nettamount =(select sum(nettamount) from  newsaleitemsproduct where invoiceno='$InvoiceNo'),  
      newbalance =(select sum(nettamount) from  newsaleitemsproduct where invoiceno='$InvoiceNo') - received,  
      discountamount =(select sum(discountamount) from  newsaleitemsproduct where invoiceno='$InvoiceNo') where
      saleuniqueno ='$InvoiceNo';"; 

      $AddPaymentMode.= "insert into salepaymentdetails (customercode,paymentmode,amount,invoiceno,date,
      transactiontype,clientid,transactiongroup,remarks)  
      select 
      (select paitientcode from salemaster where saleuniqueno ='$InvoiceNo'),
      (select paymentmode from salepaymentdetails where invoiceno ='$InvoiceNo' limit 1),
      nettamount,uniqueno,date,'CashAdvance','3','Inventory','Auto Generated for Delivery modification' 
      from removeditems where saleuniqueno='$InvoiceNo' and productcode ='$ProductCode' and updatestatus = 0;"; 
    
      $AddPaymentMode.= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
creditamount,createdby,clientid,remarks)
select 'Medicine','Medicine - Advance',uniqueno,date,(select paitientcode from salemaster where saleuniqueno ='$InvoiceNo'),
'0',nettamount,'$userid','$LocationCode','Auto Generated for Delivery modification' 
from  removeditems where saleuniqueno='$InvoiceNo' and productcode ='$ProductCode' and updatestatus = 0;"; 

$AddPaymentMode.= " INSERT INTO advancedetails (paitentcode,advancedate,amount,paymentmode,remarks,createdby,
clientid)
select (select paitientcode from salemaster where saleuniqueno ='$InvoiceNo'),
date,nettamount,(select paymentmode from salepaymentdetails where invoiceno ='$InvoiceNo' limit 1),
'Auto Generated for Delivery modification','$userid','$LocationCode'
from  removeditems where saleuniqueno='$InvoiceNo' and productcode ='$ProductCode' and updatestatus = 0;"; 



$AddPaymentMode.= "UPDATE paitentmaster set receipt=receipt+(select nettamount from removeditems where saleuniqueno='$InvoiceNo'  
and productcode ='$ProductCode' and updatestatus = 0) where paitentid=(select paitientcode from salemaster where saleuniqueno ='$InvoiceNo');";


$AddPaymentMode.= "UPDATE removeditems set updatestatus = 1 where saleuniqueno='$InvoiceNo' and productcode ='$ProductCode' and updatestatus = 0;";
  
  
// echo $AddPaymentMode;
 
   if (mysqli_multi_query($connection, $AddPaymentMode)) {
         
      // echo $AddPaymentMode;
      // echo "Service Requese has been registered, Request ID is " . $last_id;
       echo "1";
        // echo $SaveSaleMaster;
              } else {
               //   echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
                 echo $AddPaymentMode;
              } 


} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>