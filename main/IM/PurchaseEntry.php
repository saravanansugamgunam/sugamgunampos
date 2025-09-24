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
//$position=$_SESSION["SESS_LAST_NAME"]; 
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
    <title>Sugamgunam</title>
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

    select.no-radius {
        border: none;
    }

    .select-wrapper {
        border: 1px solid #ccd0d4;
        border-radius: 5px;
        padding: 5px;
    }
    </style>

    <style>
    .modal-window {
        position: fixed;
        background-color: rgba(200, 200, 200, 0.75);
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 999;
        opacity: 0;
        pointer-events: none;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
    }

    .modal-window:target {
        opacity: 1;
        pointer-events: auto;
    }

    .modal-window>div {
        width: 900px;
        position: relative;
        margin: 5% auto;
        padding: 1rem;
        background: #fff;
        color: #444;
    }

    .modal-window header {
        font-weight: bold;
    }

    .modal-close {
        color: black;
        line-height: 50px;
        font-size: large;
        position: absolute;
        right: 0;
        text-align: center;
        top: 0;
        width: 70px;
        text-decoration: none;
    }

    .modal-closebutton {
        color: #aaa;
        line-height: 50px;
        font-size: 80%;
        position: absolute;
        right: 0;
        text-align: center;
        top: 50;
        width: 70px;
        text-decoration: none;
    }

    .modal-close:hover {
        color: #000;
    }

    .modal-window h1 {
        font-size: 150%;
        margin: 0 0 15px;
    }

    .swal-button {
        padding: 7px 19px;
        border-radius: 2px;
        background-color: #4962B3;
        font-size: 12px;
        border: 1px solid #3e549a;
        text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
    }

    .vl {
        border-left: 1px solid #ccd0d4;
        height: 180px;
        position: absolute;
        left: 75%;
        margin-left: -15px;
        top: 20;
    }
    </style>

</head>

<body onload="LoadGRNNumber();">
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
                    <a href="index.php?MID=1" class="navbar-brand">

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
        function SavePurchaseItems() {


            var Rate = document.getElementById("txtRate").value;
            var MRP = document.getElementById("txtMRP").value;

            var BatchNo = document.getElementById("txtBatchNo").value;

            var Expiry = document.getElementById("dtExpiry").value;
            var ManufactureDate = document.getElementById("dtMfg").value;

            var Profit = document.getElementById("txtProfitAmount").value;
            var LineTotalAmount = document.getElementById("txtLineTotalAmount").value;
            var SupplierCode = document.getElementById("cmbSupplier").value;
            var ReceiptDate = document.getElementById("dtReceiptDate").value;
            var InvoiceDate = document.getElementById("dtInvoiceDate").value;
            var InvoiceNo = document.getElementById("txtSupplierInvoiceNo").value;
            var GRNNo = document.getElementById("txtGRNNo").value;
            var ProductCode = document.getElementById("cmbProduct").value;
            var Shortcode = document.getElementById("txtShortcode").value;
            var Category = document.getElementById("txtCategory").value;
            var ProductName = document.getElementById("txtProductName").value;
            var Location = document.getElementById("cmbLocation").value;

            var PurchaseQty = document.getElementById("txtQty").value;
            var FreeQty = document.getElementById("txtFreeQty").value;
            var BilledQty = document.getElementById("txtBilledQty").value;

            var DiscountPercentage = document.getElementById("txtDiscountPercent").value;
            var DiscountAmount = document.getElementById("txtDiscountAmount").value;
            var GrossAmount = document.getElementById("txtGross").value;
            var LineNettAmount = document.getElementById("txtTotalAmount").value;
            var BillStatus = document.getElementById("cmbGSTStatus").value; 
            
            document.getElementById("cmbSupplier").disabled = true;
            
           document.getElementById("cmbGSTStatus").disabled = true;
            document.getElementById("dtInvoiceDate").disabled = true;
            document.getElementById("txtSupplierInvoiceNo").disabled = true;
            document.getElementById("dtReceiptDate").disabled = true;
            document.getElementById("cmbLocation").disabled = true; 
 


            var GSTPercent = document.getElementById("txtGSTPercent").value;
            var GSTAmount = document.getElementById("txtGSTAmount").value;

            // var checkbox = $('[name="chkPassport"]');
            // if (checkbox.is(':checked')) {
            //     var BillStatus = 1;
            // } else {
            //     var BillStatus = 0;
            // }

            if (LineNettAmount == '' || LineNettAmount == '0' || LineNettAmount == 'NaN' || GRNNo == '' || MRP == '0' ||
                Location == '') {
                swal("Incomplete details!", "Please fill all required details	!", "error");
            } else {

                var datas = "&PurchaseQty=" + PurchaseQty + "&Rate=" + Rate + "&MRP=" + MRP + "&BatchNo=" + BatchNo +
                    "&Expiry=" + Expiry + "&ManufactureDate=" + ManufactureDate + "&Profit=" + Profit +
                    "&SupplierCode=" + SupplierCode + "&ReceiptDate=" + ReceiptDate +
                    "&InvoiceDate=" + InvoiceDate +
                    "&LineTotalAmount=" + LineTotalAmount +
                    "&GSTPercent=" + GSTPercent +
                    "&GSTAmount=" + GSTAmount +
                    "&FreeQty=" + FreeQty +
                    "&BilledQty=" + BilledQty +
                    "&DiscountPercentage=" + DiscountPercentage +
                    "&DiscountAmount=" + DiscountAmount +
                    "&GrossAmount=" + GrossAmount +
                    "&LineNettAmount=" + LineNettAmount +
                    "&InvoiceNo=" + InvoiceNo + "&GRNNo=" + GRNNo + "&ProductCode=" + ProductCode +
                    "&Shortcode=" + Shortcode + "&Category=" + Category + "&ProductName=" + ProductName +
                    "&Location=" + Location + "&BillStatus=" + BillStatus;


                $.ajax({
                    url: "Save/UniqueBarcode_SavePurchaseEntry.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == 1) {

                            // swal("Purchase Entry!", "Added Sucessfully", "success");
                            LoadAddedPurchaseItems();
                            Reset();
                        } else {
                            swal("Alert!", data, "warning");
                            LoadAddedPurchaseItems();
                            Reset();
                        }
                    }
                });
            }
        }



        function SavePurchaseMaster() {

            var GRNNo = document.getElementById("txtGRNNo").value;
            var PurchaseQty = document.getElementById("txtTotalPurchaseQty").value;
            var GrossAmount = document.getElementById("txtGrossAmount").value;
            var GSTAmount = document.getElementById("txtGSTTotalAmount").value;
            var PurchaseNettAmount = document.getElementById("txtNettAmount").value;
            var SupplierCode = document.getElementById("cmbSupplier").value;
            var SupplierInvoice = document.getElementById("txtSupplierInvoiceNo").value;
            var SupplierInvoiceDate = document.getElementById("dtInvoiceDate").value;
            var Remarks = document.getElementById("txtRemarks").value;
            var ReceiptDate = document.getElementById("dtReceiptDate").value;
            var Location = document.getElementById("cmbLocation").value;


            var checkbox = $('[name="chkPassport"]');
            if (checkbox.is(':checked')) {
                var BillStatus = 1;
            } else {
                var BillStatus = 0;
            }


            if (PurchaseNettAmount == '0' || PurchaseNettAmount == 'NaN' || GRNNo == '' ||
                PurchaseQty == '0' || Location == '') {
                swal("Incomplete details!", "Please Check all values !", "error");
            } else {
                var datas = "&GRNNo=" + GRNNo +
                    "&PurchaseQty=" + PurchaseQty +
                    "&GrossAmount=" + GrossAmount +
                    "&GSTAmount=" + GSTAmount +
                    "&PurchaseNettAmount=" + PurchaseNettAmount +
                    "&SupplierCode=" + SupplierCode +
                    "&SupplierInvoice=" + SupplierInvoice +
                    "&SupplierInvoiceDate=" + SupplierInvoiceDate +
                    "&Remarks=" + Remarks +
                    "&ReceiptDate=" + ReceiptDate +
                    "&Location=" + Location +
                    "&BillStatus=" + BillStatus;
                // alert(datas);
                $.ajax({
                    url: "Save/SavePurchaseMaster.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        // swal(data);
                        if (data == 1) {


                            swal({
                                title: "Purchaes Entry",
                                text: "Purchase Entry Added Sucessfully!",
                                closeOnClickOutside: false,
                                type: "success"
                            }).then(okay => {
                                if (okay) {
                                    window.location.reload();
                                }
                            });

                            // swal("Purchase Entry!", "Added Sucessfully", "success");
                            // swal("Purchase Entry!", "Added Sucessfully", "success");
                            // LoadAddedPurchaseItems();
                            // Reset();
                        } else {

                            swal(data);
                            //  swal("Alert!", "Error Saving the purchae Entry", "warning");

                            Reset();
                        }


                    }
                });

            }
        }





        function Reset() {


            document.getElementById("txtQty").value = "";
            document.getElementById("txtMRP").value = "";
            document.getElementById("txtTotalAmount").value = "";
            document.getElementById("txtProfitAmount").value = "";
            document.getElementById("txtRate").value = "";
            document.getElementById("txtBatchNo").value = "";
            document.getElementById("dtExpiry").value = "";
            document.getElementById("dtMfg").value = "";
            document.getElementById("txtShortcode").value = "";
            document.getElementById("txtCategory").value = "";
            document.getElementById("txtProductName").value = "";
            document.getElementById("txtGSTPercent").value = "";
            document.getElementById("txtGSTAmount").value = "";
            document.getElementById("txtBilledQty").value = "";
            document.getElementById("txtFreeQty").value = "";
            document.getElementById("txtDiscountPercent").value = "0";
            document.getElementById("txtDiscountAmount").value = "0";

            document.getElementById("txtBatchNo").focus();

        }







        function CalculateOtherCost() {

            var OtherAmount = parseInt(document.getElementById("txtOtherAmount").value) * 1;

            var GrossValue = parseInt(document.getElementById("txtGrossAmount").value) * 1;
            var GSTValue = parseInt(Math.round(document.getElementById("txtGSTTotalAmount").value, 0)) * 1;

            var FinalTotal = GrossValue + GSTValue + OtherAmount;

            document.getElementById("txtNettAmount").value = Math.round(FinalTotal, 0);

        }





        function ClearTotalAmount() {
            document.getElementById("txtTotalAmount").value = 0;
        }

        function LoadGRNNumber() {

            var InvoiceNo = new Date().getTime();
            document.getElementById("txtGRNNo").value = InvoiceNo;

            LoadAddedPurchaseItems();

        }

        function CheckStockQty() {
            var Currentstock = document.getElementById("txtCurrentStock").value;
            var BillQty = document.getElementById("txtQty").value;

            if (BillQty > Currentstock) {
                swal("Alert!", "Bill Qty should not above current stock", "warning");
                document.getElementById("txtQty").value = "";
                document.getElementById("txtQty").focus();
            }

        }


        function LoadProductDetails() {

            var ProductCode = document.getElementById("cmbProduct").value;
            var SupplierCode = document.getElementById("cmbSupplier").value;
            var InvoiceDate = document.getElementById("dtInvoiceDate").value;
            var InvoiceNo = document.getElementById("txtSupplierInvoiceNo").value;

            if (SupplierCode == '' || InvoiceDate == '' || InvoiceNo == '') {
                swal("Select Supplier!", "Please select the supplier & invoice details	!", "error");
            } else {

                var datas = "&ProductCode=" + ProductCode;
                // alert(datas);
                $.ajax({
                    url: "Load/LoadProductDetails.php",
                    method: "POST",
                    data: datas,
                    dataType: "json",
                    success: function(data) {

                        $("#txtCategory").val(data[0]);
                        $("#txtMRP").val(data[1]);
                        $("#txtShortcode").val(data[2]);
                        $("#txtProductName").val(data[3]);
                        $("#txtGSTPercent").val(data[4]);


                        document.getElementById("txtBatchNo").focus();


                    }
                });
            }

        }


        function LoadPurchaseTotal() {

            var GRNNo = document.getElementById("txtGRNNo").value;
            var datas = "&GRNNo=" + GRNNo;
            // alert(datas);
            $.ajax({
                url: "Load/LoadPurchaseTotal.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#txtTotalPurchaseQty").val(data[0]);
                    $("#txtGrossAmount").val(data[1]);
                    $("#txtGSTTotalAmount").val(data[2]);

                    $("#txtNettAmount").val(data[3]);

                }
            });

        }



        function LoadCustomerDetails() {

            var MobileNo = document.getElementById("txtMobileNo").value;
            var datas = "&MobileNo=" + MobileNo;
            // alert(datas);
            $.ajax({
                url: "Load/LoadCustomerDetails.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {
                    // alert(data);
                    $("#txtName").val(data[0]);
                    $("#txtPaitentCode").val(data[1]);
                    $("#txtOldDue").val(data[2]);
                    $("#txtoldbalance").val(data[2]);

                    var OldBalance = document.getElementById("txtOldDue");

                    if (OldBalance.value > 0) {
                        OldBalance.style.backgroundColor = "red";
                        OldBalance.style.color = "white";

                    } else
                    if (OldBalance.value <= 0) {
                        OldBalance.style.backgroundColor = "white";
                        OldBalance.style.color = "black";
                    }




                }
            });
        }



        function LoadAddedPurchaseItems() {

            var GRNNo = document.getElementById("txtGRNNo").value;
            var datas = "&GRNNo=" + GRNNo;
            // alert(datas);
            $.ajax({
                url: "Load/LoadPurchaseItemsAdded.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    // alert(data);
                    $('#DivPurchaseItemList').html(data);


                }
            });
            LoadPurchaseTotal();

        }

        function SavePaymentDetails() {

            var Invoice = document.getElementById("txtGRNNo").value;
            var PaitentCode = document.getElementById("txtPaitentCode").value;
            var PaymentMode = document.getElementById("cmbPaymentMode").value;
            var PaymentAmount = document.getElementById("txtPaymentAmount").value;
            var NettAmount = document.getElementById("txtNettAmount").value;
            var SaleDate = document.getElementById("dtInvoiceDate").value;

            if (PaymentMode == "" || PaymentAmount == "" || PaymentAmount == 0 || NettAmount == 0 || NettAmount == "") {

                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {
                var datas = "&PaymentMode=" + PaymentMode + "&Invoice=" + Invoice + "&PaitentCode=" + PaitentCode +
                    "&PaymentAmount=" + PaymentAmount + "&SaleDate=" + SaleDate;
                // alert(datas);
                $.ajax({
                    url: "Save/SavePaymentDetails.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        LoadPaymentDetails();
                        // CalculatePaymentTotal();
                    }
                });
            }
            document.getElementById("cmbPaymentMode").value = "";
            document.getElementById("txtPaymentAmount").value = "";
        }

        function LoadPaymentDetails() {

            var Invoice = document.getElementById("txtGRNNo").value;
            var datas = "&Invoice=" + Invoice;
            // alert(datas);
            $.ajax({
                url: "Load/LoadPaymentDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivPaymentList').html(data);


                }
            });

            var OldDueAmount = document.getElementById("txtOldDue").value;
            var BillAmount = document.getElementById("txtNettAmount").value;
            document.getElementById("txtTotalDueAmount").value = (OldDueAmount * 1) + (BillAmount * 1);
            LoadPaymentTotal();




        }

        function DeletePaymentItem() {
            var PaymentID = document.getElementById("txtPaymentID").value;
            var datas = "&PaymentID=" + PaymentID;
            // alert(datas);
            $.ajax({
                url: "Delete/DeletePaymentItem.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    alert(data);

                }
            });
            LoadPaymentDetails();
        }

        function DeleteProductPurchaesItems() {

            var ItemID = document.getElementById("txtItemID").value;
            var GRNNo = document.getElementById("txtGRNNo").value;
            var datas = "&ItemID=" + ItemID + "&GRNNo=" + GRNNo;

            $.ajax({
                url: "Delete/DeletePurchaseItems.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    alert(data);

                }
            });
            LoadAddedPurchaseItems();
        }

        function LoadPaymentTotal() {

            var Invoice = document.getElementById("txtGRNNo").value;
            var NettAmount = document.getElementById("txtNettAmount").value;
            var CurrentBillTotal = document.getElementById("txtAmountCurrentBill").value;
            var OldBalance = document.getElementById("txtoldbalance").value;
            var datas = "&Invoice=" + Invoice + "&CurrentBillTotal=" + CurrentBillTotal + "&OldBalance=" + OldBalance;
            // alert(datas);
            $.ajax({
                url: "Load/LoadPaymentTotal.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {
                    // alert(data);
                    $("#txtTotalPayment").val(data[0]);
                    $("#txtBalance").val(data[2]);
                    $("#txtBalanceToSave").val(data[2]);
                }
            });

            // zzzzzz();

            // alert(CurrentBalance);

        }



        function GetPointID(x) {
            var SelectedColumn = x.cellIndex;
            var SelectedRow = x.parentNode.rowIndex;

            var Id = document.getElementById("tblPaymentItems").rows[SelectedRow].cells[1].innerHTML;
            document.getElementById("txtPaymentID").value = Id;
            DeletePaymentItem();
        }

        function DeletePurchaseItems(x) {
            var SelectedColumn = x.cellIndex;
            var SelectedRow = x.parentNode.rowIndex;

            var Id = document.getElementById("tblBillingItems").rows[SelectedRow].cells[1].innerHTML;
            document.getElementById("txtItemID").value = Id;
            DeleteProductPurchaesItems();
        }

        function focusamount() {
            document.getElementById("txtPaymentAmount").focus();
        }
        </script>

        <script>
        function CalculateCurrentTotal() {

            var TotalBillValue = parseInt(document.getElementById("txtNettAmount").value);
            var SupplierPayment = parseInt(document.getElementById("txtTotalSupplierPayment").value);

            var TotalBalance = parseInt(TotalBillValue) - parseInt(SupplierPayment);
            document.getElementById("txtTotalBalance").value = parseInt(TotalBalance);

            // CalculateOtherCost();
        }


        document.addEventListener("DOMContentLoaded", function(event) {
            // document.getElementById('btnSave').disabled = "true";
        });






        function EnableGSTBill() {
            var checkbox = $('[name="chkPassport"]');

            if (checkbox.is(':checked')) {
                document.getElementById("cmbGST").disabled = false;
                // alert('The checkbox is checked');
            } else {
                document.getElementById("txtGSTAmount").value = 0;
                document.getElementById("cmbGST").disabled = true;
                $("#cmbGST option:first-child").attr("selected", "selected");
                // alert('The checkbox is not checked');
            }

            CalculateOtherCost();
        }
        </script>

        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('.search-box input[type="text"]').on("keyup input", function() {
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("ProductSearch.php", {
                        term: inputVal
                    }).done(function(data) {
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else {
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function() {

                $(".result p").hide();
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
                LoadProductDetails();
            });

        });

        function myFunction() {
            alert("You pressed a key inside the input field");
        }

        function CalculateTotalQty() {

            var BilledQty = document.getElementById("txtBilledQty").value;
            var FreeQty = document.getElementById("txtFreeQty").value;
            document.getElementById("txtQty").value = BilledQty * 1 + FreeQty * 1;

        }

        function CalculateTotal() {

            var Qty = document.getElementById("txtBilledQty").value;
            var MRP = document.getElementById("txtMRP").value;
            var Rate = document.getElementById("txtRate").value;
            var BillStatus = document.getElementById("cmbGSTStatus").value; 

            var DiscountPercentage = document.getElementById("txtDiscountPercent").value;
            var GSTPercentage = document.getElementById("txtGSTPercent").value*BillStatus;

            var LineTotal = (Qty * Rate);
            document.getElementById("txtLineTotalAmount").value = Math.round(Qty * Rate);

            var DiscountAmount = (Qty * Rate) * (DiscountPercentage / 100);
            document.getElementById("txtDiscountAmount").value = Math.round(DiscountAmount);
 
            var GrossAmount = Math.round(LineTotal - DiscountAmount);
            document.getElementById("txtGross").value = GrossAmount;
            // alert(4);
            var GSTAmount = Math.round(GrossAmount * GSTPercentage / 100);
            document.getElementById("txtGSTAmount").value = GSTAmount;

            document.getElementById("txtTotalAmount").value = Math.round(GrossAmount + GSTAmount);

            // alert(5);

        }
        </script>

        <div id="content" class="content">
            <label><b><u>Purchase Entry</u></b></label>

            <div class="row">

                <div class="row">

                    <div style="width: 100%;">
                        <div style="float:left; width:79%;">
                            <div class="panel panel-inverse">
                                <div class="panel-body">
                                    <input type="hidden" name="txtGRNNo" id="txtGRNNo" placeholder=""
                                        class="form-control" />
                                    <input type="hidden" name="txtItemID" id="txtItemID" placeholder=""
                                        class="form-control" />


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Supplier</label><br>
                                            <select class="selectpicker" data-show-subtext="true"
                                                data-live-search="true" data-style="btn-white" id='cmbSupplier'
                                                name='cmbSupplier' style="width: 650px;">
                                                <option selected></option>
                                                <?php
                                                $sqli = "SELECT suplier_id, suplier_name  FROM  supliers where supplierstatus='Active' order by 2 ";
                                                $result = mysqli_query($connection, $sqli);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    # code...

                                                    echo ' <option value="' . $row['suplier_id'] . '">' . $row['suplier_name'] . '</option>';
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>


                                    <style>
                                    .NewFormcontrol {
                                        border: 1px solid #ccd0d4;
                                        border-radius: 3px;
                                        height: 34px;
                                        color: #000;
                                        width: 120%;
                                        padding: 6px 8px;
                                    }
                                    </style>


                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Invoice Date</label>
                                            <input type="date" class="NewFormcontrol" placeholder="" id='dtInvoiceDate'
                                                name='dtInvoiceDate' />
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Rec. Dt @ Clinic</label>
                                            <input type="date" class="NewFormcontrol" placeholder="" id='dtReceiptDate'
                                                name='dtReceiptDate' />
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Inv.No</label>
                                            <input type="text" class="NewFormcontrol" placeholder="Invoice No"
                                                id='txtSupplierInvoiceNo' name='txtSupplierInvoiceNo' />
                                        </div>
                                    </div>


                                    <div class="col-md-2" style='display:none'>
                                        <div class="forpx;m-group">
                                            <label> Location * </label><br>
                                            <select class="NewFormcontrol" data-show-subtext="true"
                                                data-live-search="true" data-style="btn-white" id='cmbLocation'
                                                name='cmbLocation' disabled>
                                                <?php
                                                $sqli = "SELECT locationcode,locationname  FROM  locationmaster  where locationcode='4'
                                                 and activestatus='Active' order by 2 ";
                                                $result = mysqli_query($connection, $sqli);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    # code...

                                                    echo ' <option value="' . $row['locationcode'] . '">' . $row['locationname'] . '</option>';
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>B.Status</label>

                                            <select class="NewFormcontrol" data-show-subtext="true"
                                                data-live-search="true" data-style="btn-white" id='cmbGSTStatus'
                                                name='cmbGSTStatus'   onchange='CalculateTotal()'  >
 
                                                <option value=0>Non-GST</option>
                                                <option value=1>GST</option>
                                            </select>
 
                                            
                                        </div>
                                    </div>

                                    


                                </div>


                                </fieldset>



                                <div>

                                    <fieldset>


                                        <style type="text/css">
                                        /* Formatting search box */
                                        .search-box {
                                            width: 230px;
                                            position: relative;
                                            display: inline-block;
                                            font-size: 14px;

                                        }

                                        .search-box input[type="text"] {
                                            height: 32px;
                                            padding: 5px 10px;
                                            border: 1px solid #CCCCCC;
                                            font-size: 14px;
                                        }

                                        .result {
                                            position: absolute;
                                            z-index: 999;
                                            top: 100%;
                                            left: 0;
                                            background: white;
                                        }

                                        .search-box input[type="text"],
                                        .result {
                                            width: 100%;
                                            box-sizing: border-box;
                                        }

                                        /* Formatting result items */
                                        .result p {
                                            margin: 0;
                                            padding: 7px 10px;
                                            border: 1px solid #CCCCCC;
                                            border-top: none;
                                            cursor: pointer;
                                        }

                                        .result p:hover {
                                            background: #f2f2f2;
                                        }
                                        </style>

                                        <div class="row">


                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label> Product</label><br>

                                                    <input type='hidden' name='txtCategory' id='txtCategory' />
                                                    <input type='hidden' name='txtShortcode' id='txtShortcode' />
                                                    <input type='hidden' name='txtProductName' id='txtProductName' />



                                                    &nbsp;&nbsp;&nbsp;
                                                    <select class="selectpicker " data-show-subtext="true"
                                                        data-live-search="true" data-style="btn-white" id='cmbProduct'
                                                        name='cmbProduct' style="width: 650px;"
                                                        onchange='LoadProductDetails();'>
                                                        <option selected></option>
                                                        <?php
                                                        $sqli = "SELECT productid,CONCAT(uniquebarcode , '-', productshortcode,'-',productname) as Product  FROM  productmaster  where status='Active' order by 2 ";
                                                        $result = mysqli_query($connection, $sqli);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            # code...

                                                            echo ' <option value="' . $row['productid'] . '">' . $row['Product'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>



                                                </div>
                                            </div>


                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Batch</label>
                                                    <input type="text" name="txtBatchNo" id="txtBatchNo" placeholder=""
                                                        class="NewFormcontrol" onkeyup="CalculateTotal();" />
                                                </div>
                                            </div>



                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Mfg.Dt</label>

                                                    <input id="dtMfg" type="tel" placeholder="MM/YY"
                                                        class="masked NewFormcontrol" pattern="(1[0-2]|0[1-9])\/\d\d"
                                                        data-valid-example="11/18"
                                                        title="2-digit month and 2-digit year greater than 01/15">

                                                </div>
                                            </div>



                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Exp.Dt</label>
                                                    <input id="dtExpiry" type="tel" placeholder="MM/YY"
                                                        class="masked NewFormcontrol" pattern="(1[0-2]|0[1-9])\/\d\d"
                                                        data-valid-example="11/18"
                                                        title="2-digit month and 2-digit year greater than 01/15">
                                                </div>
                                            </div>


                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>B.Qty</label>
                                                    <input type="text" name="txtBilledQty" id="txtBilledQty"
                                                        placeholder="" class="NewFormcontrol"
                                                        onblur="CalculateTotalQty();CalculateTotal();" />
                                                </div>
                                            </div>


                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>F.Qty</label>
                                                    <input type="text" name="txtFreeQty" id="txtFreeQty" placeholder=""
                                                        class="NewFormcontrol"
                                                        onblur="CalculateTotalQty();CalculateTotal();" />
                                                </div>
                                            </div>



                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>T.Qty</label>
                                                    <input type="text" name="txtQty" id="txtQty" placeholder=""
                                                        class="NewFormcontrol" disabled
                                                        onblur="CalculateTotalQty();CalculateTotal();" />
                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Rate</label>
                                                    <input style="background-color:white;" type="text" name="txtRate"
                                                        id="txtRate" placeholder="" class="NewFormcontrol"
                                                        onblur="CalculateTotal();" />



                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>MRP</label>
                                                    <input style="background-color:white;" type="text" name="txtMRP"
                                                        id="txtMRP" placeholder="" class="NewFormcontrol"
                                                        onblur="CalculateTotal();" />



                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">


                                                </div>
                                            </div>




                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>&nbsp;&nbsp;&nbsp;Total</label>
                                                    <input style="background-color:white; background: #e5e9ed;"
                                                        type="text" name="txtLineTotalAmount" id="txtLineTotalAmount"
                                                        placeholder="" class="NewFormcontrol"
                                                        onkeyup="CalculateTotal();" disabled />



                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Disc%</label>
                                                    <input style="background-color:white;" type="text"
                                                        name="txtDiscountPercent" id="txtDiscountPercent" placeholder=""
                                                        class="NewFormcontrol" onkeyup="CalculateTotal();" />



                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Disc.Amount</label>
                                                    <input style="background-color:white;" type="text"
                                                        name="txtDiscountAmount" id="txtDiscountAmount" placeholder=""
                                                        class="NewFormcontrol" onkeyup="CalculateTotal();" />



                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Gross</label>
                                                    <input style="background-color:white;" type="text" name="txtGross"
                                                        id="txtGross" placeholder="" class="NewFormcontrol"
                                                        onkeyup="CalculateTotal();" />



                                                </div>
                                            </div>


                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>GST%</label>
                                                    <input type='text'
                                                        style="background-color:white; background: #e5e9ed;"
                                                        name='txtGSTPercent' id='txtGSTPercent' class="NewFormcontrol"
                                                        disabled />





                                                </div>
                                            </div>


                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>GST.Amt</label>
                                                    <input style="background-color:white; background: #e5e9ed;"
                                                        type="text" name="txtGSTAmount" id="txtGSTAmount" placeholder=""
                                                        class="NewFormcontrol" onkeyup="CalculateTotal();" disabled />


                                                </div>
                                            </div>






                                            <div class="col-md-1" style='display:none;'>
                                                <div class="form-group">
                                                    <label>Profit</label>
                                                    <input style="background-color:white;" type="text"
                                                        name="txtProfitAmount" id="txtProfitAmount" placeholder=""
                                                        class="form-control" onkeyup="CalculateTotal();" disabled />



                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Total Amt.</label>
                                                    <input style="background-color:white; background: #e5e9ed;"
                                                        type="text" name="txtTotalAmount" id="txtTotalAmount"
                                                        placeholder="" class="NewFormcontrol" disabled />
                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>&nbsp;&nbsp;&nbsp;L.Cost</label>
                                                    <input style="background-color:white; background: #e5e9ed;"
                                                        type="text" name="txtWeightedCost" id="txtWeightedCost"
                                                        placeholder="" class="NewFormcontrol"
                                                        onkeyup="CalculateTotal();" disabled />



                                                </div>
                                            </div>


                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <div class="controls">
                                                        <input type="button" class="btn btn-sm btn-success "
                                                            onclick="SavePurchaseItems();" value='Add'>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </fieldset>

                                    <div id="DivPurchaseItemList" class="email-content"></div>

                                    <hr>
                                    <textarea id='txtRemarks' name='txtRemarks' class='form-control'
                                        placeholder='Remarks'></textarea>

                                </div>
                            </div>
                            <!-- end col-12 -->
                        </div>

                    </div>
                    <div style="float:right; width:20%;">
                        <div class="panel panel-inverse">

                            <div class="panel-body">
                                <table>

                                    <tr>
                                        <td nowrap>Total Qty</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td><b> <input style="text-align: right;" type="number" class="form-control"
                                                    placeholder="" id='txtTotalPurchaseQty' name='txtTotalPurchaseQty'
                                                    disabled value='0' /><b></td>
                                    </tr>
                                    <tr>
                                        <td><br></td>
                                    </tr>
                                    <tr>
                                        <td>Value</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>
                                            <b>

                                                <input style="text-align: right;" type="number" class="form-control"
                                                    placeholder="" id='txtGrossAmount' name='txtGrossAmount' disabled
                                                    value='0' />

                                            </b>
                                    </tr>

                                    <tr>
                                        <td><br></td>
                                    </tr>

                                    <tr>
                                        <td nowrap>
                                            GST Amount
                                        </td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td> <b> <input style="text-align: right;" type="number" class="form-control"
                                                    placeholder="" id='txtGSTTotalAmount' name='txtGSTTotalAmount'
                                                    disabled value='0' /><b></td>
                                    </tr>
                                    <tr>
                                        <td><br></td>
                                    </tr>
                                    <tr>
                                        <td nowrap>
                                            Other Amount
                                        </td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td> <b> <input style="text-align: right;" type="number" class="form-control"
                                                    placeholder="" id='txtOtherAmount' name='txtOtherAmount' value='0'
                                                    onchange="CalculateOtherCost();" /><b></td>
                                    </tr>
                                    <tr>
                                        <td><br></td>
                                    </tr>

                                    <tr>
                                        <td>Total</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td> <b>

                                                <input type="number" class="form-control" disabled id='txtNettAmount'
                                                    name='txtNettAmount'
                                                    style="text-align: right;background-color:#11742c;color: white;"
                                                    value='0' />


                                            </b>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=6>
                                            <hr>
                                        </td>
                                    </tr>

                                </table>
                                <center>

                                    <input type="button" class="btn btn-md btn-success"
                                        onclick='SavePurchaseMaster();  CalculateCurrentTotal();' id='btnSave'
                                        name='btnSave' value=' &nbsp;&nbsp;Save &nbsp;&nbsp;'>
                                    <input type="button" class="btn btn-md btn-warning"
                                        onclick="window.location.reload();" value='Cancel'>
                                </center>




                                <table>
                                    <tr hidden>

                                        <td>


                                            <input style="text-align: right;" type="hidden" class="form-control"
                                                placeholder="" id='txtTotalProfitAmount' name='txtTotalProfitAmount' />
                                        </td>

                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div style="clear:both"></div>


                <!-- begin panel -->

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

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
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