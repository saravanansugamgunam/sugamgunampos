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
 $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]); 
 $SelectedPaymentType = mysqli_real_escape_string($connection, $_POST["SelectedPaymentType"]); 
 // $PaymentMode = 'yNo';

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
SELECT consultationuniquebill,DATE_FORMAT(billdate,'%d-%m-%Y') AS sale,b.`paitentname`,
grossamount,round(discountamount,0),ROUND((discountamount/grossamount)*100,0) AS DiscPercent, c.`username` 
 FROM consultingbillmaster AS a  JOIN paitentmaster AS b ON 
a.`paitentid`=b.`paitentid`
JOIN usermaster as c ON a.`doctorid` =c.`userid`  WHERE discountamount > 0 AND cancelledstatus = 0  
and billdate BETWEEN '$ActualFromDate' AND '$ActualToDate'   AND locationcode like('$Location') and billtype like ('Therapy') 
 ");
 
	  
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered' style='width:95%'>";
echo " <thead><tr>  
		<th>S.No</th>          
		    
		<th hidden  width='%'> SaleID</a></th>
		<th  width='%'> Date</a></th>
		<th  width='%'> Paitent</a></th>
		<th  width='%'> Total</a></th>
		<th  width='%'> Discount</a></th>
		<th  width='%'> Disc %</a></th>
		<th  width='%'> Doctor</a></th> 
		</tr> </thead> <tbody  id='tblBalanceSheet'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>";   
  echo "<td hidden width='%' >$data[0]</td>";  
  echo "<td width='%' >$data[1]</td>";  
  echo "<td width='%' >$data[2]</td>";  
  echo "<td width='%' style='text-align:right'>$data[3]</td>";  
  echo "<td width='%' style='text-align:right'>$data[4]</td>";  
  echo "<td width='%' style='text-align:right'>$data[5] %</td>";  
  echo "<td width='%' >$data[6]</td>";  
  echo "<td width='%' >
  <a href='../CLM/SaleBillView.php?invoice=$data[0]' target='_blank' ?>
<i class='fa fa-2x fa-eye' title='View'></i></a>
 
  </td>"; 
     
 echo" </tr>";
   
  
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