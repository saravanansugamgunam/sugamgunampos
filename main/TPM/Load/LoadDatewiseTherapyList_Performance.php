<style>
#tblTherapyList td,
#tblTherapyList th {
    border: 1px solid #ddd;
    padding: 8px;
}

tr td:first-child,
tr td:last-child {
    color: #359900;
    font-weight: bold;
}

#myTableSummary tr:first-child {
    font-weight: bold;
}
</style>
<script>
$(document).ready(function() {
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

$FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
$ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);

$Period =  mysqli_real_escape_string($connection, $_POST["Period"]);
$Basedon =  mysqli_real_escape_string($connection, $_POST["Basedon"]);

$Status =  mysqli_real_escape_string($connection, $_POST["Status"]);
$Therapist =  mysqli_real_escape_string($connection, $_POST["Therapist"]);

$Therapy =  mysqli_real_escape_string($connection, $_POST["Therapy"]);
$UploadStatus =  mysqli_real_escape_string($connection, $_POST["UploadStatus"]);
$Referedby =  mysqli_real_escape_string($connection, $_POST["Referedby"]);


if ($UploadStatus == 0) {
  $UploadStatus = "  ";
} else if ($UploadStatus == 1) {
  $UploadStatus = " and h.doccount >0 ";
} else {
  $UploadStatus = " and h.doccount is NULL ";
}


$currentdate = date("Y-m-d");
if ($Period == 'Today') {
  $FromPeriod = $currentdate;
  $ToPeriod = $currentdate;
} else if ($Period == 'Tomorrow') {
  $FromPeriod = date('Y-m-d', (strtotime('+1 day', strtotime($currentdate))));
  $ToPeriod = date('Y-m-d', (strtotime('+1 day', strtotime($currentdate))));
} else if ($Period == 'CurrentMonth') {
  $FromPeriod = date('Y-m-01', strtotime($currentdate));
  $ToPeriod = date('Y-m-t', strtotime($currentdate));
} else if ($Period == 'Next7Days') {
  $FromPeriod = $currentdate;
  $ToPeriod = date('Y-m-d', (strtotime('+ 7 day', strtotime($currentdate))));
} else if ($Period == 'Next14Days') {
  $FromPeriod = $currentdate;
  $ToPeriod = date('Y-m-d', (strtotime('+14 day', strtotime($currentdate))));
} else if ($Period == 'Next30Days') {
  $FromPeriod = $currentdate;
  $ToPeriod = date('Y-m-d', (strtotime('+30 day', strtotime($currentdate))));
} else if ($Period == 'Custom') {
  $FromPeriod = $FromDate;
  $ToPeriod = $ToDate;
} else if ($Period == 'Pending') {
  $FromPeriod = date('Y-m-d', (strtotime('-360 day', strtotime($currentdate))));
  $ToPeriod = $currentdate;
} else if ($Period == 'Yesterday') {
  $FromPeriod = date('Y-m-d', (strtotime('-1 day', strtotime($currentdate))));
  $ToPeriod = date('Y-m-d', (strtotime('-1 day', strtotime($currentdate))));
} else if ($Period == 'Last7Days') {
  $FromPeriod = date('Y-m-d', (strtotime('-7 day', strtotime($currentdate))));
  $ToPeriod = $currentdate;
} else if ($Period == 'Last14Days') {
  $FromPeriod = date('Y-m-d', (strtotime('-14 day', strtotime($currentdate))));
  $ToPeriod = $currentdate;
} else if ($Period == 'Last30Days') {
  $FromPeriod = date('Y-m-d', (strtotime('-30 day', strtotime($currentdate))));
  $ToPeriod = $currentdate;
}



echo " <input type='text' name='myInput' id='myInput' class='form-control'  placeholder='Search...'  />";

$result1 = mysqli_query($connection, " 


select 'Total', sum(totaltherapies),round(sum(totalamount),0),sum(pendingtherapies),
round(sum(pendingamount),0),sum(bookedtherapies),round(sum(bookedamount),0),
sum(closedtherapies),round(sum(closedamount),0),sum(cancelledtherapies),round(sum(cancelledamount),0) from 
(
  SELECT   c.username ,COUNT(*) as totaltherapies,round(SUM(a.nettamount),0) as totalamount,
  0 as pendingtherapies,0 as pendingamount,
  0 as bookedtherapies,0 as bookedamount,
0 as closedtherapies,0 as closedamount,
0 as cancelledtherapies,0 as cancelledamount
   FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid JOIN usermaster AS c ON a.doctorid=c.userid LEFT 
JOIN (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a LEFT 
JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE uniqueid IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY bookingitemid) AS d ON a.bookingid =d.bookingitemid 
JOIN usermaster AS e ON a.referedbydoctorid=e.userid LEFT JOIN (SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount, 
SUM(oldtherapist-newtherapist) AS TherapistChange FROM therapyreschedulelog WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY therapyuniqueno,therapyitemid ) AS f ON a.bookinguniqueid =f.therapyuniqueno
AND a.`bookingid`=f.`therapyitemid` WHERE bookinguniqueid IN(SELECT bookinguniqueid FROM therapybookingmaster) AND c.userid  like '$Therapist'  
AND reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' 
and a.referedbydoctorid like '$Referedby' and a.therapyid like '$Therapy'  
GROUP BY c.username    

union 


SELECT   c.username ,0,0  ,COUNT(*) ,SUM(a.nettamount) ,0 as bookedtherapies,0 as bookedamount,
0 as closedtherapies,0 as closedamount,
0 as cancelledtherapies,0 as cancelledamount
   FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid JOIN usermaster AS c ON a.doctorid=c.userid LEFT 
JOIN (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a LEFT 
JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE uniqueid IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY bookingitemid) AS d ON a.bookingid =d.bookingitemid 
JOIN usermaster AS e ON a.referedbydoctorid=e.userid LEFT JOIN (SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount, 
SUM(oldtherapist-newtherapist) AS TherapistChange FROM therapyreschedulelog WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY therapyuniqueno,therapyitemid ) AS f ON a.bookinguniqueid =f.therapyuniqueno
AND a.`bookingid`=f.`therapyitemid` WHERE bookinguniqueid IN(SELECT bookinguniqueid FROM therapybookingmaster) AND c.userid  like '$Therapist' 
 AND newstatus='Pending'
AND reviseddate BETWEEN '$FromPeriod' and '$ToPeriod'   
and a.referedbydoctorid like '$Referedby' and a.therapyid like '$Therapy'  
GROUP BY c.username    

UNION


SELECT   c.username ,0,0 ,0,0  ,COUNT(*) as bookedtherapies,SUM(a.nettamount) as bookedamount,
0 as closedtherapies,0 as closedamount,
0 as cancelledtherapies,0 as cancelledamount
   FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid JOIN usermaster AS c ON a.doctorid=c.userid LEFT 
JOIN (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a LEFT 
JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE uniqueid IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY bookingitemid) AS d ON a.bookingid =d.bookingitemid 
JOIN usermaster AS e ON a.referedbydoctorid=e.userid LEFT JOIN (SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount, 
SUM(oldtherapist-newtherapist) AS TherapistChange FROM therapyreschedulelog WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY therapyuniqueno,therapyitemid ) AS f ON a.bookinguniqueid =f.therapyuniqueno
AND a.`bookingid`=f.`therapyitemid` WHERE bookinguniqueid IN(SELECT bookinguniqueid FROM therapybookingmaster) AND c.userid  like '$Therapist'  AND newstatus='Booked'
AND reviseddate BETWEEN '$FromPeriod' and '$ToPeriod'   
and a.referedbydoctorid like '$Referedby' and a.therapyid like '$Therapy'  
GROUP BY c.username    

UNION

 SELECT   c.username ,0,0,0,0  ,0,0,COUNT(*),SUM(a.nettamount),0,0   FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid JOIN usermaster AS c ON a.doctorid=c.userid LEFT 
JOIN (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a LEFT 
JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE uniqueid IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY bookingitemid) AS d ON a.bookingid =d.bookingitemid 
JOIN usermaster AS e ON a.referedbydoctorid=e.userid LEFT JOIN (SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount, 
SUM(oldtherapist-newtherapist) AS TherapistChange FROM therapyreschedulelog WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY therapyuniqueno,therapyitemid ) AS f ON a.bookinguniqueid =f.therapyuniqueno
AND a.`bookingid`=f.`therapyitemid` WHERE bookinguniqueid IN(SELECT bookinguniqueid FROM therapybookingmaster ) AND c.userid like '$Therapist'  AND newstatus='Cancelled'
AND reviseddate BETWEEN '$FromPeriod' and '$ToPeriod'   
and a.referedbydoctorid like '$Referedby' and a.therapyid like '$Therapy'  
GROUP BY c.username  

UNION 

 SELECT   c.username  ,0,0,0,0  ,0,0,0,0, COUNT(*),SUM(a.nettamount)    FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid JOIN usermaster AS c ON a.doctorid=c.userid LEFT 
JOIN (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a LEFT 
JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE uniqueid IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY bookingitemid) AS d ON a.bookingid =d.bookingitemid 
JOIN usermaster AS e ON a.referedbydoctorid=e.userid LEFT JOIN (SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount, 
SUM(oldtherapist-newtherapist) AS TherapistChange FROM therapyreschedulelog WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY therapyuniqueno,therapyitemid ) AS f ON a.bookinguniqueid =f.therapyuniqueno
AND a.`bookingid`=f.`therapyitemid` WHERE bookinguniqueid IN(SELECT bookinguniqueid FROM therapybookingmaster ) AND c.userid like '$Therapist'  AND newstatus='Closed'
AND reviseddate BETWEEN '$FromPeriod' and '$ToPeriod'   
and a.referedbydoctorid like '$Referedby' and a.therapyid like '$Therapy' 
GROUP BY c.username ) as a  

union 




select username,sum(totaltherapies),round(sum(totalamount),0),
sum(pendingtherapies),round(sum(pendingamount),0),sum(bookedtherapies),
round(sum(bookedamount),0),sum(closedtherapies),
round(sum(closedamount),0),sum(cancelledtherapies),round(sum(cancelledamount),0) from 
(
SELECT   c.username  ,COUNT(*) as totaltherapies,SUM(a.nettamount) as totalamount,
0 as pendingtherapies,0 as pendingamount,
0 as bookedtherapies,0 as bookedamount,
0 as closedtherapies,0 as closedamount,
0 as cancelledtherapies,0 as cancelledamount
   FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid JOIN usermaster AS c ON a.doctorid=c.userid LEFT 
JOIN (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a LEFT 
JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE uniqueid IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY bookingitemid) AS d ON a.bookingid =d.bookingitemid 
JOIN usermaster AS e ON a.referedbydoctorid=e.userid LEFT JOIN (SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount, 
SUM(oldtherapist-newtherapist) AS TherapistChange FROM therapyreschedulelog WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY therapyuniqueno,therapyitemid ) AS f ON a.bookinguniqueid =f.therapyuniqueno
AND a.`bookingid`=f.`therapyitemid` WHERE bookinguniqueid IN(SELECT bookinguniqueid FROM therapybookingmaster) AND c.userid  like '$Therapist'   
AND reviseddate BETWEEN '$FromPeriod' and '$ToPeriod'   
and a.referedbydoctorid like '$Referedby' and a.therapyid like '$Therapy'  
GROUP BY c.username   

union

SELECT   c.username, 0,0 ,COUNT(*), SUM(a.nettamount),
0 as bookedtherapies, 0 as bookedamount,
0 as closedtherapies,0 as closedamount,
0 as cancelledtherapies,0 as cancelledamount
   FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid JOIN usermaster AS c ON a.doctorid=c.userid LEFT 
JOIN (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a LEFT 
JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE uniqueid IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY bookingitemid) AS d ON a.bookingid =d.bookingitemid 
JOIN usermaster AS e ON a.referedbydoctorid=e.userid LEFT JOIN (SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount, 
SUM(oldtherapist-newtherapist) AS TherapistChange FROM therapyreschedulelog WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY therapyuniqueno,therapyitemid ) AS f ON a.bookinguniqueid =f.therapyuniqueno
AND a.`bookingid`=f.`therapyitemid` WHERE bookinguniqueid IN(SELECT bookinguniqueid FROM therapybookingmaster ) AND c.userid  like '$Therapist'  AND 
newstatus='Pending'
AND reviseddate BETWEEN '$FromPeriod' and '$ToPeriod'   
and a.referedbydoctorid like '$Referedby' and a.therapyid like '$Therapy'  
GROUP BY c.username  


union

SELECT   c.username, 0,0, 0,0  ,COUNT(*) as bookedtherapies,SUM(a.nettamount) as bookedamount,
 
0 as closedtherapies,0 as closedamount,
0 as cancelledtherapies,0 as cancelledamount
   FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid JOIN usermaster AS c ON a.doctorid=c.userid LEFT 
JOIN (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a LEFT 
JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE uniqueid IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY bookingitemid) AS d ON a.bookingid =d.bookingitemid 
JOIN usermaster AS e ON a.referedbydoctorid=e.userid LEFT JOIN (SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount, 
SUM(oldtherapist-newtherapist) AS TherapistChange FROM therapyreschedulelog WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY therapyuniqueno,therapyitemid ) AS f ON a.bookinguniqueid =f.therapyuniqueno
AND a.`bookingid`=f.`therapyitemid` WHERE bookinguniqueid IN(SELECT bookinguniqueid FROM therapybookingmaster ) AND c.userid  like '$Therapist'  AND 
newstatus='Booked'
AND reviseddate BETWEEN '$FromPeriod' and '$ToPeriod'   
and a.referedbydoctorid like '$Referedby' and a.therapyid like '$Therapy'  
GROUP BY c.username    


UNION

 SELECT   c.username  ,0,0,0,0, 0,0 ,COUNT(*),SUM(a.nettamount),0,0   FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid JOIN usermaster AS c ON a.doctorid=c.userid LEFT 
JOIN (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a LEFT 
JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE uniqueid IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY bookingitemid) AS d ON a.bookingid =d.bookingitemid 
JOIN usermaster AS e ON a.referedbydoctorid=e.userid LEFT JOIN (SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount, 
SUM(oldtherapist-newtherapist) AS TherapistChange FROM therapyreschedulelog WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY therapyuniqueno,therapyitemid ) AS f ON a.bookinguniqueid =f.therapyuniqueno
AND a.`bookingid`=f.`therapyitemid` WHERE bookinguniqueid IN(SELECT bookinguniqueid FROM therapybookingmaster) AND c.userid like '$Therapist'  AND newstatus='Cancelled'
AND reviseddate BETWEEN '$FromPeriod' and '$ToPeriod'   
and a.referedbydoctorid like '$Referedby' and a.therapyid like '$Therapy'  
GROUP BY c.username  

UNION 

 SELECT   c.username  ,0,0 ,0,0,0,0, 0,0 , COUNT(*),SUM(a.nettamount)    FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid JOIN usermaster AS c ON a.doctorid=c.userid LEFT 
JOIN (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a LEFT 
JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE uniqueid IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY bookingitemid) AS d ON a.bookingid =d.bookingitemid 
JOIN usermaster AS e ON a.referedbydoctorid=e.userid LEFT JOIN (SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount, 
SUM(oldtherapist-newtherapist) AS TherapistChange FROM therapyreschedulelog WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM therapybookingdetails 
WHERE reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' ) GROUP BY therapyuniqueno,therapyitemid ) AS f ON a.bookinguniqueid =f.therapyuniqueno
AND a.`bookingid`=f.`therapyitemid` WHERE bookinguniqueid IN(SELECT bookinguniqueid FROM therapybookingmaster ) 
AND c.userid like '$Therapist'  AND newstatus='Closed'
AND reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' 
and a.referedbydoctorid like '$Referedby' and a.therapyid like '$Therapy'  
GROUP BY c.username ) as a group by username  order by 3 desc
 
");


//echo "<table id='tblProject' class='tblMasters'>";
echo "  <table id='tblTherapyList'  border='1' style='border-collapse:collapse;' 
   class='  table-bordered' width='80%'>";
echo " <thead><tr>       
    <th width='%' rowspan=2>Therapist</a></th>        
		<th width='%'  colspan=2 >Total Therapies</a></th>        
		<th width='%'  colspan=2 >Pending</a></th>        
		<th width='%'  colspan=2 >Booked</a></th>        
		<th width='%' colspan=2  >Cancelled</a></th>     
		<th width='%' colspan=2  >Completed</a></th>     
        </tr> 
        <tr>                
		<th width='%'  >Therapies</a></th>        
		<th width='%'   >Amount</a></th>     

    <th width='%'  >Therapies</a></th>        
		<th width='%'   >Amount</a></th>     
		    
		<th width='%'  >Therapies</a></th>        
		<th width='%'   >Amount</a></th>  
           
		<th width='%'  >Therapies</a></th>        
		<th width='%'   >Amount</a></th> 

		<th width='%'  >Therapies</a></th>        
		<th width='%'   >Amount</a></th>     
        
        </tr> 
        
        </thead> <tbody id='myTableSummary'>";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result1)) {
  echo "
    <tr> 
    <td width='%'  >$data[0]</td>
    <td width='%' style='text-align:right;'>$data[1]</td>  
    <td width='%' style='text-align:right;'>$data[2]</td>   
    <td width='%' style='text-align:right;'>$data[3]</td>     
    <td width='%' style='text-align:right;'>$data[4]</td>     
    <td width='%' style='text-align:right;'>$data[5]</td>     
    <td width='%' style='text-align:right;'>$data[6]</td> 
         
    <td width='%' style='text-align:right;'>$data[7]</td>     
    <td width='%' style='text-align:right;'>$data[8]</td> 
    
    <td width='%' style='text-align:right;'>$data[9]</td>     
    <td width='%' style='text-align:right;'>$data[10]</td>

    
    
    ";
  echo "</tr>";
  $SerialNo = $SerialNo + 1;
}
echo "</tbody>
    </table>";


echo "<br>";

$result = mysqli_query($connection, " 
  
 
SELECT a.bookingid,a.therapyid,a.doctorid,b.consultationname,a.totalsitings,DATE_FORMAT(reviseddate,'%d-%m-%Y') AS reviseddate,
d.timeslot, c.username, e.username,
a.newstatus,IF(a.newstatus='Closed',DATE_FORMAT(a.closingdate,'%d-%m-%Y'),'') AS Closingdate,
a.rate,a.discount,a.nettamount ,DATE_FORMAT(a.bookingdate,'%d-%m-%Y'),a.bookinguniqueid,Reschedulecount,TherapistChange,
CONCAT(g.paitentname,' <br>[',g.mobileno,']'),IFNULL(h.doccount,0)
FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
JOIN usermaster AS c ON a.doctorid=c.userid 
LEFT JOIN (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a 
LEFT JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE 
uniqueid IN(SELECT bookinguniqueid FROM 
therapybookingdetails where  reviseddate BETWEEN  '$FromPeriod' and '$ToPeriod'  ) 
GROUP BY bookingitemid) AS d ON  a.bookingid =d.bookingitemid  
JOIN usermaster AS e ON a.referedbydoctorid=e.userid  

LEFT JOIN 
(SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount,
SUM(oldtherapist-newtherapist) AS TherapistChange FROM 
therapyreschedulelog  WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM 
therapybookingdetails where  reviseddate BETWEEN  '$FromPeriod' and '$ToPeriod'  ) GROUP BY therapyuniqueno,therapyitemid ) AS f 
ON a.bookinguniqueid =f.therapyuniqueno AND a.`bookingid`=f.`therapyitemid`
JOIN paitentmaster AS g ON a.paitentid=g.paitentid

left join (select referenceid,IFNULL(count(*),0) as doccount from paitentdocumentmaster group by referenceid) as h on a.bookingid = h.referenceid

WHERE   bookinguniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster   ) and  c.userid like '$Therapist'  
AND reviseddate BETWEEN '$FromPeriod' and '$ToPeriod' and a.newstatus like '$Status' 
and a.referedbydoctorid like '$Referedby' and a.therapyid like '$Therapy'  $UploadStatus 

GROUP BY a.bookingid,a.therapyid,b.consultationname,reviseddate,c.username, a.rate,a.discount,a.nettamount ,d.timeslot,
e.username,a.newstatus,a.closingdate,a.bookingdate ,a.paitentid,h.doccount
ORDER BY a.newstatus,reviseddate 

 
    
");



//echo "<table id='tblProject' class='tblMasters'>";
echo "  <table id='tblTherapyList'  border='1' style='border-collapse:collapse;' 
   class='  table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
    <th width='%' hidden >ID</a></th>        
		<th width='%' hidden >Therapy ID</a></th>        
		<th width='%' hidden >Doctor ID</a></th>        
		<th width='%'   >Paitent</a></th>        
		<th width='%'>Therapy</a></th>     
		<th width='%' hidden > Sittings</a></th>    
		<th width='%'> Booking Date</a></th>    
		<th width='%'> Therapy Date</a></th>    
		<th width='%'> Timing</a></th>    
		<th width='%'> Therapist</a></th>    
		<th width='%'> Referedby</a></th>    
		<th width='%'> Status</a></th>    
		<th width='%'> Log</a></th>    
		<th width='%'  > Completed on</a></th>    
		<th width='%' hidden> Rate</a></th>    
		<th width='%' hidden> Discount</a></th>     
		<th width='%'> Total</a></th>
		<th width='%'>  </th>  
		<th width='%'>  </th> ";

echo "
		</tr> </thead> <tbody id='myTable'>";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td  hidden  id='BookingID'  width='%' >$data[0]</td>
  <td hidden nowrap id='TherapyDate' width='%'>$data[1]</td>  
   <td hidden id='TherapyTime'  width='%'>$data[2]</td>   
   <td width='%'>$data[18]</td>     
   <td width='%'>$data[3]</td>     
   <td hidden width='%'>$data[4]</td>     
   <td  width='%'>$data[14]</td>     

   <td nowrap id='TherapyName' width='%'>$data[5]</td>    
   <td  width='%'>$data[6]</td>     
   <td  width='%'>$data[7]</td>     
   <td  width='%'>$data[8]</td> 
   
   ";

  if ($data[9] == 'Booked') {
    echo "<td bgcolor='#02c1f2' width='%'>Booked</td> ";
  } else if ($data[9] == 'Closed') {
    echo "<td bgcolor='#51dc8b' width='%'>Completed</td> ";
  } else if ($data[9] == 'Cancelled') {
    echo "<td bgcolor='#ed796b' width='%'>Cancelled</td> ";
  } else if ($data[9] == 'Pending') {
    echo "<td bgcolor='red' width='%'>Pending</td> ";
  }



  if ($data[9] == 'Closed') {
    echo "<td ></td> ";
  } else if ($data[9] == 'Cancelled') {
    echo "<td bgcolor='#ed796b' width='%' onclick='GetPointID($data[0],$data[1],$data[2],$data[13],$data[15]);LoadTherayCancellation();'>
    <a href='#modalCancelledDetails'  data-toggle='modal' >
    Log</i></a>
     </td> ";
  } else {
    if ($data[16] == 0) {
      echo "<td ></td> ";
    } else {
      if ($data[17] == 0) {
        echo "<td bgcolor='#eaca64' width='%'  onclick='LoadTherayRescheduleDetails($data[0],$data[15]);'>
        <a href='#modalRescheduledDetails'  data-toggle='modal' >Rescheduled($data[16])</a></td> ";
      } else {
        echo "<td bgcolor='#f29d00' width='%'  onclick='LoadTherayRescheduleDetails($data[0],$data[15]);'>
        <a href='#modalRescheduledDetails'  data-toggle='modal' >Rescheduled($data[16])</a></td> ";
      }
    }
  }


  echo "<td   width='%'>$data[10]</td>     
   <td hidden width='%'>$data[11]</td>     
   <td hidden width='%'>$data[12]</td>
   <td  width='%'>$data[13]</td>
   
   <td align='center' style='color:#009ad9' >
<a href='SaleBillView.php?invoice=$data[15]' target='_blank' >
<i class='fa fa-2x fa-eye' title='View'></i></a></td>";
  if ($data[19] > 0) {
    echo "<td align='center'  onclick='LoadDocumentList($data[0])' > 
<a href='#modalDocumentList'  data-toggle='modal' ><i style='color:#16825d' class='fa fa-file
' title='View'></i></a>
 </td>";
  } else {
    echo "<td align='center' style='color:#e9e9e9'  > 
    <i class='fa fa-file
    ' title='View'></i>
 </td>";
  }


  echo "</tr>";



  $SerialNo = $SerialNo + 1;
}
echo "</tbody>
</table>";
?>