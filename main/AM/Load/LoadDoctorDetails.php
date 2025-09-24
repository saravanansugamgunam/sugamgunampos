<script>
$(document).ready(function(){
  $("#txtDoctor").on("keyup", function() {
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
 
$result = mysqli_query($connection, "SELECT userid, username,gender,doctorphone,alternateno,doctoremail,
DATE_FORMAT(dob, '%d/%m/%y') dob,DATE_FORMAT(doj, '%d/%m/%y')  doj,salary,address,activestatus,biometricid  FROM   usermaster");
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='indextable' name='tblDoctorMaster'   >";
echo " <thead><tr>  
		<th>S. No</th>  
		<th hidden>Code</th>    
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Name</a></th>     
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Gender</a></th>     
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Mobile</a></th>     
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Alternate No</a></th>     
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Email</a></th>     
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">DOB</a></th>     
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">DOJ</a></th>     
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Salary</a></th>     
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Address</a></th>     
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Biometric</a></th>     
		<th width='%'><a href=\"javascript:SortTable(3,'T');\">Status</a></th>     
		 
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
  <td id='mobileno' width='%'>$data[3]</td>  
  <td id='DoctorAlternateNo' width='%'>$data[4]</td>  
  <td id='DoctorEmail' width='%'>$data[5]</td>  
  <td id='DoctorDOB' width='%'>$data[6]</td>  
  <td id='DoctorDOJ' width='%'>$data[7]</td>  
  <td id='DoctorSalary' width='%'>$data[8]</td>     
  <td id='DoctorAddress' width='%'>$data[9]</td>     
  <td id='DoctorBiometric' width='%'>$data[11]</td>     
  
  <td width='%' onclick='GetRowID(this);'><a href='#myModalReturn' class='btn btn-sm btn-danger btn-xs' data-toggle='modal'>Edit</a></td>  
  
  
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    
}

?>