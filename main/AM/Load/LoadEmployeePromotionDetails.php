<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["StaffCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $StaffCode = mysqli_real_escape_string($connection, $_POST["StaffCode"]); 
 
$query=mysqli_query($connection, "

SELECT a.userid,a.`salary`, b.`designation`,a.`designationid` FROM usermaster AS a 
JOIN designationmaster AS b  ON a.`designationid`=b.`id` where a.userid ='".$StaffCode."' ");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    {  
      $data[] = $row['salary']; 
      $data[] = $row['designation']; 
      $data[] = $row['designationid']; 
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>