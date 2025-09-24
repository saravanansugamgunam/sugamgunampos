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
  $Purpose = mysqli_real_escape_string($connection, $_POST["Purpose"]);    
 

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

  $Transactionmode = '-';

  if($Purpose=='Medicine')
  {
   $Transactionmode='Medicine - Advance';
  } else if ($Purpose=='Consulting')
  {
   $Transactionmode = 'Consulting - Advance';
  }
  else  
  {
   $Transactionmode = 'Therapy - Advance';
  }
  
   
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];	
   
  try {
    $AddBatch = "insert into advancedetails (paitentcode,advancedate,amount,paymentmode,remarks) values 
	('$PaitentCode','$EntryDate','$AdvanceAmount','$PaymentMode','$Remarks')"; 
  
 mysqli_query($connection, $AddBatch); 
 
  $last_id = mysqli_insert_id($connection);
  
  
$PaymentQuery = "insert into salepaymentdetails(customercode,paymentmode,amount,invoiceno,date,transactiontype,clientid) values 
('$PaitentCode','$PaymentMode','$AdvanceAmount','$last_id','$EntryDate','CashAdvance','$LocationCode'); ";

 
$PaymentQuery.= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
creditamount,createdby,clientid,remarks)
VALUES 
('$Purpose','$Transactionmode','$last_id','$EntryDate','$PaitentCode','0','$AdvanceAmount','$userid','$LocationCode','$Remarks');";


$PaymentQuery .= " UPDATE paitentmaster set receipt=receipt+$AdvanceAmount where paitentid='$PaitentCode' ";
  
if (mysqli_multi_query($connection, $PaymentQuery)) {
                
   // echo "Service Requese has been registered, Request ID is " . $last_id;
     echo "1";
     // echo $SaveSaleMaster;
           } else {
              echo "Error: " . $PaymentQuery . "" . mysqli_error($connection);
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