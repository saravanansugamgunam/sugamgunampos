<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {
   date_default_timezone_set("Asia/Kolkata");

   // echo "1";
   include("../../../connect.php");

   $currentdate = date("Y-m-d");
   $currenttime = date("His");

   $DoctorID = mysqli_real_escape_string($connection, $_POST["DoctorID"]);
   $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);
   $NewToken = mysqli_real_escape_string($connection, $_POST["NewToken"]);

   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = 1;

   try {
      $UpdateDoctor = "  UPDATE tokenmaster SET 
   revisedtokennumber = '$NewToken', tokennumber = '$NewToken',  
   doctorid='$DoctorID', doctorchangeflag ='1',
   changelog=(SELECT doctorid FROM tokenmaster where invoicenumber='$InvoiceNo')
       WHERE invoicenumber='$InvoiceNo';";

      $UpdateDoctor .= "update consultingbillmaster set doctorid='$DoctorID',tokennumber='$NewToken' WHERE consultationuniquebill ='$InvoiceNo'  ;";

      $UpdateDoctor .= "update consultingdetails set doctorid='$DoctorID'  WHERE consultationuniquebill ='$InvoiceNo' ;";


      if (mysqli_multi_query($connection, $UpdateDoctor)) {
         echo 1;
         // echo $UpdateDoctor;
      } else {
         // echo "ERROR: Could not able to execute $AddItem. " . mysqli_error($connection);
         echo "0";
         // echo $UpdateDoctor;
      }

      // echo  $UpdateDoctor;

   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error";
}
