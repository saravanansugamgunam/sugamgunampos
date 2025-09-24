<?php
  include("../../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();
  
  $currentdate = date("Y-m-d");
  $MappingID = mysqli_real_escape_string($connection, $_POST["MappingID"]);    
  $ClientID = $_SESSION["SESS_LOCATION"];

$query=mysqli_query($connection, " 

SELECT consultationname as Therapy,
a.duration, a.cond ,a.instructiontotherapist
 FROM diseasemapping_paitent AS a JOIN 
 consultationmaster AS b ON a.conceptid=b.consultationid
 WHERE  mappingid ='$MappingID'  ");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $MappingID; 
      $data[] = $row['Therapy'];  
      $data[] = $row['duration'];  
      $data[] = $row['cond'];   
      $data[] = $row['instructiontotherapist']; 
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);
 