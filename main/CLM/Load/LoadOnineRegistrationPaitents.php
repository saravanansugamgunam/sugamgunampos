<?php

session_cache_limiter(FALSE);
session_start();

if (isset($_POST["MobileNo"])) {

  // echo "1";
  include("../../../connect.php");
  $FromDate = date("Y-m-d 00:00:00");
  $ToDate = date("Y-m-d 23:50:00");
  $MobileNo = mysqli_real_escape_string($connection, $_POST["MobileNo"]);

  $result = mysqli_query($connection, "
  SELECT a.mobileno,paitentname,a.gender,ROUND(DATEDIFF(CURRENT_DATE,a.dob) / 365.25,0) AS age,
  c.username,a.paitentid,b.doctorcode,b.paymentamount FROM  paitentmaster AS a JOIN
  newregistrationdetails AS b ON a.paitentid=b.customercode
  JOIN usermaster AS c ON b.doctorcode=c.userid
 WHERE b.createdon BETWEEN '$FromDate' AND '$ToDate' and convertedstatus='0' 
 ORDER BY 1 DESC 

  
 ");


  //echo "<table id='tblProject' class='tblMasters'>";


  echo " <table id='tblBillingItems' class='table table-striped table-bordered'>";
  echo " <thead><tr>    
		 
		<th width='%'>#</th>    
		<th  width='%'>Mobile</th>    
		<th  width='%'>Paitent</th>    
		<th  width='%'>Gender</th>      
		<th  width='%'>Age</th>      
		<th  width='%'>Consultant</th>      
		<th  width='%'>Payment</th>      
		<th  width='%'>Confirm</th>      
		</tr> </thead> <tbody id='TableNewPaitent'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td > $data[0]</td>
  <td width='%' >$data[1]</td>  
   <td width='%'>$data[2]</td>     
   <td width='%'>$data[3]</td>     
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[7]</td>     
   <td width='%'><button class='btn btn-sm btn-success' 
    onclick='GetNewTabRegistrationDetails($data[5],$data[6],$data[7])'>Confirm Booking</button></td>     
</tr>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody>
</table>";
}
