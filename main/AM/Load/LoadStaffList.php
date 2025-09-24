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
  
 
$Status = mysqli_real_escape_string($connection, $_POST["Status"]); 
$Designation = mysqli_real_escape_string($connection, $_POST["Designation"]);  

  $currentdate =date("Y-m-d H:i:s"); 	
 echo " <input type='text' name='myInput' id='myInput' class='form-control'  placeholder='Search...'  />";    
  
								$result = mysqli_query($connection, " 
                SELECT a.userid, username,gender, mobileno,altcontact,DATE_FORMAT(dob,'%d-%m-%Y') AS dob,biometricstatus,biometricid,
                IFNULL(Loc,'No Location'),IFNULL(Grp,'No Group') FROM usermaster AS a 
               LEFT JOIN (SELECT userid,IFNULL(IF(COUNT(*)>1,'Multiple Location',b.locationname),'No Location') AS Loc FROM uselocationmapping AS a 
               JOIN locationmaster AS b ON a.locationid=b.locationcode -- where userid =113
                GROUP BY userid) AS b ON a.userid=b.userid 
               LEFT  JOIN (SELECT userid,IF(COUNT(*)>0,b.groupname,'No Group') AS Grp FROM pos_usergroupmapping AS a 
               JOIN pos_groupmaster AS b ON a.groupid = b.groupid -- WHERE userid ='13'
               GROUP BY userid) AS c ON a.userid=c.userid
                where
activestatus like ('$Status') and designationid like ('$Designation');
");
 
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table'  border='1' style='border-collapse:collapse;' 
   class='table  table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th width='%' hidden> ID </th>    	
		<th width='%'> Name</th>   
		<th width='%'>  Gender </th> 
		<th width='%'> Mobile No. </th> 		
		<th width='%'> Alt. No. </th> 		
		<th width='%'> DOB </th>    
		<th width='%'> Biometric Status </th>    
		<th width='%'> Biometric ID </th>    
		<th width='%'> Location </th>    
		<th width='%'> Group </th>    
    <th width='%'> View </th>    
    <th width='%'> Edit </th>    
		 
		</tr> </thead> <tbody id='myTable'>";

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
   <td width='%'>$data[5]</td>
   
   ";
   
   if($data[7]=="0")
   {
	    echo "<td onclick='GetPointID($data[0])' ><button  class='btn btn-xs btn-info' >  
      <a href='#modal-Biometric' data-toggle='modal' style='color:white'>
      <i class='fa fa-2x fa-hand-o-up'></i></a> </button>
		
		
		</td>";
   }
   else
   {
	 echo "<td>Available</td>";
   }
  echo "<td width='%'>$data[7]</td>
    <td width='%'>$data[8]</td>
  <td width='%'>$data[9]</td>";
  
  echo "<td width='%'><a href='StaffProfile.php?MID=4&SID=$data[0]'   >
  <i class='fa fa-2x fa-eye'></i></a></td>";
  echo "<td width='%'>
  <a href='#modal-dialog' data-toggle='modal'   onclick='LoadStaffDetails($data[0]);'>  
  <i class='fa fa-2x fa-pencil'></i></a></td>";
  echo "</tr>";
  
 
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
								?>
    
 