<?php

session_cache_limiter(FALSE);
session_start();

function random_num($size) {
	$alpha_key = '';
	$keys = range('A', 'Z');
	
	for ($i = 0; $i < 2; $i++) {
		$alpha_key .= $keys[array_rand($keys)];
	}
	
	$length = $size - 2;
	
	$key = '';
	$keys = range(0, 9);
	
	for ($i = 0; $i < $length; $i++) {
		$key .= $keys[array_rand($keys)];
	}
	
	return $alpha_key . $key;
}


//insert.php
if (isset($_POST["InvoiceNo"])) {

  // echo "1";
  include("../../../connect.php");

  $currentdate = date("Y-m-d");


  $Height = mysqli_real_escape_string($connection, $_POST["Height"]);
  $Weight = mysqli_real_escape_string($connection, $_POST["Weight"]);
  $Pulse = mysqli_real_escape_string($connection, $_POST["Pulse"]);
  $BP = mysqli_real_escape_string($connection, $_POST["BP"]);
  $SiddhaPulse = mysqli_real_escape_string($connection, $_POST["SiddhaPulse"]);
  $TCMPulse = mysqli_real_escape_string($connection, $_POST["TCMPulse"]);
  $Temperature = mysqli_real_escape_string($connection, $_POST["Temperature"]);
  $SkinHairNail = mysqli_real_escape_string($connection, $_POST["SkinHairNail"]);
  $Compliant = mysqli_real_escape_string($connection, $_POST["Compliant"]);
  $PresentIllness = mysqli_real_escape_string($connection, $_POST["PresentIllness"]);
  $PastIllness = mysqli_real_escape_string($connection, $_POST["PastIllness"]);
  $Diagnosis = mysqli_real_escape_string($connection, $_POST["Diagnosis"]);
  $Medicine = mysqli_real_escape_string($connection, $_POST["Medicine"]);
  $Advice = mysqli_real_escape_string($connection, $_POST["Advice"]);
  $TestRequired = mysqli_real_escape_string($connection, $_POST["TestRequired"]);
  $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);
  $TokenNo = mysqli_real_escape_string($connection, $_POST["TokenNo"]);
  $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);
  $NextAppointment = mysqli_real_escape_string($connection, $_POST["NextAppointment"]);
  $OtherDoctorReference = mysqli_real_escape_string($connection, $_POST["OtherDoctorReference"]);

  $NextAppointmentType = mysqli_real_escape_string($connection, $_POST["NextAppointmentType"]);
  $NextAppointmeRemarks = mysqli_real_escape_string($connection, $_POST["NextAppointmeRemarks"]);


  $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];
  $UdateCaseHistory = '';
  
  $RandomeInvoiceNo = random_num(9);

  try {
    $UdateCaseHistory .= "delete from casehistory where consultinguniqueid ='$InvoiceNo';";

    $UdateCaseHistory .= "insert into casehistory (paitentid,height,weight,pulse,bp,temperature,shn,chiefcompliant,presentillness,pastillness,
    disgnosis,rx,diet,testsrequired,medicineid,consultinguniqueid,consultingdate,createdby,nextappointmentdate,
    siddhapulse,tcmpulse,referotherdoctor) values
    ('$PaitentID','$Height','$Weight','$Pulse','$BP','$Temperature','$SkinHairNail','$Compliant','$PresentIllness','$PastIllness',
    '$Diagnosis','$Medicine','$Advice','$TestRequired','0','$InvoiceNo','$currentdate','$userid','$NextAppointment',
    '$SiddhaPulse','$TCMPulse','$OtherDoctorReference');";
    
    
  $UdateCaseHistory .= "update diseasemapping_paitent set eprescriptionno = '$RandomeInvoiceNo' where diseasemappinguniqueid ='$InvoiceNo';";
 


    $UdateCaseHistory.=" insert nextappointmentdetails (paitentid,nextappointmentdate,remarks,freestatus) values
    ('$PaitentID','$NextAppointment','$NextAppointmeRemarks', '$NextAppointmentType') "; 
	 

    if (mysqli_multi_query($connection, $UdateCaseHistory)) {
      echo 1;
      // echo $SaveSaleMaster;
    } else {
      // echo "ERROR: Could not able to execute $AddItem. " . mysqli_error($connection);
      // echo "0";
      echo $UdateCaseHistory;
    }
  } catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
} else {
  echo "Error";
}