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
 
 
 SELECT consultingdetailid,b.consultationname,a.consultationcharge,discount,consultationtotal FROM  `consultingdetails` AS a
 JOIN consultationmaster AS b ON a.consultationid = b.consultationid WHERE consultationuniquebill ='$Invoice'
  
 ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblBillingItems' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S. No</th>     
		<th hidden width='%'><a href=\"javascript:SortTable(2,'T');\">Item ID</a></th>        
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Name</a></th>     
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Amount</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Discount</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Nett Amount</a></th>     
		 <th width='%'>  Delete </th>   
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden  > $data[0]</td>
  <td  width='%' >$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>              
     <td align='center' width='%' style='color:red'  onclick='DeleteBillingItem(this)' ><i class='fa fa-2x fa-trash' style='cursor:pointer'></i></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
    

?>