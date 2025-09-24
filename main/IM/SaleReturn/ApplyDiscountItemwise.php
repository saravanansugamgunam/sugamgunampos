<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["SaleId"]))
{
  
 // echo "1";
 include("../../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $DiscountPercent = mysqli_real_escape_string($connection, strtoupper($_POST["DiscountPercent"]));    
 $Invoice = mysqli_real_escape_string($connection, strtoupper($_POST["Invoice"]));    
 $SaleId = mysqli_real_escape_string($connection, ($_POST["SaleId"]));    
  $ActualDiscountPercent = $DiscountPercent /100;
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = " UPDATE newsaleitems SET  discountamount = mrp * $ActualDiscountPercent, 
	nettamount = mrp -  mrp*$ActualDiscountPercent, profitamount = mrp -  (mrp*$ActualDiscountPercent) - rate  WHERE saleid ='$SaleId'"; 
 
 mysqli_query($connection, $AddPaymentMode); 
echo "Added Successfuly";

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>