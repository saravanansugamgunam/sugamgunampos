<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {

  // echo "1";
  include("../../../connect.php");

  $currentdate = date("Y-m-d");

  $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);
  $RevisedDate = mysqli_real_escape_string($connection, $_POST["RevisedDate"]);
  $Session = mysqli_real_escape_string($connection, $_POST["Session"]);
  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);


  $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];

  try {

    $NewTokenNumber = 0;
    $currenttime = $Session;



    if ($currenttime < 140001) {

      $res = $connection->query("  
    SELECT IFNULL(MAX(revisedtokennumber),0)+1 AS TokenNo FROM tokenmaster WHERE DATE ='$RevisedDate' AND
    createdon < 140001 AND tokenstatus NOT IN ('Cancelled') and 
    doctorid in(select doctorid FROM tokenmaster  WHERE invoicenumber='$InvoiceNo')  ;");
    } else {
      $res = $connection->query("   
      SELECT IFNULL(MAX(revisedtokennumber),0)+1 AS TokenNo FROM tokenmaster WHERE DATE ='$RevisedDate' AND
      createdon > 140000 AND tokenstatus NOT IN ('Cancelled') AND 
      doctorid in(select doctorid FROM tokenmaster  WHERE invoicenumber='$InvoiceNo')  ;");
    }

    while ($data = mysqli_fetch_row($res)) {

      $NewTokenNumber = $data[0];
    }

    $SaveSaleMaster = '';
    $SaveSaleMaster .= "update consultingbillmaster set 
    billdate='$RevisedDate', tokennumber='$NewTokenNumber' where consultationuniquebill='$InvoiceNo' ;";

    $SaveSaleMaster .= "update tokenmaster set 
    tokenstatus='Rescheduled'  where invoicenumber='$InvoiceNo' ;";

    $SaveSaleMaster .= "insert into tokenmaster (locationcode,date,tokennumber,revisedtokennumber,
    invoicenumber,paitentcode,doctorid,tokenstatus,totalamount,createdon,onlinetokenflag)
     
    select locationcode,'$RevisedDate','$NewTokenNumber','$NewTokenNumber',
    invoicenumber,paitentcode,doctorid,'Open',totalamount,'$currenttime',onlinetokenflag 
    FROM tokenmaster WHERE invoicenumber ='$InvoiceNo';";


    $SaveSaleMaster .= "insert into modificationlogs (changetype,description,referenceno,logdate,
    remarks,changedby ) 
    value ('Reschedule - Consulting Bill','Bill date changed','$InvoiceNo','$currentdate',
    '$Remarks','$userid');";

    $SaveSaleMaster .= "UPDATE tokenmaster set onlinetokenflag='1' where invoicenumber ='$InvoiceNo'  AND DATE='2023-03-22';";

    if (mysqli_multi_query($connection, $SaveSaleMaster)) {



      echo 1;
      // echo $NewTokenNumber;
    } else {
      // echo "ERROR: Could not able to execute $AddItem. " . mysqli_error($connection);
      echo "0";
      // echo $NewTokenNumber;
    }
  } catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
} else {
  echo "Error";
}
