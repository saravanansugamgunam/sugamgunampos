<?php
 
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["EnquiryType"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $EnquiryType = mysqli_real_escape_string($connection, $_POST["EnquiryType"]);

 
// $query=mysqli_query($connection, "
// SELECT GROUP_CONCAT(mobileno) as Mobile FROM paitentmaster"
// );


$query=mysqli_query($connection, "
SELECT GROUP_CONCAT(mobileno) AS Mobile  FROM enquirydetails WHERE enquiredbyid like '$EnquiryType'"
);
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['Mobile'];
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>