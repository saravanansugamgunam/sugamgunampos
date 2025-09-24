<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["UserID"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s");  
  
  $UserID = mysqli_real_escape_string($connection, $_POST["UserID"]);      
  $CheckAllStatus = mysqli_real_escape_string($connection, $_POST["CheckAllStatus"]);  
  $SelectedBill = stripslashes(mysqli_real_escape_string($connection, $_POST["SelectedBill"])); 
  
  try { 
   // $AssignedDate = date('Y-m-d', strtotime($FromDate. ' + 1 days'));
   $SaveSaleMaster='';   
   if ($CheckAllStatus == 1) {
      
      $SaveSaleMaster.= " delete from therapytherapistmapping where therapistid='$UserID';";

      $SaveSaleMaster.= " INSERT INTO therapytherapistmapping (therapyid,therapistid) 
      SELECT consultationid,'$UserID' FROM consultationmaster WHERE 
      consultingtype ='Therapy' AND activestatus ='Active' ;";
   }
   else
   {
      $SaveSaleMaster.= " INSERT INTO therapytherapistmapping (therapyid,therapistid)
      SELECT consultationid,'$UserID' FROM consultationmaster WHERE 
      consultationid in($SelectedBill) and consultingtype ='Therapy' 
      AND activestatus ='Active' ;";
   }
  
            if (mysqli_multi_query($connection, $SaveSaleMaster)) {
                
    // echo "Service Requese has been registered, Request ID is " . $last_id;
	   echo "1";
	   // echo $SaveSaleMaster;
            } else {
               echo $SaveSaleMaster;
               // echo "Error: " . $SaveSaleMaster . "" . mysqli_error($connection);
            } 
   // echo $AddBatch;

     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>