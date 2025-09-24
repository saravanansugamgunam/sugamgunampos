<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["userid"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $userid = mysqli_real_escape_string($connection, $_POST["userid"]);

  
 $query=mysqli_query($connection, "
 
 SELECT username,emailid,mobileno
FROM usermaster WHERE designationid='9' and  userid ='".$userid."'");
 
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
     
      $data[] = $row['username']; 
	   $data[] = $row['emailid']; 
	    $data[] = $row['mobileno'];  
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>