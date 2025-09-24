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

<body onload="LoadInvoiceNo();" onmousedown="CalculateCurrentTotal()">
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

        <script>
        function SaveSaleItems() {
            var AutoDiscountPercent = document.getElementById("txtDiscPercent").value;
            if (AutoDiscountPercent > 0) {
                CalculateDiscountbyPercent();
            }

            var Currentstock = document.getElementById("txtCurrentStock").value;
            var BillQty = document.getElementById("txtQty").value;

            if (Number(BillQty) > Number(Currentstock)) {
                swal("Alert!", "Bill Qty should not above current stock", "warning");
                document.getElementById("txtQty").value = "";
                document.getElementById("txtQty").focus();
            } else {
                var Invoice = document.getElementById("txtInvoiceNo").value; //
                var ProductCode = document.getElementById("cmbProductCode").value;

                var Qty = document.getElementById("txtQty").value;
                // alert(1);
                var Shortcode = document.getElementById("txtShortcode").value; //
                // alert(1);
                var Category = document.getElementById("txtCategory").value; //

                var ProductName = document.getElementById("txtProductName").value; //
                var MRP = document.getElementById("txtMRP").value;
                var DiscountAmount = document.getElementById("txtDiscAmount").value;
                var DiscountPercent = document.getElementById("txtDiscPercent").value;
                var TotalAmount = document.getElementById("txtTotalAmount").value;
                var ProfitAmount = document.getElementById("txtProfitAmount").value; //
                var BatchCode = document.getElementById("txtBatchcode").value; //
                var Currentstock = document.getElementById("txtCurrentStock")
                    .value; //                                                            
                var SaleDate = document.getElementById("dtSaleDate")
                    .value; //                                                            
                var PaitentCode = document.getElementById("txtPaitentCode").value;
                var Rate = document.getElementById("txtRate").value;
                var DoctorCode = document.getElementById("cmbDoctor").value;

                //alert(2);                                                                                                                                         
                if (Invoice == "" || TotalAmount == "" || PaitentCode == "" || SaleDate == "" || DoctorCode == "") {

                    swal("Alert!", "Kindly provide valid details!", "warning");

                } else if (DiscountPercent > 100) {
                    swal("Alert!", "Discount should not above 100%!", "warning");
                } else {
                    // alert(3);
                    var datas = "&Invoice=" + Invoice + "&ProductCode=" + ProductCode + "&Qty=" + Qty + "&Shortcode=" +
                        Shortcode + "&Shortcode=" + Shortcode +
                        "&Category=" + Category + "&ProductName=" + ProductName + "&MRP=" + MRP + "&DiscountAmount=" +
                        DiscountAmount +
                        "&TotalAmount=" + TotalAmount + "&ProfitAmount=" + ProfitAmount + "&BatchCode=" + BatchCode +
                        "&Currentstock=" + Currentstock + "&PaitentCode=" + PaitentCode + "&Rate=" + Rate +
                        "&SaleDate=" + SaleDate + "&DoctorCode=" + DoctorCode;
                    // alert(datas);
                    $.ajax({
                        url: "Save/SaveBilling.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {
                            // alert(data);

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


        $(document).ready(function() {
            $(document).mousemove(function(event) {
                CalculateCurrentTotal();
            });
        });



        function CalculateCurrentTotal() {
            // alert(1);
            var OldBalance = parseInt(document.getElementById("txtoldbalance").value);
            var CurrentBillTotal = parseInt(document.getElementById("txtAmountCurrentBill").value);
            if (document.getElementById("txtTotalPayment").value == "") {
                var TotalPayment = 0;
            } else {
                var TotalPayment = parseInt(document.getElementById("txtTotalPayment").value);
            }

            var CurrentBalance = parseInt(OldBalance) + parseInt(CurrentBillTotal) - parseInt(TotalPayment);
            document.getElementById("txtBalanceToSave").value = CurrentBalance;
            document.getElementById("txtBalance").value = CurrentBalance;
            // alert(CurrentBillTotal);
        }


        function SaveSaleMaster() {
            // CalculateCurrentTotal();
            var Invoice = document.getElementById("txtInvoiceNo").value;
            var TotalSaleQty = document.getElementById("txtTotalSaleQty").value;
            var TotalDiscountAmount = document.getElementById("txtTotalDiscountAmount").value;
            var TotalProfitAmount = document.getElementById("txtTotalProfitAmount").value;
            var TotalSaleAmount = document.getElementById("txtNettAmount").value;
            var BalanceAmount = document.getElementById("txtBalance").value;
            var PaitentCode = document.getElementById("txtPaitentCode").value;
            var SaleDate = document.getElementById("dtSaleDate").value;

            var GroupID = <?php echo $GroupID; ?>;


            var TotalBalance = 0 * 0.0;
            TotalBalance = BalanceAmount * 1;

            if (Number(TotalBalance) > 0) {
                if (GroupID == '1') {
                    swal("Are you sure want to save bill with due?", {
                            buttons: {

                                Yes: {
                                    text: "Yes",
                                    value: "Yes",
                                    closeOnClickOutside: false,

                                },
                                No: {
                                    text: "No",
                                    value: "No",
                                    closeOnClickOutside: false,

                                },

                            },
                            closeOnClickOutside: false,
                        })
                        .then((value) => {
                            switch (value) {


                                case "Yes":
                                    // window.location.href = BillPrintURL;
                                    // window.open.href = BillPrintURL;
                                    // alert("Bi");

                                    SaveBillingDetails();
                                    break;

                                case "No":
                                    document.getElementById("cmbPaymentMode").focus;
                                    break;
                            }
                        });
                } else {
                    swal("Please provide Payment details");
                }
            }


            // else if (TotalBalance <0 )
            // { 
            // swal("Alert!", "Balance should not less than Zero", "warning");  
            // }
            else if (TotalBalance == 0 || TotalBalance < 0) {
                // alert(1);
                // CalculateCurrentTotal();

                SaveBillingDetails();
            }

        }
        // }


        function SendSMSBilling() {
            var SaleDate = document.getElementById("dtSaleDate").value
            var TotalSaleAmount = document.getElementById("txtNettAmount").value;
            var BalanceAmount = document.getElementById("txtBalance").value;
            var MobileNo = document.getElementById("BillingPaitentMobile").innerText;
            var PaitentName = document.getElementById("BillingPaitentName").innerText;
            var TokenNo = document.getElementById("txtTokenNo").value;

            var datas = "&SaleDate=" + SaleDate +
                "&TotalSaleAmount=" + TotalSaleAmount +
                "&BalanceAmount=" + BalanceAmount +
                "&MobileNo=" + MobileNo +
                "&TokenNo=" + TokenNo +
                "&PaitentName=" + PaitentName;
            $.ajax({
                url: "sendsms.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    // swal(data);
                }
            });
        }

        function SaveBillingDetailsTabConversion() {
            // alert(1);	


            var Invoice = document.getElementById("txtInvoiceNo").value;
            var TotalSaleQty = document.getElementById("txtTotalSaleQty").value;
            var TotalDiscountAmount = document.getElementById("txtTotalDiscountAmount").value;
            // alert(2);	
            var TotalProfitAmount = document.getElementById("txtTotalProfitAmount").value;
            var TotalSaleAmount = document.getElementById("txtNettAmount").value;
            var BalanceAmount = document.getElementById("txtBalance").value;
            var PaitentCode = document.getElementById("txtPaitentID_NewTab").value;
            // alert(3);	
            var SaleDate = document.getElementById("dtSaleDate").value

            // xxxxxxxxxxxxxxxx

            var OldBalance = document.getElementById("txtOldDue").value;
            var ReceivedAmount = document.getElementById("txtTotalPayment").value;
            var NewBalance = document.getElementById("txtBalance").value;
            var DoctorCode = document.getElementById("txtDoctorCode_NewTab").value;
            var TokenNo = document.getElementById("txtTokenNo").value;
            var GrossAmount = document.getElementById("txtGrossAmt").value;
            var PaymentMode = document.getElementById("cmbPaymentMode_tabConversion").value;
            var RegistrationPaymentAmount = document.getElementById("txtPaymentAmount_Tab").value;



            if (Invoice == "" || PaitentCode == "" || SaleDate == "" || DoctorCode == "") {


                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {
                var OldBalance = document.getElementById("txtOldDue").value;
                var ReceivedAmount = document.getElementById("txtTotalPayment").value;
                var NewBalance = document.getElementById("txtBalance").value;
                var Remarks = document.getElementById("txtRemarks").value;
                var BillType = 'Counter';
                var BillingType = 'Regular';
                var LocationCode = document.getElementById("cmbLocationAdmin").value;

                var OldAmountAdjusted = document.getElementById("txtoldbalance").value;

                var datas = "&Invoice=" + Invoice + "&TotalSaleQty=" + TotalSaleQty + "&TotalDiscountAmount=" +
                    TotalDiscountAmount + "&TotalProfitAmount=" + TotalProfitAmount + "&TotalSaleAmount=" +
                    TotalSaleAmount + "&BalanceAmount=" + BalanceAmount + "&PaitentCode=" + PaitentCode + "&SaleDate=" +
                    SaleDate + "&OldBalance=" + OldBalance + "&ReceivedAmount=" + ReceivedAmount + "&NewBalance=" +
                    NewBalance + "&DoctorCode=" + DoctorCode + "&BillType=" + BillType + "&Remarks=" + Remarks +
                    "&TokenNo=" + TokenNo + "&PaymentMode=" + PaymentMode + "&GrossAmount=" + GrossAmount +
                    "&BillingType=" + BillingType + "&RegistrationPaymentAmount=" + RegistrationPaymentAmount +
                    "&LocationCode=" + LocationCode + "&OldAmountAdjusted=" + OldAmountAdjusted;

                $.ajax({
                    url: "Save/SaveSaleMasterTabConversion.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        // swal(data);

                        if (data == 1) {
                            SendSMSBilling();

                            var str1 = "ReceiptPrint.php?invoice=";
                            var str2 = Invoice;
                            var str3 = "";
                            var BillPrintURL = str1.concat(str2, str3);

                            swal("Bill Saved Successfuly !", {
                                    buttons: {

                                        SendSMS: {
                                            text: "Send SMS / Print",
                                            value: "SendSMS",
                                            closeOnClickOutside: false,

                                        },
                                        Close: {
                                            text: "Close",
                                            value: "Close",
                                            closeOnClickOutside: false,

                                        },

                                    },
                                    closeOnClickOutside: false,
                                })
                                .then((value) => {
                                    switch (value) {


                                        case "SendSMS":
                                            redirect();
                                            window.location.href = "Billing.php?MID=26#modal-close";
                                            window.location.reload();
                                            break;

                                        case "Close":
                                            window.location.href = "Billing.php?MID=26#modal-close";
                                            window.location.reload();
                                            break;


                                    }
                                });
                        } else {
                            swal("Alert!", data, "warning");
                            Reset();
                        }


                    }
                });
            }
        }





        function SaveBillingDetailsFreeConsulting() {
            // alert(1);	


            var Invoice = document.getElementById("txtInvoiceNo").value;
            var TotalSaleQty = document.getElementById("txtTotalSaleQty").value;
            var TotalDiscountAmount = document.getElementById("txtTotalDiscountAmount").value;
            // alert(2);	
            var TotalProfitAmount = document.getElementById("txtTotalProfitAmount").value;
            var TotalSaleAmount = document.getElementById("txtNettAmount").value;
            var BalanceAmount = document.getElementById("txtBalance").value;
            var PaitentCode = document.getElementById("txtPaitentCode").value;
            // alert(3);	
            var SaleDate = document.getElementById("dtSaleDate").value

            // xxxxxxxxxxxxxxxx

            var OldBalance = document.getElementById("txtOldDue").value;
            var ReceivedAmount = document.getElementById("txtTotalPayment").value;
            var NewBalance = document.getElementById("txtBalance").value;
            var DoctorCode = document.getElementById("cmbDoctor").value;
            var TokenNo = document.getElementById("txtTokenNo").value;
            var GrossAmount = document.getElementById("txtGrossAmt").value;

            if (Invoice == "" || PaitentCode == "" || SaleDate == "" || DoctorCode == "") {


                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {
                var OldBalance = document.getElementById("txtOldDue").value;
                var ReceivedAmount = document.getElementById("txtTotalPayment").value;
                var NewBalance = document.getElementById("txtBalance").value;
                var Remarks = document.getElementById("txtRemarks").value;
                var BillType = 'Counter';
                var BillingType = 'Regular';
                var LocationCode = document.getElementById("cmbLocationAdmin").value;

                var OldAmountAdjusted = document.getElementById("txtoldbalance").value;

                var datas = "&Invoice=" + Invoice + "&TotalSaleQty=" + TotalSaleQty + "&TotalDiscountAmount=" +
                    TotalDiscountAmount + "&TotalProfitAmount=" + TotalProfitAmount + "&TotalSaleAmount=" +
                    TotalSaleAmount + "&BalanceAmount=" + BalanceAmount + "&PaitentCode=" + PaitentCode + "&SaleDate=" +
                    SaleDate + "&OldBalance=" + OldBalance + "&ReceivedAmount=" + ReceivedAmount + "&NewBalance=" +
                    NewBalance + "&DoctorCode=" + DoctorCode + "&BillType=" + BillType + "&Remarks=" + Remarks +
                    "&TokenNo=" + TokenNo + "&GrossAmount=" + GrossAmount + "&BillingType=" + BillingType +
                    "&LocationCode=" + LocationCode + "&OldAmountAdjusted=" + OldAmountAdjusted;

                $.ajax({
                    url: "Save/SaveSaleMasterFree.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        // swal(data);

                        if (data == 1) {
                            SendSMSBilling();

                            var str1 = "ReceiptPrint.php?invoice=";
                            var str2 = Invoice;
                            var str3 = "";
                            var BillPrintURL = str1.concat(str2, str3);

                            swal("Bill Saved Successfuly !", {
                                    buttons: {

                                        SendSMS: {
                                            text: "Send SMS / Print",
                                            value: "SendSMS",
                                            closeOnClickOutside: false,

                                        },
                                        Close: {
                                            text: "Close",
                                            value: "Close",
                                            closeOnClickOutside: false,

                                        },

                                    },
                                    closeOnClickOutside: false,
                                })
                                .then((value) => {
                                    switch (value) {


                                        case "SendSMS":
                                            redirect();
                                            window.location.href = "Billing.php?MID=26#modal-close";
                                            window.location.reload();
                                            break;

                                        case "Close":
                                            window.location.href = "Billing.php?MID=26#modal-close";
                                            window.location.reload();
                                            break;


                                    }
                                });
                        } else {
                            swal("Alert!", data, "warning");
                            Reset();
                        }


                    }
                });
            }
        }


        function SaveBillingDetails() {
            // alert(1);	


            var Invoice = document.getElementById("txtInvoiceNo").value;
            var TotalSaleQty = document.getElementById("txtTotalSaleQty").value;
            var TotalDiscountAmount = document.getElementById("txtTotalDiscountAmount").value;
            // alert(2);	
            var TotalProfitAmount = document.getElementById("txtTotalProfitAmount").value;
            var TotalSaleAmount = document.getElementById("txtNettAmount").value;
            var BalanceAmount = document.getElementById("txtBalance").value;
            var PaitentCode = document.getElementById("txtPaitentCode").value;
            // alert(3);	
            var SaleDate = document.getElementById("dtSaleDate").value

            // xxxxxxxxxxxxxxxx

            var OldBalance = document.getElementById("txtOldDue").value;
            var ReceivedAmount = document.getElementById("txtTotalPayment").value;
            var NewBalance = document.getElementById("txtBalance").value;
            var DoctorCode = document.getElementById("cmbDoctor").value;
            var TokenNo = document.getElementById("txtTokenNo").value;
            var GrossAmount = document.getElementById("txtGrossAmt").value;
            var ConsultingTiming = document.getElementById("cmbTiming").value;

            if (Invoice == "" || TotalSaleAmount == "" || PaitentCode == "" || SaleDate == "" || DoctorCode == "") {


                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {
                var OldBalance = document.getElementById("txtOldDue").value;
                var ReceivedAmount = document.getElementById("txtTotalPayment").value;
                var NewBalance = document.getElementById("txtBalance").value;
                var Remarks = document.getElementById("txtRemarks").value;
                var BillType = 'Counter';
                var BillingType = 'Regular';
                var LocationCode = document.getElementById("cmbLocationAdmin").value;

                var OldAmountAdjusted = document.getElementById("txtoldbalance").value;

                var datas = "&Invoice=" + Invoice + "&TotalSaleQty=" + TotalSaleQty + "&TotalDiscountAmount=" +
                    TotalDiscountAmount + "&TotalProfitAmount=" + TotalProfitAmount + "&TotalSaleAmount=" +
                    TotalSaleAmount + "&BalanceAmount=" + BalanceAmount + "&PaitentCode=" + PaitentCode + "&SaleDate=" +
                    SaleDate + "&OldBalance=" + OldBalance + "&ReceivedAmount=" + ReceivedAmount + "&NewBalance=" +
                    NewBalance + "&DoctorCode=" + DoctorCode + "&BillType=" + BillType + "&Remarks=" + Remarks +
                    "&TokenNo=" + TokenNo + "&GrossAmount=" + GrossAmount + "&BillingType=" + BillingType +
                    "&LocationCode=" + LocationCode + "&OldAmountAdjusted=" + OldAmountAdjusted +
                    "&ConsultingTiming=" + ConsultingTiming;

                $.ajax({
                    url: "Save/SaveSaleMaster.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        // swal(data);

                        if (data == 1) {
                            SendSMSBilling();

                            var str1 = "ReceiptPrint.php?invoice=";
                            var str2 = Invoice;
                            var str3 = "";
                            var BillPrintURL = str1.concat(str2, str3);

                            swal("Bill Saved Successfuly !", {
                                    buttons: {

                                        SendSMS: {
                                            text: "Send SMS / Print",
                                            value: "SendSMS",
                                            closeOnClickOutside: false,

                                        },
                                        Close: {
                                            text: "Close",
                                            value: "Close",
                                            closeOnClickOutside: false,

                                        },

                                    },
                                    closeOnClickOutside: false,
                                })
                                .then((value) => {
                                    switch (value) {


                                        case "SendSMS":
                                            redirect();
                                            window.location.href = "Billing.php?MID=26#modal-close";
                                            window.location.reload();
                                            break;

                                        case "Close":
                                            window.location.href = "Billing.php?MID=26#modal-close";
                                            window.location.reload();
                                            break;


                                    }
                                });
                        } else {
                            swal("Alert!", data, "warning");
                            Reset();
                        }


                    }
                });
            }
        }




        function redirect() {
            var Invoice = document.getElementById("txtInvoiceNo").value;
            var str1 = "ReceiptPrint.php?invoice=";
            var str2 = Invoice;
            var str3 = "";
            var BillPrintURL = str1.concat(str2, str3);
            // alert(BillPrintURL);
            // window.location.href = BillPrintURL;
            window.open(BillPrintURL);
        }


        function Reset() {


            document.getElementById("txtQty").value = "";
            document.getElementById("txtShortcode").value = "";
            document.getElementById("txtCategory").value = "";
            document.getElementById("txtProductName").value = "";
            document.getElementById("txtMRP").value = "";
            document.getElementById("txtDiscAmount").value = "";
            document.getElementById("txtTotalAmount").value = "";
            document.getElementById("txtProfitAmount").value = "";
            document.getElementById("txtBatchcode").value = "";
            document.getElementById("txtCurrentStock").value = "";
            document.getElementById("txtRate").value = "";
            document.getElementById("txtTotalAmount").value = "";
            $("#cmbProductCode").val('default');
            $("#cmbProductCode").selectpicker("refresh");


        }


        function CalculateTotal() {
            var MRP = document.getElementById("txtMRP").value;

            // var DiscPercent = document.getElementById("txtDiscPercent").value;
            var DiscAmount = document.getElementById("txtDiscAmount").value;
            var TotalAmount = MRP - DiscAmount;
            // document.getElementById("txtDiscPercent").focus();
            document.getElementById("txtTotalAmount").value = TotalAmount;


        }

        function CalculateDiscountbyPercent() {
            var MRP = document.getElementById("txtMRP").value;

            var DiscPercent = document.getElementById("txtDiscPercent").value;
            var DiscAmount = MRP * (DiscPercent / 100);
            document.getElementById("txtDiscAmount").value = DiscAmount;
            var TotalAmount = MRP - DiscAmount;
            // document.getElementById("txtDiscPercent").focus();
            document.getElementById("txtTotalAmount").value = TotalAmount;

        }

        function ClearTotalAmount() {
            document.getElementById("txtTotalAmount").value = 0;
        }

        function LoadInvoiceNo() {

            var InvoiceNo = new Date().getTime();
            document.getElementById("txtInvoiceNo").value = InvoiceNo;

            // GetTokenNumber();
            LoadProductList();

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

            var StockItemID = document.getElementById("cmbProductCode").value;
            var datas = "&StockItemID=" + StockItemID;
            // alert(datas);
            $.ajax({
                url: "Load/LoadProductDetailsBilling.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#txtMRP").val(data[0]);
                    $("#txtTotalAmount").val(data[0]);
                    document.getElementById("txtDiscAmount").focus();





                }
            });
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
                    $("#txtNettAmount").val(data[0]);
                    $("#txtAmountCurrentBill").val(data[0]);

                    $("#txtTotalDiscountAmount").val(data[1]);
                    $("#txtGrossAmt").val(data[2]);

                }
            });

        }


        function ClearBarcode() {
            document.getElementById("txtPaitentBarcode").value = '';
            $('#txtPaitentBarcode').prop('disabled', true);
        }

        function ClearPaitentDropdown() {
            //document.getElementById("txtMobileNo").value='';
            $('#txtMobileNo').prop('disabled', true);
        }



        function LoadPaitentDetails() {

            var MobileNo = document.getElementById("txtMobileNo").value;


            var Barcode = document.getElementById("txtPaitentBarcode").value;
            var datas = "&MobileNo=" + MobileNo + "&Barcode=" + Barcode;
            //    alert(datas);
            $.ajax({
                url: "Load/LoadPaitentDetails.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {
                    // alert(data);
                    $("#txtName").val(data[0]);
                    $("#txtPaitentCode").val(data[1]);
                    $("#txtOldDue").val(data[2]);
                    $("#txtoldbalance").val(data[2]);
                    $("#txtPendingOrders").val(data[3]);

                    $("#BillingPaitentMobile").html(data[8]);
                    $("#BillingPaitentName").html(data[0]);

                    $("#txtEmail").val(data[4]);
                    $("#txtDOB").val(data[5]);
                    $("#txtGender").val(data[6]);
                    $("#txtDiscountPaitentStatus").val(data[7]);
                    $("#txtDiscPercent").val(data[11]);

                    if (data[9] > 0) {
                        $("#spnOldConsulting").text("Old Patient");
                        $("#spnNewConsulting").text("");
                        $("#spnFreeConsulting").text("");
                        var x = document.getElementById("btnGenerateFree");

                        x.style.display = "none";

                    } else {
                        $("#spnNewConsulting").text("New Patient");
                        $("#spnOldConsulting").text("");
                        $("#spnFreeConsulting").text("");
                        var x = document.getElementById("btnGenerateFree");

                        x.style.display = "none";

                    }
                    if (data[14] =='Free') {
                        $("#spnFreeConsulting").text("Free Consulting");
                        $("#spnOldConsulting").text("");
                        $("#spnNewConsulting").text("");

                        var x = document.getElementById("btnGenerateFree");

                        x.style.display = "block";

                    }




                    var OldBalance = document.getElementById("txtOldDue");

                    if (OldBalance.value > 0) {
                        OldBalance.style.backgroundColor = "red";
                        OldBalance.style.color = "white";

                    } else
                    if (OldBalance.value < 0) {
                        OldBalance.style.backgroundColor = "green";
                        OldBalance.style.color = "white";
                    }


                    var DiscountStatus = document.getElementById("txtDiscountPaitentStatus");

                    if (DiscountStatus.value == 'YES') {
                        DiscountStatus.style.backgroundColor = "#EBBB27";
                        DiscountStatus.style.color = "black";

                    } else
                    if (DiscountStatus.value == 'No') {
                        DiscountStatus.style.backgroundColor = "white";
                        DiscountStatus.style.color = "black";
                    }




                    var PaitentCode = document.getElementById("txtPaitentCode").value;
                    if (PaitentCode == "") {

                    } else {
                        document.getElementById("cmbProductCode").focus();
                    }

                }
            });
            OrderDetails();

            $('#modalPaitentDetails').modal('show');

        }



        function LoadProductList() {

            var Invoice = document.getElementById("txtInvoiceNo").value;
            var datas = "&Invoice=" + Invoice;
            // alert(datas);
            $.ajax({
                url: "Load/LoadBillingItemList.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivTutorList').html(data);


                }
            });
            LoadInvoiceTotal();


        }

        function OrderDetails() {

            var MobileNo = document.getElementById("txtMobileNo").value;
            var datas = "&MobileNo=" + MobileNo;

            $.ajax({
                url: "Load/LoadPaitentOrderDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivOrderDetails').html(data);


                }
            });

        }

        function UpdatePaitentDetails() {
            var PaitentCode = document.getElementById("txtPaitentCode").value;
            var DOB = document.getElementById("txtDOB").value;
            var Email = document.getElementById("txtEmail").value;
            var Gender = document.getElementById("txtGender").value;

            var datas = "&PaitentCode=" + PaitentCode + "&DOB=" + DOB + "&Email=" + Email + "&Gender=" + Gender;

            $.ajax({
                url: "Save/UpdatePaitentDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {

                }
            });

        }



        function SavePaymentDetails() {

            var Invoice = document.getElementById("txtInvoiceNo").value;
            var PaitentCode = document.getElementById("txtPaitentCode").value;
            var PaymentMode = document.getElementById("cmbPaymentMode").value;
            var PaymentAmount = document.getElementById("txtPaymentAmount").value;
            var NettAmount = document.getElementById("txtNettAmount").value;
            var SaleDate = document.getElementById("dtSaleDate").value;
            var LocationCode = document.getElementById("cmbLocationAdmin").value;

            if (PaymentMode == "" || PaymentAmount == "" || NettAmount == "") {

                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {
                var datas = "&PaymentMode=" + PaymentMode + "&Invoice=" + Invoice + "&PaitentCode=" + PaitentCode +
                    "&PaymentAmount=" + PaymentAmount + "&SaleDate=" + SaleDate + "&LocationCode=" + LocationCode;
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

            var Invoice = document.getElementById("txtInvoiceNo").value;





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

        function DeleteProductinBillingItem() {

            var ItemID = document.getElementById("txtItemID").value;
            var Invoice = document.getElementById("txtInvoiceNo").value;
            var datas = "&ItemID=" + ItemID + "&Invoice=" + Invoice;

            $.ajax({
                url: "Delete/DeleteBillingItem.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    alert(data);

                }
            });
            LoadProductList();
        }

        function LoadPaymentTotal() {

            var Invoice = document.getElementById("txtInvoiceNo").value;
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
                    // $("#txtBalance").val(data[2]);  
                    // $("#txtBalanceToSave").val(data[2]);  




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

        function DeleteBillingItem(x) {
            var SelectedColumn = x.cellIndex;
            var SelectedRow = x.parentNode.rowIndex;

            var Id = document.getElementById("tblBillingItems").rows[SelectedRow].cells[1].innerHTML;
            document.getElementById("txtItemID").value = Id;
            DeleteProductinBillingItem();
        }

        function focusamount() {
            document.getElementById("txtPaymentAmount").focus();
        }

        function CheckTokenNumber() {
            var Dummy = 1;

            var datas = "&Dummy=" + Dummy;
            // alert(datas);
            $.ajax({
                url: "Load/CheckTokenNumber.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {
                    $("#txtTokenNo").val(data[0]);
                }
            });
        }

        function GetTokenNumber() {
            var Dummy = 1;
            var DoctorCode = document.getElementById("cmbDoctor").value;
            var LocationCode = document.getElementById("cmbLocationAdmin").value;

            var datas = "&LocationCode=" + LocationCode + "&DoctorCode=" + DoctorCode;

            $.ajax({
                url: "Load/LoadTokenNo.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#txtTokenNo").val(data[0]);
                }
            });
        }

        function LoadOnlineRegistration() {

            var MobileNo = '123';
            var datas = "&MobileNo=" + MobileNo;

            $.ajax({
                url: "Load/LoadOnineRegistrationPaitents.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivOnlineRegistration').html(data);
                }
            });

        }


        function LoadSpeacailTokenTiming() {

            var DoctorCode = document.getElementById("cmbDoctor").value;
            var SaleDate = document.getElementById("dtSaleDate").value;
            var ProductCode = document.getElementById("cmbProductCode").value;

            var datas = "&DoctorCode=" + DoctorCode + "&SaleDate=" + SaleDate + "&ProductCode=" + ProductCode;
            if (DoctorCode == '' || SaleDate == '') {

            } else {


                if (ProductCode == '33') {
                    $.ajax({
                        url: "Load/LoadTimingSpecialToken.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {


                            $('#DivSpecialToken').html(data);


                        }
                    });

                } else {
                    document.getElementById("cmbTiming").disabled = true;
                    document.getElementById("cmbTiming").value = 0;

                }

            }
        }


        function SaveNewBarcode() {
            var PaitentCode = document.getElementById("txtPaitentCode").value;
            var Barcode = document.getElementById("txtBarcodeNew").value;

            if (PaitentCode == "" || Barcode == "") {

                swal("Alert!", "Kindly Select Paitent Mobile No and provide Barcode !", "warning");

            } else {
                var datas = "&PaitentCode=" + PaitentCode + "&Barcode=" + Barcode;
                // alert(datas);
                $.ajax({
                    url: "Save/SaveNewBarcode.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == 1) {
                            swal("Sucess", "Barcode Assigned", "success");
                        } else {
                            swal("Alert!", "Barcode Already Assigned to another paitent", "warning");
                        }
                        document.getElementById("txtBarcodeNew").value = '';
                    }
                });
            }

        }


        function ShowHideDiv() {
            var cmbPeriod = "Custom";
            var DivFromDate = document.getElementById("lblFromDate");
            DivFromDate.style.display = "inline-block";

            var DivToDate = document.getElementById("lblToDate");
            DivToDate.style.display = "inline-block";

        }

        function GetNewTabRegistrationDetails(x, y, z) {

            document.getElementById("txtPaitentID_NewTab").value = x;
            document.getElementById("txtDoctorCode_NewTab").value = y;
            document.getElementById("txtPaymentAmount_Tab").value = z;
            $("#spnPaymentAmount").text(z);

            ShowHideDiv();
        }
        </script>








        <div class="modal fade" id="modalNewBarcode">
            <div class="modal-dialog" style="width:800px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Map New Barcode</h4>
                    </div>
                    <div class="modal-body">
                        <label> New Barcode</label>
                        <input type='text' class='form-control' name='txtBarcodeNew' id='txtBarcodeNew' />


                    </div>
                    <div class="modal-footer">

                        <a href="javascript:;" class="btn btn-sm btn-success" data-dismiss="modal"
                            onclick='SaveNewBarcode()'>Save</a>

                        <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalOnlineRegistration">
            <div class="modal-dialog" style="width:800px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Paitent Registered in Tab</h4>
                    </div>
                    <div class="modal-body">
                        <div id='DivOnlineRegistration' name='DivOnlineRegistration'> </div>
                        <hr>

                        <input type='hidden' id='txtPaitentID_NewTab' name='txtPaitentID_NewTab' />
                        <input type='hidden' id='txtDoctorCode_NewTab' name='txtDoctorCode_NewTab' />
                        <input type='hidden' id='txtPaymentAmount_Tab' name='txtPaymentAmount_Tab' />


                        <label class="radio-inline" id='lblFromDate' style='display:none;'>
                            <h3>Payment Rs:<span id='spnPaymentAmount' name='spnPaymentAmount'></span>
                            </h3>
                            <select class="form-control" id='cmbPaymentMode_tabConversion'
                                name='cmbPaymentMode_tabConversion'>
                                <option></option>
                                <?php
                                $sqli = "  SELECT paymentmodecode, paymentmode FROM paymentmodemaster WHERE activestatus='Active'";
                                $result = mysqli_query($connection, $sqli);
                                while ($row = mysqli_fetch_array($result)) {
                                    # code...

                                    echo ' <option value=' . $row['paymentmodecode'] . '>' . $row['paymentmode'] . '</option>';
                                }
                                ?>

                            </select>
                            <br>

                            <a href="javascript:;" class="btn btn-sm btn-success" data-dismiss="modal"
                                onclick='SaveBillingDetailsTabConversion()'>

                                Confirm Payment</a>


                        </label>


                    </div>
                    <div class="modal-footer">



                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-dialog">
            <div class="modal-dialog" style="width:800px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Order Details</h4>
                    </div>
                    <div class="modal-body">
                        <div id='DivOrderDetails' name='DivOrderDetails'> </div>

                    </div>
                    <div class="modal-footer">

                        <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalPaitentDetails" name="modalPaitentDetails">
            <div class="modal-dialog" style="width:500px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Paitent Details</h4>
                    </div>
                    <div class="modal-body">
                        <tr>
                            <td>Gender:</td>
                            <td>
                                <select class="form-control" id='txtGender' name='txtGender'>
                                    <option value='-'>-</option>
                                    <option value='Male'>Male</option>
                                    <option value='Female'>Female</option>

                                </select>

                            </td>
                        </tr>

                        <tr>
                            <td>DOB:</td>
                            <td>

                                <input class="form-control" type='date' id='txtDOB' name='txtDOB' />
                            </td>

                        </tr>

                        <tr>
                            <td>Email ID:</td>
                            <td><input class="form-control" type='text' id='txtEmail' name='txtEmail' /></td>
                        </tr>


                    </div>
                    <div class="modal-footer">

                        <a href="javascript:;" class="btn btn-sm btn-info" onclick='UpdatePaitentDetails();'
                            data-dismiss="modal">Save</a>
                        <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>

                    </div>
                </div>
            </div>
        </div>

        <div id="content" class="content">
            <label><b><u>Consultation Bill - Today</u></b></label>

            <center><b><span class="blinkNew" id='spnNewConsulting'> </span></b>
                <b><span class="blinkOld" id='spnOldConsulting'> </span></b>
                <b><span class="blinkFree" id='spnFreeConsulting'> </span></b>
            </center>


            <center>

                <button id='btnGenerateFree' class="btn btn-primary  btn-xs" style='display:none;'
                    onclick='SaveBillingDetailsFreeConsulting()'>Generate Free
                    Token</button>
            </center>

            <style>
            @keyframes blink {
                0% {
                    opacity: 0;
                }

                50% {
                    opacity: .5;
                }

                100% {
                    opacity: 1;
                }
            }

            @-webkit-keyframes blink {
                50% {
                    opacity: 0.0;
                }
            }

            .blinkOld {
                animation: blink 1s linear infinite;
                -webkit-animation: blink 1s step-start 0s infinite;
                background-color: magenta;

                color: white;

            }

            .blinkNew {
                animation: blink 1s linear infinite;
                -webkit-animation: blink 1s step-start 0s infinite;
                background-color: red;

                color: white;

            }

            .blinkFree {
                animation: blink 1s linear infinite;
                -webkit-animation: blink 1s step-start 0s infinite;
                background-color: yellow;

                color: black;

            }
            </style>

            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-12">



                    <div id='ModalProject' class='modal-window'>
                        <div class="row">



                            <a href='#modal-close' title='Close' class='modal-close'>&times;</a>
                            <input type='hidden' id='txtProjectId' name='txtProjectId' />
                            <input type='hidden' id='txtQuery' name='txtQuery' />
                            <input type='hidden' id='txtPaymentID' name='txtPaymentID' />
                            <input type='hidden' id='txtItemID' name='txtItemID' />

                            <h1>Payment
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp; Name: <span id='BillingPaitentName'> </span> /&nbsp;
                                <span id='BillingPaitentMobile'></span>
                            </h1>



                            <hr>

                            <table>
                                <tr>
                                    <td>Mode</td>
                                    <td>&nbsp;&nbsp;</td>
                                    <td>Amount</td>
                                    <td>&nbsp;&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td> <select class="form-control" id='cmbPaymentMode' name='cmbPaymentMode'
                                            onchange='focusamount();'>
                                            <option></option>
                                            <?php
                                            $sqli = "  SELECT paymentmodecode, paymentmode FROM paymentmodemaster WHERE activestatus='Active'";
                                            $result = mysqli_query($connection, $sqli);
                                            while ($row = mysqli_fetch_array($result)) {
                                                # code...

                                                echo ' <option value=' . $row['paymentmodecode'] . '>' . $row['paymentmode'] . '</option>';
                                            }
                                            ?>

                                        </select> </td>
                                    <td>&nbsp;&nbsp;</td>
                                    <td> <input type="number" name="txtPaymentAmount" id="txtPaymentAmount"
                                            placeholder="" class="form-control" /></td>
                                    <td>&nbsp;&nbsp;</td>
                                    <td> <button type='button' class="btn btn-sm btn-primary"
                                            onclick="SavePaymentDetails(); " data-dismiss='modal'> Add </button> </td>

                                </tr>

                            </table>


                            <hr>
                            <div class="col-md-9">
                                <div data-scrollbar="true" data-height="250px">

                                    <ul class="chats">

                                        <label> <u>Payment Details</u> </label>
                                        <div id="DivPaymentList" class="email-content"></div>

                                    </ul>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="vl"></div>
                            <div class="col-md-3">
                                <input type="hidden" class="form-control" disabled id='txtBalanceToSave'
                                    name='txtBalanceToSave' style="text-align: right;background-color:white;"
                                    onchange="CalculateCurrentTotal();" />

                                <table>
                                    <tr>
                                        <td>Old Due</td>
                                        <td width="120px;"><b><input type="number" class="form-control" disabled
                                                    id='txtoldbalance' name='txtoldbalance'
                                                    style="text-align: right;background-color:white;" value='0'
                                                    onchange="CalculateCurrentTotal();" /></b></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Current Bill</td>
                                        <td><b><input type="number" class="form-control" disabled
                                                    id='txtAmountCurrentBill' name='txtAmountCurrentBill'
                                                    style="text-align: right;background-color:white;" value='0'
                                                    onchange="CalculateCurrentTotal();" /></b></td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><b><input type="number" class="form-control" disabled id='txtTotalDueAmount'
                                                    name='txtTotalDueAmount'
                                                    style="text-align: right;background-color:white;" value='0'
                                                    onchange="CalculateCurrentTotal();" /></b></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Payment</td>
                                        <td><b><input type="number" class="form-control" disabled id='txtTotalPayment'
                                                    name='txtTotalPayment'
                                                    style="text-align: right;background-color:white;" value='0'
                                                    onchange="CalculateCurrentTotal();" /></b></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Balance</td>
                                        <td><b><input type="number" class="form-control" disabled id='txtBalance'
                                                    name='txtBalance' style="text-align: right;background-color:white;"
                                                    onchange="CalculateCurrentTotal();" /></b></td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <td> </td>
                                    <td>
                                        <br><input type="button" class="btn btn-sm btn-success"
                                            data-dismiss='modal-close' onclick="SaveSaleMaster();" value='Save'>
                                    </td>
                                    </tr>

                                </table>
                            </div>

                            <br>

                            <textarea id="txtRemarks" name="txtRemarks" rows="4" cols="50"
                                placeholder='Remarks'></textarea>
                        </div>




                    </div>
                </div>


                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-body">
                        <input type="hidden" name="txtInvoiceNo" id="txtInvoiceNo" placeholder="" class="form-control"
                            <div>
                        <table>
                            <tr>
                                <td>Sale Date </td>
                                <td></td>
                                <td>Location</td>
                                <td></td>
                                <td>Doctor</td>
                                <td></td>
                                <td>Mobile No&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href='#modalOnlineRegistration' style='color:Green' data-toggle='modal'
                                        onclick='LoadOnlineRegistration()'>View
                                        Tab Reg
                                        </i></a>
                                </td>
                                <td></td>
                                <td>Barcode &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href='#modalNewBarcode' style='color:Green' data-toggle='modal'>Sync</a>
                                </td>
                                <td></td>
                                <td>&nbsp;&nbsp;</td>
                                <td></td>
                                <td>Patient Name</td>
                                <td></td>
                                <td>Old Due</td>
                                <td></td>
                                <td hidden>Pending Orders</td>
                                <td></td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    Token: &nbsp;&nbsp;</td>
                                <td><input type='text' id='txtTokenNo' name='txtTokenNo' disabled
                                        style="font-size: 20px; box-shadow: 2px 2px 3px blue; border-radius: 5px; padding: 4px 7px;  text-align: center;"
                                        maxlength="4" size="4" /> </td>

                            </tr>
                            <tr>
                                <td><input type="date" class="form-control" placeholder="" id='dtSaleDate'
                                        name='dtSaleDate' value='<?php echo date('Y-m-d'); ?>' disabled />

                                </td>

                                <td>&nbsp;&nbsp;</td>

                                <td>
                                    <?php
                                    if ($GroupID == '1') {
                                    ?>
                                    <select class="form-control"
                                        style='border-radius: 4px; padding: 5px; text-align: left;'
                                        id='cmbLocationAdmin' name='cmbLocationAdmin' onchange='HideCourierDetails()'
                                        style="width: 150px;">
                                        <?php
                                            $sqli = "SELECT locationcode,locationname FROM locationmaster where activestatus='Active'";
                                            $result = mysqli_query($connection, $sqli);
                                            while ($row = mysqli_fetch_array($result)) {
                                                # code...

                                                echo ' <option value=' . $row['locationcode'] . '>' . $row['locationname'] . '</option>';
                                            }
                                            ?>
                                    </select>
                                    <?php
                                    } else { ?>
                                    <select class="form-control"
                                        style='border-radius: 4px; padding: 5px; text-align: left;'
                                        id='cmbLocationAdmin' name='cmbLocationAdmin' onchange='HideCourierDetails()'
                                        style="width: 150px;">
                                        <?php
                                            $sqli = "SELECT locationcode,locationname FROM locationmaster where activestatus='Active' and 
                    locationcode ='$LocationCode'";
                                            $result = mysqli_query($connection, $sqli);
                                            while ($row = mysqli_fetch_array($result)) {
                                                # code...

                                                echo ' <option value=' . $row['locationcode'] . '>' . $row['locationname'] . '</option>';
                                            }
                                            ?>
                                    </select>
                                    <?php }
                                    ?>

                                </td>
                                <td>&nbsp;&nbsp;</td>


                                <td><select class="form-control"
                                        style='border-radius: 4px; padding: 5px; text-align: left;' id='cmbDoctor'
                                        name='cmbDoctor' style="width: 150px;" onchange='GetTokenNumber();'>
                                        <option selected></option>

                                        <?php
                                        $sqli = "SELECT userid,username FROM usermaster where designationid='9' and  activestatus='Active'";
                                        $result = mysqli_query($connection, $sqli);
                                        while ($row = mysqli_fetch_array($result)) {
                                            # code...

                                            echo ' <option value=' . $row['userid'] . '>' . $row['username'] . '</option>';
                                        }
                                        ?>
                                    </select></td>
                                <td>&nbsp;&nbsp;</td>
                                <td>

                                    <select class="selectpicker" data-show-subtext="true" data-live-search="true"
                                        data-style="btn-white" id='txtMobileNo' name='txtMobileNo'
                                        onchange='LoadPaitentDetails();ClearBarcode();'>
                                        <option selected></option>

                                        <?php
                                        $sqli = "SELECT paitentid,concat(paitentname,' - ', mobileno) as Mobile FROM   `paitentmaster`";
                                        $result = mysqli_query($connection, $sqli);
                                        while ($row = mysqli_fetch_array($result)) {
                                            # code...

                                            echo ' <option value=' . $row['paitentid'] . '>' . $row['Mobile'] . '</option>';
                                        }
                                        ?>
                                    </select>

                                    <input type="hidden" name="txtMobileNoq" id="txtMobileNoq" placeholder=""
                                        class="form-control" onblur="LoadPaitentDetails();" />





                                    <input type="hidden" name="txtPaitentCode" id="txtPaitentCode" placeholder=""
                                        class="form-control" />
                                </td>
                                <td>&nbsp;&nbsp;</td>

                                <td> <input style="background-color:white;" type="text" name="txtPaitentBarcode"
                                        id="txtPaitentBarcode" placeholder="" class="form-control"
                                        onblur='LoadPaitentDetails();ClearPaitentDropdown();' /></td>
                                <td>&nbsp;&nbsp;</td>

                                <td><a href="AddPaitent.php?MID=18" class="btn btn-sm btn-success">+</a></td>
                                <td>&nbsp;&nbsp;</td>
                                <td> <input style="background-color:white;" type="text" name="txtName" id="txtName"
                                        placeholder="" class="form-control" disabled /></td>
                                <td>&nbsp;&nbsp;</td>
                                <td><input style="background-color:white;" type="text" name="txtOldDue" id="txtOldDue"
                                        placeholder="0" class="form-control" disabled /></td>
                                <td>&nbsp;&nbsp;</td>
                                <td hidden> <input style="background-color:white;" type="text" name="txtPendingOrders"
                                        id="txtPendingOrders" placeholder="0" class="form-control" disabled /> </td>
                                <td hidden>
                                    <a href='#modal-dialog' data-toggle='modal'>Details</i></a>
                                </td>
                                <td>&nbsp;&nbsp;</td>


                            </tr>

                        </table><br>
                        <fieldset>



                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label> Product</label><br>
                                        <select class="form-control" id='cmbProductCode' name='cmbProductCode'
                                            onchange="LoadProductDetails();ClearTotalAmount();LoadSpeacailTokenTiming()">
                                            <option selected></option>

                                            <?php
                                            $sqli = " SELECT consultationid,consultationname FROM  consultationmaster 
                                            WHERE activestatus ='Active' and consultingtype='General'";
                                            $result = mysqli_query($connection, $sqli);
                                            while ($row = mysqli_fetch_array($result)) {
                                                # code...

                                                echo ' <option value=' . $row['consultationid'] . '>' . $row['consultationname'] . '</option>';
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>




































                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label> Timing</label><br>
                                        <div id='DivSpecialToken'>

                                            <select class="form-control" id='cmbTiming' name='cmbTiming' disabled ">
                                            <option value=0></option>
 
                                        </select>

                                        </div>

                                    </div>
                                </div>

 

                                <input style=" background-color:white;" type="hidden" name="txtShortcode"
                                                id="txtShortcode" placeholder="" class="form-control" disabled />
                                            <input style="background-color:white;" type="hidden" name="txtCategory"
                                                id="txtCategory" placeholder="" class="form-control" disabled />
                                            <input style="background-color:white;" type="hidden" name="txtProductName"
                                                id="txtProductName" placeholder="" class="form-control" disabled />
                                            <input style="background-color:white;" type="hidden" name="txtBatchcode"
                                                id="txtBatchcode" placeholder="" class="form-control" disabled />
                                            <input style="background-color:white;" type="hidden" name="txtProfitAmount"
                                                id="txtProfitAmount" placeholder="" class="form-control" disabled />

                                            <input style="background-color:white;" type="hidden" name="txtRate"
                                                id="txtRate" placeholder="" class="form-control" disabled />
                                            <input style="background-color:white;" type="hidden" name="txtLocationCode"
                                                id="txtLocationCode" placeholder="" class="form-control" disabled />

                                            &nbsp;&nbsp;&nbsp;
                                            <div class="col-md-1">

                                                <div class="form-group">
                                                    <label>MRP</label>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <input style="background-color:white;" type="text" name="txtMRP"
                                                        id="txtMRP" placeholder="" class="form-control"
                                                        onkeyup="CalculateTotal();" disabled />
                                                </div>
                                            </div>


                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Disc Amt.</label>
                                                    <input type="text" name="txtDiscAmount" id="txtDiscAmount"
                                                        placeholder="" class="form-control" value=0
                                                        onkeyup="CalculateTotal();" />
                                                </div>

                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Total Amt.</label>
                                                    <input style="background-color:white;" type="text"
                                                        name="txtTotalAmount" id="txtTotalAmount" placeholder=""
                                                        class="form-control" disabled />
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <br>
                                                    <div class="controls">
                                                        <input type="button" class="btn btn-sm btn-success"
                                                            onclick="SaveSaleItems();" value='Add'>
                                                        <input type="button" class="btn btn-sm btn-warning"
                                                            onclick="Reset();" value='Clear'>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Cons. Paitent</label>
                                                    <input style="background-color:white;" type="text"
                                                        name="txtDiscountPaitentStatus" id="txtDiscountPaitentStatus"
                                                        placeholder="0" class="form-control" disabled />
                                                </div>
                                            </div>


                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Disc %</label>
                                                    <input type="text" disabled name="txtDiscPercent"
                                                        id="txtDiscPercent" placeholder="" class="form-control" value=0
                                                        onkeyup="CalculateTotal();" />
                                                </div>
                                            </div>
                                        </div>

                                        <div style="display:none;">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Cr. Stock</label>
                                                    <input style="background-color:white;" type="text"
                                                        name="txtCurrentStock" id="txtCurrentStock" placeholder=""
                                                        class="form-control" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Qty</label>
                                                    <input type="text" name="txtQty" id="txtQty" placeholder=""
                                                        class="form-control" onkeyup="CalculateTotal();" />
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Disc %</label>
                                                    <input type="text" name="txtDiscPercent" id="txtDiscPercent"
                                                        placeholder="" class="form-control" value=0
                                                        onkeyup="CalculateTotal();" />
                                                </div>
                                            </div>
                                        </div>



                        </fieldset>
                    </div>

                    <div class="col-md-12">
                        <!-- begin panel -->
                        <div class="panel panel-inverse" data-sortable-id="form-stuff-1">

                            <div class="panel-body">

                                <div data-scrollbar="true" data-height="250px">

                                    <ul class="chats">


                                        <div id="DivTutorList" class="email-content"></div>

                                    </ul>
                                </div>
                                <br>


                                <table style="position: relative; float:right;">
                                    <tr>
                                        <td>

                                            <input style="text-align: right;" type="hidden" class="form-control"
                                                placeholder="" id='txtTotalDiscountAmount'
                                                name='txtTotalDiscountAmount' />

                                            <input style="text-align: right;" type="hidden" class="form-control"
                                                placeholder="" id='txtTotalProfitAmount' name='txtTotalProfitAmount' />

                                        </td>
                                        <td hidden style="text-align: right;"><label>Qty</label></td>
                                        <td hidden>
                                            <div class="col-md-8">
                                                <b> <input style="text-align: right;" type="text" class="form-control"
                                                        placeholder="" id='txtTotalSaleQty' name='txtTotalSaleQty'
                                                        disabled /><b>

                                            </div>
                                        </td>



                                        <td style="text-align: right;"><label>Total</label></td>
                                        <td>
                                            <div class="col-md-12">
                                                <b> <input style="text-align: right;" type="text" class="form-control"
                                                        placeholder="" id='txtNettAmount' name='txtNettAmount'
                                                        disabled /><b>

                                                        <input style="text-align: right;" type="hidden"
                                                            class="form-control" placeholder="" id='txtGrossAmt'
                                                            name='txtGrossAmt' disabled />

                                            </div>
                                        </td>
                                        <td> <a href='#ModalProject'> <input type="button"
                                                    class="btn btn-sm btn-success"
                                                    onclick='LoadPaymentDetails();  CalculateCurrentTotal();'
                                                    value='Save'> </a> </td>
                                        <td> &nbsp;&nbsp;&nbsp; <input type="button" class="btn btn-sm btn-warning"
                                                onclick="window.location.reload();" value='Cancel'>
                                        </td>
                                    <tr>
                                        <table>


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