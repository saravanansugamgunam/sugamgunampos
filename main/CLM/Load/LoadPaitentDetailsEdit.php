<?php

session_cache_limiter(FALSE);
session_start();


if (isset($_POST["PaitentCode"])) {
  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");
  $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);
  // echo "33434";

  $query = mysqli_query($connection, "
    select paitentid,mobileno,paitentname,email,whatsappno,alternateno,referenceid,referenceno,gender,
    dob,address,city,statecode,pincode,barcode,activestatus,relationship,patientphoto,
    date_format(dob,'%d-%m-%Y') as dobformated,maritalstatus,profession,tag
     from paitentmaster where paitentid= '$PaitentCode' ");


  $data = array();

  while ($row = mysqli_fetch_assoc($query)) {

    $data[] = $row['paitentid'];
    $data[] = $row['mobileno'];
    $data[] = $row['paitentname'];
    $data[] = $row['email'];
    $data[] = $row['whatsappno'];
    $data[] = $row['alternateno'];
    $data[] = $row['referenceid'];
    $data[] = $row['referenceno'];
    $data[] = $row['gender'];
    $data[] = $row['dob'];
    $data[] = $row['address'];
    $data[] = $row['city'];
    $data[] = $row['statecode'];
    $data[] = $row['pincode'];
    $data[] = $row['barcode'];
    $data[] = $row['activestatus'];
    $data[] = $row['relationship'];
    $data[] = $row['patientphoto'];
    $data[] = $row['dobformated']; 
    $data[] = $row['maritalstatus']; 
    $data[] = $row['profession']; 
    $data[] = $row['tag']; 
  }

  echo json_encode($data);


  mysqli_close($connection);
}