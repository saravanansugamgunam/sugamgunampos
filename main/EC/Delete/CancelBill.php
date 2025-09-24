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


  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
	  
    $CancelledDetails = "update consultingbillmaster  set cancelledstatus =1 
	where consultationuniquebill='$InvoiceNo' ;";    

 $CancelledDetails .="update tokenmaster  set tokenstatus =5 
	where invoicenumber='$InvoiceNo' ;"; 
	
 $CancelledDetails .="INSERT INTO billcancelldetails
            (cancelledbillno,cancelledby,remarks,transactiontype) values ('$InvoiceNo','$LoggedInUser','$CancelledRemarks','Consultation Bill');"; 
	
	
 $CancelledDetails .="update salepaymentdetails set transactionstatus ='Cancelled' 
 where transactiontype='DoctorFee' and invoiceno= '$InvoiceNo';"; 
			
			
		$CancelledDetails .="  UPDATE paitentmaster set 
		receipt =receipt+( SELECT totalamount FROM consultingbillmaster 
		WHERE consultationuniquebill= '$InvoiceNo') where paitentid in( SELECT paitentid FROM consultingbillmaster
		WHERE consultationuniquebill= '$InvoiceNo');";

 
		
  mysqli_multi_query($connection, $CancelledDetails); 		  
 
 
  
 // $StockUpdate = "     
// UPDATE stockdetails_".$LocationCode."
        // INNER JOIN
    // saleitems ON stockdetails_".$LocationCode.".stockitemid = saleitems.itemid 
	// SET salesqty = salesqty - saleitems.saleqty,
	// stockdetails_".$LocationCode.".currentstock=stockdetails_".$LocationCode.".currentstock+saleitems.saleqty
    // WHERE saleitems.invoiceno='$InvoiceNo';";
			  // mysqli_query($connection, $StockUpdate); 
             
           

 // echo  $CancelledDetails;
 
  echo "Bill Cancelled Successfully";

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>