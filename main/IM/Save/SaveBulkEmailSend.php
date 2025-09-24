<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["MessageID"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 							  
 $MessageID = mysqli_real_escape_string($connection, $_POST["MessageID"]);    
 $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]);    
 $MailTo = mysqli_real_escape_string($connection, $_POST["MailTo"]);    
 
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
 
   if($MailTo==0)
   {
      $AddPaymentMode= "INSERT INTO bulkemailusermapping (uniqueid,messageid,emailid) 
      SELECT '$UniqueID','$MessageID', email FROM paitentmaster WHERE email NOT IN('-','') GROUP BY email union 
      SELECT  '$UniqueID','$MessageID',studentemailid FROM studentmaster  WHERE studentemailid NOT IN('-','') GROUP BY studentemailid;";
   }
    
   else if($MailTo==1)
   {
      $AddPaymentMode= "INSERT INTO bulkemailusermapping (uniqueid,messageid,emailid) 
      SELECT '$UniqueID','$MessageID', email FROM paitentmaster WHERE email NOT IN('-','')  GROUP BY email ;";
   }
    
    
   else if($MailTo==2)
   {
      $AddPaymentMode= "INSERT INTO bulkemailusermapping (uniqueid,messageid,emailid) 
      SELECT  '$UniqueID','$MessageID',studentemailid FROM studentmaster  WHERE studentemailid NOT IN('-','') GROUP BY studentemailid;"; 
   }
    
 mysqli_query($connection, $AddPaymentMode); 
echo 1;

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>