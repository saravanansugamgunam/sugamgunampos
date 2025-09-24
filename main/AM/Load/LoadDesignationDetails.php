
<script>
$(document).ready(function(){
  $("#txtDesignationsdfdsf").on("keyup", function() {
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
  
//insert.php
if(isset($_POST["Dumy"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 
$result = mysqli_query($connection, "SELECT id,designation,activestatus FROM designationmaster where id not in ('8','9')  order by designation ");
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='myTable' name='tblDoctorMaster'   >";
echo " <thead><tr>  
		<th>S. No</th>  
		<th hidden>Code</th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Designation</a></th>     
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Status</a></th>     
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden id='DoctorID'>$data[0]</td>
  <td id='Doctor' width='%'>$data[1]</td>  
  <td id='DoctorGender' width='%'>$data[2]</td>   
  <td width='%' >
  
  <input type='button' class='btn btn-sm btn-success' onclick='GetDesitnationDetails($data[0]);' value='Edit'> 
  </td>  
  
  
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    
}

?>