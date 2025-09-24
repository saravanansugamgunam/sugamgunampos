<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["StudentMobileNo"]))
{
  
  
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 
 $MobileNo = mysqli_real_escape_string($connection, $_POST["StudentMobileNo"]);
 
 
$query=mysqli_query($connection, "SELECT   studentname,studentgender,DATE_FORMAT(studentdob, '%d-%b-%y') as studentdob,studentcode  FROM studentmaster WHERE studentstatus='Active' AND 
 studentmobileno ='".$MobileNo."'");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['studentname'];
      $data[] = $row['studentgender'];
      $data[] = $row['studentdob'];
      $data[] = $row['studentcode'];
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

	 
}
else
	
	{
		echo "NOT";	
	}
	

?>