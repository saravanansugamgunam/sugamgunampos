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
$Type = mysqli_real_escape_string($connection, $_POST["Type"]);
$DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);
$Courier = mysqli_real_escape_string($connection, $_POST["Courier"]);
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

if ($Courier == 'All') {
  $Courier = '%';
}

$CourierTotal = mysqli_query($connection, "  
   
SELECT SUM(couriercharge) AS Amount,sum(paidtoserviceprovider) as Paid,
sum(couriercharge-paidtoserviceprovider) as PL FROM courierdetails 
 WHERE DATE_FORMAT(courierdate,'%Y-%m-%d') BETWEEN '$ActualFromDate' AND '$ActualToDate'  and courierservice like ('$Courier') 
 ");


echo "  <table id='data-table' class='table table-striped table-bordered' style='width:400px'>";
echo " <thead> 
<tr>  
		     
		<th width='%'> Received</th>        
		<th width='%'> Paid</th>        
		<th width='%'> Profit / Loss</th>           
		 
		 </tr>
  </thead> <tbody>";

while ($data = mysqli_fetch_row($CourierTotal)) {
  echo "
  <tr>    
   <td style='text-align:right' width='%'>";
  echo formatMoney($data[0], 1);
  echo "</td>
   <td style='text-align:right' width='%'>";
  echo formatMoney($data[1], 1);
  echo "</td>
   <td style='text-align:right' width='%'>";
  echo formatMoney($data[2], 1);
  echo "</td> 
  
  </tr>";
}

echo "</tbody></table>";


if ($Type == 'Summary') {


  $result = mysqli_query($connection, "

SELECT  DATE_FORMAT(courierdate ,'%d-%m-%y') AS courierdate ,COUNT(*) AS TotalCouriers ,SUM(couriercharge) AS Amount, 
sum(paidtoserviceprovider),
sum(couriercharge - paidtoserviceprovider) FROM courierdetails  AS a 
JOIN salemaster AS b ON a.invoicenumber=b.saleuniqueno where DATE_FORMAT(courierdate,'%Y-%m-%d') BETWEEN '$ActualFromDate' 
AND '$ActualToDate' and courierservice like ('$Courier') GROUP BY DATE_FORMAT(courierdate ,'%d-%m-%y') ORDER BY courierdate
 
  ");

  //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered' style='width:800px'>";
  echo " <thead><tr>  
		<th>S.No</th>          
		    
		<th  width='%'> Date</a></th>     
		<th width='%'> No. of Courier</th>           
		<th width='%' > Received Amount</th>        
		<th width='%' > Paid Amount</th>        
		<th width='%' > Profit/Loss </th>        
		</tr> </thead> <tbody  id='tblSalesDetails'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td> $data[0]</td>
  <td> $data[1]</td> 
   <td width='%' style='text-align:right;' >";
    echo formatMoney($data[2], 1);
    echo "</td>   
   <td width='%' style='text-align:right;' >";
    echo formatMoney($data[3], 1);
    echo "</td>  
   <td width='%' style='text-align:right;' >";
    echo formatMoney($data[4], 1);
    echo "</td>   
    
  </tr>";


    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody></table>";
} else {


  $result = mysqli_query($connection, "


SELECT  a.id,DATE_FORMAT(courierdate ,'%d-%m-%y') AS courierdate , CONCAT(invoiceno,'-',saleid) AS Billno,
 c.paitentname,c.mobileno,couriertrackingno,
 COUNT(*) AS TotalCouriers ,SUM(couriercharge) AS Amount,sum(paidtoserviceprovider), 
 sum(couriercharge - paidtoserviceprovider)
 FROM courierdetails AS a 
 JOIN salemaster AS b ON a.invoicenumber=b.saleuniqueno JOIN paitentmaster AS c ON b.paitientcode=c.paitentid 
 where DATE_FORMAT(courierdate,'%Y-%m-%d') BETWEEN '$ActualFromDate' 
AND '$ActualToDate' and courierservice like ('$Courier')

 
 GROUP BY DATE_FORMAT(courierdate ,'%d-%m-%y') , CONCAT(invoiceno,'-',saleid),
 c.paitentname,c.mobileno,a.id   ORDER BY courierdate

 
  ");






  //echo "<table id='tblProject' class='tblMasters'>";

  echo "  <table id='data-table' class='table table-striped table-bordered'  >";
  echo " <thead><tr>  
		<th>S.No</th>          
		    
		<th hidden width='%'> ID</a></th>     
		<th  width='%'> Date</a></th>     
		<th width='%'> Bill No</th>           
		<th width='%'> Paitent</th>           
		<th width='%'> Mobile No</th>           
		<th width='%'> POD No</th>           
		<th width='%'> No. of Courier</th>           
		<th width='%' > Received Amount </th>        
		<th width='%' > Paid Amount </th>        
		<th width='%' > Profit/Loss </th>        
		</tr> </thead> <tbody  id='tblSalesDetails'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden> $data[0]</td>
  <td> $data[1]</td>
  <td> $data[2]</td>
  <td> $data[3]</td>
  <td> $data[4]</td>
  <td width='%' style='text-align:left;' >";
    echo $data[5];
    echo "</td>   
  <td width='%' style='text-align:right;' >";
    echo $data[6];
    echo "</td>  <td width='%' style='text-align:right;' >";
    echo $data[7];

    if ($data[8] == 0) {
      echo "<td width='%' style='text-align:right;' onclick='GetCourierID($data[0]);'> <a href='#modalCourierPayment' data-toggle='modal' >0</i></a></td>";
    } else {
      echo "</td>  <td width='%' style='text-align:right;' >";
      echo formatMoney($data[8], 1);
    }
    echo "</td>  <td width='%' style='text-align:right;' >";
    echo formatMoney($data[9], 1);


    echo "</td>   
    
  </tr>";


    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody></table>";
}


?>