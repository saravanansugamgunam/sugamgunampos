<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["StockItemID"]))
{ 
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $StockItemID = mysqli_real_escape_string($connection, $_POST["StockItemID"]);

 $LocationCode = $_SESSION['SESS_LOCATION'];
 
$query=mysqli_query($connection, " SELECT productid,productshortcode,productname,'-' AS batchno,'0' AS profit,
 '0' AS currentstock,'0' AS rate,category,'0' AS mrp,'0'  AS locationcode
 FROM productmaster   WHERE productid ='".$StockItemID."'");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['productshortcode'];
      $data[] = $row['productname']; 
      $data[] = $row['batchno']; 
      $data[] = $row['profit'];  
      $data[] = $row['currentstock'];  
      $data[] = $row['rate'];  
      $data[] = $row['category'];  
      $data[] = $row['mrp'];  
      $data[] = $row['locationcode'];  
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>