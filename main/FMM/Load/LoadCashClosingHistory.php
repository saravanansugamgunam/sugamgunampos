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

include("../../../connect.php");
$currentdate = date("Y-m-d");

session_cache_limiter(FALSE);
session_start();

$FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
$ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
$Location = mysqli_real_escape_string($connection, $_POST["Location"]);

// echo "1";

// $result = mysqli_query($connection, "  
// SELECT  c.suplier_name,DATE_FORMAT(a.invoicedate, '%d-%m') AS InvoiceDate,
// b.productshortcode,b.productname,SUM(a.qty) AS Qty,a.rate,a.mrp ,SUM(a.qty)*a.profit AS Profit,
// SUM(a.totalamount) AS Total  FROM purchaseitems AS a JOIN productmaster AS b ON a.productcode = b.productid
// JOIN supliers AS c ON a.suppliercode=c.suplier_id
// WHERE   DATE_FORMAT(a.addedon, '%Y-%m-%d') = '$currentdate'
// GROUP BY DATE_FORMAT(a.invoicedate, '%d-%m'),a.productcode,a.rate,a.mrp,
// b.productshortcode,b.productname,c.suplier_name");		

if ($FromDate == '') {
  $FromDateQuery = '';
} else {
  $FromDateQuery = "  closingdate between '$FromDate' and ";
}

if ($ToDate == '') {
  $ToDate == '';
} else {
  $ToDate = "  '$ToDate' ";
}
$result = mysqli_query($connection, "  
SELECT DATE_FORMAT(closingdate,'%d-%m-%Y') AS dat, nettcash, cashinhand, cashdifference,

IF(cashdifference<0,'Excess',IF(cashdifference=0,'No Diff','Shortage')) AS cashstatus,
 remarks FROM denomination WHERE  $FromDateQuery $ToDate   
 ORDER BY closingdate DESC  ");


//echo "<table id='tblProject' class='tblMasters'>";
echo "  <table id='data-table' class='table  table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>             
		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Date</a></th>    
		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Sys.Cash</a></th>     
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Phy.Cash</a></th>           
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Diff.</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Status</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Remarks</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">View</a></th>        
		  
		</tr> </thead> <tbody id='ProjectTable'>";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td > $data[0]</td>   ";
  echo "<td width='%' align='right'>";
  echo formatMoney($data[1], false);
  echo "</td>
 <td width='%' align='right'>";
  echo formatMoney($data[2], false);
  echo "</td>
 <td width='%' align='right'>";
  echo formatMoney($data[3], false);
  echo "</td>";
  if ($data[4] == 'Excess') {
    echo "<td bgcolor='#b0aff8'>Excess</td>";
  } else if ($data[4] == 'Shortage') {
    echo "<td bgcolor='#ff8f6b'>Shortage</td>";
  } else {
    echo "<td bgcolor='#2fbc7a'>No Difference</td>";
  }

  echo "
 <td width='%' align='left'>";
  echo $data[5];
  echo "</td>   
       <td  style='cursor:no-drop' ><i class='fa fa-2x fa-eye' disabled></i></td>
    
  </tr>";


  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
  $SerialNo = $SerialNo + 1;
}
echo "</tbody></table>";



?>