<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["InvoiceNo"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $InvoiceNo = mysqli_real_escape_string($connection, strtoupper($_POST["InvoiceNo"]));    
 $DiscountPercent = mysqli_real_escape_string($connection, strtoupper($_POST["DiscountPercent"]));  

    
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
  $DiscountPercentage = $DiscountPercent / 100;
   
  try {
    $AddPaymentMode = "update therapybookingdetails set discount=round(rate*$DiscountPercentage,0),
    nettamount=rate-round(rate*$DiscountPercentage,0),
    discountpercent='$DiscountPercent'  where bookinguniqueid='$InvoiceNo'"; 
 
    
 

    if (mysqli_query($connection, $AddPaymentMode)) {
                
      // echo "Service Requese has been registered, Request ID is " . $last_id;
        echo "1";
              } else {
                 echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
              } 
     // echo $AddBatch;
 
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>