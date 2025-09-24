<script src="../assets/Custom/IndexTable.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tblSalesDetail tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>

<?php

session_cache_limiter(FALSE);
session_start();



// echo "1";
include("../../../connect.php");
$currentdate = date("Y-m-d");
$Type = mysqli_real_escape_string($connection, $_POST["Type"]);
$LocationCode = mysqli_real_escape_string($connection, $_POST["Location"]);

// $LocationCode = $_SESSION['SESS_LOCATION'];

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

if ($LocationCode == 'All') {
  $LocationCode = '%';
}
if ($Type == 'Detail') {



  // $result = mysqli_query($connection, " 
  //    SELECT a.paitientcode,c.locationname,d.paitentname,d.mobileno,DATE_FORMAT(a.saledate,'%d-%m-%Y') ,
  //    (d.topay-receipt)*-1 AS balance FROM salemaster AS a  JOIN 
  //   (SELECT MAX(saleid) AS saleid,paitientcode FROM salemaster WHERE   locationcode  like ('$LocationCode')
  //   GROUP BY paitientcode ORDER BY 1 DESC) AS b ON a.saleid=b.saleid 
  //   JOIN locationmaster AS c ON a.locationcode =c.locationcode
  //   JOIN paitentmaster AS d ON a.paitientcode=d.paitentid AND (topay-receipt) < 0
  //   WHERE c.locationcode  like ('$LocationCode') 
  //   ");


  $result = mysqli_query($connection, " 
  SELECT paitentid,'Annanagar',paitentname,mobileno,'-',(topay-receipt)*-1 FROM 
   paitentmaster  WHERE  (topay-receipt) < 0 
   
 ");




  //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblOutstanding' class='table table-striped table-bordered'>";
  echo " <thead><tr>  
		<th>S.No</th>          
	 
		<th width='%'> Patient Code </th>    
		<th width='%'> Location Name </th>    
		<th  width='%'> Patient Name</a></th>    
		<th width='%'> Mobile No  </th>     
		<th width='%'> Last Transaction Date</th>           
		<th hidden width='%'> ActualAmount </th>         
		<th  width='%'> Amount </th>         
		<th width='%'> Transfer </th>         
		<th width='%'> Refund </th>         
       
		</tr> </thead> <tbody id='tblSalesDetail' >";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td>$data[0]</td>
  <td >$data[1]</td>  
   <td  id='PaitientName' width='%'>$data[2]</td>   
   <td  id='MobileNo' width='%'>$data[3]</td>     
   <td  width='%'>$data[4]</td>     
   <td hidden width='%'>$data[5]</td>     
   <td  id='Outstanding' width='%'style='text-align:right;' >";
    echo formatMoney($data[5], false);
    echo "</td>

   <td width='%' style='text-align:center;' onclick='Transfer(this);' >
	 <button  class='btn btn-sm btn-primary btn-xs m-r-5' data-toggle='modal' data-target='#myModalTransfer' 
	 >Transfer</button> </td>
	      

   
 <td width='%' style='text-align:center;' onclick='Refund(this);' >
	 <button  class='btn btn-sm btn-warning btn-xs m-r-5' data-toggle='modal' data-target='#myModalRefund' 
	 >Refund</button> </td>
	      
   
  </tr>";

    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody></table>";
}


?>