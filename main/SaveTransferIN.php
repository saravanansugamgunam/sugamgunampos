<?php
session_start();
include('../connect.php');
$Invoice = $_GET['invoice'];
$fromdate=$_GET['d1'];
$todate = $_GET['d2']; 
$LocationCode = $_SESSION['SESS_LOCATION']; 
 
// header("location: Error.php");
// query
try {
	 
 $StockQuery =" INSERT INTO stock (productid,purchaseqty,salesqty,currentstock,transferin,transferout,locationcode) 
  SELECT product_code,0,0,qty,qty,0,$LocationCode FROM `transfer_order` 
   WHERE invoice ='$Invoice'  ON DUPLICATE KEY UPDATE transferin = transferin + qty ,
       currentstock = currentstock + qty;";
	   
$StockQuery .="update stocktransferoutmaster set receiptstatus	='Received' where invoice_number='$Invoice';"; 
	 
	 mysqli_multi_query($connection,$StockQuery);
	  
 header("location: TransferIN.php?d1=$fromdate&d2=$todate");
 //echo $StockQuery;
}
catch (PDOException $e) {
	  header("location: Error.php");
	 // echo ":PurchaseCode'=>$PurchaseCode,':ProductId'=>$ProductId,':CostPrice'=>$CostPrice,':Supplier'=>$Supplier,':ReceiptQty'=>$ReceiptQty,':PurchaseDate'=>$PurchaseDate,':ExpiryDate'=>$ExpiryDate,':PurchaseEntryDate'=>$PurchaseEntryDate";
 
}


 



?>