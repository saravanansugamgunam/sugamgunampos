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

session_cache_limiter(FALSE);
session_start();



// echo "1";
include("../../../connect.php");
$currentdate = date("Y-m-d");


$FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
$ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
$DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);
$Period = mysqli_real_escape_string($connection, $_POST["Period"]);


if ($Period == 'Today') {
  $FromPeriod = $currentdate;
  $ToPeriod = $currentdate;
} else if ($Period == 'Yesterday') {
  $FromPeriod = date('Y-m-d', (strtotime('-1 day', strtotime($currentdate))));
  $ToPeriod = date('Y-m-d', (strtotime('-1 day', strtotime($currentdate))));
} else if ($Period == 'CurrentMonth') {
  $FromPeriod = date('Y-m-01', strtotime($currentdate));
  $ToPeriod = date('Y-m-t', strtotime($currentdate));
} else if ($Period == 'Last7Days') {
  $FromPeriod = date('Y-m-d', (strtotime('-7 day', strtotime($currentdate))));
  $ToPeriod = $currentdate;
} else if ($Period == 'Last14Days') {
  $FromPeriod = date('Y-m-d', (strtotime('-14 day', strtotime($currentdate))));
  $ToPeriod = $currentdate;
} else if ($Period == 'Last30Days') {
  $FromPeriod = date('Y-m-d', (strtotime('-30 day', strtotime($currentdate))));
  $ToPeriod = $currentdate;
} else if ($Period == 'Custom') {
  $FromPeriod = $FromDate;
  $ToPeriod = $ToDate;
}





$TotalStock = mysqli_query($connection, "

      SELECT COUNT(a.NAME) AS TotalAppointments,SUM(b.paymentamount) AS TotalAmount
      FROM  onlinetransactionmapping AS a 
     LEFT JOIN onlinetransaction AS b ON a.orderid=b.orderid
     JOIN usermaster AS c ON a.doctorcode=c.userid 
     WHERE transactionstatus='TXN_SUCCESS' and
     a.addedon between  '$FromPeriod 00:00:01' and '$ToPeriod 23:59:59' and c.userid like '$DoctorCode'  
      
 
 ");


echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;width:20%' class='blueTable' >";
echo " <thead> 
<tr>  
		             
		<th nowrap width='%'> Total Appointment </th>             
		<th nowrap width='%'> Total Payment </th>               
		 </tr>
  </thead> <tbody>";

while ($data = mysqli_fetch_row($TotalStock)) {
  echo "
  <tr>     
   <td width='%'><b>";
  echo formatMoney($data[0], false);
  echo "</b></td> 
   <td width='%'><b>&#x20B9; ";
  echo formatMoney($data[1], false);
  echo "</b></td>
  </tr>";
}

echo "</tbody></table><br>";


echo "<br>";

$result = mysqli_query($connection, "  
SELECT DATE_FORMAT(addedon,'%d-%m-%y'),
a.NAME,a.mobileno,c.username,DATE_FORMAT(appointmentdate,'%d-%m-%y'),
IF(appointmenttime*1=1,'Morning Session','Evening Session') AS AppointmeSession,
IF(b.paymentamount=307,'FOLLOW UP CONSULTING','NEW REGISTRATION + CONSULTING') AS Consultation,
b.paymentamount, b.paymentmode,
IF(transactionstatus='TXN_SUCCESS','Success','Failed') AS TrxStatus,
 b.banktransactionid,b.orderid
 FROM  onlinetransactionmapping AS a 
LEFT JOIN onlinetransaction AS b ON a.orderid=b.orderid
JOIN usermaster AS c ON a.doctorcode=c.userid 
where a.addedon between  '$FromPeriod 00:00:01' and '$ToPeriod 23:59:59' and c.userid like '$DoctorCode'  
 

 ");





//echo "<table id='tblProject' class='tblMasters'>";

echo "  	<table id='data-table' class='table table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>   
    <th>Booked on</th>           
    <th>Name</th>           
    <th>Mobile No</th>           
    <th>Doctor</th>           
    <th>App. Dt</th>           
    <th>Session</th>           
    <th>Consultation</th>           
    <th>Paid</th>           
    <th>Mode</th>           
    <th>Status</th>               
    <th>Bank ID</th>           
    <th></th>           
    <th></th>           
		 
		</tr> </thead> <tbody id='ProjectTable'>";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td nowrap > $data[0]</td>
  <td  > $data[1]</td>
  <td >$data[2]</td>  
   <td  width='%'>$data[3]</td>  
   <td nowrap width='%'>$data[4]</td>   
   <td  width='%'>$data[5]</td>   
   ";
  echo "<td width='%' align=''>$data[6]</td>";
  echo "<td width='%' align='right'>";
  echo formatMoney($data[7], false);
  echo "</td>";
  echo "<td width='%' align=' '>$data[8]</td>";
  echo "<td  width='%' align=' '>$data[9] </td>";
  echo "<td width='%' align='right'>$data[10] </td>
 
<td align='center' style='color:#009ad9'  >
<a href='ConfirmOnlineAppointment.php?MID=61&invoice=$data[11]' target='_blank' ?>
<i class='fa fa-2x fa-eye' title='View'></i></a></td>";
if ($data[9] == 'Success') {
echo "<td align='center' style='color:#009ad9'>
    <a href='ShareOnlineAppoiment.php?MID=61&i4rjdirj9k4kd9=$data[11]' target='_blank' ?>
        <i class='fa fa-2x fa-share-alt' title='Share'></i></a>
</td>";
} else {
echo "<td></td>";
}

echo "</tr>";


// echo "<tr>
    // <td>" $data[0] "</td>
    // </tr>"; echo "<tr>" $data[1] "</tr>";
// //echo "<br>";
$SerialNo = $SerialNo + 1;
}
echo "</tbody>
</table>";



?>


<script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="../assets/js/table-manage-default.demo.min.js"></script>

<script>
$(document).ready(function() {

    TableManageDefault.init();
});
</script>