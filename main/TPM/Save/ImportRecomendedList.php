<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Invoice"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $Invoice = mysqli_real_escape_string($connection, strtoupper($_POST["Invoice"]));    
 $RecomendedID = mysqli_real_escape_string($connection, strtoupper($_POST["RecomendedID"]));    
 $BookingDate = mysqli_real_escape_string($connection, strtoupper($_POST["BookingDate"]));    
 $BookingTime = mysqli_real_escape_string($connection, strtoupper($_POST["BookingTime"]));    
 $ReferedBy = mysqli_real_escape_string($connection, strtoupper($_POST["ReferedBy"]));    
   

     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid =$_SESSION['SESS_MEMBER_ID'];
   
  try {
 		
	$sql.= "INSERT INTO therapybookingdetails (paitentid,doctorid,bookingdate,bookingtime,therapyid,location,
	remarks,reviseddate,revisedtime,closingdate,bookinguniqueid,rate,discount,
	totalsitings,nettamount,nextsettingdate,sitingid,referedbydoctorid)  
	
SELECT paitentid,doctorid,'$BookingDate','$BookingTime', therapyid,locationcode,
'-','$BookingDate','$BookingTime','$BookingDate','$Invoice',consultationcharge,0,
1,consultationcharge,'$BookingDate',sittingid,'$ReferedBy' FROM 
therapyrecomendation AS a JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
WHERE uniqueid ='$RecomendedID' and currentstatus='Pending'"; 


   if(mysqli_multi_query($connection, $sql)){
      echo 1;
     } else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
    
     }

   

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>