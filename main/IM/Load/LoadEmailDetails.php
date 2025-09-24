<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["UniqueID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							   
 $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]);
 
  $query=mysqli_query($connection, "SELECT a.uniqueid,a.subject,message,IFNULL(path,'-') as path,STATUS FROM bulkemail  AS a 
  LEFT JOIN bulkemailattachment AS b ON a.uniqueid=b.uniqueid WHERE  a.id='$UniqueID'");
  
	  
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
     
      $data[] = $row['subject']; 
	   $data[] = $row['message']; 
	    $data[] = $row['path'];  
      
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>