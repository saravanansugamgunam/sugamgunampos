<?php
	include('../connect.php');
	$id=$_GET['id'];
	$c=$_GET['invoice'];
	$sdsd=$_GET['dle'];
	$qty=$_GET['qty'];
	$wapak=$_GET['code'];
	//edit qty
	$sql = "UPDATE stock 
			SET currentstock=currentstock+?,salesqty=salesqty-?  
			WHERE productid=?";
	$q = $db->prepare($sql);
	$q->execute(array($qty,$qty,$wapak));

	$result = $db->prepare("DELETE FROM sales_order WHERE transaction_id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
	header("location: sales.php?id=$sdsd&invoice=$c");
?>