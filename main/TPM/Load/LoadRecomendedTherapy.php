 
<?php
   include("../../../connect.php"); 
session_cache_limiter(FALSE);
session_start();
  
  $PaitentID = mysqli_real_escape_string($connection, $_POST["PaitentID"]); 
 
  
 // echo "1";

  $currentdate =date("Y-m-d"); 	
     
  
								$result = mysqli_query($connection, " 
								
SELECT a.therapyid,DATE_FORMAT(a.recomendeddate,'%d-%m-%Y')  `recomendeddate`,
b.`username`,c.`consultationname`,a.sitting,currentstatus FROM therapyrecomendation AS a 
JOIN usermaster as b ON a.`doctorid`=b.`userid`
JOIN consultationmaster AS c ON a.`therapyid`=c.`consultationid`
WHERE a.paitentid ='$PaitentID'
GROUP BY a.therapyid,DATE_FORMAT(a.recomendeddate,'%d-%m-%Y') ,
b.`username`,c.`consultationname`,a.sitting,currentstatus
 
");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>         	
		<th hidden width='%'>ID</th>         	
		<th width='%'> Recomended Date</th>   
		<th width='%'>  Assigned Doctor </th> 
		<th width='%'> Therapy </th> 		
		<th width='%'> Sitting </th> 		
		<th width='%'> Status </th> 		
		<th  width='%'>  </th> 		
		 
		</tr> </thead> <tbody id='myTableRecomendedTherapy'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden width='%' >$data[0]</td>
  <td    width='%'>$data[1]</td>  
  <td    width='%'>$data[2]</td>  
  <td    width='%'>$data[3]</td>  
  <td    width='%'>$data[4]</td>  
  <td    width='%'>$data[5]</td>  

   <td  align='center' width='%'  onclick='DeleteRecomendedTherapy(this)' >
   <i class='fa fa-2x fa-trash-o text-danger' style='cursor:pointer'></i>
   </td>  
    
     
   
   ";
    
  echo "</tr>";
  
 
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
 
    usleep(200000)
	
								?>
    
 