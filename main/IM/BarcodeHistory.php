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

include("../connect.php");
// $position = $_SESSION["SESS_LAST_NAME"];
session_cache_limiter(FALSE);
session_start();
$LocationCode = $_SESSION['SESS_LOCATION'];
$LocationName = $_SESSION['SESS_LOCATIONNAME'];
$GroupID = $_SESSION['SESS_GROUP_ID'];

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

<body>
    <!-- begin #page-loader -->

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
                        <a href="../../index.php">Log Out</a>
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
            <?php include("IMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->
        <script>
        function LoadBarcodeDetails() {
            var Barcode = document.getElementById("txtBarcode").value;
            var Location = document.getElementById("cmbLocation").value;


            var datas = "&Barcode=" + Barcode + "&Location=" + Location;
            // alert(datas);
            $.ajax({
                url: "Load/LoadItemEnquiry.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {


                    document.getElementById("lblCategory").innerHTML = data[0];
                    document.getElementById("lblShortCode").innerHTML = data[1];
                    document.getElementById("lblProduct").innerHTML = data[2];
                    // document.getElementById("lblBatch").innerHTML = data[3];
                    // document.getElementById("lblMRP").innerHTML = data[4];
                    // document.getElementById("lblRate").innerHTML = data[5];
                    // document.getElementById("lblMfDate").innerHTML = data[6];
                    // document.getElementById("lblExpDate").innerHTML = data[7];
                    document.getElementById("lblPurQty").innerHTML = data[8];
                    document.getElementById("lblPurRetQty").innerHTML = data[9];
                    document.getElementById("lblSaleQty").innerHTML = data[10];
                    document.getElementById("lblSaleRetQty").innerHTML = data[11];
                    document.getElementById("lblCurrentStock").innerHTML = data[12];
                    document.getElementById("txtCurrentStock").value = data[12];

                    // $("#txtShortcode").val(data[0]); 
                    // $("#txtProductName").val(data[1]); 
                    // $("#txtBatchcode").val(data[2]); 

                    // $("#").val(data[4]); 
                    // $("#txtRate").val(data[5]); 
                    // $("#txtCategory").val(data[6]); 
                    // $("#txtMRP").val(data[7]); 
                    // $("#txtTotalAmount").val(data[7]); 
                    // $("#txtLocationCode").val(data[8]); 

                }
            });
            LoadItemEnquiryStockDetails();
            LoadPurchaseDetails();
            LoadSalesDetails();
            LoadItemEnquirySTO();
        }

        function LoadItemEnquirySTO() {
            var Barcode = document.getElementById("txtBarcode").value;
            var datas = "&Barcode=" + Barcode;
            // alert(datas);
            $.ajax({
                url: "Load/LoadItemEnquirySTO.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivSTODetails').html(data);


                }
            });
        }

        function LoadPurchaseDetails() {

            var Barcode = document.getElementById("txtBarcode").value;
            var datas = "&Barcode=" + Barcode;
            // alert(datas);
            $.ajax({
                url: "Load/LoadItemEnquiryPurchaseDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivPurchaseDetails').html(data);


                }
            });
        }

        function LoadItemEnquiryStockDetails() {

            var Barcode = document.getElementById("txtBarcode").value;
            var Location = document.getElementById("cmbLocation").value;

            var datas = "&Barcode=" + Barcode + "&Location=" + Location;
            // alert(datas);
            $.ajax({
                url: "Load/LoadItemEnquiryStockDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivStockDetails').html(data);


                }
            });


        }




        function LoadSalesDetails() {

            var Barcode = document.getElementById("txtBarcode").value;
            var datas = "&Barcode=" + Barcode;
            // alert(datas);
            $.ajax({
                url: "Load/LoadItemEnquirySalesDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivSalesDetails').html(data);


                }
            });

            LoadSalesReturnDetails();
        }

        function LoadSalesReturnDetails() {

            var Barcode = document.getElementById("txtBarcode").value;
            var datas = "&Barcode=" + Barcode;
            // alert(datas);
            $.ajax({
                url: "Load/LoadItemEnquirySalesReturnDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivSalesReturnDetails').html(data);


                }
            });


        }


        function SaveStockModification() {
            var NewStock = document.getElementById("txtNewStock").value;
            var StockItemID = document.getElementById("txtStockItemID").value;
            var CurrentStock = document.getElementById("txtCurrentStock").value;
            var Remarks = document.getElementById("txtRemarks").value;
            var LocationCode = document.getElementById("cmbLocation").value;

            var datas = "&NewStock=" + NewStock +
                "&StockItemID=" + StockItemID +
                "&CurrentStock=" + CurrentStock +
                "&LocationCode=" + LocationCode +
                "&Remarks=" + Remarks;
            $.ajax({
                url: "Save/SaveStockAdjustment.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    if (data == 1) {
                        alert("Stock updated sucessfully");
                        LoadBarcodeDetails();
                    } else {
                        alert("Error Addin stock, please retry later");
                    }

                }
            });
        }


        function LoadStockItemID(x, y) {
            document.getElementById("txtStockItemID").value = x;
            document.getElementById("txtCurrentStock").value = y;

        }
        </script>

        <div id="modalStockModification" class="modal fade" role="dialog">
            <div class="modal-dialog">


                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Stock Adjustment </h4>
                    </div>
                    <div class="modal-body">
                        <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' />
                        <input type='hidden' id='txtInvoiceNoRefund' name='txtInvoiceNoRefund' />
                        <input type='text' id='txtStockItemID' name='txtStockItemID' />
                        <div>
                            <label>
                                Current Stock
                            </label>
                            <input class='form-control' type='number' id='txtCurrentStock' name='txtCurrentStock'
                                style='width: 150px;' disabled />

                            <label>
                                Revised Stock
                            </label>
                            <input class='form-control' type='number' id='txtNewStock' name='txtNewStock'
                                style='width: 150px;' />
                            <br>
                            <textarea class='form-control' id='txtRemarks' name='txtRemarks'
                                placeholder='Remarks for Stock Adjustment'></textarea>

                        </div>

                        <br>

                        <button type="button" class="btn btn-success" data-dismiss="modal"
                            onclick='SaveStockModification();'>Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </div>

            </div>
        </div>


        <div id="content" class="content">
            <div class="row">


                <div class="profile-container">
                    <h4> </h4>
                    <!-- end profile-left -->
                    <!-- begin profile-right -->
                    <div>
                        <!-- begin profile-info -->

                        <!-- begin table -->
                        <div class="table-responsive">
                            <table class="table table-profile" style="width:60%;">
                                <thead>
                                    <tr>

                                        <td class="field">Barcode</td>
                                        <td><input type='text' class='form-control' id='txtBarcode' name='txtBarcode'
                                                onkeyup="this.value = this.value.toUpperCase()" />

                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="field">Location</td>
                                        <td>
                                            <select class='form-control' id='cmbLocation' name='cmbLocation'>
                                                <option value='3' selected>Annanagar</option>
                                                <option value='4'>Godown</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button class='btn btn-success'
                                                onclick="LoadBarcodeDetails();">View</button>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="field">Category</td>
                                        <td> <label id='lblCategory'></label> </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Short Code</td>
                                        <td> <label id='lblShortCode'></label> </td>
                                    </tr>
                                    <tr>

                                        <td class="field">Product</td>
                                        <td> <label id='lblProduct'></label> </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Purchase Qty</td>
                                        <td> <label id='lblPurQty'></label> </td>
                                    </tr>
                                    <tr>

                                        <td class="field">Pur Ret. Qty</td>
                                        <td> <label id='lblPurRetQty'></label> </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Sales Qty</td>
                                        <td> <label id='lblSaleQty'></label> </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Sale Ret. Qty</td>
                                        <td> <label id='lblSaleRetQty'></label> </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Current Stock</td>
                                        <td><b> <label id='lblCurrentStock'></label></b>

                                        </td>

                                    </tr>



                                </tbody>
                            </table>
                        </div>
                        <!-- end table -->
                        <hr>




                        <div class="panel-body">
                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab5" aria-controls="homew"
                                            role="tab" data-toggle="tab">Stock</a></li>
                                    <li role="presentation"><a href="#tab1" aria-controls="home" role="tab"
                                            data-toggle="tab">Purchase</a></li>
                                    <li role="presentation"><a href="#tab2" aria-controls="profile" role="tab"
                                            data-toggle="tab">Sales</a></li>
                                    <li role="presentation"><a href="#tab3" aria-controls="messages" role="tab"
                                            data-toggle="tab">Sales Return</a></li>
                                    <li role="presentation"><a href="#tab4" aria-controls="messages" role="tab"
                                            data-toggle="tab">Stock Transfer</a></li>
                                </ul>
                                <!-- Tab panes -->

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="tab5">

                                        <div class="col-md-12">
                                            <!-- begin scrollbar -->
                                            <div data-scrollbar="true" data-height="280px" class="bg-silver">

                                                <div id='DivStockDetails'> </div>
                                            </div>
                                            <!-- end scrollbar -->
                                        </div>

                                    </div>


                                    <div role="tabpanel" class="tab-pane  " id="tab1">

                                        <div class="col-md-12">
                                            <!-- begin scrollbar -->
                                            <div data-scrollbar="true" data-height="280px" class="bg-silver">

                                                <div id='DivPurchaseDetails'> </div>
                                            </div>
                                            <!-- end scrollbar -->
                                        </div>

                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="tab2">

                                        <div class="col-md-12">
                                            <div data-scrollbar="true" data-height="280px" class="bg-silver">

                                                <div id='DivSalesDetails'> </div>
                                            </div>
                                            <!-- end scrollbar -->
                                        </div>

                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="tab3">

                                        <div class="col-md-12">
                                            <!-- begin scrollbar -->
                                            <div data-scrollbar="true" data-height="280px" class="bg-silver">

                                                <div id='DivSalesReturnDetails'> </div>
                                            </div>
                                            <!-- end scrollbar -->
                                        </div>

                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="tab4">

                                        <div class="col-md-12">
                                            <!-- begin scrollbar -->
                                            <div data-scrollbar="true" data-height="280px" class="bg-silver">

                                                <div id='DivSTODetails'> </div>
                                            </div>
                                            <!-- end scrollbar -->
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- end profile-info -->
        </div>
        <!-- end profile-right -->
    </div>
    </div>
    <!-- end profile-container -->
    </div>

    </div>

    <!-- end row -->
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