  <?php 
  include("../../connect.php");
    
	 session_cache_limiter(FALSE);
    session_start();
	   $LocationCode = $_SESSION['SESS_LOCATION'];
	 ?>
	 
  <link href="../../assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="../../assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
    <link href="../../assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
    <link href="../../assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="../../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="../../assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
    <link href="../../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="../../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
		<link href="../../assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
		<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>
<style>
table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 40%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 2px 2px;
    text-align: center;
}
table.blueTable tbody td {
  font-size: 13px;
   text-align: center;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #83b3e4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 1px solid #444444;
}
table.blueTable thead th {
  font-size: 14px;
  font-weight: normal;
  color: #FFFFFF;
  border-left: 1px solid #D0E4F5;
   padding: 5px 20px;
  
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
}
table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
</style>
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
	
?>

<?php 
   
	 
	    $Type = mysqli_real_escape_string($connection, $_POST["Type"]);
	    $QFilter = mysqli_real_escape_string($connection, $_POST["QFilter"]);
	    $ReportLocationCode = mysqli_real_escape_string($connection, $_POST["LocationCode"]);
	    $ExcludedStatus = mysqli_real_escape_string($connection, $_POST["ExcludedStatus"]); 
		if($QFilter=='All')
		{
			$StockFilter = " and a.currentstock like '%' ";
		}
		else
		{
			$StockFilter = " and  (a.currentstock) <10  ";
		}
		
		if($ExcludedStatus=='Yes')
		{
			$ExcludedZero = " and  (a.currentstock) >0  ";
		}
		else
		{
			
			$ExcludedZero = " and a.currentstock like '%' ";
		}
		
		if($ReportLocationCode=='0')
		{
			 
		
	   
	   
	    $TotalStock = mysqli_query($connection, "  
SELECT COUNT(DISTINCT productcode) AS Product, SUM(currentstock) AS Stock,round(SUM(currentstock*rate),0) AS Cost,round(SUM(currentstock*mrp),0) AS MRP  
FROM stockdetails_".$LocationCode." as a where locationcode='$LocationCode' $StockFilter $ExcludedZero ");
 
 //<table id='tblProject' class='tblMasters'>";
 
  echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;' class='blueTable' >";
echo " <thead> 
<tr>  
		     
		<th width='%'> Total Items</th>        
		<th width='%'> Total Qty</th>        
		<th width='%'> Total Cost </th>        
		<th width='%'> Total MRP  </th>           
		 </tr>
  </thead> <tbody>";
 
while($data = mysqli_fetch_row($TotalStock))
{
  echo "
  <tr>    
   <td width='%'>"; echo formatMoney($data[0], false); echo "</td>
   <td width='%'>"; echo formatMoney($data[1], false); echo "</td>
   <td width='%'>"; echo formatMoney($data[2], false); echo "</td>
   <td width='%'>"; echo formatMoney($data[3], false); echo "</td>
  
  </tr>";
   
   
}

echo "</tbody></table>";

  echo " <input type='text' name='myInput' id='myInput' class='form-control'  placeholder='Search...'  />";
	   
	   if($Type=='Detail')
	   
	   {
		 
		   			

  
								$result = mysqli_query($connection, "  

SELECT a.stockitemid,c.locationname, b.productshortcode,b.category,b.productname,a.batchno,a.expirydate AS expiry,a.mrp ,
a.purchaseqty,a.purchasereturn,a.salesqty,transferin,a.transferout,a.stockadjadd,a.stockadjminus,a.salereturn,a.currentstock
FROM stockdetails_".$LocationCode." AS a JOIN productmaster AS b ON a.productcode=b.productid JOIN locationmaster AS c
ON a.locationcode=c.locationcode where a.locationcode='$LocationCode' $StockFilter $ExcludedZero order by a.currentstock");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblStock'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' 
  width='90%'>";
echo " <thead> 
<tr>  
		<th  width='%'>S.No</th>     
		<th hidden width='%'>Itemid</th>     
		<th hidden width='%'> Location </th>    	
		<th width='%'> SC</th>    
		<th width='%'> Category </th>    
		<th width='%'>  Product </th>        
		<th width='%'>  Batch </th>        
		<th width='%'>  Exp.Dt </th> 
		<th width='%'> MRP </th>        		
    <th width='%'> Pur.Qty </th> 
    <th width='%'> P.Ret.Qty </th>        
		<th width='%'> Sale.Qty </th>        
		<th width='%'> Tr.IN </th>        
		<th width='%'> Tr.OUT </th>        
		<th width='%'> Adj+ </th>        
		<th width='%'> Adj- </th>        
		<th width='%'> Salereturn </th>        
		<th width='%'> Cr.Stock  </th>     
		<th hidden width='%'> Adj  </th>     
		 </tr>
  </thead> <tbody id='myTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden width='%'>$data[0]</td>
  <td hidden width='%'>$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>     
   <td width='%'>$data[6]</td>     
   <td width='%'>$data[7]</td>     
   <td width='%'>$data[8]</td>     
   <td width='%'>$data[9]</td>   
   <td width='%'>$data[10]</td>   
   <td width='%'>$data[11]</td>   
   <td width='%'>$data[12]</td>   
   <td width='%'>$data[13]</td>   
   <td width='%'>$data[14]</td>   
   <td width='%'>$data[15]</td>   
   <td width='%'>$data[16]</td>  
  <td hidden align='center' style='color:#009ad9;' onclick='GetRowID(this);' >
    <button  class='btn btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#myModalCancel' >Cancel</button></td>
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
else
	
	{
	 

		$result = mysqli_query($connection, "  

SELECT c.locationname, b.productshortcode,b.category,b.productname,a.mrp ,
SUM(a.purchaseqty) AS purchaseqty,sum(a.purchasereturn) as purchasereturnqty,SUM(a.salesqty) AS salesqty,SUM(transferin) AS transferin,
SUM(a.transferout) AS transferout,sum(a.stockadjadd) as stockadjadd,sum(a.stockadjminus) as stockadjminus,
sum(a.salereturn) as Salereturn, SUM(a.currentstock) AS currentstock
FROM stockdetails_".$LocationCode." AS a JOIN productmaster AS b ON a.productcode=b.productid JOIN locationmaster AS c
ON a.locationcode=c.locationcode where a.locationcode='$LocationCode' $StockFilter $ExcludedZero 
GROUP BY c.locationname, b.productshortcode,b.category,b.productname,a.mrp order by sum(a.currentstock) ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblStock'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='90%'>";
echo " <thead> 
<tr>  
		<th  width='%'>S.No</th>     
		<th hidden width='%'> Location </th>    	
		<th width='%'> SC</th>    
		<th width='%'> Category </th>    
		<th width='%'>  Product </th>    
		<th width='%'> MRP </th>        		
    <th width='%'> Pur.Qty </th>        
    <th width='%'> P.Ret.Qty </th> 
		<th width='%'> Sale.Qty </th>        
		<th width='%'> Tr.IN </th>        
		<th width='%'> Tr.OUT </th>
<th width='%'> Adj+ </th>        
		<th width='%'> Adj- </th>          
		<th width='%'> Salereturn </th>          
		<th width='%'> Cr.Stock  </th>     
		 </tr>
  </thead> <tbody id='myTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden width='%'>$data[0]</td>
  <td width='%'>$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>     
   <td width='%'>$data[6]</td>     
   <td width='%'>$data[7]</td>     
   <td width='%'>$data[8]</td>     
   <td width='%'>$data[9]</td>     
   <td width='%'>$data[10]</td>     
   <td width='%'>$data[11]</td>     
   <td width='%'>$data[12]</td>     
   <td width='%'>$data[13]</td>   
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
	}
								?>
								
                            </div>
							
							
							
							
							<div style="display:none;">
							<div class="table-responsive" id='DivPrint' >
							<label> <h4>Stock Report - <?php echo "As on " . date("d/m/Y") ;?></h4></label>
							
                                <?php 
								$result = mysqli_query($connection, "  

SELECT c.locationname, b.productshortcode,b.category,b.productname,a.batchno,a.expirydate AS expiry,a.mrp ,
a.purchaseqty,a.purchasereturn,a.salesqty,transferin,a.transferout,a.stockadjadd,a.stockadjminus,a.salereturn,a.currentstock
FROM stockdetails_".$LocationCode." AS a JOIN productmaster AS b ON a.productcode=b.productid JOIN locationmaster AS c
ON a.locationcode=c.locationcode where a.locationcode='$LocationCode' ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='PrintTable'  border='1' style='border-collapse:collapse;' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th  width='%'> Location </th>    	
		<th width='%'> Shortcode</th>    
		<th width='%'> Category </th>    
		<th width='%'>  Product </th>        
		<th width='%'>  Batch No </th>        
		<th width='%'>  Expiry Date </th> 
		<th width='%'> MRP </th>        		
		<th width='%'> Purchase Qty </th>        
		<th width='%'> Purchase Return </th>        
		<th width='%'> Sale Qty </th>        
		<th width='%'> Transfer IN </th>        
		<th width='%'> Transfer OUT </th>  
<th width='%'> Adj+ </th>        
		<th width='%'> Adj- </th>  		
		<th width='%'> Salereturn </th>  		
		<th width='%'> Current Stock  </th>     
		 
		</tr> </thead> <tbody>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td width='%'>$data[0]</td>
  <td width='%'>$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>     
   <td width='%'>$data[6]</td>     
   <td width='%'>$data[7]</td>     
   <td width='%'>$data[8]</td>     
   <td width='%'>$data[9]</td>   
   <td width='%'>$data[10]</td>   
   <td width='%'>$data[11]</td>   
   <td width='%'>$data[12]</td>   
   <td width='%'>$data[13]</td>   
   <td width='%'>$data[14]</td>   
   <td width='%'>$data[15]</td>   
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}

//xxxxxxxxxxxxxxxxxxxxxxxxxxx

		else
		{ 
			
	    $TotalStock = mysqli_query($connection, "  
SELECT COUNT(DISTINCT productcode) AS Product, SUM(currentstock) AS Stock,round(SUM(currentstock*rate),0) AS Cost,round(SUM(currentstock*mrp),0) AS MRP  
FROM stockdetails_".$LocationCode." as a where locationcode like('%') $StockFilter $ExcludedZero ");
 
 //<table id='tblProject' class='tblMasters'>";
 
  echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;' class='blueTable' >";
echo " <thead> 
<tr>  
		     
		<th width='%'> Total Items</th>        
		<th width='%'> Total Qty</th>        
		<th width='%'> Total Cost </th>        
		<th width='%'> Total MRP  </th>           
		 </tr>
  </thead> <tbody>";
 
while($data = mysqli_fetch_row($TotalStock))
{
  echo "
  <tr>    
   <td width='%'>"; echo formatMoney($data[0], false); echo "</td>
   <td width='%'>"; echo formatMoney($data[1], false); echo "</td>
   <td width='%'>"; echo formatMoney($data[2], false); echo "</td>
   <td width='%'>"; echo formatMoney($data[3], false); echo "</td>
  
  </tr>";
   
   
}

echo "</tbody></table>";

  echo " <input type='text' name='myInput' id='myInput' class='form-control'  placeholder='Search...'  />";
	   
	   if($Type=='Detail')
	   
	   {
		 
		   			

  
								$result = mysqli_query($connection, "  

SELECT a.stockitemid,c.locationname, b.productshortcode,b.category,b.productname,a.batchno,a.expirydate AS expiry,a.mrp ,
a.purchaseqty,a.purchasereturn,a.salesqty,transferin,a.transferout,a.stockadjadd,a.stockadjminus,a.salereturn,a.currentstock
FROM stockdetails_".$LocationCode." AS a JOIN productmaster AS b ON a.productcode=b.productid JOIN locationmaster AS c
ON a.locationcode=c.locationcode where a.locationcode='$LocationCode' $StockFilter $ExcludedZero order by a.currentstock");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblStock'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' 
  width='90%'>";
echo " <thead> 
<tr>  
		<th  width='%'>S.No</th>     
		<th hidden width='%'>Itemid</th>     
		<th hidden width='%'> Location </th>    	
		<th width='%'> SC</th>    
		<th width='%'> Category </th>    
		<th width='%'>  Product </th>        
		<th width='%'>  Batch </th>        
		<th width='%'>  Exp.Dt </th> 
		<th width='%'> MRP </th>        		
    <th width='%'> Pur.Qty </th> 
    <th width='%'> P.Ret.Qty </th>        
		<th width='%'> Sale.Qty </th>        
		<th width='%'> Tr.IN </th>        
		<th width='%'> Tr.OUT </th>        
		<th width='%'> Adj+ </th>        
		<th width='%'> Adj- </th>        
		<th width='%'> Salereturn </th>        
		<th width='%'> Cr.Stock  </th>     
		<th hidden width='%'> Adj  </th>     
		 </tr>
  </thead> <tbody id='myTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden width='%'>$data[0]</td>
  <td hidden width='%'>$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>     
   <td width='%'>$data[6]</td>     
   <td width='%'>$data[7]</td>     
   <td width='%'>$data[8]</td>     
   <td width='%'>$data[9]</td>   
   <td width='%'>$data[10]</td>   
   <td width='%'>$data[11]</td>   
   <td width='%'>$data[12]</td>   
   <td width='%'>$data[13]</td>   
   <td width='%'>$data[14]</td>   
   <td width='%'>$data[15]</td>   
   <td width='%'>$data[16]</td>  
  <td hidden align='center' style='color:#009ad9;' onclick='GetRowID(this);' >
    <button  class='btn btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#myModalCancel' >Cancel</button></td>
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
else
	
	{
	 

		$result = mysqli_query($connection, "  

SELECT c.locationname, b.productshortcode,b.category,b.productname,a.mrp ,
SUM(a.purchaseqty) AS purchaseqty,sum(a.purchasereturn) as purchasereturnqty,SUM(a.salesqty) AS salesqty,SUM(transferin) AS transferin,
SUM(a.transferout) AS transferout,sum(a.stockadjadd) as stockadjadd,sum(a.stockadjminus) as stockadjminus,
sum(a.salereturn) as Salereturn, SUM(a.currentstock) AS currentstock
FROM stockdetails_".$LocationCode." AS a JOIN productmaster AS b ON a.productcode=b.productid JOIN locationmaster AS c
ON a.locationcode=c.locationcode where a.locationcode='$LocationCode' $StockFilter $ExcludedZero 
GROUP BY c.locationname, b.productshortcode,b.category,b.productname,a.mrp order by sum(a.currentstock) ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblStock'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='90%'>";
echo " <thead> 
<tr>  
		<th  width='%'>S.No</th>     
		<th hidden width='%'> Location </th>    	
		<th width='%'> SC</th>    
		<th width='%'> Category </th>    
		<th width='%'>  Product </th>    
		<th width='%'> MRP </th>        		
    <th width='%'> Pur.Qty </th>        
    <th width='%'> P.Ret.Qty </th> 
		<th width='%'> Sale.Qty </th>        
		<th width='%'> Tr.IN </th>        
		<th width='%'> Tr.OUT </th>
<th width='%'> Adj+ </th>        
		<th width='%'> Adj- </th>          
		<th width='%'> Salereturn </th>          
		<th width='%'> Cr.Stock  </th>     
		 </tr>
  </thead> <tbody id='myTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden width='%'>$data[0]</td>
  <td width='%'>$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>     
   <td width='%'>$data[6]</td>     
   <td width='%'>$data[7]</td>     
   <td width='%'>$data[8]</td>     
   <td width='%'>$data[9]</td>     
   <td width='%'>$data[10]</td>     
   <td width='%'>$data[11]</td>     
   <td width='%'>$data[12]</td>     
   <td width='%'>$data[13]</td>   
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
	}
								?>
								
                            </div>
							
							
							
							
							<div style="display:none;">
							<div class="table-responsive" id='DivPrint' >
							<label> <h4>Stock Report - <?php echo "As on " . date("d/m/Y") ;?></h4></label>
							
                                <?php 
								$result = mysqli_query($connection, "  

SELECT c.locationname, b.productshortcode,b.category,b.productname,a.batchno,a.expirydate AS expiry,a.mrp ,
a.purchaseqty,a.purchasereturn,a.salesqty,transferin,a.transferout,a.stockadjadd,a.stockadjminus,a.salereturn,a.currentstock
FROM stockdetails_".$LocationCode." AS a JOIN productmaster AS b ON a.productcode=b.productid JOIN locationmaster AS c
ON a.locationcode=c.locationcode where a.locationcode='$LocationCode' ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='PrintTable'  border='1' style='border-collapse:collapse;' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th  width='%'> Location </th>    	
		<th width='%'> Shortcode</th>    
		<th width='%'> Category </th>    
		<th width='%'>  Product </th>        
		<th width='%'>  Batch No </th>        
		<th width='%'>  Expiry Date </th> 
		<th width='%'> MRP </th>        		
		<th width='%'> Purchase Qty </th>        
		<th width='%'> Purchase Return </th>        
		<th width='%'> Sale Qty </th>        
		<th width='%'> Transfer IN </th>        
		<th width='%'> Transfer OUT </th>  
<th width='%'> Adj+ </th>        
		<th width='%'> Adj- </th>  		
		<th width='%'> Salereturn </th>  		
		<th width='%'> Current Stock  </th>     
		 
		</tr> </thead> <tbody>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td width='%'>$data[0]</td>
  <td width='%'>$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>     
   <td width='%'>$data[6]</td>     
   <td width='%'>$data[7]</td>     
   <td width='%'>$data[8]</td>     
   <td width='%'>$data[9]</td>   
   <td width='%'>$data[10]</td>   
   <td width='%'>$data[11]</td>   
   <td width='%'>$data[12]</td>   
   <td width='%'>$data[13]</td>   
   <td width='%'>$data[14]</td>   
   <td width='%'>$data[15]</td>   
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
			 
		}
								?>
								

	<script src="../../assets/js/form-wizards.demo.min.js"></script>
	<script src="../../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
	<script src="../../assets/plugins/DataTables/js/dataTables.tableTools.js"></script>
	<script src="../../assets/plugins/DataTables/js/dataTables.colVis.js"></script>
	<script src="../../assets/js/table-manage-colvis.demo.min.js"></script>
	<script src="../../assets/js/table-manage-tabletools.demo.min.js"></script>
	<script src="../../assets/js/table-manage-combine.demo.min.js"></script>
	 <script src="../../assets/js/apps.min.js"></script>