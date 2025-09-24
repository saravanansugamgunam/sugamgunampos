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

 $InvoicePrefix  = 	substr($LocationCode,0,2);  
 $InvoicePrefix  = 	"L".$InvoicePrefix;  
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];	
  $SaveSaleMaster='';
  try {
	  
	  if($BillType=='Free')
{ 
    $SaveSaleMaster.= "insert into salemaster (saledate,invoiceno,saleuniqueno,paitientcode,saleqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,doctorcode,remarks,saletype,couriercharges,billtype,addedby) values 
	('$SaleDate','$InvoicePrefix','$Invoice','$PaitentCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance','$ReceivedAmount','$NewBalance','$DoctorCode','$Remarks','Free','$CourierCharges','$BillingFormat','$userid');"; 
}
else if($BillType=='Courier')
{
		   
    $SaveSaleMaster.= "insert into salemaster (saledate,invoiceno,saleuniqueno,paitientcode,saleqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,doctorcode,remarks,saletype,couriercharges,billtype,addedby) values 
	('$SaleDate','$InvoicePrefix','$Invoice','$PaitentCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance','$ReceivedAmount','$NewBalance','$DoctorCode','$Remarks','Courier','$CourierCharges','$BillingFormat','$userid');"; 
}
else if($BillType=='Online')
{
		   
    $SaveSaleMaster.= "insert into salemaster (saledate,invoiceno,saleuniqueno,paitientcode,saleqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,doctorcode,remarks,saletype,couriercharges,billtype,addedby) values 
	('$SaleDate','$InvoicePrefix','$Invoice','$PaitentCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance','$ReceivedAmount','$NewBalance','$DoctorCode','$Remarks','Online','$CourierCharges','$BillingFormat','$userid');"; 
}
else
{
		  
    $SaveSaleMaster.= "insert into salemaster (saledate,invoiceno,saleuniqueno,paitientcode,saleqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,doctorcode,remarks,saletype,billtype,addedby) values 
	('$SaleDate','$InvoicePrefix','$Invoice','$PaitentCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance','$ReceivedAmount','$NewBalance','$DoctorCode','$Remarks','Counter','$BillingFormat','$userid');"; 
}


if($OldAmountAdjusted<>0)
{
   $SaveSaleMaster.= "insert into outstandingadjustmentdetails (uniqueno,totalamount,adjustedamount,date,transactiontype,createdby) values 
	('$Invoice','$TotalSaleAmount','$OldAmountAdjusted','$SaleDate','Inventory - Sale','$userid');";  
}

if($NewBalance<>0)
{
   $SaveSaleMaster.= "insert into outstandingdetails (uniqueno,totalamount,outstandingamount,date,transactiontype,createdby) values 
	('$Invoice','$TotalSaleAmount','$NewBalance','$SaleDate','Inventory - Sale','$userid');";  
}

 
	// $SaveSaleMaster.="  UPDATE newstockdetails_".$LocationCode." s,  newsaleitems p
	// SET s.salesqty = s.salesqty + p.saleqty,s.currentstock=s.currentstock-p.saleqty
	// WHERE s.barcode = p.barcode AND p.invoiceno='$Invoice'; "; 
	
 
	if($BillType=='Courier' || $BillType=='Online')
{
  $Address1 = mysqli_real_escape_string($connection, $_POST["txtAddress1"]);  
  $Address2 = mysqli_real_escape_string($connection, $_POST["txtAddress2"]);  
  $State = mysqli_real_escape_string($connection, $_POST["txtState"]);  
  $City = mysqli_real_escape_string($connection, $_POST["txtCity"]);  
  $Pincode = mysqli_real_escape_string($connection, $_POST["txtPincode"]); 
  $StateCode = mysqli_real_escape_string($connection, $_POST["txtStateList"]); 
   
  
  $SaveSaleMaster.= "insert into courierdetails (invoicenumber,couriercharge,address1,address2,city,state,pincode,statecode) values 
	('$Invoice','$CourierCharges','$Address1','$Address2','$City','$State','$Pincode','$StateCode');";
}


$SaveSaleMaster.= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,
vendorcode,debitamount,
creditamount,createdby,clientid,remarks)
VALUES 
('Medicine','Sale','$Invoice','$SaleDate','$PaitentCode','$TotalSaleAmount','0','$userid','$LocationCode','$Remarks');";

if($ReceivedAmount > 0)
{
   $SaveSaleMaster.= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
   creditamount,createdby,clientid,remarks)
   VALUES 
   ('Medicine','Sale - Payment','$Invoice','$SaleDate','$PaitentCode','0','$ReceivedAmount','$userid','$LocationCode','$Remarks');";
   
}
 

		$SaveSaleMaster.="  UPDATE paitentmaster set topay=topay+'$TotalSaleAmount'+'$CourierCharges', 
		receipt =receipt+'$ReceivedAmount' where paitentid='$PaitentCode';"; 

$SaveSaleMaster.="  UPDATE salemaster_estimate set estimateclosure=1 where saleuniqueno='$Invoice';"; 

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