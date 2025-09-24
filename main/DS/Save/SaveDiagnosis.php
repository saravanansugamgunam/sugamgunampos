<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["Diagnosis"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");
   $Diagnosis = mysqli_real_escape_string($connection, strtoupper($_POST["Diagnosis"]));
   $Description = mysqli_real_escape_string($connection, strtoupper($_POST["Description"]));
   $Rate = mysqli_real_escape_string($connection, strtoupper($_POST["Rate"]));


   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = $_SESSION['SESS_MEMBER_ID'];

   try {
      $AddPaymentMode = "insert into disagnosismaster (diagnosisname,description,rate,createdby)
     values ('$Diagnosis','$Description','$Rate','$userid')";

      mysqli_query($connection, $AddPaymentMode);
      echo "Added Successfuly";
      // echo $AddPaymentMode;

   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error Adding";
}
