<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$ShortCode = $_POST['txtShortCode'];
$ProductName = $_POST['txtProductName'];
$Catetory = $_POST['txtCatetory']; 
$MRP = $_POST['txtMRP'];
// query
$sql = "UPDATE productmaster 
        SET productshortcode=?, productname=?, category=? , price=? 
		WHERE productid=?";
$q = $db->prepare($sql);
$q->execute(array($ShortCode,$ProductName,$Catetory,$MRP ,$id));
header("location: ProductMaster.php");

?>