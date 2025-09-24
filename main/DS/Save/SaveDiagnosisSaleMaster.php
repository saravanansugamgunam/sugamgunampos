<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");
   $EntryDate = mysqli_real_escape_string($connection, strtoupper($_POST["EntryDate"]));
   $PaitentCode = mysqli_real_escape_string($connection, strtoupper($_POST["PaitentCode"]));
   $OldBalance = mysqli_real_escape_string($connection, strtoupper($_POST["OldBalance"]));
   $InvoiceNo = mysqli_real_escape_string($connection, strtoupper($_POST["InvoiceNo"]));
   $TotalAmount = mysqli_real_escape_string($connection, strtoupper($_POST["TotalAmount"]));
   $Cash = mysqli_real_escape_string($connection, $_POST["Cash"]);
   $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);
   $OtherPayment = mysqli_real_escape_string($connection, $_POST["OtherPayment"]);
   $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);
   $BillBalance = mysqli_real_escape_string($connection, $_POST["BillBalance"]);
   $DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);

  
   $CenterID = mysqli_real_escape_string($connection, $_POST["CenterID"]);
   $SampleCollectedBy = mysqli_real_escape_string($connection, $_POST["SampleCollectedBy"]); 
   if($SampleCollectedBy=='')
   {
      $SampleCollectedBy='0';
   }


   $ReceivedAmount = floatval($Cash) * 1 + floatval($OtherPayment) * 1;
   $NewBalance = floatval($OldBalance) * 1 + floatval($BillBalance) * 1;

   $GroupID = $_SESSION['SESS_GROUP_ID']; 

   $LocationCode = $_SESSION['SESS_LOCATION'];

   $userid = $_SESSION['SESS_MEMBER_ID'];
   $AddPaymentMode = '';
   try {
      $AddPaymentMode .= "insert into diagnosissalemaster (diagnosisuniqueno,saledate,paitentid,grossamount,discount,nettamount,
      completeddate,completedstatus,resultstatus,createdby,remarks,oldbalance,
      newbalance,receivedamount,balanceamount,doctorcode,locationcode,diagnosticcenter,samplecollected,samplecollecteddatetime)
      select '$InvoiceNo','$EntryDate','$PaitentCode',sum(rate),0,sum(rate),'1900-01-01','Pending','Not Delivered',
       '$userid','$Remarks','$OldBalance','$NewBalance','$ReceivedAmount','$BillBalance','$DoctorCode','$LocationCode',
       '$CenterID','$SampleCollectedBy','$currentdate'

       from diagnosisitems where diagnosisuniqueid='$InvoiceNo';  ";

      $AddPaymentMode .= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
        creditamount,createdby,clientid,remarks)
        VALUES 
        ('Diagnosis','Diagnosis Fee','$InvoiceNo','$EntryDate','$PaitentCode','$TotalAmount','0','$userid','$LocationCode','$Remarks');";

      if ($ReceivedAmount > 0) {
         $AddPaymentMode .= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
           creditamount,createdby,clientid,remarks)
           VALUES  
         ('Diagnosis','Diagnosis Fee - Payment','$InvoiceNo','$EntryDate','$PaitentCode','0','$ReceivedAmount','$userid','$LocationCode','$Remarks');";
      }

      $AddPaymentMode .= "  UPDATE paitentmaster set topay=topay+'$TotalAmount', receipt =receipt+'$ReceivedAmount' where paitentid='$PaitentCode';";

      if ($Cash > 0) {
         $AddPaymentMode .= "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,clientid,transactiontype,transactiongroup,completionstatus) values 
   ('$PaitentCode','12','$Cash','$InvoiceNo','$EntryDate','$LocationCode','Diagnosis','Clinic','1');";
      }

      if ($OtherPayment > 0) {
         $AddPaymentMode .= "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,clientid,transactiontype,transactiongroup,completionstatus) values 
('$PaitentCode','$PaymentMode','$OtherPayment','$InvoiceNo','$EntryDate','$LocationCode','Diagnosis','Clinic','1');";
      }


      if (mysqli_multi_query($connection, $AddPaymentMode)) {
         echo "1";
         // echo $AddPaymentMode;
      } else {
         // echo $AddPaymentMode;
         echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
      }
   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error Adding";
}