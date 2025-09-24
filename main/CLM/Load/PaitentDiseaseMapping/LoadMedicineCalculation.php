<?php
  include("../../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();
  
  $currentdate = date("Y-m-d");
  $MappingID = mysqli_real_escape_string($connection, $_POST["MappingID"]);    
  $ClientID = $_SESSION["SESS_LOCATION"];

$query=mysqli_query($connection, " 

SELECT CONCAT(b.productshortcode,'-',b.productname) as Prod,
a.mor,a.aft,a.eve,a.nig,a.cond,a.duration
 FROM diseasemapping_paitent AS a JOIN 
productmaster AS b ON a.conceptid=b.productid
 WHERE  mappingid ='$MappingID'  ");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $MappingID; 
      $data[] = $row['Prod'];  
      $data[] = $row['mor'];  
      $data[] = $row['aft'];  
      $data[] = $row['eve'];  
      $data[] = $row['nig'];  
      $data[] = $row['cond'];  
      $data[] = $row['duration'];  
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);
 