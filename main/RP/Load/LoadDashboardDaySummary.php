<?php
include("../../../connect.php");
$currentdate = date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["Type"])) {

	// echo "1"; 
	$Type = mysqli_real_escape_string($connection, $_POST["Type"]);
	$LocationCode = $_SESSION['SESS_LOCATION'];

	$FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
	$ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
	$Location = mysqli_real_escape_string($connection, $_POST["Location"]);

	if ($FromDate == "") {
		$ActualFromDate = date('Y-m-d 00:00:00');
		$ActualToDate = date('Y-m-d 23:59:59');
		$FromDateSalePayment =  date('Y-m-d');
		$ToDateSalePayment =  date('Y-m-d');
	} else {
		$FromDate = explode('/', $FromDate);
		$ActualFromDate = $FromDate[2] . '-' . $FromDate[1] . '-' . $FromDate[0] . ' 00:00:00';
		$ToDate = explode('/', $ToDate);
		$ActualToDate = $ToDate[2] . '-' . $ToDate[1] . '-' . $ToDate[0] . ' 23:59:59';

		$FromDateSalePayment = $FromDate[2] . '-' . $FromDate[1] . '-' . $FromDate[0];
		$ToDateSalePayment =  $ToDate[2] . '-' . $ToDate[1] . '-' . $ToDate[0];

		// $ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));
	}

	if ($Location == '-') {
		$Location = '%';
	}




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



	$result = mysqli_query($connection, " 

	SELECT ( 

		SELECT SUM(nettamount + couriercharges ) FROM salemaster WHERE locationcode LIKE('$Location') AND 
		transactiontype='Sale' AND
		 saledate  BETWEEN '$ActualFromDate' AND '$ActualToDate'  AND cancellstatus = 0)  AS TotalIncome,
		(SELECT COUNT(*) FROM salemaster WHERE  saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'   AND locationcode like('$Location') and transactiontype='Sale'  and cancellstatus = 0) AS TotalBills,
		(SELECT COUNT(DISTINCT paitientcode) FROM salemaster WHERE  saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'   AND locationcode like('$Location')  and cancellstatus = 0) AS TotalPaitent,
		(SELECT COUNT(DISTINCT paitientcode) FROM salemaster WHERE  saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'   AND locationcode like('$Location')  and cancellstatus = 0 AND
		paitientcode IN (SELECT paitentid FROM paitentmaster WHERE  createdin BETWEEN '$ActualFromDate 00:00:01' AND '$ActualToDate 23:59:59')) AS NewPaitent,
		(SELECT COUNT(*) FROM salemaster WHERE  saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'   AND locationcode like('$Location') AND discountamount > 0  and cancellstatus = 0) AS DiscountBill,
		(SELECT IFNULL(ROUND(SUM(discountamount),0),0)   FROM salemaster WHERE  saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'   AND 
		locationcode like('$Location') AND discountamount > 0  and cancellstatus = 0) AS DiscountAmount,
		(select ifnull(sum(outstandingamount),0) as Outstandig from outstandingdetails where transactiontype='Inventory - Sale' and 
		date between '$ActualFromDate' AND '$ActualToDate'  and uniqueno not in (select saleuniqueno from salemaster where cancellstatus = 1)) as TodayOverdue,
		(SELECT SUM(nettamount + couriercharges )*-1 FROM salemaster WHERE locationcode like('$Location') and 
		transactiontype='Return' and
		 saledate  BETWEEN '$ActualFromDate' AND '$ActualToDate'  and cancellstatus = 0) as Returnvalue
 ");

	//echo "<table id='tblProject' class='tblMasters'>";
	echo "  <table id='data-table' class='table table-striped table-bordered' style='width:300px'>";
	echo " <thead><tr>  
		<th>Summary</th>          
		        
		<th width='%'> Amount</th>           
		 
		</tr> </thead> <tbody  id='tblCashCardSummmary'>";

	$SerialNo = 1;
	while ($data = mysqli_fetch_row($result)) {
		echo "
  <tr><td>Total Sales</td> <td style='text-align:right;' ;> $data[0]</td> </tr> 
  <tr><td>Total Return</td> <td style='text-align:right;' > $data[7]</td> </tr>  
  <tr><td>Total Bills</td> <td style='text-align:right;' ;> $data[1]</td> </tr>
  <tr><td>Total Paitent</td> <td style='text-align:right;' > $data[2]</td> </tr>
  <tr><td>New Paitents</td> <td style='text-align:right;' > $data[3]</td> </tr>
  <tr><td>Disc. Bills 
  <a href='' data-toggle='modal' data-target='#ModalBillDetails'  style='float: right; '>
<i class='fa fa-2x fa-eye' title='View' style='color:orange;' onclick='LoadBillDetails();'  ></i></a>

</td> <td style='text-align:right;' > $data[4]</td> </tr>
  <tr><td>Disc. Amt.</td> <td style='text-align:right;' > $data[5]</td> </tr>  
  
  <tr hidden><td>Outstanding.</td> <td style='text-align:right;' > 0</td> </tr>    
    
  </tr>";


		//echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
		//echo "<br>";
		$SerialNo = $SerialNo + 1;
	}
	echo "</tbody></table>";



	echo "<hr>";


	$result = mysqli_query($connection, " 
	SELECT b.paymentmode,SUM(a.amount) FROM salepaymentdetails AS a JOIN paymentmodemaster AS b ON 
	a.paymentmode=b.paymentmodecode
WHERE   transactionstatus='Live' AND transactiontype IN('Sales') 
and transactiongroup in('Inventory','Clinic')  and
 DATE BETWEEN '$FromDateSalePayment' AND '$ToDateSalePayment'   AND  a.clientid like('$Location')   and completionstatus=1
GROUP BY b.paymentmode 
");

	//echo "<table id='tblProject' class='tblMasters'>";
	echo "  <table id='data-table' class='table table-striped table-bordered' style='width:300px'>";
	echo " <thead><tr>  
		<th>Mode</th>              
		<th width='%'> Amount</th>           
		 
		</tr> </thead> <tbody  id='tblCashCardSummmary'>";

	$SerialNo = 1;
	while ($data = mysqli_fetch_row($result)) {
		echo "
  <tr>
  <td > $data[0]</td>   
  <td style='text-align:right;'> $data[1]</td> 

    
  </tr>";


		//echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
		//echo "<br>";
		$SerialNo = $SerialNo + 1;
	}
	echo "</tbody></table>";



	echo "<hr>";

	$result = mysqli_query($connection, " 
SELECT b.username, IFNULL(ROUND(SUM(nettamount + couriercharges ),0),0) AS Amount  FROM salemaster AS a 
JOIN usermaster as b ON a.doctorcode = b.userid
where  saledate BETWEEN '$ActualFromDate' AND '$ActualToDate' AND locationcode like('$Location') 
and transactiontype='Sale'  and cancellstatus = 0
GROUP BY b.username ORDER BY 2 DESC 
 
");


	//echo "<table id='tblProject' class='tblMasters'>";
	echo "  <table id='data-table' class='table table-striped table-bordered' style='width:300px'>";
	echo " <thead><tr>  
		<th>Doctor</th>              
		<th width='%'> Amount</th>           
		 
		</tr> </thead> <tbody  id='tblCashCardSummmary'>";

	$SerialNo = 1;
	while ($data = mysqli_fetch_row($result)) {
		echo "
  <tr>
  <td > $data[0]</td>   
  <td style='text-align:right;'> $data[1]</td> 

    
  </tr>";


		//echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
		//echo "<br>";
		$SerialNo = $SerialNo + 1;
	}
	echo "</tbody></table>";
} else {
	echo " NO";
}
