<?php
  
session_cache_limiter(FALSE);
session_start();
  
 if(isset($_POST["PaitentCode"]))
{
  
  // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 	
 $PaitentCode = mysqli_real_escape_string($connection, $_POST["PaitentCode"]);
 
$result = mysqli_query($connection, "
SELECT address1, address2, a.city,a. state, a.pincode  FROM courierdetails AS a 
JOIN salemaster_master AS b ON a.invoicenumber=b.saleuniqueno 
JOIN paitentmaster AS c ON b.paitientcode=c.paitentid WHERE c.paitentid ='$PaitentCode' 
GROUP BY address1, address2, a.city, a.state, a.pincode  ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblSavedAddress' class='blueTable'>";
echo " <thead><tr>  
<th width='%'>  </th>     
		 <th>S.No</th>  
		<th width='%'> Address 1</th>     
		<th width='%'> Address 2</th>    
		<th width='%'> City </th>    
		<th width='%'> State</th>    
		<th width='%'> Pincode</th>       
		  
		</tr> </thead> <tbody id='TblSavedList'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td  width='%' onclick='GetSelectedAddress(this);' data-dismiss='modal'><input type='radio' name='rd' /></td>         
  <td width='10%'>$SerialNo</td>  
  <td id ='tblAddress1' >$data[0]</td> 
  <td id ='tblAddress2' width='%' >$data[1]</td>       
  <td id ='tblCity' width='%' >$data[2]</td>       
  <td id ='tblState' width='%' >$data[3]</td>       
  <td id ='tblPincode' width='%' >$data[4]</td>           
    
    
    
    
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
}