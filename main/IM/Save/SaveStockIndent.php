<?php
  
session_cache_limiter(FALSE);
session_start();


function random_num($size) {
	$alpha_key = '';
	$keys = range('A', 'Z');
	
	for ($i = 0; $i < 2; $i++) {
		$alpha_key .= $keys[array_rand($keys)];
	}
	
	$length = $size - 2;
	
	$key = '';
	$keys = range(0, 9);
	
	for ($i = 0; $i < $length; $i++) {
		$key .= $keys[array_rand($keys)];
	}
	
	return $alpha_key . $key;
}

  
//insert.php
if(isset($_POST["Invoice"]))
{
   
 // echo "1";
 include("../../../connect.php"); 
	   
  $currentdate =date("Y-m-d H:i:s");  
   
	   
  $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);   
  $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);   
  $TotalSaleQty = mysqli_real_escape_string($connection, $_POST["TotalSaleQty"]);  
  $TotalDiscountAmount = mysqli_real_escape_string($connection, $_POST["TotalDiscountAmount"]);  
  $TotalProfitAmount = mysqli_real_escape_string($connection, $_POST["TotalProfitAmount"]);  
  $TotalSaleAmount = mysqli_real_escape_string($connection, $_POST["TotalSaleAmount"]);  
  $SaleDate = mysqli_real_escape_string($connection, $_POST["SaleDate"]);  
  
  $OldBalance = mysqli_real_escape_string($connection, $_POST["OldBalance"]);  
  $ReceivedAmount = mysqli_real_escape_string($connection, $_POST["ReceivedAmount"]);  
  $NewBalance = mysqli_real_escape_string($connection, $_POST["NewBalance"]);  
  $DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);  
  $BillType = mysqli_real_escape_string($connection, $_POST["BillType"]);  
  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]); 
  $OldAmountAdjusted = mysqli_real_escape_string($connection, $_POST["OldAmountAdjusted"]); 

  
  // $CourierCharges = 0;
     $CourierCharges = mysqli_real_escape_string($connection, $_POST["CourierCharges"]);
     $BillingFormat = mysqli_real_escape_string($connection, $_POST["BillingFormat"]);

     $LocationcodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationcodeAdmin"]);

     $GroupID = $_SESSION['SESS_GROUP_ID'];
     if($GroupID==1)
     {
        $LocationCode =$LocationcodeAdmin;
     }
     else
     {
        $LocationCode = $_SESSION['SESS_LOCATION'];
     }

 $RandomeInvoiceNo = random_num(9);
 $InvoicePrefix  = 	substr($LocationCode,0,2);  
 $InvoicePrefix  = 	"L".$InvoicePrefix;  
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];	
  $SaveSaleMaster='';
  try {
	   
		  
    $SaveSaleMaster.= "insert into salemaster_stockindent (saledate,invoiceno,saleuniqueno,paitientcode,saleqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,doctorcode,remarks,saletype,billtype,addedby,einvoiceno) values 
	('$SaleDate','$InvoicePrefix','$Invoice','$PaitentCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance','$ReceivedAmount','$NewBalance','$DoctorCode','$Remarks','Counter','$BillingFormat','$userid','$RandomeInvoiceNo');"; 
  
 

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