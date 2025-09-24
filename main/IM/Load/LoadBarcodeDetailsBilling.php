<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["Barcode"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");
   $Barcode = mysqli_real_escape_string($connection, $_POST["Barcode"]);
   $LocationCodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);

   $GroupID = $_SESSION['SESS_GROUP_ID'];

   $LocationCode = $LocationCodeAdmin;


   //    $query = mysqli_query($connection, "SELECT stockitemid,shortcode,productname,batchno,profit,
   // currentstock,rate,category,mrp,locationcode  FROM newstockdetails_" . $LocationCode . "  WHERE barcode ='" . $Barcode . "'");



   $query = mysqli_query($connection, "SELECT 
(SELECT COUNT(*) FROM newstockdetails_" . $LocationCode . " 
WHERE barcode ='" . $Barcode . "' AND currentstock > 0) AS totalcount,
stockitemid,shortcode,productname,batchno,profit,
SUM(currentstock) AS stock,rate,category,mrp,locationcode,expirydate,DATEDIFF(DATE_FORMAT(CONCAT(
'20',SUBSTR(CONCAT('01/',expirydate), 7, 2),
'-',SUBSTR(CONCAT('01/',expirydate), 4, 2),
'-',SUBSTR(CONCAT('01/',expirydate), 1, 2)),'%Y-%m-%d'),CURRENT_DATE)  AS DaystoExpiry 

FROM newstockdetails_" . $LocationCode . " WHERE barcode ='" . $Barcode . "' AND currentstock > 0
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
      $data[] = $row['totalcount'];
     $data[] = $row['DaystoExpiry'];

   }

   echo json_encode($data);


   mysqli_close($connection);
}
