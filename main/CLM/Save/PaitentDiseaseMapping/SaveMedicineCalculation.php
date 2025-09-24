<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["MappingID"]))
{
  
 // echo "1";
 include("../../../../connect.php"); 
 $currentdate =date("Y-m-d"); 	 
 $MappingID = mysqli_real_escape_string($connection, $_POST["MappingID"]);    
 $MorningQty = mysqli_real_escape_string($connection, $_POST["MorningQty"]);     
 $AfternoonQty = mysqli_real_escape_string($connection, $_POST["AfternoonQty"]);     
 $EveningQty = mysqli_real_escape_string($connection, $_POST["EveningQty"]);     
 $NightQty = mysqli_real_escape_string($connection, $_POST["NightQty"]);     
 $Condition = mysqli_real_escape_string($connection, $_POST["Condition"]);     
 $Duration = mysqli_real_escape_string($connection, $_POST["Duration"]);      
 $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);      
 $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]);       
 $ConceptID = mysqli_real_escape_string($connection, $_POST["ConceptID"]);       
 $ManualCondition = mysqli_real_escape_string($connection, $_POST["ManualCondition"]);       
 $UOM = mysqli_real_escape_string($connection, $_POST["UOM"]);       
 $ManualDuration = mysqli_real_escape_string($connection, $_POST["ManualDuration"]);  
 $TotalQty = mysqli_real_escape_string($connection, $_POST["TotalQty"]);        
 

  $ClientID = $_SESSION["SESS_LOCATION"];
  $userid = $_SESSION['SESS_MEMBER_ID']; 
   
  try { 
   $QryAddDiagnosis='';

   $QryAddDiagnosis.= "delete from  diseasemapping_paitent where conceptid='$ConceptID' and paitientid='$PaitentID' and 
   diseasemappinguniqueid='$UniqueID';";

   $QryAddDiagnosis.= "insert into diseasemapping_paitent (paitientid,conceptid,
   conceptname,addedby,consultingdate,clientid,diseasemappinguniqueid,mor,aft,eve,nig,cond,
   duration,condmanual,prescriptionuom,condmanualduration,totalqty) values
   ('$PaitentID','$ConceptID','Medicine','$userid','$currentdate','$ClientID','$UniqueID',
   '$MorningQty','$AfternoonQty','$EveningQty','$NightQty','$Condition','$Duration','$ManualCondition','$UOM','$ManualDuration','$TotalQty')
    on duplicate key
   update conceptid = '$ConceptID',mor='$MorningQty',aft='$AfternoonQty',
   eve='$EveningQty',nig='$NightQty',cond='$Condition',duration='$Duration',condmanual='$ManualCondition', 
   prescriptionuom='$UOM',condmanualduration='$ManualDuration',totalqty='$TotalQty'; "; 

  
      // $QryAddDiagnosis = "update  diseasemapping_paitent set 
      // mor='$MorningQty',aft='$AfternoonQty',eve='$EveningQty',nig='$NightQty',
      // cond='$Condition',duration='$Duration' where mappingid='$MappingID'  "; 
   
  
 
   if (mysqli_multi_query($connection, $QryAddDiagnosis)) { 
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