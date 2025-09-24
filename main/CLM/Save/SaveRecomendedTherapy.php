<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PaitentID"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 	 
 $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);    
 $DoctorID = mysqli_real_escape_string($connection, $_POST["DoctorID"]);    
 $Therapy = mysqli_real_escape_string($connection, $_POST["Therapy"]);    
 $TherapyDate = mysqli_real_escape_string($connection, $_POST["TherapyDate"]);    
 $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);    
 $Sitting = mysqli_real_escape_string($connection, $_POST["Sitting"]);   
 $TherapyDiscount = mysqli_real_escape_string($connection, $_POST["TherapyDiscount"]);   
     if($Sitting=='' || $Sitting==0)
     {
      $Sitting=1;
     }
     $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
    $userid = $_SESSION["SESS_MEMBER_ID"];
  $ClientID = 1;
  // $userid = 1;	
  $sql='';
   
  try {
   $TotalSittings=$Sitting;
   $SittingID=1;

   $values = array();
	for ($x=0; $x<$TotalSittings; $x++){
		$values[] = "('$Therapy','$DoctorID','$PaitentID','$TherapyDate','$LocationCode','$userid',
      '$InvoiceNo','$Sitting','$SittingID','$TherapyDiscount')";
		$SittingID=$SittingID+1;
		}

      $sql.= "insert into therapyrecomendation (therapyid,doctorid,paitentid,recomendeddate,locationcode,
      addedby,uniqueid,sitting,sittingid,discountpercent) values";
      $sql.= implode(",",$values); 

   //  $AddTimeLog.= "insert into therapyrecomendation (therapyid,doctorid,paitentid,recomendeddate,locationcode,
   //  addedby,uniqueid,sitting,settingid) values
   //  ('$Therapy','$DoctorID','$PaitentID','$TherapyDate','$LocationCode','$userid','$InvoiceNo','$Sitting')"; 
   
    if(mysqli_multi_query($connection, $sql)){
      echo 1;
     } else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
      // echo "0";
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