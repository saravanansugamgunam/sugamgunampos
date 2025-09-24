<?php
  
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 			
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
 
$result = mysqli_query($connection, "   SELECT a.coursename,c.batchname,b.studentname,b.studentmobileno,a.studentfees,SUM(d.paymentamount) AS Payment, 
 a.studentfees - SUM(d.paymentamount) AS Due
  FROM studentbatchmapping AS a JOIN studentmaster AS b ON a.studentcode=b.studentcode
 JOIN batchmaster AS c ON a.batchcode=c.batchcode
 JOIN paymentdetails AS d ON a.batchcode=d.batchcode AND b.studentcode=d.studentcode
  where  a.batchcode like ('$Batch') 
 GROUP BY a.coursename,c.batchname,b.studentname,b.studentmobileno,a.studentfees  
  ORDER BY 7 DESC 
 
  ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>                
		<th  width='%'> Course</a></th>    
		<th  width='%'> Batch   </th>     
		<th width='%'> Student</th>           
		<th width='%'> Mobile</th>           
		<th width='%'> Fee </th>        
		<th width='%'> Paid </th>    
		<th width='%'> Due</th>           
		 
		</tr> </thead> <tbody  >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td  >$SerialNo</td>
  <td > $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[4], false); echo "</td>   
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[5], false); echo "</td>   
   <td width='%'style='text-align:right;' >"; echo formatMoney($data[6], false); echo "</td>   
   
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
  

?> 