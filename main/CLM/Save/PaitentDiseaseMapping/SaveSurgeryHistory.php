<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Surgery"]))
{
  
 // echo "1";
 include("../../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $Surgery = mysqli_real_escape_string($connection, $_POST["Surgery"]);    
 $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);     
 $ConceptName ='Surgery';
 $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]); 
 $Period = mysqli_real_escape_string($connection, $_POST["SurgeryPeriod"]);       

 
  $ClientID = $_SESSION["SESS_LOCATION"];
  $userid = $_SESSION['SESS_MEMBER_ID']; 
   
  try {
   if($PaitentID<>'')
   { 
      $QryAddDiagnosis = "insert into diseasemapping_paitent (paitientid,conceptid,
      conceptname,addedby,consultingdate,clientid,diseasemappinguniqueid,condmanual) values
      ('$PaitentID','$Surgery','$ConceptName','$userid','$currentdate','$ClientID','$UniqueID','$Period') "; 
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