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
$SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]);
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





$result = mysqli_query($connection, "  
SELECT f.`paitentname`,f.`mobileno`,DATE_FORMAT(b.updatedon,'%d-%m-%y') AS Updatedon,e.username AS Updatedby,

IF(oldtherapist-newtherapist=0,'Date Change','Therapist Change') AS ChangeType,
DATE_FORMAT(therapyolddate,'%d-%m-%y') AS therapyolddate, DATE_FORMAT(therapyreviseddate,'%d-%m-%y') AS therapyreviseddate,
c.username AS OldTherapist,d.username AS NewTherapist,b.remarks
FROM therapybookingdetails AS a 
JOIN therapyreschedulelog  AS b  ON a.bookinguniqueid =b.therapyuniqueno AND a.bookingid=b.therapyitemid
JOIN usermaster AS c ON b.oldtherapist=c.userid
JOIN usermaster AS d ON b.  newtherapist=d.userid
JOIN usermaster AS e ON b.updatedby=e.userid 

JOIN paitentmaster AS f ON b.paitentid=f.paitentid
WHERE b.updatedon BETWEEN    '$FromPeriod' and '$ToPeriod' 
 ");




//echo "<table id='tblProject' class='tblMasters'>";

echo "  	<table id='data-table' class='table table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>                 
		<th width='%'  >Paitent</th>        
		<th width='%'  >Mobile No</th>        
		<th width='%'  >Updated Date</th>        
		<th width='%'  >Updated By</a></th>        
		<th width='%'>Type</a></th>     
		<th width='%'> Old Date</a></th>    
		<th width='%'> Revised Date</a></th>    
		<th width='%'> Old Therapist</a></th>    
		<th width='%'> New Therapist</a></th>    
		<th width='%'> Remarks</a></th>    
		  
		</tr> </thead> <tbody id='myTable'>";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td    id='BookingID'  width='%' >$data[0]</td>
  <td nowrap id='TherapyDate' width='%'>$data[1]</td>  
   <td id='TherapyTime'  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td  id='TherapyName' width='%'>$data[5]</td>    
   <td  id='TherapyName' width='%'>$data[6]</td>    
   <td  id='TherapyName' width='%'>$data[7]</td> 
   <td  id='TherapyName' width='%'>$data[8]</td> 
   <td  id='TherapyName' width='%'>$data[9]</td> 
   
   ";
  echo "</tr>";


  //echo "<br>";
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