<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["StudentCode"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s");  
  
 $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);  
 $StudentCode = mysqli_real_escape_string($connection, $_POST["StudentCode"]);  
 $BatchCode = mysqli_real_escape_string($connection, $_POST["BatchCode"]);   
 $PaymentAmount = mysqli_real_escape_string($connection, $_POST["PaymentAmount"]);   
 $PaidDate = mysqli_real_escape_string($connection, $_POST["PaidDate"]);   
 $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);   
 
 
  // $ClientID = $_SESSION["CMS_CompanyID"];InvoiceNo
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddBatch = "insert into paymentdetails
	(paymentmodeid,studentcode,batchcode,paymentamount,paymentdate,addedby,invoiceno) values 
	('$PaymentMode','$StudentCode','$BatchCode','$PaymentAmount','$PaidDate','$userid','$InvoiceNo')"; 
  
   
   if(mysqli_query($connection, $AddBatch)){
      echo "1";
   } else{
      echo "ERROR: Could not able to execute $AddBatch. " . mysqli_error($connection);
      // echo "0";
   }
 
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>