 <?php

  session_cache_limiter(FALSE);
  session_start();
  include("../../../connect.php");
  //insert.php
  if (isset($_POST["CenterID"])) {


    $currentdate = date("Y-m-d H:i:s");
    $currenttime = date("His");

    $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
    $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
    $CenterID = mysqli_real_escape_string($connection, $_POST["CenterID"]);
    $ShareType = mysqli_real_escape_string($connection, $_POST["ShareType"]);
    $CheckAllStatus = mysqli_real_escape_string($connection, $_POST["CheckAllStatus"]);
    $SelectedBill = stripslashes(mysqli_real_escape_string($connection, $_POST["SelectedBill"]));
    $DoctorTherapist = stripslashes(mysqli_real_escape_string($connection, $_POST["DoctorTherapist"]));
    $AlreadyPaid = 0;
 
      if ($CheckAllStatus == 1) {
        $result = mysqli_query($connection, " 
  
    SELECT  ROUND(SUM(nettamount),0) as TotalSale, 
    ROUND(SUM(nettamount),0)  AS Profit  FROM diagnosissalemaster  AS a  JOIN diagnosticcentre AS b ON a.diagnosticcenter=b.centerid 
    JOIN paitentmaster AS c ON a.paitentid=c.paitentid
    LEFT JOIN diagnosticcenterbillsharedetails AS d ON a.diagnosisuniqueno=d.billuniqueid 
    WHERE saledate > '2022-08-01'    AND saledate   BETWEEN '$FromDate' AND '$ToDate'   
     AND   a.locationcode LIKE('%') AND a.cancellstatus =0  and nettamount > 0 AND a.diagnosticcenter LIKE ('$CenterID')  
     and diagnosisuniqueno NOT IN (SELECT billuniqueid FROM diagnosticcenterbillsharedetails)  ORDER BY saledate DESC
 ");
      } else {
        $result = mysqli_query($connection, " 
    SELECT  ROUND(SUM(nettamount),0) as TotalSale, 
    ROUND(SUM(nettamount),0)  AS Profit  FROM diagnosissalemaster  AS a  JOIN diagnosticcentre AS b ON a.diagnosticcenter=b.centerid 
    JOIN paitentmaster AS c ON a.paitentid=c.paitentid
    LEFT JOIN diagnosticcenterbillsharedetails AS d ON a.diagnosisuniqueno=d.billuniqueid 
    WHERE saledate > '2022-08-01'    AND saledate   BETWEEN '$FromDate' AND '$ToDate'   
     AND   a.locationcode LIKE('%') AND a.cancellstatus =0  and nettamount > 0 AND a.diagnosticcenter LIKE ('$CenterID')  
     and diagnosisuniqueno    in ($SelectedBill) ORDER BY saledate DESC
      ");
      }
    


    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {

      $data[] =  $row['TotalSale'];
      $data[] =  $row['Profit'];
      $data[] =  $AlreadyPaid;
    }

    echo json_encode($data);


    mysqli_close($connection);
  }

  ?>