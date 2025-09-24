<?php  
  include("../connect.php");
  session_cache_limiter(FALSE);
  session_start();
 //   $position=$_SESSION["SESS_LAST_NAME"]; 
	
	   $LocationCode = $_SESSION['SESS_LOCATION'];
   $LocationName = $_SESSION['SESS_LOCATIONNAME'];
   $GroupID = $_SESSION['SESS_GROUP_ID'];
  $EmployeeCode=$_GET['SID'];
?>

<style>
#customers {
    border-collapse: collapse;
    width: 100%;
    font-family: Arial, Helvetica, sans-serif;
}


#customers td,
#customers th,
#customers tr {
    border: 1px solid #ddd;
    padding: 8px;
}
</style>
 
<?php
$res = $connection->query("  
SELECT a.period,b.username,d.designation,DATE_FORMAT(b.doj,'%d-%m-%Y')  as doj ,c.paymentmode,a.amount,
b.salary,a.lop,a.advancepaid  FROM salarypaymentdetails  AS a 
JOIN usermaster AS b ON a.employeecode=b.userid
JOIN paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode
JOIN designationmaster AS d ON b.designationid=d.id
WHERE a.id  ='$EmployeeCode'"); 
	 
$Balance=0;
while($data = mysqli_fetch_row($res))
{

$Period=$data[0];
$EmployeeName=$data[1];
$Designation=$data[2]; 
$DOJ=$data[3];   
$PaymentMode=$data[4]; 
$SalaryPaid=$data[5];  
$Salary=$data[6];   
$LOP = $data[7]; 

$AdvancePaid=$data[8];

$LOPDays = 0;
$DaysWorked  = 26;


$TotalDedutions = number_format($LOP + $AdvancePaid, 0);  
$FixedBasicPay = number_format($Salary * (60/100), 0);  
$FixedHRA = number_format($Salary * (30/100), 0);
$FixedConvayance = number_format($Salary * (6/100), 0);
$FixedOtherConvayanre = number_format($Salary * (4/100), 0);

$PaidBasicPay = number_format($SalaryPaid * (60/100), 0);  
$PaidHRA = number_format($SalaryPaid * (30/100), 0);
$PaidConvayance = number_format($SalaryPaid * (6/100), 0);
$PaidOtherConvayanre = number_format($SalaryPaid * (4/100), 0);

}


function AmountInWords(float $amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $x < $count_length ) {
      $get_divider = ($x == 2) ? 10 : 100;
      $amount = floor($num % $get_divider);
      $num = floor($num / $get_divider);
      $x += $get_divider == 10 ? 1 : 2;
      if ($amount) {
       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
   else $string[] = null;
   }
   $implode_to_Rupees = implode('', array_reverse($string));
   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
   return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}
?>


<body onload="window.print()">
<div id='DivInvoice'>


<html><head><meta http-equiv=" Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="generator" content="Aspose.Words for .NET 21.10.0" />
<title></title>
<style type="text/css">
body {
    line-height: 108%;
    font-family: Calibri;
    font-size: 11pt
}

p {
    margin: 0pt 0pt 8pt
}

table {
    margin-top: 0pt;
    margin-bottom: 8pt
}
</style>
</head>

<body>
    <div>
        <table cellspacing="0" cellpadding="0"
            style="width:100%; margin-left:3.25pt; margin-bottom:0pt; border:0.75pt solid #bfbfbf; -aw-border:0.5pt single; border-collapse:collapse">
            <tr style="height:80.25pt">
                <td colspan="6" style="padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
<br>
                <center><img src="../assets/img/logo.png" alt="Girl in a jacket" width="300" ></center>
                    <p style="margin-bottom:0pt; text-align:center; font-size:11pt">  <span>        
                    AP 393,17TH STREET, THIRUVALLUVAR KUDIYIRIPPU,  </span><br /><span>I Block, Anna Nagar, Tamil Nadu 600040</span></p>
                </td>
            </tr>
            <tr style="height:16.5pt">
                <td colspan="6" style="padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-align:center; font-size:11pt"><span
                            style="font-weight:bold">Salary Slip for the month of <?php echo $Period; ?></span></p>
                </td>
            </tr>
            <tr style="height:13.5pt">
                <td
                    style="width:16.08%; border-top:0.75pt solid #bfbfbf; padding-right:5.4pt; padding-left:5.03pt; vertical-align:middle; -aw-border-top:0.5pt single">
                    <p style="margin-bottom:0pt; font-size:11pt"><span>Name</span></p>
                </td>
                <td colspan="2"
                    style="border-top:0.75pt solid #bfbfbf; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle; -aw-border-top:0.5pt single">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span
                            style="font-weight:bold"><?php echo $EmployeeName; ?></span></p>
                </td>
                <td
                    style="width:18.58%; border-top:0.75pt solid #bfbfbf; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle; -aw-border-top:0.5pt single">
                    <p style="margin-bottom:0pt; font-size:11pt"><span>No of days worked</span></p>
                </td>
                <td colspan="2"
                    style="border-top:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.4pt; vertical-align:middle; -aw-border-top:0.5pt single">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span
                            style="font-weight:bold"><?php echo $DaysWorked; ?></span></p>
                </td>
            </tr>
            <tr style="height:13.5pt">
                <td style="width:16.08%; padding-right:5.4pt; padding-left:5.03pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; font-size:11pt"><span>Designation</span></p>
                </td>
                <td colspan="2" style="padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span
                            style="font-weight:bold"><?php echo $Designation; ?></span></p>
                </td>
                <td style="width:18.58%; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; font-size:11pt"><span>LOP</span></p>
                </td>
                <td style="width:19.24%; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span
                            style="font-weight:bold"><?php echo $LOPDays; ?></span></p>
                </td>
                <td style="width:18.4%; padding-right:5.03pt; padding-left:5.4pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; font-size:11pt"><span>&#xa0;</span></p>
                </td>
            </tr>
            <tr style="height:13.5pt">
                <td style="width:16.08%; padding-right:5.4pt; padding-left:5.03pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; font-size:11pt"><span>Date Of Joining</span></p>
                </td>
                <td style="width:15.76%; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span
                            style="font-weight:bold"><?php echo $DOJ; ?></span></p>
                </td>
                <td style="width:11.94%; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span
                            style="font-weight:bold; -aw-import:ignore">&#xa0;</span></p>
                </td>
                <td style="width:18.58%; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; font-size:11pt"><span>Payment mode</span></p>
                </td>
                <td style="width:19.24%; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span
                            style="font-weight:bold"><?php echo $PaymentMode; ?></span></p>
                </td>
                <td style="width:18.4%; padding-right:5.03pt; padding-left:5.4pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; font-size:11pt"><span>&#xa0;</span></p>
                </td>
            </tr> 
            <tr style="height:15.75pt">
                <td
                    style="width:16.08%; border-bottom:0.75pt solid #bfbfbf; padding-right:5.4pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single">
                    <p style="margin-bottom:0pt; font-size:11pt"> </p>
                </td>
                <td
                    style="width:15.76%; border-bottom:0.75pt solid #bfbfbf; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle; -aw-border-bottom:0.5pt single">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span></span></p>
                </td>
                <td
                    style="width:11.94%; border-bottom:0.75pt solid #bfbfbf; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle; -aw-border-bottom:0.5pt single">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span>&#xa0;</span></p>
                </td>
                <td
                    style="width:18.58%; border-bottom:0.75pt solid #bfbfbf; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top; -aw-border-bottom:0.5pt single">
                    <p style="margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:'Times New Roman'"> </span></p>
                </td>
                <td
                    style="width:19.24%; border-bottom:0.75pt solid #bfbfbf; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top; -aw-border-bottom:0.5pt single">
                    <p style="margin-bottom:0pt; font-size:11pt"><span
                            style="font-family:'Times New Roman'"> </span></p>
                </td>
                <td
                    style="width:18.4%; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.4pt; vertical-align:middle; -aw-border-bottom:0.5pt single">
                    <p style="margin-bottom:0pt; font-size:11pt"><span> </span></p>
                </td>
            </tr>
            <tr style="height:28.35pt">
                <td colspan="2"
                    style="border-top:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.4pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-top:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:center; font-size:11pt"><span
                            style="font-weight:bold">Particulars</span></p>
                </td>
                <td
                    style="width:11.94%; border-right:0.75pt solid #bfbfbf; border-left:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:center;  font-size:11pt">
                    <span style="font-weight:bold">Fixed</span></p>
                </td>
                <td
                    style="width:18.58%; border-bottom:0.75pt solid #bfbfbf; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle; -aw-border-bottom:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:center; font-size:11pt"><span
                            style="font-weight:bold">Amount</span><br /><span>(in Rs)</span></p>
                </td>
                <td
                    style="width:19.24%; border-right:0.75pt solid #bfbfbf; border-left:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:center;  font-size:11pt" ><span style="font-weight:bold">Deductions</span></p>
                </td>
                <td
                    style="width:18.4%; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.4pt; vertical-align:middle; -aw-border-bottom:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:center; font-size:11pt"><span
                            style="font-weight:bold">Amount</span><br /><span>(in Rs)</span></p>
                </td>
            </tr>
            <tr style="height:16.5pt">
                <td style="width:16.08%; padding-right:5.4pt; padding-left:5.03pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span>Basic Pay</span></p>
                </td>
                <td style="width:15.76%; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span
                            style="-aw-import:ignore">&#xa0;</span></p>
                </td>
                <td
                    style="width:11.94%; border-right:0.75pt solid #bfbfbf; border-left:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:right; font-size:11pt"><span
                            style="-aw-import:spaces">&#xa0;</span><span><?php echo $FixedBasicPay; ?> </span></p>
                </td>
                <td
                    style="width:18.58%; border-right:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.4pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:right; font-size:11pt"><span
                            style="-aw-import:spaces">&#xa0;</span><span><?php echo $PaidBasicPay; ?> </span></p>
                </td>
                <td rowspan=""
                    style="width:19.24%; border-right:0.75pt solid #bfbfbf; border-left:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span>LOP</span></p>
                </td>
                
                <td rowspan=""
                    style="width:18.4%; border-left:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border-left:0.5pt single">
                    <p style="margin-bottom:0pt;  text-align:right; font-size:11pt"><span
                            style="-aw-import:spaces">&#xa0;</span><span><?php echo $LOP; ?></span><span
                            style="-aw-import:spaces">&#xa0;&#xa0; </span></p>
                </td>
            </tr>

            <tr style="height:16.5pt">
                <td style="width:16.08%; padding-right:5.4pt; padding-left:5.03pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span>HRA</span></p>
                </td>
                <td style="width:15.76%; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span
                            style="-aw-import:ignore">&#xa0;</span></p>
                </td>
                <td
                    style="width:11.94%; border-right:0.75pt solid #bfbfbf; border-left:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:right; font-size:11pt"><span
                            style="-aw-import:spaces">&#xa0;</span><span><?php echo $FixedHRA; ?> </span></p>
                </td>
                <td
                    style="width:18.58%; border-right:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.4pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:right; font-size:11pt"><span
                            style="-aw-import:spaces">&#xa0;</span><span><?php echo $PaidHRA; ?> </span></p>
                </td>
                <td rowspan="3"
                    style="width:19.24%; border-right:0.75pt solid #bfbfbf; border-left:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span>Advance</span></p>
                </td>
                
                <td rowspan="3"
                    style="width:18.4%; border-left:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; -aw-border-left:0.5pt single">
                    <p style="margin-bottom:0pt;  text-align:right; font-size:11pt"><span
                            style="-aw-import:spaces">&#xa0;</span><span><?php echo $AdvancePaid; ?></span><span
                            style="-aw-import:spaces">&#xa0;&#xa0; </span></p>
                </td>
            </tr>
            <tr style="height:16.5pt">
                <td style="width:16.08%; padding-right:5.4pt; padding-left:5.03pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span>Conveyance</span></p>
                </td>
                <td style="width:15.76%; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span
                            style="-aw-import:ignore">&#xa0;</span></p>
                </td>
                <td
                    style="width:11.94%; border-right:0.75pt solid #bfbfbf; border-left:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:right; font-size:11pt"><span
                            style="-aw-import:spaces">&#xa0;</span><span><?php echo $FixedConvayance; ?> </span></p>
                </td>
                <td
                    style="width:18.58%; border-right:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.4pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:right; font-size:11pt"><span
                            style="-aw-import:spaces">&#xa0;</span><span><?php echo $PaidConvayance; ?> </span></p>
                </td>
            </tr>
            <tr style="height:16.5pt">
                <td style="width:16.08%; padding-right:5.4pt; padding-left:5.03pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span>Others</span></p>
                </td>
                <td style="width:15.76%; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-indent:11pt; font-size:11pt"><span
                            style="-aw-import:ignore">&#xa0;</span></p>
                </td>
                <td
                    style="width:11.94%; border-right:0.75pt solid #bfbfbf; border-left:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:right; font-size:11pt"><span
                            style="-aw-import:spaces">&#xa0;</span><span><?php echo $FixedOtherConvayanre; ?> </span></p>
                </td>
                <td
                    style="width:18.58%; border-right:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.4pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:right; font-size:11pt"><span
                            style="-aw-import:spaces">&#xa0;</span><span><?php echo $PaidOtherConvayanre; ?> </span></p>
                </td>
            </tr>
            <tr style="height:14.25pt">
                <td colspan="2" rowspan="2"
                    style="border-top:0.75pt solid #bfbfbf; border-right:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:center; font-size:11pt"><span style="font-weight:bold">Gross
                            Salary</span></p>
                </td>
                <td rowspan="2"
                    style="width:11.94%; border-right:0.75pt solid #bfbfbf; border-left:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:right; font-size:11pt"><span
                            style="font-weight:bold; -aw-import:spaces">&#xa0;</span><span
                            style="font-weight:bold"><?php echo number_format($Salary,0); ?> </span></p>
                </td>
                <td rowspan="2"
                    style="width:18.58%; border-right:0.75pt solid #bfbfbf; border-left:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:right; font-size:11pt"><span
                            style="font-weight:bold; -aw-import:spaces">&#xa0;</span><span
                            style="font-weight:bold"><?php echo number_format($SalaryPaid,0); ?></span></p>
                </td>
                <td
                    style="width:19.24%; border-top:0.75pt solid #bfbfbf; border-right:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.4pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:center; font-size:11pt"><span>Total Deduction</span></p>
                </td>
                <td
                    style="width:18.4%; border-top:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.4pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-top:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:right; font-size:11pt"><span
                            style="-aw-import:spaces">&#xa0;</span><span><?php echo $TotalDedutions; ?></span><span
                            style="-aw-import:spaces">&#xa0;&#xa0; </span></p>
                </td>
            </tr>
            <tr style="height:18.6pt">
                <td style="width:19.24%; padding-right:5.4pt; padding-left:5.4pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-align:center; font-size:11pt"><span style="font-weight:bold">Net
                            pay</span></p>
                </td>
                <td
                    style="width:18.4%; border-left:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:right; font-size:11pt"><span
                            style="font-weight:bold; -aw-import:spaces">&#xa0;</span><span
                            style="font-weight:bold"><?php echo number_format($SalaryPaid,0); ?><span
                            style="-aw-import:spaces">&#xa0;&#xa0; </span></p>
                </td>
            </tr>
            <tr style="height:22.35pt" hidden>
                <td colspan="6"
                    style="border-top:0.75pt solid #bfbfbf; border-bottom:0.75pt solid #bfbfbf; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-top:0.5pt single">
                    <p style="margin-bottom:0pt; text-align:center; font-size:11pt"><span>
                    <?php echo AmountInWords($SalaryPaid); ?>
                            Only</span></p>
                </td>
            </tr>
            <tr style="height:25.35pt">
                <td colspan="6" style="padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
                    <p style="margin-bottom:0pt; text-align:center; font-size:11pt"><span>This is computer generated
                            statement signature of employer is not required</span></p>
                </td>
            </tr>
        </table>
        <p style="text-indent:40.5pt"><span style="-aw-import:ignore">&#xa0;</span></p>
    </div>
</body>

</html>
</body>