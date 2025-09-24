<?php
   include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["FromDate"]))
{	
  
 // echo "1";
 							  
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
 $BillMode = mysqli_real_escape_string($connection, $_POST["BillMode"]); 
 $Location = mysqli_real_escape_string($connection, $_POST["Location"]); 
 $DiscountStatus = mysqli_real_escape_string($connection, $_POST["DiscountStatus"]); 
  //$Location = $_SESSION['SESS_LOCATION'];
 
  if($BillMode=='All')
  {
	  $BillMode='%';
  }
  
  if($Location=='All')
  {
	  $Location='%';
  }
     
    
  if($DiscountStatus=='All')
  {
	  $DiscountStatus=' ';
  }
  else if($DiscountStatus=='Discount')
  {
	$DiscountStatus=' and discountamount > 0 ';
  }
 else if($DiscountStatus=='Regular')
 {
	$DiscountStatus=' and discountamount = 0 ';
 }


   // $Location = $_SESSION['SESS_LOCATION'];
  $FromDate = explode('/', $FromDate); 
$ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0];
 $ToDate = explode('/', $ToDate); 
$ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0];

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
SELECT SUM(Totalpaitent) as TotalPaitent,SUM(bills) as TotalBills,round(SUM(amount),0) AS Amount FROM (
  SELECT a.`saledate`, b.`referenceno`,COUNT(DISTINCT b.`paitentid`) AS Totalpaitent,CONCAT(b.paitentname,' - ',b.mobileno) AS Paitent ,
  COUNT(a.`saleid`) AS bills ,round(SUM(nettamount),0) AS Amount,'Inventory' AS transactiontype FROM 
  salemaster AS a JOIN paitentmaster AS b ON a.`paitientcode`=b.`paitentid` 
  where  saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'
  GROUP BY b.`referenceno`,CONCAT(b.paitentname,' - ',b.mobileno)  
  
  UNION
  
  SELECT a.billdate, b.`referenceno`,COUNT(DISTINCT b.`paitentid`),CONCAT(b.paitentname,' - ',b.mobileno) ,
  COUNT(a.`billid`) ,round(SUM(totalamount),0),'Consulting' AS transactiontype  FROM 
  consultingbillmaster AS a JOIN paitentmaster AS b ON a.`paitentid`=b.`paitentid`
  where  billdate BETWEEN '$ActualFromDate' AND '$ActualToDate'
  GROUP BY b.`referenceno`) AS a 
  WHERE transactiontype LIKE '$BillMode'  
   
  ");
	 
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = formatMoney($row['TotalPaitent'],false);
      $data[] = formatMoney($row['TotalBills'],false);
      $data[] = formatMoney($row['Amount'],false); 

      
     
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}
else
{
	 echo " NO";
}

?>