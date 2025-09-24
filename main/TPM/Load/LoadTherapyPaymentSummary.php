<?php
  
session_cache_limiter(FALSE); 
session_start();
  
//insert.php
if(isset($_POST["SupplierCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]);

  
 $query=mysqli_query($connection, "
 SELECT topay-paid as Outstanding FROM supliers WHERE suplier_id ='".$SupplierCode."'");
 
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
     
      $data[] = $row['Outstanding'];  
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>