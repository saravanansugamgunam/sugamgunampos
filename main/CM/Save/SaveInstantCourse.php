<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["CourseName"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");
   $CourseName = mysqli_real_escape_string($connection, $_POST["CourseName"]);
   $CourseDuration = mysqli_real_escape_string($connection, $_POST["CourseDuration"]);
   $CourseDurationType = mysqli_real_escape_string($connection, $_POST["CourseDurationType"]);
   $CourseFee = mysqli_real_escape_string($connection, $_POST["CourseFee"]);
   $CourseDescription = mysqli_real_escape_string($connection, $_POST["CourseDescription"]);
   $StudentCode = mysqli_real_escape_string($connection, $_POST["StudentCode"]);

   $StudentMobile = mysqli_real_escape_string($connection, $_POST["StudentMobile"]);
   $StudentName = mysqli_real_escape_string($connection, $_POST["StudentName"]);

   $BatchCommencesDate = date("Y-m-d");
   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = 1;

   try {
      $AddTimeLog = "insert into coursemaster (clientid,coursename,courseduration,coursedurationtype,coursefee,
      coursedescription,addedby,addedon,activestatus) values ('$ClientID','$CourseName','$CourseDuration',
      '$CourseDurationType','$CourseFee','$CourseDescription','$userid','$currentdate','Active')";

      mysqli_query($connection, $AddTimeLog);

      $NewCourseCode = $connection->insert_id;

      $AddBatch = "insert into batchmaster (clientid,coursecode,coursefee,batchname,batchcommences,batchfee,description,
      addedby,addedon,activestatus) values ('$ClientID','$NewCourseCode','$CourseFee',concat('$CourseName','$NewCourseCode'),
      '$BatchCommencesDate','$CourseFee','$CourseDescription','$userid','$currentdate','Active')";

      mysqli_query($connection, $AddBatch);

      $last_idBatch = $connection->insert_id;

      $AddBatchMapping = "insert into studentbatchmapping
      (batchcode,studentcode,studentmobileno,studentname,coursecode,
      coursename,coursefees,studentfees,addedby,addedon) values 
      ('$last_idBatch','$StudentCode','$StudentMobile','$StudentName','$NewCourseCode','$CourseName',
      '$CourseFee','$CourseFee','$userid','$currentdate')";

      mysqli_query($connection, $AddBatchMapping);

      echo 1;


      // echo $AddBatchMapping;

      // echo  $last_id;
   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error Adding new course";
}