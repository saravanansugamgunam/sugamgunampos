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
 $Batch = mysqli_real_escape_string($connection, $_POST["Batch"]); 
  
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
  SELECT  ROUND(IFNULL(SUM(paymentamount),0),2) AS Payment FROM paymentdetails AS a 
 JOIN studentmaster AS b ON a.studentcode = b.studentcode 
 JOIN batchmaster AS c ON a.batchcode =c.batchcode 
 JOIN paymentmodemaster AS d ON a.paymentmodeid = d.paymentmodecode
  WHERE  d.paymentmode='Cash' and  paymentdate BETWEEN '$ActualFromDate' AND '$ActualToDate' 
and a.batchcode like ('$Batch')
  ) AS Cash,
 
 (   SELECT  ROUND(IFNULL(SUM(paymentamount),0),2) AS Payment FROM paymentdetails AS a 
 JOIN studentmaster AS b ON a.studentcode = b.studentcode 
 JOIN batchmaster AS c ON a.batchcode =c.batchcode 
 JOIN paymentmodemaster AS d ON a.paymentmodeid = d.paymentmodecode
  WHERE  d.paymentmode='CARD' and  paymentdate BETWEEN '$ActualFromDate' AND '$ActualToDate'  and a.batchcode like ('$Batch')  ) AS Card,
  
   ( SELECT  ROUND(IFNULL(SUM(paymentamount),0),2) AS Payment FROM paymentdetails AS a 
 JOIN studentmaster AS b ON a.studentcode = b.studentcode 
 JOIN batchmaster AS c ON a.batchcode =c.batchcode 
 JOIN paymentmodemaster AS d ON a.paymentmodeid = d.paymentmodecode
  WHERE  d.paymentmode NOT IN ('Cash','CARD') and  paymentdate BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.batchcode like ('$Batch') ) AS Others,
  
     
     ( SELECT  ROUND(IFNULL(SUM(paymentamount),0),2) AS Payment FROM paymentdetails AS a 
 JOIN studentmaster AS b ON a.studentcode = b.studentcode 
 JOIN batchmaster AS c ON a.batchcode =c.batchcode 
 JOIN paymentmodemaster AS d ON a.paymentmodeid = d.paymentmodecode
   where   paymentdate BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.batchcode like ('$Batch') ) AS Total
  ");
	 
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = formatMoney($row['Cash'],false);
      $data[] = formatMoney($row['Card'],false);
      $data[] = formatMoney($row['Others'],false);
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