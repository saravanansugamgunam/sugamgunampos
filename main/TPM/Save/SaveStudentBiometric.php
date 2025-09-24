 
<?php
 
session_cache_limiter(FALSE);
session_start();
   include("../../../connect.php"); 
 $currentdate =date("Y-m-d");  
 
if(isset($_POST["Status"]))
{  
 
 // $Status=1;
  $UserID = mysqli_real_escape_string($connection,$_POST["UserID"]); 
  $Status = mysqli_real_escape_string($connection,$_POST["Status"]); 
  $ImaegInfo = mysqli_real_escape_string($connection,$_POST["ImaegInfo"]); 
  $ISOTemplate = mysqli_real_escape_string($connection,$_POST["ISOTemplate"]); 
    
	
	$AddLead = "update studentmaster set biometricstatus='Yes',imgstatus='$Status',imginfo='$ImaegInfo',isotemplate='$ISOTemplate' where studentcode ='$UserID'"; 
 
  mysqli_query($connection, $AddLead); 
   
 
 echo "1";
 // echo $AddLead;

 // echo "Sucess";
   
}
else
{
	echo "0";
}


 
?> 