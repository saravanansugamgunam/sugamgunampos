
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
  

 SELECT a.billid,DATE_FORMAT(a.billdate,'%d-%m-%Y'), b.paitentname, b.mobileno,c.username,a.totalamount-a.discountamount,a.remarks ,b.paitentid,b.gender
 FROM `consultingbillmaster` AS a JOIN paitentmaster AS b ON a.paitentid = b.paitentid  
 JOIN usermaster AS c ON a.doctorid = c.userid  WHERE consultationuniquebill ='$Invoice';"); 
	   
while($data = mysqli_fetch_row($res))
{

$InvoiceNo=$data[0];
$InvoiceDate=$data[1];
$PaitientName=$data[2]; 
$MobileNo=$data[3]; 
$DoctorName=$data[4];  
$TotalConsultationCharge=$data[5];  
$Remarks=$data[6];  
$PatientID=$data[7];  
$Gender=$data[8];   
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
	<center> 
	 <?php 
	 if ($LocationCode=='3')
	 {
		 ?>
		   <img src="../assets/img/logo.png" class="media-object"   width="200" alt="" />
	
	<br>
 <font size="2"> AP 393,17th Street, Thiruvalluvar Kudiyirippu, I Block, Anna Nagar, Tamil Nadu 600040<br>
	Phone: +91 9176606308   &nbsp;&nbsp;&nbsp;&nbsp;  Email: sugamgunamhealthcenter@gmail.com <br>
	 www.sugamgunam.com <br>
	</font>  
	<?php
	 }
	 else if ($LocationCode=='2')
	 {
		 ?>
	 	 <img src="../assets/img/logo.png" class="media-object"   width="200" alt="" />  
	
	<br>
	  <font size="2"> AP 393,17th Street, Thiruvalluvar Kudiyirippu, I Block, Anna Nagar, Tamil Nadu 600040<br>
	Phone: +91 9176606308   &nbsp;&nbsp;&nbsp;&nbsp;  Email: sugamgunamhealthcenter@gmail.com <br>
	 www.sugamgunam.com <br>
	</font>  
	<?php
	 }
	 else if ($LocationCode=='0')
	 {
		 ?>
	 	 <img src="../assets/img/logo.png" class="media-object"   width="200" alt="" />  
	
	<br>
	  <font size="2"> AP 393,17th Street, Thiruvalluvar Kudiyirippu, I Block, Anna Nagar, Tamil Nadu 600040 <br>
	Phone: +91 9176606308   &nbsp;&nbsp;&nbsp;&nbsp;  Email: sugamgunamhealthcenter@gmail.com <br>
	 www.sugamgunam.com <br>
	</font>  
	<?php
	 }
	 ?>
	
	 
	</center>
	 
	</div>
	<div style='float:right' >
	 
			 
			 Bill No. : <?php echo $InvoiceNo; ?> <br>
		 
			 
			  Date : <?php  echo $InvoiceDate; ?><br>
			  </div>
			  <div>
			      Name: <?php  echo $PaitientName; ?><br> 
			      
			      Patient ID: <?php echo 'SG'; echo $PatientID; ?><br> 
			      
			      Gender: <?php  echo $Gender; ?><br> 
  
		 
			  Mobile : <?php  echo $MobileNo; ?><br> 
			  <br>
			 <input type ="hidden" id="txtMobileNo" name="txtMobileNo"  value = <?php  echo $MobileNo; ?> />  </td>
			
		</tr>
		 
	</table>
	 
	</div> 
	</div> 
	<br>
	<div style="width: 100%; ">
	
	<table cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 12px;	text-align:left;" width="100%">
		 <b>Description</b>
	<hr>
		<tbody>
			
				<?php
				$result = mysqli_query($connection, " 
 SELECT b.consultationname,consultationtotal FROM 
 `consultingdetails` AS a JOIN `consultationmaster` AS  b ON a.consultationid = b.consultationid  
 WHERE consultationuniquebill ='$Invoice' and a.consultationid<>'9999'
  UNION 
   SELECT consultationname,consultationtotal FROM 
 `consultingdetails` as a join consultingbillmaster as b on a.consultationuniquebill=b.consultationuniquebill
 WHERE a.consultationuniquebill  ='$Invoice' and b.billingtype = 'Open'
 "); 
					 
					$Sno = 1; 
				while($row = mysqli_fetch_row($result))
					{
						
				?>
				<tr class="record">
				 
				<td ><?php echo $row[0]; ?></td>
				 
				<td style=" text-align:right;"> Rs. <?php echo $row[1]; ?></td> 
				  
				 
				
				</tr>
					<?php
					}
					?>
				 
				 
				 
			
		</tbody>
	</table>
	<hr>
	<div style="float: right;">
	<b><?php echo "Total: Rs. "; echo $TotalConsultationCharge; ?></b>
	</div>
	<div>
	Note:
	<?php echo $Remarks; ?>
	</div>
	
	
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
	$result = mysqli_query($connection, "  SELECT b.`paymentmode`,a.`amount` FROM salepaymentdetails AS a JOIN 
	`paymentmodemaster` AS b ON a.`paymentmode`=b.`paymentmodecode` WHERE  invoiceno='$Invoice'; "); 
					  
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
	 <label>Have a speedy recovery!, Sugamgunam. !!! </label>
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
	 
	 <td><button type="button" onclick="redirecttoReceiptPrint();" class="btn btn-sm btn-info">
	<i class="icon-print"></i> Receipt Print</button>	</td>
	
	
	<td>
	<a href="#modal-dialog" class="btn btn-sm btn-success" data-toggle="modal">Email</a>
		 
 	</td>
	 
	</tr> 
	<input type='hidden' id ='txtInvoiceNo' name ='txtInvoiceNo' value='<?php echo $Invoice; ?>' />
	
		</center> 
		<script>	
function redirecttoReceiptPrint() {
	var Invoice = document.getElementById("txtInvoiceNo").value; 
var str1 = "ReceiptPrint.php?invoice=";
var str2 = Invoice;
var str3 = "";
var BillPrintURL = str1.concat(str2, str3);
// alert(BillPrintURL);
// window.location.href = BillPrintURL;
window.open(BillPrintURL); 
}
</script>
		
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