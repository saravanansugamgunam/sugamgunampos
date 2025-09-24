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

 
 SELECT  DATE_FORMAT(receiptdate,'%d-%m-%Y') ReceiptDate, DATE_FORMAT(stodate,'%d-%m-%Y') STODate,
 stouniqueno,c.locationname AS `From`, b.locationname AS `To` ,stoqty,nettamount,receiptstatus 
 FROM  `stomaster` AS a JOIN 
locationmaster AS b ON a.tolocation=b.locationcode JOIN locationmaster AS c ON a.fromlocation=c.locationcode 
   WHERE tolocation = '$LocationCode' and receiptdate BETWEEN '$ActualFromDate' AND '$ActualToDate'  ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th width='%'> Receipt Date </th>    
		<th width='%'> STO Date </th>    
		<th hidden width='%'> STO No</th>    
		<th width='%'> From  </th>    
		<th width='%'>  To </th>        
		<th width='%'>  Receipt Qty </th>        
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
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[6], false); echo "</td> 
 <td >$data[7]</td>    
      <td align='center'   width='%'> <a href='STIView.php?stoid=$data[2]' target='_blank' ?><i class='fa fa-2x fa-eye' title='View' style='color:blue;'></i></a></td>  
	 
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
  

?> 