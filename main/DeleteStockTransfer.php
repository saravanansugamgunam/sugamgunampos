<?php
	include('../connect.php');
	$id=$_GET['id'];
	$c=$_GET['invoice'];
	$sdsd=$_GET['dle'];
	$qty=$_GET['qty'];
	$wapak=$_GET['code'];
	//edit qty
	$sql = "UPDATE stock 
			SET currentstock=currentstock+?,transferout=transferout-?  
			WHERE productid=?";
	$q = $db->prepare($sql);
	$q->execute(array($qty,$qty,$wapak));

	$result = $db->prepare("DELETE FROM transfer_order WHERE transaction_id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
	header("location: StockOut.php?id=$sdsd&invoice=$c");
?>