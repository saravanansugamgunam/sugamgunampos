<?php
   include("../../../connect.php"); 
session_cache_limiter(FALSE);
session_start();
  
 $LocationCode = $_SESSION['SESS_LOCATION'];
  
 // echo "1";
 $EntryDate = mysqli_real_escape_string($connection, $_POST["EntryDate"]); 
  $currentdate =date("Y-m-d H:i:s"); 					 
  $EntryDate = explode('/', $EntryDate); 
$EntryDate = $EntryDate[2].'-'.$EntryDate[1].'-'.$EntryDate[0];

  
								$result = mysqli_query($connection, "  
 SELECT entryid,DATE_FORMAT(entrydate,'%d-%m-%Y') AS DATE,patienttype,COUNT,total  FROM patiententrydetails AS a 
JOIN  patienttypemaster AS b ON a.typeid=b.typeid
  WHERE entrydate ='$EntryDate' AND a.clientid ='$LocationCode'");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblPatientEntry' name='tblPatientEntry'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th width='%' hidden> ID </th>    	
		<th width='%'> Date</th>    
		<th width='%'> Type </th>    
		<th width='%'>  Total Patient </th>      
		<th width='%'>  Total Amount </th>      
		<th width='%'>  Delete </th>      
		</tr> </thead> <tbody>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td width='%' hidden>$data[0]</td>
  <td width='%'>$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>   
   <td width='%'>$data[4]</td>   
   <td align='center' width='%' style='color:red'  onclick='GetPointID(this)' ><i class='fa fa-2x fa-trash' style='cursor:pointer'></i></td>   
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
								?>
    
 