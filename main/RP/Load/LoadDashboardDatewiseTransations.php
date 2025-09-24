<?php
   include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Type"]))
{	
  
 // echo "1"; 
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
   $LocationCode = $_SESSION['SESS_LOCATION'];
   						  
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 

if($FromDate=="")
{
	$ActualFromDate= date('Y-m-d 00:00:00');
	$ActualToDate= date('Y-m-d 23:59:59');
	
}
else
{
$FromDate = explode('/', $FromDate); 
$ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0].' 00:00:00';
$ToDate = explode('/', $ToDate); 
$ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0].' 23:59:59' ;

// $ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));
}



  

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
				 
	
 
$result = mysqli_query($connection, " 

 
SELECT 
DATE_FORMAT(a.date ,'%d-%m-%y') AS Date,
IFNULL(ROUND(SUM(amount),0),0) AS Amount FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.`paymentmode`=b.`paymentmodecode`
WHERE  a.`date` BETWEEN '$ActualFromDate' AND '$ActualToDate'
 GROUP BY  DATE_FORMAT(a.date ,'%d-%m-%y')
 
 ");
 
 
  
	  
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered' style='width:300px'>";
echo " <thead><tr>  
		<th>S.No</th>          
		    
		<th  width='%'> Date</a></th>     
		<th width='%'> Amount</th>           
		 
		</tr> </thead> <tbody  id='tblCashCardSummmary'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td> $data[0]</td>  
   <td width='%' style='text-align:right;' >"; echo formatMoney($data[1], false); echo "</td>   
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";

  
}
else
{
	 echo " NO";
}

?>