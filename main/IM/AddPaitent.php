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
    <link href="../assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <script src="../assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
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
 
    <div id="ModalAddFamily" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Family Member</h4>
                </div>

                <div class="modal-body">

                    <br>
                    <input type='hidden' name='txtPaitentMobileEdit' id ='txtPaitentMobileEdit' />

                    <table>
                        <tr>
                            <td>Family Member Name &nbsp;&nbsp;</td>
                            <td><input type='text' id='txtFamilyMemberName' name='txtFamilyMemberName' /></td>
                        </tr>
                        <td><br></td>
                        <tr>
                            <td>Sex</td>
                            <td>
                                <select id='cmbFamilyMemberSex' name='cmbFamilyMemberSex'>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>

                        </tr>
                        <td><br></td>
                        <tr>
                            <td>DOB</td>
                            <td><input type='date' id='dtFamilyMemberDOB' name='dtFamilyMemberDOB' /></td>
                        </tr>
                        <td><br></td>
                        <tr>
                            <td>Email ID</td>
                            <td><input type='text' id='txtFamilyMemberEmail' name='txtFamilyMemberEmail' /></td>
                        </tr>
                        <td><br></td>
                        <tr>
                            <td>Relation</td>
                            <td>

                                <select id='cmbFamilyMemberRelation' name='cmbFamilyMemberRelation'>
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
                                </select>

                            </td>
                        </tr>

                        <tr>
                            <td><br></td>
                        </tr>

                    </table>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" onclick="AddFamilyMember();"
                        data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script>
    function UpdatePatient() {
        var PatientStatus = $("input[name='rdPatientStatus']:checked").val();
        var UpdatedPatientName = document.getElementById("txtPatientUpdatedName").value;
        var UpdatedPatientEmail = document.getElementById("txtPatientUpdatedEmail").value;
        var UpdatedPatientMobileNo = document.getElementById("txtPatientUpdatedMobileNo").value;
        var PatientID = document.getElementById("txtPaitentID").value;
        var UpdatedPaitentBarcode = document.getElementById("txtPaitentUpdatedBarcode").value;



        var UpdateGender = document.getElementById("cmbGenderEdit").value;
        var UpdateDOB = document.getElementById("dbDOBEdit").value;

        var UpdateAddress = document.getElementById("txtAddressUpdate").value;
        var UpdateReference = document.getElementById("txtReferenceUpdate").value;

        var UpdateCity = document.getElementById("txtCityUpdate").value;
        var UpdateState = document.getElementById("cmbStateUpdate").value;
        var UpdatePincode = document.getElementById("txtPincodeUpdate").value;


 

        var datas = "&PatientID=" + encodeURIComponent(PatientID) +
            "&UpdatedPatientName=" + encodeURIComponent(UpdatedPatientName) +
            "&UpdatedPatientEmail=" + encodeURIComponent(UpdatedPatientEmail) +
            "&UpdatedPatientMobileNo=" + encodeURIComponent(UpdatedPatientMobileNo) +
            "&PatientStatus=" + encodeURIComponent(PatientStatus) +
            "&NewGender=" + encodeURIComponent(UpdateGender) +
            "&UpdatedPaitentBarcode=" + encodeURIComponent(UpdatedPaitentBarcode) +
            "&UpdateAddress=" + encodeURIComponent(UpdateAddress) +
            "&UpdateReference=" + encodeURIComponent(UpdateReference) +
            "&UpdateCity=" + encodeURIComponent(UpdateCity) +
            "&UpdateState=" + encodeURIComponent(UpdateState) +
            "&UpdatePincode=" + encodeURIComponent(UpdatePincode) +
            "&UpdateDOB=" + encodeURIComponent(UpdateDOB);

        $.ajax({
            url: "Save/UpdatePatient.php",
            method: "POST",
            data: datas,
            success: function(data) {

                if (data == "Added Successfuly") {
                    swal("Patient!", data, "success");
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
            <?php include("IMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->
        <script>

function SendSMSBilling() {

var MobileNo = document.getElementById("txtPatientMobileNo").value;
var PaitentName = document.getElementById("txtPatient").value;

var datas = "&MobileNo=" + MobileNo +
    "&PaitentName=" + PaitentName;
// alert(datas);
$.ajax({
    url: "sendsms_registration.php",
    method: "POST",
    data: datas,
    success: function(data) {

        //  swal(data);
    }
});
}
 
        function SavePatient() {

            var PaitentID = document.getElementById("txtPaitentID").value;
            var PatientMobileNo = document.getElementById("txtPatientMobileNo").value;
            var PatientEmail = document.getElementById("txtPatientEmail").value;
            var Patient = document.getElementById("txtPatient").value;
            var PatientBarcode = document.getElementById("txtBarcode").value;

            var Whatsapp = document.getElementById("txtWhatsappNo").value;
            var AlternateNo = document.getElementById("txtAlternateNo").value;
            var ReferenceNo = document.getElementById("txtReferenceNo").value;
            var Sex = document.getElementById("cmbSex").value;
            var DOB = document.getElementById("dtDob").value;
            var Address = document.getElementById("txtAddress").value;

            var City = document.getElementById("txtCity").value;
            var Pincode = document.getElementById("txtPincode").value;
            var State = document.getElementById("cmbState").value;
            var ReferenceCode = document.getElementById("cmbReferenceCode").value;
            var ActiveStatus = document.getElementById("cmbActiveStatus").value;
            
            var Device = 'Browser';

            if (Patient == "" || PatientMobileNo == "") {

                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {
                var datas = "&Patient=" + Patient +
                    "&PaitentID=" + PaitentID +
                    "&PatientEmail=" + PatientEmail +
                    "&PatientMobileNo=" + PatientMobileNo +
                    "&Whatsapp=" + Whatsapp +
                    "&AlternateNo=" + AlternateNo +
                    "&ReferenceNo=" + ReferenceNo +
                    "&ReferenceCode=" + ReferenceCode +
                    "&Sex=" + Sex +
                    "&DOB=" + DOB +
                    "&Address=" + Address +
                    "&City=" + City +
                    "&Pincode=" + Pincode +
                    "&State=" + State +
                    "&Device=" + Device +
                    "&ActiveStatus=" + ActiveStatus +
                    "&PatientBarcode=" + PatientBarcode;

                $.ajax({
                    url: "Save/SavePaitent.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == 1) {
                            SendSMSBilling();
                            swal("Patient!", "Added Sucessfuly", "success");
                            Reset();
                        } else {
                            swal("Alert!", data, "warning");
                            Reset();
                        }


                    }
                });
            }

        }


        function AddFamilyMember() {
 
            var PatientEmail = document.getElementById("txtFamilyMemberEmail").value;
            var Patient = document.getElementById("txtFamilyMemberName").value; 
            var MobileNo = document.getElementById("txtPaitentMobileEdit").value; 
             
            var AlternateNo = document.getElementById("txtPaitentMobileEdit").value; 
            var ReferenceNo = "0"
            var Sex = document.getElementById("cmbFamilyMemberSex").value;
            var PaitentID = document.getElementById("txtPaitentID").value;
             
            var RelationShip = document.getElementById("cmbFamilyMemberRelation").value;
            var DOB = document.getElementById("dtFamilyMemberDOB").value;
            var Address = "-"; 
            
            if (Patient == "" || PaitentID == "") {

                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {

                var datas = "&Patient=" + Patient +
                    "&PatientEmail=" + PatientEmail +  
                    "&AlternateNo=" + AlternateNo +
                    "&ReferenceNo=" + ReferenceNo +
                    "&MobileNo=" + MobileNo +
                    "&Sex=" + Sex +
                    "&DOB=" + DOB +
                    "&Address=" + Address +
                    "&PaitentID=" + PaitentID +
                    "&RelationShip=" + RelationShip;
 
                $.ajax({
                    url: "Save/SavePaitentFamilyMember.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == 1) {
                            swal("Patient!", "Family Member added Sucessfuly", "success");
                            Reset();
                        } else {
                            swal("Alert!", data, "warning");
                            Reset();
                        }


                    }
                });
            }

        }

        function LoadPatient() {
            var Dumy = 0;

            var datas = "&Dumy=" + Dumy;

            $.ajax({
                url: "Load/LoadPaitentList.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivPatient').html(data);


                }
            });
        }

       

        function GetRowID(x,y) {
 
            document.getElementById("txtPaitentID").value =x;
            document.getElementById("txtPaitentMobileEdit").value =y;
            
        }


        function Reset() {
             
            document.getElementById("txtPaitentID").value = "";
            document.getElementById("txtPatientMobileNo").value = "";
            document.getElementById("txtPatient").value = ""; 
            document.getElementById("txtPatientEmail").value = "";
            document.getElementById("txtWhatsappNo").value = "";
            document.getElementById("txtAlternateNo").value = ""; 
            document.getElementById("txtReferenceNo").value = ""; 
            document.getElementById("dtDob").value = "";
            document.getElementById("txtAddress").value = "";
            document.getElementById("txtCity").value = "";
            document.getElementById("txtPincode").value = "";
            document.getElementById("txtBarcode").value = ""; 
            document.getElementById("cmbState").value = "0";
            document.getElementById("cmbReferenceCode").value = "1";
            document.getElementById("cmbSex").value = "Male";
            document.getElementById("cmbActiveStatus").value = "Active";
            
            LoadPatient(); 
        }

        function GetPaitentDetails(x) {

            var PaitentCode = x;
            var datas = "&PaitentCode=" + PaitentCode;
          
            $.ajax({
                url: "Load/LoadPaitentDetailsEdit.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {
 
                    $("#txtPaitentID").val(data[0]);
                    $("#txtPatientMobileNo").val(data[1]);
                    $("#txtPatient").val(data[2]);
                    $("#txtPatientEmail").val(data[3]);
                    $("#txtWhatsappNo").val(data[4]);
                    $("#txtAlternateNo").val(data[5]);
                    $("#cmbReferenceCode").val(data[6]);
                    $("#txtReferenceNo").val(data[7]);
                    $("#cmbSex").val(data[8]);
                    $("#dtDob").val(data[9]);
                    $("#txtAddress").val(data[10]);
                    $("#txtCity").val(data[11]);
                    $("#cmbState").val(data[12]);
                    $("#txtPincode").val(data[13]);
                    $("#txtBarcode").val(data[14]);
                    $("#cmbActiveStatus").val(data[15]);
                    
            var ddlPassport = document.getElementById("cmbReferenceCode");
            var dvPassport = document.getElementById("DivOtherReference");
            dvPassport.style.display = ddlPassport.value == "0" ? "block" : "none";



                }
            });
        }


        
        function GetPaitentDetailsInitial() {
            
var MobileNo =document.getElementById("txtPatientMobileNo").value;
var datas = "&MobileNo=" + MobileNo; 
$.ajax({
    url: "Load/LoadPaitentDetailsbyMobile.php",
    method: "POST",
    data: datas,
    dataType: "json",
    success: function(data) {

        $("#txtPaitentID").val(data[0]); 
        $("#txtPatient").val(data[2]);
        $("#txtPatientEmail").val(data[3]);
        $("#txtWhatsappNo").val(data[4]);
        $("#txtAlternateNo").val(data[5]);
        $("#cmbReferenceCode").val(data[6]);
        $("#txtReferenceNo").val(data[7]);
        $("#cmbSex").val(data[8]);
        $("#dtDob").val(data[9]);
        $("#txtAddress").val(data[10]);
        $("#txtCity").val(data[11]);
        $("#cmbState").val(data[12]);
        $("#txtPincode").val(data[13]);
        $("#txtBarcode").val(data[14]);
        $("#cmbActiveStatus").val(data[15]);
        
var ddlPassport = document.getElementById("cmbReferenceCode");
var dvPassport = document.getElementById("DivOtherReference");
dvPassport.style.display = ddlPassport.value == "0" ? "block" : "none";



    }
});
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

        <div id="content" class="content">
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Patient</h4>
                           
                        </div>

                        <div class="panel-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                <input type='hidden' name='txtPaitentID' id='txtPaitentID'  />
                                    <label class="col-md-1 control-label">Mobile</label>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" placeholder="Mobile No"
                                            id='txtPatientMobileNo' name='txtPatientMobileNo' 
                                            onblur='GetPaitentDetailsInitial()' />
                                    </div>

                                    <label class="col-md-1 control-label">Name</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Name" id='txtPatient'
                                            name='txtPatient'  />
                                    </div>

                                    <label class="col-md-1 control-label">EmailID</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Email Id"
                                            id='txtPatientEmail' name='txtPatientEmail' />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-1 control-label">Whatsapp</label>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" placeholder="Mobile No"
                                            id='txtWhatsappNo' name='txtWhatsappNo' />
                                    </div>

                                    <label class="col-md-1 control-label">Alternate No</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="Alternate no"
                                            id='txtAlternateNo' name='txtAlternateNo' />
                                    </div>

                                    <label class="col-md-1 control-label">Reference</label>

                                    <div class="col-md-3">

                                        <select class="form-control" id='cmbReferenceCode' name='cmbReferenceCode'
                                            onchange='LoadReferenceDetails()'  >
                                            <option></option>
                                            <?php  
                            $sqli = "  select referenceid,reference from referencemaster where referencestatus='Active' ORDER BY 2 ";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value="'.$row['referenceid'].'">'.$row['reference'].'</option>';
                              }	
                            ?>
                                            <option value='0'>Others</option>
                                        </select>


                                        <div id='DivOtherReference' style='display:none'>
                                            <input type="text" class="form-control" placeholder="Other Reference"
                                                id='txtReferenceNo' name='txtReferenceNo' />

                                        </div>
                                    </div>


                                </div>

                                <div class="form-group">
                                    <label class="col-md-1 control-label">Sex</label>
                                    <div class="col-md-2">
                                        <select class="form-control" id='cmbSex' name='cmbSex'>

                                            <option value='Male'>Male</option>
                                            <option value='Female'>Female</option>

                                        </select>
                                    </div>

                                    <label class="col-md-1 control-label">DOB</label>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control" id='dtDob' name='dtDob' />
                                    </div>

                                    <label class="col-md-1 control-label">Address</label>
                                    <div class="col-md-3">
                                        <textarea class="form-control" id='txtAddress' name='txtAddress'></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-1 control-label">City</label>
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

                                    <label class="col-md-1 control-label">Pincode</label>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="Ex: 600001"
                                            id='txtPincode' name='txtPincode' />
                                    </div>
                                </div>


                                <div class="form-group">

                                    <label class="col-md-1 control-label">Barcode</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Barcode" id='txtBarcode'
                                            name='txtBarcode' />
                                    </div>
                                    <label class="col-md-1 control-label">Status</label>
                                    <div class="col-md-2">
                                        <select  class="form-control" name='cmbActiveStatus' id='cmbActiveStatus' >
                                            <option value='Active'>Active</option>
                                            <option value='In Active'>In Active</option>
                                        </select>
                                     
                                    </div>

                                </div>
 


                                <div class="form-group">
                                    <label class="col-md-3 control-label"> </label>
                                    <div class="col-md-9">
                                        <input type="button" class="btn btn-sm btn-success" onclick="SavePatient();"
                                            value='Save'>
                                        <input type="button" class="btn btn-sm btn-warning" onclick="Reset();"
                                            value='Cancel'>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Patient List</h4>
                        </div>

                        <div class="panel-body">
                            <form class="form-horizontal">
                                <div id="DivPatient" style="display: ;"></div>
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