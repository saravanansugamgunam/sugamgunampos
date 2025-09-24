<?php
  
session_cache_limiter(FALSE);
session_start();
  
 if(isset($_POST["STOUniqueNo"])) 
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	
 $STOUniqueNo = mysqli_real_escape_string($connection, $_POST["STOUniqueNo"]);
 
$result = mysqli_query($connection, "
 
 SELECT itemid,shortcode,productname,SUM(qty)  AS Qty, mrp*SUM(qty) AS Total , SUM(nettamount) AS nett, currentstock FROM supplierpreorderitems WHERE uniqueno ='$STOUniqueNo'
 GROUP BY shortcode,productname,currentstock,itemid
 ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblBillingItems' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S. No</th>     
		<th hidden width='%'><a href=\"javascript:SortTable(2,'T');\">Product Code</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Short Code</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Name</a></th>         
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Qty</a></th>      
		 
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden > $data[0]</td>
  <td  width='%' >$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>         
      
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
    

?>