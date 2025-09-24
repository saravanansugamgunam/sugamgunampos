 <style> 
 
    </style>
<?php
  
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 					 
  $currentdateprint =date("d-m-Y"); 					 
$result = mysqli_query($connection, "  
SELECT DATE_FORMAT(a.invoicedate, '%d-%m-%y') Incoicedate,
DATE_FORMAT(a.receiptdate, '%d-%m-%y') , supplierinvoice,c.suplier_name,expirydate,batchno,  
b.productshortcode,b.productname,SUM(a.qty) AS Qty,a.rate,a.mrp ,SUM(a.qty)*a.profit AS Profit,
SUM(a.totalamount) AS Total  FROM purchaseitemsnew AS a JOIN productmaster AS b ON a.productcode = b.productid
JOIN supliers AS c ON a.suppliercode=c.suplier_id
  WHERE   DATE_FORMAT(a.addedon, '%Y-%m-%d') =  CURRENT_DATE
GROUP BY DATE_FORMAT(a.invoicedate, '%d-%m-%y'),DATE_FORMAT(a.receiptdate, '%d-%m-%y'),a.productcode,a.rate,a.mrp,
b.productshortcode,b.productname,c.suplier_name,a.invoicedate,a.receiptdate, supplierinvoice,batchno, expirydate");
echo "<div style='display:none;'><div style='display:block;' id='DivPrinting'>";
 //echo "<table id='tblProject' class='tblMasters'>";
 echo "<h3>Purchase Entry Details on $currentdateprint</h3>"; 
  echo "  <table id='data-table' >";
echo " <thead><tr>  
		<th>S.No</th>          
		<th width='%'> Invoice Date</th>    
		<th width='%'> Receipt Date</th>    
		<th width='%'> Invoice No</th>   
<th width='%'> Supplier</th>    		
		
		<th width='%'>Expiry Date</th>    
		<th width='%'>Batch</th>         
		<th  width='%'>Shortcode</th>     
		<th width='%'> Product</th>           
		<th width='%'> Qty</th>        
		<th width='%'> Rate</th>        
		<th width='%'> MRP</th>        
		<th width='%'> Profit</th>        
		<th width='%'> Total</th>        
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td> $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
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
   
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
echo "</div></div>";     

$result = mysqli_query($connection, "  
SELECT  a.grnnumber,c.suplier_name,
b.productname,SUM(a.qty) AS Qty,a.rate,a.mrp  ,
SUM(a.totalamount) AS Total  FROM purchaseitemsnew AS a JOIN productmaster AS b ON a.productcode = b.productid
JOIN supliers AS c ON a.suppliercode=c.suplier_id
  WHERE   DATE_FORMAT(a.addedon, '%Y-%m-%d') =  CURRENT_DATE
GROUP BY DATE_FORMAT(a.invoicedate, '%d-%m'),a.productcode,a.rate,a.mrp,
b.productname,c.suplier_name");
echo "<div>";
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblTodayPurchase' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">GRN</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Supplier</a></th>      
		      
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Product</a></th>           
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Qty</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Rate</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">MRP</a></th>            
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Total</a></th>        
		<th  width='%'> <a href=\"javascript:SortTable(3,'T');\"></a></th>        
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td>$data[0]</td>
  <td >$data[1]</td>  
   <td  >$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>      
   <td width='%'>$data[6]</td>         
      
   <td   align='center' width='%' style='color:red'  onclick='GetItemIDtoRemove(this)' ><i class='fa fa-2x fa-trash'></i></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
echo "</div>";      

?>