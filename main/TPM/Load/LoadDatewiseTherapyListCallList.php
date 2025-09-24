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
$Therapist =  mysqli_real_escape_string($connection, $_POST["Therapist"]);

$TherapyStatus = 'Open';
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


if ($ID == '99999') {
  $PaitentID = " a.paitentid like '%' ";
} else {
  $PaitentID = " a.paitentid = '$ID' ";
}
$currentdate = date("Y-m-d H:i:s");



if ($Basedon == 'BookingDate') {
  $DateFilter = " a.bookingdate BETWEEN '$FromPeriod' and '$ToPeriod' ";
} else {
  $DateFilter = " a.revisedtherapydate BETWEEN '$FromPeriod' and '$ToPeriod' ";
}

if ($Status == 'All') {
  $StatusFilter = " a.therapystatus in('Booked','Scheduled','Closed') ";
} else if ($Status == 'Booked') {
  $StatusFilter = " f.CompletedSitting is null and a.therapystatus not in('Closed','Cancelled')  ";
} else if ($Status == 'InProgress') {
  $StatusFilter = " f.CompletedSitting is not null and a.therapystatus not in('Closed','Cancelled')  ";
} else if ($Status == 'Completed') {
  $StatusFilter = " f.CompletedSitting is not null  and a.therapystatus in('Closed')";
} else if ($Status == 'Cancelled') {
  $StatusFilter = " a.therapystatus in('Cancelled') ";
}

// $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
// $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
// $ID = mysqli_real_escape_string($connection, $_POST["ID"]);
// $Period =  mysqli_real_escape_string($connection, $_POST["Period"]);
// $Basedon =  mysqli_real_escape_string($connection, $_POST["Basedon"]);
// $Status =  mysqli_real_escape_string($connection, $_POST["Status"]);
// $Therapist =  mysqli_real_escape_string($connection, $_POST["Therapist"]);


if ($Therapist == 0) {
  $Therapist = '%';
} else {
  $Therapist = $Therapist;
}

$result = mysqli_query($connection, " 
   
SELECT   g.`paitentname`  AS Paitent ,g.`mobileno`,
DATE_FORMAT(reviseddate,'%d-%m-%Y') AS reviseddate,
c.username AS Therapist,   b.consultationname


FROM therapybookingdetails AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
JOIN usermaster AS c ON a.doctorid=c.userid 
LEFT JOIN (SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot,c.timevalue FROM timeslotallocation AS a 
LEFT JOIN timeslotdetails AS b ON a.timeslotid=b.id  
LEFT JOIN timeslotlist AS c ON timeslot = c.timedescription
GROUP BY bookingitemid ) AS d ON  a.bookingid =d.bookingitemid 

JOIN usermaster AS e ON a.referedbydoctorid=e.userid   
   JOIN therapybookingmaster AS f ON a.bookinguniqueid = f.bookinguniqueid
  JOIN paitentmaster AS g ON a.paitentid=g.paitentid
  
  JOIN ( SELECT invoicegrn,SUM(debitamount) AS TotalFee,SUM(creditamount) AS Received,
  SUM(debitamount)-SUM(creditamount) AS Balance FROM transactionledger  
  GROUP BY invoicegrn) AS h ON h.invoicegrn=f.bookinguniqueid
  WHERE a.`reviseddate`  between '$FromPeriod' and '$ToPeriod'  
  
GROUP BY  b.consultationname,reviseddate,c.username, a.rate,a.discount,a.nettamount ,d.timeslot,
e.username,a.bookingstatus,a.closingdate
ORDER BY g.`mobileno`


 

");



//echo "<table id='tblProject' class='tblMasters'>";
echo "  <table id='tblTherapyRegisterSL'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th    width='%' > Name</th>    	
		<th   width='%' > Mobile </th>    	
		<th nowrap width='%'>Date</th>   
		<th nowrap width='%'>Therapist</th> 
		<th nowrap width='%'>Therapy</th>    
		";

echo "
		</tr> </thead> <tbody id='myTableSL'>";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td width='%' >$data[0]</td> 
  <td width='%' >$data[1]</td> 
  <td width='%' >$data[2]</td> 
  <td width='%' >$data[3]</td> 
  <td width='%' >$data[4]</td>  
    
   ";

  echo "</tr>";

  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
  $SerialNo = $SerialNo + 1;
}
echo "</tbody></table>";