<?php
  
session_cache_limiter(FALSE);
session_start();
  
 
  if(isset($_POST["TutorCode"]))
{
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	
 $TutorCode = mysqli_real_escape_string($connection, $_POST["TutorCode"]);  
 
$result = mysqli_query($connection, " 
SELECT  DATE_FORMAT(a.paymentdate, '%d-%b-%y') AS paymentdate, 
b.tutorname,c.batchname,d.paymentmode,SUM(paymentamount) AS paymentamount  FROM tutorpaymentdetails AS a
JOIN tutormaster AS b ON a.tutorcode = b.tutorcode 
JOIN batchmaster AS c ON a.batchcode=c.batchcode
JOIN paymentmodemaster AS d ON a.paymentmode = d.paymentmodecode 
WHERE a.tutorcode ='$TutorCode'
GROUP BY DATE_FORMAT(a.paymentdate, '%d-%b-%y'), 
b.tutorname,c.batchname,d.paymentmode
  ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='tblBatch' name='tblBatch'   >";
echo " <thead><tr>  
		<th>S. No</th>     
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Payment Date</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Name</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Batch</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Mode</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Amount</a></th>          
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td> 
  <td width='%' >$data[0]</td>  
  <td width='%' >$data[1]</td>  
   <td width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>        
   <td align='center' width='%' style='color:#009ad9'  onclick='GetPointID(this)' hidden><i class='fa fa-2x fa-edit'></i></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
}

?>