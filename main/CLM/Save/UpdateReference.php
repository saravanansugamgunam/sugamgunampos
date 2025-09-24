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

  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;

  try {
    $UpdateDoctor = "  UPDATE paitentmaster SET referenceno =  '$Reference', referenceid='$ReferenceCode' where  paitentid ='$PaitentCode' ";

    mysqli_multi_query($connection, $UpdateDoctor);

    echo 1;
    // echo  $UpdateDoctor;

  } catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
} else {
  echo "Error";
}