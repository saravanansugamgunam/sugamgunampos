<html>
<?php
	require_once('auth.php');
  
?>
<head>
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

// function CalculateProfit()
// {
// var CostPrice = document.getElementById("txtCostPrice").value;
// var SellingPrice = document.getElementById("txtMRP").value;
// var  Profit = SellingPrice - CostPrice; 
// document.getElementById("txtProfit").value = Profit;
 
// }

function CalculateTotal()
{
var TotalQty = document.getElementById("txtReceiptQty").value;
var CostPrice = document.getElementById("txtCostPrice").value;
var  TotalAmount = TotalQty * CostPrice; 
document.getElementById("txtTotalAmount").value = TotalAmount;
 
}



function FillData(val){
 document.getElementById('txtMRP').value = document.getElementById('txtProductId').value;
  
}

</SCRIPT>
</head>
<body>
<form action="saveproduct.php" method="post">
<center><h4><i class="icon-plus-sign icon-large"></i> Add Product</h4></center>
<hr>
<div id="ac">
<span>Item Name : </span>
<select name="txtProductId"  id="txtProductId" style="width:265; "class="chzn-select" onchange ='FillData(this.value);' required>
<option></option>
	<?php
	include('../connect.php');
	$result = $db->prepare("SELECT * FROM productmaster WHERE STATUS ='Active' ORDER BY productshortcode ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['productid'];?>"><?php echo $row['productshortcode']; ?> - <?php echo $row['category']; ?> - <?php echo $row['productname'];   ?></option>
	<?php
				}
			?>
</select>


<span>Date of Receipt: </span><input type="date" style="width:265px; height:30px;" placeholder="09/13/2017" class="tcal tcalInput"  name="date_arrival" id="date_arrival" Required></input><br>
 <span>Supplier : </span>
<select name="txtSupplier"  id="txtSupplier" style="width:265px; height:30px; margin-left:-5px;" Required >
<option></option>
	<?php
	include('../connect.php');
	$result = $db->prepare("SELECT * FROM supliers");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option><?php echo $row['suplier_name']; ?></option>
	<?php
	}
	?>
</select><br>
<span>Cost Price : </span><input type="text" id="txtCostPrice" style="width:265px; height:30px;" name="txtCostPrice" onkeyup="CalculateTotal();" Required><br> 

<span>Receipt Qty : </span><input type="number" style="width:265px; height:30px;" min="0" id="txtReceiptQty" onkeyup="CalculateTotal;" name="txtReceiptQty" Required ><br>
<span>Total Amount : </span><input type="number" style="width:265px; height:30px;" min="0" id="txtTotalAmount" onkeyup="CalculateTotal();" name="txtTotalAmount" Required readonly ><br>
  

<div style="display:none;"> 

  
<span>Item Code : </span><input type="text" style="width:265px; height:30px;" value="PE-<?php 
$prefix= md5(time()*rand(1, 2)); echo strip_tags(substr($prefix ,0,4));?>" name="txtPurchaseCode" Readonly Required ><br>
 
<span>Expiry Date : </span><input type="date" style="width:265px; height:30px;" placeholder="09/13/2017" class="tcal tcalInput" name="exdate" ></input><br>
</div>


<div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button>
</div>
</div>


</form>
</body>
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
 
</html>
