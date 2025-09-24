<?php
// Load/CheckCashSettlement.php
header('Content-Type: application/json; charset=utf-8');
session_cache_limiter(false);
session_start();
require_once '../../connect.php'; // provides $connection (mysqli)

$from = $_POST['from'] ?? '';
$to   = $_POST['to']   ?? '';
$loc  = $_SESSION['SESS_LOCATION'] ?? null;

if (!$from || !$to) { echo json_encode(['ok'=>false,'msg'=>'Missing dates']); exit; }
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/',$from) || !preg_match('/^\d{4}-\d{2}-\d{2}$/',$to)) {
  echo json_encode(['ok'=>false,'msg'=>'Bad date format']); exit;
}

/* Overlap (including touching) test:
   NOT (existing.to_date < new.from OR existing.from_date > new.to) */
$sql = "SELECT id, from_date, to_date
        FROM cash_settlement_master
        WHERE (location_code <=> ?)
          AND NOT (to_date < ? OR from_date > ?)
        ORDER BY from_date
        LIMIT 1";
$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($stmt, 'sss', $loc, $from, $to);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$conflict = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$conflict) {
  echo json_encode(['ok'=>true, 'settled'=>false]); 
  exit;
}

/* Suggest the latest allowed end date when the user starts at $from.
   If the conflict starts on/after $from, allow up to the day before conflict.from_date.
   If the conflict started before $from (spans over $from), then nothing is allowed from $from,
   so allowed_to = DATE_SUB($from, INTERVAL 1 DAY). */
if ($conflict['from_date'] >= $from) {
  $allowedToSql = "SELECT DATE_SUB(MIN(from_date), INTERVAL 1 DAY) AS allowed_to
                   FROM cash_settlement_master
                   WHERE (location_code <=> ?)
                     AND from_date >= ?
                     AND from_date <= ?";
  $stmt2 = mysqli_prepare($connection, $allowedToSql);
  mysqli_stmt_bind_param($stmt2, 'sss', $loc, $from, $to);
  mysqli_stmt_execute($stmt2);
  $res2 = mysqli_stmt_get_result($stmt2);
  $row2 = mysqli_fetch_assoc($res2);
  mysqli_stmt_close($stmt2);
  $allowed_to = $row2 && $row2['allowed_to'] ? $row2['allowed_to'] : null;
} else {
  // conflict spans into $from
  $allowed_to = date('Y-m-d', strtotime($from . ' -1 day'));
}

echo json_encode([
  'ok'       => true,
  'settled'  => true,
  'conflict' => ['from' => $conflict['from_date'], 'to' => $conflict['to_date']],
  'allowed_to' => $allowed_to
]);
