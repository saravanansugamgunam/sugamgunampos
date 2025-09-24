<style>
table.blueTable {
    border: 1px solid #1C6EA4;
    background-color: #EEEEEE;
    width: 40%;
    text-align: left;
    border-collapse: collapse;
}

table.blueTable td,
table.blueTable th {
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

table.blueTable tfoot .links a {
    display: inline-block;
    background: #1C6EA4;
    color: #FFFFFF;
    padding: 2px 8px;
    border-radius: 5px;
}
</style>
<?php

function formatMoney($number, $fractional = false)
{
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
$currentdate = date("Y-m-d");


$FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
$ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
$SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]);
$Period = mysqli_real_escape_string($connection, $_POST["Period"]);


if ($Period == 'Today') {
  $FromPeriod = $currentdate;
  $ToPeriod = $currentdate;
} else if ($Period == 'Yesterday') {
  $FromPeriod = date('Y-m-d', (strtotime('-1 day', strtotime($currentdate))));
  $ToPeriod = date('Y-m-d', (strtotime('-1 day', strtotime($currentdate))));
} else if ($Period == 'CurrentMonth') {
  $FromPeriod = date('Y-m-01', strtotime($currentdate));
  $ToPeriod = date('Y-m-t', strtotime($currentdate));
} else if ($Period == 'Last7Days') {
  $FromPeriod = date('Y-m-d', (strtotime('-7 day', strtotime($currentdate))));
  $ToPeriod = $currentdate;
} else if ($Period == 'Last14Days') {
  $FromPeriod = date('Y-m-d', (strtotime('-14 day', strtotime($currentdate))));
  $ToPeriod = $currentdate;
} else if ($Period == 'Last30Days') {
  $FromPeriod = date('Y-m-d', (strtotime('-30 day', strtotime($currentdate))));
  $ToPeriod = $currentdate;
} else if ($Period == 'Custom') {
  $FromPeriod = $FromDate;
  $ToPeriod = $ToDate;
}





$TotalStock = mysqli_query($connection, "
      SELECT 
      (SELECT SUM(debitamount)  FROM transactionledger as a join diagnosissalemaster as b on a.invoicegrn=b.diagnosisuniqueno  
      WHERE transactiontype='Diagnosis'  AND saledate BETWEEN '$FromPeriod' and '$ToPeriod' AND transactionmode='Diagnosis Fee' 
      and vendorcode like '$SupplierCode'  ORDER BY 1 DESC) AS TotalTherapy,
      (SELECT SUM(creditamount)  FROM transactionledger as a join diagnosissalemaster as b on a.invoicegrn=b.diagnosisuniqueno  
      WHERE transactiontype='Diagnosis'  AND saledate BETWEEN '$FromPeriod' and '$ToPeriod' AND transactionmode='Diagnosis - Advance Payment' 
      and vendorcode like '$SupplierCode' ORDER BY 1 DESC) AS TherapyAdvance,
      (SELECT SUM(creditamount)  FROM transactionledger as a join diagnosissalemaster as b on a.invoicegrn=b.diagnosisuniqueno  
       WHERE transactiontype='Diagnosis'  AND saledate BETWEEN '$FromPeriod' and '$ToPeriod' AND transactionmode='Diagnosis Fee - Payment' 
       and vendorcode like '$SupplierCode' ORDER BY 1 DESC) AS TherapyPayment ,
      (SELECT SUM(creditamount)  FROM transactionledger as a  
       WHERE transactiontype='Diagnosis'  AND invoicegrndate BETWEEN '$FromPeriod' and '$ToPeriod' AND transactionmode='Diagnosis - Outstanding Payment' 
       and vendorcode like '$SupplierCode' ORDER BY 1 DESC) AS TherapyOutstandigPayment 
 
 ");


echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;width:20%' class='blueTable' >";
echo " <thead> 
<tr>  
		             
		<th nowrap width='%'> Total </th>             
		<th nowrap width='%'> Advance Payment </th>             
		<th nowrap width='%'> Full Payment </th>             
		<th nowrap width='%'> Outstanding Collection </th>             
		<th nowrap width='%'> Balance to Receive </th>             
		 </tr>
  </thead> <tbody>";

while ($data = mysqli_fetch_row($TotalStock)) {
  echo "
  <tr>     
   <td width='%'><b>&#x20B9; ";
  echo formatMoney($data[0], false);
  echo "</b></td> 
   <td width='%'><b>&#x20B9; ";
  echo formatMoney($data[1], false);
  echo "</b></td> 
   <td width='%'><b>&#x20B9; ";
  echo formatMoney($data[2], false);
  echo "</b></td> 
   <td width='%'><b>&#x20B9; ";
  echo formatMoney($data[3], false);
  echo "</b></td> 
   <td width='%'><b>&#x20B9; ";
  echo formatMoney($data[0] - ($data[1] + $data[2] + $data[3]), false);
  echo "</b></td> 
  
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
a.transactiontype ='Diagnosis' AND creditamount > 0
GROUP BY   c.paymentmode ");

echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;' class='blueTable' width='50%' >";
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

SELECT  invoicegrn,date_format(saledate,'%d-%m-%Y'), 
paitentname, SUM(debitamount) AS ToPay,
SUM(creditamount) AS Paid, 
SUM(debitamount) - SUM(creditamount) as Balance,
if(SUM(creditamount) - SUM(debitamount)= 0,0,SUM(creditamount)- (SUM(debitamount))) AS Collection,paitentid,
samplecollected,resultstatus,date_format(samplecollecteddatetime,'%d-%m-%Y %H:%m'),date_format(deliverydate,'%d-%m-%Y')
 FROM(

  SELECT invoicegrn, b.saledate,CONCAT(d.paitentname,'<br>',d.mobileno) as paitentname,
c.creditamount,c.debitamount,b.paitentid, samplecollected,resultstatus,samplecollecteddatetime,deliverydate
 FROM diagnosisitems AS a 
JOIN diagnosissalemaster AS b ON a.diagnosisuniqueid=b.diagnosisuniqueno 
JOIN transactionledger AS c ON b.diagnosisuniqueno=c.invoicegrn
JOIN paitentmaster AS d ON b.paitentid=d.paitentid 
 WHERE transactiontype='Diagnosis' AND transactionmode='Diagnosis Fee'  AND 
 saledate BETWEEN   '$FromPeriod' and '$ToPeriod'  
 UNION
 
SELECT invoicegrn, b.saledate,CONCAT(d.paitentname,'<br>',d.mobileno),
c.creditamount,c.debitamount,b.paitentid,'0','-','-','-'
 FROM diagnosisitems AS a 
JOIN diagnosissalemaster AS b ON a.diagnosisuniqueid=b.diagnosisuniqueno 
JOIN transactionledger AS c ON b.diagnosisuniqueno=c.invoicegrn
JOIN paitentmaster AS d ON b.paitentid=d.paitentid 
 WHERE transactiontype='Diagnosis' AND transactionmode='Diagnosis Fee - Payment'  AND 
 saledate BETWEEN   '$FromPeriod' and '$ToPeriod' 
 
 UNION
 
 SELECT invoicegrn, b.saledate,CONCAT(d.paitentname,'<br>',d.mobileno),
 c.creditamount,c.debitamount,b.paitentid,'0','-','-','-'
  FROM diagnosisitems AS a 
 JOIN diagnosissalemaster AS b ON a.diagnosisuniqueid=b.diagnosisuniqueno 
 JOIN transactionledger AS c ON b.diagnosisuniqueno=c.invoicegrn
 JOIN paitentmaster AS d ON b.paitentid=d.paitentid 
  WHERE transactiontype='Diagnosis' AND transactionmode='Diagnosis - Outstanding Payment'  AND 
  saledate BETWEEN   '$FromPeriod' and '$ToPeriod'  

 ) AS a 
 
 GROUP BY  invoicegrn,saledate, 
 paitentname  ORDER BY saledate DESC

 ");





//echo "<table id='tblProject' class='tblMasters'>";

echo "  	<table id='data-table' class='table table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>              
		<th hidden width='%'><a href=\"javascript:SortTable(2,'T');\">Code</a></th>         
		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Date</a></th>         
		 		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Paitent</a></th>           
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">To Pay</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Paid</a></th>        
     <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Balance</a></th> 
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Sample Collected</a></th>   
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Report Delivered</a></th>  
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Report View</a></th>  
         
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">View</a></th>   
		 
		</tr> </thead> <tbody id='ProjectTable'>";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden > $data[0]</td>
  <td >$data[1]</td>   
   ";
  echo "<td width='%' align='left'>";
  echo $data[2];
  echo "</td>";
  echo "<td width='%' align='right'>";
  echo formatMoney($data[3], false);
  echo "</td>";
  echo "<td width='%' align='right'>";
  echo formatMoney($data[4], false);
  echo "</td>";
  echo "<td width='%' align='right'>";
  echo formatMoney($data[5], false);
  echo "</td>";

  if($data[8]=='0')
  {
    echo "<td >
    <a  href='#ModalSampleCollection' data-toggle='modal' 
    onclick='GetID($data[0],$data[7],$data[5]);'  
    >Not Collected <i class='fa fa-pencil' title='View'></i> </a> </td>";
  }
  else
  {
    echo "<td >$data[8]<br>
    $data[10]</td>";
  }


  if($data[9]=='Not Delivered')
  {
    echo "<td >
    <a  href='#ModalDeliveryReport' data-toggle='modal' 
    onclick='GetID($data[0],$data[7],$data[5]);LoadMedicalReports();'  
    >Not Delivered <i class='fa fa-pencil' title='View'></i> </a> </td>";
  }
  else
  {
    echo "<td >$data[9]<br>
    $data[11]</td>";
  }
    
echo "</td>
<td align='center' style='color:#009ad9'>
<a  href='LabReport.php?invoice=$data[0]'  target='_blank'> 
<i class='fa fa-2x fa-file-pdf-o' title='View'></i></a> </td>

<td align='center' style='color:#009ad9'>
    <a href='ReceiptPrint.php?invoice=$data[0]' target='_blank' ?>
<i class='fa fa-2x fa-eye' title='View'></i></a>
</td>";


echo "</tr>";


//echo "<br>";
$SerialNo = $SerialNo + 1;
}
echo "</tbody>
</table>";


?>


<script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="../assets/js/table-manage-default.demo.min.js"></script>

<script>
$(document).ready(function() {

    TableManageDefault.init();
});
</script>