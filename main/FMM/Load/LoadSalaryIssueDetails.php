<script src="../assets/Custom/IndexTable.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<?php

session_cache_limiter(FALSE);
session_start();



// echo "1";
include("../../../connect.php"); 
$currentdate =date("Y-m-d"); 			
$Dummy = mysqli_real_escape_string($connection, $_POST["Dummy"]); 


$result = mysqli_query($connection, " SELECT period,DATE_FORMAT(salarydate,'%d-%m-%Y') AS salarydate,
salarytype,b.username,a.`amount`,c.`paymentmode`,a.id  FROM salarypaymentdetails AS a JOIN
 usermaster AS b ON a.`employeecode`=b.`userid`
JOIN paymentmodemaster AS c ON a.`paymentmode`=c.`paymentmodecode` ORDER BY a.`salarydate` DESC

");

//echo "<table id='tblProject' class='tblMasters'>";
echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
<th>S.No</th>          
<th  width='%'> Period</a></th>    
<th  width='%'> Date</a></th>    
<th  width='%'> Type</a></th>    
<th  width='%'> Stafff </th>    
<th width='%'> Amount </th>    
<th width='%'> Mode </th>    
<th hidden width='%'> ID </th>   
<th width='%'> View </th>    

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
<td >$data[5]</td>  
<td hidden >$data[6]</td> ";
if($data[2]=='Advance')
{
echo "<td> </td>";
}
else
{
    echo "<td><a href='../AM/SalarySlip.php?SID=$data[6]' target='_blank' ?>
    <i class='fa fa-print  fa-lg m-r-5' ></i></a> </td>";
}


echo "</tr>";

//echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
//echo "<br>";
$SerialNo=$SerialNo+1; 
}
echo "</tbody></table>"; 


?>