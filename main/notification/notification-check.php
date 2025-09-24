<?php

include("../connect.php");

$result = mysqli_query($connection, "SELECT * FROM notifications WHERE target_user='doctor' ORDER BY id DESC LIMIT 1");

$row = mysqli_fetch_assoc($result);

if ($row) {
    echo json_encode([
        "id" => $row['id'],
        "message" => $row['message']
    ]);
} else {
    echo json_encode([
        "id" => 0,
        "message" => ""
    ]);
}
?>