<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["StockTakeID"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d");  
    
   $StockTakeID = mysqli_real_escape_string($connection, $_POST["StockTakeID"]);  
   $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);
   $CurrentStock = mysqli_real_escape_string($connection, $_POST["CurrentStock"]);
   $CloedStatus = mysqli_real_escape_string($connection, $_POST["CloedStatus"]);
   $LocationCode = mysqli_real_escape_string($connection, $_POST["LocationCode"]);
   
  
   $StockTableName = 'newstockdetails_'; 
   $NewStockTable = $StockTableName.$LocationCode;

   
   
    // $LocationCode = $_SESSION['SESS_LOCATION'];
   // $ClientID = $_SESSION["SESS_MEMBER_ID"];
   $userid = $_SESSION["SESS_MEMBER_ID"];
   $ClientID = 1;
   // $userid = 1;	

   try {
      if($CloedStatus==1)
      {
         $AddBatch = " "; 
      }
      else
      {
         $AddBatch = "update stocktakearea set closedstatus='1',stocktakeclosureremarks='$Remarks',
         closedon='$currentdate',currentstock='$CurrentStock' where id ='$StockTakeID'; "; 

         
         $AddBatch.= "INSERT INTO stocktakeitems (stocktakeuniqueno,barcode,scanqty,shortcode,category,productname,mrp,discountamount,
                     nettamount,fromlocation,batchcode,currentstock,rate,profitamount,barcodestatus)
                     
                     SELECT $StockTakeID,barcode,0,shortcode,category,productname,mrp,0,mrp,locationcode,batchno,
                     currentstock,rate,profit,'Missing Stock' FROM $NewStockTable WHERE currentstock> 0 
                     AND barcode NOT IN 
                     (SELECT barcode FROM stocktakeitems WHERE stocktakeuniqueno ='$StockTakeID') and 
                     productcode in (SELECT productcode FROM stocktakearea WHERE id ='$StockTakeID')
                     ;";
      }
   

   
	if (mysqli_multi_query($connection, $AddBatch)) {
 
      echo  1;
   //  echo $AddBatch;
      } else {
      echo "Error: " . $AddBatch . "" . mysqli_error($connection);
      } 
 
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>