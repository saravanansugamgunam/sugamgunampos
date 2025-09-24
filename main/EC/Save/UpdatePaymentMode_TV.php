<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");
   $InvoiceNo = mysqli_real_escape_string($connection, strtoupper($_POST["InvoiceNo"]));
   $PaymentID = mysqli_real_escape_string($connection, strtoupper($_POST["PaymentID"]));
   $PaymentModeID = mysqli_real_escape_string($connection, strtoupper($_POST["PaymentModeID"]));

   $ClientID = 1;
   $userid = 1;

   try {
      $AddPaymentMode = "update salepaymentdetails SET paymentmode='$PaymentModeID' WHERE invoiceno='$InvoiceNo' AND paymentid='$PaymentID'";

      if (mysqli_multi_query($connection, $AddPaymentMode)) {
         echo 1;
         // echo $sql;
      } else {
         echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
      }
   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error Adding";
}
