<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["PatientID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $PatientID = mysqli_real_escape_string($connection, strtoupper($_POST["PatientID"]));    
 $UpdatedPatientName = mysqli_real_escape_string($connection, strtoupper($_POST["UpdatedPatientName"]));    
 $UpdatedPatientEmail = mysqli_real_escape_string($connection, strtoupper($_POST["UpdatedPatientEmail"]));    
 $UpdatedPatientMobileNo = mysqli_real_escape_string($connection, strtoupper($_POST["UpdatedPatientMobileNo"]));    
 $PatientStatus = mysqli_real_escape_string($connection, ($_POST["PatientStatus"])); 
 $PatientBarcode = mysqli_real_escape_string($connection, strtoupper($_POST["UpdatedPaitentBarcode"]));   
 
 $UpdateAddress = mysqli_real_escape_string($connection, strtoupper($_POST["UpdateAddress"])); 
 $UpdateReference = mysqli_real_escape_string($connection, strtoupper($_POST["UpdateReference"])); 

 $NewGender = mysqli_real_escape_string($connection, ($_POST["NewGender"]));    
 $UpdateDOB = mysqli_real_escape_string($connection, ($_POST["UpdateDOB"]));

 $UpdateCity = mysqli_real_escape_string($connection, ($_POST["UpdateCity"]));
 $UpdateState = mysqli_real_escape_string($connection, ($_POST["UpdateState"]));
 $UpdatePincode = mysqli_real_escape_string($connection, ($_POST["UpdatePincode"]));
 

  
  if($NewGender<>'-')
  {
	 $Updategender=" gender='$NewGender' ";
	 
  }
  else
  {
	  $Updategender=" gender=gender ";
  }
  
  if($UpdateDOB<>'')
  {
	 $UpdateDOB=" dob='$UpdateDOB' ";
	 
  }
  else
  {
	  $UpdateDOB=" dob=dob ";
  }
   

  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddPaymentMode = "update paitentmaster set paitentname='$UpdatedPatientName',barcode='$PatientBarcode', 
    mobileno='$UpdatedPatientMobileNo',email='$UpdatedPatientEmail',
    activestatus='$PatientStatus', address='$UpdateAddress', referenceno='$UpdateReference',
	$Updategender ,  $UpdateDOB,city='$UpdateCity',statecode ='$UpdateState',pincode ='$UpdatePincode'  where paitentid='$PatientID'"; 
 
 mysqli_query($connection, $AddPaymentMode); 
echo "Added Successfuly";

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>