<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["ConceptID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $ConceptID = mysqli_real_escape_string($connection, $_POST["ConceptID"]);    
 $DiseaseID = mysqli_real_escape_string($connection, $_POST["DiseaseID"]);     
 $ConceptName = mysqli_real_escape_string($connection, $_POST["ConceptName"]);     
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];
   
  try {
   if($DiseaseID<>'')
   { 
      $QryAddDiagnosis = "insert into diseasemapping (diseaseid,conceptid,conceptname,addedby) values
      ('$DiseaseID','$ConceptID','$ConceptName','$userid') "; 
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