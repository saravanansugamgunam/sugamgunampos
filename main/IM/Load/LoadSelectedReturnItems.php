<?php
  
session_cache_limiter(FALSE);
session_start();
  
 if(isset($_POST["ReturnInvoiceNo"]))
{
  
  // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	
 $ReturnInvoiceNo = mysqli_real_escape_string($connection, $_POST["ReturnInvoiceNo"]);
 
$result = mysqli_query($connection, " 
SELECT itemid, returninvoice,scode,sum(qty) AS qty,sum(value) AS value
  FROM tempsalereturnitems WHERE  returninvoice = '$ReturnInvoiceNo' group by itemid, returninvoice,scode ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblSelectedReturnItems' class='blueTable'>";
echo " <thead><tr>  
		 <th>S.No</th>  
		<th hidden width='%'> Item ID</th>     
		<th hidden width='%'> Invoice </th>    
		<th width='%'> S. Code </th>    
		<th width='%'> Qty</th>    
		<th width='%'> Value </th>       
		</tr> </thead> <tbody id='ReturnTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  
  <td width='10%'>$SerialNo</td>  
  <td hidden >$data[0]</td> 
  <td hidden width='%' >$data[1]</td>       
  <td  width='%' >$data[2]</td>       
  <td  width='%' >$data[3]</td>       
  <td  width='%' >$data[4]</td>           
    
    
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}