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
  DATE_FORMAT(DATE_ADD(DATE_ADD(billaddedon ,INTERVAL 5 HOUR) ,INTERVAL 30 MINUTE),'%h:%i %p')) AS Bill,
  c.username,IFNULL(e.`username`,'Admin'),
  discountamount,totalamount,receivedamount,
  if(cancelledstatus=0,tokenstatus,'Cancelled')
  FROM `consultingbillmaster` AS a JOIN paitentmaster AS b ON a.paitentid=b.paitentid
  JOIN usermaster as c ON a.doctorid=c.userid  
  JOIN locationmaster AS d ON a.locationcode=d.locationcode 
  LEFT JOIN usermaster AS e ON a.`addedby`=e.userid
  WHERE a.paitentid ='$PaitentID'  AND billtype='Consultation'  ORDER BY a.billdate DESC
 
 
");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th hidden width='%' > ID </th>    	
		<th width='%'> Location</th>   
		<th width='%'>  Date </th> 
		<th width='%'> Doctor </th> 		
		<th width='%'> User </th> 		
		<th width='%'> Discount</th> 		
		<th width='%'> Total</th> 		
		<th width='%'> Received </th>     
    <th width='%'> Status </th>   
		 
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
   <td width='%'   >$data[7]</td> ";
   if($data[8]=='Cancelled')
   {
    echo "<td width='%'  style='color: red;' >$data[8]</td> ";
   }
   else

  {
    echo "<td width='%'  style='color: black;' >$data[8]</td> ";
  }
    
  echo "</tr>";
  
 
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
								?>
    
 