<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["StudentCode"]))
{
  
  
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 
 $StudentCode = mysqli_real_escape_string($connection, $_POST["StudentCode"]);
 

 
$query=mysqli_query($connection, "SELECT $StudentCode as studentcode,d.studentname,
(SELECT SUM(studentfees) FROM studentbatchmapping WHERE studentcode ='$StudentCode' ) - SUM(IFNULL(c.paymentamount,0)) AS Balance,
(SELECT studentgender FROM studentmaster WHERE studentcode ='$StudentCode') as studentgender, 
(SELECT DATE_FORMAT(studentdob, '%d/%m/%Y') FROM studentmaster WHERE studentcode ='$StudentCode') as studentdob, 
(SELECT studentmobileno FROM studentmaster WHERE studentcode ='$StudentCode') as studentmobileno
 
 FROM studentbatchmapping AS a JOIN batchmaster AS b ON a.batchcode=b.batchcode 
 LEFT JOIN paymentdetails AS c ON b.batchcode=c.batchcode AND a.studentcode=c.studentcode  
 JOIN studentmaster AS d ON a.studentcode = d.studentcode
 WHERE a.studentcode ='".$StudentCode."' ");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['studentcode'];
      $data[] = $row['studentname'];
      $data[] = $row['Balance'];
      $data[] = $row['studentgender'];
      $data[] = $row['studentdob'];
      $data[] = $row['studentmobileno'];
      
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

	 
}
else
	
	{
		echo "NOT";	
	}