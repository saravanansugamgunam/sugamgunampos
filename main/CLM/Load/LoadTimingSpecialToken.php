<?php

session_cache_limiter(FALSE);
session_start();

if (isset($_POST["DoctorCode"])) {

  // echo "1";
  include("../../../connect.php");
  $FromDate = date("Y-m-d 00:00:00");
  $ToDate = date("Y-m-d 23:50:00");
  $DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);
  $SaleDate = mysqli_real_escape_string($connection, $_POST["SaleDate"]);


  $sqli = "SELECT id,timing FROM consultingtiming  WHERE id NOT IN (
  SELECT timeid FROM  consultingbillmaster WHERE billdate='$SaleDate' AND doctorid ='$DoctorCode' ) AND activestatus='Active'";

  //echo "<table id='tblProject' class='tblMasters'>";

  echo "<select class='form-control' id='cmbTiming' name='cmbTiming' >
            <option selected></option> ";


  $result = mysqli_query($connection, $sqli);
  while ($row = mysqli_fetch_array($result)) {
    # code...

    echo ' <option value=' . $row['id'] . '>' . $row['timing'] . '</option>';
  }

  echo "</select>";
}
