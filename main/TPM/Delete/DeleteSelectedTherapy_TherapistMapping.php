<?php
  
session_cache_limiter(FALSE);
session_start();
   $LocationCode = $_SESSION['SESS_LOCATION'];
//insert.php
if(isset($_POST["userid"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $UserID = mysqli_real_escape_string($connection, strtoupper($_POST["userid"]));    
 $TherapyID = mysqli_real_escape_string($connection, strtoupper($_POST["TherapyID"]));    
   
  try {
    $AddPaymentMode = "delete from therapytherapistmapping where therapyid='$TherapyID' 
    and therapistid='$UserID'  "; 
  
    
    if(mysqli_multi_query($connection, $AddPaymentMode)){
      echo 1;
     } else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
    
     }

 
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>