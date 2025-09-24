 <?php
  include("../../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();
  
  $currentdate = date("Y-m-d"); 
  $ProductCode = mysqli_real_escape_string($connection, $_POST["ProductCode"]);   
  $ClientID = $_SESSION["SESS_LOCATION"]; 
  
  $result = mysqli_query($connection, " 
  SELECT b.uom FROM productmaster AS a LEFT JOIN category AS b 
ON a.`category`=b.`name` WHERE productid='$ProductCode' GROUP BY b.uom "); 
   
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($result))
    {  
      $data[] = $row['uom']; 
    }
	  
echo json_encode($data);
 
   
  ?>