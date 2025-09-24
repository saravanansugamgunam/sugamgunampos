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
            <?php include("AMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->

        <script>
        function Reset() {

            LoadPermissionLog();
        }


        function LoadPermissionLog() {

            var FromDate = document.getElementById("dtFromDateReport").value;
            var ToDate = document.getElementById("dtToDateReprt").value;
            var EmployeeCode = document.getElementById("cmbEmployee").value;
            var ReportType = document.getElementById("cmbReportType").value;
            var Period = document.getElementById("cmbPeriod").value;


            var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate +
                "&EmployeeCode=" + EmployeeCode + "&ReportType=" + ReportType +
                "&Period=" + Period;

            // alert(datas);
            $.ajax({
                url: "Load/LoadPermissionLog.php",
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


        function UpdateLeaveDetails() {

            var EmployeeCode = document.getElementById("cmbEmployeetoAdd").value;
            var FromDate = document.getElementById("dtFromDate").value;

            var ToDate = document.getElementById("dtToDate").value;
            var TotalDays = document.getElementById("txtTotalDays").value;
            var Remarks = document.getElementById("txtRemarks").value;
            var Type = "L";

            if (EmployeeCode == '' || FromDate == '' || ToDate == '' || TotalDays == '0') {

                swal("Alert", "Please Fill all mandatory details!", "warning");
            } else {
                var datas = "&EmployeeCode=" + EmployeeCode +
                    "&FromDate=" + FromDate +
                    "&ToDate=" + ToDate +
                    "&Remarks=" + Remarks +
                    "&Type=" + Type +
                    "&TotalDays=" + TotalDays;

                $.ajax({
                    url: "Save/UpdateLeaveDetails.php",
                    method: "POST",
                    data: datas,

                    success: function(data) {
                        if (data == 1) {
                            swal("Sucess", "Leave Details Updated Sucessfully!", "success");
                            LoadPermissionLog();
                        } else {
                            swal("Alert", "Error Saving Leave Details, Please try again!", "error");

                        }
                    }
                });
            }




        }


        function UpdateWeekoffDetails() {

            var EmployeeCode = document.getElementById("cmbEmployeetoAddWeekoff").value;
            var FromDate = document.getElementById("dtFromDateWeekoff").value;

            var ToDate = document.getElementById("dtFromDateWeekoff").value;
            var TotalDays = '1';
            var Remarks = document.getElementById("txtRemarksWeekoff").value;
            var Type = "W";

            if (EmployeeCode == '' || FromDate == '' || ToDate == '' || TotalDays == '0') {

                swal("Alert", "Please Fill all mandatory details!", "warning");
            } else {
                var datas = "&EmployeeCode=" + EmployeeCode +
                    "&FromDate=" + FromDate +
                    "&ToDate=" + ToDate +
                    "&Remarks=" + Remarks +
                    "&Type=" + Type +
                    "&TotalDays=" + TotalDays;

                $.ajax({
                    url: "Save/UpdateLeaveDetails.php",
                    method: "POST",
                    data: datas,

                    success: function(data) {
                        if (data == 1) {
                            swal("Sucess", "Leave Details Updated Sucessfully!", "success");
                            LoadPermissionLog();
                        } else {
                            swal("Alert", "Error Saving Leave Details, Please try again!", "error");

                        }
                    }
                });
            }




        }

        function GetPermissionCount() {
            var EmployeeCode = document.getElementById("cmbEmployeetoAddPermission").value;

            var datas = "&EmployeeCode=" + EmployeeCode;


            $.ajax({
                url: "Load/LoadPermissionCount.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#txtTotalPermissions").val(data[0]);

                }

            });
        }

        function UpdatePermissionDetails() {

            var EmployeeCode = document.getElementById("cmbEmployeetoAddPermission").value;
            var FromDate = document.getElementById("dtFromDatePermission").value;

            var ToDate = document.getElementById("dtToDatePermission").value;
            var TotalDays = document.getElementById("txtTotalDaysPermission").value;
            var Remarks = document.getElementById("txtRemarksPermission").value;
            var PermissionCount = document.getElementById("txtTotalPermissions").value;
            var TotalHours = parseInt(TotalDays);

            var Type = "P";

            if (PermissionCount > 1) {
                swal("Alert", "Already 2 Permissions granted, Can't give more!", "error");
            } else if (TotalHours > 2) {
                swal("Alert", "Permission Can't given more than 2 Hours", "error");
            } else {
                if (EmployeeCode == '' || FromDate == '' || ToDate == '' || TotalDays == '0') {

                    swal("Alert", "Please Fill all mandatory details!", "warning");
                } else {
                    var datas = "&EmployeeCode=" + EmployeeCode +
                        "&FromDate=" + FromDate +
                        "&ToDate=" + ToDate +
                        "&Remarks=" + Remarks +
                        "&Type=" + Type +
                        "&TotalDays=" + TotalDays;

                    $.ajax({
                        url: "Save/UpdateLeaveDetails.php",
                        method: "POST",
                        data: datas,

                        success: function(data) {
                            alert(data);
                            if (data == 1) {
                                swal("Sucess", "Permission Details Updated sucessfully!", "success");
                                LoadPermissionLog();
                            } else {
                                // swal("Alert", "Error Saving Permission Details, Please try again!", "error");
                                swal("Alert", data, "error");

                            }
                        }
                    });
                }
            }
        }

        function disablePastDates() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("dtFromDateWeekoff").setAttribute("min", today);
            document.getElementById("dtFromDate").setAttribute("min", today);
            document.getElementById("dtToDate").setAttribute("min", today);
            document.getElementById("dtToDatePermission").setAttribute("min", today);
            document.getElementById("dtFromDatePermission").setAttribute("min", today);

        }
        </script>


        <style>
        .bootstrap-select:not([class*="span"]):not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 320px;
        }
        </style>


        <div id="ModalWeekOff" class="modal fade" role="dialog">
            <div class="modal-dialog ">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Week Off Details</h4>
                    </div>

                    <div class="modal-body">

                        <label>
                            Employee
                        </label>
                        <select class='form-control' id='cmbEmployeetoAddWeekoff' name='cmbEmployeetoAddWeekoff'
                            style="width: 150px;">
                            <option value=''>-</option>

                            <?php  
                            $sqli = "SELECT userid,username FROM usermaster where designationid not in ('9') and  activestatus='Active'";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value='.$row['userid'].'>'.$row['username'].'</option>';
                              }	
                            ?>
                        </select>
                        <br>
                        <div class="form-group">
                            <label>
                                Date
                            </label>
                            <input type='date' id='dtFromDateWeekoff' name='dtFromDateWeekoff' class="form-control"
                                style='width:150px;' onchange='UpdateTotalDays();'
                                value='<?php echo date('Y-m-d'); ?>' />
                            <br>

                            Total Days
                            </label>
                            <input type='text' id='txtTotalDaysWeekoff' name='txtTotalDaysWeekoff' class="form-control"
                                style='width:150px; ' disabled value='1' /></b>
                            <br>

                        </div>
                        <label>
                            Remarks
                        </label>
                        <textarea class='form-control' id='txtRemarksWeekoff' name='txtRemarksWeekoff'>

                            </textarea>



                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-success" data-dismiss="modal"
                            onclick='UpdateWeekoffDetails()'>Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <div id="ModalLeave" class="modal fade" role="dialog">
            <div class="modal-dialog ">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Leave Details</h4>
                    </div>

                    <div class="modal-body">

                        <label>
                            Employee
                        </label>
                        <select class='form-control' id='cmbEmployeetoAdd' name='cmbEmployeetoAdd'
                            style="width: 150px;">
                            <option value=''>-</option>

                            <?php  
                            $sqli = "SELECT userid,username FROM usermaster where designationid not in ('9') and  activestatus='Active'";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value='.$row['userid'].'>'.$row['username'].'</option>';
                              }	
                            ?>
                        </select>
                        <br>
                        <div class="form-group">
                            <label>
                                From Date
                            </label>
                            <input type='date' id='dtFromDate' name='dtFromDate' class="form-control"
                                style='width:150px;' onchange='UpdateTotalDays();'
                                value='<?php echo date('Y-m-d'); ?>' />
                            <br>
                            <label>
                                To Date
                            </label>
                            <input type='date' id='dtToDate' name='dtToDate' class="form-control" style='width:150px; '
                                onchange='UpdateTotalDays();' value='<?php echo date('Y-m-d'); ?>' /></b>
                            <br> <label>
                                Total Days
                            </label>
                            <input type='text' id='txtTotalDays' name='txtTotalDays' class="form-control"
                                style='width:150px; ' disabled value='1' /></b>
                            <br>

                        </div>
                        <label>
                            Remarks
                        </label>
                        <textarea class='form-control' id='txtRemarks' name='txtRemarks'>

                            </textarea>



                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-success" data-dismiss="modal"
                            onclick='UpdateLeaveDetails()'>Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <div id="ModalPermission" class="modal fade" role="dialog">
            <div class="modal-dialog ">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Permission Details</h4>
                        <input type='hidden' id='txtTotalPermissions' name='txtTotalPermissions'>
                    </div>

                    <div class="modal-body">

                        <label>
                            Employee
                        </label>
                        <select class='form-control' id='cmbEmployeetoAddPermission' name='cmbEmployeetoAddPermission'
                            style="width: 150px;" onchange='GetPermissionCount()'>
                            <option value=''>-</option>

                            <?php  
                            $sqli = "SELECT userid,username FROM usermaster where designationid not in ('9') and  activestatus='Active'";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value='.$row['userid'].'>'.$row['username'].'</option>';
                              }	
                            ?>
                        </select>
                        <br>
                        <div class="form-group">
                            <label>
                                From Date
                            </label>
                            <input type='time' id='dtFromDatePermission' name='dtFromDatePermission'
                                class="form-control" style='width:150px;' onblur='UpdateTotalTime();'
                                value='<?php echo date('H:i:s'); ?>' />
                            <br>
                            <label>
                                To Date
                            </label>
                            <input type='time' id='dtToDatePermission' name='dtToDatePermission' class="form-control"
                                style='width:150px; ' onblur='UpdateTotalTime();'
                                value='<?php echo date('H:i:s'); ?>' /></b>
                            <br> <label>
                                Total Time
                            </label>
                            <input type='text' id='txtTotalDaysPermission' name='txtTotalDaysPermission'
                                class="form-control" style='width:150px; ' disabled value='1' /></b>
                            <br>

                        </div>
                        <label>
                            Remarks
                        </label>
                        <textarea class='form-control' id='txtRemarksPermission' name='txtRemarksPermission'>

                            </textarea>



                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-success" data-dismiss="modal"
                            onclick='UpdatePermissionDetails()'>Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>


        <script>
        function diff(start, end) {
            start = start.split(":");
            end = end.split(":");
            var startDate = new Date(0, 0, 0, start[0], start[1], 0);
            var endDate = new Date(0, 0, 0, end[0], end[1], 0);
            var diff = endDate.getTime() - startDate.getTime();
            var hours = Math.floor(diff / 1000 / 60 / 60);
            diff -= hours * 1000 * 60 * 60;
            var minutes = Math.floor(diff / 1000 / 60);

            // If using time pickers with 24 hours format, add the below line get exact hours
            if (hours < 0)
                hours = hours + 24;

            return (hours <= 9 ? "0" : "") + hours + ":" + (minutes <= 9 ? "0" : "") + minutes;
        }


        function UpdateTotalTime() {
            var FromTime = document.getElementById("dtFromDatePermission").value;
            var ToTime = document.getElementById("dtToDatePermission").value;

            document.getElementById("txtTotalDaysPermission").value = diff(FromTime, ToTime); // TotalTime;

        }

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


                            <h4 class="panel-title">Leave & Permission

                                <a class="btn btn-warning  btn-xs" style='float:right'
                                    onclick='PrintReport();'>Print</a>

                            </h4>

                        </div>


                        <br>

                        <div class="form-group">

                            <label class="radio-inline"> Period

                                <select class="js-states form-control" tabindex="-1" id='cmbPeriod' name='cmbPeriod'
                                    onchange='ShowHideDiv();' disabled>

                                    <option value="Today">Today</option>
                                    <option value="Yesterday">Yesterday</option>
                                    <option selected value="CurrentMonth">Current Month</option>
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
                                Employee
                                <select class='form-control' id='cmbEmployee' name='cmbEmployee' style="width: 150px;">
                                    <option value='%'>All</option>

                                    <?php  
                            $sqli = "SELECT userid,username FROM usermaster where designationid not in ('9') and  activestatus='Active'";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value='.$row['userid'].'>'.$row['username'].'</option>';
                              }	
                            ?>
                                </select>

                            </label>


                            <label class="radio-inline">
                                Type
                                <select class='form-control' id='cmbReportType' name='cmbReportType'
                                    style="width: 150px;">
                                    <option value='%'>All </option>
                                    <option value='P'>Permission </option>
                                    <option value='L'>Leave </option>
                                    <option value='W'>Weekly Off </option>

                                </select>

                            </label>





                            <label class="radio-inline">

                                <a class="btn btn-success  btn-sm" onclick='LoadPermissionLog();'>View</a>


                            </label>
                            <label class="radio-inline" style='float:right'>
                                <a class="btn btn-primary  btn-sm" href='#ModalLeave' data-toggle='modal'
                                    onclick='disablePastDates_1()'>Add
                                    Leave</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                            </label>

                            <label class="radio-inline" style='float:right'>
                                <a class="btn btn-success  btn-sm" href='#ModalWeekOff' data-toggle='modal'
                                    onclick='disablePastDates_1()'>Add
                                    Week Off</a>



                            </label>


                            <label class="radio-inline" style='float:right'>
                                <a class="btn btn-danger  btn-sm" href='#ModalPermission' data-toggle='modal'
                                    onclick='disablePastDates_1()'>Add
                                    Permission</a>



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