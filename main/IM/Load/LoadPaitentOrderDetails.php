<?php
  
session_cache_limiter(FALSE);
session_start();
  
 if(isset($_POST["MobileNo"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	
 $MobileNo = mysqli_real_escape_string($connection, $_POST["MobileNo"]);
 
$result = mysqli_query($connection, "

SELECT id, DATE_FORMAT(DATE,'%d-%m-%Y') AS orderdate, CONCAT(c.productshortcode,'-',c.productname) AS product,
 a.qty,d.advanceamount,d.remarks FROM preorderitems AS a JOIN paitentmaster AS b ON a.paitentid = b.paitentid JOIN productmaster AS c 
 ON a.itemid= c.productid JOIN preordermaster AS d ON a.`uniqueno`=d.uniqueno
 
  WHERE b.id ='$MobileNo' AND orderstatus in('Open','Purchased') ORDER BY 1   
 ");
 

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblBillingItems' class='table table-striped table-bordered'>";
echo " <thead><tr>    
		 
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">#</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Order</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Date</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Product</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Qty</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Advance</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Remarks</a></th>    
		  
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td  > $data[0]</td>
  <td  width='%' >$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>     
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
    

?>