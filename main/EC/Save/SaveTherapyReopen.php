<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {
  date_default_timezone_set("Asia/Kolkata");

  // echo "1";
  include("../../../connect.php");

  $currentdate = date("Y-m-d");
  $currenttime = date("His");

  $BookingID = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);
  $ItemID = mysqli_real_escape_string($connection, $_POST["ItemID"]);
  $TherapyID = mysqli_real_escape_string($connection, $_POST["TherapyID"]);
  $Comments = mysqli_real_escape_string($connection, $_POST["ClosureRemarks"]);
  //  $BalanceSitting = mysqli_real_escape_string($connection, $_POST["PendingSittings"]); 

  $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION["SESS_MEMBER_ID"];
  $CurrentTime = date("h:i:s");


  try {

    $res = $connection->query(" 
    SELECT COUNT(*) FROM therapybookingdetails WHERE bookinguniqueid ='$BookingID' AND bookingstatus='Closed';  ");

    while ($data = mysqli_fetch_row($res)) {

      $BalanceSitting = $data[0];
    }


    if ($BalanceSitting == 1 || $BalanceSitting == 0) {

      $SaveSaleMaster = "  UPDATE therapybookingdetails SET bookingstatus='Booked',sittingdate='$currentdate',STATUS=0, 
		closureremarks='$Comments',closingdate='$currentdate' WHERE bookingid = '$ItemID' AND bookinguniqueid ='$BookingID';";

      $SaveSaleMaster .= " UPDATE therapybookingmaster set therapystatus='Booked',closingdate='$currentdate' 
      where bookinguniqueid ='$BookingID';";
    
      $SaveSaleMaster .= "insert into therapyreopenedetails (bookinguniqueid,therapyid,paitentid,sitting,closingdate,
      updatedby,bookingitemid,remarks) 
      SELECT bookinguniqueid,therapyid,paitentid,sitingid,'$currentdate','$userid',bookingid,'$Comments'
      FROM therapybookingdetails WHERE bookinguniqueid ='$BookingID'  and bookingid = '$ItemID' ;";
    
      
      
    } else if ($BalanceSitting > 1) {

      $SaveSaleMaster = "  UPDATE therapybookingdetails SET bookingstatus='Booked',sittingdate='$currentdate',STATUS=0, 
		closureremarks='$Comments',closingdate='$currentdate' WHERE bookingid = '$ItemID' AND bookinguniqueid ='$BookingID';";

      $SaveSaleMaster .= " UPDATE therapybookingmaster set 
revisedtherapydate=(select min(reviseddate) from therapybookingdetails where bookinguniqueid ='$BookingID'
 and  bookingstatus='Booked' ) 
   where bookinguniqueid ='$BookingID';";

        $SaveSaleMaster .= "insert into therapyreopenedetails (bookinguniqueid,therapyid,paitentid,sitting,closingdate,
        updatedby,bookingitemid,remarks) 
        SELECT bookinguniqueid,therapyid,paitentid,sitingid,'$currentdate','$userid',bookingid,'$Comments'
        FROM therapybookingdetails WHERE bookinguniqueid ='$BookingID'  and bookingid = '$ItemID' ;";
       }
  
    if (mysqli_multi_query($connection, $SaveSaleMaster)) {
      // echo 1;
      echo $SaveSaleMaster;
    } else {
      // echo "ERROR: Could not able to execute $AddItem. " . mysqli_error($connection);
      // echo "0";
      echo $SaveSaleMaster;
    }
  } catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
} else {
  echo "Error";
}