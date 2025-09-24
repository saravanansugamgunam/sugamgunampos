<style>
table.blueTable {
  border: 1px solid #1C6EA4; 
  background-color: #EEEEEE;
  width: 40%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 2px 2px;
    text-align: center;
}
table.blueTable tbody td {
  font-size: 13px;
   text-align: center;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #83b3e4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 1px solid #444444;
}
table.blueTable thead th {
  font-size: 14px;
  font-weight: normal;
  color: #FFFFFF;
  border-left: 1px solid #D0E4F5;
   padding: 5px 20px;
  
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
}
table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
</style>
<?php
  
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
				
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 		

 
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]); 
 $Period = mysqli_real_escape_string($connection,$_POST["Period"]);
 
		  
  if($Period=='Today')
  {
    $FromPeriod=$currentdate;
    $ToPeriod=$currentdate;

  }
  else if($Period=='Yesterday')
  {
    $FromPeriod=date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $currentdate) ) ));
    $ToPeriod=date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $currentdate) ) ));
 
  }
  else if($Period=='CurrentMonth')
  {
    $FromPeriod=date('Y-m-01', strtotime($currentdate));
    $ToPeriod=date('Y-m-t', strtotime($currentdate));
 

  }
  else if($Period=='Last7Days')
  {
    $FromPeriod=date('Y-m-d',(strtotime ( '-7 day' , strtotime ( $currentdate) ) ));
    $ToPeriod= $currentdate; 
  }
  else if($Period=='Last14Days')
  {
    $FromPeriod=date('Y-m-d',(strtotime ( '-14 day' , strtotime ( $currentdate) ) ));
    $ToPeriod= $currentdate; 
  }
  else if($Period=='Last30Days')
  {
    $FromPeriod=date('Y-m-d',(strtotime ( '-30 day' , strtotime ( $currentdate) ) ));
    $ToPeriod= $currentdate; 
  }
  else if($Period=='Custom')
  {
    $FromPeriod = $FromDate;
    $ToPeriod=$ToDate;
  }



 
	   
	    $TotalStock = mysqli_query($connection, "
      SELECT 
      (SELECT SUM(debitamount)  FROM transactionledger as a join therapybookingmaster as b on a.invoicegrn=b.bookinguniqueid  
      WHERE transactiontype='Therapy'  AND bookingdate BETWEEN '$FromPeriod' and '$ToPeriod' AND transactionmode='Therapy Bill' 
      and vendorcode like '$SupplierCode'  ORDER BY 1 DESC) AS TotalTherapy,
      (SELECT SUM(creditamount)  FROM transactionledger as a join therapybookingmaster as b on a.invoicegrn=b.bookinguniqueid  
      WHERE transactiontype='Therapy'  AND bookingdate BETWEEN '$FromPeriod' and '$ToPeriod' AND transactionmode='Therapy - Advance Payment' 
      and vendorcode like '$SupplierCode' ORDER BY 1 DESC) AS TherapyAdvance,
      (SELECT SUM(creditamount)  FROM transactionledger as a join therapybookingmaster as b on a.invoicegrn=b.bookinguniqueid  
       WHERE transactiontype='Therapy'  AND bookingdate BETWEEN '$FromPeriod' and '$ToPeriod' AND transactionmode='Therapy - Payment' 
       and vendorcode like '$SupplierCode' ORDER BY 1 DESC) AS TherapyPayment ,
      (SELECT SUM(creditamount)  FROM transactionledger as a  
       WHERE transactiontype='Therapy'  AND invoicegrndate BETWEEN '$FromPeriod' and '$ToPeriod' AND transactionmode='Therapy - Outstanding Payment' 
       and vendorcode like '$SupplierCode' ORDER BY 1 DESC) AS TherapyOutstandigPayment 
 
 ");
 
 
  echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;width:20%;' class='blueTable' >";
echo " <thead> 
<tr>  
		             
		<th nowrap width='%'> Total Therapy </th>             
		<th nowrap width='%'> Advance Payment </th>             
		<th nowrap width='%'> Full Payment </th>             
		<th nowrap width='%'> Outstanding Collection </th>             
		<th nowrap width='%'> Balance to Receive </th>             
		 </tr>
  </thead> <tbody>";
 
while($data = mysqli_fetch_row($TotalStock))
{
  echo "
  <tr>     
   <td width='%'><b>&#x20B9; "; echo formatMoney($data[0], false); echo "</b></td> 
   <td width='%'><b>&#x20B9; "; echo formatMoney($data[1], false); echo "</b></td> 
   <td width='%'><b>&#x20B9; "; echo formatMoney($data[2], false); echo "</b></td> 
   <td width='%'><b>&#x20B9; "; echo formatMoney($data[3], false); echo "</b></td> 
   <td width='%'><b>&#x20B9; "; echo formatMoney($data[0] - ($data[1] + $data[2] + $data[3]), false); echo "</b></td> 
  
  </tr>";
   
   
}

echo "</tbody></table><br>";
 
$TotalStock = mysqli_query($connection, "  SELECT  c.paymentmode,SUM(b.amount) 
FROM transactionledger AS a 
JOIN salepaymentdetails AS b ON a.invoicegrn=b.invoiceno 
AND a.invoicegrndate=b.date
AND a.vendorcode=b.customercode
-- AND a.creditamount=b.amount
JOIN paymentmodemaster AS c ON b.paymentmode=c.paymentmodecode
WHERE invoicegrndate BETWEEN '$FromPeriod' AND '$ToPeriod'  AND 
a.transactiontype ='Therapy' AND creditamount > 0
GROUP BY   c.paymentmode ");

echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;display:none' class='blueTable' width='50%' >";
echo " <thead> 
<tr>  
		     
		<th nowrap width='%'> Mode</th>              
		<th nowrap width='%'> Amount</th>      
		 </tr>
  </thead> <tbody>";

while ($data = mysqli_fetch_row($TotalStock)) {
  echo "
  <tr>     
   <td style='text-align:left' nowrap  width='%'>";
  echo $data[0];
  echo "</td>
   <td style='text-align:right' width='%'>";
  echo formatMoney($data[1], false);
  echo "</td>  
    
  
  </tr>";
}

echo "</tbody></table>";

 
echo "<br>";
  
$result = mysqli_query($connection, "  

SELECT  invoicegrn,date_format(bookingdate,'%d-%m-%Y'), date_format(revisedtherapydate,'%d-%m-%Y'),
paitentname,'-',consultationname,totalsitting,SUM(Total) AS TotalValue,
SUM(Advance) AS Advance,SUM(TotalPayment) AS Payment,SUM(Outstanding) AS OutstandingCollection,
if(consultationname='-',0,SUM(Total)- (SUM(Advance) + SUM(TotalPayment) + SUM(Outstanding))) AS Banalce,

vendorcode

 FROM(
 SELECT invoicegrn, c.bookingdate,c.revisedtherapydate,concat(b.paitentname,'<br>',b.mobileno) as paitentname, 
d.consultationname,c.totalsitting,a.transactionmode ,a.debitamount AS Total,0 AS Advance ,
0 AS TotalPayment,0 AS Outstanding,
a.vendorcode
  FROM transactionledger AS a JOIN paitentmaster AS b ON 
 a.vendorcode=b.paitentid
 JOIN therapybookingmaster AS c ON a.invoicegrn=c.bookinguniqueid 
JOIN  consultationmaster AS d ON c.therapyid=d.consultationid 
 WHERE transactiontype='Therapy' AND transactionmode='Therapy Bill'  and 
 bookingdate between   '$FromPeriod' and '$ToPeriod' and vendorcode like '$SupplierCode' 
  UNION
  
 SELECT  invoicegrn,c.bookingdate, c.revisedtherapydate,concat(b.paitentname,'<br>',b.mobileno),
d.consultationname,c.totalsitting,a.transactionmode ,0,0,a.creditamount,0,a.vendorcode
  FROM transactionledger AS a JOIN paitentmaster AS b ON 
 a.vendorcode=b.paitentid
 JOIN therapybookingmaster AS c ON a.invoicegrn=c.bookinguniqueid 
JOIN  consultationmaster AS d ON c.therapyid=d.consultationid 
 WHERE transactiontype='Therapy' AND transactionmode='Therapy - Payment'  and 
 bookingdate between   '$FromPeriod' and '$ToPeriod' and vendorcode like '$SupplierCode' 
  UNION
  
 SELECT  invoicegrn,c.bookingdate, c.revisedtherapydate,concat(b.paitentname,'<br>',b.mobileno),
d.consultationname,c.totalsitting,a.transactionmode ,0,a.creditamount,0,0,a.vendorcode
  FROM transactionledger AS a JOIN paitentmaster AS b ON 
 a.vendorcode=b.paitentid
 JOIN therapybookingmaster AS c ON a.invoicegrn=c.bookinguniqueid 
JOIN  consultationmaster AS d ON c.therapyid=d.consultationid 
 WHERE transactiontype='Therapy' AND transactionmode='Therapy - Advance Payment'  and 
 bookingdate between   '$FromPeriod' and '$ToPeriod' and vendorcode like '$SupplierCode' 
  UNION
  
 SELECT  invoicegrn,c.bookingdate, c.revisedtherapydate,concat(b.paitentname,'<br>',b.mobileno),
d.consultationname,c.totalsitting,a.transactionmode ,0,0,0,a.creditamount ,a.vendorcode
  FROM transactionledger AS a JOIN paitentmaster AS b ON 
 a.vendorcode=b.paitentid
 JOIN therapybookingmaster AS c ON a.invoicegrn=c.bookinguniqueid 
JOIN  consultationmaster AS d ON c.therapyid=d.consultationid 
 WHERE transactiontype='Therapy' AND transactionmode='Therapy - Outstanding Payment'  and 
 bookingdate between   '$FromPeriod' and '$ToPeriod' and vendorcode like '$SupplierCode'  
 
 union

 SELECT  invoicegrn,invoicegrndate,'-',  CONCAT(b.paitentname,'<br>',b.mobileno),
 '-','-',a.transactionmode ,0,0,0,a.creditamount ,a.vendorcode
   FROM transactionledger AS a JOIN paitentmaster AS b ON 
  a.vendorcode=b.paitentid  
  WHERE transactiontype='Therapy' AND transactionmode='Therapy - Outstanding Payment'  AND 
  invoicegrndate BETWEEN   '$FromPeriod' and '$ToPeriod' and vendorcode like '$SupplierCode'  

 ) AS a 
 
 GROUP BY  invoicegrn,bookingdate, revisedtherapydate,
 paitentname,consultationname,totalsitting,vendorcode ORDER BY revisedtherapydate DESC

 ");





 //echo "<table id='tblProject' class='tblMasters'>";

  echo "  	<table id='data-table' class='table table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>              
		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Booking Date</a></th>         
		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Therapy Date</a></th>         
		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Paitent</a></th>           
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Therapy</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Sittings</a></th>        
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Total</a></th>  
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Advance</a></th>  
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Payment</a></th>  
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Outstanding Collection</a></th>  
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Balance</a></th>  
    
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">View</a></th>  
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Payment</a></th>  
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td  > $data[1]</td>
  <td >$data[2]</td>  
   <td  width='%'>$data[3]</td>  
   <td  width='%'>$data[5]</td>   
   "; 
echo "<td width='%' align='right'>"; echo formatMoney($data[6], false); echo "</td>";
echo "<td width='%' align='right'>"; echo formatMoney($data[7], false); echo "</td>";
echo "<td width='%' align='right'>"; echo formatMoney($data[8], false); echo "</td>";
echo "<td width='%' align='right'>"; echo formatMoney($data[9], false); echo "</td>";
echo "<td width='%' align='right'>"; echo formatMoney($data[10], false); echo "</td>";
echo "<td width='%' align='right'>"; echo formatMoney($data[11], false); echo "</td>
 
<td align='center' style='color:#009ad9'  >
<a href='SaleBillView.php?invoice=$data[0]' target='_blank' ?>
<i class='fa fa-2x fa-eye' title='View'></i></a></td>";
 
if($data[11]==0)
{
  if($data[5]=='-')
  {
    echo  "<td bgcolor='#5bb734'> Old Payment</td>";
  }
  else
  {
    echo  "<td bgcolor='#5bb734'> Fully Paid</td>";
  }

}
else
{
echo "
<td bgcolor='#c3602c' align='center' >
 <button class='btn  m-r-5' href='#ModalPaymentDetails' 
  data-toggle='modal' onclick='GetID($data[0],$data[12],$data[11]);' > Collect </button>";
 
}

  echo "</tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    

?>


<script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
  <script src="../assets/js/table-manage-default.demo.min.js"></script>

  <script>
$(document).ready(function() {
    
    TableManageDefault.init();
});
  </script>