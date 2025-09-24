<?php
  
session_cache_limiter(FALSE);
session_start();
  
  
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 			
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
   $LocationCode = $_SESSION['SESS_LOCATION'];
  $FromDate = explode('/', $FromDate); 
$ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0];
 $ToDate = explode('/', $ToDate); 
$ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0];

$ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));
$userid = $_SESSION['SESS_MEMBER_ID'];
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
SELECT  DATE_FORMAT(saledate,'%d-%m-%Y') saledate, DATE_FORMAT(closuredate,'%d-%m-%Y') STODate,
saleid,b.locationname AS `From`, 'Godown' AS `To` ,saleqty,nettamount,closurestatus, saleuniqueno
FROM  `salemaster_stockindent` AS a JOIN 
locationmaster AS b ON a.locationcode=b.locationcode  
  WHERE  saledate BETWEEN  '$ActualFromDate' AND '$ActualToDate'
  
  ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th width='%'> Indent Date </th>    
		<th width='%'> Closure Date </th>    
		<th hidden width='%'> Indent #</th>    
		<th width='%'> From  </th>    
		<th width='%'>  To </th>        
		<th width='%'>  Indent Qty </th>        
		<th width='%'>  Amount </th>        
		<th width='%'> Status </th>        
	       
		<th width='%'> View </th>      
		 
		</tr> </thead> <tbody  >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td>$SerialNo</td>
  <td > $data[0]</td>
  <td >$data[1]</td>  
  <td hidden>$data[2]</td>  
  <td >$data[3]</td>  
  <td >$data[4]</td>  
  <td width='%' style='text-align:right;'>$data[5]</td>

   <td width='%' style='text-align:right;'>"; echo formatMoney($data[6], false); echo "</td>";

   if($userid=='13' || $userid=='22'|| $userid=='30'|| $userid=='91' )
   {
	if($data[7]=='Closed')
	{
		echo "<td>
		<div><i class='fa fa-2x fa-check-circle' style='color:green;'></i> Ready</div>
	
		<td align='center'   width='%'> <a href='StockIndentView.php?invoice=$data[8]' target='_blank' ?><i
    class='fa fa-2x fa-eye' title='View' style='color:blue;'></i></a></td>";
}
else
{

echo "<td onclick='UpdateIndentClosure($data[8]);'>
    <div><i class='fa fa-2x fa-spinner' style='color:blue;'>
        </i>&nbsp;In-Progress</div>
</td>

</td>
<td align='center' width='%'> <a href='StockIndentView.php?invoice=$data[8]' target='_blank' ?><i
            class='fa fa-2x fa-eye' title='View' style='color:blue;'></i></a></td>";
}
}

else
{

if($data[7]=='Closed')
{
echo "<td>
    <div><i class='fa fa-2x fa-check-circle' style='color:green;'>
        </i>&nbsp;Ready</div>
</td>
<td align='center' width='%'> <a href='StockIndentView.php?invoice=$data[8]' target='_blank' ?><i
            class='fa fa-2x fa-eye' title='View' style='color:blue;'></i></a></td>";
}
else
{
echo "<td>
    <div><i class='fa fa-2x fa-spinner' style='color:blue;'></i> In-Progress</div>

</td>
<td align='center' width='%'> <a href='StockIndentView.php?invoice=$data[8]' target='_blank' ?><i
            class='fa fa-2x fa-eye' title='View' style='color:blue;'></i></a></td>";
}

}





echo " </tr>";


$SerialNo=$SerialNo+1;
}
echo "</tbody>
</table>";



// var str1 = "StockIndentView.php?invoice=";
// var str2 = Invoice;
// var str3 = "";
// var BillPrintURL = str1.concat(str2, str3);


?>