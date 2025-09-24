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

<body onload="LoadPaitentList();">
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
        <script>
        function Reset() {
            document.getElementById("txtPaitentID").value = "";
            document.getElementById("txtPatientMobileNo").value = "";
            document.getElementById("txtPatient").value = "";
            document.getElementById("txtPatientEmail").value = "";
            document.getElementById("txtWhatsappNo").value = "";
            document.getElementById("txtAlternateNo").value = "";
            document.getElementById("dtDob").value = "";
            document.getElementById("txtAddress").value = "";
            document.getElementById("txtCity").value = "";
            document.getElementById("txtPincode").value = "";
            document.getElementById("txtBarcode").value = "";
            document.getElementById("txtPhotoPath").value = "";
            document.getElementById("cmbMaritalStatus").value = "";

            LoadPaitentList();

        }

        function LoadPaitentList() {

            var PaitentID = document.getElementById("txtSearchPaitentDetails").value;

            var datas = "&PaitentID=" + PaitentID;

            $.ajax({
                url: "Load/LoadPaitentMasterList.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivPaitentList').html(data);

                }
            });
        }

        function LoadPaitentPhoto(x) {
            var PaitentID = x;

            var datas = "&PaitentID=" + PaitentID;


            $.ajax({
                url: "Load/LoadPaitentPhoto.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivOldImage').html(data);

                }
            });
        }


        function Upload() {
            var base64image = $('#myImg').attr('src');
            var file = document.getElementById("txtPaitentIDEdit").value;
            var CurrentTime = new Date().getTime();
            var finalfilename = 'uploads/'.concat(file, CurrentTime, '.jpeg');
            document.getElementById("txtPhotoPath").value = finalfilename;

            // $file = 'uploads/'.time().
            // 'image.jpeg';
            var datas = "&base64image=" + base64image + "&finalfilename=" + finalfilename;

            $.ajax({
                url: "uploadpatientimage.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    // LoadPaymentDetails();
                    // CalculatePaymentTotal();
                }
            });

        }


        function CallPatientEdit() {
            var PaitentCode = document.getElementById("txtPaitentIDEdit").value;
            document.getElementById("txtNewFamily").value = 0;
            LoadPaitentDetails(PaitentCode);
            LoadPaitentPhoto(PaitentCode);
        }

        function AddFamily() {

            document.getElementById("txtNewFamily").value = 1;
            document.getElementById("txtPatient").value = '';


        }

        function LoadFamilyList() {
            var PaitentID = document.getElementById("txtPaitentIDEdit").value;
            var datas = "&PaitentID=" + PaitentID;
            $.ajax({
                url: "Load/LoadPaitentMasterFamily.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#divFamilyList').html(data);

                }
            });

        }

        function LoadPaitentDetails(x) {


            document.getElementById("txtPaitentIDEdit").value = x;
            var PaitentCode = x;

            var datas = "&PaitentCode=" + PaitentCode;

            $.ajax({
                url: "Load/LoadPaitentDetailsEdit.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    //                 alert(data);
                    //                 $data[] = $row['paitentid'];
                    // $data[] = $row['mobileno'];
                    // $data[] = $row['paitentname'];
                    // $data[] = $row['email'];
                    // $data[] = $row['whatsappno'];
                    // $data[] = $row['alternateno'];
                    // $data[] = $row['referenceid'];
                    // $data[] = $row['referenceno'];
                    // $data[] = $row['gender'];
                    // $data[] = $row['dob'];
                    // $data[] = $row['address'];
                    // $data[] = $row['city'];
                    // $data[] = $row['statecode'];
                    // $data[] = $row['pincode'];
                    // $data[] = $row['barcode'];
                    // $data[] = $row['activestatus'];
                    document.getElementById("txtPaitentID").value = data[0];
                    document.getElementById("txtPatientMobileNo").value = data[1];
                    document.getElementById("txtPatient").value = data[2];
                    document.getElementById("txtPatientEmail").value = data[3];
                    document.getElementById("txtWhatsappNo").value = data[4];
                    document.getElementById("txtAlternateNo").value = data[5];
                    document.getElementById("cmbReferenceCode").value = data[6];
                    document.getElementById("txtReferenceNo").value = data[7];
                    document.getElementById("cmbSex").value = data[8];
                    document.getElementById("dtDob").value = data[9];
                    document.getElementById("txtAddress").value = data[10];
                    document.getElementById("txtCity").value = data[11];
                    document.getElementById("cmbState").value = data[12];
                    document.getElementById("txtPincode").value = data[13];
                    document.getElementById("txtBarcode").value = data[14];
                    document.getElementById("cmbActiveStatus").value = data[15];
                    document.getElementById("cmbFamilyMemberRelation").value = data[16];
                    document.getElementById("txtPhotoPath").value = data[17];
                    document.getElementById("cmbMaritalStatus").value = data[19];
                    document.getElementById("cmbProfession").value = data[20];
                    document.getElementById("cmbTag").value = data[21];


                    $("#spnPatientMobileNo").text(data[1]);
                    $("#spnPatient").text(data[2]);
                    $("#spnGender").text(data[8]);
                    $("#spnDOB").text(data[18]);
                    $("#spnAltMobile").text(data[5]);
                    $("#spnReference").text(data[7]);
                    $("#spnCity").text(data[11]);
                    $("#spnState").text(data[12]);
                    $("#spnPincode").text(data[13]);
                    $("#spnAddress").text(data[10]);
                    $("#spnProfession").text(data[20]);
                    $("#spnTag").text(data[21]);


                    var ddlPassport = document.getElementById("cmbReferenceCode");
                    var dvPassport = document.getElementById("DivOtherReference");
                    dvPassport.style.display = ddlPassport.value == "0" ? "block" : "none";


                    if (data[17] == '' || data[17] == 'undefined' || data[17] == '-') {
                        document.getElementById("imgPatientImage").src = 'uploads/dummyuser.jpeg';

                    } else {
                        document.getElementById("imgPatientImage").src = data[17];

                    }

                }
            });

            LoadFamilyList();
        }


        function SavePatient() {
            var ID = document.getElementById("txtID").value;
            var PaitentID = document.getElementById("txtPaitentID").value;
            var PatientMobileNo = document.getElementById("txtPatientMobileNo").value;
            var Name = document.getElementById("txtPatient").value;
            var PatientEmail = document.getElementById("txtPatientEmail").value;
            var Whatsapp = document.getElementById("txtWhatsappNo").value;
            var AlternateNo = document.getElementById("txtAlternateNo").value;
            var ReferenceCode = document.getElementById("cmbReferenceCode").value;
            var ReferenceNo = document.getElementById("txtReferenceNo").value;
            var Sex = document.getElementById("cmbSex").value;
            var DOB = document.getElementById("dtDob").value;
            var Address = document.getElementById("txtAddress").value;
            var City = document.getElementById("txtCity").value;
            var State = document.getElementById("cmbState").value;
            var Pincode = document.getElementById("txtPincode").value;
            var PatientBarcode = document.getElementById("txtBarcode").value;
            var ActiveStatus = document.getElementById("cmbActiveStatus").value;
            var PatientImage = document.getElementById("txtPhotoPath").value;
            var RelationShip = document.getElementById("cmbFamilyMemberRelation").value;
            var NewFamily = document.getElementById("txtNewFamily").value;
            var MaritalStatus = document.getElementById("cmbMaritalStatus").value;
            var Profession = document.getElementById("cmbProfession").value;
            var Tag = document.getElementById("cmbTag").value;
            var Device = "Browser";

            if (PatientMobileNo == "" || Name == "" || Sex == "" || DOB == "" || City == "" ||
                Pincode == "" || MaritalStatus == "" || RelationShip == "") {
                swal("Alert!", "Please fill the mandatory fields", "warning");
            } else {


                var datas = "&PaitentID=" + PaitentID + "&PatientMobileNo=" + PatientMobileNo +
                    "&Name=" + Name + "&PatientEmail=" + PatientEmail +
                    "&Whatsapp=" + Whatsapp + "&AlternateNo=" + AlternateNo +
                    "&ReferenceCode=" + ReferenceCode +
                    "&ReferenceNo=" + ReferenceNo + "&Sex=" + Sex +
                    "&DOB=" + DOB + "&Address=" + Address +
                    "&City=" + City + "&State=" + State +
                    "&Tag=" + Tag + "&Profession=" + Profession +
                    "&Pincode=" + Pincode + "&PatientBarcode=" + PatientBarcode +
                    "&Device=" + Device + "&RelationShip=" + RelationShip + "&NewFamily=" + NewFamily +
                    "&ActiveStatus=" + ActiveStatus + "&PatientImage=" + PatientImage + "&MaritalStatus=" +
                    MaritalStatus;


                $.ajax({
                    url: "Save/SavePaitent.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == "1") {
                            swal("Patient!", "Patient Saved sucessfully", "success");
                            Reset();
                        } else {
                            swal("Alert!", data, "warning");
                            Reset();
                        }
                    }
                });
            }
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

        function LoadReferenceDetails() {

            var RefID = document.getElementById("cmbReferenceCode").value;

            var ReferenceName = document.getElementById("txtReferenceNo").value;

            var SelectedValue = $("#cmbReferenceCode option:selected").text();

            var ddlPassport = document.getElementById("cmbReferenceCode");
            var dvPassport = document.getElementById("DivOtherReference");
            dvPassport.style.display = ddlPassport.value == "0" ? "block" : "none";

            if (RefID == '0') {
                document.getElementById("txtReferenceNo").value = '';
                document.getElementById("txtReferenceNo").focus();
            } else {
                document.getElementById("txtReferenceNo").value = SelectedValue;


            }

        }
        </script>



</body>

<div class="modal fade" id="modal-addnewpatient">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Consultation Type</h4>
                <input type='hidden' id='txtID' name='txtID' />
            </div>
            <div class="modal-body">


                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <input type='hidden' name='txtPaitentID' id='txtPaitentID' />
                            <label class="col-md-1 control-label">Mobile*</label>
                            <div class="col-md-2">
                                <input type="number" class="form-control" placeholder="Mobile No"
                                    id='txtPatientMobileNo' name='txtPatientMobileNo'
                                    onblur='GetPaitentDetailsInitial()' />
                            </div>

                            <label class="col-md-1 control-label">Name*</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Name" id='txtPatient'
                                    name='txtPatient' />
                            </div>

                            <label class="col-md-1 control-label">EmailID</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Email Id" id='txtPatientEmail'
                                    name='txtPatientEmail' />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-1 control-label">Whatsapp</label>
                            <div class="col-md-2">
                                <input type="number" class="form-control" placeholder="Mobile No" id='txtWhatsappNo'
                                    name='txtWhatsappNo' />
                            </div>

                            <label class="col-md-1 control-label">Alternate No</label>
                            <div class="col-md-3">
                                <input type="number" class="form-control" placeholder="Alternate no" id='txtAlternateNo'
                                    name='txtAlternateNo' />
                            </div>

                            <label class="col-md-1 control-label">Reference</label>

                            <div class="col-md-3">

                                <select class="form-control" id='cmbReferenceCode' name='cmbReferenceCode'
                                    onchange='LoadReferenceDetails()'>
                                    <option></option>
                                    <?php  
                                                    $sqli = "  select referenceid,reference from referencemaster where referencestatus='Active' ORDER BY 2 ";
                                                    $result = mysqli_query($connection, $sqli); 
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        # code...
                                                
                                                    echo ' <option value="'.$row['referenceid'].'">'.$row['reference'].'</option>';
                                                    }	
                                                    ?>
                                </select>


                                <div id='DivOtherReference' style='display:none'>
                                    <input type="text" class="form-control" placeholder="Other Reference"
                                        id='txtReferenceNo' name='txtReferenceNo' />

                                </div>
                            </div>


                        </div>

                        <div class="form-group">
                            <label class="col-md-1 control-label">Gender*</label>
                            <div class="col-md-2">
                                <select class="form-control" id='cmbSex' name='cmbSex'>

                                    <option value='Male'>Male</option>
                                    <option value='Female'>Female</option>

                                </select>
                            </div>

                            <label class="col-md-1 control-label">DOB*</label>
                            <div class="col-md-3">
                                <input type="date" class="form-control" id='dtDob' name='dtDob' />
                            </div>

                            <label class="col-md-1 control-label">Marital Status*</label>
                            <div class="col-md-3">

                                <select id='cmbMaritalStatus' class="form-control" name='cmbMaritalStatus'>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Divorced">Divorced</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-1 control-label">City *</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="City Name" id='txtCity'
                                    name='txtCity' />
                            </div>

                            <label class="col-md-1 control-label">State</label>
                            <div class="col-md-3">
                                <select class="form-control" id='cmbState' name='cmbState'>
                                    <?php
                                              $sqli = "SELECT stateid,UPPER(statename) as statename FROM statemaster WHERE activestatus='Active' order by orderid";
                                              $result = mysqli_query($connection, $sqli); 
                                              while ($row = mysqli_fetch_array($result)) {
                                             echo ' <option value="'.$row['stateid'].'">'.$row['statename'].'</option>';
                                                }	
                                              ?>
                                </select>

                            </div>

                            <label class="col-md-1 control-label">Pincode*</label>
                            <div class="col-md-3">
                                <input type="number" class="form-control" placeholder="Ex: 600001" id='txtPincode'
                                    name='txtPincode' />
                            </div>
                        </div>



                        <div class="form-group">

                            <label class="col-md-1 control-label">Profession</label>
                            <div class="col-md-2">

                                <select class="form-control" id='cmbProfession' name='cmbProfession'>
                                    <option value='-'>-</option>
                                    <?php
                        $sqli = " SELECT  profession FROM  professionalmaster ORDER BY profession ";
                        $result = mysqli_query($connection, $sqli);
                        while ($row = mysqli_fetch_array($result)) {
                            # code...

                            echo ' <option value="' . $row['profession'] . '">' . $row['profession'] . '</option>';
                        }
                        ?>

                                </select>
                            </div>

                            <label class="col-md-1 control-label">Tag</label>
                            <div class="col-md-3">
                                <select class="form-control" id='cmbTag' name='cmbTag'>

                                    <option value='0'>Regular</option>
                                    <?php
                        $sqli = " SELECT  tagname FROM  taglistmaster ORDER BY tagname ";
                        $result = mysqli_query($connection, $sqli);
                        while ($row = mysqli_fetch_array($result)) {
                            # code...

                            echo ' <option value="' . $row['tagname'] . '">' . $row['tagname'] . '</option>';
                        }
                        ?>

                                </select>
                            </div>

                            <label class="col-md-1 control-label">Relation*</label>
                            <div class="col-md-3">
                                <select id='cmbFamilyMemberRelation' class="form-control"
                                    name='cmbFamilyMemberRelation'>
                                    <option selected value="Self">Self</option>
                                    <option value="Mother">Mother</option>
                                    <option value="Father">Father</option>
                                    <option value="Husband">Husband</option>
                                    <option value="Wife">Wife</option>
                                    <option value="Brother">Brother</option>
                                    <option value="Sister">Sister</option>
                                    <option value="Son">Son</option>
                                    <option value="Daughter">Daughter</option>
                                    <option value="Grand Father">Grand Father</option>
                                    <option value="Grand Mother">Grand Mother</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>


                        </div>

                        <div class="form-group">

                            <label class="col-md-1 control-label">Address</label>
                            <div class="col-md-6">
                                <input type="hidden" class="form-control" placeholder="Barcode" id='txtBarcode'
                                    name='txtBarcode' />

                                <textarea class="form-control" id='txtAddress' name='txtAddress'></textarea>
                            </div>



                            <label class="col-md-1 control-label">Status</label>
                            <div class="col-md-2">
                                <select class="form-control" name='cmbActiveStatus' id='cmbActiveStatus'>
                                    <option value='Active'>Active</option>
                                    <option value='In Active'>In Active</option>
                                </select>

                            </div>



                        </div>


                        <div class="form-group">

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
                            </script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js">
                            </script>

                            <div class="col-md-6">
                                <div id="my_camera"></div>
                                <br />
                                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                <input type="hidden" id='image' name="image" class="image-tag">

                            </div>

                            <div class="col-md-6">
                                <div id="results">Your captured image will appear here...
                                </div>
                                <img id="myImg" width="180" height="180">

                            </div>



                        </div>


                        <!-- Configure a few settings and attach camera -->
                        <script language="JavaScript">
                        Webcam.set({
                            width: 180,
                            height: 180,
                            image_format: 'jpeg',
                            jpeg_quality: 90
                        });

                        Webcam.attach('#my_camera');

                        function take_snapshot() {

                            Webcam.snap(function(data_uri) {
                                $(".image-tag").val(data_uri);
                                document.getElementById("myImg").src = data_uri;
                                document.getElementById('results').innerHTML =
                                    '<img hidden src="' +
                                    data_uri + '"  />';
                            });
                            Upload();


                        }
                        </script>





                        <div class="form-group">
                            <label class="col-md-3 control-label"> </label>
                            <div class="col-md-9">
                                <input type="button" class="btn btn-sm btn-success" onclick="SavePatient();"
                                    value='Save'>
                                <input type="button" class="btn btn-sm btn-warning" onclick="Reset();" value='Cancel'>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


<div id="content" class="content">
    <div class="col-md-6">

        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">

                <h4 class="panel-title">Patient List
                </h4>
            </div>

            <div class="panel-body">
                <div class="col-md-6">
                    <input type='text' name='txtSearchPaitentDetails' id='txtSearchPaitentDetails'
                        class='form-control' />
                </div>
                <div class="col-md-3">
                    <button class='btn btn-primary' onclick='LoadPaitentList()'>Search</button>
                </div>
                <div class="col-md-3">
                    <a href='#modal-addnewpatient' data-toggle="modal" class=' btn btn-sm btn-success btn-xs'
                        data-toggle='modal' onclick='Reset()'>
                        <i class='fa fa-plus' title='View'></i></a>

                </div>
                <div class="col-md-12">
                    <div class="table-responsive" id='DivPaitentList'>

                    </div>
                </div>

            </div>
        </div>
        <!-- end panel -->

        <!-- end panel -->
    </div>

    <div class="col-md-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">

                <h4 class="panel-title">Patient Details

                    <a href='#modal-addnewpatient' style='float:right' data-toggle="modal"
                        class=' btn btn-sm btn-warning btn-xs' onclick='CallPatientEdit()'> Edit </a>


                    <input type='hidden' name='txtPaitentIDEdit' id='txtPaitentIDEdit' />
                    <input type='hidden' name='txtPhotoPath' id='txtPhotoPath' />
                </h4>

            </div>

            <div class="panel-body">
                <div class="form-group">


                    <div class="panel-body">
                        <div class="media media-lg">
                            <a class="media-left" href="javascript:;">
                                <img id='imgPatientImage' name='imgPatientImage'
                                    src="../assets/img/gallery/gallery-1.jpg" alt="" class="media-object" />
                            </a>
                            <div class="media-body">
                                <h5 class="media-heading">Name: <b><span id='spnPatient' name='spnPatient'></span></h5>
                                <h5 class="media-heading">Gender: <b><span id='spnGender' name='spnGender'></span>
                                </h5>

                                <h5 class="media-heading">DOB: <b><span id='spnDOB' name='spnDOB'></span></h6>
                                        <h5 class="media-heading">Mobile No: <b><span id='spnPatientMobileNo'
                                                    name='spnPatientMobileNo'></span></h5>
                                        <h5 class="media-heading">Alt No: <b><span id='spnAltMobile'
                                                    name='spnAltMobile'></span></h5>
                                        <h5 class="media-heading">Tag: <b><span id='spnTag' name='spnTag'></span></h5>
                                        <h5 class="media-heading">Profession: <b><span id='spnProfession'
                                                    name='spnProfession'></span></h5>

                                        <h5 class="media-heading">Reference: <b><span id='spnReference'
                                                    name='spnReference'></span></h5>
                                        <h5 class="media-heading">City: <b><span id='spnCity' name='spnCity'></span>
                                        </h5>
                                        <h5 class="media-heading">State:
                                            <b><span id='spnState' name='spnState'></span>
                                        </h5>
                                        <h5 class="media-heading">
                                            Pincode: <b><span id='spnPincode' name='spnPincode'></span></h5>

                            </div>
                            <br>
                            <h5 class="media-heading">

                                Address: <b><span id='spnAddress' name='spnAddress'></span>
                            </h5>


                        </div>
                        <hr>
                        Family Members


                        <a href='#modal-addnewpatient' style='float:right' data-toggle="modal"
                            class=' btn btn-sm btn-warning  ' onclick='AddFamily();'> Add Family Member
                        </a>

                        <input type='hidden' id='txtNewFamily' name='txtNewFamily' value='0'>


                        <div id='divFamilyList'>

                        </div>

                    </div>
                </div>


            </div>
        </div>
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