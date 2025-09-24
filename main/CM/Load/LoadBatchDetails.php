<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["BatchCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $BatchCode = mysqli_real_escape_string($connection, $_POST["BatchCode"]);


 
$query=mysqli_query($connection, "SELECT  DATE_FORMAT(batchcommences, '%d-%b-%y') as batchcommences  , coursename, batchfee, b.coursefee,
 a.batchcode,b.coursecode 
 FROM batchmaster AS a JOIN coursemaster AS b ON a.coursecode=b.coursecode  WHERE a.activestatus='Active' and batchCode= '".$BatchCode."'");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['batchcommences'];
      $data[] = $row['coursename'];
      $data[] = $row['batchfee'];
      $data[] = $row['batchcode'];
      $data[] = $row['coursecode'];
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>