<?php
session_cache_limiter(FALSE);
session_start();

// TEMP: show errors clearly while debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/plain; charset=UTF-8');

$LocationCode = '3'; // or $_SESSION['SESS_LOCATION'];

function removeslashes($s){ $s = implode("", explode("\\", $s)); return stripslashes(trim($s)); }
function n2($v){ return number_format((float)$v, 2, '.', ''); }
function dbg($label, $val){ error_log("[SaveReturn] $label: " . (is_scalar($val) ? $val : json_encode($val))); }

if (!isset($_POST["ItemID"])) {
  http_response_code(400);
  echo "Missing ItemID (expected 'saleid|qty,saleid|qty,...').";
  exit;
}

require_once("../../../connect.php"); // must set $connection (mysqli)
if (!isset($connection) || !($connection instanceof mysqli)) {
  http_response_code(500);
  echo "Failed: DB connection not available.";
  exit;
}

// Throw mysqli errors as exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
  $currentdatetime      = date("Y-m-d H:i:s");
  $currentdate          = date("Y-m-d");

  // Inputs
  $rawItemPairs         = removeslashes(mysqli_real_escape_string($connection, $_POST["ItemID"]));
  $InvoiceNo            = mysqli_real_escape_string($connection, strtoupper($_POST["InvoiceNo"] ?? ''));
  $ReturnInvoice        = mysqli_real_escape_string($connection, strtoupper($_POST["ReturnInvoice"] ?? ''));
  $PercentageConsidered = (float)($_POST["PercentageConsidered"] ?? 0);
  $userid               = $_SESSION['SESS_MEMBER_ID'] ?? null;

  dbg('POST', $_POST);

  if ($InvoiceNo === '' || $ReturnInvoice === '') {
    throw new Exception("InvoiceNo and ReturnInvoice are required.");
  }

  // Parse "saleid|qty"
  $pairs = array_filter(array_map('trim', explode(',', $rawItemPairs)));
  $returnMap = []; // saleid => qty
  foreach ($pairs as $p) {
    $parts = explode('|', $p);
    if (count($parts) !== 2) continue;
    $saleid = (int)$parts[0];
    $qty    = (int)$parts[1];
    if ($saleid > 0 && $qty > 0) {
      if (!isset($returnMap[$saleid])) $returnMap[$saleid] = 0;
      $returnMap[$saleid] += $qty;
    }
  }
  if (empty($returnMap)) {
    throw new Exception("No valid sale lines to return in ItemID.");
  }
  dbg('returnMap', $returnMap);

  // Ensure returnedqty exists
  $colCheck = $connection->query("SHOW COLUMNS FROM newsaleitems LIKE 'returnedqty'");
  if ($colCheck->num_rows === 0) {
    throw new Exception("Column 'returnedqty' missing. Run: ALTER TABLE newsaleitems ADD COLUMN returnedqty INT NOT NULL DEFAULT 0;");
  }

  mysqli_begin_transaction($connection);

  // Guard duplicate return invoice
  $chk = $connection->prepare("SELECT 1 FROM salemaster WHERE saleuniqueno = ? LIMIT 1");
  if (!$chk) throw new Exception("Prepare-dup-check failed: ".$connection->error);
  $chk->bind_param('s', $ReturnInvoice);
  $chk->execute();
  $chk->store_result();
  if ($chk->num_rows > 0) {
    throw new Exception("This return invoice already exists. Refresh and try again.");
  }
  $chk->close();

  // ========== PREPARED STATEMENTS (make sure these exist before foreach) ==========
  $selLine = $connection->prepare("
    SELECT saleid, invoiceno, barcode, shortcode, category, productname,
           saleqty, mrp, discountamount, nettamount, saledate, location, batchcode,
           currentstock, paitentcode, rate, profitamount,
           COALESCE(returnedqty,0) AS returnedqty
    FROM newsaleitems
    WHERE saleid = ? AND invoiceno = ?
    FOR UPDATE
  ");
  if (!$selLine) throw new Exception("Prepare selLine failed: ".$connection->error);

  $insReturnItem = $connection->prepare("
    INSERT INTO newsaleitems
      (invoiceno, barcode, saleqty, shortcode, category, productname,
       mrp, discountamount, nettamount, saledate, location, batchcode,
       currentstock, paitentcode, rate, profitamount, entrydate, returnstatus, transactiontype)
    VALUES
      (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
  ");
  if (!$insReturnItem) throw new Exception("Prepare insReturnItem failed: ".$connection->error);

  $updSourceLine = $connection->prepare("
    UPDATE newsaleitems
       SET returnedqty = ?, returnstatus = ?
     WHERE saleid = ?
  ");
  if (!$updSourceLine) throw new Exception("Prepare updSourceLine failed: ".$connection->error);
  // ===============================================================================

  $insertedAny = false;

  // Batch-aware bumps: key = barcode||batchcode
  $stockBumps = [];

  foreach ($returnMap as $saleid => $retQtyReq) {
    $selLine->bind_param('is', $saleid, $InvoiceNo);
    $selLine->execute();
    $res = $selLine->get_result();
    if ($res->num_rows === 0) {
      throw new Exception("Sale line $saleid not found under invoice $InvoiceNo.");
    }
    $row = $res->fetch_assoc();

    $saleqty   = (int)$row['saleqty'];
    $returned  = (int)$row['returnedqty'];
    $remaining = max(0, $saleqty - $returned);
    if ($remaining <= 0) continue;

    $retQty = min((int)$retQtyReq, $remaining);
    if ($retQty <= 0) continue;

    $barcode   = $row['barcode'];
    $shortcode = $row['shortcode'];
    $category  = $row['category'];
    $pname     = $row['productname'];
    $mrpPU     = (float)$row['mrp'];
    $discLine  = (float)$row['discountamount'];
    $saledate  = $row['saledate'];
    $location  = $row['location'];   // if INT in DB, cast to (int) and change bind type below.
    $batch     = $row['batchcode'];
    $curStock  = (int)$row['currentstock'];
    $pcode     = $row['paitentcode'];
    $rate      = (float)$row['rate'];
    $profitLn  = (float)$row['profitamount'];

    $discPerUnit   = ($saleqty > 0) ? ($discLine / $saleqty) : 0.0;
    $profitPerUnit = ($saleqty > 0) ? ($profitLn / $saleqty) : 0.0;

    $grossForRet   = $mrpPU * $retQty;
    $discForRet    = $discPerUnit * $retQty;
    $netBeforeDed  = $grossForRet - $discForRet;
    $netAfterDed   = $netBeforeDed * (1 - ($PercentageConsidered / 100.0));

    $ret_saleqty  = -$retQty;
    $ret_mrp      = -$mrpPU;
    $ret_discount = -round($discForRet, 2);
    $ret_nett     = -round($netAfterDed, 2);
    $ret_profit   = -round($profitPerUnit * $retQty, 2);
    $returnstatus = 1;
    $transType    = 'Return';

    // If newsaleitems.location is INT in DB:
    //   $location = (int)$location;
    //   $bindTypes = 'ssisssdddssisddsis'; // 11th type = i (instead of s)
    $bindTypes = 'ssisssdddsssisddsis'; // treating location as string
    $insReturnItem->bind_param(
      $bindTypes,
      $ReturnInvoice, $barcode, $ret_saleqty, $shortcode, $category, $pname,
      $ret_mrp, $ret_discount, $ret_nett, $saledate, $location, $batch, $curStock,
      $pcode, $rate, $ret_profit, $currentdatetime, $returnstatus, $transType
    );
    $insReturnItem->execute();

    $newReturned   = $returned + $retQty;
    $srcRetStatus  = ($newReturned >= $saleqty) ? 1 : 0;
    $updSourceLine->bind_param('iii', $newReturned, $srcRetStatus, $saleid);
    $updSourceLine->execute();

    $insertedAny = true;

    $key = $barcode . '||' . $batch;
    if (!isset($stockBumps[$key])) $stockBumps[$key] = 0;
    $stockBumps[$key] += $retQty;
  }

  if (!$insertedAny) {
    throw new Exception("Nothing to return (all lines already fully returned).");
  }

  // Get original master row
  $orig = mysqli_query($connection, "
    SELECT paitientcode, locationcode, oldbalance, newbalance, cancellstatus
    FROM salemaster
    WHERE saleuniqueno = '{$InvoiceNo}'
    LIMIT 1
  ");
  if (mysqli_num_rows($orig) === 0) {
    throw new Exception("Original salemaster not found for invoice {$InvoiceNo}.");
  }

  // Create the return salemaster via INSERT...SELECT (safe for NOT NULL columns)
  $SaleReturnMaster = "
    INSERT INTO salemaster
      (saledate, invoiceno, saleuniqueno, paitientcode,
       saleqty, discountamount, nettamount, profitamount, locationcode,
       entrydate, oldbalance, received, newbalance, cancellstatus,
       transactiontype, remarks, deliverystatus, addedby)
    SELECT
       '{$currentdate}'                                       AS saledate,
       '{$ReturnInvoice}'                                     AS invoiceno,
       '{$ReturnInvoice}'                                     AS saleuniqueno,
       sm.paitientcode                                        AS paitientcode,
       COALESCE( (SELECT SUM(saleqty)        FROM newsaleitems WHERE invoiceno = '{$ReturnInvoice}'), 0 ),
       COALESCE( (SELECT SUM(discountamount) FROM newsaleitems WHERE invoiceno = '{$ReturnInvoice}'), 0 ),
       COALESCE( (SELECT SUM(nettamount)     FROM newsaleitems WHERE invoiceno = '{$ReturnInvoice}'), 0 ),
       COALESCE( (SELECT SUM(profitamount)   FROM newsaleitems WHERE invoiceno = '{$ReturnInvoice}'), 0 ),
       sm.locationcode                                        AS locationcode,
       '{$currentdatetime}'                                   AS entrydate,
       sm.oldbalance                                          AS oldbalance,
       COALESCE( (SELECT SUM(nettamount) FROM newsaleitems WHERE invoiceno = '{$ReturnInvoice}'), 0 ),
       sm.newbalance                                          AS newbalance,
       sm.cancellstatus                                       AS cancellstatus,
       'Return'                                               AS transactiontype,
       '".n2($PercentageConsidered)."'                        AS remarks,
       '1'                                                    AS deliverystatus,
       ".($userid ? "'{$userid}'" : "NULL")."                 AS addedby
    FROM salemaster sm
    WHERE sm.saleuniqueno = '{$InvoiceNo}'
    LIMIT 1
  ";
  mysqli_query($connection, $SaleReturnMaster);

  // Batch-aware stock update
  foreach ($stockBumps as $key => $qAdd) {
    $qAdd = (int)$qAdd;
    if ($qAdd <= 0) continue;
    list($bc, $bt) = explode('||', $key, 2);

    $stmt = $connection->prepare("
      UPDATE newstockdetails_{$LocationCode}
         SET salereturn = salereturn + ?, currentstock = currentstock + ?
       WHERE barcode = ? AND batchno = ?
       LIMIT 1
    ");
    if (!$stmt) throw new Exception("Prepare stock update failed: ".$connection->error);
    $stmt->bind_param('iiss', $qAdd, $qAdd, $bc, $bt);
    $stmt->execute();
    // Not fatal if 0 rows affected; could log if needed
  }

  // Receipt & ledger
  $UpdatePaymentDetails = "
    UPDATE paitentmaster
       SET receipt = receipt - (SELECT COALESCE(nettamount,0) FROM salemaster WHERE saleuniqueno = '{$ReturnInvoice}')
     WHERE paitentid = (SELECT paitientcode FROM salemaster WHERE saleuniqueno = '{$ReturnInvoice}');
    INSERT INTO transactionledger
      (transactiontype, transactionmode, invoicegrn, invoicegrndate, vendorcode,
       debitamount, creditamount, createdby, clientid, remarks)
    VALUES
      (
        'Medicine', 'Salereturn', '{$ReturnInvoice}', '{$currentdate}',
        (SELECT paitientcode FROM salemaster WHERE saleuniqueno = '{$ReturnInvoice}'),
        '0',
        (SELECT COALESCE(SUM(nettamount) * -1, 0) FROM newsaleitems WHERE invoiceno = '{$ReturnInvoice}'),
        ".($userid ? "'{$userid}'" : "NULL").",
        '{$LocationCode}', '-'
      );
  ";
  if (!mysqli_multi_query($connection, $UpdatePaymentDetails)) {
    throw new Exception("Failed to update patient/ledger: ".mysqli_error($connection));
  }
  while (mysqli_more_results($connection) && mysqli_next_result($connection)) { /* drain */ }

  mysqli_commit($connection);
  echo "OK: Product returned (partial), salemaster created, batch-wise stock updated.";

} catch (mysqli_sql_exception $dbex) {
  mysqli_rollback($connection);
  http_response_code(500);
  echo "Failed (SQL): " . $dbex->getMessage();
} catch (Throwable $e) {
  mysqli_rollback($connection);
  http_response_code(500);
  echo "Failed: " . $e->getMessage();
}
