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
   $TotalAmount = mysqli_real_escape_string($connection, $_POST["MRP"]);
   $ProfitAmount = mysqli_real_escape_string($connection, $_POST["ProfitAmount"]);
   $BatchCode = mysqli_real_escape_string($connection, $_POST["BatchCode"]);
   $Currentstock = mysqli_real_escape_string($connection, $_POST["Currentstock"]);
   $SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]);
   $Rate = mysqli_real_escape_string($connection, $_POST["Rate"]);
   $SaleDate = mysqli_real_escape_string($connection, $_POST["SaleDate"]);
   $LocationCodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);

   $GroupID = $_SESSION['SESS_GROUP_ID'];

   if ($GroupID == 1) {
      $LocationCode = $LocationCodeAdmin;
   } else {
      $LocationCode = $_SESSION['SESS_LOCATION'];
   }


   try {
      $AddBatch = "insert into newpurchasereturnitems (invoiceno,barcode,returnqty,shortcode,category,productname,mrp,
	discountamount,nettamount,profitamount,saledate,location,batchcode,currentstock,suppliercode,rate) values 
	('$Invoice','$Barcode','$Qty','$Shortcode','$Category','$ProductName','$MRP','$DiscountAmount','$TotalAmount',
	'$ProfitAmount','$SaleDate','$LocationCode','$BatchCode','$Currentstock','$SupplierCode','$Rate') 
   ON DUPLICATE KEY UPDATE  returnqty = returnqty+ '$Qty',nettamount=nettamount+ '$TotalAmount'";
      mysqli_query($connection, $AddBatch);

      // $StockQuery ="INSERT INTO stockdetails (productcode,purchaseqty,currentstock,locationcode,batchno,expirydate,mrp) VALUES  ('$ProductCode','$Qty','$Qty','$LocationCode','$BatchNo','$Expiry','$MRP') on duplicate key update purchaseqty = purchaseqty + '$Qty' ,
      // currentstock = currentstock + '$Qty' "; 

      // mysqli_query($connection,$StockQuery);

      echo "1";
      // echo  $AddBatch;

   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error";
}
