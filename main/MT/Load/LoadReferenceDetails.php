<script>
$(document).ready(function() {
    $("#txtSearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#ProjectTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>


<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Dummy"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 echo   "<input type='text' class='form-control' placeholder='Search...' id='txtSearch'
 name='txtSearch' />";

$result = mysqli_query($connection, "
SELECT referenceid,reference,medicinepercent,consultingpercent,therapypercent,coursepercent,
referencestatus FROM referencemaster  order by reference ");
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='myTable' name='tblDoctorMaster'   >";
echo " <thead><tr>  
		<th>#</th>  
		<th hidden>Code</th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Reference</a></th>        
    <th width='%'><a href=\"javascript:SortTable(2,'T');\">Med&nbsp;%</a></th>     
    <th width='%'><a href=\"javascript:SortTable(2,'T');\">Cons&nbsp;%</a></th>     
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Therapy&nbsp;%</a></th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Course&nbsp;%</a></th>    
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
  <td id='DoctorGender' width='%'>$data[3]</td>  
  <td id='DoctorGender' width='%'>$data[4]</td>    
  <td id='DoctorGender' width='%'>$data[5]</td>    
   
  <td width='%' >
  
  <input type='button' class='btn btn-sm btn-success' onclick='LoadPercentDetais($data[0]);' value='Edit'> 
  </td>  
  
  
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    
}

?>