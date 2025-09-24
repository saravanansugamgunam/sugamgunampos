<?php
  
session_cache_limiter(FALSE);
session_start();
  
 if(isset($_POST["Invoice"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	
 $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);
 
// $result = mysqli_query($connection, "
// SELECT a.bookingid,a.therapyid,b.consultationname,a.totalsitings,reviseddate,doctorid, a.rate,a.discount,a.nettamount 
// FROM therapybookingdetails_recomended AS a JOIN 
// consultationmaster AS b ON a.therapyid = b.consultationid WHERE bookinguniqueid ='$Invoice' 
// order by therapyid,sitingid,a.bookingid
//  ");

$result = mysqli_query($connection, "
SELECT a.bookingid,a.therapyid,b.consultationname,a.totalsitings,reviseddate,d.timeslot, c.`username`,
 a.rate,a.discount,a.nettamount 
FROM therapybookingdetails  AS a 
JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
JOIN usermaster AS c ON a.doctorid=c.userid left JOIN 
(SELECT bookingitemid,CONCAT(timeslot,' - ',COUNT(timeslot),'Hr') AS timeslot FROM timeslotallocation AS a 
left JOIN timeslotdetails AS b ON a.timeslotid=b.id WHERE uniqueid ='$Invoice'
GROUP BY bookingitemid) AS d ON a.bookingid =d.bookingitemid
WHERE bookinguniqueid ='$Invoice'  and bookingstatus <> 'R-Closed'
GROUP BY a.bookingid,a.therapyid,b.consultationname,reviseddate,c.`username`, a.rate,a.discount,a.nettamount ,d.timeslot
ORDER BY therapyid,sitingid,a.bookingid 
 ");
  

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblBillingItems' class=' table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S. No</th>     
		<th width='%'  ><a href=\"javascript:SortTable(2,'T');\">ID</a></th>        
		<th width='%'  ><a href=\"javascript:SortTable(2,'T');\">Therapy ID</a></th>        
		<th width='%'><a href=\"javascript:SortTable(2,'T');\">Therapy</a></th>     
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Sittings</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Date</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Timing</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Therapist</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Rate</a></th>    
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Discount</a></th>     
		<th width='%'> <a href=\"javascript:SortTable(3,'T');\">Total</a></th>      
		<th width='%'>  Delete </th>   
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td  >$data[0]</td>
  <td width='%'  >$data[1]</td>
  <td  width='%' >$data[2]</td>  
      
   <td width='%'>$data[3]</td>   
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>              
   <td width='%'>$data[6]</td>              
   <td width='%'>$data[7]</td>              
   <td width='%'>$data[8]</td>              
   <td width='%'>$data[9]</td>              
     <td align='center' width='%' style='color:red'  onclick='DeleteBillingItem(this)' ><i class='fa fa-2x fa-trash' style='cursor:pointer'></i></td>  
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}
    

?>