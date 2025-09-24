 <?php
  include("../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();
  
  $currentdate = date("Y-m-d H:i:s");
  $DiseaseID = mysqli_real_escape_string($connection, $_POST["DiseaseID"]);    

  $result = mysqli_query($connection, " SELECT mappingid,diagnosis FROM diseasemapping AS a 
  JOIN diagnosismaster AS b ON a.conceptid=b.diagnosisid and a.conceptname='Diagnosis' AND a.diseaseid='$DiseaseID'");
  
  echo "  <thead><tr>       
		<th width='%' hidden> ID </th>        
		</tr> </thead> <tbody  id='tblCustomerListforCollection'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr> 
  <td width='%' hidden id='ID' >$data[0]</td>
  <td width='%' id='Name' >$data[1] <i style='color:red;cursor: pointer;' 
  class='fa fa-times'onclick='DeleteConceptItem($data[0])'></td>          
  </tr>"; 

    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
  } 
  ?>