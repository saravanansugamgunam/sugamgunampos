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
    <script src="../assets/Custom/IndexTable.js"></script>
    <link href="style/style.css" rel="stylesheet" type="text/css" />

    <style>
    table.blueTable {
        border: 1px solid #1C6EA4;
        background-color: #EEEEEE;
        width: 100%;
        text-align: left;
        border-collapse: collapse;
    }

    table.blueTable td,
    table.blueTable th {
        border: 1px solid #AAAAAA;
        padding: 1px 1px;
        text-align: center;
    }

    table.blueTable tbody td {
        font-size: 13px;
        text-align: center;
    }

    table.blueTable tr:nth-child(even) {
        background: #D0E4F5;
    }

    table.blueTable thead {
        background: #83b3e4;
        background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        border-bottom: 1px solid #444444;
    }

    table.blueTable thead th {
        font-size: 12px;
        font-weight: normal;
        color: #FFFFFF;
        border-left: 1px solid #D0E4F5;
        padding: 5px 10px;

    }

    table.blueTable thead th:first-child {
        border-left: none;
    }

    table.blueTable tfoot {
        font-size: 12px;
        font-weight: bold;
        color: #FFFFFF;
        background: #D0E4F5;
        background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
        background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
        background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
        border-top: 2px solid #444444;
    }

    table.blueTable tfoot td {
        font-size: 12px;
    }

    table.blueTable tfoot .links {
        text-align: right;
    }

    table.blueTable tfoot .links a {
        display: inline-block;
        background: #1C6EA4;
        color: #FFFFFF;
        padding: 2px 5px;
        border-radius: 5px;
    }



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

    html,
    body {
        padding: 0 !important;
    }

    .modal {
        overflow-y: auto;
    }

    .modal-open {
        overflow: auto;
    }

    .modal-open[style] {
        padding-right: 0px !important;
    }
    </style>

</head>

<div id="ModalAddEnquiry" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Enquiry Details</h4>
            </div>

            <div class="modal-body">

                <div class="form-group">


                    <div class="col-md-3">
                        <label class="col-md-12  control-label"><b><u>Enquiry</u></b></label>

                        <select class="form-control" id='cmbEnquiry' name='cmbEnquiry'>
                            <option></option>
                            <?php
                            $sqli = "  SELECT id,enquirylist  FROM enquirylist WHERE activestatus ='Active'";
                            $result = mysqli_query($connection, $sqli);
                            while ($row = mysqli_fetch_array($result)) {
                                # code...

                                echo ' <option value=' . $row['id'] . '>' . $row['enquirylist'] . '</option>';
                            }
                            ?>
                        </select>

                    </div>


                    <div class="col-md-3">
                        <label class="col-md-12  control-label"><b><u>Reference</u></b></label>

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

                    <div class="col-md-3">
                        <label class="col-md-12  control-label"><b><u>Name</u></b></label>
                        <input type='text' class='form-control' name='txtName' id='txtName' />

                    </div>
                    <div class="col-md-3">
                        <label class="col-md-12  control-label"><b><u>Mobile No</u></b></label>
                        <input type='text' class='form-control' name='txtMobileNo' id='txtMobileNo' />

                    </div>
                    <div class="col-md-3">
                        <label class="col-md-12  control-label"><b><u>Followup Date</u></b></label>
                        <input
                            style='border-width: 0px; border-style: inset;  border-radius: 1px; border-bottom: 2px solid grey; '
                            type='date' id='dtNextAppointment' name='dtNextAppointment' />

                    </div>
                </div>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

                <label class="col-md-3 control-label">Remarks</label>
                <textarea id='txtRemarks' name='txtRemarks' class='form-control' rows=5></textarea>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-success" onclick='SaveEnquiry()'>Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>


<script>
function SaveEnquiry() {
    var AppointmentDate = document.getElementById("dtNextAppointment").value;
    var Remarks = document.getElementById("txtRemarks").value;
    var Enquiry = document.getElementById("cmbEnquiry").value;
    var MobileNo = document.getElementById("txtMobileNo").value;
    var Name = document.getElementById("txtName").value;
    var Reference = document.getElementById("cmbReference").value;


    var datas = "&AppointmentDate=" + AppointmentDate + "&Remarks=" + Remarks +
        "&Enquiry=" + Enquiry +
        "&MobileNo=" + MobileNo +
        "&Reference=" + Reference +
        "&Name=" + Name;
    // alert(datas);
    $.ajax({
        url: "Save/SaveEnquiry.php",
        method: "POST",
        data: datas,
        success: function(data) {
            window.location.reload();
        }
    });
}
</script>


<body>
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
        <div id="content" class="content">
            <div class="row">


                <div class="col-md-12">

                    <!-- begin panel -->
                    <div class="panel panel-success">
                        <div class="panel-heading">

                            <h4 class="panel-title">Appointment Calendar




                                <input type='hidden' name='txtStatus' id='txtStatus' value='P' />

                            </h4>


                        </div>

                        <div class="panel-body">


                            <link rel="stylesheet"
                                href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js">
                            </script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js">
                            </script>



                            <script>
                            $(document).ready(function() {
                                var status = document.getElementById("txtStatus").value;
                                var LoadURl = 'load.php?sts=';
                                var FinalLoadURl = LoadURl.concat(status);

                                var calendar = $('#calendar').fullCalendar({
                                    editable: true,
                                    eventColor: '#378006',
                                    themeSystem: 'bootstrap5',
                                    header: {
                                        left: 'prev,next today',
                                        center: 'title',
                                        right: 'month,agendaWeek,agendaDay'
                                    },
                                    events: FinalLoadURl, //'load.php?sts='status',
                                    selectable: true,
                                    selectHelper: true,
                                    editable: true,

                                    eventResize: function(event) {
                                        var start = $.fullCalendar.formatDate(event.start,
                                            "Y-MM-DD HH:mm:ss");
                                        var end = $.fullCalendar.formatDate(event.end,
                                            "Y-MM-DD HH:mm:ss");

                                        var title = event.title;
                                        var id = event.id;
                                        $.ajax({
                                            url: "update.php",
                                            type: "POST",
                                            data: {
                                                title: title,
                                                start: start,
                                                end: end,
                                                id: id
                                            },
                                            success: function() {
                                                calendar.fullCalendar('refetchEvents');
                                                alert('Event Update');
                                            }
                                        })
                                    },

                                    eventDrop: function(event) {
                                        var start = $.fullCalendar.formatDate(event.start,
                                            "Y-MM-DD HH:mm:ss");
                                        var end = $.fullCalendar.formatDate(event.end,
                                            "Y-MM-DD HH:mm:ss");
                                        var title = event.title;
                                        var id = event.id;
                                        $.ajax({
                                            url: "update.php",
                                            type: "POST",
                                            data: {
                                                title: title,
                                                start: start,
                                                end: end,
                                                id: id
                                            },
                                            success: function() {
                                                calendar.fullCalendar('refetchEvents');
                                                alert("Event Updated");
                                            }
                                        });
                                    },

                                    eventClick: function(event) {
                                        var id = event.id;
                                        // alert(id);
                                        // window.open(
                                        //       "https://www.geeksforgeeks.org", "_blank");


                                        if (event.url) {
                                            window.open(event.url, "_blank");
                                            return false;
                                        }

                                    },

                                });
                            });
                            </script>

                            <script>
                            function ChangeURL() {

                                var status = document.getElementById("cmbStatus").value;
                                if (status == 'P') {
                                    window.location.href = 'CalendarView.php?MID=62&sts=P';

                                } else {
                                    window.location.href = 'CalendarView.php?MID=62&sts=C';

                                }


                            }
                            </script>


                            <div class="container">

                                <div id="calendar"></div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- end panel -->

                <!-- end panel -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
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