 <style>

 </style>
 <?php
  
session_cache_limiter(FALSE);
session_start();
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 					 
  $currentdateprint =date("d-m-Y"); 

 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $Doctor = mysqli_real_escape_string($connection, $_POST["userid"]); 
 
//  $result = mysqli_query($connection, "
// SELECT b.username, DATE_FORMAT(a.assigneddate,'%d-%m-%y') AS DATE, a.timeslot ,
// IF(bookedstatus>=1,'Booked','Open') AS STATUS,a.id FROM 
// timeslotdetails AS a JOIN usermaster AS b ON a.doctorid=b.userid  
// LEFT JOIN (SELECT timeslotid,IFNULL(COUNT(*),0) AS bookedstatus FROM timeslotallocation 
// GROUP BY timeslotid) AS c ON c.timeslotid=a.id
// where  assigneddate between '$FromDate' and '$ToDate' and a.doctorid='$Doctor'
// ORDER BY assigneddate desc ,a.starttime asc "); 
 
 

$result = mysqli_query($connection, "
SELECT b.username, DATE_FORMAT(a.assigneddate,'%d-%m-%y') AS DATE, a.timeslot ,
CASE
    WHEN bookedstatus = 1 THEN 'Booked'
    WHEN bookedstatus = 2 THEN 'Recomended'
    ELSE 'Open'
END AS status,a.id FROM 
timeslotdetails AS a JOIN usermaster AS b ON a.doctorid=b.userid  
LEFT JOIN (SELECT a.timeslotid, IF(ISNULL(therapystatus)=1,'2','1') AS bookedstatus
FROM timeslotallocation AS a LEFT JOIN  therapybookingmaster AS b 
ON a.uniqueid=b.bookinguniqueid) AS c ON c.timeslotid=a.id
where  assigneddate between '$FromDate' and '$ToDate' and a.doctorid='$Doctor'
ORDER BY assigneddate desc ,a.starttime asc "); 
 
   
 
 echo "  <table id='tblTodayPurchase' class='table   table-condensed'>";
echo " <thead><tr>  
		<th>S.No</th>          
		    
		<th width='%'> Doctor</th>
        <th width='%'> Date</th>    
		<th width='%'> Time Slot</th>    
		<th width='%'> Status</th>   
		<th width='%'> Delete</th>   
		   
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td> $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td> ";
if($data[3]=='Booked')
{
      echo "<td bgcolor='#43cdef' width='%'>$data[3]</td>
      <td></td>";
}
else if($data[3]=='Recomended')
{
      echo "<td bgcolor='#f0a97a' width='%'>$data[3]</td>
      <td></td>";
}
else
{
    echo "<td  bgcolor='#93d543' width='%'>$data[3]</td>
    <td onclick='DeleteTimeSlot($data[4])' style='cursor:pointer'> 
<i class='fa fa-2x  fa-trash text-danger'></i> </td>";
}
echo"        

    
 </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
echo "</div></div>";     
 


?>

 <div style="display:none;">
     <div class="table-responsive" id='DivPrint'>
         <label>
             <h4>Doctor Share Report - <?php echo "As on " . $currentdateprint ;?></h4>
         </label>
         <?php

$result = mysqli_query($connection, "



SELECT DATE_FORMAT(a.entrydate, '%d-%m-%y'),
 
username,LEFT(sharefor , 1),DATE_FORMAT(a.fromdate, '%d-%m-%y'),DATE_FORMAT(a.todate, '%d-%m-%y'),shareamount,
c.paymentmode FROM doctorsharedetails AS a JOIN
usermaster as b ON a.userid=b.userid 
JOIN paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode where a.sharefor in('Consultation','Therapy')
and a.entrydate between '$FromDate' and '$ToDate' and a.userid='$Doctor'
ORDER BY entrydate DESC 
 "); 
 
  
 
 echo "  <table id='PrintTable'  border='1' style='border-collapse:collapse;' width='100%'>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th width='%'> Date</th>    
		<th width='%'> Doctor</th>    
		<th width='%'> For</th>    
		<th width='%'> From</th>   
		<th width='%'> To</th>   
 		<th width='%'>Paid</th>    
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
   <td width='%'>$data[6]</td>      
   
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
 
 ?>

     </div>
 </div>