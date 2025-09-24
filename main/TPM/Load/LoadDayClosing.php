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
				
				 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	
  
session_cache_limiter(FALSE);
session_start();
  
  $Location = mysqli_real_escape_string($connection, $_POST["Location"]);
  
 // echo "1";
				 
// $result = mysqli_query($connection, "  
// SELECT  c.suplier_name,DATE_FORMAT(a.invoicedate, '%d-%m') AS InvoiceDate,
// b.productshortcode,b.productname,SUM(a.qty) AS Qty,a.rate,a.mrp ,SUM(a.qty)*a.profit AS Profit,
// SUM(a.totalamount) AS Total  FROM purchaseitems AS a JOIN productmaster AS b ON a.productcode = b.productid
// JOIN supliers AS c ON a.suppliercode=c.suplier_id
  // WHERE   DATE_FORMAT(a.addedon, '%Y-%m-%d') = '$currentdate'
// GROUP BY DATE_FORMAT(a.invoicedate, '%d-%m'),a.productcode,a.rate,a.mrp,
// b.productshortcode,b.productname,c.suplier_name");		


	   
	    $TotalStock = mysqli_query($connection, "
		
 SELECT SUM(incomeamount) Income,SUM(expenseamount) Expense,
  SUM(incomeamount-expenseamount) AS Total  FROM accountingtransaction AS a JOIN accountingledger AS b ON a.ledgerid=b.ledgerid 
 JOIN accoutingcategory AS c ON b.categoryid=c.categoryid  WHERE  DATE_FORMAT(a.date, '%Y-%m-%d') = '$currentdate' ");

    // $TotalStock = "  
// SELECT COUNT(DISTINCT productcode) AS Product, SUM(currentstock) AS Stock,round(SUM(currentstock*rate),0) AS Cost,round(SUM(currentstock*mrp),0) AS MRP  
// FROM  ".$NewStockTable."  as a where   $StockFilter $ExcludedZero ";

// if (mysqli_query($connection, $TotalStock)) {
                 
	   // echo "1";
            // } else {
               // echo "Error: " . $TotalStock . "" . mysqli_error($connection);
            // } 
			
			
 
 //<table id='tblProject' class='tblMasters'>";
  


$result = mysqli_query($connection, "  
 SELECT DATE_FORMAT(closingdate, '%d-%m-%Y') AS DATE , openingbalance,cashcollection,releasedamount,closingbalance FROM dayclosedetails  where  transactiontype='Clinic' and clientid ='$Location' ORDER BY closingdate DESC  ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>             
		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Date</a></th>    
		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Opening Balance</a></th>     
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Collection</a></th>           
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Handover</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Closing</a></th>        
		  
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td > $data[0]</td>   ";
echo "<td width='%' align='right'>"; echo formatMoney($data[1], false); echo "</td>
 <td width='%' align='right'>"; echo formatMoney($data[2], false); echo "</td>
 <td width='%' align='right'>"; echo formatMoney($data[3], false); echo "</td>
 <td width='%' align='right'>"; echo formatMoney($data[4], false); echo "</td>   
       
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    

?>