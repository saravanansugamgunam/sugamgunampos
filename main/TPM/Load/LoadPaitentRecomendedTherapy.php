
		<link rel="stylesheet" type="text/css" href="../assets/css/component.css" />
		<script src="../assets/js/modernizr.custom.js"></script>
		
 
  
<?php
  
session_cache_limiter(FALSE);
session_start();
 
 // echo "1";
 include("../../../connect.php"); 
 
 $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);
  $currentdate =date("Y-m-d"); 					 
$result = mysqli_query($connection, "  
 
  
  SELECT  DATE_FORMAT(a.addedon,'%d-%m-%Y') Added,
  DATE_FORMAT(a.recomendeddate,'%d-%m-%Y')  `recomendeddate` ,c.`consultationname` FROM therapyrecomendation AS a 
JOIN consultationmaster AS c ON a.`therapyid`=c.`consultationid` WHERE paitentid='$PaitentID' AND currentstatus='Pending' ");
 
	
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblRecomendedRherapy' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>            
		<th nowrap width='%'> <a href=\"javascript:SortTable(3,'T');\">Added on</a></th>           
		<th nowrap width='%'> <a href=\"javascript:SortTable(3,'T');\">Recomended Date</a></th>        
		<th nowrap width='%'> <a href=\"javascript:SortTable(3,'T');\">Recomended Therapy</a></th>
	</tr> </thead> <tbody  id='tblRecomendedRherapyBody'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td  >$SerialNo</td>
  <td nowrap > $data[0]</td>
  <td nowrap   >$data[1]</td>  
   <td  nowrap >$data[2]</td> </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    

?>

	<script src="../assets/js/classie.js"></script>
		<script src="../assets/js/modalEffects.js"></script>