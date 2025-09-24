<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["DoctorCode"]))
{
    
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d");  
   
  $DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);   
  $Status = mysqli_real_escape_string($connection, $_POST["Status"]);   
      
 $LocationCode = $_SESSION['SESS_LOCATION']; 
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];
 

  try {
    $SaveSaleMaster = "UPDATE usermaster set onlinebookingstatus='$Status' where userid ='$DoctorCode';"; 
		 
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