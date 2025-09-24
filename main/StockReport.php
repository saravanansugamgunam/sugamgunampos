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
			<i class="icon-table"></i> Stock Report
			</div>
			 

<?php 
			include('../connect.php');
			$LocationCode = $_SESSION['SESS_LOCATION']; 
			$Type=$_GET['t1'];
			if($Type=='0')
			{
				$result = $db->prepare("SELECT * FROM stock  AS a JOIN  locationmaster  AS b ON a.locationcode =b.locationcode where a.locationcode ='$LocationCode'  ");
			}
			else
			{
				$result = $db->prepare("SELECT * FROM stock  AS a JOIN  locationmaster  AS b ON a.locationcode =b.locationcode where a.locationcode ='$LocationCode' and currentstock < 10 ");
			}
			
				
				$result->execute();
				$rowcount = $result->rowcount();
			?>
			
			<?php 
			include('../connect.php');
			 
				$result = $db->prepare("SELECT * FROM stock  AS a JOIN  locationmaster  AS b ON a.locationcode =b.locationcode where currentstock < 10   and a.locationcode ='$LocationCode' ");
				$result->execute();
				$rowcount123 = $result->rowcount();

			?>
			
<div style="margin-top: 0px; margin-bottom: 21px;">
<a  href="index.php"><button class="btn btn-default btn-small" style="float: left;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
			 
			 <form>
			 <div style="text-align:center;">
			Total Number of Products:  <font color="green" style="font:bold 22px 'Aleo';">[<?php echo $rowcount;?>]</font>
			</div>
			
			<div style="text-align:center;">
			<font style="color:rgb(255, 95, 66);  font:bold 22px 'Aleo';">[<?php echo $rowcount123;?>]</font> Products are below QTY of 10 
			<br>
			<button type='submit' class="btn btn-danger btn-small" onclick="ViewBelow10();"> View < 10 </button>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<button type='submit' class="btn btn-success btn-small" onclick="ViewAll();"> View All </button>
			<script>
			function ViewBelow10()
			{
			document.getElementById("t1").value = 1;
			}
			function ViewAll()
			{
			document.getElementById("t1").value = 0;
			}
			
			</script>
			<input type='hidden' id='t1' name ='t1' value ='0' /> 
			</div>
			</form>
			<br>
<input type="text" style="height:35px; color:#222;" name="filter" value="" id="filter" placeholder="Search Product..." autocomplete="off" />
<br>


<table class="hoverTable" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th hidden > Product ID </th>
			<th  > S. No </th>
			<th  > Location </th>
			<th > Short Code </th>
			<th  > Product Name </th>
			<th > Category </th>
			<th > MRP </th>
			<th > Purchase Qty </th>
			<th > Transfer IN </th>
			<th > Transfer OUT </th>
			<th > Sales Qty </th>
			<th > Current Stock </th>
			
		 
			 
		</tr>
	</thead>
	<tbody>
		
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
				include('../connect.php');
				$Type=$_GET['t1'];
			if($Type=='0')
			{
				$result = $db->prepare(" SELECT a.productid,a.productshortcode,a.category,a.productname,
 a.price,b.purchaseqty,b.salesqty,b.currentstock,b.transferout,b.transferin,c.locationname FROM productmaster AS a JOIN stock AS b ON a.productid=b.productid   JOIN  locationmaster  AS c ON b.locationcode =c.locationcode  where b.locationcode ='$LocationCode'  ");
			}
			else
			{
			$result = $db->prepare(" SELECT a.productid,a.productshortcode,a.category,a.productname,
 a.price,b.purchaseqty,b.salesqty,b.currentstock,b.transferout,b.transferin,c.locationname FROM productmaster AS a JOIN stock AS b ON a.productid=b.productid   JOIN  locationmaster  AS c ON b.locationcode =c.locationcode  where b.locationcode ='$LocationCode' and b.currentstock < 10 ");
			}
			
				$result->execute();
				$sno=1;
				for($i=0; $row = $result->fetch(); $i++){
				 
				echo '<tr class="record">';
				 
			?>
		

			<td hidden><?php echo $row['productid']; ?></td>
			<td><?php echo $sno; ?></td>
			<td><?php echo $row['locationname']; ?></td>
			<td><?php echo $row['productshortcode']; ?></td>
			<td><?php echo $row['productname']; ?></td>
			<td><?php echo $row['category']; ?></td>
			<td style="text-align:right;"><?php echo $row['price']; ?></td>
			<td style="text-align:right;"><?php echo $row['purchaseqty']; ?></td>
			<td style="text-align:right;"><?php echo $row['transferin']; ?></td>
			<td style="text-align:right;"><?php echo $row['transferout']; ?></td>
			<td style="text-align:right;"><?php echo $row['salesqty']; ?></td>
			<td style="text-align:right;"><?php echo $row['currentstock']; ?></td>
					 
			</tr>
			<?php
			$sno=$sno+1;
				}
			?>
		
		
		
	</tbody>
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