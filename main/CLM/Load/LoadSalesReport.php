<script src="../assets/Custom/IndexTable.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


<script>
// function myFunction() {
// var input, filter, table, tr, td, i, txtValue;
// input = document.getElementById("txtItemSearch");
// filter = input.value.toLowerCase();
// $("#tblItemwise tr").filter(function() {
// $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
// });
// alert(1);
// }

// $(document).ready(function(){
// $("#txtItemSearch").on("keyup", function() {
// var value = $(this).val().toLowerCase();
// alert(2);
// $("#tblItemwise tr").filter(function() {
// $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
// });
// });
</script>

<?php

session_cache_limiter(FALSE);
session_start();



// echo "1";
include("../../../connect.php");
$currentdate = date("Y-m-d");
$FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
$ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
$Type = 'Detail';
$ConsultationType = mysqli_real_escape_string($connection, $_POST["ConsultationType"]);
$Location = mysqli_real_escape_string($connection, $_POST["Location"]);
$ConsultationGroup = mysqli_real_escape_string($connection, $_POST["ConsultationGroup"]);
$Doctor = mysqli_real_escape_string($connection, $_POST["Doctor"]);
$PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]); 

if ($Location == 'All') {
	$Location = '%';
}

if ($ConsultationType == 'All') {
	$ConsultationType = '%';
}

if ($ConsultationGroup == 'All') {
	$ConsultationGroup = '%';
}

if ($Doctor == 'All') {
	$Doctor = '%';
}
if($PaymentMode=='All')
{
    $PaymentMode='%';
}


$LocationCode = $_SESSION['SESS_LOCATION'];

$FromDate = explode('/', $FromDate);
$ActualFromDate = $FromDate[2] . '-' . $FromDate[1] . '-' . $FromDate[0];
$ToDate = explode('/', $ToDate);
$ActualToDate = $ToDate[2] . '-' . $ToDate[1] . '-' . $ToDate[0];

// $ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));

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


if ($Type == 'Detail') { 

	$result = mysqli_query($connection, " 
  SELECT CONCAT(DATE_FORMAT(a.billdate,'%d-%m-%Y'),'<br> ', 
  DATE_FORMAT(DATE_ADD(DATE_ADD(a.billaddedon ,INTERVAL 5 HOUR) ,INTERVAL 30 MINUTE),'%h:%i %p')) ,
  a.consultationuniquebill,a.billid, 
  CONCAT(b.paitentname,'(',b.mobileno,')') AS paitent,
  c.username,g.username,a.totalamount+a.extracharge,cancelledstatus,
	a.receivedamount,SUM(d.discount) AS discount,billtype,tokensession FROM `consultingbillmaster` AS a JOIN paitentmaster AS b
	ON a.paitentid = b.paitentid  
 JOIN usermaster AS c ON a.doctorid = c.userid join 
 consultingdetails as d on a.consultationuniquebill = d.consultationuniquebill
 join consultationmaster as e on d.consultationid=e.consultationid
 left join salepaymentdetails as f on a.consultationuniquebill = f.invoiceno
 join usermaster as g on a.addedby=g.userid

 JOIN (SELECT 
IF(a.createdon < 140001,'Morning','Evening') AS tokensession,invoicenumber FROM tokenmaster AS a  
WHERE date  BETWEEN '$ActualFromDate' AND '$ActualToDate' 
) AS t ON a.consultationuniquebill  = t.invoicenumber

 WHERE  a.billdate BETWEEN '$ActualFromDate' AND '$ActualToDate' AND cancelledstatus='0'
 and a.locationcode like('$Location')  and d.consultationid like('$ConsultationType') 
and  e.consultingtype like ('$ConsultationGroup') and a.doctorid like ('$Doctor')
 
GROUP BY CONCAT(DATE_FORMAT(a.billdate,'%d-%m-%Y'),' ', 
DATE_FORMAT(DATE_ADD(DATE_ADD(a.billaddedon ,INTERVAL 5 HOUR) ,INTERVAL 30 MINUTE),'%h:%i %p')) ,a.consultationuniquebill,a.billid, CONCAT(b.paitentname,
'(',b.mobileno,')'),
c.username,a.totalamount+a.extracharge,cancelledstatus,
	a.receivedamount ,billtype
	order by a.billdate,tokensession desc,c.username
	 
	
 ");


	//echo "<table id='tblProject' class='tblMasters'>";
	echo "  <table id='tblItemwise' class='table table-stripee table-bordered'>";
	echo " <thead><tr>  
		<th>S.No</th>          
		<th  width='%'> Date</a></th>    
		<th hidden width='%'> Unique No </th>    
		<th width='%'> Bill No </th>    
		<th  width='%'> Patient  </th>     
		<th  width='%'> Session  </th>     
		<th width='%'> Doctor</th>           
		<th width='%'> Billedby</th>           
		<th width='%'> Fees </th>        
		<th width='%'> Discount </th>        
		<th width='%'> Received Amount </th>        
		<th width='%'> View </th>        
		<th width='%'> Cancel </th>   
		<th width='%'> Modify </th>             
		     
		</tr> </thead> <tbody id='tblSalesDetail' >";

	$SerialNo = 1;
	while ($data = mysqli_fetch_row($result)) {
		echo "
  <tr>
  <td width='%'> $SerialNo </td>
  <td    > $data[0]</td>
  <td hidden  > $data[1]</td>
  <td >$data[2]</td>  
   <td  width='%'>$data[3]</td>";
   if($data[11]=='Morning')
   {
       echo "<td  bgcolor='#C6C5E1' width='%'>$data[11]</td>";
   }
   else
   {
       echo "<td  bgcolor='#F9E539' width='%'>$data[11]</td>";
   }
   echo "     
   <td width='%'>
   <a href='' data-toggle='modal' data-target='#ModifyDoctor' onclick='LoadCancelBillDetail(" . $data[1] . ");'> 
   $data[4]
   </a>
   </td>
   <td  width='%'>$data[5]</td>   
   
   <td width='%'style='text-align:right;' >";
		echo formatMoney($data[6], true);
		echo "</td>    
   <td width='%'style='text-align:right;' >";
		echo formatMoney($data[9], true);
		echo "</td>    
   <td width='%'style='text-align:right;' >";
		echo formatMoney($data[8], true);
		echo "</td>    
  
  <td align='center' style='color:#009ad9'  >
   <a href='SaleBillView.php?invoice=$data[1]' target='_blank' ?>
<i class='fa fa-2x fa-eye' title='View'></i></a></td>

";

if ($data[10] == 'Consultation') {
echo "<td align='center' style='color:#009ad9'>
    <a href='' data-toggle='modal' data-target='#myModalCancel' onclick='LoadCancelBillDetail(" . $data[1] . ");'> <i
            class='fa fa-2x  fa-times-circle text-danger' title='Sales Cancel'></i></a>";


    echo "
</td>";
} else {
echo "<td align='center' style='color:#009ad9'> </td>";
}

echo "<td align='center' style='color:#009ad9'>
    <a href='' data-toggle='modal' data-target='#myModifyPaymentMode' onclick='LoadCancelBillDetail(" . $data[1] . ");'>
        <i class='fa fa-2x  fa-pencil-square-o' title='Sales Cancel'></i></a>";
    echo "
</td>";


echo "</tr>";

$SerialNo = $SerialNo + 1;
}
echo "</tbody>
</table>";
}  
        ?>