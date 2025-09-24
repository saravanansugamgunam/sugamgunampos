 <?php
  include("../../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();
  
  $currentdate = date("Y-m-d"); 
  $Duration = mysqli_real_escape_string($connection, $_POST["Duration"]);   
  $ClientID = $_SESSION["SESS_LOCATION"]; 
  
  $result = mysqli_query($connection, " 
  SELECT noofdays FROM prescriptionduration WHERE durationid = '$Duration'  "); 
   
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($result))
    {  
      $data[] = $row['noofdays']; 
    }
	  
echo json_encode($data);
 
   
  ?>