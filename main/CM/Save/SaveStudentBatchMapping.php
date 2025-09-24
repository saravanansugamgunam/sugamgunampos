<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["BatchCode"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s"); 							  
 $StudentCode = mysqli_real_escape_string($connection, $_POST["StudentCode"]);    
 $MobileNo = mysqli_real_escape_string($connection, $_POST["MobileNo"]);    
 $StudentName = mysqli_real_escape_string($connection, $_POST["StudentName"]);    
 $Gender = mysqli_real_escape_string($connection, $_POST["StudentCode"]);    
 $DOB = mysqli_real_escape_string($connection, $_POST["DOB"]);    
 $BatchCode = mysqli_real_escape_string($connection, $_POST["BatchCode"]);    
 $CourseCode = mysqli_real_escape_string($connection, $_POST["CourseCode"]);    
 $CourseName = mysqli_real_escape_string($connection, $_POST["CourseName"]);    
 $Commences = mysqli_real_escape_string($connection, $_POST["Commences"]);    
 $StudentFee = mysqli_real_escape_string($connection, $_POST["StudentFee"]);    
 $BatchFee = mysqli_real_escape_string($connection, $_POST["BatchFee"]);    
 
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddBatch = "insert into studentbatchmapping
	(batchcode,studentcode,studentmobileno,studentname,coursecode,coursename,coursefees,studentfees,addedby,addedon) values ('$BatchCode','$StudentCode','$MobileNo','$StudentName','$CourseCode','$CourseName','$BatchFee','$StudentFee','$userid','$currentdate')"; 
 
 mysqli_query($connection, $AddBatch); 
  
 echo "Added Successfuly";
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>