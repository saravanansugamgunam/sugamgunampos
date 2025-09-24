 
<?php
// fetch_messages.php
header('Content-Type: application/json; charset=utf-8');
include("../../../../connect.php"); 

$since_id = isset($_GET['since_id']) ? max(0, (int)$_GET['since_id']) : 0;

$stmt = $pdo->prepare(
  "SELECT id, username, body,
          DATE_FORMAT(created_at, '%Y-%m-%dT%H:%i:%sZ') AS created_at
   FROM messages
   WHERE id > ?
   ORDER BY id ASC
   LIMIT 100"
);
$stmt->execute([$since_id]);

echo json_encode(['messages' => $stmt->fetchAll()], JSON_UNESCAPED_UNICODE);
?>