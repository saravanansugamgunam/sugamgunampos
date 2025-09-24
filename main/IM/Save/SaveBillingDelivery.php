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
   $StockItemID = mysqli_real_escape_string($connection, $_POST["StockItemID"]);

   $MRP = mysqli_real_escape_string($connection, $_POST["MRP"]);
   $DiscountAmount = mysqli_real_escape_string($connection, $_POST["DiscountAmount"]);
   $TotalAmount = mysqli_real_escape_string($connection, $_POST["TotalAmount"]);
   $ProfitAmount = mysqli_real_escape_string($connection, $_POST["ProfitAmount"]);
   $Currentstock = mysqli_real_escape_string($connection, $_POST["Currentstock"]);
   $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);
   $Rate = mysqli_real_escape_string($connection, $_POST["Rate"]);
   $SaleDate = mysqli_real_escape_string($connection, $_POST["SaleDate"]);

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
      mrp=(select mrp from newstockdetails_3 where stockitemid ='$StockItemID' ) and 
      batchcode=(select batchno from newstockdetails_3 where stockitemid ='$StockItemID' ) and 
      expirydate=(select expirydate from newstockdetails_3 where stockitemid ='$StockItemID' );";

      $AddBatch .= "insert into newsaleitems (invoiceno,barcode,saleqty,shortcode,category,productname,mrp,
      discountamount,nettamount,profitamount,saledate,location,batchcode,currentstock,paitentcode,rate,expirydate)   
      select  '$Invoice','$Barcode','$Qty',b.productshortcode,b.category,b.productname,a.mrp,'$DiscountAmount','$Qty'*a.mrp ,
      '$ProfitAmount','$SaleDate','$LocationCode',a.batchno,a.currentstock,'$PaitentCode',a.rate,a.expirydate
      FROM newstockdetails_3 AS a JOIN productmaster AS b ON a.productcode = b.productid
      WHERE a.stockitemid ='$StockItemID'  ";


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
