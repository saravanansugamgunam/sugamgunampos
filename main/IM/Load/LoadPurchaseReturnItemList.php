<?php
  
session_cache_limiter(FALSE);
session_start();
  
 if(isset($_POST["Invoice"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	
 $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);
 
$result = mysqli_query($connection, "
 
 SELECT purchasereturnid,barcode,concat(shortcode,'-',productname),batchcode,SUM(returnqty)  AS Qty, mrp*SUM(returnqty) AS Total, 
 round(SUM(discountamount),0) AS Discount, round(SUM(nettamount),0) AS nett, currentstock FROM newpurchasereturnitems WHERE invoiceno ='$Invoice'
 GROUP BY shortcode,productname,currentstock,batchcode,purchasereturnid order by purchasereturnid desc
 ");
 
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblBill' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>#</th>     
		<th hidden width='%'><a href=\"javascript:SortTable(2,'T');\">Item ID</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Barcode Code</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Product</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Batch No</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Qty</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Total Amount</a></th>    
		<th hidden width='%'> <a href=\"javascript:SortTable(3,'T');\">Discount</a></th>    
		<th hidden width='%'> <a href=\"javascript:SortTable(3,'T');\">Nett Amount</a></th>    
		<th hidden width='%'> <a href=\"javascript:SortTable(3,'T');\">Current Stock</a></th>    
		 <th width='%'>  Delete </th>   
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden > $data[0]</td>
  <td  width='%' >$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     	
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>     
   <td hidden width='%' onclick='ItemwiseDiscount(this);'> <a href='#modalItemwiseDiscount' data-toggle='modal' >$data[6]</i></a></td>     
   <td hidden id='TotalAmount' width='%'>$data[7]</td>     
   <td hidden width='%'>$data[8]</td>       
     <td align='center' width='%' style='color:red'  onclick='DeleteBillingItem(this);' ><i class='fa fa-2x fa-trash' style='cursor:pointer'></i></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
    

?>