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
 $ID = mysqli_real_escape_string($connection, $_POST["ID"]); 
 
 $TherapyStatus = mysqli_real_escape_string($connection, $_POST["TherapyStatus"]); 
 if( $ID=='1')
 {
	  $PaitentID =" a.paitentid like '%' ";
 }
 else
 {
	 $PaitentID =" a.paitentid = '$ID' ";
 }
  $currentdate =date("Y-m-d H:i:s"); 	
 echo " <input type='text' name='myInput' id='myInput' class='form-control'  placeholder='Search...'  />";    
  
								// $result = mysqli_query($connection, " 
								
// SELECT a.bookingid, DATE_FORMAT(a.reviseddate,'%d-%m-%Y') AS Bookingdate ,
// TIME_FORMAT(a.revisedtime, '%h:%i %p') AS BookingTime, 
// CONCAT(b.paitentname,'[',b.mobileno,']') AS paitent,  
// d.consultationname,d.consultationcharge,c.username, e.locationname,
// b.mobileno,b.paitentname,c.doctorphone,ROUND(b.topay-b.receipt,0) AS OldDue, 
// ROUND(d.consultationcharge + b.topay-b.receipt,0)  TotalFee
// FROM  therapybookingdetails   AS a JOIN paitentmaster AS b 
// ON a.paitentid=b.paitentid JOIN usermaster AS c ON a.doctorid=c.userid
// JOIN consultationmaster AS d ON a.therapyid=d.consultationid JOIN locationmaster AS e
// ON a.location=e.locationcode WHERE bookingstatus NOT IN ('Closed','Cancelled')
// ");						

if($TherapyStatus=='Open')
{
	$result = mysqli_query($connection, "  

  SELECT a.bookinguniqueid, DATE_FORMAT(a.revisedtherapydate,'%d-%m-%Y') AS Bookingdate,a.revisedtherapytime,
c.paitentname,CONCAT(e.consultationname,' (Sittings-',a.totalsitting,')'),d.username,a.fees,
c.mobileno,d.mobileno
 FROM therapybookingmaster AS a 
JOIN therapybookingdetails AS b ON a.bookinguniqueid=b.bookinguniqueid
JOIN paitentmaster AS c ON a.paitentid=c.paitentid
JOIN usermaster AS d ON a.doctorid=d.userid
JOIN consultationmaster AS e ON a.therapyid=e.consultationid
WHERE a.therapystatus in('Booked','WIP','Scheduled') and  $PaitentID and therapystatus in('Booked','WIP','Scheduled')
GROUP BY a.bookinguniqueid, DATE_FORMAT(a.revisedtherapydate,'%d-%m-%Y'),a.revisedtherapytime,
c.paitentname,d.username,e.consultationname,
c.mobileno,d.mobileno,CONCAT(e.consultationname,' (Sittings-',a.totalsitting,')'),a.fees
 HAVING (SUM(totalsitings)-SUM(STATUS)) >0 order by a.revisedtherapydate desc, a.bookingid desc
 
");
}
else if ($TherapyStatus=='Completed')
{
	$result = mysqli_query($connection, "  

  SELECT a.bookinguniqueid, DATE_FORMAT(a.revisedtherapydate,'%d-%m-%Y') AS Bookingdate,a.revisedtherapytime,
c.paitentname,CONCAT(e.consultationname,' (Sittings-',a.totalsitting,')'),d.username,a.fees,
c.mobileno,d.mobileno
 FROM therapybookingmaster AS a 
JOIN therapybookingdetails AS b ON a.bookinguniqueid=b.bookinguniqueid
JOIN paitentmaster AS c ON a.paitentid=c.paitentid
JOIN usermaster AS d ON a.doctorid=d.userid
JOIN consultationmaster AS e ON a.therapyid=e.consultationid
WHERE a.therapystatus in('Closed') and  $PaitentID and therapystatus in('Closed')
GROUP BY a.bookinguniqueid, DATE_FORMAT(a.revisedtherapydate,'%d-%m-%Y'),a.revisedtherapytime,
c.paitentname,d.username,e.consultationname,
c.mobileno,d.mobileno,CONCAT(e.consultationname,' (Sittings-',a.totalsitting,')'),a.fees 
  order by a.revisedtherapydate desc, a.bookingid desc
");
}

else if ($TherapyStatus=='Cancelled')
{
	$result = mysqli_query($connection, "  

  SELECT a.bookinguniqueid, DATE_FORMAT(a.revisedtherapydate,'%d-%m-%Y') AS Bookingdate,a.revisedtherapytime,
c.paitentname,CONCAT(e.consultationname,' (Sittings-',a.totalsitting,')'),d.username,a.fees,
c.mobileno,d.mobileno
 FROM therapybookingmaster AS a 
JOIN therapybookingdetails AS b ON a.bookinguniqueid=b.bookinguniqueid
JOIN paitentmaster AS c ON a.paitentid=c.paitentid
JOIN usermaster AS d ON a.doctorid=d.userid
JOIN consultationmaster AS e ON a.therapyid=e.consultationid
WHERE a.therapystatus in('Cancelled') and  $PaitentID  and therapystatus in('Cancelled')
GROUP BY a.bookinguniqueid, DATE_FORMAT(a.revisedtherapydate,'%d-%m-%Y'),a.revisedtherapytime,
c.paitentname,d.username,e.consultationname,
c.mobileno,d.mobileno,CONCAT(e.consultationname,' (Sittings-',a.totalsitting,')'),a.fees 
  order by a.revisedtherapydate desc, a.bookingid desc
");
}
else if ($TherapyStatus=='All')
{
	$result = mysqli_query($connection, "  

  SELECT a.bookinguniqueid, DATE_FORMAT(a.revisedtherapydate,'%d-%m-%Y') AS Bookingdate,a.revisedtherapytime,
c.paitentname,CONCAT(e.consultationname,' (Sittings-',a.totalsitting,')'),d.username,a.fees,
c.mobileno,d.mobileno
 FROM therapybookingmaster AS a 
JOIN therapybookingdetails AS b ON a.bookinguniqueid=b.bookinguniqueid
JOIN paitentmaster AS c ON a.paitentid=c.paitentid
JOIN usermaster AS d ON a.doctorid=d.userid
JOIN consultationmaster AS e ON a.therapyid=e.consultationid
WHERE a.therapystatus in('Closed','Booked','Cancelled','WIP','Scheduled') and  $PaitentID  and 
therapystatus in('Closed','Booked','Cancelled','WIP','Scheduled')
GROUP BY a.bookinguniqueid, DATE_FORMAT(a.revisedtherapydate,'%d-%m-%Y'),a.revisedtherapytime,
c.paitentname,d.username,e.consultationname,
c.mobileno,d.mobileno,CONCAT(e.consultationname,' (Sittings-',a.totalsitting,')'),a.fees 
  order by a.revisedtherapydate desc, a.bookingid desc
");
}

 

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblTherapyRegister'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th hidden width='%' > ID </th>    	
		<th nowrap width='%'> Date</th>   
		<th width='%'>  Time </th> 
		<th width='%'> Paitent </th> 
		<th width='%'> Therapy</th> 		  		 
		<th width='%'> Doctor </th> 		
		<th width='%'> Fees</th> ";
if($ID=='1')
{
	echo "<th width='%'> </th> ";   
	if($TherapyStatus=='Open')
{
	
	
	echo "<th hidden width='%'>  </th>    
		<th width='%'>  </th>    
		<th width='%'>  </th> ";
}
}
		 echo "
		</tr> </thead> <tbody id='myTable'>";

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
   <td  width='%'>$data[6]</td>    ";
if($ID=='1')
{
	echo "
  
   <td hidden id='MobileNo' width='%'>$data[7]</td>
   <td hidden id='PaitentName' width='%'>$data[3]</td>
   <td hidden id='mobileno' width='%'>$data[8]</td> 
   <td onclick='GetPointID(this);'><a href='#modalTherapyClosure'  data-toggle='modal' >
   <i class='fa fa-2x fa-check-circle text-success'></i></a></td>";
   if($TherapyStatus=='Open')
{ 
   echo "
   
   <td   onclick='GetPointID(this)'><a href='#modalTherapyCancel' data-toggle='modal'  >
   <i class='fa fa-2x fa-minus-circle text-danger'></i></a></td>
   
   <td onclick='GetPointID(this)'><a href='#modalTherapyReschedule' data-toggle='modal'  >
   <i class='fa fa-2x  fa-calendar text-warning'></i></a></td>
   
   <td onclick='SendSMSPaitent(this)'> <i class='fa fa-2x  fa-envelope text-warning'></i></td>";
}

   }
   else if($ID<>'1')
{
	echo "<td onclick='GetPointID(this)'><a href='#modalTherapyClosure' data-toggle='modal'  >
	<i class='fa fa-2x  fa-eye text-warning'></i></a></td>";
}
    
    
  echo "</tr>";
  
 
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
								?>
    
 