<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {

   // echo "1";
   include("../../../connect.php");

   $currentdate = date("Y-m-d");


   $BookingID = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);
   $ItemID = mysqli_real_escape_string($connection, $_POST["ItemID"]);
   $BalanceSitting = mysqli_real_escape_string($connection, $_POST["PendingSittings"]);

   $RefundAmount = mysqli_real_escape_string($connection, $_POST["RefundAmount"]);
   $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);
   $RefundStatus = mysqli_real_escape_string($connection, $_POST["RefundStatus"]);

   $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);

   $LocationCode = 3; //$_SESSION['SESS_LOCATION'];
   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = $_SESSION["SESS_MEMBER_ID"];
   $SaveSaleMaster = '';

   try {
      $SaveSaleMaster .= "delete from timeslotallocation WHERE uniqueid ='$BookingID' and bookingitemid='$ItemID';";

      $SaveSaleMaster .= "UPDATE therapybookingdetails set bookingstatus='Cancelled'
    where bookinguniqueid ='$BookingID' and bookingid='$ItemID';";



      $SaveSaleMaster .= "insert into therapycancelleddetails (bookingid ,bookingitemid,remarks,refundamount,cancelledby) values 
 ('$BookingID','$ItemID','$Remarks','$RefundAmount','$userid');";



$SaveSaleMaster .= "UPDATE paitentmaster set receipt=receipt+$RefundAmount where paitentid   ='$PaitentCode';";


      if ($BalanceSitting == 1 || $BalanceSitting == 0) {
         $SaveSaleMaster .= "
   UPDATE therapybookingmaster set therapystatus='Cancelled' where bookinguniqueid ='$BookingID'  ;";
      } else {
         $SaveSaleMaster .= "
      UPDATE therapybookingmaster set revisedtherapydate = 
      ( select MIN(reviseddate) from therapybookingdetails where bookinguniqueid='$BookingID') 
       where bookinguniqueid ='$BookingID'  ;";
      }


      $SaveSaleMaster .= "insert into transactionlog(refno,category,type,transactionlog,description,createdby,vendorcode1,vendorcode2)  
      VALUE ('$BookingID','Therapy Cancel','Therapy Cancel', 'Amount Rs: $RefundAmount','$Remarks','$userid',
      (SELECT paitentid FROM therapybookingmaster WHERE bookinguniqueid ='$BookingID'),
      (SELECT paitentid FROM therapybookingmaster WHERE bookinguniqueid ='$BookingID'));";



      if ($RefundAmount > 0) {
         $SaveSaleMaster .= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
   creditamount,createdby,clientid,remarks)
   VALUES 
   ('Therapy','Therapy - Cancellation','$BookingID','$currentdate',(SELECT paitentid FROM therapybookingmaster WHERE bookinguniqueid ='$BookingID'),
   '0' ,'$RefundAmount','$userid','$LocationCode','$Remarks');";
      }




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
