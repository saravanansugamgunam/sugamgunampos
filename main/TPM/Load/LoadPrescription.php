<script>
$(document).ready(function(){
  // $("#myInputDocument").on("keyup", function() {
  $("#myInputDocument").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTableDocument tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<style>
p.ridge {border-style: ridge;}

</style>
<?php
   include("../../../connect.php"); 
session_cache_limiter(FALSE);
session_start();
  
  $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]); 
  $PrescriptionID = mysqli_real_escape_string($connection, $_POST["PrescriptionID"]); 
 
  
 // echo "1";

  $currentdate =date("Y-m-d H:i:s"); 	 
								$result = mysqli_query($connection, " 
								
SELECT a.id,DATE_FORMAT(a.createddate,'%d-%m-%Y') as date,b.username,a.prescription,a.documentlink FROM prescriptionmaster AS a JOIN usermaster as b ON a.doctorid=b.userid WHERE paitentid ='$PaitentID'
and id='$PrescriptionID' 
");
  
 
 
while($data = mysqli_fetch_row($result))
{
  echo "<p>Date:&nbsp;&nbsp;<b>";
  echo $data[1]; 
  echo "</b></p>";
  echo "<p>Doctor:&nbsp;&nbsp;<b>";
  echo $data[2]; 
  echo "</b></p>";
  echo "Prescription:<br>";
  
  if($data[4]=='-')
  {
  echo " <pre>";
  echo $data[3];
  echo "</pre>";
  }
  else
  {
  echo " <pre>";
  echo " <img src=".$data[4]." alt='Presc' width='600' height='400'> ";
   
  echo "</pre>";
  }
  
  
} 
								?>
    
 