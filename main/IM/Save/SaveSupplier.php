<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Name"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	 
 $Name = mysqli_real_escape_string($connection, strtoupper($_POST["Name"]));    
   
 $MobileNo = mysqli_real_escape_string($connection, $_POST["MobileNo"]);   
 $ContactPerson = mysqli_real_escape_string($connection, $_POST["ContactPerson"]);   
 $Address = mysqli_real_escape_string($connection, $_POST["Address"]);    
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
    $AddTimeLog = "insert into supliers (suplier_name,suplier_contact,contact_person,suplier_address) values ('$Name','$MobileNo','$ContactPerson','$Address')"; 
 
 mysqli_query($connection, $AddTimeLog); 
  
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