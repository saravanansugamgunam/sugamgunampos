<script>
$(document).ready(function(){
  // $("#myInput").on("keyup", function() {
  $("#myInputRecomended").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTableRecomended tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<?php
   include("../../../connect.php"); 
session_cache_limiter(FALSE);
session_start();

 
  $currentdate =date("Y-m-d H:i:s"); 	
 echo " <input type='text' name='myInputRecomended' id='myInputRecomended' class='form-control'  placeholder='Search...'  />";    
  
	 
	$result = mysqli_query($connection, "
  select a.saleuniqueno, DATE_FORMAT(a.saledate,'%d-%m-%y') ,concat(a.invoiceno,'-',a.saleid) as Invoice,
  b.paitentname,b.mobileno, a.nettamount,c.username
  From salemaster as a join paitentmaster as b on 
a.paitientcode=b.paitentid left join usermaster as c on a.addedby = c.userid
 where deliverystatus =0 and saledate > '2022-10-25'   AND transactiontype='Sale'
 
");
  

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblTherapyRegisterRecomnded'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th  hidden width='%' > ID </th>    	
		<th nowrap width='%'> Date</th>    
		<th width='%'> Invoice No </th> 
		<th width='%'> Paitent </th> 
    <th width='%'> Mobile No </th> 
    <th width='%'> Bill Amount </th>   
    <th width='%'> View</th> 	
    <th width='%'> Deliver</th> 	 
    <th width='%'> Billed by</th> 	 
		
		";  
		 echo "
		</tr> </thead> <tbody id='myTableRecomended'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden id='BookingID'  width='%' >$data[0]</td>
  <td nowrap id='TherapyDate' width='%'>$data[1]</td>  
   <td id='TherapyTime'  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td  id='TherapyName' width='%'>$data[5]</td> ";   
 
echo "<td align='center' style='color:#009ad9'  >
<a href='SaleBillView.php?invoice=$data[0]' target='_blank' ?>
<i class='fa fa-2x fa-eye' title='View'></i></a></td> ";
 
   echo "<td align='center' style='color:#009ad9'  >
   <a href='ItemDelivery.php?MID=61&invoice=$data[0]' target='_blank' ?>
<i class='fa fa-2x fa-archive' title='View'></i></a></td>
  

<td width='%'>$data[6]</td>       ";

    
  echo "</tr>";
  $SerialNo=$SerialNo+1; 
}
  

 
echo "</tbody></table>";
								?>
    
 