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
SELECT saleuniqueno,paitientcode,doctorcode, DATE_FORMAT(saledate,'%d-%m-%Y') AS saledate,
b.paitentname,b.mobileno,a.saleqty,a.nettamount + a.couriercharges,
a.estimateclosure AS sttaus 
 FROM  salemaster_estimate AS a JOIN paitentmaster AS b ON a.paitientcode=b.paitentid
 where saledate between   '$FromPeriod' and '$ToPeriod' ORDER BY saledate DESC

 ");

//echo "<table id='tblProject' class='tblMasters'>";

echo "  	<table id='data-table' class='table table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>              
		<th hidden width='%'><a href=\"javascript:SortTable(2,'T');\">Saleuniqueno</a></th>         
		<th hidden width='%'><a href=\"javascript:SortTable(2,'T');\">PID</a></th>         
		<th hidden width='%'><a href=\"javascript:SortTable(2,'T');\">DID</a></th>         
		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Date</a></th>         
		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Paitent</a></th>         
		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Mobile</a></th>           
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Qty</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Amount</a></th>    
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Status</a></th>   
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">View</a></th>   
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Cancel</a></th>   
		 
		</tr> </thead> <tbody id='ProjectTable'>";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden > $data[0]</td>
  <td hidden > $data[1]</td>
  <td hidden > $data[2]</td>
  <td > $data[3]</td>
  <td > $data[4]</td>
  <td >$data[5]</td>  
   <td  width='%'>$data[6]</td>  
   <td  width='%'>$data[7]</td>";
  if ($data[8] == '1') {
    echo " <td  width='%' bgcolor='#5bb734'>Converted</td>  ";
  } else if ($data[8] == '2') {
    echo " <td  width='%' bgcolor='#fcc82f'>Cancelled</td>  ";
  } else {
    // echo " <td  width='%'  bgcolor='#c3602c'>
    // <a style='color:white;' 
    // href='BillingEstimateAdjustment.php?MID=62&invoice=$data[0]&PID=$data[1]&DID=$data[2]#modal-close'>
    // Pending
    // </a></td>  ";

    echo " <td  width='%'  bgcolor='#c3602c'>
   
    Pending </td>  ";
  }

  if ($data[8] == '1') {
    echo "  <td align='center' style='color:#009ad9'  >
    <a href='SaleBillView.php?invoice=$data[0]' target='_blank' ?>
<i class='fa fa-2x fa-eye' title='View'></i></a></td> ";
  } else {
    echo " <td align='center' style='color:#009ad9'>
    <a href='SaleEstimateView.php?invoice=$data[0]' target='_blank' ?>
        <i class='fa fa-2x fa-eye' title='View'></i></a>
</td> ";
  }

  if ($data[8] == '0') {
    echo "<td align='center' style='color:red'> <i class='fa fa-2x fa-minus-circle' title='View'
        onclick='CancelEstimate($data[0])'></i>";
  } else {
    echo "
<td width='%'> </td> ";
  }
  echo "</tr>";

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