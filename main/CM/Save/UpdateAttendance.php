 
<?php
 
session_cache_limiter(FALSE);
session_start();
   include("../../../connect.php"); 
 $currentdate =date("Y-m-d");  
 
if(isset($_POST["UserID"]))
{  
 
 // $Status=1;
  $UserID = mysqli_real_escape_string($connection,$_POST["UserID"]); 
  
	
	$AddLead = "insert into attendanceregister_student(userid) values ('$UserID')"; 
 
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