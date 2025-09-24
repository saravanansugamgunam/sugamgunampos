<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("update productmaster set status='InActive' WHERE productid= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
?>