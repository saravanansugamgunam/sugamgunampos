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
    $result = mysqli_query($connection, "  SELECT symptomsid,symptoms,COUNT(medicineid)
    FROM symptomsmaster AS a LEFT JOIN symptomsmedicinemapping AS b 
    ON a.`symptomsid`=b.`symptomid`  GROUP BY  symptomsid,symptoms  order by symptoms");
  }
  else  if($ID==1)
  {
    $result = mysqli_query($connection, "  SELECT symptomsid,symptoms,COUNT(medicineid)
    FROM symptomsmaster AS a LEFT JOIN symptomsmedicinemapping AS b 
    ON a.`symptomsid`=b.`symptomid`  GROUP BY  symptomsid,symptoms having COUNT(medicineid) > 0 order by symptoms");
  }
  else  if($ID==2)
  {
    $result = mysqli_query($connection, "  SELECT symptomsid,symptoms,COUNT(medicineid)
    FROM symptomsmaster AS a LEFT JOIN symptomsmedicinemapping AS b 
    ON a.`symptomsid`=b.`symptomid`  GROUP BY  symptomsid,symptoms  having COUNT(medicineid) = 0 order by symptoms");
  }



  //echo "<table id='tblProject' class='tblMasters'>";
  echo "  
 
  <table id='data-table'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
  echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th width='%' hidden> ID </th>    	
		<th width='%'> Symptoms </th>      
		<th width='%'> Add / View Medicine </th>      
		<th width='%'>  Edit </th>      
		<th width='%'>  Delete </th>      
		</tr> </thead> <tbody  id='tblCustomerListforCollection'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td width='%' hidden id='ID' >$data[0]</td>
  <td width='%' id='Name' >$data[1]</td>
  <td   style='text-align: center; vertical-align: middle;' >
  <a href='#ModalAddMedicine' data-toggle='modal'
  onclick='LoadMedicineList($data[0])' class='btn btn-sm btn-success btn-xs' >Add Medicine ($data[2]) </a>  </a>
 </td> 
 <td width='%' onclick='GetRowID(this);'>
 <a href='#' class='btn btn-sm btn-info btn-xs' >Edit</a></td> 
      
   <td width='%' onclick='DeleteSymptoms($data[0]);'>
   <a href='#' class='btn btn-sm btn-danger btn-xs' >Delete</a></td>    
  </tr>";


    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody></table>";
  ?>