<style>
  #tblTherapyListCancell td, #tblTherapyListCancell th {
  border: 1px solid #ddd;
  padding: 8px;
}

  </style>
 
<?php
   include("../../../connect.php"); 
session_cache_limiter(FALSE);
session_start();
  
 
  
 // echo "1";
 
 $InvoiceNo = mysqli_real_escape_string($connection, $_POST["InvoiceNo"]); 
 
  $currentdate =date("Y-m-d H:i:s"); 	
 
	$result = mysqli_query($connection, " 
  
  SELECT DATE_FORMAT(cancelleddate,'%d-%m-%Y') cancelleddate,e.username,consultationname,c.username,refundamount,d.remarks
  FROM therapybookingdetails AS a 
  JOIN consultationmaster AS b ON a.therapyid = b.consultationid 
  JOIN usermaster AS c ON a.doctorid=c.userid  
  JOIN therapycancelleddetails AS d ON a.bookinguniqueid=d.bookingid
  AND a.bookingid=d.bookingitemid
    JOIN usermaster AS e ON d.cancelledby=e.userid  
  WHERE bookinguniqueid ='$InvoiceNo' 
 
"); 

 

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='tblTherapyListCancell'  border='1' style='border-collapse:collapse;' 
   class='  table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th width='%'  >Cancelled Date</th>        
		<th width='%'  >Cancelled By</a></th>        
		<th width='%'>Therapy</a></th>     
		<th width='%'> Therapist</a></th>    
		<th width='%'> Refund</a></th>    
		<th width='%'> Remarks</a></th>    
		  
		</tr> </thead> <tbody id='myTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td    id='BookingID'  width='%' >$data[0]</td>
  <td nowrap id='TherapyDate' width='%'>$data[1]</td>  
   <td id='TherapyTime'  width='%'>$data[2]</td>   
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td  id='TherapyName' width='%'>$data[5]</td>    
   
 </tr>";
   
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
								?>
    
 