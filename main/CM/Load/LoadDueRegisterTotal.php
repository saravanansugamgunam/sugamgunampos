<?php
   include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["FromDate"]))
{	
  
 // echo "1";
 							  
 // $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 // $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $Batch = mysqli_real_escape_string($connection, $_POST["Batch"]); 
  
  // $FromDate = explode('/', $FromDate); 
// $ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0];
 // $ToDate = explode('/', $ToDate); 
// $ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0];

// $ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));


function formatMoney($number, $fractional=false) {
					if ($fractional) {
						$number = sprintf('%.2f', $number);
					}
					while (true) {
						$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
						if ($replaced != $number) {
							$number = $replaced;
						} else {
							break;
						}
					}
					return $number;
				}
				

$query=mysqli_query($connection, "  
  SELECT (SELECT  SUM(a.studentfees) AS ToPay 
  FROM studentbatchmapping AS a JOIN studentmaster AS b ON a.studentcode=b.studentcode
 JOIN batchmaster AS c ON a.batchcode=c.batchcode  where  a.batchcode like ('$Batch')) AS ToPay, 
 (SELECT SUM(d.paymentamount) AS Payment   
  FROM studentbatchmapping AS a JOIN studentmaster AS b ON a.studentcode=b.studentcode
 JOIN batchmaster AS c ON a.batchcode=c.batchcode
 JOIN paymentdetails AS d ON a.batchcode=d.batchcode AND b.studentcode=d.studentcode  where  a.batchcode like ('$Batch') ) AS Paid
   
  ");
	 
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = formatMoney($row['ToPay'],false);
      $data[] = formatMoney($row['Paid'],false);
      $data[] = formatMoney($row['ToPay'] - $row['Paid'],false); 
     
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}
else
{
	 echo " NO";
}

?>