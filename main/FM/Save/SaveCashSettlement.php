<?php
// Save/SaveCashSettlement.php
header('Content-Type: application/json; charset=utf-8');
session_cache_limiter(false);
session_start();

require_once '../../connect.php'; // adjust if needed; should set $connection (mysqli)

function jexit($arr) { echo json_encode($arr); exit; }

if (!$connection) {
  jexit(['success'=>false, 'msg'=>'DB connection missing']);
}

// Read payload: prefer JSON, fallback to POST form.
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
if (!is_array($data)) {
  // fallback to form fields
  $data = $_POST;
}

$from        = isset($data['from']) ? trim($data['from']) : '';
$to          = isset($data['to']) ? trim($data['to']) : '';
$systemCash  = isset($data['systemCash']) ? floatval($data['systemCash']) : 0;
$dnmTotal    = isset($data['dnmTotal']) ? floatval($data['dnmTotal']) : 0;
$difference  = isset($data['difference']) ? floatval($data['difference']) : ($dnmTotal - $systemCash);
$notes       = isset($data['notes']) ? trim($data['notes']) : null;

// denominations: [{denom: 500, count: 3}, ...]
$denoms      = isset($data['denominations']) && is_array($data['denominations']) ? $data['denominations'] : [];

$createdBy     = isset($_SESSION['SESS_MEMBER_ID']) ? intval($_SESSION['SESS_MEMBER_ID']) : null;
$locationCode  = isset($_SESSION['SESS_LOCATION']) ? $_SESSION['SESS_LOCATION'] : null;

// Basic validation
if (!$from || !$to) jexit(['success'=>false, 'msg'=>'Missing from/to']);
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $from) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $to)) {
  jexit(['success'=>false, 'msg'=>'Invalid date format (use YYYY-MM-DD)']);
}
if ($systemCash < 0 || $dnmTotal < 0) {
  jexit(['success'=>false, 'msg'=>'Negative totals not allowed']);
}

mysqli_begin_transaction($connection);
try {
  // Insert master
  $sqlM = "INSERT INTO cash_settlement_master 
           (from_date, to_date, system_cash, counted_cash, difference_amt, notes, location_code, created_by)
           VALUES (?,?,?,?,?,?,?,?)";
  $stmtM = mysqli_prepare($connection, $sqlM);
  if (!$stmtM) throw new Exception('Prepare master failed: '.mysqli_error($connection));
  mysqli_stmt_bind_param(
    $stmtM, 'ssdddsii',
    $from, $to, $systemCash, $dnmTotal, $difference, $notes, $locationCode, $createdBy
  );
  if (!mysqli_stmt_execute($stmtM)) {
    // Unique violation? Return friendly message
    if (mysqli_errno($connection) == 1062) {
      throw new Exception('A settlement already exists for this date range and location.');
    }
    throw new Exception('Insert master failed: '.mysqli_error($connection));
  }
  $settlementId = mysqli_insert_id($connection);
  mysqli_stmt_close($stmtM);

  // Insert denomination lines
  if (!empty($denoms)) {
    $sqlD = "INSERT INTO cash_settlement_denoms (settlement_id, denomination, qty, line_total)
             VALUES (?,?,?,?)";
    $stmtD = mysqli_prepare($connection, $sqlD);
    if (!$stmtD) throw new Exception('Prepare detail failed: '.mysqli_error($connection));

    foreach ($denoms as $row) {
      $denom = isset($row['denom']) ? intval($row['denom']) : 0;
      $qty   = isset($row['count']) ? intval($row['count']) : 0;
      if ($denom <= 0 || $qty < 0) continue;
      $line  = $denom * $qty;
      mysqli_stmt_bind_param($stmtD, 'iiid', $settlementId, $denom, $qty, $line);
      if (!mysqli_stmt_execute($stmtD)) {
        throw new Exception('Insert detail failed: '.mysqli_error($connection));
      }
    }
    mysqli_stmt_close($stmtD);
  }

  mysqli_commit($connection);
  jexit(['success'=>true, 'id'=>$settlementId]);

} catch (Exception $e) {
  mysqli_rollback($connection);
  jexit(['success'=>false, 'msg'=>$e->getMessage()]);
}
