 
<?php
  
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 include("../../../connect.php");
  
//insert.php
if(isset($_POST["UserID"]))
{
   
 $currentdate =date("Y-m-d H:i:s"); 							  
 $UserID = mysqli_real_escape_string($connection, $_POST["UserID"]);
 
 
 
$result = mysqli_query($connection, " 
SELECT studentcode,studentname, isotemplate from  studentmaster  WHERE  isotemplate IS NOT NULL 
UNION
SELECT userid,username, isotemplate FROM  usermaster   WHERE  isotemplate IS NOT NULL 
 ");
echo "<div>";
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblBioCode' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">ID</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Name</a></th>      
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Code</a></th>      
		       
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td>$data[0]</td>
  <td >$data[1]</td>  
   <td  >$data[2]</td>     
 
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
 
}
echo "</tbody></table>";
$SerialNo=$SerialNo-1;
echo "<input type='text' id='txtTotalData' name='txtTotalData' value='$SerialNo' />";


// $query=mysqli_query($connection, " 
 // SELECT isotemplate from  biometric WHERE userid ='".$UserID."'");
	 
	 // $data = array();
   
    // while($row=mysqli_fetch_assoc($query))
    // { 
      // $data[] = $row['isotemplate']; 
       
     
     
    // }
	  
// echo json_encode($data);
 
  
    // mysqli_close($connection);

  
}

?>