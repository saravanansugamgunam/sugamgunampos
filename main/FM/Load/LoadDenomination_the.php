<?php
include("../../../connect.php");
$currentdate = date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
 
if (isset($_POST["DayCloseDate"])) {

	$DayCloseDate = mysqli_real_escape_string($connection, $_POST["DayCloseDate"]);
	$Location = '%'; //mysqli_real_escape_string($connection, $_POST["Location"]);

	$LocationCode = '%';
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

	$query = mysqli_query($connection, " 
		SELECT COUNT(*) as status,n2000,n500,n200,n100,n50,n20,n10,coin,b.username,medcash,
	concash,thecash,othcash,grosscash,expense,nettcash,cashinhand,cashdifference,remarks,a.id,
	openingcash,closingcash,pettycashdifference,handedoverto
	FROM denomination AS a 
	  JOIN usermaster AS b ON a.enteredby=b.userid WHERE closinggroup=3 and  closingdate ='$DayCloseDate' ");

	$data = array();

	while ($row = mysqli_fetch_assoc($query)) {
		$data[] = $row['status'];
		$data[] = $row['n2000'];
		$data[] = $row['n500'];
		$data[] = $row['n200'];
		$data[] = $row['n100'];
		$data[] = $row['n50'];
		$data[] = $row['n20'];
		$data[] = $row['n10'];
		$data[] = $row['coin'];
		$data[] = $row['medcash'];
		$data[] = $row['concash'];
		$data[] = $row['thecash'];
		$data[] = $row['othcash'];
		$data[] = $row['grosscash'];
		$data[] = $row['expense'];
		$data[] = $row['nettcash'];
		$data[] = $row['cashinhand'];
		$data[] = $row['cashdifference'];
		$data[] = $row['remarks'];
		$data[] = $row['username'];
		$data[] = $row['id'];
		$data[] = $row['openingcash'];
		$data[] = $row['closingcash'];
		$data[] = $row['pettycashdifference'];
		$data[] = $row['handedoverto'];
	}

	
	echo json_encode($data);
	mysqli_close($connection);
} else {
	echo " NO";
}