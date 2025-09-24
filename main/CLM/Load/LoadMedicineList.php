 <script>
$(document).ready(function() {
    // $("#myInput").on("keyup", function() {
    $("#txtSearchCustomer").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tblCustomerListforCollection tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
 </script>

 <?php
  include("../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();



  // echo "1";

  $currentdate = date("Y-m-d H:i:s");
  $ID = mysqli_real_escape_string($connection, $_POST["ID"]); 
  if($ID==0)
  {
    $result = mysqli_query($connection, " 
SELECT productid,uniquebarcode,category,productshortcode,productname,medicinebase, STATUS,
COUNT(alternatebarcode)AS AlternateMedicine FROM productmaster AS a 
LEFT JOIN alternate_medicines AS b ON a.`uniquebarcode`= b.`parentbarcode`
WHERE uniquebarcode>10000 and uniquebarcode <>'10282' GROUP BY 
productid,uniquebarcode,category,productshortcode,productname,medicinebase, STATUS
ORDER BY  productshortcode
");
  }
  else  if($ID==1)
  {
    $result = mysqli_query($connection, " 
    SELECT productid,uniquebarcode,category,productshortcode,productname,medicinebase, STATUS,
COUNT(alternatebarcode)AS AlternateMedicine FROM productmaster AS a 
LEFT JOIN alternate_medicines AS b ON a.`uniquebarcode`= b.`parentbarcode`
WHERE uniquebarcode>10000 and uniquebarcode <>'10282' GROUP BY 
productid,uniquebarcode,category,productshortcode,productname,medicinebase, STATUS
having COUNT(alternatebarcode) > 0
ORDER BY  productshortcode");
  }
  else  if($ID==2)
  {
    $result = mysqli_query($connection, " 
    SELECT productid,uniquebarcode,category,productshortcode,productname,medicinebase, STATUS,
COUNT(alternatebarcode)AS AlternateMedicine FROM productmaster AS a 
LEFT JOIN alternate_medicines AS b ON a.`uniquebarcode`= b.`parentbarcode`
WHERE uniquebarcode>10000 and uniquebarcode <>'10282' GROUP BY 
productid,uniquebarcode,category,productshortcode,productname,medicinebase, STATUS
having COUNT(alternatebarcode) = 0
ORDER BY  productshortcode");
  }



  //echo "<table id='tblProject' class='tblMasters'>";
  echo "  
 
  <table id='data-table'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
  echo " <thead><tr>  
		<th  width='%'>S.No</th>      
		<th width='%' hidden> Barcode </th>   
		<th width='%'> System </th>   
		<th width='%'> Category </th>  
		<th width='%'> Product </th> 
		<th width='%'> Status </th>  
    
    
		<th width='%'> Add / View Alternate </th>      
		<th width='%'>   Add / View Symptoms </th>        
		</tr> </thead> <tbody  id='tblCustomerListforCollection'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td width='%'  id='ID' hidden >$data[1]</td>
  
  <td width='%' id='Name' >$data[5]</td>
  <td width='%' id='Name' >$data[2]</td>
  <td width='%' id='Name' >$data[3]<br>$data[4]</td>
  <td width='%' id='Name' nowrap >$data[6]</td> 

  <td   style='text-align: center; vertical-align: middle;' >
  <a href='#ModalAddMedicine' data-toggle='modal'
  onclick='LoadMedicineList($data[1])' class='btn btn-sm btn-success btn-xs' >Alt. Medicine ($data[7]) </a>  </a>
 </td>   

   <td   style='text-align: center; vertical-align: middle; cursor:not-allowed;'  >
  <a  disabled
  onclick='LoadMedicineList($data[1])' class='btn btn-sm btn-warning btn-xs' >Alt. Symptoms (0) </a>  </a>
 </td>   

  </tr>";


    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody></table>";
  ?>