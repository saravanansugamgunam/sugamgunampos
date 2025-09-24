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
SELECT date_format(b.stodate,'%d-%m-%Y'),b.stouniqueno,a.shortcode,
a.productname,a.mrp,c.locationname AS FromLocation,d.locationname AS ToLocation,b.receiptstatus
 FROM newstoitems AS a JOIN stomaster AS b ON a.stouniqueno=b.stouniqueno 
JOIN locationmaster AS c ON b.fromlocation=c.locationcode
JOIN locationmaster AS d ON b.tolocation=d.locationcode
WHERE a.barcode ='$Barcode' 
 ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblBill' class='table table-striped table-bordered'>";
echo " <thead>  
    <tr>
    <th>#</th>  
    <th>STO Date</th>  
    <th>STO ID</th>  
    <th>Short Code</th>  
    <th>Product</th>  
    <th>MRP</th>  
    <th>From</th>  
    <th>To</th>  
    <th>Status</th>  

		   
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
   <td width='%'>$data[6]</td>     
   <td width='%'>$data[7]</td>     
    
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
    

?>