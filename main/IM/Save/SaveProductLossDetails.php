<?php
   include("../../../connect.php"); 
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Barcode"]))
{
   
 // echo "1";

  $currentdate =date("Y-m-d H:i:s"); 							  
 $Barcode = mysqli_real_escape_string($connection, strtoupper($_POST["Barcode"]));    
 $ShortCode = mysqli_real_escape_string($connection, strtoupper($_POST["ShortCode"]));    
 $EntryDate = mysqli_real_escape_string($connection, strtoupper($_POST["EntryDate"]));    
 $ProductName = mysqli_real_escape_string($connection, strtoupper($_POST["ProductName"]));    
 $MRP = mysqli_real_escape_string($connection, strtoupper($_POST["MRP"]));    
 $Remarks = mysqli_real_escape_string($connection, strtoupper($_POST["Remarks"]));     
    
  $LocationCodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);

  $GroupID = $_SESSION['SESS_GROUP_ID'];
 
  if($GroupID==1)
  {
     $LocationCode =$LocationCodeAdmin;
  }
  else
  {
     $LocationCode = $_SESSION['SESS_LOCATION'];
  }
  
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
   
  $userid = 1;	
   
  try {
    $AddLossDetails  = "insert into productlossdetails (entrydate ,barcode,shortcode,product,mrp,remarks,locationcode,
	addedby) values ('$EntryDate','$Barcode','$ShortCode','$ProductName','$MRP',
	'$Remarks','$LocationCode','$userid');"; 
	
	$AddLossDetails.="  UPDATE newstockdetails_".$LocationCode."  SET  currentstock=currentstock-1, loststock=loststock+1 WHERE barcode ='$Barcode'; "; 

if (mysqli_multi_query($connection, $AddLossDetails)) {
                
    // echo "Service Requese has been registered, Request ID is " . $last_id;
	   echo "1";
	   // echo $AddLossDetails;
            } else {
               echo "Error: " . $AddLossDetails . "" . mysqli_error($connection);
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