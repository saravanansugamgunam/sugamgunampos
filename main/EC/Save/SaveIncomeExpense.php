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
 $EntryType = mysqli_real_escape_string($connection, $_POST["EntryType"]);    
 $Amount = mysqli_real_escape_string($connection, $_POST["Amount"]);    
 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);    
  
     
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = 1;	
   
  try {
	  if($EntryType =='INCOME')
	  {
		   $AddPaymentMode = "insert into accountingtransaction (ledgerid,date,transactiongroup,transactiontype,incomeamount,transactionamount,remarks,createdby) values ('$Ledger','$EntryDate','$Group','$EntryType','$Amount','$Amount','$Remarks','$userid')";
	  }
	  else
	  {
		   $AddPaymentMode = "insert into accountingtransaction (ledgerid,date,transactiongroup,transactiontype,expenseamount,transactionamount,remarks,createdby) values ('$Ledger','$EntryDate','$Group','$EntryType','$Amount','$Amount','$Remarks','$userid')";
	  }
	  
    
 
 mysqli_query($connection, $AddPaymentMode); 
echo "1";
// echo $AddPaymentMode;

} catch (Exception $e) {
   echo 'Message: ' .$e->getMessage();
}    
   
}
else
{
	echo "Error Adding";
}

?>