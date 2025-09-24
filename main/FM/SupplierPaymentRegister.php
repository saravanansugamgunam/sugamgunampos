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
    $position=$_SESSION["SESS_LAST_NAME"]; 
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
            <?php include("FMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->

        <script>
        function SaveIncomeExpenses() {


            var SupplierCode = document.getElementById("cmbSupplier").value;
            var Group = document.getElementById("cmbGroup").value;
            var EntryDate = document.getElementById("dtEntryDate").value;
            var EntryType = document.querySelector('input[name="rdType"]:checked').value;
            var Amount = document.getElementById("txtAmount").value;
            var Remarks = document.getElementById("txtRemarks").value;
            var PaymentMode = document.getElementById("cmbPaymentMode").value;
            var InvoiceNo = document.getElementById("txtInvoiceNo").value;
            var Balance = document.getElementById("txtBalance").value;


            // alert(Ledger);

            if (SupplierCode == "" || EntryDate == "" || Amount == "" || InvoiceNo == "" || Amount == "0") {

                swal("Alert!", " Fill All details", "warning");

            } else {

                var datas = "&SupplierCode=" + SupplierCode + "&Group=" + Group + "&EntryDate=" + EntryDate +
                    "&EntryType=" + EntryType + "&Amount=" + Amount + "&Remarks=" + Remarks + "&PaymentMode=" +
                    PaymentMode + "&InvoiceNo=" + InvoiceNo;
                // alert(datas);
                $.ajax({
                    url: "Save/SaveSupplierPayment.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == 1) {

                            swal("Supplier Payment!", "Done Sucessfully", "success");
                            // swal(data);
                            LoadIncomeExpenseList();
                            Reset();
                        } else {
                            swal("Alert!", data, "warning");
                            LoadIncomeExpenseList();
                            Reset();
                        }


                    }
                });
            }

        }

        function LoadInvoiceNo() {

            var InvoiceNo = new Date().getTime();
            document.getElementById("txtInvoiceNo").value = InvoiceNo;


        }

        function Reset() {


            document.getElementById("txtAmount").value = '0';
            document.getElementById("txtRemarks").value = '0';
            document.getElementById("txtOutstanding").value = '0';
            document.getElementById("txtBalance").value = '0';

            $("#cmbGroup").val('default');
            $(cmbGroup).selectpicker("refresh");

            $("#cmbSupplier").val('default');
            $(cmbSupplier).selectpicker("refresh");
            document.getElementById("cmbSupplier").focus();
            LoadInvoiceNo();
            LoadIncomeExpenseList();
        }


        function LoadIncomeExpenseList() {

            var FromDate = document.getElementById("dtFromDateReport").value;
            var ToDate = document.getElementById("dtToDateReprt").value;
            var SupplierCode = document.getElementById("cmbSupplierCodeReport").value;
            var Period = document.getElementById("cmbPeriod").value;
            

            var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate 
            + "&SupplierCode=" + SupplierCode + "&Period=" + Period;

            // alert(datas);
            $.ajax({
                url: "Load/LoadSupplierPayment.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivPaymentHistory').html(data);


                }
            });
        }


        function LoadOutstanding() {

            var SupplierCode = document.getElementById("cmbSupplier").value;
            var datas = "&SupplierCode=" + SupplierCode;

            // alert(datas);
            $.ajax({
                url: "Load/LoadSupplierOutstanding.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {
                    // alert(data);
                    $("#txtOutstanding").val(data[0]);

                }
            });

        }


        function CalculateTotal() {
            var TotalOutstanding = document.getElementById("txtOutstanding").value;
            var Payment = document.getElementById("txtAmount").value;

            var NetBalance = (TotalOutstanding - Payment);
            // document.getElementById("txtDiscPercent").focus();
            document.getElementById("txtBalance").value = NetBalance;


        }



        function ShowHideDiv() {
            var cmbPeriod = document.getElementById("cmbPeriod");
            var DivFromDate = document.getElementById("lblFromDate");
            DivFromDate.style.display = cmbPeriod.value == "Custom" ? "inline-block" : "none";

            var DivToDate = document.getElementById("lblToDate");
            DivToDate.style.display = cmbPeriod.value == "Custom" ? "inline-block" : "none";


        }

        
 function PrintReport() {
	    var CurrentDate=new Date()
        var contents = $("#DivPaymentHistory").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
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
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    } 
        </script>


        <style>
        .bootstrap-select:not([class*="span"]):not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 320px;
        }
        </style>

        <div id="content" class="content">
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-5" style='display:none'>
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">

                            <h4 class="panel-title">Supplier Payment Entry</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' />
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Date</label>

                                    <div class="col-md-6">
                                        <input type="date" class="form-control" placeholder="" id='dtEntryDate'
                                            name='dtEntryDate' />
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Group</label>
                                    <div class="col-md-6">



                                        <select class="selectpicker" data-show-subtext="true" data-live-search="true"
                                            data-style="btn-white" id='cmbGroup' name='cmbGroup' style="width: 100px;">
                                            <option value='Inventory' selected>Inventory</option>
                                            <option value='Clinic'>Clinic</option>
                                            <option value='Course'>Course</option>

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Supplier</label>
                                    <div class="col-md-6">



                                        <select class="selectpicker" data-show-subtext="true" data-live-search="true"
                                            data-style="btn-white" id='cmbSupplier' name='cmbSupplier'
                                            style="width: 100px;" onchange="LoadOutstanding();">
                                            <option selected></option>
                                            <?php  
                            $sqli = "SELECT suplier_id, UPPER(suplier_name) as suppliername FROM `supliers`";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value='.$row['suplier_id'].'>'.$row['suppliername'].'</option>';
                              }	
                            ?>
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
                          
                             echo ' <option value='.$row['paymentmodecode'].'>'.$row['paymentmode'].'</option>';
                              }	
                            ?>

                                        </select>

                                    </div>
                                </div>



                                <div class="form-group" style='display:none;'>
                                    <label class="col-md-3 control-label">Type</label>
                                    <div class="col-md-6">

                                        <label class="radio-inline">
                                            <input type="radio" name="rdType" value="Income" disabled />
                                            Income Entry
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="rdType" value="Expense" checked disabled />
                                            Expense Entry
                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Outstanding</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" placeholder="" id='txtOutstanding'
                                            name='txtOutstanding' disabled />

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Amount</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" placeholder="" id='txtAmount'
                                            name='txtAmount' onkeyup="CalculateTotal()" />

                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Balance</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" placeholder="" id='txtBalance'
                                            name='txtBalance' disabled />

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
                                            onClick="SaveIncomeExpenses();" value='Save'>
                                        <input type="button" class="btn btn-sm btn-warning" onClick="Reset();"
                                            value='Clear'>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">

                            <h4 class="panel-title">Supplier - Payment Register</h4>
                        </div>


                        <br>

                        <div class="form-group">

                            <label class="radio-inline"> Period

                                <select class="js-states form-control" tabindex="-1" id='cmbPeriod' name='cmbPeriod'
                                    onchange='ShowHideDiv();'>

                                    <option value="Today">Today</option>
                                    <option value="Yesterday">Yesterday</option>
                                    <option value="CurrentMonth">Current Month</option>
                                    <option value="Last7Days">Last 7 Days</option>
                                    <option value="Last14Days">Last 14 Days</option>
                                    <option value="Last30Days">Last 30 Days</option>
                                    <option value="Custom">Custom</option>

                                </select></label>


                            <label class="radio-inline" id='lblFromDate' style='display:none;'>
                                From
                                <input type="date" class='form-control' name="dtFromDateReport" id='dtFromDateReport' />

                            </label>
                            <label class="radio-inline" id='lblToDate' style='display:none;'>
                                To
                                <input type="date" class='form-control' name="dtToDateReprt" id='dtToDateReprt' />

                            </label>



                            <label class="radio-inline">
                                Supplier
                                <select class='form-control' id='cmbSupplierCodeReport' name='cmbSupplierCodeReport'
                                    style="width: 150px;">
                                    <option value='%'>All</option>

                                    <?php  
                            $sqli = "SELECT suplier_id,suplier_name FROM  supliers ORDER BY suplier_name  ";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value='.$row['suplier_id'].'>'.$row['suplier_name'].'</option>';
                              }	
                            ?>
                                </select>

                            </label>
                            <label class="radio-inline">

                                <a class="btn btn-success  btn-sm" onclick='LoadIncomeExpenseList();'>View</a>
                                <a class="btn btn-warning  btn-sm" onclick='PrintReport();'>Print</a>

                                
                            </label>





                        </div>


                        <div data-scrollbar="true" data-height="510px">
                            <ul class="chats">


                                <div id="DivPaymentHistory" class="email-content"></div>
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