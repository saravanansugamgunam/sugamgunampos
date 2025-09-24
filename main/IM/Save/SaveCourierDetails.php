<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["CourierInvoice"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $CourierInvoice = mysqli_real_escape_string($connection, strtoupper($_POST["CourierInvoice"]));    
 $CourierName = mysqli_real_escape_string($connection, strtoupper($_POST["CourierName"]));    
 $CourierDate = mysqli_real_escape_string($connection, strtoupper($_POST["CourierDate"]));    
 $CourierReference = mysqli_real_escape_string($connection, strtoupper($_POST["CourierReference"]));    
 $CourierRemarks = mysqli_real_escape_string($connection, strtoupper($_POST["CourierRemarks"]));    
  
  
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "update courierdetails set courierposteddate='$CourierDate', couriertrackingno ='$CourierReference', courierservice='$CourierName', courierremarks ='$CourierRemarks' where invoicenumber= '$CourierInvoice' "; 
 
 mysqli_query($connection, $AddPaymentMode); 
// echo "Added Successfuly";
echo  $AddPaymentMode;

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>