<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PatientMobileNo"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $PatientMobileNo = mysqli_real_escape_string($connection, $_POST["PatientMobileNo"]);
 
$query=mysqli_query($connection, " SELECT  paitentid as Total,paitentname FROM paitentmaster 
 WHERE mobileno ='".$PatientMobileNo."'  ORDER BY 1  LIMIT 1");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['Total'];
      $data[] = $row['paitentname']; 
      
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}
