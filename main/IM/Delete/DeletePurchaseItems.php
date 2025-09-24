<?php
  
session_cache_limiter(FALSE);
session_start();
   $LocationCode = $_SESSION['SESS_LOCATION'];
//insert.php
if(isset($_POST["GRNNo"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $ItemID = mysqli_real_escape_string($connection, strtoupper($_POST["ItemID"]));    
 $GRNNo = mysqli_real_escape_string($connection, strtoupper($_POST["GRNNo"]));    
 
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "delete from purchaseitemsnew where grnnumber='$GRNNo' and productcode='$ItemID' "; 
  
 mysqli_query($connection, $AddPaymentMode); 
echo "Product removed Successfully";

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>