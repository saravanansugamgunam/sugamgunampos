<?php

include("../connect.php");
session_cache_limiter(FALSE);
session_start();


$MobileNo = mysqli_real_escape_string($connection, $_POST["MobileNo"]);
$PaitentName = mysqli_real_escape_string($connection, $_POST["PaitentName"]);
$BillAmount = mysqli_real_escape_string($connection, $_POST["TotalSaleAmount"]);
$TokenNo = mysqli_real_escape_string($connection, $_POST["TokenNo"]);
$PhoneNo = '9176606308';


// //  Dear {#var#}, thanks for choosing Sugamgunam! Your consultation amount is Rs. {#var#}. 
// // We wish you recover soon! Please call {#var#} for queries.
$TokenMessage = ', Token#' . $TokenNo;
$Message1 = 'Dear ';
$Message2 = ', thanks for choosing Sugamgunam! Your consultation amount is Rs. ';
$Message3 = '. We wish you recover soon! Please call ';
$Message4 = ' for queries.';

$MessageOriginal =  $Message1 . $PaitentName . $Message2 . $BillAmount . $TokenMessage . $Message3 . $PhoneNo . $Message4;

// Dear {#var#}, Thank you for registering with Sugamgunam Health Centre


$SenderId = 'SUGAMT';
$ApiKey = '95M55QkhjOsEGr5hqBU4NJNCbSBexhqX+bBXdDp1YIY=';
$ClientId = '570924ec-f1ec-4df5-b217-d3d5a0f9eaa6';


$Message = urlencode($MessageOriginal);
$MobileNumbers = '91' . $MobileNo;
// $UR = "https://api.mylogin.co.in/api/v2/SendSMS?ApiKey=".$ApiKey."&ClientId=".$ClientId."&SenderId=".$SenderId."&Message=".$Message."&MobileNumbers=".$MobileNumbers."";

$ch = curl_init("https://api.mylogin.co.in/api/v2/SendSMS?ApiKey=" . $ApiKey . "&ClientId=" . $ClientId . "&SenderId=" . $SenderId . "&Message=" . $Message . "&MobileNumbers=" . $MobileNumbers . "");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);

// echo $MessageOriginal;
// echo 1;