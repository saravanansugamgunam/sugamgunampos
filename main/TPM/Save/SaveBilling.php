<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Invoice"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s");  
   
	   
 $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);  
 $ProductCode = mysqli_real_escape_string($connection, $_POST["ProductCode"]);
 
$ProductName = mysqli_real_escape_string($connection, $_POST["ProductName"]);  
 $MRP = mysqli_real_escape_string($connection, $_POST["MRP"]);   
 $DiscountAmount = mysqli_real_escape_string($connection, $_POST["DiscountAmount"]);   
  $TotalAmount = mysqli_real_escape_string($connection, $_POST["TotalAmount"]);  
  $ProfitAmount = mysqli_real_escape_string($connection, $_POST["ProfitAmount"]);  
  $BatchCode = mysqli_real_escape_string($connection, $_POST["BatchCode"]);  
  $Currentstock = mysqli_real_escape_string($connection, $_POST["Currentstock"]);  
  $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);  
  $Rate = mysqli_real_escape_string($connection, $_POST["Rate"]);  
  $SaleDate = mysqli_real_escape_string($connection, $_POST["SaleDate"]);  
   
 $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
  
  try {
    $AddBatch = "insert into consultingdetails (consultationuniquebill,consultationid,consultationname,consultationcharge,discount,doctorid,paitentid,consultationtotal,clientid,addedby) values 
	('$Invoice','$ProductCode','$ProductName','$MRP','$DiscountAmount','1','$PaitentCode','$TotalAmount','$LocationCode',
	'$userid')"; 
  
 mysqli_query($connection, $AddBatch); 
 
 // $StockQuery ="INSERT INTO stockdetails (productcode,purchaseqty,currentstock,locationcode,batchno,expirydate,mrp) VALUES  ('$ProductCode','$Qty','$Qty','$LocationCode','$BatchNo','$Expiry','$MRP') on duplicate key update purchaseqty = purchaseqty + '$Qty' ,
       // currentstock = currentstock + '$Qty' "; 
	 
	 // mysqli_query($connection,$StockQuery);
  
  echo "1";
 //echo  $AddBatch;
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>