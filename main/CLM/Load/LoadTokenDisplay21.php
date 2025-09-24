 


<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Dumy"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $LocationCode = 3;
  $currentdate =date("Y-m-d H:i:s"); 							  
  $currenttime = date("His"); 
  
   if($currenttime<140001)
  {
$result = mysqli_query($connection, "SELECT tokennumber,paitentname,
(SELECT paitentnamedisplay FROM tokensettings  where clientid ='$LocationCode') AS DisplayName FROM  tokenmaster AS a JOIN paitentmaster AS b 
ON a.`paitentcode`=b.`paitentid` WHERE a.`date` =CURRENT_DATE 
AND tokenstatus ='Open' AND doctorid ='2' and a.createdon < 140001  and locationcode='$LocationCode'   ORDER BY revisedtokennumber LIMIT 5 OFFSET 1");
}
   else
  {
	  $result = mysqli_query($connection, "SELECT tokennumber,paitentname,
(SELECT paitentnamedisplay FROM tokensettings  where clientid ='$LocationCode') AS DisplayName FROM  tokenmaster AS a JOIN paitentmaster AS b 
ON a.`paitentcode`=b.`paitentid` WHERE a.`date` =CURRENT_DATE 
AND tokenstatus ='Open' AND doctorid ='2'  AND createdon > 140000  and locationcode='$LocationCode'   ORDER BY revisedtokennumber LIMIT 5 OFFSET 1");
  }
  
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed  id='indextable' name='tblPatientMaster'  style='width:70%;' >";
echo " <thead><tr>    
		 
		<th  style='font-size: 20px;' nowrap> Next Tokens </th> 
    </tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr> 
  <td  nowrap id='PatientID'  style='font-size: 30px;'>$data[0]</td>";
  if($data[2]==1)
  {
 echo " <td nowrap id='Patient' width='0%'  style='font-size: 30px;'>$data[1]</td>  ";
  }
 echo " </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
     
    
}

?>