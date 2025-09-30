<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {

  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");
  $Invoice =  mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);

//   $query = mysqli_query($connection, "
  
//   SELECT 
//   height,weight,pulse,bp,temperature,shn,diet,testsrequired, nextappointmentdate,COUNT(*)  as casehistorycount
//   FROM casehistory WHERE consultinguniqueid ='$Invoice'");
 
 
 
//   $query = mysqli_query($connection, "
  
//     SELECT 
//   height,weight,pulse,bp,temperature,shn,diet,testsrequired,
//   nextappointmentdate,COUNT(*)  AS casehistorycount, 
//   (SELECT remarks FROM nextappointmentdetails WHERE paitentid IN(
//   SELECT paitentid FROM casehistory WHERE consultinguniqueid ='$Invoice') AND
//     nextappointmentdate IN ( SELECT nextappointmentdate FROM casehistory 
//     WHERE consultinguniqueid ='$Invoice') 
//     ORDER BY createdon DESC LIMIT 1 ) AS remarks,siddhapulse,tcmpulse
//   FROM casehistory WHERE consultinguniqueid ='$Invoice'");
  
  
  
  $query = mysqli_query($connection, "
  
    SELECT 
  height,weight,pulse,bp,temperature,shn,diet,testsrequired,
   nextappointmentdate,COUNT(*)  AS casehistorycount, 
   (SELECT remarks FROM nextappointmentdetails WHERE paitentid IN(
   SELECT paitentid FROM casehistory WHERE consultinguniqueid ='$Invoice') AND
    nextappointmentdate IN ( SELECT nextappointmentdate FROM casehistory 
    WHERE consultinguniqueid ='$Invoice') 
    ORDER BY createdon DESC LIMIT 1 ) AS remarks,siddhapulse,tcmpulse,
    (SELECT instruction FROM diesasemappingtherapistinstruction 
    WHERE consultinguniqueid ='$Invoice' LIMIT  1) as instruction
  FROM casehistory WHERE consultinguniqueid ='$Invoice'");
 
 
 
 

  $data = array();

  while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row['height'];
    $data[] = $row['weight'];
    $data[] = $row['pulse'];
    $data[] = $row['bp'];
    $data[] = $row['temperature'];
    $data[] = $row['shn']; 
    $data[] = $row['diet'];
    $data[] = $row['testsrequired'];
    $data[] = $row['nextappointmentdate'];
    $data[] = $row['casehistorycount'];
    $data[] = $row['remarks'];
    $data[] = $row['siddhapulse'];
    $data[] = $row['tcmpulse'];
        $data[] = $row['instruction'];


 
  }

  echo json_encode($data);


  mysqli_close($connection);
}