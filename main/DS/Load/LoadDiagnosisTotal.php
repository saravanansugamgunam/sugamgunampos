<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["InvoiceNo"]))
{
    
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]); 
 
$query=mysqli_query($connection, "
SELECT SUM(a.rate) as Total FROM diagnosisitems AS a JOIN disagnosismaster  AS b ON a.diagnosisid=b.id  WHERE
diagnosisuniqueid ='$InvoiceNo' ;");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['Total'];  
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}
