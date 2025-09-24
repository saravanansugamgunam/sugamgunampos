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
  
 // echo "1";

  $currentdate =date("Y-m-d H:i:s"); 	
    
  
								// $result = mysqli_query($connection, " 
								
// SELECT a.bookingid, DATE_FORMAT(a.reviseddate,'%d-%m-%Y') AS Bookingdate ,
// TIME_FORMAT(a.revisedtime, '%h:%i %p') AS BookingTime, 
// CONCAT(b.paitentname,'[',b.mobileno,']') AS paitent,  
// d.consultationname,d.consultationcharge,c.username, e.locationname,
// b.mobileno,b.paitentname,c.doctorphone,ROUND(b.topay-b.receipt,0) AS OldDue, 
// ROUND(d.consultationcharge + b.topay-b.receipt,0)  TotalFee
// FROM  therapybookingdetails   AS a JOIN paitentmaster AS b 
// ON a.paitentid=b.paitentid JOIN usermaster as c ON a.doctorid=c.userid
// JOIN consultationmaster AS d ON a.therapyid=d.consultationid JOIN locationmaster AS e
// ON a.location=e.locationcode WHERE bookingstatus NOT IN ('Closed','Cancelled')
// ");						

$result = mysqli_query($connection, " 
SELECT b.consultationname,DATE_FORMAT(a.closingdate,'%d-%m-%Y') 
 FROM therapyclosredetails AS a 
JOIN consultationmaster AS b ON a.therapyid=b.consultationid 
where a.bookinguniqueid ='$BookingID'
ORDER BY closingdate 
 
");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>      	
		<th width='%'>Therapy</th>   
		<th width='%'>Completed on </th> 
		  
		</tr> </thead> <tbody id='myTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td width='%'>$data[0]</td>
  <td width='%'>$data[1]</td> ";
    
  echo "</tr>";
  
 
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
 


								?>
    
 