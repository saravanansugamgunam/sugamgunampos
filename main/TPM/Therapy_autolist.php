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
    <title>SugamGunam</title>
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
    <link href="../assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
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
    <link href="../assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <script src="../assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="../assets/Custom/sweetalert.css" rel="stylesheet" />
    <script src="../assets/Custom/sweetalert2.min.js"></script>
    <script src="../assets/Custom/IndexTable.js"></script>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
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

    html,
    body {
        padding: 0 !important;
    }

    .modal {
        overflow-y: auto;
    }

    .modal-open {
        overflow: auto;
    }

    .modal-open[style] {
        padding-right: 0px !important;
    }
    </style>

</head>



<script>
function Refund(x) {
    var SelectedColumn = x.cellIndex;
    var SelectedRow = x.parentNode.rowIndex;
    // alert(SelectedRow); 
    var InvoiceNo = document.getElementById("tblOutstanding").rows[SelectedRow].cells.namedItem("InvoiceNo")
        .innerHTML;
    var InvoiceDate = document.getElementById("tblOutstanding").rows[SelectedRow].cells.namedItem("InvoiceDate")
        .innerHTML;
    var InvoiceDoctorId = document.getElementById("tblOutstanding").rows[SelectedRow].cells.namedItem(
        "InvoiceDoctorId").innerHTML;
    var InvoicePaitienID = document.getElementById("tblOutstanding").rows[SelectedRow].cells.namedItem(
        "InvoicePaitienID").innerHTML;
    var InvoiceTotalAmount = document.getElementById("tblOutstanding").rows[SelectedRow].cells.namedItem(
        "InvoiceTotalAmount").innerHTML;
    var InvoiceReceivedAmount = document.getElementById("tblOutstanding").rows[SelectedRow].cells.namedItem(
        "InvoiceReceivedAmount").innerHTML;
    var InvoiceRefundAmount = document.getElementById("tblOutstanding").rows[SelectedRow].cells.namedItem(
        "InvoiceRefundAmount").innerHTML;
    var InvoiceDiscountAmount = document.getElementById("tblOutstanding").rows[SelectedRow].cells.namedItem(
        "InvoiceDiscountAmount").innerHTML;
    var InvoiceGrossAmount = document.getElementById("tblOutstanding").rows[SelectedRow].cells.namedItem(
        "InvoiceGrossAmount").innerHTML;
    var InvoiceOldBalance = document.getElementById("tblOutstanding").rows[SelectedRow].cells.namedItem(
        "InvoiceOldBalance").innerHTML;
    var InvoiceNewBalance = document.getElementById("tblOutstanding").rows[SelectedRow].cells.namedItem(
        "InvoiceNewBalance").innerHTML;
    var InvoicePaitentName = document.getElementById("tblOutstanding").rows[SelectedRow].cells.namedItem(
        "InvoicePaitentName").innerHTML;
    var InvoicePaitentMobile = document.getElementById("tblOutstanding").rows[SelectedRow].cells.namedItem(
        "InvoicePaitentMobile").innerHTML;

    document.getElementById("txtInvoiceNoRefund").value = InvoiceNo;
    document.getElementById("txtInvoiceDate").value = InvoiceDate.trim();
    document.getElementById("txtInvoiceDoctorId").value = InvoiceDoctorId.trim();
    document.getElementById("txtInvoicePaitienID").value = InvoicePaitienID.trim();
    document.getElementById("txtInvoiceTotalAmount").value = InvoiceTotalAmount.trim();
    document.getElementById("txtInvoiceReceivedAmount").value = InvoiceReceivedAmount.trim();
    document.getElementById("txtInvoiceRefundAmount").value = InvoiceRefundAmount.trim();
    document.getElementById("txtInvoiceDiscountAmount").value = InvoiceDiscountAmount.trim();
    document.getElementById("txtInvoiceGrossAmount").value = InvoiceGrossAmount.trim();
    document.getElementById("txtInvoiceOldBalance").value = InvoiceOldBalance.trim();
    document.getElementById("txtInvoiceNewBalance").value = InvoiceNewBalance.trim();
    document.getElementById("txtPaitentName").value = InvoicePaitentName.trim();
    document.getElementById("txtMobile").value = InvoicePaitentMobile.trim();


}

function CalculateBalance() {

    var total = parseInt(document.getElementById("txtTotalRefund").value);
    var val2 = parseInt(document.getElementById("txtTotalPayment").value);

    // to make sure that they are numbers
    if (!total) {
        total = 0;
    }
    if (!val2) {
        val2 = 0;
    }

    var ansD = document.getElementById("txtNewBalance");
    ansD.value = total - val2;
}

function LoadInvoiceNo() {

    var InvoiceNo = new Date().getTime();
    document.getElementById("txtInvoiceNo").value = InvoiceNo;


}

function SaveCancellation() {

    var InvoiceNo = document.getElementById("txtInvoiceNo").value;
    var Remarks = document.getElementById("txtCancelRemarks").value;


    if (InvoiceNo == "" || Remarks == "") {
        swal("Kindly provide remarks for cancellation");
    } else {
        var datas = "&InvoiceNo=" + InvoiceNo +
            "&Remarks=" + Remarks;
        // alert(datas);
        $.ajax({
            url: "Save/SaveTherapyCancellation.php",
            method: "POST",
            data: datas,
            success: function(data) {
                if (data == 1) {
                    swal("Therapy Recomendation Cancelled");
                    window.location.reload();
                } else {
                    swal("Error Saving Recomendation Cancellation");
                }



            }
        });
    }


}

function GetPointIDRD(x) {
    document.getElementById("txtInvoiceNo").value = x
}
</script>

<div id="modalTherapyCancelRecomended" class="modal fade" role="dialog">
    <div class="modal-dialog">


        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cancel Recomended </h4>
            </div>
            <div class="modal-body">
                <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' />
                <input type='hidden' id='txtInvoiceNoRefund' name='txtInvoiceNoRefund' />
                <div>

                    <textarea class='form-control' id='txtCancelRemarks' name='txtCancelRemarks'
                        placeholder='Remarks for Cancellation'></textarea>

                </div>

                <br>

                <button type="button" class="btn btn-success" onclick='SaveCancellation();'>Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>

    </div>
</div>

<body onload="LoadRecomendedTherapy();">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in">
        <span class="spinner"></span>
    </div>
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
            <?php include("CLMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->
        <div id="content" class="content">
            <div class="row">
                <!-- begin col-6 -->
                <script>
                function printDiv() {
                    var divToPrint = document.getElementById('DivPrint');
                    newWin = window.open("");
                    newWin.document.write(divToPrint.outerHTML);
                    newWin.print();
                    newWin.close();



                }

                function exportF(elem) {
                    var table = document.getElementById("data-table");
                    var html = table.outerHTML;
                    var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
                    elem.setAttribute("href", url);
                    elem.setAttribute("download", "export.xls"); // Choose the file name
                    return false;
                }

                function LoadRecomendedTherapy() {

                    var Type = 'Detail';

                    var datas = "&Type=" + Type;
                    //  alert(datas);
                    $.ajax({
                        url: "Load/LoadTherapylist_auto.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {
                            //  alert(data);
                            $('#DivPaymentHistory').html(data);


                        }
                    });
                    LoadRecomendedTherapyTotal();
                }

                function LoadRecomendedTherapyTotal() {

                    var Type = 'Detail';

                    var datas = "&Type=" + Type;
                    // alert(datas);
                    $.ajax({
                        url: "Load/LoadRefundRegisterTotal.php",
                        method: "POST",
                        data: datas,
                        dataType: "json",
                        success: function(data) {
                            // alert(data); 
                            $("#txtTotalSale").val(data[0]);

                        }
                    });
                }

                function LoadItemDetails(x) {
                    var Invoice = x;
                    document.getElementById("txtInvoiceNo").value = x;
                    var datas = "&Invoice=" + Invoice;
                    alert(datas);
                    $.ajax({
                        url: "Load/LoadProductListReturn.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {

                            $('#DivProductListReturn').html(data);


                        }
                    });

                }

                function LoadSelectedItemDetails() {


                    var Invoice = document.getElementById("txtInvoiceNo").value;
                    var datas = "&Invoice=" + Invoice;
                    // alert(datas);
                    $.ajax({
                        url: "Load/LoadProductListSelectedReturn.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {


                            $('#DivSelectedProductListReturn').html(data);


                        }
                    });

                }

                function CancellBill(x) {
                    var ItemID = x;
                    var Invoice = document.getElementById("txtInvoiceNo").value;
                    var datas = "&Invoice=" + Invoice;
                    // alert(datas);
                    $.ajax({
                        url: "Delete/CancelBill.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {
                            alert(data);

                            // $( '#DivSelectedProductListReturn' ).html(data);


                        }
                    });
                }


                function GetBillDetail(x) {


                    var SelectedColumn = x.cellIndex;
                    var SelectedRow = x.parentNode.rowIndex;


                    // var Id = document.getElementById("indextable").rows[SelectedRow].cells[0].innerHTML; 
                    var STOID = document.getElementById("data-table").rows[SelectedRow].cells.namedItem("InvoiceNo")
                        .innerHTML;
                    //alert (Id);
                    var datas = "&STOID=" + STOID;
                    // alert(datas);
                    $.ajax({
                        method: 'POST',
                        url: "SaleBillView.php",
                        data: datas,
                        success: function(response) {

                            alert(response);


                        }
                    });



                }

                function myFunction() {
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("txtItemSearch");
                    SelectionCriteria = document.getElementById("cmbSelectionCriteria").value;
                    filter = input.value.toUpperCase();
                    table = document.getElementById("tblItemwise");
                    tr = table.getElementsByTagName("tr");

                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[SelectionCriteria];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                    // alert(1);
                }
                </script>


                <div class="modal fade" id="modal-QRCode" name="modal-QRCode">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Scan QR Code </h4>
                            </div>
                            <div class="modal-bod">
                                <div class="col-md-12">
                                    <!-- begin panel -->

                                    <div class="panel-body">
                                        <form class="form-horizontal">


                                            <div class="form-group">
                                                <label>Please Scan QR Code on below
                                                    box</label>
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" placeholder=""
                                                        id='txtQRCode' name='txtQRCode' onblur='redirect()' />
                                                </div>

                                            </div>


                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>

                <script>
                function FocusQR() {

                    document.getElementById("txtQRCode").focus();
                }

                function redirect() {

                    var Invoice = document.getElementById("txtQRCode").value;

                    var str1 = "ItemDelivery.php?MID=61&invoice=";
                    var str2 = Invoice;
                    var str3 = "";
                    var BillPrintURL = str1.concat(str2, str3);
                    if (Invoice != '') {
                        window.open(BillPrintURL);
                        window.location.reload();
                    } else {

                    }

                    // break;

                    // $('#modal-QRCode').modal('toggle');
                    // $('#modal-QRCode').modal('close');
                    // $('#modal-QRCode').removeClass('in')
                }
                </script>



                <div class="col-md-12">

                    <!-- begin panel -->
                    <div class="panel panel-success">
                        <div class="panel-heading">

                            <h4 class="panel-title">Therapy Recomended List &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="hidden" class="btn btn-sm btn-info btn-xs" onclick="printDiv();"
                                    value='Print'>
                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;


                            </h4>


                        </div>

                        <div class="panel-body">


                            <br>
                            <div id="DivPaymentHistory"></div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- end panel -->

            <!-- end panel -->
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-12 -->
    </div>
    <!-- end row -->




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
    <script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
    <script src="../assets/plugins/DataTables/js/dataTables.tableTools.js"></script>
    <script src="../assets/plugins/DataTables/js/dataTables.colVis.js"></script>
    <script src="../assets/js/table-manage-colvis.demo.min.js"></script>
    <script src="../assets/js/table-manage-tabletools.demo.min.js"></script>
    <script src="../assets/js/table-manage-combine.demo.min.js"></script>

    <script src="../assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
    $(document).ready(function() {
        App.init();
        Inbox.init();
        FormPlugins.init();
        FormSliderSwitcher.init();
        FormWizard.init();

        TableManageFixedColumns.init();

    });
    </script>
</body>
<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->

</html>