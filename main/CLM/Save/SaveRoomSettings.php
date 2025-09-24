<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Room"]))
{
	 date_default_timezone_set("Asia/Kolkata");
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d");  
   $currenttime = date("His"); 
	   
 $Room = mysqli_real_escape_string($connection, $_POST["Room"]);    
 $Doctor = mysqli_real_escape_string($connection, $_POST["Doctor"]);    
     
 $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
  $PurchaseOrderItems='';
  try {

   $PurchaseOrderItems .= "delete from roomalocation where doctorid='$Doctor' and roomno='$Room' and clientid ='$LocationCode'; ";
   $PurchaseOrderItems .= "insert into roomalocation (doctorid,roomno,clientid) values
   ('$Doctor','$Room','$LocationCode') ;";



   if (mysqli_multi_query($connection, $PurchaseOrderItems)) {
       echo 1;
       // echo $PurchaseOrderMaster;
   } else {
       echo "ERROR: Could not able to execute $PurchaseOrderItems. " . mysqli_error($connection);
   }
    
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>