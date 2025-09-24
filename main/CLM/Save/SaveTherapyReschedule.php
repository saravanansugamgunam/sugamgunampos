<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["BookingID"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d");  
   
  $BookingID = mysqli_real_escape_string($connection, $_POST["BookingID"]);  
  $RevisedDate = mysqli_real_escape_string($connection, $_POST["RevisedDate"]);  
  $RevisedTime = mysqli_real_escape_string($connection, $_POST["RevisedTime"]);  
   
  $EveningTimeSlotID = stripslashes(mysqli_real_escape_string($connection, $_POST["EveningTimeSlotID"])); 
  $MorningTimeSlotID = stripslashes(mysqli_real_escape_string($connection, $_POST["MorningTimeSlotID"])); 
   
 $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
 // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
  
  try {
    $SaveSaleMaster = "UPDATE therapybookingdetails set reviseddate='$RevisedDate',nextsettingdate='$RevisedDate',revisedtime='$RevisedTime' 
		where bookinguniqueid ='$BookingID' and status = 0;"; 
		
		$SaveSaleMaster.= "UPDATE therapybookingmaster set revisedtherapydate='$RevisedDate',revisedtherapytime='$RevisedTime', therapystatus='Scheduled'
		where bookinguniqueid ='$BookingID';";
    
    $SaveSaleMaster.= "delete from timeslotallocation	where uniqueid ='$BookingID';";
     
if($EveningTimeSlotID<>'')
{
  $SaveSaleMaster.="insert INTO timeslotallocation (timeslotid,totaltime,uniqueid)
  select id,60,'$BookingID' FROM timeslotdetails WHERE id IN ($EveningTimeSlotID) ;";
}
if($MorningTimeSlotID<>'')
{
  $SaveSaleMaster.="insert INTO timeslotallocation (timeslotid,totaltime,uniqueid)
  select id,60,'$BookingID' FROM timeslotdetails WHERE id IN ($MorningTimeSlotID);";
}

 
 
 mysqli_multi_query($connection, $SaveSaleMaster); 
 
 // $StockQuery ="INSERT INTO stockdetails (productcode,purchaseqty,currentstock,locationcode,batchno,expirydate,mrp) VALUES  ('$ProductCode','$Qty','$Qty','$LocationCode','$BatchNo','$Expiry','$MRP') on duplicate key update purchaseqty = purchaseqty + '$Qty' ,
       // currentstock = currentstock + '$Qty' "; 
	 
	 // mysqli_query($connection,$StockQuery);
  
  echo 1;
 // echo  $SaveSaleMaster;
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>