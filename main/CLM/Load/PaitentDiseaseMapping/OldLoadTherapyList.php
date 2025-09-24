 <?php
  include("../../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();
  
  $currentdate = date("Y-m-d");
  $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);    
  $ClientID = $_SESSION["SESS_LOCATION"];
  

  $result = mysqli_query($connection, "  SELECT mappingid,consultationname  FROM diseasemapping_paitent AS a 
  JOIN consultationmaster AS b ON a.conceptid=b.`consultationid` AND a.conceptname='Therapy' AND a.paitientid='$PaitentID'
  where consultingdate ='$currentdate' and clientid='$ClientID'");
  
  
  echo "  <thead><tr>       
		<th width='%' hidden> ID </th>        
		</tr> </thead> <tbody  id='tblCustomerListforCollection'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo " 
  <tr>
  <td width='%' hidden id='ID' >$data[0]</td>
  <td width='%' id='Name' nowrap>$data[1] <i style='color:red;cursor: pointer;' 
  class='fa fa-times'onclick='DeleteConceptItem($data[0])'></i></td>  
  </tr>"; 

    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>"; 
  } 
  ?>