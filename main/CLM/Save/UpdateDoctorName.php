<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");
   $InvoiceNo = mysqli_real_escape_string($connection, strtoupper($_POST["InvoiceNo"]));
   $DoctorCode = mysqli_real_escape_string($connection, strtoupper($_POST["DoctorCode"]));
 
 

   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   
   
  $userid = $_SESSION['SESS_MEMBER_ID'];


   try {
      $AddPaymentMode = "UPDATE consultingbillmaster SET doctorid ='$DoctorCode'
       WHERE consultationuniquebill ='$InvoiceNo';";

   $AddPaymentMode.= "UPDATE therapybookingmaster SET doctorid ='$DoctorCode'
   WHERE bookinguniqueid ='$InvoiceNo';";

$AddPaymentMode.= "UPDATE therapybookingdetails SET doctorid ='$DoctorCode'
WHERE bookinguniqueid ='$InvoiceNo';";
 

 if (mysqli_multi_query($connection, $AddPaymentMode)) {
                
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