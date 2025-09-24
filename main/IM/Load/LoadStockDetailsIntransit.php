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

 
 

	$TotalStock = mysqli_query($connection, "  
	SELECT COUNT(DISTINCT productname),SUM(b.stoqty) AS Qty,SUM(b.mrp) 
	AS MRP FROM stomaster AS a JOIN newstoitems AS b 
	ON a.stouniqueno=b.stouniqueno 
	JOIN locationmaster AS c ON a.fromlocation=c.locationcode
	JOIN locationmaster AS d ON a.tolocation=d.locationcode
	WHERE receiptstatus ='Not Received' ");
	 
		echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;' class='blueTable' >";
		echo " <thead> 
			<tr>  
						 
					<th width='%'> Total Items</th>        
					<th width='%'> Total Qty</th>  
		 			<th width='%'> Total MRP  </th>           
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
			  <td width='%'> ";
			echo formatMoney($data[2], false);
			echo "</td>
			 
			 </tr>";
		}

		echo "</tbody></table> <br>";
 

	$result = mysqli_query($connection, "  
	SELECT DATE_FORMAT(a.stodate,'%d-%m-%Y') AS STOdate ,c.locationname,d.locationname,
	category,productname,shortcode,SUM(b.stoqty) AS Qty ,sum(mrp) as  MRP,
	a.stouniqueno FROM stomaster AS a JOIN newstoitems AS b 
	ON a.stouniqueno=b.stouniqueno 
	JOIN locationmaster AS c ON a.fromlocation=c.locationcode
	JOIN locationmaster AS d ON a.tolocation=d.locationcode
	WHERE receiptstatus ='Not Received'
	group by DATE_FORMAT(a.stodate,'%d-%m-%Y') ,c.locationname,d.locationname,
	category,productname,shortcode,a.stouniqueno ");


			echo "	<table id='data-table' class='table table-striped table-bordered'>
			<thead>
			<tr>
			<th>STO Date</th>
			<th>From</th>
			<th>To</th> 
			<th>Category</th>
			<th>Product</th>
			<th>Shortcode</th>
			<th>Qty</th>
			<th>MRP</th>
		 
			<th></th> 
			</tr>
			</thead>
			<tbody>";

			$SerialNo = 1;
			while ($data = mysqli_fetch_row($result)) {
			 
			echo" <td>$data[0]</td>
			<td>$data[1]</td>
			<td>$data[2]</td>
			<td>$data[3]</td> 
			<td>$data[4]</td> 
			<td>$data[5]</td> 
			<td>$data[6]</td> 
			<td>$data[7]</td> 
			<td > 
			<a href=STIView.php?stoid=$data[8] target=/'_blank'/'><i class='fa fa-2x fa-eye text-primary'></i> 
			</a>
			</td> 
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