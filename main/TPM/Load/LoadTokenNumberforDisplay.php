 


<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Dumy"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 
 
$result = mysqli_query($connection, "SELECT tokennumber,paitentname FROM  tokenmaster AS a JOIN paitentmaster AS b 
ON a.`paitentcode`=b.`paitentid` WHERE a.`date` =CURRENT_DATE 
AND tokenstatus ='Open' AND doctorid ='2' AND tokennumber IN (
SELECT MIN(tokennumber) FROM  tokenmaster AS a JOIN paitentmaster AS b 
ON a.`paitentcode`=b.`paitentid` WHERE a.`date` =CURRENT_DATE 
AND tokenstatus ='Open' AND doctorid ='2' )");
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='indextable' name='tblPatientMaster'  style='width:70%;' >";
echo " <thead><tr>  
		<th nowrap>S. No</th>  
		 
		<th nowrap> Token</a></th>     
		<th nowrap> Name</a></th>     
		 </tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden id='PatientID'>$data[0]</td>
  <td id='Patient' width='0%'>$data[1]</td>   
  
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    
}

?>