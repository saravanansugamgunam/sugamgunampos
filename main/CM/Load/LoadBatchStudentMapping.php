<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["StudentCode"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
  $StudentCode = mysqli_real_escape_string($connection, $_POST["StudentCode"]);    
$result = mysqli_query($connection, "SELECT a.`studentname`,c.`coursename`,b.`batchname`,
DATE_FORMAT(b.batchcommences, '%d-%b-%y') AS Commences, a.`coursefees`,a.`studentfees` 
FROM studentbatchmapping AS a JOIN `batchmaster` AS b ON a.`batchcode`=b.`batchcode` 
JOIN coursemaster AS c ON a.`coursecode`=c.`coursecode` WHERE a.`StudentCode`='$StudentCode' ");
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='indextable' name='tblProjectMaster'   >";
echo " <thead><tr>  
		<th>S. No</th>  
		<th hidden>Code</th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Student Name</a></th>   
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Course Name</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Batch</a></th>   
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Commence Date</a></th>   
		
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Actual Fee</a></th>   
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Discounted Fee</a></th>   
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Payment Scehdule</a></th>   
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td> $data[0]</td>
  <td width='%'>$data[1]</td>  
   <td width='%'>$data[2]</td>  
   <td width='%'>$data[3]</td>  
   <td width='%'>$data[4]</td>  
   <td width='%'>$data[5]</td>  
   <td align='center' width='%' style='color:#009ad9'><i class='fa fa-2x fa-clock-o'></i></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    
}

?>