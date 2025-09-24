<?php
  include("../../../../connect.php");
  session_cache_limiter(FALSE);
  session_start();
  
  $currentdate = date("Y-m-d");
  $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]); 
  $UniqueID = mysqli_real_escape_string($connection, $_POST["UniqueID"]);   
  $ClientID = $_SESSION["SESS_LOCATION"];
 
  $result = mysqli_query($connection, "
  
  SELECT mappingid,
  CONCAT(productshortcode,'<br> ' ,CONCAT(conditionname,' ',condmanual)),
  CONCAT(mor,' ',IF(mor='','',prescriptionuom)),
   CONCAT(aft,' ',IF(aft='','',prescriptionuom)),
   CONCAT(eve,' ',IF(eve='','',prescriptionuom)),
   CONCAT(nig,' ',IF(nig='','',prescriptionuom)),
  
    CONCAT(IFNULL(d.`duration`,''),' ',condmanualduration),
     CEILING(totalqty/packsize)  
     FROM diseasemapping_paitent AS a 
   JOIN productmaster AS b ON a.conceptid=b.`productid` AND a.conceptname='Medicine'  AND a.paitientid='$PaitentID'
   LEFT JOIN medicineprescriptioncondition AS c ON   c.conditionid = a.cond 
   LEFT JOIN prescriptionduration AS d ON a.`duration`=d.`durationid` 
   WHERE  diseasemappinguniqueid ='$UniqueID'");
  
  
  echo "  <table class='table'><thead><tr>       
		<th width='%' hidden> ID </th>        
		<th width='%' > Medicine </th>        
		<th width='%' > Mor </th>        
		<th width='%' > Aft </th>        
		<th width='%' > Eve </th>        
		<th width='%' > Nig </th>                 
		<th width='%' > Duration </th>        
		<th width='%' > Box </th>        
		<th width='%' >  </th>        
		</tr> </thead> <tbody  id='tblCustomerListforCollection'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo " 

  <tr>
  <td width='%' hidden id='ID' >$data[0]</td>
  <td width='%' id='Name' nowrap>$data[1] </td>
  <td width='%'  id='ID' >$data[2]</td>
  <td width='%'  id='ID' >$data[3]</td>
  <td width='%'  id='ID' >$data[4]</td>
  <td width='%'  id='ID' >$data[5]</td>
  <td width='%'  id='ID' >$data[6]</td>
  <td width='%'  id='ID' style='text-align:center' >$data[7]</td>
   
   
  </tr>"; 

    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>"; 
  } 

  echo "</table>"
  ?>