<script>
$(document).ready(function() {
    // $("#myInput").on("keyup", function() {
    $("#myInputSL").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTableSL tr").filter(function() {
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
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $ID = mysqli_real_escape_string($connection, $_POST["ID"]); 
 $Period =  mysqli_real_escape_string($connection, $_POST["Period"]); 
 $Basedon =  mysqli_real_escape_string($connection, $_POST["Basedon"]); 
 $Status =  mysqli_real_escape_string($connection, $_POST["Status"]); 
 $TherapyStatus = 'Open'; 
 $currentdate =date("Y-m-d"); 
 
 if($Period=='Today')
 {
   $FromPeriod=$currentdate;
   $ToPeriod=$currentdate;

 }


 else if($Period=='Tomorrow')
 {
   $FromPeriod=date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $currentdate) ) ));
   $ToPeriod=date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $currentdate) ) ));

 }
 else if($Period=='CurrentMonth')
 {
   $FromPeriod=date('Y-m-01', strtotime($currentdate));
   $ToPeriod=date('Y-m-t', strtotime($currentdate)); 
 }
 else if($Period=='Next7Days')
 {
   $FromPeriod=$currentdate; 
   $ToPeriod= date('Y-m-d',(strtotime ( '+ 7 day' , strtotime ( $currentdate) ) ));
 }
 else if($Period=='Next14Days')
 {
   $FromPeriod=$currentdate; 
   $ToPeriod= date('Y-m-d',(strtotime ( '+14 day' , strtotime ( $currentdate) ) ));
 }
 else if($Period=='Next30Days')
 {
   $FromPeriod= $currentdate; 
   $ToPeriod= date('Y-m-d',(strtotime ( '+30 day' , strtotime ( $currentdate) ) ));
 }
 else if($Period=='Custom')
 {
   $FromPeriod = $FromDate;
   $ToPeriod=$ToDate;
 }
 else if($Period=='Pending')
 {
   $FromPeriod = date('Y-m-d',(strtotime ( '-360 day' , strtotime ( $currentdate) ) ));
   $ToPeriod=$currentdate;
 }
 else if($Period=='Yesterday')
 {
   $FromPeriod=date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $currentdate) ) ));
   $ToPeriod=date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $currentdate) ) ));

 } 
 else if($Period=='Last7Days')
 {
   $FromPeriod=date('Y-m-d',(strtotime ( '-7 day' , strtotime ( $currentdate) ) ));
   $ToPeriod= $currentdate; 
 }
 else if($Period=='Last14Days')
 {
   $FromPeriod=date('Y-m-d',(strtotime ( '-14 day' , strtotime ( $currentdate) ) ));
   $ToPeriod= $currentdate; 
 }
 else if($Period=='Last30Days')
 {
   $FromPeriod=date('Y-m-d',(strtotime ( '-30 day' , strtotime ( $currentdate) ) ));
   $ToPeriod= $currentdate; 
 }

 
 if( $ID=='99999')
 {
	  $PaitentID =" a.paitentid like '%' ";
 }
 else
 {
	 $PaitentID =" a.paitentid = '$ID' ";
 }
  $currentdate =date("Y-m-d H:i:s"); 	
 echo " <input type='text' name='myInputSL' id='myInputSL' class='form-control'  placeholder='Search...'  />";    
  

 if($Basedon=='BookingDate')
 {
  $DateFilter = " a.bookingdate BETWEEN '$FromPeriod' and '$ToPeriod' "; 
 }
 else
 {
  $DateFilter = " a.revisedtherapydate BETWEEN '$FromPeriod' and '$ToPeriod' "; 
 }

 if($Status=='All')
 {
  $StatusFilter = " a.therapystatus in('Booked','Scheduled','Closed') "; 
 }
 else if($Status=='Booked')
 {
  $StatusFilter = " f.CompletedSitting is null and a.therapystatus not in('Closed','Cancelled')  "; 
 }
 else if($Status=='InProgress')
 {
  $StatusFilter = " f.CompletedSitting is not null and a.therapystatus not in('Closed','Cancelled')  "; 
 }
 else if($Status=='Completed')
 {
   $StatusFilter = " f.CompletedSitting is not null  and a.therapystatus   in('Closed') "; 
 }
 else if($Status=='Cancelled')
 {
  $StatusFilter = " a.therapystatus in('Cancelled') "; 
 }


  $result = mysqli_query($connection, "


  SELECT  a.bookinguniqueid,DATE_FORMAT(a.bookingdate,'%d-%m-%y') AS bookingdate, 
  DATE_FORMAT(a.revisedtherapydate,'%d-%m-%y') AS revisedtherapydate,d.paitentname,d.mobileno ,
  c.username,e.consultationname,a.therapystatus, 
CONCAT( IFNULL(CompletedSitting,0),' / ', SUM(b.totalsitings)) AS Sittings,SUM(b.nettamount),SUM(b.discount) 
 FROM therapybookingmaster AS a  
 JOIN therapybookingdetails AS b ON a.bookinguniqueid=b.bookinguniqueid  
 JOIN usermaster AS c ON a.doctorid=c.userid
 JOIN paitentmaster AS d ON a.paitentid=d.paitentid
 JOIN consultationmaster AS e ON a.therapyid=e.consultationid
 LEFT JOIN (SELECT bookinguniqueid, IFNULL(count(sitting),0) AS CompletedSitting FROM therapyclosredetails 
 GROUP BY bookinguniqueid ) AS f
 ON a.bookinguniqueid=f.bookinguniqueid
 WHERE $DateFilter  and $StatusFilter
 GROUP BY  a.bookinguniqueid,DATE_FORMAT(a.bookingdate,'%d-%m-%y'), 
 DATE_FORMAT(a.revisedtherapydate,'%d-%m-%y'),d.paitentname,d.mobileno ,c.username,e.consultationname,a.therapystatus 
 ORDER BY a.bookingdate DESC ");
 
 

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblTherapyRegisterSL'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th  hidden  width='%' > ID </th>    	
		<th   width='%' > Booking Dt </th>    	
		<th nowrap width='%'>Therapy Dt</th>   
		 <th width='%'> Paitent </th> 
    <th width='%'> Mobile No </th> 
    <th width='%'> Doctor </th> 
		<th width='%'> Therapy</th> 		 
    <th width='%'> Status</th> 	
		<th width='%'> Sittings </th> 	 
		<th   width='%'> Total Amount </th>  
		<th width='%'> </th>
		<th width='%'> </th>
		<th width='%'> </th>
		";
 
		 echo "
		</tr> </thead> <tbody id='myTableSL'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden   id='BookingID'  width='%' >$data[0]</td>
  <td nowrap id='TherapyDate' width='%'>$data[1]</td>  
  <td nowrap id='DoctorCode' width='%'>$data[2]</td>  
   <td id='TherapyTime'  width='%'>$data[3]</td>   
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>     
   <td  id='TherapyName' width='%'>$data[6]</td>    
   <td  width='%'>$data[7]</td>
   <td  width='%'>$data[8]</td>
   <td   id='userid' width='%'>$data[9]</td> 
    
   ";
  
   if($data[7]=='Closed' || $data[7]=='Cancelled' )
    {
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
    }
    else{

   echo "
   <td hidden id='PaitentName' width='%'>$data[3]</td> 
   <td   onclick='GetScheduledTherapyID(this);'><a href='#modalTherapyClosure'  data-toggle='modal' >
   <i class='fa fa-2x fa-check-circle text-success'></i></a></td> 
   
   <td   onclick='GetScheduledTherapyID(this)'><a href='#modalTherapyCancel' data-toggle='modal'  >
   <i class='fa fa-2x fa-minus-circle text-danger'></i></a></td>
   
   <td onclick='GetScheduledTherapyID(this)'><a href='#modalTherapyReschedule' data-toggle='modal'  >
   <i class='fa fa-2x  fa-calendar text-warning'></i></a></td>
   
   <td onclick='SendSMSPaitent(this)'> <i class='fa fa-2x  fa-envelope text-warning'></i></td>";
  }
    
  echo "</tr>";
 
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
								?>