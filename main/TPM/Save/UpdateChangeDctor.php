<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["TokenID"]))
{
	 date_default_timezone_set("Asia/Kolkata");
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d");  
   $currenttime = date("His"); 
	   
 $TokenID = mysqli_real_escape_string($connection, $_POST["TokenID"]);    
 $DoctorID = mysqli_real_escape_string($connection, $_POST["DoctorID"]);    
 $LocationCode = mysqli_real_escape_string($connection, $_POST["LocationCode"]); 
 
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
  
  try {
   $UpdateDoctor = "  UPDATE tokenmaster SET 
   revisedtokennumber = (SELECT IFNULL(MAX(tokennumber),0)+1 FROM
   tokenmaster WHERE doctorid='$DoctorID' AND DATE='$currentdate' AND locationcode ='$LocationCode'),

   tokennumber = (SELECT IFNULL(MAX(tokennumber),0)+1 FROM 
   tokenmaster WHERE doctorid='$DoctorID' AND DATE='$currentdate' AND locationcode ='$LocationCode'),  

   doctorid='$DoctorID' WHERE tokenid='$TokenID';";
   
   $UpdateDoctor.="update consultingbillmaster set doctorid='$DoctorID' WHERE consultationuniquebill IN(
   SELECT invoicenumber FROM tokenmaster  WHERE tokenid='$TokenID')  ;";
   
   $UpdateDoctor.="update consultingdetails set doctorid='$DoctorID'  WHERE consultationuniquebill IN(
   SELECT invoicenumber FROM tokenmaster  WHERE tokenid='$TokenID') ;"; 
	 
 
    mysqli_multi_query($connection, $UpdateDoctor); 
  
   echo 1;
   // echo  $UpdateDoctor;
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>