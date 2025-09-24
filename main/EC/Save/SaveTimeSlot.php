<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["InvoiceNo"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s");   

  $DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);      
  $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);  
  $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 

  $FromTime = mysqli_real_escape_string($connection, $_POST["FromTime"]);   
  $ToTime = mysqli_real_escape_string($connection, $_POST["ToTime"]);   
  $SlotType = mysqli_real_escape_string($connection, $_POST["SlotType"]);   

  $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);   
  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);    
   
 $LocationCode = $_SESSION['SESS_LOCATION'];
 $InvoicePrefix  = 	substr($LocationCode,0,2);  
 $InvoicePrefix  = 	"L".$InvoicePrefix;  
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $DoctorCode = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  $datetime1 = new DateTime($FromDate);

$datetime2 = new DateTime($ToDate);

$difference = $datetime1->diff($datetime2);
$TotalDays = $difference->d;
if($ToTime==0)
{ $ToTime=$FromTime;
}
 
$Date = "2010-09-17";
 
  try { 
   // $AssignedDate = date('Y-m-d', strtotime($FromDate. ' + 1 days'));
   $SaveSaleMaster='';  
   for ($x=0; $x<$TotalDays+1; $x++){
   $AssignedDate = date('Y-m-d', strtotime($FromDate. ' + '.$x.' days'));
   $SaveSaleMaster.= " INSERT INTO timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,STATUS,remarks)
   SELECT '$DoctorCode','$AssignedDate',timedescription,timevalue,60,'Open','$Remarks' FROM timeslotlist WHERE 
   timevalue BETWEEN '$FromTime' AND '$ToTime' ;";

   // $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','06-07 AM','6','60','Open');"; 
   //  $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','07-08 AM','7','60','Open');"; 
   // $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','08-09 AM','8','60','Open');"; 
   // $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','09-10 AM','9','60','Open');"; 
   // $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','10-11 AM','10','60','Open');"; 
   // $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','11-12 AM','11','60','Open');"; 
   // $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','12-01 PM','12','60','Open');"; 
   // $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','01-02 PM','13','60','Open');"; 
   // $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','02-03 PM','14','60','Open');"; 
   // $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','03-04 PM','15','60','Open');"; 
   // $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','04-05 PM','16','60','Open');"; 
   // $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','05-06 PM','17','60','Open');"; 
   // $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','06-07 PM','18','60','Open');"; 
   // $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','07-08 PM','19','60','Open');"; 
   // $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','08-09 PM','20','60','Open');"; 
   // $SaveSaleMaster.= "insert into timeslotdetails (doctorid,assigneddate,timeslot,starttime,timeslottype,status) values 
	// ('$DoctorCode','$AssignedDate','09-10 PM','21','60','Open');";  

   }
 

            if (mysqli_multi_query($connection, $SaveSaleMaster)) {
                
    // echo "Service Requese has been registered, Request ID is " . $last_id;
	   echo "1";
	   // echo $SaveSaleMaster;
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