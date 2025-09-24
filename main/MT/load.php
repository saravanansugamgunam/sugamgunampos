<?php

//load.php
include("../../connect.php");

$Statusupdate = $_GET['sts'];
$currentdate = date("Y-m-d");
$FromPeriod = date('Y-m-d', (strtotime('-1 day', strtotime($currentdate))));

// $query = mysqli_query($connection, " SELECT * FROM events ORDER BY id  
//  ");

$query = mysqli_query($connection, " 
  
 
    SELECT id,name,followupdate,mobileno,enquiryid FROM newenquirydetails
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
        'id'   => $row["id"],
        'title'   => $row["name"],
        'start'   => $row["followupdate"],
        'end'   => $row["followupdate"],
        'color' => $Color,
        'url' => "javascript:;",
    );
}

echo json_encode($data);


mysqli_close($connection);
