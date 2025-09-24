<style>
  #tblTherapyList td, #tblTherapyList th {
  border: 1px solid #ddd;
  padding: 8px;
}

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
  
 
  
 // echo "1";
 $PaitentID = mysqli_real_escape_string($connection, $_POST["ID"]); 
  
 
  $currentdate =date("Y-m-d H:i:s"); 	
 echo " <input type='text' name='myInput' id='myInput' class='form-control'  placeholder='Search...'  />";    
  
	$result = mysqli_query($connection, " 
   
  SELECT a.bookingid,a.bookinguniqueid,a.doctorid,b.consultationname,a.totalsitings,DATE_FORMAT(reviseddate,'%d-%m-%Y') AS reviseddate,
  d.timeslot, c.username, e.username,
a.bookingstatus,IF(a.bookingstatus='Closed',DATE_FORMAT(a.closingdate,'%d-%m-%Y'),'') AS Closingdate,
 a.rate,a.discount,a.nettamount 
  FROM therapybookingdetails AS a 
  JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
  JOIN usermaster AS c ON a.doctorid=c.userid 
  LEFT JOIN (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a 
  LEFT JOIN timeslotdetails AS b ON a.timeslotid=b.id  
  
  GROUP BY bookingitemid) AS d ON  a.bookingid =d.bookingitemid  
  JOIN usermaster AS e ON a.referedbydoctorid=e.userid   
  WHERE a.paitentid='$PaitentID'
  GROUP BY a.bookingid,a.bookinguniqueid,b.consultationname,reviseddate,c.username, a.rate,a.discount,a.nettamount ,d.timeslot,
  e.username,a.bookingstatus,a.closingdate
  ORDER BY reviseddate
  
 
    
"); 

 

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblTherapyList'  border='1' style='border-collapse:collapse;' 
   class='  table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
    <th width='%' hidden  >ID</a></th>        
		<th width='%' hidden  >Therapy ID</a></th>        
		<th width='%' hidden  >Doctor ID</a></th>        
		<th width='%'>Therapy</a></th>     
		<th width='%'> Sittings</a></th>    
		<th width='%'> Date</a></th>    
		<th width='%'> Timing</a></th>    
		<th width='%'> Therapist</a></th>    
		<th width='%'> Referedby</a></th>    
		<th width='%'> Status</a></th>         
		<th width='%'> Rate</a></th>    
		<th width='%'> Discount</a></th>     
		<th width='%'> Total</a></th>
		<th width='%'>  </th> 
     
		</tr> </thead> <tbody id='myTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td  hidden  id='BookingID'  width='%' >$data[0]</td>
  <td hidden   nowrap id='TherapyDate' width='%'>$data[1]</td>  
   <td hidden  id='TherapyTime'  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td  id='TherapyName' width='%'>$data[5]</td>    
   <td  width='%'>$data[6]</td>     
   <td  width='%'>$data[7]</td>     
   <td  width='%'>$data[8]</td>      
   <td  width='%'>$data[9]</td>       
   <td  width='%'>$data[11]</td>     
   <td  width='%'>$data[12]</td>
   <td  width='%'>$data[13]</td> ";
 if($data[9]=='Recomended' )
 {
echo " <td   onclick='DeleteTherapy($data[0],$data[1]);'> 
<i class='fa fa-2x fa-minus-circle text-warning'></i> </td>";
 }
 else
{
  echo " <td> </td>";
}
     

 echo "</tr>";
  
 
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
								?>
    
 