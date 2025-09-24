
<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["InvoiceNo"]))
{ 
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 							  
 $RefundStatus = mysqli_real_escape_string($connection, $_POST["RefundStatus"]);        
 $Remarks = mysqli_real_escape_string($connection, strtoupper($_POST["Remarks"]));    
 $RefundAmount = mysqli_real_escape_string($connection, strtoupper($_POST["RefundAmount"])); 
 $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]); 
 $TokenNo = mysqli_real_escape_string($connection, $_POST["TokenNo"]); 
 $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);  
 $NextAppointment = mysqli_real_escape_string($connection, $_POST["NextAppointment"]);  
  
   $LocationCode = $_SESSION['SESS_LOCATION'];
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
	  
	  if($RefundStatus=='FullRefund')
	  {
		    $AddPaymentMode = "update consultingbillmaster set tokenstatus='Completed', 
	refundamount=totalamount,closureremarks='$Remarks', refundstatus='$RefundStatus' ,
	nextappointment='$NextAppointment' where consultationuniquebill ='$InvoiceNo' and tokennumber='$TokenNo'; ";
	  }
	  else if($RefundStatus=='PartialRefund')
	  {
		    $AddPaymentMode = "update consultingbillmaster set tokenstatus='Completed', 
	refundamount='$RefundAmount',closureremarks='$Remarks', refundstatus='$RefundStatus' ,
	nextappointment='$NextAppointment' where consultationuniquebill ='$InvoiceNo' and tokennumber='$TokenNo'; ";
	  }
	  else
	  {
			$AddPaymentMode = "update consultingbillmaster set tokenstatus='Completed',
			closureremarks='$Remarks', refundstatus='$RefundStatus' ,
		nextappointment='$NextAppointment' where consultationuniquebill ='$InvoiceNo' and tokennumber='$TokenNo'; ";
	  }
  

	$AddPaymentMode.= "update tokenmaster set tokenstatus='Completed'  
	 where invoicenumber ='$InvoiceNo' and tokennumber='$TokenNo'; "; 
	 
	$AddPaymentMode.= "insert into appointmentdetails (paitentid	 ,appointmentdate,remarks,createdby) values ('$PaitentID','$NextAppointment','$Remarks',(select doctorid FROM consultingbillmaster WHERE consultationuniquebill ='$InvoiceNo' and tokennumber='$TokenNo' )); "; 
	   
 
 mysqli_multi_query($connection, $AddPaymentMode); 
echo "1";
// echo $AddPaymentMode;

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	// echo "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date) values 
	// ('$PaitentCode','$PaymentMode','$PaymentAmount','$Invoice','$currentdate')";
}

?>