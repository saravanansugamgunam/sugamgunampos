<?php
include("../../../connect.php");
$currentdate = date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();

//insert.php
if (isset($_POST["Type"])) {

  // echo "1"; 
  $Type = mysqli_real_escape_string($connection, $_POST["Type"]);
  $LocationCode = $_SESSION['SESS_LOCATION'];

  $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
  $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
  $Location = mysqli_real_escape_string($connection, $_POST["Location"]);
  $PaymentMode = mysqli_real_escape_string($connection, $_POST["PaymentMode"]);
  $SelectedPaymentType = mysqli_real_escape_string($connection, $_POST["SelectedPaymentType"]);
  // $PaymentMode = 'yNo';

  if ($FromDate == "") {
    $ActualFromDate = date('Y-m-d 00:00:00');
    $ActualToDate = date('Y-m-d 23:59:59');
  } else {
    $FromDate = explode('/', $FromDate);
    $ActualFromDate = $FromDate[2] . '-' . $FromDate[1] . '-' . $FromDate[0] . ' 00:00:00';
    $ToDate = explode('/', $ToDate);
    $ActualToDate = $ToDate[2] . '-' . $ToDate[1] . '-' . $ToDate[0] . ' 23:59:59';

    // $ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));
  }


  if ($Location == '-') {
    $Location = '%';
  }




  function formatMoney($number, $fractional = false)
  {
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

  if ($PaymentMode == 'No') {
    $result = mysqli_query($connection, " 

   SELECT t.transactiontype,
   t.Income,t.Expense,
       
       @running_total:=@running_total + t.Income - t.Expense AS cumulative_sum
FROM
(SELECT a.transactiontype, 
SUM(Income) AS Income, SUM(Expenses) AS Expense, 
SUM(Income) - SUM(Expenses) AS Balance
FROM

(SELECT 
UPPER(a.transactiontype) AS transactiontype,
IFNULL(ROUND(SUM(amount),0),0) AS Income,0.00 AS Expenses  FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.paymentmode=b.paymentmodecode
WHERE  a.date BETWEEN '$ActualFromDate' AND '$ActualToDate'  and a.clientid like ('$Location') and
 transactiontype in ('CashAdvance','IncomeEntry','OutstandingCollection','PaitentOrder' ) and transactionstatus='Live' 
 and b.paymentmodecode like ('$SelectedPaymentType') and transactiongroup ='Inventory'  
 GROUP BY a.transactiontype
 
 UNION 

 SELECT 
UPPER(a.transactiontype) AS transactiontype,
IFNULL(ROUND(SUM(amount),0),0) AS Income,0.00 AS Expenses  FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.paymentmode=b.paymentmodecode
WHERE  a.date BETWEEN '$ActualFromDate' AND '$ActualToDate'  and a.clientid like ('$Location') and
 transactiontype in ('Sales') and transactionstatus='Live' 
 and b.paymentmodecode like ('$SelectedPaymentType') and transactiongroup ='Inventory' and 
 completionstatus ='1'
 GROUP BY a.transactiontype
 
 UNION 
 
 
SELECT 
UPPER(a.transactiontype) AS transactiontype,
0.00 AS Income, IFNULL(ROUND(SUM(amount),0),0)  FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.paymentmode=b.paymentmodecode
WHERE  a.date BETWEEN  '$ActualFromDate' AND '$ActualToDate'  AND a.transactiontype not in 
('SalesReturn')  and a.clientid like ('$Location') and transactiontype in
 ('ExpenseEntry','SupplierOrder','RefundToCustomer') and transactionstatus='Live' 
 and b.paymentmodecode like ('$SelectedPaymentType') and transactiongroup ='Inventory' 
 
 GROUP BY a.transactiontype
 
 
 UNION 
 
 
SELECT 
UPPER(a.transactiontype) AS transactiontype,
0.00 AS Income, IFNULL(ROUND(SUM(amount),0),0)   FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.paymentmode=b.paymentmodecode
WHERE  a.date BETWEEN  '$ActualFromDate' AND '$ActualToDate' and a.clientid like ('$Location') 
and transactiontype in ('Supplier Payment','Doctor Share')  and transactionstatus='Live' 
 and b.paymentmodecode like ('$SelectedPaymentType') and transactiongroup ='Inventory'
 
 GROUP BY a.transactiontype  
 
 union

 SELECT 
UPPER(a.`transactiontype`) AS transactiontype,
IFNULL(ROUND(SUM(amount),0),0) AS Income,0.00 AS Expenses FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.`paymentmode`=b.`paymentmodecode`
WHERE  a.`date` BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.clientid like ('$Location')  AND transactionstatus ='Live' 
 and transactiongroup ='Clinic' and transactiontype in ('Therapy Payment','DoctorFee')
  and transactionstatus='Live' 
 and b.paymentmodecode like ('$SelectedPaymentType') and 
 completionstatus ='1'
 GROUP BY a.`transactiontype`
 
 UNION 

 
 SELECT 
UPPER(a.`transactiontype`) AS transactiontype,
IFNULL(ROUND(SUM(amount),0),0) AS Income,0.00 AS Expenses FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.`paymentmode`=b.`paymentmodecode`
WHERE  a.`date` BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.clientid like ('$Location')  AND transactionstatus ='Live' 
 and transactiongroup ='Clinic' and transactiontype in ('Therapy Payment','DoctorFee')
  and transactionstatus='Live' 
 and b.paymentmodecode like ('$SelectedPaymentType') 
 
 GROUP BY a.`transactiontype`
 
 UNION 
 
 
SELECT 
UPPER(a.`transactiontype`) AS transactiontype,
0.00 AS Income, IFNULL(ROUND(SUM(amount),0),0)  FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.`paymentmode`=b.`paymentmodecode`
WHERE  a.`date` BETWEEN  '$ActualFromDate' AND '$ActualToDate'  and a.clientid like ('$Location')   
  and transactiongroup ='Clinic' and  transactiontype in ('ExpenseEntry','Salary','Supplier Payment','Therapy Share') and transactionstatus='Live' 
 and b.paymentmodecode like ('$SelectedPaymentType')  
 GROUP BY a.`transactiontype`  

 ) AS a
 GROUP BY a.transactiontype 
 ) t
 
JOIN (SELECT @running_total:=0) r
group by t.transactiontype 
ORDER BY t.transactiontype,t.Income,t.Expense 
 
 
 ");
  } else {


    $result = mysqli_query($connection, " 

   SELECT t.transactiontype,
     t.paymentmode,
   sum(t.Income),sum(t.Expense),
       
       @running_total:=@running_total + t.Income - t.Expense AS cumulative_sum
FROM
(SELECT a.transactiontype,a.paymentmode, 
SUM(Income) AS Income, SUM(Expenses) AS Expense, 
SUM(Income) - SUM(Expenses) AS Balance
FROM

(SELECT 
UPPER(a.transactiontype) AS transactiontype,
IFNULL(ROUND(SUM(amount),0),0) AS Income,0.00 AS Expenses,b.paymentmode FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.paymentmode=b.paymentmodecode
WHERE  a.date BETWEEN '$ActualFromDate' AND '$ActualToDate' AND a.transactiontype not in ('SalesReturn') 
and a.clientid like ('$Location') and transactiontype in ('CashAdvance','IncomeEntry','OutstandingCollection','PaitentOrder') 
 and b.paymentmodecode like ('$SelectedPaymentType') and transactiongroup ='Inventory' 
  
 GROUP BY a.transactiontype,b.paymentmode

 union

 SELECT 
UPPER(a.transactiontype) AS transactiontype,
IFNULL(ROUND(SUM(amount),0),0) AS Income,0.00 AS Expenses,b.paymentmode FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.paymentmode=b.paymentmodecode
WHERE  a.date BETWEEN '$ActualFromDate' AND '$ActualToDate' AND a.transactiontype not in ('SalesReturn') 
and a.clientid like ('$Location') and transactiontype in ('Sales') 
 and b.paymentmodecode like ('$SelectedPaymentType') and transactiongroup ='Inventory' and 
 completionstatus ='1'
 GROUP BY a.transactiontype,b.paymentmode
 
 UNION 
 
 
SELECT 
UPPER(a.transactiontype) AS transactiontype,
0.00 AS Income, IFNULL(ROUND(SUM(amount),0),0),b.paymentmode  FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.paymentmode=b.paymentmodecode
WHERE  a.date BETWEEN  '$ActualFromDate' AND '$ActualToDate'  AND a.transactiontype not in ('SalesReturn')  
and a.clientid like ('$Location') and transactiontype in ('ExpenseEntry','SupplierOrder','RefundToCustomer') 
 and b.paymentmodecode like ('$SelectedPaymentType')  and transactiongroup ='Inventory'  
 GROUP BY a.transactiontype,b.paymentmode
 
 
 UNION 
 
 
SELECT 
UPPER(a.transactiontype) AS transactiontype,
0.00 AS Income, IFNULL(ROUND(SUM(amount),0),0),b.paymentmode  FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.paymentmode=b.paymentmodecode
WHERE  a.date BETWEEN  '$ActualFromDate' AND '$ActualToDate' and a.clientid like ('$Location') and 
transactiontype in ('Supplier Payment','Doctor Share')  and b.paymentmodecode like ('$SelectedPaymentType')
 and transactiongroup ='Inventory' 
 GROUP BY a.transactiontype ,b.paymentmode   
 
 union

 SELECT 
 UPPER(a.`transactiontype`) AS transactiontype,
 IFNULL(ROUND(SUM(amount),0),0) AS Income,0.00 AS Expenses,b.paymentmode   FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
 ON a.`paymentmode`=b.`paymentmodecode`
 WHERE  a.`date` BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.clientid like ('$Location')  AND transactionstatus ='Live' 
  and transactiongroup ='Clinic' and transactiontype in ('Therapy Payment', 'DoctorFee') and transactionstatus='Live' 
  and b.paymentmodecode like ('$SelectedPaymentType') and 
  completionstatus ='1'
  GROUP BY a.`transactiontype`,b.paymentmode  


  union

  SELECT 
  UPPER(a.`transactiontype`) AS transactiontype,
  IFNULL(ROUND(SUM(amount),0),0) AS Income,0.00 AS Expenses,b.paymentmode   FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
  ON a.`paymentmode`=b.`paymentmodecode`
  WHERE  a.`date` BETWEEN '$ActualFromDate' AND '$ActualToDate' and a.clientid like ('$Location')  AND transactionstatus ='Live' 
   and transactiongroup ='Clinic' and transactiontype in ( 'IncomeEntry' ) and transactionstatus='Live' 
   and b.paymentmodecode like ('$SelectedPaymentType')  
   GROUP BY a.`transactiontype`,b.paymentmode  

  UNION 
 
 
  SELECT 
  UPPER(a.`transactiontype`) AS transactiontype,
  0.00 AS Income, IFNULL(ROUND(SUM(amount),0),0) ,b.paymentmode  FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
  ON a.`paymentmode`=b.`paymentmodecode`
  WHERE  a.`date` BETWEEN  '$ActualFromDate' AND '$ActualToDate'  and a.clientid like ('$Location')   
	and transactiongroup ='Clinic' and  transactiontype in ('ExpenseEntry','Salary','Supplier Payment','Therapy Share') and transactionstatus='Live' 
   and b.paymentmodecode like ('$SelectedPaymentType') 
   GROUP BY a.`transactiontype`  ,b.paymentmode 


  ) AS a
 GROUP BY a.transactiontype ,a.paymentmode 
 ) t
 
JOIN (SELECT @running_total:=0) r
group by t.transactiontype
  ,t.paymentmode
ORDER BY t.transactiontype,t.Income,t.Expense 
 
 
 ");
  }



  //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered' style='width:95%'>";
  echo " <thead><tr>  
		<th>S.No</th>          
		    
		<th  width='%'> Transaction</a></th> ";
  if ($PaymentMode == 'No') {
  } else {
    echo "<th  width='%'> Mode</a></th>";
  }

  echo "<th width='%'> Income</th>           
		<th width='%'> Expenses</th>           
		<th width='%'> Balance</th>           
		 
		</tr> </thead> <tbody  id='tblBalanceSheet'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td width='5%'  >";
    echo substr($data[0], 0, 15);
    echo "</td> ";
    if ($PaymentMode == 'No') {
      echo "
   <td width='%' style='text-align:right;' >";
      echo formatMoney($data[1], false);
      echo "</td>   
   <td width='%' style='text-align:right;' >";
      echo formatMoney($data[2], false);
      echo "</td>   
   <td width='%' style='text-align:right;' >";
      echo formatMoney($data[3], false);
      echo "</td>  ";
    } else {
      echo "
   <td width='%'  >";
      echo formatMoney($data[1], false);
      echo "</td>   
   <td width='%' style='text-align:right;' >";
      echo formatMoney($data[2], false);
      echo "</td>   
   <td width='%' style='text-align:right;' >";
      echo formatMoney($data[3], false);
      echo "</td>   
  <td width='%' style='text-align:right;' >";
      echo formatMoney($data[4], false);
      echo "</td> ";
    }


    echo " </tr>";


    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody></table>";
} else {
  echo " NO";
}