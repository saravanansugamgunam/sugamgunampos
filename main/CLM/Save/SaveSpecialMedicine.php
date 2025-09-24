<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PaitentCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);    
 $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);    
 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);         
 $DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);      
    
  $ClientID = 1; 
  $userid = $_SESSION["SESS_MEMBER_ID"];
   
  try {
  
      $QryAddDiet = "insert into specialmedicine_patientmapping (uniquecode,patientcode,doctorcode,
      remarks,status,addedby) values
      ('$InvoiceNo','$PaitentCode','$DoctorCode','$Remarks','Pending','$userid') "; 
   
 
   if (mysqli_query($connection, $QryAddDiet)) {

      
      echo "1";
   } else {
      echo "Error: " . $QryAddDiet . "" . mysqli_error($connection);
   } 

    
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>