 <style> 
 
    </style>
<?php
  
session_cache_limiter(FALSE);
session_start();
   
 
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d"); 					 
  $currentdateprint =date("d-m-Y"); 					 
$result = mysqli_query($connection, "  
 
 SELECT a.id ,a.name, a.mobileno,b.enquiry,a.emailid,c.enquirytype,d.reference FROM enquirydetails AS a 
 JOIN enquirymaster AS b ON a.enquiredbyid = b.enquiryid
 JOIN enquirytypemaster AS c ON a.enquirytypeid = c.enquirytypeid
 JOIN referencemaster AS d ON a.referenceid  = d.referenceid 
 WHERE DATE_FORMAT(a.addedon, '%Y-%m-%d') = CURDATE()");
 
echo "<div style='display:block;'><div style='display:block;' id='DivPrinting'>";
 //echo "<table id='tblProject' class='tblMasters'>";
  
  echo " <table id='data-table' class='table table-striped table-bordered'>";
echo " <thead><tr>  
		<th>S.No</th>          
		<th hidden>ID</th>          
	 
		<th width='%'> Name</th>    
		<th width='%'> Mobile</th>    
		<th width='%'>Enquired For</th>     
		</tr> </thead> <tbody id='tblEnquiry'>"; 
 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td hidden> $data[0]</td>
  <td >$data[1]</td>  
   <td  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>       
    
  </tr>";
    
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
echo "</div></div>";      
?>