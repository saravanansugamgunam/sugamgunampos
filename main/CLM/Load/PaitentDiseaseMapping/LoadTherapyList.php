 <?php
  include("../../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();
  
  $currentdate = date("Y-m-d");
  $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]);  
  $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]);    

  $ClientID = $_SESSION["SESS_LOCATION"];
  

  $result = mysqli_query($connection, "  SELECT mappingid,consultationname,
  duration,conditionname,condmanual,instructiontotherapist  FROM diseasemapping_paitent AS a 
  JOIN consultationmaster AS b ON a.conceptid=b.`consultationid` AND a.conceptname='Therapy' 
  AND a.paitientid='$PaitentID'
  left JOIN medicineprescriptioncondition AS c ON   c.conditionid = a.cond 
  where diseasemappinguniqueid='$UniqueID' order by mappingid");
  
  
  
  echo "  <table class='table'><thead><tr>       
		<th width='%' hidden> ID </th>        
		<th width='%' > Therapy </th>        
		<th width='%' > Sittings </th >      
		<th width='%' > Condition </th>       
		<th width='%' > Frequency </th>       
		<th width='%' > Instruction </th>     
		<th width='%' >  </th>        
		</tr> </thead> <tbody  id='tblCustomerListforCollection'>";


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
    <td width='%'  id='ID' >$data[2]</td>
    <td width='%'  id='ID' >$data[3]</td>  
    <td width='%'  id='ID' >$data[4]</td> 
    <td width='%'  id='ID' >$data[5]</td>  
    <td width='%'  id='ID' >
    <button class='btn btn-success' onclick='UpdateTherapyIDEdit($data[0]);'><i class='fa fa-pencil'></i>  </button> </td>
     
    </tr>";  
    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>"; 
  } 
  ?>