<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["UserID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	
 

 $UserID = mysqli_real_escape_string($connection, strtoupper($_POST["UserID"]));    
 $Group = mysqli_real_escape_string($connection, strtoupper($_POST["Group"]));       
   
  $ClientID = 1; 
   
  try {
    $AddPaymentMode = "insert into pos_usergroupmapping (groupid,userid)
	values ('$Group','$UserID') on duplicate key update groupid='$Group' ;";
     
   if (mysqli_multi_query($connection, $AddPaymentMode)) {
                
       
      echo "1";
      // echo $AddPaymentMode;
            } else {
               // echo $AddPaymentMode;
               echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
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