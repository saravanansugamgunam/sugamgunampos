<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Invoice"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 							  
 $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);
 $CurrentBillTotal = 0;
 $OldBalance = 0;
 $BillTotal = $CurrentBillTotal + $OldBalance;
 
$query=mysqli_query($connection, " 
SELECT SUM(amount) AS  TotalPayment FROM salepaymentdetails WHERE invoiceno  ='".$Invoice."'");
	 
	 // echo  " 
// SELECT SUM(amount) AS  TotalPayment FROM salepaymentdetails WHERE invoiceno  ='".$Invoice."' ";

	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['TotalPayment']; 
     
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
  }

?>