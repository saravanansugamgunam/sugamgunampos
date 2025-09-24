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
 $Doctor = mysqli_real_escape_string($connection, $_POST["DoctorCode"]); 
 
$result = mysqli_query($connection, "


SELECT b.`doctorname`, DATE_FORMAT(a.`assigneddate`,'%d-%m-%y') AS DATE, a.`timeslot`,a.`status` FROM 
 timeslotdetails AS a JOIN doctormaster AS b ON a.`doctorid`=b.`doctorcode` where
 assigneddate between '$FromDate' and '$ToDate' and a.doctorid='$Doctor'
ORDER BY assigneddate DESC 
 "); 
 
  
 
 echo "  <table id='tblTodayPurchase' class='table   table-condensed'>";
echo " <thead><tr>  
		<th>S.No</th>          
		    
		<th width='%'> Doctor</th>
        <th width='%'> Date</th>    
		<th width='%'> Time Slot</th>    
		<th width='%'> Status</th>   
		   
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
 
doctorname,LEFT(sharefor , 1),DATE_FORMAT(a.fromdate, '%d-%m-%y'),DATE_FORMAT(a.todate, '%d-%m-%y'),shareamount,
c.paymentmode FROM doctorsharedetails AS a JOIN
doctormaster AS b ON a.doctorcode=b.doctorcode 
JOIN paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode where a.sharefor in('Consultation','Therapy')
and a.entrydate between '$FromDate' and '$ToDate' and a.doctorcode='$Doctor'
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