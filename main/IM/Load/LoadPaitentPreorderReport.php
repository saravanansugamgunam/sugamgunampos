<?php
  
session_cache_limiter(FALSE);
session_start();
  
  
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 			
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
   $ToPeriod='2099-12-30';
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
				
 if ($Type=='Detail')
 {
 
$result = mysqli_query($connection, " 
 
      SELECT DATE_FORMAT(b.orderdate, '%d-%b-%y') OrderDate,CONCAT(c.paitentname,'(',c.mobileno,')') AS Paitent,shortcode,productname,SUM(a.qty) AS Qty 
      FROM preorderitems AS a JOIN preordermaster AS b ON a.uniqueno=b.uniqueno
      JOIN paitentmaster AS c ON b.patientid=c.paitentid  
      WHERE orderdate BETWEEN '$FromPeriod' AND '$ToPeriod' and b.orderstatus ='Open'
      GROUP BY  DATE_FORMAT(b.orderdate, '%d-%b-%y'),CONCAT(c.paitentname,'(',c.mobileno,')'),shortcode,productname


");


 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>  
<th width='%'> Ord.Date </th>		    
<th width='%'> Paitent </th>		    
		            
		<th width='%'> SC </th>    
		<th width='%'>  Product </th>        
		<th width='%'>  Qty </th>         
		 
		</tr> </thead> <tbody  >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td>$SerialNo</td>
  <td > $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>            
   
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
 SELECT DATE_FORMAT(b.orderdate, '%d-%b-%y') OrderDate,CONCAT(c.paitentname,'(',c.mobileno,')') AS Paitent, 
 SUM(a.qty) AS Qty, sum(b.advanceamount) as Advance, orderid
      FROM preorderitems AS a JOIN preordermaster AS b ON a.uniqueno=b.uniqueno
      JOIN paitentmaster AS c ON b.patientid=c.paitentid  
      WHERE orderdate BETWEEN '$FromPeriod' AND '$ToPeriod'
	  and b.orderstatus ='Open'
      GROUP BY  DATE_FORMAT(b.orderdate, '%d-%b-%y'),CONCAT(c.paitentname,'(',c.mobileno,')') 


 ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		 
		<th  width='%'> Ord.Date</a></th>     
		<th  width='%'> Paitent</a></th>      
		<th width='%'> Qty</th>           
		<th width='%' > Advance </th>       
		<th width='%' > Cancel </th>       
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
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[3], false); echo "</td>  
   <td ><a href='' data-toggle='modal' data-target='#myModalCancel' onclick='LoadOrderId(" . $data[4] . ");'> <i
            class='fa fa-2x  fa-times-circle text-danger' title='Sales Cancel'></i></a>  </td>
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
		 
	 }

?> 