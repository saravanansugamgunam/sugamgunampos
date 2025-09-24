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
   SELECT 
   '-',productshortcode as shortcode,b.productname,'-' AS  batchno,'0' AS profit,
   SUM(currentstock) AS currentstock,'0' AS rate,b.category,mrp,locationcode,productcode FROM 
   newstockdetails_" . $LocationCode . "   AS a 
   JOIN productmaster AS b ON a.productcode = b.productid
   WHERE CONCAT(productcode,'-',mrp) ='" . $ProductCode . "'  AND  currentstock > 0
   GROUP BY productshortcode,b.productname, b.category,mrp,locationcode,productcode   ");


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
      $data[] = $row['productcode'];
   }

   echo json_encode($data);


   mysqli_close($connection);
}
