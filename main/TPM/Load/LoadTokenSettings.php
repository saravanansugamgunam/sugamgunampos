<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
 
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							   


 
$query=mysqli_query($connection, "

SELECT tokendisplayroom1,tokendisplayroom2,paitentnamedisplay FROM  tokensettings"
);
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['tokendisplayroom1'];
      $data[] = $row['tokendisplayroom2']; 
      $data[] = $row['paitentnamedisplay'];   
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);
 

?>