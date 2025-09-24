<?php
   include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
   
//insert.php
if(isset($_POST["FromDate"]))
{	
  
 // echo "1";
 							  
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
  
  $FromDate = explode('/', $FromDate); 
$ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0];
 $ToDate = explode('/', $ToDate); 
$ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0];

$ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));


function formatMoney($number, $fractional=false) {
					if ($fractional) {
						$number = sprintf('%.2f', $number);
					}
					while (true) {
						$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
						if ($replaced != $number) {
							$number = $replaced;
						} else {
							break;
						}
					}
					return $number;
				}
				

$query=mysqli_query($connection, "  
SELECT(
 SELECT ROUND(IFNULL(SUM(stoqty),0),0)  AS Qty   FROM stomaster  WHERE receiptdate BETWEEN '$ActualFromDate' AND '$ActualToDate'  ) AS Qty,
 
 (  SELECT ROUND(IFNULL(SUM(nettamount),0),0)  AS Qty   FROM stomaster  WHERE receiptdate BETWEEN '$ActualFromDate' AND '$ActualToDate'  ) AS Total   ");
	 
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = formatMoney($row['Qty'],false);
      $data[] = formatMoney($row['Total'],false); 
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}
else
{
	 echo " NO";
}

?>