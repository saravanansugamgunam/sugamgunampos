<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["StockItemID"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");
   $NewStock = mysqli_real_escape_string($connection, strtoupper($_POST["NewStock"]));
   $StockItemID = mysqli_real_escape_string($connection, strtoupper($_POST["StockItemID"]));
   $CurrentStock = mysqli_real_escape_string($connection, strtoupper($_POST["CurrentStock"]));
   $Remarks = mysqli_real_escape_string($connection, strtoupper($_POST["Remarks"]));
   $LocationCode = mysqli_real_escape_string($connection, strtoupper($_POST["LocationCode"]));

   $userid = $_SESSION['SESS_MEMBER_ID'];

   $AddPaymentMode = '';

   try {

      $AddPaymentMode .= "update newstockdetails_" . $LocationCode . " 
     set currentstock ='$NewStock'  where stockitemid ='$StockItemID' ; ";

      $AddPaymentMode .= "insert into  stockadjustmentlog(barcode,oldqty,newqty,updatedby,adjustmentremarks) values 
     ('$StockItemID','$CurrentStock','$NewStock','$userid','$Remarks'); ";


      if (mysqli_multi_query($connection, $AddPaymentMode)) {

         // echo "Service Requese has been registered, Request ID is " . $last_id;
         echo "1";
         // echo $SaveSaleMaster;
      } else {
         echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
      }
   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error Adding";
}
