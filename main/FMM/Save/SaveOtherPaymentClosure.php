<?php
  
session_cache_limiter(FALSE);
session_start();
  $userid = $_SESSION['SESS_MEMBER_ID'];
//insert.php
if(isset($_POST["PaymentDate"]))
{ 
	  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $PaymentDate = mysqli_real_escape_string($connection, $_POST["PaymentDate"]);    
 $PaymentCode = mysqli_real_escape_string($connection, $_POST["PaymentCode"]);    
 $CreditAmount = mysqli_real_escape_string($connection, $_POST["CreditAmount"]);    
 $LocationCode = mysqli_real_escape_string($connection, $_POST["LocationCode"]);    
 $Reference = mysqli_real_escape_string($connection, $_POST["Reference"]);    
 
	  
	  
  $ClientID = 1; 	
   
  try {
	 
		   $AddPaymentMode = "insert into otherpaymentdayclosure (paymentmode,date,amountcredited,addedby,locationcode,reference)
		   values ('$PaymentCode','$PaymentDate','$CreditAmount','$userid','$LocationCode','$Reference');";
		   
		   		   
  $AddPaymentMode .= ""; 
	 
	  
	  
    // echo $AddPaymentMode;
 
 mysqli_multi_query($connection, $AddPaymentMode); 
echo "1";
// echo $AddPaymentMode;

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
	// echo $AddPaymentMode;
}

?>