 
<?php
// fetch_messages.php
header('Content-Type: application/json; charset=utf-8');
include("../../../../connect.php"); 

 

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
if (!is_array($data)) { $data = $_POST; }

$username = trim($data['username'] ?? '');
$body     = trim($data['body'] ?? '');

if ($username === '' || $body === '') {
  http_response_code(422);
  echo json_encode(['error' => 'Username and message are required.']);
  exit;
}
if (mb_strlen($username) > 32 || mb_strlen($body) > 1000) {
  http_response_code(422);
  echo json_encode(['error' => 'Too long. Username ≤ 32 chars, message ≤ 1000.']);
  exit;
}

$stmt = $pdo->prepare("INSERT INTO messages (username, body) VALUES (?, ?)");
$stmt->execute([$username, $body]);

echo json_encode([
  'ok'         => true,
  'id'         => (int)$pdo->lastInsertId(),
  'created_at' => gmdate('Y-m-d\TH:i:s\Z')
]);

