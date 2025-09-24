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
$EmployeeCode = mysqli_real_escape_string($connection, $_POST["EmployeeCode"]);
$ReportType = mysqli_real_escape_string($connection, $_POST["ReportType"]);
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


if($EmployeeCode=='%')
{
  $EmployeeCode=='%';
} 

 
echo "<br>";


if($ReportType =='%')
{
  $result = mysqli_query($connection, "  
  SELECT DATE_FORMAT(a.`date`,'%d-%m-%Y'),b.`username`,a.`permissiontype`,
  IF(a.`permissiontype`='Permission',DATE_FORMAT(a.`fromtime`,'%d-%m-%Y %H:%i'),DATE_FORMAT(a.`fromtime`,'%d-%m-%Y')) fromdate,
  IF(a.`permissiontype`='Permission',DATE_FORMAT(a.`totime`,'%d-%m-%Y %H:%i'),DATE_FORMAT(a.`totime`,'%d-%m-%Y')) todate,
  IF(a.`permissiontype`='Permission',CONCAT(a.`totaltime`,' Hr'),CONCAT(DATEDIFF(a.`totime`,a.`fromtime`)+1,' Day')) AS total,  
  a.`remarks` FROM permissionlog AS a 
  JOIN usermaster AS b ON a.`employeecode`=b.`userid`
  where a.`employeecode` like '$EmployeeCode'   
    
   
 
 ");
 


//echo "<table id='tblProject' class='tblMasters'>";

echo "  	<table id='data-table' class='table table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>   
		<th >Entry Date</th>    
    <th>Employee</th>           
    <th>Type</th>           
    <th>From</th>           
    <th>To</th>               
    <th>Duration</th>                  
    <th>Remarks</th>     
		 
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
  <td >$data[5]</td>  
  <td >$data[6]</td>        "; 


echo "</tr>";


// echo "<tr>
    // <td>" $data[0] "</td>
    // </tr>"; echo "<tr>" $data[1] "</tr>";
// //echo "<br>";
$SerialNo = $SerialNo + 1;
}
echo "</tbody>
</table>";
}
else
if($ReportType =='P')
{ 
$result = mysqli_query($connection, "SELECT DATE_FORMAT(a.`date`,'%d-%m-%Y'),b.`username`,a.`permissiontype`,
IF(a.`permissiontype`='Permission',DATE_FORMAT(a.`fromtime`,'%d-%m-%Y %H:%i'),DATE_FORMAT(a.`fromtime`,'%d-%m-%Y')) fromdate,
IF(a.`permissiontype`='Permission',DATE_FORMAT(a.`totime`,'%d-%m-%Y %H:%i'),DATE_FORMAT(a.`totime`,'%d-%m-%Y')) todate,
IF(a.`permissiontype`='Permission',CONCAT(a.`totaltime`,' Hr'),CONCAT(DATEDIFF(a.`totime`,a.`fromtime`)+1,' Day')) AS total, 
a.`remarks` FROM permissionlog AS a 
JOIN usermaster AS b ON a.`employeecode`=b.`userid`
where a.`employeecode` like '$EmployeeCode' and permissiontype='Permission'


");



//echo "<table id='tblProject' class='tblMasters'>";

echo "  	<table id='data-table' class='table table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>   
		<th >Entry Date</th>    
    <th>Employee</th>           
    <th>Type</th>           
    <th>From</th>           
    <th>To</th>               
    <th>Duration</th>                  
    <th>Remarks</th>     
		 
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
  <td >$data[5]</td>  
  <td >$data[6]</td>        "; 


echo "</tr>";


            // echo "<tr>
                // <td>" $data[0] "</td>
                // </tr>"; echo "<tr>" $data[1] "</tr>";
            // //echo "<br>";
            $SerialNo = $SerialNo + 1;
            }
            echo "
        </tbody>
    </table>";
    } else
    if($ReportType =='L')
    { 
    $result = mysqli_query($connection, "SELECT DATE_FORMAT(a.`date`,'%d-%m-%Y'),b.`username`,a.`permissiontype`,
    IF(a.`permissiontype`='Permission',DATE_FORMAT(a.`fromtime`,'%d-%m-%Y %H:%i'),DATE_FORMAT(a.`fromtime`,'%d-%m-%Y')) fromdate,
    IF(a.`permissiontype`='Permission',DATE_FORMAT(a.`totime`,'%d-%m-%Y %H:%i'),DATE_FORMAT(a.`totime`,'%d-%m-%Y')) todate,
    IF(a.`permissiontype`='Permission',CONCAT(a.`totaltime`,' Hr'),CONCAT(DATEDIFF(a.`totime`,a.`fromtime`)+1,' Day')) AS total, 
    a.`remarks` FROM permissionlog AS a 
    JOIN usermaster AS b ON a.`employeecode`=b.`userid`
    where a.`employeecode` like '$EmployeeCode' and permissiontype='Leave'


    ");




//echo "<table id='tblProject' class='tblMasters'>";

echo "  	<table id='data-table' class='table table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>   
		<th >Entry Date</th>    
    <th>Employee</th>           
    <th>Type</th>           
    <th>From</th>           
    <th>To</th>               
    <th>Duration</th>                  
    <th>Remarks</th>     
		 
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
  <td >$data[5]</td>  
  <td >$data[6]</td>        "; 


echo "</tr>";


                // echo "<tr>
                    // <td>" $data[0] "</td>
                    // </tr>"; echo "<tr>" $data[1] "</tr>";
                // //echo "<br>";
                $SerialNo = $SerialNo + 1;
                }
                echo "
            </tbody>
        </table>";
        }

        else
    if($ReportType =='W')
    { 
    $result = mysqli_query($connection, "SELECT DATE_FORMAT(a.`date`,'%d-%m-%Y'),b.`username`,a.`permissiontype`,
    IF(a.`permissiontype`='Permission',DATE_FORMAT(a.`fromtime`,'%d-%m-%Y %H:%i'),DATE_FORMAT(a.`fromtime`,'%d-%m-%Y')) fromdate,
    IF(a.`permissiontype`='Permission',DATE_FORMAT(a.`totime`,'%d-%m-%Y %H:%i'),DATE_FORMAT(a.`totime`,'%d-%m-%Y')) todate,
    IF(a.`permissiontype`='Permission',CONCAT(a.`totaltime`,' Hr'),CONCAT(DATEDIFF(a.`totime`,a.`fromtime`)+1,' Day')) AS total, 
    a.`remarks` FROM permissionlog AS a 
    JOIN usermaster AS b ON a.`employeecode`=b.`userid`
    where a.`employeecode` like '$EmployeeCode' and permissiontype='Week Off'


    ");




//echo "<table id='tblProject' class='tblMasters'>";

echo "  	<table id='data-table' class='table table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>   
		<th >Entry Date</th>    
    <th>Employee</th>           
    <th>Type</th>           
    <th>From</th>           
    <th>To</th>               
    <th>Duration</th>                  
    <th>Remarks</th>     
		 
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
  <td >$data[5]</td>  
  <td >$data[6]</td>        "; 


echo "</tr>";


                // echo "<tr>
                    // <td>" $data[0] "</td>
                    // </tr>"; echo "<tr>" $data[1] "</tr>";
                // //echo "<br>";
                $SerialNo = $SerialNo + 1;
                }
                echo "
            </tbody>
        </table>";
        }




        ?>


<script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="../assets/js/table-manage-default.demo.min.js"></script>

<script>
$(document).ready(function() {

    TableManageDefault.init();
});
</script>