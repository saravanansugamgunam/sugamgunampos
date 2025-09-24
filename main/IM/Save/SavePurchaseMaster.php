<?php
include("../../../connect.php");
date_default_timezone_set("Asia/Kolkata");
session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["GRNNo"])) {

  // echo "1";


  $currentdate = date("Y-m-d H:i:s");
  $PurchaseDate = date("Y-m-d");


  $GRNNo = mysqli_real_escape_string($connection, $_POST["GRNNo"]);
  $PurchaseQty = mysqli_real_escape_string($connection, $_POST["PurchaseQty"]);
  $GrossAmount = mysqli_real_escape_string($connection, $_POST["GrossAmount"]);
  $GSTAmount = mysqli_real_escape_string($connection, $_POST["GSTAmount"]);
  $PurchaseNettAmount = mysqli_real_escape_string($connection, $_POST["PurchaseNettAmount"]);
  $SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]);
  $SupplierInvoice = mysqli_real_escape_string($connection, $_POST["SupplierInvoice"]);
  $SupplierInvoiceDate = mysqli_real_escape_string($connection, $_POST["SupplierInvoiceDate"]);
  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);
  $ReceiptDate = mysqli_real_escape_string($connection, $_POST["ReceiptDate"]);
  $Location = mysqli_real_escape_string($connection, $_POST["Location"]);
  $BillStatus = mysqli_real_escape_string($connection, $_POST["BillStatus"]);

  $CGSTSGST = $GSTAmount / 2;
  $LocationCode = $Location;

  $userid = $_SESSION['SESS_MEMBER_ID'];
  // $TotalReceipt = $CashAmount + $OtherPayment;
  $PurchaseMaster = '';
  try {

    $PurchaseMaster .= "insert into purchasemaster (purchasegrn,billstatus,suppliercode,purchasedate,invoicedate,
invoiceno,totalqty,grossamount,discount,gst,igst,cgst,sgst,nettamount,cancelledstatus,remarks,enteredby,clientid) values 
('$GRNNo','$BillStatus','$SupplierCode','$PurchaseDate','$SupplierInvoiceDate','$SupplierInvoice','$PurchaseQty',
'$GrossAmount','0','$GSTAmount','0','$CGSTSGST','$CGSTSGST','$PurchaseNettAmount','0','$Remarks',
'$userid','4');";

    $PurchaseMaster .= "INSERT INTO newstockdetails_4(productcode,purchaseqty,currentstock,
locationcode,batchno,expirydate,mrp,productname,category,shortcode,profit,rate,barcode,grnnumber,gstpercentage)   
SELECT productcode,qty,qty,'4',batchno,expirydate,mrp,b.productname,b.category,b.productshortcode, 
profit,rate,barcode,'$GRNNo',b.gstpercentage 
FROM purchaseitemsnew AS a JOIN productmaster AS b ON a.productcode=b.productid WHERE grnnumber ='$GRNNo' 
ON DUPLICATE KEY UPDATE currentstock = currentstock  + qty
  ;";


    //   $PurchaseMaster.= "  UPDATE newstockdetails_3  AS T1,
    //   (SELECT productcode,mrp FROM purchaseitemsnew WHERE grnnumber ='$GRNNo' GROUP BY productcode,mrp) AS T2 
    //   SET T1.mrp = T2.mrp 
    //   WHERE T1.productcode = T2.productcode AND T1.mrp < T2.mrp   
    //   and  T1.productcode not in (select productid from productmaster where ismrp=1) 
    //   AND currentstock > 0;";

    // $PurchaseMaster.= "  UPDATE newstockdetails_4  AS T1,
    // (SELECT productcode,mrp FROM purchaseitemsnew WHERE grnnumber ='$GRNNo' GROUP BY productcode,mrp) AS T2 
    // SET T1.mrp = T2.mrp 
    // WHERE T1.productcode = T2.productcode AND T1.mrp < T2.mrp   
    // and  T1.productcode not in (select productid from productmaster where ismrp=1) 
    // AND currentstock > 0;";


    $PurchaseMaster .= " update supliers set topay=topay+'$PurchaseNettAmount'  where suplier_id='$SupplierCode';";




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
