<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["StockTakeID"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s");  
   

   $StockTakeID = mysqli_real_escape_string($connection, $_POST["StockTakeID"]);  
   $Barcode = mysqli_real_escape_string($connection, $_POST["Barcode"]);
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
   $Rate = mysqli_real_escape_string($connection, $_POST["Rate"]);  

   $LocationCode = $_SESSION['SESS_LOCATION'];
   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = 1;	

   try {
      if($Rate>0)
      {
         $BarcodeStatus = 'Valid';
      }
      else
      {
         $BarcodeStatus = 'Invalid';
      }
   $AddBatch = "insert into stocktakeitems (stocktakeuniqueno,barcode,scanqty,shortcode,category,productname,mrp,discountamount,
   nettamount,profitamount,stocktakedate,fromlocation,batchcode,currentstock,rate,barcodestatus) values 
   ('$StockTakeID','$Barcode','$Qty','$Shortcode','$Category','$ProductName','$MRP','$DiscountAmount','$TotalAmount',
   '$ProfitAmount','$currentdate','$LocationCode','$BatchCode','$Currentstock','$Rate','$BarcodeStatus')"; 

   mysqli_query($connection, $AddBatch); 
   echo "1";
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>