<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["Invoice"])) {

   // echo "1";
   include("../../../connect.php");

   $currentdate = date("Y-m-d H:i:s");


   $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);
   $Barcode = mysqli_real_escape_string($connection, $_POST["Barcode"]);
   $Qty = mysqli_real_escape_string($connection, $_POST["Qty"]);
   $Shortcode = mysqli_real_escape_string($connection, $_POST["Shortcode"]);
   $Category = mysqli_real_escape_string($connection, $_POST["Category"]);
   $ProductName = mysqli_real_escape_string($connection, strtoupper($_POST["ProductName"]));
   $MRP = mysqli_real_escape_string($connection, $_POST["MRP"]);
   $DiscountAmount = mysqli_real_escape_string($connection, $_POST["DiscountAmount"]);
   $TotalAmount = mysqli_real_escape_string($connection, $_POST["TotalAmount"]);
   $ProfitAmount = mysqli_real_escape_string($connection, $_POST["ProfitAmount"]);
   $BatchCode = mysqli_real_escape_string($connection, $_POST["BatchCode"]);
   $Currentstock = mysqli_real_escape_string($connection, $_POST["Currentstock"]);
   $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);
   $Rate = mysqli_real_escape_string($connection, $_POST["Rate"]);
   $SaleDate = mysqli_real_escape_string($connection, $_POST["SaleDate"]);
   $ExpiryDate = mysqli_real_escape_string($connection, $_POST["ExpiryDate"]);
   $EmployeeCode = mysqli_real_escape_string($connection, $_POST["EmployeeCode"]);
   
   $LocationCode = $_SESSION['SESS_LOCATION'];
   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = 1;
   $AddBatch = '';

   try {
      $AddBatch .= "delete from newsaleitems where 
      invoiceno='$Invoice' and 
      barcode='$Barcode' and
      mrp='$MRP' and
      batchcode='$BatchCode' and
      expirydate='$ExpiryDate';   ";

      $AddBatch .= "insert into newsaleitems (invoiceno,barcode,saleqty,shortcode,category,productname,mrp,
      discountamount,nettamount,profitamount,saledate,location,batchcode,currentstock,paitentcode,rate,expirydate,employeecode) values 
	('$Invoice','$Barcode','$Qty','$Shortcode','$Category','$ProductName','$MRP','$DiscountAmount','$TotalAmount',
	'$ProfitAmount','$SaleDate','$LocationCode','$BatchCode','$Currentstock','$PaitentCode','$Rate','$ExpiryDate','$EmployeeCode'); 
     ";


      if (mysqli_multi_query($connection, $AddBatch)) {


         echo "1";
      } else {
         echo "Error: " . $AddBatch . "" . mysqli_error($connection);
      }
   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error";
}