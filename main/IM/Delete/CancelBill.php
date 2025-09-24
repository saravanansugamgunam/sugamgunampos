	<?php
  
session_cache_limiter(FALSE);
session_start();
   $LocationCode = $_SESSION['SESS_LOCATION'];
   $LoggedInUser = $_SESSION['SESS_MEMBER_ID'];
//insert.php
    function removeslashes($string)
{
    $string=implode("",explode("\\",$string));
    return stripslashes(trim($string));
}

if(isset($_POST["Invoice"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
  $currentdatetime =date("Y-m-d H:i:s"); 							  
  $currentdate =date("Y-m-d"); 							      
 $InvoiceNo = mysqli_real_escape_string($connection, strtoupper($_POST["Invoice"]));     
 $CancelledRemarks = mysqli_real_escape_string($connection, strtoupper($_POST["CancelledRemarks"]));     
 $BillLocationCode = mysqli_real_escape_string($connection, $_POST["BillLocationCode"]);     
 $CancellType = mysqli_real_escape_string($connection, $_POST["CancellType"]);     
 
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];	
   
  try {
    $SaleItems = "update salemaster set cancellstatus =1,transactiontype='Cancelled'  where saleuniqueno='$InvoiceNo' and locationcode ='$BillLocationCode'";  
 mysqli_query($connection, $SaleItems); 
  

 $CancelledDetails ="INSERT INTO billcancelldetails
            (cancelledbillno,cancelledby,cancelltype,remarks) values ('$InvoiceNo','$LoggedInUser','$CancellType','$CancelledRemarks');"; 
	if($CancellType=='Refund')
    {
        $CancelledDetails .="  UPDATE paitentmaster set 
		receipt =receipt+( SELECT nettamount  FROM salemaster WHERE saleuniqueno= '$InvoiceNo') 
        where paitentid in( SELECT paitientcode  FROM salemaster WHERE saleuniqueno= '$InvoiceNo');";

    }
		
		$CancelledDetails .=" UPDATE newstockdetails_".$BillLocationCode."
        INNER JOIN
        newsaleitems ON newstockdetails_".$BillLocationCode.".barcode = newsaleitems.barcode 
	SET salesqty = salesqty - newsaleitems.saleqty,
	newstockdetails_".$BillLocationCode.".currentstock=newstockdetails_".$BillLocationCode.".currentstock+newsaleitems.saleqty
    WHERE newsaleitems.invoiceno='$InvoiceNo';"; 
		

    if (mysqli_multi_query($connection, $CancelledDetails)) { 
           echo "1";
          // echo $CancelledDetails; 
                } else {
                   echo "Error: " . $CancelledDetails . "" . mysqli_error($connection);
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