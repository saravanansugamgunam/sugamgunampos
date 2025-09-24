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
 
$query=mysqli_query($connection, "SELECT productcode FROM  stocktakearea WHERE id ='$StockTakeID'");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['productcode'];
      
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>