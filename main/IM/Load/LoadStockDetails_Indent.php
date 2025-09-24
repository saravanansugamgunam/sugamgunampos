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
 
$QFilter = 'All';
$ReportLocationCode =3;
$ExcludedStatus = 'Yes';

$LowStock = " HAVING SUM(a.currentstock) < 20 "; 
 
if ($ExcludedStatus == 'Yes') {
	$ExcludedZero = "  (a.currentstock) >0  ";
} else {

	$ExcludedZero = " a.currentstock like '%' ";
}


 
	$StockTableName = 'newstockdetails_'; 
	$NewStockTable = $StockTableName . $ReportLocationCode;

  
	$result = mysqli_query($connection, "  
		  SELECT   b.uniquebarcode, b.productshortcode, SUM(a.currentstock)
		   FROM  $NewStockTable
		  AS a 
		  JOIN productmaster AS b ON a.productcode=b.`productid`
		  where  $ExcludedZero 
		  GROUP BY b.uniquebarcode, b.productshortcode  $LowStock ");



	echo "	<table id='data-table' name='data-table' class='table table-striped table-bordered  '>
		  <thead>
			  <tr>  
				  <th>Barcode</th>
				  <th>SC</th>
				  <th>Qty</th>
				  <th>Select</th>";
 
	echo "  
			  </tr>
		  </thead>
		  <tbody>";

	$SerialNo = 1;
	while ($data = mysqli_fetch_row($result)) {
 

		echo "<td>$data[0]</td>
			   <td>$data[1]</td>
			   <td>$data[2]</td>  
			   <td onclick='LoadBarcodeDetails_fromStock($data[0])'><i style=' color:green'  class='fa fa-2x fa-check-circle-o'></i></td> 
			   </tr>";
		}
 

	echo "</tbody>
	  </table> ";
 

?>




 <script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
 <script src="../assets/js/table-manage-default.demo.min.js"></script>

 <script>
$(document).ready(function() {
    App.init();
    TableManageDefault.init();
});
 </script>