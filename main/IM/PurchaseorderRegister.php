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

<body onload="LoadEnquiryRegister();">
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



        <style>
        .bootstrap-select:not([class*="span"]):not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 320px;
        }
        </style>




        <script>
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


        function SaveEnquiry() {
            var AppointmentDate = document.getElementById("dtNextAppointment").value;
            var Remarks = document.getElementById("txtRemarks").value;
            var Enquiry = document.getElementById("cmbEnquiry").value;
            var MobileNo = document.getElementById("txtMobileNo").value;
            var Name = document.getElementById("txtName").value;
            var Reference = document.getElementById("cmbReference").value;
            var Stakeholder = document.getElementById("cmbStakeholder").value;
            var Pincode = document.getElementById("txtPincode").value
            var Location = document.getElementById("txtLocation").value
            var Priority = document.getElementById("cmbPriority").value;


            var datas = "&AppointmentDate=" + AppointmentDate + "&Remarks=" + Remarks +
                "&Enquiry=" + Enquiry +
                "&MobileNo=" + MobileNo +
                "&Reference=" + Reference +
                "&Stakeholder=" + Stakeholder +
                "&Location=" + Location +
                "&Pincode=" + Pincode +
                "&Priority=" + Priority +
                "&Name=" + Name;
            $.ajax({
                url: "Save/SaveEnquiry.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    window.location.reload();
                }
            });
        }


        function SaveLog() {
            var FollowupDate = document.getElementById("dtNextFollowup").value;
            var LeadStatus = document.getElementById("cmbLeadStatus").value;
            var FollowupRemarks = document.getElementById("txtFollowupRemarks").value;
            var LeadId = document.getElementById("txtLeadId").value;

            var datas = "&FollowupDate=" + FollowupDate +
                "&LeadStatus=" + LeadStatus +
                "&FollowupRemarks=" + FollowupRemarks +
                "&LeadId=" + LeadId;
            $.ajax({
                url: "Save/SaveLeadLog.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    window.location.reload();
                }
            });
        }

        function LoadLeadID(x) {
            document.getElementById("txtLeadId").value = x;
        }


        function LoadLeadView(x) {
            var LeadId = x;

            var datas = "&LeadId=" + LeadId;

            $.ajax({
                url: "Load/LoadLeadView.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivLeadView').html(data);

                }
            });

        }


        function LoadEnquiryRegister() {

            var FromDate = document.getElementById("dtFromDateReport").value;
            var ToDate = document.getElementById("dtToDateReprt").value;
            var Period = document.getElementById("cmbPeriod").value; 
            var LeadStatus = document.getElementById("cmbLeadStatusFilter").value;
 
            var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate + "&Period=" + Period +
                 "&LeadStatus=" + LeadStatus;

            // alert(datas);
            $.ajax({
                url: "Load/Purchaseorder/LoadPurchaseorderReport.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivPaymentHistory').html(data);


                }
            });
        }
        </script>



        <div id="ModelViewLead" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Lead Details</h4>
                    </div>

                    <div class="modal-body">

                        <div id='DivLeadView'></div>


                    </div>
                </div>
            </div>
        </div>
        <div id="ModelUpdateLog" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Followup Log</h4>
                        <input type='hidden' id='txtLeadId' name='txtLeadId'>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4" for="message">Next Followup</label>

                            <input
                                style='border-width: 0px; border-style: inset;  border-radius: 1px; border-bottom: 2px solid grey; '
                                type='date' id='dtNextFollowup' name='dtNextFollowup' />
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4" for="message">Status</label>
                            <select class="form-control" id='cmbLeadStatus' name='cmbLeadStatus'>
                                <option value='Intrested'>Intrested</option>
                                <option value='Follow-up'>Follow-up</option>
                                <option value='Dropped'>Dropped</option>
                                <option value='Converted'>Converted</option>
                                <option value='Closed'>Closed</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4" for="message">Remarks</label>
                            <textarea id='txtFollowupRemarks' name='txtFollowupRemarks' rows="3"
                                class='form-control'></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-success" onclick='SaveLog()'>Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div id="ModalAddEnquiry" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Lead Creation</h4>
                    </div>

                    <div class="modal-body">



                        <form class="form-horizontal form-bordered" data-parsley-validate="true" name="demo-form">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="fullname">Stakeholder *
                                    :</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control" id='cmbStakeholder' name='cmbStakeholder'>
                                        <option></option>
                                        <?php
                            $sqli = "  SELECT stakeholderid,stakeholder  FROM stakeholderlist WHERE activestatus ='Active'";
                            $result = mysqli_query($connection, $sqli);
                            while ($row = mysqli_fetch_array($result)) {
                                # code...

                                echo ' <option value=' . $row['stakeholderid'] . '>' . $row['stakeholder'] . '</option>';
                            }
                            ?>
                                    </select>
                                </div>
                            </div>

                            


                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="email">Reference * :</label>
                                <div class="col-md-6 col-sm-6">

                                    <select class="form-control" id='cmbReference' name='cmbReference'>
                                        <option></option>
                                        <?php
                            $sqli = "  SELECT referenceid,reference FROM referencemaster  WHERE referencestatus ='Active'";
                            $result = mysqli_query($connection, $sqli);
                            while ($row = mysqli_fetch_array($result)) {
                                # code...

                                echo ' <option value=' . $row['referenceid'] . '>' . $row['reference'] . '</option>';
                            }
                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="website">Name *:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type='text' class='form-control' name='txtName' id='txtName' />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="message">Mobile No *:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type='text' class='form-control' name='txtMobileNo' id='txtMobileNo' />

                                </div>
                            </div>
                            
                                                        <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="message">Location*:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type='text' class='form-control' name='txtLocation' id='txtLocation' />

                                </div>
                            </div>
                            
                                                        <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="message">Pincode:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type='text' class='form-control' name='txtPincode' id='txtPincode' />

                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="message">Followup Date :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input
                                        style='border-width: 0px; border-style: inset;  border-radius: 1px; border-bottom: 2px solid grey; '
                                        type='date' id='dtNextAppointment' name='dtNextAppointment' />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="message">Remarks :</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea id='txtRemarks' name='txtRemarks' rows="3"
                                        class='form-control'></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="email">Priority * :</label>
                                <div class="col-md-6 col-sm-6">

                                    <select class="form-control" id='cmbPriority' name='cmbPriority'>
                                        <option value='Low'>Low</option>
                                        <option value='Med'>Med</option>
                                        <option value='High'>High</option>

                                    </select>
                                </div>
                            </div>


                        </form>



                        <div class="modal-footer">

                            <button type="button" class="btn btn-success" onclick='SaveEnquiry()'>Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div id="content" class="content">
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">


                            <h4 class="panel-title">Purchase Order Register
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              


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

                           
                            <label class="radio-inline"> Status

                                <select class="form-control" id='cmbLeadStatusFilter' name='cmbLeadStatusFilter'>
                                    <option value='%'>All</option>
                                    <option value='Captured'>Captured</option>
                                    <option value='Intrested'>Intrested</option>
                                    <option value='Follow-up'>Follow-up</option>
                                    <option value='Dropped'>Dropped</option>
                                    <option value='Convereted'>Convereted</option>
                                        <option value='Closed'>Closed</option>

                                </select>
                            </label>



                            </label>
                            <label class="radio-inline">

                                <a class="btn btn-success  btn-sm" onclick='LoadEnquiryRegister();'>View</a>
                                

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