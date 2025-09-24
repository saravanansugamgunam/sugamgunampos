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
 $ConsultationType = mysqli_real_escape_string($connection, $_POST["ConsultationType"]); 
 $Location = mysqli_real_escape_string($connection, $_POST["Location"]); 
   
  if($Location=='All')
  {
	  $Location='%';
  }
  
   if($ConsultationType=='All')
  {
	  $ConsultationType='%';
  }
  
  
  $LocationCode = $_SESSION['SESS_LOCATION'];
  
 // $BillMode = mysqli_real_escape_string($connection, $_POST["BillMode"]); 
 
 
      
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
				

$query=mysqli_query($connection, " SELECT(
 SELECT ROUND(IFNULL(SUM(amount),0),2) FROM `salepaymentdetails`  AS a JOIN  paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode 
    WHERE transactiontype='DoctorFee' AND c.paymentmode='Cash' AND DATE BETWEEN '$ActualFromDate' AND '$ActualToDate' and transactionstatus='Cancelled' and a.invoiceno in (
	SELECT  a.consultationuniquebill   FROM `consultingbillmaster` AS a JOIN paitentmaster AS b ON a.paitentid = b.paitentid  
 JOIN usermaster as c ON a.doctorid = c.userid join 
 consultingdetails as d on a.consultationuniquebill = d.consultationuniquebill
 WHERE  a.billdate BETWEEN '$ActualFromDate' AND '$ActualToDate' AND cancelledstatus='1'
 and a.locationcode like('$Location')  and d.consultationid like('$ConsultationType')  ) ) AS Cash,
 
 (  SELECT ROUND(IFNULL(SUM(amount),0),2) FROM `salepaymentdetails`  AS a JOIN  paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode 
    WHERE transactiontype='DoctorFee' AND c.paymentmode='CARD' AND DATE BETWEEN '$ActualFromDate' AND '$ActualToDate'  and transactionstatus='Cancelled' and a.invoiceno in (
	SELECT  a.consultationuniquebill   FROM `consultingbillmaster` AS a JOIN paitentmaster AS b ON a.paitentid = b.paitentid  
 JOIN usermaster as c ON a.doctorid = c.userid join 
 consultingdetails as d on a.consultationuniquebill = d.consultationuniquebill
 WHERE  a.billdate BETWEEN '$ActualFromDate' AND '$ActualToDate' AND cancelledstatus='1'
 and a.locationcode like('$Location')  and d.consultationid like('$ConsultationType')  )
	
	  ) AS Card,
  
   (
 SELECT ROUND(IFNULL(SUM(amount),0),2) FROM `salepaymentdetails`  AS a JOIN  paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode 
    WHERE transactiontype='DoctorFee' AND c.paymentmode NOT IN ('Cash','CARD') AND DATE BETWEEN '$ActualFromDate' AND '$ActualToDate'  and transactionstatus='Cancelled' and a.invoiceno in (
	SELECT  a.consultationuniquebill   FROM `consultingbillmaster` AS a JOIN paitentmaster AS b ON a.paitentid = b.paitentid  
 JOIN usermaster as c ON a.doctorid = c.userid join 
 consultingdetails as d on a.consultationuniquebill = d.consultationuniquebill
 WHERE  a.billdate BETWEEN '$ActualFromDate' AND '$ActualToDate' AND cancelledstatus='1'
 and a.locationcode like('$Location')  and d.consultationid like('$ConsultationType')  ) ) AS Others,
  
     
     ( SELECT ROUND(IFNULL(SUM(amount),0),2) FROM `salepaymentdetails`  AS a JOIN  paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode 
    WHERE transactiontype='DoctorFee' AND   DATE BETWEEN '$ActualFromDate' AND '$ActualToDate'   and transactionstatus='Cancelled'   and a.invoiceno in (
	SELECT  a.consultationuniquebill   FROM `consultingbillmaster` AS a JOIN paitentmaster AS b ON a.paitentid = b.paitentid  
 JOIN usermaster as c ON a.doctorid = c.userid join 
 consultingdetails as d on a.consultationuniquebill = d.consultationuniquebill
 WHERE  a.billdate BETWEEN '$ActualFromDate' AND '$ActualToDate' AND cancelledstatus='1'
 and a.locationcode like('$Location')  and d.consultationid like('$ConsultationType')  )  ) AS Total
  "); 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = formatMoney($row['Cash'],false);
      $data[] = formatMoney($row['Card'],false);
      $data[] = formatMoney($row['Others'],false);
      $data[] = formatMoney($row['Total'],false);
     
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);
	 
}
else
{
	 echo " NO";
}

?>