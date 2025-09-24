<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Diagnosis"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $Diagnosis = mysqli_real_escape_string($connection, $_POST["Diagnosis"]);    
 $ID = mysqli_real_escape_string($connection, $_POST["ID"]);    
   
  $ClientID = 1;
  $userid = 1;	
   
  try {
   if($ID<>'')
   {
      $QryAddDiagnosis = "update diagnosismaster set diagnosis = '$Diagnosis' 
      where diagnosisid='$ID' "; 
   }
   else
   {
      $QryAddDiagnosis = "insert into diagnosismaster (diagnosis) values
      ('$Diagnosis') "; 
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