<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["FromPaitentCode"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");


   $FromPaitentCode = mysqli_real_escape_string($connection, $_POST["FromPaitentCode"]);
   $AvailableAmount = mysqli_real_escape_string($connection, $_POST["AvailableAmount"]);
   $ToPaitentCode = mysqli_real_escape_string($connection, $_POST["ToPaitentCode"]);
   $TransferRemarks = mysqli_real_escape_string($connection, $_POST["TransferRemarks"]);
   $TransferAmount = mysqli_real_escape_string($connection, $_POST["TransferAmount"]);

   $LocationCode = $_SESSION['SESS_LOCATION'];
   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = $_SESSION['SESS_MEMBER_ID'];

   $RefNo = date("YmdHis");

   try {
      $SaveTransfer = '';


      $res = $connection->query(" SELECT 
      (SELECT CONCAT(paitentname,'(',paitentid,')','-',mobileno) FROM paitentmaster WHERE paitentid ='$FromPaitentCode') AS FromPaitent,
      (SELECT CONCAT(paitentname,'(',paitentid,')','-',mobileno) FROM paitentmaster WHERE paitentid ='$ToPaitentCode') AS ToPaintent;");

      while ($data = mysqli_fetch_row($res)) {

         $FromPaitent = $data[0];
         $ToPaitent = $data[1];
      }


      $SaveTransfer .= "update paitentmaster set receipt = receipt  - '$TransferAmount' where paitentid ='$FromPaitentCode';";
      $SaveTransfer .= "update paitentmaster set receipt = receipt  + '$TransferAmount' where paitentid ='$ToPaitentCode';";
      $SaveTransfer .= "insert into transactionlog(refno,category,type,transactionlog,description,createdby,vendorcode1,vendorcode2) 
      VALUE ('$RefNo','Liability Transfer','Liability Transfer',
      'Amount Rs: $TransferAmount transfered from $FromPaitent to $ToPaitent','$TransferRemarks','$userid','$FromPaitentCode','$ToPaitentCode');";


      mysqli_multi_query($connection, $SaveTransfer);
      echo "1";
      // echo $SaveTransfer;
   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error Adding";
}