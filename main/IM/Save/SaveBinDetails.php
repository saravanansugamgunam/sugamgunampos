<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["Rack"])) {

   // echo "1";
   include("../../../connect.php");

   $currentdate = date("Y-m-d H:i:s");
 

   $Rack = mysqli_real_escape_string($connection, $_POST["Rack"]);
   $Shelf = mysqli_real_escape_string($connection, $_POST["Shelf"]);
   $Bin = mysqli_real_escape_string($connection, $_POST["Bin"]);
   $Product = mysqli_real_escape_string($connection, $_POST["Product"]); 

   $LocationCode = $_SESSION['SESS_LOCATION'];
   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = 1;
   $AddSTOItems = "";

   try { 
      $AddSTOItems.= "insert into rack_stockbinmapping (rack,shelf,bin,barcode,clientid) values 
	('$Rack','$Shelf','$Bin','$Product','$LocationCode')";
 
   
      if (mysqli_multi_query($connection, $AddSTOItems)) {

         echo "1";
      } else {
         echo "Error: " . $AddSTOItems . "" . mysqli_error($connection);
      }
   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error";
}