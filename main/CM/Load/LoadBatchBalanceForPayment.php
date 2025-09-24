<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["StudentCode"])) {


  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");
  $StudentCode = mysqli_real_escape_string($connection, $_POST["StudentCode"]);
  $BatchCode = mysqli_real_escape_string($connection, $_POST["BatchCode"]);



  $query = mysqli_query($connection, "  

SELECT 
a.studentfees - IFNULL(SUM(c.paymentamount),0) AS BalanceFee 
 FROM studentbatchmapping AS a JOIN batchmaster AS b ON a.batchcode=b.batchcode 
 LEFT JOIN paymentdetails AS c ON b.batchcode=c.batchcode AND a.studentcode=c.studentcode  
 JOIN studentmaster AS d ON a.studentcode = d.studentcode
 WHERE a.studentcode ='$StudentCode' AND a.batchcode='$BatchCode'  ");

  $data = array();

  while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row['BalanceFee'];
  }

  echo json_encode($data);


  mysqli_close($connection);
} else {
  echo "NOT";
}