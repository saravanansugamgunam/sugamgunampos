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
$DoctorCode = mysqli_real_escape_string($connection, $_POST["DoctorCode"]);
$Period = mysqli_real_escape_string($connection, $_POST["Period"]);


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



 

echo "<br>";

$result = mysqli_query($connection, "  

SELECT   a.consultationuniquebill, a.paitentid, DATE_FORMAT(a.billdate,'%d-%m-%Y')  , 
  CONCAT(b.paitentname,'<br>','(',b.mobileno,')') AS paitent,
  c.username,ISNULL(h.`paitentid`),
  ISNULL(TotalMedicine),ISNULL(TotalTherapy),ISNULL(MedicineBill),ISNULL(TherapyBooking),IFNULL(m.Followup,0)
    FROM `consultingbillmaster` AS a JOIN paitentmaster AS b
 ON a.paitentid = b.paitentid  
 JOIN usermaster AS c ON a.doctorid = c.userid JOIN 
 consultingdetails AS d ON a.consultationuniquebill = d.consultationuniquebill
 JOIN consultationmaster AS e ON d.consultationid=e.consultationid 
 LEFT JOIN casehistory AS h ON  a.consultationuniquebill = h.`consultinguniqueid`
 LEFT JOIN ( SELECT diseasemappinguniqueid, COUNT(*) AS TotalMedicine FROM `diseasemapping_paitent` AS a
LEFT JOIN productmaster AS b ON a.conceptid = b.`productid` 
 WHERE conceptname ='Medicine' GROUP BY diseasemappinguniqueid) AS i ON a.`consultationuniquebill`=i.diseasemappinguniqueid
 LEFT JOIN ( SELECT diseasemappinguniqueid, COUNT(*) AS TotalTherapy FROM `diseasemapping_paitent` AS a
LEFT JOIN consultationmaster AS b ON a.conceptid = b.`consultationid`
 WHERE conceptname ='Therapy' GROUP BY diseasemappinguniqueid) AS j ON a.`consultationuniquebill`= j.diseasemappinguniqueid
 LEFT JOIN (SELECT paitientcode,saledate,COUNT(*) AS MedicineBill FROM salemaster  
 WHERE saledate BETWEEN '$FromPeriod' AND '$ToPeriod' 
 GROUP BY paitientcode,saledate) AS k ON a.`paitentid`=k.paitientcode AND a.`billdate`=k.saledate 

LEFT JOIN ( SELECT paitentid,bookingdate,COUNT(*) AS TherapyBooking FROM therapybookingmaster WHERE 
  bookingdate BETWEEN '$FromPeriod' AND '$ToPeriod'
 GROUP BY  paitentid,bookingdate) AS l ON a.`paitentid`=l.paitentid AND a.`billdate`=l.bookingdate 
  
LEFT JOIN ( SELECT IFNULL(IF(COUNT(*)>0,'1',0),0) AS Followup,mobileno FROM  newenquirydetails WHERE
 addeddate BETWEEN '$FromPeriod' AND '$ToPeriod'  group by mobileno) as m on m.mobileno=b.mobileno  
 
 WHERE  a.billdate BETWEEN '$FromPeriod' AND '$ToPeriod' AND cancelledstatus='0'  AND 
 e.`consultingtype`='General' and a.doctorid like('$DoctorCode') GROUP BY  DATE_FORMAT(a.billdate,'%d-%m-%Y')  ,
  a.consultationuniquebill,  CONCAT(b.paitentname,'(',b.mobileno,')') ,
  c.username ,h.`paitentid`, a.`paitentid`,m.Followup
 
 ");


 
 

//echo "<table id='tblProject' class='tblMasters'>";

echo "  	<table id='data-table' class='table table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>   
		<th hidden>ID</th>   
		<th hidden>Paitentid</th>   
    <th>Consulting Date</th>           
    <th>Name</th>           
    <th>Doctor</th>           
    <th>Case Sheet Status</th>           
    <th>Medicine Status</th>   
    <th>Medicine Purchase</th>         
    <th>Therapy Status</th>           
          
    <th>Therapy Booking</th>           
    <th>View</th>       
    <th>Followup</th>       
		 
		</tr> </thead> <tbody id='ProjectTable'>";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden nowrap > $data[0]</td>
  <td hidden  > $data[1]</td>
  <td >$data[2]</td>  
   <td  width='%'>$data[3]</td>
   <td  width='%'>$data[4]</td>";
   if($data[5]==1)
   {
    echo "<td  bgcolor='#ff6c6c' nowrap width='%'>Not Prepared</td>";  
   }
   else
   {
    echo "<td nowrap width='%'> Prepared</td>";  

   } 

   if($data[6]==1)
   {
    echo "<td  bgcolor='#ff6c6c' nowrap width='%'>Not Prescribed</td>";  
   }
   else
   {
    echo "<td nowrap width='%'> Prescribed</td>";  

   } 
   if($data[8]==1)
   {
    echo "<td  bgcolor='#ff6c6c' nowrap width='%'>Not Billed</td>";  
   }
   else
   {
    echo "<td nowrap width='%'> Billed</td>";  

   }  
   
   if($data[7]==1)
   {
    echo "<td  bgcolor='#ff6c6c' nowrap width='%'>Not Recomended</td>";  
   }
   else
   {
    echo "<td nowrap width='%'> Recomended</td>";  

   }  

  

   if($data[9]==1)
   {
    echo "<td  bgcolor='#ff6c6c' nowrap width='%'>Not Booked</td>";  
   }
   else
   {
    echo "<td nowrap width='%'> Booked</td>";  

   }  
 
 echo " <td align='center' style='color:#009ad9'  >
  <a href='ConsultingView.php?PID=$data[1]&INV=0&TID=0&S=C&MID=52' target='_blank' ?>
<i class='fa fa-2x fa-eye' title='View'></i></a></td>";

if($data[10]=='0')
{
echo " <td align='center' style='color:#009ad9' onclick='LoadCustomerDetails($data[1])'>
    <a href='#ModalAddEnquiry' data-toggle='modal'>
        <i class='fa fa-2x fa-pencil' title='View'></i> </a>
</td>";
}
else { echo " <td align='center' style='color:green'>In Followup</a>
</td>";}

echo "</tr>";


// echo "<tr>
    // <td>" $data[0] "</td>
    // </tr>"; echo "<tr>" $data[1] "</tr>";
// //echo "<br>";
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