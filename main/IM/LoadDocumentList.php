 <script>
$(document).ready(function() {
    // $("#myInputDocument").on("keyup", function() {
    $("#myInputDocument").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTableDocument tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
<?php
   include("../connect.php"); 
session_cache_limiter(FALSE);
session_start();
  
  $GRNNumber = mysqli_real_escape_string($connection, $_POST["GRNNumber"]); 
 
  
 // echo "1";

  $currentdate =date("Y-m-d H:i:s"); 	
 echo " <input type='text' name='myInputDocument' id='myInputDocument' class='form-control'  placeholder='Search...'  />";    
  
								$result = mysqli_query($connection, " 

                SELECT documentname,documentpath FROM documentmaster WHERE documentfor ='Purchase' AND documentreference ='$GRNNumber'
 
 
");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table'  border='1' style='border-collapse:collapse;'  
  class='table table-striped table-bordered' width='80%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th width='%'>  Name </th> 
		<th width='%'> View </th> 		
		 
		</tr> </thead> <tbody id='myTableDocument'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td  width='%' >$data[0]</td>  
   <td ><a href='$data[1]'  target='_blank'    >View</a></td>
    
   
   
   ";
    
  echo "</tr>";
  
 
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
								?>