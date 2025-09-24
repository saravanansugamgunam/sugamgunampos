<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {

   // echo "1";
   include("../../../connect.php");

   $currentdate = date("Y-m-d");


   $BookingID = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);
   $ItemID = mysqli_real_escape_string($connection, $_POST["ItemID"]);
   $TherapyID = mysqli_real_escape_string($connection, $_POST["TherapyID"]);
   $RevisedDate = mysqli_real_escape_string($connection, $_POST["SittingDate"]);
   $RevisedTime = mysqli_real_escape_string($connection, $_POST["SittingTime"]);
   $Therapist = mysqli_real_escape_string($connection, $_POST["Therapist"]);
   $ScheduleRemarks = mysqli_real_escape_string($connection, $_POST["ScheduleRemarks"]);


   $EveningTimeSlotID = stripslashes(mysqli_real_escape_string($connection, $_POST["EveningSlot"]));
   $MorningTimeSlotID = stripslashes(mysqli_real_escape_string($connection, $_POST["MorningSlot"]));
   $RescheduleStatus = stripslashes(mysqli_real_escape_string($connection, $_POST["RescheduleStatus"]));

   $LocationCode = $_SESSION['SESS_LOCATION'];
   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = $_SESSION["SESS_MEMBER_ID"];
   $SaveSaleMaster = '';

   try {


      $SaveSaleMaster .= "INSERT INTO therapyreschedulelog (paitentid,therapyitemid,therapyuniqueno,therapyolddate,
      therapyreviseddate,oldtherapist,newtherapist,remarks,updatedby)
      values ((SELECT paitentid FROM therapybookingmaster WHERE bookinguniqueid ='$BookingID'),'$ItemID',
      '$BookingID',
      (SELECT reviseddate FROM therapybookingdetails WHERE bookinguniqueid ='$BookingID' and bookingid='$ItemID'),
      '$RevisedDate',
      (SELECT doctorid FROM therapybookingdetails WHERE bookinguniqueid ='$BookingID' and bookingid='$ItemID'),
      '$Therapist','$ScheduleRemarks','$userid');";




      $SaveSaleMaster .= "delete from timeslotallocation WHERE uniqueid ='$BookingID' and bookingitemid='$ItemID';";

      if ($EveningTimeSlotID <> '') {
         $SaveSaleMaster .= "INSERT INTO timeslotallocation (timeslotid,totaltime,uniqueid,therapyid,bookingitemid)
      values ($EveningTimeSlotID,'60','$BookingID','$TherapyID','$ItemID');";

         $SaveSaleMaster .= "UPDATE therapybookingdetails set reviseddate='$RevisedDate',nextsettingdate='$RevisedDate',
   revisedtime=( SELECT timeslot FROM timeslotdetails WHERE id IN($EveningTimeSlotID) LIMIT 1),
   doctorid ='$Therapist' where bookinguniqueid ='$BookingID' and bookingid='$ItemID';";

         $SaveSaleMaster .= "
   UPDATE therapybookingmaster set 
   revisedtherapydate= (SELECT  min(reviseddate) from therapybookingdetails where bookinguniqueid ='$BookingID' ),
   revisedtherapytime= ( SELECT timeslot FROM timeslotdetails WHERE id IN($EveningTimeSlotID) LIMIT 1),
   doctorid ='$Therapist' where bookinguniqueid ='$BookingID'  ;";
      }
      if ($MorningTimeSlotID <> '') {
         $SaveSaleMaster .= "INSERT INTO timeslotallocation (timeslotid,totaltime,uniqueid,therapyid,bookingitemid)
      values ($MorningTimeSlotID,'60','$BookingID','$TherapyID','$ItemID');";

         $SaveSaleMaster .= "UPDATE therapybookingdetails set reviseddate='$RevisedDate',nextsettingdate='$RevisedDate',
   revisedtime=( SELECT timeslot FROM timeslotdetails WHERE id IN($MorningTimeSlotID) LIMIT 1),
   doctorid ='$Therapist' where bookinguniqueid ='$BookingID' and bookingid='$ItemID';";

         $SaveSaleMaster .= "
   UPDATE therapybookingmaster set 
   revisedtherapydate= (SELECT  min(reviseddate) from therapybookingdetails where bookinguniqueid ='$BookingID' ),
   revisedtherapytime= ( SELECT timeslot FROM timeslotdetails WHERE id IN($MorningTimeSlotID) LIMIT 1),
   doctorid ='$Therapist' where bookinguniqueid ='$BookingID'  ;";
      }




      mysqli_multi_query($connection, $SaveSaleMaster);

      // echo 1;
      echo  $SaveSaleMaster;
   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error";
}
