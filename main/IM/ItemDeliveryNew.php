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

    $Invoice=$_GET['invoice'];

    
	  $res = $connection->query(" 
      SELECT  saledate AS InvoiceDate , CONCAT(invoiceno,'-',saleid) AS Invoice, `paitentname`,
      SUM(nettamount) AS Total,b.mobileno,billtype,a.paitientcode,a.locationcode,a.saleqty,
      a.deliverystatus  FROM salemaster AS a
      JOIN paitentmaster AS b ON a.paitientcode = b.`paitentid` LEFT JOIN courierdetails  AS c
      ON a.saleuniqueno=c.invoicenumber WHERE saleuniqueno ='$Invoice';"); 
             
      while($data = mysqli_fetch_row($res))
      {
      
      $InvoiceDate=$data[0];
      $BillNo=$data[1];
      $PaitientName=ucwords(strtolower($data[2])) ; 
      $TotalAmount=$data[3];  
      $MobileNo=$data[4]; 
      $BillType =$data[5]; 
      $PaitentCode =$data[6]; 
      $LocationCode=$data[7];
      $TotalSaleQty=$data[8];
      $DeliveryStatus=$data[9];
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
            <?php include("IMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->

        <script>
        function Reset() {
            LoadProductList();
            ClearBarcode();
        }


        function ClearBarcode() {
            var Invoice = document.getElementById("txtInvoiceNo").value;
            var datas = "&Invoice=" + Invoice;

            $.ajax({
                url: "Delete/DeleteBillingInitialItem.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);

                }
            });
            LoadBarcodeList();
        }


        function LoadProductList() {

            var Invoice = document.getElementById("txtInvoiceNo").value;

            var datas = "&Invoice=" + Invoice;

            $.ajax({
                url: "Load/LoadDeliveryProductListEdit.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivProductList').html(data);


                }
            });
        }

        function DeleteBillingItem(x) {


            var SelectedColumn = x.cellIndex;
            var SelectedRow = x.parentNode.rowIndex;

            var Id = document.getElementById("tblBill").rows[SelectedRow].cells[1].innerHTML;
            document.getElementById("txtBarcodeToDelete").value = Id;
            DeleteProductinBillingItem();


        }

        function DeleteProductinBillingItem() {

            var Barcode = document.getElementById("txtBarcodeToDelete").value;
            var Invoice = document.getElementById("txtInvoiceNo").value;
            var datas = "&Barcode=" + Barcode + "&Invoice=" + Invoice;

            $.ajax({
                url: "Delete/DeleteBillingItem.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);

                }
            });
            LoadBarcodeList();
        }

        function LoadBarcodeList() {
            var Invoice = document.getElementById("txtInvoiceNo").value;
            var datas = "&Invoice=" + Invoice;
            // alert(datas);
            $.ajax({
                url: "Load/LoadBillingItemListDelivery.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivBarcodeList').html(data);


                }
            });
            LoadInvoiceTotal();
        }


        function LoadBarcodeDetails() {

            var Barcode = document.getElementById("txtBarcode").value;
            var InvoiceNo = document.getElementById("txtInvoiceNo").value;
            var BillType = document.getElementById("cmbBillType").value;
            var LocationCode = document.getElementById("cmbLocationAdmin").value;
            var datas = "&Barcode=" + Barcode + "&LocationCode=" + LocationCode + "&InvoiceNo=" + InvoiceNo;
            if (Barcode == '') {

            } else {


                $.ajax({
                    url: "Load/LoadBarcodeDetailsBillingDelivery.php",
                    method: "POST",
                    data: datas,
                    dataType: "json",
                    success: function(data) {

                        $("#txtShortcode").val(data[0]);
                        $("#txtProductName").val(data[1]);
                        $("#txtBatchcode").val(data[2]);
                        $("#txtCurrentStock").val(data[4]);
                        $("#txtRate").val(data[5]);
                        $("#txtCategory").val(data[6]);
                        $("#txtMRP").val(data[7]);
                        $("#txtTotalAmount").val(data[7]);
                        $("#txtBalancetoScan").val(data[9]);


                        var CurrentStockQty = document.getElementById("txtCurrentStock").value;
                        document.getElementById("txtQty").value = 1;
                        var BalanceToScan = document.getElementById("txtBalancetoScan").value;


                        if (BalanceToScan == 0) {
                            swal("Alert!",
                                "Alredy required stocks are scanned or Invalid",
                                "warning");
                            document.getElementById("txtBalancetoScan").value = '';
                            document.getElementById("txtBarcode").value = '';
                            document.getElementById("txtBarcode").focus();
                        } else if (BalanceToScan > 0) {

                            if (Barcode != "") {


                                if (CurrentStockQty == 0) {


                                    swal("Alert!",
                                        "Invalid Barcode or No Stock in the selected barcode,       PRESS ESC Key",
                                        "warning");
                                    document.getElementById("txtBalancetoScan").value = '';
                                    document.getElementById("txtBarcode").value = '';
                                    document.getElementById("txtRate").value = '';
                                    document.getElementById("txtBarcode").focus();

                                } else {

                                    SaveSaleItems()
                                    document.getElementById("txtBalancetoScan").value = '';
                                    document.getElementById("txtBarcode").value = '';
                                    document.getElementById("txtRate").value = '';
                                    document.getElementById("txtBarcode").focus();
                                }
                            }

                        }

                    }
                });

            }
        }



        function SaveSaleItems() {



            var Currentstock = document.getElementById("txtCurrentStock").value;
            var BillQty = document.getElementById("txtQty").value;

            if (Number(BillQty) > Number(Currentstock)) {

                swal("Alert!", "Bill Qty should not above current stock", "warning");
                document.getElementById("txtQty").value = "";
                document.getElementById("txtQty").focus();
            } else {

                var Invoice = document.getElementById("txtInvoiceNo").value;
                var Barcode = document.getElementById("txtBarcode").value;

                var Qty = document.getElementById("txtQty").value;
                var Shortcode = document.getElementById("txtShortcode").value;
                var Category = document.getElementById("txtCategory").value;
                var ProductName = document.getElementById("txtProductName").value;
                var MRP = document.getElementById("txtMRP").value;

                var BatchCode = document.getElementById("txtBatchcode").value;
                var Currentstock = document.getElementById("txtCurrentStock")
                    .value; //                                                            
                var SaleDate = document.getElementById("dtSaleDate")
                    .value; //                                                            
                var PaitentCode = document.getElementById("txtPaitentCode").value;
                var Rate = document.getElementById("txtRate").value;
                var BillType = document.getElementById("cmbBillType").value;


                if (BillType == 'Free') {
                    var ProfitAmount = -Rate;
                    var TotalAmount = 0;
                    var DiscountAmount = MRP;
                    var DiscountPercent = 100;
                } else {
                    var ProfitAmount = document.getElementById("txtProfitAmount").value;
                    var TotalAmount = document.getElementById("txtTotalAmount").value;
                    var DiscountAmount = document.getElementById("txtDiscAmount").value;
                    var DiscountPercent = document.getElementById("txtDiscPercent").value;
                }

                if (Invoice == "" || PaitentCode == "" || SaleDate == "") {

                    swal("Alert!", "Kindly provide valid detailsxxxxx!", "warning");

                } else if (DiscountPercent > 100) {
                    swal("Alert!", "Discount should not above 100%!", "warning");
                } else

                {

                    var datas = "&Invoice=" + Invoice + "&Barcode=" + Barcode + "&Qty=" + Qty + "&Shortcode=" +
                        Shortcode + "&Shortcode=" + Shortcode +
                        "&Category=" + Category + "&ProductName=" + ProductName + "&MRP=" + MRP + "&DiscountAmount=" +
                        DiscountAmount +
                        "&TotalAmount=" + TotalAmount + "&ProfitAmount=" + ProfitAmount + "&BatchCode=" + BatchCode +
                        "&Currentstock=" + Currentstock + "&PaitentCode=" + PaitentCode + "&Rate=" + Rate +
                        "&SaleDate=" + SaleDate;
                    // alert(datas);
                    $.ajax({
                        url: "Save/SaveBilling.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {


                            if (data == 1) {
                                // ApplyOveralllAutoDiscount();
                                LoadBarcodeList();

                            } else {
                                swal("Alert!", data, "warning");
                                LoadBarcodeList();

                            }


                        }
                    });
                }

            }


        }



        function LoadInvoiceTotal() {

            var Invoice = document.getElementById("txtInvoiceNo").value;
            var datas = "&Invoice=" + Invoice;
            // alert(datas);
            $.ajax({
                url: "Load/LoadBillingTotal.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {
                    // alert(data); 
                    $("#txtTotalSaleQtytoDeliver").val(data[2]);

                }
            });

        }

        function SaveDeliveryDetails() {
            var Invoice = document.getElementById("txtInvoiceNo").value;
            var TotalScanned = document.getElementById("txtTotalSaleQtytoDeliver").value;
            var TotalToScan = document.getElementById("txtTotalSaleQty").value;
            var LocationCode = document.getElementById("cmbLocationAdmin").value;
            var DeliveryStatus = document.getElementById("txtDeliveryStatus").value;

            var Balance = 1;
            Balance = TotalToScan * 1 - TotalScanned * 1;

            if (DeliveryStatus == 1) {
                swal("Error!", "This invoice is already delivered", "error");
                setTimeout(function() {

                    location.reload();

                }, 1000);
            } else {
                if (Balance == 0) {
                    var datas = "&Invoice=" + Invoice + "&LocationCode=" + LocationCode;

                    $.ajax({
                        url: "Save/CompleteDelivery.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {
                            swal("Success!", "Items Sucessfully Delivered", "success");
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    });
                } else {
                    swal("Alert!", "Check all items are scanned", "warning");
                }

            }


        }

        function GetPointID(x) {
            var SelectedColumn = x.cellIndex;
            var SelectedRow = x.parentNode.rowIndex;

            document.getElementById("txtModifyProductCode").value = document.getElementById("tableproductlist").rows[
                SelectedRow].cells[1].innerHTML;
            document.getElementById("txtModifiedQty").value = document.getElementById("tableproductlist").rows[
                SelectedRow].cells[4].innerHTML;
            document.getElementById("txtActualQty").value = document.getElementById("tableproductlist").rows[
                SelectedRow].cells[4].innerHTML;

            document.getElementById("spnProductName").textContent = document.getElementById("tableproductlist").rows[
                SelectedRow].cells[2].innerHTML;

        }

        function ClearQty() {
            document.getElementById("txtModifiedQty").value = 0;
        }

        function UpdateItemQty() {
            var ProductCode = document.getElementById("txtModifyProductCode").value;
            var ActualQty = document.getElementById("txtActualQty").value;
            var ModifiedQty = document.getElementById("txtModifiedQty").value;
            var TotalSaleQty = document.getElementById("txtTotalSaleQty").value;

            var InvoiceNo = <?php echo  $Invoice; ?>;
            var datas = "&ProductCode=" + ProductCode +
                "&ActualQty=" + ActualQty +
                "&ModifiedQty=" + ModifiedQty +
                "&InvoiceNo=" + InvoiceNo;
            if (TotalSaleQty == 1 && ModifiedQty == 0) {
                swal("Error!", "You cannot remove all items on a bill, you can only cancel the bill", "warning");
            } else {


                $.ajax({
                    url: "Save/UpdateDeliveryProducts.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        if (data == 1) {
                            UpdateValue()
                        } else {
                            swal("Error!", "Unable to Modify bill details", "warning");
                        }

                    }
                });
            }
        }

        function UpdateValue() {
            var ProductCode = document.getElementById("txtModifyProductCode").value;
            var ActualQty = document.getElementById("txtActualQty").value;
            var ModifiedQty = document.getElementById("txtModifiedQty").value;
            var InvoiceNo = <?php echo  $Invoice; ?>;
            var datas = "&ProductCode=" + ProductCode +
                "&ActualQty=" + ActualQty +
                "&ModifiedQty=" + ModifiedQty +
                "&InvoiceNo=" + InvoiceNo;

            $.ajax({
                url: "Save/UpdateDeliveryProducts_Salemaster.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    // swal(data);

                    if (data == 1) {
                        swal("Success!", "Sale bill sucessfully Modified", "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        swal("Error!", "Unable to Modify bill Value", "warning");
                    }

                }
            });
        }
        </script>




        <style>
        .bootstrap-select:not([class*="span"]):not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 320px;
        }
        </style>



        <div class="modal fade" id="ModalModifyProduct" name="ModalModifyProduct">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Modify Product </h4>
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->

                            <div class="panel-body">
                                <form class="form-horizontal">

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><b><span
                                                    id='spnProductName'></span></b></label>
                                        <div class="col-md-3">
                                            <input type="hidden" class="form-control" placeholder=""
                                                id='txtModifyProductCode' name='txtModifyProductCode' />

                                            <input type="text" class="form-control" placeholder="" id='txtModifiedQty'
                                                name='txtModifiedQty' />


                                            <input type="hidden" class="form-control" placeholder="" id='txtActualQty'
                                                name='txtActualQty' />

                                        </div>
                                        <div class="col-md-3">
                                            <i style="color:red" class='fa fa-2x fa-trash' title='View'
                                                onclick='ClearQty()'></i>

                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-5">
                            <input type="button" id='btnSave' class="btn btn-sm btn-success" onClick="UpdateItemQty();"
                                value='Update'>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="content" class="content">
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-5">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">

                            <h4 class="panel-title">Bill Details - Modification 


                            </h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo'
                                    value='<?php echo $Invoice; ?>' />
                                <input type='hidden' id='txtDeliveryStatus' name='txtDeliveryStatus'
                                    value='<?php echo $DeliveryStatus; ?>' />

                                <input type='hidden' id='txtBarcodeToDelete' name='txtBarcodeToDelete' />


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Date</label>

                                    <div class="col-md-6">
                                        <input type="date" class="form-control" placeholder="" id='dtSaleDate'
                                            name='dtSaleDate' value='<?php echo $InvoiceDate; ?>' disabled />
                                    </div>

                                </div>



                                <div class="form-group">
                                    <label class="col-md-3 control-label">Invoice No</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtBillNO'
                                            name='txtBillNO' disabled value='<?php echo $BillNo;?>' />

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Paietent</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtPaitentName'
                                            name='txtPaitentName' value='<?php echo $PaitientName;?>' disabled />

                                        <input type="hidden" class="form-control" placeholder="" id='txtPaitentCode'
                                            name='txtPaitentCode' value='<?php echo $PaitentCode;?>' disabled />

                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Sale Qty</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtTotalSaleQty'
                                            name='txtTotalSaleQty' disabled value='<?php echo $TotalSaleQty;?>' />

                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Bill Value</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtTotalBillAmount'
                                            name='txtTotalBillAmount' disabled value='<?php echo $TotalAmount;?>' />

                                    </div>

                                </div>


                                <div class="form-group" id='DivProductList'>

                                </div>

                                <center>
                                    <a href='SaleBillView.php?invoice=<?php echo $Invoice; ?>'
                                        class="btn btn btn-success" target='_blank' ?>
                                        <i class='fa fa-2x fa-print' title='View'></i></a>

                                </center>


                                <div class="form-group">
                                    <label class="col-md-3 control-label"> </label>
                                    <div class="col-md-9">


                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <div class="col-md-7 " style='display:none;'>
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">

                            <h4 class="panel-title">Delivery Items</h4>
                        </div>


                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Barcode</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="" id='txtBarcode'
                                        name='txtBarcode' onblur="LoadBarcodeDetails()"
                                        onkeyup="this.value = this.value.toUpperCase()" />

                                </div>

                            </div>

                            <input type="hidden" class="form-control" placeholder="" id='txtTotalSaleQtytoDeliver'
                                name='txtTotalSaleQtytoDeliver' disabled />


                            <input type="hidden" class="form-control" placeholder="Balance" id='txtBalancetoScan'
                                name='txtBalancetoScan' />



                            <div style='display:none;'>


                                <input type="text" class="form-control" placeholder="Qty" id='txtQty' name='txtQty' />
                                <input type="text" class="form-control" placeholder="Shortcode" id='txtShortcode'
                                    name='txtShortcode' />
                                <input type="text" class="form-control" placeholder="ProductName" id='txtProductName'
                                    name='txtProductName' />

                                <input type="text" class="form-control" placeholder="Category" id='txtCategory'
                                    name='txtCategory' />
                                <input type="text" class="form-control" placeholder="MRP" id='txtMRP' name='txtMRP' />
                                <input type="text" class="form-control" placeholder="Batch" id='txtBatchcode'
                                    name='txtBatchcode' />
                                <input type="text" class="form-control" placeholder="Current Stock" id='txtCurrentStock'
                                    name='txtCurrentStock' />
                                <input type="text" class="form-control" placeholder="Rate" id='txtRate'
                                    name='txtRate' />
                                <input type="text" class="form-control" placeholder="Bill Type" id='cmbBillType'
                                    name='cmbBillType' value='<?php echo $BillType; ?>' />
                                <input type="text" class="form-control" placeholder="Bill Type" id='cmbLocationAdmin'
                                    name='cmbLocationAdmin' value='<?php echo $LocationCode; ?>' />

                                <input type="text" class="form-control" placeholder="Profit" id='txtProfitAmount'
                                    name='txtProfitAmount' />
                                <input type="text" class="form-control" placeholder="Total" id='txtTotalAmount'
                                    name='txtTotalAmount' />
                                <input type="text" class="form-control" placeholder="Discount" id='txtDiscAmount'
                                    name='txtDiscAmount' />
                                <input type="text" class="form-control" placeholder="Disc %" id='txtDiscPercent'
                                    name='txtDiscPercent' />
                            </div>

                            <br>
                            <br>

                            <div data-scrollbar="true" data-height="410px">
                                <ul class="chats">


                                    <div id="DivBarcodeList" class="email-content"></div>

                                </ul>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> </label>
                                <div class="col-md-9">
                                    <input type="button" id='btnSave' class="btn btn-sm btn-success"
                                        onClick="SaveDeliveryDetails();" value='Save'>
                                    <input type="button" class="btn btn-sm btn-warning" onClick="Reset();"
                                        value='Clear'>
                                </div>
                            </div>


                        </div>
                    </div>

                    <!-- end panel -->
                </div>
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