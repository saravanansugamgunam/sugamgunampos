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
 $Type ='Detail'; 
 $ConsultationType = mysqli_real_escape_string($connection, $_POST["ConsultationType"]); 
 $Location = mysqli_real_escape_string($connection, $_POST["Location"]); 
 $ConsultationGroup = mysqli_real_escape_string($connection, $_POST["ConsultationGroup"]); 
 $Doctor = mysqli_real_escape_string($connection, $_POST["Doctor"]); 
 $PaitientID = mysqli_real_escape_string($connection, $_POST["PaitientID"]); 
  
   
  if($Location=='All')
  {
	  $Location='%';
  }
  
   if($ConsultationType=='All')
  {
	  $ConsultationType='%';
  }
  
  if($ConsultationGroup=='All')
  {
	  $ConsultationGroup='%';
  }
  
  if($Doctor=='All')
  {
	  $Doctor='%';
  }
  
  
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
  // SELECT saleuniqueno,CONCAT(invoiceno,'-',saleid) AS Bill,DATE_FORMAT(saledate,'%d-%m-%Y'), CONCAT(b.paitentname,' (',b.mobileno,')'),
 // saleqty,discountamount,nettamount,received,profitamount,locationcode,a.transactiontype FROM salemaster  AS a
 // JOIN paitentmaster AS b ON a.paitientcode=b.paitentid
 // WHERE saledate BETWEEN '$ActualFromDate' AND '$ActualToDate' and locationcode ='$LocationCode' and a.transactiontype not in('Outstanding','Cancelled') and cancellstatus =0 ");
 
 
 $result = mysqli_query($connection, " 
  SELECT DATE_FORMAT(a.billdate,'%d-%m-%Y') ,a.consultationuniquebill,a.billid, 
  CONCAT(b.paitentname,'(',b.mobileno,')') AS paitent,c.username,a.totalamount+a.extracharge,cancelledstatus,
	a.receivedamount,SUM(d.discount) AS discount,billtype FROM `consultingbillmaster` AS a JOIN paitentmaster AS b ON a.paitentid = b.paitentid  
 JOIN usermaster AS c ON a.doctorid = c.userid join 
 consultingdetails as d on a.consultationuniquebill = d.consultationuniquebill
 join consultationmaster as e on d.consultationid=e.consultationid
 
 WHERE   cancelledstatus='0'
 and a.locationcode like('$Location')  and d.consultationid like('$ConsultationType') 
and  e.consultingtype like ('$ConsultationGroup') and a.doctorid like ('$Doctor')
and a.paitentid='$PaitientID'
GROUP BY DATE_FORMAT(a.billdate,'%d-%m-%Y') ,a.consultationuniquebill,a.billid, CONCAT(b.paitentname,'(',b.mobileno,')'),
c.username,a.totalamount+a.extracharge,cancelledstatus,
	a.receivedamount ,billtype
	
	union 
	
	
	  SELECT DATE_FORMAT(a.billdate,'%d-%m-%Y') ,a.consultationuniquebill,a.billid, CONCAT(b.paitentname,'(',b.mobileno,')') AS paitent,c.username,
	  a.totalamount+a.extracharge,cancelledstatus,
	a.receivedamount,SUM(d.discount) AS discount,billtype FROM `consultingbillmaster` AS a JOIN paitentmaster AS b ON a.paitentid = b.paitentid  
 JOIN usermaster AS c ON a.doctorid = c.userid join 
 consultingdetails as d on a.consultationuniquebill = d.consultationuniquebill 
 
 WHERE   cancelledstatus='0'
 and a.locationcode like('$Location')  and d.consultationid like('$ConsultationType') 
  and a.doctorid like ('$Doctor')
and a.paitentid='$PaitientID'
GROUP BY DATE_FORMAT(a.billdate,'%d-%m-%Y') ,a.consultationuniquebill,a.billid, CONCAT(b.paitentname,'(',b.mobileno,')'),
c.username,a.totalamount+a.extracharge,cancelledstatus,
	a.receivedamount ,billtype
	
 ");
   
 
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th  width='%'> Date</a></th>    
		<th hidden width='%'> Unique No </th>    
		<th width='%'> Bill No </th>    
		<th  width='%'> Patient  </th>     
		<th width='%'> Doctor</th>           
		<th width='%'> Fees </th>        
		<th width='%'> Discount </th>        
		<th width='%'> Received Amount </th>        
		<th width='%'> View </th>        
		<th width='%'> Cancel </th>        
		     
		</tr> </thead> <tbody id='tblSalesDetail' >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'> $SerialNo </td>
  <td    > $data[0]</td>
  <td hidden  > $data[1]</td>
  <td >$data[2]</td>  
   <td  width='%'>$data[3]</td>   
   <td width='%'>$data[4]</td>        
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[5], true); echo "</td>    
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[8], true); echo "</td>    
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[7], true); echo "</td>    
  
  <td align='center' style='color:#009ad9'  >
   <a href='SaleBillView.php?invoice=$data[1]' target='_blank' ?>
   <i class='fa fa-2x fa-eye' title='View'></i></a></td>  
 
";

if($data[9]=='Consultation')
{
	echo "<td align='center' style='color:#009ad9' >
<a href='' data-toggle='modal' data-target='#myModalCancel' 
	onclick='LoadCancelBillDetail(".$data[1].");'> <i class='fa fa-2x  fa-times-circle text-danger' title='Sales Cancel'></i></a>"; 
		 
	 
	echo "</td>"; 
}
else
{
	echo "<td align='center' style='color:#009ad9' > </td>"; 
}


	
   
  echo "</tr>";
      
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
 }
 else if ($Type=='ProductWise')
 {
 
// $result = mysqli_query($connection, " 
 // SELECT saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) AS Bill,DATE_FORMAT(a.saledate,'%d-%m-%Y'), CONCAT(b.paitentname,' (',b.mobileno,')'),
 // `shortcode`,`category`,`productname`,`rate`,`mrp`,
 // c.saleqty,c.discountamount,c.nettamount,c.profitamount,a.locationcode,a.transactiontype FROM salemaster  AS a
 // JOIN paitentmaster AS b ON a.paitientcode=b.paitentid JOIN saleitems AS c ON a.`saleuniqueno`=c.`invoiceno`
 // WHERE a.saledate BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.locationcode ='$LocationCode'  and a.transactiontype not in('Outstanding','Cancelled') and cancellstatus =0 ");
 
 
 $result = mysqli_query($connection, "

 SELECT saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid) AS Bill,DATE_FORMAT(a.saledate,'%d-%m-%Y'), CONCAT(b.paitentname,' (',b.mobileno,')'),
 shortcode,category,productname,rate,mrp,
 c.saleqty,c.discountamount,c.nettamount,c.profitamount,a.locationcode,a.transactiontype ,SUM(c.returnstatus),saletype,IFNULL(courierservice,'-')  FROM salemaster  AS a
 JOIN paitentmaster AS b ON a.paitientcode=b.paitentid JOIN saleitems AS c ON a.saleuniqueno=c.invoiceno 
 LEFT JOIN courierdetails AS d ON  a.saleuniqueno=d.invoicenumber 
 WHERE  a.locationcode ='$LocationCode'   AND a.transactiontype NOT IN('Outstanding','Cancelled') AND cancellstatus =0 and 
 saletype like ('%".$BillMode."%') and a.paitentid='$PaitientID'
 
 GROUP BY saleuniqueno,CONCAT(a.invoiceno,'-',a.saleid),DATE_FORMAT(a.saledate,'%d-%m-%Y'),
  CONCAT(b.paitentname,' (',b.mobileno,')'),
 shortcode,category,productname,rate,mrp,
 c.saleqty,c.discountamount,c.nettamount,c.profitamount,a.locationcode,a.transactiontype,saletype,courierservice

   ");
     

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
		<th width='%'> Profit</th>           
		<th width='%'> View</th>           
		<th width='%'> Return</th>   		
		<th width='%'> Cancel</th>   		
		<th width='%'> Courier</th>   		
		 
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
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[12], true); echo "</td> 
   <td align='center' style='color:#009ad9'  >
   <a href='SaleBillView.php?invoice=$data[0]' target='_blank' ?>
   <i class='fa fa-2x fa-eye' title='View'></i></a></td>  
  <td align='center' style='color:#009ad9' >";
	
    if ($data[14] =='Return')
	{
	
	}
	else
	{
		echo "
		
		<a href='' data-toggle='modal' data-target='#myModalReturn' 
	onclick='LoadItemDetails(".$data[0].");'> <i class='fa fa-2x  fa-mail-reply-all text-warning' title='Sales Return'></i></a>";
	}
	echo "</td>  
	<td align='center' style='color:#009ad9' >";
	if ($data[14] =='Return' || $data[10] =='Cancelled')
	{

	}
	else
	{
		if ($data[15] ==0 )
		{ 
			
			echo "
		

		<a href='' data-toggle='modal' data-target='#myModalCancel' 
	onclick='LoadCancelBillDetail(".$data[0].");'> <i class='fa fa-2x  fa-times-circle text-danger' title='Sales Cancel'></i></a>";
 
		}
	
	}
	 
	echo "</td>" ;
	
	echo "<td align='center' style='color:#009ad9' >";
	 
	 if ($data[16] =='Courier')
	{
	 
		
if ($data[17] =='0')
	{
	
	
	 echo "<a href='' data-toggle='modal' data-target='#myModalCourierTracking' 
	onclick='LoadCancelBillDetail(".$data[0].");'> <i class='fa fa-2x  fa-truck text-danger' title='Courier Details'></i></a>";
	}
	else
	{
	echo "<a href='' data-toggle='modal' data-target='#myModalCourierTrackingDetails' 
	onclick='LoadCourierDetails(".$data[0].");'> <i class='fa fa-2x  fa-truck text-success' title='View Courier Details'></i></a>";
	}
	
	}
	else
	{
		
	}
	
	 echo "</td> 
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

    
 SELECT DATE_FORMAT(a.saledate,'%d-%m-%Y'), SUM(a.saleqty) AS Qty,ROUND(SUM(a.discountamount),2) AS Discount,
 ROUND(SUM(a.nettamount),2) AS TotalSale,
 ROUND(SUM(d.couriercharge),2) AS CourierCharge,
 ROUND(SUM(a.received),2) AS Received,ROUND(SUM(a.profitamount),2) AS Profit,locationcode FROM salemaster  AS a 
 JOIN saleitems AS b ON  a.saleuniqueno=b.invoiceno 
 LEFT JOIN courierdetails AS d ON  a.saleuniqueno=d.invoicenumber
 WHERE  locationcode ='$LocationCode'  and a.transactiontype not in('Outstanding') and cancellstatus =0  and 
 saletype like ('%".$BillMode."%') 
  GROUP BY locationcode ,DATE_FORMAT(a.saledate,'%d-%m-%Y') ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		 
		<th  width='%'> Date</a></th>     
		<th width='%'> Qty</th>           
		<th width='%' > Discount </th>        
		<th width='%'> Nett Amount </th>        
		<th width='%'> Courier. Chg </th>        
		<th width='%'> Received Amount </th>        
		<th width='%'> Profit</th>      
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
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[5], false); echo "</td>  
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[6], false); echo "</td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
		 
	 }

?> 