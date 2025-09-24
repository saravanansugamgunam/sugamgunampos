<html>
<html>
<head>
<title>
POS
</title>

<?php 
require_once('auth.php');
?>
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
<!--sa poip up-->
<script src="jeffartagame.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'src/loading.gif',
      closeImage   : 'src/closelabel.png'
    })
  })
</script>
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

 


 <script language="javascript" type="text/javascript">
 <!--Brought To You by code-projects.org-->
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

<body>
<?php include('navfixed.php');?>
<div class="container-fluid">
      <div class="row-fluid">
	
	<div class="contentheader">
			<i class="icon-table"></i> Day Summary Report
			</div>
			 

<div style="margin-top: 0px; margin-bottom: 21px;">
<a  href="index.php"><button class="btn btn-default btn-small" style="float: left;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
			  
			 <br>
			 <br>
			 
<form action="DaySummary.php" method="get">
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

function formatMoney($number, $fractional=false) {
					if ($fractional) {
						$number = sprintf('%.0f', $number);
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

?>

<script>
	
</script>
 
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
Summary Report from&nbsp;<?php echo $fromdate; ?>&nbsp;to&nbsp;<?php echo $todate;    ?>  
</div>  
 
		 <style>
                            #talkbubble {
                            width: 180px;
                            height: 80px;
                            position: relative;
                            -moz-border-radius: 5px;
                            -webkit-border-radius: 5px;
                            border-radius: 5px;
                            text-align: center;
                            vertical-align: middle;
                            padding: 1% 2%;
                            }
                            .rectangle {
                            height: 50px;
                            width: 100px;
                            background-color: #555;
                            }kground-color: #555;
                            }
                            .hidden{
                            visibility:hidden;
                            }
                          </style>
			<?php
				include('../connect.php');
				$LocationCode = $_SESSION['SESS_LOCATION']; 
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$result = $db->prepare("
				  
SELECT (
SELECT COUNT(*)  FROM sales WHERE cancelledstatus='0' AND locationcode='$LocationCode' AND saledate BETWEEN :a AND :b)  AS TotalBill,   
  
(SELECT SUM(amount) FROM sales WHERE cancelledstatus='0' AND 
locationcode='$LocationCode' AND saledate BETWEEN :a AND :b) AS TotalSaleAmount  ,   

(SELECT SUM(qty) FROM  `sales_order`   WHERE invoice IN (
SELECT invoice_number FROM sales WHERE cancelledstatus='0' AND locationcode='$LocationCode' AND  
saledate BETWEEN :a AND :b))  AS TotalSaleQty,

(SELECT SUM(qty) FROM products WHERE   purchasedate BETWEEN :a AND :b)  AS TotalPurchaseQty  ,

(SELECT SUM(qty*cost) FROM  products WHERE   purchasedate BETWEEN :a AND :b)  AS TotalPurchaseAmount ,

(SELECT SUM(qty) FROM  `transfer_order`   WHERE invoice IN (
SELECT invoice_number FROM stocktransferoutmaster WHERE  tolocation='$LocationCode' AND  saledate  BETWEEN :a AND :b)) AS TotalTransferQty");

 
				// SELECT DATE_FORMAT(purchaseentrydate, '%d/%m/%Y') AS PurchaseDate ,supplier,SUM(qty) AS PurchaseQty, SUM(qty*cost) AS TotalValue,purchaseentrydate FROM  products where   purchaseentrydate BETWEEN :a AND :b GROUP BY purchaseentrydate ,supplier ORDER BY purchaseentrydate
				
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->execute();
				 
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<center>
			 <table style="left:50px;">
			 <tr style=" height: 10px;" >
			 <td >
			 <div id="talkbubble" class="col-md-2" style="background: #f9e58d; left:40px;">
			 <br>
                    <b><p   style="font-size:30px"><?php echo formatMoney($row['TotalBill'], true);   ?> </p></b>
                   Bills
                  </div>
				  </td>
				  <td>&nbsp;&nbsp;&nbsp;&nbsp;
				  </td>
				  <td>
				  	<div id="talkbubble" class="col-md-2" style="background: #5fc1d7; left:40px;">
			<br>
                    <b><p   style="font-size:30px"><?php echo formatMoney($row['TotalSaleQty'], true);  ?> </p></b>
                   Sale Qty
                  </div>
			
				  </td>
				   <td>&nbsp;&nbsp;&nbsp;&nbsp;
				  </td>
				  <td>
		<div id="talkbubble" class="col-md-2" style="background: #7fbb80; left:40px;">
			<br>
                    <b><p   style="font-size:30px"><?php echo formatMoney($row['TotalSaleAmount'], true); ?> </p></b>
                   Sale Amount
                  </div>
				  </td>
				  <td>&nbsp;&nbsp;&nbsp;&nbsp;
				  </td>
				  </tr>
				  <td>
				  <br>
				  </td>
				  <tr>
				  <td>
				  
			<div id="talkbubble" class="col-md-2" style="background: #f4cbae; left:40px;">
			<br>
                    <b><p   style="font-size:30px"><?php echo formatMoney($row['TotalPurchaseQty'], true); ?> </p></b>
                   Purchase Qty
                  </div>
				  </td>
				  <td>&nbsp;&nbsp;&nbsp;&nbsp;
				  </td>
				  <td>
			<div id="talkbubble" class="col-md-2" style="background: #d79e63; left:40px;">
			<br>
                    <b><p   style="font-size:30px"><?php echo formatMoney($row['TotalPurchaseAmount'], true); ?> </p></b>
                   Purchase Value
                  </div>
				  </td>
				  <td>&nbsp;&nbsp;&nbsp;&nbsp;
				  </td>
				  <td>
			<div id="talkbubble" class="col-md-2" style="background: #b88fcd; left:40px;">
			<br>
                    <b><p   style="font-size:30px"><?php echo formatMoney($row['TotalTransferQty'], true);   ?> </p></b>
                   Transfer Qty
                  </div>
				  </td>
				  <td>&nbsp;&nbsp;&nbsp;&nbsp;
				  </td>
				  <td>
			 </tr>
				  </table>
				  </center>
			<?php 
				}
			?>
		
	 
<div class="clearfix"></div>
</div>

</div>

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
 if(confirm("Sure you want to delete this Product? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deleteproduct.php",
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
</body>
<?php include('footer.php');?>

</html>