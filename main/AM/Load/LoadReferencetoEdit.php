<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["RefereneCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $RefereneCode = mysqli_real_escape_string($connection, $_POST["RefereneCode"]); 
 
$query=mysqli_query($connection, "SELECT reference,medicinepercent,consultingpercent,
coursepercent,referenceid,therapypercent FROM referencemaster  WHERE referenceid ='$RefereneCode'");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['reference']; 
      $data[] = $row['medicinepercent']; 
      $data[] = $row['consultingpercent']; 
      $data[] = $row['coursepercent']; 
      $data[] = $row['referenceid']; 
      $data[] = $row['therapypercent']; 
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>