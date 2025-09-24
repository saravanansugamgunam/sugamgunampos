<?php
  
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 			
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
 
 if ($Type=='Detail')
 {
 
$result = mysqli_query($connection, "  SELECT paymentid,DATE_FORMAT(a.paymentdate, '%d-%b-%y') AS Paymentdate, 
 b.studentname,b.studentmobileno,c.batchname,d.paymentmode,SUM(paymentamount) AS Payment,a.invoiceno FROM paymentdetails AS a 
 JOIN studentmaster AS b ON a.studentcode = b.studentcode 
 JOIN batchmaster AS c ON a.batchcode =c.batchcode  
 join paymentmodemaster as d on a.paymentmodeid=d.paymentmodecode
 WHERE paymentdate BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.batchcode like ('$Batch') 
 GROUP BY 
 DATE_FORMAT(a.paymentdate, '%d-%b-%y'), 
 b.studentname,c.batchname,b.studentmobileno,a.invoiceno,d.paymentmode
 order by a.paymentdate
 
  ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>                
		<th  width='%'> ID</th>    
    <th  width='%'> Date</th>  
		<th  width='%'> Student   </th>     
		<th width='%'> Mobile No</th>           
		<th width='%'> Batch </th>        
		<th width='%'> Mode </th>    
    <th width='%'> Nett Receipt </th>  
		<th width='%'> View</th>           
    <th width='%' hidden> Invoice</th> 
		 
		</tr> </thead> <tbody  >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td > $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td> 
   <td width='%'>$data[5]</td>  
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[6], false); echo "</td>   
   <td align='center' width='%' style='color:#009ad9'  onclick='redirect($data[6])' >
   <a href='ReceiptPrint.php?invoice=$data[7]' target='_blank' ?>
   <i class='fa fa-2x fa-eye' title='View'></i></a> </td>  
   <td width='%' hidden>$data[7]</td>   
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
 }
 else
	 
	 {
		 
$result = mysqli_query($connection, "  
  SELECT DATE_FORMAT(a.paymentdate, '%d-%b-%y') AS Paymentdate, 
 COUNT(b.studentname) AS Total,SUM(paymentamount) AS Payment FROM paymentdetails AS a 
 JOIN studentmaster AS b ON a.studentcode = b.studentcode 
 JOIN batchmaster AS c ON a.batchcode =c.batchcode 
 JOIN paymentmodemaster AS d ON a.paymentmodeid = d.paymentmodecode
  WHERE paymentdate BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.batchcode like ('$Batch') 
 GROUP BY 
 DATE_FORMAT(a.paymentdate, '%d-%b-%y')
  order by a.paymentdate
  ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		 
		<th  width='%'> Date</a></th>     
		<th width='%'> Total Receipt</th>        
		<th width='%'> Nett Amount </th>  
		</tr> </thead> <tbody  >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td> $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%' style='text-align:right;' >"; echo formatMoney($data[2], false); echo "</td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
		 
	 }

?> 