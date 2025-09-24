<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Condition"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $Condition = mysqli_real_escape_string($connection, $_POST["Condition"]);    
 $ConditionType = mysqli_real_escape_string($connection, $_POST["ConditionType"]);    
 $ID = mysqli_real_escape_string($connection, $_POST["ID"]);    
   
  $ClientID = 1;
  $userid = 1;	
   
  try {
   if($ID<>'')
   {
      $QryAddDiagnosis = "update medicineprescriptioncondition set conditionname = '$Condition' 
      where conditionid='$ID' "; 
   }
   else
   {
      $QryAddDiagnosis = "insert into medicineprescriptioncondition (conditionname,conditiontype) values
      ('$Condition','$ConditionType') "; 
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