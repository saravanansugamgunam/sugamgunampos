<?php
  
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
 $StudentCode = mysqli_real_escape_string($connection, $_POST["StudentCode"]);
 
$SqlQuery = "

SELECT a.batchcode, CONCAT(b.batchname,' [',a.studentfees - IFNULL(SUM(e.Paid),0),']') AS Batch,
 a.studentfees - IFNULL(SUM(e.Paid),0) AS BalanceFee  
 FROM studentbatchmapping AS a JOIN batchmaster AS b ON a.batchcode=b.batchcode 
 JOIN studentmaster AS d ON a.studentcode = d.studentcode LEFT JOIN
  ( SELECT batchcode,SUM(paymentamount) AS Paid FROM paymentdetails WHERE studentcode ='$StudentCode' 
 GROUP BY batchcode) AS e ON a.batchcode=e.batchcode WHERE a.studentcode ='$StudentCode' 
 GROUP BY a.batchcode  ";
 
 // echo $SqlQuery;
 
$result = mysqli_query($connection,$SqlQuery);

$Batch_Arr = array();

while( $row = mysqli_fetch_array($result) ){
    $BatchCode = $row['batchcode'];
    $Batch = $row['Batch']; 

    $Batch_Arr[] = array("batchcode" => $BatchCode, "Batch" => $Batch);
}
 
echo json_encode($Batch_Arr);