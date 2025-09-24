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
SELECT saleid,b.uniquebarcode,concat(shortcode,'-',a.productname),SUM(saleqty)  AS Qty,
 mrp*SUM(saleqty) AS Total  FROM newstockindentitems as a 
join productmaster as b on a.productcode =b.productid  WHERE invoiceno ='$Invoice'
GROUP BY shortcode,a.productname,currentstock,uniquebarcode,saleid order by saleid desc

 
 ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblBill' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>#</th>     
		<th hidden width='%'><a href=\"javascript:SortTable(2,'T');\">Item ID</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Barcode </a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Product</a></th>     
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Qty</a></th>       
		<th   width='%'> <a href=\"javascript:SortTable(3,'T');\">Value</a></th>       
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
  <td align='center' width='%' style='color:red'  onclick='DeleteBillingItem(this);' ><i class='fa fa-2x fa-trash' style='cursor:pointer'></i></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
    

?>