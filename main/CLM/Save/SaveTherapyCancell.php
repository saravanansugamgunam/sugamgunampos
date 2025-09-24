<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["BookingID"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d");  
   
  $BookingID = mysqli_real_escape_string($connection, $_POST["BookingID"]);  
  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);    
  $RefundStatus = mysqli_real_escape_string($connection, $_POST["RefundStatus"]);    
  $RefundAmount = mysqli_real_escape_string($connection, $_POST["RefundAmount"]);    
   
 $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
 $userid = $_SESSION["SESS_MEMBER_ID"];
  $ClientID = 1;
  // $userid = 1;	
  
  try {
	  
    $SaveSaleMaster = "UPDATE therapybookingmaster set therapystatus='Cancelled' 
						where bookinguniqueid ='$BookingID';"; 

    $SaveSaleMaster.= "insert into therapycancelleddetails (bookingid ,remarks,cancelledby) values 
	('$BookingID','$Remarks','$userid');"; 
 
	if($RefundStatus=='Yes')
	{
		$SaveSaleMaster.= "UPDATE paitentmaster set receipt=receipt+$RefundAmount 
						where paitentid in (SELECT paitentid FROM therapybookingmaster WHERE bookinguniqueid ='$BookingID');"; 
	}
 
 mysqli_multi_query($connection, $SaveSaleMaster); 
 
 // $StockQuery ="INSERT INTO stockdetails (productcode,purchaseqty,currentstock,locationcode,batchno,expirydate,mrp) VALUES  ('$ProductCode','$Qty','$Qty','$LocationCode','$BatchNo','$Expiry','$MRP') on duplicate key update purchaseqty = purchaseqty + '$Qty' ,
       // currentstock = currentstock + '$Qty' "; 
	 
	 // mysqli_query($connection,$StockQuery);
  
  echo 1;
 // echo  $SaveSaleMaster;
     
} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error";
	
}

?>