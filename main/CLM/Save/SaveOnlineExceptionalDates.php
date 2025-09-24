<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["DoctorCode"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s");   

 
  
  $ExceptionalDate = mysqli_real_escape_string($connection, $_POST["ExceptionalDate"]);      
  $DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);      
  $AllDoctorFlag = mysqli_real_escape_string($connection, $_POST["AllDoctorFlag"]);   

  
  try {  
   $SaveSaleMaster='';   
 
      $SaveSaleMaster.= "insert into onlineexceptionaldatemaster (doctorcode,exceptionaldate) values 
      ('$DoctorCode','$ExceptionalDate');"; 
    
 
   if (mysqli_multi_query($connection, $SaveSaleMaster)) {
         echo "1"; 
   } else {
      echo "Error: " . $SaveSaleMaster . "" . mysqli_error($connection);
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