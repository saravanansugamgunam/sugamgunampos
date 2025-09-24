<?php
session_start();
include('../connect.php');
$ShortCode = $_POST['txtShortCode'];
$ProductMaster = $_POST['txtProductMaster'];
$Catetory = $_POST['txtCatetory'];
$MRP = $_POST['txtMRP'];
 
// query
$sql = "INSERT INTO productmaster (productshortcode,productname,category,price) VALUES (:ShortCode,:ProductMaster,:Catetory,:MRP)";
$q = $db->prepare($sql);
$q->execute(array(':ShortCode'=>$ShortCode,':ProductMaster'=>$ProductMaster,':Catetory'=>$Catetory,':MRP'=>$MRP));
header("location: ProductMaster.php");


?>