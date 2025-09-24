<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["PaitentCode"])) {
  date_default_timezone_set("Asia/Kolkata");

  // echo "1";
  include("../../../connect.php");

  $currentdate = date("Y-m-d");
  $currenttime = date("His");

  $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);
  $ReferenceCode = mysqli_real_escape_string($connection, $_POST["ReferenceCode"]);
  $Reference = mysqli_real_escape_string($connection, $_POST["Reference"]);
  $PaitentName = mysqli_real_escape_string($connection, $_POST["PaitentName"]);
  $PaitentMobile = mysqli_real_escape_string($connection, $_POST["PaitentMobile"]);
  $PaitentEmail = mysqli_real_escape_string($connection, $_POST["PaitentEmail"]);
  $PaitentGender = mysqli_real_escape_string($connection, $_POST["PaitentGender"]);
  $PaitentDOB = mysqli_real_escape_string($connection, $_POST["PaitentDOB"]);
  $PaitentAddress = mysqli_real_escape_string($connection, $_POST["PaitentAddress"]);
  $Tag = mysqli_real_escape_string($connection, $_POST["Tag"]);
  $Profession = mysqli_real_escape_string($connection, $_POST["Profession"]);

  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;

  // select paitentid,mobileno,paitentname,email,whatsappno,alternateno,referenceid,referenceno,gender,
  //   dob,address,city,statecode,pincode,barcode,activestatus from paitentmaster where paitentid= '$PaitentCode' ");


  try {
    $UpdateDoctor = "  UPDATE paitentmaster SET 
   referenceid =  '$ReferenceCode',
   referenceno =  '$Reference',
   paitentname =  '$PaitentName',
   email =  '$PaitentEmail',
   gender =  '$PaitentGender',
   dob =  '$PaitentDOB',
   address =  '$PaitentAddress',
   mobileno =  '$PaitentMobile',
   tag =  '$Tag', 
   profession =  '$Profession'  
   
    where  paitentid ='$PaitentCode' ";

    mysqli_multi_query($connection, $UpdateDoctor);

    echo 1;
    // echo  $UpdateDoctor;

  } catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
} else {
  echo "Error";
}
