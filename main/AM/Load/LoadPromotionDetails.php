<script src="../assets/Custom/IndexTable.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<?php

session_cache_limiter(FALSE);
session_start();



// echo "1";
include("../../../connect.php"); 
$currentdate =date("Y-m-d"); 			
$Dummy = mysqli_real_escape_string($connection, $_POST["Dummy"]); 


$result = mysqli_query($connection, " 
SELECT DATE_FORMAT(promotedate, '%d-%b-%Y') AS promotedate,d.username,
oldsalary,newsalary,b.`designation`,c.`designation` FROM promotiondetails AS a 
JOIN designationmaster AS b ON a.`olddesignation`= b.`id` 
JOIN designationmaster AS c ON a.`newdesignation`= c.`id` 
JOIN usermaster AS d ON a.`employeecode`=d.`userid`
ORDER BY a.`promotedate` DESC

");

//echo "<table id='tblProject' class='tblMasters'>";
echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
<th>S.No</th>          
<th  width='%'> Date</a></th> 
<th  width='%'> Name</a></th> 
<th  width='%'> Old Salary</a></th>    
<th  width='%'> Revised Salary</a></th>    
<th width='%'> Old Designation </th>    
<th  width='%'> New Designation</th>    
 
</tr> </thead> <tbody id='tblSalesDetail' >";

$SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
echo "
<tr>
<td width='%'> $SerialNo </td>
<td >$data[0]</td>
<td >$data[1]</td>
<td >$data[2]</td>  
<td >$data[3]</td>  
<td >$data[4]</td>  
<td >$data[5]</td>  </tr>";

//echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
//echo "<br>";
$SerialNo=$SerialNo+1; 
}
echo "</tbody></table>"; 


?>