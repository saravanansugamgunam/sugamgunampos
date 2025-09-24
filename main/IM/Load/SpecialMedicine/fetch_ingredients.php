<?php
include("../../../../connect.php");

$term = isset($_GET['term']) ? $connection->real_escape_string($_GET['term']) : '';

$sql = "SELECT ingredientsname AS name, ingredientcostpergram AS cost 
        FROM ingredients 
        WHERE ingredientsname LIKE '%$term%' 
        LIMIT 20";
$result = $connection->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'id' => $row['name'],
            'text' => $row['name'],
            'cost' => $row['cost']
        ];
    }
}

$connection->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
