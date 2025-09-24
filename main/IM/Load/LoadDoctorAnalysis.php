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
  $currentdate =date("Y-m-d"); 			
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
 $DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]); 
  $LocationCode = $_SESSION['SESS_LOCATION'];
  $Location = mysqli_real_escape_string($connection, $_POST["Location"]); 
  
  if($Location=='All')
  {
	  $Location='%';
  }
  
  
  $FromDate = explode('/', $FromDate); 
$ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0];
 $ToDate = explode('/', $ToDate); 
$ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0];

// $ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));

function formatMoney($number, $fractional=false) {
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
				
 if ($Type=='Summary')
 {
 
	 
$result = mysqli_query($connection, "


  SELECT  b.`username`,  SUM(saleqty) AS Qty,ROUND(SUM(discountamount),0) AS Discount,
 ROUND(SUM(nettamount),0) AS TotalSale,ROUND(SUM(profitamount),0) AS Profit FROM salemaster  AS a 
 JOIN usermaster AS b ON a.doctorcode=b.userid 
 WHERE saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'  and  a.locationcode like('$Location') 
    AND a.transactiontype NOT IN('Outstanding','Cancelled','Return') AND cancellstatus =0 
	and a.doctorcode like ('$DoctorCode') 
  GROUP BY b.`username` order by saledate desc
  ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		    
		<th  width='%'> Doctor</a></th>     
		<th width='%'> Qty</th>           
		<th width='%' > Discount </th>        
		<th width='%'> Nett Amount </th>              
		<th width='%'> Profit</th>      
		</tr> </thead> <tbody  id='tblSalesDetails'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td> $data[0]</td>
  
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[1], false); echo "</td>     
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[2], false); echo "</td>     
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[3], false); echo "</td>     
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[4], false); echo "</td>   
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
 }
 
 
 else
	 
	 {
		 
$result = mysqli_query($connection, "


  SELECT DATE_FORMAT(saledate,'%d-%m-%Y'),b.`username`,  SUM(saleqty) AS Qty,ROUND(SUM(discountamount),0) AS Discount,
 ROUND(SUM(nettamount),0) AS TotalSale, ROUND(SUM(profitamount),0) AS Profit FROM salemaster  AS a 
 JOIN usermaster AS b ON a.doctorcode=b.userid 
 WHERE saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'  and  a.locationcode like('$Location')   
    AND a.transactiontype NOT IN('Outstanding','Cancelled','Return') AND cancellstatus =0 
		and a.doctorcode like ('$DoctorCode') 
  GROUP BY DATE_FORMAT(saledate,'%d-%m-%Y'),b.`username` order by saledate desc
  ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		 
		<th  width='%'> Date</a></th>     
		<th  width='%'> Doctor</a></th>     
		<th width='%'> Qty</th>           
		<th width='%' > Discount </th>        
		<th width='%'> Nett Amount </th>               
		<th width='%'> Profit</th>      
		</tr> </thead> <tbody  id='tblSalesDetails'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td> $data[0]</td>
  <td> $data[1]</td>
  <td >$data[2]</td>  
    
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[3], false); echo "</td>     
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[4], false); echo "</td>  
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[5], false); echo "</td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
		 
	 }

?> 