<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["InvoiceNo"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d");  
   
  $PaymentAmount = mysqli_real_escape_string($connection, $_POST["PaymentAmount"]);  
  $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);   
  $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);   
  $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);   
  
 $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
 // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];

  try {
    $SaveSaleMaster= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,
    invoicegrndate,vendorcode,debitamount,
    creditamount,createdby,clientid,remarks)
    VALUES 
    ('Therapy','Therapy - Outstanding Payment','$InvoiceNo','$currentdate','$PaitentCode','0','$PaymentAmount',
    '$userid','$LocationCode','-');";
   
   $SaveSaleMaster.="  UPDATE paitentmaster set receipt = receipt+'$PaymentAmount' where paitentid='$PaitentCode';"; 


   $SaveSaleMaster.= "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,clientid,
   transactiontype,transactiongroup) values 
   ('$PaitentCode','$PaymentMode','$PaymentAmount','$InvoiceNo','$currentdate','$LocationCode','Therapy Payment','Clinic')"; 
 
 
    
if(mysqli_multi_query($connection, $SaveSaleMaster)){ 
   echo 1;
 // echo $SaveSaleMaster;
} else{
  // echo "ERROR: Could not able to execute $AddItem. " . mysqli_error($connection);
   echo "0";
 // echo $SaveSaleMaster;
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