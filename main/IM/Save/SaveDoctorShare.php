<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["InvoiceNo"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s");  
   
  $userid = mysqli_real_escape_string($connection, $_POST["userid"]);   
  $EntryDate = mysqli_real_escape_string($connection, $_POST["EntryDate"]);   
  $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);  
  $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);  
  $CalculationMode = mysqli_real_escape_string($connection, $_POST["CalculationMode"]);  
  $SharePercent = mysqli_real_escape_string($connection, $_POST["SharePercent"]);  
  $AmountToPay = mysqli_real_escape_string($connection, $_POST["AmountToPay"]);  
  $TotalSale = mysqli_real_escape_string($connection, $_POST["TotalSale"]);  
  $Profit = mysqli_real_escape_string($connection, $_POST["Profit"]);  
  $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);  
  
  $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);  
  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);   
 
   
 $LocationCode = $_SESSION['SESS_LOCATION'];
 $InvoicePrefix  = 	substr($LocationCode,0,2);  
 $InvoicePrefix  = 	"L".$InvoicePrefix;  
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
   
  try { 
		  
    $SaveSaleMaster = "insert into doctorsharedetails (invoiceno,userid,entrydate,fromdate,todate,calculationmode,profitpercent,shareamount,totalsale,totalprofit,paymentmode,remarks,enteredby) values 
	('$InvoiceNo','$userid','$EntryDate','$FromDate','$ToDate','$CalculationMode','$SharePercent','$AmountToPay','$TotalSale','$Profit','$PaymentMode','$Remarks','$userid');"; 
  
  $SaveSaleMaster.= "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,clientid,transactiontype,transactiongroup) values ('$userid','$PaymentMode','$AmountToPay','$InvoiceNo','$EntryDate','$ClientID','Doctor Share','Inventory')"; 
 

            if (mysqli_multi_query($connection, $SaveSaleMaster)) {
                
    // echo "Service Requese has been registered, Request ID is " . $last_id;
	   echo "1";
	   // echo $SaveSaleMaster;
            } else {
               echo "Error: " . $SaveSaleMaster . "" . mysqli_error($connection);
            } 
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