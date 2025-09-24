<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PaitentCode"]))
{
	 date_default_timezone_set("Asia/Kolkata");
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d");  
   $currenttime = date("His"); 
	   
 $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);     
 $TherapistInstruction = mysqli_real_escape_string($connection, $_POST["TherapistInstruction"]);  
 $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);  
  
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
 
  $userid = $_SESSION['SESS_MEMBER_ID'];

  
  try {
    $QryTherapistInstruction='';
   $QryTherapistInstruction.=" insert diesasemappingtherapistinstruction (instructedby,
   instruction,patientid,consultinguniqueid) values
    ('$userid','$TherapistInstruction','$PaitentCode','$InvoiceNo') "; 
	 
    

   if(mysqli_multi_query($connection, $QryTherapistInstruction)){
    echo 1;
   } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
  
   }
 
   
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}



