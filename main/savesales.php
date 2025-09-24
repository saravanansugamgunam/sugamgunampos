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
$cname = $_POST['cname'];
$LocationCode = $_SESSION['SESS_LOCATION'];
 $SaleDate= date('Y-m-d');
 
if($d=='credit') {
$f = $_POST['due'];
$sql = "INSERT INTO sales (invoice_number,cashier,date,type,amount,profit,due_date,name,locationcode) VALUES (:a,:b,:c,:d,:e,:z,:f,:g,:h)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':z'=>$z,':f'=>$f,':g'=>$cname,':h'=>$LocationCode ));
header("location: preview.php?invoice=$a");
exit();
}
if($d=='cash') {
$f = $_POST['cash'];
$sql = "INSERT INTO sales (invoice_number,cashier,date,type,amount,profit,due_date,name,paymenttype,saledate,locationcode) VALUES (:a,:b,:c,:d,:e,:z,:f,:g,:h,:SaleDate,:LocationCode)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':z'=>$z,':f'=>$f,':g'=>$cname,':h'=>$CashCard,':SaleDate'=>$SaleDate,':LocationCode'=>$LocationCode));
header("location: preview.php?invoice=$a");
exit();
}
// query



?>




 