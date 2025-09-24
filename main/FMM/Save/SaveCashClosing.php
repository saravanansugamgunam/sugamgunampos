<?php

session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["DayCloseDate"])) {

   // echo "1";
   include("../../../connect.php");
   $currentdate = date("Y-m-d H:i:s");



   $DayCloseDate = mysqli_real_escape_string($connection, $_POST["DayCloseDate"]);
   $Note2000 = mysqli_real_escape_string($connection, $_POST["Note2000"]);
   $Note500 = mysqli_real_escape_string($connection, $_POST["Note500"]);
   $Note200 = mysqli_real_escape_string($connection, $_POST["Note200"]);
   $Note100 = mysqli_real_escape_string($connection, $_POST["Note100"]);
   $Note50 = mysqli_real_escape_string($connection, $_POST["Note50"]);
   $Note20 = mysqli_real_escape_string($connection, $_POST["Note20"]);
   $Note10 = mysqli_real_escape_string($connection, $_POST["Note10"]);
   $NoteCoins = mysqli_real_escape_string($connection, $_POST["NoteCoins"]);
   $CashonHand = mysqli_real_escape_string($connection, $_POST["CashonHand"]);
   $GrossCash = mysqli_real_escape_string($connection, $_POST["GrossCash"]);
   $Expense = mysqli_real_escape_string($connection, $_POST["Expense"]);
   $NettCash = mysqli_real_escape_string($connection, $_POST["NettCash"]);
   $Remarks = mysqli_real_escape_string($connection, $_POST["Remarks"]);
   $Location = mysqli_real_escape_string($connection, $_POST["Location"]);
   $MedCash = mysqli_real_escape_string($connection, $_POST["MedCash"]);
   $ConCash = mysqli_real_escape_string($connection, $_POST["ConCash"]);
   $TheCash = mysqli_real_escape_string($connection, $_POST["TheCash"]);
   $OthCash = mysqli_real_escape_string($connection, $_POST["OthCash"]);
   $CashDifference = mysqli_real_escape_string($connection, $_POST["CashDifference"]);
   $PettycashOpening = mysqli_real_escape_string($connection, $_POST["PettycashOpening"]);
   $PettycashClosing = mysqli_real_escape_string($connection, $_POST["PettycashClosing"]);
   $PettyCashDifference = mysqli_real_escape_string($connection, $_POST["PettyCashDifference"]);


   $LocationCode = $_SESSION['SESS_LOCATION'];
   $ClientID = 1;
   $userid = $_SESSION['SESS_MEMBER_ID'];

   try {

      $AddPaymentMode = "insert into denomination
      (closingdate,n2000,n500,n200,n100,n50,n20,n10,coin,clientid,cashinhand,
      grosscash,expense,nettcash,remarks,enteredby,medcash,concash,thecash,othcash,cashdifference,
      openingcash,closingcash,pettycashdifference,closinggroup) values 
      ('$DayCloseDate','$Note2000','$Note500','$Note200','$Note100','$Note50','$Note20','$Note10','$NoteCoins','$LocationCode','$CashonHand',
      '$GrossCash','$Expense','$NettCash','$Remarks','$userid','$MedCash','$ConCash','$TheCash',
      '$OthCash','$CashDifference','$PettycashOpening','$PettycashClosing','$PettyCashDifference',1);";

      mysqli_multi_query($connection, $AddPaymentMode);
      echo "1";
      // echo $AddPaymentMode;

   } catch (Exception $e) {
      echo 'Message: ' . $e->getMessage();
   }
} else {
   echo "Error Adding";
}
