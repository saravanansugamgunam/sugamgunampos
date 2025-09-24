<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");
   $InvoiceNo = mysqli_real_escape_string($connection, strtoupper($_POST["InvoiceNo"]));
   $PaymentMode = mysqli_real_escape_string($connection, strtoupper($_POST["PaymentMode"]));



   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = 1;

   try {
      $AddPaymentMode = "update salepaymentdetails set paymentmode='$PaymentMode' 
     where invoiceno='$InvoiceNo'";

      mysqli_query($connection, $AddPaymentMode);
      echo "Added Successfuly";
   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error Adding";
}