<script>
$(document).ready(function(){
  // $("#myInput").on("keyup", function() {
  $("#myInputCL").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTableCL tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<?php
   include("../../../connect.php"); 
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
 $ID = mysqli_real_escape_string($connection, $_POST["ID"]); 
 $Period =  mysqli_real_escape_string($connection, $_POST["Period"]); 
 $TherapyStatus = 'Open'; 
 $currentdate =date("Y-m-d"); 
 
 
 if($Period=='Today')
 {
   $FromPeriod=$currentdate;
   $ToPeriod=$currentdate;

 }
 else if($Period=='Yesterday')
 {
   $FromPeriod=date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $currentdate) ) ));
   $ToPeriod=date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $currentdate) ) ));

 }
 else if($Period=='CurrentMonth')
 {
   $FromPeriod=date('Y-m-01', strtotime($currentdate));
   $ToPeriod=date('Y-m-t', strtotime($currentdate));


 }
 else if($Period=='Last7Days')
 {
   $FromPeriod=date('Y-m-d',(strtotime ( '-7 day' , strtotime ( $currentdate) ) ));
   $ToPeriod= $currentdate; 
 }
 else if($Period=='Last14Days')
 {
   $FromPeriod=date('Y-m-d',(strtotime ( '-14 day' , strtotime ( $currentdate) ) ));
   $ToPeriod= $currentdate; 
 }
 else if($Period=='Last30Days')
 {
   $FromPeriod=date('Y-m-d',(strtotime ( '-30 day' , strtotime ( $currentdate) ) ));
   $ToPeriod= $currentdate; 
 }
 else if($Period=='Custom')
 {
   $FromPeriod = $FromDate;
   $ToPeriod=$ToDate;
 }

 

 if( $ID=='99999')
 {
	  $PaitentID =" a.paitentid like '%' ";
 }
 else
 {
	 $PaitentID =" a.paitentid = '$ID' ";
 }
  $currentdate =date("Y-m-d H:i:s"); 	
 echo " <input type='text' name='myInputCL' id='myInputCL' class='form-control'  placeholder='Search...'  />";    
  
	 
	$result = mysqli_query($connection, "  
  SELECT a.bookinguniqueid,DATE_FORMAT(e.closingdate,'%d-%m-%Y') AS closingdate ,
b.paitentname,b.mobileno,d.consultationname,c.username ,
CONCAT(totalsitting,'/',MAX(e.`sitting`)) AS Sittings,
a.`fees`, g.Balance
FROM therapybookingmaster AS a
JOIN paitentmaster AS b ON a.paitentid =b.paitentid 
JOIN usermaster AS c ON a.doctorid=c.userid 
JOIN consultationmaster AS d ON a.therapyid=d.consultationid 
JOIN therapyclosredetails AS e ON a.bookinguniqueid = e.bookinguniqueid
LEFT JOIN  (SELECT invoicegrn,SUM(debitamount)-SUM(creditamount) AS Balance FROM transactionledger 
  GROUP BY invoicegrn) AS g ON a.`bookinguniqueid`=g.invoicegrn
where e.closingdate between '$FromPeriod' and '$ToPeriod'
GROUP BY a.bookinguniqueid, 
b.paitentname,b.mobileno,d.consultationname,totalsitting,c.username,e.closingdate

ORDER BY 1 DESC 
 
");
 

  

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblTherapyRegisterCL'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th  hidden width='%' > ID </th>    	
		<th nowrap width='%'> Date</th>   
		<th width='%'> Paitent </th> 
    <th width='%'> Mobile No </th> 
		<th width='%'> Therapy</th> 
    <th width='%'> Doctor </th> 		  		 
    <th width='%'> Sittings</th> 
    		<th width='%'> Fee </th>
		<th width='%'> Balance</th>
	
    <th width='%'>  </th> "; 
	 
		 echo "
		</tr> </thead> <tbody id='myTableCL'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td  hidden  id='BookingID'  width='%' >$data[0]</td>
  <td nowrap id='TherapyDate' width='%'>$data[1]</td>  
   <td id='TherapyTime'  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td  id='TherapyName' width='%'>$data[5]</td>    
   <td  width='%'>$data[6]</td> 
   <td  width='%'>$data[7]</td> 
   <td  width='%'>$data[8]</td> 
   
   ";
   echo "<td onclick='GetCompletedTherapyID(this)'><a href='#modalTherapyClosed' data-toggle='modal'  >
   <i class='fa fa-2x  fa-eye text-warning'></i></a></td>";
    
    
  echo "</tr>";
  
 
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
								?>
    
 