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
 
$query=mysqli_query($connection, " SELECT
  round(SUM(nettamount),0)  AS TotalAmount, 
SUM(profitamount) AS TotalProfit, 
 SUM(saleqty)  AS Qty, SUM(discountamount) AS DiscountAmount FROM newstockindentitems
  WHERE invoiceno ='".$Invoice."'");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['TotalAmount'];
      $data[] = $row['TotalProfit'];
      $data[] = $row['Qty'];
      $data[] = $row['DiscountAmount'];
     
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>