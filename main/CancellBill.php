<?php
   
session_start();
include('../connect.php');
    
$SelectedID =  $_POST["SelectedID"]; 
$password =   $_POST["password"]; 
$CancelledBy=$_SESSION['SESS_MEMBER_ID'];
  $CurrentDate = date("Y/m/d");
	
$query = "   SELECT * FROM specialpriviliage  WHERE password ='$password'";
 
$result = mysqli_query($connection, $query);
$output = '';
 
	 
if(mysqli_num_rows($result) > 0)
{
	$query = " update sales set cancelledstatus =1 WHERE transaction_id ='$SelectedID'";
 
$result = mysqli_query($connection, $query);

$query1 = "insert into eventlog (eventname,userid,eventdate,reference) 
values ('Bill Cancel',$CancelledBy,'$CurrentDate','$SelectedID')";
 
$result1 = mysqli_query($connection, $query1);
 

$UpdateQuery = " UPDATE stock t1 INNER JOIN sales_order t2 ON t1.productid = t2.product_code
SET t1.currentstock = t1.currentstock + t2.qty ,t1.salesqty = t1.salesqty - t2.qty 
WHERE t2.invoice IN (SELECT invoice_number FROM  sales WHERE transaction_id ='$SelectedID')";
 
$UpdateResult = mysqli_query($connection, $UpdateQuery);
 
   echo "1";
}
else
{
	echo "0";
}

?>