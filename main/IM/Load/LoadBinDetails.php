 <?php

include("../../connect.php");

session_cache_limiter(FALSE);
session_start();
$LocationCode = $_SESSION['SESS_LOCATION'];
$UserID = $_SESSION['SESS_MEMBER_ID'];
date_default_timezone_set('Asia/Kolkata');
 
$currentdate = date("d-m-Y h:i A");
  
		$result = mysqli_query($connection, "  
		SELECT id,rack,shelf,bin,barcode,b.`productshortcode`,b.`productname` FROM
		rack_stockbinmapping AS a JOIN productmaster AS b 
		ON a.barcode =b.`uniquebarcode` WHERE clientid ='$LocationCode'  ");
 
		echo "	<table id='data-table' name='data-table' class='table table-striped table-bordered  '>
		<thead>
		<tr>   
		<th>Rack</th>
		<th>Shelf</th>
		<th>Bin</th>
		<th>Barcode</th>
		<th>Short&nbsp;Code</th>
		<th>Product</th>
		<th>Delete</th>";

		echo "  
		</tr>
		</thead>
		<tbody>";

		$SerialNo = 1;
		while ($data = mysqli_fetch_row($result)) {


		echo " 
		<td>$data[1]</td>
		<td>$data[2]</td>  
		<td>$data[3]</td>  
		<td>$data[4]</td>  
		<td>$data[5]</td>   
		<td>$data[6]</td>   
		<td onclick='DeleteRackDetails($data[0])'><i style=' color:red'  class='fa fa-2x fa-trash'></i></td> 
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