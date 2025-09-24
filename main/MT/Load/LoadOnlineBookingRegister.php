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





// $TotalStock = mysqli_query($connection, "

//       SELECT COUNT(a.NAME) AS TotalAppointments,SUM(b.paymentamount) AS TotalAmount
//       FROM  onlinetransactionmapping_enrol AS a 
//      LEFT JOIN onlinetransaction_enrol AS b ON a.orderid=b.orderid
//      JOIN usermaster AS c ON a.doctorcode=c.userid 
//      WHERE transactionstatus='TXN_SUCCESS' and
//      a.addedon between  '$FromPeriod 00:00:01' and '$ToPeriod 23:59:59' and c.userid like '$DoctorCode'  
      
 
//  ");

 
$TotalStock = mysqli_query($connection, "

SELECT count(*),sum(attended) 
  FROM campdata as a 
WHERE 
a.createdon between  '$FromPeriod 00:00:01' and '$ToPeriod 23:59:59'  


");





echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;width:20%' class='blueTable' >";
echo " <thead> 
<tr>  
		             
		<th nowrap width='%'> Total Bookings </th>             
		<th nowrap width='%'> Visited </th>               
		 </tr>
  </thead> <tbody>";

while ($data = mysqli_fetch_row($TotalStock)) {
  echo "
  <tr>     
   <td width='%'><b>";
  echo formatMoney($data[0], false);
  echo "</b></td> 
   <td   width='%'><b> ";
  echo formatMoney($data[1], false);
  echo "</b></td>
  </tr>";
}

echo "</tbody></table><br>";


echo "<br>";

// $result = mysqli_query($connection, "  
// SELECT DATE_FORMAT(addedon,'%d-%m-%y'),
// a.NAME,a.mobileno,c.username,DATE_FORMAT(appointmentdate,'%d-%m-%y'),
// IF(appointmenttime*1=1,'Morning Session','Evening Session') AS AppointmeSession,
// IF(b.paymentamount=307,'FOLLOW UP CONSULTING','NEW REGISTRATION + CONSULTING') AS Consultation,
// b.paymentamount, b.paymentmode,
// IF(transactionstatus='TXN_SUCCESS','Success','Failed') AS TrxStatus,
//  b.banktransactionid,b.orderid
//  FROM  onlinetransactionmapping_enrol AS a 
// LEFT JOIN onlinetransaction_enrol AS b ON a.orderid=b.orderid
// JOIN usermaster AS c ON a.doctorcode=c.userid 
// where a.addedon between  '$FromPeriod 00:00:01' and '$ToPeriod 23:59:59' and c.userid like '$DoctorCode'  
 

//  ");

 $result = mysqli_query($connection, "  
 
 
 SELECT c.campname, DATE_FORMAT(a.createdon,'%d-%m-%Y') Registredon,
 NAME,mobileno,emailid,DATE_FORMAT(dob,'%d-%m-%Y') DOB,gender,maritalstatus,reference,a.id,
 attended 
  FROM campdata AS a JOIN   referencemaster AS b
  ON a.referedby =b.referenceid JOIN campmaster AS c ON a.campid=c.campid where 
a.createdon between  '$FromPeriod 00:00:01' and '$ToPeriod 23:59:59'   
  "); 

//echo "<table id='tblProject' class='tblMasters'>";

echo " <table id='data-table' class='table table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>   
     <th>Camp Name</th> 
    <th>Registrated on</th> 
    <th>Name</th>            
    <th>Mobile No</th>   
    <th>Email</th>           
    <th hidden>DOB</th>           
    <th>Gender</th>           
    <th>Marital Status</th>               
    <th>Referedby</th>       
    <th>Confirm</th>       
		 
		</tr> </thead> <tbody id='ProjectTable'>";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td nowrap > $data[0]</td>
  <td  > $data[1]</td>
  <td >$data[2]</td>  
  <td >$data[3]</td>  
  <td >$data[4]</td>  
  <td hidden >$data[5]</td>  
  <td >$data[6]</td>  
  <td >$data[7]</td>   
  <td >$data[8]</td>  ";
 
  if($data[10]==0){
    echo " <td  bgcolor='#2fc2de' ><button onclick='ConfirmVisit($data[9])'>Confirm</button></td> ";
  }
  else
  {
    echo " <td bgcolor='#22914d' >Confirmed</td> ";
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