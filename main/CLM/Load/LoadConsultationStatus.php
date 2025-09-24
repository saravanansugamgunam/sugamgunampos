<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {

  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");
  $Invoice =  mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);

  $query = mysqli_query($connection, "

  SELECT receivedamount,tokenstatus,cancelledstatus FROM consultingbillmaster WHERE consultationuniquebill ='$Invoice'");


  //   $query = mysqli_query($connection, " 
  //  SELECT  SUM(discount) AS Discount,SUM(consultationtotal) AS Total,SUM(a.consultationcharge) AS Gross FROM 
  //  `consultingdetails` AS a WHERE consultationuniquebill ='" . $Invoice . "'");

  $data = array();

  while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row['receivedamount'];
    $data[] = $row['tokenstatus'];
    $data[] = $row['cancelledstatus'];
  }

  echo json_encode($data);


  mysqli_close($connection);
}
