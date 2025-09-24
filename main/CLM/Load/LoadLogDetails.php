 <?php

	include("../../connect.php");

	session_cache_limiter(FALSE);
	session_start();
	$LocationCode = $_SESSION['SESS_LOCATION'];
	$UserID = $_SESSION['SESS_MEMBER_ID'];
	date_default_timezone_set('Asia/Kolkata');

	
    $PaitentID = mysqli_real_escape_string($connection, $_POST["Paitent"]);


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




	$result = mysqli_query($connection, "  SELECT loggedat,b.`username`,DATE_FORMAT(loggeddatetime,'%d-%m-%Y %h:%i %p') AS logdate,
comments FROM patientlogdetails AS a JOIN usermaster AS b ON a.loggedby=b.`userid`  where patientid ='$PaitentID'
ORDER BY loggeddatetime  DESC  ");


	echo "	<table id='data-table' class='table table-striped table-bordered'>
			<thead>
			<tr>
			<th>#</th>
			<th>During</th>
			<th>Log By</th> 
			<th>On</th> 
			<th>Comments</th> 
			</tr>
			</thead>
			<tbody>";

	$SerialNo = 1;
	while ($data = mysqli_fetch_row($result)) {

		echo "
	<tr> 
			<td>$SerialNo</td> 
			<td>$data[0]</td> 
			<td>$data[1]</td>
			<td>$data[2]</td> 
			<td>$data[3]</td>
			 
  
			</tr>";
			$SerialNo=$SerialNo+1;
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