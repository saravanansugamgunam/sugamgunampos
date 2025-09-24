<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8">
  <![endif]-->
<!--[if !IE]>
  <!-->
<html lang="en">
<!--
    	<![endif]-->
<?php 
  
    include("../../connect.php");
    // $position=$_SESSION["SESS_LAST_NAME"]; 
	 session_cache_limiter(FALSE);
    session_start();
  $LocationCode = $_SESSION['SESS_LOCATION'];
  $GroupID = $_SESSION['SESS_GROUP_ID'];
  
  $userid = $_SESSION['SESS_MEMBER_ID'];	


     if(isset($_SESSION['SESS_LAST_NAME']))
    {
    //echo 'Session Active';
    
    }
    else
    {
    //echo 'Session In Active';
    $url='../../index.php';
    echo '
    <META HTTP-EQUIV=REFRESH CONTENT=".1; '.$url.'">';
    }


    ?>

<head>
    <meta charset="utf-8" />

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="../assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../assets/css/animate.min.css" rel="stylesheet" />
    <link href="../assets/css/style.min.css" rel="stylesheet" />
    <link href="../assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="../assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->
    <!-- ================== BEGIN BASE JS ================== -->
    <link href="../assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
    <link href="../assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
    <link href="../assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="../assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="../assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
    <link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
    <link href="../assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
    <link href="../assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <link href="../assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <script src="../assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link href="../assets/Custom/sweetalert.css" rel="stylesheet" />
    <script src="../assets/Custom/sweetalert2.min.js"></script>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../assets/Custom/masking-input.css" />

    <style>
    body {
        background: #f5f5f5 url('../assets/img/bg.png') left top repeat;
    }

    #f1_upload_process {
        z-index: 100;
        visibility: hidden;
        position: absolute;
        text-align: center;
        width: 400px;
    }

    .msg {
        text-align: left;
        color: #666;
        background-repeat: no-repeat;
        margin-left: 30px;
        margin-right: 30px;
        padding: 5px;
        padding-left: 30px;
    }

    .emsg {
        text-align: left;
        margin-left: 30px;
        margin-right: 30px;
        color: #666;
        background-repeat: no-repeat;
        padding: 5px;
        padding-left: 30px;
    }

    /* Chrome, Safari, Edge, Opera */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
    </style>

</head>

<body onload="Reset();">
    <!-- begin #page-loader -->

    <!-- end #page-loader -->
    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-minified page-header-fixed">
        <!-- begin #header -->
        <div id="header" class="header navbar navbar-default navbar-fixed-top">
            <!-- begin container-fluid -->
            <div class="container-fluid">
                <!-- begin mobile sidebar expand / collapse button -->
                <div class="navbar-header">
                    <a href="../index.php" class="navbar-brand">
                        <img src="../assets/img/logo.png" class="media-object" width="150" alt="" />
                    </a>
                    <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- end mobile sidebar expand / collapse button -->
                <!-- begin header navigation right -->
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown navbar-user">
                        <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">

                            <i class="fa fa-bell-o"></i>
                        </a>
                    </li>

                    <li class="dropdown navbar-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="../assets/img/user-13.jpg" alt="" />
                            <span class="hidden-xs">
                                <?php echo $_SESSION['SESS_FIRST_NAME']; ?>
                            </span>

                        </a>
                    <li class="divider"></li>
                    <li>
                        <a href="../logout.php">Log Out</a>
                    </li>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li class="arrow"></li>
                        <li>
                            <a href="PasswordChange.php">Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php">Log Out</a>
                        </li>
                    </ul>
                    </li>
                </ul>
                <!-- end header navigation right -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end #header -->

        <div id="wait"
            style="display:none;width:69px;height:189px;border:1px grey;position:absolute;top:50%;left:50%;padding:2px; z-index: 1000;">
            <img src='../assets/img/demo_wait.gif' width="64" height="64" />
            <br>Loading...
        </div>
        <!-- begin #sidebar -->
        <div id="sidebar" class="sidebar">
            <!-- begin sidebar scrollbar -->
            <!-- begin sidebar user -->
            <!-- end sidebar user -->
            <!-- begin sidebar nav -->
            <?php include("FMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->

        <script>
        function SaveIncomeExpenses() {
            var Ledger = document.getElementById("cmbLedger").value;
            var Group = document.getElementById("cmbGroup").value;
            var EntryDate = document.getElementById("dtEntryDate").value;
            var Amount = document.getElementById("txtAmount").value;
            var Remarks = document.getElementById("txtRemarks").value;
            var PaymentMode = document.getElementById("cmbPaymentMode").value;
            var InvoiceNo = document.getElementById("txtInvoiceNo").value;
            var LocationCode = document.getElementById("cmbLocationAdmin").value;

            var expensePhoto = document.getElementById("expensePhoto").files[0];
            var expensePDF = document.getElementById("expensePDF").files[0];

            if (Ledger == "" || EntryDate == "" || Amount == "" || InvoiceNo == "" || Amount == "0") {
                swal("Alert!", " Fill All details", "warning");
                return;
            }

            var formData = new FormData();
            formData.append('Ledger', Ledger);
            formData.append('Group', Group);
            formData.append('EntryDate', EntryDate);
            formData.append('Amount', Amount);
            formData.append('Remarks', Remarks);
            formData.append('PaymentMode', PaymentMode);
            formData.append('InvoiceNo', InvoiceNo);
            formData.append('LocationCode', LocationCode);

            if (expensePhoto) {
                formData.append('expensePhoto', expensePhoto);
            }
            if (expensePDF) {
                formData.append('expensePDF', expensePDF);
            }

            $.ajax({
                url: "Save/SaveIncomeExpenseC.php",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data == '1') {
                        swal("Income / Expense Entry!", "Added Successfully", "success");
                        LoadIncomeExpenseList();
                        Reset();
                    } else {
                        swal("Alert!", data, "warning");
                        LoadIncomeExpenseList();
                        Reset();
                    }
                }
            });
        }



        function SaveIncomeExpensesOld() {


            var Ledger = document.getElementById("cmbLedger").value;
            var Group = document.getElementById("cmbGroup").value;
            var EntryDate = document.getElementById("dtEntryDate").value;
            var Amount = document.getElementById("txtAmount").value;
            var Remarks = document.getElementById("txtRemarks").value;
            var PaymentMode = document.getElementById("cmbPaymentMode").value;
            var InvoiceNo = document.getElementById("txtInvoiceNo").value;
            var LocationCode = document.getElementById("cmbLocationAdmin").value;

            // alert(Ledger);

            if (Ledger == "" || EntryDate == "" || Amount == "" || InvoiceNo == "" || Amount == "0") {

                swal("Alert!", " Fill All details", "warning");

            } else {

                var datas = "&Ledger=" + Ledger + "&Group=" + Group + "&EntryDate=" + EntryDate +
                    "&Amount=" + Amount + "&Remarks=" + Remarks + "&PaymentMode=" + PaymentMode +
                    "&InvoiceNo=" + InvoiceNo +
                    "&LocationCode=" + LocationCode;
                // alert(datas);
                $.ajax({
                    url: "Save/SaveIncomeExpenseC.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == 1) {

                            swal("Income / Expense Entry!", "Added Sucessfully", "success");
                            // swal(data);
                            LoadIncomeExpenseList();
                            Reset();
                        } else {
                            swal("Alert!", data, "warning");
                            LoadIncomeExpenseList();
                            Reset();
                        }


                    }
                });
            }

        }

        function LoadInvoiceNo() {

            var InvoiceNo = new Date().getTime();
            document.getElementById("txtInvoiceNo").value = InvoiceNo;


        }


        function Reset() {


            document.getElementById("txtAmount").value = '';
            document.getElementById("txtRemarks").value = '';

            $("#cmbGroup").val('default');
            $(cmbGroup).selectpicker("refresh");

            $("#cmbLedger").val('default');
            $(cmbLedger).selectpicker("refresh");
            document.getElementById("cmbLedger").focus();
            LoadInvoiceNo();
            LoadIncomeExpenseList();
        }


        function LoadIncomeExpenseList() {


            var Period = document.getElementById("cmbPeriod").value;
            var FromDate = document.getElementById("dtFromDate").value;
            var ToDate = document.getElementById("dtToDate").value;
            var ApprovalStatus = '%';


            var Dummy = "Dummy";
            var datas = "&Dummy=" + Dummy +
                "&Period=" + Period +
                "&FromDate=" + FromDate +
                "&ApprovalStatus=" + ApprovalStatus +
                "&ToDate=" + ToDate;

            // alert(datas);
            $.ajax({
                url: "Load/LoadIncomeExpenseListc.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivPaymentHistory').html(data);


                }
            });
        }

        function LoadIncomeExpenseListUnApproved() {


            var Period = document.getElementById("cmbPeriod").value;
            var FromDate = document.getElementById("dtFromDate").value;
            var ToDate = document.getElementById("dtToDate").value;
            var ApprovalStatus = '0';


            var Dummy = "Dummy";
            var datas = "&Dummy=" + Dummy +
                "&Period=" + Period +
                "&FromDate=" + FromDate +
                "&ApprovalStatus=" + ApprovalStatus +
                "&ToDate=" + ToDate;

            // alert(datas);
            $.ajax({
                url: "Load/LoadIncomeExpenseListc.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivPaymentHistory').html(data);


                }
            });
        }


        function saveNewLedger() {
            var newLedgerName = $('#newLedgerName').val();
            var newLedgerType = $('#cmbLedgerTypeNew').val();
            if (newLedgerName !== '') {
                $.ajax({
                    url: 'Save/SaveNewLedger.php',
                    method: 'POST',
                    data: {
                        ledgerName: newLedgerName,
                        ledgertype: newLedgerType
                    },
                    success: function(response) {
                        if (response == '1') {
                            swal("Success", "Ledger Added Successfully!", "success");
                            $('#addLedgerModal').modal('hide');
                            location.reload(); // Or reload the ledger dropdown only via AJAX
                        } else {
                            swal("Error", response, "error");
                        }
                    }
                });
            } else {
                swal("Error", "Please enter Ledger Name", "warning");
            }
        }

        function ApproveTransaction(transactionID) {

            var UserID = <?php echo $userid; ?>;

            if (UserID == '13' || UserID == '30') {
                swal({
                    title: "Are you sure?",
                    text: "Want to approve the Transaction!",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "No",
                            value: null,
                            visible: true,
                            className: "btn btn-danger",
                            closeModal: true,
                        },
                        confirm: {
                            text: "Yes",
                            value: true,
                            visible: true,
                            className: "btn btn-success",
                            closeModal: true
                        }
                    },
                    dangerMode: true,
                }).then((willApprove) => {
                    if (willApprove) {
                        $.ajax({
                            url: 'Save/ApproveCashExpenseTransaction.php',
                            method: 'POST',
                            data: {
                                TransactionID: transactionID
                            },
                            success: function(response) {
                                if (response == '1') {
                                    swal("Approved!", "The entry has been Approved successfully.",
                                        "success");
                                    LoadIncomeExpenseList();
                                } else {
                                    swal("Error", response, "error");
                                }
                            },
                            error: function() {
                                swal("Error", "Failed to communicate with the server.", "error");
                            }
                        });
                    }
                });
            } else {
                swal("Warning!", "Sorry, You Don't have access to approve the transaction.", "warning");
            }



        }

        function DeleteExpenseEntry(transactionID) {
            if (transactionID !== '') {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this entry!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: 'Save/DeleteExpenseEntry.php',
                            method: 'POST',
                            data: {
                                TransactionID: transactionID
                            },
                            success: function(response) {
                                if (response == '1') {
                                    swal("Deleted!", "The entry has been deleted successfully.",
                                        "success");
                                    LoadIncomeExpenseList();
                                } else {
                                    swal("Error", response, "error");
                                }
                            },
                            error: function() {
                                swal("Error", "Failed to communicate with the server.", "error");
                            }
                        });
                    }
                });
            } else {
                swal("Error", "Invalid Expense Entry ID.", "warning");
            }
        }

        function ViewDocuments(invoiceNo) {
            $.ajax({
                url: 'Load/LoadViewDocument.php',
                method: 'POST',
                data: {
                    invoiceno: invoiceNo
                },
                success: function(response) {
                    alert(response);
                    // Show in modal or alert
                    swal({
                        title: 'Uploaded Documents',
                        html: response,
                        width: 600
                    });
                }
            });
        }




        function ShowHideDiv() {

            var cmbPeriod = document.getElementById("cmbPeriod");
            var DivCustomDate = document.getElementById("DivCustomDate");
            DivCustomDate.style.display = cmbPeriod.value == "Custom" ? "inline-block" : "none";

        }
        </script>


        <style>
        .bootstrap-select:not([class*="span"]):not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 320px;
        }
        </style>

 
<style>
  /* Reduce table row padding */
  #tblDenoms td, 
  #tblDenoms th {
    padding: 4px 6px !important;   /* default is ~8px */
    font-size: 12px;               /* slightly smaller text */
    vertical-align: middle;        /* align numbers nicely */
  }

  /* Make the denomination input shorter */
  #tblDenoms .dnm-count {
    height: 30px;       /* reduce input box height */
    padding: 2px 4px;   /* tighter padding */
    font-size: 12px;
  }
</style>

        
<div id="content" class="content">
        <!-- Cash Settlement (Bootstrap 3) -->
<div class="container-fluid">

<!-- Filters row -->
<div class="row" style="margin-bottom:15px;">
  <div class="col-md-2">
    <label>From</label>
    <input type="date" id="fromDate"  max="<?= date('Y-m-d') ?>" class="form-control">
  </div>
  <div class="col-md-2">
    <label>To</label>
    <input type="date" id="toDate"  max="<?= date('Y-m-d') ?>" class="form-control">
  </div>
  <div class="col-md-2">
    <label style="visibility:hidden;display:block;">Load</label>
    <button id="btnLoad" class="btn btn-primary btn-block">Load</button>
  </div>
  <div class="col-md-3 col-md-offset-3 text-right">
    <h5 style="margin-top:28px;">Date: <span id="asOfDate"></span></h5>
  </div>
</div>

<!-- Two panels side by side -->
<div class="row">

  <!-- Left Panel: Sales -->
  <div class="col-md-6">
    <div class="panel panel-inverse" data-sortable-id="sales-panel">
      <div class="panel-heading">
        <h4 class="panel-title">Clinic Cash Settlement</h4>
      </div>
      <div class="panel-body" style="padding:0;">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-condensed" id="tblSales" style="margin:0;">
            <thead>
              <tr>
                <th style="width:18%">Date</th>
                <th class="text-right">Consulting</th>
                <th class="text-right">Medicine</th>
                <th class="text-right">Therapy</th>
                <th class="text-right">Total</th>
              </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
              <tr class="active">
                <th>Total</th>
                <th class="text-right" id="ftConsulting">0</th>
                <th class="text-right" id="ftMedicine">0</th>
                <th class="text-right" id="ftTherapy">0</th>
                <th class="text-right" id="ftTotal">0</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Right Panel: Denominations -->
  <div class="col-md-6">
    <div class="panel panel-inverse" data-sortable-id="denom-panel">
      <div class="panel-heading">
        <h4 class="panel-title">Cash Denomination</h4>
        <div class="panel-heading-btn">
          <button class="btn btn-xs btn-default" id="btnClearDenoms" title="Clear">Clear</button>
        </div>
      </div>
      <div class="panel-body" style="padding:0;">
        <div class="table-responsive">
          <table class="table table-bordered table-condensed" id="tblDenoms" style="margin:0;">
            <thead>
              <tr>
                <th>Denomination</th>
                <th class="text-right">Count</th>
                <th class="text-right">Total</th>
              </tr>
            </thead>
            <tbody><!-- built by JS --></tbody>
            <tfoot>
              <tr class="active">
                <th>Total</th><th></th>
                <th class="text-right" id="dnmTotal">0</th>
              </tr>
              <tr class="active">
                <th>System Cash</th><th></th>
                <th class="text-right" id="systemCash">0</th>
              </tr>
              <tr class="active">
                <th>Difference</th><th></th>
                <th class="text-right" id="difference">0</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="row" style="padding:10px;">
          <div class="col-xs-6">
            <button class="btn btn-success btn-block" id="btnSave">Save Settlement</button>
          </div>
          <div class="col-xs-6">
            <button class="btn btn-default btn-block" id="btnPrint">Print</button>
          </div>
        </div>
      </div>
    </div>
  </div>

</div><!-- /.row -->
</div><!-- /.container-fluid -->



        <script>
// ====== Helpers ======
const fmt = n => (Number(n || 0)).toLocaleString('en-IN');
const toNum = v => {
  if (v === null || v === undefined || v === '') return 0;
  return Number(String(v).replace(/,/g, '')) || 0;
};

// ====== Denominations UI build ======
const DENOMS = [500, 200, 100, 50, 20, 10, 5, 1]; // adjust to your usage
function buildDenoms() {
  const tb = document.querySelector('#tblDenoms tbody');
  tb.innerHTML = '';
  DENOMS.forEach(v => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>₹ ${fmt(v)}</td>
      <td class="text-end">
        <input type="number" min="0" data-denom="${v}" class="form-control form-control-sm text-end dnm-count" value="0">
      </td>
      <td class="text-end dnm-line" data-denom="${v}">0</td>
    `;
    tb.appendChild(tr);
  });
}
buildDenoms();

// ====== Denomination calculations ======
function recalcDenoms() {
  let total = 0;
  document.querySelectorAll('.dnm-count').forEach(inp => {
    const denom = Number(inp.dataset.denom);
    const cnt = toNum(inp.value);
    const line = denom * cnt;
    const td = document.querySelector(`.dnm-line[data-denom="${denom}"]`);
    td.textContent = fmt(line);
    total += line;
  });
  document.getElementById('dnmTotal').textContent = fmt(total);
  // Compare with system cash
  const system = toNum(document.getElementById('systemCash').textContent);
  const diff = total - system;
  document.getElementById('difference').textContent = fmt(diff);
  document.getElementById('difference').classList.toggle('text-danger', diff !== 0);
  document.getElementById('difference').classList.toggle('text-success', diff === 0);
}
document.addEventListener('input', e => {
  if (e.target.classList.contains('dnm-count')) recalcDenoms();
});
document.getElementById('btnClearDenoms').addEventListener('click', () => {
  document.querySelectorAll('.dnm-count').forEach(i => i.value = 0);
  recalcDenoms();
});

// ====== Sales table population ======



async function isSettled(range) {
  const res = await fetch('Load/LoadCheckCashSettlement.php', {
    method: 'POST',
    headers: {'Content-Type':'application/x-www-form-urlencoded'},
    body: new URLSearchParams(range)
  });
  return res.json(); // {ok,true, settled:bool, conflict:{from,to}, allowed_to: 'YYYY-MM-DD'|null}
}

async function loadSales() {
  const fromDate = document.getElementById('fromDate').value;
  const toDate   = document.getElementById('toDate').value;

  const tb = document.querySelector('#tblSales tbody');
  tb.innerHTML = '<tr><td colspan="5" class="text-center">Loading…</td></tr>';

  // ✅ Overlap (and touching) check
  const check = await isSettled({ from: fromDate, to: toDate });
  if (check && check.ok && check.settled) {
    const msg = check.allowed_to
      ? `Already settled between ${check.conflict.from} and ${check.conflict.to}. 
         You can only close up to ${check.allowed_to}.`
      : `Already settled between ${check.conflict.from} and ${check.conflict.to}.`;
    tb.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Already settled</td></tr>';

    // lock save and show message
    const btnSave = document.getElementById('btnSave');
    btnSave.disabled = true; btnSave.title = 'Already settled';
    swal('Already settled', msg, 'warning');

    // Optional: auto-adjust the "To" date to allowed_to (if returned)
    if (check.allowed_to) {
      document.getElementById('toDate').value = check.allowed_to;
    }

    // Reset totals on UI
    document.getElementById('ftConsulting').textContent = '0';
    document.getElementById('ftMedicine').textContent   = '0';
    document.getElementById('ftTherapy').textContent    = '0';
    document.getElementById('ftTotal').textContent      = '0';
    document.getElementById('systemCash').textContent   = '0';
    recalcDenoms();
    return;
  } else {
    const btnSave = document.getElementById('btnSave');
    btnSave.disabled = false; btnSave.title = '';
  }

  // ... proceed to fetch and render datewise rows as you already do
 




  try {
    const res = await fetch('Load/LoadCashSettlementDatewise.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ from: fromDate, to: toDate })
    });

    const raw = await res.text();
    console.log('RAW response:', raw);

    if (!res.ok) {
      tb.innerHTML = `<tr><td colspan="5" class="text-danger text-center">HTTP ${res.status}</td></tr>`;
      return;
    }

    let data;
    try {
      data = JSON.parse(raw);
    } catch (e) {
      tb.innerHTML = `<tr><td colspan="5" class="text-danger text-center">Invalid JSON</td></tr>`;
      console.error('JSON parse error:', e);
      return;
    }

    tb.innerHTML = '';

    if (!data || !data.success) {
      tb.innerHTML = `<tr><td colspan="5" class="text-danger text-center">Server error</td></tr>`;
      console.error('Server error payload:', data);
      return;
    }

    const rows = Array.isArray(data.rows) ? data.rows : [];
    if (rows.length === 0) {
      tb.innerHTML = `<tr><td colspan="5" class="text-center">No data</td></tr>`;
    }

    let sumConsult = 0, sumMed = 0, sumTher = 0, sumTotal = 0;

    rows.forEach(r => {
      const consulting = toNum(r.consulting ?? r.Con ?? r.consult ?? 0);
      const medicine   = toNum(r.medicine   ?? r.Med ?? 0);
      const therapy    = toNum(r.therapy    ?? r.Thy ?? 0);
      const total      = consulting + medicine + therapy;

      sumConsult += consulting;
      sumMed     += medicine;
      sumTher    += therapy;
      sumTotal   += total;

      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${r.date_ddmmyyyy || r.date || r.dt || ''}</td>
        <td class="text-right">${fmt(consulting)}</td>  <!-- BS3 class -->
        <td class="text-right">${fmt(medicine)}</td>
        <td class="text-right">${fmt(therapy)}</td>
        <td class="text-right">${fmt(total)}</td>
      `;
      tb.appendChild(tr);
    });

    // Footer totals
    document.getElementById('ftConsulting').textContent = fmt(sumConsult);
    document.getElementById('ftMedicine').textContent   = fmt(sumMed);
    document.getElementById('ftTherapy').textContent    = fmt(sumTher);
    document.getElementById('ftTotal').textContent      = fmt(sumTotal);

    // ✅ System Cash = total of datewise transactions
    document.getElementById('systemCash').textContent = fmt(sumTotal);

    recalcDenoms();

  } catch (err) {
    console.error('Fetch error:', err);
    tb.innerHTML = `<tr><td colspan="5" class="text-danger text-center">Network/JS error</td></tr>`;
  }
}




document.getElementById('btnLoad').addEventListener('click', loadSales);

// Defaults
(function initDefaults() {
  const today = new Date();
  const toISO = d => d.toISOString().slice(0,10);
  document.getElementById('toDate').value = toISO(today);
  const d2 = new Date(today); d2.setDate(d2.getDate()-2); // last 3 days by default
  document.getElementById('fromDate').value = toISO(d2);
  document.getElementById('asOfDate').textContent = today.toLocaleDateString('en-GB');
})();
document.getElementById('btnPrint')?.addEventListener('click', () => window.print());







document.getElementById('btnSave').addEventListener('click', async () => {
  const payload = {
    from: document.getElementById('fromDate').value,
    to: document.getElementById('toDate').value,
    systemCash: toNum(document.getElementById('systemCash').textContent), // ← from footer (sum of datewise)
    dnmTotal: toNum(document.getElementById('dnmTotal').textContent),
    difference: toNum(document.getElementById('difference').textContent),
    notes: '', // optional: wire a textarea if you want
    denominations: Array.from(document.querySelectorAll('.dnm-count')).map(i => ({
      denom: Number(i.dataset.denom),
      count: toNum(i.value)
    }))
  };

  try {
    const res = await fetch('Save/SaveCashSettlement.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(payload)
    });
    const data = await res.json();
    if (data.success) {
      swal('Saved!', 'Cash settlement saved successfully. ID: ' + data.id, 'success');
    } else {
      swal('Error', data.msg || 'Failed to save', 'error');
    }
  } catch(err) {
    console.error(err);
    swal('Error', 'Network/Server error', 'error');
  }
});

</script>



    <!-- end #content -->
    <!-- begin theme-panel -->
    <!-- end theme-panel -->
    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="../assets/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script src="../assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
    <script src="../assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!--[if lt IE 9]>
  <script src="../assets/crossbrowserjs/html5shiv.js"></script>
  <script src="../assets/crossbrowserjs/respond.min.js"></script>
  <script src="../assets/crossbrowserjs/excanvas.min.js"></script>
  <![endif]-->
    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/plugins/jquery-cookie/jquery.cookie.js"></script>
    <script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
    <script src="../assets/plugins/DataTables/js/dataTables.fixedColumns.js"></script>
    <script src="../assets/js/table-manage-fixed-columns.demo.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->



    <script src="../assets/js/inbox.demo.min.js"></script>
    <script src="../assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="../assets/plugins/bootstrap-daterangepicker/moment.js"></script>
    <script src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../assets/js/form-plugins.demo.min.js"></script>
    <script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="../assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
    <script src="../assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="../assets/plugins/masked-input/masked-input.min.js"></script>
    <script src="../assets/plugins/password-indicator/js/password-indicator.js"></script>
    <script src="../assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
    <script src="../assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
    <script src="../assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
    <script src="../assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="../assets/plugins/switchery/switchery.min.js"></script>
    <script src="../assets/plugins/powerange/powerange.min.js"></script>
    <script src="../assets/js/form-slider-switcher.demo.min.js"></script>
    <script src="../assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
    <script src="../assets/js/form-wizards.demo.min.js"></script>
    <script src="..assets/js/form-plugins.demo.min.js"></script>

    <script src="../assets/Custom/masking-input.js" data-autoinit="true"></script>
    <script src="../assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
    $(document).ready(function() {
        App.init();
        Inbox.init();
        FormPlugins.init();
        FormSliderSwitcher.init();
        FormWizard.init();
    });
    </script>
</body>
<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->

</html>