<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");
   $PaitentCode = mysqli_real_escape_string($connection, strtoupper($_POST["PaitentCode"]));
   $DiagnosisID = mysqli_real_escape_string($connection, strtoupper($_POST["DiagnosisID"]));
   $InvoiceNo = mysqli_real_escape_string($connection, strtoupper($_POST["InvoiceNo"]));


   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = $_SESSION['SESS_MEMBER_ID'];

   try {
      $AddPaymentMode = "insert into diagnosisitems (diagnosisuniqueid,paitentcode,diagnosisid,rate,qty,discount,nettamount)
      select '$InvoiceNo','$PaitentCode','$DiagnosisID',rate,1,0,rate from disagnosismaster where id='$DiagnosisID'  ";

      if (mysqli_query($connection, $AddPaymentMode)) {

         // echo "Service Requese has been registered, Request ID is " . $last_id;
         echo "1";
      } else {
         echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
      }
   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error Adding";
}
