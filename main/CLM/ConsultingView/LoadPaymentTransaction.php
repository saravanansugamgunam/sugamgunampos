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

session_cache_limiter(FALSE);
session_start();



// echo "1";
include("../../../connect.php");
$currentdate = date("Y-m-d");
$PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);

// $FromDate = explode('/', $FromDate); 
// $ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0];
// $ToDate = explode('/', $ToDate); 
// $ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0];

// $ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));

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

$TotalStock = mysqli_query($connection, "  

      
SELECT  round(sum(Debit),0),  round(sum(Credit),0),round(sum(Debit-Credit),0) as Total

FROM (
SELECT saledate,'a. SaleMaster' AS Source, DATE_FORMAT(saledate, '%d-%m-%Y')AS DATE,paitientcode,saleid,saleuniqueno, 'Purchase' AS Transcation ,nettamount AS Debit, 0 AS 
Credit FROM salemaster WHERE cancellstatus='0' AND paitientcode LIKE  ('$PaitentID') AND transactiontype ='Sale'
UNION
SELECT saledate,'a. SaleMaster' AS Source,DATE_FORMAT(saledate, '%d-%m-%Y')AS DATE,paitientcode,saleid,saleuniqueno,'Return',0, -nettamount FROM 
salemaster WHERE cancellstatus='0' AND paitientcode LIKE  ('$PaitentID') AND transactiontype ='Return'
UNION
SELECT courierdate,'c.Courier' AS Source, DATE_FORMAT(courierdate, '%d-%m-%Y')AS DATE,b.paitientcode,b.saleid,b.saleuniqueno,'Courier',couriercharge,0
FROM courierdetails AS a  JOIN salemaster AS b ON a.invoicenumber = b.saleuniqueno  where b.paitientcode LIKE  ('$PaitentID')
UNION
 
SELECT billdate,'d.Consulting' AS Source, DATE_FORMAT(billdate, '%d-%m-%Y')AS DATE,paitentid,consultationuniquebill,consultationuniquebill,'Doctor Consultion',totalamount,0
FROM consultingbillmaster  where paitentid LIKE( '$PaitentID')
UNION
SELECT invoicegrndate,'Ledger' AS Source,DATE_FORMAT(invoicegrndate, '%d-%m-%Y')AS DATE,vendorcode,invoicegrn, invoicegrn,
'Outstanding Adjustment',0,debitamount FROM transactionledger WHERE vendorcode LIKE( '$PaitentID') AND transactionmode ='Medicne - Outstanding Adjustment' 
UNION
SELECT invoicegrndate,'Ledger' AS Source,DATE_FORMAT(invoicegrndate, '%d-%m-%Y')AS DATE,vendorcode,invoicegrn, invoicegrn,
'Outstanding Adjustment',creditamount,0 FROM transactionledger WHERE vendorcode LIKE( '$PaitentID') AND transactionmode ='Medicne - Liability Adjustment' 
 
UNION
SELECT invoicegrndate,'Ledger' AS Source,DATE_FORMAT(invoicegrndate, '%d-%m-%Y')AS DATE,vendorcode,invoicegrn, invoicegrn,
'Liability Adjustment',0,creditamount FROM transactionledger WHERE vendorcode LIKE( '$PaitentID') AND transactionmode ='Medicne - Liability Adjustment' 
 
UNION
SELECT invoicegrndate,'Ledger' AS Source,DATE_FORMAT(invoicegrndate, '%d-%m-%Y')AS DATE,vendorcode,invoicegrn, invoicegrn,
'Liability Transfer',debitamount,0 FROM transactionledger WHERE vendorcode LIKE( '$PaitentID') AND transactionmode ='Liability Transfer Debit' 
  
UNION
SELECT invoicegrndate,'Ledger' AS Source,DATE_FORMAT(invoicegrndate, '%d-%m-%Y')AS DATE,vendorcode,invoicegrn, invoicegrn,
'Therapy - Cancellation',0,creditamount FROM transactionledger WHERE vendorcode LIKE( '$PaitentID') AND transactionmode ='Therapy - Cancellation' 
 

UNION

SELECT DATE,'Payment' AS Source,DATE_FORMAT(DATE, '%d-%m-%Y')AS DATE,customercode,paymentid, invoiceno,'Pre Order',0,amount FROM salepaymentdetails WHERE transactionstatus ='Live' AND customercode LIKE( '$PaitentID') AND transactiontype ='PaitentOrder'
UNION
SELECT DATE,'Payment' AS Source,DATE_FORMAT(DATE, '%d-%m-%Y')AS DATE,customercode,paymentid, invoiceno,'Purchase Payment',0,amount FROM salepaymentdetails WHERE transactionstatus ='Live' AND customercode LIKE( '$PaitentID') AND transactiontype ='Sales'
UNION
SELECT DATE,'Payment' AS Source,DATE_FORMAT(DATE, '%d-%m-%Y')AS DATE,customercode,paymentid, invoiceno,'Outtanding Payment',0,amount FROM salepaymentdetails WHERE transactionstatus ='Live' AND customercode LIKE( '$PaitentID') AND transactiontype ='OutstandingCollection' 
UNION
SELECT DATE,'Payment' AS Source,DATE_FORMAT(DATE, '%d-%m-%Y')AS DATE,customercode,paymentid, invoiceno,'Cash Advance',0,amount FROM salepaymentdetails WHERE transactionstatus ='Live' AND customercode LIKE( '$PaitentID') AND transactiontype ='CashAdvance' 
UNION
SELECT DATE,'Payment' AS Source,DATE_FORMAT(DATE, '%d-%m-%Y')AS DATE,customercode,paymentid, invoiceno,'Consultation Fee',0,amount FROM salepaymentdetails WHERE transactionstatus ='Live' AND customercode LIKE( '$PaitentID') AND transactiontype ='DoctorFee' 
UNION
SELECT DATE,'Payment' AS Source,DATE_FORMAT(DATE, '%d-%m-%Y')AS DATE,customercode,paymentid, invoiceno,'Consultation Fee',0,amount FROM salepaymentdetails WHERE transactionstatus ='Live' AND customercode LIKE( '$PaitentID') AND transactiontype ='Therapy Payment' 
UNION
SELECT DATE,'Payment' AS Source,DATE_FORMAT(DATE, '%d-%m-%Y')AS DATE,customercode,paymentid, invoiceno,'Refund',amount,0 FROM salepaymentdetails WHERE transactionstatus ='Live' AND customercode LIKE( '$PaitentID') AND transactiontype ='RefundToCustomer' 
 
) AS a               
JOIN paitentmaster AS b ON a.paitientcode=b.`paitentid`  ORDER BY 1 desc, 2 asc

");

echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;' class='blueTable' >";
echo " <thead> 
<tr>  
		              
		<th width='%'> Debit</th>        
		<th width='%'> Credit </th>        
		<th width='%'> Balance  </th>           
		 </tr>
  </thead> <tbody>";

while ($data = mysqli_fetch_row($TotalStock)) {
  echo "
  <tr>    
   <td width='%'>";
  echo formatMoney($data[0], false);
  echo "</td>
   <td width='%'>";
  echo formatMoney($data[1], false);
  echo "</td>
   <td width='%'>";
  echo formatMoney($data[2], false);
  echo "</td> 
  
  </tr>";
}




$result = mysqli_query($connection, " 
 
      
SELECT   saledate,  DATE,
 Transcation, saleuniqueno, Debit,  
Credit,TransactionType

FROM (
SELECT saledate,'a. SaleMaster' AS Source, DATE_FORMAT(saledate, '%d-%m-%Y')AS DATE,paitientcode,saleid,saleuniqueno, 'Medicine Bill' AS Transcation ,nettamount AS Debit, 0 AS 
Credit,1 as TransactionType FROM salemaster WHERE cancellstatus='0' AND paitientcode LIKE  ('$PaitentID') AND transactiontype ='Sale'
UNION
SELECT saledate,'a. SaleMaster' AS Source,DATE_FORMAT(saledate, '%d-%m-%Y')AS DATE,paitientcode,saleid,saleuniqueno,'Return',0, -nettamount,1 FROM 
salemaster WHERE cancellstatus='0' AND paitientcode LIKE  ('$PaitentID') AND transactiontype ='Return'
UNION
SELECT courierdate,'c.Courier' AS Source, DATE_FORMAT(courierdate, '%d-%m-%Y')AS DATE,b.paitientcode,b.saleid,b.saleuniqueno,
'Courier',couriercharge,0,1
FROM courierdetails AS a  JOIN salemaster AS b ON a.invoicenumber = b.saleuniqueno  where b.paitientcode LIKE  ('$PaitentID')
UNION
 
SELECT billdate,'d.Consulting' AS Source, DATE_FORMAT(billdate, '%d-%m-%Y')AS DATE,paitentid,consultationuniquebill,
consultationuniquebill,'Consultion Bill',totalamount,0,2
FROM consultingbillmaster  where paitentid LIKE( '$PaitentID') and billtype='Consultation'
UNION 

SELECT billdate,'d.Consulting' AS Source, DATE_FORMAT(billdate, '%d-%m-%Y')AS DATE,paitentid,consultationuniquebill,
consultationuniquebill,'Therapy Bill',totalamount,0,3
FROM consultingbillmaster  where paitentid LIKE( '$PaitentID') and billtype='Therapy'

UNION
SELECT invoicegrndate,'Ledger' AS Source,DATE_FORMAT(invoicegrndate, '%d-%m-%Y')AS DATE,vendorcode,invoicegrn, invoicegrn,
'Outstanding Adjustment',debitamount,0,0 FROM transactionledger WHERE vendorcode LIKE( '$PaitentID') AND transactionmode ='Medicne - Outstanding Adjustment' 
UNION
SELECT invoicegrndate,'Ledger' AS Source,DATE_FORMAT(invoicegrndate, '%d-%m-%Y')AS DATE,vendorcode,invoicegrn, invoicegrn,
'Liability Adjustment',0,creditamount,0 FROM transactionledger WHERE vendorcode LIKE( '$PaitentID') AND transactionmode ='Medicne - Liability Adjustment' 
 
UNION
SELECT invoicegrndate,'Ledger' AS Source,DATE_FORMAT(invoicegrndate, '%d-%m-%Y')AS DATE,vendorcode,invoicegrn, invoicegrn,
'Liability Transfer',debitamount,0,0 FROM transactionledger WHERE vendorcode LIKE( '$PaitentID') AND transactionmode ='Liability Transfer Debit' 
  
UNION
SELECT invoicegrndate,'Ledger' AS Source,DATE_FORMAT(invoicegrndate, '%d-%m-%Y')AS DATE,vendorcode,invoicegrn, invoicegrn,
'Therapy - Cancellation',0,SUM(creditamount),3 FROM transactionledger WHERE vendorcode LIKE( '$PaitentID') AND transactionmode ='Therapy - Cancellation' 
 GROUP BY invoicegrndate

UNION  


SELECT DATE,'Payment' AS Source,DATE_FORMAT(DATE, '%d-%m-%Y')AS DATE,customercode,paymentid, invoiceno,'Pre Order',0,amount,0 
FROM salepaymentdetails WHERE transactionstatus ='Live' AND customercode LIKE( '$PaitentID') AND transactiontype ='PaitentOrder'
UNION
SELECT DATE,'Payment' AS Source,DATE_FORMAT(DATE, '%d-%m-%Y')AS DATE,customercode,paymentid, invoiceno,'Medicine Payment',0,amount,1
 FROM salepaymentdetails WHERE transactionstatus ='Live' AND customercode LIKE( '$PaitentID') AND transactiontype ='Sales'
UNION
SELECT DATE,'Payment' AS Source,DATE_FORMAT(DATE, '%d-%m-%Y')AS DATE,customercode,paymentid, invoiceno,'Outstanding Payment',0,amount,0 
FROM salepaymentdetails WHERE transactionstatus ='Live' AND customercode LIKE( '$PaitentID') AND transactiontype ='OutstandingCollection' 
UNION
SELECT DATE,'Payment' AS Source,DATE_FORMAT(DATE, '%d-%m-%Y')AS DATE,customercode,paymentid, invoiceno,'Cash Advance',0,amount,0 
FROM salepaymentdetails WHERE transactionstatus ='Live' AND customercode LIKE( '$PaitentID') AND transactiontype ='CashAdvance' 
UNION
SELECT DATE,'Payment' AS Source,DATE_FORMAT(DATE, '%d-%m-%Y')AS DATE,customercode,paymentid, invoiceno,'Consultation Fee',0,amount,2
FROM salepaymentdetails WHERE transactionstatus ='Live' AND customercode LIKE( '$PaitentID') AND transactiontype ='DoctorFee' 
UNION
SELECT DATE,'Payment' AS Source,DATE_FORMAT(DATE, '%d-%m-%Y')AS DATE,customercode,paymentid, invoiceno,'Therapy Payment',0,amount,3 
FROM salepaymentdetails WHERE transactionstatus ='Live' AND customercode LIKE( '$PaitentID') AND transactiontype ='Therapy Payment' 
UNION
SELECT DATE,'Payment' AS Source,DATE_FORMAT(DATE, '%d-%m-%Y')AS DATE,customercode,paymentid, invoiceno,'Refund',amount,0,0 
FROM salepaymentdetails WHERE transactionstatus ='Live' AND customercode LIKE( '$PaitentID') AND transactiontype ='RefundToCustomer' 
 
 order by saleuniqueno asc, saleid desc ) AS a               
JOIN paitentmaster AS b ON a.paitientcode=b.`paitentid` ORDER BY saledate desc ,saleuniqueno desc 


");


//echo "<table id='tblProject' class='tblMasters'>";
echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>   	     
		            
		<th hidden width='%'> Date </th>    
		<th width='%'>  Date </th>        
		<th width='%'>  Transaction </th>         
		<th width='%'>  Transaction ID </th>         
		<th width='%'>  Debit </th>         
		<th width='%'>  Credit </th>         
		<th width='%'>  View </th>         
		 
		</tr> </thead> <tbody  >";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
  <td>$SerialNo</td>
  <td hidden > $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>            
   <td width='%'>$data[5]</td>";

  if ($data[6] == 0) {
    echo    "<td width='%'>  </td> ";
  } else if ($data[6] == 1) {
    echo    "<td width='%'> <a href='Medicine_SaleBillView.php?invoice=$data[3]' target='_blank' >
    <i class='fa fa-2x fa-eye' title='View'></i></a></td> ";
  } else   if ($data[6] == 2) {
    echo    "<td width='%'> <a href='Consulting_SaleBillView.php?invoice=$data[3]' target='_blank' >
    <i class='fa fa-2x fa-eye' title='View'></i></a></td> ";
  } else   if ($data[6] == 3) {
    echo    "<td width='%'> <a href='SaleBillView.php?invoice=$data[3]' target='_blank' >
    <i class='fa fa-2x fa-eye' title='View'></i></a></td> ";
  }



  echo "</tr>";


  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
  $SerialNo = $SerialNo + 1;
}
echo "</tbody></table>";


?>