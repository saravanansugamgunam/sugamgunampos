 


<?php
  
session_cache_limiter(FALSE);
session_start();
  include("../../../connect.php"); 
//insert.php
if(isset($_POST["userid"]))
{
	 

  $currentdate =date("Y-m-d H:i:s"); 							  
 $currenttime = date("His"); 
 
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $userid = mysqli_real_escape_string($connection, $_POST["userid"]); 
 $AlreadyPaid = 0; 
 
$res = $connection->query("

SELECT userid  FROM doctorsharedetails  WHERE sharefor ='Medicine' and  
'$FromDate' BETWEEN fromdate  AND todate OR sharefor ='Medicine' and '$ToDate'  BETWEEN fromdate  AND todate   "); 
	   
while($data = mysqli_fetch_row($res))
{

	$AlreadyPaid = $data[0];
	 
	
}
 
if($AlreadyPaid=='')
{
	$AlreadyPaid=0;
}

$result = mysqli_query($connection, " 
SELECT ROUND(SUM(nettamount),0) AS TotalSale,ROUND(SUM(profitamount),0) AS Profit from salemaster  
AS a  JOIN usermaster as b ON a.userid=b.userid 
 WHERE saledate BETWEEN '$FromDate' AND '$ToDate'  AND  a.locationcode LIKE('%') 
 AND a.transactiontype NOT IN('Outstanding','Cancelled','Return') AND cancellstatus =0 
 AND a.userid LIKE ('$userid')  ORDER BY saledate DESC " );  

// echo "

// SELECT userid  FROM doctorsharedetails  WHERE 
// '$FromDate' BETWEEN fromdate  AND todate OR '$ToDate'  BETWEEN fromdate  AND todate";
 
  // echo $AlreadyPaid;
	 $data = array(); 
    while($row=mysqli_fetch_assoc($result))
			{   
		 
				$data[] =  $row['TotalSale']; 
				$data[] =  $row['Profit']; 
				$data[] =  $AlreadyPaid; 
		 
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);
    
}

?>