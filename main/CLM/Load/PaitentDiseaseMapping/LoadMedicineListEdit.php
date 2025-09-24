 <?php
  include("../../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();
  
  $currentdate = date("Y-m-d"); 
  $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]);   
  $ClientID = $_SESSION["SESS_LOCATION"];
 
  
 
  $result = mysqli_query($connection, "  select conceptid,
  mor,aft,eve,nig,conditionid,duration,prescriptionuom,condmanual
    FROM diseasemapping_paitent AS a 
  JOIN productmaster AS b ON a.conceptid=b.`productid` AND a.conceptname='Medicine' 
  left JOIN medicineprescriptioncondition AS c ON c.conditionid = a.cond 
  where mappingid='$UniqueID'"); 
   
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($result))
    {  
      $data[] = $row['conceptid']; 
      $data[] = $row['mor']; 
      $data[] = $row['aft']; 
      $data[] = $row['eve']; 
      $data[] = $row['nig']; 
      $data[] = $row['conditionid']; 
      $data[] = $row['duration']; 
      $data[] = $row['prescriptionuom']; 
      $data[] = $row['condmanual']; 
    }
	  
echo json_encode($data);
 
   
  ?>