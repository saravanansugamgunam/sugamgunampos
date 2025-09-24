<script src="../assets/Custom/IndexTable.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
 
 <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tblSalesDetail tr").filter(function() {
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
  $currentdate =date("d-m-Y h:i A"); 
 $Type = mysqli_real_escape_string($connection, $_POST["Type"]); 
  $LocationCode = $_SESSION['SESS_LOCATION'];
   
// $ActualToDate =  date('Y-m-d', strtotime("+1 day", strtotime($ActualToDate)));

function formatMoney($number, $fractional=false) {
					if ($fractional) {
						$number = sprintf('%.2f', $number);
					}
					while (true) {
						$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
						if ($replaced != $number) {
							$number = $replaced;
						} else {
							break;
						}
					}
					return $number;
				}
				
 if ($Type=='Detail')
 { 
  
$result = mysqli_query($connection, " 
SELECT suplier_id,suplier_name,contact_person,suplier_contact,topay,paid,topay-paid FROM supliers
  where (topay-paid) > 1 order by 2 

  ");
  // WHERE c.locationcode ='$LocationCode' 

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblOutstanding' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>        
		<th hidden width='%'> Supplier Code </th>    
		<th width='%' > Supplier Name </th>    
		<th  width='%'> Contact Person</a></th>    
		<th width='%'> Contact No</th>     
		<th width='%' > Credit</th>           
		<th width='%'> Debit </th>         
		<th  width='%'> Balance </th>         
		       
		</tr> </thead> <tbody id='tblSalesDetail' >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden >$data[0]</td>
  <td  >$data[1]</td>  
   <td  id='PaitientName' width='%'>$data[2]</td>   
   <td  id='MobileNo' width='%'>$data[3]</td>     
   <td  width='%' style='text-align:right;'>$data[4]</td>     
   <td  id='Outstandingcredit' width='%'style='text-align:right;' > $data[5]</td>   
   <td  id='Outstanding' width='%'style='text-align:right;' > $data[6]</td>   
   <td width='%' style='text-align:center;' onclick='Payment(this);' >
   
   <button  class='btn btn-sm btn-primary btn-xs m-r-5' data-toggle='modal' data-target='#myModalPayment' 
	 >Pay</button> </td>
	 
    <td width='%'  onclick='SendSMS(this);' > <button  class='btn btn-sm btn-success btn-xs m-r-5'   > Send SMS </button></td>
	<td width='%' onclick='GetID(this);' > 
	<a href='#modalEmail' class='btn btn-sm btn-success' data-toggle='modal'>Email</a>
	 </td>
  </tr>";
      
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
 }
 ?> 
 							
							<div style="display:none;">
							<div class="table-responsive" id='DivPrint' >
							 <label> <h4>Outstanding Report - <?php echo "As on " . $currentdate ;?></h4></label>
							 <?php
$result = mysqli_query($connection, " 
SELECT suplier_id,suplier_name,contact_person,suplier_contact,topay,paid,topay-paid FROM supliers
  where (topay-paid) >0 order by 2 
  
  ");
  // WHERE c.locationcode ='$LocationCode' 

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='PrintTable'  border='1' style='border-collapse:collapse;' width='100%'>";
echo " <thead><tr>  
		<th>S.No</th>          
	 
    <th>S.No</th>        
		<th hidden width='%'> Supplier Code </th>    
		<th width='%' > Supplier Name </th>    
		<th  width='%'> Contact Person</a></th>    
		<th width='%'> Contact No</th>     
		<th width='%' > Credit</th>           
		<th width='%'> Debit </th>         
		<th  width='%'> Balance </th>       
	        
		</tr> </thead> <tbody id='tblSalesDetail' >";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td>$data[0]</td>
  <td >$data[1]</td>  
   <td  id='PaitientName' width='%'>$data[2]</td>   
   <td  id='MobileNo' width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td  id=' ' width='%'style='text-align:right;' > $data[5]</td>    
   <td  id=' ' width='%'style='text-align:right;' > $data[6]</td> 
  </tr>";
      
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
 
 ?> 
							
							</div>
							</div>
 

