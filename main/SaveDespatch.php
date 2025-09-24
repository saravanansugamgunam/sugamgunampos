<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['cashier'];
$c = $_POST['date'];
$d = $_POST['ptype'];
$e = $_POST['totalamount'];
$z = $_POST['profit'];
$CashCard = $_POST['txtCashCard'];
$tolocation = $_POST['Location']; 
$fromlocation = $_SESSION['SESS_LOCATION']; 
 $dtTransferDate= $_POST['dtTransferDate'];
if($tolocation<>'') {
$f = 0;
$sql = "INSERT INTO stocktransferoutmaster (invoice_number,cashier,date,type,amount,profit,due_date,tolocation,fromlocation,saledate) VALUES (:a,:b,:c,:d,:e,:z,:f,:g,:h,:i)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':z'=>$z,':f'=>$f,':g'=>$tolocation,':h'=>$fromlocation,':i'=>$dtTransferDate));
echo $sql;
header("location: TransferOutView.php?invoice=$a");
exit();
} 
// query



?>




 