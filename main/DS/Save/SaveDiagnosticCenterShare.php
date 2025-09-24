<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["InvoiceNo"])) {

  // echo "1";
  include("../../../connect.php");

  $currentdate = date("Y-m-d H:i:s");

  $CenterID = mysqli_real_escape_string($connection, $_POST["CenterID"]);
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

    $SaveSaleMaster = "insert into diagnosticcentersharedetails (invoiceno,centercode,entrydate,fromdate,todate,calculationmode,profitpercent,
    shareamount,totalsale,totalprofit,paymentmode,remarks,enteredby,sharefor) values 
	('$InvoiceNo','$CenterID','$EntryDate','$FromDate','$ToDate','$CalculationMode','$SharePercent','$AmountToPay',
  '$TotalSale','$Profit','$PaymentMode','$Remarks','$userid','$ShareFor');";


 
      if ($CheckAllStatus == 1) {
        $SaveSaleMaster .= "INSERT INTO diagnosticcenterbillsharedetails (paymentid,billuniqueid,billtype,centerid,paiddate,
        paidamount,paymentmode,createdby) 
       SELECT '$InvoiceNo',diagnosisuniqueno,'Lab Test',diagnosticcenter,'$EntryDate',
       ROUND((SUM(nettamount)) *$SharePercentToCalculateBillwise,1) ,'$PaymentMode','$userid' FROM diagnosissalemaster WHERE
       diagnosisuniqueno NOT IN (SELECT billuniqueid FROM diagnosticcenterbillsharedetails) 
     and diagnosticcenter='$CenterID' and  saledate   BETWEEN '$FromDate' AND '$ToDate'
     GROUP BY  diagnosisuniqueno,diagnosticcenter   ;";
      } else {
        $SaveSaleMaster .= "INSERT INTO diagnosticcenterbillsharedetails (paymentid,billuniqueid,billtype,centerid,paiddate,paidamount,paymentmode,createdby) 

      SELECT '$InvoiceNo',diagnosisuniqueno,'Lab Test',diagnosticcenter,'$EntryDate',
       ROUND((SUM(nettamount)) *$SharePercentToCalculateBillwise,1) ,'$PaymentMode','$userid' FROM diagnosissalemaster WHERE
       diagnosisuniqueno IN ($SelectedBill) 
     and diagnosticcenter='$CenterID' and  saledate   BETWEEN '$FromDate' AND '$ToDate'
     GROUP BY  diagnosisuniqueno,diagnosticcenter   ;";
      }
      
      $SaveSaleMaster .= "insert into salepaymentdetails (customercode ,paymentmode,amount,invoiceno,date,clientid,transactiontype,transactiongroup) 
  values ('$CenterID','$PaymentMode','$AmountToPay','$InvoiceNo','$EntryDate','$ClientID','Diagnostic Center Share','Clinic')";
    

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