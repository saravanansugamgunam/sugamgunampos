<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8">
<![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php 
  include("../../connect.php");
  session_cache_limiter(FALSE);
  session_start();

  $LocationCode = $_SESSION['SESS_LOCATION'] ?? '';
  $GroupID      = $_SESSION['SESS_GROUP_ID'] ?? '';
  $userid       = $_SESSION['SESS_MEMBER_ID'] ?? '';

  if (!isset($_SESSION['SESS_LAST_NAME'])) {
    $url='../../index.php';
    echo '<META HTTP-EQUIV=REFRESH CONTENT=".1; '.$url.'">';
    exit;
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

    <!-- ================== BEGIN PLUGINS CSS ================== -->
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
    <link href="../assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <link href="../assets/Custom/sweetalert.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/Custom/masking-input.css" />
    <script src="../assets/plugins/pace/pace.min.js"></script>

    
    <!-- Custom page styles -->
    <style>
    body {
        background: #f5f5f5 url('../assets/img/bg.png') left top repeat;
    }

    /* Trim number spinners */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    /* Make selects tidy */
    .bootstrap-select:not([class*="span"]):not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
        width: 100%;
    }

    /* Two/three-column compact form */
    .form-compact .form-row {
        margin-left: -8px;
        margin-right: -8px;
    }

    .form-compact .form-row>[class*="col-"] {
        padding-left: 8px;
        padding-right: 8px;
    }

    .form-compact .control-label {
        padding-top: 7px;
    }

    .form-compact .form-group {
        margin-bottom: 10px;
    }

    /* History table container */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    </style>
</head>

<body onload="Reset();">
    <div id="page-container" class="fade page-sidebar-minified page-header-fixed">
        <!-- Header -->
        <div id="header" class="header navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="../index.php" class="navbar-brand">
                        <img src="../assets/img/logo.png" class="media-object" width="150" alt="" />
                    </a>
                    <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                        <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown navbar-user">
                        <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14"><i
                                class="fa fa-bell-o"></i></a>
                    </li>
                    <li class="dropdown navbar-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="../assets/img/user-13.jpg" alt="" />
                            <span
                                class="hidden-xs"><?php echo htmlspecialchars($_SESSION['SESS_FIRST_NAME'] ?? ''); ?></span>
                        </a>
                    <li class="divider"></li>
                    <li><a href="../logout.php">Log Out</a></li>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li class="arrow"></li>
                        <li><a href="PasswordChange.php">Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php">Log Out</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div id="sidebar" class="sidebar"><?php include("FMSidePanel.php") ?></div>

        <!-- ================= CONTENT ================= -->

        <div id="content" class="content">

            <!-- ENTRY PANEL TOP (compact multi-column) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-entry">
                        <div class="panel-heading">
                        <div class="panel-heading-btn"> 
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> 
                            </div>
                            <h4 class="panel-title">Income / Expense Entry</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal form-compact" onsubmit="return false;">
                                <input type="hidden" id="txtInvoiceNo" name="txtInvoiceNo" />

                                <!-- Row 1: Date | Account (Location) | Group -->
                                <div class="row">

                                    <!-- Date -->
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" class="form-control" id="dtEntryDate" name="dtEntryDate"
                                                value="<?php echo date('Y-m-d');?>" />
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Account</label>
                                            <?php 
                      if($GroupID=='1'){ ?>
                                            <select class="form-control" id='cmbLocationAdmin' name='cmbLocationAdmin'>
                                                <?php
                          $sqli = "SELECT locationcode,locationname FROM locationmaster WHERE activestatus='Active'";
                          $result = mysqli_query($connection, $sqli);
                          while ($row = mysqli_fetch_array($result)) {
                            echo '<option value="'.htmlspecialchars($row['locationcode']).'">'.htmlspecialchars($row['locationname']).'</option>';
                          }
                        ?>
                                            </select>
                                            <?php } else { ?>
                                            <select class="form-control" id='cmbLocationAdmin' name='cmbLocationAdmin'>
                                                <?php
                          $sqli = "SELECT locationcode,locationname FROM locationmaster WHERE activestatus='Active' AND locationcode ='$LocationCode'";
                          $result = mysqli_query($connection, $sqli);
                          while ($row = mysqli_fetch_array($result)) {
                            echo '<option value="'.htmlspecialchars($row['locationcode']).'">'.htmlspecialchars($row['locationname']).'</option>';
                          }
                        ?>
                                            </select>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!-- Group -->
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Group</label>
                                            <select class="form-control" id="cmbGroup" name="cmbGroup"
                                                data-style="btn-blue">
                                                <option value="Clinic" selected>Clinic</option>
                                                <option value="Inventory">Inventory</option>
                                                <option value="Course">Course</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Ledger</label>
                                            <div class="input-group">
                                                <select class="selectpicker form-control" data-live-search="true"
                                                    data-style="btn-blue" id="cmbLedger" name="cmbLedger">
                                                    <option selected></option>
                                                    <?php  
                          $sqli = "SELECT ledgerid, CONCAT(ledgername,' [',b.categoryname,']') AS Ledger 
                                   FROM accountingledger AS a 
                                   JOIN accoutingcategory AS b ON a.categoryid=b.categoryid  
                                   WHERE a.ledgerstatus='Active' AND cashledger='Cash' 
                                   ORDER BY ledgername ";
                          $result = mysqli_query($connection, $sqli); 
                          while ($row = mysqli_fetch_array($result)) {
                            echo '<option value="'.htmlspecialchars($row['ledgerid']).'">'.htmlspecialchars($row['Ledger']).'</option>';
                          }	
                        ?>
                                                </select>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#addLedgerModal">+</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Tag</label>
                                            <input type="text" class="form-control" id="txtTag" name="txtTag" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Amount</label>
                                            <input type="number" class="form-control" id="txtAmount" name="txtAmount" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 3: Remarks | File | Buttons (one line) -->
                                
                                    <!-- Remarks -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Remarks</label>
                                            <textarea id="txtRemarks" name="txtRemarks" rows="2"
                                                class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- Single file control: accepts image or PDF -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Attach File (Image/PDF)</label>
                                            <input type="file" id="expenseFile" name="expenseFile"
                                                accept="image/*,application/pdf" class="form-control" />
                                        </div>
                                    </div>

                                    <!-- Buttons on the same line -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">&nbsp;</label>
                                            <div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <button type="button" class="btn btn-sm btn-success"
                                                    onclick="SaveIncomeExpenses();">Save</button>
                                                <button type="button" class="btn btn-sm btn-warning"
                                                    onclick="Reset();">Clear</button>
                                            </div>
                                        </div>
                                    </div>
                               

                        </div>
                    </div>
                </div>
            </div>

            <!-- HISTORY PANEL BELOW (DataTable with Excel/Print) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="list-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Income / Expense History</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="cmbPeriod" class="col-md-1 control-label">Period</label>
                                <div class="col-md-2">
                                    <select class="form-control" id="cmbPeriod" name="cmbPeriod"
                                        onchange="ShowHideDiv();">
                                        <option value="Today">Today</option>
                                        <option value="Yesterday">Yesterday</option>
                                        <option value="CurrentMonth">Current Month</option>
                                        <option value="Last7Days">Last 7 Days</option>
                                        <option value="Last14Days">Last 14 Days</option>
                                        <option value="Last30Days">Last 30 Days</option>
                                        <option value="Custom">Custom</option>
                                    </select>
                                </div>
                                <div class="form-group row" id="DivCustomDate" style="display:none;">
                                <label for="dtFromDate" class="col-md-1 control-label">From</label>
                                <div class="col-md-5">
                                    <input class="form-control" type="date" id="dtFromDate" name="dtFromDate" />
                                </div>

                                <label for="dtToDate" class="col-md-1 control-label">To</label>
                                <div class="col-md-5">
                                    <input class="form-control" type="date" id="dtToDate" name="dtToDate" />
                                </div>
                            </div>
                            
                                <div class="col-md-2">
                                    <button class="btn btn-primary w-100"
                                        onclick='LoadIncomeExpenseList();'>Load</button>
                                </div>
                              
                            </div>

                            

                            <div id="DivPaymentHistory" class="email-content"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- ============== END CONTENT ============== -->

        <!-- Add New Ledger Modal -->
        <div class="modal fade" id="addLedgerModal" tabindex="-1" role="dialog" aria-labelledby="addLedgerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Ledger</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Ledger Name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="newLedgerName"
                                    placeholder="Enter Ledger Name">
                            </div>
                        </div>

                        <div class="form-group" style="margin-top:16px;">
                            <label class="col-md-3 control-label">Entry Type</label>
                            <div class="col-md-5">
                                <select class='form-control' id='cmbLedgerTypeNew' name='cmbLedgerTypeNew'>
                                    <option value='Expense'>Expense</option>
                                    <option value='Income'>Income</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="saveNewLedger()">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
            data-click="scroll-top">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>

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

    <!-- DataTables core (already referenced in your project) -->
    <script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>

   
    <!-- Your other plugins -->
    <script src="../assets/plugins/DataTables/js/dataTables.fixedColumns.js"></script>
    <script src="../assets/js/table-manage-fixed-columns.demo.min.js"></script>
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
    <script src="../assets/Custom/sweetalert2.min.js"></script>
    <script src="../assets/Custom/masking-input.js" data-autoinit="true"></script>
    <script src="../assets/js/apps.min.js"></script>
    <script src="../assets/js/inbox.demo.min.js"></script>
    <!-- ================== END BASE JS ================== -->

    <script>
    // ---------- Page Init ----------
    $(document).ready(function() {
        App.init(); 
    });

    // ---------- Helpers ----------
    function LoadInvoiceNo() {
        var InvoiceNo = new Date().getTime();
        document.getElementById("txtInvoiceNo").value = InvoiceNo;
    }

    function Reset() {
        $("#txtAmount").val('');
        $("#txtRemarks").val('');
        $("#cmbGroup").val('Clinic').selectpicker("refresh");
        $("#cmbLedger").val('').selectpicker("refresh");
        $("#cmbLedger").focus();
        LoadInvoiceNo();
        LoadIncomeExpenseList();
    }

    function ShowHideDiv() {
        var isCustom = document.getElementById("cmbPeriod").value === "Custom";
        document.getElementById("DivCustomDate").style.display = isCustom ? "block" : "none";
    }

    // ---------- Save with files ----------
    function SaveIncomeExpenses() {
        var Ledger = $("#cmbLedger").val();
        var Group = $("#cmbGroup").val();
        var EntryDate = $("#dtEntryDate").val();
        var Amount = $("#txtAmount").val();
        var Remarks = $("#txtRemarks").val();
        var PaymentMode = 12;
        var InvoiceNo = $("#txtInvoiceNo").val();
        var LocationCode = $("#cmbLocationAdmin").val();
        var Tag = $("#txtTag").val();

        // var expensePhoto = $("#expensePhoto")[0].files[0];
        // var expensePDF = $("#expensePDF")[0].files[0];

        if (!Ledger || !EntryDate || !Amount || Amount === "0" || !InvoiceNo) {
            swal("Alert!", "Fill all mandatory details", "warning");
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
        formData.append('Tag', Tag);

        // single file input that accepts image or pdf; map to old fields so backend stays the same
var expenseFile = $("#expenseFile")[0].files[0];
if (expenseFile) {
  if (expenseFile.type && expenseFile.type.indexOf('pdf') !== -1) {
    formData.append('expensePDF', expenseFile);   // backend expects this key for PDFs
  } else {
    formData.append('expensePhoto', expenseFile); // backend expects this key for images
  }
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
                }
            },
            error: function() {
                swal("Error", "Failed to communicate with the server.", "error");
            }
        });
    }

    // ---------- Load & Enhance with DataTable ----------
    function enhanceToDataTable($table) {
        try {
            // Ensure an id
            if (!$table.attr('id')) $table.attr('id', 'txnTable');
            // Destroy if already initialized
            if ($.fn.dataTable.isDataTable('#' + $table.attr('id'))) {
                $('#' + $table.attr('id')).DataTable().destroy();
            }
            // Init DataTable with buttons
            $('#' + $table.attr('id')).DataTable({
                pageLength: 25,
                order: [], // keep server order
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        title: 'IncomeExpense_' + new Date().toISOString().slice(0, 10)
                    },
                    {
                        extend: 'print',
                        title: 'Income / Expense'
                    }
                ]
            });
        } catch (e) {
            console.warn('DataTable init failed:', e);
        }
    }

    function LoadIncomeExpenseList() {
  var Period = $("#cmbPeriod").val();
  var FromDate = $("#dtFromDate").val() || '';
  var ToDate = $("#dtToDate").val() || '';
  var ApprovalStatus = '%';

  var datas = "Dummy=1" +
      "&Period=" + encodeURIComponent(Period) +
      "&FromDate=" + encodeURIComponent(FromDate) +
      "&ApprovalStatus=" + encodeURIComponent(ApprovalStatus) +
      "&ToDate=" + encodeURIComponent(ToDate);

  $.ajax({
    url: "Load/LoadIncomeExpenseListc.php",
    method: "POST",
    data: datas,
    success: function(html) {
      $('#DivPaymentHistory').html(html);

     
    }
  });
}


    function LoadIncomeExpenseListUnApproved() {
        var Period = $("#cmbPeriod").val();
        var FromDate = $("#dtFromDate").val() || '';
        var ToDate = $("#dtToDate").val() || '';
        var ApprovalStatus = '0';

        var datas = "Dummy=1" +
            "&Period=" + encodeURIComponent(Period) +
            "&FromDate=" + encodeURIComponent(FromDate) +
            "&ApprovalStatus=" + encodeURIComponent(ApprovalStatus) +
            "&ToDate=" + encodeURIComponent(ToDate);

        $.ajax({
            url: "Load/LoadIncomeExpenseListc.php",
            method: "POST",
            data: datas,
            success: function(html) {
                $('#DivPaymentHistory').html(html);
 
                
            },
            error: function() {
                $('#DivPaymentHistory').html("<div class='alert alert-danger'>Failed to load list.</div>");
            }
        });
    }

    // ---------- Approve / Delete / Docs ----------
    function ApproveTransaction(transactionID) {
     
        var UserID = <?php echo json_encode($userid); ?>;
     
        if (UserID == '13' || UserID == '30') {
          
            swal({
                title: "Are you sure?",
                text: "Want to approve the Transaction!",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "No",
                        visible: true,
                        className: "btn btn-danger",
                        closeModal: true
                    },
                    confirm: {
                        text: "Yes",
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
                                swal("Approved!", "The entry has been approved successfully.",
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
            swal("Warning!", "Sorry, You don't have access to approve the transaction.", "warning");
        }
    }

    function DeleteExpenseEntry(transactionID) {
        if (!transactionID) {
            swal("Error", "Invalid Expense Entry ID.", "warning");
            return;
        }
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
                            swal("Deleted!", "The entry has been deleted successfully.", "success");
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
    }

    function ViewDocuments(invoiceNo) {
        $.ajax({
            url: 'Load/LoadViewDocument.php',
            method: 'POST',
            data: {
                invoiceno: invoiceNo
            },
            success: function(response) {
                swal({
                    title: 'Uploaded Documents',
                    html: response,
                    width: 600
                });
            },
            error: function() {
                swal("Error", "Failed to load documents.", "error");
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
                        location.reload();
                    } else {
                        swal("Error", response, "error");
                    }
                },
                error: function() {
                    swal("Error", "Failed to communicate with the server.", "error");
                }
            });
        } else {
            swal("Error", "Please enter Ledger Name", "warning");
        }
    }
    </script>
</body>

</html>