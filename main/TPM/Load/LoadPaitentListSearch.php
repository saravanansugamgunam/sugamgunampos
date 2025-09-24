 


<script>
$(document).ready(function(){
  // $("#myInput").on("keyup", function() {
  $("#myInput").on("keyup", function() {
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
if(isset($_POST["Dumy"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 echo " <input type='text' name='myInput' id='myInput' class='form-control'  placeholder='Search...'  />";    
  
$result = mysqli_query($connection, "SELECT paitentid, paitentname,gender,
DATE_FORMAT(dob ,'%d-%m-%Y') dob ,mobileno,email,whatsappno FROM   paitentmaster  order by paitentname
  ");
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='indextable' name='tblPatientMaster'   >";
echo " <thead><tr>  
		<th>S. No</th>  
		<th hidden>Code</th>    
		<th width='0%'><a href=\"javascript:SortTable(2,'T');\">Name</a></th>     
		<th width='0%'><a href=\"javascript:SortTable(2,'T');\">Gender</a></th>     
		<th width='0%'><a href=\"javascript:SortTable(2,'T');\">DOB</a></th>     
		<th width='0%'><a href=\"javascript:SortTable(3,'T');\">Mobile No</a></th>     
		<th width='0%'><a href=\"javascript:SortTable(4,'T');\">Email ID</a></th>     
		<th width='0%'><a href=\"javascript:SortTable(5,'T');\"></a></th>       
		 
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden id='PatientID'>$data[0]</td>
  <td id='Patient' width='0%'>$data[1]</td>  
  <td id='PaitentGender' width='0%'>$data[2]</td>  
  <td nowrap id='PaitentDOB' width='0%'>$data[3]</td>  
  <td id='PatientMobile' width='0%'>$data[4]</td>  
  <td id='PatientEmail' width='0%'>$data[5]</td>    
  <td width='0%' onclick='GetRowID(this);'><a href='PaitentHistoryView.php?PID=$data[0]&INV=0&TID=0&S=O&MID=52' 
  class='btn btn-sm btn-success btn-xs' data-toggle='modal'>View</a></td>  
  
  
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    
}

?>