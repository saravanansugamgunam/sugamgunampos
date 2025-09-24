
<form action="" method="post" >
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	
							
     <?php
// Start the buffering //
ob_start();
   
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
$Invoice=$_GET['invoice'];
 

	  $res = $connection->query(" 
SELECT DATE_FORMAT(saledate,'%d-%m-%Y') AS InvoiceDate , CONCAT(invoiceno,'-',saleid) AS Invoice, `paitentname`,
SUM(nettamount) AS Total,b.mobileno,a.discountamount,IFNULL(address1,'-') AS address1,address2,b.city,state,b.pincode,c.couriercharge FROM salemaster AS a
JOIN paitentmaster AS b ON a.paitientcode = b.`paitentid` LEFT JOIN courierdetails  AS c
ON a.saleuniqueno=c.invoicenumber WHERE saleuniqueno ='$Invoice';"); 
	   
while($data = mysqli_fetch_row($res))
{

$InvoiceDate=$data[0];
$InvoiceNo=$data[1];
$PaitientName=$data[2]; 
$TotalAmount=$data[3];  
$MobileNo=$data[4]; 
$DiscountBill=$data[5]; 
$Address1=strtoupper($data[6]); 
$Address2=strtoupper($data[7]); 
$City=strtoupper($data[8]); 
$State=strtoupper($data[9]); 
$Pincode=$data[10]; 
$CourierCharge=$data[11]; 
$FinalTotal=$TotalAmount+$CourierCharge;


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
	<div style="width: 100%; " >
	<div style="width: 900px; float: left;">
	<center><div style="font:bold 25px 'Aleo';">SugamGunam</div>
	<center><div style="font:bold 12px 'Aleo';">Estimate</div>
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
	<div style="width: 200px; float: left;">
	<table cellpadding="3" cellspacing="0" style="font-family: arial; font-size: 12px;text-align:left;width : 100%;">

		<tr>
			<td>Bill No. :</td>
			<td><?php echo $InvoiceNo; ?></td>
		</tr>
		<tr>
			<td>Date :</td>
			 
			<td><?php  echo $InvoiceDate; ?></td>
		</tr>
		<tr>
			<td>Paitent :</td>
			 
			<td><?php  echo $PaitientName; ?></td>
		</tr>
		<tr>
			<td>Mobile :</td>
			 
			<td><?php  echo $MobileNo; ?>
			 <input type ="hidden" id="txtMobileNo" name="txtMobileNo"  value = <?php  echo $MobileNo; ?> />  </td>
			
		</tr>
		<?php
		if($Address1 =="-")
		{
		}
		else
		{
			echo "<tr>
			<td valign='top'>Address :</td><td style'text-transform:uppercase;'>";
			 echo " <b>$Address1</b><br> "; 
			 echo " <b>$Address2</b><br> ";
			 echo " <b>$City</b><br> ";
			 echo " <b>$State - $Pincode</b><br> ";
			 echo " </td></tr>";
		}
		?>
	</table>
	<br>
	</div>
	<div class="clearfix"></div>
	</div>
	<div style="width: 100%; ">
	<table border="1" cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 12px;	text-align:left;" width="100%">
		<thead>
			<tr>
				 
				<th>S. No</th>
				<th> Barcode </th> 
				<th> Shortcode </th> 
				<th> Qty </th>
				<?php if($DiscountBill>0)
				{
					echo "<th> Discount </th>";
				}
				 ?>
				 
				<th> Amount </th>
			</tr>
		</thead>
		<tbody>
			
				<?php
				$result = mysqli_query($connection, " SELECT barcode,shortcode,saleqty,discountamount, nettamount,invoiceno
FROM 
(SELECT barcode,shortcode,saleqty,discountamount, nettamount,invoiceno FROM `newsaleitems`
UNION 
SELECT '-',shortcode,saleqty,discountamount, nettamount,invoiceno FROM saleitems) AS a   WHERE invoiceno  ='$Invoice'; "); 
					  
					$Sno = 1; 
				while($row = mysqli_fetch_row($result))
					{
						
				?>
				<tr class="record">
				<td><?php echo $Sno; ?></td>
				<td ><?php echo $row[0]; ?></td>
				<td ><?php echo $row[1]; ?></td>
				 
				<td style=" text-align:right;"><?php echo $row[2]; ?></td> 
				<?php if($DiscountBill>0)
				{
					echo "<td style=' text-align:right;'>$row[3]</td> ";
				}
				 ?>
				 
				
				<td style=" text-align:right;"> <?php echo $row[4]; ?> </td> 
				 
				
				</tr>
				<?php
				$Sno=$Sno+1;
					}
				?>
			
				<tr>
				<?php if($DiscountBill>0)
				{
					echo "<td colspan='5' style='text-align:right;'><strong style='font-size: 12px;'>Total Amount: &nbsp;</strong></td>
					<td colspan='3' style=' text-align:right;'><strong style='font-size: 12px;'>";
				    echo formatMoney($TotalAmount, true);
				}
				else
				{
					echo "<td colspan='4' style='text-align:right;'><strong style='font-size: 12px;'>Total Amount: &nbsp;</strong></td>
					<td colspan='2
					' style=' text-align:right;'><strong style='font-size: 12px;'>";
					
				    echo formatMoney($TotalAmount, true);
				}
				
					?>
					<input type ="hidden" id="txtTotalInvoiceValue" name="txtTotalInvoiceValue"  value = <?php  echo $TotalAmount; ?> /> 
					</strong></td>
				</tr>
				 
				 
				<?php 
				
				
				
				 
					if($CourierCharge>0)
				{
					 if($DiscountBill>0)
				{
					
					echo " <tr><td colspan='5' style='text-align:right;'><strong style='font-size: 12px;'>Courier Amount: &nbsp;</strong></td>
					<td colspan='3' style=' text-align:right;'><strong style='font-size: 12px;'>";
				    echo formatMoney($CourierCharge, true);
					echo "</td></tr>";
					
					echo " <tr><td colspan='5' style='text-align:right;'><strong style='font-size: 12px;'>Final Amount: &nbsp;</strong></td>
					<td colspan='3' style=' text-align:right;'><strong style='font-size: 12px;'>";
				    echo formatMoney($FinalTotal, true);
					echo "</td></tr>";
				}
				else
					{
					
					echo " <tr><td colspan='4' style='text-align:right;'><strong style='font-size: 12px;'>Courier Amount: &nbsp;</strong></td>
					<td colspan='3' style=' text-align:right;'><strong style='font-size: 12px;'>";
				    echo formatMoney($CourierCharge, true);
					echo "</td></tr>";
					
					echo " <tr><td colspan='4' style='text-align:right;'><strong style='font-size: 12px;'>Final Amount: &nbsp;</strong></td>
					<td colspan='3' style=' text-align:right;'><strong style='font-size: 12px;'>";
				    echo formatMoney($FinalTotal, true);
					echo "</td></tr>";
				}
					 
				 
				}
				?>
				  
				 
			
		</tbody>
	</table>
	
	
	<br>
	<br>
	<h5>Payment Details</h5>
	<table border="1" cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 12px;	text-align:left;" width="20%">
		<thead>
			<tr>
				 
				<th>S. No</th>
				<th> Payment Mode </th> 
				<th> Amount </th>  
			</tr>
		</thead>
		<tbody>
		
	<?php
	$result = mysqli_query($connection, "  SELECT b.`paymentmode`,a.`amount` FROM salepaymentdetails AS a JOIN `paymentmodemaster` AS b ON a.`paymentmode`=b.`paymentmodecode` WHERE  invoiceno='$Invoice'; "); 
					  
					$Sno = 1; 
				while($row = mysqli_fetch_row($result))
					{
						?>
						<tr>
						<td><?php echo $Sno; ?></td>
						<td><?php echo  $row[0]; ?></td>
						<td><?php echo formatMoney($row[1], true); ?></td>
						 
						</tr>
						
					<?php
					$Sno=$Sno+1;
					}
					
					?>
					
		</tbody>
	</table>
	
	
						
	<center> 
	<br>
	 <label> Thank you !!! </label>
	</center>
	</div>
	</div>
	</div>
	</div>
	<center>  
	<tr>
	    <?php
 

// Get the content that is in the buffer and put it in your file //
file_put_contents('Bill.html', ob_get_contents());
?>

	<td><button type="button" onclick="Clickheretoprint();" class="btn btn-sm btn-info"><i class="icon-print"></i> Print</button>	</td>
	<td><button type="button" onclick="SendSMS();" class="btn btn-sm btn-primary"><i class="icon-print"></i> SMS</button> 	</td>
	<td>
	<a href="#modal-dialog" class="btn btn-sm btn-success" data-toggle="modal">Email</a>
		 
 	</td>
	 
	</tr> 
		</center> 
		
		<div class="modal fade" id="modal-dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">Email To</h4>
										</div>
										<div class="modal-body">
											<label>
											Email ID*
											</label>
											 <input class="form-control" style='width: 350px;' type="text" name="txtEmail" id="txtEmail" />
											
										</div>
										<div class="modal-footer">
											<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
						  
						 <a  href="javascript:;" type='submit' onclick='SeneEmail();' class='btn btn-sm btn-success'>Send</a>  
										</div>
									</div>
								</div>
							</div>
							
	 
							
		</form>
		<script>
		
		 function SeneEmail()
	  {
		  
		var EmaiID = document.getElementById("txtEmail").value;
		if(EmaiID=="")
		{
			alert("Kindly provide Email ID");
		}
		else
		{
			
		var datas = "&EmaiID="+EmaiID;	
	  	   // alert(datas);
		 $.ajax({
		   url:"sendemail.php",
		    method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		     alert(data);
		   
		   }
		});}
		   
	  } 
	  
	  
		</script>