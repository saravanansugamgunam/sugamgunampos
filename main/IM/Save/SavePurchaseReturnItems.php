<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PurchaseReturnUniqueNo"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s");  
   
	   
 $PurchaseReturnUniqueNo = mysqli_real_escape_string($connection, $_POST["PurchaseReturnUniqueNo"]);  
 $ProductCode = mysqli_real_escape_string($connection, $_POST["ProductCode"]);
$Qty = mysqli_real_escape_string($connection, $_POST["Qty"]);   
$Shortcode = mysqli_real_escape_string($connection, $_POST["Shortcode"]);   
$Category = mysqli_real_escape_string($connection, $_POST["Category"]);   
$ProductName = mysqli_real_escape_string($connection, $_POST["ProductName"]);  
 $MRP = mysqli_real_escape_string($connection, $_POST["MRP"]);   
 $DiscountAmount = mysqli_real_escape_string($connection, $_POST["DiscountAmount"]);   
  $TotalAmount = mysqli_real_escape_string($connection, $_POST["TotalAmount"]);  
  $ProfitAmount = mysqli_real_escape_string($connection, $_POST["ProfitAmount"]);  
  $BatchCode = mysqli_real_escape_string($connection, $_POST["BatchCode"]);  
  $Currentstock = mysqli_real_escape_string($connection, $_POST["Currentstock"]);  
  $SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]);  
  $Rate = mysqli_real_escape_string($connection, $_POST["Rate"]);  
   
 $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddBatch = "insert into purchasereturnitems (purchasereturnuniqueno,itemid,returnqty,shortcode,category,
    productname,mrp,discountamount,nettamount,profitamount,returndate,fromlocation,batchcode,currentstock,
    suppliercode,rate) values 
	('$PurchaseReturnUniqueNo','$ProductCode','$Qty','$Shortcode','$Category','$ProductName','$MRP','$DiscountAmount','$TotalAmount',
	'$ProfitAmount','$currentdate','$LocationCode','$BatchCode','$Currentstock','$SupplierCode','$Rate') on duplicate key update 
	discountamount = discountamount + '$DiscountAmount',  returnqty = returnqty + '$Qty',  nettamount = nettamount + '$TotalAmount',
	profitamount = profitamount + '$ProfitAmount'"; 
   
 mysqli_query($connection, $AddBatch); 
 
 // $StockQuery ="INSERT INTO stockdetails (productcode,purchaseqty,currentstock,locationcode,batchno,expirydate,mrp) VALUES  ('$ProductCode','$Qty','$Qty','$LocationCode','$BatchNo','$Expiry','$MRP') on duplicate key update purchaseqty = purchaseqty + '$Qty' ,
       // currentstock = currentstock + '$Qty' "; 
	 
	 // mysqli_query($connection,$StockQuery);
  
  echo "1";
 //echo $AddBatch;
     
}
 catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>