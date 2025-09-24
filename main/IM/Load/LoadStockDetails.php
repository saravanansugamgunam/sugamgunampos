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

include("../../connect.php");

session_cache_limiter(FALSE);
session_start();
$LocationCode = $_SESSION['SESS_LOCATION'];
$UserID = $_SESSION['SESS_MEMBER_ID'];
date_default_timezone_set('Asia/Kolkata');



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

$currentdate = date("d-m-Y h:i A");

$Type = mysqli_real_escape_string($connection, $_POST["Type"]);
$QFilter = mysqli_real_escape_string($connection, $_POST["QFilter"]);
$ReportLocationCode = mysqli_real_escape_string($connection, $_POST["ReportLocationCode"]);
$ExcludedStatus = mysqli_real_escape_string($connection, $_POST["ExcludedStatus"]);

if ($QFilter == 'All') {
	$StockFilter = "   a.mrp ,   ";
	$LowStock = "   ";
} else {
	$StockFilter = " ";
	$LowStock = " HAVING SUM(a.currentstock) < 20 ";
}



if ($ExcludedStatus == 'Yes') {
	$ExcludedZero = "  (a.currentstock) >0  ";
} else {

	$ExcludedZero = " a.currentstock like '%' ";
}

 
if($ReportLocationCode=='-')
{
	$ReportLocationCode='%';
} 
 
	$TotalStock = mysqli_query($connection, "  
	
SELECT SUM(currentstock) AS currentstock, SUM(MRP) AS MRP FROM (
SELECT locationcode,
SUM(currentstock) AS currentstock, ROUND(SUM(mrp*currentstock) ,0) AS MRP FROM newstockdetails_3 
where locationcode like '$ReportLocationCode'
			UNION
SELECT locationcode,
SUM(currentstock) AS currentstock, ROUND(SUM(mrp*currentstock) ,0) FROM newstockdetails_4
 where locationcode like '$ReportLocationCode'
 			UNION
SELECT locationcode,
SUM(currentstock) AS currentstock, ROUND(SUM(mrp*currentstock) ,0) FROM newstockdetails_5
 where locationcode like '$ReportLocationCode'
 
 ) AS a 
where $ExcludedZero  
   ");
 
		echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;' class='blueTable' >";
		echo " <thead> 
		  <tr>   <th width='%'> Total Qty</th> 
				  <th width='%'> Stock @ MRP</th>  </tr>
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
			
			</tr>";
		}

		echo "</tbody></table> <br>";
 
 
		  
	$result = mysqli_query($connection, "  

	SELECT Location, b.uniquebarcode, b.productshortcode,b.category,b.productname, a.MRP,
SUM(a.currentstock) AS currentstock,
ROUND(SUM(TotalMRP),0),  
ROUND(IFNULL((c.Saleqty/6),0),0) AS STR, ROUND(IFNULL(SUM(a.currentstock)/IFNULL((c.Saleqty/6),0),0),1) AS Ratio,
IF(b.status='Active','Live','Stopped') AS ProductStatus
FROM (SELECT 'Annanagar   ' AS Location,productcode,mrp AS MRP,SUM(currentstock) AS currentstock,
SUM(currentstock*mrp) AS TotalMRP FROM newstockdetails_3 WHERE barcode LIKE '1%' and locationcode like '$ReportLocationCode'
GROUP BY barcode,mrp
UNION 
SELECT 'Godown   ' AS Location,productcode,mrp AS MRP,SUM(currentstock) AS currentstock,
SUM(currentstock*mrp) AS TotalMRP FROM newstockdetails_4 WHERE barcode LIKE '1%'  and locationcode like '$ReportLocationCode'
GROUP BY barcode,mrp 
UNION 
SELECT 'Tiruvallur   ' AS Location,productcode,mrp AS MRP,SUM(currentstock) AS currentstock,
SUM(currentstock*mrp) AS TotalMRP FROM newstockdetails_5 WHERE barcode LIKE '1%'  and locationcode like '$ReportLocationCode'
GROUP BY barcode,mrp 

) AS a 
JOIN productmaster AS b ON a.productcode=b.`productid` 
LEFT JOIN (SELECT barcode, SUM(saleqty) AS Saleqty FROM newsaleitems WHERE invoiceno IN (
SELECT saleuniqueno FROM salemaster WHERE saledate BETWEEN  DATE_ADD(CURRENT_DATE, INTERVAL -180 DAY) AND CURRENT_DATE  AND cancellstatus='0')
GROUP BY barcode) AS c ON b.`uniquebarcode`=c.barcode
where $ExcludedZero   
GROUP BY Location,  b.productshortcode,b.category,b.uniquebarcode,b.productname,a.MRP $LowStock

 ");
 


	echo "	<table id='data-table' name='data-table' class='table table-striped table-bordered'>
		  <thead>
			  <tr> 
				  <th>Location</th>
				  <th>Barcode</th>
				  <th>SC</th>
				  <th>Category</th>
				  <th>Product</th>
				  <th>MRP</th>
				  <th>Qty</th>
				  <th>Stock@MRP</th>
				  <th>Avg.Sale/Month</th>
				  <th>STR(Month)</th>  
				  <th>Status</th>  
			  </tr>
		  </thead>
		  <tbody>";

	$SerialNo = 1;
	while ($data = mysqli_fetch_row($result)) {

		if ($data[6] <= 20) {
			echo "<tr style='color: red; font-weight: bold;'> ";
		} else {
			echo "<tr>";
		}

		echo "  <td>$data[0]</td>
			   <td>$data[1]</td>
			   <td>$data[2]</td>
			   <td>$data[3]</td> 
			   <td>$data[4]</td> 
			   <td>$data[5]</td> 
			   <td>$data[6]</td> 
			   <td>$data[7]</td> 
			   <td>$data[8]</td> 
			   <td>$data[9]</td> 
			   <td>$data[10]</td> 
			   </tr>";
		}
 
	echo "</tbody>
	  </table> "; 

?>




<script src="../../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="../../assets/js/table-manage-default.demo.min.js"></script>

<script>
$(document).ready(function() {
    App.init();
    TableManageDefault.init();
});
</script>