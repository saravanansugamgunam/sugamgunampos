<style>

</style>
<?php
 
session_cache_limiter(FALSE);
session_start();
 

 
// echo "1";
include("../../../connect.php"); 
 $currentdate =date("Y-m-d"); 					 
 $currentdateprint =date("d-m-Y"); 

$FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
$ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
$Doctor = mysqli_real_escape_string($connection, $_POST["userid"]); 

$result = mysqli_query($connection, "



SELECT   DATE_FORMAT(a.entrydate, '%d-%m-%y') AS entrydate ,
username,LEFT(sharefor , 1),
IFNULL(DATE_FORMAT(f.`billdate`, '%d-%m-%y'),
CONCAT(DATE_FORMAT(a.fromdate, '%d'),' to ',DATE_FORMAT(a.todate, '%d'))) AS d, 
IFNULL(g.`paitentname`,'-'), IFNULL(e.`paidamount`,shareamount),
c.paymentmode,a.remarks FROM doctorsharedetails AS a JOIN
usermaster AS b ON a.doctorcode=b.userid 
LEFT JOIN `doctorsharebilldetails` AS e ON a.`invoiceno`=e.`paymentid`
LEFT JOIN consultingbillmaster AS f ON e.`billuniqueid`=f.`consultationuniquebill`
LEFT JOIN paitentmaster AS g ON f.`paitentid`=g.`paitentid`
 JOIN paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode WHERE a.sharefor IN('Consultation','Therapy')
  and a.entrydate between '$FromDate' and '$ToDate' and a.doctorcode='$Doctor'
 
UNION 
SELECT   DATE_FORMAT(a.entrydate, '%d-%m-%y'),
username,LEFT(sharefor , 1),
IFNULL(DATE_FORMAT(f.`saledate`, '%d-%m-%y'),
CONCAT(DATE_FORMAT(a.fromdate, '%d'),' to ',DATE_FORMAT(a.todate, '%d'))) AS d, 
IFNULL(g.`paitentname`,'-'), IFNULL(e.`paidamount`,shareamount),
c.paymentmode,a.remarks FROM doctorsharedetails AS a JOIN
usermaster AS b ON a.doctorcode=b.userid 
LEFT JOIN `doctorsharebilldetails` AS e ON a.`invoiceno`=e.`paymentid`
LEFT JOIN salemaster AS f ON e.`billuniqueid`=f.`saleuniqueno`
LEFT JOIN paitentmaster AS g ON f.`paitientcode`=g.`paitentid`
 JOIN paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode WHERE a.sharefor IN('Inventory')
 and a.entrydate between '$FromDate' and '$ToDate' and a.doctorcode='$Doctor'
ORDER BY  entrydate DESC


"); 

 

echo "  <table id='tblTodayPurchase' class='table   table-condensed'>";
echo " <thead><tr>  
       <th>S.No</th>          
       <th width='%'> Date</th>    
       <th width='%'> Doctor</th>    
       <th width='%'> For</th>    
       <th width='%'> Period</th>   
       <th width='%'> Paitent</th>   
        <th width='%'>Paid</th>    
       <th width='%'>Mode</th>     
       <th width='%'>Remarks</th>        
         
       </tr> </thead> <tbody id='ProjectTable'>";

$SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
 echo "
 <tr>
 <td width='%'>$SerialNo</td>
 <td> $data[0]</td>
 <td >$data[1]</td>  
  <td  width='%'>$data[2]</td>   
  <td width='%'>$data[3]</td>     
  <td width='%'>$data[4]</td>     
  <td width='%'>$data[5]</td>      
  <td width='%'>$data[6]</td>     
  <td width='%'>$data[7]</td>       
  
   
 </tr>";
  
 
 //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
 //echo "<br>";
$SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
echo "</div></div>";     



?>

<div style="display:none;">
    <div class="table-responsive" id='DivPrint'>
        <label>
            <h4>Doctor Share Report - <?php echo "As on " . $currentdateprint ;?></h4>
        </label>
        <?php

$result = mysqli_query($connection, "


SELECT   DATE_FORMAT(a.entrydate, '%d-%m-%y'),
username,LEFT(sharefor , 1),
IFNULL(DATE_FORMAT(f.`billdate`, '%d-%m-%y'),
CONCAT(DATE_FORMAT(a.fromdate, '%d'),' to ',DATE_FORMAT(a.todate, '%d'))) AS d, 
IFNULL(g.`paitentname`,'-'), IFNULL(e.`paidamount`,shareamount),
c.paymentmode,a.remarks FROM doctorsharedetails AS a JOIN
usermaster AS b ON a.doctorcode=b.userid 
LEFT JOIN `doctorsharebilldetails` AS e ON a.`invoiceno`=e.`paymentid`
LEFT JOIN consultingbillmaster AS f ON e.`billuniqueid`=f.`consultationuniquebill`
LEFT JOIN paitentmaster AS g ON f.`paitentid`=g.`paitentid`
 JOIN paymentmodemaster AS c ON a.paymentmode=c.paymentmodecode WHERE a.sharefor IN('Consultation','Therapy')
 and a.entrydate between '$FromDate' and '$ToDate' and a.doctorcode='$Doctor'
ORDER BY entrydate DESC
 
"); 

 

echo "  <table id='PrintTable'  border='1' style='border-collapse:collapse;' width='100%'>";
echo " <thead><tr>  
       <th>S.No</th>          
       <th width='%'> Date</th>    
       <th width='%'> Doctor</th>    
       <th width='%'> For</th>    
       <th width='%'> Period</th>   
       <th width='%'> Paitent</th>   
        <th width='%'>Paid</th>    
       <th width='%'>Mode</th> 
       <th width='%'>Remarks</th>       
         
       </tr> </thead> <tbody id='ProjectTable'>";

$SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
 echo "
 <tr>
 <td width='%'>$SerialNo</td>
 <td> $data[0]</td>
 <td >$data[1]</td>  
  <td  width='%'>$data[2]</td>   
  <td width='%'>$data[3]</td>     
  <td width='%'>$data[4]</td>     
  <td width='%'>$data[5]</td>      
  <td width='%'>$data[6]</td>     
  <td width='%'>$data[7]</td>      
  
   
 </tr>";
  
 
 //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
 //echo "<br>";
$SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
    

?>

    </div>
</div>