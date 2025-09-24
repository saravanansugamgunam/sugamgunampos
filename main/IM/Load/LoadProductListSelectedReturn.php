<style>
table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: orange;
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
  font-size: 12px;
  font-weight: normal;
  color: #FFFFFF;
  border-left: 1px solid #D0E4F5;
   padding: 5px 10px;
  
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot {
  font-size: 12px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
}
table.blueTable tfoot td {
  font-size: 12px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 5px;
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
SELECT itemid, shortcode,saleqty, mrp,discountamount,((saleqty* mrp) - discountamount) AS Total
  FROM saleitems WHERE  invoiceno ='$Invoice' ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblPaymentItems' class='blueTable'>";
echo " <thead><tr>  
		<th>S.No</th>     
		<th hidden width='%'> Item ID</th>    
		<th width='%'> Code </th>    
		<th width='%'> Qty </th>    
		<th width='%'> MRP </th>    
		<th width='%'> Disc. </th>    
		<th width='%'> Total </th>    
		<th width='%'>  Return </th>    
		 
		 
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
  <td  width='%' >$data[3]</td>       
  <td  width='%' >$data[4]</td>       
  <td  width='%' >$data[5]</td>        
    <td align='center' style='color:#009ad9' >
    <button  class='btn btn-sm btn-danger btn-xs' onclick='CancellBill(".$data[0].");' >Return</button></td> 
    
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
    
	echo "<hr>";

?>