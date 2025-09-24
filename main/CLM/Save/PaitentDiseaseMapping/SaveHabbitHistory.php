<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Habbit"]))
{
  
 // echo "1";
 include("../../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $Habbit = mysqli_real_escape_string($connection, $_POST["Habbit"]);    
 $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);     
 $ConceptName ='Habbit History';
 $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]); 
 $HabbitPeriod = mysqli_real_escape_string($connection, $_POST["HabbitPeriod"]);       

 
  $ClientID = $_SESSION["SESS_LOCATION"];
  $userid = $_SESSION['SESS_MEMBER_ID']; 
   
  try {
   if($PaitentID<>'')
   { 
      $QryAddDiagnosis = "insert into diseasemapping_paitent (paitientid,conceptid,
      conceptname,addedby,consultingdate,clientid,diseasemappinguniqueid,condmanual) values
      ('$PaitentID','$Habbit','$ConceptName','$userid','$currentdate','$ClientID','$UniqueID','$HabbitPeriod') "; 
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