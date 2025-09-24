<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["Invoice"])) {

   // echo "1";
   include("../../../connect.php");

   $currentdate = date("Y-m-d H:i:s");


   $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);
   $ProductCode = mysqli_real_escape_string($connection, $_POST["ProductCode"]);
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
   // $StockItemID = mysqli_real_escape_string($connection, $_POST["StockItemID"]);

   $LocationCode = $_SESSION['SESS_LOCATION'];
   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = 1;
   $NettAmount = $TotalAmount * $Qty;
   $SaveSaleItems = '';

   try {
      $SaveSaleItems .= "delete from newsaleitemsproduct where invoiceno='$Invoice' and productcode='$ProductCode';";

      $SaveSaleItems = "insert into newsaleitemsproduct (invoiceno,productcode,saleqty,shortcode,category,productname,
      mrp,discountamount,nettamount,profitamount,saledate,location,batchcode,currentstock,paitentcode,rate) values 
	('$Invoice','$ProductCode','$Qty','$Shortcode','$Category','$ProductName','$MRP','$DiscountAmount','$NettAmount',
	'$ProfitAmount','$SaleDate','$LocationCode','$BatchCode','$Currentstock','$PaitentCode','$Rate')";

      if (mysqli_multi_query($connection, $SaveSaleItems)) {

         echo "1";
         //echo $SaveSaleItems;
      } else {
         echo "Error: " . $SaveSaleItems . "" . mysqli_error($connection);
      }
   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error";
}
