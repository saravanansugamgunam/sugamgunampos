<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PatientType"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $ConsultationName = mysqli_real_escape_string($connection, $_POST["PatientType"]);    
 $FeesAmount = mysqli_real_escape_string($connection, $_POST["FeesAmount"]);    
 $ConsultationType = mysqli_real_escape_string($connection, $_POST["ConsultationType"]);    
 $ID = mysqli_real_escape_string($connection, $_POST["ID"]);    
 $Status = mysqli_real_escape_string($connection, $_POST["Status"]);    
 $Duration = mysqli_real_escape_string($connection, $_POST["Duration"]);    
     
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddTimeLog = "insert into consultationmaster (consultingtype,consultationname,
    consultationcharge,consultationid,activestatus,totalminutes) values
    ('$ConsultationType','$ConsultationName','$FeesAmount','$ID','$Status','$Duration') on 
    DUPLICATE KEY UPDATE consultingtype='$ConsultationType',consultationname='$ConsultationName',
    consultationcharge='$FeesAmount',activestatus='$Status',totalminutes='$Duration' "; 
 
 mysqli_query($connection, $AddTimeLog); 
  
 echo "1";
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>