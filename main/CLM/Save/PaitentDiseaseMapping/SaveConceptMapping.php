<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["ConceptID"]))
{
  
 // echo "1";
 include("../../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $ConceptID = mysqli_real_escape_string($connection, $_POST["ConceptID"]);    
 $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);     
 $ConceptName = mysqli_real_escape_string($connection, $_POST["ConceptName"]);     
 $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]);     
 $SymptomsPeriod = mysqli_real_escape_string($connection, $_POST["SymptomsPeriod"]);     
 $SymptomsValue = mysqli_real_escape_string($connection, $_POST["SymptomsValue"]);     
 
  $ClientID = $_SESSION["SESS_LOCATION"];
  $userid = $_SESSION['SESS_MEMBER_ID']; 
   
  try {
   if($PaitentID<>'')
   { 
      $QryAddDiagnosis = "insert into diseasemapping_paitent (paitientid,conceptid,
      conceptname,addedby,consultingdate,clientid,diseasemappinguniqueid,symptomsperiod,symptomsvalue) values
      ('$PaitentID','$ConceptID','$ConceptName','$userid','$currentdate','$ClientID','$UniqueID','$SymptomsPeriod','$SymptomsValue') "; 
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