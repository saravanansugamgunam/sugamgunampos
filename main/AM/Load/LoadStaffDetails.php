<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["UserID"])) {

  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");
  $UserID = mysqli_real_escape_string($connection, $_POST["UserID"]);

  $query = mysqli_query($connection, "select userid,username,dob,doj,gender,maritalstatus,mobileno,altcontact,address1,
salary,biometricid,designationid,qualification,yoe,activestatus,password,
(SELECT IF(COUNT(*)>0,b.groupname,'No Group') AS Grp FROM pos_usergroupmapping AS a 
JOIN pos_groupmaster AS b ON a.groupid = b.groupid WHERE userid ='$UserID') as Groupname,
(SELECT IFNULL(IF(COUNT(*)>1,'Multiple Location',b.locationname),'No Location') AS Loc FROM uselocationmapping AS a JOIN
 locationmaster AS b ON a.locationid=b.locationcode WHERE userid ='$UserID') as LocationName,hrdocumentid,accesscode
from usermaster
where userid ='$UserID'");

  $data = array();

  while ($row = mysqli_fetch_assoc($query)) {

    $data[] = $row['username'];
    $data[] = $row['dob'];
    $data[] = $row['doj'];
    $data[] = $row['gender'];
    $data[] = $row['maritalstatus'];
    $data[] = $row['mobileno'];
    $data[] = $row['altcontact'];
    $data[] = $row['address1'];
    $data[] = $row['salary'];
    $data[] = $row['biometricid'];
    $data[] = $row['designationid'];
    $data[] = $row['qualification'];
    $data[] = $row['yoe'];
    $data[] = $row['activestatus'];
    $data[] = $row['userid'];
    $data[] = $row['password'];
    $data[] = $row['Groupname'];
    $data[] = $row['LocationName'];
    $data[] = $row['hrdocumentid'];
    $data[] = $row['accesscode'];
  }

  echo json_encode($data);


  mysqli_close($connection);

  // echo "select userid,username,dob,doj,gender,maritalstatus,mobileno,altcontact,address1,
  // salary,biometricid,designationid,qualification,yoe,activestatus,password,
  // (SELECT IF(COUNT(*)>0,b.groupname,'No Group') AS Grp FROM pos_usergroupmapping AS a 
  // JOIN pos_groupmaster AS b ON a.groupid = b.groupid WHERE userid ='$UserID') as Groupname,
  // (SELECT IFNULL(IF(COUNT(*)>1,'Multiple Location',b.locationname),'No Location') AS Loc FROM uselocationmapping AS a JOIN
  //  locationmaster AS b ON a.locationid=b.locationcode WHERE userid ='$UserID') as LocationName
  // from usermaster
  // where userid ='$UserID'";
}