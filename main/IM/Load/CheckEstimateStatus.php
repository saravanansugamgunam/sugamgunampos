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
 
$query=mysqli_query($connection, " SELECT estimateclosure from  salemaster_estimate WHERE saleuniqueno ='".$Invoice."'");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['estimateclosure'];
           
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>