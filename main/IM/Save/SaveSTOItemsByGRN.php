<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["STOUniqueNo"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s");  
    
 $STOUniqueNo = mysqli_real_escape_string($connection, $_POST["STOUniqueNo"]);  
 $GRN = mysqli_real_escape_string($connection, $_POST["GRN"]); 
  $ToLocation = mysqli_real_escape_string($connection, $_POST["ToLocation"]);   
   
 $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddBatch = " INSERT INTO newstoitems (stouniqueno,barcode,stoqty,shortcode,category,productname,mrp,discountamount,nettamount,
    profitamount,stodate,fromlocation,batchcode,currentstock,tolocation,rate)   

    SELECT '$STOUniqueNo',a.`barcode`,1,b.productshortcode, b.category,b.productname,a.mrp,0,a.`rate`,a.`profit`,'$currentdate',
'$LocationCode',a.batchno,1,'$ToLocation',a.`rate` 
 FROM purchaseitemsnew AS a JOIN 
productmaster AS b ON a.productcode=b.productid 
JOIN newstockdetails_$LocationCode AS c ON a.barcode=c.barcode WHERE a.grnnumber IN(
'$GRN') AND c.currentstock > 0 "; 
   
 mysqli_query($connection, $AddBatch); 
 
 // $StockQuery ="INSERT INTO stockdetails (productcode,purchaseqty,currentstock,locationcode,batchno,expirydate,mrp) VALUES  ('$ProductCode','$Qty','$Qty','$LocationCode','$BatchNo','$Expiry','$MRP') on duplicate key update purchaseqty = purchaseqty + '$Qty' ,
       // currentstock = currentstock + '$Qty' "; 
	 
	 // mysqli_query($connection,$StockQuery);
  
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