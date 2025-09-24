<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Disease"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $Disease = mysqli_real_escape_string($connection, $_POST["Disease"]);    
 $ID = mysqli_real_escape_string($connection, $_POST["ID"]);    
   
  $ClientID = 1;
  $userid = 1;	
   
  try {
   if($ID<>'')
   {
      $QryAddDiseases = "update diseasemaster set disease = '$Disease' where diseaseid='$ID' "; 
   }
   else
   {
      $QryAddDiseases = "insert into diseasemaster (disease) values
      ('$Disease') "; 
   }
 
   if (mysqli_query($connection, $QryAddDiseases)) {

      
      echo "1";
   } else {
      echo "Error: " . $QryAddDiseases . "" . mysqli_error($connection);
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