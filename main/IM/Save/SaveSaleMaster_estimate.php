<?php
  
session_cache_limiter(FALSE);
session_start();
  
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
  $userid = mysqli_real_escape_string($connection, $_POST["userid"]);  
  $BillType = mysqli_real_escape_string($connection, $_POST["BillType"]);  
  // $CourierCharges = 0;
     $CourierCharges = mysqli_real_escape_string($connection, $_POST["CourierCharges"]);
     $BillingFormat = mysqli_real_escape_string($connection, $_POST["BillingFormat"]);
   

   
 $LocationCode = $_SESSION['SESS_LOCATION'];
 $InvoicePrefix  = 	substr($LocationCode,0,2);  
 $InvoicePrefix  = 	"L".$InvoicePrefix;  
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];	
   
  try {
	  
	  if($BillType=='Free')
{
		  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]); 
    $Savesalemaster_estimate = "insert into salemaster_estimate (saledate,invoiceno,saleuniqueno,paitientcode,saleqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,userid,remarks,saletype,couriercharges,billtype) values 
	('$SaleDate','$InvoicePrefix','$Invoice','$PaitentCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance','$ReceivedAmount','$NewBalance','$userid','$Remarks','Free','$CourierCharges','$BillingFormat');"; 
}
else if($BillType=='Courier')
{
		  
	 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]); 
    $Savesalemaster_estimate = "insert into salemaster_estimate (saledate,invoiceno,saleuniqueno,paitientcode,saleqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,userid,remarks,saletype,couriercharges,billtype) values 
	('$SaleDate','$InvoicePrefix','$Invoice','$PaitentCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance','$ReceivedAmount','$NewBalance','$userid','$Remarks','Courier','$CourierCharges','$BillingFormat');"; 
}
else if($BillType=='Online')
{
		  
	 $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]); 
    $Savesalemaster_estimate = "insert into salemaster_estimate (saledate,invoiceno,saleuniqueno,paitientcode,saleqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,userid,remarks,saletype,couriercharges,billtype) values 
	('$SaleDate','$InvoicePrefix','$Invoice','$PaitentCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance','$ReceivedAmount','$NewBalance','$userid','$Remarks','Online','$CourierCharges','$BillingFormat');"; 
}
else
{
		  
    $Savesalemaster_estimate = "insert into salemaster_estimate (saledate,invoiceno,saleuniqueno,paitientcode,saleqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,userid,remarks,saletype,billtype) values 
	('$SaleDate','$InvoicePrefix','$Invoice','$PaitentCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance','$ReceivedAmount','$NewBalance','$userid','-','Counter','$BillingFormat');"; 
}
 

            if (mysqli_multi_query($connection, $Savesalemaster_estimate)) {
                
    // echo "Service Requese has been registered, Request ID is " . $last_id;
	   echo "1";
	   // echo $Savesalemaster_estimate;
            } else {
               echo "Error: " . $Savesalemaster_estimate . "" . mysqli_error($connection);
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