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
if (isset($_POST["InvoiceNo"])) {

  // echo "1";
  include("../../../connect.php");

  $currentdate = date("Y-m-d");

 
  $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]); 
  $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]); 
  $OldUniqueID = mysqli_real_escape_string($connection, $_POST["OldUniqueID"]); 
  

  $LocationCode = $_SESSION['SESS_LOCATION'];
  // $ClientID = $_SESSION["CMS_CompanyID"];
  // $userid = $_SESSION["CMS_EmployeeID"];
  $ClientID = 1;
  $userid = $_SESSION['SESS_MEMBER_ID'];
  $UdateCaseHistory = '';
  
  $RandomeInvoiceNo = random_num(9);

  try { 
$res = $connection->query("

select 
(SELECT COUNT(*) AS CaseHistoryCount FROM casehistory WHERE consultinguniqueid ='$InvoiceNo') as CaseSheetCount 
");

   $CaseSheetCount = 0; 
   while ($data = mysqli_fetch_row($res)) {

      $CaseSheetCount = $data[0]; 
   }


  $UdateCaseHistory .= "
  INSERT INTO diseasemapping_paitent (paitientid,conceptid,
  conceptname,addedby,consultingdate,clientid,diseasemappinguniqueid,mor,aft,eve,
  nig,cond,duration,condmanual,prescriptionuom,condmanualduration)     
  SELECT  paitientid,conceptid,
  conceptname,'$userid','$currentdate',clientid,'$InvoiceNo',mor,aft,eve,
  nig,cond,duration,condmanual,prescriptionuom,condmanualduration  FROM  `diseasemapping_paitent` 
  WHERE paitientid ='$PaitentID' AND diseasemappinguniqueid='$OldUniqueID' AND 
  conceptid NOT IN (SELECT conceptid FROM diseasemapping_paitent WHERE  diseasemappinguniqueid ='$InvoiceNo') ;";
 
if($CaseSheetCount>0)
{

}
else
{
  $UdateCaseHistory .= "INSERT INTO casehistory (paitentid,height,weight,pulse,bp,temperature,shn,
  chiefcompliant,presentillness,pastillness, disgnosis,rx,diet,testsrequired,medicineid,
  consultinguniqueid,consultingdate,createdby, siddhapulse,tcmpulse)   
  SELECT paitentid,height,weight,pulse,bp,temperature,shn,chiefcompliant,presentillness,pastillness,
  disgnosis,rx,diet,testsrequired,medicineid,'$InvoiceNo','$currentdate','$userid',
  siddhapulse,tcmpulse FROM casehistory  WHERE paitentid ='$PaitentID' ORDER BY createdon DESC LIMIT 1 ;";
}

     
   
  
    
  // $UdateCaseHistory .= "update diseasemapping_paitent set eprescriptionno = '$RandomeInvoiceNo'
  //  where diseasemappinguniqueid ='$InvoiceNo';";

    if (mysqli_multi_query($connection, $UdateCaseHistory)) {
      echo 1;
      // echo $SaveSaleMaster;
    } else {
      // echo "ERROR: Could not able to execute $AddItem. " . mysqli_error($connection);
       echo "0";
     // echo $UdateCaseHistory;
    }
  } catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
} else {
  echo "Error";
}