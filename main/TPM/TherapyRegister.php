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
if (isset($_SESSION['SESS_LAST_NAME'])) {
    //echo 'Session Active';

} else {
    //echo 'Session In Active';
    $url = '../../index.php';
    echo '
    <META HTTP-EQUIV=REFRESH CONTENT=".1; ' . $url . '">';
}    ?>

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

<body onload="LoadTherapyRegister(); LoadInvoiceNo();" onmousedown="CalculateBalance()">
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
        function AssignTherapy() {

            var Remarks = document.getElementById("txtRemarksScheduled").value;
            var DoctorCode = document.getElementById("cmbDoctorSchedule").value;
            var ScheduledDate = document.getElementById("dtScheduleDate").value;
            var ScheduledTime = document.getElementById("dtSchdeuledTime").value;
            var TherapyID = document.getElementById("txtIDforClosure").value;
            var InvoiceNo = document.getElementById("txtInvoiceNo").value;


            if (ScheduledDate == "" || ScheduledTime == "" || TherapyID == "") {

                swal("Alert!", "Kindly provide valid details!", "warning");
            } else {

                var datas = "&Remarks=" + Remarks +
                    "&DoctorCode=" + DoctorCode +
                    "&ScheduledDate=" + ScheduledDate +
                    "&ScheduledTime=" + ScheduledTime +
                    "&TherapyID=" + TherapyID +
                    "&InvoiceNo=" + InvoiceNo;

                $.ajax({
                    url: "Save/SaveTherapyAssiging.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == 1) {
                            swal("Therapy!", "Therapy Scheduled", "success");
                            LoadTherapyRegister();
                            $('#modalTherapyAssiging').modal('hide');
                            // setTimeout(function() {
                            //     window.location.reload(1);
                            // }, 1000);
                        } else {
                            // swal(data);
                            swal("Alert!", "Error Saving Therapy Schedule", "warning");
                            LoadTherapyRegister();
                            $('#modalTherapyAssiging').modal('hide');
                            // setTimeout(function() {
                            //     window.location.reload(1);
                            // }, 1000);
                        }


                    }
                });
            }

        }

        function SaveTherapyDetails() {

            var PaitentName = document.getElementById("cmbPaitent").value;
            var TherapyName = document.getElementById("cmbTherapyName").value;
            var BookingDate = document.getElementById("dtBookingDate").value;
            var BookingTime = document.getElementById("txtBookingTime").value;
            var Doctor = document.getElementById("cmbDoctor").value;
            var Remarks = document.getElementById("txtRemarks").value;

            if (PaitentName == "" || Doctor == "" || TherapyName == "" || BookingDate == "" || BookingTime == "") {

                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {
                var datas = "&PaitentName=" + PaitentName + "&TherapyName=" + TherapyName + "&BookingDate=" +
                    BookingDate + "&BookingTime=" + BookingTime + "&Doctor=" + Doctor + "&Remarks=" + Remarks;

                $.ajax({
                    url: "Save/SaveTherapyBooking.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == 1) {
                            swal("Therapy!", "Therapy Booked", "success");
                            LoadTherapyRegister();
                        } else {
                            swal("Alert!", "Error Saving Therapy", "warning");
                            LoadTherapyRegister();
                        }


                    }
                });
            }

        }

        function SaveTherapyClouser() {
            // alert(1);

            var BookingID = document.getElementById("txtIDforClosure").value;
            var NextSittingDate = document.getElementById("dtNextSitingDate").value;
            var NextSittingTime = document.getElementById("dtNextSitingTime").value;
            var Comments = document.getElementById("txtComments").value;
            var BalanceSitting = document.getElementById("txtBalanceSittings").value;
            var SittingID = document.getElementById("txtSittingid").value;


            // alert(2);   
            if (BookingID == "") {

                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {

                var datas = "&BookingID=" + BookingID + "&NextSittingDate=" + NextSittingDate +
                    "&NextSittingTime=" + NextSittingTime + "&Comments=" + Comments +
                    "&BalanceSitting=" + BalanceSitting + "&SittingID=" + SittingID;

                $.ajax({
                    url: "Save/SaveTherapyClosure.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        // swal(data);
                        if (data == '1') {
                            // swal(data);
                            swal("Therapy!", "Therapy Completed", "success");
                            setTimeout(function() {
                                window.location.reload(1);
                            }, 1000);
                        } else {

                            swal("Therapy!", "Error Saving Therapy Details", "warning");
                            setTimeout(function() {
                                window.location.reload(1);
                            }, 1000);
                        }

                    }
                });

            }
        }

        function SaveCancellation() {

            var BookingID = document.getElementById("txtIDforClosure").value;
            var Remarks = document.getElementById("txtCancelRemarks").value;
            var RefundStatus = document.getElementById("cmbRefundStatus").value;
            var RefundAmount = document.getElementById("txtRefundAmount").value;

            if (BookingID == "" || Remarks == "" || RefundStatus == "" || RefundStatus == "-") {

                swal("Alert!", "Kindly provide valid details!", "warning");
            } else {
                var datas = "&BookingID=" + BookingID + "&Remarks=" + Remarks + "&RefundStatus=" + RefundStatus +
                    "&RefundAmount=" + RefundAmount;

                $.ajax({
                    url: "Save/SaveTherapyCancell.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == 1) {
                            // swal(data);
                            swal("Therapy!", "Therapy Cancellation Done", "success");
                            setTimeout(function() {
                                window.location.reload(1);
                            }, 1000);
                        } else {

                            swal("Alert!", "Error Saving", "warning");
                            setTimeout(function() {
                                window.location.reload(1);
                            }, 1000);
                        }


                    }
                });
            }

        }


        function SaveCancellationRecomended() {

            var BookingID = document.getElementById("txtIDforClosure").value;
            var Remarks = document.getElementById("txtCancelRecomendedRemarks").value;

            if (BookingID == "" || Remarks == "") {

                swal("Alert!", "Kindly provide valid details!", "warning");
            } else {
                var datas = "&BookingID=" + BookingID + "&Remarks=" + Remarks;

                $.ajax({
                    url: "Save/SaveTherapyCancellRecomended.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        if (data == 1) {
                            // swal(data);
                            swal("Therapy!", "Therapy Cancellation Done", "success");
                            setTimeout(function() {
                                window.location.reload(1);
                            }, 1000);
                        } else {

                            swal("Alert!", "Error Saving", "warning");
                            setTimeout(function() {
                                window.location.reload(1);
                            }, 1000);
                        }


                    }
                });
            }

        }


        function SaveReschedule() {

            var BookingID = document.getElementById("txtIDforClosure").value;
            var RevisedDate = document.getElementById("dtRevisedBookingDate").value;
            var RevisedTime = document.getElementById("txtRevisedBookingTime").value;
            var EveningTimeSlotID = document.getElementById("txtEveningTimeSlotID").value;
            var MorningTimeSlotID = document.getElementById("txtMorningTimeSlotID").value;


            if (BookingID == "" || RevisedDate == "" || RevisedTime == "") {

                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {
                var datas = "&BookingID=" + BookingID +
                    "&RevisedDate=" + RevisedDate +
                    "&EveningTimeSlotID=" + EveningTimeSlotID +
                    "&MorningTimeSlotID=" + MorningTimeSlotID +
                    "&RevisedTime=" + RevisedTime;

                $.ajax({
                    url: "Save/SaveTherapyReschedule.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == 1) {
                            // swal(data);
                            swal("Therapy!", "Therapy Rescheduled", "success");
                            setTimeout(function() {
                                window.location.reload(1);
                            }, 1000);
                        } else {
                            // swal(data);
                            swal("Therapy!", "Therapy Rescheduled", "success");
                            setTimeout(function() {
                                window.location.reload(1);
                            }, 1000);
                        }


                    }
                });
            }

        }


        function LoadInvoiceNo() {

            var InvoiceNo = new Date().getTime();
            document.getElementById("txtInvoiceNo").value = InvoiceNo;

            LoadProductList();

        }

        function Reset() {

            LoadTherapyRegister();
        }

        function CalculateBalance() {
            var TotlaFee = parseInt(document.getElementById("txtTherapyFee").value);
            var Discount = parseInt(document.getElementById("txtDiscount").value);
            var OldDue = parseInt(document.getElementById("txtOldDue").value);
            var PaidAmount = parseInt(document.getElementById("txtPaidAmount").value);
            var ExtraCharge = parseInt(document.getElementById("txtExtraCharge").value);

            // to make sure that they are numbers
            if (!TotlaFee) {
                TotlaFee = 0;
            }
            if (!Discount) {
                Discount = 0;
            }
            if (!OldDue) {
                OldDue = 0;
            }
            if (!PaidAmount) {
                PaidAmount = 0;
            }
            if (!ExtraCharge) {
                ExtraCharge = 0;
            }

            var FinalFee = document.getElementById("txtTherapyFeeFinal");
            var NewBalanceAmount = document.getElementById("txtNewBalance");
            FinalFee.value = TotlaFee + OldDue - Discount + ExtraCharge;
            NewBalanceAmount.value = TotlaFee + OldDue - Discount + ExtraCharge - PaidAmount;



        }


        function LoadTherapyRegister() {
            var FromDate = document.getElementById("dtFromDate").value;
            var ToDate = document.getElementById("dtToDate").value;


            var ID = 99999;
            var datas = "&ID=" + ID + "&FromDate=" + FromDate + "&ToDate=" + ToDate;

            $.ajax({
                url: "Load/LoadTherapyWaitingList.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivTherapyWaitingList').html(data);


                }
            });
            // LoadRecomendedTherapyList();
        }

        function LoadRecomendedTherapyList() {
            var FromDate = document.getElementById("dtFromDate").value;
            var ToDate = document.getElementById("dtToDate").value;


            var ID = 99999;
            var datas = "&ID=" + ID + "&FromDate=" + FromDate + "&ToDate=" + ToDate;

            $.ajax({
                url: "Load/LoadRecomendedTherapyList.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivRecomendedTherapyList').html(data);


                }
            });

        }

        function LoadDatewiseRegister() {
            var FromDate = document.getElementById("dtFromDate").value;
            var ToDate = document.getElementById("dtToDate").value;
            var Period = document.getElementById("cmbPeriod").value;
            var Basedon = document.getElementById("cmbBasedon").value;
            var Status = document.getElementById("cmbStatus").value;
            var Therapist = document.getElementById("cmbTherapist").value;



            var ID = 99999;
            var datas = "&ID=" + ID + "&FromDate=" + FromDate + "&ToDate=" + ToDate + "&Period=" + Period +
                "&Basedon=" + Basedon +
                "&Therapist=" + Therapist +
                "&Status=" + Status;

            $.ajax({
                url: "Load/LoadDatewiseTherapyList.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivTherapyScheduled').html(data);


                }
            });
        }

        function LoadTherapyCompleted() {
            var FromDate = document.getElementById("dtFromDateClosure").value;
            var ToDate = document.getElementById("dtToDateClosure").value;
            var Period = document.getElementById("cmbPeriodClosure").value;


            var ID = 99999;
            var datas = "&ID=" + ID + "&FromDate=" + FromDate +
                "&ToDate=" + ToDate + "&Period=" + Period;

            $.ajax({
                url: "Load/LoadTherapyClosed.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivTherapyClosed').html(data);


                }
            });
        }




        function SavePaymentDetails() {

            var Invoice = document.getElementById("txtInvoiceNo").value;

            var PaymentMode = document.getElementById("cmbPaymentMode").value;

            var PaymentAmount = document.getElementById("txtPaymentAmount").value;
            var BookingID = document.getElementById("txtIDforClosure").value;
            // var NettAmount = document.getElementById("txtNettAmount").value;


            if (PaymentMode == "" || PaymentAmount == "" || PaymentAmount == 0) {

                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {
                var datas = "&PaymentMode=" + PaymentMode + "&Invoice=" + Invoice + "&PaymentAmount=" + PaymentAmount +
                    "&BookingID=" + BookingID;
                // alert(datas);
                $.ajax({
                    url: "Save/SavePaymentTherapyDetails.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // swal(data);
                        LoadPaymentDetails();
                        // CalculatePaymentTotal();
                    }
                });
            }
            document.getElementById("cmbPaymentMode").value = "";
            document.getElementById("txtPaymentAmount").value = "";
        }


        function LoadTherapyTransactions() {

            var BookingID = document.getElementById("txtIDforClosure").value;


            var datas = "&BookingID=" + BookingID;

            $.ajax({
                url: "Load/LoadTherapyTransactions.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivTherapyDetails').html(data);
                    $('#DivTherapyDetailsClosure').html(data);
                    $('#DivTherapyDetailsClosed').html(data);


                }
            });
            LoadTherapyClosureDetails();
            LoadPendingSettings();
        }

        function LoadTherapyClosureDetails() {

            // alert(1);
            var BookingID = document.getElementById("txtIDforClosure").value;


            var datas = "&BookingID=" + BookingID;
            // alert(datas);
            $.ajax({
                url: "Load/LoadTherapyTransactionsCompleted.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivTherapyCompletedDetails').html(data);

                }
            });
            LoadSitingDetailsforCancel();
        }


        function LoadPaymentDetails() {


            var InvoiceNo = document.getElementById("txtInvoiceNo").value;


            var datas = "&InvoiceNo=" + InvoiceNo;

            $.ajax({
                url: "Load/LoadPaymentDetailsTherapy.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivPaymentList').html(data);

                }
            });

            // var OldDueAmount = document.getElementById("txtOldDue").value;
            // var BillAmount = document.getElementById("txtNettAmount").value;
            // document.getElementById("txtTotalDueAmount").value = (OldDueAmount*1)+(BillAmount*1);
            LoadPaymentTotal();
            setTimeout("CalculateBalance()", 1000);


        }

        function LoadPendingSettings() {
            // alert(77);
            var BookingID = document.getElementById("txtIDforClosure").value;
            var datas = "&BookingID=" + BookingID;
            // alert(datas);
            $.ajax({
                url: "Load/LoadPendingSettings.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#txtBalanceSittings").val(data[0]);
                    $("#txtSittingid").val(data[1]);


                }
            });


        }


        function LoadSitingDetailsforCancel() {
            // alert(77);
            var BookingID = document.getElementById("txtIDforClosure").value;
            var datas = "&BookingID=" + BookingID;

            $.ajax({
                url: "Load/LoadPendingSettingsforCancel.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $('#spnTotalSiggings').html(data);

                }
            });


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



        function GetPointIDtoDelete(x) {
            var SelectedColumn = x.cellIndex;
            var SelectedRow = x.parentNode.rowIndex;

            var Id = document.getElementById("tblPaymentItems").rows[SelectedRow].cells[1].innerHTML;
            document.getElementById("txtPaymentID").value = Id;
            DeletePaymentItem();
        }




        function SendSMSPaitent(x) {
            // alert(1);
            var row = x.parentNode.rowIndex;
            // alert(row);
            var MobileNo = document.getElementById("tblTherapyRegister").rows[row].cells.namedItem("MobileNo")
                .innerHTML;
            var TherapyDate = document.getElementById("tblTherapyRegister").rows[row].cells.namedItem("TherapyDate")
                .innerHTML;
            var TherapyTime = document.getElementById("tblTherapyRegister").rows[row].cells.namedItem("TherapyTime")
                .innerHTML;
            var PaitentName = document.getElementById("tblTherapyRegister").rows[row].cells.namedItem("PaitentName")
                .innerHTML;
            // var MobileNo = 9884589943; 

            var M1 = "Dear ";

            var M2 = PaitentName;

            var M3 = " Your Therapy is booked on ";

            var M4 = TherapyDate

            var M5 = " @ ";


            var M6 = TherapyTime;

            var M7 = ", Kindly ensure you reach clinic before 10 mins, SUGAMGUNAM. Cell:9176606308.";


            var Message = M1.concat(M2, M3, M4, M5, M6, M7);

            // var M3  = ", Thanks for trust in SugamGunam, Chetpet";
            // var Message  =   M1.concat('Rs.',TotalValue,M2);
            // alert(Message);
            var datas = "&MobileNo=" + MobileNo + "&Message=" + Message;

            $.ajax({
                url: "sendsms.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    alert("SMS Sent to Paitent");

                }
            });
            SendSMSDoctor(x);
        }



        function SendSMSDoctor(x) {
            // alert(1);
            var row = x.parentNode.rowIndex;
            // alert(row);
            var MobileNo = document.getElementById("tblTherapyRegister").rows[row].cells.namedItem("mobileno")
                .innerHTML;
            var TherapyDate = document.getElementById("tblTherapyRegister").rows[row].cells.namedItem("TherapyDate")
                .innerHTML;
            var TherapyTime = document.getElementById("tblTherapyRegister").rows[row].cells.namedItem("TherapyTime")
                .innerHTML;
            var PaitentName = document.getElementById("tblTherapyRegister").rows[row].cells.namedItem("PaitentName")
                .innerHTML;
            // var MobileNo = 9884589943; 
            // alert(MobileNo);
            var M1 = "Dear Doctor";
            var M2 = "";
            var M3 = " Therapy is booked on ";
            var M4 = TherapyDate;
            var M5 = " @ ";
            var M6 = TherapyTime;
            var M7 = ", This is for your remainder.";


            var Message = M1.concat(M2, ",", M3, M4, M5, M6, M7)

            // var M3  = ", Thanks for trust in SugamGunam, Chetpet";
            // var Message  =   M1.concat('Rs.',TotalValue,M2);
            // alert(Message);
            var datas = "&MobileNo=" + MobileNo + "&Message=" + Message;
            // alert(datas); 
            $.ajax({
                url: "sendsms.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    alert("SMS Sent to Doctor");

                }
            });
        }



        function GetPointIDRD(x) {
            var row = x.parentNode.rowIndex;
            // alert('Rec');
            document.getElementById("txtIDforClosure").value = document.getElementById("tblTherapyRegisterRecomnded")
                .rows[row]
                .cells.namedItem("BookingID").innerHTML;

            document.getElementById("txtDoctorCode").value = document.getElementById("tblTherapyRegisterRecomnded")
                .rows[row]
                .cells.namedItem("DoctorCode").innerHTML;


            // var DueAmount = document.getElementById("tblTherapyRegister").rows[row].cells.namedItem("DueAmount")
            //     .innerHTML;
            // $("#spnDueAmount").text(DueAmount);

            LoadTherapyTransactions();
            LoadSitingDetailsforCancel();

        }

        function GetPointID(x) {
            var row = x.parentNode.rowIndex;
            // alert('WL');
            document.getElementById("txtIDforClosure").value = document.getElementById("tblTherapyRegisterWL").rows[row]
                .cells.namedItem("BookingID").innerHTML;

            document.getElementById("txtDoctorCode").value = document.getElementById("tblTherapyRegisterWL").rows[row]
                .cells.namedItem("DoctorCode").innerHTML;

            // var DueAmount = document.getElementById("tblTherapyRegister").rows[row].cells.namedItem("DueAmount")
            //     .innerHTML;
            // $("#spnDueAmount").text(DueAmount);

            LoadTherapyTransactions();
            LoadSitingDetailsforCancel();

        }

        function GetScheduledTherapyID(x) {
            var row = x.parentNode.rowIndex;
            // alert('Sche');
            document.getElementById("txtIDforClosure").value = document.getElementById("tblTherapyRegisterSL").rows[row]
                .cells.namedItem("BookingID").innerHTML;

            document.getElementById("txtDoctorCode").value = document.getElementById("tblTherapyRegisterSL").rows[row]
                .cells.namedItem("DoctorCode").innerHTML;

            // var DueAmount = document.getElementById("tblTherapyRegister").rows[row].cells.namedItem("DueAmount")
            //     .innerHTML;
            // $("#spnDueAmount").text(DueAmount);

            LoadTherapyTransactions();
            LoadSitingDetailsforCancel();

        }


        function GetCompletedTherapyID(x) {
            var row = x.parentNode.rowIndex;
            document.getElementById("txtIDforClosure").value = document.getElementById("tblTherapyRegisterCL").rows[row]
                .cells.namedItem("BookingID").innerHTML;
            // var DueAmount = document.getElementById("tblTherapyRegister").rows[row].cells.namedItem("DueAmount")
            //     .innerHTML;
            // $("#spnDueAmount").text(DueAmount);

            LoadTherapyTransactions();
            LoadSitingDetailsforCancel();

        }



        function ShowHideDiv() {

            var cmbPeriod = document.getElementById("cmbPeriod");
            var DivCustomDate = document.getElementById("DivCustomDate");
            DivCustomDate.style.display = cmbPeriod.value == "Custom" ? "inline-block" : "none";

        }



        function ShowHideDivClosure() {
            var cmbPeriod = document.getElementById("cmbClosedPeriod");
            var DivCustomDateClosure = document.getElementById("DivCustomDateClosure");
            DivCustomDateClosure.style.display = cmbClosedPeriod.value == "Custom" ? "inline-block" : "none";

        }


        function PrintReport1() {
            var CurrentDate = new Date()
            var contents = $("#DivTherapyScheduled").html();
            var frame1 = $('<iframe />');
            frame1[0].name = "frame1";
            frame1.css({
                "position": "absolute",
                "top": "-1000000px"
            });
            $("body").append(frame1);
            var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ?
                frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.
            frameDoc.document.write('<html><head><title>Balance Sheet</title>');
            frameDoc.document.write(CurrentDate);
            frameDoc.document.write('</head><body>');
            //Append the external CSS file.
            frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
            //Append the DIV contents.
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function() {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                frame1.remove();
            }, 500);
        }

        function PrintReport() {
            var FromDate = document.getElementById("dtFromDate").value;
            var ToDate = document.getElementById("dtToDate").value;
            var today = new Date().toJSON().slice(0, 10).split('-').reverse().join('/');

            var disp_setting = "toolbar=yes,location=no,";
            disp_setting += "directories=yes,menubar=yes,";
            disp_setting += "scrollbars=yes,width=650, height=600, left=100, top=25";
            var content_vlue = document.getElementById('DivTherapyScheduled').innerHTML;
            var docprint = window.open("", "", disp_setting);
            docprint.document.open();
            docprint.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"');
            docprint.document.write('"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
            docprint.document.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">');
            docprint.document.write('<head><title>My Title</title>');
            docprint.document.write('<style type="text/css">body{ margin:0px;');
            docprint.document.write('font-family:verdana,Arial;color:#000;');
            docprint.document.write('font-family:Verdana, Geneva, sans-serif; font-size:12px;}');
            docprint.document.write('a{color:#000;text-decoration:none;} </style>');
            docprint.document.write('Therapy List - ');
            docprint.document.write(today);
            docprint.document.write("\n\n\n");
            docprint.document.write('</head><body onLoad="self.print()"><center>');

            docprint.document.write(content_vlue);
            docprint.document.write('</center></body></html>');
            docprint.document.close();
            docprint.focus();
        }



        function GetSittingID(x) {
            var ID = x;
            document.getElementById("txtSittingid").value = ID;

            $('#modalTherapyNextSetting').modal('show');
        }


        function EnableRefundAmount() {
            if (document.getElementById("cmbRefundStatus").value === "Yes")

            {
                document.getElementById("txtRefundAmount").disabled = '';

            } else {

                document.getElementById("txtRefundAmount").disabled = 'true';
            }

        }

        function LoadAvailability() {
            var Dummy = 1;
            var DoctorCode = document.getElementById("txtDoctorCode").value;
            var TherapyDate = document.getElementById("dtRevisedBookingDate").value;

            var datas = "&Dummy=" + Dummy + "&DoctorCode=" + DoctorCode + "&TherapyDate=" + TherapyDate;
            // alert(datas);
            $.ajax({
                url: "Load/LoadTimeAllotmentDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivTimeSlot').html(data);


                }
            });
        }
        </script>

        <div class="modal fade" id="modal-dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Therapy Register</h4>

                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->

                            <div class="panel-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Name</label>
                                        <div class="col-md-4">
                                            <select class="selectpicker form-control" data-show-subtext="true"
                                                data-live-search="true" data-style="btn-white" id='cmbPaitent'
                                                name='cmbPaitent' style="width:150px;">
                                                <option selected></option>
                                                <?php
                                                $sqli = "SELECT paitentid, CONCAT(mobileno, ' [',paitentname,']') AS paitentname FROM `paitentmaster` ";
                                                $result = mysqli_query($connection, $sqli);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    # code...

                                                    echo ' <option value=' . $row['paitentid'] . '>' . $row['paitentname'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <label class="col-md-1 control-label">Therapy</label>
                                        <div class="col-md-3">
                                            <select class="selectpicker form-control" data-show-subtext="true"
                                                data-live-search="true" data-style="btn-white" id='cmbTherapyName'
                                                name='cmbTherapyName' style="width:150px;">
                                                <option selected></option>
                                                <?php
                                                $sqli = "SELECT consultationid, CONCAT(consultationname,' [',consultationcharge,']') as consultationname  FROM consultationmaster where consultingtype='Therapy'";
                                                $result = mysqli_query($connection, $sqli);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    # code...

                                                    echo ' <option value=' . $row['consultationid'] . '>' . $row['consultationname'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Date</label>
                                        <div class="col-md-3">
                                            <input type="date" name="dtBookingDate" id="dtBookingDate"
                                                placeholder="Smith" class="form-control" />
                                        </div>
                                        <label class="col-md-2 control-label">Time</label>
                                        <div class="col-md-3">
                                            <input type="time" name="txtBookingTime" id="txtBookingTime"
                                                placeholder="Smith" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Doctor</label>
                                        <div class="col-md-3">

                                            <select class="selectpicker form-control" data-show-subtext="true"
                                                data-live-search="true" data-style="btn-white" id='cmbDoctorNew'
                                                name='cmbDoctorNew' style="width:150px;">
                                                <option selected></option>
                                                <?php
                                                $sqli = "SELECT userid,username FROM  usermaster WHERE designationid in('8','9') and activestatus ='Active'";
                                                $result = mysqli_query($connection, $sqli);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    # code...

                                                    echo ' <option value=' . $row['userid'] . '>' . $row['username'] . '</option>';
                                                }
                                                ?>
                                            </select>

                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Remarks</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" placeholder="Remarks" rows="5"
                                                id='txtRemarks' name='txtRemarks'></textarea>
                                        </div>
                                    </div>



                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <a href="javascript:;" class="btn btn-sm btn-success" onclick="SaveTherapyDetails();">Save</a>
                        <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="myModalCancel" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Invoice Cancellation</h4>
                    </div>

                    <div class="modal-body">
                        <input type='hidden' id='txtCancelInvoiceNo' name='txtCancelInvoiceNo' />

                        <h2 style="color: red;">Are you sure want to canell the bill? </h2>
                        <br>
                        <label>Admin Password:</label>&nbsp;&nbsp;&nbsp;
                        <input type='password' id='txtAdminPassword' name='txtAdminPassword' />
                        <br>
                        <textarea class="form-control" id='txtCancelledRemarks' name='txtCancelledRemarks'
                            placeholder='Remarks'></textarea>




                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="CancellBill();"
                            data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>


        <div class="modal   fade" id="modalTherapyNextSetting" style='z-index: 9999; '>
            <div class="modal-dialog" style='background: grey; '>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">
                            Comments and Next Sitting</h4>
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->


                            <div class="panel-body">
                                <form class="form-horizontal">

                                    <div class="form-group">



                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <a href="javascript:;" class="btn btn-sm btn-success" onclick="SaveTherapyClouser();">Save</a>
                        <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>

        <input type='hidden' name='txtIDforClosure' id='txtIDforClosure' />
        <input type='hidden' name='txtInvoiceNo' id='txtInvoiceNo' />
        <input type='hidden' name='txtPaymentID' id='txtPaymentID' />
        <input type='hidden' name='txtBalanceSittings' id='txtBalanceSittings' />
        <input type='hidden' name='txtSittingid' id='txtSittingid' />




        <div class="modal fade" id="modalTherapyAssiging" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Therapy Scheduling

                        </h4>
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->


                            <div class="panel-body">


                                <div style='display: ;' id='DivAssign' name='DivAssign'>
                                    <div style='display:none;'>
                                        <label class="radio-inline" hidden>
                                            Doctor
                                            <select class="  form-control" data-style="btn-white" id='cmbDoctorSchedule'
                                                name='cmbDoctorSchedule' style="width:150px;">
                                                <option selected value=''> Select Doctor</option>
                                                <?php
                                                $sqli = "SELECT userid,username FROM  usermaster WHERE  designationid in('8','9') and  activestatus ='Active'";
                                                $result = mysqli_query($connection, $sqli);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    # code...

                                                    echo ' <option value=' . $row['userid'] . '>' . $row['username'] . '</option>';
                                                }
                                                ?>
                                            </select>

                                        </label>
                                    </div>

                                    <label class="radio-inline">
                                        Scheduled Date
                                        <input type="date" class='form-control' name="dtScheduleDate"
                                            id='dtScheduleDate' />

                                    </label>

                                    <label class="radio-inline">
                                        Scheduled Time
                                        <input type="time" name="dtSchdeuledTime" id="dtSchdeuledTime"
                                            placeholder="time" class="form-control" />

                                    </label>


                                    <label class="radio-inline">
                                        Remarks
                                        <textarea class='form-control' name="txtRemarksScheduled"
                                            id='txtRemarksScheduled'></textarea>



                                    </label>

                                    <a href="javascript:;" class="btn btn-sm btn-success"
                                        onclick="AssignTherapy();">Assign</a>

                                </div>
                                <hr>


                                <div data-scrollbar="true" data-height="300px">

                                    <ul class="chats">

                                        <label> <u>Therapy Details</u> </label>


                                        <div id="DivTherapyDetails" class="email-content"></div>

                                    </ul>
                                </div>



                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">


                        <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>









        <div class="modal fade" id="modalTherapyClosure" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Therapy Completion
                        </h4>
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->


                            <div class="panel-body">


                                <form class="form-horizontal">
                                    <div class="form-group">

                                        <div class="col-md-">
                                            <textarea class="form-control" id='txtComments' name='txtComments'
                                                placeholder='Therapist Comments'></textarea>
                                        </div>
                                        <br>

                                        <label class="col-md-2 control-label">Next Sitting Date</label>
                                        <div class="col-md-3">
                                            <input type="date" name="dtNextSitingDate" id="dtNextSitingDate"
                                                placeholder="date" class="form-control" />
                                        </div>
                                        <label class="col-md-1 control-label">Time</label>
                                        <div class="col-md-3">
                                            <input type="time" name="dtNextSitingTime" id="dtNextSitingTime"
                                                placeholder="time" class="form-control" />
                                        </div>
                                        <div class="col-md-3">
                                            <a href="javascript:;" class="btn btn-sm btn-success"
                                                onclick="SaveTherapyClouser();">Complete Sitting</a>
                                        </div>
                                    </div>
                                </form>

                                <hr>


                                <div data-scrollbar="true" data-height="300px">

                                    <ul class="chats">

                                        <label> <u>Therapy Details</u> </label>


                                        <div id="DivTherapyDetailsClosure" class="email-content"></div>

                                    </ul>
                                </div>



                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">


                        <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalTherapyClosed" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Therapy Completion
                        </h4>
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->


                            <div class="panel-body">



                                <div data-scrollbar="true" data-height="300px">

                                    <ul class="chats">

                                        <label> <u>Therapy Details</u> </label>


                                        <div id="DivTherapyDetailsClosed" class="email-content"></div>

                                    </ul>
                                </div>



                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">


                        <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalTherapyCancelRecomended">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Cancel Recomended Therapy</h4>
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->


                            <div class="panel-body">
                                <form class="form-horizontal">


                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Remarks *</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" placeholder="Remarks" rows="5"
                                                id='txtCancelRecomendedRemarks'
                                                name='txtCancelRecomendedRemarks'></textarea>
                                        </div>

                                    </div>



                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <a href="javascript:;" class="btn btn-sm btn-success"
                            onclick="SaveCancellationRecomended();">Save</a>
                        <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalTherapyCancel">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Cancellation</h4>
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->


                            <div class="panel-body">
                                <form class="form-horizontal">

                                    <div>
                                        <label>Total sitings: </label><span id='spnTotalSiggings'><span />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Remarks *</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" placeholder="Remarks" rows="5"
                                                id='txtCancelRemarks' name='txtCancelRemarks'></textarea>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Refund to Paitent * </label>

                                        <div class="col-md-3">
                                            <select class="form-control" id='cmbRefundStatus' name='cmbRefundStatus'
                                                onchange='EnableRefundAmount();'>
                                                <option value='-'>-</option>
                                                <option value='Yes'>Yes</option>
                                                <option value='No'>No</option>
                                            </select>

                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Refund Amount * </label>

                                        <div class="col-md-4">
                                            <input type='number' class="form-control" name='txtRefundAmount'
                                                id='txtRefundAmount' value=0 placeholder='Refund amount' disabled />

                                        </div>
                                    </div>



                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <a href="javascript:;" class="btn btn-sm btn-success" onclick="SaveCancellation();">Save</a>
                        <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalTherapyReschedule">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Reschedule</h4>
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->


                            <div class="panel-body">
                                <form class="form-horizontal">

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Revised Date</label>
                                        <input type='hidden' id='txtEveningTimeSlotID' name='txtEveningTimeSlotID' />
                                        <input type='hidden' id='txtMorningTimeSlotID' name='txtMorningTimeSlotID' />
                                        <input type='hidden' id='txtDoctorCode' name='txtDoctorCode' />


                                        <div class="col-md-4">
                                            <input type="date" name="dtRevisedBookingDate" id="dtRevisedBookingDate"
                                                placeholder="Smith" class="form-control"
                                                value='<?php echo date('Y-m-d');  ?>' />
                                        </div>
                                        <i onclick='LoadAvailability()' style='cursor:pointer;'
                                            class="fa fa-2x fa-clock-o"></i>

                                        <div class="col-md-3">
                                            <input type="hidden" name="txtRevisedBookingTime" id="txtRevisedBookingTime"
                                                placeholder="Smith" class="form-control" value='00:00:00' />

                                        </div>
                                    </div>
                                    <script>
                                    $(document).ready(function() {
                                        // $("#myInput").on("keyup", function() {
                                        $("#myInputSL").on("keyup", function() {
                                            var value = $(this).val().toLowerCase();
                                            $("#myTableSL tr").filter(function() {
                                                $(this).toggle($(this).text().toLowerCase()
                                                    .indexOf(value) > -1)
                                            });
                                        });
                                    });
                                    </script>

                                    <div id='DivTimeSlot'></div>

                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <a href="javascript:;" class="btn btn-sm btn-success" onclick="SaveReschedule();">Save</a>
                        <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>



        <div id="content" class="content">
            <div class="col-md-12">

                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title">Therapy Register


                            <button type="button" class="btn btn-warning btn-sm" onclick='PrintReport()'
                                style='float:right;'> Print</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </h4>


                    </div>

                    <div class="panel-body">

                        <div class="col-md-12">




                            <div class="panel-body">
                                <form class="form-inline">


                                    <div style='display:none' class="form-group">
                                        <label for="exampleInputPassword2">Based On</label>

                                        <select class="js-states form-control" tabindex="-1" id='cmbBasedon'
                                            name='cmbBasedon'>



                                            <option value="TherapyDate">Therapy Date</option>


                                        </select>
                                    </div>


                                    <div style='display:none' class="form-group">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="exampleInputPassword2">Status</label>

                                        <select class="js-states form-control" tabindex="-1" id='cmbStatus'
                                            name='cmbStatus'>



                                            <option selected value="All">All</option>
                                            <option value="Booked">Booked</option>
                                            <option value="InProgress">In Progress</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Cancelled">Cancelled</option>


                                        </select>
                                    </div>


                                    <div class="form-group">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="exampleInputPassword2">Period</label>

                                        <select class="js-states form-control" tabindex="-1" id='cmbPeriod'
                                            name='cmbPeriod' onchange='ShowHideDiv();'>

                                            <option value="Today">Today</option>
                                            <option value="Tomorrow">Tomorrow</option>
                                            <option value="CurrentMonth">Current Month</option>
                                            <option value="Next7Days">Next 7 Days</option>
                                            <option value="Next14Days">Next 14 Days</option>
                                            <option value="Next30Days">Next 30 Days</option>
                                            <option value="Pending">All</option>
                                            <option value="Custom">Custom</option>

                                        </select>
                                    </div>

                                    <div class="form-group">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="exampleInputPassword2">Therapist</label>

                                        <select class="js-states form-control" tabindex="-1" id='cmbTherapist'
                                            name='cmbTherapist'>
                                            <option value='0'>All Therapist</option>
                                            <?php
                                            $sqli = "SELECT userid,username FROM usermaster where designationid in('8','9')  and  activestatus ='Active'";
                                            $result = mysqli_query($connection, $sqli);
                                            while ($row = mysqli_fetch_array($result)) {
                                                # code...

                                                echo ' <option value=' . $row['userid'] . '>' . $row['username'] . '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>





                                    <div class="form-group" id='DivCustomDate' name='DivCustomDate'
                                        style='display:none;'>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label>From Date</label>
                                        <input class="form-control" type='date' id='dtFromDate' name='dtFromDate' />
                                        <label>To Date</label>
                                        <input class="form-control" type='date' id='dtToDate' name='dtToDate' />
                                    </div>

                                    <div class="checkbox">

                                    </div>
                                    <button type="button" class="btn btn-info"
                                        onclick='LoadDatewiseRegister()'>Load</button>

                                </form>
                            </div>
                            <div class="table-responsive" id='DivTherapyScheduled'></div>

                        </div>


                    </div>
                </div>
                <!-- end panel -->

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