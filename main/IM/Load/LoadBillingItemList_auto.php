<style>
  .tbl {
	display: table;
  border-spacing: 10px;
  border-collapse: separate;
  box-sizing: border-box;
  text-indent: 0;
  border: 1px solid;      
}

.tbl>tr>td{
  border-color: #e2e7eb;
  padding: 10px 15px; 
  border: 1px solid black;
  border-collapse: collapse;

}

 
  </style>
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
 
 SELECT saleid,barcode,concat(shortcode,''),batchcode,SUM(saleqty)  AS Qty, mrp*SUM(saleqty) AS Total, 
 round(SUM(discountamount),0) AS Discount, round(SUM(nettamount),0) AS nett, currentstock,employeecode
  FROM newsaleitems WHERE invoiceno ='$Invoice'
 GROUP BY shortcode,productname,currentstock,batchcode,saleid
 ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tble' class='table  table-sm'>";
echo " <thead><tr>  
		<th>#</th>     
		<th hidden width='%'><a href=\"javascript:SortTable(2,'T');\">Item ID</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Barcode</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Product</a></th>    
		<th hidden width='%'><a href=\"javascript:SortTable(2,'T');\">Batch No</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Qty</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Total</a></th>    
		<th  width='%'> <a href=\"javascript:SortTable(3,'T');\">Discount</a></th>    
		<th   width='%'> <a href=\"javascript:SortTable(3,'T');\">Nett Amount</a></th>    
		<th hidden width='%'> <a href=\"javascript:SortTable(3,'T');\">Current Stock</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">E.Code</a></th>    
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
   <td  width='%'>$data[2]</td>   
   <td hidden width='%'>$data[3]</td>     	
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>     
   <td  width='%' onclick='ItemwiseDiscount(this);'> <a href='#modalItemwiseDiscount' data-toggle='modal' >$data[6]</i></a></td>     
   <td  id='TotalAmount' width='%'>$data[7]</td>     
   <td hidden width='%'>$data[8]</td>       
   <td width='%'>$data[9]</td>     
     <td align='center' width='%' style='color:red'  onclick='DeleteBillingItem($data[0]);' >
     <i class='fa fa-2x fa-trash' style='cursor:pointer'></i></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}