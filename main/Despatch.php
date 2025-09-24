<html>
<head>
<title>Checkout</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<script>
function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#country').addClass('load');
			$.post("autosuggestname.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#country').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		$('#country').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 600);
	}

</script>

<style>
#result {
	height:20px;
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
#country{
	border: 1px solid #999;
	background: #EEEEEE;
	padding: 5px 10px;
	box-shadow:0 1px 2px #ddd;
    -moz-box-shadow:0 1px 2px #ddd;
    -webkit-box-shadow:0 1px 2px #ddd;
}
.suggestionsBox {
	position: absolute;
	left: 10px;
	margin: 0;
	width: 268px;
	top: 40px;
	padding:0px;
	background-color: #000;
	color: #fff;
}
.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
ul {
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#FFF;
	padding:0;
	margin:0;
}

.load{
background-image:url(loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
}
.combopopup{
	padding:3px;
	width:268px;
	border:1px #CCC solid;
}
 
[type="date"] {
  background:#fff url(https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/calendar_2.png)  97% 50% no-repeat ;
  padding: 3px 50px;
    width: 150px;
    height: 190px;
	font-size:25px;
	 box-shadow: inset 0 3px 6px rgba(0,0,0,0.1);
}
[type="date"]::-webkit-inner-spin-button {
  display: none;
}
[type="date"]::-webkit-calendar-picker-indicator {
  opacity: 0;
}
 
</style> 
</head>
<body onLoad="document.getElementById('country').focus();">
<form action="SaveDespatch.php" method="post">
<div id="ac">
<center><h4><i class="icon icon-money icon-large"></i> Location</h4></center><hr>
<input type="hidden" name="date" value="<?php echo date("m/d/y"); ?>" />
<input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
<input type="hidden" id='totalamount' name="totalamount" value="<?php echo $_GET['total']; ?>" />
<input type="hidden" name="ptype" value="<?php echo $_GET['pt']; ?>" />
<input type="hidden" name="cashier" value="<?php echo $_GET['cashier']; ?>" />
<input type="hidden" name="profit" value="<?php echo $_GET['totalprof']; ?>" />
 
<table>
<tr>
<td>
Date  &nbsp;&nbsp;&nbsp;&nbsp; 
</td>
<td>
<input type='date' name ='dtTransferDate' id = 'dtTransferDate' required />
</td>
</tr>
<tr>
<td>
Location  &nbsp;&nbsp;&nbsp;&nbsp; 
</td>
<td>

<select name="Location" style="width:200px; "class="chzn-select" required>
 
	<?php
	session_start();
	include('../connect.php');
	$LocationCode = $_SESSION['SESS_LOCATION']; 
	$result = $db->prepare("SELECT * FROM locationmaster  WHERE locationcode <> '$LocationCode'");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['locationcode'];?>"><?php echo $row['locationname']; ?> </option>
	<?php
				}
			?>
</select>

 
</td>
</tr>
</table>


<center>
<input type="hidden" size="25" value="" name="cname" id="country" onkeyup="suggest(this.value);" onblur="fill();" class="" autocomplete="off" placeholder="Enter Customer Name" style="width: 268px; height:30px;" />
     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
      </div>
	  <fieldset style="left: -100px;">
  <script>
    function CashCard(x)
                                                 
                                                {
                                                	 // alert(x);
                                                	var CashCard = x;
                                                	////alert (DailyCondition);
                                                	if (CashCard =="Cash")
                                                	{
                                                		document.getElementById("txtCashCard").value= 'Cash';
														document.getElementById("cash").value= 0;
														document.getElementById("txtBalance").value= 0;
														document.getElementById("cash").focus();
                                                	}
                                                	else
                                                	{
                                                		document.getElementById("txtCashCard").value= 'Card';
                                          document.getElementById("cash").value= document.getElementById("totalamount").value;
                                          document.getElementById("txtBalance").value= 0;
                                                	}
                                                	 
                                                }
												
 function CalculateBalance()
{
var TotalAmount = document.getElementById("totalamount").value;
var ReceivedAmount = document.getElementById("cash").value;
var  BalanceAmount = ReceivedAmount - TotalAmount; 
document.getElementById("txtBalance").value = BalanceAmount;


 
}

function CheckTotal()
{
	var Balance = document.getElementById("txtBalance").value;
	 
	 if (Balance < 0 )
			{
               alert("Amount Mismatch");
               return false;
           }
           else
		   
		   {
			    return true;
               
           }
		   
}


  </script>
                                           <input type="hidden" name="txtCashCard" id="txtCashCard" value="Cash" />
                                          <input type="hidden" name="rdCashCard"  id="rdCash" value="Cash" checked onclick="CashCard(this.value);"/> 
                                        
                                          
                                          <input type="hidden" name="rdCashCard" id="rdCard" value="Card" onclick="CashCard(this.value);"/> 
										  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  
                                       
</fieldset>
<br>
<?php
$asas=$_GET['pt'];
if($asas=='credit') {
?>Due Date: <input type="hidden" name="due" placeholder="Due Date" style="width: 268px; height:30px; margin-bottom: 15px;" /><br>
<?php
}
if($asas=='cash') {
?>

<input type="hidden" name="cash" id='cash' placeholder="Amount" style="width: 268px; height:30px;  margin-bottom: 15px;"  required onkeyup="CalculateBalance();" /><br>
<input type="hidden" name="txtBalance" id="txtBalance" placeholder="Balance" style="width: 268px; height:30px;  margin-bottom: 15px;"  required readonly /><br>

<?php
}
?>


 <input class="btn btn-success btn-block btn-large" style="width:267px;"
 type="submit" name="sbmt" id="sbmt" value="Despatch"  onclick="return CheckTotal();"/>
   <center>
</div>
</form>
</body>
</html>