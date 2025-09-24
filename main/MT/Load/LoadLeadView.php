 <?php

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

session_cache_limiter(FALSE);
session_start();



// echo "1";
include("../../../connect.php");
$currentdate = date("Y-m-d");


$LeadId = mysqli_real_escape_string($connection, $_POST["LeadId"]);
 
  
$result = mysqli_query($connection, "  
SELECT  date_format(addeddate,'%d-%m-%Y') ,c.`stakeholder`,b.enquirylist,a.`name`,mobileno,
leadstatus
FROM(  
   SELECT id,name,followupdate,enquiryid,remarks,addeddate, mobileno,stakeholderid,leadstatus FROM newenquirydetails 
    where  id like ('$LeadId') ) AS a JOIN `enquirylist` AS b ON
    a.enquiryid = b.id JOIN stakeholderlist AS c ON a.stakeholderid =c.stakeholderid 
    where  a.id like ('$LeadId')  
 ");
 
//echo "<table id='tblProject' class='tblMasters'>";

echo " <div> 	<table id='data-tablee' class='table table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>   
    <th>Date</th>           
    <th>Stakeholder</th>           
    <th>Lead For</th>           
    <th>Name</th>           
    <th>Mobile No</th>             
    <th>Current Status</th>           
		 
		</tr> </thead> <tbody id='ProjectTable'>";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td nowrap > $data[0]</td>
  <td  > $data[1]</td>
  <td >$data[2]</td>  
   <td  width='%'>$data[3]</td>  
   <td   width='%'>$data[4]</td> 
   <td   width='%'>$data[5]</td>    
   ";
  echo "</tr>";
  $SerialNo = $SerialNo + 1;
}
echo "</tbody>
</table>";
 
 echo "<hr>";
 echo "<h3>Followup History</h3>";
$result = mysqli_query($connection, "
SELECT DATE_FORMAT(createdon,'%d-%m-%Y') AS logdage, leadlog,
DATE_FORMAT(followupdate,'%d-%m-%Y') followupdate, 
leadstatus FROM leadlog WHERE leadid ='$LeadId' 
ORDER BY id DESC 
 ");
 
//echo "<table id='tblProject' class='tblMasters'>";

echo "  	<table id='data-table' class='table table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>   
    <th>Log Date</th>  
    <th>Remarks</th>           
    <th>Followup Date</th>           
            
    <th>Status</th>                 
		 
		</tr> </thead> <tbody id='ProjectTable'>";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td nowrap > $data[0]</td>
  <td  > $data[1]</td>
  <td >$data[2]</td>  
   <td  width='%'>$data[3]</td>    ";
  echo "</tr>";
  $SerialNo = $SerialNo + 1;
}
echo "</tbody>
</table>
</div>";
?>