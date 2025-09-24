<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["StockItemid"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");
   $StockItemid = mysqli_real_escape_string($connection, $_POST["StockItemid"]);
   $LocationCodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);

   $GroupID = $_SESSION['SESS_GROUP_ID'];
   $LocationCode = $_SESSION['SESS_LOCATION'];

   if ($GroupID == 1) {
      $LocationCode = $LocationCodeAdmin;
   } else {
      $LocationCode = $_SESSION['SESS_LOCATION'];
   }


   //    $query = mysqli_query($connection, "SELECT stockitemid,shortcode,productname,batchno,profit,
   // currentstock,rate,category,mrp,locationcode  FROM newstockdetails_" . $LocationCode . "  WHERE barcode ='" . $Barcode . "'");



   $query = mysqli_query($connection, "SELECT  
stockitemid,shortcode,productname,batchno,profit,
SUM(currentstock) AS stock,rate,category,mrp,locationcode,expirydate 
FROM newstockdetails_" . $LocationCode . " WHERE stockitemid ='" . $StockItemid . "'  
GROUP BY stockitemid,shortcode,productname,batchno,profit,rate,category,mrp,locationcode,expirydate");



   $data = array();

   while ($row = mysqli_fetch_assoc($query)) {
      $data[] = $row['shortcode'];
      $data[] = $row['productname'];
      $data[] = $row['batchno'];
      $data[] = $row['profit'];
      $data[] = $row['stock'];
      $data[] = $row['rate'];
      $data[] = $row['category'];
      $data[] = $row['mrp'];
      $data[] = $row['locationcode'];
      $data[] = $row['expirydate'];
   }

   echo json_encode($data);


   mysqli_close($connection);
}
