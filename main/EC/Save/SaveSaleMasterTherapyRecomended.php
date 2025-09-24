<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Invoice"]))
{
     date_default_timezone_set("Asia/Kolkata");
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d"); 
	$currenttime = date("His");  
  
	
	   
  $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);   
  $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);   
   
  $TotalDiscountAmount = mysqli_real_escape_string($connection, $_POST["TotalDiscountAmount"]);  
   
  $TotalSaleAmount = mysqli_real_escape_string($connection, $_POST["TotalSaleAmount"]);  
  $BillDate = mysqli_real_escape_string($connection, $_POST["SaleDate"]);  
  
  $DoctorCode= mysqli_real_escape_string($connection, $_POST["DoctorReferedby"]);  
  $ReceivedAmount = mysqli_real_escape_string($connection, $_POST["ReceivedAmount"]);  
   
  $DoctorReferedby = mysqli_real_escape_string($connection, $_POST["DoctorReferedby"]);  
   
  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);    
  $ExtraCharge = mysqli_real_escape_string($connection, $_POST["ExtraCharge"]);    
  
  $TherapyDate = mysqli_real_escape_string($connection, $_POST["TherapyDate"]);    
  $TherapyTime = '00:00:00'; // mysqli_real_escape_string($connection, $_POST["TherapyTime"]);    
  $NumberofTherapy = mysqli_real_escape_string($connection, $_POST["NumberofTherapy"]);    
  
  
  $OldBalance = mysqli_real_escape_string($connection, $_POST["OldBalance"]);     
  $NewBalance = mysqli_real_escape_string($connection, $_POST["NewBalance"]);  
  $EntryType = mysqli_real_escape_string($connection, $_POST["EntryType"]);  
  $TherapyType = mysqli_real_escape_string($connection, $_POST["TherapyType"]);  
  $WaitingList = mysqli_real_escape_string($connection, $_POST["WaitingList"]);  

  $EveningTimeSlotID = stripslashes(mysqli_real_escape_string($connection, $_POST["EveningTimeSlotID"])); 
  $MorningTimeSlotID = stripslashes(mysqli_real_escape_string($connection, $_POST["MorningTimeSlotID"])); 
   
  
  if($EntryType=='SameDay')
  {
$TherapyStatus ='Closed';
  }
  else
  {
	   
	if($WaitingList==1)
	{
		$TherapyStatus ='Recomended';
	}
	else
	{
		$TherapyStatus ='Recomended';
	}
  }
  
  $CourierCharges = 0;

  
 $LocationCode = $_SESSION['SESS_LOCATION'];
 $InvoicePrefix  = 	substr($LocationCode,0,2);  
 $InvoicePrefix  = 	"L".$InvoicePrefix;  
  // $ClientID = $_SESSION["CMS_CompanyID"];
  $userid = $_SESSION["SESS_MEMBER_ID"];
  $ClientID = 1;
  // $userid = 1;
  $TotalBillValue=0;	 
 $TotalBillValue = $TotalSaleAmount*1   ;
 $SaveSaleMaster='';
  try {

 
	$SaveSaleMaster.="INSERT INTO timeslotallocation (timeslotid,totaltime,uniqueid,therapyid,bookingitemid)
	SELECT timeslotid,totaltime,uniqueid,therapyid,bookingitemid FROM timeslotallocation_temp WHERE uniqueid ='$Invoice';";
	
	$SaveSaleMaster.="delete from timeslotallocation_temp WHERE uniqueid ='$Invoice';";
	 

	

if($EntryType=='SameDay')
{ 
if($NumberofTherapy>1)

{
	$SaveSaleMaster.="insert into therapybookingmaster_recomended (bookinguniqueid,bookingdate,paitentid,doctorid,therapydate,
	therapytime,revisedtherapydate,revisedtherapytime,addedby,location,remarks,therapyid,totalsitting,fees,
	referedbydoctorid,therapystatus,closingdate) values 
	('$Invoice','$currentdate','$PaitentCode','$DoctorReferedby','$TherapyDate','$TherapyTime','$TherapyDate',
	'$TherapyTime','$userid','$LocationCode','$Remarks','0',( select max(sitingid) from therapybookingdetails_recomended 
	where bookinguniqueid='$Invoice'),'$TotalSaleAmount','$DoctorReferedby','$TherapyStatus','$currentdate');";
}
else
{
	$SaveSaleMaster.="insert into therapybookingmaster_recomended (bookinguniqueid,bookingdate,paitentid,doctorid,therapydate,
	therapytime,revisedtherapydate,revisedtherapytime,addedby,location,remarks,therapyid,totalsitting,fees,
	referedbydoctorid,therapystatus,closingdate) values 
	('$Invoice','$currentdate','$PaitentCode','$DoctorReferedby','$TherapyDate','$TherapyTime','$TherapyDate',
	'$TherapyTime','$userid','$LocationCode','$Remarks',(SELECT therapyid  FROM 
	therapybookingdetails_recomended WHERE bookinguniqueid='$Invoice'),
	( select max(sitingid) from therapybookingdetails_recomended where bookinguniqueid='$Invoice'),
	'$TotalSaleAmount','$DoctorReferedby','$TherapyStatus','$currentdate');";
}
}
else
{
if($NumberofTherapy>1)

{
	$SaveSaleMaster.="insert into therapybookingmaster_recomended (bookinguniqueid,bookingdate,paitentid,doctorid,therapydate,
	therapytime,revisedtherapydate,revisedtherapytime,addedby,location,remarks,therapyid,totalsitting,fees,referedbydoctorid,therapystatus) values 
	('$Invoice','$currentdate','$PaitentCode','$DoctorReferedby',
	( select MIN(reviseddate) from therapybookingdetails_recomended where bookinguniqueid='$Invoice'),
	(SELECT timeslot FROM timeslotallocation AS a JOIN timeslotdetails AS b ON a.timeslotid =b.id
	WHERE uniqueid ='$Invoice' HAVING MIN(timeslotid)),
	( select MIN(reviseddate) from therapybookingdetails_recomended where bookinguniqueid='$Invoice'),
	(SELECT timeslot FROM timeslotallocation AS a JOIN timeslotdetails AS b ON a.timeslotid =b.id
	WHERE uniqueid ='$Invoice' HAVING MIN(timeslotid)),
	
	'$userid','$LocationCode','$Remarks','0',( select max(sitingid) from therapybookingdetails_recomended 
	where bookinguniqueid='$Invoice'),'$TotalSaleAmount','$DoctorReferedby','$TherapyStatus');";
}
else
{
	$SaveSaleMaster.="insert into therapybookingmaster_recomended (bookinguniqueid,bookingdate,paitentid,doctorid,therapydate,
	therapytime,revisedtherapydate,revisedtherapytime,addedby,location,remarks,therapyid,totalsitting,fees,referedbydoctorid,therapystatus) values 
	('$Invoice','$currentdate','$PaitentCode','$DoctorReferedby',
	( select MIN(reviseddate) from therapybookingdetails_recomended where bookinguniqueid='$Invoice'),
	(SELECT timeslot FROM timeslotallocation AS a JOIN timeslotdetails AS b ON a.timeslotid =b.id
	WHERE uniqueid ='$Invoice' HAVING MIN(timeslotid)),
	( select MIN(reviseddate) from therapybookingdetails_recomended where bookinguniqueid='$Invoice'),
	(SELECT timeslot FROM timeslotallocation AS a JOIN timeslotdetails AS b ON a.timeslotid =b.id
	WHERE uniqueid ='$Invoice' HAVING MIN(timeslotid)),
	'$userid','$LocationCode','$Remarks',(SELECT therapyid  FROM 
	therapybookingdetails_recomended WHERE bookinguniqueid='$Invoice'),
	( select max(sitingid) from therapybookingdetails_recomended where bookinguniqueid='$Invoice'),
	'$TotalSaleAmount','$DoctorReferedby','$TherapyStatus');";
}

}

 
   
 
// $SaveSaleMaster.="  UPDATE therapyrecomendation set currentstatus='Completed' where 
// therapyid in(SELECT therapyid FROM therapybookingdetails_recomended  WHERE bookinguniqueid='$Invoice') and paitentid='$PaitentCode';"; 

 
		if (mysqli_multi_query($connection, $SaveSaleMaster)) {
			
 // echo $SaveSaleMaster;
  echo "1";
		} else {
		   echo "Error: " . $SaveSaleMaster . "" . mysqli_error($connection);
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