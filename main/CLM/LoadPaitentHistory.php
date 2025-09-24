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
  
  $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]); 
 
  
 // echo "1";

  $currentdate =date("Y-m-d H:i:s"); 	
 echo " <input type='text' name='myInput' id='myInput' class='form-control'  placeholder='Search...'  />";    
  
								$result = mysqli_query($connection, " 
								
  SELECT consultationuniquebill,locationname ,
  CONCAT(DATE_FORMAT(a.billdate,'%d-%m-%Y'),' ', 
  DATE_FORMAT(DATE_ADD(DATE_ADD(billaddedon ,INTERVAL 5 HOUR) ,INTERVAL 30 MINUTE),'%h:%i %p')) AS Bill,c.username,
  discountamount,totalamount,receivedamount
  FROM `consultingbillmaster` AS a JOIN paitentmaster AS b ON a.paitentid=b.paitentid
  JOIN usermaster AS c ON a.doctorid=c.userid  
  JOIN locationmaster AS d ON a.locationcode=d.locationcode 
  WHERE a.paitentid ='$PaitentID' AND  cancelledstatus='0' AND billtype='Consultation'  ORDER BY a.billdate DESC
 
 
");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th hidden width='%' > ID </th>    	
		<th width='%'> Location</th>   
		<th width='%'>  Date </th> 
		<th width='%'> Doctor </th> 		
		<th width='%'> Discount</th> 		
		<th width='%'> Total</th> 		
		<th width='%'> Received </th>     
		 
		</tr> </thead> <tbody id='myTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden id='BillNo'  width='%' >$data[0]</td>
  <td  id='VisitDate' width='%'>$data[1]</td>  
   <td id='Doctor'  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td  width='%'>$data[4]</td>     
   <td  width='%'>$data[5]</td>
   <td width='%'>$data[6]</td>  
   
   
   ";
    
  echo "</tr>";
  
 
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
								?>
    
 