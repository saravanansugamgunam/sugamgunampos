<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["StockItemID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $ConsultationID = mysqli_real_escape_string($connection, $_POST["StockItemID"]);

 $LocationCode = $_SESSION['SESS_LOCATION'];
 
$query=mysqli_query($connection, "SELECT consultationcharge FROM  consultationmaster WHERE consultationid ='".$ConsultationID."'");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
     
      $data[] = $row['consultationcharge'];  
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>