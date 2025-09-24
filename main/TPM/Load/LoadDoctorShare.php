 


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
 $ShareType = mysqli_real_escape_string($connection, $_POST["ShareType"]);  
 $CheckAllStatus = mysqli_real_escape_string($connection, $_POST["CheckAllStatus"]);  
 $SelectedBill = stripslashes(mysqli_real_escape_string($connection, $_POST["SelectedBill"]));  
 $AlreadyPaid = 0;  
 
// $res = $connection->query("

// SELECT userid  FROM doctorsharedetails  WHERE sharefor ='$ShareFor' and 
// '$FromDate' BETWEEN fromdate  AND todate OR sharefor ='$ShareFor' and  '$ToDate'  BETWEEN fromdate  AND todate   "); 
	   
// while($data = mysqli_fetch_row($res))
// {

// 	$AlreadyPaid = $data[0];
	 
	
// }
 
// if($AlreadyPaid=='')
// {
// 	$AlreadyPaid=0;
// }
 
if($CheckAllStatus==1)
{
  $result = mysqli_query($connection, " 
  SELECT ROUND(SUM(totalamount)-SUM(discountamount),0) AS TotalSale,ROUND(SUM(totalamount)-SUM(discountamount),0) AS Profit 
  from consultingbillmaster  AS a  JOIN usermaster as b ON a.doctorid=b.userid 
  WHERE billdate BETWEEN '$FromDate' AND '$ToDate'  AND  a.locationcode LIKE('%') 
  AND a.cancelledstatus =0  AND a.doctorid LIKE ('$userid') and billtype='$ShareType' 
  and consultationuniquebill not in (SELECT billuniqueid FROM doctorsharebilldetails)  ORDER BY billdate DESC " );  
}
else
{
  $result = mysqli_query($connection, " 
  SELECT ROUND(SUM(totalamount)-SUM(discountamount),0) AS TotalSale,ROUND(SUM(totalamount)-SUM(discountamount),0) AS Profit 
  from consultingbillmaster  AS a  JOIN usermaster as b ON a.doctorid=b.userid 
  WHERE billdate BETWEEN '$FromDate' AND '$ToDate'  AND  a.locationcode LIKE('%') 
  AND a.cancelledstatus =0  AND a.doctorid LIKE ('$userid') and billtype='$ShareType' 
  and consultationuniquebill in ($SelectedBill)  ORDER BY billdate DESC " );  
}
 
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