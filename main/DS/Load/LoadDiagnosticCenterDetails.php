<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["CenterID"]))
{
    
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $CenterID = mysqli_real_escape_string($connection, $_POST["CenterID"]); 
 
$query=mysqli_query($connection, "
SELECT centerid,centername,contactno,pincode address,center_citycode,
center_statecode,pincode,contactno,emailid,contactperson,
activestatus,addedon,addedby FROM diagnosticcentre WHERE
centerid ='$CenterID' ;");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['centerid'];  
      $data[] = $row['centername'];  
      $data[] = $row['address'];  
      $data[] = $row['center_citycode'];  
      $data[] = $row['center_statecode'];  
      $data[] = $row['pincode'];  
      $data[] = $row['contactno'];  
      $data[] = $row['emailid'];  
      $data[] = $row['contactperson'];  
      $data[] = $row['activestatus'];  
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}