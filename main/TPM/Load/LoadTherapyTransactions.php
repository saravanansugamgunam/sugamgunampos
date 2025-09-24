<style>
table, th, td {
  border: 1px solid #E2E7EB;
  border-collapse: collapse;
}
th, td {
	
  padding: 3px;
}
th{ text-align:center;}
</style>

<script>
$(document).ready(function(){
  // $("#myInput").on("keyup", function() {
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<?php
   include("../../../connect.php"); 
session_cache_limiter(FALSE);
session_start();
  
 $BookingID = mysqli_real_escape_string($connection, $_POST["BookingID"]); 
 
   

  $currentdate =date("Y-m-d H:i:s"); 	
    
   

$result = mysqli_query($connection, "  


SELECT b.consultationname,c.username,count(*) as TotalSitting, 
ifnull(d.CompletedSitting,0) as CompletedSitting,
COUNT(*)-IFNULL(d.CompletedSitting,0) as Balance FROM  therapybookingdetails as a 
join consultationmaster as b on a.therapyid=b.consultationid 
JOIN usermaster as c ON a.doctorid=c.userid
left join (
SELECT therapyid,COUNT(*) as CompletedSitting,bookinguniqueid FROM  therapybookingdetails 
WHERE  bookinguniqueid ='$BookingID' AND STATUS ='1'
GROUP BY therapyid,bookinguniqueid 
) as d on a.bookinguniqueid=d.bookinguniqueid and a.therapyid=d.therapyid
where a.bookinguniqueid ='$BookingID'
group by  b.consultationname,c.username  ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table'  border='1' style='border-collapse:collapse; '  class='  ' width='100%'>";
echo " <thead><tr>  
		<th    width='%'>#</th>      	
		<th width='%'> Therapy</th>    
		<th width='%'>  Doctor </th> 
		<th width='%'> Total Sittings</th> 
		<th width='%'> Completed</th>    
    <th width='%'> Balance</th>    
		 
		</tr> </thead> <tbody id='myTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
 
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td    width='%' >$data[0]</td> 
  <td    width='%' >$data[1]</td> 
  <td    width='%' >$data[2]</td> 
  <td    width='%' >$data[3]</td> 
  <td    width='%' >$data[4]</td> 
  "; 
    
  echo "</tr>";
   
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";


echo "<br>";
echo '<u>Completed History</u>';

$result = mysqli_query($connection, "  
SELECT a.`closingdate`,c.username,a.`closureremarks`   FROM  therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid=b.consultationid 
JOIN usermaster as c ON a.doctorid=c.userid
WHERE a.bookinguniqueid ='$BookingID'  AND STATUS ='1' 
GROUP BY a.`closingdate`,c.username,a.`closureremarks` order by a.`closingdate`  ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table'  border='1' style='border-collapse:collapse; '  class='  ' width='100%'>";
echo " <thead><tr>  
		<th    width='%'>#</th>      	
		<th width='%'> Completed on </th>    
    <th width='%'> Doctor </th>
		<th width='%'>  Remarks </th>  
		 
		</tr> </thead> <tbody id='myTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
 
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td    width='%' >$data[0]</td> 
  <td    width='%' >$data[1]</td> 
  <td    width='%' >$data[2]</td>  
  "; 
    
  echo "</tr>";
   
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";



								?>
    
 