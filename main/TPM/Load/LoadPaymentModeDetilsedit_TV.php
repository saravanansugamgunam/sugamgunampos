<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["PaymentID"])) {

  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");
  $PaymentID = mysqli_real_escape_string($connection, $_POST["PaymentID"]);

  $query = mysqli_query($connection, "
SELECT concat(DATE_FORMAT(DATE,'%d-%m-%Y'),' - ',b.paymentmode, ' - ',a.amount) as Id FROM salepaymentdetails AS a JOIN 
paymentmodemaster AS b ON a.paymentmode=b.paymentmodecode 
WHERE paymentid='$PaymentID' ");

  $data = array();

  while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row['Id'];
  }

  echo json_encode($data);


  mysqli_close($connection);
}
