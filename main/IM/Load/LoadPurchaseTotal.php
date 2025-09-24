<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["GRNNo"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $GRNNo = mysqli_real_escape_string($connection, $_POST["GRNNo"]);


 
$query=mysqli_query($connection, "
SELECT  SUM(qty) as Qty,SUM(grossamount) as TotalAmount,
SUM(gstamount) as GST,SUM(nettamount) as NettAmount 
  FROM purchaseitemsnew  WHERE grnnumber  ='".$GRNNo."'");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['Qty'];
      $data[] = $row['TotalAmount']; 
      $data[] = $row['GST'];   
      $data[] = $row['NettAmount'];   
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>