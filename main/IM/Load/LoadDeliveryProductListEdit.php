 
<?php
  
session_cache_limiter(FALSE);
session_start();
   
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 					 
  $currentdateprint =date("d-m-Y");
  $Invoice = mysqli_real_escape_string($connection, strtoupper($_POST["Invoice"]));  

$result = mysqli_query($connection, "select productcode,shortcode,mrp,saleqty,nettamount from newsaleitemsproduct
 where invoiceno='$Invoice'");
echo " <div style='display:block;' id='DivPrinting'>"; 
  echo "  <table id='tableproductlist' class='table' >";
echo " <thead><tr>  
		<th>S.No</th>          
		<th hidden nowrap width='%'> ProductCode</th>    
		<th nowrap width='%'> Shorcode</th>    
		<th width='%'> MRP</th>    
		<th width='%'> Qty</th>   
		<th width='%'>Total Amount</th>        
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden >$data[0]</td>
  <td >$data[1]</td>  
   <td  width='%'><b>$data[2]</b></td>   
   <td width='%'>$data[3]</td>    
   <td width='%'>$data[4]</td>    
   <td  onclick='GetPointID(this);' width='%'>
   <a href='#ModalModifyProduct' data-toggle='modal'>
<i class='fa fa-pencil' title='View'></i></a></td>
</td>    
   
  </tr>"; 
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
echo " </div>";     
 
?>