<style>
  #tblTherapyListCancell td,
  #tblTherapyListCancell th {
    border: 1px solid #ddd;
    padding: 8px;
  }
</style>

<?php
include("../../../connect.php");
session_cache_limiter(FALSE);
session_start();



// echo "1";

$InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]);
$ID = mysqli_real_escape_string($connection, $_POST["ID"]);

$currentdate = date("Y-m-d H:i:s");

$result = mysqli_query($connection, "
  SELECT DATE_FORMAT(b.updatedon,'%d-%m-%y') AS Updatedon,e.username AS Updatedby,
IF(oldtherapist-newtherapist=0,'Date Change','Therapist Change') AS ChangeType,
DATE_FORMAT(therapyolddate,'%d-%m-%y') as therapyolddate, DATE_FORMAT(therapyreviseddate,'%d-%m-%y') as therapyreviseddate,
c.username AS OldTherapist,d.username AS NewTherapist,b.remarks
FROM therapybookingdetails AS a 
JOIN therapyreschedulelog  AS b  ON a.bookinguniqueid =b.therapyuniqueno AND a.bookingid=b.therapyitemid
JOIN usermaster AS c ON b.oldtherapist=c.userid
JOIN usermaster AS d ON b.  newtherapist=d.userid
JOIN usermaster AS e ON b.updatedby=e.userid
WHERE bookinguniqueid ='$InvoiceNo' AND a.bookingid='$ID'  
   
 
");



//echo "<table id='tblProject' class='tblMasters'>";
echo "  <table id='tblTherapyListCancell'  border='1' style='border-collapse:collapse;' 
   class='  table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th width='%'  >Updated Date</th>        
		<th width='%'  >Updated By</a></th>        
		<th width='%'>Type</a></th>     
		<th width='%'> Old Date</a></th>    
		<th width='%'> Revised Date</a></th>    
		<th width='%'> Old Therapist</a></th>    
		<th width='%'> New Therapist</a></th>    
		<th width='%'> Remarks</a></th>    
		  
		</tr> </thead> <tbody id='myTable'>";

$SerialNo = 1;
while ($data = mysqli_fetch_row($result)) {
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td    id='BookingID'  width='%' >$data[0]</td>
  <td nowrap id='TherapyDate' width='%'>$data[1]</td>  
   <td id='TherapyTime'  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td  id='TherapyName' width='%'>$data[5]</td>    
   <td  id='TherapyName' width='%'>$data[6]</td>    
   <td  id='TherapyName' width='%'>$data[7]</td>    
   
 </tr>";

  $SerialNo = $SerialNo + 1;
}
echo "</tbody></table>";
?>