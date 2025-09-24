<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["STOID"])) {

  // echo "1";
  include("../../../connect.php");

  $currentdate = date("Y-m-d");


  $STOID = mysqli_real_escape_string($connection, $_POST["STOID"]);
  $STOFROMID = mysqli_real_escape_string($connection, $_POST["STOFROMID"]);

  $LocationCode = $_SESSION['SESS_LOCATION'];
  $InvoicePrefix  =   substr($LocationCode, 0, 2);
  $InvoicePrefix  =   "L" . $InvoicePrefix;
  $FromStockDetails  =   "newstockdetails_" . $STOFROMID;
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;

  try {
    $AddBatch = "
	
 INSERT INTO newstockdetails_" . $LocationCode . " (productcode,purchaseqty,salesqty,currentstock,transferin,transferout,
 locationcode,batchno,
expirydate,mrp,stockadjadd,stockadjminus,purchasereturn,salereturn,productname,category,shortcode,profit,rate,barcode,grnnumber)   
  SELECT productcode,0,0,stoqty,stoqty,0,$LocationCode,batchno,
a.expirydate,a.mrp,0,0,0,0,a.productname,a.category,a.shortcode,a.profit,a.rate,a.barcode,a.grnnumber
FROM " . $FromStockDetails . " AS a JOIN newstoitems AS b ON 
a.barcode=b.barcode and 
a.mrp=b.mrp and 
a.batchno=b.batchcode and 
a.expirydate=b.expirydate
 
 WHERE   stouniqueno ='$STOID' 
 ON DUPLICATE KEY UPDATE newstockdetails_" . $LocationCode . ".transferin = newstockdetails_" . $LocationCode . ".transferin + stoqty ,
newstockdetails_" . $LocationCode . ".currentstock = newstockdetails_" . $LocationCode . ".currentstock + stoqty    ";

    mysqli_query($connection, $AddBatch);

    $StockQuery = " 
  UPDATE  stomaster set receiptstatus='Received',receiptdate='$currentdate' WHERE   stouniqueno='$STOID' ";

    mysqli_query($connection, $StockQuery);

    // echo $AddBatch;
    echo "Added Successfuly";
  } catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
} else {
  echo "Error";
}
