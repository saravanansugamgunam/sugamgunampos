<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["OrderNo"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s");  
    
  
 $OrderNo = mysqli_real_escape_string($connection, $_POST["OrderNo"]);  
 
 $RevisedRemarks = mysqli_real_escape_string($connection, $_POST["RevisedRemarks"]);    
  
  
 $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
	  
	  $CancelQuery = "update paitientorder set orderstatus ='Cancelled' , 
	  cancelledremarks='$RevisedRemarks' where orderid ='$OrderNo'; ";

$CancelQuery .= " UPDATE paitentmaster set receipt=receipt-(SELECT advance FROM paitientorder WHERE 
				orderid='$OrderNo') where paitentid in(SELECT paitentid FROM paitientorder WHERE 
				orderid='$OrderNo'); ";

$CancelQuery .= " UPDATE salepaymentdetails set transactionstatus='Cancelled' where transactiontype='PaitentOrder' and invoiceno ='$OrderNo'; ";				
 
mysqli_multi_query($connection,$CancelQuery);


    // $AddBatch = "update paitientorder set orderstatus ='Cancelled' , cancelledremarks='$RevisedRemarks' where  
	// orderid ='$OrderNo' "; 
	 
 // mysqli_query($connection, $AddBatch); 
  
 echo 1;
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