<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["ProductCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 		 
  $RemovedUniqueID = date("Ymdhisa");


 $ProductCode = mysqli_real_escape_string($connection, strtoupper($_POST["ProductCode"]));    
 $ActualQty = mysqli_real_escape_string($connection, strtoupper($_POST["ActualQty"]));    
 $ModifiedQty = mysqli_real_escape_string($connection, strtoupper($_POST["ModifiedQty"]));    
 $InvoiceNo = mysqli_real_escape_string($connection, strtoupper($_POST["InvoiceNo"]));     
  $RemovedQty =  $ActualQty - $ModifiedQty;
  $ClientID = 1;
  
  $userid = $_SESSION['SESS_MEMBER_ID'];	
  $AddPaymentMode='';
  try {
   if($ModifiedQty==0)
   {
      $AddPaymentMode.="insert into removeditems(uniqueno,saleuniqueno,date,productcode,qty,mrp,discount,nettamount,updatedby)  
      select '$RemovedUniqueID','$InvoiceNo','$currentdate','$ProductCode','$RemovedQty',mrp,
      ifnull((discountamount / $ActualQty)*'$RemovedQty',0),ifnull((nettamount/$ActualQty)*'$RemovedQty',0),'$userid' from 
      newsaleitemsproduct where invoiceno='$InvoiceNo' and productcode ='$ProductCode';"; 

      $AddPaymentMode.= "delete from newsaleitemsproduct  where invoiceno='$InvoiceNo' and productcode ='$ProductCode';";
       
   }
   else
   {
      $AddPaymentMode.="insert into removeditems(uniqueno,saleuniqueno,date,productcode,qty,mrp,discount,nettamount,updatedby)  
      select '$RemovedUniqueID','$InvoiceNo','$currentdate','$ProductCode','$RemovedQty',mrp,
      ifnull((discountamount / $ActualQty)*'$RemovedQty',0),ifnull((nettamount/$ActualQty)*'$RemovedQty',0),'$userid' from 
      newsaleitemsproduct where invoiceno='$InvoiceNo' and productcode ='$ProductCode';";

      $AddPaymentMode.= "update  newsaleitemsproduct set 
      saleqty ='$ModifiedQty',
      discountamount = ifnull((discountamount / $ActualQty)*'$ModifiedQty',0),
      nettamount = ifnull((nettamount/$ActualQty)*'$ModifiedQty',0) 
      where invoiceno='$InvoiceNo' and productcode ='$ProductCode';";

    
    }
    
 
   if (mysqli_multi_query($connection, $AddPaymentMode)) {
             // echo $AddPaymentMode;  
      // echo "Service Requese has been registered, Request ID is " . $last_id;
         echo "1";
        // echo $SaveSaleMaster;
              } else {
                 echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
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