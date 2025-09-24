<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["FromPaitentCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	
 
 $FromPaitentCode = mysqli_real_escape_string($connection, $_POST["FromPaitentCode"]);    
 $AvailableAmount = mysqli_real_escape_string($connection, $_POST["AvailableAmount"]);    
 $ToPaitentCode = mysqli_real_escape_string($connection, $_POST["ToPaitentCode"]);    
 $TransferRemarks = mysqli_real_escape_string($connection, $_POST["TransferRemarks"]);    
 $TransferAmount = mysqli_real_escape_string($connection, $_POST["TransferAmount"]);  
 $InvoiceGrn =date('Ymdhis');

 
  $LocationCode = $_SESSION['SESS_LOCATION'];
  $userid = 1;	
  $QryLiability='';

   
  try {
  
         $QryLiability.= "insert into transactionledger (transactiontype,transactionmode,invoicegrn,
         invoicegrndate,vendorcode,debitamount,creditamount,clientid,remarks) 
         values('Liability','Liability Transfer Debit','$InvoiceGrn',
         '$currentdate','$FromPaitentCode','$TransferAmount','0','$LocationCode','$TransferRemarks');"; 

         $QryLiability.= "insert into transactionledger (transactiontype,transactionmode,invoicegrn,
         invoicegrndate,vendorcode,debitamount,creditamount,clientid,remarks) 
         values('Liability','Liability Transfer Cerdit','$InvoiceGrn',
         '$currentdate','$ToPaitentCode','0','$TransferAmount','$LocationCode','$TransferRemarks');"; 

         $QryLiability.= "Update paitentmaster set receipt=receipt-'$TransferAmount' where paitentid ='$FromPaitentCode';"; 

         $QryLiability.= "Update paitentmaster set receipt=receipt+'$TransferAmount' where paitentid ='$ToPaitentCode';"; 
 
 
   if (mysqli_multi_query($connection, $QryLiability)) {

      
      echo "1";
   } else {
      // echo $QryLiability;
      echo "Error: " . $QryLiability . "" . mysqli_error($connection);
   } 

    
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>