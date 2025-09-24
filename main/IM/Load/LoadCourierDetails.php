<?php
   include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s");
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["CourierTrackingInvoiceNo"]))
{	
   				  
 $CourierTrackingInvoiceNo = mysqli_real_escape_string($connection, $_POST["CourierTrackingInvoiceNo"]); 
  

$query=mysqli_query($connection, "  
SELECT  DATE_FORMAT(courierposteddate,'%d-%m-%Y') AS courierposteddate, courierservice, couriertrackingno,courierremarks  FROM courierdetails WHERE invoicenumber ='".$CourierTrackingInvoiceNo."'
  ");
	 
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] =  $row['courierposteddate'];
      $data[] =  $row['courierservice'];
      $data[] =  $row['couriertrackingno'];
      $data[] =  $row['courierremarks'];
       
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

// echo  "  
// SELECT courierposteddate, courierservice, couriertrackingno,courierremarks  FROM courierdetails WHERE invoicenumber ='".$CourierTrackingInvoiceNo."'
  // ";
  
}
else
{
	 echo " NO";
}

?>