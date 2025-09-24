<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["GRN"]))
{
  
 
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $GRN = mysqli_real_escape_string($connection, $_POST["GRN"]);
 $LocationCodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);

 $GroupID = $_SESSION['SESS_GROUP_ID'];
 $LocationCode = $_SESSION['SESS_LOCATION'];

 if($GroupID==1)
 {
    $LocationCode =$LocationCodeAdmin;
 }
 else
 {
    $LocationCode = $_SESSION['SESS_LOCATION'];
 }

 
$query=mysqli_query($connection, "SELECT IFNULL(SUM(currentstock),0) AS GRNQty FROM newstockdetails_$LocationCode 
 WHERE grnnumber ='".$GRN."' AND currentstock>0 ");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['GRNQty']; 
    }
	  
   //  echo "1";

echo json_encode($data);
 
  
    mysqli_close($connection);

  
}
