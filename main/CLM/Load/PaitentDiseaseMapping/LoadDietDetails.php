<?php
  include("../../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();
  
  $currentdate = date("Y-m-d");
  $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);  
  $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]);

  $ClientID = $_SESSION["SESS_LOCATION"];

$query=mysqli_query($connection, " 
SELECT  
GROUP_CONCAT(dietdetails ORDER BY dietdetails ASC) AS Diet
FROM diseasedietmapping  WHERE diseaseid IN( SELECT conceptid FROM 
diseasemapping_paitent WHERE conceptname ='Disease'  AND  diseasemappinguniqueid='$UniqueID' )  ");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['Diet'];  
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);
 