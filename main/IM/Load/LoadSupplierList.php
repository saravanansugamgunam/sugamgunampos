<?php
  
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 					 
$result = mysqli_query($connection, "SELECT suplier_id, suplier_name, contact_person, suplier_contact, suplier_address,supplierstatus  FROM  `supliers`  
 ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S. No</th>    
		<th width='%' hidden>Code</th>   
		<th width='%'>Name</th>    
		<th width='%'>Contact Person</th>    
		<th width='%'>Contact No</th>    
		<th width='%'>Address</th>    
		<th width='%'>Status</th> 
<th></th>		
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td id='SupplierCode' hidden> $data[0]</td>
  <td id='SupplierName'  width='%' >$data[1]</td>  
   <td id='SupplierContactPerson' width='%'>$data[2]</td>   
   <td id='SupplierContactNo' width='%'>$data[3]</td>     
   <td id='SupplierAddress' width='%'>$data[4]</td>     
   <td   width='%'>$data[5]</td>     
   <td align='center' width='%' style='color:#009ad9' onclick='GetRowID(this);'><a href='#myModalEdit'   data-toggle='modal'><i class='fa fa-2x fa-edit'></i></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    

?>