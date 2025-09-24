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
   date_default_timezone_set("Asia/Kolkata");
   // echo "1";
   include("../../../connect.php");

   $currentdate = date("Y-m-d H:i:s");
   $currenttime = date("His");

   $payments = json_decode($_POST['payments'], true);



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
   $OldAmountAdjusted = mysqli_real_escape_string($connection, $_POST["OldAmountAdjusted"]);
   $ConsultingTiming = mysqli_real_escape_string($connection, $_POST["ConsultingTiming"]);

   $GroupID = $_SESSION['SESS_GROUP_ID'];
//   if ($GroupID == 1) {
//       $LocationCode = $LocationcodeAdmin;
//   } else {
      $LocationCode = $_SESSION['SESS_LOCATION'];
//   }

   $InvoicePrefix  =    substr($LocationCode, 0, 2);
   $InvoicePrefix  =    "L" . $InvoicePrefix;
   // $ClientID = $_SESSION["CMS_CompanyID"];
   // $userid = $_SESSION["CMS_EmployeeID"];
   $ClientID = 1;
   $userid = $_SESSION['SESS_MEMBER_ID'];
   try {




      $NewTokenNumber = 0;
      $currenttime = date("His");
      if ($currenttime < 140001) {

         $query = mysqli_query($connection, " 
SELECT IFNULL(MAX(revisedtokennumber),0)+1 AS TokenNo FROM tokenmaster WHERE DATE ='$BillDate' AND
createdon < 140001 AND tokenstatus NOT IN ('Cancelled') and   doctorid ='$DoctorCode' AND locationcode ='$LocationCode'

");
      } else {
         $query = mysqli_query($connection, " 
SELECT IFNULL(MAX(revisedtokennumber),0)+1 AS TokenNo FROM tokenmaster WHERE DATE ='$BillDate' AND
createdon > 140000 AND tokenstatus NOT IN ('Cancelled') AND doctorid ='$DoctorCode' AND locationcode ='$LocationCode'
 ");
      }

      $data = array();

      while ($row = mysqli_fetch_assoc($query)) {
         $NewTokenNumber = $row['TokenNo'];
      }

 
   
    $RandomeInvoiceNo = random_num(9);
      $SaveSaleMaster = "insert into consultingbillmaster (billdate,consultationuniquebill,doctorid,paitentid,discountamount,
      totalamount,locationcode,addedby,remarks,tokennumber,receivedamount,oldbalance,newbalance,grossamount,billingtype,timeid,einvoiceno) values 
	('$BillDate','$Invoice','$DoctorCode','$PaitentCode','$TotalDiscountAmount','$TotalSaleAmount','$LocationCode','$userid',
   '$Remarks','$NewTokenNumber','$ReceivedAmount','$OldBalance','$NewBalance','$GrossAmount','$BillingType','$ConsultingTiming','$RandomeInvoiceNo');";



  

      if ($NewTokenNumber > 0) {
         $SaveSaleMaster .= "insert into tokenmaster (locationcode,date,tokennumber,revisedtokennumber,
         invoicenumber,paitentcode,doctorid,totalamount,createdon,
         patientarivalstatus,patientarivaltime) values 
	('$LocationCode','$BillDate','$NewTokenNumber','$NewTokenNumber','$Invoice','$PaitentCode','$DoctorCode',
   '$TotalSaleAmount','$currenttime','1','$currentdate');";
      }



      $SaveSaleMaster .= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
creditamount,createdby,clientid,remarks)
VALUES 
('Consulting','Consulting Fee','$Invoice','$BillDate','$PaitentCode','$TotalSaleAmount','0','$userid','$LocationCode','$Remarks');";



      if ($ReceivedAmount > 0) {
         $SaveSaleMaster .= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,invoicegrndate,vendorcode,debitamount,
   creditamount,createdby,clientid,remarks)
   VALUES 
   ('Consulting','Consulting Fee - Payment','$Invoice','$BillDate','$PaitentCode','0','$ReceivedAmount','$userid','$LocationCode','$Remarks');";
      }


      
foreach ($payments as $payment) {
   $paymentCode  = $payment['code'];
   $amount = $payment['amount'];
   mysqli_query($connection, "INSERT INTO salepaymentdetails (invoiceno, amount,paymentmode,customercode,
   date,transactiontype,clientid,transactiongroup) VALUES 
   ('$Invoice', '$amount','$paymentCode','$PaitentCode','$BillDate','DoctorFee','$LocationCode','Clinic')");
}




      if ($OldAmountAdjusted <> 0) {
         $SaveSaleMaster .= "insert into outstandingadjustmentdetails (uniqueno,totalamount,adjustedamount,date,transactiontype,createdby) values 
	('$Invoice','$TotalSaleAmount','$OldAmountAdjusted','$BillDate','Consulting - Sale','$userid');";
      }

      if ($NewBalance <> 0) {
         $SaveSaleMaster .= "insert into outstandingdetails (uniqueno,totalamount,outstandingamount,date,transactiontype,createdby) values 
	('$Invoice','$TotalSaleAmount','$NewBalance','$BillDate','Consulting - Sale','$userid');";
      }


      $SaveSaleMaster .= "  UPDATE paitentmaster set topay=topay+'$TotalSaleAmount'+'$CourierCharges', 
		receipt =receipt+'$ReceivedAmount' where paitentid='$PaitentCode';";

      $SaveSaleMaster .= "  UPDATE salepaymentdetails set completionstatus =1 where invoiceno='$Invoice'; ";

      if (mysqli_multi_query($connection, $SaveSaleMaster)) {

         // echo "Service Requese has been registered, Request ID is " . $last_id;
         echo "1";
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
