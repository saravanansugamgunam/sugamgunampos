<script>
$(document).ready(function() {
    // $("#myInput").on("keyup", function() {
    $("#myInputRecomended").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTableRecomended tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
<?php
   include("../../../connect.php"); 
session_cache_limiter(FALSE);
session_start();

 
  $currentdate =date("Y-m-d"); 	
 echo " <input type='text' name='myInputRecomended' id='myInputRecomended' class='form-control'  placeholder='Search...'  />";    
   
	 
	$result = mysqli_query($connection, "
  SELECT diseasemappinguniqueid,c.`paitentid`,
  DATE_FORMAT(consultingdate,'%d-%m-%y'),b.`username`, c.`paitentname`,c.mobileno
FROM diseasemapping_paitent AS a JOIN 
usermaster AS b ON a.addedby = b.`userid` JOIN 
paitentmaster AS c ON a.`paitientid`=c.`paitentid`
 WHERE consultingdate ='$currentdate' and therapycompleted ='0'
AND conceptname ='Therapy'  
GROUP BY diseasemappinguniqueid,c.`paitentid`,consultingdate,b.`username`, c.`paitentname`,c.mobileno
 
 
");
  

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblTherapyRegisterRecomnded'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th  hidden width='%' > ID </th>    	
		<th hidden width='%'> PID</th>    
		<th nowrap width='%'> Date</th> 
		<th width='%'> Doctor </th> 
    <th width='%'> Patient </th> 
    <th width='%'> Mobile No </th>    	
    <th width='%'> Open Booking</th> 	 	 
    <th width='%'> Advance Booking</th> 	 	 
		
		";  
		 echo "
		</tr> </thead> <tbody id='myTableRecomended'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden id='BookingID'  width='%' >$data[0]</td>
  <td hidden  id='TherapyDate' width='%'>$data[1]</td>  
   <td nowrap id='TherapyTime'  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td  id='TherapyName' width='%'>$data[5]</td> ";    

echo "<td align='center' style='color:#009ad9'>
    <a href='TherapyBooking.php?MID=30&i=$data[0]&PID=$data[1]' target='_blank' ?>
<i class='fa fa-2x fa-book' title='View'></i></a>
</td>";

echo "<td align='center' style='color:#009ad9'>
    <a href='TherapyBookingAdvance.php?MID=30&i=$data[0]&PID=$data[1]' target='_blank' ?>
        <i class='fa fa-2x fa-calendar' title='View'></i></a>
</td>";


echo "</tr>";
$SerialNo=$SerialNo+1;
}



echo "</tbody>
</table>";
?>