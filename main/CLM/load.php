<?php

//load.php
include("../../connect.php");

$Statusupdate = $_GET['sts'];

// $query = mysqli_query($connection, " SELECT * FROM events ORDER BY id  
//  ");
$currentdate = date("Y-m-d");
$FromPeriod = date('Y-m-d', (strtotime('-1 day', strtotime($currentdate))));
$query = mysqli_query($connection, " 
 
    SELECT a.paitentid,concat(b.`paitentname`,'\n',b.mobileno) as paitentname,a.`nextappointmentdate`,
    CONCAT('PaitentHistoryView.php?PID=',a.`paitentid`,'&INV=',a.paitentid,'&TID=0&S=O&MID=52/')AS url,2 as enquiryid
    FROM nextappointmentdetails AS a JOIN paitentmaster AS b ON a.`paitentid`=b.`paitentid` where
    nextappointmentdate > '$FromPeriod' GROUP BY a.paitentid,b.`paitentname`,a.`nextappointmentdate` ORDER BY nextappointmentdate
 
");




$data = array();
$Color = 'green';
while ($row = mysqli_fetch_assoc($query)) {
    if ($row["enquiryid"] == 1) {
        $Color = 'green';
    } else if ($row["enquiryid"] == 2) {
        $Color = 'blue';
    } else if ($row["enquiryid"] == 3) {
        $Color = 'orange';
    } else if ($row["enquiryid"] == 4) {
        $Color = 'pink';
    } else if ($row["enquiryid"] == 5) {
        $Color = 'green';
    } else if ($row["enquiryid"] == 6) {
        $Color = 'red';
    } else if ($row["enquiryid"] == 7) {
        $Color = 'lightgreen';
    } else if ($row["enquiryid"] == 8) {
        $Color = 'grey';
    }
    $data[] = array(
        'id'   => $row["paitentid"],
        'title'   => $row["paitentname"],
        'start'   => $row["nextappointmentdate"],
        'end'   => $row["nextappointmentdate"],
        'color' => $Color,
        'url' => $row["url"],
    );
}

echo json_encode($data);


mysqli_close($connection);
