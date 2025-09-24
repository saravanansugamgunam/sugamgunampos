<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["ProductID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $ProductID = mysqli_real_escape_string($connection, strtoupper($_POST["ProductID"]));    
 $ProductName = mysqli_real_escape_string($connection, strtoupper($_POST["UpdatedProductName"]));    
 $ProductStatus = mysqli_real_escape_string($connection, ($_POST["ProductStatus"])); 

 $HSNName = mysqli_real_escape_string($connection, ($_POST["HSNName"])); 
 $GSTPercent = mysqli_real_escape_string($connection, ($_POST["GSTPercent"])); 

 $ShortCode = mysqli_real_escape_string($connection, ($_POST["ShortCode"])); 
 $Weight = mysqli_real_escape_string($connection, ($_POST["Weight"])); 
 $IsMRPUpdate = mysqli_real_escape_string($connection, ($_POST["IsMRPUpdate"])); 
 $BarcodeUpdate = mysqli_real_escape_string($connection, ($_POST["BarcodeUpdate"])); 
 
 

 
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "update productmaster set productname='$ProductName',
     status='$ProductStatus',gstpercentage='$GSTPercent',hsncode='$HSNName',
     productshortcode='$ShortCode', uniquebarcode='$BarcodeUpdate',
     Weight='$Weight' ,ismrp='$IsMRPUpdate' where productid='$ProductID'"; 
    
    
     if (mysqli_query($connection, $AddPaymentMode)) {
                
      // echo "Service Requese has been registered, Request ID is " . $last_id;
        echo  1;
         // echo $PurchaseMaster;
              } else {
                  echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
              // echo $PurchaseMaster;
              } 
    

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}
