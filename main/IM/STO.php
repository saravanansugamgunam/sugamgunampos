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

if (isset($_SESSION['SESS_LAST_NAME'])) {
    //echo 'Session Active';

} else {
    //echo 'Session In Active';
    $url = '../../index.php';
    echo '
    <META HTTP-EQUIV=REFRESH CONTENT=".1; ' . $url . '">';
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
    </style>

</head>


<body onload="LoadInvoiceNo();">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in">
        <span class="spinner"></span>
    </div>
    <!-- end #page-loader -->
    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
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

        <div id="wait" style="display:none;width:69px;height:189px;border:1px grey;position:absolute;top:50%;left:50%;padding:2px; z-index: 1000;">
            <img src='../assets/img/demo_wait.gif' width="64" height="64" />
            <br>Loading...
        </div>
        <!-- begin #sidebar -->
        <div id="sidebar" class="sidebar">
            <!-- begin sidebar scrollbar -->
            <!-- begin sidebar user -->
            <!-- end sidebar user -->
            <!-- begin sidebar nav -->
            <?php include("IMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->
        <div id="content" class="content">
            <div class="row">
                <!-- begin col-6 -->
                <script>
                    function DisableTransferLocation() {
                        document.getElementById("cmbToLocation").disabled = true;
                    }

                    function LoadProductList() {

                        var STOUniqueNo = document.getElementById("txtInvoiceNo").value;
                        var datas = "&STOUniqueNo=" + STOUniqueNo;
                        // alert(datas);
                        $.ajax({
                            url: "Load/LoadSTOItemList.php",
                            method: "POST",
                            data: datas,
                            success: function(data) {

                                $('#DivSTOList').html(data);

                            }
                        });
                        LoadInvoiceTotal();

                    }


                    function LoadInvoiceTotal() {

                        var STOUniqueNo = document.getElementById("txtInvoiceNo").value;
                        var datas = "&STOUniqueNo=" + STOUniqueNo;
                        // alert(datas);
                        $.ajax({
                            url: "Load/LoadSTOTotal.php",
                            method: "POST",
                            data: datas,
                            dataType: "json",
                            success: function(data) {
                                // alert(data);
                                $("#txtNettAmount").val(data[0]);
                                $("#txtTotalProfitAmount").val(data[1]);
                                $("#txtTotalSaleQty").val(data[2]);
                                $("#txtTotalDiscountAmount").val(data[3]);

                            }
                        });
                    }



                    function LoadMultipleItems() {
                        var Barcode = document.getElementById("txtBarcode").value;
                        var LocationCode = <?php echo $LocationCode ?>;
                        // var BillType = document.getElementById("cmbBillType").value;
                        var datas = "&Barcode=" + Barcode + "&LocationCode=" + LocationCode;

                        $.ajax({
                            url: "Load/LoadBarcodeDetailsBilling_STO.php",
                            method: "POST",
                            data: datas,
                            success: function(data) {
                                $('#DivStockList').html(data);
                            }
                        });
                    }


                    function LoadBarcodeDetails_STO(x) {

                        var StockItemid = x;
                        var LocationCode = <?php echo $LocationCode ?>;
                        // var BillType = document.getElementById("cmbBillType").value;
                        var datas = "&StockItemid=" + StockItemid + "&LocationCode=" + LocationCode;

                        $.ajax({
                            url: "Load/LoadBarcodeDetails_STO.php",
                            method: "POST",
                            data: datas,
                            dataType: "json",
                            success: function(data) {
                                $('#modalStockList').modal('hide');
                                $("#txtShortcode").val(data[0]);
                                $("#txtProductName").val(data[1]);
                                $("#txtBatchcode").val(data[2]);
                                $("#txtCurrentStock").val(data[4]);
                                $("#txtRate").val(data[5]);
                                $("#txtCategory").val(data[6]);
                                $("#txtMRP").val(data[7]);
                                $("#txtTotalAmount").val(data[7]);
                                $("#txtLocationCode").val(data[8]);
                                $("#txtExpiry").val(data[9]);
                                document.getElementById("txtQty").focus();

                                var CurrentStockQty = document.getElementById("txtCurrentStock").value;


                                if (Barcode != "") {


                                    if (CurrentStockQty == 0) {
                                        swal("Alert!",
                                            "Invalid Barcode or No Stock in the selected barcode,       PRESS ESC Key",
                                            "warning");

                                        // document.getElementById("txtBarcode").value = '';
                                        // document.getElementById("txtRate").value = '';
                                        // document.getElementById("txtBarcode").focus();
                                    } else {
                                        // SaveSTOItems();
                                    }
                                }


                            }
                        });
                    }


                    function LoadBarcodeDetails() {

                        var Barcode = document.getElementById("txtBarcode").value;
                        var LocationCode = <?php echo $LocationCode ?>;
                        // var BillType = document.getElementById("cmbBillType").value;
                        var datas = "&Barcode=" + Barcode + "&LocationCode=" + LocationCode;

                        $.ajax({
                            url: "Load/LoadBarcodeDetailsBilling.php",
                            method: "POST",
                            data: datas,
                            dataType: "json",
                            success: function(data) {
                                $("#txtCurrentStock").val(data[4]);
                                if (data[10] > 1) {

                                    LoadMultipleItems();
                                    $('#modalStockList').modal('show');

                                } else {
                                    $("#txtShortcode").val(data[0]);
                                    $("#txtProductName").val(data[1]);
                                    $("#txtBatchcode").val(data[2]);
                                    $("#txtCurrentStock").val(data[4]);
                                    $("#txtRate").val(data[5]);
                                    $("#txtCategory").val(data[6]);
                                    $("#txtMRP").val(data[7]);
                                    $("#txtTotalAmount").val(data[7]);
                                    $("#txtLocationCode").val(data[8]);
                                    $("#txtExpiry").val(data[9]);
                                    // document.getElementById("txtQty").focus();

                                }


                                var CurrentStockQty = document.getElementById("txtCurrentStock").value;


                                if (Barcode != "") {


                                    if (CurrentStockQty == 0) {
                                        swal("Alert!",
                                            "Invalid  or No Stock in the selected barcode,       PRESS ESC Key",
                                            "warning");

                                        // document.getElementById("txtBarcode").value = '';
                                        // document.getElementById("txtRate").value = '';
                                        // document.getElementById("txtBarcode").focus();
                                    } else {
                                        // SaveSTOItems();
                                    }
                                }


                            }
                        });
                    }


                    function LoadInvoiceNo() {

                        var InvoiceNo = new Date().getTime();
                        document.getElementById("txtInvoiceNo").value = InvoiceNo;
                        LoadProductList();

                    }


                    function SaveSTOItems() {

                        var Currentstock = document.getElementById("txtCurrentStock").value;
                        var BillQty = document.getElementById("txtQty").value;

                        if (Number(BillQty) > Number(Currentstock)) {
                            swal("Alert!", "Bill Qty should not above current stock", "warning");
                            document.getElementById("txtQty").value = "";
                            document.getElementById("txtQty").focus();
                        } else {

                            var STOUniqueNo = document.getElementById("txtInvoiceNo").value;
                            var ProductCode = document.getElementById("cmbProductCode").value;
                            var Qty = document.getElementById("txtQty").value;

                            var Shortcode = document.getElementById("txtShortcode").value;
                            var Category = document.getElementById("txtCategory").value;
                            var ProductName = document.getElementById("txtProductName").value;
                            var MRP = document.getElementById("txtMRP").value;

                            var DiscountAmount = document.getElementById("txtDiscAmount").value;
                            var TotalAmount = document.getElementById("txtTotalAmount").value;

                            var ProfitAmount = document.getElementById("txtProfitAmount").value;
                            var BatchCode = document.getElementById("txtBatchcode").value;

                            var Currentstock = document.getElementById("txtCurrentStock")
                                .value;

                            var Barcode = document.getElementById("txtBarcode")
                                .value;
                            var ToLocation = document.getElementById("cmbToLocation").value;
                            var Rate = document.getElementById("txtRate").value;
                            var ExpiryDate = document.getElementById("txtExpiry").value;



                            if (STOUniqueNo == "" || TotalAmount == "" || ToLocation == "" || TotalAmount == "0") {

                                swal("Alert!", "Kindly provide valid details!", "warning");

                            } else {

                                var datas = "&STOUniqueNo=" + STOUniqueNo + "&Barcode=" + Barcode + "&Qty=" + Qty +
                                    "&Shortcode=" +
                                    Shortcode + "&Shortcode=" + Shortcode +
                                    "&Category=" + Category + "&ProductName=" + ProductName + "&MRP=" + MRP +
                                    "&DiscountAmount=" +
                                    DiscountAmount +
                                    "&TotalAmount=" + TotalAmount + "&ProfitAmount=" + ProfitAmount + "&BatchCode=" +
                                    BatchCode +
                                    "&Currentstock=" + Currentstock + "&ToLocation=" + ToLocation +
                                    "&ExpiryDate=" + ExpiryDate + "&Rate=" + Rate;
 
                                $.ajax({
                                    url: "Save/SaveSTOItems.php",
                                    method: "POST",
                                    data: datas,
                                    success: function(data) {

                                        if (data == 1) {

                                            LoadProductList()
                                            Reset();
                                        } else {
                                            swal("Alert!", data, "warning");
                                            LoadProductList()
                                            Reset();
                                        }


                                    }
                                });
                            }

                        }

                    }



                    function SaveSTOMaster() {

                        var STOUniqueNo = document.getElementById("txtInvoiceNo").value;
                        var TotalSaleQty = document.getElementById("txtTotalSaleQty").value;
                        var TotalDiscountAmount = document.getElementById("txtTotalDiscountAmount").value;

                        var TotalProfitAmount = document.getElementById("txtTotalProfitAmount").value;
                        var TotalSaleAmount = document.getElementById("txtNettAmount").value;

                        var ToLocation = document.getElementById("cmbToLocation").value;


                        if (STOUniqueNo == "" || TotalSaleAmount == "" || ToLocation == "" || TotalSaleAmount == "0") {

                            swal("Alert!", "Kindly provide valid details!", "warning");

                        } else {

                            var datas = "&STOUniqueNo=" + STOUniqueNo + "&TotalSaleQty=" + TotalSaleQty +
                                "&TotalDiscountAmount=" + TotalDiscountAmount + "&TotalProfitAmount=" +
                                TotalProfitAmount +
                                "&TotalSaleAmount=" + TotalSaleAmount +
                                "&ToLocation=" +
                                ToLocation;

                            $.ajax({
                                url: "Save/SaveSTOMaster.php",
                                method: "POST",
                                data: datas,
                                success: function(data) {
                                    if (data == 1) {
                                        swal("Stock Transfer Out!", "Transfered Sucessfully", "success");
                                        // window.location.reload();
                                        setTimeout(function() {
                                            window.location = window.location;
                                        }, 1000);

                                        // history.pushState("", "", "www.mysamplepage.net/index.php/?page=index");
                                    } else {
                                        swal("Alert!", data, "warning");
                                        Reset();
                                    }


                                }
                            });
                        }

                    }


                    function Reset() {


                        document.getElementById("txtQty").value = "";
                        document.getElementById("txtBarcode").focus();
                        document.getElementById("txtShortcode").value = "";
                        document.getElementById("txtCategory").value = "";
                        document.getElementById("txtProductName").value = "";
                        document.getElementById("txtMRP").value = "";
                        document.getElementById("txtDiscAmount").value = "";
                        document.getElementById("txtProfitAmount").value = "";
                        document.getElementById("txtBatchcode").value = "";
                        document.getElementById("txtCurrentStock").value = "";
                        document.getElementById("txtRate").value = "";
                        document.getElementById("txtTotalAmount").value = "";
                        document.getElementById("txtBarcode").value = "";
                        document.getElementById("txtGRN").value = "";
                        document.getElementById("txtValidGRN").value = "";


                    }
                </script>


                <input style="background-color:white;" type="hidden" name="txtShortcode" id="txtShortcode" placeholder="" class="form-control" disabled />
                <input style="background-color:white;" type="hidden" name="txtCategory" id="txtCategory" placeholder="" class="form-control" disabled />
                <input style="background-color:white;" type="hidden" name="txtProductName" id="txtProductName" placeholder="" class="form-control" disabled />
                <input style="background-color:white;" type="hidden" name="txtBatchcode" id="txtBatchcode" placeholder="" class="form-control" disabled />
                <input style="background-color:white;" type="hidden" name="txtProfitAmount" id="txtProfitAmount" placeholder="" class="form-control" disabled />

                <input style="background-color:white;" type="hidden" name="txtRate" id="txtRate" placeholder="" class="form-control" disabled />
                <input style="background-color:white;" type="hidden" name="txtLocationCode" id="txtLocationCode" placeholder="" class="form-control" disabled />
                <input style="background-color:white;" type="hidden" name="txtExpiry" id="txtExpiry" placeholder="" class="form-control" disabled />
                <input style="background-color:white;" type="hidden" name="cmbProductCode" id="cmbProductCode" placeholder="" class="form-control" disabled />
                <input style="background-color:white;" type="hidden" name="txtTotalAmount" id="txtTotalAmount" placeholder="" class="form-control" disabled />





                <input type="hidden" name="txtDiscPercent" id="txtDiscPercent" placeholder="" class="form-control" value=0 onkeyup="CalculateTotal();" />
                <input type="hidden" name="txtDiscAmount" id="txtDiscAmount" placeholder="" class="form-control" value=0 onkeyup="CalculateTotal();" />


                <div id="modalStockList" class="modal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Stock Details</h4>
                            </div>

                            <div class="modal-body">
                                <input type='hidden' disabled id='txtInvoiceNo' name='txtInvoiceNo' />
                                <div data-scrollbar="true" data-height="450px">
                                    <ul class="chats">

                                        <div id="DivStockList" class="email-content"></div>

                                    </ul>
                                </div>


                            </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" onclick="ReturnItems();" data-dismiss="modal">Return</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-12">

                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">

                            <h4 class="panel-title">Stock Transfer Out

                            </h4>


                        </div>

                        <div class="panel-body">
                            <div class="table-responsive" id='DivStockReport'>
                                <input type="hidden" name="txtInvoiceNo" id="txtInvoiceNo" placeholder="" class="form-control" />

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Transfer To</label>
                                        <select class="form-control" id='cmbToLocation' name='cmbToLocation'>
                                            <option selected></option>

                                            <?php
                                            $sqli = "SELECT locationcode, locationname FROM locationmaster  WHERE  locationcode <>'$LocationCode'";
                                            $result = mysqli_query($connection, $sqli);
                                            while ($row = mysqli_fetch_array($result)) {
                                                # code...

                                                echo ' <option value=' . $row['locationcode'] . '>' . $row['locationname'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-2" style="margin-left:-0%;">
                                    <div class="form-group">
                                        <label>By Barcode</label>
                                        <input style="background-color:white;" type="text" name="txtBarcode" id="txtBarcode" class="form-control" onfocus="DisableTransferLocation()" onblur="LoadBarcodeDetails()" onkeyup="this.value = this.value.toUpperCase()" />




                                    </div>
                                </div>

                                <div class="col-md-2" style="margin-left:-0%;">
                                    <div class="form-group">
                                        <label>By GRN Number</label>
                                        <input style="background-color:white;" type="text" name="txtGRN" id="txtGRN" class="form-control" onfocus="DisableTransferLocation()" onblur="LoadBarcodeDetailsGRN()" onkeyup="this.value = this.value.toUpperCase()" />
                                        <input type='hidden' id='txtValidGRN' name='txtValidGRN' />



                                    </div>
                                </div>


                                <div class="col-md-1" style="margin-left:-0%;">
                                    <div class="form-group">
                                        <label>MRP</label>
                                        <input style="background-color:white;" type="text" name="txtMRP" id="txtMRP" placeholder="" class="form-control" onchange="CalculateTotal();" disabled />
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Cr. Stock</label>
                                        <input style="background-color:white;" type="text" name="txtCurrentStock" id="txtCurrentStock" placeholder="" class="form-control" disabled />
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Qty</label>
                                        <input type="text" name="txtQty" id="txtQty" placeholder="" class="form-control" onkeyup="CalculateTotal();" />
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <br>
                                        <div class="controls">
                                            <input type="button" class="btn btn-sm btn-success" onclick=" SaveSTOItems();" value='Add'>
                                            <input type="button" class="btn btn-sm btn-warning" onclick="Reset();" value='Clear'>
                                        </div>
                                    </div>
                                </div>



                            </div>

                            <div class="table-responsive" id='DivStockReport'>

                                <div id="DivSTOList" class="email-content"></div>

                                <br>


                                <table style="position: relative; float:right;">
                                    <tr>
                                        <td>

                                            <input style="text-align: right;" type="hidden" class="form-control" placeholder="" id='txtTotalDiscountAmount' name='txtTotalDiscountAmount' />

                                            <input style="text-align: right;" type="hidden" class="form-control" placeholder="" id='txtTotalProfitAmount' name='txtTotalProfitAmount' />

                                        </td>
                                        <td style="text-align: right;"><label>Qty</label></td>
                                        <td>
                                            <div class="col-md-8">
                                                <b> <input style="text-align: right;" type="text" class="form-control" placeholder="" id='txtTotalSaleQty' name='txtTotalSaleQty' disabled /><b>

                                            </div>
                                        </td>

                                        <td style="text-align: right;"><label>Total</label></td>
                                        <td>
                                            <div class="col-md-12">
                                                <b> <input style="text-align: right;" type="text" class="form-control" placeholder="" id='txtNettAmount' name='txtNettAmount' disabled /><b>

                                            </div>
                                        </td>
                                        <td> <input type="button" class="btn btn-sm btn-success" onclick='this.disabled=true; SaveSTOMaster();' value='Save'> </td>
                                        <td> &nbsp;&nbsp;&nbsp; <input type="button" class="btn btn-sm btn-warning" onclick="window.location.reload();" value='Cancel'>
                                        </td>
                                    <tr>
                                        <table>



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
    </div>

    </div>
    </div>
    </div>

    <!-- end col-10 -->
    </div>

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