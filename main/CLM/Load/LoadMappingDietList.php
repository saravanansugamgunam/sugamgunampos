 <?php
  include("../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();
  
  $currentdate = date("Y-m-d H:i:s");
  $DiseaseID = mysqli_real_escape_string($connection, $_POST["DiseaseID"]);    

  $result = mysqli_query($connection, " SELECT dietdetails FROM diseasedietmapping where diseaseid='$DiseaseID'");
  
  
  $data = array();
   
  while($row=mysqli_fetch_assoc($result))
  { 
    $data[] = $row['dietdetails']; 
   
   
  }
  
echo json_encode($data);
 
  ?>