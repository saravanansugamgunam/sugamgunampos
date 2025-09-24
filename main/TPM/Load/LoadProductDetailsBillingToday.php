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

 $LocationCode = $_SESSION['SESS_LOCATION'];
 
$query=mysqli_query($connection, "SELECT consultationcharge FROM  consultationmaster WHERE consultationid ='".$ProductCode."';");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
     
      $data[] = $row['consultationcharge'];   
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>