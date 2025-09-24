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
  
  $DoctorReferedby= mysqli_real_escape_string($connection, $_POST["DoctorReferedby"]);  
  $ReceivedAmount = mysqli_real_escape_string($connection, $_POST["ReceivedAmount"]);  
   
  $DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);  
   
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
	$TherapyStatus ='Scheduled';
  }
  
  $CourierCharges = 0;
   
  if($WaitingList==1)
	{
		$TherapyStatus ='Booked';
	}
	else
	{
		$TherapyStatus ='Scheduled';
	}


    
 $LocationCode = $_SESSION['SESS_LOCATION'];
 $InvoicePrefix  = 	substr($LocationCode,0,2);  
 $InvoicePrefix  = 	"L".$InvoicePrefix;  
  // $ClientID = $_SESSION["CMS_CompanyID"];
  $userid = $_SESSION["SESS_MEMBER_ID"];
  $ClientID = 1;
  // $userid = 1;	 
 
  try {

	$SaveSaleMaster = "insert into consultingbillmaster (billdate,consultationuniquebill,doctorid,paitentid,
	discountamount,totalamount,locationcode,addedby,remarks,tokennumber,receivedamount,extracharge,billtype,
	oldbalance,newbalance,grossamount) values 
	('$currentdate','$Invoice','$DoctorCode','$PaitentCode','$TotalDiscountAmount',
	'$TotalSaleAmount'+'$TotalDiscountAmount','$LocationCode','$userid','$Remarks','0','$ReceivedAmount',
	'$ExtraCharge','Therapy','$OldBalance','$NewBalance','$TotalSaleAmount'+'$TotalDiscountAmount'+'$ExtraCharge');";  

	if($EveningTimeSlotID<>'')
	{
		$SaveSaleMaster.="insert INTO timeslotallocation (timeslotid,totaltime,uniqueid)
		select id,60,'$Invoice' FROM timeslotdetails WHERE id IN ($EveningTimeSlotID) ;";
	}
	if($MorningTimeSlotID<>'')
	{
		$SaveSaleMaster.="insert INTO timeslotallocation (timeslotid,totaltime,uniqueid)
		select id,60,'$Invoice' FROM timeslotdetails WHERE id IN ($MorningTimeSlotID);";
	}

	

if($EntryType=='SameDay')
{ 
if($NumberofTherapy>1)

{
	$SaveSaleMaster.="insert into therapybookingmaster (bookinguniqueid,bookingdate,paitentid,doctorid,therapydate,
	therapytime,revisedtherapydate,revisedtherapytime,addedby,location,remarks,therapyid,totalsitting,fees,
	referedbydoctorid,therapystatus,closingdate) values 
	('$Invoice','$currentdate','$PaitentCode','$DoctorCode','$TherapyDate','$TherapyTime','$TherapyDate',
	'$TherapyTime','$userid','$LocationCode','$Remarks','0',( select max(sitingid) from therapybookingdetails 
	where bookinguniqueid='$Invoice'),'$TotalSaleAmount','$DoctorReferedby','$TherapyStatus','$currentdate');";
}
else
{
	$SaveSaleMaster.="insert into therapybookingmaster (bookinguniqueid,bookingdate,paitentid,doctorid,therapydate,
	therapytime,revisedtherapydate,revisedtherapytime,addedby,location,remarks,therapyid,totalsitting,fees,
	referedbydoctorid,therapystatus,closingdate) values 
	('$Invoice','$currentdate','$PaitentCode','$DoctorCode','$TherapyDate','$TherapyTime','$TherapyDate',
	'$TherapyTime','$userid','$LocationCode','$Remarks',(SELECT therapyid  FROM 
	therapybookingdetails WHERE bookinguniqueid='$Invoice'),
	( select max(sitingid) from therapybookingdetails where bookinguniqueid='$Invoice'),
	'$TotalSaleAmount','$DoctorReferedby','$TherapyStatus','$currentdate');";
}
}
else
{
if($NumberofTherapy>1)

{
	$SaveSaleMaster.="insert into therapybookingmaster (bookinguniqueid,bookingdate,paitentid,doctorid,therapydate,
	therapytime,revisedtherapydate,revisedtherapytime,addedby,location,remarks,therapyid,totalsitting,fees,referedbydoctorid,therapystatus) values 
	('$Invoice','$currentdate','$PaitentCode','$DoctorCode','$TherapyDate','$TherapyTime','$TherapyDate',
	'$TherapyTime','$userid','$LocationCode','$Remarks','0',( select max(sitingid) from therapybookingdetails 
	where bookinguniqueid='$Invoice'),'$TotalSaleAmount','$DoctorReferedby','$TherapyStatus');";
}
else
{
	$SaveSaleMaster.="insert into therapybookingmaster (bookinguniqueid,bookingdate,paitentid,doctorid,therapydate,
	therapytime,revisedtherapydate,revisedtherapytime,addedby,location,remarks,therapyid,totalsitting,fees,referedbydoctorid,therapystatus) values 
	('$Invoice','$currentdate','$PaitentCode','$DoctorCode','$TherapyDate','$TherapyTime','$TherapyDate',
	'$TherapyTime','$userid','$LocationCode','$Remarks',(SELECT therapyid  FROM 
	therapybookingdetails WHERE bookinguniqueid='$Invoice'),
	( select max(sitingid) from therapybookingdetails where bookinguniqueid='$Invoice'),
	'$TotalSaleAmount','$DoctorReferedby','$TherapyStatus');";
}

}




// TherapyType

	$SaveSaleMaster.="  INSERT INTO consultingdetails  (consultationuniquebill,consultationid,consultationname,
	consultationcharge,discount,doctorid,paitentid,consultationtotal,createdon, clientid,addedby,extracharge ) 
	  
SELECT bookinguniqueid,therapyid,'-',rate,discount,doctorid,paitentid,SUM(rate),addedon,location,'1',0 FROM 
	therapybookingdetails WHERE bookinguniqueid='$Invoice'
GROUP BY bookinguniqueid,therapyid,rate,discount,doctorid,paitentid,addedon,location 
ON DUPLICATE KEY UPDATE consultationuniquebill = '$Invoice' ;";

$SaveSaleMaster.= " insert into therapyallotment (bookinguniqueid,doctorid,bookeddate,bookedfromtime,
allotedtime,bookiedendtime)   
SELECT bookinguniqueid,doctorid,reviseddate,revisedtime,(SELECT SUM(totalhours) FROM (
SELECT therapyid,totalhours  FROM therapybookingdetails WHERE bookinguniqueid ='$Invoice'
GROUP BY therapyid,totalhours ) AS a) AS Addminute,
DATE_ADD(revisedtime,INTERVAL (SELECT SUM(totalhours) FROM (
SELECT therapyid,totalhours  FROM therapybookingdetails WHERE bookinguniqueid ='$Invoice'
GROUP BY therapyid,totalhours ) AS a) MINUTE) AS Endtime
 FROM therapybookingdetails WHERE bookinguniqueid ='$Invoice'
LIMIT 1;";

$SaveSaleMaster.= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
creditamount,createdby,clientid,remarks)
VALUES 
('Thrapy','Invoice','$Invoice','$TherapyDate','$PaitentCode','$TotalSaleAmount'+'$CourierCharges','0','$userid','$LocationCode','$Remarks');";


 if($TotalSaleAmount>0)
 {
	$SaveSaleMaster.= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
creditamount,createdby,clientid,remarks)
VALUES 
('Thrapy','Payment','$Invoice','$TherapyDate','$PaitentCode','0','$ReceivedAmount','$userid','$LocationCode','$Remarks');";

 }

$SaveSaleMaster.="  UPDATE paitentmaster set topay=topay+'$TotalSaleAmount'+'$CourierCharges', 
receipt =receipt+'$ReceivedAmount' where paitentid='$PaitentCode';"; 

$SaveSaleMaster.="  UPDATE therapyrecomendation set currentstatus='Completed' where 
therapyid in(SELECT therapyid FROM therapybookingdetails  WHERE bookinguniqueid='$Invoice') and paitentid='$PaitentCode';"; 

 $SaveSaleMaster.= "  UPDATE salepaymentdetails set completionstatus =1 where invoiceno='$Invoice'; ";
 


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