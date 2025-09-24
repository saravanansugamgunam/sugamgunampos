<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Pathology"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $Pathology = mysqli_real_escape_string($connection, $_POST["Pathology"]);    
 $ID = mysqli_real_escape_string($connection, $_POST["ID"]);    
   
  $ClientID = 1;
  $userid = 1;	
   
  try {
   if($ID<>'')
   {
      $QryAddPathology = "update pathologymaster set pathology = '$Pathology' 
      where pathologyid='$ID' "; 
   }
   else
   {
      $QryAddPathology = "insert into pathologymaster (pathology) values
      ('$Pathology') "; 
   }
 
   if (mysqli_query($connection, $QryAddPathology)) {

      
      echo "1";
   } else {
      echo "Error: " . $QryAddPathology . "" . mysqli_error($connection);
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