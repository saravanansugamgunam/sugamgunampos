<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["Barcode"])) {

  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");
  $Barcode = mysqli_real_escape_string($connection, $_POST["Barcode"]);
  $LocationCode = mysqli_real_escape_string($connection, $_POST["Location"]);



  //  $LocationCode = $_SESSION['SESS_LOCATION'];

  // $query=mysqli_query($connection, "
  // SELECT a.shortcode,a.category,a.productname,a.batchno,a.mrp,a.rate,manufacturedate,a.expirydate,1 AS purqty,0 AS purretqty,
  // ifnull(c.saleqty,0 ) as saleqty,ifnull(d.salereturn,0) as salereturn,a.currentstock FROM 
  // newstockdetails_".$LocationCode." AS a JOIN purchaseitemsnew AS b ON a.barcode=b.barcode
  // LEFT JOIN (SELECT barcode,SUM(a.saleqty) AS saleqty  FROM newsaleitems AS a JOIN salemaster AS b ON a.invoiceno=b.saleuniqueno 
  // WHERE a.transactiontype ='Sales' and b.transactiontype='Sale' GROUP BY barcode) AS c
  // ON a.barcode=c.barcode  LEFT JOIN (SELECT barcode,SUM(-a.saleqty) AS salereturn FROM newsaleitems AS a JOIN salemaster AS b ON a.invoiceno=b.saleuniqueno
  // WHERE a.transactiontype ='Return' GROUP BY barcode) AS d
  // ON a.barcode=d.barcode 
  // WHERE a.barcode ='".$Barcode."'");

  $query = mysqli_query($connection, "
SELECT a.shortcode,a.category,a.productname,a.batchno,a.mrp,a.rate,manufacturedate,a.expirydate,SUM(purchaseqty) AS purqty,0 AS purretqty,
IFNULL(c.saleqty,0 ) AS saleqty,IFNULL(d.salereturn,0) AS salereturn,
(SELECT SUM(currentstock) FROM newstockdetails_" . $LocationCode . " WHERE barcode ='" . $Barcode . "') AS currentstock  FROM 
newstockdetails_" . $LocationCode . " AS a JOIN purchaseitemsnew AS b ON 
a.barcode=b.barcode AND a.mrp=b.mrp AND a.expirydate=b.expirydate AND a.`batchno`=b.`batchno`
LEFT JOIN (SELECT barcode,SUM(a.saleqty) AS saleqty  FROM newsaleitems AS a JOIN salemaster AS b ON a.invoiceno=b.saleuniqueno 
WHERE a.transactiontype ='Sales' AND b.transactiontype='Sale' GROUP BY barcode) AS c
ON a.barcode=c.barcode  LEFT JOIN (SELECT barcode,SUM(-a.saleqty) AS salereturn FROM newsaleitems AS a JOIN salemaster AS b ON a.invoiceno=b.saleuniqueno
WHERE a.transactiontype ='Return' GROUP BY barcode) AS d
ON a.barcode=d.barcode 
WHERE a.barcode ='" . $Barcode . "'");



  $data = array();

  while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row['shortcode'];
    $data[] = $row['category'];
    $data[] = $row['productname'];
    $data[] = $row['batchno'];
    $data[] = $row['mrp'];
    $data[] = $row['rate'];
    $data[] = $row['manufacturedate'];
    $data[] = $row['expirydate'];
    $data[] = $row['purqty'];
    $data[] = $row['purretqty'];
    $data[] = $row['saleqty'];
    $data[] = $row['salereturn'];
    $data[] = $row['currentstock'];
  }

  echo json_encode($data);


  mysqli_close($connection);
}
