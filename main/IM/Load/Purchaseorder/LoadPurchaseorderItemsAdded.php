<?php
  
session_cache_limiter(FALSE);
session_start();
  
 if(isset($_POST["PurchaseOrderUniqueno"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	
 $PurchaseOrderUniqueno = mysqli_real_escape_string($connection, $_POST["PurchaseOrderUniqueno"]);
 
$result = mysqli_query($connection, "
SELECT a.productcode,b.productname,SUM(qty),a.uom,rate,mrp,SUM(nettamount) FROM purchaseorderitems
 AS a JOIN productmaster AS b
ON a.productcode = b.productid WHERE purchaseorderuniqueid ='$PurchaseOrderUniqueno'
GROUP BY a.productcode,b.productname,rate,mrp,a.uom ");
 
  
 // echo "<table id='tblProject' class='tblMasters'>";
echo " <table id='tblBillingItems' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S. No</th>       
		<th hidden >ID</th>       
		<th>Product</th>       
		<th>Qty</th>      
      	<th>UOM</th> 
		<th>Rate</th>       
		<th>MRP</th>       
		<th>Total</th>       
	       
		<th width='%'>  Delete </th>    
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden >$data[0]</td>
  <td > $data[1]</td>
  <td > $data[2]</td>
  <td > $data[3]</td>
  <td > $data[4]</td>
  <td > $data[5]</td>
  <td > $data[6]</td>
   
          
     <td align='center' width='%' style='color:red'  onclick='DeletePurchaseItems(this)' ><i class='fa fa-2x fa-trash' style='cursor:pointer'></i></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
    

?>