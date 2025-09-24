<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {

  // echo "1";
  include("../../../connect.php");

  $currentdate = date("Y-m-d H:i:s");

  $DoctorCode = mysqli_real_escape_string($connection, $_POST["userid"]);
  $EntryDate = mysqli_real_escape_string($connection, $_POST["EntryDate"]);
  $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
  $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
  $CalculationMode = mysqli_real_escape_string($connection, $_POST["CalculationMode"]);
  $SharePercent = mysqli_real_escape_string($connection, $_POST["SharePercent"]);
  $AmountToPay = mysqli_real_escape_string($connection, $_POST["AmountToPay"]);
  $TotalSale = mysqli_real_escape_string($connection, $_POST["TotalSale"]);
  $Profit = mysqli_real_escape_string($connection, $_POST["Profit"]);
  $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);

  $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);
  $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);
  $ShareFor = mysqli_real_escape_string($connection, $_POST["ShareType"]);
  $SelectedBill = stripslashes(mysqli_real_escape_string($connection, $_POST["SelectedBill"]));
  $CheckAllStatus = mysqli_real_escape_string($connection, $_POST["CheckAllStatus"]);
  $LocationcodeAdmin = mysqli_real_escape_string($connection, $_POST["LocationCode"]);
  $DoctorTherapist = mysqli_real_escape_string($connection, $_POST["DoctorTherapist"]);



  $GroupID = $_SESSION['SESS_GROUP_ID'];
  if ($GroupID == 1) {
    $LocationCode = $LocationcodeAdmin;
  } else {
    $LocationCode = $_SESSION['SESS_LOCATION'];
  }
  $InvoicePrefix  =   substr($LocationCode, 0, 2);
  $InvoicePrefix  =   "L" . $InvoicePrefix;
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = $LocationCode;
  $userid = $_SESSION['SESS_MEMBER_ID'];
  $SharePercentToCalculateBillwise = $SharePercent * 1 / 100;

  try {

    $SaveSaleMaster = "insert into referencesharedetails (invoiceno,referenceid,entrydate,fromdate,todate,calculationmode,profitpercent,
    shareamount,totalsale,totalprofit,paymentmode,remarks,enteredby,sharefor) values 
	('$InvoiceNo','$DoctorCode','$EntryDate','$FromDate','$ToDate','$CalculationMode','$SharePercent','$AmountToPay',
  '$TotalSale','$Profit','$PaymentMode','$Remarks','$userid','$ShareFor');";



    if ($ShareFor == 'Inventory') {
      if ($CheckAllStatus == 1) {
        $SaveSaleMaster .= "INSERT INTO doctorsharebilldetails (paymentid,billuniqueid,billtype,referenceid,paiddate,paidamount,paymentmode,createdby) 
       SELECT '$InvoiceNo',saleuniqueno,billtype,doctorcode,'$EntryDate',
       ROUND((SUM(nettamount)) *$SharePercentToCalculateBillwise,1) ,'$PaymentMode','$userid' FROM salemaster WHERE
     saleuniqueno NOT IN (SELECT billuniqueid FROM doctorsharebilldetails) 
     and doctorcode='$DoctorCode' and  saledate   BETWEEN '$FromDate' AND '$ToDate'
     GROUP BY  saleuniqueno,billtype,doctorcode   ;";
      } else {
        $SaveSaleMaster .= "INSERT INTO doctorsharebilldetails (paymentid,billuniqueid,billtype,doctorid,paiddate,paidamount,paymentmode,createdby) 

      SELECT '$InvoiceNo',saleuniqueno,billtype,doctorcode,'$EntryDate',
       ROUND((SUM(nettamount)) *$SharePercentToCalculateBillwise,1) ,'$PaymentMode','$userid' FROM salemaster WHERE
     saleuniqueno IN ($SelectedBill) 
     and doctorcode='$DoctorCode' and  saledate   BETWEEN '$FromDate' AND '$ToDate'
     GROUP BY  saleuniqueno,billtype,doctorcode   ;";
      }
    } else  if ($ShareFor == 'Consultation') {
      if ($CheckAllStatus == 1) {
        $SaveSaleMaster .= "INSERT INTO doctorsharebilldetails (paymentid,billuniqueid,billtype,doctorid,paiddate,paidamount,paymentmode,createdby) 
   SELECT '$InvoiceNo',consultationuniquebill,billtype,doctorid,'$EntryDate',
   ROUND((SUM(totalamount)-SUM(discountamount)) *$SharePercentToCalculateBillwise,1) ,'$PaymentMode','$userid' FROM consultingbillmaster WHERE
     consultationuniquebill NOT IN (SELECT billuniqueid FROM doctorsharebilldetails) 
     and doctorid='$DoctorCode' and  billdate   BETWEEN '$FromDate' AND '$ToDate'
     group by  consultationuniquebill,billtype,doctorid   ;";
      } else {
        $SaveSaleMaster .= "INSERT INTO doctorsharebilldetails (paymentid,billuniqueid,billtype,doctorid,paiddate,paidamount,paymentmode,createdby) 
   SELECT '$InvoiceNo',consultationuniquebill,billtype,doctorid,'$EntryDate',
   ROUND((SUM(totalamount)-SUM(discountamount)) *$SharePercentToCalculateBillwise,1) ,'$PaymentMode','$userid' 
   FROM consultingbillmaster WHERE  consultationuniquebill IN($SelectedBill) group by  consultationuniquebill,billtype,doctorid   ;";
      }
    } else  if ($ShareFor == 'Therapy') {

      if ($DoctorTherapist == 'Doctor') {
        if ($CheckAllStatus == 1) {
          $SaveSaleMaster .= "INSERT INTO referencesharebilldetails (paymentid,billuniqueid,billtype,referenceid,paiddate,
          paidamount,paymentmode,createdby)

   SELECT '$InvoiceNo',bookingid,'Therapy','$DoctorCode','$EntryDate',
   ROUND((SUM(nettamount)) *$SharePercentToCalculateBillwise,1) ,'$PaymentMode','$userid' FROM therapybookingdetails  as a
   join paitentmaster as b on a.paitentid=b.paitentid WHERE
   bookingid NOT IN (SELECT billuniqueid FROM referencesharebilldetails where billtype ='Therapy') 
     and b.referenceid='$DoctorCode' and  closingdate   BETWEEN '$FromDate' AND '$ToDate'  AND   bookingstatus ='Closed'
     group by  bookingid   ;";
        } else {
          $SaveSaleMaster .= "INSERT INTO referencesharebilldetails (paymentid,billuniqueid,billtype,referenceid,paiddate,paidamount,paymentmode,createdby)

        SELECT '$InvoiceNo',bookingid,'Therapy','$DoctorCode','$EntryDate',
        ROUND((SUM(nettamount)) *$SharePercentToCalculateBillwise,1) ,'$PaymentMode','$userid' FROM therapybookingdetails  as a
       join paitentmaster as b on a.paitentid=b.paitentid WHERE
        bookingid IN ($SelectedBill) 
          and b.referenceid='$DoctorCode' and  closingdate   BETWEEN '$FromDate' AND '$ToDate'  AND   bookingstatus ='Closed'
          group by  bookingid   ;";
        }
      } else {

        if ($CheckAllStatus == 1) {
          $SaveSaleMaster .= "INSERT INTO referencesharebilldetails (paymentid,billuniqueid,billtype,referenceid,paiddate,paidamount,paymentmode,createdby)

   SELECT '$InvoiceNo',bookingid,'Therapy','$DoctorCode','$EntryDate',
   ROUND((SUM(nettamount)) *$SharePercentToCalculateBillwise,1) ,'$PaymentMode','$userid' FROM therapybookingdetails  as a
       join paitentmaster as b on a.paitentid=b.paitentid WHERE
   bookingid NOT IN (SELECT billuniqueid FROM referencesharebilldetails where billtype ='Therapy') 
     and  b.referenceid='$DoctorCode' and  closingdate   BETWEEN '$FromDate' AND '$ToDate'  AND   bookingstatus ='Closed'
     group by  bookingid   ;";
        } else {
          $SaveSaleMaster .= "INSERT INTO referencesharebilldetails (paymentid,billuniqueid,billtype,referenceid,paiddate,paidamount,paymentmode,createdby)

        SELECT '$InvoiceNo',bookingid,'Therapy','$DoctorCode','$EntryDate',
        ROUND((SUM(nettamount)) *$SharePercentToCalculateBillwise,1) ,'$PaymentMode','$userid' FROM therapybookingdetails  as a
       join paitentmaster as b on a.paitentid=b.paitentid WHERE
        bookingid IN ($SelectedBill) 
          and  b.referenceid='$DoctorCode' and  closingdate   BETWEEN '$FromDate' AND '$ToDate'  AND   bookingstatus ='Closed'
          group by  bookingid   ;";
        }
      }
    }







    if ($ShareFor == 'Consultation') {
      $SaveSaleMaster .= "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,clientid,transactiontype,transactiongroup) 
  values ('$DoctorCode','$PaymentMode','$AmountToPay','$InvoiceNo','$EntryDate','$ClientID','Consulting Share','Clinic')";
    } else if ($ShareFor == 'Therapy') {
      $SaveSaleMaster .= "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,clientid,transactiontype,transactiongroup) 
  values ('$DoctorCode','$PaymentMode','$AmountToPay','$InvoiceNo','$EntryDate','$ClientID','Therapy Share','Clinic')";
    } else {
      $SaveSaleMaster .= "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,clientid,transactiontype,transactiongroup) 
  values ('$DoctorCode','$PaymentMode','$AmountToPay','$InvoiceNo','$EntryDate','$ClientID','Inventory Share','Clinic')";
    }


    if (mysqli_multi_query($connection, $SaveSaleMaster)) {

      // echo "Service Requese has been registered, Request ID is " . $last_id;
      echo "1";
      //  echo $SaveSaleMaster;
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