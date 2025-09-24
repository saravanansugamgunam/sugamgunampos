<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["StaffCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
 $currentdate =date("Y-m-d H:i:s"); 	 
    
 
 $StaffCode = mysqli_real_escape_string($connection, $_POST["StaffCode"]);    
 $EntryDate = mysqli_real_escape_string($connection, $_POST["EntryDate"]);   
 $CurrentSalary = mysqli_real_escape_string($connection, $_POST["CurrentSalary"]);   
 $NewSalary = mysqli_real_escape_string($connection, $_POST["NewSalary"]);   
 $CurrentDesignationID = mysqli_real_escape_string($connection, $_POST["CurrentDesignationID"]);   
 $NewDesignationID = mysqli_real_escape_string($connection, $_POST["NewDesignationID"]);    
 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);    
   
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];
   
  try {
    $AddTimeLog = "insert into promotiondetails (employeecode,promotedate,oldsalary,newsalary,
    olddesignation,newdesignation,remarks,createdby) values
    ('$StaffCode','$EntryDate','$CurrentSalary','$NewSalary','$CurrentDesignationID','$NewDesignationID',
    '$Remarks','$userid');"; 

    $AddTimeLog .= "update usermaster set salary='$NewSalary',designationid='$NewDesignationID' where 
    userid ='$StaffCode' "; 
  
     
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
