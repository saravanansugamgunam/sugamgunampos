<?php
// Save/SaveSTISimple.php  — simple, robust partial/excess receiving
session_cache_limiter(FALSE);
session_start();
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['SESS_LAST_NAME'])) {
  echo json_encode(['ok'=>false,'msg'=>'Unauthorized']); exit;
}

require_once __DIR__ . "/../../connect.php";

$STOID   = mysqli_real_escape_string($connection, $_POST['STOID']   ?? '');
$FROMLOC = preg_replace('/\D/','', $_POST['FROMLOC'] ?? '');
$TOLOC   = preg_replace('/\D/','', $_POST['TOLOC']   ?? '');
$lines   = json_decode($_POST['lines'] ?? '[]', true);

if ($STOID==='' || $FROMLOC==='' || $TOLOC==='' || !is_array($lines)) {
  echo json_encode(['ok'=>false,'msg'=>'Missing/Bad inputs']); exit;
}

$FromStock = '`newstockdetails_' . $FROMLOC . '`';
$ToStock   = '`newstockdetails_' . $TOLOC   . '`';
$today     = date('Y-m-d');

$connection->begin_transaction();
try {
  $sumSto=0; $sumRecv=0;

  // 1) Update each line in newstoitems with received qty + variance type
  foreach ($lines as $L) {
    $barcode = mysqli_real_escape_string($connection, $L['barcode']   ?? '');
    $batch   = mysqli_real_escape_string($connection, $L['batchcode'] ?? '');
    $mrp     = (float)($L['mrp']    ?? 0);
    $sto     = (float)($L['stoqty'] ?? 0);
    $recv    = (float)($L['receivedqty'] ?? 0);
    $var     = $recv - $sto;
    $type    = ($var>0?'Excess':($var<0?'Short':'Match'));

    $sql = "
      UPDATE newstoitems
         SET receivedqty = {$recv},
             varianceqty = {$var},
             variancetype = '{$type}'
       WHERE stouniqueno = '{$STOID}'
         AND barcode = '{$barcode}'
         AND mrp = {$mrp}
         AND batchcode = '{$batch}'
    ";
    if (!$connection->query($sql)) {
      throw new Exception('Item update failed: '.$connection->error);
    }

    $sumSto  += $sto;
    $sumRecv += $recv;
  }

  // Build an aggregated temp set (derived table) of received qty per (barcode, mrp, batch)
  $agg = "
    SELECT ni.barcode,
           ni.mrp,
           ni.batchcode AS batchno,
           ni.expirydate AS expirydate,
           SUM(COALESCE(ni.receivedqty,0)) AS recvqty
    FROM newstoitems ni
    WHERE ni.stouniqueno = '{$STOID}'
      AND COALESCE(ni.receivedqty,0) > 0
    GROUP BY ni.barcode, ni.mrp, ni.batchcode,ni.expirydate
  ";

  // 2a) UPDATE existing destination rows: add recvqty to transferin + currentstock
  $updDst = "
    UPDATE {$ToStock} dst
    JOIN ({$agg}) r
      ON  r.barcode = dst.barcode
      AND r.mrp     = dst.mrp
      AND r.batchno = dst.batchno
      AND r.expirydate = dst.expirydate
      AND dst.locationcode = {$TOLOC}
    SET dst.transferin   = dst.transferin   + r.recvqty,
        dst.currentstock = dst.currentstock + r.recvqty
  ";
  if (!$connection->query($updDst)) {
    throw new Exception('Destination update failed: '.$connection->error);
  }

  // 2b) INSERT rows that do not yet exist in destination
  $insDst = "
    INSERT INTO {$ToStock}
      (productcode, purchaseqty, salesqty, currentstock, transferin, transferout,
       locationcode, batchno, expirydate, mrp, stockadjadd, stockadjminus,
       purchasereturn, salereturn, productname, category, shortcode, profit, rate,
       barcode, grnnumber)
    SELECT
      a.productcode, 0,0, r.recvqty, r.recvqty, 0,
      {$TOLOC}, a.batchno, a.expirydate, a.mrp, 0,0,0,0,
      a.productname, a.category, a.shortcode, a.profit, a.rate, a.barcode, a.grnnumber
    FROM {$FromStock} a
    JOIN ({$agg}) r
      ON  a.barcode = r.barcode
      AND a.mrp     = r.mrp
      AND a.batchno = r.batchno
      AND a.expirydate = r.expirydate
    LEFT JOIN {$ToStock} dst
      ON  dst.barcode = r.barcode
      AND dst.mrp     = r.mrp
      AND dst.batchno = r.batchno
      AND dst.expirydate = r.expirydate
      AND dst.locationcode = {$TOLOC}
    WHERE dst.barcode IS NULL
  ";
  if (!$connection->query($insDst)) {
    throw new Exception('Destination insert failed: '.$connection->error);
  }

  // 3) Update header status
  $status2 = 'Not Received';
  if ($sumSto > 0 && abs($sumRecv - $sumSto) < 0.0001) $status2 = 'Fully Received';
  elseif ($sumRecv > 0)                                $status2 = 'Partially Received';

  $hdr = "
    UPDATE stomaster
       SET receiptstatus='Received',
           receiptstatus2='{$status2}',
           receiptdate='{$today}'
     WHERE stouniqueno = '{$STOID}'
  ";
  if (!$connection->query($hdr)) {
    throw new Exception('Header update failed: '.$connection->error);
  }

  $connection->commit();
  echo json_encode(['ok'=>true,'status'=>$status2,'sumSto'=>$sumSto,'sumRecv'=>$sumRecv]);
} catch (Throwable $e) {
  $connection->rollback();
  echo json_encode(['ok'=>false,'msg'=>$e->getMessage()]);
}
