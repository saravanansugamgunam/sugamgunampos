<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["TherapyBookingID"])) {
	// echo "1";
	include("../../../connect.php");
	$currentdate = date("Y-m-d");
	$CurrentDateTime = date("Y-m-d H:i:s");
	$TherapyBookingID = mysqli_real_escape_string($connection, $_POST["TherapyBookingID"]); 
 
	$LocationCode = $_SESSION['SESS_LOCATION']; 
	$userid = $_SESSION["SESS_MEMBER_ID"];

	try {

		$AddPaymentMode = "update therapybookingdetails set reconsultationstatus='1',
			reconsultationdate='$CurrentDateTime', reconsultationby='$userid' 
			 where bookingid ='$TherapyBookingID' ; "; 

		if (mysqli_multi_query($connection, $AddPaymentMode)) {

			echo "1";
			// echo    $AddPaymentMode;
		} else {
			echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
		}
	} catch (Exception $e) {
		echo 'Message: ' . $e->getMessage();

		// echo $AddPaymentMode;
	}
} else {
	// echo "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date) values 
	// ('$PaitentCode','$PaymentMode','$PaymentAmount','$Invoice','$currentdate')";
}