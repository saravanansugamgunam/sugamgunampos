<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Invoice"]))
{
     date_default_timezone_set("Asia/Kolkata");
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s"); 
	$currenttime = date("His");  
  
	
	   
  $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);   
  $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);   
  $TotalSaleQty = mysqli_real_escape_string($connection, $_POST["TotalSaleQty"]);  
  $TotalDiscountAmount = mysqli_real_escape_string($connection, $_POST["TotalDiscountAmount"]);  
  $TotalProfitAmount = mysqli_real_escape_string($connection, $_POST["TotalProfitAmount"]);  
  $TotalSaleAmount = mysqli_real_escape_string($connection, $_POST["TotalSaleAmount"]);  
  $BillDate = mysqli_real_escape_string($connection, $_POST["SaleDate"]);  
  
  $OldBalance = mysqli_real_escape_string($connection, $_POST["OldBalance"]);  
  $ReceivedAmount = mysqli_real_escape_string($connection, $_POST["ReceivedAmount"]);  
  $NewBalance = mysqli_real_escape_string($connection, $_POST["NewBalance"]);  
  
  $DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);  
  $BillType = mysqli_real_escape_string($connection, $_POST["BillType"]);  
  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);    
  $TokenNo = mysqli_real_escape_string($connection, $_POST["TokenNo"]);  
  $GrossAmount = mysqli_real_escape_string($connection, $_POST["GrossAmount"]);  
  $BillingType = mysqli_real_escape_string($connection, $_POST["BillingType"]);  
  $CourierCharges = 0;
 
  $LocationcodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);

  $GroupID = $_SESSION['SESS_GROUP_ID'];
  if($GroupID==1)
  {
     $LocationCode =$LocationcodeAdmin;
  }
  else
  {
     $LocationCode = $_SESSION['SESS_LOCATION'];
  }
 $InvoicePrefix  = 	substr($LocationCode,0,2);  
 $InvoicePrefix  = 	"L".$InvoicePrefix;  
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];
  try {
	  
 
		 
    $SaveSaleMaster = "insert into consultingbillmaster (billdate,consultationuniquebill,doctorid,paitentid,discountamount,totalamount,locationcode,addedby,remarks,tokennumber,receivedamount,oldbalance,newbalance,grossamount,billingtype) values 
	('$BillDate','$Invoice','$DoctorCode','$PaitentCode','$TotalDiscountAmount','$TotalSaleAmount','$LocationCode','$userid','$Remarks','$TokenNo','$ReceivedAmount','$OldBalance','$NewBalance','$GrossAmount','$BillingType');";  
	
	if($TokenNo>0)
	{
		 $SaveSaleMaster.= "insert into tokenmaster (locationcode,date,tokennumber,revisedtokennumber,invoicenumber,paitentcode,doctorid,totalamount,createdon) values 
	('$LocationCode','$BillDate','$TokenNo','$TokenNo','$Invoice','$PaitentCode','$DoctorCode','$TotalSaleAmount','$currenttime');";  
	}
   
    
		$SaveSaleMaster.="  UPDATE paitentmaster set topay=topay+'$TotalSaleAmount'+'$CourierCharges', 
		receipt =receipt+'$ReceivedAmount' where paitentid='$PaitentCode';"; 

 

            if (mysqli_multi_query($connection, $SaveSaleMaster)) {
                
    // echo "Service Requese has been registered, Request ID is " . $last_id;
	   echo "1";
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