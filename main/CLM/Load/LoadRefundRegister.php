<script src="../assets/Custom/IndexTable.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
 
 <script>
$(document).ready(function(){
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
  $currentdate =date("Y-m-d"); 			 
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
  $LocationCode = $_SESSION['SESS_LOCATION'];
   
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
 
// $result = mysqli_query($connection, " 
   // SELECT a.paitientcode,c.locationname,d.paitentname,d.mobileno,DATE_FORMAT(a.saledate,'%d-%m-%Y') ,a.newbalance FROM salemaster AS a  JOIN 
  // (SELECT MAX(saleid) AS saleid,paitientcode FROM salemaster WHERE   locationcode ='$LocationCode' 
  // GROUP BY paitientcode ORDER BY 1 DESC) AS b ON a.saleid=b.saleid 
  // JOIN locationmaster AS c ON a.locationcode =c.locationcode
  // JOIN paitentmaster AS d ON a.paitientcode=d.paitentid
  // where c.locationcode ='$LocationCode' AND newbalance > 0 ");
  
$result = mysqli_query($connection, " 
SELECT consultationuniquebill,billdate,doctorid,a.paitentid,totalamount,a.receivedamount,locationcode,tokennumber,
 a.refundstatus,a.refundamount,discountamount,grossamount,oldbalance,newbalance ,b.paitentname,b.mobileno,c.username,
 IFNULL(d.`refundstatus`,'Pending') RefundStatus
 FROM 
 `consultingbillmaster` AS a  
 JOIN paitentmaster AS b ON a.paitentid=b.paitentid 
 JOIN usermaster AS c ON a.doctorid=c.userid 
 left join refundregister as d on a.consultationuniquebill=d.invoiceno
 WHERE  billdate ='$currentdate' and locationcode ='$LocationCode' and tokenstatus='Completed'  and 
 a.refundstatus <>'NoConcession'
  
  ");
  

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblOutstanding' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
	 
		<th hidden width='%'> ID </th>    
		<th width='%'> Date </th>    
			<th width='%'> Token</th>       
		<th hidden width='%'> Doctor</a></th>    
		<th hidden width='%'> Paitent  </th>    
		
		<th width='%'> Paitent Name</th>         
		<th width='%'> Mobile No</th>         
		<th width='%'> Doctor</th>   
		
		<th width='%'> Bill Amount</th>           
		<th width='%'> Recd. Amount</th>         
		<th hidden width='%'> Location</th>         
	  
		       
		<th width='%'> Refund Amount</th>   
		<th hidden width='%'> Refund Status</th>  		
		<th hidden width='%'> Discount Amount</th>         
		<th hidden width='%'> Gross Amount</th>         
		<th hidden width='%'> Old Balance</th>         
		<th hidden width='%'> New Balance</th>         
		<th  width='%'> Status</th>         
	      
       
		</tr> </thead> <tbody id='tblSalesDetail' >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden id='InvoiceNo' >$data[0]</td>
  <td id='InvoiceDate' >$data[1]</td> 
 <td  width='%'>$data[7]</td>     
   <td hidden id='InvoiceDoctorId' width='%'>$data[2]</td>   
   <td hidden id='InvoicePaitienID' width='%'>$data[3]</td> 
   <td  id='InvoicePaitentName' width='%'>$data[14]</td>   
   <td  id='InvoicePaitentMobile' width='%'>$data[15]</td>   
   <td  id='InvoiceDoctorName' width='%'>$data[16]</td> 
   
   <td id='InvoiceTotalAmount' width='%'>$data[4]</td>     
   <td id='InvoiceReceivedAmount'  width='%'>$data[5]</td>   
   <td hidden width='%'>$data[6]</td>   
  
   
   <td id='InvoiceRefundAmount' width='%'>$data[9]</td>   
    <td hidden width='%'>$data[8]</td>  
   <td hidden id='InvoiceDiscountAmount' width='%'>$data[10]</td>   
   <td hidden id='InvoiceGrossAmount' width='%'>$data[11]</td>   
   <td hidden id='InvoiceOldBalance' width='%'>$data[12]</td>   
   <td hidden id='InvoiceNewBalance' width='%'>$data[13]</td>   ";
  if($data[17]=='Completed' || $data[17]=='Adjusted')
  {
	   
 echo "<td width='%' style='text-align:center;'   >
	 <button  class='btn btn-sm btn-success btn-xs m-r-5'  
	 >$data[17]</button> </td>";
  }
  else
  {
	   
 echo "<td width='%' style='text-align:center;' onclick='Refund(this);' >
	 <button  class='btn btn-sm btn-warning btn-xs m-r-5' data-toggle='modal' data-target='#myModalRefund' 
	 >Refund</button> </td>";
  }
  
 
	      
   
 echo " </tr>";
      
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
 }
 

?> 