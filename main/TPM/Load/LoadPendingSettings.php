<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["BookingID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $BookingID = mysqli_real_escape_string($connection, $_POST["BookingID"]);
 
$query=mysqli_query($connection, " 
 
 SELECT COUNT(DISTINCT sitingid) as BalanceSitting,MIN(sitingid) AS SittingID 
  FROM `therapybookingdetails` WHERE bookinguniqueid ='$BookingID' AND STATUS =0 ");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    {  
      $data[] = $row['BalanceSitting'] ;   
      $data[] = $row['SittingID'] ; 
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>