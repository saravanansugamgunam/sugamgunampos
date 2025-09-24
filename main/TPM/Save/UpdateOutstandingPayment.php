<?php

session_cache_limiter(FALSE);
session_start();



//insert.php
if (isset($_POST["PaitentCode"])) {

  // echo "1";
  include("../../../connect.php");

  $currentdate = date("Y-m-d");

  $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);
  $CurrentOutstanding = mysqli_real_escape_string($connection, $_POST["CurrentOutstanding"]);
  $NewOutstanding = mysqli_real_escape_string($connection, $_POST["NewOutstanding"]);
  $AdjustedAmount = mysqli_real_escape_string($connection, $_POST["AdjustedAmount"]);
  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);
  $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);

  $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];

  try {
    $SaveSaleMaster = "";
    if ($AdjustedAmount < 0) {
      $SaveSaleMaster .= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,
      invoicegrndate,vendorcode,debitamount,
      creditamount,createdby,clientid,remarks)
      VALUES 
      ('Medicne','Medicne - Outstanding Adjustment','$InvoiceNo','$currentdate','$PaitentCode','0','$AdjustedAmount',
      '$userid','$LocationCode','$Remarks');";
    } else {
      $SaveSaleMaster .= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,
      invoicegrndate,vendorcode,debitamount,
      creditamount,createdby,clientid,remarks)
      VALUES 
      ('Medicne','Medicne - Outstanding Adjustment','$InvoiceNo','$currentdate','$PaitentCode','$AdjustedAmount','0',
      '$userid','$LocationCode','$Remarks');";
    }

    if ($CurrentOutstanding < 0) {
      $SaveSaleMaster .= " INSERT INTO transactionlog (refno,category,type,
      transactionlog,description,createdby,vendorcode1,vendorcode2)
      VALUES 
      ('$InvoiceNo','Liability Adjustment','Liability Adjustment',
      'Liability amount Rs.$CurrentOutstanding revised to $NewOutstanding','$Remarks','$userid','$PaitentCode','$PaitentCode');";
    } else {
      $SaveSaleMaster .= " INSERT INTO transactionlog (refno,category,type,
      transactionlog,description,createdby,vendorcode1,vendorcode2)
      VALUES 
      ('$InvoiceNo','Outstanding Adjustment','Outstanding Adjustment',
      'Outstanding amount Rs.$CurrentOutstanding revised to $NewOutstanding','$Remarks','$userid','$PaitentCode','$PaitentCode');";
    }

    $SaveSaleMaster .= "  UPDATE paitentmaster set receipt = receipt+'$AdjustedAmount' where paitentid='$PaitentCode';";


    if (mysqli_multi_query($connection, $SaveSaleMaster)) {
      echo 1;
      // echo $SaveSaleMaster;
    } else {
      // echo "ERROR: Could not able to execute $AddItem. " . mysqli_error($connection);
      echo "0";
      // echo $SaveSaleMaster;
    }
  } catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
} else {
  echo "Error";
}
