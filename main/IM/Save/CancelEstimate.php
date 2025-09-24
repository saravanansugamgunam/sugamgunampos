<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");

   $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);

   $ClientID = 1;
   $userid = 1;

   try {

      $AddPaymentMode = " UPDATE salemaster_estimate  SET  estimateclosure='2' 
        WHERE saleuniqueno ='$InvoiceNo';";


      if (mysqli_multi_query($connection, $AddPaymentMode)) {

         echo  1;
      } else {
         echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
      }
   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error Adding";
}
