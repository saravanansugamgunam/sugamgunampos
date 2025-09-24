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

  $result = mysqli_query($connection, "  SELECT pathologyid,pathology 
 								FROM pathologymaster   order by pathology");

  //echo "<table id='tblProject' class='tblMasters'>";
  echo "  
 
  <table id='data-table'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
  echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th width='%' hidden> ID </th>    	
		<th width='%'> Pathology </th>      
		<th width='%'>  Edit </th>      
		</tr> </thead> <tbody  id='tblCustomerListforCollection'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td width='%' hidden id='ID' >$data[0]</td>
  <td width='%' id='Name' >$data[1]</td>      
   <td width='%' onclick='GetRowID(this);'>
   <a href='#' class='btn btn-sm btn-info btn-xs' >Edit</a></td>    
  </tr>";


    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody></table>";
  ?>