<script src="../assets/Custom/IndexTable.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


<script>
// function myFunction() {
// var input, filter, table, tr, td, i, txtValue;
// input = document.getElementById("txtItemSearch");
// filter = input.value.toLowerCase();
// $("#tblItemwise tr").filter(function() {
// $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
// });
// alert(1);
// }

// $(document).ready(function(){
// $("#txtItemSearch").on("keyup", function() {
// var value = $(this).val().toLowerCase();
// alert(2);
// $("#tblItemwise tr").filter(function() {
// $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
// });
// });
</script>

<?php

session_cache_limiter(FALSE);
session_start();


function removeslashes($string)
{
    $string=implode("",explode("\\",$string));
    return stripslashes(trim($string));
}


// echo "1";
include("../../../connect.php");
$currentdate = date("Y-m-d");
$FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
$ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
$Type = mysqli_real_escape_string($connection, $_POST["Type"]);
$SelectedReportType = mysqli_real_escape_string($connection, $_POST["SelectedReportType"]);
$BillMode = mysqli_real_escape_string($connection, $_POST["BillMode"]);
$DiscountStatus = mysqli_real_escape_string($connection, $_POST["DiscountStatus"]);

$SelectedReportType = removeslashes(mysqli_real_escape_string($connection, $_POST["SelectedReportType"])); 


//$Location = $_SESSION['SESS_LOCATION'];



if($SelectedReportType =="''")
{
	$SelectedReportType='N';
}
if(strpos($SelectedReportType, '0') !== false){
   
    $QueryPart0 = " ,referenceno  ";
    
 } else
 {
     $QueryPart0 ="";
 }
  if(strpos($SelectedReportType, '1') !== false){
    
    $QueryPart1 = " ,saledate ";
    
 } else
 {
     $QueryPart1 ="";
 }
  if(strpos($SelectedReportType, '2') !== false){
    
    $QueryPart2 = " ,transactiontype ";
    
 } else
 {
     $QueryPart2 ="";
 }
  if(strpos($SelectedReportType, '3') !== false){
    
    $QueryPart3 = " ,Paitent ";
    
 } else
 {
     $QueryPart3 ="";
 }
 if($SelectedReportType=='N')
 { 
    $QueryPart0 = " ,referenceno  ";
 }
 

 $Query  = $QueryPart0;
 $Query .= $QueryPart1;
 $Query .= $QueryPart2;
 $Query .= $QueryPart3;

 
$FromDate = explode('/', $FromDate);
$ActualFromDate = $FromDate[2] . '-' . $FromDate[1] . '-' . $FromDate[0];
$ToDate = explode('/', $ToDate);
$ActualToDate = $ToDate[2] . '-' . $ToDate[1] . '-' . $ToDate[0];

// $ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));

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
  

    $result = mysqli_query($connection, " 

    SELECT 1 $Query, SUM(Totalpaitent),SUM(bills),SUM(amount) AS Amount FROM (
        SELECT a.`saledate`, b.`referenceno`,COUNT(DISTINCT b.`paitentid`) AS Totalpaitent,CONCAT(b.paitentname,' - ',b.mobileno) AS Paitent ,
        COUNT(a.`saleid`) AS bills ,SUM(nettamount) AS Amount,'Inventory' AS transactiontype FROM 
        salemaster AS a JOIN paitentmaster AS b ON a.`paitientcode`=b.`paitentid` 
        where  saledate BETWEEN '$ActualFromDate' AND '$ActualToDate'
        GROUP BY b.`referenceno`,CONCAT(b.paitentname,' - ',b.mobileno)  
        
        UNION
        
        SELECT a.billdate, b.`referenceno`,COUNT(DISTINCT b.`paitentid`),CONCAT(b.paitentname,' - ',b.mobileno) ,
        COUNT(a.`billid`) ,SUM(totalamount),'Consulting' AS transactiontype  FROM 
        consultingbillmaster AS a JOIN paitentmaster AS b ON a.`paitentid`=b.`paitentid`
        where  billdate BETWEEN '$ActualFromDate' AND '$ActualToDate'
        GROUP BY b.`referenceno`) AS a 
        WHERE transactiontype LIKE '$BillMode'
        GROUP BY 1 $Query
    
    
 
 "); 

 $DataCount=0; 
 
    echo "  <table id='tblItemwise' class='table table-st`riped table-bordered'>";
    echo " <thead><tr>  
		<th>S.No</th>";

        if($SelectedReportType =='N')
	
        {
            echo "<th>Reference</th>";
                $DataCount=$DataCount+1;
        }

        if(strpos($SelectedReportType, '0') !== false) 
	{
      
            echo "<th>Reference</th>";
                $DataCount=$DataCount+1;
        }
 
           
        if(strpos($SelectedReportType, '1') !== false){
	
        
            echo "<th>Date</th>";
                $DataCount=$DataCount+1;
        }
        if(strpos($SelectedReportType, '2') !== false){
	
         
            echo "<th>Type</th>";
                $DataCount=$DataCount+1;
        }
        if(strpos($SelectedReportType, '3') !== false){
	 
            echo "<th>Paitent</th>";
                $DataCount=$DataCount+1;
        }



        echo "
        <th>Total Paitent</th>
        <th>Total Bills</th> 
        <th>Total Amount</th> ";

		 
	echo "</tr> </thead> <tbody id='tblSalesDetail' >";
    $DataCount=$DataCount+3;
    $SerialNo = 1;
    while ($data = mysqli_fetch_row($result)) {
        echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden >$data[0]</td>  "; 
  	 
	for ($x = 1; $x <= $DataCount; $x++) {
		echo "<td>$data[$x]</td>";
	} 
     
echo "</tr>";
 
    $SerialNo = $SerialNo + 1;
    }
    echo "</tbody>
    </table>";
    
 

            ?>