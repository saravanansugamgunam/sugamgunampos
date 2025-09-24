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
    <link href="style/style.css" rel="stylesheet" type="text/css" />

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






    <div id="modalTherapyReschedule" class="modal fade" role="dialog">
        <div class="modal-dialog ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Reschedule</h4>
                </div>

                <div class="modal-body">

                    <input type='hidden' name='txtTherapyIDforClosure' id='txtTherapyIDforClosure' />

                    <input type='hidden' id='txtEveningTimeSlotID' name='txtEveningTimeSlotID' />
                    <input type='hidden' id='txtMorningTimeSlotID' name='txtMorningTimeSlotID' />
                    <input type='hidden' id='txtWaitinglistStatus' name='txtWaitinglistStatus' value='0' />




                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Therapist</label>
                            <select class="form-control" style='border-radius: 4px; padding: 5px; text-align: left;'
                                id='cmbTherapist' name='cmbTherapist'>
                                <option selected></option>

                                <?php
                                $sqli = "SELECT userid,username FROM usermaster where designationid in ('8','9') and activestatus ='Active' order by username";
                                $result = mysqli_query($connection, $sqli);
                                while ($row = mysqli_fetch_array($result)) {
                                    # code...

                                    echo ' <option value=' . $row['userid'] . '>' . $row['username'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="dtTherapySittingDate" id="dtTherapySittingDate" placeholder=""
                                class="form-control" onkeyup="CalculateTotal();" onblur="CalculateTotal();"
                                value='<?php echo date('Y-m-d'); ?>' />
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Time.</label>
                            <input type="text" name="dtTherapySittingTime" id="dtTherapySittingTime" placeholder=""
                                class="form-control" onclick="LoadAvailability()" readonly style='cursor:pointer;'
                                value='Schedule' />
                        </div>

                    </div>

                    <div id='DivTimeSlot'></div>

                    <br>
                    <textarea class='form-control' id='txtRescheduleRemarks' name='txtRescheduleRemarks'
                        placeholder='Reschedule Remarks' rows=5></textarea>


                </div>

                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-success" data-dismiss="modal"
                        onclick='SaveTherapyReschedule(1)'>Save</a>

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modalCancelledDetails" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Cancellation Details</h4>
                </div>
                <div class="modal-bod">
                    <div class="col-md-12">
                        <!-- begin panel -->

                        <div class="col-md-12">
                            <div class="panel-body">

                                <div id='DivCancellationDetails'> </div>
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


    <div class="modal fade" id="modlPaymentModeModification" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Paymentmode Modification </h4>
                </div>
                <div class="modal-bod">
                    <div class="col-md-12">
                        <!-- begin panel -->

                        <div class="col-md-12">
                            <div class="panel-body">

                                <input type='hidden' id='txtInvoiceModifyPayment' name='txtInvoiceModifyPayment' />
                                <input type='hidden' id='txtPaymentModeID' name='txtPaymentModeID' />

                                <div id='DivPaymentModeDetails'> </div>
                                <hr>
                                <span id='PaymentDetails' name='PaymentDetails'></span>
                                <select class="form-control" id='cmbPaymentModeEdit' name='cmbPaymentModeEdit'
                                    onchange='focusamount();' style='width:150px;'>
                                    <option value='0'></option>
                                    <?php
                                    $sqli = "  SELECT paymentmodecode, paymentmode FROM paymentmodemaster WHERE activestatus='Active'";
                                    $result = mysqli_query($connection, $sqli);
                                    while ($row = mysqli_fetch_array($result)) {
                                        # code...

                                        echo ' <option value=' . $row['paymentmodecode'] . '>' . $row['paymentmode'] . '</option>';
                                    }
                                    ?>

                                </select>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-success" onclick="ModifyPaymentMode();"
                        data-dismiss="modal">Save</a>


                    <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                        data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRescheduledDetails" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Rescheduled Details</h4>
                </div>
                <div class="modal-bod">
                    <div class="col-md-12">
                        <!-- begin panel -->

                        <div class="col-md-12">
                            <div class="panel-body">

                                <div id='DivRescheduledDetails'> </div>
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




    <div id="modalTherapyCancel" class="modal fade" role="dialog">
        <div class="modal-dialog ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cancellation</h4>
                </div>

                <div class="modal-body">

                    <form class="form-horizontal">

                        <div class="form-group">
                            <label class="col-md-2 control-label">Remarks *</label>
                            <div class="col-md-8">
                                <textarea class="form-control" placeholder="Remarks" rows="5" id='txtCancelRemarks'
                                    name='txtCancelRemarks'></textarea>
                            </div>

                        </div>

                        <div class='form-horizontal'>
                            <label class="col-md-3 control-label">Refund Amount </label>
                            <div class="col-md-4">

                                <input class='form-control' type='number' disabled id='txtTherapyValue'
                                    name='txtTherapyValue' />
                            </div>
                        </div>


                        <div class="form-group" style='display:none;'>
                            <label class="col-md-2 control-label">Refund to Paitent * </label>

                            <div class="col-md-3">
                                <select class="form-control" id='cmbRefundStatus' name='cmbRefundStatus'
                                    onchange='EnableRefundAmount();'>

                                    <option value='No'>No</option>
                                    <option selected value='Yes'>Yes</option>
                                </select>

                            </div>
                        </div>

                        <br><br>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Actual Refund Amount * </label>

                            <div class="col-md-4">
                                <input type='number' class="form-control" name='txtRefundAmount' id='txtRefundAmount' />

                            </div>
                        </div>



                    </form>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-success" data-dismiss="modal"
                        onclick='SaveCancellation()'>Update</button>
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

                        <div class="col-md-12">
                            <div class="panel-body">

                                <textarea class='form-control' id='txtClosureRemarks' name='txtClosureRemarks'
                                    placeholder='Closure Remarks' rows=10></textarea>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-success" data-dismiss="modal"
                        onclick='SaveTherapyClosure()'>Save</a>

                    <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                        data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="modalTherapyReopen" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Therapy Reopen</h4>
                </div>
                <div class="modal-bod">
                    <div class="col-md-12">
                        <!-- begin panel -->

                        <div class="col-md-12">
                            <div class="panel-body">

                                <textarea class='form-control' id='txtReopenRemarks' name='txtReopenRemarks'
                                    placeholder='Reopen Remarks' rows=10></textarea>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-success" data-dismiss="modal"
                        onclick='SaveTherapyReopen()'>Save</a>

                    <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                        data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalTherapyClosureCompleted" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Therapy Completion</h4>
                </div>
                <div class="modal-bod">
                    <div class="col-md-12">
                        <!-- begin panel -->
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
                    <h4 class="modal-title">Update Paitent Details</h4>
                </div>

                <div class="modal-body">

                    <label>Name</label>

                    <input class='form-control' type='text' id='txtModifyPaitentName' name='txtModifyPaitentName' />


                    <label>Mobile No</label>

                    <input class='form-control' type='number' id='txtModifyPaitentMobile'
                        name='txtModifyPaitentMobile' />


                    <label>Email</label>

                    <input class='form-control' type='text' id='txtModifyPaitentEmail' name='txtModifyPaitentEmail' />


                    <label>Gender</label>

                    <select class="form-control" id='cmbModifyPaitentGender' name='cmbModifyPaitentGender'>
                        <option value='Male'>Male</option>
                        <option value='Female'>Female</option>
                        <option value='Others'>Others</option>

                    </select>

                    <label>DOB</label>
                    <input class='form-control' type='date' id='dtModifyPaitentDOB' name='dtModifyPaitentDOB' />


                    <label>Address</label>
                    <textarea class='form-control' id='txtModifyPaitentAddress'
                        name='txtModifyPaitentAddress'></textarea>


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
    function LoadTherayCancellation() {

        var ID = document.getElementById("txtPaitentID").value;
        var InvoiceNo = document.getElementById("txtInvoiceNo").value;
        var TherapyStatus = 'All';
        var datas = "&ID=" + ID + "&InvoiceNo=" + InvoiceNo;
        // alert(datas);
        $.ajax({
            url: "Load/LoadTherapyCancellationDetails.php",
            method: "POST",
            data: datas,
            success: function(data) {
                // alert(data);
                $('#DivCancellationDetails').html(data);


            }
        });
    }

    function LoadTherayRescheduleDetails() {

        var ID = document.getElementById("txtIDforClosure").value;
        var InvoiceNo = document.getElementById("txtInvoiceNo").value;
        var TherapyStatus = 'All';
        var datas = "&ID=" + ID + "&InvoiceNo=" + InvoiceNo;
        // alert(datas);
        $.ajax({
            url: "Load/LoadTherapyRescheduleDetails.php",
            method: "POST",
            data: datas,
            success: function(data) {
                // alert(data);
                $('#DivRescheduledDetails').html(data);


            }
        });
    }







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


    function LoadPaintentDetailsforEdit() {
        var PaitentCode = document.getElementById("txtPaitentID").value;
        var datas = "&PaitentCode=" + PaitentCode;
        $.ajax({
            url: "Load/LoadPaitentDetailsEdit.php",
            method: "POST",
            data: datas,
            dataType: "json",
            success: function(data) {
                $("#txtModifyPaitentName").val(data[2]);
                $("#txtModifyPaitentMobile").val(data[1]);
                $("#txtModifyPaitentEmail").val(data[3]);
                $("#cmbModifyPaitentGender").val(data[8]);
                $("#dtModifyPaitentDOB").val(data[9]);
                $("#txtModifyPaitentAddress").val(data[10]);
                $("#cmbReferenceCode").val(data[7]);
                $("#txtEditedReference").val(data[6]);

            }
        });
    }

    function UpdateReference()

    {
        var PaitentCode = document.getElementById("txtPaitentID").value;
        var ReferenceCode = document.getElementById("cmbReferenceCode").value;
        var Reference = document.getElementById("txtEditedReference").value;

        var PaitentName = document.getElementById("txtModifyPaitentName").value;
        var PaitentMobile = document.getElementById("txtModifyPaitentMobile").value;
        var PaitentEmail = document.getElementById("txtModifyPaitentEmail").value;
        var PaitentGender = document.getElementById("cmbModifyPaitentGender").value;
        var PaitentDOB = document.getElementById("dtModifyPaitentDOB").value;
        var PaitentAddress = document.getElementById("txtModifyPaitentAddress").value;

        var datas = "&PaitentCode=" + encodeURIComponent(PaitentCode) +
            "&ReferenceCode=" + encodeURIComponent(ReferenceCode) +
            "&Reference=" + encodeURIComponent(Reference) +
            "&PaitentName=" + encodeURIComponent(PaitentName) +
            "&PaitentMobile=" + encodeURIComponent(PaitentMobile) +
            "&PaitentEmail=" + encodeURIComponent(PaitentEmail) +
            "&PaitentGender=" + encodeURIComponent(PaitentGender) +
            "&PaitentDOB=" + encodeURIComponent(PaitentDOB) +
            "&PaitentAddress=" + encodeURIComponent(PaitentAddress);

        $.ajax({
            url: "Save/UpdatePaitentDetailsEdit.php",
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
                    swal("Alert!", "Unable to Save", "warning");

                }



            }
        });
    }


    function GetPointIDClosure(x, y) {

        document.getElementById("txtIDforClosure").value = x;
        document.getElementById("txtInvoiceNo").value = y;


        // var row = x.parentNode.rowIndex;

        // document.getElementById("txtIDforClosure").value = document.getElementById("tblTherapyRegister").rows[1].cells
        //     .namedItem("BookingID").innerHTML;

        LoadTherapyTransactions();
    }

    function GetPoint(x) {


        var row = x.parentNode.rowIndex;

        document.getElementById("txtIDforClosure").value = document.getElementById("tblTherapyRegister").rows[1].cells
            .namedItem("BookingID").innerHTML;

        LoadTherapyTransactions();
    }

    function LoadTherapyTransactions() {
        var BookingID = document.getElementById("txtInvoiceNo").value;


        var datas = "&BookingID=" + BookingID;
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
            var InvoiceNo = <?php echo $InvoiceNo; ?>;
            var datas = "&PaitentID=" + PaitentID + "&InvoiceNo=" + InvoiceNo;

            $.ajax({
                url: "Load/LoadPaitentDetailsforTherapy.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    LoadTherapyRegisterList();
                    $('#DivPaitentDetails').html(data);

                }
            });
        }

        function LoadDocumentListConsulting() {
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
                url: "Load/LoadTherapyListRecomended.php",
                method: "POST",
                data: datas,
                success: function(data) {
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

        function LoadTherapyRegisterList() {

            var ID = document.getElementById("txtPaitentID").value;
            var InvoiceNo = <?php echo $InvoiceNo; ?>;
            var TherapyStatus = 'All';
            var datas = "&ID=" + ID + "&InvoiceNo=" + InvoiceNo;

            $.ajax({
                url: "Load/LoadTherapyList_TV.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivTherapyRegisterList').html(data);


                }
            });
        }

        function LoadTherapyRegister() {

            var ID = document.getElementById("txtPaitentID").value;
            var TherapyStatus = 'All';
            var datas = "&ID=" + ID + "&TherapyStatus=" + TherapyStatus;
            $.ajax({
                url: "Load/LoadTherapyList_TV.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivTherapyRegister').html(data);


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



        function LoadAvailability() {
            var Dummy = 1;
            var DoctorCode = document.getElementById("cmbTherapist").value;
            var TherapyDate = document.getElementById("dtTherapySittingDate").value;
            var Invoice = <?php echo $InvoiceNo; ?>;

            var datas = "&Dummy=" + Dummy + "&DoctorCode=" + DoctorCode + "&TherapyDate=" + TherapyDate + "&Invoice=" +
                Invoice;
            // alert(datas);
            $.ajax({
                url: "Load/LoadTimeAllotmentDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivTimeSlot').html(data);


                }
            });
        }


        function LoadPaymentModedetails(x) {
            var Invoice = x;

            document.getElementById("txtInvoiceModifyPayment").value = x;
            var datas = "&Invoice=" + Invoice;

            $.ajax({
                url: "Load/LoadPaymentModeDetails_TV.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivPaymentModeDetails').html(data);

                }
            });
        }

        function LoadModeDetails(x) {
            PaymentID = x;
            document.getElementById("txtPaymentModeID").value = x

            var datas = "&PaymentID=" + PaymentID;

            $.ajax({
                url: "Load/LoadPaymentModeDetilsedit_TV.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#PaymentDetails").html(data[0]);



                }
            });

        }



        function ModifyPaymentMode() {
            var InvoiceNo = document.getElementById("txtInvoiceModifyPayment").value;
            var PaymentID = document.getElementById("txtPaymentModeID").value;
            var PaymentModeID = document.getElementById("cmbPaymentModeEdit").value;


            if (InvoiceNo == '' || PaymentID == '' || PaymentModeID == '') {
                swal("Warning!", "No Details to Save, please try again", "warning");
            } else {
                var datas = "&InvoiceNo=" + InvoiceNo +
                    "&PaymentID=" + encodeURIComponent(PaymentID) +
                    "&PaymentModeID=" + encodeURIComponent(PaymentModeID);

                $.ajax({
                    url: "Save/UpdatePaymentMode_TV.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        LoadTherapyPaymentDetails();
                    }
                });
            }

        }





        function GetPointID(x, y, z, v, ID) {

            // var row = x.parentNode.rowIndex;

            // document.getElementById("txtIDforClosure").value = document.getElementById("tblTherapyRegister").rows[1].cells
            //     .namedItem("BookingID").innerHTML;
            document.getElementById("txtIDforClosure").value = x;
            document.getElementById("txtTherapyIDforClosure").value = y;
            document.getElementById("cmbTherapist").value = z;
            document.getElementById("txtTherapyValue").value = v;
            document.getElementById("txtRefundAmount").value = v;

            document.getElementById("txtInvoiceNo").value = ID;

            LoadTherapyRegister();
        }


        function SaveCancellation() {


            var InvoiceNo = document.getElementById("txtInvoiceNo").value;
            var ItemID = document.getElementById("txtIDforClosure").value;
            var Remarks = document.getElementById("txtCancelRemarks").value;

            var PaitentCode = document.getElementById("txtPaitentID").value;


            var RefundStatus = document.getElementById("cmbRefundStatus").value;
            var RefundAmount = document.getElementById("txtRefundAmount").value;

            var PendingSittings = document.getElementById("txtPendingSitting").value;

            if (InvoiceNo == "" || Remarks == "" || ItemID == "" || RefundStatus == "-") {

                swal("Alert!", "Kindly provide valid details!", "warning");
            } else {
                var datas = "&InvoiceNo=" + InvoiceNo +
                    "&ItemID=" + ItemID +
                    "&Remarks=" + Remarks +
                    "&RefundStatus=" + RefundStatus +
                    "&PendingSittings=" + PendingSittings +
                    "&PaitentCode=" + PaitentCode +
                    "&RefundAmount=" + RefundAmount;

                $.ajax({
                    url: "Save/SaveTherapyCancell.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        if (data == 1) {
                            // swal(data);
                            swal("Therapy!", "Therapy Cancellation Done", "success");
                            LoadPaitentDetails();
                            setTimeout(function() {
                                window.location.reload(1);
                            }, 2000);
                        } else {

                            swal("Alert!", "Error Saving", "warning");
                            LoadPaitentDetails();
                            setTimeout(function() {
                                window.location.reload(1);
                            }, 2000);
                        }


                    }
                });
            }

        }


        function SaveTherapyClosure() {
            var InvoiceNo = document.getElementById("txtInvoiceNo").value;
            var ItemID = document.getElementById("txtIDforClosure").value;
            var TherapyID = document.getElementById("txtTherapyIDforClosure").value;
            var PendingSittings = document.getElementById("txtPendingSitting").value;
            var ClosureRemarks = document.getElementById("txtClosureRemarks").value;


            var datas = "&InvoiceNo=" + InvoiceNo +
                "&ItemID=" + ItemID +
                "&TherapyID=" + TherapyID +
                "&PendingSittings=" + PendingSittings +
                "&ClosureRemarks=" + ClosureRemarks;
            $.ajax({
                url: "Save/SaveTherapyClosure.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    document.getElementById("txtQuery").value = data;
                    LoadPaitentDetails();
                }
            });

        }

        function SaveTherapyReopen() {
            var InvoiceNo = document.getElementById("txtInvoiceNo").value;
            var ItemID = document.getElementById("txtIDforClosure").value;
            var TherapyID = document.getElementById("txtTherapyIDforClosure").value;
            var PendingSittings = document.getElementById("txtPendingSitting").value;
            var ClosureRemarks = document.getElementById("txtReopenRemarks").value;



            var datas = "&InvoiceNo=" + InvoiceNo +
                "&ItemID=" + ItemID +
                "&TherapyID=" + TherapyID +
                "&PendingSittings=" + PendingSittings +
                "&ClosureRemarks=" + ClosureRemarks;
            $.ajax({
                url: "Save/SaveTherapyReopen.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    document.getElementById("txtQuery").value = data;
                    LoadPaitentDetails();
                }
            });

        }



        function SaveTherapyReschedule(x) {
            var InvoiceNo = document.getElementById("txtInvoiceNo").value;
            var ItemID = document.getElementById("txtIDforClosure").value;
            var TherapyID = document.getElementById("txtTherapyIDforClosure").value;

            var EveningSlot = document.getElementById("txtEveningTimeSlotID").value;
            var MorningSlot = document.getElementById("txtMorningTimeSlotID").value;
            var Therapist = document.getElementById("cmbTherapist").value;
            var SittingDate = document.getElementById("dtTherapySittingDate").value;
            var SittingTime = document.getElementById("dtTherapySittingTime").value;
            var ScheduleRemarks = document.getElementById("txtRescheduleRemarks").value;

            var RescheduleStatus = x;

            if (MorningSlot == '' && EveningSlot == '') {

                swal("Alert!", "Please select schedule time", "warning");


            } else {

                var datas = "&InvoiceNo=" + InvoiceNo +
                    "&ItemID=" + ItemID +
                    "&TherapyID=" + TherapyID +
                    "&EveningSlot=" + EveningSlot +
                    "&MorningSlot=" + MorningSlot +
                    "&Therapist=" + Therapist +
                    "&SittingDate=" + SittingDate +
                    "&SittingTime=" + SittingTime +
                    "&RescheduleStatus=" + RescheduleStatus +
                    "&ScheduleRemarks=" + ScheduleRemarks;

                $.ajax({
                    url: "Save/SaveTherapyReschedule.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        document.getElementById("txtQuery").value = data;

                        LoadPaitentDetails();
                    }
                });
            }
        }

        function LoadTherapyPaymentDetails() {

            var FromDate = '2020-01-01'; //document.getElementById("dtFromDateReport").value;
            var ToDate = '2026-12-01'; //document.getElementById("dtToDateReprt").value;
            var SupplierCode = <?php echo $PaitentId; ?>; //document.getElementById("cmbSupplierCodeReport").value;
            var Period = 'Custom'; //document.getElementById("cmbPeriod").value;


            var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate +
                "&SupplierCode=" + SupplierCode + "&Period=" + Period;

            $.ajax({
                url: "Load/LoadTherapyPaymentList_TV.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivPaymentCollection').html(data);
                }
            });
        }

        function GetID(x, y, z) {
            document.getElementById("txtPaitentID").value = y;
            document.getElementById("txtInvoiceNo").value = x;
            document.getElementById("txtPaymentAmount").value = z;
            document.getElementById("txtCurrentBalance").value = z;
            document.getElementById("txtFinalBalance").value = 0;

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



        function CalculateOutstanding() {
            var TotalOutstanding = document.getElementById("txtCurrentOutstanding").value;
            var RevisedOutstanding = document.getElementById("txtNewOutstanding").value;

            var NetBalance = (TotalOutstanding - RevisedOutstanding);
            document.getElementById("txtAdjustedAmount").value = NetBalance;

        }


        function UpdateOutstanding() {
            var PaitentCode = document.getElementById("txtPaitentID").value;
            var CurrentOutstanding = document.getElementById("txtCurrentOutstanding").value;
            var NewOutstanding = document.getElementById("txtNewOutstanding").value;
            var AdjustedAmount = document.getElementById("txtAdjustedAmount").value;
            var Remarks = document.getElementById("txtAdjustmentRemarks").value;

            var InvoiceNo = new Date().getTime();



            if (Remarks == '' || PaitentCode == '' || CurrentOutstanding == '' || CurrentOutstanding == '0' ||
                AdjustedAmount == '' || AdjustedAmount == '0') {

                swal("Alert", "No Details to Save, please check all details are filled!", "warning");
            } else {
                var datas = "&PaitentCode=" + PaitentCode +
                    "&CurrentOutstanding=" + CurrentOutstanding +
                    "&NewOutstanding=" + NewOutstanding +
                    "&AdjustedAmount=" + AdjustedAmount +
                    "&InvoiceNo=" + InvoiceNo +
                    "&Remarks=" + Remarks;

                $.ajax({
                    url: "Save/UpdateOutstandingPayment.php",
                    method: "POST",
                    data: datas,

                    success: function(data) {
                        document.getElementById("txtQuery").value = data;
                        if (data == 1) {
                            swal("Sucess", "Payment Updated Sucessfully!", "success");
                            LoadTherapyPaymentDetails();
                            LoadPaitentDetails();
                        } else {
                            swal("Alert", "Error Saving Payment Details, Please try again!", "error");

                        }
                    }
                });
            }
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
                            LoadTherapyPaymentDetails();
                            LoadPaitentDetails();
                        } else {
                            swal("Alert", "Error Saving Payment Details, Please try again!", "error");

                        }
                    }
                });
            }

        }

        function AccessDeniedMessage() {
            swal("Access Denied", "You don't have access, Please Contact Manager!", "error");
        }


        function LoadPaitentTransaction() {
            // alert(1); 
            var PaitentID = document.getElementById("txtPaitentID").value;

            var datas = "&PaitentID=" + PaitentID;
            // alert(datas);
            $.ajax({
                url: "Load/LoadPaitentTransaction.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivPaitentTransaction').html(data);


                }
            });

        }



        function printPaitentTransactionDiv() {
            var PaitentID = document.getElementById("txtPaitentID").value;
            var str1 = 'DebitCreditStatement.php?P=';
            var str2 = PaitentID;
            var str3 = '';
            var BillPrintURL = str1.concat(str2, str3);
            window.open(BillPrintURL, '_blank');


        }


        function LoadDocumentList(x) {
            var ReffID = x;

            var datas = "&ReffID=" + ReffID;
            $.ajax({
                url: "Load/LoadDocumentList_TV.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivDocmentList').html(data);


                }
            });
        }
        </script>



        <div id="modalDocumentList" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Documents</h4>
                    </div>

                    <div class="modal-body">

                        <div id='DivDocmentList'></div>


                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>



        <div id="myModalRefund" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <script>
                function Refund() {

                    document.getElementById("txtTotalRefund").value = document.getElementById("txtCurrentOutstanding")
                        .value * -1;
                    document.getElementById("txtPatientCode").value = document.getElementById("txtPaitentID").value;



                }

                function CalculateBalance() {

                    var total = parseInt(document.getElementById("txtTotalRefund").value);
                    var val2 = parseInt(document.getElementById("txtTotalPayment").value);

                    // to make sure that they are numbers
                    if (!total) {
                        total = 0;
                    }
                    if (!val2) {
                        val2 = 0;
                    }

                    var ansD = document.getElementById("txtNewBalance");
                    ansD.value = total - val2;
                }



                function SaveRefund() {

                    var InvoiceNo = new Date().getTime();

                    // alert(1);
                    var OldBalance = document.getElementById("txtTotalRefund").value;
                    var Payment = document.getElementById("txtTotalPayment").value;
                    var NewBalance = document.getElementById("txtNewBalance").value;
                    var PatientCode = document.getElementById("txtPatientCode").value;
                    var PaymentMode = document.getElementById("cmbPaymentModeRefund").value;
                    var PaymentDate = document.getElementById("dtOutstandingPaymentDate").value;
                    var Remarks = document.getElementById("txtRemarksRefund").value;
                    var LocationCode = document.getElementById("cmbLocationAdmin").value;

                    // alert(2);
                    if (PaymentDate == "" || PatientCode == "" || PaymentMode == "" || NewBalance == "" ||
                        Payment ==
                        "" ||
                        Payment == 0) {
                        swal("Kindly select payment mode");
                    } else if (NewBalance < 0) {
                        swal("Balance should not be Less than Zero");
                    } else {
                        var datas = "&PatientCode=" + PatientCode + "&PaymentMode=" + PaymentMode +
                            "&PaymentDate=" +
                            PaymentDate + "&OldBalance=" +
                            OldBalance + "&Payment=" + Payment + "&NewBalance=" + NewBalance + "&InvoiceNo=" +
                            InvoiceNo +
                            "&Remarks=" + Remarks +
                            "&LocationCode=" + LocationCode;

                        $.ajax({
                            url: "Save/SaveRefund.php",
                            method: "POST",
                            data: datas,
                            success: function(data) {
                                // swal(data);


                                if (data == 1) {
                                    swal("Payment Refunded!", "Payment has been Refunded sucessfully!",
                                        "success");


                                    setTimeout(function() {
                                        window.location.reload(1);
                                    }, 1000);

                                } else {
                                    swal(data);
                                    // swal("Error !", "Unable to Refund Payment !", "warning");

                                }

                            }
                        });
                    }


                }





                function Transfer() {




                    document.getElementById("txtAvailableAmount").value = document.getElementById(
                        "txtCurrentOutstanding").value * -1;
                }

                function SaveTransfer() {
                    var FromPaitentCode = document.getElementById("txtPaitentID").value;
                    var AvailableAmount = document.getElementById("txtAvailableAmount").value;
                    var ToPaitentCode = document.getElementById("cmbToPaitent").value;
                    var TransferRemarks = document.getElementById("txtRemarksTransfer").value;
                    var TransferAmount = document.getElementById("txtTransferAmount").value;

                    var datas = "&FromPaitentCode=" + FromPaitentCode +
                        "&AvailableAmount=" + AvailableAmount +
                        "&ToPaitentCode=" + ToPaitentCode +
                        "&TransferRemarks=" + TransferRemarks +
                        "&TransferRemarks=" + TransferRemarks +
                        "&TransferAmount=" + TransferAmount;

                    if (FromPaitentCode == '' || ToPaitentCode == '' || TransferAmount == 0 || TransferAmount == '') {

                        swal("Error !", "Kindly fill required details", "warning");

                    } else {


                        if (AvailableAmount * 1 < TransferAmount * 1) {
                            swal("Error !", "Transfer amount should not be higner than available amount", "warning");

                        } else {
                            $.ajax({
                                url: "Save/SaveLiabilityTransfer.php",
                                method: "POST",
                                data: datas,
                                success: function(data) {


                                    if (data == 1) {
                                        swal("Payment Transfered!",
                                            "Payment has been transfered sucessfully!", "success");


                                        setTimeout(function() {
                                            window.location.reload(1);
                                        }, 1000);

                                    } else {
                                        // swal(data);
                                        swal("Error !", "Unable to Transfer Payment !", "warning");

                                    }


                                }
                            });
                        }


                    }

                }
                </script>
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Refund to Customer</h4>
                    </div>
                    <div class="modal-body">
                        <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' />
                        <input type='hidden' id='txtPatientCode' name='txtPatientCode' />
                        <div>
                            <table>
                                <tr>
                                    <td>Payment Date</td>
                                    <td><input type='date' id='dtOutstandingPaymentDate' name='dtOutstandingPaymentDate'
                                            style="width: 150px; height:30px; padding-top:6px; padding-bottom: 4px; 
                                    margin-right: 4px; font-size:15px; border-radius: 4px;"
                                            value='<?php echo date('Y-m-d'); ?>' />
                                    </td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>

                                <tr>
                                    <td>Location</td>
                                    <td>

                                        <?php
                                        if ($GroupID == '1') {
                                        ?>
                                        <select class="form-control"
                                            style='border-radius: 4px; padding: 5px; text-align: left;'
                                            id='cmbLocationAdmin' name='cmbLocationAdmin'
                                            onchange='HideCourierDetails()' style="width: 150px;">
                                            <?php
                                                $sqli = "SELECT locationcode,locationname FROM locationmaster where activestatus='Active'";
                                                $result = mysqli_query($connection, $sqli);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    # code...

                                                    echo ' <option value=' . $row['locationcode'] . '>' . $row['locationname'] . '</option>';
                                                }
                                                ?>
                                        </select>
                                        <?php
                                        } else { ?>
                                        <select class="form-control"
                                            style='border-radius: 4px; padding: 5px; text-align: left;'
                                            id='cmbLocationAdmin' name='cmbLocationAdmin'
                                            onchange='HideCourierDetails()' style="width: 150px;">
                                            <?php
                                                $sqli = "SELECT locationcode,locationname FROM locationmaster where activestatus='Active' and 
                    locationcode ='$LocationCode'";
                                                $result = mysqli_query($connection, $sqli);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    # code...

                                                    echo ' <option value=' . $row['locationcode'] . '>' . $row['locationname'] . '</option>';
                                                }
                                                ?>
                                        </select>
                                        <?php }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>


                                <tr>
                                    <td>Available Balance &nbsp;&nbsp;</td>

                                    <td><input type='text' id='txtTotalRefund' name='txtTotalRefund'
                                            style="width: 150px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px; border-radius: 4px;"
                                            disabled /></td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td>Payment Mode</td>
                                    <td><select id='cmbPaymentModeRefund' name='cmbPaymentModeRefund'
                                            onchange='focusamount();'
                                            style="width: 150px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px; border-radius: 4px;">
                                            <option></option>
                                            <?php
                                            $sqli = "  SELECT paymentmodecode, paymentmode FROM paymentmodemaster WHERE activestatus='Active'";
                                            $result = mysqli_query($connection, $sqli);
                                            while ($row = mysqli_fetch_array($result)) {
                                                # code...

                                                echo ' <option value=' . $row['paymentmodecode'] . '>' . $row['paymentmode'] . '</option>';
                                            }
                                            ?>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td>Total Refund&nbsp;&nbsp;</td>
                                    <td><input type='number' id='txtTotalPayment' name='txtTotalPayment'
                                            style="width: 150px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px; border-radius: 4px;"
                                            required onkeyup="CalculateBalance()" value=0 /></td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td>Balance&nbsp;&nbsp;</td>
                                    <td>
                                        <input type='text' id='txtNewBalance' name='txtNewBalance'
                                            style="width: 150px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px; border-radius: 4px;"
                                            disabled />
                                    </td>
                                </tr>

                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td>Remarks&nbsp;&nbsp;</td>
                                    <td>
                                        <textarea class='form-contrl' id='txtRemarksRefund'
                                            name='txtRemarksRefund'></textarea>
                                    </td>
                                </tr>



                            </table>




                        </div>

                        <br>


                        <button type="button" class="btn btn-success" onclick='SaveRefund();'>Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </div>

            </div>
        </div>


        <div id="myModalTransfer" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Transfer Liability to Another Paitent</h4>


                    </div>
                    <div class="modal-body">


                        <div class="form-group">
                            <label>Available Amount * </label>
                            <input type='number' class='form-control' id='txtAvailableAmount' name='txtAvailableAmount'
                                disabled />
                        </div>


                        <div class="form-group">
                            <label>Transfer To Paitent *</label><br>
                            <select class="selectpicker" data-show-subtext="true" data-live-search="true"
                                data-style="btn-white" id='cmbToPaitent' name='cmbToPaitent'
                                onchange='LoadPaitentDetails();ClearBarcode();'>
                                <option selected></option>

                                <?php
                                $sqli = "SELECT paitentid,concat(paitentname,' - ', mobileno) as Mobile FROM   `paitentmaster` order by mobileno";
                                $result = mysqli_query($connection, $sqli);
                                while ($row = mysqli_fetch_array($result)) {
                                    # code...

                                    echo ' <option value=' . $row['paitentid'] . '>' . $row['Mobile'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Transfer Amount *</label>
                            <input type='number' class='form-control' id='txtTransferAmount' name='txtTransferAmount' />
                        </div>


                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea class='form-control' id='txtRemarksTransfer' name='txtRemarksTransfer'></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick='SaveTransfer()'>Transfer</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
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

                                echo ' <option value=' . $row['paymentmodecode'] . '>' . $row['paymentmode'] . '</option>';
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

                                <button>
                                    <a class='btn btn-info btn-xs m-r-5'
                                        href='TherapyBooking.php?MID=30&PID=<?php echo $PaitentId; ?>' target="_blank">
                                        </i>
                                        Book Open Therapy </a>
                                </button>

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                                <button>
                                    <a class='btn btn-warning btn-xs m-r-5'
                                        href='TherapyBookingAdvance.php?MID=30&PID=<?php echo $PaitentId; ?>'
                                        target="_blank">
                                        </i>
                                        Book Advanced Therapy </a>
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




                            </h4>


                        </div>


                        <style>
                        /* Please ❤ this if you like it! */
                        /* Follow Me https://codepen.io/designfenix */
                        /**/
                        /**/
                        /**/
                        /**/
                        /**/
                        /**/
                        /**/
                        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

                        :root {
                            --vs-primary: 29 92 255;
                        }

                        /*Dialog Styles*/
                        dialog {
                            background: white;
                            max-width: 600px;
                            border-radius: 20px;
                            border: 0;
                            box-shadow: 0 5px 30px 0 rgb(0 0 0 / 10%);
                            animation: fadeIn 1s ease both;

                            &::backdrop {
                                animation: fadeIn 1s ease both;
                                background: rgb(255 255 255 / 40%);
                                z-index: 2;
                                backdrop-filter: blur(20px);
                            }

                            .x {
                                filter: grayscale(1);
                                border: none;
                                background: none;
                                position: absolute;
                                top: 15px;
                                right: 10px;
                                transition: ease filter, transform 0.3s;
                                cursor: pointer;
                                transform-origin: center;

                                &:hover {
                                    filter: grayscale(0);
                                    transform: scale(1.1);
                                }
                            }

                            h2 {
                                font-weight: 600;
                                font-size: 2rem;
                                padding-bottom: 1rem;
                            }

                            p {
                                font-size: 1rem;
                                line-height: 1.3rem;
                                padding: 0.5rem 0;

                                a {
                                    &:visited {
                                        color: rgb(var(--vs-primary));
                                    }
                                }
                            }
                        }

                        /*General Styles*/


                        button.primary {
                            display: inline-block;
                            font-size: 0.8rem;
                            color: #fff !important;
                            background: rgb(var(--vs-primary) / 100%);
                            padding: 13px 25px;
                            border-radius: 17px;
                            transition: background-color 0.1s ease;
                            box-sizing: border-box;
                            transition: all 0.25s ease;
                            border: 0;
                            cursor: pointer;
                            box-shadow: 0 10px 20px -10px rgb(var(--vs-primary) / 50%);

                            &:hover {
                                box-shadow: 0 20px 20px -10px rgb(var(--vs-primary) / 50%);
                                transform: translateY(-5px);
                            }
                        }

                        @keyframes fadeIn {
                            from {
                                opacity: 0;
                            }

                            to {
                                opacity: 1;
                            }
                        }
                        </style>





                        <div class="panel-body">

                            <div id='DivPaitentDetails'></div>


                            <div class="col-md-12">
                                <input type='hidden' id='txtQuery' name='txtQuery' />
                                <input type='hidden' id='txtPaitentID' name='txtPaitentID'
                                    value='<?php echo $PaitentId ?>' />
                                <input type='hidden' id='txtTokenID' name='txtTokenID' value='<?php echo $TokenID ?>' />
                                <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' />

                                <input type='hidden' name='txtIDforClosure' id='txtIDforClosure' />



                                <ul class="nav nav-tabs">
                                    <li class=" " onclick='LoadTherapyRegisterList();'><a href="#default-tab-11"
                                            data-toggle="tab">Therapy - Details</a></li>
                                    <li class="" onclick='LoadTherapyPaymentDetails();'><a href="#default-tab-9"
                                            data-toggle="tab">Collect - Payment</a></li>


                                    <li class=" " onclick='LoadPrescriptionList();'><a href="#default-tab-1"
                                            data-toggle="tab">Prescription</a></li>


                                    <li class="" onclick='LoadPaitentHistory();'><a href="#default-tab-3"
                                            data-toggle="tab">Consulting - History</a></li>

                                    <li class="" onclick='LoadSalesReport();'><a href="#default-tab-5"
                                            data-toggle="tab">Medicine - History</a></li>

                                    <li class="" onclick='LoadTherapyRegister();' style='display:none'><a
                                            href="#default-tab-7" data-toggle="tab">Therapy - History</a></li>

                                    <li class="" onclick='LoadNextApppointment();'><a href="#default-tab-4"
                                            data-toggle="tab">Next Apppointment</a></li>

                                    <li class="" onclick='LoadRecomendation();' style='display:none'><a
                                            href="#default-tab-6" data-toggle="tab">Therapy Recomendation</a>

                                    <li class="" onclick='LoadDocumentListConsulting();'><a href="#default-tab-2"
                                            data-toggle="tab">Documents</a></li>

                                    <li class="" onclick='LoadFamilyDetails();'><a href="#default-tab-8"
                                            data-toggle="tab">Family Members</a></li>


                                    <li class="" onclick='LoadPaitentTransaction();'><a href="#default-tab-12"
                                            data-toggle="tab">Transactions</a></li>







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

                                    <div class="tab-pane fade" id="default-tab-11">

                                        <h3 class="m-t-10"> Therapy Details</h3>
                                        <div id='DivTherapyRegisterList'> </div>


                                    </div>



                                    <div class="tab-pane fade" id="default-tab-3">

                                        <h3 class="m-t-10"> Consultation History</h3>
                                        <div id='DivPaitentHistory'> </div>


                                    </div>


                                    <div class="tab-pane fade" id="default-tab-5">

                                        <h3 class="m-t-10"> Medicine History</h3>
                                        <div id='DivPaitentBillingHistory'> </div>

                                    </div>

                                    <div class="tab-pane fade" id="default-tab-12">

                                        <h3 class="m-t-10"> Paitent Transaction</h3>

                                        <input type=" " style='float:right;' class="btn btn-sm btn-info btn-xs"
                                            onclick="printPaitentTransactionDiv();" value='Print'>
                                        <div id='DivPaitentTransaction'> </div>

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

                                        <div id='DivTherapyRegister'> </div>
                                    </div>

                                    <div class="tab-pane fade" id="default-tab-8">

                                        <h3 class="m-t-10"> Family Details</h3>
                                        <div id='DivFamily'> </div>


                                    </div>

                                    <div class="tab-pane fade" id="default-tab-9">

                                        <h3 class="m-t-10"> Payment Collection</h3>
                                        <div id='DivPaymentCollection'> </div>


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
        FormPlugins.init();
        FormSliderSwitcher.init();
        FormWizard.init();
    });
    </script>
</body>
<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->

</html>