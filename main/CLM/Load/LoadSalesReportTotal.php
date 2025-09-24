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
 $ConsultationGroup = mysqli_real_escape_string($connection, $_POST["ConsultationGroup"]); 
 $Doctor = mysqli_real_escape_string($connection, $_POST["Doctor"]); 
 $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]); 
   
  if($Location=='All')
  {
	  $Location='%';
  }
  
   if($ConsultationType=='All')
  {
	  $ConsultationType='%';
  }
  
  
  if($ConsultationGroup=='All')
  {
	  $ConsultationGroup='%';
  }
  
  if($Doctor=='All')
  {
	  $Doctor='%';
  }

  if($PaymentMode=='All')
  {
	  $PaymentMode='%';
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
    WHERE transactiontype  in('DoctorFee','Therapy Payment') AND c.paymentmode='Cash' and c.paymentmodecode like('$PaymentMode') AND DATE BETWEEN '$ActualFromDate' AND '$ActualToDate' and transactionstatus='Live' and a.invoiceno in (
	SELECT  a.consultationuniquebill   FROM `consultingbillmaster` AS a JOIN paitentmaster AS b ON a.paitentid = b.paitentid  
 JOIN usermaster AS c ON a.doctorid = c.userid join 
 consultingdetails as d on a.consultationuniquebill = d.consultationuniquebill
  join consultationmaster as e on d.consultationid=e.consultationid
 WHERE  a.billdate BETWEEN '$ActualFromDate' AND '$ActualToDate' AND cancelledstatus='0'
 and a.locationcode like('$Location')  and d.consultationid like('$ConsultationType') and  e.consultingtype like ('$ConsultationGroup') and a.doctorid like ('$Doctor') ) ) AS Cash,
 
 (  SELECT ROUND(IFNULL(SUM(amount),0),2) FROM `salepaymentdetails`  AS a JOIN  paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode 
    WHERE transactiontype  in('DoctorFee','Therapy Payment') AND c.paymentmode='CARD'   and c.paymentmodecode like('$PaymentMode') AND DATE BETWEEN '$ActualFromDate' AND '$ActualToDate'  and transactionstatus='Live' and a.invoiceno in (
	SELECT  a.consultationuniquebill   FROM `consultingbillmaster` AS a JOIN paitentmaster AS b ON a.paitentid = b.paitentid  
 JOIN usermaster AS c ON a.doctorid = c.userid join 
 consultingdetails as d on a.consultationuniquebill = d.consultationuniquebill
  join consultationmaster as e on d.consultationid=e.consultationid
 WHERE  a.billdate BETWEEN '$ActualFromDate' AND '$ActualToDate' AND cancelledstatus='0'
 and a.locationcode like('$Location')  and d.consultationid like('$ConsultationType') and  e.consultingtype like ('$ConsultationGroup') and a.doctorid like ('$Doctor') )
	
	  ) AS Card,
  
   (
 SELECT ROUND(IFNULL(SUM(amount),0),2) FROM `salepaymentdetails`  AS a JOIN  paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode 
    WHERE transactiontype  in('DoctorFee','Therapy Payment') AND c.paymentmode NOT IN ('Cash','CARD')  and c.paymentmodecode like('$PaymentMode') AND DATE BETWEEN '$ActualFromDate' AND '$ActualToDate'  and transactionstatus='Live' and a.invoiceno in (
	SELECT  a.consultationuniquebill   FROM `consultingbillmaster` AS a JOIN paitentmaster AS b ON a.paitentid = b.paitentid  
 JOIN usermaster AS c ON a.doctorid = c.userid join 
 consultingdetails as d on a.consultationuniquebill = d.consultationuniquebill
  join consultationmaster as e on d.consultationid=e.consultationid
 WHERE  a.billdate BETWEEN '$ActualFromDate' AND '$ActualToDate' AND cancelledstatus='0'
 and a.locationcode like('$Location')  and d.consultationid like('$ConsultationType') and  e.consultingtype like ('$ConsultationGroup') and a.doctorid like ('$Doctor') ) ) AS Others,
  
     
     ( SELECT ROUND(IFNULL(SUM(amount),0),2) FROM `salepaymentdetails`  AS a JOIN  paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode 
    WHERE transactiontype in('DoctorFee','Therapy Payment')  and c.paymentmodecode like('$PaymentMode') AND   DATE BETWEEN '$ActualFromDate' AND '$ActualToDate'   and transactionstatus='Live'   and a.invoiceno in (
	SELECT  a.consultationuniquebill   FROM `consultingbillmaster` AS a JOIN paitentmaster AS b ON a.paitentid = b.paitentid  
 JOIN usermaster AS c ON a.doctorid = c.userid join 
 consultingdetails as d on a.consultationuniquebill = d.consultationuniquebill
  join consultationmaster as e on d.consultationid=e.consultationid
 WHERE  a.billdate BETWEEN '$ActualFromDate' AND '$ActualToDate' AND cancelledstatus='0'
 and a.locationcode like('$Location')  and d.consultationid like('$ConsultationType') and  e.consultingtype like ('$ConsultationGroup') and a.doctorid like ('$Doctor') )  ) AS Total
  "); 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] =  formatMoney($row['Cash'],false);
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