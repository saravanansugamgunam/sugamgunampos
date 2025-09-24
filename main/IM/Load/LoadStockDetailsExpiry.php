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


if (
	$ReportLocationCode == '0' || $ReportLocationCode == '1' || $ReportLocationCode == '2'
	|| $ReportLocationCode == '3'	|| $ReportLocationCode == '4'
) {
	$StockTableName = 'newstockdetails_';

	$NewStockTable = $StockTableName . $ReportLocationCode;


	$TotalStock = mysqli_query($connection, "  
		  SELECT COUNT(DISTINCT productcode) AS Product, 
		  round(SUM(currentstock),0) AS currentstock,
		  round(SUM(currentstock*rate),0) AS Cost,round(SUM(currentstock*mrp),0) AS MRP  
		  FROM  $NewStockTable  as a where $ExcludedZero $LowStock ");
	if ($QFilter == 'All') {
		echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;display:none;' class='blueTable'   >";
		echo " <thead> 
		  <tr>  
					   
				  <th width='%'> Total Items</th>        
				  <th width='%'> Total Qty</th>";
		if ($UserID == 13) {
			echo "<th width='%'> Total Cost </th>";
		}
		echo "<th width='%'> Total MRP  </th>           
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
			echo "</td>";
			if ($UserID == 13) {
				echo "<td width='%'>";
				echo formatMoney($data[2], false);
			}
			echo "</td>
			 <td width='%'>";
			echo formatMoney($data[3], false);
			echo "</td>
			
			</tr>";
		}

		echo "</tbody></table> <br>";
	}



	$result = mysqli_query($connection, "  
		  SELECT b.uniquebarcode, b.productshortcode,b.category,b.productname,expirydate,
		  DATEDIFF(DATE_FORMAT(CONCAT(
			'20',SUBSTR(CONCAT('01/',expirydate), 7, 2),
			'-',SUBSTR(CONCAT('01/',expirydate), 4, 2),
			'-',SUBSTR(CONCAT('01/',expirydate), 1, 2)),'%Y-%m-%d'),CURRENT_DATE)  AS DaystoExpiry,
		  $StockFilter
		    
 
	 
		  SUM(a.currentstock),SUM(a.rate*a.currentstock) ,
		  SUM(a.mrp*a.currentstock)  
		   FROM  $NewStockTable
		  AS a 
		  JOIN productmaster AS b ON a.productcode=b.`productid`
		  where  $ExcludedZero  
		  GROUP BY  $StockFilter b.productshortcode,b.category,b.productname,b.uniquebarcode,expirydate  $LowStock ");



	echo "	<table id='data-table' name='data-table' class='table table-striped table-bordered'>
		  <thead>
			  <tr> 
				  <th>Barcode</th>
				  <th>SC</th>
				  <th>Category</th>
				  <th>Product</th>
				  <th>Expiry</th>
				  <th>Exp.Days</th>
				  
				  ";

	if ($QFilter == 'All') {
		echo "  
					<th>MRP</th>";
	} else {
	}

	echo "<th>Stock Qty</th> ";
	if ($UserID == 13) {
		echo "<th width='%'> Stock @ Cost </th>";
	}
	echo "  <th>Stock @ MRP</th>
			  </tr>
		  </thead>
		  <tbody>";

	$SerialNo = 1;
	while ($data = mysqli_fetch_row($result)) {

		if ($QFilter == 'All') {
			if ($data[5] <= 10) {
				echo "<tr style='color: red; font-weight: bold;'> ";
			} else {
				echo "<tr>";
			}
		} else {
			if ($data[5] <= 10) {
				echo "<tr style='color: red; font-weight: bold;'> ";
			} else {
				echo "<tr>";
			}
		}


		echo "<td>$data[0]</td>
			   <td>$data[1]</td>
			   <td>$data[2]</td>
			   <td>$data[3]</td> 
			   <td>$data[4]</td> 
			   <td>$data[5]</td> 
			   
			   ";
		if ($QFilter == 'All') {
			echo "<td> $data[6]</td>
				   <td>$data[7]</td> ";

			if ($UserID == 13) {
				echo "<td>$data[8]</td>";
			}
			echo "
			   <td>$data[9]</td>
			   </tr>";
		} else {
			echo "<td> $data[6]</td>";

			if ($UserID == 13) {
				echo "<td>$data[7]</td>";
			}
			echo "
			   <td>$data[8]</td>
			   </tr>";
		}
	}

	echo "</tbody>
	  </table> ";
} else {



	$TotalStock = mysqli_query($connection, "  
			SELECT  COUNT(DISTINCT b.productid),SUM(a.currentstock) as currentstock,
			round(SUM(a.rate*a.currentstock),0) ,
			round(SUM(a.mrp*a.currentstock) ,0)
			 FROM
			(SELECT *,'Vanagaram    ' AS Location FROM newstockdetails_0
			UNION
			SELECT *,'Chetpet    ' AS Location  FROM newstockdetails_1 
			UNION
			SELECT *,'Vadaperumbakkam    ' AS Location  FROM newstockdetails_2  
			UNION
			SELECT *,'Annanagar   ' AS Location  FROM newstockdetails_3 
					UNION
			SELECT *,'Godown   ' AS Location  FROM newstockdetails_4
			) AS a 
			JOIN productmaster AS b ON a.productcode=b.`productid`
		    where  $ExcludedZero  $LowStock ");
	if ($QFilter == 'All') {
		echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;' class='blueTable' >";
		echo " <thead> 
			<tr>  
						 
					<th width='%'> Total Items</th>        
					<th width='%'> Total Qty</th>  ";
		if ($UserID == 13) {
			echo "<th width='%'> Total Cost </th>";
		}
		echo "<th width='%'> Total MRP  </th>           
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
			echo "</td>";
			if ($UserID == 13) {
				echo "<td width='%'>";
				echo formatMoney($data[2], false);
			}
			echo "</td>
			  <td width='%'>";
			echo formatMoney($data[3], false);
			echo "</td>
			 
			 </tr>";
		}

		echo "</tbody></table> <br>";
	}

	$result = mysqli_query($connection, "  
			SELECT Location, b.uniquebarcode, b.productshortcode,b.category,b.productname,expirydate,
			DATEDIFF(DATE_FORMAT(CONCAT(
				'20',SUBSTR(CONCAT('01/',expirydate), 7, 2),
				'-',SUBSTR(CONCAT('01/',expirydate), 4, 2),
				'-',SUBSTR(CONCAT('01/',expirydate), 1, 2)),'%Y-%m-%d'),CURRENT_DATE)  AS DaystoExpiry,
			$StockFilter SUM(a.currentstock) as currentstock,SUM(a.rate*a.currentstock) ,
			SUM(a.mrp*a.currentstock), a.productcode  
			FROM
			(SELECT *,'Vanagaram    ' AS Location FROM newstockdetails_0
			UNION
			SELECT *,'Chetpet    ' AS Location  FROM newstockdetails_1 
			UNION
			SELECT *,'Vadaperumbakkam    ' AS Location  FROM newstockdetails_2 WHERE currentstock>0
			UNION
			SELECT *,'Annanagar   ' AS Location  FROM newstockdetails_3  
					UNION
			SELECT *,'Godown   ' AS Location  FROM newstockdetails_4
			) AS a 
			JOIN productmaster AS b ON a.productcode=b.`productid`
			where  $ExcludedZero  
			GROUP BY   $StockFilter Location,  b.productshortcode,b.category,
			b.uniquebarcode,b.productname,expirydate $LowStock ");


	echo "	<table id='data-table' class='table table-striped table-bordered'>
			<thead>
			<tr>
			<th>Location</th>
			<th>Barcode</th>
			<th>SC</th>
			<th>Category</th>
			<th>Product</th>
			<th>Expiry</th>
			<th>Exp.Days</th>
			
			";
	if ($QFilter == 'All') {
		echo "  
			<th>MRP</th>";
	} else {
	}

	echo "<th>Stock Qty</th> ";
	if ($UserID == 13) {
		echo "<th width='%'> Stock @ Cost </th>";
	}
	echo "
			<th>Stock @ MRP</th>
			<th>View</th>
			</tr>
			</thead>
			<tbody>";

	$SerialNo = 1;
	while ($data = mysqli_fetch_row($result)) {
		if ($QFilter == 'All') {
			if ($data[6] <= 10) {
				echo "<tr style='color: red; font-weight: bold;'> ";
			} else {
				echo "<tr>";
			}
		} else {
			if ($data[6] <= 10) {
				echo "<tr style='color: red; font-weight: bold;'> ";
			} else {
				echo "<tr>";
			}
		}

		echo " 
			<td>$data[0]</td>
			<td>$data[1]</td>
			<td>$data[2]</td>
			<td>$data[3]</td>
			<td>$data[4]</td>
			<td>$data[5]</td>
			<td>$data[6]</td>
			";
		if ($QFilter == 'All') {
			echo "<td>$data[7]</td>
			<td>$data[8]</td> ";

			if ($UserID == 13) {
				echo "<td>$data[9]</td>";
			}
			echo "
			<td>$data[10]</td>
			
			<td> 
			</td> 

			</tr>";
		} else {
			echo "<td>$data[7]</td>";

			if ($UserID == 13) {
				echo "<td>$data[8]</td>";
			}
			echo "
			<td>$data[9]</td>
			<td></td>
			</tr>";
		}
	}

	echo "</tbody>
			</table> ";
}


?>




<script src="../../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="../../assets/js/table-manage-default.demo.min.js"></script>

<script>
$(document).ready(function() {
    App.init();
    TableManageDefault.init();
});
</script>