<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["SupplierID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 
 
				
 $SupplierID = mysqli_real_escape_string($connection, strtoupper($_POST["SupplierID"]));    
 $UpdatedSupplierName = mysqli_real_escape_string($connection, strtoupper($_POST["UpdatedSupplierName"]));    
 $ContactPerson = mysqli_real_escape_string($connection, ($_POST["ContactPerson"]));    
 $ContactNo = mysqli_real_escape_string($connection, ($_POST["ContactNo"]));    
 $SupplierStatus = mysqli_real_escape_string($connection, ($_POST["SupplierStatus"]));    
 $Address = mysqli_real_escape_string($connection, ($_POST["Address"]));    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "update supliers set suplier_name='$UpdatedSupplierName',suplier_address='$Address',suplier_contact='$ContactNo',contact_person='$ContactPerson', supplierstatus='$SupplierStatus' where suplier_id='$SupplierID'"; 
 
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