<style>
table.blueTable {
    border: 1px solid #1C6EA4;
    background-color: #EEEEEE;
    width: 40%;
    text-align: left;
    border-collapse: collapse;
}

table.blueTable td,
table.blueTable th {
    border: 1px solid #AAAAAA;
    padding: 2px 2px;
    text-align: center;
}

table.blueTable tbody td {
    font-size: 13px;
    text-align: center;
}

table.blueTable tr:nth-child(even) {
    background: #D0E4F5;
}

table.blueTable thead {
    background: #83b3e4;
    background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
    background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
    background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
    border-bottom: 1px solid #444444;
}

table.blueTable thead th {
    font-size: 14px;
    font-weight: normal;
    color: #FFFFFF;
    border-left: 1px solid #D0E4F5;
    padding: 5px 20px;

}

table.blueTable thead th:first-child {
    border-left: none;
}

table.blueTable tfoot {
    font-size: 14px;
    font-weight: bold;
    color: #FFFFFF;
    background: #D0E4F5;
    background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
    background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
    background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
    border-top: 2px solid #444444;
}

table.blueTable tfoot td {
    font-size: 14px;
}

table.blueTable tfoot .links {
    text-align: right;
}

table.blueTable tfoot .links a {
    display: inline-block;
    background: #1C6EA4;
    color: #FFFFFF;
    padding: 2px 8px;
    border-radius: 5px;
}
</style>
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


$FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]);
$ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]);
$Period = mysqli_real_escape_string($connection, $_POST["Period"]);
$Enquiry = mysqli_real_escape_string($connection, $_POST["Enquiry"]);
$LeadStatus = mysqli_real_escape_string($connection, $_POST["LeadStatus"]);


if ($Period == 'Today') {
  $FromPeriod = $currentdate;
  $ToPeriod = $currentdate;
} else if ($Period == 'Yesterday') {
  $FromPeriod = date('Y-m-d', (strtotime('-1 day', strtotime($currentdate))));
  $ToPeriod = date('Y-m-d', (strtotime('-1 day', strtotime($currentdate))));
} else if ($Period == 'CurrentMonth') {
  $FromPeriod = date('Y-m-01', strtotime($currentdate));
  $ToPeriod = date('Y-m-t', strtotime($currentdate));
} else if ($Period == 'Last7Days') {
  $FromPeriod = date('Y-m-d', (strtotime('-7 day', strtotime($currentdate))));
  $ToPeriod = $currentdate;
} else if ($Period == 'Last14Days') {
  $FromPeriod = date('Y-m-d', (strtotime('-14 day', strtotime($currentdate))));
  $ToPeriod = $currentdate;
} else if ($Period == 'Last30Days') {
  $FromPeriod = date('Y-m-d', (strtotime('-30 day', strtotime($currentdate))));
  $ToPeriod = $currentdate;
} else if ($Period == 'Custom') {
  $FromPeriod = $FromDate;
  $ToPeriod = $ToDate;
}

if($Enquiry=='')
{
  $Enquiry='%';
} 

 
$TotalStock = mysqli_query($connection, "

SELECT 
(SELECT COUNT(*) FROM newenquirydetails WHERE enquiryid like ('$Enquiry') and 
addedon between '$FromPeriod 00:00:01' and '$ToPeriod 23:59:59') 'Total',
(SELECT COUNT(*) FROM newenquirydetails WHERE leadstatus ='Captured' and enquiryid like ('$Enquiry') and 
addedon between '$FromPeriod 00:00:01' and '$ToPeriod 23:59:59') 'Captured',
(SELECT COUNT(*) FROM newenquirydetails WHERE leadstatus ='Intrested' and enquiryid like ('$Enquiry') and  
addedon between '$FromPeriod 00:00:01' and '$ToPeriod 23:59:59') 'Intrested',
(SELECT COUNT(*) FROM newenquirydetails WHERE leadstatus ='Follow-up' and enquiryid like ('$Enquiry') and  
addedon between '$FromPeriod 00:00:01' and '$ToPeriod 23:59:59') 'Follow-up',
(SELECT COUNT(*) FROM newenquirydetails WHERE leadstatus ='Dropped' and enquiryid like ('$Enquiry') and  
addedon between '$FromPeriod 00:00:01' and '$ToPeriod 23:59:59') 'Dropped',
(SELECT COUNT(*) FROM newenquirydetails WHERE leadstatus ='Converted' and enquiryid like ('$Enquiry') and  
addedon between '$FromPeriod 00:00:01' and '$ToPeriod 23:59:59') 'Converted',
(SELECT COUNT(*) FROM newenquirydetails WHERE leadstatus ='Closed' and enquiryid like ('$Enquiry') and  
addedon between '$FromPeriod 00:00:01' and '$ToPeriod 23:59:59') 'Closed' 
 
 ");


echo "  <table id='tblTotalStock'  border='1' style='border-collapse:collapse;width:20%' class='blueTable' >";
echo " <thead> 
<tr>  
		             
		<th nowrap width='%'> Total </th>             
		<th nowrap width='%'> Captured </th>             
		<th nowrap width='%'> Intrested </th>             
		<th nowrap width='%'> Follow-up </th>             
		<th nowrap width='%'> Dropped </th>             
		<th nowrap width='%'> Converted </th>             
		<th nowrap width='%'> Closed </th>             
		 </tr>
  </thead> <tbody>";

while ($data = mysqli_fetch_row($TotalStock)) {
  echo "
  <tr>     
   <td width='%'><b>";echo formatMoney($data[0], false); echo "</b></td>  
   <td width='%'><b>";echo formatMoney($data[1], false); echo "</b></td>  
   <td width='%'><b>";echo formatMoney($data[2], false); echo "</b></td>  
   <td width='%'><b>";echo formatMoney($data[3], false); echo "</b></td>  
   <td width='%'><b>";echo formatMoney($data[4], false); echo "</b></td>  
   <td width='%'><b>";echo formatMoney($data[5], false); echo "</b></td> 
   <td width='%'><b>";echo formatMoney($data[6], false); echo "</b></td> 
  </tr>";
}

echo "</tbody></table><br>";


echo "<br>";

$result = mysqli_query($connection, "  
        SELECT  a.id,CallType,date_format(addeddate,'%d-%m-%Y') ,c.`stakeholder`,b.enquirylist,a.`name`,mobileno,
        date_format(followupdate,'%d-%m-%Y') ,remarks,leadstatus,location,pincode FROM( 
        SELECT 'New Calls' AS CallType,id,name,followupdate,enquiryid,remarks,addeddate, mobileno,stakeholderid,
        leadstatus,location,pincode FROM newenquirydetails  where
        addedon between '$FromPeriod 00:00:01' and '$ToPeriod 23:59:59'         
        UNION 
        SELECT 'Follow-up' as CallType,id,NAME,followupdate,enquiryid,remarks,addeddate, mobileno,stakeholderid,
        leadstatus,location,pincode FROM newenquirydetails  WHERE
        followupdate BETWEEN '$FromPeriod' AND '$ToPeriod' and id not in (
        select id from newenquirydetails where addedon between '$FromPeriod 00:00:01' and '$ToPeriod 23:59:59'  ) and
        leadstatus not in('Dropped','Converted','Closed')) AS a JOIN `enquirylist` AS b ON
        a.enquiryid = b.id JOIN stakeholderlist AS c ON a.stakeholderid =c.stakeholderid 
        where  a.enquiryid like ('$Enquiry')  and a.leadstatus like ('$LeadStatus')

 ");



//echo "<table id='tblProject' class='tblMasters'>";

echo "  	<table id='data-table' class='table table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>   
    <th>Type</th>           
    <th>Date</th>           
    <th>Stakeholder</th>           
    <th>Lead For</th>           
    <th>Name</th>           
    <th>Mobile No</th>      
    <th>Location</th>      
    <th>Pincode</th>           
    <th>Followup Date</th>           
    <th>Remarks</th>
    <th>Status</th>   
    <th>View</th>           
    <th>Log</th>           
		 
		</tr> </thead> <tbody id='ProjectTable'>";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
    <td width='10%'>$SerialNo</td>
    <td nowrap > $data[1]</td>
    <td  > $data[2]</td>
    <td >$data[3]</td>  
    <td  width='%'>$data[4]</td>  
    <td   width='%'>$data[5]</td>
     
    <td   width='%'>$data[9]</td> 
     
    <td   width='%'>$data[10]</td> 
    
    <td   width='%'>$data[6]</td>  
    <td   width='%'>$data[7]</td>  
    <td   width='%'>$data[8]</td>  
    <td   width='%'>$data[9]</td>  


   <td style='text-align:center;color:#1588cf' onclick='LoadLeadView($data[0])'>
   <a href='#ModelViewLead' data-toggle='modal'><i class='fa fa-eye'></a></td>";

if($data[9]=='Dropped' || $data[9]=='Converted' || $data[9]=='Closed')
{
  echo " <td style='text-align:center;color:#1588cf''> </td>";
}
else
{
  echo "   <td style='text-align:center;color:#1588cf'  onclick='LoadLeadID($data[0])'>
  <a href='#ModelUpdateLog' data-toggle='modal'><i class='fa fa-pencil'></a></td>";

} 
  echo "</tr>";
  $SerialNo = $SerialNo + 1;
}
echo "</tbody>
</table>";



?>


<script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="../assets/js/table-manage-default.demo.min.js"></script>

<script>
$(document).ready(function() {

    TableManageDefault.init();
});
</script>