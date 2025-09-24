<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["BookingID"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d");  
   
  $BookingID = mysqli_real_escape_string($connection, $_POST["BookingID"]);  
  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);    
   
 $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
 $userid = $_SESSION["SESS_MEMBER_ID"];
  $ClientID = 1;
  // $userid = 1;	
  $SaveSaleMaster='';
  try {
	  
    $SaveSaleMaster = "UPDATE therapyrecomendation set currentstatus='Cancelled' 
						where uniqueid ='$BookingID' and  currentstatus='Pending';"; 
  
 mysqli_multi_query($connection, $SaveSaleMaster); 
  
  
  echo 1;
  // echo  $SaveSaleMaster;
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>