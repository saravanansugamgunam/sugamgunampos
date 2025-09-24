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
            <?php include("CLMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->

        <script>
        function LoadInvoiceNo() {

            var InvoiceNo = new Date().getTime();
            document.getElementById("txtInvoiceNo").value = InvoiceNo;

            LoadTimeSlotDetails();

        }




        function Reset() {
            document.getElementById("txtAmount").value = '';
            document.getElementById("txtRemarks").value = '';

            $("#cmbGroup").val('default');
            $(cmbGroup).selectpicker("refresh");

            $("#cmbDoctorCode").val('default');
            $(cmbDoctorCode).selectpicker("refresh");
            document.getElementById("cmbDoctorCode").focus();
            LoadIncomeExpenseList();
        }





        function LoadTimeSlotDetails() {

            var userid = document.getElementById("cmbDoctor").value;

            var FromDate = document.getElementById("dtFromDateReport").value;

            var ToDate = document.getElementById("dtToDateReprt").value;

            var datas = "&userid=" + userid + "&FromDate=" + FromDate + "&ToDate=" + ToDate;

            $.ajax({
                url: "Load/LoadTimeSlotDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivPaymentHistory').html(data);
                }
            });
        }

        function DeleteTimeSlot(x) {

            var SlotID = x;

            var datas = "&SlotID=" + SlotID;

            $.ajax({
                url: "Delete/DeleteTimeSlot.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    LoadTimeSlotDetails();
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

        function LoadScheduleDetails(x) {
            var DoctorCode = x;
            document.getElementById("txtDoctorCode").value = x;

            var datas = "&DoctorCode=" + DoctorCode;

            $.ajax({
                url: "Load/LoadOnlineSchedule.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    if (data[0] == 'Sunday') {
                        $("#cmbSlotActive1D1").val('Yes');
                    } else {
                        $("#cmbSlotActive1D1").val('No');
                    }

                    if (data[1] == 'Monday') {
                        $("#cmbSlotActive1D2").val('Yes');
                    } else {
                        $("#cmbSlotActive1D2").val('No');
                    }

                    if (data[2] == 'Tuesday') {
                        $("#cmbSlotActive1D3").val('Yes');
                    } else {
                        $("#cmbSlotActive1D3").val('No');
                    }

                    if (data[3] == 'Wednesday') {
                        $("#cmbSlotActive1D4").val('Yes');
                    } else {
                        $("#cmbSlotActive1D4").val('No');
                    }

                    if (data[4] == 'Thursday') {
                        $("#cmbSlotActive1D5").val('Yes');
                    } else {
                        $("#cmbSlotActive1D5").val('No');
                    }

                    if (data[5] == 'Friday') {
                        $("#cmbSlotActive1D6").val('Yes');
                    } else {
                        $("#cmbSlotActive1D6").val('No');
                    }

                    if (data[6] == 'Saturday') {
                        $("#cmbSlotActive1D7").val('Yes');
                    } else {
                        $("#cmbSlotActive1D7").val('No');
                    }

                    $("#txtSession1D1").val(data[7]);
                    $("#txtSession1D2").val(data[8]);
                    $("#txtSession1D3").val(data[9]);
                    $("#txtSession1D4").val(data[10]);
                    $("#txtSession1D5").val(data[11]);
                    $("#txtSession1D6").val(data[12]);
                    $("#txtSession1D7").val(data[13]);


                    if (data[14] == 'Sunday') {
                        $("#cmbSlotActive2D1").val('Yes');
                    } else {
                        $("#cmbSlotActive2D1").val('No');
                    }

                    if (data[15] == 'Monday') {
                        $("#cmbSlotActive2D2").val('Yes');
                    } else {
                        $("#cmbSlotActive2D2").val('No');
                    }

                    if (data[16] == 'Tuesday') {
                        $("#cmbSlotActive2D3").val('Yes');
                    } else {
                        $("#cmbSlotActive2D3").val('No');
                    }

                    if (data[17] == 'Wednesday') {
                        $("#cmbSlotActive2D4").val('Yes');
                    } else {
                        $("#cmbSlotActive2D4").val('No');
                    }

                    if (data[18] == 'Thursday') {
                        $("#cmbSlotActive2D5").val('Yes');
                    } else {
                        $("#cmbSlotActive2D5").val('No');
                    }

                    if (data[19] == 'Friday') {
                        $("#cmbSlotActive2D6").val('Yes');
                    } else {
                        $("#cmbSlotActive2D6").val('No');
                    }

                    if (data[20] == 'Saturday') {
                        $("#cmbSlotActive2D7").val('Yes');
                    } else {
                        $("#cmbSlotActive2D7").val('No');
                    }

                    $("#txtSession2D1").val(data[21]);
                    $("#txtSession2D2").val(data[22]);
                    $("#txtSession2D3").val(data[23]);
                    $("#txtSession2D4").val(data[24]);
                    $("#txtSession2D5").val(data[25]);
                    $("#txtSession2D6").val(data[26]);
                    $("#txtSession2D7").val(data[27]);



                    if (data[28] == 'Sunday') {
                        $("#cmbSlotActive3D1").val('Yes');
                    } else {
                        $("#cmbSlotActive3D1").val('No');
                    }

                    if (data[29] == 'Monday') {
                        $("#cmbSlotActive3D2").val('Yes');
                    } else {
                        $("#cmbSlotActive3D2").val('No');
                    }

                    if (data[30] == 'Tuesday') {
                        $("#cmbSlotActive3D3").val('Yes');
                    } else {
                        $("#cmbSlotActive3D3").val('No');
                    }

                    if (data[31] == 'Wednesday') {
                        $("#cmbSlotActive3D4").val('Yes');
                    } else {
                        $("#cmbSlotActive3D4").val('No');
                    }

                    if (data[32] == 'Thursday') {
                        $("#cmbSlotActive3D5").val('Yes');
                    } else {
                        $("#cmbSlotActive3D5").val('No');
                    }

                    if (data[33] == 'Friday') {
                        $("#cmbSlotActive3D6").val('Yes');
                    } else {
                        $("#cmbSlotActive3D6").val('No');
                    }

                    if (data[34] == 'Saturday') {
                        $("#cmbSlotActive3D7").val('Yes');
                    } else {
                        $("#cmbSlotActive3D7").val('No');
                    }

                    $("#txtSession3D1").val(data[35]);
                    $("#txtSession3D2").val(data[36]);
                    $("#txtSession3D3").val(data[37]);
                    $("#txtSession3D4").val(data[38]);
                    $("#txtSession3D5").val(data[39]);
                    $("#txtSession3D6").val(data[40]);
                    $("#txtSession3D7").val(data[41]);

                    LoadExceptionalDate();

                }
            });


        }

        function SaveTimeSlot() {

            var DoctorCode = document.getElementById("txtDoctorCode").value;

            var SlotActive1ID1 = document.getElementById("cmbSlotActive1D1").value;
            var SlotActive1ID2 = document.getElementById("cmbSlotActive1D2").value;
            var SlotActive1ID3 = document.getElementById("cmbSlotActive1D3").value;
            var SlotActive1ID4 = document.getElementById("cmbSlotActive1D4").value;
            var SlotActive1ID5 = document.getElementById("cmbSlotActive1D5").value;
            var SlotActive1ID6 = document.getElementById("cmbSlotActive1D6").value;
            var SlotActive1ID7 = document.getElementById("cmbSlotActive1D7").value;
            var TotalToken1D1 = document.getElementById("txtSession1D1").value;
            var TotalToken1D2 = document.getElementById("txtSession1D2").value;
            var TotalToken1D3 = document.getElementById("txtSession1D3").value;
            var TotalToken1D4 = document.getElementById("txtSession1D4").value;
            var TotalToken1D5 = document.getElementById("txtSession1D5").value;
            var TotalToken1D6 = document.getElementById("txtSession1D6").value;
            var TotalToken1D7 = document.getElementById("txtSession1D7").value;

            var SlotActive2ID1 = document.getElementById("cmbSlotActive2D1").value;
            var SlotActive2ID2 = document.getElementById("cmbSlotActive2D2").value;
            var SlotActive2ID3 = document.getElementById("cmbSlotActive2D3").value;
            var SlotActive2ID4 = document.getElementById("cmbSlotActive2D4").value;
            var SlotActive2ID5 = document.getElementById("cmbSlotActive2D5").value;
            var SlotActive2ID6 = document.getElementById("cmbSlotActive2D6").value;
            var SlotActive2ID7 = document.getElementById("cmbSlotActive2D7").value;
            var TotalToken2D1 = document.getElementById("txtSession2D1").value;
            var TotalToken2D2 = document.getElementById("txtSession2D2").value;
            var TotalToken2D3 = document.getElementById("txtSession2D3").value;
            var TotalToken2D4 = document.getElementById("txtSession2D4").value;
            var TotalToken2D5 = document.getElementById("txtSession2D5").value;
            var TotalToken2D6 = document.getElementById("txtSession2D6").value;
            var TotalToken2D7 = document.getElementById("txtSession2D7").value;

            var SlotActive3ID1 = document.getElementById("cmbSlotActive3D1").value;
            var SlotActive3ID2 = document.getElementById("cmbSlotActive3D2").value;
            var SlotActive3ID3 = document.getElementById("cmbSlotActive3D3").value;
            var SlotActive3ID4 = document.getElementById("cmbSlotActive3D4").value;
            var SlotActive3ID5 = document.getElementById("cmbSlotActive3D5").value;
            var SlotActive3ID6 = document.getElementById("cmbSlotActive3D6").value;
            var SlotActive3ID7 = document.getElementById("cmbSlotActive3D7").value;
            var TotalToken3D1 = document.getElementById("txtSession3D1").value;
            var TotalToken3D2 = document.getElementById("txtSession3D2").value;
            var TotalToken3D3 = document.getElementById("txtSession3D3").value;
            var TotalToken3D4 = document.getElementById("txtSession3D4").value;
            var TotalToken3D5 = document.getElementById("txtSession3D5").value;
            var TotalToken3D6 = document.getElementById("txtSession3D6").value;
            var TotalToken3D7 = document.getElementById("txtSession3D7").value;

            if (DoctorCode == "") {

                swal("Alert!", " Fill All details", "warning");

            } else {


                var datas = "&DoctorCode=" + DoctorCode +

                    "&SlotActive1ID1=" + SlotActive1ID1 +
                    "&SlotActive1ID2=" + SlotActive1ID2 +
                    "&SlotActive1ID3=" + SlotActive1ID3 +
                    "&SlotActive1ID4=" + SlotActive1ID4 +
                    "&SlotActive1ID5=" + SlotActive1ID5 +
                    "&SlotActive1ID6=" + SlotActive1ID6 +
                    "&SlotActive1ID7=" + SlotActive1ID7 +

                    "&TotalToken1D1=" + TotalToken1D1 +
                    "&TotalToken1D2=" + TotalToken1D2 +
                    "&TotalToken1D3=" + TotalToken1D3 +
                    "&TotalToken1D4=" + TotalToken1D4 +
                    "&TotalToken1D5=" + TotalToken1D5 +
                    "&TotalToken1D6=" + TotalToken1D6 +
                    "&TotalToken1D7=" + TotalToken1D7 +

                    "&SlotActive2ID1=" + SlotActive2ID1 +
                    "&SlotActive2ID2=" + SlotActive2ID2 +
                    "&SlotActive2ID3=" + SlotActive2ID3 +
                    "&SlotActive2ID4=" + SlotActive2ID4 +
                    "&SlotActive2ID5=" + SlotActive2ID5 +
                    "&SlotActive2ID6=" + SlotActive2ID6 +
                    "&SlotActive2ID7=" + SlotActive2ID7 +

                    "&TotalToken2D1=" + TotalToken2D1 +
                    "&TotalToken2D2=" + TotalToken2D2 +
                    "&TotalToken2D3=" + TotalToken2D3 +
                    "&TotalToken2D4=" + TotalToken2D4 +
                    "&TotalToken2D5=" + TotalToken2D5 +
                    "&TotalToken2D6=" + TotalToken2D6 +
                    "&TotalToken2D7=" + TotalToken2D7 +

                    "&SlotActive3ID1=" + SlotActive3ID1 +
                    "&SlotActive3ID2=" + SlotActive3ID2 +
                    "&SlotActive3ID3=" + SlotActive3ID3 +
                    "&SlotActive3ID4=" + SlotActive3ID4 +
                    "&SlotActive3ID5=" + SlotActive3ID5 +
                    "&SlotActive3ID6=" + SlotActive3ID6 +
                    "&SlotActive3ID7=" + SlotActive3ID7 +

                    "&TotalToken3D1=" + TotalToken3D1 +
                    "&TotalToken3D2=" + TotalToken3D2 +
                    "&TotalToken3D3=" + TotalToken3D3 +
                    "&TotalToken3D4=" + TotalToken3D4 +
                    "&TotalToken3D5=" + TotalToken3D5 +
                    "&TotalToken3D6=" + TotalToken3D6 +
                    "&TotalToken3D7=" + TotalToken3D7;

                $.ajax({
                    url: "Save/SaveTimeSlot.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == 1) {

                            swal("Time slot updated!", "Sucessfully", "success");
                            // swal(data);

                            //  location.reload();
                        } else {
                            swal("Alert!", data, "warning");
                            LoadTimeSlotDetails();

                        }


                    }
                });
            }


        }

        function Deactivate(x) {
            var DoctorCode = x;
            document.getElementById("txtDoctorCodeDeactivate").value = x;


        }

        function UpdateDoctorStatus() {
            var DoctorCode = document.getElementById("txtDoctorCodeDeactivate").value;
            var Status = document.getElementById("cmbDoctorActivate").value;

            var datas = "&DoctorCode=" + DoctorCode + "&Status=" + Status;

            $.ajax({
                url: "Save/UpdateDoctorStatus.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    location.reload();

                }
            });



        }


        function AddExceptionalDate() {
            var ExceptionalDate = document.getElementById("dtExceptionalDate").value;
            var DoctorCode = document.getElementById("txtDoctorCode").value;
            var AllDoctorFlag = document.getElementById("chkExceptionforAll").value;

            var datas = "&ExceptionalDate=" + ExceptionalDate + "&AllDoctorFlag=" + AllDoctorFlag + "&DoctorCode=" +
                DoctorCode;

            $.ajax({
                url: "Save/SaveOnlineExceptionalDates.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    swal("Exceptional Date!", "Sucessfully", "success");
                    location.reload();

                }
            });


        }

        function LoadExceptionalDate() {

            var DoctorCode = document.getElementById("txtDoctorCode").value;


            var datas = "&DoctorCode=" + DoctorCode;

            $.ajax({
                url: "Load/LoadOnlineExceptionalDate.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivExptionalDates').html(data);
                }
            });

        }



        function DeleteExceptionalDate(x) {

            var ExceptionalDateID = x;


            var datas = "&ExceptionalDateID=" + ExceptionalDateID;

            $.ajax({
                url: "Delete/DeleteExceptionalDate.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    LoadExceptionalDate();

                }
            });

        }
        </script>


        <style>
        .bootstrap-select:not([class*="span"]):not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 320px;
        }
        </style>

        <div class="modal fade" id="modal-Deactivate" name="modal-Deactivate">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Activate Doctor </h4>
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->

                            <div class="panel-body">
                                <form class="form-horizontal">


                                    <div class="form-group">
                                        <label></label>
                                        <input type='hidden' id='txtDoctorCodeDeactivate'
                                            name='txtDoctorCodeDeactivate' />


                                        <div class="col-md-12">
                                            <select class='form-control' id='cmbDoctorActivate'>
                                                <option value='1'>Activate</option>
                                                <option value='0'>Deactivate</option>
                                            </select>
                                        </div>

                                        <center>
                                            <br>
                                            <br>
                                            <input type="button" class="btn btn-sm btn-success"
                                                onClick="UpdateDoctorStatus();" value='Save'>
                                        </center>



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





        <div id="content" class="content">
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-5">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">

                            <h4 class="panel-title">Doctor Details</h4>
                        </div>
                        <div class="panel-body">
                            <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' />
                            <form class="form-horizontal">

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <table class='table'>
                                            <th>S.No</th>
                                            <th hidden>Code</th>
                                            <th>Doctor</th>
                                            <th>Status</th>
                                            <th> </th>
                                            <tbody>

                                                <?php  
                            $sqli = "SELECT userid,username,onlinebookingstatus FROM usermaster
                             WHERE designationid in('9') and userid <>'33'  and  activestatus ='Active' ";
                            $result = mysqli_query($connection, $sqli); 

                            $SerialNo = 1;
                            while($data = mysqli_fetch_row($result))
                            {
                                echo "<tr>";
                                echo "<td>$SerialNo</td>"; 
                                echo "<td hidden>$data[0]</td>"; 
                                echo "<td>$data[1]</td>";
                                if($data[2]==0) 
                                {
                                    echo "<td onclick='Deactivate($data[0])' style='cursor:pointer'>
                                    <a href='#modal-Deactivate' data-toggle='modal'  >
                                        In Active</a>
                                        </td>"; 
                                }
                                else
                                {
                                    echo "<td onclick='Deactivate($data[0])' style='cursor:pointer'>
                                    <a href='#modal-Deactivate' data-toggle='modal' >
                                        Active</a>
                                        </td>"; 
                                }
                               
                                echo "<td onclick='LoadScheduleDetails($data[0])' style='cursor:pointer'>
                                <input type='button' class='btn btn-sm btn-success' value='Schedule'>
                                 </td>"; 
                                echo "</tr>";
                                $SerialNo=$SerialNo+1; 
                            }
 
                            ?>
                                            </tbody>
                                        </table>
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

                            <h4 class="panel-title">Time Slot Details</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <input type='hidden' id='txtDoctorCode' />
                                <table class='table'>
                                    <th>Session</th>
                                    <th>Sun</th>
                                    <th>Mon</th>
                                    <th>Tue</th>
                                    <th>Wed</th>
                                    <th>Thu</th>
                                    <th>Fri</th>
                                    <th>Sat</th>

                                    <tr>
                                        <td rowspan=1 style="vertical-align : middle;text-align:center;"> 08 AM - 11 AM
                                        </td>
                                        <td><select id='cmbSlotActive3D1'>
                                                <option>Yes</option>
                                                <option selected>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive3D2'>
                                                <option>Yes</option>
                                                <option selected>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive3D3'>
                                                <option>Yes</option>
                                                <option selected>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive3D4'>
                                                <option>Yes</option>
                                                <option selected>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive3D5'>
                                                <option>Yes</option>
                                                <option selected>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive3D6'>
                                                <option>Yes</option>
                                                <option selected>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive3D7'>
                                                <option>Yes</option>
                                                <option selected>No</option>
                                            </select></td>

                                    </tr>

                                    <tr>
                                        <td rowspan=1 style="vertical-align : middle;text-align:center;"> 11 AM - 01 PM
                                        </td>
                                        <td><select id='cmbSlotActive1D1'>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive1D2'>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive1D3'>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive1D4'>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive1D5'>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive1D6'>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive1D7'>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>

                                    </tr>


                                    <tr>
                                        <td rowspan=1 style="vertical-align : middle;text-align:center;"> 05 PM - 07 PM
                                        </td>
                                        <td><select id='cmbSlotActive2D1'>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive2D2'>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive2D3'>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive2D4'>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive2D5'>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive2D6'>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>
                                        <td><select id='cmbSlotActive2D7'>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select></td>

                                    </tr>




                                    <tr hidden>
                                        <td><input type='number' value=30 id='txtSession3D1' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession3D2' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession3D3' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession3D4' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession3D5' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession3D6' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession3D7' style='width:45px;' /></td>

                                    </tr>


                                    <tr hidden>
                                        <td><input type='number' value=30 id='txtSession1D1' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession1D2' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession1D3' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession1D4' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession1D5' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession1D6' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession1D7' style='width:45px;' /></td>


                                    </tr>

                                    <tr hidden>
                                        <td><input type='number' value=30 id='txtSession2D1' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession2D2' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession2D3' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession2D4' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession2D5' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession2D6' style='width:45px;' /></td>
                                        <td><input type='number' value=30 id='txtSession2D7' style='width:45px;' /></td>


                                    </tr>
                                </table>

                                <hr>

                                <div class="col-md-12">
                                    <center>
                                        <input type="button" class="btn btn-sm btn-success" onClick="SaveTimeSlot();"
                                            value='Save Schedule'>
                                    </center>

                                </div>

                                <hr>
                                <hr>
                                <hr>

                                <h5><u>Exceptional Dates</u></h5>
                                <div class="form-group col-md-12">
                                    <label class="col-md-1 control-label">Period</label>

                                    <div class="col-md-3">
                                        <input type="date" class="form-control" placeholder="" id='dtExceptionalDate'
                                            name='dtExceptionalDate' />

                                    </div>
                                    <div class="col-md-4">
                                        <div class="checkbox">
                                            <label>
                                                <input disabled type="checkbox" id='chkExceptionforAll' value="" />
                                                Apply to All Doctors
                                            </label>
                                        </div>

                                    </div>


                                    <div class="col-md-3">
                                        <input type="button" class="btn btn-sm btn-warning"
                                            onClick="AddExceptionalDate();" value='Add'>

                                    </div>



                                </div>

                                <div id='DivExptionalDates'>

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