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

<body onload="LoadInvoiceNo();">
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
            <?php include("DSSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->

        <script>
        function LoadInvoiceNo() {

            var InvoiceNo = new Date().getTime();
            document.getElementById("txtInvoiceNo").value = InvoiceNo;

            LoadCenterSharePaymentDetails();

        }

        function SaveDisgnosticCenterShare() {

            var CenterID = document.getElementById("cmbCenterid").value;
            var EntryDate = document.getElementById("dtEntryDate").value;
            var FromDate = document.getElementById("dtFromDate").value;
            var ToDate = document.getElementById("dtToDate").value;
            var CalculationMode = document.getElementById("cmbCalculationMode").value;
            var SharePercent = document.getElementById("txtSharePercent").value;
            var AmountToPay = document.getElementById("txtAmountToPay").value;
            var PaymentMode = document.getElementById("cmbPaymentMode").value;
            var Remarks = document.getElementById("txtRemarks").value;
            var TotalSale = document.getElementById("txtTotalSales").value;
            var Profit = document.getElementById("txtProfit").value;
            var InvoiceNo = document.getElementById("txtInvoiceNo").value;
            var ShareType = document.getElementById("cmbShareType").value;
            var CheckAllStatus = document.getElementById("ckbCheckAll").value;
            var SelectedBill = document.getElementById("txtSelectedBill").value;
            var LocationCode = document.getElementById("cmbLocationAdmin").value;
            var DoctorTherapist = document.getElementById("cmbDoctorTheraist").value;
            if (!$('#ckbCheckAll').is(':checked')) {
                CheckAllStatus = 0; //alert('Not checked');
            } else {
                CheckAllStatus = 1;
            }

            if (CenterID == "" || EntryDate == "" || FromDate == "" || ToDate == "" || SharePercent == "" ||
                SharePercent == "0" || AmountToPay == "" || InvoiceNo == "" || AmountToPay == "0" || TotalSale == "0" ||
                Profit == "0" || TotalSale == "" || Profit == "" || PaymentMode == "") {

                swal("Alert!", " Fill All details", "warning");

            } else {

                var datas = "&CenterID=" + CenterID + "&EntryDate=" + EntryDate + "&FromDate=" + FromDate +
                    "&ToDate=" + ToDate +
                    "&CalculationMode=" + CalculationMode + "&SharePercent=" + SharePercent + "&AmountToPay=" +
                    AmountToPay +
                    "&PaymentMode=" + PaymentMode + "&Remarks=" + Remarks +
                    "&TotalSale=" + TotalSale +
                    "&SelectedBill=" + SelectedBill +
                    "&CheckAllStatus=" + CheckAllStatus +
                    "&LocationCode=" + LocationCode +
                    "&DoctorTherapist=" + DoctorTherapist +
                    "&Profit=" + Profit +
                    "&InvoiceNo=" + InvoiceNo + "&ShareType=" + ShareType;
                // alert(datas);
                $.ajax({
                    url: "Save/SaveDiagnosticCenterShare.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // swal(data);
                        if (data == 1) {

                            swal("Diagnostic Center Share Updated!", "Sucessfully", "success");
                            // swal(data);

                            location.reload();
                        } else {
                            swal("Alert!", data, "warning");
                            LoadIncomeExpenseList();

                        }


                    }
                });
            }

        }


        function Reset() {
            document.getElementById("txtAmount").value = '';
            document.getElementById("txtRemarks").value = '';

            $("#cmbGroup").val('default');
            $(cmbGroup).selectpicker("refresh");

            $("#cmbCenterid").val('default');
            $(cmbCenterid).selectpicker("refresh");
            document.getElementById("cmbCenterid").focus();
            LoadIncomeExpenseList();
        }

        function CalculateShare() {
            LoadDiagnosticCenterShare();

            var TotalSales = parseInt(document.getElementById("txtTotalSales").value);
            var Profit = parseInt(document.getElementById("txtProfit").value);
            var SharePercent = parseInt(document.getElementById("txtSharePercent").value);
            var CalculationMode = document.getElementById("cmbCalculationMode").value;


            if (CalculationMode == 'Profit') {
                var AmountToPay = parseInt(Profit) * parseInt(SharePercent) / 100;
                document.getElementById("txtAmountToPay").value = Math.round(AmountToPay);
            } else {
                var AmountToPay = parseInt(TotalSales) * parseInt(SharePercent) / 100;
                document.getElementById("txtAmountToPay").value = Math.round(AmountToPay);
            }

        }


        function CalculateSharePercent() {
            LoadDiagnosticCenterShare();

            var TotalSales = parseInt(document.getElementById("txtTotalSales").value);
            var Profit = parseInt(document.getElementById("txtProfit").value);
            var AmountToPay = parseInt(document.getElementById("txtAmountToPay").value);
            var CalculationMode = document.getElementById("cmbCalculationMode").value;


            if (CalculationMode == 'Profit') {
                var SharePercent = (parseInt(AmountToPay) / parseInt(TotalSales)) * 100;
                document.getElementById("txtSharePercent").value = Math.round(SharePercent);
            } else {
                var SharePercent = (parseInt(AmountToPay) / parseInt(TotalSales)) * 100;
                document.getElementById("txtSharePercent").value = Math.round(SharePercent);
            }

        }



        function LoadDiagnosticCenterShare() {
            var CenterID = document.getElementById("cmbCenterid").value;
            var FromDate = document.getElementById("dtFromDate").value;
            var ToDate = document.getElementById("dtToDate").value;
            var ShareType = document.getElementById("cmbShareType").value;
            var SelectedBill = document.getElementById("txtSelectedBill").value;
            var DoctorTherapist = document.getElementById("cmbDoctorTheraist").value;

            var CheckAllStatus = document.getElementById("ckbCheckAll").value;
            if (!$('#ckbCheckAll').is(':checked')) {
                CheckAllStatus = 0; //alert('Not checked');
            } else {
                CheckAllStatus = 1;
            }



            var datas = "&CenterID=" + CenterID + "&FromDate=" + FromDate +
                "&ToDate=" + ToDate +
                "&SelectedBill=" + SelectedBill +
                "&CheckAllStatus=" + CheckAllStatus +
                "&DoctorTherapist=" + DoctorTherapist +
                "&ShareType=" + ShareType;

            $.ajax({
                url: "Load/LoadDiagnosticCenterShare.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    if (data[2] == '0') {
                        document.getElementById("txtTotalSales").value = data[0];
                        document.getElementById("txtProfit").value = data[1];
                    } else {
                        swal('Already Paid');
                        document.getElementById("txtTotalSales").value = '';
                        document.getElementById("txtProfit").value = '';
                        document.getElementById("txtAmountToPay").value = '';
                    }

                }
            });
        }

        function LoadCenterSharePaymentDetails() {

            var CenterID = document.getElementById("cmbCenterID").value;

            var FromDate = document.getElementById("dtFromDateReport").value;

            var ToDate = document.getElementById("dtToDateReprt").value;

            var datas = "&CenterID=" + CenterID + "&FromDate=" + FromDate + "&ToDate=" + ToDate;

            $.ajax({
                url: "Load/LoadCenterSharePaymentDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivPaymentHistory').html(data);
                }
            });
        }


        function printDiv() {
            var divToPrint = document.getElementById('DivPrint');
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }

        function LoadPendingBills() {
            var CenterID = document.getElementById("cmbCenterid").value;
            var ShareType = document.getElementById("cmbShareType").value;
            var FromDate = document.getElementById("dtFromDate").value;
            var ToDate = document.getElementById("dtToDate").value;
            var Status = document.getElementById("cmbBillStatus").value;
            var DoctorTherapist = document.getElementById("cmbDoctorTheraist").value;

            document.getElementById("txtSelectedBill").value = '';

            var datas = "&CenterID=" + CenterID +
                "&ShareType=" + ShareType +
                "&FromDate=" + FromDate +
                "&ToDate=" + ToDate +
                "&DoctorTherapist=" + DoctorTherapist +
                "&Status=" + Status;

            // alert(datas);
            $.ajax({
                url: "Load/LoadPendingBills.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivBillList').html(data);
                }
            });

        }
        </script>

        <style>
        .bootstrap-select:not([class*="span"]):not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 320px;
        }
        </style>

        <div id="ModalBillDetails" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Bill Details
                            &nbsp;&nbsp;&nbsp;
                            <select style='display:none' id='cmbBillStatus' name='cmbBillStatus'
                                onchange="LoadPendingBills()">
                                <option selected value='1'>Pending Bills</option>
                                <option value='2'>Paid Bills</option>
                                <option value='0'>All</option>
                            </select>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <button type="button" class="btn btn-success" data-dismiss="modal"
                                onclick='LoadDiagnosticCenterShare()'>
                                Select Bills</button>

                        </h4>

                    </div>

                    <div class="modal-body">

                        <div id='DivBillList'></div>


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

                            <h4 class="panel-title">Diagnostic Center Payment Entry</h4>
                        </div>
                        <div class="panel-body">
                            <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' />
                            <input type='hidden' id='txtSelectedBill' name='txtSelectedBill' />

                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Payment Date</label>

                                    <div class="col-md-6">
                                        <input type="date" class="form-control" placeholder="" id='dtEntryDate'
                                            name='dtEntryDate' value='<?php echo date('Y-m-d'); ?>' />
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Location </label>

                                    <div class="col-md-6">
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
                                    </div>

                                </div>


                                <div class="form-group" style='display:none'>
                                    <label class="col-md-3 control-label"> Payment For</label>
                                    <div class="col-md-6">



                                        <select class="selectpicker" data-show-subtext="true" data-live-search="true"
                                            data-style="btn-white" id='cmbDoctorTheraist' name='cmbDoctorTheraist'
                                            style="width: 100px;">
                                            <option>Doctor</option>
                                            <option>Therapist</option>

                                        </select>

                                    </div>
                                </div>







                                <div class="form-group">
                                    <label class="col-md-3 control-label">Center Name</label>
                                    <div class="col-md-6">



                                        <select class="selectpicker" data-show-subtext="true" data-live-search="true"
                                            data-style="btn-white" id='cmbCenterid' name='cmbCenterid'
                                            style="width: 100px;">

                                            <?php
                                            $sqli = "SELECT centerid,centername FROM diagnosticcentre where activestatus ='Active'  order by 2 ";
                                            $result = mysqli_query($connection, $sqli);
                                            while ($row = mysqli_fetch_array($result)) {
                                                # code...

                                                echo ' <option value=' . $row['centerid'] . '>' . $row['centername'] . '</option>';
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>






                                <div class="form-group">
                                    <label class="col-md-3 control-label">Period</label>

                                    <div class="col-md-4">
                                        <input type="date" class="form-control" placeholder="" id='dtFromDate'
                                            name='dtFromDate' />
                                    </div>

                                    <div class="col-md-4">
                                        <input type="date" class="form-control" placeholder="" id='dtToDate'
                                            name='dtToDate' />
                                    </div>


                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Based On</label>

                                    <div class="col-md-4">
                                        <select class="form-control" id='cmbShareType' name='cmbShareType' />
                                        <option value='Samples'>Samples Collection</option>
                                        <!-- <option value='Therapy'>Therapy</option>
                                        <option value='Inventory'>Inventory</option> -->
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <a href='' data-toggle='modal' data-target='#ModalBillDetails'
                                            onclick='LoadPendingBills()'>Select Bills </a>
                                    </div>


                                </div>




                                <div class="form-group">
                                    <label class="col-md-3 control-label">Total Fee</label>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="" id='txtTotalSales'
                                            name='txtTotalSales' disabled />
                                    </div>

                                    <div class="col-md-4">
                                        <input type="hidden" class="form-control" placeholder="" id='txtProfit'
                                            name='txtProfit' disabled />
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" style='display:none'>Calculate by</label>

                                    <div class="col-md-3" style='display:none'>
                                        <select id='cmbCalculationMode' name='cmbCalculationMode' class="form-control"
                                            disabled>
                                            <option value='Profit'>Fee</option>
                                            <option value='Sale'>Total Sale</option>
                                        </select>
                                    </div>
                                    <label class="col-md-3 control-label" style='white-space:nowrap;'>Share %</label>

                                    <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="" id='txtSharePercent'
                                            name='txtSharePercent' onkeyup="CalculateTotal()" />
                                    </div>


                                    <a class="btn btn-success btn-icon btn-circle btn-lg" onclick='CalculateShare();'>
                                        <i class="fa fa-plus"> </i></a>


                                </div>

                                <div class="form-group">

                                    <label class="col-md-3 control-label"> Amount to Pay</label>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" placeholder="" id='txtAmountToPay'
                                            name='txtAmountToPay' onkeyup="CalculateSharePercent()" />
                                    </div>




                                </div>

                                <div class="form-group" style='display:none;'>
                                    <label class="col-md-3 control-label"> Group</label>
                                    <div class="col-md-6">



                                        <select class="selectpicker" data-show-subtext="true" data-live-search="true"
                                            data-style="btn-white" id='cmbGroup' name='cmbGroup' style="width: 100px;"
                                            disabled>
                                            <option value='Inventory' selected>Inventory</option>
                                            <option value='Clinic'>Clinic</option>
                                            <option value='Course'>Course</option>

                                        </select>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Payment Mode</label>
                                    <div class="col-md-6">



                                        <select class="form-control" id='cmbPaymentMode' name='cmbPaymentMode'
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

                                        </select>

                                    </div>
                                </div>



                                <div class="form-group" style='display:none;'>
                                    <label class="col-md-3 control-label">Type</label>
                                    <div class="col-md-6">

                                        <label class="radio-inline">
                                            <input type="radio" name="rdType" value="Income" />
                                            Income Entry
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="rdType" value="Expense" checked />
                                            Expense Entry
                                        </label>

                                    </div>

                                </div>



                                <div class="form-group">
                                    <label class="col-md-3 control-label">Remarks.</label>

                                    <div class="col-md-6">
                                        <textarea id='txtRemarks' name='txtRemarks' row='5'
                                            class="form-control"></textarea>
                                    </div>
                                </div>





                                <div class="form-group">
                                    <label class="col-md-3 control-label"> </label>
                                    <div class="col-md-9">
                                        <input type="button" class="btn btn-sm btn-success"
                                            onClick="SaveDisgnosticCenterShare();" value='Save'>
                                        <input type="button" class="btn btn-sm btn-warning" onClick="Reset();"
                                            value='Clear'>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <div class="col-md-7">

                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">

                            <h4 class="panel-title">Payment History</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">

                                <label class="radio-inline">
                                    From
                                    <input type="date" class='form-control' name="dtFromDateReport"
                                        id='dtFromDateReport' />

                                </label>
                                <label class="radio-inline">
                                    To
                                    <input type="date" class='form-control' name="dtToDateReprt" id='dtToDateReprt' />

                                </label>
                                <label class="radio-inline">
                                    Center Name
                                    <select class='form-control' id='cmbCenterID' name='cmbCenterID'
                                        style="width: 150px;">

                                        <?php
                                        $sqli = "SELECT centerid,centername FROM diagnosticcentre where   activestatus='Active' order by 2 ";
                                        $result = mysqli_query($connection, $sqli);
                                        while ($row = mysqli_fetch_array($result)) {
                                            # code...

                                            echo ' <option value=' . $row['centerid'] . '>' . $row['centername'] . '</option>';
                                        }
                                        ?>
                                    </select>

                                </label>
                                <label class="radio-inline">

                                    <a class="btn btn-success  btn-sm"
                                        onclick='LoadCenterSharePaymentDetails();'>View</a>

                                    <a class="btn btn-success  btn-sm" onclick="printDiv();"><i
                                            class="fa  fa-print"></i></a>
                                </label>





                            </div>

                            <div data-scrollbar="true" data-height="510px">
                                <ul class="chats">

                                    <div id="DivPaymentHistory"></div>
                                </ul>
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