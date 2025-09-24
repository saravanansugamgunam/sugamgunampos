<?php
   include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Type"]))
{	
  
 // echo "1"; 
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
   $LocationCode = $_SESSION['SESS_LOCATION'];
   						  
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $Location = mysqli_real_escape_string($connection, $_POST["Location"]); 
 
if($FromDate=="")
{
	$ActualFromDate= date('Y-m-d 00:00:00');
	$ActualToDate= date('Y-m-d 23:59:59');
	
}
else
{
$FromDate = explode('/', $FromDate); 
$ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0].' 00:00:00';
$ToDate = explode('/', $ToDate); 
$ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0].' 23:59:59' ;

// $ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));
}


if($Location=='-')
{
$Location='%';
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
				 
	
 
$result = mysqli_query($connection, " 

 
SELECT PaymentMode,SUM(Amount), paymentmodecode FROM (
SELECT 
UPPER(b.`paymentmode`) AS PaymentMode,
IFNULL(ROUND(SUM(amount),0),0) AS Amount,b.`paymentmodecode` FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.`paymentmode`=b.`paymentmodecode`
WHERE  a.`date` BETWEEN '$ActualFromDate' AND '$ActualToDate'  and a.clientid like ('$Location')  and transactiongroup ='Inventory' and a.transactiontype in ('CashAdvance','IncomeEntry','OutstandingCollection','PaitentOrder','Sales')
 GROUP BY  b.`paymentmode`,b.`paymentmodecode`
 
 union 
 
 
SELECT 
UPPER(b.`paymentmode`) AS PaymentMode,
-IFNULL(ROUND(SUM(amount),0),0) AS Amount,b.`paymentmodecode` FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.`paymentmode`=b.`paymentmodecode`
WHERE  a.`date` BETWEEN '$ActualFromDate' AND '$ActualToDate'  and a.clientid like ('$Location')  and transactiongroup ='Inventory' and a.transactiontype in ('RefundToCustomer','ExpenseEntry','Doctor Share')
 GROUP BY  b.`paymentmode`,b.`paymentmodecode` 
 
 union 
 
 
SELECT 
UPPER(b.`paymentmode`) AS PaymentMode,
-IFNULL(ROUND(SUM(amount),0),0) AS Amount,b.`paymentmodecode` FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.`paymentmode`=b.`paymentmodecode`
WHERE  a.`date` BETWEEN '$ActualFromDate' AND '$ActualToDate'  and a.clientid like ('$Location')  and transactiongroup ='Inventory' and a.transactiontype in ('Supplier Payment')
 GROUP BY  b.`paymentmode`,b.`paymentmodecode`) AS a GROUP BY PaymentMode,paymentmodecode
 
 ");
  
	  
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table  id='myTable' class='table table-striped table-bordered' style='width:100%'  > ";
echo " <thead><tr>  
		<th>S.No</th>          
		    
		<th  width='%'> Payment Mode</a></th>     
		<th width='%'> Amount</th>           
		<th width='%'> Select </th>           
		 
		</tr> </thead> <tbody  id='tblCashCardSummmary'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td> $data[0]</td>  
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[1], false); echo "</td>   
	<td onclick='LoadBalanceSheetforPaymentMode($data[2])'> 
	<i class='fa fa-2x fa-eye text-primary'></i> 
	</td> 
			

    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";

  
}
else
{
	 echo " NO";
}

?>