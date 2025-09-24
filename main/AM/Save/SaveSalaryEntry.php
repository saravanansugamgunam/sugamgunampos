<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["StaffCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
 $currentdate =date("Y-m-d H:i:s"); 	 
  

 $StaffCode = mysqli_real_escape_string($connection, $_POST["StaffCode"]);    
 $EntryDate = mysqli_real_escape_string($connection, $_POST["EntryDate"]);   
 $EntryType = mysqli_real_escape_string($connection, $_POST["EntryType"]);   
 $Amount = mysqli_real_escape_string($connection, $_POST["Amount"]);   
 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);   
 $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);   
 $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);       
 $Location = mysqli_real_escape_string($connection, $_POST["Location"]);       
 $Period = mysqli_real_escape_string($connection, $_POST["Period"]);       
 
 $FixedSalary = mysqli_real_escape_string($connection, $_POST["FixedSalary"]);    
 $LOP = mysqli_real_escape_string($connection, $_POST["LOP"]);    
 $AdvancePaid = mysqli_real_escape_string($connection, $_POST["AdvancePaid"]);
 $Bonus = mysqli_real_escape_string($connection, $_POST["Bonus"]);
 $Incentive = mysqli_real_escape_string($connection, $_POST["Incentive"]);
  
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];
   
  if($EntryType=='Incentive')
  {
   $Amount=$Incentive;
  }

  if($EntryType=='Bonus')
  {
   $Amount=$Bonus;
  }


  try {
    $AddTimeLog = "insert into salarypaymentdetails (paymentid,period,employeecode,salarydate,salarytype,amount,
    paymentmode,remarks,createdby,locationcode,fixedsalary,lop,advancepaid) values
    ('$InvoiceNo','$Period','$StaffCode','$EntryDate','$EntryType','$Amount','$PaymentMode','$Remarks',
    '$userid','$Location','$FixedSalary','$LOP','$AdvancePaid');"; 

    $AddTimeLog .= "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,
    transactiontype,transactiongroup,clientid) values 
    ('$StaffCode','$PaymentMode','$Amount','$InvoiceNo','$EntryDate','$EntryType','Clinic',
    '$Location');"; 
  
     
    if(mysqli_multi_query($connection, $AddTimeLog)){ 
      echo 1;
   } else{
      // echo "ERROR: Could not able to execute $AddItem. " . mysqli_error($connection);
      // echo "0";
      echo $AddTimeLog;
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
