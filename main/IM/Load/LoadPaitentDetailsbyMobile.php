<?php

session_cache_limiter(FALSE);
session_start();
     
//insert.php
if(isset($_POST["MobileNo"]))
{ 
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $MobileNo = mysqli_real_escape_string($connection, $_POST["MobileNo"]); 
   

  $query=mysqli_query($connection, "
  select paitentid,mobileno,paitentname,email,whatsappno,alternateno,referenceid,referenceno,gender,
  dob,address,city,statecode,pincode,barcode,activestatus from paitentmaster where mobileno= '$MobileNo' ");
 
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
     
      $data[] = $row['paitentid']; 
	    $data[] = $row['mobileno']; 
	    $data[] = $row['paitentname']; 
	    $data[] = $row['email']; 
	    $data[] = $row['whatsappno']; 
      $data[] = $row['alternateno']; 
      $data[] = $row['referenceid']; 
      $data[] = $row['referenceno']; 
      $data[] = $row['gender']; 
      $data[] = $row['dob']; 
      $data[] = $row['address']; 
      $data[] = $row['city']; 
      $data[] = $row['statecode']; 
      $data[] = $row['pincode']; 
      $data[] = $row['barcode']; 
      $data[] = $row['activestatus']; 
      
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>