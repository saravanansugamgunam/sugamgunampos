<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {

  // echo "1";
  include("../../../connect.php");

  $currentdate = date("Y-m-d");
 
  $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]); 
  $DeliveryDate = mysqli_real_escape_string($connection, $_POST["DeliveryDate"]);

  $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];

  $SaveSaleMaster = " update diagnosissalemaster set  
  deliverydate='$DeliveryDate', resultstatus='Delivered', 
  reconsultingstatus='1' where  diagnosisuniqueno = '$InvoiceNo' ";
 
 
  if (mysqli_multi_query($connection, $SaveSaleMaster)) {
    echo 1;
  } else {
    // echo "ERROR: Could not able to execute $AddItem. " . mysqli_error($connection);
    echo "0";
    // echo $SaveSaleMaster;
  }
} else {
  echo "Error";
}