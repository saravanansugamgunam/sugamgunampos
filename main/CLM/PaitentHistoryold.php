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

$PaitentId = $_GET['PID'];
$TokenID = $_GET['TID'];
$InvoiceNo = $_GET['INV'];
$TokenStatus = $_GET['S'];

$userid = $_SESSION["SESS_MEMBER_ID"];
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
    <link href="../assets/Custom/sweetalert.css" rel="stylesheet" />
    <script src="../assets/Custom/sweetalert2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link href="style/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../assets/Custom/nicEdit.js"></script>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>
    <link href=" Prescription/assets/jquery.signaturepad.css" rel="stylesheet">




    <script type="text/javascript">
    bkLib.onDomLoaded(function() {
        nicEditors.allTextAreas()
    });
    </script>

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




    <div id="ModalCloseConsultation" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Consulting Closure</h4>
                </div>

                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <label class="col-md-1 control-label"><b><u>Concession</u></b></label>
                            <div class="col-md-12">
                                <label class="radio-inline">
                                    <input type="radio" name="rdConcession" value="NoConcession" checked
                                        onclick='findselected()' />
                                    No Concession
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="rdConcession" value="FullRefund"
                                        onclick='findselected()' />
                                    Refund Full Amount
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="rdConcession" value="PartialRefund"
                                        onclick='findselected()' />
                                    Refund Partial Amount
                                    <input style='border-width: 2px;
											border-style: inset; padding: 1px 2px;border-radius: 4px' type='number' id='txtRefundAmount'
                                        name='txtRefundAmount' value='0' disabled />
                                </label>


                            </div>
                        </div>
                        <div class="col-md-12">
                            Next Appointment: &nbsp;&nbsp;
                            <input style='border-width: 0px;
											border-style: inset;  border-radius: 1px; border-bottom: 2px solid grey; ' type='date'
                                id='dtNextAppointment' name='dtNextAppointment' />

                        </div>
                        <br><br><br>

                        <label class="col-md-3 control-label">Remarks</label>
                        <input type='text' class='form-control' id='txtRemarks' name='txtRemarks' />
                    </div>

                    <br>
                    <br>
                    <br>


                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-success" onclick='SaveConsultingClosure()'>Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>



    <div id="ModalLoadStock" class="modal fade" role="dialog">
        <div class="modal-dialog  modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Current Stock</h4>
                </div>

                <div class="modal-body">

                    <div id='DivStockDetails'>

                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-success" onclick='SaveCancelConsultation()'>Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <div id="ModalCancelConsultation" class="modal fade" role="dialog">
        <div class="modal-dialog ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Consulting Cancel</h4>
                </div>

                <div class="modal-body">

                    <br>


                    <label class="col-md-3 control-label">Remarks</label>
                    <input type='text' class='form-control' id='txtCancelRemarks' name='txtCancelRemarks' />


                    <br>
                    <br>
                    <br>


                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-success" onclick='SaveCancelConsultation()'>Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modalTherapyClosure" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Therapy Completion</h4>
                </div>
                <div class="modal-bod">
                    <div class="col-md-12">
                        <!-- begin panel -->
                        <input type='hidden' name='txtIDforClosure' id='txtIDforClosure' />

                        <input type='hidden' name='txtPaymentID' id='txtPaymentID' />

                        <div class="col-md-12">
                            <div class="panel-body">
                                <input type='hidden' name='txtBalanceSittings' id='txtBalanceSittings' />

                                <div data-scrollbar="true" data-height="400px">

                                    <ul class="chats">

                                        <label> <u>Therapy Details</u> </label>
                                        <div id="DivTherapyDetails" class="email-content"></div>

                                    </ul>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">


                    <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                        data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>

    <div id="ModalPrescription" class="modal fade" role="dialog">
        <div class="modal-dialog ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Prescription</h4>
                </div>

                <div class="modal-body">


                    <div id='DivPrescription'> </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>







    <div id="ModalReference" class="modal fade" role="dialog">
        <div class="modal-dialog ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Reference</h4>
                </div>

                <div class="modal-body">

                    <label>Reference</label>


                    <select class="form-control" id='cmbReferenceCode' name='cmbReferenceCode'
                        onchange='LoadReferenceDetails()'>
                        <option></option>
                        <?php
                        $sqli = "  select referenceid,reference from referencemaster where referencestatus='Active' ORDER BY 2 ";
                        $result = mysqli_query($connection, $sqli);
                        while ($row = mysqli_fetch_array($result)) {
                            # code...

                            echo ' <option value="' . $row['referenceid'] . '">' . $row['reference'] . '</option>';
                        }
                        ?>
                    </select>


                    <div id='DivOtherReference' style='display:none'>
                        <input type="text" class="form-control" placeholder="Other Reference" id='txtEditedReference'
                            name='txtEditedReference' />

                    </div>


                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-success" data-dismiss="modal"
                        onclick='UpdateReference()'>Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div id="ModalNextAppointment" class="modal fade" role="dialog">
        <div class="modal-dialog ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Fix Next Appointment</h4>
                </div>

                <div class="modal-body">

                    <label>Appointment Date</label>
                    <input type='date' id='dtNextAppointmentNew' name='dtNextAppointmentNew' style='width: 150px;'
                        class='form-control' />

                    <label>Free Appointment</label>
                    <select class='form-control' id='cmbFreePaidAppointment' name='cmbFreePaidAppointment'
                        style='width: 150px;'>
                        <option value='Paid'>Paid</option>
                        <option value='Free'>Free</option>
                    </select>


                    <label>Remarks</label>
                    <input type='text' id='txtRemarksNew' name='txtRemarksNew' class='form-control'>


                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-success" data-dismiss="modal"
                        onclick='UpdateNextApopintment()'>Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <script>
    function UpdateDoctor() {
        var DoctorStatus = $("input[name='rdDoctorStatus']:checked").val();
        var UpdatedDoctorName = document.getElementById("txtDoctorUpdatedName").value;
        var DoctorID = document.getElementById("txtDoctorID").value;
        var UpdatedMobileNo = document.getElementById("txtDoctorUpdatedMobile").value;
        var datas = "&DoctorID=" + encodeURIComponent(DoctorID) +
            "&UpdatedDoctorName=" + encodeURIComponent(UpdatedDoctorName) +
            "&DoctorStatus=" + encodeURIComponent(DoctorStatus) +
            "&UpdatedMobileNo=" + encodeURIComponent(UpdatedMobileNo);

        $.ajax({
            url: "Save/UpdateDoctor.php",
            method: "POST",
            data: datas,
            success: function(data) {

                if (data == "Added Successfuly") {
                    swal("Doctor!", data, "success");
                    Reset();
                } else {
                    swal("Alert!", data, "warning");
                    Reset();
                }

            }
        });
    }


    function LoadReferenceDetails() {

        var RefID = document.getElementById("cmbReferenceCode").value;

        var ReferenceName = document.getElementById("txtEditedReference").value;

        var SelectedValue = $("#cmbReferenceCode option:selected").text();

        var ddlPassport = document.getElementById("cmbReferenceCode");
        var dvPassport = document.getElementById("DivOtherReference");
        dvPassport.style.display = ddlPassport.value == "0" ? "block" : "none";

        if (RefID == '0') {
            document.getElementById("txtEditedReference").value = '';
            document.getElementById("txtEditedReference").focus();
        } else {
            document.getElementById("txtEditedReference").value = SelectedValue;


        }

    }

    function UpdateReference()

    {
        var PaitentCode = document.getElementById("txtPaitentID").value;
        var ReferenceCode = document.getElementById("cmbReferenceCode").value;
        var Reference = document.getElementById("txtEditedReference").value;
        var datas = "&PaitentCode=" + encodeURIComponent(PaitentCode) +
            "&ReferenceCode=" + encodeURIComponent(ReferenceCode) +
            "&Reference=" + encodeURIComponent(Reference);

        $.ajax({
            url: "Save/UpdateReference.php",
            method: "POST",
            data: datas,
            success: function(data) {
                window.location.reload();
            }
        });

    }

    function UpdateNextApopintment()

    {
        var PaitentCode = document.getElementById("txtPaitentID").value;
        var NextAppointment = document.getElementById("dtNextAppointmentNew").value;
        var FreePaid = document.getElementById("cmbFreePaidAppointment").value;



        var Remarks = document.getElementById("txtRemarksNew").value;
        var datas = "&PaitentCode=" + encodeURIComponent(PaitentCode) +
            "&NextAppointment=" + encodeURIComponent(NextAppointment) +
            "&FreePaid=" + encodeURIComponent(FreePaid) +
            "&Remarks=" + encodeURIComponent(Remarks);

        $.ajax({
            url: "Save/UpdateNextAppointment.php",
            method: "POST",
            data: datas,
            success: function(data) {

                window.location.reload();
            }
        });

    }



    function UpdateNextApopintmentOnClosure()

    {
        var PaitentCode = document.getElementById("txtPaitentID").value;
        var NextAppointment = document.getElementById("dtNextAppointment").value;
        var Remarks = document.getElementById("txtRemarks").value;
        var datas = "&PaitentCode=" + encodeURIComponent(PaitentCode) +
            "&NextAppointment=" + encodeURIComponent(NextAppointment) +
            "&Remarks=" + encodeURIComponent(Remarks);

        $.ajax({
            url: "Save/UpdateNextAppointment.php",
            method: "POST",
            data: datas,
            success: function(data) {

                window.location.reload();
            }
        });

    }

    function SaveConsultation() {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1500
        })
    }

    function SaveConsultingClosure() {
        var RefundStatus = $("input[name='rdConcession']:checked").val();
        var Remarks = document.getElementById("txtRemarks").value;
        var RefundAmount = document.getElementById("txtRefundAmount").value;
        var PaitentID = document.getElementById("txtPaitentID").value;
        var TokenNo = document.getElementById("txtTokenID").value;
        var InvoiceNo = document.getElementById("txtInvoiceNo").value;
        var NextAppointment = document.getElementById("dtNextAppointment").value;

        var datas = "&RefundStatus=" + encodeURIComponent(RefundStatus) +
            "&Remarks=" + encodeURIComponent(Remarks) +
            "&RefundAmount=" + encodeURIComponent(RefundAmount) +
            "&PaitentID=" + encodeURIComponent(PaitentID) +
            "&InvoiceNo=" + encodeURIComponent(InvoiceNo) +
            "&NextAppointment=" + encodeURIComponent(NextAppointment) +
            "&TokenNo=" + encodeURIComponent(TokenNo);

        // swal(datas);

        $.ajax({
            url: "Save/SaveConsultingClosure.php",
            method: "POST",
            data: datas,
            success: function(data) {
                // swal(data);

                if (data == 1) {
                    // windows.location('TokenDetails.php?MID=31');
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Token Closed Sucessfully',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    // window.location.assign("TokenDetails.php?MID=31");
                    setTimeout(function() {
                        window.location.href =
                            "TokenDetails.php?MID=31"; //will redirect to your blog page (an ex: blog.html)
                    }, 1500); //will call the function after 2 secs.



                } else {
                    swal("Alert!", "Unable to Close Token", "warning");

                }
            }
        });
        // UpdateNextApopintmentOnClosure();
    }

    function SaveCancelConsultation() {
        var RefundStatus = $("input[name='rdConcession']:checked").val();
        var Remarks = document.getElementById("txtCancelRemarks").value;
        var RefundAmount = document.getElementById("txtRefundAmount").value;
        var PaitentID = document.getElementById("txtPaitentID").value;
        var TokenNo = document.getElementById("txtTokenID").value;
        var InvoiceNo = document.getElementById("txtInvoiceNo").value;

        var datas = "&RefundStatus=" + encodeURIComponent(RefundStatus) +
            "&Remarks=" + encodeURIComponent(Remarks) +
            "&RefundAmount=" + encodeURIComponent(RefundAmount) +
            "&PaitentID=" + encodeURIComponent(PaitentID) +
            "&InvoiceNo=" + encodeURIComponent(InvoiceNo) +
            "&TokenNo=" + encodeURIComponent(TokenNo);

        $.ajax({
            url: "Save/SaveCancelConsultation.php",
            method: "POST",
            data: datas,
            success: function(data) {
                // swal(data);

                if (data == 1) {
                    // windows.location('TokenDetails.php?MID=31');
                    window.location.assign("TokenDetails.php?MID=31")

                } else {
                    swal("Alert!", data, "warning");

                }



            }
        });
    }


    function GetPointID(x) {

        var row = x.parentNode.rowIndex;

        document.getElementById("txtIDforClosure").value = document.getElementById("tblTherapyRegister").rows[1].cells
            .namedItem("BookingID").innerHTML;

        LoadTherapyTransactions();
    }

    function LoadTherapyTransactions() {

        var BookingID = document.getElementById("txtIDforClosure").value;


        var datas = "&BookingID=" + BookingID;
        // alert(datas);
        $.ajax({
            url: "Load/LoadTherapyTransactions.php",
            method: "POST",
            data: datas,
            success: function(data) {
                // alert(data);
                $('#DivTherapyDetails').html(data);

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
            <?php include("CLMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->
        <script>
        function LoadPaitentHistory() {
            var Dumy = 0;
            var PaitentID = document.getElementById("txtPaitentID").value;

            var datas = "&PaitentID=" + PaitentID;

            $.ajax({
                url: "Load/LoadPaitentHistory.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivPaitentHistory').html(data);


                }
            });

        }

        function LoadTherapyHistory() {
            var Dumy = 0;
            var PaitentID = document.getElementById("txtPaitentID").value;

            var datas = "&PaitentID=" + PaitentID;

            $.ajax({
                url: "Load/LoadPaitentHistory.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivTherapyHistory').html(data);


                }
            });

        }







        function LoadNextApppointment() {
            var Dumy = 0;
            var PaitentID = document.getElementById("txtPaitentID").value;

            var datas = "&PaitentID=" + PaitentID;

            $.ajax({
                url: "Load/LoadNextAppointment.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#NextAppointmentdate_span").html(data[0]);



                }
            });

        }

        function LoadTherapyHistorye() {
            var Dumy = 0;
            var PaitentID = document.getElementById("txtPaitentID").value;

            var datas = "&PaitentID=" + PaitentID;

            $.ajax({
                url: "Load/LoadNextAppointmentDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivAppointmentList').html(data);


                }
            });

        }





        function LoadPaitentDetails() {
            var Dumy = 0;
            var PaitentID = document.getElementById("txtPaitentID").value;
            var TokenNo = document.getElementById("txtTokenID").value;
            var datas = "&PaitentID=" + PaitentID + "&TokenNo=" + TokenNo;

            $.ajax({
                url: "Load/LoadPaitentDetailsforHistory.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivPaitentDetails').html(data);

                }
            });
        }

        function LoadDocumentList() {
            var Dumy = 0;
            var PaitentID = document.getElementById("txtPaitentID").value;

            var datas = "&PaitentID=" + PaitentID;

            $.ajax({
                url: "Load/LoadDocumentList.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivDocumentList').html(data);


                }
            });
        }

        function SaveDiscountPaitent() {
            var PaitentID = document.getElementById("txtPaitentID").value;

            var MedicineDiscount = document.getElementById("txtDiscountMedicine").value;
            var ConsultingDiscount = document.getElementById("txtDiscountConsulting").value;
            var TherapyDiscount = document.getElementById("txtDiscountTherapy").value;

            if (MedicineDiscount > 0 || ConsultingDiscount > 0 || TherapyDiscount > 0) {
                var DiscountStatus = 'YES';
            } else {
                var DiscountStatus = 'No';
            }
            var datas = "&PaitentID=" + PaitentID +
                "&MedicineDiscount=" + MedicineDiscount +
                "&ConsultingDiscount=" + ConsultingDiscount +
                "&TherapyDiscount=" + TherapyDiscount +
                "&DiscountStatus=" + DiscountStatus;
            // alert(datas);
            $.ajax({
                url: "Save/UpdateDiscountCustomer.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 1000);

                }
            });





        }

        // function LoadRecomendation() {
        //     var Dumy = 0;
        //     var PaitentID = document.getElementById("txtPaitentID").value;

        //     var datas = "&PaitentID=" + PaitentID;
        //     // alert(datas);
        //     $.ajax({
        //         url: "Load/LoadRecomendedTherapy.php",
        //         method: "POST",
        //         data: datas,
        //         success: function(data) {
        //             // alert(data);
        //             $('#DivRecomendedList').html(data);


        //         }
        //     });
        // }


        function LoadRecomendation() {

            var ID = document.getElementById("txtPaitentID").value;
            var TherapyStatus = 'All';
            var datas = "&ID=" + ID;
            // alert(datas);
            $.ajax({
                url: "Load/LoadTherapyListTherapy.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivRecomendedList').html(data);


                }
            });
        }


        function LoadPrescriptionList() {
            var Dumy = 0;
            var PaitentID = document.getElementById("txtPaitentID").value;

            var datas = "&PaitentID=" + PaitentID;

            $.ajax({
                url: "Load/LoadPrescriptionList.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivPrescriptionList').html(data);


                }
            });
        }

        function DisplayPrescription(x) {
            var Dumy = 0;
            var PaitentID = document.getElementById("txtPaitentID").value;
            var PrescriptionID = x;

            var datas = "&PaitentID=" + PaitentID + "&PrescriptionID=" + PrescriptionID;

            $.ajax({
                url: "Load/LoadPrescription.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivPrescription').html(data);


                }
            });
        }

        function SavePrescription() {
            var Dumy = 0;
            var PaitentID = document.getElementById("txtPaitentID").value;
            var DoctorID = document.getElementById("cmbDoctor").value;
            var nicE = new nicEditors.findEditor('txtDescription');
            Prescription = nicE.getContent();

            var datas = "&PaitentID=" + PaitentID + "&Prescription=" + encodeURIComponent(Prescription) +
                "&DoctorID=" + encodeURIComponent(DoctorID);

            $.ajax({
                url: "Save/SavePrescription.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // swal(data);
                    swal("Paitent History!", "Prescription Added", "success");
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 1000);
                }
            });
        }

        function AddRecomendedTherapy() {
            var Dumy = 0;
            var PaitentID = document.getElementById("txtPaitentID").value;
            var InvoiceNo = document.getElementById("txtInvoiceNo").value;
            var DoctorID = document.getElementById("cmbTherapyDoctor").value;
            var Therapy = document.getElementById("cmbTherapyName").value;
            var TherapyDate = document.getElementById("dtTherapyDate").value;
            var Sitting = document.getElementById("txtSittings").value;
            var TherapyFee = document.getElementById("txtTherapyFee").value;
            var TherapyDiscount = document.getElementById("txtTherapyDiscount").value;


            var datas = "&PaitentID=" + PaitentID +
                "&DoctorID=" + encodeURIComponent(DoctorID) +
                "&Therapy=" + encodeURIComponent(Therapy) +
                "&InvoiceNo=" + encodeURIComponent(InvoiceNo) +
                "&Sitting=" + encodeURIComponent(Sitting) +
                "&TherapyDiscount=" + encodeURIComponent(TherapyDiscount) +
                "&TherapyDate=" + encodeURIComponent(TherapyDate);

            $.ajax({
                url: "Save/SaveRecomendedTherapy.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    // //  swal("Paitent History!", "Recomendation added", "success");
                    LoadRecomendation();
                }
            });
        }

        function GetRowID(x) {

            var row = x.parentNode.rowIndex;
            document.getElementById("txtDoctorID").value = document.getElementById("indextable").rows[row].cells
                .namedItem("DoctorID").innerHTML;
            document.getElementById("txtDoctorUpdatedName").value = document.getElementById("indextable").rows[row]
                .cells.namedItem("Doctor").innerHTML;
            document.getElementById("txtDoctorUpdatedMobile").value = document.getElementById("indextable").rows[row]
                .cells.namedItem("mobileno").innerHTML;
            document.getElementById("txtDoctorStatus").value = document.getElementById("indextable").rows[row].cells
                .namedItem("DoctorStatus").innerHTML;

        }


        function Reset() {

            LoadPaitentDetails();
            // LoadPaitentHistory();
            // LoadDocumentList();
            // LoadPrescriptionList();
            // LoadSalesReport();
            // LoadRecomendation();
            // LoadTherapyRegister();
            // LoadTherapyHistory();
            // LoadNextApppointment();
            // LoadFamilyDetails();
        }



        function DeleteTherapy(x, y) {

            var BookingID = x;
            var BookingUniqueID = y;
            var datas = "&BookingID=" + BookingID + "&BookingUniqueID=" + BookingUniqueID;
            // alert(datas);
            $.ajax({
                url: "Delete/DeleteRecomendedTherapy.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    if (data == 1) {
                        LoadRecomendation();
                    } else {
                        alert("Past dated recomendations can't be deleted");
                    }

                }
            });

        }


        function findselected() {
            var result = document.querySelector('input[name="rdConcession"]:checked').value;
            if (result == "PartialRefund") {

                document.getElementById("txtRefundAmount").removeAttribute('disabled');
                document.getElementById("txtRefundAmount").value = 0;
            } else {
                document.getElementById("txtRefundAmount").setAttribute('disabled', true);
                document.getElementById("txtRefundAmount").value = 0;
            }
        }


        function LoadSalesReport() {
            // alert(1);

            var Type = 'Detail';
            var Paitent = document.getElementById("txtPaitentID").value;

            var datas = "&Paitent=" + Paitent + "&Type=" + Type;
            // alert(datas);
            $.ajax({
                url: "Load/LoadSalesSearch.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivPaitentBillingHistory').html(data);


                }
            });
        }

        function LoadFamilyDetails() {
            // alert(1);

            var Type = 'Detail';
            var Paitent = document.getElementById("txtPaitentID").value;

            var datas = "&Paitent=" + Paitent + "&Type=" + Type;
            // alert(datas);
            $.ajax({
                url: "Load/LoadFamilyDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivFamily').html(data);


                }
            });
        }




        function LoadTherapyStatus() {
            // alert(1);

            var Type = 'Detail';
            var Paitent = document.getElementById("txtPaitentID").value;

            var datas = "&Paitent=" + Paitent + "&Type=" + Type;
            // alert(datas);
            $.ajax({
                url: "Load/LoadTherapyStatus.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivTherapyStatus').html(data);


                }
            });
        }


        function LoadTherapyRegister() {

            var ID = document.getElementById("txtPaitentID").value;
            var TherapyStatus = 'All';
            var datas = "&ID=" + ID + "&TherapyStatus=" + TherapyStatus;
            // alert(datas);
            $.ajax({
                url: "Load/LoadTherapyList.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivTherapyRegisterList').html(data);


                }
            });
        }


        function LoadStockDetails() {
            // alert(1);

            var Type = 'Detail';
            var Paitent = document.getElementById("txtPaitentID").value;

            var datas = "&Paitent=" + Paitent + "&Type=" + Type;
            // alert(datas);
            $.ajax({
                url: "Load/LoadStockDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivStockDetails').html(data);


                }
            });
        }

        function PlaySound() {
            var TokenID = document.getElementById("txtTokenID").value;
            var UserID = <?php echo $userid; ?>;
            var RoomID = 0;
            if (UserID == 13) {
                RoomID = 1;
            } else {
                RoomID = 2;
            }

            var AudioID = 'audio';

            AudioID = AudioID.concat(RoomID, TokenID);

            var audio = document.getElementById(AudioID);
            audio.play();
        }


        function LoadProductDetails() {

            var StockItemID = document.getElementById("cmbTherapyName").value;
            var datas = "&StockItemID=" + StockItemID;
            // alert(datas);
            $.ajax({
                url: "Load/LoadProductDetailsBilling.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#txtTherapyFee").val(data[0]);
                    document.getElementById("txtSittings").focus();


                }
            });
        }


        function TherapyRecomendationURL() {


            var PID = <?php echo $PaitentId; ?>;
            var DID = <?php echo $userid; ?>;
            var INV = <?php echo $InvoiceNo; ?>;
            var TID = <?php echo $TokenID; ?>;


            var Status = 'O';

            var URL1 = '../TPM/TherapyBookingRecomendation.php?MID=56&DID=';
            var TherapyRecomendedURL = URL1.concat(DID, '&PID=', PID, '&INV=', INV, '&TID=', TID, '&S=', Status);


            window.open(TherapyRecomendedURL);
            // TPM/TherapyBookingRecomendation.php?MID=56&DID=13&PID=569#modal-close
        }
        </script>

        <div id="content" class="content">
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Details
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button class='btn btn-info m-r-5' href='#ModalLoadStock' data-toggle='modal'
                                    onclick='LoadStockDetails()'><i class='fa  fa-suitcase'></i> Check Stock
                                </button>


                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                                <?php

                                if ($TokenStatus == 'O') {
                                    echo "<button class='btn btn-success    ><i class='fa  fa-check-circle' onclick='SaveConsultingClosure()' ></i> Complete Consultation </button>";
                                    echo "<button class='btn btn-danger m-r-5' href='#ModalCancelConsultation'   data-toggle='modal' ><i class='fa  fa-times-circle-o' ></i> Cancel </button>";
                                    echo " <button style='float:right;' class='btn btn-warning' onclick='PlaySound()'>
                                Token Announcement
                            </button> ";
                                }

                                ?>



                            </h4>


                        </div>


                        <audio id="audio11" src="Sound\R1_1.mp3"></audio>
                        <audio id="audio12" src="Sound\R1_2.mp3"></audio>
                        <audio id="audio13" src="Sound\R1_3.mp3"></audio>
                        <audio id="audio14" src="Sound\R1_4.mp3"></audio>
                        <audio id="audio15" src="Sound\R1_5.mp3"></audio>
                        <audio id="audio16" src="Sound\R1_6.mp3"></audio>
                        <audio id="audio17" src="Sound\R1_7.mp3"></audio>
                        <audio id="audio18" src="Sound\R1_8.mp3"></audio>
                        <audio id="audio19" src="Sound\R1_9.mp3"></audio>
                        <audio id="audio110" src="Sound\R1_10.mp3"></audio>
                        <audio id="audio111" src="Sound\R1_11.mp3"></audio>
                        <audio id="audio112" src="Sound\R1_12.mp3"></audio>
                        <audio id="audio113" src="Sound\R1_13.mp3"></audio>
                        <audio id="audio114" src="Sound\R1_14.mp3"></audio>
                        <audio id="audio115" src="Sound\R1_15.mp3"></audio>
                        <audio id="audio116" src="Sound\R1_16.mp3"></audio>
                        <audio id="audio117" src="Sound\R1_17.mp3"></audio>
                        <audio id="audio118" src="Sound\R1_18.mp3"></audio>
                        <audio id="audio119" src="Sound\R1_19.mp3"></audio>
                        <audio id="audio120" src="Sound\R1_20.mp3"></audio>
                        <audio id="audio121" src="Sound\R1_21.mp3"></audio>
                        <audio id="audio122" src="Sound\R1_22.mp3"></audio>
                        <audio id="audio123" src="Sound\R1_23.mp3"></audio>
                        <audio id="audio124" src="Sound\R1_24.mp3"></audio>
                        <audio id="audio125" src="Sound\R1_25.mp3"></audio>
                        <audio id="audio126" src="Sound\R1_26.mp3"></audio>
                        <audio id="audio127" src="Sound\R1_27.mp3"></audio>
                        <audio id="audio128" src="Sound\R1_28.mp3"></audio>
                        <audio id="audio129" src="Sound\R1_29.mp3"></audio>
                        <audio id="audio130" src="Sound\R1_30.mp3"></audio>
                        <audio id="audio131" src="Sound\R1_31.mp3"></audio>
                        <audio id="audio132" src="Sound\R1_32.mp3"></audio>
                        <audio id="audio133" src="Sound\R1_33.mp3"></audio>
                        <audio id="audio134" src="Sound\R1_34.mp3"></audio>
                        <audio id="audio135" src="Sound\R1_35.mp3"></audio>
                        <audio id="audio136" src="Sound\R1_36.mp3"></audio>
                        <audio id="audio137" src="Sound\R1_37.mp3"></audio>
                        <audio id="audio138" src="Sound\R1_38.mp3"></audio>
                        <audio id="audio139" src="Sound\R1_39.mp3"></audio>
                        <audio id="audio140" src="Sound\R1_40.mp3"></audio>

                        <audio id="audio141" src="Sound\R1_41.mp3"></audio>


                        <audio id="audio21" src="Sound\R2_1.mp3"></audio>
                        <audio id="audio22" src="Sound\R2_2.mp3"></audio>
                        <audio id="audio23" src="Sound\R2_3.mp3"></audio>
                        <audio id="audio24" src="Sound\R2_4.mp3"></audio>
                        <audio id="audio25" src="Sound\R2_5.mp3"></audio>
                        <audio id="audio26" src="Sound\R2_6.mp3"></audio>
                        <audio id="audio27" src="Sound\R2_7.mp3"></audio>
                        <audio id="audio28" src="Sound\R2_8.mp3"></audio>
                        <audio id="audio29" src="Sound\R2_9.mp3"></audio>
                        <audio id="audio210" src="Sound\R2_10.mp3"></audio>
                        <audio id="audio211" src="Sound\R2_11.mp3"></audio>
                        <audio id="audio212" src="Sound\R2_12.mp3"></audio>
                        <audio id="audio213" src="Sound\R2_13.mp3"></audio>
                        <audio id="audio214" src="Sound\R2_14.mp3"></audio>
                        <audio id="audio215" src="Sound\R2_15.mp3"></audio>
                        <audio id="audio216" src="Sound\R2_16.mp3"></audio>
                        <audio id="audio217" src="Sound\R2_17.mp3"></audio>
                        <audio id="audio218" src="Sound\R2_18.mp3"></audio>
                        <audio id="audio219" src="Sound\R2_19.mp3"></audio>
                        <audio id="audio220" src="Sound\R2_20.mp3"></audio>
                        <audio id="audio221" src="Sound\R2_21.mp3"></audio>
                        <audio id="audio222" src="Sound\R2_22.mp3"></audio>
                        <audio id="audio223" src="Sound\R2_23.mp3"></audio>
                        <audio id="audio224" src="Sound\R2_24.mp3"></audio>
                        <audio id="audio225" src="Sound\R2_25.mp3"></audio>
                        <audio id="audio226" src="Sound\R2_26.mp3"></audio>
                        <audio id="audio227" src="Sound\R2_27.mp3"></audio>
                        <audio id="audio228" src="Sound\R2_28.mp3"></audio>
                        <audio id="audio229" src="Sound\R2_29.mp3"></audio>
                        <audio id="audio230" src="Sound\R2_30.mp3"></audio>


                        <div class="panel-body">

                            <div id='DivPaitentDetails'></div>

                            <?php
                            if ($TokenStatus == 'O') {
                                echo "<lable>Status: <b>Open</b></lable>";
                            } else if ($TokenStatus == 'C') {
                                echo "<lable>Status: <b>Completed</b></lable>";
                            } else if ($TokenStatus == 'X') {
                                echo "<lable>Status: <b>Cancelled</b></lable>";
                            }
                            ?>


                            <div class="col-md-12">
                                <br>


                                <ul class="nav nav-tabs">
                                    <li class="active" onclick='LoadPrescriptionList();'><a href="#default-tab-1"
                                            data-toggle="tab">Prescription</a></li>

                                    <li class="" onclick='LoadPaitentHistory();'><a href="#default-tab-3"
                                            data-toggle="tab">Consulting - History</a></li>

                                    <li class="" onclick='LoadSalesReport();'><a href="#default-tab-5"
                                            data-toggle="tab">Medicine - History</a></li>

                                    <li class="" onclick='LoadTherapyRegister();'><a href="#default-tab-7"
                                            data-toggle="tab">Therapy - History</a></li>

                                    <li class="" onclick='LoadNextApppointment();'><a href="#default-tab-4"
                                            data-toggle="tab">Next Apppointment</a></li>

                                    <li class="" onclick='LoadRecomendation();'><a href="#default-tab-6"
                                            data-toggle="tab">Therapy Recomendation</a>

                                    <li class="" onclick='LoadDocumentList();'><a href="#default-tab-2"
                                            data-toggle="tab">Documents</a></li>

                                    <li class="" onclick='LoadFamilyDetails();'><a href="#default-tab-8"
                                            data-toggle="tab">Family Members</a></li>

                                    <li class="" onclick='LoadFreeFollowup();'><a href="#default-tab-9"
                                            data-toggle="tab">Free Followup</a></li>


                                    <li class="" onclick='LoadLiabilityTransfer();'><a href="#default-tab-10"
                                            data-toggle="tab">Liability Transfer</a></li>

                                    </li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="default-tab-1">

                                        <div class="col-md-12">
                                            <button class="btn btn-info" data-toggle="collapse" data-target="#demo">Add
                                                Prescription </button>


                                            <a class="btn btn-warning"
                                                href='Prescription.php?PID=<?php echo $PaitentId; ?>&INV=<?php echo $InvoiceNo; ?>&TID=<?php echo $TokenID; ?>&S=<?php echo $TokenStatus; ?>&MID=31'>
                                                Add Handwiten Prescription </a>


                                            <div id="demo" class="collapse">
                                                <br>





                                                <style>
                                                .ui-autocomplete {
                                                    cursor: pointer;
                                                    height: 120px;
                                                    overflow-y: scroll;
                                                }
                                                </style>

                                                <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
                                                <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('.search-box input[type="text"]').on("keyup input",
                                                        function() {
                                                            alert(1);
                                                            /* Get input value on change */
                                                            var inputVal = $(this).val();
                                                            var resultDropdown = $(this).siblings(
                                                                ".result");
                                                            if (inputVal.length) {
                                                                $.get("ajax-live-search.php", {
                                                                    term: inputVal
                                                                }).done(function(data) {
                                                                    // Display the returned data in browser
                                                                    resultDropdown.html(data);
                                                                });
                                                            } else {
                                                                resultDropdown.empty();
                                                            }
                                                        });

                                                    // Set search input value on click of result item
                                                    $(document).on("click", ".result p", function() {

                                                        $(".result p").hide();
                                                        $(this).parents(".search-box").find(
                                                            'input[type="text"]').val($(
                                                                this)
                                                            .text());
                                                        $(this).parent(".result").empty();

                                                        // LoadCustomerDetails();
                                                    });
                                                });

                                                $(document).ready(function() {
                                                    $("#txtSerialNoMobile").on('keyup', function() {
                                                        $("#txtSerialNoMobileNewSercive").val($(this)
                                                            .val())
                                                    });
                                                });
                                                </script>



                                                <div class="search-box">
                                                    <input type="text" id='txtSerialNoMobile' autocomplete="on"
                                                        placeholder="Serial or Mobile noee" />
                                                    <div class="result"></div>

                                                    <input type="text" id='txtSerialNoMobileNewSercive'
                                                        autocomplete="on" placeholder="Serial or Mobile noee" />

                                                </div>








                                                Doctor: &nbsp;&nbsp; <select class="selectpicker form-control"
                                                    data-show-subtext="true" data-live-search="true"
                                                    data-style="btn-white" id='cmbDoctor' name='cmbDoctor'
                                                    style="width:150px;">
                                                    <option selected></option>
                                                    <?php
                                                    $sqli = "SELECT userid,username FROM usermaster where designationid='9' and  activestatus='Active'";
                                                    $result = mysqli_query($connection, $sqli);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        # code...

                                                        echo ' <option value=' . $row['userid'] . '>' . $row['username'] . '</option>';
                                                    }
                                                    ?>
                                                </select>

                                                <br>
                                                <textarea class="form-control" rows="5" id='txtDescription'
                                                    name='txtDescription'
                                                    style="width: 900px; height: 100px;"></textarea>

                                                <button class="btn btn-success"
                                                    onclick="SavePrescription()">Save</button>


                                            </div>





                                            <div id='DivPrescriptionList'> </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="default-tab-2">



                                        <body>
                                            <form id="uploadForm" enctype="multipart/form-data" method="post">



                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="col-md-12">

                                                            <label>Annexure </label>
                                                            <input type='text' class="form-control" id='txtDocumentName'
                                                                name='txtDocumentName' />

                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>File </label>
                                                            <input type="file" class="form-control" name="file"
                                                                id="fileupload">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>&nbsp; </label>
                                                            <input type="submit" name="submit" value="Upload"
                                                                class="btn btn-primary  m-r-5" />
                                                        </div>
                                                    </div>
                                                </div>


                                                <br>
                                                <input type='hidden' id='txtPaitentID' name='txtPaitentID'
                                                    value='<?php echo $PaitentId ?>' />
                                                <input type='hidden' id='txtTokenID' name='txtTokenID'
                                                    value='<?php echo $TokenID ?>' />
                                                <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo'
                                                    value='<?php echo $InvoiceNo ?>' />

                                                <input type='hidden' id='txtQuery' name='txtQuery' />


                                                <br>
                                            </form>

                                            <div class="progress">
                                                <div class="progress-bar"></div>
                                            </div>
                                            <div id="uploadsuccessfully"></div>
                                            <script
                                                src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
                                            </script>
                                            <script>
                                            $(document).ready(function() {
                                                $("#uploadForm").on('submit', function(e) {
                                                    e.preventDefault();


                                                    $.ajax({
                                                        xhr: function() {
                                                            var xhr = new window
                                                                .XMLHttpRequest();
                                                            xhr.upload.addEventListener(
                                                                "progress",
                                                                function(evt) {
                                                                    if (evt
                                                                        .lengthComputable
                                                                    ) {
                                                                        var percentComplete =
                                                                            ((evt.loaded /
                                                                                    evt
                                                                                    .total
                                                                                ) *
                                                                                100);
                                                                        $(".progress-bar")
                                                                            .width(
                                                                                percentComplete +
                                                                                '%');
                                                                        $(".progress-bar")
                                                                            .html(
                                                                                percentComplete +
                                                                                '%');
                                                                    }
                                                                }, false);
                                                            return xhr;
                                                        },
                                                        type: 'POST',
                                                        url: 'upload.php?PAI=1',
                                                        data: new FormData(this),
                                                        contentType: false,
                                                        cache: false,
                                                        processData: false,
                                                        beforeSend: function() {
                                                            $(".progress-bar").width('0%');
                                                            $('#uploadsuccessfully').html(
                                                                '<img src="images/ajaxloading.gif"/>'
                                                            );
                                                        },
                                                        error: function() {
                                                            $('#uploadsuccessfully').html(
                                                                '<p style="color:#EA4335;">File upload failed, please try again.</p>'
                                                            );
                                                        },
                                                        success: function(resp) {
                                                            //alert(resp);
                                                            document.getElementById(
                                                                "txtQuery").value = resp;
                                                            if (resp == 1) {

                                                                $('#uploadForm')[0].reset();
                                                                $('#uploadsuccessfully')
                                                                    .html(
                                                                        '<p style="color:#28A74B;">File has uploaded successfully!</p>'
                                                                    );
                                                            } else if (resp == 'err') {
                                                                $('#uploadsuccessfully')
                                                                    .html(
                                                                        '<p style="color:#EA4335;">Please select a valid file to upload.</p>'
                                                                    );
                                                            }
                                                        }
                                                    });
                                                });
                                                $("#fileupload").change(function() {
                                                    var allowedTypes = ['application/pdf',
                                                        'application/msword', 'image/jpeg',
                                                        'image/png', 'image/jpg', 'image/gif'
                                                    ];
                                                    var file = this.files[0];
                                                    var fileType = file.type;
                                                    if (!allowedTypes.includes(fileType)) {
                                                        alert(
                                                            'Please select a valid file (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF).'
                                                        );
                                                        $("#fileupload").val('');
                                                        return false;
                                                    }
                                                });
                                            });
                                            </script>
                                        </body>
                                        <label><u><b>Document List</b></u></label>
                                        <div id='DivDocumentList'> </div>





                                    </div>
                                    <div class="tab-pane fade" id="default-tab-3">

                                        <h3 class="m-t-10"> Consultation History</h3>
                                        <div id='DivPaitentHistory'> </div>


                                    </div>


                                    <div class="tab-pane fade" id="default-tab-5">

                                        <h3 class="m-t-10"> Medicine History</h3>
                                        <div id='DivPaitentBillingHistory'> </div>

                                    </div>

                                    <div class="tab-pane fade" id="default-tab-4">


                                        <div class="col-md-6">
                                            <h3 class="m-t-10">
                                                <button class='btn btn-success m-r-5' href='#ModalNextAppointment'
                                                    data-toggle='modal'><i class='fa  fa-calendar'></i>
                                                    Add Appointment </button>

                                                <br>
                                                <br>
                                                Next Appointment: <span id='NextAppointmentdate_span'> </span>

                                            </h3>
                                        </div>

                                        <div class="col-md-6">

                                            <label>Appointment vs Visit</label>

                                            <br>

                                            <div id='DivAppointmentList'>

                                            </div>

                                        </div>


                                    </div>


                                    <div class="tab-pane fade" id="default-tab-7">

                                        <div id='DivTherapyRegisterList'> </div>
                                    </div>

                                    <div class="tab-pane fade" id="default-tab-8">

                                        <h3 class="m-t-10"> Family Details</h3>
                                        <div id='DivFamily'> </div>


                                    </div>
                                    <div class="tab-pane fade" id="default-tab-6">

                                        <div class="row">
                                            <input type='hidden' id='txtTherapyID' name='txtTherapyID' />

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <br>
                                                    <div class="controls">

                                                        <input type="button" class="btn btn-sm btn-success"
                                                            onclick="TherapyRecomendationURL();"
                                                            value='Add Recomendation' />
                                                    </div>
                                                </div>
                                            </div>

                                            <div style='display:none'>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label> Date</label><br>
                                                        <input type="date" class="form-control" placeholder=""
                                                            id='dtTherapyDate' name='dtTherapyDate' />

                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label> Assign to Doctor</label><br>
                                                        <select class="form-control" id='cmbTherapyDoctor'
                                                            name='cmbTherapyDoctor' data-style="btn-white">
                                                            <option selected></option>

                                                            <?php
                                                            $sqli = "SELECT userid,username FROM usermaster where designationid='9' and  activestatus='Active'";
                                                            $result = mysqli_query($connection, $sqli);
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                # code...

                                                                echo ' <option value=' . $row['userid'] . '>' . $row['username'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label> Therapy</label><br>
                                                        <select class="form-control" id='cmbTherapyName'
                                                            name='cmbTherapyName' data-style="btn-white"
                                                            onchange="LoadProductDetails();">
                                                            <option selected></option>

                                                            <?php
                                                            $sqli = " SELECT consultationid,consultationname FROM  consultationmaster WHERE activestatus ='Active' and consultingtype='Therapy'";
                                                            $result = mysqli_query($connection, $sqli);
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                # code...

                                                                echo ' <option value=' . $row['consultationid'] . '>' . $row['consultationname'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>

                                                    </div>
                                                </div>


                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>Therapy Fee</label><br>
                                                        <input type="number" class="form-control" id='txtTherapyFee'
                                                            name='txtTherapyFee' disabled />
                                                    </div>
                                                </div>

                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>Sitting</label><br>
                                                        <input type="number" class="form-control" id='txtSittings'
                                                            name='txtSittings' value=1 />
                                                    </div>
                                                </div>

                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>Discount %</label><br>
                                                        <input type="number" class="form-control"
                                                            id='txtTherapyDiscount' name='txtTherapyDiscount' />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div id='DivRecomendedList'></div>
                                    </div>
                                </div>

                            </div>

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
    <script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
    <script src="../assets/js/table-manage-default.demo.min.js"></script>

    <script src="../assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
    <script src="../assets/js/form-wizards.demo.min.js"></script>
    <script src="../assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
    $(document).ready(function() {
        App.init();
        TableManageDefault.init();
    });
    </script>
</body>
<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->

</html>