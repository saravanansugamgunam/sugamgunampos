<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Tag"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $TagName = mysqli_real_escape_string($connection, $_POST["Tag"]);    
 $ID = mysqli_real_escape_string($connection, $_POST["ID"]);    
   
  $ClientID = 1;
  $userid = 1;	
   
  try {
   if($ID<>'')
   {
      $QryAddDiet = "update taglistmaster set tagname = '$TagName' 
      where id='$ID' "; 
   }
   else
   {
      $QryAddDiet = "insert into taglistmaster (tagname) values
      ('$TagName') "; 
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