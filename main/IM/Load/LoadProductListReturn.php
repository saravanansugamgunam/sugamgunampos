<?php
// Load/LoadProductListReturn.php
session_cache_limiter(FALSE);
session_start();
header('Content-Type: text/html; charset=UTF-8');

if (!isset($_POST['Invoice'])) {
  echo "<div style='color:#c00'>Invoice not provided.</div>";
  exit;
}

require_once("../../../connect.php"); // provides $connection (mysqli)
$Invoice = mysqli_real_escape_string($connection, $_POST['Invoice']);

/*
  IMPORTANT:
  - We use COALESCE(returnedqty,0). If your schema doesn’t have it, run:
      ALTER TABLE newsaleitems ADD COLUMN returnedqty INT NOT NULL DEFAULT 0;
  - We keep returnstatus=0 filter (shows only lines not fully returned).
*/
$sql = "
  SELECT
    saleid,            -- 0
    barcode,           -- 1
    shortcode,         -- 2
    batchcode,         -- 3
    expirydate,        -- 4
    saleqty,           -- 5
    mrp,               -- 6
    discountamount,    -- 7 (line-level discount)
    ((saleqty * mrp) - discountamount) AS line_total, -- 8
    COALESCE(returnedqty,0) AS returnedqty            -- 9
  FROM newsaleitems
  WHERE invoiceno = '$Invoice'
    AND returnstatus = 0
  ORDER BY saleid ASC
";

$res = mysqli_query($connection, $sql);
if (!$res) {
  echo "<div style='color:#c00'>Query failed: ".htmlspecialchars(mysqli_error($connection))."</div>";
  exit;
}

function n2($v){ return number_format((float)$v, 2, '.', ''); }
?>
<style>
table.blueTable { border:1px solid #1C6EA4; background:#EEEEEE; width:100%; text-align:left; border-collapse:collapse;}
table.blueTable td, table.blueTable th { border:1px solid #AAAAAA; padding:1px 1px; text-align:center;}
table.blueTable tbody td { font-size:13px; text-align:center;}
table.blueTable tr:nth-child(even) { background:#D0E4F5;}
table.blueTable thead{
  background:#83b3e4;
  background:-moz-linear-gradient(top,#5592bb 0%,#327cad 66%,#1C6EA4 100%);
  background:-webkit-linear-gradient(top,#5592bb 0%,#327cad 66%,#1C6EA4 100%);
  background:linear-gradient(to bottom,#5592bb 0%,#327cad 66%,#1C6EA4 100%);
  border-bottom:1px solid #444444;
}
table.blueTable thead th{ font-size:12px; font-weight:normal; color:#fff; border-left:1px solid #D0E4F5; padding:5px 10px;}
table.blueTable thead th:first-child{ border-left:none;}
table.blueTable tfoot{ font-size:12px; font-weight:bold; color:#fff; background:#D0E4F5; border-top:2px solid #444;}
table.blueTable tfoot td{ font-size:12px;}
table.blueTable tfoot .links{ text-align:right;}
table.blueTable tfoot .links a{ display:inline-block; background:#1C6EA4; color:#fff; padding:2px 5px; border-radius:5px;}
.small-note{font-size:11px;color:#555;}
</style>

<table id="tblReturnItems" class="blueTable">
  <thead>
    <tr>
      <th><input type="checkbox" id="chkAll"></th>
      <th>S.No</th>
      <th>Barcode</th>
      <th>Code</th>
      <th>Batch</th>
      <th>Exp.Dt</th>
      <th>Qty Sold</th>
      <th>Already Returned</th>
      <th>Returnable</th>
      <th>MRP</th>
      <th>Disc.</th>
      <th>Line Total</th>
      <th>Return Qty</th>
      <th>Return Amt</th>
    </tr>
  </thead>
  <tbody>
<?php
$i = 1;
while ($row = mysqli_fetch_row($res)) {
  $saleid   = (int)$row[0];
  $barcode  = $row[1];
  $code     = $row[2];
  $batch    = $row[3];
  $exp      = $row[4] ?  : '';
  $qty      = (int)$row[5];
  $mrp      = (float)$row[6];
  $disc     = (float)$row[7];
  $lt       = (float)$row[8];
  $retPrev  = (int)$row[9];

  $returnable = max(0, $qty - $retPrev);
  // per-unit net (based on line total / sold qty)
  $unitNet = ($qty > 0) ? ($lt / $qty) : 0.0;

  echo "<tr>
    <td>
      <input type='checkbox' class='row-check'
             data-saleid='{$saleid}'
             data-unitnet='".n2($unitNet)."' />
    </td>
    <td>{$i}</td>
    <td>".htmlspecialchars($barcode)."</td>
    <td>".htmlspecialchars($code)."</td>
    <td>".htmlspecialchars($batch)."</td>
    <td>{$exp}</td>
    <td>{$qty}</td>
    <td>{$retPrev}</td>
    <td>{$returnable}</td>
    <td>".n2($mrp)."</td>
    <td>".n2($disc)."</td>
    <td>".n2($lt)."</td>
    <td>
      <input type='number' class='ret-qty' min='0' step='1' value='0'
             max='{$returnable}' data-max='{$returnable}'
             style='width:60px; text-align:right;' />
    </td>
    <td class='ret-amt'>0.00</td>
  </tr>";
  $i++;
}
?>
  </tbody>
</table>

<div class="small-note">Tip: tick a row and set <b>Return Qty</b> (max = Returnable). Gross & Final values update automatically.</div>
<br/>
<div>
  <label>Return Value&nbsp;&nbsp;</label>
  <input style="border-radius:4px;padding:5px;text-align:right;"
         id="txtGrossTotalReturn" name="txtGrossTotalReturn" value="0.00" disabled />
</div>
<div style="margin-top:6px;">
  <label>% Deducted&nbsp;&nbsp;</label>
  <input style="border-radius:4px;padding:5px;text-align:right;width:90px;"
         id="txtPercentageDeducted" name="txtPercentageDeducted" value="0" />%
</div>
<div style="margin-top:6px;">
  <label>Final Return Value&nbsp;&nbsp;</label>
  <input style="border-radius:4px;padding:5px;text-align:right;"
         id="txtTotalReturn" name="txtTotalReturn" value="0.00" disabled />
</div>

<!-- Hidden payload (pairs like saleid|qty,saleid|qty) -->
<input type="hidden" id="txtItemId" name="txtItemId" value="" />

<script>
// Use parent page's jQuery (do NOT include jQuery here).

function toNum(v){ if(v==null) return 0; v=(v+'').replace(/,/g,'').trim(); var n=parseFloat(v); return isNaN(n)?0:n; }
function f2(n){ return (toNum(n)).toFixed(2); }
function clampInt(val,min,max){
  val = Math.floor(toNum(val));
  if(!isFinite(val)) val=0;
  if(val<min) val=min;
  if(val>max) val=max;
  return val;
}

function CalculateFinalValue(){
  var gross = toNum(document.getElementById('txtGrossTotalReturn')?.value);
  var pct   = toNum(document.getElementById('txtPercentageDeducted')?.value);
  var fin   = gross - (gross * pct/100);
  document.getElementById('txtTotalReturn').value = f2(fin);
}

function recalcReturn(){
  var ids = [];
  var gross = 0;

  document.querySelectorAll('#tblReturnItems tbody tr').forEach(function(tr){
    var cb = tr.querySelector('.row-check');
    var q  = tr.querySelector('.ret-qty');
    var amtCell = tr.querySelector('.ret-amt');
    if(!cb || !q || !amtCell) return;

    var max = toNum(q.getAttribute('data-max'));
    var qty = clampInt(q.value, 0, max);
    if (qty != toNum(q.value)) q.value = qty;

    var unitNet = toNum(cb.getAttribute('data-unitnet'));
    var lineRet = qty * unitNet;
    amtCell.textContent = f2(lineRet);

    if (cb.checked && qty > 0){
      ids.push(cb.getAttribute('data-saleid') + '|' + qty);
      gross += lineRet;
    }
  });

  document.getElementById('txtGrossTotalReturn').value = f2(gross);
  document.getElementById('txtItemId').value = ids.join(',');
  CalculateFinalValue();
}

function onRowCheckChange(e){
  var tr = e.target.closest('tr');
  var q  = tr?.querySelector('.ret-qty');
  if(!q) return;
  if (e.target.checked){
    var max = toNum(q.getAttribute('data-max'));
    if (toNum(q.value) <= 0 && max > 0) q.value = 1;
  }
  recalcReturn();
}

function onQtyChange(e){
  var inp = e.target;
  var tr  = inp.closest('tr');
  var cb  = tr?.querySelector('.row-check');
  var max = toNum(inp.getAttribute('data-max'));
  inp.value = clampInt(inp.value, 0, max);
  if (cb){ cb.checked = toNum(inp.value) > 0; }
  recalcReturn();
}

$(function(){
  // select all toggle
  $(document).on('change', '#chkAll', function(){
    var on = this.checked;
    $('#tblReturnItems .row-check').each(function(){
      this.checked = on;
      // auto-set qty=1 only if returnable >=1 and currently 0
      var tr = this.closest('tr');
      var q  = tr?.querySelector('.ret-qty');
      var max = q ? toNum(q.getAttribute('data-max')) : 0;
      if (on && q && toNum(q.value)<=0 && max>0) q.value = 1;
    });
    recalcReturn();
  });

  // row interactions
  $(document).on('change', '#tblReturnItems .row-check', onRowCheckChange);
  $(document).on('input change', '#tblReturnItems .ret-qty', onQtyChange);
  $(document).on('input blur', '#txtPercentageDeducted', CalculateFinalValue);

  recalcReturn(); // initial compute
});
</script>
