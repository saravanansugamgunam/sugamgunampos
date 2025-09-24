<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["DesignationID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $DesignationID = mysqli_real_escape_string($connection, $_POST["DesignationID"]);
 
$query=mysqli_query($connection, " SELECT id, designation,activestatus FROM designationmaster 
 WHERE id ='".$DesignationID."'");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['id'];
      $data[] = $row['designation'];
      $data[] = $row['activestatus']; 
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>