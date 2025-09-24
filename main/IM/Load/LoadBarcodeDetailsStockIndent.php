<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["ProductCode"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");
   $ProductCode = mysqli_real_escape_string($connection, $_POST["ProductCode"]);
   $LocationCodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);

   $GroupID = $_SESSION['SESS_GROUP_ID'];

   $LocationCode = $LocationCodeAdmin;



   $query = mysqli_query($connection, "

   SELECT b.productshortcode AS shortcode,b.productname, 
   SUM(currentstock) AS currentstock,mrp,locationcode,productcode FROM 
   newstockdetails_" . $LocationCode . "   AS a 
   JOIN productmaster AS b ON a.productcode = b.productid
   WHERE  barcode ='$ProductCode '  
   GROUP BY  productshortcode,b.productname,mrp,locationcode 
   ");


   $data = array();

   while ($row = mysqli_fetch_assoc($query)) {
      $data[] = $row['shortcode'];
      $data[] = $row['productname'];
      $data[] = '-';
      $data[] = '0';
      $data[] = $row['currentstock'];
      $data[] = 0;
      $data[] = '-';
      $data[] = $row['mrp'];
      $data[] = $row['locationcode'];
      $data[] = $row['productcode'];
   }

   echo json_encode($data);


   mysqli_close($connection);
}