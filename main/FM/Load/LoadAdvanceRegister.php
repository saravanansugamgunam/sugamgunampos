			<style>
			table.blueTable {
				border: 1px solid #1C6EA4;
				background-color: #EEEEEE;
				width: 20%;
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

			$ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
			$FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
			$Purpose = mysqli_real_escape_string($connection, $_POST["Purpose"]); 
 
if($Purpose==1)
{
	$Purpose='Medicine - Advance';
}else if($Purpose==2)
{
	$Purpose='Consulting - Advance';
}
else if($Purpose==3)
{
	$Purpose='Therapy - Advance';
}
else
{
	$Purpose='%';
}
 

			$TotalStock = mysqli_query($connection, "  
			
SELECT SUM(a.amount) FROM advancedetails AS a JOIN paymentmodemaster AS b ON a.paymentmode=b.paymentmodecode
JOIN paitentmaster AS c ON a.paitentcode=c.paitentid    JOIN transactionledger AS d ON a.`id`=d.`invoicegrn`
 WHERE 
advancedate BETWEEN '$FromDate' AND '$ToDate' and transactionmode like '%$Purpose%'   "); 

			echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;' class='blueTable' >";
			echo " <thead> 
			<tr>   
		     
			<th width='%'> Total Advance</th>             
			</tr>
			</thead> <tbody>";

			while ($data = mysqli_fetch_row($TotalStock)) {
			echo "
			<tr>    
			<td width='%'>";
			echo formatMoney($data[0], false);
			echo "</td>
			  
			</tr>";
			}

			echo "</tbody></table> <br>";
		 


			$result = mysqli_query($connection, "  
			SELECT DATE_FORMAT(advancedate,'%d-%m-%Y') advancedate, transactionmode  AS Purpose,c.paitentname, c.mobileno,b.paymentmode,
			a.amount,a.remarks 
			 FROM advancedetails AS a JOIN paymentmodemaster AS b ON a.paymentmode=b.paymentmodecode
JOIN paitentmaster AS c ON a.paitentcode=c.paitentid    JOIN transactionledger AS d ON a.`id`=d.`invoicegrn`
 WHERE  advancedate BETWEEN '$FromDate' AND '$ToDate'  and transactionmode like '%$Purpose%'
 ");
 
			echo "	<table id='data-table' name='data-table' class='table table-striped table-bordered'>
			<thead>
			<tr> 
			<th>S. No</th>
			<th>Date</th>
			<th>Advance For</th>
			<th>Paitent Name</th>
			<th>Mobile No</th>
			<th>Mode</th>
			<th>Amount</th>
			<th>Remarks</th> 
			</tr>
			</thead>
			<tbody>";

			$SerialNo = 1;
			while ($data = mysqli_fetch_row($result)) { 
				echo "  <tr>";
				echo "<td>$SerialNo</td>";
				echo "<td>$data[0]</td>";
				echo "<td>$data[1]</td>";
				echo "<td>$data[2]</td>";
				echo "<td>$data[3]</td>";
				echo "<td>$data[4]</td>";
				echo "<td>"; echo formatMoney($data[5], false);
				 echo"</td>";
				echo "<td>$data[6]</td>";
				echo "  </tr>";
				$SerialNo++;
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