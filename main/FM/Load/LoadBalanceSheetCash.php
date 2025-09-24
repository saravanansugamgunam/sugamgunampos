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
  $currentdate =date("Y-m-d"); 			
  
   
		function removeslashes($string)
{
    $string=implode("",explode("\\",$string));
    return stripslashes(trim($string));
}



 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
  
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
  $LocationCode = $_SESSION['SESS_LOCATION'];
  
    $Location = mysqli_real_escape_string($connection, $_POST["Location"]); 
    $Ledger = mysqli_real_escape_string($connection, $_POST["Ledger"]); 
    $ExpenseIncomeFilter = mysqli_real_escape_string($connection, $_POST["ExpenseIncomeFilter"]); 
    $Category = removeslashes(mysqli_real_escape_string($connection, $_POST["Category"])); 
	
  
  if($Location=='All')
  {
	  $Location='%';
  }
  
  if($Type=='All')
  {
	  $SelectedGroup = " transactiongroup like ('%')  ";
  }
  else
  {
	  $SelectedGroup = " transactiongroup in ('$Type')  ";
  } 
  
  if($Ledger=='All')
  {
	  $SelectedLedger = " ledgername like ('%')  ";
  }
  else
  {
	  $SelectedLedger = " ledgername in ('$Ledger')  ";
  } 
  
  if($Category=='All')
  {
	  $SelectedCategory = " categoryname like ('Cash')  ";
  }
  else
  {
	  $SelectedCategory = " categoryname like ('Cash')    ";
  } 
  
  if($ExpenseIncomeFilter=='All')
  {
	  $ExpenseIncomeFilter=" IncomeExpense like ('%') ";
  }
  else if($ExpenseIncomeFilter=='Income')
  {
	  $ExpenseIncomeFilter="IncomeExpense='Income' ";
  }
  else if($ExpenseIncomeFilter=='Expense')
  {
	  $ExpenseIncomeFilter=" IncomeExpense='Expense'";
  }
  
   $PaymentModeStatus = mysqli_real_escape_string($connection, $_POST["PaymentModeStatus"]); 
   
  $FromDate = explode('/', $FromDate); 
$ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0];
 $ToDate = explode('/', $ToDate); 
$ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0];

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
				 
	    $TotalStock = mysqli_query($connection, "  
SELECT  round(SUM(Income),0), round(SUM(Expenses),0),round(SUM(Income)-SUM(Expenses),0) AS Total, transactiongroup,categoryname,
ledgername,remarks,IncomeExpense  FROM (
 
 SELECT  a.date AS EnrtyDate ,a.transactiongroup,c.categoryname,b.ledgername,remarks,
 SUM(incomeamount) AS Income, SUM(expenseamount) AS Expenses,
 CASE WHEN  SUM(incomeamount)>0 THEN 'Income' ELSE 'Expense' END AS IncomeExpense
 FROM accountingtransaction AS a JOIN accountingledger AS b ON a.ledgerid=b.ledgerid 
 JOIN accoutingcategory AS c ON b.categoryid=c.categoryid 
 where a.date BETWEEN  '$ActualFromDate' AND '$ActualToDate' and transactionstatus ='Active' and a.clientid like 
 ('$Location')  and  transactiontype not in('Supplier Payment') and   $SelectedGroup 
 GROUP BY a.transactionid, DATE_FORMAT(a.date, '%d-%m-%y') ,c.categoryname,b.ledgername,remarks,a.transactiongroup 
 
 UNION
  
   SELECT a.date, transactiongroup,  b.displayname AS categoryname, 
'-' AS ledgername, '-' AS remarks,0,IFNULL(ROUND(SUM(amount),0),0),'Expense' FROM 
salepaymentdetails AS a JOIN transactionmasterreport AS b ON a.`transactiontype`=b.transactionname WHERE
 b.transactionname NOT IN('ExpenseEntry','IncomeEntry') AND b.transactiontype ='Expense' 
AND transactionstatus='Live'   AND amount<>0  and  date BETWEEN  '$ActualFromDate' AND '$ActualToDate'
   AND clientid LIKE ('$Location') and  $SelectedGroup  GROUP BY  DATE_FORMAT(a.date, '%d-%m-%y') ,transactiongroup,  b.displayname 
   
    UNION
	
 SELECT a.date, transactiongroup,  b.displayname AS categoryname, 
'-' AS ledgername, '-' AS remarks,IFNULL(ROUND(SUM(amount),0),0),0,'Income'  FROM 
salepaymentdetails AS a JOIN transactionmasterreport AS b ON a.`transactiontype`=b.transactionname
 WHERE b.transactionname NOT IN('ExpenseEntry','IncomeEntry') AND b.transactiontype ='Income' 
AND transactionstatus='Live' AND amount<>0  and  date BETWEEN  '$ActualFromDate' AND '$ActualToDate'
   AND clientid LIKE ('$Location') and  $SelectedGroup  GROUP BY  DATE_FORMAT(a.date, '%d-%m-%y'), transactiongroup,  b.displayname 
 
   ) AS t
   where $SelectedCategory and $SelectedLedger  and $ExpenseIncomeFilter
    

 ");
  
   
  
 // SELECT IFNULL(ROUND(SUM(amount),0),0),0,0,'Sales' as categoryname,'-' as ledgername FROM salepaymentdetails WHERE transactiontype IN('Sales','SalesReturn') and transactionstatus='Live' and date BETWEEN '$ActualFromDate' AND '$ActualToDate' and clientid like ('$Location') and 
  // $SelectedGroup    
  
   
 
  
  echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;' class='blueTable' >";
echo " <thead> 
<tr>  
		     
		<th nowrap width='%'> Income</th>        
		<th nowrap width='%'> Expense</th>        
		<th nowrap width='%'> Closing Balance </th>             
		 </tr>
  </thead> <tbody>";
 
while($data = mysqli_fetch_row($TotalStock))
{
  echo "
  <tr>    
   <td width='%'>"; echo formatMoney($data[0], false); echo "</td>
   <td width='%'>"; echo formatMoney($data[1], false); echo "</td>
   <td width='%'><b>"; echo formatMoney($data[2], false); echo "</b></td> 
  
  </tr>";
  
} 

echo "</tbody></table>";
if($PaymentModeStatus =='Yes')
{

 $result = mysqli_query($connection, " 
 SELECT DATE_FORMAT(EnrtyDate,'%d-%m-%y') ,transactiongroup,categoryname,ledgername,remarks,paymentmode,SUM(Income), 
 SUM(Expenses),SUM(Income)-SUM(Expenses) AS Total,IncomeExpense  FROM (
 
 SELECT  a.date AS EnrtyDate ,a.transactiongroup,c.categoryname,b.ledgername,remarks,
d.paymentmode as paymentmode,
 SUM(incomeamount) AS Income, SUM(expenseamount) AS Expenses,
  CASE WHEN  SUM(incomeamount)>0 THEN 'Income' ELSE 'Expense' END AS IncomeExpense
 FROM accountingtransaction AS a JOIN accountingledger AS b ON a.ledgerid=b.ledgerid 
 JOIN accoutingcategory AS c ON b.categoryid=c.categoryid 
 join paymentmodemaster as d on a.paymentmode=d.paymentmodecode
 where a.date BETWEEN  '$ActualFromDate' AND '$ActualToDate' and transactionstatus ='Active' and a.clientid like 
 ('$Location') and  transactiontype not in('Supplier Payment') and $SelectedGroup 
 GROUP BY a.transactionid, DATE_FORMAT(a.date, '%d-%m-%y') ,c.categoryname,b.ledgername,remarks,a.transactiongroup,d.paymentmode
 
 UNION
 
 
   SELECT a.date, transactiongroup,  b.displayname AS categoryname, 
'-' AS ledgername, a.remarks AS remarks,c.paymentmode,0,IFNULL(ROUND(SUM(amount),0),0),'Expense' FROM 
salepaymentdetails AS a JOIN transactionmasterreport AS b ON a.`transactiontype`=b.transactionname 
join paymentmodemaster as c on a.paymentmode=c.paymentmodecode WHERE b.transactionname NOT IN('ExpenseEntry','IncomeEntry') AND b.transactiontype ='Expense' 
AND transactionstatus='Live'  and b.transactionname not in('Supplier Payment','Salary','Advance','Incentive','Bonus') AND amount<>0  and  date BETWEEN  '$ActualFromDate' AND '$ActualToDate'
   AND a.clientid LIKE ('$Location') and  $SelectedGroup  GROUP BY  DATE_FORMAT(a.date, '%d-%m-%y') ,transactiongroup, 
    b.displayname ,c.paymentmode,a.remarks
   
    UNION
	
 SELECT a.date, transactiongroup,  b.displayname AS categoryname, 
'-' AS ledgername, a.remarks AS remarks,c.paymentmode,IFNULL(ROUND(SUM(amount),0),0),0,'Income'  FROM 
salepaymentdetails AS a JOIN transactionmasterreport AS b ON a.`transactiontype`=b.transactionname 
join paymentmodemaster as c on a.paymentmode=c.paymentmodecode  WHERE b.transactionname NOT IN('ExpenseEntry','IncomeEntry') AND b.transactiontype ='Income' 
AND transactionstatus='Live'  and b.transactionname not in('Supplier Payment','Salary','Advance','Incentive','Bonus') AND amount<>0  and  date BETWEEN  '$ActualFromDate' AND '$ActualToDate'
   AND a.clientid LIKE ('$Location') and  $SelectedGroup  GROUP BY  DATE_FORMAT(a.date, '%d-%m-%y'), 
   transactiongroup,  b.displayname ,c.paymentmode,a.remarks
  
   UNION
	
   SELECT a.date, transactiongroup,  b.displayname AS categoryname, 
   d.`username` AS ledgername, e.remarks AS remarks,c.paymentmode,0,IFNULL(ROUND(SUM(a.amount),0),0),'Expense'  FROM 
  salepaymentdetails AS a JOIN transactionmasterreport AS b ON a.`transactiontype`=b.transactionname 
  join paymentmodemaster as c on a.paymentmode=c.paymentmodecode 
  JOIN usermaster AS d ON a.`customercode`=d.userid JOIN salarypaymentdetails AS e ON a.`invoiceno`=e.paymentid
   WHERE b.transactionname NOT IN('ExpenseEntry','IncomeEntry') AND b.transactiontype ='Expense' 
  AND transactionstatus='Live'  and b.transactionname in('Salary','Advance','Incentive','Bonus') AND a.amount<>0  and 
  date BETWEEN  '$ActualFromDate' AND '$ActualToDate'
     AND a.clientid LIKE ('$Location') and  $SelectedGroup  
     GROUP BY  DATE_FORMAT(a.date, '%d-%m-%y'), transactiongroup,  b.displayname ,c.paymentmode,
     CONCAT(e.`salarytype`,' - ',d.`username`), e.remarks
  
     union 

          
 SELECT  a.date AS EnrtyDate ,a.transactiongroup,'SUPPLIER PAYMENT',b.suplier_name,remarks,
 d.paymentmode AS paymentmode,
  SUM(incomeamount) AS Income, SUM(expenseamount) AS Expenses,
   CASE WHEN  SUM(incomeamount)>0 THEN 'Income' ELSE 'Expense' END AS IncomeExpense
  FROM accountingtransaction AS a JOIN supliers AS b ON a.ledgerid=b.suplier_id  
  JOIN paymentmodemaster AS d ON a.paymentmode=d.paymentmodecode
  WHERE a.date BETWEEN '$ActualFromDate' AND '$ActualToDate' AND transactionstatus ='Active' AND   transactiontype   IN('Supplier Payment') 
  AND a.clientid LIKE ('$Location') and  $SelectedGroup   
  GROUP BY a.transactionid, DATE_FORMAT(a.date, '%d-%m-%y') ,b.suplier_name,remarks,a.transactiongroup,d.paymentmode
  
   
      
   ) AS t
   where $SelectedCategory and $SelectedLedger and $ExpenseIncomeFilter 
   GROUP BY DATE_FORMAT(EnrtyDate,'%d-%m-%y'),transactiongroup,categoryname,ledgername,remarks,paymentmode
   order by EnrtyDate 
  
 ");
}
else
{
  
 
 $result = mysqli_query($connection, " 
 SELECT DATE_FORMAT(EnrtyDate,'%d-%m-%y') ,transactiongroup,categoryname,ledgername,remarks,SUM(Income), SUM(Expenses),SUM(Income)-SUM(Expenses) AS Total  FROM (
 
 SELECT  a.date AS EnrtyDate ,a.transactiongroup,c.categoryname,b.ledgername,remarks,
  
 SUM(incomeamount) AS Income, SUM(expenseamount) AS Expenses,
 CASE WHEN  SUM(incomeamount)>0 THEN 'Income' ELSE 'Expense' END AS IncomeExpense
 FROM accountingtransaction AS a JOIN accountingledger AS b ON a.ledgerid=b.ledgerid 
 JOIN accoutingcategory AS c ON b.categoryid=c.categoryid 
 where a.date BETWEEN  '$ActualFromDate' AND '$ActualToDate' and transactionstatus ='Active' and a.clientid like 
 ('$Location')  and  transactiontype not in('Supplier Payment') and   $SelectedGroup 
 GROUP BY a.transactionid, DATE_FORMAT(a.date, '%d-%m-%y') ,c.categoryname,b.ledgername,remarks,a.transactiongroup 
 
 UNION
 
 
   SELECT a.date, transactiongroup,  b.displayname AS categoryname, 
'-' AS ledgername, a.remarks AS remarks ,0,IFNULL(ROUND(SUM(amount),0),0),'Expense' FROM 
salepaymentdetails AS a JOIN transactionmasterreport AS b ON a.`transactiontype`=b.transactionname 
join paymentmodemaster as c on a.paymentmode=c.paymentmodecode WHERE b.transactionname NOT IN('ExpenseEntry','IncomeEntry') AND b.transactiontype ='Expense' 
AND transactionstatus='Live'  and b.transactionname  not in('Supplier Payment','Salary','Advance','Incentive','Bonus')  AND amount<>0  and  date BETWEEN  '$ActualFromDate' AND '$ActualToDate'
   AND a.clientid LIKE ('$Location') and  $SelectedGroup  GROUP BY  DATE_FORMAT(a.date, '%d-%m-%y') ,transactiongroup,  b.displayname,a.remarks 
   
    UNION
	
 SELECT a.date, transactiongroup,  b.displayname AS categoryname, 
'-' AS ledgername, a.remarks AS remarks, IFNULL(ROUND(SUM(amount),0),0),0,'Income'  FROM 
salepaymentdetails AS a JOIN transactionmasterreport AS b ON a.`transactiontype`=b.transactionname 
join paymentmodemaster as c on a.paymentmode=c.paymentmodecode  WHERE b.transactionname NOT IN('ExpenseEntry','IncomeEntry') AND b.transactiontype ='Income' 
AND transactionstatus='Live'  and b.transactionname   not in('Supplier Payment','Salary','Advance','Incentive','Bonus')  AND amount<>0  and  date BETWEEN  '$ActualFromDate' AND '$ActualToDate'
   AND a.clientid LIKE ('$Location') and  $SelectedGroup  GROUP BY  DATE_FORMAT(a.date, '%d-%m-%y'), transactiongroup,  b.displayname ,a.remarks
     
   UNION
	
   SELECT a.date, transactiongroup,  b.displayname AS categoryname, 
   d.`username` AS ledgername, e.remarks AS remarks,0, IFNULL(ROUND(SUM(a.amount),0),0),'Expense'  FROM 
  salepaymentdetails AS a JOIN transactionmasterreport AS b ON a.`transactiontype`=b.transactionname 
  join paymentmodemaster as c on a.paymentmode=c.paymentmodecode  
  JOIN usermaster AS d ON a.`customercode`=d.userid JOIN salarypaymentdetails AS e ON a.`invoiceno`=e.paymentid 
  WHERE b.transactionname NOT IN('ExpenseEntry','IncomeEntry') AND b.transactiontype ='Expense' 
  AND transactionstatus='Live'  and b.transactionname in('Salary','Advance','Incentive','Bonus')  AND a.amount<>0  and  date BETWEEN  '$ActualFromDate' AND '$ActualToDate'
     AND a.clientid LIKE ('$Location') and  $SelectedGroup  GROUP BY  DATE_FORMAT(a.date, '%d-%m-%y'), 
     transactiongroup,  b.displayname ,   CONCAT(e.`salarytype`,' - ',d.`username`), e.remarks
   
     union

     
 SELECT  a.date AS EnrtyDate ,a.transactiongroup,'SUPPLIER PAYMENT',b.suplier_name,remarks, 
  SUM(incomeamount) AS Income, SUM(expenseamount) AS Expenses,
   CASE WHEN  SUM(incomeamount)>0 THEN 'Income' ELSE 'Expense' END AS IncomeExpense
  FROM accountingtransaction AS a JOIN supliers AS b ON a.ledgerid=b.suplier_id  
  JOIN paymentmodemaster AS d ON a.paymentmode=d.paymentmodecode
  WHERE a.date BETWEEN '$ActualFromDate' AND '$ActualToDate' AND transactionstatus ='Active' AND   transactiontype   IN('Supplier Payment') 
  AND a.clientid LIKE ('$Location') and  $SelectedGroup   
  GROUP BY a.transactionid, DATE_FORMAT(a.date, '%d-%m-%y') ,b.suplier_name,remarks,a.transactiongroup 
  
      
   ) AS t
   where $SelectedCategory and $SelectedLedger and $ExpenseIncomeFilter
   GROUP BY DATE_FORMAT(EnrtyDate,'%d-%m-%y'),transactiongroup,categoryname,ledgername,remarks 
   order by EnrtyDate 
  
 ");
   
}
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>               
		<th  width='%'> Date</a></th>    
		<th  width='%'> Group  </th>     
		<th  width='%'> Category  </th>     
		<th width='%'> Ledger</th>           
		<th width='%'> Remarks </th>   ";
		if($PaymentModeStatus=='No')
		{   }
		else
		{ echo "<th  width='%'> Paymentmode</a></th>"; }

echo	"     
		<th width='%'> Income </th>        
		<th width='%'> Expenses </th>        
		<th width='%'> Balance</th>           
		</tr> </thead> <tbody id='tblSalesDetail' >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'> $SerialNo</a></td>";
 
 if($PaymentModeStatus=='No')
	{   
echo" <td >$data[0]</td>  
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>           
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[5], true); echo "</td>       
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[6], true); echo "</td>       
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[7], true); echo "</td> "; 
	}
	else
	{
		echo" <td >$data[0]</td>  
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>         
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[6], true); echo "</td>       
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[7], true); echo "</td>  
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[8], true); echo "</td>"; 
	}
	  
    
  echo "</tr>";
      
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
 
 

?>