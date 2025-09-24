 <?php

   session_cache_limiter(FALSE);
   session_start();

   //insert.php
   if (isset($_POST["InvoiceNo"])) {

      // echo "1";
      include("../../../connect.php");

      $SaleDate = date("Y-m-d");
      $currentdate = date("Y-m-d H:i:s");


      $Invoice = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);
      $PaitentCode = mysqli_real_escape_string($connection, $_POST["PatientCode"]);
      $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);
      $PaymentDate = mysqli_real_escape_string($connection, $_POST["PaymentDate"]);
      $TotalSaleQty = 0;
      $TotalDiscountAmount = 0;
      $TotalProfitAmount = 0;
      $TotalSaleAmount = 0;

      $OldBalance = mysqli_real_escape_string($connection, $_POST["OldBalance"]);
      $RefundAmount = mysqli_real_escape_string($connection, $_POST["Payment"]);
      $NewBalance = mysqli_real_escape_string($connection, $_POST["NewBalance"]);
      $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);



      $LocationCodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);

      $GroupID = $_SESSION['SESS_GROUP_ID'];

      if ($GroupID == 1) {
         $LocationCode = $LocationCodeAdmin;
      } else {
         $LocationCode = $_SESSION['SESS_LOCATION'];
      }

      $InvoicePrefix  =    substr($LocationCode, 0, 2);
      $InvoicePrefix  =    "L" . $InvoicePrefix;
      // $ClientID = $_SESSION["CMS_CompanyID"];
      // $userid = $_SESSION["CMS_EmployeeID"];
      $ClientID = 1;
      $userid = $_SESSION['SESS_MEMBER_ID'];

      $RefNo = date("YmdHis");

      try {

         $AddPaymentMode = '';
         $AddPaymentMode .= " insert into salemaster (saledate,invoiceno,saleuniqueno,paitientcode,saleqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,transactiontype,remarks) values 
	('$PaymentDate','$InvoicePrefix','$Invoice','$PaitentCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance',
  '$RefundAmount','$NewBalance','Refund','$Remarks');";

         $AddPaymentMode .= "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,transactiontype,clientid,remarks) values 
	('$PaitentCode','$PaymentMode','$RefundAmount','$Invoice','$PaymentDate','RefundToCustomer','$LocationCode','$Remarks');";

         $AddPaymentMode .= "update paitentmaster set   receipt=receipt-$RefundAmount where paitentid = $PaitentCode;";

         $AddPaymentMode .= "insert into transactionlog(refno,category,type,transactionlog,description,createdby,vendorcode1,vendorcode2)  
      VALUE ('$RefNo','Liability Refund','Liability Refund', 'Amount Rs: $RefundAmount refunded to Paitent Code $PaitentCode','$Remarks','$userid',
      '$PaitentCode','$PaitentCode');";


         mysqli_multi_query($connection, $AddPaymentMode);
         echo "1";
         // echo $SaveTransfer;
      } catch (Exception $e) {
         echo 'Message: ' . $e->getMessage();
      }
   } else {
      echo "Error";
   }

   ?>