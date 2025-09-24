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
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
  $LocationCode = $_SESSION['SESS_LOCATION'];
  
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
 SELECT SUM(incomeamount) Income,SUM(expenseamount) Expense,
  SUM(incomeamount-expenseamount) AS Total  FROM accountingtransaction AS a JOIN accountingledger AS b ON a.ledgerid=b.ledgerid 
 JOIN accoutingcategory AS c ON b.categoryid=c.categoryid 
 WHERE a.date BETWEEN  '$ActualFromDate' AND '$ActualToDate' and transactionstatus ='Active'  and transactiongroup='Clinic'  ");
 
 
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
 
 $result = mysqli_query($connection, " 
 SELECT  DATE_FORMAT(a.date, '%d-%m-%y') AS DATE ,a.transactiongroup,c.categoryname,b.ledgername,remarks,
 SUM(incomeamount) AS Income, SUM(expenseamount) AS Expenses, 
 (incomeamount-expenseamount) AS Total  FROM accountingtransaction AS a JOIN accountingledger AS b ON a.ledgerid=b.ledgerid 
 JOIN accoutingcategory AS c ON b.categoryid=c.categoryid 
 where a.date BETWEEN  '$ActualFromDate' AND '$ActualToDate' and transactionstatus ='Active'  and transactiongroup='Clinic' 
 GROUP BY a.transactionid, DATE_FORMAT(a.date, '%d-%m-%y') ,c.categoryname,b.ledgername,remarks,a.transactiongroup 
  
 ");
 
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>               
		<th  width='%'> Date</a></th>    
		<th  width='%'> Group  </th>     
		<th  width='%'> Category  </th>     
		<th width='%'> Ledger</th>           
		<th width='%'> Remarks </th>        
		<th width='%'> Income </th>        
		<th width='%'> Expenses </th>        
		<th width='%'> Balance</th>           
		</tr> </thead> <tbody id='tblSalesDetail' >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'> $SerialNo</a></td>
 
  <td >$data[0]</td>  
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[5], false); echo "</td>    
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[6], true); echo "</td>       
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[7], true); echo "</td>  
   
    
    
  </tr>";
      
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
 
 

?> 