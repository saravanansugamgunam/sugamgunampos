<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM productmaster WHERE productid= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveeditproductmaster.php" method="post">
<center><h4><i class="icon-edit icon-large"></i> Edit Product</h4></center>
<hr>
<div id="ac">
<input type="hidden" name="memi" value="<?php echo $id; ?>" />

<span>Short Code : </span>
<input type="text" style="width:265px; height:30px;" name="txtShortCode" value="<?php echo $row['productshortcode']; ?>" /><br> 
<span>Product : </span>
<input type="text" style="width:265px; height:30px;" name="txtProductName"  value="<?php echo $row['productname']; ?>"  /> <br> 
<span>MRP : </span>
<input type="text" style="width:265px; height:30px;" name="txtMRP"  value="<?php echo $row['price']; ?>"  /> <br>
<span>Category : </span>
<select name="txtCatetory"  style="width:265px; height:30px;  " Required >
<option></option>
	<?php
	include('../connect.php');
	$result = $db->prepare("SELECT * FROM category");
		$result->bindParam(':userid', $res);
		$result->execute();
		echo "<option selected>";
		echo $row['category'];
		echo "</option>";
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option><?php echo $row['name']; ?></option>
	<?php
	}
	?>
</select>
 


</div>

<div style="float:right; margin-right:10px;">

<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save Changes</button>
</div>
</div>
</form>
<?php
}
?>