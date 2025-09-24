<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["EmployeeCode"]))
{
  
 // echo "1";
 include("../../../connect.php");  		
  $currentdate = date("Y-m-d");				  
  $FromPeriod = date('Y-m-01', strtotime($currentdate));
  $ToPeriod = date('Y-m-t', strtotime($currentdate));

 $EmployeeCode = mysqli_real_escape_string($connection, $_POST["EmployeeCode"]); 
 
$query=mysqli_query($connection, "
SELECT COUNT(*) as totaldays FROM permissionlog WHERE employeecode ='$EmployeeCode' 
AND fromtime BETWEEN '$FromPeriod 00:00:01' AND '$ToPeriod 23:00:00'  AND permissiontype='Permission' ");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['totaldays'];  
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>