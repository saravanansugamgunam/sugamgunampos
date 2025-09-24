 <style> 
 
    </style>
<?php
  
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 					 
  $currentdateprint =date("d-m-Y"); 					 
$result = mysqli_query($connection, "


SELECT DATE_FORMAT(a.entrydate, '%d-%m-%y'),
 
username,DATE_FORMAT(a.fromdate, '%d-%m-%y'),DATE_FORMAT(a.todate, '%d-%m-%y'),shareamount,c.paymentmode FROM doctorsharedetails AS a JOIN
usermaster as b ON a.userid=b.userid 
JOIN paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode
 where sharefor ='Medicine' ORDER BY entrydate DESC 
 "); 
 echo "  <table id='tblTodayPurchase' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th width='%'> Date</th>    
		<th width='%'> Doctor</th>    
		<th width='%'> Period From</th>   
		<th width='%'> Period To</th>   
 		<th width='%'>Paid Amount</th>    
		<th width='%'>Mode</th>         
		  
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
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>      
   
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
echo "</div></div>";     
 

?>