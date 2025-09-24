<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Ledger"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $Ledger = mysqli_real_escape_string($connection, $_POST["Ledger"]);    
 $Group = mysqli_real_escape_string($connection, $_POST["Group"]);    
 $EntryDate = mysqli_real_escape_string($connection, $_POST["EntryDate"]);     
 $Amount = mysqli_real_escape_string($connection, $_POST["Amount"]);    
 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);    
 $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);    
 $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);      
  
 $LocationcodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);

 $GroupID = $_SESSION['SESS_GROUP_ID'];
 $LocationCode =$LocationcodeAdmin;
  
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1; 	
  $userid = $_SESSION['SESS_MEMBER_ID'];
   
  try {

		$AddPaymentMode = "insert into accountingtransaction (ledgerid,date,transactiongroup,
		transactiontype,
		incomeamount,expenseamount,
		transactionamount,remarks,createdby,clientid,paymentmode,invoiceno) values
		('$Ledger','$EntryDate','$Group',
		(select ledgertype from accountingledger where ledgerid ='$Ledger'),
		(SELECT IF(ledgertype='Income','1','0') FROM accountingledger WHERE ledgerid ='$Ledger' ) * '$Amount',
		(SELECT IF(ledgertype='Income','0','1') FROM accountingledger WHERE ledgerid ='$Ledger' ) * '$Amount',
		'$Amount','$Remarks','$userid','$LocationCode','$PaymentMode','$InvoiceNo');";

		$AddPaymentMode .= "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,transactiontype,
		transactiongroup,clientid) values ('$Ledger','$PaymentMode','$Amount','$InvoiceNo','$EntryDate',
		(SELECT IF(ledgertype='Income','IncomeEntry','ExpenseEntry') FROM accountingledger WHERE ledgerid ='$Ledger' ),
		'$Group','$LocationCode');"; 

		if (mysqli_multi_query($connection, $AddPaymentMode)) {

			// echo "Service Requese has been registered, Request ID is " . $last_id;
			echo "1";
			//  echo $SaveSaleMaster;
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