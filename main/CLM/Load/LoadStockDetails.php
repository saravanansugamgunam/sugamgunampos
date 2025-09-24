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




	$result = mysqli_query($connection, "  
			SELECT Location,  b.productshortcode,b.category,b.productname,
		 SUM(a.currentstock) as currentstock,SUM(a.rate*a.currentstock) ,
			a.mrp, a.productcode  
			FROM
			( 
			SELECT *,'Annanagar   ' AS Location  FROM newstockdetails_3   where currentstock > 0
					 
			) AS a 
			JOIN productmaster AS b ON a.productcode=b.`productid`
			 
			GROUP BY    Location,  b.productshortcode,b.category,b.productname,a.mrp");


	echo "	<table id='data-table' class='table table-striped table-bordered'>
			<thead>
			<tr>
			<th>Short Code</th>
			<th>Product</th> 
			<th>Qty</th> 
			<th>MRP</th> 
			</tr>
			</thead>
			<tbody>";

	$SerialNo = 1;
	while ($data = mysqli_fetch_row($result)) {

		echo "
	<tr> 
			<td>$data[1]</td> 
			<td>$data[3]</td>
			<td>$data[4]</td> 
			<td>$data[6]</td>
			 
  
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