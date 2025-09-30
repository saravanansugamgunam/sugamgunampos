<?php
session_cache_limiter(FALSE);
session_start();

header('Content-Type: application/json');

if (!isset($_POST['STOID'])) {
  echo json_encode([0]);
  exit;
}

include("../../../connect.php");

$STOID = $_POST['STOID'];

// Sum STO vs RECEIVED from item lines
$sum = $connection->prepare("
  SELECT
    COALESCE(SUM(stoqty), 0)                             AS sumSto,
    COALESCE(SUM(COALESCE(receivedqty, 0)), 0)           AS sumRecv
  FROM newstoitems
  WHERE stouniqueno = ?
");
$sum->bind_param('s', $STOID);
$sum->execute();
$sum->bind_result($sumSto, $sumRecv);
$sum->fetch();
$sum->close();

$fully = 0;

// If we have item rows, consider fully received when received >= sto (handles excess too)
if ($sumSto > 0) {
  if (($sumRecv + 0.000001) >= $sumSto) {
    $fully = 1;
  }
} else {
  // Fallback: if no item rows found, rely on header status
  $hdr = $connection->prepare("
    SELECT
      CASE
        WHEN COALESCE(receiptstatus2, '') = 'Fully Received'
             OR COALESCE(receiptstatus, '') = 'Received'
        THEN 1 ELSE 0
      END AS is_received
    FROM stomaster
    WHERE stouniqueno = ?
    LIMIT 1
  ");
  $hdr->bind_param('s', $STOID);
  $hdr->execute();
  $hdr->bind_result($is_received);
  if ($hdr->fetch()) {
    $fully = (int)$is_received;
  }
  $hdr->close();
}

echo json_encode([$fully]);

$connection->close();
