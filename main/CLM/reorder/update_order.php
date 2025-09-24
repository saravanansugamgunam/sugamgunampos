<?php 
 include("../../../connect.php"); 
if(isset($_GET["order"])) {
	$order  = explode(",",$_GET["order"]);
	for($i=0; $i < count($order);$i++) {
		 
		$sql = "UPDATE tokenmaster SET revisedtokennumber='" . $i . "' WHERE tokenid=". $order[$i];		
		mysqli_query($connection, $sql) or die("database error:". mysqli_error($connection));	
	}
}

?>