 <?php
   include("../../../connect.php"); 
session_cache_limiter(FALSE);
session_start();
  
  $PaitentID = mysqli_real_escape_string($connection, $_POST["Paitent"]); 
  
  $currentdate =date("Y-m-d H:i:s"); 	
 
  $result = mysqli_query($connection, " 
  
  SELECT paitentname,DATE_FORMAT(dob,'%d-%m-%Y'),gender,relationship FROM paitentmaster WHERE 
  mobileno in (select mobileno from paitentmaster where paitentid ='$PaitentID')
  UNION
  SELECT paitentname,DATE_FORMAT(dob,'%d-%m-%Y'),gender,relationship FROM paitentmaster WHERE paitentid ='$PaitentID'
                
 
");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>Name</th>         	
		<th width='%'> DOB</th>   
		<th width='%'> Gender </th> 
		<th width='%'> Relationship </th> 		
		 
		</tr> </thead> <tbody id='myTableDocument'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr> 
  <td  width='%' >$data[0]</td>
  <td    width='%'>$data[1]</td>  
  <td    width='%'>$data[2]</td>  
  <td    width='%'>$data[3]</td>   
   
   
   ";
    
  echo "</tr>";
  
 
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
								?>