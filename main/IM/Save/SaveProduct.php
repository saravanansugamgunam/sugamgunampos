<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["ProductName"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");
   $ShortCode = mysqli_real_escape_string($connection, strtoupper($_POST["ShortCode"]));
   $ProductName = mysqli_real_escape_string($connection, strtoupper($_POST["ProductName"]));
   $Category = mysqli_real_escape_string($connection, strtoupper($_POST["Category"]));

   $HSN = mysqli_real_escape_string($connection, strtoupper($_POST["HSN"]));
   $GST = mysqli_real_escape_string($connection, strtoupper($_POST["GST"]));
   $Weight = mysqli_real_escape_string($connection, strtoupper($_POST["Weight"]));
   // $Barcode = mysqli_real_escape_string($connection, strtoupper($_POST["Barcode"]));
   $IsMRP = mysqli_real_escape_string($connection, $_POST["IsMRP"]);
   $ApplicationType = mysqli_real_escape_string($connection, $_POST["ApplicationType"]);
   $MedicineBase = mysqli_real_escape_string($connection, $_POST["MedicineBase"]);
   $ProductType = mysqli_real_escape_string($connection, $_POST["ProductType"]);
  

   $MRP = 0;
   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = 1;

   try {
      $GetNewBarcodeno = "SELECT MAX(uniquebarcode) +1 as Barcode  FROM productmaster";

      $res = mysqli_query($connection, $GetNewBarcodeno);

      while ($row = mysqli_fetch_array($res)) {
         $BarcodeNo = $row['Barcode'];
      };

      $AddPaymentMode = "insert into productmaster (productshortcode,productname,category,price,
    gstpercentage,hsncode,weight,ismrp,uniquebarcode,applicationtype,materialtype,medicinebase) 
    values ('$ShortCode','$ProductName','$Category','$MRP','$GST','$HSN','$Weight','$IsMRP',
    '$BarcodeNo','$ApplicationType','$ProductType','$MedicineBase ')";
    
    
      if (mysqli_query($connection, $AddPaymentMode)) {

         // echo "Service Requese has been registered, Request ID is " . $last_id;
         echo  1;
         // echo $PurchaseMaster;
      } else {
         //   echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
         echo $PurchaseMaster;
      }
   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error Adding";
}
