<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["ID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $ID = mysqli_real_escape_string($connection, $_POST["ID"]);     
 $LocationCode = $_SESSION['SESS_LOCATION']; 
 $userid = $_SESSION["SESS_MEMBER_ID"];
  
  try {
   
      $QryAddSymptoms = "delete from symptomsmaster where symptomsid ='$ID'"; 
  
 
   if (mysqli_query($connection, $QryAddSymptoms)) {

      
      echo "1";
   } else {
      echo "Error: " . $QryAddSymptoms . "" . mysqli_error($connection);
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