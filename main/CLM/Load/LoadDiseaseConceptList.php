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

 
$ReportFilter = mysqli_real_escape_string($connection, $_POST["ReportFilter"]);

   
$TotalStock = mysqli_query($connection, "
SELECT (SELECT COUNT(DISTINCT disease)  FROM diseasemaster AS a 
LEFT JOIN diseasemapping AS b ON a.diseaseid=b.diseaseid) AS Total,
( SELECT COUNT(DISTINCT disease) FROM diseasemaster AS a 
LEFT JOIN diseasemapping AS b ON a.diseaseid=b.diseaseid WHERE conceptid>0) AS Mapped 
 ");


echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;width:30%' class='blueTable' >";
echo " <thead> 
<tr>  
		             
		<th nowrap width='%'> Total </th>             
		<th nowrap width='%'> Mapped </th>               
		<th nowrap width='%'> Mapped % </th>               
		 </tr>
  </thead> <tbody>";

while ($data = mysqli_fetch_row($TotalStock)) {
  echo "
  <tr>     
   <td width='%'><b>";
  echo formatMoney($data[0], false);
  echo "</b></td> 
   <td width='%'><b>  ";
  echo formatMoney($data[1], false);
  echo "</b></td>
  <td width='%'><b> ";
  echo  round(($data[1]/$data[0])*100,0); 
  echo " % </b></td>
  </tr>";
}

echo "</tbody></table><br>";


echo "<br>";
if($ReportFilter=='All')
{
  $result = mysqli_query($connection, "  
  SELECT a.diseaseid,a.disease,COUNT(b.conceptid) FROM diseasemaster AS a 
  LEFT JOIN diseasemapping AS b ON a.diseaseid=b.diseaseid 
  
  GROUP BY a.diseaseid,a.disease ORDER BY disease 
  
   ");
} else if($ReportFilter=='Mapped')
{
  $result = mysqli_query($connection, "  
  SELECT a.diseaseid,a.disease,COUNT(b.conceptid) FROM diseasemaster AS a 
  LEFT JOIN diseasemapping AS b ON a.diseaseid=b.diseaseid 
  where a.diseaseid in(SELECT a.diseaseid FROM diseasemaster AS a 
  LEFT JOIN diseasemapping AS b ON a.diseaseid=b.diseaseid WHERE conceptid>0
  GROUP BY a.diseaseid)
  GROUP BY a.diseaseid,a.disease ORDER BY disease 
  
   ");
}
else
{
  $result = mysqli_query($connection, "  
  SELECT a.diseaseid,a.disease,COUNT(b.conceptid) FROM diseasemaster AS a 
  LEFT JOIN diseasemapping AS b ON a.diseaseid=b.diseaseid 
  where a.diseaseid not in(SELECT a.diseaseid FROM diseasemaster AS a 
  LEFT JOIN diseasemapping AS b ON a.diseaseid=b.diseaseid WHERE conceptid>0
  GROUP BY a.diseaseid)
  GROUP BY a.diseaseid,a.disease ORDER BY disease 
  
   ");
}






//echo "<table id='tblProject' class='tblMasters'>";

echo "  	<table id='data-table' class='table table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>   
    <th hidden>DID</th>           
    <th>Disease</th>           
    <th>Mapped Status</th>    
    <th></th>           
		 
		</tr> </thead> <tbody id='ProjectTable'>";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td  hidden> $data[0]</td>
  <td nowrap > $data[1]</td>";
  if($data[2]>0)
  {
echo "<td style='background-color:#4fc379;'>Mapped</td>";
  }
  else
  {
    echo "<td  style='background-color:#ffcecd;'>Not Mapped</td>";

  }
 
echo "<td align='center' style='color:#009ad9'  >
<a href='AddDiagnosisMapping.php?MID=74&ID=$data[0]' target='_blank' ?>
<i class='fa fa-2x fa-eye' title='View'></i></a></td>";

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