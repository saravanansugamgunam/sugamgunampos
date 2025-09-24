<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["CourseCode"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $CourseFee = mysqli_real_escape_string($connection, $_POST["CourseFee"]);    
 $CourseCode = mysqli_real_escape_string($connection, $_POST["CourseCode"]);    
 $BatchName = mysqli_real_escape_string($connection, $_POST["BatchName"]);   
 $BatchCommences = mysqli_real_escape_string($connection, $_POST["BatchCommences"]);   
 $BatchFee = mysqli_real_escape_string($connection, $_POST["BatchFee"]);   
 $BatchDescription = mysqli_real_escape_string($connection, $_POST["BatchDescription"]);   
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddBatch = "insert into batchmaster (clientid,coursecode,coursefee,batchname,batchcommences,batchfee,description,addedby,addedon,activestatus) values ('$ClientID','$CourseCode','$CourseFee','$BatchName','$BatchCommences','$BatchFee','$BatchDescription','$userid','$currentdate','Active')"; 
 
 mysqli_query($connection, $AddBatch); 
  
 echo "New Batch Added Successfuly";
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding new batch";
}

?>