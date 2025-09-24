<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Profession"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $Profession = mysqli_real_escape_string($connection, $_POST["Profession"]);    
 $ID = mysqli_real_escape_string($connection, $_POST["ID"]);    
   
  $ClientID = 1;
  $userid = 1;	
   
  try {
   if($ID<>'')
   {
      $QryAddDiet = "update professionalmaster set profession = '$Profession' 
      where id='$ID' "; 
   }
   else
   {
      $QryAddDiet = "insert into professionalmaster (profession) values
      ('$Profession') "; 
   }
 
   if (mysqli_query($connection, $QryAddDiet)) {

      
      echo "1";
   } else {
      echo "Error: " . $QryAddDiet . "" . mysqli_error($connection);
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