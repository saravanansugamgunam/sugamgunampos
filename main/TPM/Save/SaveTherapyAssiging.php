<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["TherapyID"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d");  
   
  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);  
  $Doctor = mysqli_real_escape_string($connection, $_POST["userid"]);  
  $ScheduledDate = mysqli_real_escape_string($connection, $_POST["ScheduledDate"]);  
  $ScheduledTime = mysqli_real_escape_string($connection, $_POST["ScheduledTime"]);  
  $TherapyID = mysqli_real_escape_string($connection, $_POST["TherapyID"]);  
  $UniqueID = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);  
    
  
 $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
 // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];

  try {
    $SaveSaleMaster = "UPDATE therapybookingdetails set reviseddate='$ScheduledDate',nextsettingdate='$ScheduledDate',
    revisedtime='$ScheduledTime' where bookinguniqueid ='$TherapyID' and status = 0;"; 
		
		$SaveSaleMaster.= "UPDATE therapybookingmaster set revisedtherapydate='$ScheduledDate',
    revisedtherapytime='$ScheduledTime',therapystatus='Scheduled' where bookinguniqueid ='$TherapyID';"; 
 
if(mysqli_multi_query($connection, $SaveSaleMaster)){ 
   echo 1;
 // echo $SaveSaleMaster;
} else{
  // echo "ERROR: Could not able to execute $AddItem. " . mysqli_error($connection);
  // echo "0";
  echo $SaveSaleMaster;
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