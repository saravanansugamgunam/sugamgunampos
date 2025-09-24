<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["PatientMobileNo"])) {

  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");
  $MobileNo = mysqli_real_escape_string($connection, strtoupper($_POST["PatientMobileNo"]));
  $PatientEmail = mysqli_real_escape_string($connection, strtoupper($_POST["PatientEmail"]));
  $Name = mysqli_real_escape_string($connection, strtoupper($_POST["Patient"]));

  $Whatsapp = mysqli_real_escape_string($connection, strtoupper($_POST["Whatsapp"]));
  $AlternateNo = mysqli_real_escape_string($connection, strtoupper($_POST["AlternateNo"]));
  $ReferenceNo = mysqli_real_escape_string($connection, strtoupper($_POST["ReferenceNo"]));
  $Sex = mysqli_real_escape_string($connection, $_POST["Sex"]);
  $DOB = mysqli_real_escape_string($connection, strtoupper($_POST["DOB"]));
  $Address = mysqli_real_escape_string($connection, strtoupper($_POST["Address"]));
  $PatientBarcode = mysqli_real_escape_string($connection, strtoupper($_POST["PatientBarcode"]));
  $Relation = mysqli_real_escape_string($connection, $_POST["Relation"]);
  $AlreadyRegistred = mysqli_real_escape_string($connection, strtoupper($_POST["AlreadyRegistred"]));
  $ReferenceCode = mysqli_real_escape_string($connection, strtoupper($_POST["ReferenceCode"]));

  $Doctor = mysqli_real_escape_string($connection, strtoupper($_POST["Doctor"]));
  $MaritalStatus = mysqli_real_escape_string($connection, $_POST["MaritalStatus"]);


  $City = mysqli_real_escape_string($connection, $_POST["City"]);
  $Pincode = mysqli_real_escape_string($connection, $_POST["Pincode"]);
  $State = mysqli_real_escape_string($connection, $_POST["State"]);
  $Device = mysqli_real_escape_string($connection, $_POST["Device"]);

  if ($Device == 'Mobile') {
    $Signature = mysqli_real_escape_string($connection, $_POST["Signature"]);
  } else {
    $Signature = '-';
  }

  if ($AlreadyRegistred > 0) {
    $Relation = $Relation;
  } else {
    $Relation = 'Self';
  }

  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;
  try {
    $AddPaymentMode = "insert into paitentmaster (paitentname ,mobileno,email,whatsappno,alternateno,referenceno,
    address,dob,gender,barcode,city,statecode,pincode,device,signatureimage,relationship,
    parentid,referenceid,maritalstatus) values ('$Name','$MobileNo','$PatientEmail','$Whatsapp',
    '$AlternateNo','$ReferenceNo','$Address','$DOB','$Sex','$PatientBarcode',
    '$City','$State','$Pincode','$Device','$Signature','$Relation','$AlreadyRegistred','$ReferenceCode',
    '$MaritalStatus')";




    if (mysqli_query($connection, $AddPaymentMode)) {

      $last_id = mysqli_insert_id($connection);

      $AddConsultation = "insert into newregistrationdetails (customercode ,doctorcode,convertedstatus) 
      values ('$last_id','$Doctor','0')";


      if (mysqli_query($connection, $AddConsultation)) {

        echo 1;
      }
    } else {
      echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
    }
  } catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
} else {
  echo "Error Adding";
}
