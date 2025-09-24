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

SELECT b.suplier_name, DATE_FORMAT(a.returndate, '%d-%b-%y'),a.shortcode,a.category,a.productname,
a.batchcode,'-',-a.returnqty,ROUND(-a.rate,0),ROUND(-a.mrp,0),0,ROUND(-SUM(a.returnqty*rate),0)
 FROM purchasereturnitems AS a JOIN supliers AS b ON  a.suppliercode	=b.suplier_id JOIN 
 purchasereturnmaster AS c ON a.purchasereturnuniqueno=c.purchasereturnuniqueno
 where c.returndate BETWEEN '$ActualFromDate' AND '$ActualToDate'
 GROUP BY b.suplier_name,DATE_FORMAT(a.returndate, '%d-%b-%y'),a.shortcode,a.category,a.productname,
a.batchcode,-a.returnqty,-a.rate,-a.mrp


");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>      
		<th width='%'> Supplier </th>    
		<th width='%'> Inv.Date </th>    
		<th width='%'> S.code</th>    
		<th width='%'> Category </th>    
		<th width='%'>  Product </th>        
		<th width='%'>  Batch.No </th>        
		<th width='%'>  Exp.Dt </th>        
		<th width='%'> Qty </th>        
		<th width='%'> Rate </th>        
		<th width='%'> MRP </th>        
		<th width='%'> Profit </th>        
		<th width='%'> Total </th>      
		 
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
   <td width='%'>$data[5]</td>           
   <td width='%'>$data[6]</td>            
   <td width='%' style='text-align:right;'>$data[7]</td>             
   <td width='%' style='text-align:right;'>$data[8]</td>             
   <td width='%' style='text-align:right;'>$data[9]</td>    

   <td width='%' style='text-align:right;'>"; echo formatMoney($data[10], false); echo "</td>    
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[11], false); echo "</td>  
  
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
 

SELECT  DATE_FORMAT(a.returndate, '%d-%b-%y'),b.suplier_name, remarks AS Remarks,
SUM(-a.returnqty),0, ROUND(IFNULL(-SUM(a.returnqty*rate),0),2)
 FROM purchasereturnitems AS a JOIN supliers AS b ON  a.suppliercode =b.suplier_id JOIN 
 purchasereturnmaster AS c ON a.purchasereturnuniqueno=c.purchasereturnuniqueno
 WHERE a.returndate BETWEEN '$ActualFromDate' AND '$ActualToDate'
 GROUP BY b.suplier_name,DATE_FORMAT(a.returndate, '%d-%b-%y'),remarks

 ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		 
		<th  width='%'> Date</a></th>     
		<th  width='%'> Supplier</a></th>     
		<th width='%'> Remarks</th>           
		<th width='%'> Qty</th>           
		<th width='%' > Profit </th>        
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
  <td >$data[2]</td>  
   <td  width='%' style='text-align:right;' >"; echo formatMoney($data[3], false); echo "</td>  
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[4], false); echo "</td>     
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[5], false); echo "</td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
		 
	 }

?> 