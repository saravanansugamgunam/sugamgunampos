<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PaitentCode"]))
{
    
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s");  
     	
	  
  $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);   
  $EntryDate = mysqli_real_escape_string($connection, $_POST["EntryDate"]);    
  $AdvanceAmount = mysqli_real_escape_string($connection, $_POST["AdvanceAmount"]);    
  $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);    
      
  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);    
 

  $LocationCodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);

  $GroupID = $_SESSION['SESS_GROUP_ID'];
 
  if($GroupID==1)
  {
     $LocationCode =$LocationCodeAdmin;
  }
  else
  {
     $LocationCode = $_SESSION['SESS_LOCATION'];
  }
  
   
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddBatch = "insert into advancedetails (paitentcode,advancedate,amount,paymentmode,remarks) values 
	('$PaitentCode','$EntryDate','$AdvanceAmount','$PaymentMode','$Remarks')"; 
  
 mysqli_query($connection, $AddBatch); 
 
  $last_id = mysqli_insert_id($connection);
  
  
$PaymentQuery = "insert into salepaymentdetails(customercode,paymentmode,amount,invoiceno,date,transactiontype,clientid) values 
('$PaitentCode','$PaymentMode','$AdvanceAmount','$last_id','$EntryDate','CashAdvance','$LocationCode'); ";

$PaymentQuery .= " UPDATE paitentmaster set receipt=receipt+$AdvanceAmount where paitentid='$PaitentCode' ";
  
mysqli_multi_query($connection,$PaymentQuery);
 
    
  
   // echo $AddBatch;
  echo "1";
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>