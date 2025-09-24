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

$ConsultingInvoiceno = $_GET['i'];
$PatientCode = $_GET['P']; 
$currentdate = date("Y-m-d");

$res = $connection->query(" 
SELECT diseasemappinguniqueid,concat(c.`paitentname`,' - ',c.mobileno),b.`username`,b.userid FROM diseasemapping_paitent AS a JOIN 
usermaster AS b ON a.addedby = b.`userid` JOIN 
paitentmaster AS c ON a.`paitientid`=c.`paitentid`
 WHERE consultingdate ='$currentdate'
AND conceptname ='Medicine' AND diseasemappinguniqueid ='$ConsultingInvoiceno'
GROUP BY username,concat(c.`paitentname`,' - ',c.mobileno),diseasemappinguniqueid,b.userid ;");

while ($data = mysqli_fetch_row($res)) { 
    $PatientName = $data[1];
    $DoctorName = $data[2]; 
    $DoctorCode = $data[3]; 
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

<body onload="LoadInvoiceNo();LoadPaitentDetails();" onmousedown="CalculateCurrentTotal()">
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
            <?php include("IMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->

        <script>
        function SaveSaleItems() {



            var Currentstock = document.getElementById("txtCurrentStock").value;
            var BillQty = document.getElementById("txtQty").value;

            var ProductName = document.getElementById("txtProductName").value; //
            var MRP = document.getElementById("txtMRP").value;

            if (Number(BillQty) > Number(Currentstock)) {
                swal("Alert!", "Bill Qty should not above current stock", "warning");
                document.getElementById("txtQty").value = "";
                document.getElementById("txtQty").focus();
            } else {

                if (BillQty > 0 && MRP > 0 && ProductName != '') {
                    var Invoice = document.getElementById("txtInvoiceNo").value; //
                    // var ProductCode = document.getElementById("cmbProductCode").value;
                    var Barcode = document.getElementById("txtBarcode").value;

                    var Qty = document.getElementById("txtQty").value;
                    // alert(1);
                    var Shortcode = document.getElementById("txtShortcode").value; //
                    // alert(1);
                    var Category = document.getElementById("txtCategory").value; //


                    var BatchCode = document.getElementById("txtBatchcode").value; //
                    var Currentstock = document.getElementById("txtCurrentStock")
                        .value; //                                                            
                    var SaleDate = document.getElementById("dtSaleDate")
                        .value; //                                                            
                    var PaitentCode = document.getElementById("txtPaitentCode").value;
                    var Rate = document.getElementById("txtRate").value;
                    var DoctorCode = document.getElementById("cmbDoctor").value;
                    var BillType = document.getElementById("cmbBillType").value;
                    var ExpiryDate = document.getElementById("txtExpiryDate").value;
                    var EmployeeCode = document.getElementById("txtEmployeeCode").value;

                    if (EmployeeCode == "") {
                        EmployeeCode = 0;
                    }

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
                    // alert(Invoice);
                    // alert(TotalAmount);
                    // alert(PaitentCode);
                    // alert(SaleDate);
                    // alert(userid);

                    if (Invoice == "" || PaitentCode == "" || SaleDate == "" || DoctorCode == "") {

                        swal("Alert!", "Kindly provide valid detailsxxxxx!", "warning");

                    } else if (DiscountPercent > 100) {
                        swal("Alert!", "Discount should not above 100%!", "warning");
                    } else

                    {

                        var datas = "&Invoice=" + Invoice + "&Barcode=" + Barcode + "&Qty=" + Qty + "&Shortcode=" +
                            Shortcode + "&Shortcode=" + Shortcode +
                            "&Category=" + Category + "&ProductName=" + ProductName + "&MRP=" + MRP +
                            "&DiscountAmount=" +
                            DiscountAmount +
                            "&TotalAmount=" + TotalAmount + "&ProfitAmount=" + ProfitAmount + "&BatchCode=" +
                            BatchCode +
                            "&Currentstock=" + Currentstock + "&PaitentCode=" + PaitentCode + "&Rate=" + Rate +
                            "&SaleDate=" + SaleDate + "&DoctorCode=" + DoctorCode + "&ExpiryDate=" + ExpiryDate +
                            "&EmployeeCode=" + EmployeeCode;
                        // alert(datas);
                        $.ajax({
                            url: "Save/SaveBilling.php",
                            method: "POST",
                            data: datas,
                            success: function(data) {
                                // alert(data);

                                if (data == 1) {
                                    ApplyOveralllAutoDiscount();

                                    LoadProductList();
                                    Reset();
                                } else {
                                    swal("Alert!", data, "warning");
                                    LoadProductList()
                                    Reset();
                                }


                            }
                        });
                    }

                } else {
                    swal("Alert!", "No Details to Save", "warning");
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
            var CourierCharges = parseInt(document.getElementById("txtCourierCharges").value);

            var OldDueAmount = document.getElementById("txtOldDue").value;
            var BillAmount = document.getElementById("txtNettAmount").value;
            var CourierCharge = document.getElementById("txtCourierCharges").value;
            document.getElementById("txtTotalDueAmount").value = (OldDueAmount * 1) + (BillAmount * 1) + (
                CourierCharge * 1);


            if (document.getElementById("txtTotalPayment").value == "") {
                var TotalPayment = 0;
            } else {
                var TotalPayment = parseInt(document.getElementById("txtTotalPayment").value);
            }

            var CurrentBalance = parseInt(OldBalance) + parseInt(CurrentBillTotal) + parseInt(CourierCharges) -
                parseInt(TotalPayment);
            document.getElementById("txtBalanceToSave").value = CurrentBalance;
            document.getElementById("txtBalance").value = CurrentBalance;
            // alert(CurrentBillTotal);
        }


        function SaveSaleMaster() {
            var Invoice = document.getElementById("txtInvoiceNo").value;
            var TotalSaleQty = document.getElementById("txtTotalSaleQty").value;
            var TotalDiscountAmount = document.getElementById("txtTotalDiscountAmount").value;
            var TotalProfitAmount = document.getElementById("txtTotalProfitAmount").value;
            var TotalSaleAmount = document.getElementById("txtNettAmount").value;
            var BalanceAmount = document.getElementById("txtBalance").value;
            var PaitentCode = document.getElementById("txtPaitentCode").value;
            var SaleDate = document.getElementById("dtSaleDate").value;
            var GroupID = <?php echo $GroupID; ?>;

            var CourierCharges = document.getElementById("txtCourierCharges").value;
            var CurrentBillTotal = document.getElementById("txtAmountCurrentBill").value;
            var OldBalance = document.getElementById("txtOldDue").value;


            var TotalBalance = 0 * 0.0;
            TotalBalance = BalanceAmount * 1;

            if (document.getElementById("txtTotalPayment").value == "") {
                var ReceivedAmount = 0;
            } else {
                var ReceivedAmount = parseInt(document.getElementById("txtTotalPayment").value);
            }


            ReceivedAmount = ReceivedAmount * 1;
            CurrentBillTotal = CurrentBillTotal * 1 + CourierCharges * 1;
            OldBalance = OldBalance * 1;

            if (GroupID == 2) {
                if (ReceivedAmount == CurrentBillTotal) {


                    SaveBillingDetails();

                } else if (ReceivedAmount > CurrentBillTotal && ReceivedAmount <= CurrentBillTotal + OldBalance) {

                    SaveBillingDetails();

                } else if ((CurrentBillTotal + OldBalance) <= ReceivedAmount) {

                    SaveBillingDetails();

                } else {
                    swal("Alert!", "Received amont is not match with Bill value", "warning");
                }
            } else {


                if (Number(TotalBalance) > 0) {
                    // alert(2);

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
                                    //  alert("Bi");
                                    SaveBillingDetails();
                                    break;

                                case "No":
                                    document.getElementById("cmbPaymentMode").focus;
                                    break;
                            }
                        });
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
        }



        // }

        function ApplyDiscountItemwise() {

            var DiscountPercent = document.getElementById("txtItemwiseDiscountPercent").value;
            var Invoice = document.getElementById("txtInvoiceNo").value;
            var SaleId = document.getElementById("txtBarcodeforItemwiseDiscount").value;

            var datas = "&SaleId=" + SaleId + "&DiscountPercent=" + DiscountPercent;


            $.ajax({
                url: "Save/ApplyDiscountItemwise.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    LoadProductList();
                }
            });

        }


        function ApplyOveralllDiscount() {


            var Invoice = document.getElementById("txtInvoiceNo").value;
            var DiscountPercent = document.getElementById("txtOverallDiscountPercent").value;
            var GroupID = <?php echo $GroupID; ?>;



            if (GroupID == 2 && DiscountPercent > 5) {
                DiscountPercent = 0;
                document.getElementById("txtOverallDiscountPercent").value = 0;
                var datas = "&Invoice=" + Invoice + "&DiscountPercent=" + DiscountPercent;
                alert("Not permitted to give above 10%");
                $.ajax({
                    url: "Save/ApplyDiscountOverall.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        LoadProductList();
                    }
                });

            } else {
                var datas = "&Invoice=" + Invoice + "&DiscountPercent=" + DiscountPercent;
                $.ajax({
                    url: "Save/ApplyDiscountOverall.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        LoadProductList();
                    }
                });
            }



        }

        function ApplyOveralllAutoDiscount() {


            var Invoice = document.getElementById("txtInvoiceNo").value;
            var DiscountPercent = document.getElementById("txtDiscPercent").value;


            var datas = "&Invoice=" + Invoice + "&DiscountPercent=" + DiscountPercent;


            $.ajax({
                url: "Save/ApplyDiscountOverall.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    LoadProductList();
                }
            });

        }

        function SendSMSBilling() {
            var SaleDate = document.getElementById("dtSaleDate").value
            var TotalSaleAmount = document.getElementById("txtNettAmount").value;
            var BalanceAmount = document.getElementById("txtBalance").value;
            var MobileNo = document.getElementById("BillingPaitentMobile").innerText;
            var PaitentName = document.getElementById("BillingPaitentName").innerText;

            var datas = "&SaleDate=" + SaleDate +
                "&TotalSaleAmount=" + TotalSaleAmount +
                "&BalanceAmount=" + BalanceAmount +
                "&MobileNo=" + MobileNo +
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

        function SendSMSCourierBilling() {
            var SaleDate = document.getElementById("dtSaleDate").value
            var TotalSaleAmount = document.getElementById("txtNettAmount").value;
            var BalanceAmount = document.getElementById("txtBalance").value;
            var MobileNo = document.getElementById("BillingPaitentMobile").innerText;
            var PaitentName = document.getElementById("BillingPaitentName").innerText;

            var datas = "&SaleDate=" + SaleDate +
                "&TotalSaleAmount=" + TotalSaleAmount +
                "&BalanceAmount=" + BalanceAmount +
                "&MobileNo=" + MobileNo +
                "&PaitentName=" + PaitentName;
            $.ajax({
                url: "sendsms_courier.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    // swal(data);
                }
            });
        }


        function SaveBillingDetails() {

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
            var BillType = document.getElementById("cmbBillType").value;
            var OldBalance = document.getElementById("txtOldDue").value;
            var ReceivedAmount = document.getElementById("txtTotalPayment").value;
            var NewBalance = document.getElementById("txtBalance").value;
            // var BillType = 'Counter';

            // alert(3);
            var txtAddress1 = document.getElementById("txtAddress1").value;
            var txtAddress2 = document.getElementById("txtAddress2").value;
            var txtState = document.getElementById("txtState").value;
            var txtCity = document.getElementById("txtCity").value;
            var txtPincode = document.getElementById("txtPincode").value;
            var Remarks = document.getElementById("txtRemarks").value;
            var CurrentBillTotal = document.getElementById("txtAmountCurrentBill").value;

            var LocationcodeAdmin = document.getElementById("cmbLocationAdmin").value;
            var OldAmountAdjusted = document.getElementById("txtoldbalance").value;


            var CourierCharges = document.getElementById("txtCourierCharges").value;
            var BillingFormat = 'Regular';


            if (Invoice == "" || TotalSaleAmount == "" || PaitentCode == "" || SaleDate == "" || DoctorCode == "") {


                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {

                var datas = "&Invoice=" + Invoice + "&TotalSaleQty=" + TotalSaleQty + "&TotalDiscountAmount=" +
                    TotalDiscountAmount + "&TotalProfitAmount=" + TotalProfitAmount + "&TotalSaleAmount=" +
                    TotalSaleAmount + "&BalanceAmount=" + BalanceAmount + "&PaitentCode=" + PaitentCode + "&SaleDate=" +
                    SaleDate + "&OldBalance=" + OldBalance + "&ReceivedAmount=" + ReceivedAmount + "&NewBalance=" +
                    NewBalance + "&DoctorCode=" + DoctorCode + "&BillType=" + BillType + "&txtAddress1=" + txtAddress1 +
                    "&txtAddress2=" + txtAddress2 + "&txtState=" + txtState + "&txtCity=" + txtCity + "&txtPincode=" +
                    txtPincode + "&Remarks=" + Remarks +
                    "&CourierCharges=" + CourierCharges +
                    "&LocationcodeAdmin=" + LocationcodeAdmin +
                    "&CurrentBillTotal=" + CurrentBillTotal +
                    "&OldAmountAdjusted=" + OldAmountAdjusted +

                    "&BillingFormat=" +
                    BillingFormat;
                // alert(datas);

                $.ajax({
                    url: "Save/SaveSaleMaster.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // swal(data);
                        if (data == 1) {
                            if (BillType == 'Courier') {
                                SendSMSCourierBilling();
                            }


                            //   SendSMSBilling();

                            var str1 = "SaleBillView.php?invoice=";
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
                                            window.location.href = "Billing.php?MID=8#modal-close";
                                            window.location.reload();
                                            break;

                                        case "Close":
                                            window.location.href = "Billing.php?MID=8#modal-close";
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
            var str1 = "SaleBillView.php?invoice=";
            var str2 = Invoice;
            var str3 = "";
            var BillPrintURL = str1.concat(str2, str3);
            // alert(BillPrintURL);
            // window.location.href = BillPrintURL;
            window.open(BillPrintURL);
        }


        function redirectcasesheet() {
            var Invoice = document.getElementById("txtInvoiceNo").value;
            var PaitentCode = document.getElementById("txtPaitentCode").value;
            var str1 = "../CLM/CaseSheetPrint/CaseSheetPrint.php?P=";
            var str2 = PaitentCode;
            var str3 = "&UID=";
            var str4 = <?php echo $ConsultingInvoiceno; ?>;
            var BillPrintURL = str1 + str2 + str3 + str4; //.concat(str2, str3, srt4);
            // alert(BillPrintURL);
            // window.location.href = BillPrintURL;
            window.open(BillPrintURL);
        }




        // http: //localhost/sg_pos/main/CLM/CaseSheetPrint/CaseSheetPrint.php?P=16012&UID=1728622912

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
            document.getElementById("txtBarcode").value = "";

            document.getElementById("txtBarcode").focus();
        }


        function CalculateTotal() {
            // var Qty = document.getElementById("txtQty").value;
            // var MRP = document.getElementById("txtMRP").value;
            // var Rate = document.getElementById("txtRate").value;
            // var DiscPercent = document.getElementById("txtDiscPercent").value;

            // if (DiscPercent>10)
            // {

            // swal("Alert!", "Discounted price below cost is not allowed", "warning");
            // document.getElementById("txtTotalAmount").value=0;
            // document.getElementById("txtDiscPercent").focus();
            // }
            // else
            // {
            // var GrossAmount = (Qty*MRP)
            // var DiscountAmount =  GrossAmount * (DiscPercent/100);
            // var TotalAmount =  GrossAmount-DiscountAmount;
            // var Profit = TotalAmount- (Qty*Rate);

            // document.getElementById("txtTotalAmount").value=TotalAmount;
            // document.getElementById("txtDiscAmount").value=DiscountAmount;
            // document.getElementById("txtProfitAmount").value=Profit;
            // }




        }

        function ClearTotalAmount() {
            // document.getElementById("txtTotalAmount").value=0;
        }

        function LoadInvoiceNo() {

            var InvoiceNo = new Date().getTime();
            document.getElementById("txtInvoiceNo").value = InvoiceNo;

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
                        // $("#txtMRP").val(data[7]); 
                        $("#txtTotalAmount").val(data[7]);
                        $("#txtLocationCode").val(data[8]);
                    }
                    var CurrentStockQty = document.getElementById("txtCurrentStock").value;
                    if (CurrentStockQty < 10) {
                        swal("Alert!", "Selected Stock is Below 10, consider for replineshment", "warning");
                        document.getElementById("txtQty").focus();
                    } else {
                        document.getElementById("txtQty").focus();
                    }



                }
            });
        }


        function LoadMultipleItems() {
            var Barcode = document.getElementById("txtBarcode").value;
            var LocationCode = document.getElementById("cmbLocationAdmin").value;
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
            var LocationCode = document.getElementById("cmbLocationAdmin").value;

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
                    $("#txtExpiryDate").val(data[9]);
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
            var BillType = document.getElementById("cmbBillType").value;
            var LocationCode = document.getElementById("cmbLocationAdmin").value;
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
                        if(data[11] <= 30)
                    {
                        swal("Alert!",
                                    "This Stock is Expired, Please Check",
                                    "warning");
                    }
                    else
                    {

                        $("#txtShortcode").val(data[0]);
                        $("#txtProductName").val(data[1]);
                        $("#txtBatchcode").val(data[2]);

                        $("#txtCurrentStock").val(data[4]);
                        $("#txtRate").val(data[5]);
                        $("#txtCategory").val(data[6]);
                        $("#txtMRP").val(data[7]);
                        $("#txtTotalAmount").val(data[7]);
                        $("#txtLocationCode").val(data[8]);
                        $("#txtExpiryDate").val(data[9]);

                        var CurrentStockQty = document.getElementById("txtCurrentStock").value;
                        document.getElementById("txtQty").value = 1;

                        if (Barcode != "") {


                            if (CurrentStockQty == 0) {
                                swal("Alert!",
                                    "Invalid Barcode or No Stock in the selected barcode,       PRESS ESC Key",
                                    "warning");

                                document.getElementById("txtBarcode").value = '';
                                document.getElementById("txtRate").value = '';
                                document.getElementById("txtBarcode").focus();
                            } else {
                                // SaveSaleItems()
                            }
                        }
                    }  }

                }
            });
        }


        function LoadInvoiceTotal() {

            var Invoice = document.getElementById("txtInvoiceNo").value;
            var datas = "&Invoice=" + Invoice;

            $.ajax({
                url: "Load/LoadBillingTotal.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#txtNettAmount").val(data[0]);
                    $("#txtAmountCurrentBill").val(data[0]);

                    $("#txtTotalProfitAmount").val(data[1]);
                    $("#txtTotalSaleQty").val(data[2]);
                    $("#txtTotalDiscountAmount").val(data[3]);

                }
            });

        }

        function UpdateCourierCharges() {

            var Invoice = document.getElementById("txtInvoiceNo").value;
            var BillType = document.getElementById("cmbBillType").value;
            var StateCode = document.getElementById("txtStateList").value;

            var datas = "&Invoice=" + Invoice + "&BillType=" + BillType + "&StateCode=" + StateCode;

            $.ajax({
                url: "Load/AddCourierCharges.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#txtCourierCharges").val(data[0]);
                    $("#txtState").val(data[1]);

                }
            });

        }

        // function UpdateCourierCharges() {

        //     var Invoice = document.getElementById("txtInvoiceNo").value;
        //     var BillType = document.getElementById("cmbBillType").value;
        //     var StateCode = document.getElementById("txtStateList").value;

        //     var datas = "&Invoice=" + Invoice + "&BillType=" + BillType + "&StateCode=" + StateCode;

        //     $.ajax({
        //         url: "Load/AddCourierCharges.php",
        //         method: "POST",
        //         data: datas,
        //         dataType: "json",
        //         success: function(data) {

        //             $("#txtCourierCharges").val(data[0]);
        //             $("#txtState").val(data[1]);

        //         }
        //     });

        // }

        function LoadSavedAddress() {
            var PaitentCode = document.getElementById("txtPaitentCode").value;
            var datas = "&PaitentCode=" + PaitentCode;
            // alert(datas);
            $.ajax({
                url: "Load/LoadSavedAddress.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivAddres').html(data);


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



        function LoadMedicine() {
            var PaitentID = <?php echo $PatientCode; ?>;
            var UniqueID = <?php echo $ConsultingInvoiceno; ?>;

            var datas = "&PaitentID=" + PaitentID + "&UniqueID=" + UniqueID

            $.ajax({
                url: "Load/PaitentDiseaseMapping/LoadMedicineList_delivery.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivMedicineList').html(data);
                }
            });
        }


        function LoadPaitentDetails() {

            var MobileNo = <?php echo $PatientCode; ?>; //document.getElementById("txtMobileNo").value;
            var Barcode = document.getElementById("txtPaitentBarcode").value;
            var datas = "&MobileNo=" + MobileNo + "&Barcode=" + Barcode;
            // alert(datas);
            $.ajax({
                url: "Load/LoadPaitentDetails.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#txtName").val(data[0]);
                    $("#txtPaitentCode").val(data[1]);
                    $("#txtOldDue").val(data[2]);
                    $("#txtoldbalance").val(data[2]);
                    $("#txtPendingOrders").val(data[3]);

                    $("#BillingPaitentMobile").html(data[5]);
                    $("#BillingPaitentName").html(data[0]);
                    $("#txtDiscountPaitentStatus").val(data[4]);
                    $("#txtDiscPercent").val(data[6]);





                    var OldBalance = document.getElementById("txtOldDue");

                    if (OldBalance.value > 0) {
                        OldBalance.style.backgroundColor = "red";
                        OldBalance.style.color = "white";

                    } else if (OldBalance.value < 0) {
                        OldBalance.style.backgroundColor = "green";
                        OldBalance.style.color = "white";
                    }



                    var DiscountStatus = document.getElementById("txtDiscountPaitentStatus");

                    if (DiscountStatus.value == 'YES') {

                        DiscountStatus.style.backgroundColor = "#EBBB27";
                        DiscountStatus.style.color = "black";


                    } else if (DiscountStatus.value == 'No') {

                        DiscountStatus.style.backgroundColor = "white";
                        DiscountStatus.style.color = "black";

                    }


                    var PaitentCode = document.getElementById("txtPaitentCode").value;
                    if (PaitentCode == "") {

                    } else {


                        document.getElementById("txtBarcode").focus();
                    }

                }
            });
            OrderDetails();
            LoadMedicine();
        }



        function LoadProductList() {

            var Invoice = document.getElementById("txtInvoiceNo").value;
            var datas = "&Invoice=" + Invoice;
            // alert(datas);
            $.ajax({
                url: "Load/LoadBillingItemList_auto.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivTutorList').html(data);
                    LoadInvoiceTotal();
                    UpdateCourierCharges();
                }
            });



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

        function DisableBillType() {
            document.getElementById("cmbBillType").disabled = true;
        }

        function SavePaymentDetails() {

            var Invoice = document.getElementById("txtInvoiceNo").value;
            var PaitentCode = document.getElementById("txtPaitentCode").value;
            var PaymentMode = document.getElementById("cmbPaymentMode").value;
            var PaymentAmount = document.getElementById("txtPaymentAmount").value;
            var NettAmount = document.getElementById("txtNettAmount").value;
            var SaleDate = document.getElementById("dtSaleDate").value;
            var LocationCode = document.getElementById("cmbLocationAdmin").value;

            if (PaymentMode == "" || PaymentAmount == "" || PaymentAmount == 0 || NettAmount == 0 || NettAmount == "") {

                swal("Alert!", "Kindly provide payment details!", "warning");

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

            var Barcode = document.getElementById("txtBarcodeToDelete").value;
            var Invoice = document.getElementById("txtInvoiceNo").value;
            var datas = "&Barcode=" + Barcode + "&Invoice=" + Invoice;

            $.ajax({
                url: "Delete/DeleteBillingItem.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    LoadProductList();
                }
            });

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

        function HideCourierDetails() {

            var BillType = document.getElementById("cmbBillType").value;
            var DivCourierDetails = document.getElementById("DivCourierDetails");

            if (BillType == "Courier" || BillType == "Online") {
                $('.trCourierCharges').show();
                DivCourierDetails.style.display = "block";

            } else

            {
                $('.trCourierCharges').hide();
                DivCourierDetails.style.display = "none";

            }

        }

        function DeleteBillingItem(x) {
            document.getElementById("txtBarcodeToDelete").value = x;
            DeleteProductinBillingItem();

        }

        function ItemwiseDiscount(x) {


            var SelectedColumn = x.cellIndex;
            var SelectedRow = x.parentNode.rowIndex;

            var Id = document.getElementById("tblBill").rows[SelectedRow].cells[1].innerHTML;
            document.getElementById("txtBarcodeforItemwiseDiscount").value = Id;


        }

        function focusamount() {
            document.getElementById("txtPaymentAmount").focus();
        }



        function GetSelectedAddress(x) {

            var SelectedColumn = x.cellIndex;
            var SelectedRow = x.parentNode.rowIndex;

            var Address1 = document.getElementById("tblSavedAddress").rows[SelectedRow].cells.namedItem("tblAddress1")
                .innerHTML;
            var Address2 = document.getElementById("tblSavedAddress").rows[SelectedRow].cells.namedItem("tblAddress2")
                .innerHTML;
            var City = document.getElementById("tblSavedAddress").rows[SelectedRow].cells.namedItem("tblCity")
                .innerHTML;
            var State = document.getElementById("tblSavedAddress").rows[SelectedRow].cells.namedItem("tblState")
                .innerHTML;
            var Pincode = document.getElementById("tblSavedAddress").rows[SelectedRow].cells.namedItem("tblPincode")
                .innerHTML;


            document.getElementById("txtAddress1").value = Address1;
            document.getElementById("txtAddress2").value = Address2;
            document.getElementById("txtCity").value = City;
            document.getElementById("txtState").value = State;
            document.getElementById("txtPincode").value = Pincode;

            document.getElementById("txtRemarks").focus();


        }
        </script>

        <div id="modalStockList" class="modal" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Stock Details</h4>
                    </div>

                    <div class="modal-body">
                        <div data-scrollbar="true" data-height="450px">
                            <ul class="chats">

                                <div id="DivStockList" class="email-content"></div>

                            </ul>
                        </div>


                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

        <div class="modal fade" id="ModalAddress">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Saved Address</h4>
                    </div>
                    <div class="modal-body">
                        <div data-scrollbar="true" data-height="200px">

                            <ul class="chats">

                                <div id='DivAddres'> </div>

                            </ul>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalItemwiseDiscount">
            <div class="modal-dialog" style="width:200px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Discount Details</h4>
                    </div>
                    <div class="modal-body">

                        <input type='text' id='txtItemwiseDiscountPercent' name='txtItemwiseDiscountPercent'
                            class='form-control' placeholder='Discount %' />
                    </div>
                    <div class="modal-footer">

                        <a href="javascript:;" class="btn btn-sm btn-success" onclick="ApplyDiscountItemwise()"
                            data-dismiss="modal">Apply</a>

                    </div>
                </div>
            </div>
        </div>

        <div id="content" class="content">
            <label><b><u>Billing</u></b></label>




            <div class="row ">

                <div class="col-md-5">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">

                            <h4 class="panel-title">Bill Details
                                <button class='btn btn-success btn-xs' style='float:right'
                                    onclick='redirectcasesheet()'>View
                                    Prescription</button>
                            </h4>
                        </div>
                        <div class="panel-body">





                            <table>
                                <tr>
                                    <td width='15%'>Doctor &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td>  <input type='text' class="form-control" id='txtDoctorName' name='txtDoctorName'
                                    disabled value='<?php echo  $DoctorName; ?>' /></td>
    </tr>
    </table>
    <table>
    <tr>
                                    <td width='0%'>Patient</td>
                                    <td>Outstanding</td>
                                    <td>Disc</td>
                                </tr>
                                <tr>
                                    <td hidden>
                                        <select class="form-control"
                                            style='border-radius: 4px; padding: 5px; text-align: left;' id='cmbBillType'
                                            name='cmbBillType' onchange='HideCourierDetails()' style="width: 150px;">
                                            <option value='Counter' selected>Counter</option>
                                            <?php
                                            if ($GroupID == '1') {
                                                echo "<option value='Free' >Free</option>";
                                            }
                                            ?>
                                            <option value='Courier'>Courier</option>
                                            <option value='Online'>Online</option>

                                        </select>

                                    </td>


                                    <td hidden>
                                        <?php
                                        if ($GroupID == '1') {
                                        ?>
                                        <select class="form-control"
                                            style='border-radius: 4px; padding: 5px; text-align: left;'
                                            id='cmbLocationAdmin' name='cmbLocationAdmin'
                                            onchange='HideCourierDetails()' style="width: 150px;">
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
                                            id='cmbLocationAdmin' name='cmbLocationAdmin'
                                            onchange='HideCourierDetails()' style="width: 150px;">
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

                                    <td hidden><input type="date" class="form-control" placeholder="" id='dtSaleDate'
                                            name='dtSaleDate' value='<?php echo date('Y-m-d'); ?>' />
                                    </td>
                                    <td hidden>
                                      
                                        <input type='hidden' class="form-control" id='cmbDoctor' name='cmbDoctor'
                                            disabled value='<?php echo  $DoctorCode; ?>' />
                                    </td>


                                    <td>
                                        <input type='text' class="form-control" id='txtMobileNo' name='txtMobileNo'
                                            disabled value='<?php echo $PatientName; ?>' />
                                        <input type='hidden' class="form-control" id='txtPaitentCode'
                                            name='txtPaitentCode' disabled />

                                    </td>

                                    <td><input style="background-color:white;" type="text" name="txtOldDue"
                                            id="txtOldDue" placeholder="0" class="form-control" disabled /></td>

                                    <td>
                                        <input style="background-color:white;" type="text"
                                            name="txtDiscountPaitentStatus" id="txtDiscountPaitentStatus"
                                            placeholder="0" class="form-control" disabled />
                                    </td>
                                    <td hidden> <input style="background-color:white;" type="text"
                                            name="txtPaitentBarcode" id="txtPaitentBarcode" placeholder=""
                                            class="form-control"
                                            onblur='LoadPaitentDetails();ClearPaitentDropdown();' /></td>


                                    <td hidden><input style="background-color:white;" type="text" name="txtName"
                                            id="txtName" placeholder="" class="form-control" disabled /></td>


                                    <td hidden> <input style="background-color:white;" type="text"
                                            name="txtPendingOrders" id="txtPendingOrders" placeholder="0"
                                            class="form-control" disabled /> </td>




                                </tr>

                            </table>
                            <hr>
                            <div id='DivMedicineList'></div>
                            <br><br><br><br><br><br><br><br><br><br><br>
                            <br><br><br><br>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">

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
                                                onclick="SavePaymentDetails(); " data-dismiss='modal'> Add </button>
                                        </td>
                                    </tr>

                                </table>


                                <hr>
                                <div class="col-md-9">
                                    <div data-scrollbar="true" data-height="200px">

                                        <ul class="chats">

                                            <label> <u>Payment Details</u> </label>
                                            <div id="DivPaymentList" class="email-content"></div>

                                        </ul>
                                    </div>


                                    <div id="DivCourierDetails" style="display:none;">
                                        <table width='90%'>
                                            <tr>
                                                <td><u>Courier Address</u></td>
                                                <td>&nbsp;&nbsp;&nbsp;<a href="#ModalAddress" data-toggle="modal"
                                                        onclick='LoadSavedAddress();'
                                                        class="btn btn-sm btn-success">Saved
                                                        Address</a> </td>
                                            </tr>
                                            <tr>
                                                <td>Address 1 &nbsp;&nbsp;</td>
                                                <td width="250px;"><input type="text" class="form-control"
                                                        id='txtAddress1' name='txtAddress1' placeholder='Address 1'
                                                        style="text-align: left;background-color:white;text-transform:uppercase;" />
                                                </td>



                                                <td colspan="2"><input type="text" class="form-control" id='txtAddress2'
                                                        name='txtAddress2' placeholder='Address 2' style="text-align: left;background-color:white;
                                                    text-transform:uppercase;" />
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>State & City &nbsp;&nbsp;</td>
                                                <td width="20px;">
                                                    <select class="selectpicker" data-show-subtext="true"
                                                        data-live-search="true" data-style="btn-white" id='txtStateList'
                                                        name='txtStateList' style="height:1.8em;"
                                                        onchange="UpdateCourierCharges()">
                                                        <option selected value='0'></option>
                                                        <?php
                                                    $sqli = " 
                            select stateid,statename from statemaster order by statename ";
                                                    $result = mysqli_query($connection, $sqli);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        # code...

                                                        echo ' <option value=' . $row['stateid'] . '>' . $row['statename'] . '</option>';
                                                    }
                                                    ?>
                                                    </select>


                                                </td>

                                                <td>
                                                    <input type="hidden" class="form-control" id='txtState'
                                                        name='txtState' placeholder='State'
                                                        style="text-align: left;background-color:white;text-transform:uppercase;" />
                                                </td>

                                                <td><input type="text" class="form-control" id='txtCity' name='txtCity'
                                                        placeholder='City'
                                                        style="text-align: left;background-color:white;text-transform:uppercase;" />
                                                </td>


                                                <td><input type="number" class="form-control" id='txtPincode'
                                                        name='txtPincode' placeholder='Pincode'
                                                        style="text-align: left;background-color:white;" /></td>

                                            </tr>
                                        </table>
                                    </div>
                                    <br>
                                    <textarea rows=3 class="form-control" id='txtRemarks' placeholderr='Remarks'
                                        placeholder='Remarks' name='txtRemarks' style="width=50%"></textarea>

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
                                                        onchange="CalculateCurrentTotal();" /></b>

                                            </td>
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
                                            <td></td>
                                        </tr>


                                        <tr class="trCourierCharges" hidden>
                                            <td>Courier </td>
                                            <td><b><input type="number" class="form-control" id='txtCourierCharges'
                                                        name='txtCourierCharges'
                                                        style="text-align: right;background-color:#94b75f;" value='0'
                                                        onchange="CalculateCurrentTotal();" /></b></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>


                                            <td>Total</td>
                                            <td><b><input type="number" class="form-control" disabled
                                                        id='txtTotalDueAmount' name='txtTotalDueAmount'
                                                        style="text-align: right;background-color:white;" value='0'
                                                        onchange="CalculateCurrentTotal();" /></b></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Payment</td>
                                            <td><b><input type="number" class="form-control" disabled
                                                        id='txtTotalPayment' name='txtTotalPayment'
                                                        style="text-align: right;background-color:white;" value='0'
                                                        onchange="CalculateCurrentTotal();" /></b></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Balance</td>
                                            <td><b><input type="number" class="form-control" disabled id='txtBalance'
                                                        name='txtBalance'
                                                        style="text-align: right;background-color:white;"
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


                            </div>




                        </div>
                    </div>


                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                            <div class="panel-heading">

                                <h4 class="panel-title">Product Details</h4>
                            </div>
                            <div class="panel-body">
                                <input type="hidden" name="txtInvoiceNo" id="txtInvoiceNo" placeholder=""
                                    class="form-control" />
                                <input type="hidden" name="txtExpiryDate" id="txtExpiryDate" placeholder=""
                                    class="form-control" />

                                <input type="hidden" name="txtBarcodeToDelete" id="txtBarcodeToDelete" placeholder=""
                                    class="form-control" />
                                <input type="hidden" name="txtBarcodeforItemwiseDiscount"
                                    id="txtBarcodeforItemwiseDiscount" placeholder="" class="form-control" />

                                <div>


                                    <br>
                                    <fieldset>



                                        <div class="row">

                                            <table>
                                                <tr>
                                                    <td>Barcode</td>
                                                    <td>Product</td>
                                                    <td>Qty</td>
                                                    <td>Emp</td>
                                                    <td>MRP</td>
                                                    <td>Add</td>
                                                    <td>Clear</td>
                                                </tr>
                                                <tr>
                                                    <td> <input style="background-color:white;" type="text"
                                                            name="txtBarcode" id="txtBarcode" class="form-control"
                                                            onfocus="DisableBillType()" onblur="LoadBarcodeDetails()"
                                                            onkeyup="this.value = this.value.toUpperCase()" /></td>
                                                    <td> <input style="background-color:white;" type="text"
                                                            name="txtProductName" id="txtProductName" placeholder=""
                                                            class="form-control" disabled /></td>
                                                    <td> <input type="text" name="txtQty" id="txtQty" placeholder=""
                                                            class="form-control" onkeyup="CalculateTotal();" /></td>
                                                    <td><input type="text" name="txtEmployeeCode" id="txtEmployeeCode"
                                                            placeholder="" class="form-control" /></td>
                                                    <td> <input style="background-color:white;" type="text"
                                                            name="txtMRP" id="txtMRP" placeholder=""
                                                            class="form-control" disabled /></td>
                                                    <td><input type="button" class="btn btn-sm btn-success"
                                                            onclick="SaveSaleItems();" value='Add'></td>
                                                    <td><input type="button" class="btn btn-sm btn-warning"
                                                            onclick="Reset();" value='Clear'></td>
                                                </tr>
                                            </table>



                                            <div class="col-md-1" style='display:none'>
                                                <div class="form-group">
                                                    <label>Cr. Stock</label>
                                                    <input style="background-color:white;" type="text"
                                                        name="txtCurrentStock" id="txtCurrentStock" placeholder=""
                                                        class="form-control" disabled />
                                                </div>
                                            </div>




                                            <div class="col-md-1" style='display:none'>
                                                <div class="form-group">
                                                    <label>Disc %</label>
                                                    <input type="text" name="txtDiscPercent" id="txtDiscPercent"
                                                        placeholder="" class="form-control" disabled value=0 />
                                                </div>
                                            </div>






                                            <div style="display:none;">




                                                <input style="background-color:white;" type="hidden" name="txtShortcode"
                                                    id="txtShortcode" placeholder="" class="form-control" disabled />
                                                <input style="background-color:white;" type="hidden" name="txtCategory"
                                                    id="txtCategory" placeholder="" class="form-control" disabled />

                                                <input style="background-color:white;" type="hidden" name="txtBatchcode"
                                                    id="txtBatchcode" placeholder="" class="form-control" disabled />
                                                <input style="background-color:white;" type="hidden"
                                                    name="txtProfitAmount" id="txtProfitAmount" placeholder=""
                                                    class="form-control" disabled />

                                                <input style="background-color:white;" type="hidden" name="txtRate"
                                                    id="txtRate" placeholder="" class="form-control" disabled />
                                                <input style="background-color:white;" type="hidden"
                                                    name="txtLocationCode" id="txtLocationCode" placeholder=""
                                                    class="form-control" disabled />



                                                <input type="text" name="txtDiscAmount" id="txtDiscAmount"
                                                    placeholder="" class="form-control" disabled value=0 />








                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Total Amt.</label>
                                                        <input style="background-color:white;" type="text"
                                                            name="txtTotalAmount" id="txtTotalAmount" placeholder=""
                                                            class="form-control" disabled />
                                                    </div>
                                                </div>


                                            </div>





                                        </div>


                                    </fieldset>
                                </div>

                                <div class="panel-body">

                                    <div data-scrollbar="true" data-height="350px">

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
                                                    placeholder="" id='txtTotalProfitAmount'
                                                    name='txtTotalProfitAmount' />



                                            </td>

                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>


                                            <td hidden style="text-align: right;"><label>Overall Disc %</label></td>
                                            <td >
                                                <div class="col-md-8">
                                                    <b> <input type="text" name="txtOverallDiscountPercent"
                                                            id="txtOverallDiscountPercent" placeholder=""
                                                            class="form-control" value=0 />

                                                </div>

                                                <input type="button" class="btn btn-sm btn-info"
                                                    onclick="ApplyOveralllDiscount();" value='Apply'>



                                            </td>

                                            <td style="text-align: left;"> </td>


                                            <td style="text-align: right;"><label>Qty</label></td>
                                            <td>
                                                <div class="col-md-8">
                                                    <b> <input style="text-align: right;" type="text"
                                                            class="form-control" placeholder="" id='txtTotalSaleQty'
                                                            name='txtTotalSaleQty' disabled /><b>

                                                </div>
                                            </td>





                                            <td style="text-align: right;"><label>Total</label></td>
                                            <td>
                                                <div class="col-md-12">
                                                    <b> <input style="text-align: right;" type="text"
                                                            class="form-control" placeholder="" id='txtNettAmount'
                                                            name='txtNettAmount' disabled /><b>

                                                </div>
                                            </td>
                                            <td> <a href='#ModalProject'> <input type="button"
                                                        class="btn btn-sm btn-success"
                                                        onclick='LoadPaymentDetails();  CalculateCurrentTotal();'
                                                        value='Save'> </a> </td>
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td> <input type="button" class="btn btn-sm btn-warning"
                                                    onclick="window.location.reload();" value='Clear'>
                                            </td>
                                        <tr>
                                            <table>


                                </div>

                            </div>
                            <!-- end col-12 -->
                        </div>
                        <!-- end row -->
                    </div>
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