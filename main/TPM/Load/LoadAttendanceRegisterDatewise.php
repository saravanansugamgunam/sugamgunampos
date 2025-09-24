<script src="../assets/Custom/IndexTable.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
 
 
 <script>
 

// function myFunction() {
  // var input, filter, table, tr, td, i, txtValue;
  // input = document.getElementById("txtItemSearch");
  // filter = input.value.toLowerCase();
  // $("#tblItemwise tr").filter(function() {
      // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    // });
	// alert(1);
// }

// $(document).ready(function(){
  // $("#txtItemSearch").on("keyup", function() {
    // var value = $(this).val().toLowerCase();
	// alert(2);
    // $("#tblItemwise tr").filter(function() {
      // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    // });
  // });
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
   
    $FromDate = explode('/', $FromDate); 
$ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0];
 $ToDate = explode('/', $ToDate); 
$ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0];


 
 
 echo "<b><u>Summary</u></b>";
 $result = mysqli_query($connection, " 
SELECT b.username, 
 (
SELECT COUNT(*) FROM time_dimension WHERE db_date BETWEEN '$ActualFromDate' AND '$ActualToDate') AS TotalDays, 
 COUNT(DISTINCT DATE_FORMAT(attendancetime,'%Y-%m-%d'))
 
FROM attendanceregister AS a JOIN usermaster AS  b ON b.userid=a.userid
 WHERE DATE_FORMAT(attendancetime,'%Y-%m-%d') BETWEEN '$ActualFromDate' AND '$ActualToDate' and b.userid like ('$UserID')
GROUP BY b.username 

 ");
   
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tbUserItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th  width='%'> Staff</a></th>    
		 <th  width='%'> Total Days</a></th>    
		<th width='%'> Days Present </th>    
		<th  width='%'> Days Absent </th>    
		      
		</tr> </thead> <tbody id='tblSalesDetail' >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
	 $TotalDays = $data[1]-$data[2];
	 
  echo "
  <tr>
  <td width='%'> $SerialNo </td>
  <td > $data[0]</td>
  <td > $data[1]</td>
  <td >$data[2]</td> 
  <td >$TotalDays</td> 
  </tr>";
      
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>"; 
	 
	 
 
 
 echo "<br><b><u>Details</u></b>";
 $result = mysqli_query($connection, " 
 
SELECT DATE_FORMAT(a.db_date,'%d-%m-%Y'),c.username,
 DATE_FORMAT(DATE_ADD( MIN(attendancetime), INTERVAL 330 MINUTE),'%r') AS InTime,
 DATE_FORMAT(DATE_ADD( MAX(attendancetime), INTERVAL 330 MINUTE),'%r') AS OutTime 
 FROM  
time_dimension  AS a LEFT JOIN `attendanceregister` AS b
ON a.db_date=DATE_FORMAT(b.attendancetime,'%Y-%m-%d')
LEFT JOIN usermaster AS  c ON b.userid=c.userid
WHERE a.db_date BETWEEN '$ActualFromDate' AND '$ActualToDate' AND 
c.userid like ('$UserID')
GROUP BY c.username,DATE_FORMAT(a.db_date,'%d-%m-%Y') order by a.db_date
 ");
   
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th  width='%'> Date</a></th>    
		<th  width='%'> User</a></th>    
		<th width='%'> IN Time </th>    
		<th  width='%'> OUT Time </th>    
		      
		</tr> </thead> <tbody id='tblSalesDetail' >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'> $SerialNo </td>
  <td    > $data[0]</td>
  <td   > $data[1]</td>
  <td >$data[2]</td>";
if($data[3]==$data[2])
{
	echo " <td >-</td>  ";
}
else
{
	echo " <td >$data[3]</td>  ";
}

 
    
   
  echo "</tr>";
      
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>"; 
	 

?> 