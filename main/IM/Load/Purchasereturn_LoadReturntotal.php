<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["STOUniqueNo"])) {

  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");
  $STOUniqueNo = mysqli_real_escape_string($connection, $_POST["STOUniqueNo"]);

  $query = mysqli_query($connection, " SELECT SUM(nettamount*returnqty) AS TotalAmount,
   SUM(profitamount) AS TotalProfit, 
SUM(returnqty) AS Qty, SUM(discountamount) AS DiscountAmount FROM newpurchasereturnitems
  WHERE invoiceno ='" . $STOUniqueNo . "'");

  $data = array();

  while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row['TotalAmount'];
    $data[] = $row['TotalProfit'];
    $data[] = $row['Qty'];
    $data[] = $row['DiscountAmount'];
  }

  echo json_encode($data);


  mysqli_close($connection);
}
