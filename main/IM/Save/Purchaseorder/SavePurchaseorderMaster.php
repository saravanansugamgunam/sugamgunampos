<?php
include("../../../connect.php");
date_default_timezone_set("Asia/Kolkata");
session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["PurchaseorderUniqueno"])) {

  // echo "1";


  $currentdate = date("Y-m-d H:i:s");
  $PurchaseOrderDate = date("Y-m-d");

 

  $PurchaseorderUniqueno = mysqli_real_escape_string($connection, $_POST["PurchaseorderUniqueno"]);
  $PurchaseQty = mysqli_real_escape_string($connection, $_POST["PurchaseQty"]);
  $GrossAmount = mysqli_real_escape_string($connection, $_POST["GrossAmount"]);
  $GSTAmount = mysqli_real_escape_string($connection, $_POST["GSTAmount"]);
  $PurchaseNettAmount = mysqli_real_escape_string($connection, $_POST["PurchaseNettAmount"]);
  $SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]);
  $PurchaseOrderNumber = mysqli_real_escape_string($connection, $_POST["PurchaseOrderNumber"]);
  $PODate = mysqli_real_escape_string($connection, $_POST["PODate"]);
  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]); 
  $Location = mysqli_real_escape_string($connection, $_POST["Location"]);
  $BillStatus = mysqli_real_escape_string($connection, $_POST["BillStatus"]);
  $GSTType = mysqli_real_escape_string($connection, $_POST["GSTType"]); 

  if($GSTType =='INTRA STATE')
  {
    $CGSTSGST = $GSTAmount / 2;
    $IGST = 0;
  } 
  else
  {
    $CGSTSGST =0;
    $IGST = $GSTAmount;
  }
 
  $LocationCode = $Location;

  $userid = $_SESSION['SESS_MEMBER_ID'];
  // $TotalReceipt = $CashAmount + $OtherPayment;
  $PurchaseMaster = '';
  try {

    $PurchaseMaster.= "insert into purchaseordermaster (purchaseorderuniqueid,purchaseordernumber,billstatus,suppliercode,orderdate,
totalqty,grossamount,discount,gstpercent,gst,igst,cgst,sgst,nettamount,
cancelledstatus,remarks,enteredby,clientid) values 
('$PurchaseorderUniqueno','$PurchaseOrderNumber','$BillStatus','$SupplierCode','$PurchaseOrderDate',
'$PurchaseQty','$GrossAmount','0','0','$GSTAmount','$IGST','$CGSTSGST','$CGSTSGST','$PurchaseNettAmount',
'0','$Remarks','$userid','4');";
 
  

    if (mysqli_multi_query($connection, $PurchaseMaster)) {

      // echo "Service Requese has been registered, Request ID is " . $last_id;
      echo  1;
      // echo $PurchaseMaster;
    } else {
      echo "Error: " . $PurchaseMaster . "" . mysqli_error($connection);
    }
  } catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
} else {
  echo "Error";
}
