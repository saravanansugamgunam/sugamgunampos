<?php
session_start();
include('../connect.php');
$ProductId = $_POST['txtProductId'];
$PurchaseCode = $_POST['txtPurchaseCode'];
 
$PurchaseDate = $_POST['date_arrival'];
$CostPrice = $_POST['txtCostPrice'];
 
$Supplier = $_POST['txtSupplier'];
$ReceiptQty = $_POST['txtReceiptQty'];
$ExpiryDate = $_POST['date_arrival'];
$PurchaseEntryDate =   date('Y-m-d');
$LocationCode = $_SESSION['SESS_LOCATION'];
// header("location: Error.php");
// query
try {
	
	
	$sql = "INSERT INTO products (purchasecode,product_id,cost,supplier,qty,purchasedate,expiry_date,purchaseentrydate) VALUES (:PurchaseCode,:ProductId,:CostPrice,:Supplier,:ReceiptQty,:PurchaseDate,:ExpiryDate,:PurchaseEntryDate)";
$q = $db->prepare($sql);
$q->execute(array(':PurchaseCode'=>$PurchaseCode,':ProductId'=>$ProductId,':CostPrice'=>$CostPrice,':Supplier'=>$Supplier,':ReceiptQty'=>$ReceiptQty,':PurchaseDate'=>$PurchaseDate,':ExpiryDate'=>$ExpiryDate,':PurchaseEntryDate'=>$PurchaseEntryDate));
 
 
 $StockQuery ="INSERT INTO stock (productid,purchaseqty,currentstock,locationcode) VALUES  ('$ProductId','$ReceiptQty','$ReceiptQty','$LocationCode') on duplicate key update purchaseqty = purchaseqty + '$ReceiptQty' ,
       currentstock = currentstock + '$ReceiptQty' "; 
	 
	 mysqli_query($connection,$StockQuery);
	
	 // on duplicate key update
     // currentstock = currentstock + '$ReceiptQty';
	
// $sql2 = "INSERT INTO stock (productid,costprice,sellingprice,purchaseqty,currentstock) VALUES 
// (:ProductId,:CostPrice,:MRP,:ReceiptQty,:ReceiptQty ) on duplicate key update currentstock=currentstock+ ? ";

// $StockQuery = $db->prepare($sql2);
// $StockQuery->execute(array(':ProductId'=>$ProductId,':CostPrice'=>$,':MRP'=>$,':ReceiptQty'=>$,':ReceiptQty'=>$ReceiptQty ));



  header("location: products.php");
// echo $StockQuery;
}
catch (PDOException $e) {
	  header("location: Error.php");
	 // echo ":PurchaseCode'=>$PurchaseCode,':ProductId'=>$ProductId,':CostPrice'=>$CostPrice,':Supplier'=>$Supplier,':ReceiptQty'=>$ReceiptQty,':PurchaseDate'=>$PurchaseDate,':ExpiryDate'=>$ExpiryDate,':PurchaseEntryDate'=>$PurchaseEntryDate";
 
}


 



?>