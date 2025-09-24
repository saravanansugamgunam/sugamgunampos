<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["TherapyName"]))
{
  
//    echo "1";
 include("../../../connect.php"); 
 $currentdate =date("Y-m-d"); 
 $LineAmount =0;
	   
 $PaitentName = mysqli_real_escape_string($connection, $_POST["PaitentName"]);    
 $TherapyName = mysqli_real_escape_string($connection, $_POST["TherapyName"]);   
 $BookingDate = mysqli_real_escape_string($connection, $_POST["BookingDate"]);   
 $BookingTime = mysqli_real_escape_string($connection, $_POST["BookingTime"]);   
 $Doctor = mysqli_real_escape_string($connection, $_POST["Doctor"]);   
 $DoctorReferedby= mysqli_real_escape_string($connection, $_POST["DoctorReferedby"]);   
 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);   
 $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);
 $TotalHours = mysqli_real_escape_string($connection, $_POST["TotalHours"]); 
 $EveningTimeSlotID = mysqli_real_escape_string($connection, $_POST["EveningTimeSlotID"]); 
 $MorningTimeSlotID = mysqli_real_escape_string($connection, $_POST["MorningTimeSlotID"]); 
  


 $EntryType = mysqli_real_escape_string($connection, $_POST["EntryType"]);  
 
 
 $MRP = mysqli_real_escape_string($connection, $_POST["MRP"]);   
 $Discount = mysqli_real_escape_string($connection, $_POST["Discount"]);   
 $TotalSittings = mysqli_real_escape_string($connection, $_POST["TotalSittings"]);   
 $TotalAmount = mysqli_real_escape_string($connection, $_POST["TotalAmount"]);   
 $LineAmount =  ($MRP*1) - (($Discount*1)/ $TotalSittings);
 $LineDiscount = (($Discount*1)/ $TotalSittings);
 $LocationCode = $_SESSION['SESS_LOCATION'];
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  
  $ClientID = 1;
  $userid = 1;	
  $SittingID=1;
  $sql='';
    
  if($EntryType=='SameDay')
  {
	$values = array();
	for ($x=0; $x<$TotalSittings; $x++){
		$values[] = "('$PaitentName','$Doctor','$BookingDate','$BookingTime','$TherapyName','$LocationCode','$Remarks',
		'$BookingDate',
'$BookingTime','$BookingDate','$InvoiceNo','$MRP','$LineDiscount','1','$LineAmount',
'$BookingDate','$SittingID','$DoctorReferedby','1','$BookingDate','Booked','$TotalHours');";
		$SittingID=$SittingID+1;
		}

	$sql.= "insert into therapybookingdetails (paitentid,doctorid,bookingdate,bookingtime,therapyid,location,
	remarks,reviseddate,revisedtime,closingdate,bookinguniqueid,rate,discount,
	totalsitings,nettamount,nextsettingdate,sitingid,referedbydoctorid,status,sittingdate,bookingstatus,totalhours) values";
	$sql.= implode(",",$values);


	$sql.= "insert into therapyclosredetails (bookinguniqueid,therapyid,paitentid,sitting,closingdate,updatedby) values
	('$InvoiceNo', '$TherapyName','$PaitentName','1','$BookingDate','$userid');";
  }
  else 
  {

 
	$values = array();
	for ($x=0; $x<$TotalSittings; $x++){
		$values[] = "('$PaitentName','$Doctor','$BookingDate','$BookingTime','$TherapyName','$LocationCode','$Remarks','$BookingDate',
'$BookingTime','$BookingDate','$InvoiceNo','$MRP','$LineDiscount','1','$LineAmount','$BookingDate',
'$SittingID','$DoctorReferedby','$TotalHours')";
		$SittingID=$SittingID+1;
		}
		
	$sql.= "insert into therapybookingdetails (paitentid,doctorid,bookingdate,bookingtime,therapyid,location,
	remarks,reviseddate,revisedtime,closingdate,bookinguniqueid,rate,discount,
	totalsitings,nettamount,nextsettingdate,sitingid,referedbydoctorid,totalhours) values";
	$sql.= implode(",",$values);

	

  }
 
 
	  
		
if(mysqli_multi_query($connection, $sql)){
	echo 1;
  } else{
	echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
 
  }
	 
}
else
{
	echo "Error Adding";
}

?>