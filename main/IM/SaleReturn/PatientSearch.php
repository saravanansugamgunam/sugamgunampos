<?php
include("../../connect.php");

$term = mysqli_real_escape_string($connection, $_POST['searchTerm']);

$sql = "SELECT paitentid, CONCAT(paitentname, ' - ', mobileno) AS text 
        FROM paitentmaster 
        WHERE (paitentname LIKE '%$term%' OR mobileno LIKE '%$term%')
        AND activestatus='Active'
        LIMIT 20";

$result = mysqli_query($connection, $sql);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = ["id" => $row['paitentid'], "text" => $row['text']];
}

echo json_encode($data);
?>
