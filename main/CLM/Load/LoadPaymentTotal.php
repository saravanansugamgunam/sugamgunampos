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
 $CurrentBillTotal = mysqli_real_escape_string($connection, $_POST["CurrentBillTotal"]);
 $OldBalance = mysqli_real_escape_string($connection, $_POST["OldBalance"]);
 $BillTotal = $CurrentBillTotal + $OldBalance;
 
$query=mysqli_query($connection, "
SELECT(
SELECT SUM(amount) AS  TotalPayment FROM salepaymentdetails WHERE invoiceno  ='".$Invoice."') AS Payment,
(
SELECT SUM(nettamount) AS TotalAmount FROM saleitems  WHERE invoiceno ='".$Invoice."') AS InvoiceAmount,
(SELECT '".$BillTotal."' - Payment) AS Balance");
	 
	 $data = array();
   
    while($row=mysqli_fetch_assoc($query))
    { 
      $data[] = $row['Payment'];
      $data[] = $row['InvoiceAmount'];
      $data[] = $row['Balance'];
     
     
    }
	  
echo json_encode($data);
 
  
    mysqli_close($connection);

  
}

?>