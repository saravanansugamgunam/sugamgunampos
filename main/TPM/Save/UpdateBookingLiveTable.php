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
 $TmpInvoice = mysqli_real_escape_string($connection, strtoupper($_POST["TmpInvoice"]));    
   
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
   
   $UpdateLiveTable = " ";

   $UpdateLiveTable.= "INSERT INTO therapybookingdetails  
   (paitentid,doctorid,bookingdate,bookingtime,therapyid,location,remarks,reviseddate,revisedtime,
   bookingstatus,closingdate,totalsitings,balancesitings,rate,discount,nettamount,bookinguniqueid,STATUS,
   sittingdate,updatedby,nextsettingdate,sitingid,referedbydoctorid,totalhours,recomendedid)
   SELECT paitentid,doctorid,bookingdate,bookingtime,therapyid,location,remarks,reviseddate,revisedtime,
   bookingstatus,closingdate,totalsitings,balancesitings,rate,discount,nettamount,'$Invoice',STATUS,
   sittingdate,updatedby,nextsettingdate,sitingid,referedbydoctorid,totalhours,bookingid FROM 
   therapybookingdetails_recomended WHERE bookingstatus ='Recomended' AND bookinguniqueid ='$TmpInvoice';";
       
   mysqli_multi_query($connection, $UpdateLiveTable); 
      
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>