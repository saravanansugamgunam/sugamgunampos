<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Acupuncture"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $Acupuncture = mysqli_real_escape_string($connection, $_POST["Acupuncture"]);    
 $ID = mysqli_real_escape_string($connection, $_POST["ID"]);    
   
  $ClientID = 1;
  $userid = 1;	
   
  try {
   if($ID<>'')
   {
      $QryAddAcupuncture = "update acupuncturepoints set acupoints = '$Acupuncture' 
      where acuid='$ID' "; 
   }
   else
   {
      $QryAddAcupuncture = "insert into acupuncturepoints (acupoints) values
      ('$Acupuncture') "; 
   }
 
   if (mysqli_query($connection, $QryAddAcupuncture)) {

      
      echo "1";
   } else {
      echo "Error: " . $QryAddAcupuncture . "" . mysqli_error($connection);
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