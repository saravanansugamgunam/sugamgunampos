<script>
$(document).ready(function(){
  $("#txtCategory").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#indextable tr").filter(function() {
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
 
$result = mysqli_query($connection, "SELECT id, name,categorystatus FROM   category ");
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='indextable' name='tblCategoryMaster'   >";
echo " <thead><tr>  
		<th>S. No</th>  
		<th hidden>Code</th>    
		<th width='50%'><a href=\"javascript:SortTable(2,'T');\">Name</a></th>     
		<th width='50%'><a href=\"javascript:SortTable(3,'T');\">Status</a></th>     
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden id='CategoryID'>$data[0]</td>
  <td id='Category' width='50%'>$data[1]</td>  
  <td id='CategoryStatus' width='40%'>$data[2]</td>  
  
  <td width='40%' onclick='GetRowID(this);'><a href='#myModalReturn' class='btn btn-sm btn-danger btn-xs' data-toggle='modal'>Edit</a></td>  
  
  
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    
}

?>