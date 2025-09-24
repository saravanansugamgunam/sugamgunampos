<?php
   include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["ProductCode"]))
{	
  
 // echo "1"; 
 $ProductCode = mysqli_real_escape_string($connection, $_POST["ProductCode"]); 
 $MRP = mysqli_real_escape_string($connection, $_POST["MRP"]); 
   
$result = mysqli_query($connection, " 
SELECT grnnumber,DATE_FORMAT(b.purchasedate,'%d-%m-%y') AS Purchasedate,c.suplier_name ,shortcode,productname, barcode, a.currentstock FROM newstockdetails_3 AS a JOIN 
purchasemaster AS b ON a.grnnumber=b.purchasegrn JOIN supliers AS c ON b.suppliercode=c.suplier_id 
WHERE a.productcode='$ProductCode' AND a.currentstock > 0 and mrp ='$MRP'
 ");
  
	  
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered' style='width:95%'>";
echo " <thead><tr>  
		<th>S.No</th>          
		    
		<th  width='%'> GRN</a></th>
		<th  width='%'> Purchase Date</a></th>
		<th  width='%'> Supplier</a></th>
	
		<th  width='%'> SC</a></th>
		<th  width='%'> Product</a></th>
    <th  width='%'> Barcode</a></th>
		<th  width='%'> Stock</a></th> 
		</tr> </thead> <tbody  id='tblBalanceSheet'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>";   
  echo "<td  width='%' >$data[0]</td>";  
  echo "<td width='%' >$data[1]</td>";  
  echo "<td width='%' >$data[2]</td>";  
  echo "<td width='%' >$data[3]</td>";  
  echo "<td width='%' >$data[4]</td>";  
  echo "<td width='%' >$data[5]</td>";  
  echo "<td width='%' >$data[6]</td>";  
     
 echo" </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";

  
}
else
{
	 echo " NO";
}

?>