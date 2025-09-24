<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["DayName"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $DayName = mysqli_real_escape_string($connection, $_POST["DayName"]);    
 $NoofDays = mysqli_real_escape_string($connection, $_POST["NoofDays"]);    
 $ID = mysqli_real_escape_string($connection, $_POST["ID"]);    
   
  $ClientID = 1;
  $userid = 1;	
   
  try {
   if($ID<>'')
   {
      $QryAddDiagnosis = "update prescriptionduration set duration = '$DayName',
      noofdays='$NoofDays' where durationid='$ID' "; 
   }
   else
   {
      $QryAddDiagnosis = "insert into prescriptionduration 
      (duration,noofdays) values ('$DayName','$NoofDays') "; 
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