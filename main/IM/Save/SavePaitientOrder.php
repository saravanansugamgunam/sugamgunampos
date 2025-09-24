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
 $ProductCode = mysqli_real_escape_string($connection, $_POST["ProductCode"]);  
 $OrderDate = mysqli_real_escape_string($connection, $_POST["OrderDate"]);   
 $OrderQty = mysqli_real_escape_string($connection, $_POST["OrderQty"]);   
 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);   
 $Advance = mysqli_real_escape_string($connection, $_POST["Advance"]);   
 $DeliveryMode = mysqli_real_escape_string($connection, $_POST["DeliveryMode"]);   
  
 $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
	  
	  $PaitientOrderQuery = "insert into paitientorder (clientid,paitentid,orderdate,productcode,qty,remarks,orderstatus,advance,deliverymode) values 
	('$ClientID','$PaitentCode','$OrderDate','$ProductCode','$OrderQty','$Remarks','Open','$Advance','$DeliveryMode');";
	mysqli_query($connection, $PaitientOrderQuery);
	
	 $last_id = mysqli_insert_id($connection);
	 
$PaymentQuery = "insert into salepaymentdetails(customercode,paymentmode,amount,invoiceno,date,transactiontype,clientid) values 
('$PaitentCode','12','$Advance','$last_id','$OrderDate','PaitentOrder','$LocationCode'); ";

$PaymentQuery .= " UPDATE paitentmaster set receipt=receipt+$Advance where paitentid='$PaitentCode' ";
 

 
mysqli_multi_query($connection,$PaymentQuery);
 



    // $AddBatch = "insert into paitientorder (clientid,paitentid,orderdate,productcode,qty,remarks,orderstatus) values 
	// ('$ClientID','$PaitentCode','$OrderDate','$ProductCode','$OrderQty','$Remarks','Open')"; 
   
 // mysqli_query($connection, $AddBatch); 
  
 echo 1;
 // echo $AddBatch;
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>