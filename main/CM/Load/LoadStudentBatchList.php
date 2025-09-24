<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Mobileno"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
  $Mobileno = mysqli_real_escape_string($connection, $_POST["Mobileno"]);    
  
  
$result = mysqli_query($connection, "
SELECT DATE_FORMAT(b.batchcommences, '%d-%b-%y') as batchcommences,
a.`coursename`,b.batchcode,b.batchname,a.studentfees,SUM(IFNULL(c.paymentamount,0)) AS Paid, a.studentfees - SUM(IFNULL(c.paymentamount,0)) AS Balance
 FROM studentbatchmapping AS a JOIN batchmaster AS b ON a.batchcode=b.batchcode 
 LEFT JOIN paymentdetails AS c ON b.batchcode=c.batchcode AND a.studentcode=c.studentcode  
 WHERE studentmobileno ='$Mobileno' GROUP BY  b.batchcode,b.batchname,a.studentfees,b.`batchcommences`,a.`coursename`
HAVING  SUM(IFNULL(c.paymentamount,0)) <> a.studentfees ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='tblBatch' name='tblBatch'   >";
echo " <thead><tr>  
		<th>#</th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\"> Date</a></th>   
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Course</a></th>    
		<th width='%' hidden > <a href=\"javascript:SortTable(3,'T');\">Batch Code</a></th>   
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Batch</a></th>   
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Fee</a></th>   
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Paid</a></th>   
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Balance</a></th>   
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Pay</a></th>    
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td> $data[0]</td>
  <td width='%'>$data[1]</td>  
   <td width='%' hidden id ='tblBatchCode'>$data[2]</td>  
   <td width='%' id ='tblBatchName'>$data[3]</td>  
   <td width='%'>$data[4]</td>  
   <td width='%'>$data[5]</td>  
   <td width='%'  id ='tblDueAmount'>$data[6]</td>  
   <td align='center' width='%' style='color:#009ad9'  onclick='GetPointID(this)'><i class='fa fa-2x fa-plus-square'></i></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    
}

?>