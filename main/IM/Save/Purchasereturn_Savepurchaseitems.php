<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["STOUniqueNo"])) {

   // echo "1";
   include("../../../connect.php");

   $currentdate = date("Y-m-d H:i:s");


   $STOUniqueNo = mysqli_real_escape_string($connection, $_POST["STOUniqueNo"]);
   $Barcode = mysqli_real_escape_string($connection, $_POST["Barcode"]);
   $Qty = mysqli_real_escape_string($connection, $_POST["Qty"]);
   $Shortcode = mysqli_real_escape_string($connection, $_POST["Shortcode"]);
   $Category = mysqli_real_escape_string($connection, $_POST["Category"]);
   $ProductName = mysqli_real_escape_string($connection, $_POST["ProductName"]);
   $MRP = mysqli_real_escape_string($connection, $_POST["MRP"]);
   $DiscountAmount = mysqli_real_escape_string($connection, $_POST["DiscountAmount"]);
   $TotalAmount = mysqli_real_escape_string($connection, $_POST["TotalAmount"]);
   $ProfitAmount = mysqli_real_escape_string($connection, $_POST["ProfitAmount"]);
   $BatchCode = mysqli_real_escape_string($connection, $_POST["BatchCode"]);
   $Currentstock = mysqli_real_escape_string($connection, $_POST["Currentstock"]);
   $SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]);
   $Rate = mysqli_real_escape_string($connection, $_POST["Rate"]);
   $ExpiryDate = mysqli_real_escape_string($connection, $_POST["ExpiryDate"]);

   $LocationCode = $_SESSION['SESS_LOCATION'];
   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = 1;
   $AddSTOItems = "";

   try {
      $AddSTOItems .= "delete from newpurchasereturnitems where invoiceno='$STOUniqueNo' and barcode='$Barcode' and 
      batchcode ='$BatchCode' and expirydate='$ExpiryDate' and mrp='$MRP';";

      $AddSTOItems .= "insert into newpurchasereturnitems (invoiceno,barcode,returnqty,shortcode,category,productname,
      mrp,discountamount,nettamount,profitamount,saledate,location,batchcode,currentstock,suppliercode,rate,expirydate) values 
	('$STOUniqueNo','$Barcode','$Qty','$Shortcode','$Category','$ProductName','$MRP','$DiscountAmount','$TotalAmount',
	'$ProfitAmount','$currentdate','$LocationCode','$BatchCode','$Currentstock','$SupplierCode','$Rate','$ExpiryDate')";

      if (mysqli_multi_query($connection, $AddSTOItems)) {

         echo "1";
      } else {
         echo "Error: " . $AddSTOItems . "" . mysqli_error($connection);
      }
   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error";
}
