<?php
  
session_cache_limiter(FALSE);
session_start();

function random_num($size) {
	$alpha_key = '';
	$keys = range('A', 'Z');
	
	for ($i = 0; $i < 2; $i++) {
		$alpha_key .= $keys[array_rand($keys)];
	}
	
	$length = $size - 2;
	
	$key = '';
	$keys = range(0, 9);
	
	for ($i = 0; $i < $length; $i++) {
		$key .= $keys[array_rand($keys)];
	}
	
	return $alpha_key . $key;
}
  
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
  $BookingDate = mysqli_real_escape_string($connection, $_POST["BookingDate"]);    
  
  
  $OldBalance = mysqli_real_escape_string($connection, $_POST["OldBalance"]);     
  $NewBalance = mysqli_real_escape_string($connection, $_POST["NewBalance"]);  
  $EntryType = mysqli_real_escape_string($connection, $_POST["EntryType"]);  
  $TherapyType = mysqli_real_escape_string($connection, $_POST["TherapyType"]);  
  $WaitingList = mysqli_real_escape_string($connection, $_POST["WaitingList"]);  

  $EveningTimeSlotID = stripslashes(mysqli_real_escape_string($connection, $_POST["EveningTimeSlotID"])); 
  $MorningTimeSlotID = stripslashes(mysqli_real_escape_string($connection, $_POST["MorningTimeSlotID"])); 
  $FreeTherapy = mysqli_real_escape_string($connection, $_POST["FreeTherapy"]);  
   
  
  if($EntryType=='SameDay')
  {
$TherapyStatus ='Booked';
  }
  else
  {
	   
	if($WaitingList==1)
	{
		$TherapyStatus ='Booked';
	}
	else
	{
		$TherapyStatus ='Booked';
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

 
 $RandomeInvoiceNo = random_num(9);
  try {

	$SaveSaleMaster = "insert into consultingbillmaster (billdate,consultationuniquebill,doctorid,paitentid,
	discountamount,totalamount,locationcode,addedby,remarks,tokennumber,receivedamount,extracharge,billtype,
	oldbalance,newbalance,grossamount,einvoiceno) values 
	('$BookingDate','$Invoice','$DoctorReferedby','$PaitentCode','$TotalDiscountAmount',
	'$TotalSaleAmount'+'$TotalDiscountAmount','$LocationCode','$userid','$Remarks','0','$ReceivedAmount',
	'$ExtraCharge','Therapy','$OldBalance','$NewBalance','$TotalSaleAmount'+'$TotalDiscountAmount'+'$ExtraCharge','$RandomeInvoiceNo');";  


	$SaveSaleMaster.="INSERT INTO timeslotallocation (timeslotid,totaltime,uniqueid,therapyid,bookingitemid)
	SELECT timeslotid,totaltime,uniqueid,therapyid,bookingitemid FROM timeslotallocation_temp WHERE uniqueid ='$Invoice';";
	
		$SaveSaleMaster.="update diseasemapping_paitent set therapycompleted='1' WHERE 
	paitientid='$PaitentCode' and consultingdate ='$currentdate' ;";
	
	$SaveSaleMaster.="delete from timeslotallocation_temp WHERE uniqueid ='$Invoice';";

if($EntryType<>'SameDay')
	{
		$SaveSaleMaster.="update therapybookingdetails set bookingstatus='Booked' WHERE 
		bookinguniqueid='$Invoice' and bookingstatus <>'R-Closed' ;";
	} 
	

	// if($EveningTimeSlotID<>'')
	// {
	// 	$SaveSaleMaster.="insert INTO timeslotallocation (timeslotid,totaltime,uniqueid)
	// 	select id,60,'$Invoice' FROM timeslotdetails WHERE id IN ($EveningTimeSlotID) ;";
	// }
	// if($MorningTimeSlotID<>'')
	// {
	// 	$SaveSaleMaster.="insert INTO timeslotallocation (timeslotid,totaltime,uniqueid)
	// 	select id,60,'$Invoice' FROM timeslotdetails WHERE id IN ($MorningTimeSlotID);";
	// }

	

if($EntryType=='SameDay')
{ 
if($NumberofTherapy>1)

{
	$SaveSaleMaster.="insert into therapybookingmaster (bookinguniqueid,bookingdate,paitentid,doctorid,therapydate,
	therapytime,revisedtherapydate,revisedtherapytime,addedby,location,remarks,therapyid,totalsitting,fees,
	referedbydoctorid,therapystatus,closingdate,freebooking,einvoiceno) values 
	('$Invoice','$BookingDate','$PaitentCode','$DoctorReferedby','$TherapyDate','$TherapyTime','$TherapyDate',
	'$TherapyTime','$userid','$LocationCode','$Remarks','0',( select max(sitingid) from therapybookingdetails 
	where bookinguniqueid='$Invoice'),'$TotalSaleAmount','$DoctorReferedby','$TherapyStatus','$BookingDate',
	'$FreeTherapy','$RandomeInvoiceNo');";
}
else
{
	$SaveSaleMaster.="insert into therapybookingmaster (bookinguniqueid,bookingdate,paitentid,doctorid,therapydate,
	therapytime,revisedtherapydate,revisedtherapytime,addedby,location,remarks,therapyid,totalsitting,fees,
	referedbydoctorid,therapystatus,closingdate,freebooking,einvoiceno) values 
	('$Invoice','$BookingDate','$PaitentCode','$DoctorReferedby','$TherapyDate','$TherapyTime','$TherapyDate',
	'$TherapyTime','$userid','$LocationCode','$Remarks',(SELECT therapyid  FROM 
	therapybookingdetails WHERE bookinguniqueid='$Invoice'),
	( select max(sitingid) from therapybookingdetails where bookinguniqueid='$Invoice'),
	'$TotalSaleAmount','$DoctorReferedby','$TherapyStatus','$BookingDate','$FreeTherapy','$RandomeInvoiceNo');";
}
}
else
{
if($NumberofTherapy>1)

{
	$SaveSaleMaster.="insert into therapybookingmaster (bookinguniqueid,bookingdate,paitentid,doctorid,therapydate,
	therapytime,revisedtherapydate,revisedtherapytime,addedby,location,remarks,therapyid,totalsitting,fees,
	referedbydoctorid,therapystatus,freebooking,einvoiceno) values 
	('$Invoice','$BookingDate','$PaitentCode','$DoctorReferedby',
	( select MIN(reviseddate) from therapybookingdetails where bookinguniqueid='$Invoice'),
	(SELECT timeslot FROM timeslotallocation AS a JOIN timeslotdetails AS b ON a.timeslotid =b.id
	WHERE uniqueid ='$Invoice' HAVING MIN(timeslotid)),
	( select MIN(reviseddate) from therapybookingdetails where bookinguniqueid='$Invoice'),
	(SELECT timeslot FROM timeslotallocation AS a JOIN timeslotdetails AS b ON a.timeslotid =b.id
	WHERE uniqueid ='$Invoice' HAVING MIN(timeslotid)),
	
	'$userid','$LocationCode','$Remarks','0',( select max(sitingid) from therapybookingdetails 
	where bookinguniqueid='$Invoice'),'$TotalSaleAmount','$DoctorReferedby','$TherapyStatus',
	'$FreeTherapy','$RandomeInvoiceNo');";
}
else
{
	$SaveSaleMaster.="insert into therapybookingmaster (bookinguniqueid,bookingdate,paitentid,doctorid,therapydate,
	therapytime,revisedtherapydate,revisedtherapytime,addedby,location,remarks,therapyid,totalsitting,fees,
	referedbydoctorid,therapystatus,freebooking,einvoiceno) values 
	('$Invoice','$BookingDate','$PaitentCode','$DoctorReferedby',
	( select MIN(reviseddate) from therapybookingdetails where bookinguniqueid='$Invoice'),
	(SELECT timeslot FROM timeslotallocation AS a JOIN timeslotdetails AS b ON a.timeslotid =b.id
	WHERE uniqueid ='$Invoice' HAVING MIN(timeslotid)),
	( select MIN(reviseddate) from therapybookingdetails where bookinguniqueid='$Invoice'),
	(SELECT timeslot FROM timeslotallocation AS a JOIN timeslotdetails AS b ON a.timeslotid =b.id
	WHERE uniqueid ='$Invoice' HAVING MIN(timeslotid)),
	'$userid','$LocationCode','$Remarks',(SELECT therapyid  FROM 
	therapybookingdetails WHERE bookinguniqueid='$Invoice'),
	( select max(sitingid) from therapybookingdetails where bookinguniqueid='$Invoice'),
	'$TotalSaleAmount','$DoctorReferedby','$TherapyStatus','$FreeTherapy','$RandomeInvoiceNo');";
}

}




// TherapyType

	$SaveSaleMaster.="  INSERT INTO consultingdetails  (consultationuniquebill,consultationid,consultationname,
	consultationcharge,discount,doctorid,paitentid,consultationtotal,createdon, clientid,addedby,extracharge ) 
	  
SELECT bookinguniqueid,therapyid,'-',rate,discount,doctorid,paitentid,SUM(rate),addedon,location,'1',0 FROM 
	therapybookingdetails WHERE bookinguniqueid='$Invoice' and bookingstatus <>'R-Closed'
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
('Therapy','Therapy Bill','$Invoice','$BookingDate','$PaitentCode','$TotalBillValue' ,'0','$userid','$LocationCode','$Remarks');";

// if($OldBalance < $ReceivedAmount)
// {
// 	// Adjust on old balance
// }
// else
// {

// 	$SaveSaleMaster.= "";
//}

	if($ReceivedAmount>0)
	{
		if($TotalBillValue > $ReceivedAmount  )
		{
			$SaveSaleMaster.= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
			creditamount,createdby,clientid,remarks)
			VALUES 
			('Therapy','Therapy - Advance Payment','$Invoice','$BookingDate','$PaitentCode','0','$ReceivedAmount','$userid','$LocationCode','$Remarks');";
			
		}
		else
		{   $SaveSaleMaster.= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
			creditamount,createdby,clientid,remarks)
			VALUES 
			('Therapy','Therapy - Payment','$Invoice','$BookingDate','$PaitentCode','0','$ReceivedAmount','$userid','$LocationCode','$Remarks');";
			

		}
	
	}
 
	if($NewBalance<>0)
	{
	   $SaveSaleMaster.= "insert into outstandingdetails (uniqueno,totalamount,outstandingamount,date,transactiontype,createdby) values 
		('$Invoice','$TotalSaleAmount','$NewBalance','$BookingDate','Therapy - Sale','$userid');";  
	}


	
	
$SaveSaleMaster.="  UPDATE paitentmaster set topay=topay+'$TotalSaleAmount'+'$CourierCharges', 
receipt =receipt+'$ReceivedAmount' where paitentid='$PaitentCode';"; 

$SaveSaleMaster.="  UPDATE therapyrecomendation set currentstatus='Completed' where 
therapyid in(SELECT therapyid FROM therapybookingdetails  WHERE bookinguniqueid='$Invoice') and paitentid='$PaitentCode';"; 

 

$SaveSaleMaster.=" UPDATE therapybookingmaster_recomended SET therapystatus='Booked' 
WHERE bookinguniqueid='$Invoice';"; 

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