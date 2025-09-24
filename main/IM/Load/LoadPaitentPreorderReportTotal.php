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
 $Period =  mysqli_real_escape_string($connection, $_POST["Period"]);  
 
 if($Period=='Today')
 {
   $FromPeriod=$currentdate;
   $ToPeriod=$currentdate;

 }
  
 else if($Period=='CurrentMonth')
 {
   $FromPeriod=date('Y-m-01', strtotime($currentdate));
   $ToPeriod=date('Y-m-t', strtotime($currentdate)); 
 }
  
 else if($Period=='Custom')
 {
   $FromPeriod = $FromDate;
   $ToPeriod=$ToDate;
 }
 else if($Period=='All')
 {
   $FromPeriod = '2020-01-01';
   $ToPeriod=$currentdate;
 }

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

SELECT 
	(      
      SELECT SUM(a.qty) AS Qty 
      FROM preorderitems AS a JOIN preordermaster AS b ON a.uniqueno=b.uniqueno
      JOIN paitentmaster AS c ON b.patientid=c.paitentid  
      WHERE orderdate BETWEEN  '$FromPeriod' AND '$ToPeriod'  and b.orderstatus='Open' )   AS Qty,
	   
	(      
      SELECT  SUM(b.`advanceamount`) AS Total
      FROM preorderitems AS a JOIN preordermaster AS b ON a.uniqueno=b.uniqueno
      JOIN paitentmaster AS c ON b.patientid=c.paitentid  
      WHERE orderdate BETWEEN  '$FromPeriod' AND '$ToPeriod' and b.orderstatus='Open' )    AS Total
	  ") ;
	 
	 
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