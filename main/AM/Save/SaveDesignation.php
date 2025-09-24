<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Designation"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
 $currentdate =date("Y-m-d H:i:s"); 	 
 $DesignationID = mysqli_real_escape_string($connection, $_POST["DesignationID"]);    
 $Designation = mysqli_real_escape_string($connection, $_POST["Designation"]);   
 $Status = mysqli_real_escape_string($connection, $_POST["Status"]);   
 

  $ClientID =  $_SESSION['SESS_LOCATION'];
  $userid = $_SESSION['SESS_MEMBER_ID'];
   
  try {
     if($DesignationID >0)
     {
      $AddDesignation = "update  designationmaster set designation='$Designation',createdby='$userid',
      activestatus='$Status' where id ='$DesignationID' "; 
     }
     else
     {
      $AddDesignation = "insert into designationmaster (designation,createdby,activestatus) values
      ('$Designation','$userid','$Status')"; 
     }
   
   if(mysqli_query($connection, $AddDesignation)){
      echo 1;
   } else{
      // echo "ERROR: Could not able to execute $AddItem. " . mysqli_error($connection);
      echo 0;
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