<?php
  
session_cache_limiter(FALSE);
session_start();
   $LocationCode = $_SESSION['SESS_LOCATION'];
//insert.php
if(isset($_POST["PurchaseID"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $PurchaseID = mysqli_real_escape_string($connection, strtoupper($_POST["PurchaseID"]));    
     
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
	  
	  
 $DeleteStock = "delete from newstockdetails_0 where  grnnumber='$PurchaseID' "; 
 mysqli_query($connection, $DeleteStock); 
 
    $AddPaymentMode = "delete from purchaseitemsnew where  grnnumber='$PurchaseID' "; 
  
 mysqli_query($connection, $AddPaymentMode); 
  
		
echo  $DeleteStock;
// echo "Purchase Entry removed Successfully";

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>