<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {
	// echo "1";
	include("../../../connect.php");
	$currentdate = date("Y-m-d");
	$CurrentDateTime = date("Y-m-d H:i:s");
	$RefundStatus = mysqli_real_escape_string($connection, $_POST["RefundStatus"]);
	$Remarks = mysqli_real_escape_string($connection, strtoupper($_POST["Remarks"])); 
	$PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);
	$TokenNo = mysqli_real_escape_string($connection, $_POST["TokenNo"]);
	$InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]); 
		$Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
		$TherapyBookingID = mysqli_real_escape_string($connection, $_POST["TherapyBookingID"]); 





	$LocationCode = $_SESSION['SESS_LOCATION'];
	$userid = $_SESSION['SESS_MEMBER_ID']; 
	$ClientID = 1; 

	try {

		if($Type=='ReConsultation')
		{
			$AddPaymentMode = "update therapybookingdetails set reconsultationstatus='1',
			reconsultationdate='$CurrentDateTime', reconsultationby='$userid' 
			 where bookingid ='$TherapyBookingID' ; ";  

		} else 
		if($Type=='Diagnosis')
		{
			$AddPaymentMode = "update diagnosissalemaster set reconsultingstatus='2',
			reconsultingdate='$CurrentDateTime', reconsultingby='$userid' 
			 where id ='$TherapyBookingID' ; ";  

		}
		else
		{

		$AddPaymentMode = "update consultingbillmaster set tokenstatus='Completed',
			closureremarks='-', refundstatus='NoConcession' ,
		nextappointment='1900-01-01' where consultationuniquebill ='$InvoiceNo' and tokennumber='$TokenNo'
		 and tokenstatus='Open' and cancelledstatus='0'; ";

		$AddPaymentMode .= "update tokenmaster set tokenstatus='Completed' , completeddate='$CurrentDateTime'   
	 where invoicenumber ='$InvoiceNo' and tokennumber='$TokenNo'  and tokenstatus='Open' ; ";

		$AddPaymentMode .= "insert into appointmentdetails (paitentid ,appointmentdate,remarks,createdby)
		 values ('$PaitentID','1900-01-01','-',
		 (select doctorid FROM consultingbillmaster WHERE 
		 consultationuniquebill ='$InvoiceNo' and tokennumber='$TokenNo' )); ";
}

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