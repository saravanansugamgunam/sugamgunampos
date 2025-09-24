<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["ProductCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $ProductCode = mysqli_real_escape_string($connection, $_POST["ProductCode"]);


 
$query=mysqli_query($connection, "

SELECT category,productshortcode,productname,IFNULL(b.mrp,0) AS mrp FROM  productmaster AS a
LEFT JOIN `purchaseitems` AS b ON productid=productcode WHERE productid ='".$ProductCode."'  ORDER BY purchaseid DESC LIMIT 1"
);
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['category'];
      $data[] = $row['mrp']; 
      $data[] = $row['productshortcode']; 
      $data[] = $row['productname'];  
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>