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
$result = mysqli_query($connection, "
 SELECT DATE_FORMAT(a.paymentdate, '%d-%b-%y') as paymentdate,b.coursename, c.batchname,d.paymentmode,
  paymentamount AS Payment,invoiceno FROM      paymentdetails  AS a 
 JOIN studentbatchmapping AS b ON  a.studentcode = b.studentcode AND
 a.batchcode = b.batchcode JOIN batchmaster AS c ON a.batchcode = c.batchcode 
 JOIN `paymentmodemaster` AS d ON a.paymentmodeid = d.`paymentmodecode`
 WHERE b.`studentcode` ='$StudentCode' order by a.paymentdate");
 //echo "<table id='tblProject' class='tblMasters'>";
 
  echo " <table class='table table-fixed table-striped' id='tblBatch' name='tblBatch'   >";
  echo " <thead><tr>  
		<th>S. No</th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\"> Payment Date</a></th>   
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Course</a></th>       
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Batch</a></th>   
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Mode</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Fees Paid</a></th>   
    <th width='%'> <a href=\"javascript:SortTable(3,'T');\">Print</a></th> 
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
   <td width='%'>
   <a href='ReceiptPrint.php?invoice=$data[5]' target='_blank' ?>
<i class='fa fa-print  fa-lg m-r-5'></i></a>
</td>

</tr>";

}
echo "</tbody>
</table>";


}

?>