<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Referedby"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
 $currentdate =date("Y-m-d H:i:s"); 	 
   

 $Referedby = mysqli_real_escape_string($connection, $_POST["Referedby"]);    
 $MedicinePercentage = mysqli_real_escape_string($connection, $_POST["MedicinePercentage"]);   
 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);   
 $ConsultingPercentage = mysqli_real_escape_string($connection, $_POST["ConsultingPercentage"]);   
 $CoursePercentage = mysqli_real_escape_string($connection, $_POST["CoursePercentage"]);   
 $TherapyPercentage = mysqli_real_escape_string($connection, $_POST["TherapyPercentage"]);   
 $ReferedbyID = mysqli_real_escape_string($connection, $_POST["ReferedbyID"]);   
 $EntryType = mysqli_real_escape_string($connection, $_POST["EntryType"]);      

 $Location = mysqli_real_escape_string($connection, $_POST["Location"]);      
 $MobileNo = mysqli_real_escape_string($connection, $_POST["MobileNo"]);      
 $Clinic = mysqli_real_escape_string($connection, $_POST["Clinic"]);      

   
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1; 
  $userid = $_SESSION['SESS_MEMBER_ID'];
   
  try {
     if( $EntryType=='Edit')
     {
      $AddTimeLog ='';
      $AddTimeLog.= "update referencemaster set reference='$Referedby',medicinepercent='$MedicinePercentage',
      consultingpercent='$ConsultingPercentage',coursepercent='$CoursePercentage',
      therapypercent='$TherapyPercentage',
      remarks='$Remarks',
      location='$Location',mobileno='$MobileNo',institute='$Clinic'  where referenceid='$ReferedbyID';"; 
    
     }
     else
     {
      $AddTimeLog ='';
      $AddTimeLog.= "insert into referencemaster (reference,referencestatus,medicinepercent,
      consultingpercent,therapypercent,coursepercent,remarks,
      createdby,location,mobileno,institute) values
      ('$Referedby','Active','$MedicinePercentage','$ConsultingPercentage',
      '$TherapyPercentage','$CoursePercentage','$Remarks','$userid','$Location','$MobileNo','$Clinic');"; 
    
     }
 
    if(mysqli_multi_query($connection, $AddTimeLog)){ 
      echo 1;
      // echo $AddTimeLog;
   } else{
       echo "ERROR: Could not able to execute $AddItem. " . mysqli_error($connection);
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