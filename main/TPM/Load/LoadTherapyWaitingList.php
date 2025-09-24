<script>
$(document).ready(function(){
  // $("#myInput").on("keyup", function() {
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
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
 
 $TherapyStatus = 'Open'; 
 if( $ID=='99999')
 {
	  $PaitentID =" a.paitentid like '%' ";
 }
 else
 {
	 $PaitentID =" a.paitentid = '$ID' ";
 }
  $currentdate =date("Y-m-d H:i:s"); 	
 echo " <input type='text' name='myInput' id='myInput' class='form-control'  placeholder='Search...'  />";    
  
	 
	$result = mysqli_query($connection, "  
  SELECT a.bookinguniqueid,DATE_FORMAT(revisedtherapydate,'%d-%m-%Y') AS revisedtherapydated,
  IFNULL(f.timeslot,revisedtherapytime),b.paitentname,b.mobileno,d.consultationname,totalsitting,c.username,c.userid,
  a.`fees`, g.Balance
  FROM therapybookingmaster AS a
  JOIN paitentmaster AS b ON a.paitentid =b.paitentid 
  JOIN usermaster as c ON a.doctorid=c.userid 
  JOIN consultationmaster AS d ON a.therapyid=d.consultationid 
  LEFT JOIN timeslotallocation AS e ON a.bookinguniqueid=e.uniqueid
  LEFT JOIN timeslotdetails AS f ON e.timeslotid= f.id
  LEFT JOIN  (SELECT invoicegrn,SUM(debitamount)-SUM(creditamount) AS Balance FROM transactionledger 
  GROUP BY invoicegrn) AS g ON a.`bookinguniqueid`=g.invoicegrn
  WHERE  a.therapystatus='Booked' ORDER BY revisedtherapydate DESC
 
");
  
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblTherapyRegisterWL'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th hidden width='%' > ID </th>    	
		<th nowrap width='%'> Date</th>   
		<th width='%'>  Time </th> 
		<th width='%'> Paitent </th> 
    <th width='%'> Mobile No </th> 
		<th width='%'> Therapy</th> 		  		 
    <th width='%'> Sittings</th> 	
		<th width='%'> Doctor </th>
		<th hidden width='%'> userid </th>
		<th width='%'> Fee </th>
		<th width='%'> Balance</th>

		";
if($ID=='99999')
{
	echo "<th width='%'> </th> ";   
	if($TherapyStatus=='Open')
{
	 
	echo "<th hidden width='%'>  </th>    
		<th width='%'>  </th>    
		<th width='%'>  </th> ";
}
}
		 echo "
		</tr> </thead> <tbody id='myTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td  hidden id='BookingID'  width='%' >$data[0]</td>
  <td nowrap id='TherapyDate' width='%'>$data[1]</td>  
   <td id='TherapyTime'  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td  id='TherapyName' width='%'>$data[5]</td>    
   <td  width='%'>$data[6]</td>
   <td  width='%'>$data[7]</td>
   <td hidden id='userid' width='%'>$data[8]</td>
   <td   id='userid' width='%'>$data[9]</td>
   <td   id='userid' width='%'>$data[10]</td>
   
   ";
if($ID=='99999')
{
	echo "
   
   <td hidden id='PaitentName' width='%'>$data[3]</td> 
   <td hidden onclick='GetPointID(this);'><a href='#modalTherapyAssiging'  data-toggle='modal' >
   <i class='fa fa-2x fa-check-circle text-success'></i></a></td>";
   
   if($TherapyStatus=='Open')
{ 
   echo "
   
   <td   onclick='GetPointID(this)'><a href='#modalTherapyCancel' data-toggle='modal'  >
   <i class='fa fa-2x fa-minus-circle text-danger'></i></a></td>
   
   <td onclick='GetPointID(this)'><a href='#modalTherapyReschedule' data-toggle='modal'  >
   <i class='fa fa-2x  fa-calendar text-warning'></i></a></td>
   
   <td onclick='SendSMSPaitent(this)'> <i class='fa fa-2x  fa-envelope text-warning'></i></td>";
}

   }
   else if($ID<>'99999')
{
	echo "<td onclick='GetPointID(this)'><a href='#modalTherapyAssiging' data-toggle='modal'  >
	<i class='fa fa-2x  fa-eye text-warning'></i></a></td>";
}
    
    
  echo "</tr>";
  
 
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
								?>
    
 