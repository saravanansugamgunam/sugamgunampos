<script>
$(document).ready(function(){
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

 
  $currentdate =date("Y-m-d H:i:s"); 	
 echo " <input type='text' name='myInputRecomended' id='myInputRecomended' class='form-control'  placeholder='Search...'  />";    
  
	 
	$result = mysqli_query($connection, "SELECT a.paitentid,a.bookinguniqueid,a.doctorid, DATE_FORMAT(bookingdate,'%d-%m-%Y') AS bookingdate,b.paitentname,b.mobileno,c.username,
  d.reviseddate FROM therapybookingdetails AS a JOIN paitentmaster AS b ON 
  a.paitentid=b.paitentid JOIN usermaster AS c ON a.doctorid=c.userid 
  JOIN (SELECT bookinguniqueid,MIN(reviseddate) AS reviseddate FROM therapybookingdetails WHERE bookingstatus ='Recomended' 
  GROUP BY bookinguniqueid) AS d ON d.bookinguniqueid=a.bookinguniqueid
  WHERE bookingstatus ='Recomended' AND a.bookinguniqueid IN(
  SELECT bookinguniqueid FROM therapybookingmaster_recomended WHERE  therapystatus ='Recomended' )
  GROUP BY a.paitentid,a.bookinguniqueid,a.doctorid,bookingdate,b.paitentname,b.mobileno,c.username 
 
  
");
  

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblTherapyRegisterRecomnded'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th   width='%' > ID </th>    	
		<th nowrap width='%'> Uniqueid</th>    
		<th width='%'> Doctoid </th> 
    <th width='%'> Booking Date</th> 
    <th width='%'> Paitent </th>  		  		 
    <th width='%'> Mobile </th>  		  		 
    <th width='%'> Therapist</th>  	
    <th width='%'> Payment</th> 	
    <th width='%'> Cancel</th> 	
		
		";  
		 echo "
		</tr> </thead> <tbody id='myTableRecomended'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td    id='BookingID'  width='%' >$data[0]</td>
  <td nowrap id='TherapyDate' width='%'>$data[1]</td>  
   <td id='TherapyTime'  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td  id='TherapyName' width='%'>$data[5]</td>     
   <td  id='TherapyName' width='%'>$data[6]</td>     
  

   <td onclick='GetPointIDRD($data[0])'>
   <a href='TherapyBookingCompleteRecomendation.php?MID=56&PID=$data[0]&INV=$data[1]&DID=$data[2]'  target='_blank' >
   <i class='fa fa-2x  fa-rupee text-warning'></i></a></td>
   
   <td   onclick='GetPointIDRD($data[1])'><a href='#modalTherapyCancelRecomended' data-toggle='modal'  >
   <i class='fa fa-2x fa-minus-circle text-danger'></i></a></td>
   ";

    
  echo "</tr>";
}
  
 $SerialNo=$SerialNo+1; 
 
echo "</tbody></table>";
								?>
    
 