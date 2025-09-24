<style>
  #tblBillingItems tr:nth-of-type(1) td {   /* 1st row */
    background-color: #33c481;
 }
</style>

<?php
  
session_cache_limiter(FALSE);
session_start();
  
 if(isset($_POST["StockTakeID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	
 $StockTakeID = mysqli_real_escape_string($connection, $_POST["StockTakeID"]);
 
$result = mysqli_query($connection, "
 
 SELECT barcode,shortcode,productname,batchcode,SUM(scanqty)  AS Qty, mrp*SUM(scanqty) AS Total , 
 SUM(nettamount) AS nett, currentstock,id FROM stocktakeitems WHERE stocktakeuniqueno ='$StockTakeID'
 GROUP BY shortcode,productname,currentstock,batchcode,barcode  ORDER BY id DESC 
 ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblBillingItems' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S. No</th>     
		<th   width='%'><a href=\"javascript:SortTable(2,'T');\">Barcode</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Short Code</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Product</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Batch No</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Qty</a></th>     
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Nett Amount</a></th>    
		<th hidden width='%'> <a href=\"javascript:SortTable(3,'T');\">Current Stock</a></th>    
		 
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td   > $data[0]</td>
  <td  width='%' >$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>        
   <td id='TotalAmount' width='%'>$data[5]</td>     
   <td hidden>$data[6]</td>     
   <td align='center' width='%' style='color:#009ad9'  onclick='GetPointID(this)' 
   hidden><i class='fa fa-2x fa-edit'></i></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
    

?>