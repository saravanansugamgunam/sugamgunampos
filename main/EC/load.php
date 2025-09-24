<?php

//load.php
include("../../connect.php");

$Statusupdate = $_GET['sts'];
$Therapist = $_GET['emp'];

if ($Therapist == 0 && $Statusupdate == 'Pending') {

    $TherapistName = "";
} else if ($Therapist == 0 && $Statusupdate == 'Completed') {
    $TherapistName = "";
} else if ($Therapist <> 0 && $Statusupdate == 'Pending') {
    $TherapistName = " and a.bookinguniqueid IN (
        SELECT bookinguniqueid FROM therapybookingdetails WHERE  bookingstatus='Booked' AND doctorid='$Therapist') ";
} else if ($Therapist <> 0 && $Statusupdate == 'Completed') {
    $TherapistName = " and  a doctorid='$Therapist') ";
}





// $query = mysqli_query($connection, " SELECT * FROM events ORDER BY id  
//  ");

if ($Statusupdate == 'Pending') {
    $query = mysqli_query($connection, " 
 
    SELECT bookinguniqueid, CONCAT(b.`paitentname`,' - ',c.`consultationname`) AS paitentname,
    reviseddate as revisedtherapydate,reviseddate as revisedtherapydate, IF(reviseddate < CURRENT_DATE,'#f76464','#4cb011') AS color,
    CONCAT('TherapyView.php?PID=',a.`paitentid`,'&INV=',bookinguniqueid,'&TID=0&S=O&MID=52/')AS url
    FROM therapybookingdetails AS a 
   JOIN paitentmaster AS b ON a.`paitentid`=b.`paitentid` JOIN consultationmaster AS c ON a.`therapyid`=c.`consultationid`
   WHERE bookinguniqueid IN(SELECT bookinguniqueid FROM therapybookingmaster) AND  bookingstatus<>'Closed' AND  bookingstatus<>'Cancelled'  
   $TherapistName  

 
    ");
} else {
    $query = mysqli_query($connection, " 
 
    SELECT IFNULL(bookinguniqueid,0) AS bookinguniqueid, CONCAT(b.`paitentname`,' - ',c.`consultationname`) AS paitentname,
     closingdate as revisedtherapydate,closingdate as revisedtherapydate, '#4cb011' AS color,
     IFNULL(CONCAT('TherapyView.php?PID=',a.`paitentid`,'&INV=',bookinguniqueid,'&TID=0&S=O&MID=52/'),'-')AS url
     FROM therapybookingdetails AS a 
    JOIN paitentmaster AS b ON a.`paitentid`=b.`paitentid` JOIN consultationmaster AS c ON a.`therapyid`=c.`consultationid`
    WHERE bookinguniqueid IN(SELECT bookinguniqueid FROM therapybookingmaster)  and bookingstatus='Closed' AND  bookingstatus<>'Cancelled' AND closingdate >'2020-12-03'    $TherapistName 
    ");
}







$data = array();

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = array(
        'id'   => $row["bookinguniqueid"],
        'title'   =>  $row["paitentname"],
        'start'   => $row["revisedtherapydate"],
        'end'   => $row["revisedtherapydate"],
        'color' => $row["color"],
        'url' => $row["url"],
    );
}

echo json_encode($data);


mysqli_close($connection);
