<style>
  #tblTherapyList td,
  #tblTherapyList th {
    border: 1px solid #ddd;
    padding: 8px;
  }
</style>


<style>
       
     

        #tblTherapyListSummary tbody tr:nth-child(1) * {
  background-color:rgb(157, 167, 252) !important;
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



// echo "1";
$ID = mysqli_real_escape_string($connection, $_POST["ID"]);

if ($ID == '1') {
  $PaitentID = " a.paitentid like '%' ";
} else {
  $PaitentID = " a.paitentid = '$ID' ";
}
$currentdate = date("Y-m-d H:i:s");



$resultsummary = mysqli_query($connection, "  
 
 
SELECT 
'Total',SUM(Booked) AS Booked,SUM(Cancelled) AS Cancelled,SUM(Completed) AS Completed, SUM(Pending) AS Pending, 
'-' AS 'Rate/Sitting',SUM(Gross) AS Gross, SUM(Discount) AS Discount, SUM(Nett) Nett 
FROM 
(SELECT 
 IFNULL(consultationname, 'Total') , SUM(Booked) AS Booked, SUM(Cancelled) AS Cancelled, SUM(Completed) AS Completed, SUM(Pending) AS Pending, 
rate AS 'Rate/Sitting',Gross, Discount, Nett

FROM (SELECT  b.consultationname,COUNT(a.totalsitings) AS Booked, 0 AS Cancelled ,0 AS Completed,0 AS Pending,
a.bookingstatus,a.rate,
SUM(a.rate) AS Gross,SUM(a.discount) AS Discount,SUM(a.nettamount) AS Nett
FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
JOIN usermaster AS c ON a.doctorid=c.userid 
LEFT JOIN (SELECT bookingitemid,timeslot AS timeslot FROM timeslotallocation AS a 
LEFT JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE 
uniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') 
GROUP BY bookingitemid) AS d ON  a.bookingid =d.bookingitemid  
JOIN usermaster AS e ON a.referedbydoctorid=e.userid 
LEFT JOIN 
(SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount,
SUM(oldtherapist-newtherapist) AS TherapistChange FROM 
therapyreschedulelog  WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') GROUP BY therapyuniqueno,therapyitemid ) AS f 
ON a.bookinguniqueid =f.therapyuniqueno AND a.`bookingid`=f.`therapyitemid`


LEFT JOIN (SELECT referenceid,COUNT(*) AS doccount FROM paitentdocumentmaster GROUP BY referenceid) AS h ON a.bookingid = h.referenceid
LEFT JOIN (SELECT a.bookinguniqueid AS Adduniqueid,b.username FROM therapybookingmaster AS a LEFT JOIN  usermaster AS b ON a.addedby = b.userid GROUP BY  bookinguniqueid,b.username) AS g ON 
g.Adduniqueid = a.`bookinguniqueid`
 
WHERE  a.paitentid='$ID'   AND bookinguniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') AND   a.bookingstatus IN('Booked','Cancelled','Closed')
GROUP BY b.consultationname,a.bookingstatus 

UNION 

SELECT  b.consultationname,0,COUNT(a.totalsitings) AS Cancelled ,0 AS Completed,0,
a.bookingstatus,a.rate AS 'Rate/Sitting',
SUM(a.rate),SUM(a.discount),SUM(a.nettamount) 
FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
JOIN usermaster AS c ON a.doctorid=c.userid 
LEFT JOIN (SELECT bookingitemid,timeslot AS timeslot FROM timeslotallocation AS a 
LEFT JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE 
uniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') 
GROUP BY bookingitemid) AS d ON  a.bookingid =d.bookingitemid  
JOIN usermaster AS e ON a.referedbydoctorid=e.userid 
LEFT JOIN 
(SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount,
SUM(oldtherapist-newtherapist) AS TherapistChange FROM 
therapyreschedulelog  WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') GROUP BY therapyuniqueno,therapyitemid ) AS f 
ON a.bookinguniqueid =f.therapyuniqueno AND a.`bookingid`=f.`therapyitemid`


LEFT JOIN (SELECT referenceid,COUNT(*) AS doccount FROM paitentdocumentmaster GROUP BY referenceid) AS h ON a.bookingid = h.referenceid
LEFT JOIN (SELECT a.bookinguniqueid AS Adduniqueid,b.username FROM therapybookingmaster AS a LEFT JOIN  usermaster AS b ON a.addedby = b.userid GROUP BY  bookinguniqueid,b.username) AS g ON 
g.Adduniqueid = a.`bookinguniqueid`
 
WHERE  a.paitentid='$ID'   AND bookinguniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') AND   a.bookingstatus = 'Cancelled'
GROUP BY b.consultationname,a.bookingstatus 


UNION 

SELECT  b.consultationname,0,0,COUNT(a.totalsitings) AS Completed,0,
a.bookingstatus,a.rate AS 'Rate/Sitting',
SUM(a.rate),SUM(a.discount),SUM(a.nettamount) 
FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
JOIN usermaster AS c ON a.doctorid=c.userid 
LEFT JOIN (SELECT bookingitemid,timeslot AS timeslot FROM timeslotallocation AS a 
LEFT JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE 
uniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') 
GROUP BY bookingitemid) AS d ON  a.bookingid =d.bookingitemid  
JOIN usermaster AS e ON a.referedbydoctorid=e.userid 
LEFT JOIN 
(SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount,
SUM(oldtherapist-newtherapist) AS TherapistChange FROM 
therapyreschedulelog  WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') GROUP BY therapyuniqueno,therapyitemid ) AS f 
ON a.bookinguniqueid =f.therapyuniqueno AND a.`bookingid`=f.`therapyitemid`


LEFT JOIN (SELECT referenceid,COUNT(*) AS doccount FROM paitentdocumentmaster GROUP BY referenceid) AS h ON a.bookingid = h.referenceid
LEFT JOIN (SELECT a.bookinguniqueid AS Adduniqueid,b.username FROM therapybookingmaster AS a LEFT JOIN  usermaster AS b ON a.addedby = b.userid GROUP BY  bookinguniqueid,b.username) AS g ON 
g.Adduniqueid = a.`bookinguniqueid`
 
WHERE  a.paitentid='$ID'   AND bookinguniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') AND   a.bookingstatus = 'Closed'
GROUP BY b.consultationname,a.bookingstatus


UNION 

SELECT  b.consultationname,0,0,0,COUNT(a.totalsitings) AS Pending,
a.bookingstatus,a.rate AS 'Rate/Sitting',
SUM(a.rate),SUM(a.discount),SUM(a.nettamount) 
FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
JOIN usermaster AS c ON a.doctorid=c.userid 
LEFT JOIN (SELECT bookingitemid,timeslot AS timeslot FROM timeslotallocation AS a 
LEFT JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE 
uniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') 
GROUP BY bookingitemid) AS d ON  a.bookingid =d.bookingitemid  
JOIN usermaster AS e ON a.referedbydoctorid=e.userid 
LEFT JOIN 
(SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount,
SUM(oldtherapist-newtherapist) AS TherapistChange FROM 
therapyreschedulelog  WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') GROUP BY therapyuniqueno,therapyitemid ) AS f 
ON a.bookinguniqueid =f.therapyuniqueno AND a.`bookingid`=f.`therapyitemid`


LEFT JOIN (SELECT referenceid,COUNT(*) AS doccount FROM paitentdocumentmaster GROUP BY referenceid) AS h ON a.bookingid = h.referenceid
LEFT JOIN (SELECT a.bookinguniqueid AS Adduniqueid,b.username FROM therapybookingmaster AS a LEFT JOIN  usermaster AS b ON a.addedby = b.userid GROUP BY  bookinguniqueid,b.username) AS g ON 
g.Adduniqueid = a.`bookinguniqueid`
 
WHERE  a.paitentid='$ID'   AND bookinguniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') AND   a.bookingstatus = 'Booked'
GROUP BY b.consultationname,a.bookingstatus) AS a 

 

GROUP BY consultationname,rate ) AS a 

UNION 
 
 
 
 
 

-- ---------------------------------------
 
SELECT 
 IFNULL(consultationname, 'Total') , SUM(Booked) AS Booked, SUM(Cancelled) AS Cancelled, SUM(Completed) AS Completed, SUM(Pending) AS Pending, 
rate AS 'Rate/Sitting',Gross, Discount, Nett

FROM (SELECT  b.consultationname,COUNT(a.totalsitings) AS Booked, 0 AS Cancelled ,0 AS Completed,0 AS Pending,
a.bookingstatus,a.rate,
SUM(a.rate) AS Gross,SUM(a.discount) AS Discount,SUM(a.nettamount) AS Nett
FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
JOIN usermaster AS c ON a.doctorid=c.userid 
LEFT JOIN (SELECT bookingitemid,timeslot AS timeslot FROM timeslotallocation AS a 
LEFT JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE 
uniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') 
GROUP BY bookingitemid) AS d ON  a.bookingid =d.bookingitemid  
JOIN usermaster AS e ON a.referedbydoctorid=e.userid 
LEFT JOIN 
(SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount,
SUM(oldtherapist-newtherapist) AS TherapistChange FROM 
therapyreschedulelog  WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') GROUP BY therapyuniqueno,therapyitemid ) AS f 
ON a.bookinguniqueid =f.therapyuniqueno AND a.`bookingid`=f.`therapyitemid`


LEFT JOIN (SELECT referenceid,COUNT(*) AS doccount FROM paitentdocumentmaster GROUP BY referenceid) AS h ON a.bookingid = h.referenceid
LEFT JOIN (SELECT a.bookinguniqueid AS Adduniqueid,b.username FROM therapybookingmaster AS a LEFT JOIN  usermaster AS b ON a.addedby = b.userid GROUP BY  bookinguniqueid,b.username) AS g ON 
g.Adduniqueid = a.`bookinguniqueid`
 
WHERE  a.paitentid='$ID'   AND bookinguniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') AND   a.bookingstatus IN('Booked','Cancelled','Closed')
GROUP BY b.consultationname,a.bookingstatus 

UNION 

SELECT  b.consultationname,0,COUNT(a.totalsitings) AS Cancelled ,0 AS Completed,0,
a.bookingstatus,a.rate AS 'Rate/Sitting',
SUM(a.rate),SUM(a.discount),SUM(a.nettamount) 
FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
JOIN usermaster AS c ON a.doctorid=c.userid 
LEFT JOIN (SELECT bookingitemid,timeslot AS timeslot FROM timeslotallocation AS a 
LEFT JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE 
uniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') 
GROUP BY bookingitemid) AS d ON  a.bookingid =d.bookingitemid  
JOIN usermaster AS e ON a.referedbydoctorid=e.userid 
LEFT JOIN 
(SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount,
SUM(oldtherapist-newtherapist) AS TherapistChange FROM 
therapyreschedulelog  WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') GROUP BY therapyuniqueno,therapyitemid ) AS f 
ON a.bookinguniqueid =f.therapyuniqueno AND a.`bookingid`=f.`therapyitemid`


LEFT JOIN (SELECT referenceid,COUNT(*) AS doccount FROM paitentdocumentmaster GROUP BY referenceid) AS h ON a.bookingid = h.referenceid
LEFT JOIN (SELECT a.bookinguniqueid AS Adduniqueid,b.username FROM therapybookingmaster AS a LEFT JOIN  usermaster AS b ON a.addedby = b.userid GROUP BY  bookinguniqueid,b.username) AS g ON 
g.Adduniqueid = a.`bookinguniqueid`
 
WHERE  a.paitentid='$ID'   AND bookinguniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') AND   a.bookingstatus = 'Cancelled'
GROUP BY b.consultationname,a.bookingstatus 


UNION 

SELECT  b.consultationname,0,0,COUNT(a.totalsitings) AS Completed,0,
a.bookingstatus,a.rate AS 'Rate/Sitting',
SUM(a.rate),SUM(a.discount),SUM(a.nettamount) 
FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
JOIN usermaster AS c ON a.doctorid=c.userid 
LEFT JOIN (SELECT bookingitemid,timeslot AS timeslot FROM timeslotallocation AS a 
LEFT JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE 
uniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') 
GROUP BY bookingitemid) AS d ON  a.bookingid =d.bookingitemid  
JOIN usermaster AS e ON a.referedbydoctorid=e.userid 
LEFT JOIN 
(SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount,
SUM(oldtherapist-newtherapist) AS TherapistChange FROM 
therapyreschedulelog  WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') GROUP BY therapyuniqueno,therapyitemid ) AS f 
ON a.bookinguniqueid =f.therapyuniqueno AND a.`bookingid`=f.`therapyitemid`


LEFT JOIN (SELECT referenceid,COUNT(*) AS doccount FROM paitentdocumentmaster GROUP BY referenceid) AS h ON a.bookingid = h.referenceid
LEFT JOIN (SELECT a.bookinguniqueid AS Adduniqueid,b.username FROM therapybookingmaster AS a LEFT JOIN  usermaster AS b ON a.addedby = b.userid GROUP BY  bookinguniqueid,b.username) AS g ON 
g.Adduniqueid = a.`bookinguniqueid`
 
WHERE  a.paitentid='$ID'   AND bookinguniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') AND   a.bookingstatus = 'Closed'
GROUP BY b.consultationname,a.bookingstatus


UNION 

SELECT  b.consultationname,0,0,0,COUNT(a.totalsitings) AS Pending,
a.bookingstatus,a.rate AS 'Rate/Sitting',
SUM(a.rate),SUM(a.discount),SUM(a.nettamount) 
FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
JOIN usermaster AS c ON a.doctorid=c.userid 
LEFT JOIN (SELECT bookingitemid,timeslot AS timeslot FROM timeslotallocation AS a 
LEFT JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE 
uniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') 
GROUP BY bookingitemid) AS d ON  a.bookingid =d.bookingitemid  
JOIN usermaster AS e ON a.referedbydoctorid=e.userid 
LEFT JOIN 
(SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount,
SUM(oldtherapist-newtherapist) AS TherapistChange FROM 
therapyreschedulelog  WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') GROUP BY therapyuniqueno,therapyitemid ) AS f 
ON a.bookinguniqueid =f.therapyuniqueno AND a.`bookingid`=f.`therapyitemid`


LEFT JOIN (SELECT referenceid,COUNT(*) AS doccount FROM paitentdocumentmaster GROUP BY referenceid) AS h ON a.bookingid = h.referenceid
LEFT JOIN (SELECT a.bookinguniqueid AS Adduniqueid,b.username FROM therapybookingmaster AS a LEFT JOIN  usermaster AS b ON a.addedby = b.userid GROUP BY  bookinguniqueid,b.username) AS g ON 
g.Adduniqueid = a.`bookinguniqueid`
 
WHERE  a.paitentid='$ID'   AND bookinguniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') AND   a.bookingstatus = 'Booked'
GROUP BY b.consultationname,a.bookingstatus) AS a 

 

GROUP BY consultationname,rate 



 
    
");

//echo "<table id='tblProject' class='tblMasters'>";
echo "  <table id='tblTherapyListSummary'  border='1' style='border-collapse:collapse; '  class='table' width='100%'>";
echo " <thead><tr>  
		<th    width='%'>#</th>      	
		<th width='%'> Therapy</th>   
     <th width='%'> Rate/Sitting</th>   
		<th width='%'>  Booked </th> 
		<th width='%'> Cancelled</th> 
		<th width='%'> Completed</th>    
    <th width='%'> Balance</th>    
     
		 
		</tr> </thead> <tbody id='myTable'>";

 $SerialNo = 0;
while($data = mysqli_fetch_row($resultsummary))
{
 
  echo "
  <tr>";
  
  if($SerialNo==0)
  {
echo   "<td width='%'></td>";
  }
  else
  {
echo   "<td width='%'>$SerialNo</td>";
  }
  
 echo" <td    width='%' >$data[0]</td> 
    <td    width='%' >$data[5]</td> 
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








echo "<hr>";

echo " <input type='text' name='myInput' id='myInput' class='form-control'  placeholder='Search...'  />";

$result = mysqli_query($connection, " 
  
 
SELECT a.bookingid,a.therapyid,a.doctorid,b.consultationname,a.totalsitings,DATE_FORMAT(reviseddate,'%d-%m-%Y') AS reviseddatenew,
d.timeslot, c.username, e.username,
a.bookingstatus,IF(a.bookingstatus='Closed',DATE_FORMAT(a.closingdate,'%d-%m-%Y'),'') AS Closingdate,
a.rate,a.discount,a.nettamount ,DATE_FORMAT(a.bookingdate,'%d-%m-%Y'),a.bookinguniqueid,
Reschedulecount,TherapistChange,h.doccount
FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
JOIN usermaster AS c ON a.doctorid=c.userid 
LEFT JOIN (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a 
LEFT JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE 
uniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') 
GROUP BY bookingitemid) AS d ON  a.bookingid =d.bookingitemid  
JOIN usermaster AS e ON a.referedbydoctorid=e.userid 
LEFT JOIN 
(SELECT therapyuniqueno,therapyitemid,COUNT(*) AS Reschedulecount,
SUM(oldtherapist-newtherapist) AS TherapistChange FROM 
therapyreschedulelog  WHERE therapyuniqueno IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID') GROUP BY therapyuniqueno,therapyitemid ) AS f 
ON a.bookinguniqueid =f.therapyuniqueno AND a.`bookingid`=f.`therapyitemid`


left join (select referenceid,count(*) as doccount from paitentdocumentmaster group by referenceid) as h on a.bookingid = h.referenceid


WHERE  a.paitentid='$ID'   AND bookinguniqueid IN(SELECT bookinguniqueid FROM 
therapybookingmaster WHERE paitentid='$ID')   
GROUP BY a.bookingid,a.therapyid,b.consultationname,reviseddate,c.username, a.rate,a.discount,a.nettamount ,d.timeslot,
e.username,a.bookingstatus,a.closingdate,a.bookingdate 
ORDER BY reviseddate desc

 
    
");



//echo "<table id='tblProject' class='tblMasters'>";
echo "  <table id='tblTherapyList'  border='1' style='border-collapse:collapse;' 
   class='  table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
    <th width='%' hidden >ID</a></th>        
		<th width='%' hidden >Therapy ID</a></th>        
		<th width='%' hidden >Doctor ID</a></th>        
		<th width='%'>Therapy</a></th>     
		<th width='%' hidden > Sittings</a></th>    
		<th width='%'> Booking Date</a></th>    
		<th width='%'> Therapy Date</a></th>    
		<th width='%'> Timing</a></th>    
		<th width='%'> Therapist</a></th>    
		<th width='%'> Referedby</a></th>    
		<th width='%'> Status</a></th>    
		<th width='%'  > Completed on</a></th>    
		<th width='%'> Rate</a></th>    
		<th width='%'> Discount</a></th>     
		<th width='%'> Total</a></th>
		<th width='%'>  </th>
		<th width='%'>  </th>
		<th width='%'>  </th>
		<th width='%'>  </th>
		<th width='%'>  </th>
    
    
    ";
if ($ID == '1') {
  echo "<th width='%'> </th> ";
  if ($TherapyStatus == 'Open') {


    echo "<th   width='%'>  </th>    
		<th width='%'>  </th>    
		<th width='%'>  </th> ";
  }
}
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
   <td width='%'>$data[3]</td>     
   <td hidden width='%'>$data[4]</td>     
   <td  width='%'>$data[14]</td>     

   <td nowrap id='TherapyName' width='%'>$data[5]</td>    
   <td  width='%'>$data[6]</td>     
   <td  width='%'>$data[7]</td>     
   <td  width='%'>$data[8]</td>";
  if ($data[9] == 'Closed') {
    echo "<td bgcolor='#51dc8b' width='%'>Completed</td> ";
  } else if ($data[9] == 'Cancelled') {
    echo "<td bgcolor='#ed796b' width='%' onclick='GetPointID($data[0],$data[1],$data[2],$data[13],$data[15]);LoadTherayCancellation();'>
    <a href='#modalCancelledDetails'  data-toggle='modal' >
    Cancelled</i></a>
     </td> ";
  } else {
    if ($data[16] == 0) {
      echo "<td bgcolor='#02c1f2' width='%'>Booked</td> ";
    } else {
      if ($data[17] == 0) {
        echo "<td bgcolor='#eaca64' width='%'  onclick='GetPointID($data[0],$data[1],$data[2],$data[13],$data[15]);LoadTherayRescheduleDetails();'>
        <a href='#modalRescheduledDetails'  data-toggle='modal' >Rescheduled($data[16])</a></td> ";
      } else {
        echo "<td bgcolor='#f29d00' width='%'  onclick='GetPointID($data[0],$data[1],$data[2],$data[13],$data[15]);LoadTherayRescheduleDetails();'>
        <a href='#modalRescheduledDetails'  data-toggle='modal' >Rescheduled($data[16])</a></td> ";
      }
    }
  }


  echo "<td   width='%'>$data[10]</td>     
   <td  width='%'>$data[11]</td>     
   <td  width='%'>$data[12]</td>
   <td  width='%'>$data[13]</td>
   
   <td align='center' style='color:#009ad9'  >
<a href='../TPM/SaleBillView.php?invoice=$data[15]' target='_blank' >
<i class='fa fa-2x fa-eye' title='View'></i></a></td>";
  if ($data[18] > 0) {
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

  if ($data[9] == 'Closed') {
    echo
    "<td onclick='GetPointIDClosure($data[0],$data[15]);LoadTherapyTransactions()'><a href='#modalTherapyClosureCompleted'
        data-toggle='modal'>
        <i class='fa fa-2x  fa-eye text-warning'></i></a></td>
 <td onclick='GetPointIDClosure($data[0],$data[15])'>
        <a href='#modalTherapyReopen'
        data-toggle='modal'>
        <i class='fa fa-2x  fa-pencil text-warning'></i>
        
        </i></a></td>
<td></td> ";
  } else if ($data[9] == 'Booked') {
    echo
    "<td onclick='GetPointIDClosure($data[0],$data[15])'><a href='#modalTherapyClosure' data-toggle='modal'>
        <i class='fa fa-2x  fa-check-circle  text-success'></i></a></td>

<td onclick='GetPointID($data[0],$data[1],$data[2],$data[13],$data[15]);'><a href='#modalTherapyReschedule'
        data-toggle='modal'>
        <i class='fa fa-2x  fa-calendar text-warning'></i></a></td>

<td onclick='GetPointID($data[0],$data[1],$data[2],$data[13],$data[15]);'><a href='#modalTherapyCancel'
        data-toggle='modal'>
        <i class='fa fa-2x fa-minus-circle text-danger'></i></a></td>";
  }


  echo "</tr>";



  $SerialNo = $SerialNo + 1;
}
echo "</tbody>
</table>";
?>