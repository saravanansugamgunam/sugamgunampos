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
if (isset($_POST["Invoice"])) {

   // echo "1";
   include("../../../connect.php");

   $currentdate = date("Y-m-d");


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


   $LocationCode = $LocationcodeAdmin;
      $RandomeInvoiceNo = random_num(9);



   $InvoicePrefix  =    substr($LocationCode, 0, 2);
   $InvoicePrefix  =    "L" . $InvoicePrefix;
   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = $_SESSION['SESS_MEMBER_ID'];
   $SaveSaleMaster = '';
   try {

       if ($BillType == 'Free') {
         $SaveSaleMaster .= "insert into salemaster (saledate,invoiceno,saleuniqueno,paitientcode,saleqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,doctorcode,remarks,saletype,couriercharges,billtype,addedby,deliverystatus,einvoiceno) values 
	('$SaleDate','$InvoicePrefix','$Invoice','$PaitentCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance','$ReceivedAmount','$NewBalance','$DoctorCode','$Remarks','Free','$CourierCharges','$BillingFormat','$userid','1','$RandomeInvoiceNo');";
      } else if ($BillType == 'Courier') {

         $SaveSaleMaster .= "insert into salemaster (saledate,invoiceno,saleuniqueno,paitientcode,saleqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,doctorcode,remarks,saletype,couriercharges,billtype,addedby,deliverystatus,einvoiceno) values 
	('$SaleDate','$InvoicePrefix','$Invoice','$PaitentCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance','$ReceivedAmount','$NewBalance','$DoctorCode','$Remarks','Courier','$CourierCharges','$BillingFormat','$userid','1','$RandomeInvoiceNo');";
      } else if ($BillType == 'Online') {

         $SaveSaleMaster .= "insert into salemaster (saledate,invoiceno,saleuniqueno,paitientcode,saleqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,doctorcode,remarks,saletype,couriercharges,billtype,addedby,deliverystatus,einvoiceno) values 
	('$SaleDate','$InvoicePrefix','$Invoice','$PaitentCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance','$ReceivedAmount','$NewBalance','$DoctorCode','$Remarks','Online','$CourierCharges','$BillingFormat','$userid','1','$RandomeInvoiceNo');";
      } else {

         $SaveSaleMaster .= "insert into salemaster (saledate,invoiceno,saleuniqueno,paitientcode,saleqty,discountamount,nettamount,profitamount,locationcode,oldbalance,received,newbalance,doctorcode,remarks,saletype,billtype,addedby,deliverystatus,einvoiceno) values 
	('$SaleDate','$InvoicePrefix','$Invoice','$PaitentCode','$TotalSaleQty','$TotalDiscountAmount','$TotalSaleAmount','$TotalProfitAmount','$LocationCode','$OldBalance','$ReceivedAmount','$NewBalance','$DoctorCode','$Remarks','Counter','$BillingFormat','$userid','1','$RandomeInvoiceNo');";
      }

      if ($OldAmountAdjusted <> 0) {
         $SaveSaleMaster .= "insert into outstandingadjustmentdetails (uniqueno,totalamount,adjustedamount,date,transactiontype,createdby) values 
	('$Invoice','$TotalSaleAmount','$OldAmountAdjusted','$SaleDate','Inventory - Sale','$userid');";
      }

      if ($NewBalance <> 0) {
         $SaveSaleMaster .= "insert into outstandingdetails (uniqueno,totalamount,outstandingamount,date,transactiontype,createdby) values 
	('$Invoice','$TotalSaleAmount','$NewBalance','$SaleDate','Inventory - Sale','$userid');";
      }

      $SaveSaleMaster .= "  UPDATE newsaleitems set deliverystatus=1 where invoiceno='$Invoice'; ";
      
      
      $SaveSaleMaster .= "  UPDATE diseasemapping_paitent set 
      medicinecompleted=1 where paitientid='$PaitentCode' and consultingdate='$currentdate'; ";



      $SaveSaleMaster .= "  UPDATE salepaymentdetails set completionstatus =1 where invoiceno='$Invoice'; ";


      $SaveSaleMaster .= "  UPDATE    newstockdetails_" . $LocationCode . " s,  newsaleitems p
	SET       s.salesqty = s.salesqty + p.saleqty,s.currentstock=s.currentstock-p.saleqty
	WHERE     s.barcode = p.barcode and 
   s.mrp=p.mrp and 
s.batchno=p.batchcode and 
s.expirydate=p.expirydate 
AND p.invoiceno='$Invoice'; ";




      // $SaveSaleMaster.="  UPDATE paitientorder a, newsaleitems as b 
      // set a.orderstatus ='Delivered', a.invoiceno='$Invoice', a.invoicedate='$SaleDate' 
      // where a.productcode in(SELECT productcode FROM stockdetails_1 WHERE stockitemid in(b.itemid)) and a.paitentid='$PaitentCode' and a.orderstatus in('Open','Purchased')  AND b.invoiceno='$Invoice';";

      if ($BillType == 'Courier' || $BillType == 'Online') {
         $Address1 = mysqli_real_escape_string($connection, $_POST["txtAddress1"]);
         $Address2 = mysqli_real_escape_string($connection, $_POST["txtAddress2"]);
         $State = mysqli_real_escape_string($connection, $_POST["txtState"]);
         $City = mysqli_real_escape_string($connection, $_POST["txtCity"]);
         $Pincode = mysqli_real_escape_string($connection, $_POST["txtPincode"]);



         $SaveSaleMaster .= "insert into courierdetails (invoicenumber,couriercharge,address1,address2,city,state,pincode) values 
	('$Invoice','$CourierCharges','$Address1','$Address2','$City','$State','$Pincode');";
      }


      $SaveSaleMaster .= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
creditamount,createdby,clientid,remarks)
VALUES 
('Medicine','Sale','$Invoice','$SaleDate','$PaitentCode','$TotalSaleAmount','0','$userid','$LocationCode','$Remarks');";

      if ($ReceivedAmount > 0) {
         $SaveSaleMaster .= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
   creditamount,createdby,clientid,remarks)
   VALUES 
   ('Medicine','Sale - Payment','$Invoice','$SaleDate','$PaitentCode','0','$ReceivedAmount','$userid','$LocationCode','$Remarks');";
      }


      $SaveSaleMaster .= "  UPDATE paitentmaster set topay=topay+'$TotalSaleAmount'+'$CourierCharges', 
		receipt =receipt+'$ReceivedAmount' where paitentid='$PaitentCode';";


      if (mysqli_multi_query($connection, $SaveSaleMaster)) {

         // echo "Service Requese has been registered, Request ID is " . $last_id;
         echo "1";
         // echo $SaveSaleMaster;
      } else {
         echo "Error: " . $SaveSaleMaster . "" . mysqli_error($connection);
      }
      // echo $AddBatch;


   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error";
}
