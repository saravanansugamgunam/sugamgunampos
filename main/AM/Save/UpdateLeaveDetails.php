<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["EmployeeCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
 $currentdate =date("Y-m-d"); 	 
  

 $EmployeeCode = mysqli_real_escape_string($connection, $_POST["EmployeeCode"]);    
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);    
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);    
 $TotalDays = mysqli_real_escape_string($connection, $_POST["TotalDays"]);    
 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);    
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]);    

 
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];
    
 
  try {
   if($Type=='L')
   {
      $AddTimeLog = "insert into permissionlog (employeecode,permissiontype,date,
      fromtime,totime,totaltime,totaldays, createdby,remarks ) values
      ('$EmployeeCode','Leave','$currentdate','$FromDate 00:00:00','$ToDate 23:59:59','24:00:00',
      '$TotalDays','$userid','$Remarks' );"; 
   }
   else    if($Type=='P')
   {
      $AddTimeLog = "insert into permissionlog (employeecode,permissiontype,date,
      fromtime,totime,totaltime,totaldays,createdby,remarks ) values
      ('$EmployeeCode','Permission','$currentdate','$currentdate $FromDate','$currentdate $ToDate',
      '$TotalDays','1','$userid','$Remarks' );"; 
   }
   else     
   {
      $AddTimeLog = "insert into permissionlog (employeecode,permissiontype,date,
      fromtime,totime,totaltime,totaldays,createdby,remarks ) values
      ('$EmployeeCode','Week Off','$currentdate','$FromDate 00:00:00','$ToDate 23:59:59',
      '$TotalDays','1','$userid','$Remarks' );"; 
   }
 
  
     
    if(mysqli_multi_query($connection, $AddTimeLog)){ 
      echo 1;
   } else{
      // echo "ERROR: Could not able to execute $AddItem. " . mysqli_error($connection);
      // echo "0";
      echo $AddTimeLog;
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