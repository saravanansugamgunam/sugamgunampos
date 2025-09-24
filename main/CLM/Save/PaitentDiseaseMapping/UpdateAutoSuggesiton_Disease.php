<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PaitentID"]))
{
  
 // echo "1";
 include("../../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]); 
 $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]);     

 
  $ClientID = $_SESSION["SESS_LOCATION"];
  $userid = $_SESSION['SESS_MEMBER_ID']; 
   
  try {
   if($PaitentID<>'')
   { 
      $QryAddDiagnosis='';
      $QryAddDiagnosis.= "delete from diseasemapping_paitent WHERE suggested='1' and conceptname ='Pathology' 
      or  conceptname ='Acupoints'  or conceptname ='Therapy' or conceptname ='Medicine' or conceptname ='Symptoms'   ;";
      
      $QryAddDiagnosis.= " insert into diseasemapping_paitent (paitientid,conceptid,conceptname,addedby,consultingdate,
      clientid,suggested,diseasemappinguniqueid)  
      SELECT '$PaitentID',conceptid,conceptname,'$userid','$currentdate','$ClientID','1','$UniqueID' FROM diseasemapping 
      WHERE conceptname NOT IN ( 'Disease')   AND diseaseid IN ( 
      SELECT conceptid FROM  `diseasemapping_paitent`  WHERE  conceptname='Disease' AND 
       paitientid='$PaitentID' AND clientid='$ClientID' 
      AND consultingdate='$currentdate')
        ON DUPLICATE KEY UPDATE diseasemapping_paitent.mappingid = diseasemapping_paitent.mappingid; "; 
 
 
       

      $QryAddDiagnosis.=" insert into diseasemapping_paitent (paitientid,conceptid,conceptname,addedby,consultingdate,
      clientid,suggested)  SELECT '$PaitentID',diseaseid,'Disease','$userid','$currentdate','$ClientID','1' FROM 
      diseasemapping WHERE conceptname='Disease' AND  conceptid IN(
      SELECT conceptid FROM  `diseasemapping_paitent`  WHERE   conceptname='Disease' AND paitientid='$PaitentID' AND clientid='$ClientID' 
      AND consultingdate='$currentdate') GROUP BY diseaseid
      ON DUPLICATE KEY UPDATE diseasemapping_paitent.mappingid = diseasemapping_paitent.mappingid "; 

   }
 
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