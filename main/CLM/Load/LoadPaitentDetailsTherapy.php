<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PaitentCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);

  
 $query=mysqli_query($connection, "
 SELECT a.paitentid, paitentname,topay-receipt AS Balance,COUNT(b.orderid) AS TotalOrders
FROM paitentmaster AS a LEFT JOIN paitientorder AS b ON a.paitentid = b.paitentid AND 
b.orderstatus in('Open','Purchased')
  WHERE a.paitentid ='".$PaitentCode."'");
 
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
     
      $data[] = $row['paitentname']; 
	   $data[] = $row['paitentid']; 
	    $data[] = $row['Balance']; 
	    $data[] = $row['TotalOrders']; 
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>