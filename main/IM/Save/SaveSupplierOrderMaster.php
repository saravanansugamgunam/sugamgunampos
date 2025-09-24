<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["STOUniqueNo"]))
{
    
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s");  
  $date =date("Y-m-d");  
    
  $STOUniqueNo = mysqli_real_escape_string($connection, $_POST["STOUniqueNo"]);   
  $SupplierID = mysqli_real_escape_string($connection, $_POST["SupplierID"]);    
  $DeliveryMode = mysqli_real_escape_string($connection, $_POST["DeliveryMode"]);    
  $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);    
  $AdvanceAmount = mysqli_real_escape_string($connection, $_POST["AdvanceAmount"]);    
  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);    
   
 $LocationCode = $_SESSION['SESS_LOCATION'];
   
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION["SESS_MEMBER_ID"];
   
  try {
    $AddBatch = "insert into supplierpreordermaster (orderdate,patientid,uniqueno,advanceamount,deliverymode,paymentmode,remarks) values 
	('$currentdate','$SupplierID','$STOUniqueNo','$AdvanceAmount','$DeliveryMode','$PaymentMode','$Remarks')"; 
  
 mysqli_query($connection, $AddBatch); 
 
  $last_id = mysqli_insert_id($connection);
  
  
$PaymentQuery = "insert into salepaymentdetails(customercode,paymentmode,amount,invoiceno,date,transactiontype,clientid) values 
('$SupplierID','$PaymentMode','$AdvanceAmount','$last_id','$date','SupplierOrder','$LocationCode'); ";


if($AdvanceAmount>0)
	{
	   $PaymentQuery.= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
   creditamount,createdby,clientid,remarks)
   VALUES 
   ('Medicine','Advance - Supplier Preorder','$last_id','$date','$SupplierID','0','$AdvanceAmount','$userid','$LocationCode','$Remarks');";
   
	}
 

$PaymentQuery .= "   ";
  
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