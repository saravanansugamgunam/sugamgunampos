<script src="../assets/Custom/IndexTable.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
 
 
 <script>
 
 function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

<?php
  
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 			
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $UserID = mysqli_real_escape_string($connection, $_POST["UserID"]); 
 $ReportType = mysqli_real_escape_string($connection, $_POST["ReportType"]); 
   
    $FromDate = explode('/', $FromDate); 
$ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0];
 $ToDate = explode('/', $ToDate); 
$ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0];


echo "<input type='text' id ='myInput' name ='myInput' 
onkeyup='myFunction()' placeholder='Search ...' class= 'form-control' />";

if($ReportType=='Staff')
{
  $result = mysqli_query($connection, " 
  
  SELECT DATE_FORMAT(c.datename,'%d-%m-%Y') LogDate ,a.`username`,a.`mobileno`,MIN(b.`logtime`),
  MAX(b.`logtime`),
  TIME_FORMAT(TIMEDIFF(MAX(b.`logtime`), MIN(b.`logtime`)),'%H:%i') AS te FROM 
  `datetable` AS c 
    JOIN usermovementlog AS b ON b.`logdate`=c.datename 
    JOIN usermaster AS a  ON a.`biometricid` = b.`empcode`*1 
  WHERE c.datename BETWEEN  '$ActualFromDate' AND '$ActualToDate' 
  GROUP BY  c.datename,a.`username`,a.`mobileno`
  ORDER BY c.datename  
 
  ");
}
else
{
  $result = mysqli_query($connection, " 
  SELECT DATE_FORMAT(b.`logdate`,'%d-%m-%Y') LogDate ,a.`studentname`,a.`studentmobileno`,min(b.`logtime`) FROM studentmaster AS a 
  JOIN usermovementlog AS b
  ON a.`biometricid` = b.`empcode`*1 
  WHERE b.`logdate` BETWEEN  '$ActualFromDate' AND '$ActualToDate' 
  GROUP BY  b.`logdate`,a.`studentname`,a.`studentmobileno`
  order by b.`logdate`  
  ");
}
 
   
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='myTable' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th  width='%'> Date</a></th>    
		<th  width='%'> User</a></th>    
		<th width='%'> Mobile</th>    
		<th  width='%'> IN Time </th> 
		<th  width='%'> OUT Time </th> 
		<th  width='%'> Total Time </th>    
		      
		</tr> </thead> <tbody id='tblItemwise' >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'> $SerialNo </td>
  <td    > $data[0]</td>
  <td   > $data[1]</td>
  <td >$data[2]</td>";
 echo " <td>$data[3]</td> ";
if($data[3]==$data[4])
{
	echo " <td style='color:red'><b>Not Punched</b></td>  ";
		echo " <td >-</td>  ";
}
else
{
	echo " <td >$data[4]</td>  ";
		echo " <td >$data[5]</td>  ";
} 
	
 
    
   
  echo "</tr>";
      
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>"; 
	 

?> 