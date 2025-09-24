<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["DiagnosticCenterName"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");
 
   $DiagnosticCenterID = mysqli_real_escape_string($connection, $_POST["DiagnosticCenterID"]);
   $DiagnosticCenterName = mysqli_real_escape_string($connection, strtoupper($_POST["DiagnosticCenterName"]));
   $Address = mysqli_real_escape_string($connection, $_POST["Address"]); 
   $City = mysqli_real_escape_string($connection, $_POST["City"]); 
   $State = mysqli_real_escape_string($connection, $_POST["State"]); 
   $Pincode = mysqli_real_escape_string($connection, $_POST["Pincode"]); 
   $ContactNo = mysqli_real_escape_string($connection, $_POST["ContactNo"]); 
   $EmailID = mysqli_real_escape_string($connection, $_POST["EmailID"]); 
   $ContactPerson = mysqli_real_escape_string($connection, $_POST["ContactPerson"]); 
   $ActiveStatus = mysqli_real_escape_string($connection, $_POST["ActiveStatus"]); 


   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = $_SESSION['SESS_MEMBER_ID'];

   try {
      if($DiagnosticCenterID>0)
      {
         $AddPaymentMode = "update diagnosticcentre set centername='$DiagnosticCenterName',
         address='$Address',center_citycode='$City',center_statecode='$State',pincode='$Pincode',
         contactno='$ContactNo',emailid='$EmailID',contactperson='$ContactPerson',activestatus='$ActiveStatus' where
         centerid ='$DiagnosticCenterID'";
      }
      else
      {
 
      $AddPaymentMode = "insert into diagnosticcentre (centername,address,center_citycode,center_statecode,pincode,
      contactno,emailid,contactperson,addedby,activestatus)
     values ('$DiagnosticCenterName','$Address','$City','$State','$Pincode',
     '$ContactNo','$EmailID','$ContactPerson','$userid','$ActiveStatus')";
   }

   
   if (mysqli_query($connection, $AddPaymentMode)) {
      echo "1";
      // echo $AddPaymentMode;
   } else {
      // echo $AddPaymentMode;
      echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
   }
 

   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error Adding";
}