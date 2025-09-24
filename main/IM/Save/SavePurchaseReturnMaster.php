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
  $TotalSaleQty = mysqli_real_escape_string($connection, $_POST["TotalSaleQty"]);  
  $TotalDiscountAmount = mysqli_real_escape_string($connection, $_POST["TotalDiscountAmount"]);  
  $TotalProfitAmount = mysqli_real_escape_string($connection, $_POST["TotalProfitAmount"]);  
  $TotalSaleAmount = mysqli_real_escape_string($connection, $_POST["TotalSaleAmount"]);  
  $SaleDate = mysqli_real_escape_string($connection, $_POST["SaleDate"]);  
  
  $OldBalance = mysqli_real_escape_string($connection, $_POST["OldBalance"]);  
  $ReceivedAmount = mysqli_real_escape_string($connection, $_POST["ReceivedAmount"]);  
  $NewBalance = mysqli_real_escape_string($connection, $_POST["NewBalance"]);  
  $SupplierCode = mysqli_real_escape_string($connection, $_POST["SupplierCode"]);  
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
  $userid = 1;	
   
  try {
	  
 	  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]); 
    $SaveSaleMaster = "insert into purchasereturnmaster (purchasereturndate,invoiceno,purchaseteturnuniqueno,suppliercode,returnqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,remarks,saletype,couriercharges,billtype) values 
	('$SaleDate','$InvoicePrefix','$Invoice','$SupplierCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance','$ReceivedAmount','$NewBalance','$Remarks','Free','$CourierCharges','$BillingFormat');"; 
 
 
		$SaveSaleMaster.="  UPDATE    newstockdetails_".$LocationCode." s,  newpurchasereturnitems p
	SET       s.purchasereturn = s.purchasereturn + p.returnqty,s.currentstock=s.currentstock-p.returnqty
	WHERE     s.barcode = p.barcode and 
   s.mrp=p.mrp and 
s.batchno=p.batchcode and 
s.expirydate=p.expirydate  AND p.invoiceno='$Invoice'; "; 
	
		
		// $SaveSaleMaster.="  UPDATE paitientorder a, newsaleitems as b 
		// set a.orderstatus ='Delivered', a.invoiceno='$Invoice', a.invoicedate='$SaleDate' 
		// where a.productcode in(SELECT productcode FROM stockdetails_1 WHERE stockitemid in(b.itemid)) and a.paitentid='$PaitentCode' and a.orderstatus in('Open','Purchased')  AND b.invoiceno='$Invoice';";
	
  

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
