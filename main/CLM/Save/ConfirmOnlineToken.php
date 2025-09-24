<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Invoice"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d");  
   
  $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);   
    
  
 $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
 // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];

  try {
    $SaveSaleMaster = "UPDATE tokenmaster set onlinetokenflag='1' where invoicenumber ='$Invoice';"; 
		 
if(mysqli_multi_query($connection, $SaveSaleMaster)){ 
   echo 1;
 // echo $SaveSaleMaster;
} else{
  // echo "ERROR: Could not able to execute $AddItem. " . mysqli_error($connection);
  // echo "0";
  echo $SaveSaleMaster;
}

  
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>