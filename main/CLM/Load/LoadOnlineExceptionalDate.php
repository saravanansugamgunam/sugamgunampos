<?php
  
session_cache_limiter(FALSE);
session_start();
 
if(isset($_POST["DoctorCode"]))
{
   
     
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);
 
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 
$result = mysqli_query($connection, "SELECT  id,date_format(exceptionaldate,'%d-%m-%Y'),b.`username` 
FROM onlineexceptionaldatemaster AS a JOIN usermaster AS b  ON a.`doctorcode`=b.`userid` 
WHERE doctorcode ='$DoctorCode'  order by exceptionaldate desc
 ");
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='indextable' name='tblCategoryMaster'   >";
echo " <thead><tr>  
		<th>S. No</th>  
		<th hidden >Code</th>    
		<th width='50%'><a href=\"javascript:SortTable(2,'T');\">Date</a></th>     
		<th width='50%'><a href=\"javascript:SortTable(2,'T');\">Doctor</a></th>     
		<th width='50%'><a href=\"javascript:SortTable(3,'T');\">Delete</a></th>     
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden id='LedgerID'>$data[0]</td>
  <td id='Ledger' width='50%'>$data[1]</td>  
  <td id='LedgerStatus' width='40%'>$data[2]</td>   
  
  <td width='40%' onclick='DeleteExceptionalDate($data[0]);'>
  <a href='#' class='btn btn-sm btn-danger btn-xs' data-toggle='modal'>Delete</a></td>  
  
  
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
}

?>