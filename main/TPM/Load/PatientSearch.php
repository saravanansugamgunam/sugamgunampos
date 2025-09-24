<?php
include("../../connect.php");

$searchTerm = $_POST['searchTerm'] ?? '';

$data = [];

if (!empty($searchTerm)) {
    $query = "SELECT paitentid, CONCAT(mobileno, ' - ', paitentname) AS label 
              FROM paitentmaster 
              WHERE mobileno LIKE '%$searchTerm%' OR paitentname LIKE '%$searchTerm%' 
              LIMIT 20";
    
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            "id" => $row['paitentid'],
            "text" => $row['label']
        ];
    }
}

echo json_encode($data);
?>
