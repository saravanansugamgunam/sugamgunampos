<?php
   include("../../../connect.php"); 
session_cache_limiter(FALSE);
session_start();
  
  
  
 // echo "1";

  $LocationCode = $_SESSION['SESS_LOCATION'];
  $currentdate =date("Y-m-d"); 			
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);   
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]);   
  
  $FromDate = explode('/', $FromDate); 
$ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0];
 $ToDate = explode('/', $ToDate); 
$ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0];

$ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));

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
				
 if ($Type=='Detail')
 {
 
$result = mysqli_query($connection, "  
 SELECT DATE_FORMAT(entrydate,'%d-%m-%Y') AS DATE,patienttype,sum(COUNT) as TotalPatient,sum(total) as TotalFes
 FROM patiententrydetails AS a 
JOIN  patienttypemaster AS b ON a.typeid=b.typeid
  WHERE entrydate BETWEEN '$ActualFromDate' AND '$ActualToDate' AND a.clientid ='$LocationCode'
  group by DATE_FORMAT(entrydate,'%d-%m-%Y') ,patienttype
");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>      
		<th width='%'> Date </th>    
		<th width='%'> Patient Type</th>    
		<th width='%'> Total Patient  </th>    
		<th width='%'> Total Fees  </th>    		 
		</tr> </thead> <tbody  >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td>$SerialNo</td>
  <td > $data[0]</td>
  <td >$data[1]</td>    
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[2], false); echo "</td> 
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[3], false); echo "</td> 
  
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
 }
 else
	 
	 {
		 
$result = mysqli_query($connection, "  
 SELECT DATE_FORMAT(entrydate,'%d-%m-%Y') AS DATE,sum(COUNT) as TotalPatient,sum(total) as TotalFes
 FROM patiententrydetails AS a 
JOIN  patienttypemaster AS b ON a.typeid=b.typeid
  WHERE entrydate BETWEEN '$ActualFromDate' AND '$ActualToDate' AND a.clientid ='$LocationCode'
  group by DATE_FORMAT(entrydate,'%d-%m-%Y') 
  
 ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>      
		<th width='%'> Date </th>     
		<th width='%'> Total Patient  </th>    
		<th width='%'> Total Fees  </th>    		 
		</tr> </thead> <tbody  >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
   echo "
  <tr>
  <td>$SerialNo</td>
  <td > $data[0]</td>   
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[1], false); echo "</td> 
   <td width='%' style='text-align:right;'>"; echo formatMoney($data[2], true); echo "</td> 
  
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
		 
	 }

?> 