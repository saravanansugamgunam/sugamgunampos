<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['product'];
$c = $_POST['qty'];
$w = $_POST['pt'];
$date = $_POST['date'];
$discount = $_POST['discount'];
$LocationCode = $_SESSION['SESS_LOCATION'];
$result = $db->prepare("SELECT *,(SELECT c.cost FROM products AS c  WHERE c.product_id= :userid LIMIT 1) AS cost
 FROM productmaster AS a JOIN stock AS b ON a.productid = b.`productid` WHERE a.productid= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$asasa=$row['price'];
$code=$row['productid'];
$gen=$row['category'];
$name=$row['productname'];
$shortcode=$row['productshortcode'];
$p=$row['cost'];;
}

//edit qty
$sql = "UPDATE stock 
        SET currentstock=currentstock-?,salesqty=salesqty+?
		WHERE productid=? and locationcode =?";
$q = $db->prepare($sql);
$q->execute(array($c,$c,$b,$LocationCode));
$fffffff=$asasa-($asasa*($discount/100));
$discountamount=($asasa*($discount/100))* $c ;
$d=$fffffff*$c;
$profit=$d - ($p*$c);
// query
$sql = "INSERT INTO sales_order (invoice,product,qty,amount,name,price,profit,product_code,gen_name,date,discountpercent,discount,shortcode,locationcode) VALUES (:a,:b,:c,:d,:e,:f,:h,:i,:j,:k,:l,:m,:shortcode,:locationcode)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$name,':f'=>$asasa,':h'=>$profit,':i'=>$code,':j'=>$gen,':k'=>$date,':l'=>$discount,':m'=>$discountamount,':shortcode'=>$shortcode,':locationcode'=>$LocationCode));
header("location: sales.php?id=$w&invoice=$a");


?>