     <?php
// Start the buffering //
ob_start();
   
    include("../../connect.php");
   
	 session_cache_limiter(FALSE);
    session_start();
	 $position = $_SESSION["SESS_LAST_NAME"]; 
   $LocationCode = $_SESSION['SESS_LOCATION'];
   ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <title>Estimate</title>
    </head>
    <body>
	
	<style>
body	{
    font-size: 11px;
    font-family: Verdana, sans-serif;
}

td,
th,
tr,
table {
  
	width:90%;
}


th {
  border-top: 1px solid black;
  
    
}



td.description,
th.description {
    width: 20%;
	 word-break: nowrap;
}

td.quantity,
th.quantity {
    width: 10%;
     
	text-align: right;
}

td.price,
th.price {
   width: 50%;
    word-break: break-all;
	text-align: right;
}

table.billdetails 
{
 
    border-collapse: collapse;
	width:90%;
}



td.billdetailsleft,
th.billdetailsleft{
   border-bottom: 1px solid white;
   width: 20px;
    max-width: 20px;
    word-break: nowrap;
	text-align: left;
	 
}

td.billdetailsright,
th.billdetailsright{
   border-bottom: 1px solid white;
   width: 20px;
    max-width: 20px;
    word-break: nowrap;
	text-align: right;
	 
}


td.sno,
th.sno {
width: 10%;
    word-break: break-all;
	text-align: right;
}

.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 300px;
    max-width: 300px;
}

img {
    max-width: inherit;
    width: inherit;
}

@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
	</style>
	
	<?php 
	$Invoice=$_GET['invoice'];
 

	  $res = $connection->query("  
      SELECT c.`paitentname`, address1,
      address2,a.city,state,a.pincode,c.`mobileno` FROM courierdetails AS a JOIN salemaster AS b ON a.`invoicenumber`=b.`saleuniqueno`
      
      JOIN paitentmaster AS c ON b.`paitientcode`=c.`paitentid` WHERE invoicenumber='$Invoice'"); 
	   
	    
   
while($data = mysqli_fetch_row($res))
{

$PaitentName=$data[0];
$Address1=$data[1];
$Address2=$data[2]; 
$City=$data[3];  
$State=$data[4]; 
$Pincode=$data[5];  
$Mobile=$data[6];  
 }

?>
        <div class="ticket"> 	


        <h5>
            <b>
                FROM, <br> 
        SUGAMGUNAM TRADITIONAL HEALTH CENTER</b><br> 
        AP 393,17TH STREET, <br> 
        THIRUVALLUVAR KUDIYIRIPPU, <br> 
        I Block, Anna Nagar, Tamil Nadu 600040<br> 
        Ph: 9176606308
</h5>

<br><br>

<h5>
            <b>
               
 <?php echo 'TO,'; 
 echo '<br>'; 
 echo $PaitentName; echo '<br>';
echo $Address1 ;
echo '<br>';
echo $Address2; 
echo '<br>';
echo $City; echo ','; echo $State; 
echo '<br>';
echo $Pincode;
echo '<br>';
echo "Ph: ";  
echo $Mobile;
?>
</h5>

 
        </div>
        <button id="btnPrint" class="hidden-print">Print</button>
        <script src="script.js"></script>
		
		<script>
		const $btnPrint = document.querySelector("#btnPrint");
$btnPrint.addEventListener("click", () => {
    window.print();
});
		</script>
    </body>
</html>