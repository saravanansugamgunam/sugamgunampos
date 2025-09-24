<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Count"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	 
 $EntryDate = mysqli_real_escape_string($connection, $_POST["EntryDate"]);    
 $PatientType = mysqli_real_escape_string($connection, $_POST["PatientType"]);   
 $Count = mysqli_real_escape_string($connection, $_POST["Count"]);   
 $Fees = mysqli_real_escape_string($connection, $_POST["Fees"]);   
 $TotalAmount = mysqli_real_escape_string($connection, $_POST["TotalAmount"]);  
     $EntryDate = explode('/', $EntryDate); 
$ActualEntryDate = $EntryDate[2].'-'.$EntryDate[1].'-'.$EntryDate[0];
$LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddTimeLog = "insert into patiententrydetails (clientid,entrydate,typeid,fees,count,total,addedby) values
    ('$LocationCode','$ActualEntryDate','$PatientType','$Fees','$Count','$TotalAmount','$userid')"; 
 
 mysqli_query($connection, $AddTimeLog); 
  
 echo "Added Successfuly";
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>