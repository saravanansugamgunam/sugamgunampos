<?php
session_cache_limiter(FALSE);
session_start();

// ===== Debug helpers (TEMPORARY) =====
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/plain; charset=UTF-8');

$LocationCode = '3'; // or: $_SESSION['SESS_LOCATION'];

function removeslashes($string){
    $string = implode("", explode("\\", $string));
    return stripslashes(trim($string));
}
function n2($v){ return number_format((float)$v, 2, '.', ''); }
function dbg($label, $value){ error_log("[SaveReturn] $label: " . (is_scalar($value)? $value : json_encode($value))); }

if (!isset($_POST["ItemID"])) {
    http_response_code(400);
    echo "Missing ItemID (expected 'saleid|qty,saleid|qty,...').";
    exit;
}

require_once("../../../connect.php");

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

    // Quick schema check for the most common 500
    $colCheck = $connection->query("SHOW COLUMNS FROM newsaleitems LIKE 'returnedqty'");
    if ($colCheck->num_rows === 0) {
        throw new Exception("Column 'returnedqty' is missing in newsaleitems. Run: ALTER TABLE newsaleitems ADD COLUMN returnedqty INT NOT NULL DEFAULT 0;");
    } 
    mysqli_begin_transaction($connection);





    // Guard against duplicate ReturnInvoice
    $chk = $connection->prepare("SELECT 1 FROM salemaster WHERE saleuniqueno = ? LIMIT 1");
    $chk->bind_param('s', $ReturnInvoice);
    $chk->execute();
    $chk->store_result();
    if ($chk->num_rows > 0) {
        throw new Exception("This return invoice already exists. Refresh the page and try again.");
    }
    $chk->close();

    // Prepared statements
    $selLine = $connection->prepare("
        SELECT saleid, invoiceno, barcode, shortcode, category, productname,
               saleqty, mrp, discountamount, nettamount, saledate, location, batchcode,
               currentstock, paitentcode, rate, profitamount,
               COALESCE(returnedqty,0) AS returnedqty
        FROM newsaleitems
        WHERE saleid = ? AND invoiceno = ?
        FOR UPDATE
    ");

    $insReturnItem = $connection->prepare("
        INSERT INTO newsaleitems
          (invoiceno, barcode, saleqty, shortcode, category, productname,
           mrp, discountamount, nettamount, saledate, location, batchcode,
           currentstock, paitentcode, rate, profitamount, entrydate, returnstatus, transactiontype)
        VALUES
          (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    ");

    $updSourceLine = $connection->prepare("
        UPDATE newsaleitems
           SET returnedqty = ?, returnstatus = ?
         WHERE saleid = ?
    ");

    $totalQty = 0; $totalDisc = 0.00; $totalNet = 0.00; $totalProfit = 0.00;




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
        $location  = $row['location'];     // If INT in schema, cast below and change bind type (see note)
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

        // IMPORTANT: If newsaleitems.location is INT in your DB, use (int)$location and change the bind string as noted.
        $bindTypes = 'ssisssdddsssisddsis'; // location treated as string
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

        $totalQty    += $ret_saleqty;
        $totalDisc   += $ret_discount;
        $totalNet    += $ret_nett;
        $totalProfit += $ret_profit;

        $key = $barcode . '||' . $batch;
        if (!isset($stockBumps[$key])) $stockBumps[$key] = 0;
        $stockBumps[$key] += $retQty;
    }

    // if (abs($totalNet) <= 0.00001) {
    //     throw new Exception("No valid quantities to return (all lines fully returned or invalid).");
    // }
 

    // Original master
    $orig = mysqli_query($connection, "
        SELECT paitientcode, locationcode, oldbalance, newbalance, cancellstatus
        FROM salemaster
        WHERE saleuniqueno = '{$InvoiceNo}'
        LIMIT 1
    ");
    if (mysqli_num_rows($orig) === 0) {
        throw new Exception("Original sale master not found for invoice {$InvoiceNo}.");
    }
    $origRow  = mysqli_fetch_assoc($orig);





    // // Summaries (negative totals)
    // $sumQ  = "SELECT 
    //             COALESCE(SUM(saleqty),0) as s_qty,
    //             COALESCE(SUM(discountamount),0) as s_disc,
    //             COALESCE(SUM(nettamount),0) as s_net,
    //             COALESCE(SUM(profitamount),0) as s_profit
    //           FROM newsaleitems
    //           WHERE invoiceno = '{$ReturnInvoice}'";
    // $sumRes = mysqli_query($connection, $sumQ);
    // $sum    = mysqli_fetch_assoc($sumRes);

    // $insM = $connection->prepare("
    //   INSERT INTO salemaster
    //     (saledate, invoiceno, saleuniqueno, paitientcode,
    //      saleqty, discountamount, nettamount, profitamount, locationcode,
    //      entrydate, oldbalance, received, newbalance, cancellstatus,
    //      transactiontype, remarks, deliverystatus, addedby)
    //   VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    // ");
    // $transactiontype = 'Return';
    // $remarks         = n2($PercentageConsidered);
    // $deliverystatus  = 1;

    // $insM->bind_param(
    //   'ssssssssssssssssss',
    //   $currentdate,
    //   $ReturnInvoice,
    //   $ReturnInvoice,
    //   $origRow['paitientcode'],
    //   (string)$sum['s_qty'],
    //   n2($sum['s_disc']),
    //   n2($sum['s_net']),
    //   n2($sum['s_profit']),
    //   (string)$origRow['locationcode'],
    //   $currentdatetime,
    //   (string)$origRow['oldbalance'],
    //   n2($sum['s_net']),
    //   (string)$origRow['newbalance'],
    //   (string)$origRow['cancellstatus'],
    //   $transactiontype,
    //   $remarks,
    //   (string)$deliverystatus,
    //   (string)($userid ?? '')
    // );
    // $insM->execute();

    // Batch-aware stock update
    foreach ($stockBumps as $key => $qAdd) {
        $qAdd = (int)$qAdd;
        if ($qAdd <= 0) continue;
        list($bc, $bt) = explode('||', $key, 2);

        $stmt = $connection->prepare("
            UPDATE newstockdetails_3 
               SET salereturn = salereturn + ?, currentstock = currentstock + ?
             WHERE barcode = ? AND batchcode = ?
             LIMIT 1
        ");
        $stmt->bind_param('iiss', $qAdd, $qAdd, $bc, $bt);
        $stmt->execute();
        if ($stmt->affected_rows === 0) {
            // Not fatal; log it for you to inspect table contents
            dbg('stock_update_skipped', ['barcode'=>$bc, 'batchcode'=>$bt, 'qty'=>$qAdd]);
        }
    }





    // Patient receipt & ledger
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
    echo "OK: Product returned (partial), batch-wise stock updated.";

} catch (mysqli_sql_exception $dbex) {
    mysqli_rollback($connection);
    http_response_code(500);
    // Print exact SQL error (TEMPORARY for debugging)
    echo "Failed (SQL): " . $dbex->getMessage();
} catch (Throwable $e) {
    mysqli_rollback($connection);
    http_response_code(500);
    echo "Failed: " . $e->getMessage();
}
