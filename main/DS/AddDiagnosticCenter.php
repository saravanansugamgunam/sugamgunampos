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
    <link href="../assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <script src="../assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

<body onload="Reset();">
    <!-- begin #page-loader -->

    <div id="myModalReturn" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Diagnosis</h4>
                </div>

                <div class="modal-body">
                    <input hidden='text' id='txtDisgnosisID' name='txtDisgnosisID' />
                    <label></label>

                    <input hidden='text' id='txtDisgnosisStatus' name='txtDisgnosisStatus' />
                    <br>

                    <table>
                        <tr>
                            <td>Diagnosis</td>
                            <td><input type='text' id='txtDisgnosisUpdatedName' name='txtDisgnosisUpdatedName' /></td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td><label class="col-md-1 control-label">Status</label></td>
                            <td><label class="radio-inline">
                                    <input type="radio" id='rdActive' name="rdDiagnosisStatus" value="Active" checked />
                                    Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id='rdInActive' name="rdDiagnosisStatus" value="In Active " />
                                    In Active
                                </label>
                            </td>
                        </tr>
                    </table>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" onclick="UpdateDiagnosis();"
                        data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script>
    function UpdateDiagnosis() {
        var DiagnosisStatus = $("input[name='rdDiagnosisStatus']:checked").val();
        var UpdatedDiagnosisName = document.getElementById("txtDisgnosisUpdatedName").value;
        var DiagnosisID = document.getElementById("txtDisgnosisID").value;
        var datas = "&DiagnosisID=" + encodeURIComponent(DiagnosisID) +
            "&UpdatedDiagnosisName=" + encodeURIComponent(UpdatedDiagnosisName) +
            "&DiagnosisStatus=" + encodeURIComponent(DiagnosisStatus);

        $.ajax({
            url: "Save/UpdateDiagnosis.php",
            method: "POST",
            data: datas,
            success: function(data) {

                if (data == "Added Successfuly") {
                    swal("Diagnosis!", data, "success");
                    Reset();
                } else {
                    swal("Alert!", data, "warning");
                    Reset();
                }


            }
        });
    }
    </script>


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
        function SaveDiagnosticCenter() {

            var DiagnosticCenterID = document.getElementById("txtDiagnosticCenterID").value;
            var DiagnosticCenterName = document.getElementById("txtDiagnosticCenterName").value;
            var Address = document.getElementById("txtAddress").value;
            var City = document.getElementById("txtCity").value;
            var State = document.getElementById("txtState").value;
            var Pincode = document.getElementById("txtPincode").value;
            var ContactNo = document.getElementById("txtContactNo").value;
            var EmailID = document.getElementById("txtEmailID").value;
            var ContactPerson = document.getElementById("txtContactPerson").value;
            var ActiveStatus = document.getElementById("cmbActiveStatus").value;

            if (DiagnosticCenterName == "") {

                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {
                var datas = "&DiagnosticCenterName=" + DiagnosticCenterName +
                    "&DiagnosticCenterID=" + DiagnosticCenterID +
                    "&Address=" + Address +
                    "&City=" + City +
                    "&State=" + State +
                    "&Pincode=" + Pincode +
                    "&ContactNo=" + ContactNo +
                    "&EmailID=" + EmailID +
                    "&ContactPerson=" + ContactPerson +
                    "&ActiveStatus=" + ActiveStatus;

                $.ajax({
                    url: "Save/SaveDiagnosticCenter.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {


                        if (data == "1") {
                            swal("Diatnostic Center Added!", "Center Details Updated", "success");
                            Reset();
                        } else {
                            swal("Alert!", "Error adding center details", "warning");
                            Reset();
                        }


                    }
                });
            }

        }

        function LoadDiagnosticCenterList() {
            var Dumy = 0;

            var datas = "&Dumy=" + Dumy;

            $.ajax({
                url: "Load/LoadDiagnosticCenterList.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivDiagnosticCenter').html(data);


                }
            });
        }

        function GetCenterDetails(x) {
            var CenterID = x;

            var datas = "&CenterID=" + CenterID;

            $.ajax({
                url: "Load/LoadDiagnosticCenterDetails.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    document.getElementById("txtDiagnosticCenterID").value = data[0];
                    document.getElementById("txtDiagnosticCenterName").value = data[1];
                    document.getElementById("txtAddress").value = data[2];
                    document.getElementById("txtCity").value = data[3];
                    document.getElementById("txtState").value = data[4];
                    document.getElementById("txtPincode").value = data[5];
                    document.getElementById("txtContactNo").value = data[6];
                    document.getElementById("txtEmailID").value = data[7];
                    document.getElementById("txtContactPerson").value = data[8];
                    document.getElementById("cmbActiveStatus").value = data[9];
                }
            });
        }




        function Reset() {
            LoadDiagnosticCenterList();

            document.getElementById("txtDiagnosticCenterID").value = '';
            document.getElementById("txtDiagnosticCenterName").value = '';
            document.getElementById("txtAddress").value = '';
            document.getElementById("txtCity").value = '';
            document.getElementById("txtState").value = '';
            document.getElementById("txtPincode").value = '';
            document.getElementById("txtContactNo").value = '';
            document.getElementById("txtEmailID").value = '';
            document.getElementById("txtContactPerson").value = '';
            document.getElementById("cmbActiveStatus").value = '';

        }
        </script>

        <div id="content" class="content">
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-5">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Diagnostic Center</h4>
                            <input type='hidden' id='txtDiagnosticCenterID' name='txtDiagnosticCenterID' />
                        </div>

                        <div class="panel-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Center Name</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder=""
                                            id='txtDiagnosticCenterName' name='txtDiagnosticCenterName' />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Address</label>
                                    <div class="col-md-6">
                                        <textarea class='form-control' name='txtAddress' id='txtAddress'></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">City</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtCity'
                                            name='txtCity' />
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">State</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtState'
                                            name='txtState' />
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Pincode</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtPincode'
                                            name='txtPincode' />
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-md-3 control-label">Contact No</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtContactNo'
                                            name='txtContactNo' />
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-md-3 control-label">Email ID</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtEmailID'
                                            name='txtEmailID' />
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-md-3 control-label">Contact Person</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtContactPerson'
                                            name='txtContactPerson' />
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-md-3 control-label">Active Status</label>
                                    <div class="col-md-6">
                                        <select class='form-control' id='cmbActiveStatus' name='cmbActiveStatus'>
                                            <option value='Active'>Active</option>
                                            <option value='In Active'>In Active</option>
                                        </select>
                                    </div>
                                </div>

                            </form>
                            <center>
                                <button onclick='SaveDiagnosticCenter()' class='btn btn-success'> Add
                                    Center</button>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Diagnostic Center List</h4>
                        </div>

                        <div class="panel-body">
                            <form class="form-horizontal">
                                <div id="DivDiagnosticCenter" style="display: ;"></div>
                            </form>
                        </div>
                    </div>



                    <!-- end panel -->
                </div>
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

    });
    </script>
</body>
<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->

</html>