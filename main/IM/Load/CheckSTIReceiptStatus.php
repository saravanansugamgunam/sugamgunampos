<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["STOID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $STOID = mysqli_real_escape_string($connection, $_POST["STOID"]);
 
$query=mysqli_query($connection, "
SELECT COUNT(*) as TotalCount FROM stomaster  WHERE stouniqueno ='".$STOID."' AND receiptstatus ='Received'");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['TotalCount'];
           
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>