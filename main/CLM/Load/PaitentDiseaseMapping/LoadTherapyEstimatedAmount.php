 <?php
  include("../../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();
  
  $currentdate = date("Y-m-d");
  $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]); 
  $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]);   
  $ClientID = $_SESSION["SESS_LOCATION"];
 
  $result = mysqli_query($connection, "
  
   SELECT  SUM(duration*consultationcharge) as EstimateAmount  FROM diseasemapping_paitent AS a 
  JOIN consultationmaster AS b ON a.conceptid=b.`consultationid` AND a.conceptname='Therapy' 
  AND a.paitientid='$PaitentID'
  LEFT JOIN medicineprescriptioncondition AS c ON   c.conditionid = a.cond 
  WHERE diseasemappinguniqueid='$UniqueID' ORDER BY mappingid");
  
      
	 $data = array();
   
   while($row=mysqli_fetch_assoc($result))
   {  
     $data[] = $row['EstimateAmount']; 
   }
   
echo json_encode($data);

  ?>