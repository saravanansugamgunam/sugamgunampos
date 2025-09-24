<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["TherapyName"]))
{
  
//    echo "1";
 include("../../../connect.php"); 
 $currentdate =date("Y-m-d"); 
 $BookingTime =date("H:i:s"); 
 $LineAmount =0;
	   
 $PaitentName = mysqli_real_escape_string($connection, $_POST["PaitentName"]);    
 $TherapyName = mysqli_real_escape_string($connection, $_POST["TherapyName"]);    
 $DoctorReferedby= mysqli_real_escape_string($connection, $_POST["DoctorReferedby"]);   
 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);   
 $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);
 $TotalHours = mysqli_real_escape_string($connection, $_POST["TotalHours"]); 
 $EveningTimeSlotID = stripslashes(mysqli_real_escape_string($connection, $_POST["EveningTimeSlotID"])); 
 $MorningTimeSlotID = stripslashes(mysqli_real_escape_string($connection, $_POST["MorningTimeSlotID"])); 
  
 $EntryType = mysqli_real_escape_string($connection, $_POST["EntryType"]);  
 
 $ModeofCollection = mysqli_real_escape_string($connection, $_POST["ModeofCollection"]); 
 $CollectionTime = mysqli_real_escape_string($connection, $_POST["CollectionTime"]); 
  
 
 $MRP = mysqli_real_escape_string($connection, $_POST["MRP"]);   
 $Discount = mysqli_real_escape_string($connection, $_POST["Discount"]);   
 $TotalSittings = mysqli_real_escape_string($connection, $_POST["TotalSittings"]);   
 $TotalAmount = mysqli_real_escape_string($connection, $_POST["TotalAmount"]);   
 $LineAmount =  ($MRP*1) - (($Discount*1)/ $TotalSittings);
 $LineDiscount = (($Discount*1)/ $TotalSittings);
 $LocationCode = $_SESSION['SESS_LOCATION'];
 
 $SittingTime = mysqli_real_escape_string($connection, $_POST["SittingTime"]);   
 $SittingDate = mysqli_real_escape_string($connection, $_POST["SittingDate"]);   
 $Therapist = mysqli_real_escape_string($connection, $_POST["Therapist"]);   
 

  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  
  $ClientID = 1;
  $userid = 1;	
  $SittingID=1;
  $sql='';
     
 

 $sql.= "insert into therapybookingdetails (paitentid,doctorid,bookingdate,bookingtime,therapyid,location,
 remarks,reviseddate,revisedtime,closingdate,bookinguniqueid,rate,discount,
 totalsitings,nettamount,nextsettingdate,sitingid,referedbydoctorid,totalhours,bookingstatus,
 collectiontime,modeofcollection) values
 ('$PaitentName','$Therapist','$currentdate','$BookingTime','$TherapyName','$LocationCode','$Remarks','$SittingDate',
 '$SittingTime','$SittingDate','$InvoiceNo','$MRP','$LineDiscount', ' $TotalSittings', '$LineAmount','$SittingDate',
 '$TotalSittings','$DoctorReferedby','$TotalHours','Booked','$CollectionTime' ,'$ModeofCollection');"; 

  
	  
		
if(mysqli_multi_query($connection, $sql)){
	 echo 1;

	 $last_id = mysqli_insert_id($connection);
 
 if($EveningTimeSlotID<>'')
 {
	 $TimeSlotUpdate="insert INTO timeslotallocation_temp (timeslotid,totaltime,uniqueid,therapyid,bookingitemid)
	 select id,60,'$InvoiceNo','$TherapyName','$last_id' FROM timeslotdetails WHERE id IN ($EveningTimeSlotID) ;";
 }
 if($MorningTimeSlotID<>'')
 {
	 $TimeSlotUpdate="insert INTO timeslotallocation_temp (timeslotid,totaltime,uniqueid,therapyid,bookingitemid)
	 select id,60,'$InvoiceNo','$TherapyName','$last_id' FROM timeslotdetails WHERE id IN ($MorningTimeSlotID);";
 }

 if(mysqli_multi_query($connection, $TimeSlotUpdate)){
 }

	// echo $sql;


  } else{
	echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
 
  }
	 
}
else
{
	echo "Error Adding";
}

?>