<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["TutorCode"]))
{
    
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $TutorCode = mysqli_real_escape_string($connection, $_POST["TutorCode"]);    
 $BatchCode = mysqli_real_escape_string($connection, $_POST["BatchCode"]);    
 $Payment = mysqli_real_escape_string($connection, $_POST["Payment"]);   
 $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);   
 $PaymentDate = mysqli_real_escape_string($connection, $_POST["PaymentDate"]);  
  
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddBatch = "insert into tutorpaymentdetails (tutorcode,batchcode,paymentamount,paymentmode,paymentdate,addedby) values 
	('$TutorCode','$BatchCode','$Payment','$PaymentMode','$PaymentDate','$userid')"; 
 
 mysqli_query($connection, $AddBatch); 
  
 echo "Added Successfuly";
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error saving";
}

?>