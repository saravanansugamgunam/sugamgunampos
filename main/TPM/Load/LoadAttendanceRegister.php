<script src="../assets/Custom/IndexTable.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
 
 
 <script>
 

// function myFunction() {
  // var input, filter, table, tr, td, i, txtValue;
  // input = document.getElementById("txtItemSearch");
  // filter = input.value.toLowerCase();
  // $("#tblItemwise tr").filter(function() {
      // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    // });
	// alert(1);
// }

// $(document).ready(function(){
  // $("#txtItemSearch").on("keyup", function() {
    // var value = $(this).val().toLowerCase();
	// alert(2);
    // $("#tblItemwise tr").filter(function() {
      // $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    // });
  // });
  </script>

<?php
  
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 			
 $FromDate = mysqli_real_escape_string($connection, $_POST["FromDate"]); 
 $ToDate = mysqli_real_escape_string($connection, $_POST["ToDate"]); 
   
    $FromDate = explode('/', $FromDate); 
$ActualFromDate = $FromDate[2].'-'.$FromDate[1].'-'.$FromDate[0];
 $ToDate = explode('/', $ToDate); 
$ActualToDate = $ToDate[2].'-'.$ToDate[1].'-'.$ToDate[0];

// $result = mysqli_query($connection, " 
  // SELECT saleuniqueno,CONCAT(invoiceno,'-',saleid) AS Bill,DATE_FORMAT(saledate,'%d-%m-%Y'), CONCAT(b.paitentname,' (',b.mobileno,')'),
 // saleqty,discountamount,nettamount,received,profitamount,locationcode,a.transactiontype FROM salemaster  AS a
 // JOIN paitentmaster AS b ON a.paitientcode=b.paitentid
 // WHERE saledate BETWEEN '$ActualFromDate' AND '$ActualToDate' and locationcode ='$LocationCode' and a.transactiontype not in('Outstanding','Cancelled') and cancellstatus =0 ");
 
 
 $result = mysqli_query($connection, " 
 SELECT b.username,DATE_FORMAT(attendancetime,'%d-%m-%Y'),
 DATE_FORMAT(DATE_ADD(attendancetime, INTERVAL 330 MINUTE),'%r') 
FROM attendanceregister AS a JOIN usermaster AS b ON a.userid=b.`userid` 
WHERE attendancetime BETWEEN '$ActualFromDate 00:00' AND '$ActualToDate 23:59'
  
 ");
   
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblItemwise' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th  width='%'> User</a></th>    
		<th  width='%'> Date </th>    
		<th width='%'> Time </th>    
		      
		</tr> </thead> <tbody id='tblSalesDetail' >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'> $SerialNo </td>
  <td    > $data[0]</td>
  <td   > $data[1]</td>
  <td >$data[2]</td>  
    
   
  </tr>";
      
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>"; 
	 

?> 