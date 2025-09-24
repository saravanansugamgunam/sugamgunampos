<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Invoice"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 							  
 $Invoice = mysqli_real_escape_string($connection, strtoupper($_POST["Invoice"]));    
 $LocationCode = mysqli_real_escape_string($connection, strtoupper($_POST["LocationCode"]));    
 
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];	
  try {
    $DeliveryCompletion = "insert into deliverydetails (invoiceno,deliveredby) 
    values ('$Invoice'  ,'$userid');"; 
    
    $DeliveryCompletion.= "update salemaster set deliverystatus=1 where saleuniqueno ='$Invoice';"; 
    $DeliveryCompletion.= "update newsaleitems set deliverystatus=1 where invoiceno ='$Invoice';"; 
    
    	$DeliveryCompletion.="  UPDATE newstockdetails_".$LocationCode." s,  newsaleitems p
	SET s.salesqty = s.salesqty + p.saleqty,s.currentstock=s.currentstock-p.saleqty
	WHERE s.barcode = p.barcode AND p.invoiceno='$Invoice'; "; 
	

    if (mysqli_multi_query($connection, $DeliveryCompletion)) {
                
      // echo "Service Requese has been registered, Request ID is " . $last_id;
        echo "1";
        // echo $SaveSaleMaster;
              } else {
                 echo "Error: " . $DeliveryCompletion . "" . mysqli_error($connection);
              } 
     // echo $AddBatch;

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>