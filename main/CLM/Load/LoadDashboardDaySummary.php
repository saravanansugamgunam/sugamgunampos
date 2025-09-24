<?php
   include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Type"]))
{	
  
 
	   
 
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
   $LocationCode = $_SESSION['SESS_LOCATION'];
   						  
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
 $Location = mysqli_real_escape_string($connection, $_POST["Location"]); 

if($FromDate=="")
{
	$ActualFromDate= date('Y-m-d 00:00:00');
	$ActualToDate= date('Y-m-d 23:59:59');
	
}
else
{
$FromDate = explode('/', $FromDate); 
$ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0].' 00:00:00';
$ToDate = explode('/', $ToDate); 
$ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0].' 23:59:59' ;

// $ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));
}

if($Location=='-')
{
$Location='%';
}

 
function formatMoney($number, $fractional=false) {
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

				SELECT  
					( SELECT  IFNULL(ROUND(SUM(totalamount),0),0) AS Amount  FROM consultingbillmaster AS a JOIN usermaster AS b ON a.doctorid = b.userid
					where  billdate BETWEEN '$ActualFromDate' AND '$ActualToDate'   AND locationcode like('$Location')  and cancelledstatus ='0'  ) AS TotalIncome, 

					(SELECT COUNT(*) FROM consultingbillmaster WHERE  billdate BETWEEN '$ActualFromDate' AND '$ActualToDate' 
					  AND locationcode like('$Location') and cancelledstatus ='0') AS TotalBills,

					(SELECT COUNT(DISTINCT paitentid) FROM consultingbillmaster WHERE  billdate BETWEEN '$ActualFromDate' AND '$ActualToDate'
					AND locationcode like('$Location') and cancelledstatus ='0') AS TotalPaitent,

					(SELECT COUNT(DISTINCT paitentid) FROM consultingbillmaster WHERE  billdate BETWEEN '$ActualFromDate' AND '$ActualToDate'
					AND locationcode like('$Location') and cancelledstatus ='0' AND
					paitentid IN (SELECT paitentid FROM paitentmaster WHERE createdin BETWEEN '$ActualFromDate 00:00:01' 
					AND '$ActualToDate 23:59:59')) AS NewPaitent,

					(SELECT COUNT(*) FROM consultingbillmaster WHERE  billdate BETWEEN '$ActualFromDate' AND '$ActualToDate'  
					 AND locationcode like('$Location') and cancelledstatus ='0' AND discountamount > 0) AS DiscountBill,

					(SELECT IFNULL(ROUND(SUM(discountamount),0),0)   FROM consultingbillmaster WHERE  
					billdate BETWEEN '$ActualFromDate' AND '$ActualToDate'   AND 
					locationcode like('$Location') and cancelledstatus ='0' AND discountamount > 0) AS DiscountAmount 
	
 ");
 
 
  
	  
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered' style='width:300px'>";
echo " <thead><tr>  
		<th>Summary</th>          
		        
		<th width='%'> Amount</th>           
		 
		</tr> </thead> <tbody  id='tblCashCardSummmary'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr><td>Total Sales</td> <td style='text-align:right;' ;> $data[0]</td> </tr> 
  <tr><td>Total Bills</td> <td style='text-align:right;' ;> $data[1]</td> </tr>
  <tr><td>Total Paitent</td> <td style='text-align:right;' > $data[2]</td> </tr>
  <tr><td>New Paitents</td> <td style='text-align:right;' > $data[3]</td> </tr>
  <tr><td>Disc. Bills <a href='' data-toggle='modal' data-target='#ModalBillDetails'  style='float: right; '>
  <i class='fa fa-2x fa-eye' title='View' style='color:orange;' onclick='LoadBillDetails();'  ></i></a>
  </td> <td style='text-align:right;' > $data[4]</td> </tr>
  <tr><td>Disc. Amt.</td> <td style='text-align:right;' > $data[5]</td> </tr>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";

echo "<hr>";
 
$result = mysqli_query($connection, " 
SELECT b.username, IFNULL(ROUND(SUM(totalamount),0),0) AS Amount  FROM consultingbillmaster AS a 
JOIN usermaster AS b ON a.doctorid = b.userid
where  billdate BETWEEN '$ActualFromDate' AND '$ActualToDate'   AND locationcode like('$Location') and cancelledstatus ='0'  
GROUP BY b.username ORDER BY 2 DESC
 
 
");
 
 
 
	  
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered' style='width:300px'>";
echo " <thead><tr>  
		<th>Doctor</th>              
		<th width='%'> Amount</th>           
		 
		</tr> </thead> <tbody  id='tblCashCardSummmary'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td > $data[0]</td>   
  <td style='text-align:right;'> $data[1]</td> 

    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";


  
}
else
{
	 echo " NO";
}

?>