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
   $LocationCode = $_SESSION['SESS_LOCATION'];
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
 SELECT   ROUND(IFNULL(SUM(amount),0),2) FROM salepaymentdetails AS a JOIN salemaster AS b 
 ON a.invoiceno = b.saleuniqueno  JOIN  paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode
  WHERE  c.paymentmode='Cash' and  saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'   and locationcode ='$LocationCode'   and b.transactiontype in('Return') and cancellstatus =0 ) AS Cash,
 
 ( SELECT ROUND(IFNULL(SUM(amount),0),2)  FROM salepaymentdetails AS a JOIN salemaster AS b 
 ON a.invoiceno = b.saleuniqueno  JOIN  paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode
  WHERE  c.paymentmode='CARD'  and  saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'     and b.transactiontype  in('Return') and cancellstatus =0 ) AS Card,
  
   ( SELECT ROUND(IFNULL(SUM(amount),0),2) FROM salepaymentdetails AS a JOIN salemaster AS b 
 ON a.invoiceno = b.saleuniqueno  JOIN  paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode
  WHERE  c.paymentmode NOT IN ('Cash','CARD') and  saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'       and b.transactiontype  in('Return') and cancellstatus =0  ) AS Others,
  
     
     (SELECT ROUND(IFNULL(SUM(amount),0),0)  FROM salepaymentdetails AS a JOIN salemaster AS b 
 ON a.invoiceno = b.saleuniqueno  JOIN  paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode
   where   saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'    and b.transactiontype  in('Return') and cancellstatus =0 ) AS Total
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