 <?php

  session_cache_limiter(FALSE);
  session_start();
  include("../../../connect.php");
  //insert.php
  if (isset($_POST["userid"])) {


    $currentdate = date("Y-m-d H:i:s");
    $currenttime = date("His");

    $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
    $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
    $userid = mysqli_real_escape_string($connection, $_POST["userid"]);
    $ShareType = mysqli_real_escape_string($connection, $_POST["ShareType"]);
    $CheckAllStatus = mysqli_real_escape_string($connection, $_POST["CheckAllStatus"]);
    $SelectedBill = stripslashes(mysqli_real_escape_string($connection, $_POST["SelectedBill"]));
    $DoctorTherapist = stripslashes(mysqli_real_escape_string($connection, $_POST["DoctorTherapist"]));
    $AlreadyPaid = 0;

    if ($ShareType == 'Inventory') {
      if ($CheckAllStatus == 1) {
        $result = mysqli_query($connection, " 
  
    SELECT  ROUND(SUM(nettamount),0) as TotalSale, 
    ROUND(SUM(nettamount),0)  AS Profit  FROM salemaster  AS a  JOIN usermaster AS b ON a.doctorcode=b.userid 
    JOIN paitentmaster AS c ON a.paitientcode=c.paitentid
    LEFT JOIN doctorsharebilldetails AS d ON a.saleuniqueno=d.billuniqueid 
    WHERE saledate > '2022-08-01'    AND saledate   BETWEEN '$FromDate' AND '$ToDate'   
     AND   a.locationcode LIKE('%') AND a.cancellstatus =0  and nettamount > 0 AND a.doctorcode LIKE ('$userid')  
     and saleuniqueno NOT IN (SELECT billuniqueid FROM doctorsharebilldetails)  ORDER BY saledate DESC
 ");
      } else {
        $result = mysqli_query($connection, " 
    SELECT  ROUND(SUM(nettamount),0) as TotalSale, 
    ROUND(SUM(nettamount),0)  AS Profit  FROM salemaster  AS a  JOIN usermaster AS b ON a.doctorcode=b.userid 
    JOIN paitentmaster AS c ON a.paitientcode=c.paitentid
    LEFT JOIN doctorsharebilldetails AS d ON a.saleuniqueno=d.billuniqueid 
    WHERE saledate > '2022-08-01'    AND saledate   BETWEEN '$FromDate' AND '$ToDate'   
     AND   a.locationcode LIKE('%') AND a.cancellstatus =0  and nettamount > 0 AND a.doctorcode LIKE ('$userid')  
     and saleuniqueno    in ($SelectedBill) ORDER BY saledate DESC
      ");
      }
    } else if ($ShareType == 'Consultation') {
      if ($CheckAllStatus == 1) {
        $result = mysqli_query($connection, " 
    SELECT ROUND(SUM(totalamount)-SUM(discountamount),0) AS TotalSale,ROUND(SUM(totalamount)-SUM(discountamount),0) AS Profit 
    from consultingbillmaster  AS a  JOIN usermaster AS b ON a.doctorid=b.userid 
    WHERE billdate BETWEEN '$FromDate' AND '$ToDate'  AND  a.locationcode LIKE('%') 
    AND a.cancelledstatus =0  AND a.doctorid LIKE ('$userid') and billtype='$ShareType' 
    and consultationuniquebill not in (SELECT billuniqueid FROM doctorsharebilldetails)  ORDER BY billdate DESC ");
      } else {
        $result = mysqli_query($connection, " 
    SELECT ROUND(SUM(totalamount)-SUM(discountamount),0) AS TotalSale,ROUND(SUM(totalamount)-SUM(discountamount),0) AS Profit 
    from consultingbillmaster  AS a  JOIN usermaster AS b ON a.doctorid=b.userid 
    WHERE billdate BETWEEN '$FromDate' AND '$ToDate'  AND  a.locationcode LIKE('%') 
    AND a.cancelledstatus =0  AND a.doctorid LIKE ('$userid') and billtype='$ShareType' 
    and consultationuniquebill in ($SelectedBill)  ORDER BY billdate DESC ");
      }
    } else if ($ShareType == 'Therapy') {

      if ($DoctorTherapist == 'Doctor') {
        if ($CheckAllStatus == 1) {
          $result = mysqli_query($connection, "SELECT ROUND(SUM(nettamount),0) AS TotalSale,ROUND(SUM(nettamount),0) AS Profit,
           (SELECT  IFNULL(therapypercent,0) FROM referencemaster WHERE referenceid ='$userid') as SharePercent
        FROM therapybookingdetails AS a JOIN paitentmaster AS b ON 
   a.paitentid = b.paitentid LEFT JOIN consultationmaster AS c ON a.therapyid = c.consultationid WHERE closingdate > '2022-08-01' 
   AND closingdate BETWEEN '$FromDate' AND '$ToDate'   AND  b.referenceid LIKE ('$userid')    AND   bookingstatus ='Closed' 
   and bookingid not in (SELECT billuniqueid FROM doctorsharebilldetails where billtype ='Therapy') ");
        } else {
          $result = mysqli_query($connection, "SELECT ROUND(SUM(nettamount),0) AS TotalSale,ROUND(SUM(nettamount),0) AS Profit,
           (SELECT  IFNULL(therapypercent,0) FROM referencemaster WHERE referenceid ='$userid') as SharePercent 
         FROM therapybookingdetails AS a JOIN paitentmaster AS b ON 
   a.paitentid = b.paitentid LEFT JOIN consultationmaster AS c ON a.therapyid = c.consultationid WHERE closingdate > '2022-08-01' 
   AND closingdate BETWEEN '$FromDate' AND '$ToDate'   AND  b.referenceid LIKE ('$userid') AND   bookingstatus ='Closed' and 
     bookingid   in ($SelectedBill)   ");
        }
      } else {
        if ($CheckAllStatus == 1) {
          $result = mysqli_query($connection, "SELECT ROUND(SUM(nettamount),0) AS TotalSale,ROUND(SUM(nettamount),0) AS Profit,
           (SELECT  IFNULL(therapypercent,0) FROM referencemaster WHERE referenceid ='$userid') as SharePercent
        FROM therapybookingdetails AS a JOIN paitentmaster AS b ON 
   a.paitentid = b.paitentid LEFT JOIN consultationmaster AS c ON a.therapyid = c.consultationid WHERE closingdate > '2022-08-01' 
   AND closingdate BETWEEN '$FromDate' AND '$ToDate'   AND  b.referenceid LIKE ('$userid') AND   bookingstatus ='Closed' 
   and bookingid not in (SELECT billuniqueid FROM doctorsharebilldetails where billtype ='Therapy') ");
        } else {
          $result = mysqli_query($connection, "SELECT ROUND(SUM(nettamount),0) AS TotalSale,ROUND(SUM(nettamount),0) AS Profit,
           (SELECT  IFNULL(therapypercent,0) FROM referencemaster WHERE referenceid ='$userid') as SharePercent
         FROM therapybookingdetails AS a JOIN paitentmaster AS b ON 
   a.paitentid = b.paitentid LEFT JOIN consultationmaster AS c ON a.therapyid = c.consultationid WHERE closingdate > '2022-08-01' 
   AND closingdate BETWEEN '$FromDate' AND '$ToDate'   AND  b.referenceid LIKE ('$userid')  AND   bookingstatus ='Closed' and 
     bookingid  in ($SelectedBill)   ");
        }
      }
    }


    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {

      $data[] =  $row['TotalSale'];
      $data[] =  $row['Profit'];
      $data[] =  $AlreadyPaid;
      $data[] =  $row['SharePercent'];
      $data[] =  ($row['TotalSale']*1) * ($row['SharePercent']/100);

    }

    echo json_encode($data);


    mysqli_close($connection);
  }

  ?>