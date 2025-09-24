<?php
  
session_cache_limiter(FALSE);
session_start();
  
  
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 			
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
  
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
 
$result = mysqli_query($connection, " 
 
      SELECT DATE_FORMAT(b.orderdate, '%d-%b-%y') OrderDate,CONCAT(c.suplier_name) AS Suplier,shortcode,productname,SUM(a.qty) AS Qty 
      FROM supplierpreorderitems AS a JOIN supplierpreordermaster AS b ON a.uniqueno=b.uniqueno
      JOIN supliers AS c ON b.patientid=c.suplier_id  
      WHERE orderdate BETWEEN '$ActualFromDate' AND '$ActualToDate' and b.orderstatus ='Open'
      GROUP BY  DATE_FORMAT(b.orderdate, '%d-%b-%y'),CONCAT(c.suplier_name),shortcode,productname


");

 
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>  
<th width='%'> Ord.Date </th>		    
<th width='%'> Supplier </th>		    
		            
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
      SELECT DATE_FORMAT(b.orderdate, '%d-%b-%y') OrderDate,CONCAT(c.suplier_name) AS Suplier,SUM(a.qty) AS Qty 
      FROM supplierpreorderitems AS a JOIN supplierpreordermaster AS b ON a.uniqueno=b.uniqueno
      JOIN supliers AS c ON b.patientid=c.suplier_id  
      WHERE orderdate BETWEEN '$ActualFromDate' AND '$ActualToDate' and b.orderstatus ='Open'
      GROUP BY  DATE_FORMAT(b.orderdate, '%d-%b-%y'),CONCAT(c.suplier_name) 


 ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		 
		<th  width='%'> Ord.Date</a></th>     
		<th  width='%'> Supplier</a></th>      
		<th width='%'> Qty</th>           
		       
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