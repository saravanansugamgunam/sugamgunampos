<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["StocktakeID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $StocktakeID = mysqli_real_escape_string($connection, $_POST["StocktakeID"]);  
 $StockTakeStatus = mysqli_real_escape_string($connection, $_POST["StockTakeStatus"]); 
 $LocationCode = mysqli_real_escape_string($connection, $_POST["LocationCode"]); 
 $ProductCode = mysqli_real_escape_string($connection, $_POST["ProductCode"]); 
 
 if($ProductCode==0)
 {
  $ProductCode =' ';
  }
  else
  {
    $ProductCode=" productcode ='$ProductCode'  ";
    }
 
 $StockTableName = 'newstockdetails_'; 
 $NewStockTable = $StockTableName.$LocationCode;

 
 if($StockTakeStatus==0)
 {
  $query=mysqli_query($connection, "
 
  SELECT DATE_FORMAT(createdon,'%d-%m-%Y') createdon,id,c.username,
  IFNULL(d.scanqty,0) AS Scannqty,
  (SELECT SUM(currentstock) AS TotalStock FROM $NewStockTable where $ProductCode ) as TotalStock,
  stocktakeclosureremarks,closedstatus,a.stocktakelocation FROM  stocktakearea AS a 
  JOIN locationmaster AS b ON a.stocktakelocation = b.locationcode
  JOIN usermaster AS c ON a.incharge=c.userid
  LEFT JOIN (SELECT stocktakeuniqueno,SUM(scanqty) AS scanqty FROM stocktakeitems  where barcodestatus='Valid'
  GROUP BY stocktakeuniqueno ) AS d ON a.id=d.stocktakeuniqueno 
  WHERE a.id='$StocktakeID'");
 }
 else
 {
  $query=mysqli_query($connection, "
 
  SELECT DATE_FORMAT(createdon,'%d-%m-%Y') createdon,id,c.username,
  IFNULL(d.scanqty,0) AS Scannqty,sum(currentstock) as TotalStock,
  stocktakeclosureremarks,closedstatus,a.stocktakelocation FROM  stocktakearea AS a 
  JOIN locationmaster AS b ON a.stocktakelocation = b.locationcode
  JOIN usermaster AS c ON a.incharge=c.userid
  LEFT JOIN (SELECT stocktakeuniqueno,SUM(scanqty) AS scanqty FROM stocktakeitems   where barcodestatus='Valid'
  GROUP BY stocktakeuniqueno ) AS d ON a.id=d.stocktakeuniqueno 
  WHERE a.id='$StocktakeID'");
 }

	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['id'];
      $data[] = $row['createdon']; 
      $data[] = $row['username'];
      $data[] = $row['Scannqty'];
      $data[] = $row['TotalStock']; 
      $data[] = $row['TotalStock']-$row['Scannqty']; 
      $data[] = $row['stocktakeclosureremarks'];
      $data[] = $row['closedstatus']; 
  
     
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>