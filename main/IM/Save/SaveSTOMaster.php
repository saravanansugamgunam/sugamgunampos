<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["STOUniqueNo"])) {

  // echo "1";
  include("../../../connect.php");

  $currentdate = date("Y-m-d H:i:s");


  $STOUniqueNo = mysqli_real_escape_string($connection, $_POST["STOUniqueNo"]);
  $ToLocation = mysqli_real_escape_string($connection, $_POST["ToLocation"]);
  $TotalSaleQty = mysqli_real_escape_string($connection, $_POST["TotalSaleQty"]);
  $TotalDiscountAmount = mysqli_real_escape_string($connection, $_POST["TotalDiscountAmount"]);
  $TotalProfitAmount = mysqli_real_escape_string($connection, $_POST["TotalProfitAmount"]);
  $TotalSaleAmount = mysqli_real_escape_string($connection, $_POST["TotalSaleAmount"]);

  $LocationCode = $_SESSION['SESS_LOCATION'];
  $InvoicePrefix  =   substr($LocationCode, 0, 2);
  $InvoicePrefix  =   "L" . $InvoicePrefix;
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;

  $AddBatch = '';
  try {
    $AddBatch .= "insert into stomaster (stodate,stono,stouniqueno,tolocation,stoqty,discountamount,
    nettamount,profitamount,fromlocation) values 
	('$currentdate','$InvoicePrefix','$STOUniqueNo','$ToLocation','$TotalSaleQty','$TotalDiscountAmount',
  '$TotalSaleAmount','$TotalProfitAmount','$LocationCode');";

    $AddBatch .= " 
  UPDATE    newstockdetails_" . $LocationCode . " s,  newstoitems p
SET       s.transferout = s.transferout + p.stoqty,s.currentstock=s.currentstock-p.stoqty
WHERE     s.barcode = p.barcode and 
s.mrp=p.mrp and 
s.batchno=p.batchcode and 
s.expirydate=p.expirydate  AND p.stouniqueno='$STOUniqueNo'; ";


    if (mysqli_multi_query($connection, $AddBatch)) {

      // echo "Service Requese has been registered, Request ID is " . $last_id;
      echo "1";
      // echo $SaveSaleMaster;
    } else {
      echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
    }
  } catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
} else {
  echo "Error";
}
