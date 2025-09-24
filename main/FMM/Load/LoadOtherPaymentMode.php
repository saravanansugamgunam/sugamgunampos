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

}

table.blueTable tbody td {
    font-size: 13px;

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
<script src="../assets/Custom/IndexTable.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


<script>
// function myFunction() {
// var input, filter, table, tr, td, i, txtValue;
// input = document.getElementById("txtItemSearch");
// filter = input.value.toLowerCase();
// $("#tblItemwise tr").filter(function() {
// $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
// });
// alert(1);
// }

// $(document).ready(function(){
// $("#txtItemSearch").on("keyup", function() {
// var value = $(this).val().toLowerCase();
// alert(2);
// $("#tblItemwise tr").filter(function() {
// $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
// });
// });
</script>

<?php

session_cache_limiter(FALSE);
session_start();



// echo "1";
include("../../../connect.php");
$currentdate = date("Y-m-d");


function removeslashes($string)
{
  $string = implode("", explode("\\", $string));
  return stripslashes(trim($string));
}



$FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
$ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);

$LocationCode = $_SESSION['SESS_LOCATION'];

$Location = mysqli_real_escape_string($connection, $_POST["Location"]);
$PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);

if ($Location == 'All' || $Location == '') {
  $Location = '%';
}

if ($PaymentMode == 'All') {
  $PaymentMode = '%';
}


$FromDate = explode('/', $FromDate);
$ActualFromDate = $FromDate[2] . '-' . $FromDate[1] . '-' . $FromDate[0];
$ToDate = explode('/', $ToDate);
$ActualToDate = $ToDate[2] . '-' . $ToDate[1] . '-' . $ToDate[0];

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


// $TotalStock = mysqli_query($connection, " SELECT a.`transactionmode` ,c.paymentmode,SUM(b.amount) FROM transactionledger AS a 
// JOIN salepaymentdetails AS b ON a.invoicegrn=b.invoiceno 
// AND a.invoicegrndate=b.date
// AND a.vendorcode=b.customercode
// AND a.creditamount=b.amount
// JOIN paymentmodemaster AS c ON b.paymentmode=c.paymentmodecode
// WHERE invoicegrndate BETWEEN '2022-12-01' AND '2022-12-03'  AND 
// a.transactiontype ='Therapy'
// GROUP BY  transactionmode,c.paymentmode  ");




$TotalStock = mysqli_query($connection, " 
SELECT a.paymentmode,SUM(Receipt),SUM(IFNULL((b.`amountcredited`),0)) AS Credited,
SUM(Receipt-IFNULL((b.`amountcredited`),0)) 
 FROM (
  
  SELECT a.DATE,a.paymentmode AS Paymode,b.paymentmode,SUM(amount) AS Receipt, a.clientid 
FROM  salepaymentdetails AS a JOIN paymentmodemaster AS b ON
a.paymentmode=b.paymentmodecode  
WHERE a.transactionstatus='Live' and a.DATE BETWEEN  '$ActualFromDate' AND '$ActualToDate' 
 AND a.paymentmode<>'12' AND a.clientid  LIKE '$Location' and b.paymentmodecode like '$PaymentMode' and transactiontype not
 in('Supplier Payment','ExpenseEntry','Therapy Share','Salary','RefundToCustomer',
 'Doctor Share','Incentive','Bonus','Supplier Payment','Advance')
GROUP BY b.paymentmode,a.DATE,a.paymentmode,a.clientid ) AS a LEFT JOIN 

(SELECT  b.date, b.paymentmode,b.locationcode,SUM(b.amountcredited) AS amountcredited  FROM otherpaymentdayclosure AS b
GROUP BY b.date, b.paymentmode,b.locationcode) AS b ON a.Paymode=b.paymentmode AND
a.date=b.date AND a.`clientid`=b.locationcode 
GROUP BY a.paymentmode 
 ORDER BY paymentmode DESC  ");

echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;' class='blueTable' >";
echo " <thead> 
<tr>  
		     
		<th nowrap width='%'> Mode</th>        
		<th nowrap width='%'> Collection</th>        
		<th nowrap width='%'> Credited in account</th>        
		<th nowrap width='%'> Difference</th>             
		 </tr>
  </thead> <tbody>";

while ($data = mysqli_fetch_row($TotalStock)) {
  echo "
  <tr>     
   <td  nowrap width='%'>";
  echo $data[0];
  echo "</td>
   <td align='right' width='%'>";
  echo formatMoney($data[1], false);
  echo "</td>
   <td  align='right' width='%'>";
  echo formatMoney($data[2], false);
  echo "</td>
   <td  align='right' width='%'>";
  echo formatMoney($data[3], false);
  echo "</td>   
    
  
  </tr>";
}

echo "</tbody></table>";

$result = mysqli_query($connection, " 
SELECT a.DATE,Paymode,clientid,DATE_FORMAT(a.DATE,'%d-%m-%Y'),a.paymentmode,

transactiontype,CONCAT(paitentname,'(',invoiceno,')'),
Receipt,
IFNULL((b.`amountcredited`),0) AS Credited,
Receipt-IFNULL((b.`amountcredited`),0),invoiceno,c.`remarks`
 FROM (
  
SELECT a.DATE,a.paymentmode AS Paymode,b.paymentmode,SUM(amount) AS Receipt, a.clientid,a.transactiontype ,a.invoiceno, c.`paitentname`
FROM  salepaymentdetails AS a JOIN paymentmodemaster AS b ON
a.paymentmode=b.paymentmodecode   LEFT JOIN paitentmaster AS c ON a.`customercode` = c.`paitentid`  
WHERE  a.transactionstatus='Live' and  a.DATE BETWEEN  '$ActualFromDate' AND '$ActualToDate' 
AND a.paymentmode<>'12' AND a.clientid  LIKE '$Location'  and b.paymentmodecode like '$PaymentMode' and transactiontype not
in('Supplier Payment','ExpenseEntry','Therapy Share','Salary','RefundToCustomer',
'Doctor Share','Incentive','Bonus','Supplier Payment','Advance') and 
transactiontype IN('CashAdvance','DoctorFee','OutstandingCollection','Sales','Therapy Payment')
GROUP BY b.paymentmode,a.DATE,a.paymentmode,a.clientid,a.transactiontype ,a.invoiceno , c.`paitentname`

union all 
 
SELECT a.DATE,a.paymentmode AS Paymode,b.paymentmode,SUM(amount) AS Receipt, a.clientid,a.transactiontype ,a.invoiceno,'-' 
FROM  salepaymentdetails AS a JOIN paymentmodemaster AS b ON
a.paymentmode=b.paymentmodecode  
WHERE  a.transactionstatus='Live' and  a.DATE BETWEEN  '$ActualFromDate' AND '$ActualToDate' 
AND a.paymentmode<>'12' AND a.clientid  LIKE '$Location'  and b.paymentmodecode like '$PaymentMode' and transactiontype not
in('Supplier Payment','ExpenseEntry','Therapy Share','Salary','RefundToCustomer',
'Doctor Share','Incentive','Bonus','Supplier Payment','Advance', 'CashAdvance','DoctorFee','OutstandingCollection','Sales','Therapy Payment')
GROUP BY b.paymentmode,a.DATE,a.paymentmode,a.clientid,a.transactiontype ,a.invoiceno 

) AS a LEFT JOIN 
otherpaymentdayclosure AS b ON a.Paymode=b.paymentmode AND
a.date=b.date AND a.`clientid`=b.locationcode  and b.reference = a.invoiceno LEFT JOIN remarksmaster AS c ON a.invoiceno=c.uniquereference ORDER BY a.invoiceno DESC
  
 ");


//echo "<table id='tblProject' class='tblMasters'>";
echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>               
		<th hidden  width='%'> Date</a></th>    
		<th hidden  width='%'> Payment Mode ID  </th>     
		<th hidden  width='%'> Location ID  </th>     
		<th  width='%'> Date  </th>     
		<th  width='%'> Payment Mode</th> 
		<th  width='%'> Transaction</th> 
		
	<th  width='%'> Ref.No</th> 
		<th  width='%'> Remarks</th>     
		<th  width='%'> Receipt</th>     
		<th width='%'> Credited in Acount</th>           
		<th width='%'> Difference </th>
		<th hidden width='%'> Ref.No</th> ";


$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
  <td width='%'> $SerialNo</a></td>";


  echo " <td hidden  id='tblPaymentDate' >$data[0]</td>  
  <td   hidden id='tblPaymentMode' >$data[1]</td>  
   <td   hidden id='tblLocationCode'  width='%'>$data[2]</td>  
   <td width='%'>$data[3]</td>  
   <td width='%'>$data[4]</td>  
   <td width='%'>$data[5]</td>  
   <td width='%' id='e' >$data[6]</td>  
   <td width='%' id='e' >$data[11]</td>  

   <td id='tblPaymentAmount'  align='right' width='%'>$data[7]</td> ";

  if ($data[8] == 0) {
    echo "<td align='right' width='%'  onclick='GetPaymentID(this);'>
   <a href='#modal-dialog'  data-toggle='modal'><i class='fa fa-pencil'></i>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data[7]</a> 
</td>  ";
  } else {
    echo "<td align='right' >$data[8]</td>";
  }

  if ($data[9] > 0) {
    echo "<td bgcolor='#F4B084' align='right' width='%' >$data[9]</td>          ";
  } else {
    echo "<td bgcolor='#C6E0B4' align='right' width='%' >$data[9]</td>          ";
  }
  echo " <td width='%' id='tblReference' hidden >$data[10]</td>  ";

  echo "</tr>";

  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
  $SerialNo = $SerialNo + 1;
}
echo "</tbody></table>";



?>