<html>
<?php
	require_once('auth.php');
?>
<head>
<title>
POS
</title>
 <link href="css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
  
  <link rel="stylesheet" href="css/font-awesome.min.css">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">


<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script>
<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=700, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>


 <script language="javascript" type="text/javascript">
/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
<!-- Begin
var timerID = null;
var timerRunning = false;
function stopclock (){
if(timerRunning)
clearTimeout(timerID);
timerRunning = false;
}
function showtime () {
var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = "" + ((hours >12) ? hours -12 :hours)
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
timeValue += (hours >= 12) ? " P.M." : " A.M."
document.clock.face.value = timeValue;
timerID = setTimeout("showtime()",1000);
timerRunning = true;
}
function startclock() {
stopclock();
showtime();
}
window.onload=startclock;
// End -->
</SCRIPT>
</head>
<?php
function createRandomPassword() {
	$chars = "003232303232023232023456789";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	while ($i <= 7) {

		$num = rand() % 33;

		$tmp = substr($chars, $num, 1);

		$pass = $pass . $tmp;

		$i++;

	}
	return $pass;
}
$finalcode='RS-'.createRandomPassword();
?>
<body>
<?php include('navfixed.php');?>
<div class="container-fluid">
      <div class="row-fluid">
	
	<div class="contentheader">
			<i class="icon-bar-chart"></i> Sales Report
			</div>
			 

<div style="margin-top: 0px; margin-bottom: 21px;">
<a  href="index.php"><button class="btn btn-default btn-small" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
<button  style="float:right;" class="btn btn-success btn-mini"><a href="javascript:Clickheretoprint()"> Print</button></a>

</div>
<form action="salesreport.php" method="get">
<center><strong>From : <input type="date" style="width: 223px; height:35px; color:#222;" name="d1" class="stcal" value="" /> To: <input type="date" style="width: 223px; height:35px; color:#222;" name="d2" class="stcal" value="" />
 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit"><i class="icon icon-search icon-large"></i> Search</button>
</strong></center>
</form>
<div class="content" id="content">
<?php

$fromdate= date("d/m/Y");
$todate= date("d/m/Y");
$fromdate=$_GET['d1'];
$todate = $_GET['d2'];

// if ($fromdate=='');
// {
	// $fromdate= date("d/m/Y"); 
// } 
// if ($todate=='');
// {
	// $todate= date("d/m/Y"); 
// } 

//echo date_format(date_create($_GET['d1']),'d/m/Y'); 



?>

 
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
Sales Report from&nbsp;<?php echo $fromdate; ?>&nbsp;to&nbsp;<?php echo $todate;    ?>
</div>
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
		 <th hidden  width="13%"> Transaction ID </th>
			<th  width="16%"> <font color="white"> Invoice Number</font> </th>
			<th width="13%"> <font color="white">Sale Date </font></th>
			<th width="20%"> <font color="white">Customer Name</font> </th> 
			<th width="18%"> <font color="white">Amount </font></th>
			<th width="13%"> <font color="white">Profit </font></th>
			<th width="3%"> <font color="white">View/Print</font> </th>
			<th width="13%"> <font color="white">Cancel </font> </th> 
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$LocationCode = $_SESSION['SESS_LOCATION']; 
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$result = $db->prepare("SELECT transaction_id,invoice_number,DATE_FORMAT(saledate, '%d/%m/%Y') as saledate ,name,amount,profit FROM sales WHERE cancelledstatus=0 and locationcode ='$LocationCode' and saledate BETWEEN :a AND :b ORDER by transaction_id  ");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td  id ='tblTransactionID'  hidden><?php echo $row['transaction_id']; ?></td>
			<td  id ='tblInvoiceNo'><?php echo $row['invoice_number']; ?></td>
			<td id ='tblInvoiceDate'><?php echo $row['saledate']; ?></td>
			<td  id ='tblCustomerName'><?php echo $row['name']; ?></td>
			
			
			<td style="text-align:right;" id ='tblAmount'><?php
			$dsdsd=$row['amount'];
			echo formatMoney($dsdsd, true);
			?></td>
			<td style="text-align:right;"><?php
			$zxc=$row['profit'];
			echo formatMoney($zxc, true);
			?></td>
			<td><button  style="float:left;" class="btn btn-info btn-mini"><a href="preview.php?invoice=<?php echo $row['invoice_number']; ?>"> View</button></a></td>
			
			<td  onclick='GetComments(this);' > 
			
		  <button type="button" class="btn btn-danger btn-mini" data-toggle="modal" data-target="#myModal">Invoice Cancel</button>  
		 
			
		
			
			</td>
			</tr>
			<?php
				}
			?>
		
	</tbody>
	<thead>
		<tr>
			<th colspan="3" style="border-top:1px solid #999999"> Total: </th>
			<th style="text-align:right;" colspan="1" style="border-top:1px solid #999999"> 
			<?php
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
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$results = $db->prepare("SELECT sum(amount) FROM sales  WHERE cancelledstatus=0 and locationcode ='$LocationCode' and  saledate BETWEEN :a AND :b");
				$results->bindParam(':a', $d1);
				$results->bindParam(':b', $d2);
				$results->execute();
				for($i=0; $rows = $results->fetch(); $i++){
				$dsdsd=$rows['sum(amount)'];
				echo formatMoney($dsdsd, true);
				}
				?>
			</th>
				<th style="text-align:right;" colspan="1" style="border-top:1px solid #999999">
			<?php 
				$resultia = $db->prepare("SELECT sum(profit) FROM sales  WHERE cancelledstatus=0 and locationcode ='$LocationCode' and saledate BETWEEN :c AND :d");
				$resultia->bindParam(':c', $d1);
				$resultia->bindParam(':d', $d2);
				$resultia->execute();
				for($i=0; $cxz = $resultia->fetch(); $i++){
				$zxc=$cxz['sum(profit)'];
				echo formatMoney($zxc, true);
				}
				?>
		
				</th>
				<th>
				</th><th>
				</th>
				
		</tr>
	</thead>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>

	

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Invoice Cancellation</h4>
      </div>
      <div class="modal-body">
	   <b>
                      Invoice Number: <span id="spnInvoice"></span>
                   
					  <br>
					   Invoice Date: <span id="spnInvoiceDate"></span>
                   
					  <br>
					   Customer: <span id="spnCustomer"></span>
                   
					  <br>
					   Amount: <span id="spnInvoiceAmount"></span>
                   
					  <br>
					  <br>
					  <br>
					  
					  
        <label>Admin Password</label>
		 
		<input type='password' id='txtAdminPassword' name ='txtAdminPassword' style="width: 150px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;"  />
		<input type='hidden' id='txtSelectedRow' name ='txtSelectedRow' />
		<input type='hidden' id='txtSelectedID' name ='txtSelectedID' />
		 <button type="button" class="btn btn-danger" onclick='CancellBill();'  data-dismiss="modal">Cancel Invoice</button>
      </div>
	   
      <div class="modal-footer">
        <button type	="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
<div class="clearfix"></div>
</div>
</div>
                            

</body>
<script>
	function GetComments(x)
	{
		// alert(1);
		  document.getElementById("txtSelectedRow").value = x.parentNode.rowIndex;
		  var row = document.getElementById("txtSelectedRow").value; 
		  // alert(2);
		    document.getElementById("txtSelectedID").value = document.getElementById("resultTable").rows[row].cells.namedItem("tblTransactionID").innerHTML;
			// alert(document.getElementById("txtSelectedID").value);
			document.getElementById("spnInvoice").textContent=document.getElementById("resultTable").rows[row].cells.namedItem("tblInvoiceNo").innerHTML;
			
			document.getElementById("spnInvoiceDate").textContent=document.getElementById("resultTable").rows[row].cells.namedItem("tblInvoiceDate").innerHTML;
			
			document.getElementById("spnCustomer").textContent=document.getElementById("resultTable").rows[row].cells.namedItem("tblCustomerName").innerHTML;
			
			document.getElementById("spnInvoiceAmount").textContent=document.getElementById("resultTable").rows[row].cells.namedItem("tblAmount").innerHTML;
			document.getElementById("txtAdminPassword").value='';
			
	}
	
     function CancellBill()
								{
							 
							   var SelectedID = document.getElementById("txtSelectedID").value;
							   var password = document.getElementById("txtAdminPassword").value;
                          	   
                          	                      
                                  var datas = "&SelectedID="+SelectedID+"&password="+password;
                                 //alert(datas);                               
								 $.ajax({
								 type: 'post',
								  url:"CancellBill.php",
								  data:datas,
								  success:function(response)
								  {
									  // alert(response);
									 if(response==1)
									 {
										 alert("Bill Cancelled Successfully");
									    location.reload() 
									 }
									 else
									 {
										 alert("Password Mismath, Contact your admin!!");
									 }
									 
									 
								  }
								 });
								 
								}
</script>
<script src="js/jquery.js"></script>
  <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this update? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deletesales.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<?php include('footer.php');?>
</html>