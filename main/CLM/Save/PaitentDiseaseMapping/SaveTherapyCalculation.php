<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["UniqueID"]))
{
  
 // echo "1";
 include("../../../../connect.php"); 
  $currentdate =date("Y-m-d");  
 
 $Duration = mysqli_real_escape_string($connection, $_POST["Sittings"]);     
 $Condition = mysqli_real_escape_string($connection, $_POST["Condition"]);     
 $ConceptID = mysqli_real_escape_string($connection, $_POST["ConceptID"]);  
 $ManualCondition = mysqli_real_escape_string($connection, $_POST["Frequency"]);  
 $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);  
 $MappingID = mysqli_real_escape_string($connection, $_POST["MappingID"]);  
 $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]);     
 $InstructionstoTherapist = mysqli_real_escape_string($connection, $_POST["InstructionstoTherapist"]);  
 
  $ClientID = $_SESSION["SESS_LOCATION"];
  $userid = $_SESSION['SESS_MEMBER_ID']; 
   
  try { 
       $QryAddDiagnosis='';

   $QryAddDiagnosis.= "delete from  diseasemapping_paitent where conceptid='$ConceptID' and paitientid='$PaitentID' and 
   diseasemappinguniqueid='$UniqueID';";

  
   $QryAddDiagnosis.= "insert into diseasemapping_paitent (paitientid,conceptid,
   conceptname,addedby,consultingdate,clientid,diseasemappinguniqueid,cond,
   duration,condmanual,instructiontotherapist) values
   ('$PaitentID','$ConceptID','Therapy','$userid','$currentdate','$ClientID','$UniqueID',
   '$Condition','$Duration','$ManualCondition','$InstructionstoTherapist')
    on duplicate key
   update conceptid = '$ConceptID',cond='$Condition',duration='$Duration',
   condmanual='$ManualCondition',instructiontotherapist='$InstructionstoTherapist' "; 
    

    

   if (mysqli_multi_query($connection, $QryAddDiagnosis)) { 
      echo "1";
       echo $QryAddDiagnosis;
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