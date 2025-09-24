<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Invoice"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);
 
$query=mysqli_query($connection, " 
 SELECT SUM(a.nettamount) as Total,SUM(a.discount) as Discount,count(therapyid) as Qty
 FROM therapybookingdetails AS a JOIN 
consultationmaster AS b ON a.therapyid = b.consultationid WHERE bookinguniqueid ='".$Invoice."'");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['Total']; 
       $data[] = $row['Discount'];
       $data[] = $row['Qty'];
     
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>