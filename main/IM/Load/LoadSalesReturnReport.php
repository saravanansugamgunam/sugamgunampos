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
  $LocationCode = $_SESSION['SESS_LOCATION'];
  
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
				
 if ($Type=='Detail')
 {
 
$result = mysqli_query($connection, " 
  SELECT saleuniqueno,CONCAT(invoiceno,'-',saleid) AS Bill,DATE_FORMAT(saledate,'%d-%m-%Y'), CONCAT(b.paitentname,' (',b.mobileno,')'), 
 saleqty,discountamount,nettamount,IFNULL(received,0),profitamount,locationcode,a.transactiontype,c.username FROM salemaster  AS a
 JOIN paitentmaster AS b ON a.paitientcode=b.paitentid 
 JOIN usermaster AS c ON a.addedby = c.userid
 WHERE saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'  and a.transactiontype  in('Return') and cancellstatus =0 ");
 

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th hidden  width='%'> Unique No </th>    
		<th width='%'> Bill No </th>    
		<th  width='%'> Date</a></th>    
		<th  width='%'> Patient  </th>    
		<th  width='%'> Return By  </th>     
		<th width='%'> Qty</th>           
		<th width='%'> Discount </th>        
		<th width='%'> Nett Amount </th>        
		<th width='%'> Received Amount </th>        
		<th width='%' hidden> Profit</th>           
		<th width='%'> View</th>               
		 
		</tr> </thead> <tbody id='tblSalesDetail' >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'><a href='../assets/Custom/IndexTable.js'> $SerialNo</a></td>
  <td hidden id ='InvoiceNo' > $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>   
      <td width='%'>$data[11]</td>  
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[4], false); echo "</td>    
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[5], true); echo "</td>       
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[6], true); echo "</td> 
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[7], true); echo "</td> 
   <td width='%' style='text-align:right;' hidden>"; echo formatMoney($data[8], true); echo "</td> 
   <td align='center' style='color:#009ad9'  >
   <a href='SaleBillView.php?invoice=$data[0]' target='_blank' ?>
   <button  class='btn btn-sm btn-info btn-xs'>View</button></a></td>  
   
    
  </tr>";
      
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
 }
 else if ($Type=='ProductWise')
 {
 
$result = mysqli_query($connection, " 
 SELECT saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) AS Bill,DATE_FORMAT(a.saledate,'%d-%m-%Y'), CONCAT(b.paitentname,' (',b.mobileno,')'),
 `shortcode`,`category`,`productname`,`rate`,`mrp`,
 c.saleqty,c.discountamount,c.nettamount,c.profitamount,a.locationcode,a.transactiontype FROM salemaster  AS a
 JOIN paitentmaster AS b ON a.paitientcode=b.paitentid JOIN newsaleitems AS c ON a.`saleuniqueno`=c.`invoiceno`
 WHERE a.saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'  and a.transactiontype  in('Return') and cancellstatus =0 ");

 //echo "<table id='tblProject' class='tblMasters'>";
 echo "";
  echo "  <table id='tblItemwise' name='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th hidden width='%'> Unique No </th>    
		<th width='%'> B.No </th>    
		<th  width='%'> Date</a></th>    
		<th  width='%'> Patient  </th>     
		<th  width='%'> S.Code  </th>     
		<th  width='%'> Category  </th>     
		<th  width='%' id='Pr'> Product  </th>     
		<th  width='%'> Cost  </th>     
		<th  width='%'> MRP  </th>     
		<th width='%'> Qty</th>           
		<th width='%'> Discount </th>        
		<th width='%'> Nett.Amt </th>        
		<th width='%' hidden> Profit</th>           
		<th width='%'> View</th>       		
		 
		</tr> </thead> <tbody id='tblSalesDetails' >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden id ='InvoiceNo' > $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>     
   <td width='%'>$data[6]</td>     
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[7], false); echo "</td>    
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[8], false); echo "</td>       
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[9], false); echo "</td> 
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[10], true); echo "</td> 
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[11], true); echo "</td> 
   <td width='%' style='text-align:right;' hidden> "; echo formatMoney($data[12], true); echo "</td> 
   <td align='center' style='color:#009ad9'  >
   <a href='SaleBillView.php?invoice=$data[0]' target='_blank' ?>
   <button  class='btn btn-sm btn-info btn-xs'>View</button></a></td>  
   
    
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
 SELECT DATE_FORMAT(saledate,'%d-%m-%Y'), SUM(saleqty) AS Qty,ROUND(SUM(discountamount),2) AS Discount,
 ROUND(SUM(nettamount),2) AS TotalSale,
 ROUND(SUM(received),2) AS Received,ROUND(SUM(profitamount),2) AS Profit,locationcode FROM salemaster  AS a 
 WHERE saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'   and a.transactiontype in('Return') and cancellstatus =0 
  GROUP BY locationcode ,DATE_FORMAT(saledate,'%d-%m-%Y') ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		 
		<th  width='%'> Date</a></th>     
		<th width='%'> Qty</th>           
		<th width='%' > Discount </th>        
		<th width='%'> Nett Amount </th>        
		<th width='%'> Received Amount </th>        
		<th width='%' hidden> Profit</th>      
		</tr> </thead> <tbody  id='tblSalesDetails'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td> $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%' style='text-align:right;' >"; echo formatMoney($data[2], false); echo "</td>  
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[3], false); echo "</td>     
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[4], false); echo "</td>  
   <td width='%' style='text-align:right;'hidden  >"; echo formatMoney($data[5], false); echo "</td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
		 
	 }

?> 