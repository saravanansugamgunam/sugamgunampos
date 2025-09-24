<?php
   include("../../../connect.php"); 
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";

  $currentdate =date("Y-m-d H:i:s"); 					 
  
								$result = mysqli_query($connection, "  SELECT consultingtype,consultationname,
                consultationcharge,activestatus,consultationid,totalminutes
 								FROM consultationmaster where consultingtype ='Therapy'  order by activestatus,consultationname");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th width='%'> Type </th>    	
		<th width='%'> Consultation</th>    
		<th width='%'> Fees </th>    
		<th width='%'> Duration(Min) </th>    
		<th width='%'>  Status </th>      
		<th width='%' hidden>  ID </th>      
		<th width='%'>  Edit </th>      
		</tr> </thead> <tbody>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td width='%' id='Type' >$data[0]</td>
  <td width='%' id='Name' >$data[1]</td>  
   <td width='%' id='Fee' >$data[2]</td>     
   <td width='%' id='Duration' >$data[5]</td>     
   <td width='%' id='Status' >$data[3]</td>     
   <td width='%' id='ID' hidden >$data[4]</td>     
   <td width='%' onclick='GetRowID(this);'>
   <a href='#' class='btn btn-sm btn-info btn-xs'  >Edit</a></td>    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
