<?php

  
session_cache_limiter(FALSE);
session_start();
  
  
  
 // echo "1";
 include("../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
  $PaitentID=$_GET['P'];
 
  ?>




<style>
table.blueTable {
  border: 1px solid #1C6EA4;
  background: white;
  width: 40%; 
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 5px 5px; 
}

table.blueTable tbody td {
  font-size: 13px; 
}

table.blueTable tr:nth-child(even) {
  background: white;
}
 

table.blueTable thead th {
  font-size: 14px;
  font-weight: normal; 
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
  border-top: 2px solid #444444;
}
table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block; background: white;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
</style>


<?php


  
  // $FromDate = explode('/', $FromDate); 
// $ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0];
 // $ToDate = explode('/', $ToDate); 
// $ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0];

// $ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));

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
	  
$DebitAmount = 0;
$CreditAmount = 0;
$BalanceAmount = 0;
$PaitentName = '';

	    $TotalStock = mysqli_query($connection, "  

      
SELECT  round(sum(Debit),0),  round(sum(Credit),0),round(sum(Debit-Credit),0) as Total,b.paitentname

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
 
ORDER BY 1,2 ASC,4 ) AS a               
JOIN paitentmaster AS b ON a.paitientcode=b.`paitentid`
");
  
 
 
while($data = mysqli_fetch_row($TotalStock))
{
   

$DebitAmount = formatMoney($data[0], false); 
$CreditAmount = formatMoney($data[1], false);  
$BalanceAmount = formatMoney($data[2], false); 
$PaitentName  = $data[3]; 
}
				 

				
 
$result = mysqli_query($connection, " 
 
      
SELECT   saledate,  DATE,saleid,
 Transcation,  Debit,  
Credit,
@running_total:=@running_total + Debit - Credit AS cumulative_sum

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
 
ORDER BY 1,2 ASC,4 ) AS a       

JOIN paitentmaster AS b ON a.paitientcode=b.`paitentid`
JOIN (SELECT @running_total:=0) r



");

 
 //echo "<table id='tblProject' class='tblMasters'>";
echo"  
<body  style='width: 900px;' onload='window.print()'  >
<div id='DivInvoice'>


    <center>
    <b>SUGAMGUNAM</b><br> 
    Patient Transaction Ledger <br> 
    Name: $PaitentName<br> 
     

    </center> 
    
    
    ";

  echo " <table id='customers'  class='blueTable'  style='width: 900px;'    cellspacing='1' cellpadding='1'>";
echo " <thead><tr>  
		<th  width='%'><b>S.No</th>   	     
		            
		<th hidden width='%'><b> Date </th>    
		<th width='%'>  <b>Date </th>
    <th width='%'> <b> Ref. No </th>         
		<th width='%'>  <b>Transaction </th>         
	        
		<th width='%'> <b> Debit </th>         
    <th width='%'>  <b>Credit </th>       
    <th width='%'>  <b>Balance </th> 
		</tr> </thead> <tbody  >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td>$SerialNo</td>
  <td hidden > $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%' style='text-align: right;' >$data[4]</td>            
   <td width='%' style='text-align: right;' >$data[5]</td> ";
   if($data[6]<=0)
   {
    echo "<td width='%'  style='text-align: right;' >$data[6] Cr</td> ";
   }
   else
   {
    echo "<td width='%'  style='text-align: right;' >$data[6] Dr</td> ";
   }
   
echo " </tr>";

   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "<tr>";
echo "<td colspan = 4 ><b>Total</td>"; 
echo "<td style='text-align: right;'><b>$DebitAmount</td>";
echo "<td style='text-align: right;'><b>$CreditAmount</td>";
if($BalanceAmount<=0)
{
 echo "<td width='%'  style='text-align: right;' ><b>$BalanceAmount Cr</td> ";
}
else
{
 echo "<td width='%'  style='text-align: right;' ><b>$BalanceAmount Dr</td> ";
}
 
echo "</tr>";
echo "</tbody></table>";
       

?>  
    