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
   $currentdateddmm = date("Y-m-d");
   $BillDate = $currentdateddmm;
   $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);
   $CampCode = mysqli_real_escape_string($connection, $_POST["CampCode"]);
      
   $CourierCharges = 0;
 
    $LocationCode = $_SESSION['SESS_LOCATION'];
   
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
createdon < 140001 AND tokenstatus NOT IN ('Cancelled') and 
doctorid in(select doctorcode from newregistrationdetails where id ='$CampCode') AND locationcode ='$LocationCode'

");
      } else {
         $query = mysqli_query($connection, " 
SELECT IFNULL(MAX(revisedtokennumber),0)+1 AS TokenNo FROM tokenmaster WHERE DATE ='$BillDate' AND
createdon > 140000 AND tokenstatus NOT IN ('Cancelled') AND
 doctorid in (select doctorcode from newregistrationdetails where id ='$CampCode') AND locationcode ='$LocationCode'
 ");
      }

      $data = array();

      while ($row = mysqli_fetch_assoc($query)) {
         $NewTokenNumber = $row['TokenNo'];
      }


      $SaveSaleMaster = "insert into consultingdetails (consultationuniquebill,consultationid,
      consultationname,consultationcharge,
      discount,doctorid,paitentid,consultationtotal,clientid,addedby) values 
      ('$Invoice',
      (select consultationid from newregistrationdetails where id ='$CampCode')
      ,'-','0','0',
      (select doctorcode from newregistrationdetails where id ='$CampCode'),
      (select customercode from newregistrationdetails where id ='$CampCode'),
      '0','$LocationCode','$userid');";

 $RandomeInvoiceNo = random_num(9);
      $SaveSaleMaster .= "insert into consultingbillmaster (billdate,consultationuniquebill,doctorid,paitentid,discountamount,totalamount,
      locationcode,addedby,remarks,tokennumber,receivedamount,oldbalance,newbalance,grossamount,billingtype,einvoiceno) values 
	('$BillDate','$Invoice',(select doctorcode from newregistrationdetails where id ='$CampCode'),
   (select customercode from newregistrationdetails where id ='$CampCode'),
   '0','0','$LocationCode','$userid',
   '-','$NewTokenNumber','0','0','0','0','Regular','$RandomeInvoiceNo');";

      if ($NewTokenNumber > 0) {
         $SaveSaleMaster .= "insert into tokenmaster (locationcode,date,tokennumber,revisedtokennumber,invoicenumber,
         paitentcode,doctorid,totalamount,createdon) values 
	('$LocationCode','$BillDate','$NewTokenNumber','$NewTokenNumber','$Invoice',
   (select customercode from newregistrationdetails where id ='$CampCode'),
   (select doctorcode from newregistrationdetails where id ='$CampCode'),
   '0','$currenttime');";
      }


      $SaveSaleMaster .= "insert into salepaymentdetails (customercode,paymentmode,amount,invoiceno,date,clientid,transactiontype,transactiongroup) values 
      ((select customercode from newregistrationdetails where id ='$CampCode'),
      '12','0','$Invoice','$currentdateddmm','$LocationCode','DoctorFee','Clinic');";



      $SaveSaleMaster .= " INSERT INTO transactionledger (transactiontype,transactionmode,invoicegrn,
      invoicegrndate,vendorcode,debitamount,
creditamount,createdby,clientid,remarks)
VALUES 
('Consulting','Consulting Fee','$Invoice','$BillDate',
(select customercode from newregistrationdetails where id ='$CampCode'),
'0','0','$userid','$LocationCode','-');";

      
    
      $SaveSaleMaster .= "  UPDATE newregistrationdetails SET convertedstatus ='1' where id='$CampCode'; ";

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