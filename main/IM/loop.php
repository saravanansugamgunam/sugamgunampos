<?php
/////////////////////////
// for testing. Remove //
$ParticiDetails = 3;
$_POST['field1'] = "field1";
$_POST['field2'] = "field2";
$_POST['field3'] = "field3";
$_POST['field4'] = "field4";
/////////////////////////

//Any validation should be done here
$field1 = trim($_POST['field1']);
$field2 = trim($_POST['field2']);
$field3 = trim($_POST['field3']);
$field4 = trim($_POST['field4']);

$values = array();
for ($x=0; $x<$ParticiDetails; $x++){
	$values[] = "('$field1','$field2','$field3','$field4')";
}

$sql = "INSERT INTO table (column1,column2,column3,column4) VALUES";
$sql .= implode(",",$values);
echo "$sql";
?>