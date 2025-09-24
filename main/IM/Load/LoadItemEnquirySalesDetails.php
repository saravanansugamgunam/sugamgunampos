<?php
  
session_cache_limiter(FALSE);
session_start();
  
 if(isset($_POST["Barcode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	
 $Barcode = mysqli_real_escape_string($connection, $_POST["Barcode"]);
 
$result = mysqli_query($connection, "
SELECT d.paitentname,d.mobileno,DATE_FORMAT(a.saledate,'%d-%m-%Y') , c.locationname,b.saletype,a.invoiceno    FROM newsaleitems AS a JOIN salemaster AS b ON a.invoiceno=b.saleuniqueno
JOIN locationmaster AS c ON a.location=c.locationcode JOIN paitentmaster AS d ON a.paitentcode = d.paitentid
WHERE a.transactiontype ='Sales' AND a.barcode ='$Barcode' 
 ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblBill' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>#</th>     
		<th  width='%'><a href=\"javascript:SortTable(2,'T');\">Paitent</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Mobile</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Date</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Center</a></th>      
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Type</a></th>    
		   
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
    
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
    

?>