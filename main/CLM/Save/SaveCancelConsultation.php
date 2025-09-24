<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {
  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d");
  $Remarks = mysqli_real_escape_string($connection, strtoupper($_POST["Remarks"]));
  $RefundAmount = mysqli_real_escape_string($connection, strtoupper($_POST["RefundAmount"]));
  $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);
  $TokenNo = mysqli_real_escape_string($connection, $_POST["TokenNo"]);
  $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);

  $LocationCode = $_SESSION['SESS_LOCATION'];

  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];

  try {
    $AddPaymentMode = "update consultingbillmaster set tokenstatus='Cancelled', 
	 closureremarks='$Remarks',cancelledstatus=1  where consultationuniquebill ='$InvoiceNo' and tokennumber='$TokenNo'; ";

    $AddPaymentMode .= "update tokenmaster set tokenstatus='Cancelled' where invoicenumber ='$InvoiceNo' and tokennumber='$TokenNo'; ";


    $AddPaymentMode .= "insert into transactionlog(refno,category,type,transactionlog,description,createdby,vendorcode1,vendorcode2)  
  VALUE ('$InvoiceNo','Consultation Cancel','Consultation Cancel', 'Amount Rs: $RefundAmount','$Remarks','$userid',
  (SELECT paitentid FROM consultingbillmaster WHERE consultationuniquebill ='$InvoiceNo'),
  (SELECT paitentid FROM consultingbillmaster WHERE consultationuniquebill ='$InvoiceNo'));";



    if ($RefundAmount > 0) {
      $AddPaymentMode .= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
creditamount,createdby,clientid,remarks)
VALUES 
('Consulting','Consulting - Cancellation','$InvoiceNo','$currentdate',(SELECT paitentid FROM consultingbillmaster WHERE consultationuniquebill ='$InvoiceNo'),
'0' ,'$RefundAmount','$userid','$LocationCode','$Remarks');";


      $AddPaymentMode .= "UPDATE paitentmaster set 
      topay=topay - (select totalamount - receivedamount from consultingbillmaster WHERE consultationuniquebill ='$InvoiceNo'),
      receipt=receipt+$RefundAmount 
where paitentid in (SELECT paitentid FROM consultingbillmaster WHERE consultationuniquebill ='$InvoiceNo');";
    }




    if (mysqli_multi_query($connection, $AddPaymentMode)) {

      echo "1";
      // echo    $AddPaymentMode;
    } else {
      echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
    }
  } catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
} else {
  // echo "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date) values 
  // ('$PaitentCode','$PaymentMode','$PaymentAmount','$Invoice','$currentdate')";
}
