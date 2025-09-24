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
$position = $_SESSION["SESS_LAST_NAME"];
session_cache_limiter(FALSE);
session_start();

?>

<head>
    <meta charset="utf-8" />
    <title>Valviyal Academy</title>
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
            <?php include("CMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->
        <script>
        function SavePayment() {
            // alert(1);
            var PaymentMode = document.getElementById("cmbPaymentMode").value;
            var StudentCode = document.getElementById("txtStudentCode").value;
            var BatchCode = document.getElementById("cmbBatch").value;
            var PaidDate = document.getElementById("dtPaidDate").value;
            var InvoiceNo = document.getElementById("txtInvoiceNo").value;

            // alert(2);
            var PaymentAmount = document.getElementById("txtPaymentAmount").value;
            var MobileNo = document.getElementById("txtStudentMobile").value;
            // alert(3);
            if (PaymentMode == "" || MobileNo == "" || StudentCode == "" || BatchCode == "" || PaidDate == "" ||
                PaymentAmount == "") {

                swal("Alert!", "  Please Provide valid details!", "warning");

            } else {

                var datas = "&PaymentMode=" + PaymentMode + "&StudentCode=" + StudentCode + "&BatchCode=" +
                    BatchCode + "&PaymentAmount=" + PaymentAmount + "&MobileNo=" + MobileNo + "&PaidDate=" + PaidDate +
                    "&InvoiceNo=" + InvoiceNo;
                // alert(datas);
                $.ajax({
                    url: "Save/SavePayment.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == 1) {
                            swal("Payment!", "Payment Made", "success");
                            LoadBalanceFees()

                            redirect();
                            Reset();

                        } else {
                            swal("Alert!", data, "warning");
                            LoadBalanceFees()
                            Reset();
                        }


                    }
                });
            }
            //  LoadInvoiceNo();
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
            document.getElementById("txtPaymentAmount").value = 0;
            document.getElementById("cmbPaymentMode").value = "";
            LoadPaymentHistory();
            LoadBatchList();
            LoadInvoiceNo();
        }

        function LoadPaymentHistory() {

            var StudentCode = document.getElementById("cmbStudent").value;
            var datas = "&StudentCode=" + StudentCode;
            $.ajax({
                url: "Load/LoadPaymentHistory.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivPaymentHistory').html(data);


                }
            });
        }

        function LoadBatchList() {


            var StudentCode = document.getElementById("cmbStudent").value;

            $.ajax({
                url: 'Load/LoadBatchForPayment.php',
                type: 'post',
                data: {
                    StudentCode: StudentCode
                },
                dataType: 'json',
                success: function(response) {


                    var len = response.length;

                    $("#cmbBatch").empty();
                    $("#cmbBatch").append("<option value='0'>-</option>");
                    for (var i = 0; i < len; i++) {
                        var batchcode = response[i]['batchcode'];
                        var Batch = response[i]['Batch'];

                        $("#cmbBatch").append("<option value='" + batchcode + "'>" + Batch + "</option>");

                    }

                }
            });

        }



        function LoadBalanceFees() {

            var StudentCode = document.getElementById("cmbStudent").value;

            var datas = "&StudentCode=" + StudentCode;
            // alert(datas);
            $.ajax({
                url: "Load/LoadFeesBalance.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#txtStudentCode").val(data[0]);
                    $("#txtStudentName").val(data[1]);
                    $("#txtFeesBalance").val(data[2]);
                    $("#txtGender").val(data[3]);
                    $("#txtStudentDOB").val(data[4]);
                    $("#txtStudentMobile").val(data[5]);


                    document.getElementById("cmbBatch").focus();
                }
            });
            LoadBatchList();
            LoadPaymentHistory();
        }

        function LoadBatchBalance() {

            var StudentCode = document.getElementById("cmbStudent").value;
            var BatchCode = document.getElementById("cmbBatch").value;


            var datas = "&StudentCode=" + StudentCode + "&BatchCode=" + BatchCode;

            $.ajax({
                url: "Load/LoadBatchBalanceForPayment.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#txtBalanceBatchFee").val(data[0]);
                    $("#txtPaymentAmount").val(data[0]);
                    document.getElementById("txtPaymentAmount").focus();
                    document.getElementById("txtPaymentAmount").select();
                }
            });

        }

        function GetPointID(x) {
            var SelectedColumn = x.cellIndex;
            var SelectedRow = x.parentNode.rowIndex;

            //var Id = document.getElementById("indextable").rows[SelectedRow].cells[0].innerHTML;  
            var Id = document.getElementById("tblBatch").rows[SelectedRow].cells.namedItem("tblBatchCode").innerHTML;
            var BatchName = document.getElementById("tblBatch").rows[SelectedRow].cells.namedItem("tblBatchName")
                .innerHTML;
            var DueAmount = document.getElementById("tblBatch").rows[SelectedRow].cells.namedItem("tblDueAmount")
                .innerHTML;
            document.getElementById("txtBatchCodetoSave").value = Id;
            document.getElementById("txtBatchName").value = BatchName;
            document.getElementById("txtPaymentAmount").value = DueAmount;
            document.getElementById("txtPaymentAmount").focus();
            document.getElementById("txtPaymentAmount").select();
            // document.getElementById("txtSelectedRowForUploadAttachment").value = SelectedRow; 


        }

        function LoadInvoiceNo() {

            var InvoiceNo = new Date().getTime();
            document.getElementById("txtInvoiceNo").value = InvoiceNo;


        }

        function SaveCourse() {

            var CourseName = document.getElementById("txtCourseName").value;
            var CourseDuration = document.getElementById("txtDuration").value;
            var CourseDurationType = document.getElementById("cmbDuration").value;
            var CourseFee = document.getElementById("txtFeeAmount").value;
            var CourseDescription = document.getElementById("txtCourseDescription").value;
            var StudentCode = document.getElementById("txtStudentCode").value;
            var StudentMobile = document.getElementById("txtStudentMobile").value;
            var StudentName = document.getElementById("txtStudentName").value;




            if (CourseName == "" || CourseFee == "" || CourseDuration == "" || StudentCode == "") {

                swal("Alert!", "Kindly provide all details!", "warning");

            } else {
                var datas = "&CourseName=" + CourseName + "&CourseDuration=" + CourseDuration + "&CourseDurationType=" +
                    CourseDurationType + "&CourseFee=" + CourseFee + "&CourseDescription=" + CourseDescription +
                    "&StudentCode=" + StudentCode + "&StudentMobile=" + StudentMobile + "&StudentName=" + StudentName;

                $.ajax({
                    url: "Save/SaveInstantCourse.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == 1) {
                            swal("Course!", "Successfuly Added", "success");
                            Reset();
                        } else {
                            swal("Alert!", "Error adding instant Course", "warning");
                            Reset();
                        }


                    }
                });
            }
            LoadBalanceFees();
        }
        </script>

        <div id="content" class="content">

            <div class="modal fade" id="modal-dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Modal Dialog</h4>
                        </div>
                        <div class="modal-body">

                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Course Name</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Course Name"
                                            id='txtCourseName' name='txtCourseName' />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Course Duration</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="Duration"
                                            id='txtDuration' name='txtDuration' />
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" id='cmbDuration' name='cmbDuration'>
                                            <option>Day</option>
                                            <option>Week</option>
                                            <option>Month</option>
                                            <option>Year</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Course Fee</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="Fees amount"
                                            id='txtFeeAmount' name='txtFeeAmount' />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Course Description</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" placeholder="Course Description" rows="2"
                                            id='txtCourseDescription' name='txtCourseDescription'></textarea>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-sm btn-warning" data-dismiss="modal"
                                onclick="Reset();">Cancel</a>
                            <a href="javascript:;" class="btn btn-sm btn-success" onclick="SaveCourse();"
                                data-dismiss="modal"> Add</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">

                            <h4 class="panel-title">Payment Collection</h4>
                            <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' />
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Mobile No</label>

                                    <div class="col-md-6">

                                        <select class="selectpicker" data-show-subtext="true" data-live-search="true"
                                            data-style="btn-white" id='cmbStudent' name='cmbStudent'
                                            onchange="LoadBalanceFees();">
                                            <option selected></option>
                                            <?php
                                            $sqli = "SELECT a.studentcode,CONCAT(a.studentname, ' [',a.studentmobileno, ']') AS Student
                              FROM studentmaster AS a  
                              group by a.studentcode,CONCAT(a.studentname, ' [',a.studentmobileno, ']')  ";
                                            $result = mysqli_query($connection, $sqli);
                                            while ($row = mysqli_fetch_array($result)) {
                                                # code...

                                                echo ' <option value=' . $row['studentcode'] . '>' . $row['Student'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">

                                        <a href="#modal-dialog" class="btn btn-sm btn-warning" data-toggle="modal">Add
                                            Instant Course</a>

                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Name</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" placeholder="Name" id='txtStudentName'
                                            name='txtStudentName' readonly />
                                        <input type="hidden" class="form-control" placeholder="Name" id='txtStudentCode'
                                            name='txtStudentCode' readonly />
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Mobile"
                                            id='txtStudentMobile' name='txtStudentMobile' readonly />

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Gender</label>

                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="" id='txtGender'
                                            name='txtGender' readonly />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="DOB" id='txtStudentDOB'
                                            name='txtStudentDOB' readonly />
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Total Balance</label>

                                    <div class="col-md-3">
                                        <b> <input type="text" class="form-control" placeholder="" id='txtFeesBalance'
                                                name='txtFeesBalance' readonly /> </b>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-md-3 control-label"> Batch</label>
                                    <div class="col-md-5">
                                        <select class="form-control" id='cmbBatch' name='cmbBatch'
                                            onchange='LoadBatchBalance();'>
                                            <option selected value='0'>-</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="" id='txtBalanceBatchFee'
                                            name='txtBalanceBatchFee' readonly />
                                    </div>




                                </div>

                                <div class="form-group">

                                    <label class="col-md-3 control-label"> Payment</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="" id='txtPaymentAmount'
                                            name='txtPaymentAmount' />
                                    </div>

                                    <label class="col-md-1 control-label"> Paid Date</label>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control" placeholder="" id='dtPaidDate'
                                            name='dtPaidDate' />
                                    </div>


                                </div>
                                <div class="form-group">

                                    <label class="col-md-3 control-label"> Payment Mode</label>



                                    <div class="col-md-6">
                                        <select class="form-control" id='cmbPaymentMode' name='cmbPaymentMode'>
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

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> </label>
                                    <div class="col-md-9">
                                        <input type="button" class="btn btn-sm btn-success" onclick="SavePayment();"
                                            value='Pay'>

                                        <input type="button" class="btn btn-sm btn-warning"
                                            onClick="window.location.reload();" value='Clear'>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- end panel -->




                <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">

                            <h4 class="panel-title">Payment History</h4>
                        </div>
                        <div class="panel-body">
                            <div data-scrollbar="true" data-height="210px">
                                <ul class="chats">


                                    <div id="DivPaymentHistory" class="email-content"></div>
                                </ul>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
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