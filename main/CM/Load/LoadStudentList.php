<?php
  
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 					 
$result = mysqli_query($connection, "  SELECT  studentcode,studentname,studentmobileno,studentalternatecontactno,
studentemailid,DATE_FORMAT(studentdob, '%d-%b-%y') AS DOB,
studentgender,studentmaritalstatus, studentaddress,studentqualification FROM studentmaster ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S. No</th>    
		<th width='%' hidden> <a href=\"javascript:SortTable(3,'T');\"> Code</a></th>   
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Name</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Mobile No</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Alt. Contact</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Email</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">DOB</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Gender</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Marital Status</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Adress</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Qualification</a></th>        
		<th width='%' hidden> <a href=\"javascript:SortTable(3,'T');\">Edit</a></th>    
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden> $data[0]</td>
  <td width='%' id ='tblCourseCode'>$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>     
   <td width='%'>$data[6]</td>     
   <td width='%'>$data[7]</td>     
   <td width='%'>$data[8]</td>     
   <td width='%'>$data[9]</td>     
   <td width='%'>$data[10]</td>     
   <td align='center' width='%' style='color:#009ad9'  onclick='GetPointID(this)' hidden><i class='fa fa-2x fa-edit'></i></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    

?>