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

<body >
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
            <?php include("CLMSidePanel.php") ?>
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
                            LoadReviewStatusRegister();
                            Reset();
                        } else {
                            swal("Alert!", data, "warning");
                            LoadReviewStatusRegister();
                            Reset();
                        }


                    }
                });
            }

        }

 


        function LoadReviewStatusRegister() {

            var FromDate = document.getElementById("dtFromDateReport").value;
            var ToDate = document.getElementById("dtToDateReprt").value;
            var DoctorCode = document.getElementById("cmbDoctor").value;
            var Period = document.getElementById("cmbPeriod").value;


            var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate +
                "&DoctorCode=" + DoctorCode + "&Period=" + Period;

            // alert(datas);
            $.ajax({
                url: "Load/LoadReviewStatusRegister.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivPaymentHistory').html(data);


                }
            });
        }


        function LoadTherapyPaymentSummary() {

            var SupplierCode = document.getElementById("cmbSupplier").value;
            var datas = "&SupplierCode=" + SupplierCode;

            // alert(datas);
            $.ajax({
                url: "Load/LoadTherapyPaymentSummary.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {
                    // alert(data);
                    $("#txtOutstanding").val(data[0]);

                }
            });

        }





        function ShowHideDiv() {
            var cmbPeriod = document.getElementById("cmbPeriod");
            var DivFromDate = document.getElementById("lblFromDate");
            DivFromDate.style.display = cmbPeriod.value == "Custom" ? "inline-block" : "none";

            var DivToDate = document.getElementById("lblToDate");
            DivToDate.style.display = cmbPeriod.value == "Custom" ? "inline-block" : "none";


        }


        function PrintReport() {
            var CurrentDate = new Date()
            var contents = $("#DivPaymentHistory").html();
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

        function GetID(x, y, z) {
            document.getElementById("txtPaitentID").value = y;
            document.getElementById("txtInvoiceNo").value = x;
            document.getElementById("txtPaymentAmount").value = z;
            document.getElementById("txtCurrentBalance").value = z;
            document.getElementById("txtFinalBalance").value = 0;
            document.getElementById("cmbPaymentMode").value = 0;

        }


        function CalculateTotal() {
            var TotalOutstanding = document.getElementById("txtCurrentBalance").value;
            var Payment = document.getElementById("txtPaymentAmount").value;

            var NetBalance = (TotalOutstanding - Payment);
            if (NetBalance < 0) {
                swal("Alert", "Payment should not greater than Balance!", "warning");

                document.getElementById("txtFinalBalance").value = 0;
                document.getElementById("txtPaymentAmount").value = TotalOutstanding;
            } else {
                document.getElementById("txtFinalBalance").value = NetBalance;
            }
            // document.getElementById("txtDiscPercent").focus();



        }


        function UpdatePayment() {

            var InvoiceNo = document.getElementById("txtInvoiceNo").value;
            var PaitentCode = document.getElementById("txtPaitentID").value;

            var PaymentAmount = document.getElementById("txtPaymentAmount").value;
            var PaymentMode = document.getElementById("cmbPaymentMode").value;

            if (InvoiceNo == '' || PaitentCode == '' || PaymentAmount == '' || PaymentMode == '0') {

                swal("Alert", "Please Fill all mandatory details!", "warning");
            } else {
                var datas = "&InvoiceNo=" + InvoiceNo +
                    "&PaymentAmount=" + PaymentAmount +
                    "&PaitentCode=" + PaitentCode +
                    "&PaymentMode=" + PaymentMode;

                $.ajax({
                    url: "Save/UpdateTherapyPayment.php",
                    method: "POST",
                    data: datas,

                    success: function(data) {
                        if (data == 1) {
                            swal("Sucess", "Payment Updated Sucessfully!", "success");
                            LoadReviewStatusRegister();
                        } else {
                            swal("Alert", "Error Saving Payment Details, Please try again!", "error");

                        }
                    }
                });
            }
        }

        function UpdateReviewStatus() {
          
            var Remarks = document.getElementById("txtRemarks").value;
            var Status = document.getElementById("cmbReviewStatus").value;
            var ReviewID = document.getElementById("txtPatientCode").value;

 

            var datas = "&Remarks=" + Remarks + "&Status=" + Status +
                "&ReviewID=" + ReviewID;
            $.ajax({
                url: "Save/UpdateReviewStatus.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    alert(data);
                }
            });
        }




        function LoadCustomerDetails(x) { 
            document.getElementById("txtPatientCode").value=x;
            
        }
        </script>


        <style>
        .bootstrap-select:not([class*="span"]):not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 320px;
        }
        </style>


        <div id="ModalAddEnquiry" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Review Status</h4>
                        <input type='hidden' name ='txtPatientCode' id='txtPatientCode' /> 
                    </div>

                    <div class="modal-body">



                        <form class="form-horizontal form-bordered" data-parsley-validate="true" name="demo-form">
                            

                        <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="message">Status :</label>
                                <div class="col-md-6 col-sm-6">
                                   <select class='form-control' id='cmbReviewStatus' name ='cmbReviewStatus'>
                                    <option value='Completed'>Completed</option>
                                    <option value='NotWilling'>Not Willing</option> 
                                   </select>
                                </div>
                            </div> 


                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="message">Review Date :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input
                                        style='border-width: 0px; border-style: inset;  border-radius: 1px; border-bottom: 2px solid grey; '
                                        type='date' id='dtReviewDate' name='dtReviewDate' />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="message">Remarks :</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea id='txtRemarks' name='txtRemarks' rows="3"
                                        class='form-control'></textarea>
                                </div>
                            </div> 

                        </form>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-success" onclick='UpdateReviewStatus()'>Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <div id="ModalPaymentDetails" class="modal fade" role="dialog">
            <div class="modal-dialog ">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Collection</h4>
                    </div>

                    <div class="modal-body">

                        <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' class="form-control"
                            style='width:150px;' />
                        <input type='hidden' id='txtPaitentID' name='txtPaitentID' class="form-control"
                            style='width:150px;' />


                        <label>
                            Total Balance
                        </label>
                        <input type='number' style='font-size:20px;' id='txtCurrentBalance' name='txtCurrentBalance'
                            class="form-control" disabled />
                        <br>
                        <label>
                            Payment Amount
                        </label>
                        <input type='number' id='txtPaymentAmount' name='txtPaymentAmount' class="form-control"
                            style='width:150px;' onblur='CalculateTotal()' />
                        <br>
                        <label>
                            Balance
                        </label>
                        <b><input type='number' id='txtFinalBalance' name='txtFinalBalance' class="form-control"
                                style='font-size:20px;' style='width:150px;color:blue;' value=0 disabled /></b>
                        <br>

                        <label>
                            Payment Mode
                        </label>

                        <select class="form-control" id='cmbPaymentMode' name='cmbPaymentMode' onchange='focusamount();'
                            style='width:150px;'>
                            <option value='0'></option>
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

                    <div class="modal-footer">

                        <button type="button" class="btn btn-success" data-dismiss="modal"
                            onclick='UpdatePayment()'>Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="modal-QRCode" name="modal-QRCode">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Scan QR Code </h4>
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->

                            <div class="panel-body">
                                <form class="form-horizontal">


                                    <div class="form-group">
                                        <label>Please Scan QR Code on below
                                            box</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" placeholder="" id='txtQRCode'
                                                name='txtQRCode' onblur='redirect()' />
                                        </div>

                                    </div>


                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

        <script>
        function FocusQR() {

            document.getElementById("txtQRCode").focus();
        }

        function redirect() {

            var Invoice = document.getElementById("txtQRCode").value;

            var str1 = "ConfirmOnlineAppointment.php?MID=61&invoice=";
            var str2 = Invoice;
            var str3 = "";
            var BillPrintURL = str1.concat(str2, str3);
            if (Invoice != '') {
                window.open(BillPrintURL);
                window.location.reload();
            } else {

            }

            // break;

            // $('#modal-QRCode').modal('toggle');
            // $('#modal-QRCode').modal('close');
            // $('#modal-QRCode').removeClass('in')
        }
        </script>


        <div id="content" class="content">
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">


                            <h4 class="panel-title">Review Status Report
                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;


                            </h4>

                        </div>


                        <br>

                        <div class="form-group">

                            <label class="radio-inline"> Period

                                <select class="js-states form-control" tabindex="-1" id='cmbPeriod' name='cmbPeriod'
                                    onchange='ShowHideDiv();'>

                                    <option selected value="Today">Today</option>
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


<div style='display:none;'>
<label class="radio-inline"  >
                                Doctor
                                <select class='form-control' id='cmbDoctor' name='cmbDoctor' style="width: 150px;" hidden>
                                    <option value='%'>All</option>

                                    <?php  
                            $sqli = "SELECT userid,username FROM usermaster where designationid='9' and  activestatus='Active'";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value='.$row['userid'].'>'.$row['username'].'</option>';
                              }	
                            ?>
                                </select>
                            </td> 

                            </label>
    </div>
                            


                            <label class="radio-inline">

                                <a class="btn btn-success  btn-sm" onclick='LoadReviewStatusRegister();'>View</a>
                                <a class="btn btn-warning  btn-sm" onclick='PrintReport();'>Print</a>


                            </label>





                        </div>


                        <div data-scrollbar="true" data-height="900px">


                            <div id="DivPaymentHistory" class="email-content"></div>

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


    <script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
    <script src="../assets/js/table-manage-default.demo.min.js"></script>



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
    <script src="../assets/js/form-plugins.demo.min.js"></script>



    <script src="../assets/Custom/masking-input.js" data-autoinit="true"></script>
    <script src="../assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
    $(document).ready(function() {
        App.init();
        Inbox.init();
        FormPlugins.init();
        FormSliderSwitcher.init();
        TableManageDefault.init();
        FormWizard.init();
    });
    </script>
</body>
<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->

</html>