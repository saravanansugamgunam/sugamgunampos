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
   
SELECT SUM(nettamount) AS Amount,sum(paidtovendor) as Paid,
sum(nettamount-paidtovendor) as PL FROM diagnosissalemaster 
 WHERE DATE_FORMAT(saledate,'%Y-%m-%d') BETWEEN '$ActualFromDate' AND '$ActualToDate'  and  cancellstatus='0' 
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

  SELECT DATE_FORMAT(saledate ,'%d-%m-%y') as saledate,COUNT(*),SUM(nettamount),SUM(paidtovendor),SUM(nettamount-paidtovendor)  FROM `diagnosissalemaster`
WHERE cancellstatus='0' and  saledate  BETWEEN '$ActualFromDate' AND '$ActualToDate'
GROUP BY saledate order by saledate  
 
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


   SELECT a.id,DATE_FORMAT(saledate ,'%d-%m-%y') AS saledate,
 CONCAT(a.id) AS Billno, b.paitentname,b.mobileno,
 COUNT(*),SUM(nettamount),round(SUM(paidtovendor),0),SUM(nettamount-paidtovendor) FROM `diagnosissalemaster` AS a 
JOIN paitentmaster  AS b ON a.paitentid = b.paitentid 
 WHERE cancellstatus='0' AND  saledate 
 BETWEEN '$ActualFromDate' 
AND '$ActualToDate'  GROUP BY saledate,b.paitentname,b.mobileno 
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
  <td width='%' style='text-align:left;' >";
    echo $data[4];
    echo "</td>   <td width='%' style='text-align:right;' >";
    echo $data[6];

    if ($data[7] == 0) {
      echo "<td width='%' style='text-align:right;' onclick='GetCourierID($data[0]);'>
       <a href='#modalCourierPayment' data-toggle='modal' >0</i></a></td>";
    } else {
      echo "</td>  <td width='%' style='text-align:right;' >";
      echo formatMoney($data[7], 1);
    }
    echo "</td>  <td width='%' style='text-align:right;' >";
    echo formatMoney($data[8], 1);


    echo "</td>   
    
  </tr>";


    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody></table>";
}


?>