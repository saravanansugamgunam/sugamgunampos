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

<script>
function sum() {
            var txtFirstNumberValue = document.getElementById('txt1').value;
            var txtSecondNumberValue = document.getElementById('txt2').value;
            var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt3').value = result;
				
            }
			
			 var txtFirstNumberValue = document.getElementById('txt11').value;
            var result = parseInt(txtFirstNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt22').value = result;				
            }
			
			 var txtFirstNumberValue = document.getElementById('txt11').value;
            var txtSecondNumberValue = document.getElementById('txt33').value;
            var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt55').value = result;
				
            }
			
			 var txtFirstNumberValue = document.getElementById('txt4').value;
			 var result = parseInt(txtFirstNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt5').value = result;
				}
			
        }
</script>


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
			<i class="icon-table"></i> Transfer IN
			</div>
			 

<div style="margin-top: 0px; margin-bottom: 21px;">
<a  href="index.php"><button class="btn btn-default btn-small" style="float: left;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
			  
			 <br>
			 <br>
			 
<form action="TransferIN.php" method="get">
<center><strong>From : <input type="date" style="width: 223px; height:35px; color:#222;" name="d1" class="stcal" value="" /> To: <input type="date" style="width: 223px; height:35px; color:#222;" name="d2" class="stcal" value="" />
 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit"><i class="icon icon-search icon-large"></i> Search</button>
</strong></center>
 
</form>
<div class="content" id="content">

 
<?php 
include('../connect.php');
$LocationCode = $_SESSION['SESS_LOCATION']; 
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
Transfers Between&nbsp;<?php echo $fromdate; ?>&nbsp;to&nbsp;<?php echo $todate;    ?>  
</div>

<input type="text" style="height:35px; color:#222;" name="filter" value="" id="filter" placeholder="Search..." autocomplete="off" />
 <br><br>
<table class="hoverTable" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
		 
			<th width="5%"> S. No </th>
			<th width="13%"> From Location </th>
			<th width="20%"> Transfer Number </th> 
			<th width="18%"> Transfer Date </th>
			<th width="13%"> Total Value </th>
			<th width="13%"> Status</th>
			<th width="5%"> View </th>
			<th width="13%"> Receive Stock </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$result = $db->prepare("SELECT locationname,invoice_number,DATE_FORMAT(saledate, '%d/%m/%Y') AS TransferDate,
    SUM(amount) AS Total,receiptstatus   FROM  `stocktransferoutmaster` AS a JOIN  
    locationmaster  AS b ON a.fromlocation =b.locationcode  
	where  a.fromlocation<>'$LocationCode' and  saledate BETWEEN :a AND :b
	GROUP BY locationname,invoice_number,saledate ORDER BY saledate ");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->execute();
				$Sno = 1;
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td style="text-align:right;"><?php echo $Sno; ?></td>
			<td><?php echo $row['locationname']; ?></td>
			<td><?php echo $row['invoice_number']; ?></td>
			<td><?php echo $row['TransferDate']; ?></td>  
			 
			<td style="text-align:right;"><?php
			$dsdsd=$row['Total'];
			echo formatMoney($dsdsd, true);
			?></td>
			<?php 
			if ($row['receiptstatus']=='Not Received')
			{	
			echo  "<td  style='background-color:#f88379'> Not Received</td>";
			}
			else
			{
			echo  "<td  style='background-color:#8ec38e'> Received</td>";
			}
			?>
			
			 
			<td style="text-align:right;"><button  style="float:left;" class="btn btn-info btn-mini">
			<a href="TransferOutView.php?invoice=<?php echo $row['invoice_number']; ?>">  View</button></a></td>
			
			<?php 
			if ($row['receiptstatus']=='Not Received')
			{	
			echo  "<td style='text-align:right;'>"; 
			?>
			
			<button  style='float:left;' class='btn btn-success btn-mini'>
			<a href='SaveTransferIN.php?invoice=<?php echo $row['invoice_number']; ?>'>  Receive</button></a>
			
			<?php echo "</td>";
			}
			else
			{
			echo  "<td style='text-align:right;'>"; 
			?>
			
			<button disabled style='float:left;' class='btn btn-success btn-mini'>
			  Receive</button> 
			
			<?php echo "</td>";
			}
			?>
			
			
			
			
			</tr>
			
			<?php
			$Sno=$Sno+1;
				}
			?>
		
	</tbody>
	<thead>
		<tr>
			<th colspan="4" style="border-top:1px solid #999999"> Total: </th>
			 
				<th colspan="1" style="border-top:1px solid #999999; text-align:right;"  >
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
				
				$resultia = $db->prepare("SELECT SUM(amount) AS TotalValue FROM  `stocktransferoutmaster` where fromlocation<>'$LocationCode' and saledate BETWEEN :c AND :d");
				$resultia->bindParam(':c', $d1);
				$resultia->bindParam(':d', $d2);
				$resultia->execute();
				for($i=0; $cxz = $resultia->fetch(); $i++){
				$zxc=$cxz['TotalValue'];
				echo formatMoney($zxc, true);
				}
				?>
		
				</th>
				<th>
				</th>
				 <th>
				</th> <th>
				</th>
				
		</tr>
	</thead>
</table>
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