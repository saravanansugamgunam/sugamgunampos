<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
     
 <?php 
  
    include("../../connect.php");
   
	 session_cache_limiter(FALSE);
    session_start();
	 $position = $_SESSION["SESS_LAST_NAME"]; 
   $LocationCode = $_SESSION['SESS_LOCATION'];
   
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
					
    // $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]); 
$GRNNumber=$_GET['A'];  
	  $res = $connection->query("
 SELECT DATE_FORMAT(purchasereturndate,'%d-%m-%Y') AS InvoiceDate , '-' AS Invoice, suplier_name,
SUM(a.nettamount) AS Total,SUM(a.returnqty) AS Qty,0 FROM purchasereturnmaster AS a
JOIN supliers AS b ON a.suppliercode = b.suplier_id WHERE purchaseteturnuniqueno='$GRNNumber' ;


"); 
	   
while($data = mysqli_fetch_row($res))
{

$InvoiceDate=$data[0];
$InvoiceNo=$data[1];
$SupplierName=$data[2]; 
$TotalAmount=$data[3];  
$TotalQty=$data[4]; 
$DiscountBill=$data[5]; 


}


	
   ?>
<div class="content" id="content">
<script>
 function printDiv() 
 {
        var divToPrint = document.getElementById('DivInvoice');
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
}
   
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("DivInvoice").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}

 
	 function SendSMS()
	  {
		  
		var MobileNo = document.getElementById("txtMobileNo").value; 
		// var MobileNo = 9884589943; 
		var TotalValue = document.getElementById("txtTotalInvoiceValue").value; 
		var M1  = "Get well soon!. Your bill value is ";
		var M2  = ", Thanks for trust in SugamGunam, Chetpet";
		var Message  =   M1.concat('Rs.',TotalValue,M2);
		 // alert(Message);
		var datas = "&MobileNo="+MobileNo+"&Message="+Message;	
	  	  // alert(datas); 
		 $.ajax({
		   url:"sendsms.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		    alert(data);
		   
		   }
		  }); 
	  } 
 
	  
</script>
 
<div id='DivInvoice'>
<div style="margin: 0 auto; padding: 20px; width: 900px; font-weight: normal;">
	<div style="width: 100%; height: 190px;" >
	<div style="width: 900px; float: left;">
	<center><div style="font:bold 25px 'Aleo';">SugamGunam</div>
	<center><div style="font:bold 12px 'Aleo';">Purchase Return Details</div>
	 <?php 
	 if ($LocationCode=='1')
	 {
		 ?>
		 <!--  <img src="../assets/img/L1_Bill_Invoice.png" class="media-object"   width="200" alt="" />-->
	
	<br>
   <!-- 	<font size="2"> No.18, Mc.Nichols Road,    Chetpet, Chennai – 31 <br>
	Phone: +91 9176606308   &nbsp;&nbsp;&nbsp;&nbsp;  Email: sugamgunamhealthcenter@gmail.com <br>
	 www.sugamgunam.com <br>
	</font> -->
	<?php
	 }
	 else if ($LocationCode=='2')
	 {
		 ?>
	 <!-- 	 <img src="../assets/img/L1_Bill_Invoice.png" class="media-object"   width="200" alt="" /> -->
	
	<br>
	 <!--  <font size="2"> No.18, Chetpet, Chennai – 31 <br>
	Phone: +91 9176606308   &nbsp;&nbsp;&nbsp;&nbsp;  Email: sugamgunamhealthcenter@gmail.com <br>
	 www.sugamgunam.com <br>
	</font>--> 
	<?php
	 }
	 ?>
	
	 
	</center>
	 
	</div>
	<div style="width: 506px; float: left; height: 70px;">
	<table   cellspacing="0" style="font-family: arial; font-size: 12px;text-align:left;">

		<tr>
			<td>Supplier. :</td>
			<td><?php echo $SupplierName; ?></td>
		</tr>
		<tr>
			<td>Date :</td>
			 
			<td><?php  echo $InvoiceDate; ?></td>
		</tr>
		 
	</table>
	
	</div>
	<div class="clearfix"></div>
	</div>
	<div style="width: 100%; margin-top:-70px;">
	<table border="1" cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 12px;	text-align:left;" width="100%">
		<thead>
			<tr>
				 
				<th>S. No</th>
				<th> Barcode </th>
				<th> Shortcode </th>
				<th> Product </th>
				<th> Batch </th>
				<th> Qty </th>
				<th> Rate </th> 
				 
			</tr>
		</thead>
		<tbody>
			
				<?php
				$result = mysqli_query($connection, "
SELECT a.barcode,a.shortcode,a.productname,a.batchcode,1,a.rate FROM newpurchasereturnitems AS a 
WHERE invoiceno='$GRNNumber'  "); 
					 
					$Sno = 1; 
				while($row = mysqli_fetch_row($result))
					{
						 // echo formatMoney($TotalAmount, true);
				?>
				<tr class="record">
				<td><?php echo $Sno; ?></td>
				<td ><?php echo $row[0]; ?></td>
				<td><?php echo $row[1]; ?></td> 
				<td ><?php echo $row[2]; ?></td> 
				<td style='text-align:right;'><?php echo $row[3]; ?></td> 
				<td style='text-align:right;'><?php echo $row[4]; ?></td> 
				<td style='text-align:right;'><?php echo $row[5]; ?></td> 
				 
				</tr>
				
				<?php
				$Sno=$Sno+1;
					}
				?>
			
				<tr>
				 <td colspan='5' style='text-align:right;'><strong style='font-size: 12px;'>Total Amount: &nbsp;</strong></td>
				 <td colspan='0' style=' text-align:right;'><strong style='font-size: 12px;'>
				   <?php echo formatMoney($TotalQty, true); ?>
				 
					</strong></td>
					<td colspan='3' style=' text-align:right;'><strong style='font-size: 12px;'>
				   <?php echo formatMoney($TotalAmount, true); ?>
				 
					</strong></td>
				</tr>

		</tbody>
	</table>
	
	<center> 
	<br>
	  
	</center>
	  
	</div>
	</div>
	</div>
	</div>
	<center>  
	<tr>
	<td><button type="button" onclick="Clickheretoprint();" class="btn btn-sm btn-info"><i class="icon-print"></i> Print</button>	</td>
 
	</tr> 
		</center>
	