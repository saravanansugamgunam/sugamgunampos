<?php
// save.php
header('Content-Type: application/json');

 



$host = "localhost";
$user = "u675828376_lazo";
$pass = "Lazo@min0!";
$db = "u675828376_db_lazo"; // Change this

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection failed"]);
    exit;
}

$shortCode = $_POST['short_code'];
$fullName = $_POST['full_name'];
$combinations = $_POST['combination'];
$percentages = $_POST['percentage']; 
$CustommedicineCombination = $_POST['txtCustommedicineCombination']; 


$stmt = $conn->prepare("INSERT INTO medicine_mix (short_code, full_name, combination, mixing_percentage,patientcode) VALUES (?, ?, ?, ?, ?)");
foreach ($combinations as $i => $combo) {
    $stmt->bind_param("sssss", $shortCode, $fullName, $combo, $percentages[$i], $CustommedicineCombination);
    $stmt->execute();
}
$stmt->close();
$conn->close();

echo json_encode(["success" => true]);
exit;
