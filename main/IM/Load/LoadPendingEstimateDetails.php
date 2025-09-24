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
SELECT saleuniqueno,paitientcode,doctorcode,DATE_FORMAT(saledate,'%d-%m-%Y') AS DATE,nettamount 
FROM `salemaster_estimate` WHERE paitientcode ='$MobileNo'   and estimateclosure=0
  
 ");
 

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblBillingItems' class='table table-striped table-bordered'>";
echo " <thead><tr>    
		 
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">#</a></th>    
		<th hidden width='%'><a href=\"javascript:SortTable(2,'T');\">Uniqueno</a></th>    
		<th hidden width='%'><a href=\"javascript:SortTable(2,'T');\">Paitent</a></th>    
		<th hidden width='%'><a href=\"javascript:SortTable(2,'T');\">Doctor</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Date</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Nett Amount</a></th>     
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Convert</a></th>     
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden > $data[0]</td>
  <td hidden width='%' >$data[1]</td>  
   <td hidden width='%'>$data[2]</td>    
   <td width='%'>$data[3]</td>    
   <td width='%'>$data[4]</td>    
   <td width='%'>
   <a href='BillingEstimateAdjustment.php?MID=62&invoice=$data[0]&PID=$data[1]&DID=$data[2]' ?>
<i class='fa fa-2x fa-eye' title='View'></i></a>
   </td>    
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
    

?>