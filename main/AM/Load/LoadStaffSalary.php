<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["StaffCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $StaffCode = mysqli_real_escape_string($connection, $_POST["StaffCode"]);
 $Period = mysqli_real_escape_string($connection, $_POST["Period"]);
 
$query=mysqli_query($connection, "
SELECT 
(SELECT salary FROM usermaster WHERE userid ='".$StaffCode."') AS FixedSalary,
(SELECT IFNULL(SUM(amount),0) FROM salarypaymentdetails WHERE period='".$Period."'
 and employeecode ='".$StaffCode."') AS Advance;");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['FixedSalary']; 
      $data[] = $row['Advance']; 
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>