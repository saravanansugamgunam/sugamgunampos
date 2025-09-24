 <?php
  include("../../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();
  
  $currentdate = date("Y-m-d"); 
  $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]);   
  $ClientID = $_SESSION["SESS_LOCATION"];
 
  
 
  
  $result = mysqli_query($connection, "  SELECT conceptid,
  duration,cond,condmanual,a.instructiontotherapist  FROM diseasemapping_paitent AS a 
  JOIN consultationmaster AS b ON a.conceptid=b.`consultationid` 
  AND a.conceptname='Therapy'  
  left JOIN medicineprescriptioncondition AS c ON   c.conditionid = a.cond 
  where mappingid='$UniqueID'");
 
   
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($result))
    {  
      $data[] = $row['conceptid']; 
      $data[] = $row['duration']; 
      $data[] = $row['cond']; 
      $data[] = $row['condmanual'];  
      $data[] = $row['instructiontotherapist']; 
    }
	  
echo json_encode($data);
 
   
  ?>