<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["AlternateMedicine"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $AlternateMedicine = mysqli_real_escape_string($connection, $_POST["AlternateMedicine"]);    
 $SelectedMedicine = mysqli_real_escape_string($connection, $_POST["SelectedMedicine"]);    
 $LocationCode = $_SESSION['SESS_LOCATION']; 
 $userid = $_SESSION["SESS_MEMBER_ID"];
   

  try {
   
      $QryAddSymptoms = "insert into alternate_medicines (parentbarcode,alternatebarcode) values
      ('$SelectedMedicine','$AlternateMedicine') "; 
  
 
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