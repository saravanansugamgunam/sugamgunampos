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
  
	 
	$result = mysqli_query($connection, "SELECT a.uniqueid, DATE_FORMAT(a.addedon,'%d-%m-%Y') Created,
  d.paitentname,d.mobileno,b.username, DATE_FORMAT(a.recomendeddate,'%d-%m-%Y') TherapyDate 
  FROM therapyrecomendation AS a 
  JOIN usermaster AS b ON a.doctorid=b.userid 
  JOIN paitentmaster AS d ON a.paitentid=d.paitentid
  WHERE a.currentstatus='Pending' 
  GROUP BY a.uniqueid, DATE_FORMAT(a.addedon,'%d-%m-%Y')  , 
  d.paitentname,d.mobileno,b.username, DATE_FORMAT(a.recomendeddate,'%d-%m-%Y') ORDER BY recomendeddate  
 
");
  

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblTherapyRegisterRecomnded'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th hidden width='%' > ID </th>    	
		<th nowrap width='%'> Date</th>    
		<th width='%'> Paitent </th> 
    <th width='%'> Mobile No </th> 
    <th width='%'> Doctor </th>  		  		 
    <th width='%'> Recomended Date</th>  	
    <th width='%'> Schedule</th> 	
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
  <td  hidden id='BookingID'  width='%' >$data[0]</td>
  <td nowrap id='TherapyDate' width='%'>$data[1]</td>  
   <td id='TherapyTime'  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td  id='TherapyName' width='%'>$data[5]</td>     
 
   <td onclick='GetPointIDRD(this)'>
   <a href='TherapyBookingAdvanceAuto.php?MID=30&RD=$data[0]#modal-close'  target='_blank' >
   <i class='fa fa-2x  fa-calendar text-warning'></i></a></td>
   
   <td   onclick='GetPointIDRD(this)'><a href='#modalTherapyCancelRecomended' data-toggle='modal'  >
   <i class='fa fa-2x fa-minus-circle text-danger'></i></a></td>
   ";

    
  echo "</tr>";
}
  
 $SerialNo=$SerialNo+1; 
 
echo "</tbody></table>";
								?>
    
 