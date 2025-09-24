<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Barcode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $Barcode = mysqli_real_escape_string($connection, $_POST["Barcode"]);
 $StockTakeID = mysqli_real_escape_string($connection, $_POST["StockTakeID"]);
 $ProductCode = mysqli_real_escape_string($connection, $_POST["ProductCode"]);
 

 $LocationCode = 3;// $_SESSION['SESS_LOCATION'];
 
 
 if($ProductCode==0)
 {
  $query=mysqli_query($connection, "select stockitemid,shortcode,productname,batchno,profit,
  currentstock,rate,category,mrp,locationcode, 
  (select count(*) FROM stocktakeitems where stocktakeuniqueno ='$StockTakeID' AND barcode ='$Barcode') AS scannedqty
   FROM newstockdetails_".$LocationCode."  where  barcode ='".$Barcode."'");
 }
 else
 {
  $query=mysqli_query($connection, "select stockitemid,shortcode,productname,batchno,profit,
currentstock,rate,category,mrp,locationcode, 
(select count(*) FROM stocktakeitems where stocktakeuniqueno ='$StockTakeID' AND barcode ='$Barcode') AS scannedqty
 FROM newstockdetails_".$LocationCode."  where productcode ='$ProductCode' and  barcode ='".$Barcode."'");
 }

	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['shortcode'];
      $data[] = $row['productname']; 
      $data[] = $row['batchno']; 
      $data[] = $row['profit'];  
      $data[] = $row['currentstock'];  
      $data[] = $row['rate'];  
      $data[] = $row['category'];  
      $data[] = $row['mrp'];  
      $data[] = $row['scannedqty'];  
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>