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
 
SELECT CONCAT('Coimpleted ',SUM(STATUS),' out of ',COUNT(*) ) as TotalSittting FROM therapybookingdetails 
WHERE bookinguniqueid ='$BookingID'");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    {  
      $data[] = $row['TotalSittting'] ;   
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>