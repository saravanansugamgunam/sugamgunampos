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

<body onload="LoadStaffList();">
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
            <?php include("AMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->
        <script>
        function SaveStaff() {

            var Name = document.getElementById("txtStaffName").value;
            var DOB = document.getElementById("dtDOB").value;
            var DOJ = document.getElementById("dtDOJ").value;
            var Gender = document.getElementById("cmbGender").value;
            var MaritalStatus = document.getElementById("cmbMaritalStatus").value;
            var MobileNo = document.getElementById("txtMobileNo").value;
            var AlternateContactNo = document.getElementById("txtAlternateContactNo").value;
            var Address = document.getElementById("txtAddress").value;
            var Salary = document.getElementById("txtSalary").value;
            var BiometricID = document.getElementById("txtBiometricID").value;
            var Designation = document.getElementById("cmbDesignation").value;

            var Qualification = document.getElementById("txtQualification").value;
            var YearofExp = document.getElementById("txtYearofExp").value;
            var Status = document.getElementById("cmbActiveStatus").value;
            var UserID = document.getElementById("txtUserID").value;
            var Password = document.getElementById("txtPassword").value;
            var HRDocID = document.getElementById("txtHRDocID").value;
            var Mobilecode = document.getElementById("txtMobilecode").value;





            if (Name == "" || MobileNo == "" || Salary == "") {

                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {
                var datas = "&Name=" + Name + "&DOB=" + DOB +
                    "&Gender=" + Gender + "&MaritalStatus=" + MaritalStatus +
                    "&MobileNo=" + MobileNo + "&AlternateContactNo=" + AlternateContactNo +
                    "&Address=" + Address + "&Salary=" + Salary +
                    "&DOJ=" + DOJ + "&Designation=" + Designation + "&BiometricID=" + BiometricID +
                    "&Qualification=" + Qualification +
                    "&Status=" + Status +
                    "&UserID=" + UserID +
                    "&HRDocID=" + HRDocID +
                    "&Password=" + Password +
                    "&Mobilecode=" + Mobilecode +
                    "&YearofExp=" + YearofExp;

                $.ajax({
                    url: "Save/SaveStaff.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == "1") {
                            swal("Sucess!", "Staff details sucess", "success");
                            Reset();
                        } else {
                            swal("Alert!", "Error adding Staff details", "warning");
                            Reset();
                        }


                    }
                });
            }

        }

        function Reset() {
            ClearAll();
            LoadStaffList();
        }

        function LoadStaffList() {

            var Status = document.getElementById("cmbStatusFilter").value;
            var Designation = document.getElementById("cmbDesignationFilter").value;

            var datas = "&Status=" + Status + "&Designation=" + Designation;

            $.ajax({
                url: "Load/LoadStaffList.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivStaffList').html(data);


                }
            });
        }


        function GetPointID(x) {

            document.getElementById("UserID").value = x;
            ResetBiometric();


            // var SelectedColumn = x.cellIndex;
            // var SelectedRow = x.parentNode.rowIndex;


            // var Id = document.getElementById("indextable").rows[SelectedRow].cells.namedItem("tblTaskId").innerHTML; 
            // document.getElementById("txtObservationIDforUploadAttachment").value = Id;
            // document.getElementById("txtSelectedRowForUploadAttachment").value = SelectedRow; 
            // LoadAttachments();


        }
        </script>

        <div class="modal fade" id="modal-dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Add Staff</h4>

                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->

                            <div class="panel-body">
                                <form class="form-horizontal">
                                    <input type='hidden' name='txtUserID' id='txtUserID' />
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Name</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="Staff Name"
                                                id='txtStaffName' name='txtStaffName' />
                                        </div>

                                        <label class="col-md-1 control-label">Gender</label>
                                        <div class="col-md-3">
                                            <Select name="cmbGender" id="cmbGender" class="form-control" />
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Others</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">DOB</label>
                                        <div class="col-md-3">
                                            <input type="date" name="dtDOB" id="dtDOB" placeholder="Smith"
                                                class="form-control" />
                                        </div>
                                        <label class="col-md-2 control-label">Marital Status</label>
                                        <div class="col-md-3">
                                            <Select name="cmbMaritalStatus" id="cmbMaritalStatus"
                                                class="form-control" />
                                            <option>Un Married</option>
                                            <option>Married</option>
                                            <option>Widow</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Mobile No</label>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" placeholder="" id='txtMobileNo'
                                                name='txtMobileNo' />
                                        </div>
                                        <label class="col-md-2 control-label">Alt. Contact No</label>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" placeholder=""
                                                id='txtAlternateContactNo' name='txtAlternateContactNo' />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Joining Date</label>
                                        <div class="col-md-3">
                                            <input type="date" class="form-control" placeholder="" id='dtDOJ'
                                                name='dtDOJ' />
                                        </div>
                                        <label class="col-md-2 control-label">Salary</label>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" placeholder="" id='txtSalary'
                                                name='txtSalary' />
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Qualification</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="" id='txtQualification'
                                                name='txtQualification' />
                                        </div>
                                        <label class="col-md-2 control-label">Year of Exp.</label>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" placeholder="" id='txtYearofExp'
                                                name='txtYearofExp' />
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Biometric ID</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="" id='txtBiometricID'
                                                name='txtBiometricID' />
                                        </div>


                                        <label class="col-md-2 control-label">HRD Doc.ID</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="" id='txtHRDocID'
                                                name='txtHRDocID' />
                                        </div>

                                    </div>


                                    <div class="form-group">

                                        <label class="col-md-3 control-label">Designation</label>
                                        <div class="col-md-3">

                                            <select class="form-control" id='cmbDesignation' name='cmbDesignation'>
                                                <option></option>
                                                <?php

                                                $sqli = "SELECT id,designation FROM designationmaster WHERE activestatus ='Active'";

                                                $result = mysqli_query($connection, $sqli);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    # code...
                                                    echo '<option value =' . $row['id'] . '>' . $row['designation'] . '</option>';
                                                }
                                                ?>

                                            </select>
                                        </div>


                                        <label class="col-md-2 control-label">Login Password</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="" id='txtPassword'
                                                name='txtPassword' />
                                        </div>

                                    </div>



                                    <div class="form-group">

                                        <label class="col-md-3 control-label">Mobile Code</label>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" placeholder="" id='txtMobilecode'
                                                name='txtMobilecode' />
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Address</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" placeholder="Address" rows="2"
                                                id='txtAddress' name='txtAddress'></textarea>
                                        </div>
                                    </div>


                                    <div class="form-group">

                                        <label class="col-md-3 control-label">Active Status</label>
                                        <div class="col-md-3">
                                            <select id='cmbActiveStatus' name='cmbActiveStatus' class='form-control'>
                                                <option value='Active'>Active</option>
                                                <option value='In Active'>In Active</option>
                                            </select>
                                        </div>
                                    </div>



                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <a href="javascript:;" class="btn btn-sm btn-success" onclick="SaveStaff();">Save</a>
                        <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="modal-Biometric">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Add Biometric Details</h4>
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->

                            <div class="panel-body">
                                <form class="form-horizontal">



                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Biometric ID</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" placeholder=""
                                                id='txtModifyBiometricID' name='txtModifyBiometricID' />
                                        </div>

                                    </div>


                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <a href="javascript:;" class="btn btn-sm btn-success" onclick="SaveBiometricID();">Save</a>
                        <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-Biometricold">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Add Biometric</h4>
                        <input type='hidden' id='UserID' name='UserID' />
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->

                            <div class="panel-body">
                                <form class="form-horizontal">



                                    <style type="text/css">
                                    .img {
                                        min-width: 125px;
                                        min-height: 155px;
                                        width: 125px;
                                        height: 155px;
                                        border: 1px solid #CCC;
                                        border-radius: 4px;
                                        box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset;
                                        background-color: #FFFFFF;
                                    }
                                    </style>
                                    <script src="jquery-1.8.2.js"></script>
                                    <script src="mfs100-9.0.2.6.js"></script>

                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
                                    </script>
                                    <script language="javascript" type="text/javascript">
                                    function AutoCapture() {
                                        // do whatever you like here

                                        setTimeout(Capture, 5000);
                                    }



                                    var quality = 60; //(1 to 100) (recommanded minimum 55)
                                    var timeout = 10; // seconds (minimum=10(recommanded), maximum=60, unlimited=0 )

                                    function GetInfo() {
                                        document.getElementById('tdSerial').innerHTML = "";
                                        document.getElementById('tdCertification').innerHTML = "";
                                        document.getElementById('tdMake').innerHTML = "";
                                        document.getElementById('tdModel').innerHTML = "";
                                        document.getElementById('tdWidth').innerHTML = "";
                                        document.getElementById('tdHeight').innerHTML = "";
                                        document.getElementById('tdLocalMac').innerHTML = "";
                                        document.getElementById('tdLocalIP').innerHTML = "";
                                        document.getElementById('tdSystemID').innerHTML = "";
                                        document.getElementById('tdPublicIP').innerHTML = "";


                                        var key = document.getElementById('txtKey').value;

                                        var res;
                                        if (key.length == 0) {
                                            res = GetMFS100Info();
                                        } else {
                                            res = GetMFS100KeyInfo(key);
                                        }

                                        if (res.httpStaus) {

                                            document.getElementById('txtStatus').value = "ErrorCode: " + res.data
                                                .ErrorCode + " ErrorDescription: " + res.data.ErrorDescription;

                                            if (res.data.ErrorCode == "0") {
                                                document.getElementById('tdSerial').innerHTML = res.data.DeviceInfo
                                                    .SerialNo;
                                                document.getElementById('tdCertification').innerHTML = res.data
                                                    .DeviceInfo.Certificate;
                                                document.getElementById('tdMake').innerHTML = res.data.DeviceInfo.Make;
                                                document.getElementById('tdModel').innerHTML = res.data.DeviceInfo
                                                    .Model;
                                                document.getElementById('tdWidth').innerHTML = res.data.DeviceInfo
                                                    .Width;
                                                document.getElementById('tdHeight').innerHTML = res.data.DeviceInfo
                                                    .Height;
                                                document.getElementById('tdLocalMac').innerHTML = res.data.DeviceInfo
                                                    .LocalMac;
                                                document.getElementById('tdLocalIP').innerHTML = res.data.DeviceInfo
                                                    .LocalIP;
                                                document.getElementById('tdSystemID').innerHTML = res.data.DeviceInfo
                                                    .SystemID;
                                                document.getElementById('tdPublicIP').innerHTML = res.data.DeviceInfo
                                                    .PublicIP;
                                            }
                                        } else {
                                            alert(res.err);
                                        }
                                        return false;
                                    }

                                    function ResetBiometric() {
                                        document.getElementById('imgFinger').src = "../assets/img/Biometric.jpg";
                                        document.getElementById('txtImageInfo').value = "";
                                        document.getElementById('txtIsoTemplate').value = "";
                                        document.getElementById('txtAnsiTemplate').value = "";
                                        document.getElementById('txtIsoImage').value = "";
                                        document.getElementById('txtRawData').value = "";
                                        document.getElementById('txtWsqData').value = "";
                                    }

                                    function Capture() {
                                        try {

                                            // document.getElementById('txtStatus').value = "4";

                                            document.getElementById('imgFinger').src = "data:image/bmp;base64,";
                                            document.getElementById('txtImageInfo').value = "";
                                            document.getElementById('txtIsoTemplate').value = "";
                                            document.getElementById('txtAnsiTemplate').value = "";
                                            document.getElementById('txtIsoImage').value = "";
                                            document.getElementById('txtRawData').value = "";
                                            document.getElementById('txtWsqData').value = "";

                                            var res = CaptureFinger(quality, timeout);
                                            if (res.httpStaus) {

                                                document.getElementById('txtStatus').value = "ErrorCode: " + res.data
                                                    .ErrorCode + " ErrorDescription: " + res.data.ErrorDescription;

                                                if (res.data.ErrorCode == "0") {
                                                    document.getElementById('imgFinger').src =
                                                        "data:image/bmp;base64," + res.data.BitmapData;
                                                    var imageinfo = "Quality: " + res.data.Quality + " Nfiq: " + res
                                                        .data.Nfiq + " W(in): " + res.data.InWidth + " H(in): " + res
                                                        .data.InHeight + " area(in): " + res.data.InArea +
                                                        " Resolution: " + res.data.Resolution + " GrayScale: " + res
                                                        .data.GrayScale + " Bpp: " + res.data.Bpp +
                                                        " WSQCompressRatio: " + res.data.WSQCompressRatio +
                                                        " WSQInfo: " + res.data.WSQInfo;
                                                    document.getElementById('txtImageInfo').value = imageinfo;
                                                    document.getElementById('txtIsoTemplate').value = res.data
                                                        .IsoTemplate;
                                                    document.getElementById('txtAnsiTemplate').value = res.data
                                                        .AnsiTemplate;
                                                    document.getElementById('txtIsoImage').value = res.data.IsoImage;
                                                    document.getElementById('txtRawData').value = res.data.RawData;
                                                    document.getElementById('txtWsqData').value = res.data.WsqImage;
                                                }
                                            } else {
                                                alert(res.err);
                                            }
                                        } catch (e) {

                                            alert(e);
                                        }
                                        return false;
                                    }
                                    </script>


                                    <table width="100%" style="padding-top:0px;">


                                        <tr>

                                            <td width="150px" height="190px" align="center" class="img">
                                                <img src="../assets/img/Biometric.jpg" id="imgFinger" width="145px"
                                                    height="188px" alt="Finger Image" />
                                            </td>
                                            <td>
                                                <table align="left" border="0" style="width:30%; padding-right:2px;">

                                                    <tr>
                                                        <td align="left" style="width: 100px;">S.No:</td>
                                                        <td align="left" style="width: 150px;" id="tdSerial"></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left">IP</td>
                                                        <td align="left" id="tdLocalIP"></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left">MAC:</td>
                                                        <td align="left" id="tdLocalMac"></td>
                                                    </tr>
                                                    <tr hidden>
                                                        <input type="hidden" value="" id="txtKey"
                                                            class="form-control" />
                                                        <td align="left">Make:</td>
                                                        <td align="left" id="tdMake"></td>
                                                        <td align="left">Model:</td>
                                                        <td align="left" id="tdModel"></td>

                                                        <td align="left">Width:</td>
                                                        <td align="left" id="tdWidth"></td>
                                                        <td align="left">Height:</td>
                                                        <td align="left" id="tdHeight"></td>

                                                        <td align="left">Public IP</td>
                                                        <td align="left" id="tdPublicIP"></td>
                                                        <td align="left">System ID</td>
                                                        <td align="left" id="tdSystemID"></td>

                                                        <td align="left" style="width: 100px;">Certification:</td>
                                                        <td align="left" id="tdCertification"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>


                                    <table hidden width="100%">
                                        <tr>
                                            <td width="220px">
                                                Status:
                                            </td>
                                            <td>
                                                <input type="text" value="" id="txtStatus" class="form-control" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Quality:
                                            </td>
                                            <td>
                                                <input type="text" value="" id="txtImageInfo" class="form-control" />
                                            </td>
                                        </tr>
                                        <!--<tr>
                <td>
                    NFIQ:
                </td>
                <td>
                    <input type="text" value="" id="txtNFIQ" class="form-control" />
                </td>
            </tr>-->
                                        <tr>
                                            <td>
                                                Base64Encoded ISO Template
                                            </td>
                                            <td>
                                                <textarea id="txtIsoTemplate" style="width: 100%; height:50px;"
                                                    class="form-control"> </textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Base64Encoded ANSI Template
                                            </td>
                                            <td>
                                                <textarea id="txtAnsiTemplate" style="width: 100%; height:50px;"
                                                    class="form-control"> </textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Base64Encoded ISO Image
                                            </td>
                                            <td>
                                                <textarea id="txtIsoImage" style="width: 100%; height:50px;"
                                                    class="form-control"> </textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Base64Encoded Raw Data
                                            </td>
                                            <td>
                                                <textarea id="txtRawData" style="width: 100%; height:50px;"
                                                    class="form-control"> </textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Base64Encoded Wsq Image Data
                                            </td>
                                            <td>
                                                <textarea id="txtWsqData" style="width: 100%; height:50px;"
                                                    class="form-control"> </textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Encrypted Base64Encoded Pid/Rbd
                                            </td>
                                            <td>
                                                <textarea id="txtPid" style="width: 100%; height:50px;"
                                                    class="form-control"> </textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Encrypted Base64Encoded Session Key
                                            </td>
                                            <td>
                                                <textarea id="txtSessionKey" style="width: 100%; height:50px;"
                                                    class="form-control"> </textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Encrypted Base64Encoded Hmac
                                            </td>
                                            <td>
                                                <input type="text" value="" id="txtHmac" class="form-control" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Ci
                                            </td>
                                            <td>
                                                <input type="text" value="" id="txtCi" class="form-control" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Pid/Rbd Ts
                                            </td>
                                            <td>
                                                <input type="text" value="" id="txtPidTs" class="form-control" />
                                            </td>
                                        </tr>
                                    </table>


                                    <script>
                                    function SaveBiometricID() {
                                        var BiometricID = document.getElementById("txtModifyBiometricID").value;
                                        var UserID = document.getElementById("UserID").value;


                                        if (BiometricID == "" || UserID == "") {
                                            swal("Alert!", "Kindly provide the details!", "warning");
                                            // alert(1);
                                        } else {
                                            var datas = "&BiometricID=" + BiometricID + "&UserID=" + UserID;

                                            $.ajax({
                                                url: "Save/SaveBiometricID.php",
                                                method: "POST",
                                                data: datas,
                                                success: function(data) {
                                                    if (data == 1) {
                                                        // swal("Biometric!", "Biometric details added, "success");
                                                        swal("Biometric!", "Kindly provide valid details!",
                                                            "success");
                                                        setTimeout(function() {
                                                            location.reload()
                                                        }, 1000);
                                                    } else {
                                                        // swal("Biometric!", "Error Saving Biometric, "alert");
                                                        swal("Alert!", "Kindly provide valid details!",
                                                            "warning");
                                                        setTimeout(function() {
                                                            location.reload()
                                                        }, 1000);
                                                    }


                                                }
                                            });
                                        }





                                    }

                                    function SaveBiometric() {
                                        var Status = document.getElementById("txtStatus").value;
                                        var UserID = document.getElementById("UserID").value;
                                        var ImaegInfo = document.getElementById("txtImageInfo").value;
                                        var ISOTemplate = document.getElementById("txtIsoTemplate").value;

                                        // var Status = 1;
                                        // var ImaegInfo = 2;
                                        // var ISOTemplate = 3;

                                        if (Status == "" || UserID == "" || ImaegInfo == "" || ISOTemplate == "") {
                                            swal("Alert!", "Kindly provide the details!", "warning");
                                            // alert(1);
                                        } else {
                                            var datas = "&Status=" + Status + "&ImaegInfo=" + ImaegInfo + "&UserID=" +
                                                UserID + "&ISOTemplate=" + encodeURIComponent(ISOTemplate);
                                            // alert(datas);
                                            $.ajax({
                                                url: "Save/SaveBio.php",
                                                method: "POST",
                                                data: datas,
                                                success: function(data) {
                                                    if (data == 1) {
                                                        // swal("Biometric!", "Biometric details added, "success");
                                                        swal("Biometric!", "Kindly provide valid details!",
                                                            "success");
                                                        setTimeout(function() {
                                                            location.reload()
                                                        }, 1000);
                                                    } else {
                                                        // swal("Biometric!", "Error Saving Biometric, "alert");
                                                        swal("Alert!", "Kindly provide valid details!",
                                                            "warning");
                                                        setTimeout(function() {
                                                            location.reload()
                                                        }, 1000);
                                                    }


                                                }
                                            });
                                        }





                                    }


                                    function LoadStaffDetails(x) {
                                        var UserID = x;
                                        var datas = "&UserID=" + UserID;

                                        $.ajax({
                                            url: "Load/LoadStaffDetails.php",
                                            method: "POST",
                                            data: datas,
                                            dataType: "json",
                                            success: function(data) {
                                                // alert(data);
                                                $("#txtStaffName").val(data[0]);
                                                $("#dtDOB").val(data[1]);
                                                $("#dtDOJ").val(data[2]);
                                                $("#cmbGender").val(data[3]);
                                                $("#cmbMaritalStatus").val(data[4]);
                                                $("#txtMobileNo").val(data[5]);
                                                $("#txtAlternateContactNo").val(data[6]);
                                                $("#txtAddress").val(data[7]);
                                                $("#txtSalary").val(data[8]);
                                                $("#txtBiometricID").val(data[9]);
                                                $("#cmbDesignation").val(data[10]);
                                                $("#txtQualification").val(data[11]);
                                                $("#txtYearofExp").val(data[12]);
                                                $("#cmbActiveStatus").val(data[13]);
                                                $("#txtUserID").val(data[14]);
                                                $("#txtPassword").val(data[15]);
                                                $("#txtHRDocID").val(data[18]);
                                                $("#txtMobilecode").val(data[19]);

                                            }
                                        });

                                    }

                                    function ClearAll() {
                                        document.getElementById("txtStaffName").value = '';
                                        document.getElementById("dtDOB").value = '';
                                        document.getElementById("dtDOJ").value = '';
                                        document.getElementById("cmbGender").value = 'Male';
                                        document.getElementById("cmbMaritalStatus").value = 'Un Married';
                                        document.getElementById("txtMobileNo").value = '';
                                        document.getElementById("txtAlternateContactNo").value = '';
                                        document.getElementById("txtAddress").value = '';
                                        document.getElementById("txtSalary").value = '';
                                        document.getElementById("txtBiometricID").value = '';
                                        document.getElementById("cmbDesignation").value = '';
                                        document.getElementById("txtQualification").value = '';
                                        document.getElementById("txtYearofExp").value = '';
                                        document.getElementById("cmbActiveStatus").value = 'Active';
                                        document.getElementById("txtUserID").value = '';
                                        document.getElementById("txtPassword").value = '';
                                        document.getElementById("txtHRDocID").value = '';
                                        document.getElementById("txtMobilecode").value = '';


                                    }


                                    function GetBiometric() {
                                        // var UserID = document.getElementById("txtInvoiceNo").value;
                                        var UserID = 1;

                                        var datas = "&UserID=" + UserID;
                                        // alert(datas);
                                        $.ajax({
                                            url: "LoadBiometric.php",
                                            method: "POST",
                                            data: datas,
                                            dataType: "json",
                                            success: function(data) {
                                                // alert(data);
                                                $("#txtIsoTemplate").val(data[0]);

                                            }
                                        });

                                    }
                                    </script>

</body>

</html>




</form>
</div>

</div>
</div>
<div class="modal-footer">
    <a href="javascript:;" class="btn btn-sm btn-warning" onclick="return GetInfo()">Device Status</a>

    <a href="javascript:;" class="btn btn-sm btn-danger" onclick="return Capture()">Capture</a>
    <a href="javascript:;" class="btn btn-sm btn-success" onclick="SaveBiometric()">Save</a>

</div>
</div>
</div>
</div>

<div id="content" class="content">
    <div class="col-md-12">

        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">

                <h4 class="panel-title">Staff List &nbsp;&nbsp;&nbsp;&nbsp;

                    <button class="btn btn-xs btn-info"> <a href="#modal-dialog" data-toggle="modal" style="color:white"
                            onclick="ClearAll()"><i class="fa fa-2x fa-plus-circle"></i></a> </button>

                </h4>


            </div>

            <div class="panel-body">

                <div class="form-group">
                    <label class="col-md-1 control-label">Staus</label>
                    <div class="col-md-3">
                        <select class='form-control' id='cmbStatusFilter' name='cmbStatusFilter'
                            onchange='LoadStaffList()'>
                            <option value='Active'>
                                Active
                            </option>
                            <option value='In Active'>
                                In-Active
                            </option>
                        </select>
                    </div>

                    <label class="col-md-1 control-label">Designation</label>
                    <div class="col-md-3">
                        <select class='form-control' id='cmbDesignationFilter' name='cmbDesignationFilter'
                            onchange='LoadStaffList()'>
                            <option value='%'>All</option>
                            <?php

                            $sqli = "SELECT id,designation FROM designationmaster WHERE activestatus ='Active'";

                            $result = mysqli_query($connection, $sqli);
                            while ($row = mysqli_fetch_array($result)) {
                                # code...
                                echo '<option value =' . $row['id'] . '>' . $row['designation'] . '</option>';
                            }
                            ?>

                        </select>
                    </div>

                </div>

            </div>




            <div class="table-responsive" id='DivStaffList'>



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