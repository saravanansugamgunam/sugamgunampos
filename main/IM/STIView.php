<?php 
include("../../connect.php");
session_cache_limiter(FALSE);
session_start();
if (!isset($_SESSION['SESS_LAST_NAME'])) {
  echo '<META HTTP-EQUIV=REFRESH CONTENT=".1; ../../index.php">';
  exit;
}

$LocationCode = $_SESSION['SESS_LOCATION']; // destination (TO)
function formatMoney($number, $fractional=false) {
  if ($fractional) $number = sprintf('%.2f', $number);
  while (true) {
    $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
    if ($replaced != $number) { $number = $replaced; } else { break; }
  }
  return $number;
}

$STOID = $_GET['stoid'] ?? '';
$STOID = mysqli_real_escape_string($connection, $STOID);

// Fetch header (including receiptstatus)
$hdr = $connection->query("
  SELECT 
    DATE_FORMAT(a.receiptdate ,'%d-%m-%Y') AS STODate,
    CONCAT('ST',a.stono,'-',a.stoid) AS STONo,
    b.locationname AS FromLocationName,
    a.nettamount,
    a.stoqty,
    a.fromlocation AS FromLocationCode,
    a.receiptstatus,
    COALESCE(a.receiptstatus2,'') AS receiptstatus2
  FROM stomaster AS a
  JOIN locationmaster AS b ON a.fromlocation = b.locationcode
  WHERE a.stouniqueno = '{$STOID}'
  LIMIT 1
");

$InvoiceDate=$InvoiceNo=$FromLocation=$TotalAmount=$TotalQty='';
$FromLocationCode='';
$receiptstatus='Not Received'; $receiptstatus2='';
if ($hdr && $hdr->num_rows) {
  $row = $hdr->fetch_assoc();
  $InvoiceDate       = $row['STODate'];
  $InvoiceNo         = $row['STONo'];
  $FromLocation      = $row['FromLocationName'];
  $TotalAmount       = $row['nettamount'];
  $TotalQty          = $row['stoqty'];
  $FromLocationCode  = $row['FromLocationCode'];
  $receiptstatus     = $row['receiptstatus'];
  $receiptstatus2    = $row['receiptstatus2'];
}
$isReceived = (strcasecmp((string)$receiptstatus, 'Received') === 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Stock Transfer IN</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<style>
  body { background:#fff; }
  .text-right { text-align:right; }
  .diff-pos { color:#0a0; font-weight:600; }
  .diff-neg { color:#b00; font-weight:600; }
  .table>thead>tr>th { white-space:nowrap; }
  .input-xs { height:26px; padding: 2px 6px; }
  .toolbar { margin: 10px 0 15px; }
</style>
</head>
<body>
<div class="content" id="content" style="max-width:1000px;margin:15px auto;">
  <div id='DivInvoice'>
    <div style="padding: 10px 5px;">
      <div class="row">
        <div class="col-xs-12 text-center">
          <div style="font:bold 22px 'Aleo';">Stock Transfer IN</div>
          <?php if ($LocationCode=='1') { ?>
            <img src="../assets/img/L1_Bill_Invoice.png" width="200" alt="" />
            <div style="font-size:12px;line-height:1.4">
              No.18, Mc.Nichols Road, Chetpet, Chennai – 31 <br>
              Phone: +91 9176606308 &nbsp;&nbsp;&nbsp;&nbsp; Email: sugamgunamhealthcenter@gmail.com <br>
              www.sugamgunam.com
            </div>
          <?php } else if ($LocationCode=='2') { ?>
            <img src="../assets/img/L1_Bill_Invoice.png" width="200" alt="" />
            <div style="font-size:12px;line-height:1.4">
              No.18, Chetpet, Chennai – 31 <br>
              Phone: +91 9176606308 &nbsp;&nbsp;&nbsp;&nbsp; Email: sugamgunamhealthcenter@gmail.com <br>
              www.sugamgunam.com
            </div>
          <?php } ?>
        </div>
      </div>

      <div class="row" style="margin-top:10px;">
        <div class="col-sm-8">
          <table class="table table-condensed" style="font-size:12px;width:auto;">
            <tr><td>STI No. :</td><td><strong><?php echo htmlspecialchars($InvoiceNo); ?></strong></td></tr>
            <tr><td>STI Date :</td><td><?php echo htmlspecialchars($InvoiceDate); ?></td></tr>
            <tr><td>From Location :</td><td><?php echo htmlspecialchars($FromLocation); ?></td></tr>
          </table>
        </div>
        <div class="col-sm-4">
          <?php if ($isReceived): ?>
            <div class="alert alert-info" style="margin-top:10px;">
              <strong>Received</strong><?php
                echo $receiptstatus2 ? " ({$receiptstatus2})" : "";
              ?> on <?php echo htmlspecialchars($InvoiceDate ?: '-'); ?>.
              Editing is disabled.
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Toolbar (hidden in read-only) -->
      <div class="toolbar clearfix" id="toolbar" style="<?php echo $isReceived ? 'display:none' : ''; ?>">
        <label class="checkbox-inline">
          <input type="checkbox" id="chkReceiveAll"> Receive all (auto fill Recv = STO)
        </label>
        <button type="button" id="btnSave" class="btn btn-primary btn-sm pull-right">
          <i class="fa fa-save"></i> Save Receipt
        </button>
        <button type="button" onclick="printDiv();" class="btn btn-default btn-sm pull-right" style="margin-right:8px;">
          <i class="fa fa-print"></i> Print
        </button>
      </div>

      <!-- Lines table -->
      <div class="table-responsive">
        <table id="tblSTI" class="table table-bordered table-striped" style="font-size:12px;">
          <thead>
            <tr>
              <th style="width:50px;">S. No</th>
              <th>Barcode</th>
              <th>Shortcode</th>
              <th>Batch No</th>
              <th class="text-right">MRP</th>
              <th class="text-right">STO Qty</th>
              <th class="text-right" style="width:120px;">Recv Qty</th>
              <th class="text-right" style="width:110px;">Diff</th>
              <th hidden>Nett Value</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $Sno = 1;
            $items = $connection->query("
              SELECT barcode,shortcode,batchcode,mrp,stoqty,nettamount,
                     COALESCE(receivedqty,0) AS receivedqty
              FROM newstoitems
              WHERE stouniqueno = '{$STOID}'
              ORDER BY barcode, mrp, batchcode
            ");
            while ($r = $items->fetch_assoc()) {
              $barcode   = htmlspecialchars($r['barcode']);
              $shortcode = htmlspecialchars($r['shortcode']);
              $batch     = htmlspecialchars($r['batchcode']);
              $mrp       = (float)$r['mrp'];
              $sto       = (float)$r['stoqty'];
              $recvQ     = (float)$r['receivedqty'];
              $nett      = (float)$r['nettamount'];

              echo "<tr data-barcode=\"{$barcode}\" data-batch=\"{$batch}\" data-mrp=\"{$mrp}\">";
              echo   "<td>{$Sno}</td>";
              echo   "<td>{$barcode}</td>";
              echo   "<td>{$shortcode}</td>";
              echo   "<td>{$batch}</td>";
              echo   "<td class='text-right'>".number_format($mrp,2,'.','')."</td>";
              echo   "<td class='text-right sto'>".number_format($sto,2,'.','')."</td>";
              echo   "<td class='text-right recv-cell'>";
              if ($isReceived) {
                echo "<span class='recv-txt'>".number_format($recvQ,2,'.','')."</span>";
              } else {
                // you can default to 0.00; or prefill to existing receivedqty if any
                $prefill = $recvQ > 0 ? $recvQ : 0;
                echo "<input type='number' min='0' step='0.01' class='form-control input-xs recv' value='".number_format($prefill,2,'.','')."'>";
              }
              echo   "</td>";
              echo   "<td class='text-right diff'>0.00</td>";
              echo   "<td hidden class='text-right'>".number_format($nett,2,'.','')."</td>";
              echo "</tr>";
              $Sno++;
            }
          ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="5" class="text-right">Totals</th>
              <th class="text-right" id="totSto">0.00</th>
              <th class="text-right" id="totRecv">0.00</th>
              <th class="text-right" id="totDiff">0.00</th>
              <th hidden></th>
            </tr>
          </tfoot>
        </table>
      </div>

      <div class="text-center" style="margin-top:10px;">
        <label>Thank you !!!</label>
      </div>
    </div>
  </div>

  <!-- Hidden values -->
  <input type="hidden" id="hidSTOID" value="<?php echo htmlspecialchars($STOID); ?>">
  <input type="hidden" id="hidFromLoc" value="<?php echo htmlspecialchars($FromLocationCode); ?>">
  <input type="hidden" id="hidToLoc" value="<?php echo htmlspecialchars($LocationCode); ?>">

  <div class="text-center" style="margin:15px 0;">
    <button type="button" onclick="printDiv();" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Print</button>
  </div>
</div>

<script src="../assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script>
var READONLY = <?php echo $isReceived ? 'true' : 'false'; ?>;

function printDiv() {
  var divToPrint = document.getElementById('DivInvoice');
  var newWin = window.open("");
  newWin.document.write(divToPrint.outerHTML);
  newWin.print();
  newWin.close();
}

function getRecvFromRow($tr){
  var $inp = $tr.find('.recv');
  if ($inp.length) return parseFloat($inp.val()) || 0;
  var txt = $tr.find('.recv-txt').text() || '0';
  return parseFloat(txt) || 0;
}

function recomputeRow($tr){
  var sto  = parseFloat($tr.find('.sto').text()) || 0;
  var recv = getRecvFromRow($tr);
  var diff = recv - sto;
  $tr.find('.diff').text(diff.toFixed(2))
                   .toggleClass('diff-pos', diff>0)
                   .toggleClass('diff-neg', diff<0);
}

function recomputeTotals(){
  var sSto=0, sRecv=0, sDiff=0;
  $('#tblSTI tbody tr').each(function(){
    var sto  = parseFloat($(this).find('.sto').text()) || 0;
    var recv = getRecvFromRow($(this));
    var diff = recv - sto;
    sSto  += sto; sRecv += recv; sDiff += diff;
  });
  $('#totSto').text(sSto.toFixed(2));
  $('#totRecv').text(sRecv.toFixed(2));
  $('#totDiff').text(sDiff.toFixed(2))
               .toggleClass('diff-pos', sDiff>0)
               .toggleClass('diff-neg', sDiff<0);
}

// initial compute (works for both modes)
$('#tblSTI tbody tr').each(function(){ recomputeRow($(this)); });
recomputeTotals();

if (!READONLY) {
  // live recompute for inputs
  $(document).on('input', '.recv', function(){
    var $tr = $(this).closest('tr');
    recomputeRow($tr);
    recomputeTotals();
  });

  // receive all
  $('#chkReceiveAll').on('change', function(){
    if (this.checked) {
      $('#tblSTI tbody tr').each(function(){
        var sto = parseFloat($(this).find('.sto').text()) || 0;
        $(this).find('.recv').val(sto.toFixed(2));
        recomputeRow($(this));
      });
      recomputeTotals();
    }
  });

  // save
  $('#btnSave').on('click', function(){
    var STOID = $('#hidSTOID').val();
    var FromLoc = $('#hidFromLoc').val();
    var ToLoc   = $('#hidToLoc').val();

    var lines = [];
    var bad=false;
    $('#tblSTI tbody tr').each(function(){
      var $tr   = $(this);
      var sto   = parseFloat($tr.find('.sto').text()) || 0;
      var recv  = getRecvFromRow($tr);
      if (isNaN(recv) || recv < 0) { bad = true; return false; }
      lines.push({
        barcode:   $tr.data('barcode'),
        batchcode: $tr.data('batch'),
        mrp:       String($tr.data('mrp')),
        stoqty:    sto,
        receivedqty: +recv.toFixed(2)
      });
    });
    if (bad) { alert("Please enter valid non-negative received quantities."); return; }

    $.ajax({
      url: "Save/SaveSTI.php",
      method: "POST",
      dataType: "json",
      data: {
        STOID: STOID,
        FROMLOC: FromLoc,
        TOLOC: ToLoc,
        lines: JSON.stringify(lines)
      }
    })
    .done(function(res){
      if (res && res.ok) {
        alert("Saved: " + res.status);
        location.reload();
      } else {
        alert("Save failed: " + (res && res.msg ? res.msg : 'Unknown error'));
      }
    })
    .fail(function(xhr){
      console.error('Save error', xhr.status, xhr.responseText);
      alert("Server error while saving.");
    });
  });
} else {
  // hide toolbar just in case
  document.getElementById('toolbar')?.remove?.();
}
</script>
</body>
</html>
