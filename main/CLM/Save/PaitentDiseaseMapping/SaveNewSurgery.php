<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["NewSurgery"]))
{
  
 // echo "1";
 include("../../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $NewSurgery = mysqli_real_escape_string($connection, $_POST["NewSurgery"]);     
 $Period = mysqli_real_escape_string($connection, $_POST["Period"]);     
 $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);          
 $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]);
 
  $ClientID = $_SESSION["SESS_LOCATION"];
  $userid = $_SESSION['SESS_MEMBER_ID']; 
   
  try {
   if($PaitentID<>'')
   { 
      $QryAddDiagnosis = "insert into surgerymaster (surgeryname) values
      ('$NewSurgery') "; 
   }
 
   if (mysqli_query($connection, $QryAddDiagnosis)) { 
      $last_idBatch = $connection->insert_id;


      $QryAdd = "insert into diseasemapping_paitent (paitientid,conceptid,
      conceptname,addedby,consultingdate,clientid,diseasemappinguniqueid,condmanual) values
      ('$PaitentID','$last_idBatch','Surgery','$userid','$currentdate','$ClientID','$UniqueID','$Period') ";
      mysqli_query($connection, $QryAdd);

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