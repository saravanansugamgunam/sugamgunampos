<?php
// file_put_contents("debug_log.txt", print_r($_POST, true), FILE_APPEND);


include("../../connect.php");

$search = mysqli_real_escape_string($connection, $_POST['searchTerm']);
$selectedBarcode = mysqli_real_escape_string($connection, $_POST['selectedBarcode']);

// Correct SQL with proper parentheses to group OR conditions
$query = "
SELECT uniquebarcode, CONCAT(productshortcode, ' - ', productname) AS text 
FROM productmaster 
WHERE TRIM(uniquebarcode) <> '$selectedBarcode' 
AND 
CONCAT(productshortcode, ' - ', productname)   LIKE '%$search%' LIMIT 20";

$result = mysqli_query($connection, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        'id' => $row['uniquebarcode'],
        'text' => $row['text']
    ];
}

header('Content-Type: application/json');
echo json_encode($data);
?>
