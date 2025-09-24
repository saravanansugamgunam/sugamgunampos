 
<?php
  
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 					 
  $currentdateprint =date("d-m-Y"); 	
$PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);     
$result = mysqli_query($connection, "  
 
SELECT DATE_FORMAT(a.advancedate, '%d-%m-%y') advancedate ,SUM(amount) AS Advance,b.paymentmode,remarks FROM 
advancedetails AS a JOIN paymentmodemaster AS b ON a.paymentmode=b.paymentmodecode WHERE a.paitentcode='$PaitentCode'
GROUP BY  advancedate,b.paymentmode,remarks "); 
 

 
  echo "  <table id='data-table' class='table table-striped table-bordered' >";
echo " <thead><tr>  
		<th>S.No</th>          
		<th width='%'> Date</th>    
		<th width='%'> Amount</th>    
		<th width='%'> Mode</th>   
<th width='%'> Remarks</th>    		
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td> $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>   
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>"; 
      

?>