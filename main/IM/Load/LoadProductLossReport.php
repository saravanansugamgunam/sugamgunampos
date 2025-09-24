 
<?php
  
session_cache_limiter(FALSE);
session_start();
   
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 					 
  $currentdateprint =date("d-m-Y"); 					 
$result = mysqli_query($connection, "SELECT DATE_FORMAT(entrydate, '%d-%m-%y') AS Entrydatee, barcode, shortcode, SUBSTRING(product,0,6), mrp,1 as Qty, remarks 
FROM productlossdetails order by entrydate DESC   ");
echo " <div style='display:block;' id='DivPrinting'>"; 
  echo "  <table id='table' class='table' >";
echo " <thead><tr>  
		<th>S.No</th>          
		<th nowrap width='%'> Entry Date</th>    
		<th width='%'> Barcode</th>    
		<th width='%'> SC</th>   
		<th width='%'>Product</th>    
		<th width='%'>MRP</th>         
		<th  width='%'>Qty</th>     
		<th width='%'> Remarks</th>           
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
   
  </tr>"; 
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
echo " </div>";     
 
?>