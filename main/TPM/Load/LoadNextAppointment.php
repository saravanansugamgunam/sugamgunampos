<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PaitentID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);

  
 $query=mysqli_query($connection, "
 SELECT DATE_FORMAT(nextappointment,'%d-%m-%Y') AS NextAppointmentDate 
 FROM consultingbillmaster WHERE paitentid ='$PaitentID' ORDER BY billid DESC  LIMIT 1  ");
 
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
     
      $data[] = $row['NextAppointmentDate'];  
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>