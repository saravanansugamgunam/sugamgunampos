<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["DiseaseID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	     
 $DiseaseID = mysqli_real_escape_string($connection, $_POST["DiseaseID"]);     
 $Diet = mysqli_real_escape_string($connection, $_POST["Diet"]);     
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];
   
  try {
   if($DiseaseID<>'')
   { 
      $QryAddDiagnosis = "insert into diseasedietmapping (diseaseid,dietdetails,addedby) values
      ('$DiseaseID','$Diet','$userid') ON DUPLICATE KEY UPDATE 
      dietdetails='$Diet'"; 
   }
 
   if (mysqli_query($connection, $QryAddDiagnosis)) {

      
      echo "1";
   } else {
      echo "Error: " . $QryAddDiagnosis . "" . mysqli_error($connection);
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