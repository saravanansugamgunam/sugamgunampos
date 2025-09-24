<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["Barcode"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");
   $Barcode = mysqli_real_escape_string($connection, $_POST["Barcode"]);
   $SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]);
   $LocationCodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);

   $GroupID = $_SESSION['SESS_GROUP_ID'];

   $LocationCode = 4;



   //    $query = mysqli_query($connection, "
   // SELECT stockitemid,shortcode,productname,a.batchno,a.profit,currentstock,
   // b.rate,category,b.mrp,locationcode  FROM newstockdetails_" . $LocationCode . " AS a JOIN purchaseitemsnew   AS b
   // ON a.barcode=b.barcode  WHERE b.suppliercode='" . $SupplierCode . "' AND b.barcode ='" . $Barcode . "'");

   $query = mysqli_query($connection, "SELECT 
(SELECT COUNT(*) FROM newstockdetails_" . $LocationCode . " WHERE barcode ='" . $Barcode . "') AS totalcount,
stockitemid,shortcode,productname,a.batchno,a.profit,
SUM(currentstock) AS currentstock,a.rate,a.category,a.mrp,a.locationcode,a.expirydate 
FROM newstockdetails_" . $LocationCode . "  AS a JOIN purchaseitemsnew   AS b
ON a.barcode=b.barcode  WHERE a.barcode ='" . $Barcode . "' AND currentstock > 0 and b.suppliercode='" . $SupplierCode . "'
GROUP BY stockitemid,shortcode,productname,a.batchno,a.profit,a.rate,a.category,a.mrp,a.locationcode,a.expirydate");



   $data = array();

   while ($row = mysqli_fetch_assoc($query)) {
      $data[] = $row['shortcode'];
      $data[] = $row['productname'];
      $data[] = $row['batchno'];
      $data[] = $row['profit'];
      $data[] = $row['currentstock'];
      $data[] = $row['rate'];
      $data[] = $row['category'];
      $data[] = $row['mrp'];
      $data[] = $row['locationcode'];
      $data[] = $row['expirydate'];
      $data[] = $row['totalcount'];
   }

   echo json_encode($data);


   mysqli_close($connection);
}
