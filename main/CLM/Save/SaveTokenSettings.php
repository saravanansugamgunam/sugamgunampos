<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Room1Caption"]))
{
	 date_default_timezone_set("Asia/Kolkata");
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d");  
   $currenttime = date("His"); 
	   
 $Room1Caption = mysqli_real_escape_string($connection, $_POST["Room1Caption"]);    
 $Room2Caption = mysqli_real_escape_string($connection, $_POST["Room2Caption"]);   
 $DisplayPatientName = mysqli_real_escape_string($connection, $_POST["DisplayPatientName"]);   
  
     
 $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
  
  try {
    $SavePrescription = "update tokensettings set  tokendisplayroom1 ='$Room1Caption' ,tokendisplayroom2='$Room2Caption', 
    paitentnamedisplay='$DisplayPatientName' where clientid='$LocationCode';"; 
	 
 
 mysqli_query($connection, $SavePrescription); 
  
  // echo 1;
 echo  $SavePrescription;
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>