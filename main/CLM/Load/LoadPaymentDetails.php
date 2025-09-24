<style>
table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 1px 1px;
    text-align: center;
}
table.blueTable tbody td {
  font-size: 13px;
   text-align: center;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #83b3e4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 1px solid #444444;
}
table.blueTable thead th {
  font-size: 14px;
  font-weight: normal;
  color: #FFFFFF;
  border-left: 1px solid #D0E4F5;
   padding: 5px 20px;
  
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
}
table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
 


</style>
<?php
  
session_cache_limiter(FALSE);
session_start();
  
 if(isset($_POST["Invoice"]))
{
  
  // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	
 $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);
 
$result = mysqli_query($connection, " 
SELECT paymentid,b.paymentmode, SUM(amount) AS Amount FROM salepaymentdetails AS a JOIN paymentmodemaster AS b
ON a.paymentmode = b.paymentmodecode  WHERE invoiceno ='$Invoice' GROUP BY b.paymentmode,paymentid
 ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblPaymentItems' class='blueTable'>";
echo " <thead><tr>  
		<th>S.No</th>     
		<th hidden width='%'> Payment ID</th>    
		<th width='%'> Mode </th>    
		<th width='%'> Amount </th>    
		<th width='%'>  Delete </th>    
		 
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td  hidden> $data[0]</td>
  <td  width='%' >$data[1]</td>       
  <td  width='%' >$data[2]</td>       
   <td align='center' width='%' style='color:red'  onclick='GetPointID(this)' ><i class='fa fa-2x fa-trash' style='cursor:pointer'></i></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
    

?>