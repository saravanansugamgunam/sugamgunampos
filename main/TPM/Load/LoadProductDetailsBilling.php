<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["ProductCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $ProductCode = mysqli_real_escape_string($connection, $_POST["ProductCode"]);
 $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);

 $LocationCode = $_SESSION['SESS_LOCATION'];
 
$query=mysqli_query($connection, "
SELECT 
(SELECT consultationcharge FROM  consultationmaster WHERE consultationid ='".$ProductCode."') AS MRP,
(SELECT IFNULL(MAX(sitingid),0)+1 FROM therapybookingdetails WHERE bookinguniqueid='".$Invoice."' AND therapyid='".$ProductCode."' ) AS Sittingid ");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
     
      $data[] = $row['MRP'];  
      $data[] = $row['Sittingid'];  
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>