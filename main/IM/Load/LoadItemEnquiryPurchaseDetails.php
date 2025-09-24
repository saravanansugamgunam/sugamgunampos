<?php
  
session_cache_limiter(FALSE);
session_start();
  
 if(isset($_POST["Barcode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	
 $Barcode = mysqli_real_escape_string($connection, $_POST["Barcode"]);
 $GroupID = $_SESSION['SESS_GROUP_ID'];

$result = mysqli_query($connection, "
 SELECT UPPER(b.suplier_name),DATE_FORMAT(a.invoicedate,'%d-%m-%Y') AS InvoiceDate,DATE_FORMAT(a.receiptdate,'%d-%m-%Y') AS ReceiptDate,
grnnumber,supplierinvoice FROM purchaseitemsnew AS a JOIN supliers AS b ON a.suppliercode = b.suplier_id
WHERE a.barcode ='$Barcode' 
 ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblBill' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>#</th>";     
		if($GroupID ==1){ echo "<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Supplier</a></th>";}
		echo "<th width='%'><a href=\"javascript:SortTable(2,'T');\">Inv.Date</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Rc.Date</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">GRN</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Invoice 
		</a></th>    
		   
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>";

  if($GroupID ==1){ echo " <td  > $data[0]</td>";}
   
  echo "<td  width='%' >$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     	
   <td width='%'>$data[4]</td>     
    
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
    

?>