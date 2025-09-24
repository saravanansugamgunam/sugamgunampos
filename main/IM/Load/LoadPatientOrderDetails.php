
		<link rel="stylesheet" type="text/css" href="../assets/css/component.css" />
		<script src="../assets/js/modernizr.custom.js"></script>
		
 

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>

<?php
  
session_cache_limiter(FALSE);
session_start();
 
 // echo "1";
 include("../../../connect.php"); 
 
 $OrderStatus = mysqli_real_escape_string($connection, $_POST["OrderStatus"]);
  $currentdate =date("Y-m-d"); 					 
$result = mysqli_query($connection, "  
 SELECT orderid, DATE_FORMAT(orderdate,'%d-%m-%Y')  as orderdate,b.paitentname,b.mobileno,concat(c.productshortcode,'-',c.productname) as product,a.qty,a.advance,a.remarks,a.orderstatus, DATE_FORMAT(a.invoicedate,'%d-%m-%Y')  as invdate,a.invoiceno  
 FROM paitientorder AS a JOIN paitentmaster AS b ON a.paitentid = b.paitentid JOIN productmaster AS c ON a.productcode= c.productid where a.orderstatus ='$OrderStatus'");
echo " <input type='text' name='myInput' id='myInput' class='form-control'  placeholder='Search...'  />";
	
 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblPaitientOrders' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th hidden width='%'><a href=\"javascript:SortTable(2,'T');\">Order ID</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Date</a></th>           
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Paitent Name</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Mobile No</a></th>           
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Product</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Qty</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Advance</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Remarks</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Status</a></th>";
		if($OrderStatus=='Delivered')
  {
echo "<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Del.Date</a></th>        
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Ref.no</a></th>";
  }
  
        
		 if($OrderStatus=='Open' || $OrderStatus=='Purchased')
  {
	  echo "<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Cancel</a></th>";
  }
		 
		 
		 
		echo "</tr> </thead> <tbody  id='myTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td  >$SerialNo</td>
  <td hidden nowrap > $data[0]</td>
  <td nowrap   >$data[1]</td>  
   <td   width='25%'>$data[2]</td>   
   <td nowrap width='%'>$data[3]</td>     
   <td nowrap width='%'>$data[4]</td>     
   <td nowrap width='%'>$data[5]</td>      
   <td nowrap width='%'>$data[6]</td>      
   <td  width='%'>$data[7]</td>      
   <td nowrap width='%'>$data[8]</td> 
   
   ";    
  if($OrderStatus=='Open' || $OrderStatus=='Purchased')
  {
echo "<td>
<a href='#modal-dialog' class='btn btn-sm btn-danger' data-toggle='modal'
 onclick='LoadOrderID(".$data[0].");'><i class='fa fa-times-circle'></i></a>
 

  </td>";
  }
    if($OrderStatus=='Delivered')
  {
echo "<td nowrap width='%'>$data[9]</td> ";
echo "<td nowrap width='%'>$data[10]</td> ";
  }
	 
    
  echo "</tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    

?>

	<script src="../assets/js/classie.js"></script>
		<script src="../assets/js/modalEffects.js"></script>