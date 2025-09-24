<?php
   include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Paitent"]))
{	
  
 // echo "1";
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
 $Paitent = mysqli_real_escape_string($connection, $_POST["Paitent"]);
  
   $LocationCode = $_SESSION['SESS_LOCATION'];
   

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
 join paitentmaster AS d ON b.paitientcode=d.paitentid 
  WHERE  c.paymentmode='Cash' and   d.paitentid = '$Paitent'    and locationcode ='$LocationCode'   and b.transactiontype not in('Outstanding') and cancellstatus =0    ) AS Cash,
 
 ( SELECT ROUND(IFNULL(SUM(amount),0),2)  FROM salepaymentdetails AS a JOIN salemaster AS b 
 ON a.invoiceno = b.saleuniqueno  JOIN  paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode
  join paitentmaster AS d ON b.paitientcode=d.paitentid 
  WHERE  c.paymentmode='CARD'  and   d.paitentid = '$Paitent'   and locationcode ='$LocationCode'   and b.transactiontype not in('Outstanding') and cancellstatus =0    ) AS Card,
  
   ( SELECT ROUND(IFNULL(SUM(amount),0),2) FROM salepaymentdetails AS a JOIN salemaster AS b 
 ON a.invoiceno = b.saleuniqueno  JOIN  paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode
  join paitentmaster AS d ON b.paitientcode=d.paitentid 
  WHERE  c.paymentmode NOT IN ('Cash','CARD') and   d.paitentid = '$Paitent'   and locationcode ='$LocationCode'     and b.transactiontype not in('Outstanding') and cancellstatus =0     ) AS Others,
  
     
     (SELECT ROUND(IFNULL(SUM(amount),0),0)  FROM salepaymentdetails AS a JOIN salemaster AS b 
 ON a.invoiceno = b.saleuniqueno  JOIN  paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode
  join paitentmaster AS d ON b.paitientcode=d.paitentid 
   where    d.paitentid = '$Paitent'   and locationcode ='$LocationCode'  and b.transactiontype not in('Outstanding') and cancellstatus =0    ) AS Total
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