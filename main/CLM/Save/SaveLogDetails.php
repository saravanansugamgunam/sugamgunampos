<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Paitent"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 

 $PatientID = mysqli_real_escape_string($connection, $_POST["Paitent"]);    
 $Comments = mysqli_real_escape_string($connection, $_POST["Comments"]);    
 $Loggedat = mysqli_real_escape_string($connection, $_POST["Loggedat"]);    
    
	$UserID = $_SESSION['SESS_MEMBER_ID'];

  try {
    
      $QryAddDiet = "insert into patientlogdetails (patientid,loggedby,loggedat,comments) values
      ('$PatientID','$UserID','$Loggedat','$Comments') "; 
  
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