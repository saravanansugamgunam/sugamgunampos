<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Invoice"]))
{
  
 // echo "1";
 include("../../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $DiscountPercent = mysqli_real_escape_string($connection, strtoupper($_POST["DiscountPercent"]));    
 $Invoice = mysqli_real_escape_string($connection, strtoupper($_POST["Invoice"]));    
  
  $ActualDiscountPercent = $DiscountPercent /100;
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
	  
	     $AddPaymentMode = " UPDATE newsaleitems SET  discountamount = 
		 (mrp*saleqty) * $ActualDiscountPercent, 
	nettamount = (mrp*saleqty) -  (mrp*saleqty)*$ActualDiscountPercent, profitamount = (mrp*saleqty) -  ((mrp*saleqty)*$ActualDiscountPercent) - rate 
    WHERE invoiceno ='$Invoice';"; 
	 
    $AddPaymentMode.= " UPDATE newsaleitemsproduct SET  discountamount = 
    (mrp*saleqty) * $ActualDiscountPercent, 
nettamount = (mrp*saleqty) -  (mrp*saleqty)*$ActualDiscountPercent, profitamount = (mrp*saleqty) -  ((mrp*saleqty)*$ActualDiscountPercent) - rate 
 WHERE invoiceno ='$Invoice';"; 
 


 if (mysqli_multi_query($connection, $AddPaymentMode)) {
                
   // echo "Service Requese has been registered, Request ID is " . $last_id;
     echo "1";
     // echo $SaveSaleMaster;
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