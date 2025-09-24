<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["GRN"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 
   
 $ModifiedRate = mysqli_real_escape_string($connection, $_POST["ModifiedRate"]);  
 $ModifiedMRP = mysqli_real_escape_string($connection, $_POST["ModifiedMRP"]);  
 $ModifiedProfit = mysqli_real_escape_string($connection, $_POST["ModifiedProfit"]);  
 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);    
 $ProductCode = mysqli_real_escape_string($connection, $_POST["ProductCode"]);
 $GRN = mysqli_real_escape_string($connection, $_POST["GRN"]);
 $OldRate = mysqli_real_escape_string($connection, $_POST["OldRate"]);
 $OldMRP = mysqli_real_escape_string($connection, $_POST["OldMRP"]);
 
  $ClientID = 1;
  $userid = 1;	
   
  try {
	  
	     $AddPaymentMode = " UPDATE purchaseitemsnew  SET rate='$ModifiedRate', mrp='$ModifiedMRP',
         profit='$ModifiedProfit'  WHERE grnnumber ='$GRN' and productcode ='$ProductCode';"; 
	 

    $AddPaymentMode.= " UPDATE newstockdetails_3  SET rate='$ModifiedRate', mrp='$ModifiedMRP' 
    WHERE grnnumber ='$GRN' and productcode ='$ProductCode';"; 
 
   $AddPaymentMode.= " UPDATE newstockdetails_4  SET rate='$ModifiedRate', mrp='$ModifiedMRP' 
   WHERE grnnumber ='$GRN' and productcode ='$ProductCode';"; 

    $AddPaymentMode.= " insert into purchaseupdatelog(grnnumber,productid,oldmrp,newmrp,oldrate,
    newrate,remarks,updatedby) values ('$GRN','$ProductCode','$OldMRP','$ModifiedMRP','$OldRate',
    '$ModifiedRate','$Remarks','$userid');"; 
 
    if (mysqli_multi_query($connection, $AddPaymentMode)) {
                
      // echo "Service Requese has been registered, Request ID is " . $last_id;
        echo  1;
         // echo $PurchaseMaster;
              } else {
                 echo "Error: " . $AddPaymentMode . "" . mysqli_error($connection);
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