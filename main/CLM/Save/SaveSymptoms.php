<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Symptoms"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $Symptoms = mysqli_real_escape_string($connection, $_POST["Symptoms"]);    
 $ID = mysqli_real_escape_string($connection, $_POST["ID"]);    
   
  $ClientID = 1;
  $userid = 1;	
   
  try {
   if($ID<>'')
   {
      $QryAddSymptoms = "update symptomsmaster set symptoms = '$Symptoms' where symptomsid='$ID' "; 
   }
   else
   {
      $QryAddSymptoms = "insert into symptomsmaster (symptoms) values
      ('$Symptoms') "; 
   }
 
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