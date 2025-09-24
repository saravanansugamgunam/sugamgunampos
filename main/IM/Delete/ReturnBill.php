<?php
  
  session_cache_limiter(FALSE);
  session_start();
     $LocationCode = '3'; // $_SESSION['SESS_LOCATION'];
  //insert.php
      function removeslashes($string)
  {
      $string=implode("",explode("\\",$string));
      return stripslashes(trim($string));
  }
  
  if(isset($_POST["ItemID"]))
  {
     
   // echo "1";
   include("../../../connect.php"); 
    $currentdatetime =date("Y-m-d H:i:s"); 							  
    $currentdate =date("Y-m-d"); 							  
   $ItemID = removeslashes(mysqli_real_escape_string($connection, strtoupper($_POST["ItemID"])));    
   $InvoiceNo = mysqli_real_escape_string($connection, strtoupper($_POST["InvoiceNo"]));    
   $ReturnInvoice = mysqli_real_escape_string($connection, strtoupper($_POST["ReturnInvoice"]));  
   $PercentageConsidered = mysqli_real_escape_string($connection, strtoupper($_POST["PercentageConsidered"]));  
   $ReturnValue = mysqli_real_escape_string($connection, strtoupper($_POST["ReturnValue"]));  
     

    // $ClientID = $_SESSION["CMS_CompanyID"];
    // $userid = $_SESSION["CMS_EmployeeID"];
    $ClientID = 1;
    $userid = $_SESSION['SESS_MEMBER_ID'];	
     
    try {
      $SaleItems = "update newsaleitems set returnstatus =1 where barcode in($ItemID) and invoiceno='$InvoiceNo'  ";  
   mysqli_query($connection, $SaleItems); 
     
    
   $SaleReturnItems = " INSERT INTO newsaleitems
              (invoiceno,barcode,saleqty,shortcode,category,productname,
               mrp,discountamount,nettamount,saledate,location,batchcode,
               currentstock,paitentcode,rate,profitamount,entrydate,returnstatus,transactiontype)
               
  SELECT $ReturnInvoice AS invoiceno,barcode,-saleqty,shortcode,category,productname,
               -mrp,-discountamount,(nettamount - (nettamount *($PercentageConsidered/100)))*-1 ,saledate,location,batchcode,
               currentstock,paitentcode,rate,-profitamount,'$currentdatetime','1','Return' FROM 
               newsaleitems WHERE invoiceno= $InvoiceNo AND barcode IN($ItemID);";
         
          mysqli_query($connection, $SaleReturnItems); 
                
            $SaleReturnMaster = "  INSERT INTO salemaster
  (saledate,invoiceno,saleuniqueno,paitientcode,
  saleqty,discountamount,nettamount,profitamount,locationcode,
  entrydate,oldbalance,received,newbalance,cancellstatus,
  transactiontype,remarks,deliverystatus,addedby)
  SELECT '$currentdate' AS saledate,invoiceno,$ReturnInvoice AS saleuniqueno,paitientcode,
  (SELECT SUM(saleqty) FROM  newsaleitems WHERE invoiceno= '$ReturnInvoice') AS saleqty,
  (SELECT SUM(discountamount) FROM  newsaleitems WHERE invoiceno= '$ReturnInvoice') AS Discount,
  (SELECT SUM(nettamount) FROM  newsaleitems WHERE invoiceno= '$ReturnInvoice') AS Netamount,
  (SELECT SUM(profitamount) FROM  newsaleitems WHERE invoiceno= '$ReturnInvoice') AS profit,
  locationcode,'$currentdatetime',oldbalance,
  (SELECT SUM(nettamount) FROM  newsaleitems WHERE invoiceno= $ReturnInvoice) AS received,
    newbalance,cancellstatus, 'Return','$PercentageConsidered','1','$userid' FROM salemaster WHERE saleuniqueno= '$InvoiceNo'";
    mysqli_query($connection, $SaleReturnMaster); 
    
    
         $StockUpdate = "UPDATE newstockdetails_".$LocationCode." SET salereturn = salereturn + 1, currentstock=currentstock+1 WHERE 
     barcode IN($ItemID)";  
      
     
   mysqli_query($connection, $StockUpdate); 
   
  //  $UpdatePaymentDetails ="  INSERT INTO  salepaymentdetails
  // (customercode,paymentmode,amount,invoiceno,DATE,transactiontype,clientid) 
  //  SELECT paitientcode,'12', - $ReturnValue,saleuniqueno,'$currentdate','SalesReturn',$LocationCode FROM salemaster WHERE saleuniqueno= '$ReturnInvoice'; "; 
    
      $UpdatePaymentDetails="  UPDATE paitentmaster set 
      receipt =receipt -( SELECT nettamount  FROM salemaster WHERE saleuniqueno= '$ReturnInvoice') where paitentid 
      in( SELECT paitientcode  FROM salemaster WHERE saleuniqueno= '$ReturnInvoice');"; 

$UpdatePaymentDetails.= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
creditamount,createdby,clientid,remarks)
VALUES 
('Medicine','Salereturn','$ReturnInvoice','$currentdate',
(select paitientcode from salemaster WHERE saleuniqueno= '$ReturnInvoice'),'0',
(SELECT SUM(nettamount) FROM  newsaleitems WHERE invoiceno= '$ReturnInvoice')*-1,'$userid','$LocationCode','-');";

      
      if (mysqli_multi_query($connection, $UpdatePaymentDetails)) {
    
   
    echo "Product returned Successfully";
  
  }
  }
   catch (Exception $e) {
     echo 'Message: ' .$e->getMessage();
  }   
  } 
     
  
  ?>