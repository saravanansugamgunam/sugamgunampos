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



    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



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


    #loading {
        background: url('../assets/img/ai.gif') no-repeat center center;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        margin: auto;
        height: 100%;
        width: 100%;
        z-index: 9999999;
        background-color: rgba(192, 192, 192, 0.3);
    }
    </style>

</head>

<div id="loading" style='display:none'></div>


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




    <div id="modalConsultingCancel" class="modal fade" role="dialog">
        <div class="modal-dialog ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cancel Consultation</h4>
                </div>

                <div class="modal-body">

                    <form class="form-horizontal">

                        <div class="form-group">
                            <label class="col-md-2 control-label">Remarks *</label>
                            <div class="col-md-8">
                                <textarea class="form-control" placeholder="Remarks" rows="5"
                                    id='txtConsultationCancelRemarks' name='txtConsultationCancelRemarks'></textarea>
                            </div>

                        </div>

                        <div class='form-horizontal'>
                            <label class="col-md-3 control-label">Refund Amount </label>
                            <div class="col-md-4">

                                <input class='form-control' type='number' disabled id='txtConsultingPaidAmount'
                                    name='txtConsultingPaidAmount' />
                            </div>
                        </div>


                        <br><br>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Actual Refund Amount * </label>

                            <div class="col-md-4">
                                <input type='number' class="form-control" name='txtConsultingRefundAmount'
                                    id='txtConsultingRefundAmount' />

                            </div>
                        </div>



                    </form>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-success" data-dismiss="modal"
                        onclick='SaveConsultationCancel()'>Cancel</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                    <h4 class="modal-title">Therapy Cancellation</h4>
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



    <div id="ModalCompletion" class="modal fade" role="dialog">
        <div class="modal-dialog  modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Next Appointment</h4>
                </div>

                <div class="modal-body">

                    <div class="col-md-12">
                        Next Appointment: &nbsp;&nbsp;
                        <input style='border-width: 0px;
											border-style: inset;  border-radius: 1px; border-bottom: 2px solid grey; ' type='date'
                            id='dtNextAppointment' name='dtNextAppointment' />

                    </div>
                    <br>
                    <br>
                    <br>
                    <label class="col-md-3 control-label">Remarks</label>
                    <textarea class='form-control' id='txtRemarks' name='txtRemarks'></textarea>
                    <br>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-success" onclick='SaveConsultingClosure()'>Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

        var InvoiceNo = document.getElementById("txtInvoiceNoToken").value;
        var datas = "&InvoiceNo=" + InvoiceNo;

        $.ajax({
            url: "Load/LoadConsultationStatus.php",
            method: "POST",
            data: datas,
            dataType: "json",
            success: function(data) {

                if (data[2] == '1') {
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'This token is Cancelled, you cannot complete it',
                        showConfirmButton: true,
                        timer: 2500
                    })
                } else {
                    SaveConsultingClosureInstant();
                }


            }
        });




    }


    function SaveConsultingClosureInstant() {
        var RefundStatus = '-'; //$("input[name='rdConcession']:checked").val();
        var Remarks = document.getElementById("txtRemarks").value;
        var RefundAmount = document.getElementById("txtRefundAmount").value;
        var PaitentID = document.getElementById("txtPaitentID").value;
        var TokenNo = document.getElementById("txtTokenID").value;
        var InvoiceNo = document.getElementById("txtInvoiceNoToken").value;
        var NextAppointment = document.getElementById("dtNextAppointment").value;

        var datas = "&RefundStatus=" + encodeURIComponent(RefundStatus) +
            "&Remarks=" + encodeURIComponent(Remarks) +
            "&RefundAmount=" + encodeURIComponent(RefundAmount) +
            "&PaitentID=" + encodeURIComponent(PaitentID) +
            "&InvoiceNo=" + encodeURIComponent(InvoiceNo) +
            "&NextAppointment=" + encodeURIComponent(NextAppointment) +
            "&TokenNo=" + encodeURIComponent(TokenNo);

        $.ajax({
            url: "Save/SaveConsultingClosureInstant.php",
            method: "POST",
            data: datas,
            success: function(data) {


                // document.getElementById("txtQuery").value = data;

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






        function LoadPaitentDetails() {
            var Dumy = 0;
            var PaitentID = document.getElementById("txtPaitentID").value;
            var InvoiceNo = <?php echo $InvoiceNo; ?>;
            var datas = "&PaitentID=" + PaitentID + "&InvoiceNo=" + InvoiceNo;

            $.ajax({
                url: "../TPM/Load/LoadPaitentDetailsforTherapy.php",
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

            LoadAllConcepts();
            LoadPaitentDetails();
            LoadCaseHistoryCurrent();
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
            alert(AudioID);

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
                url: "../TPM/Load/LoadTimeAllotmentDetails.php",
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
                    "&RefundAmount=" + RefundAmount;

                $.ajax({
                    url: "../TPM/Save/SaveTherapyCancell.php",
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
                url: "../TPM/Save/SaveTherapyReschedule.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    document.getElementById("txtQuery").value = data;

                    LoadPaitentDetails();
                }
            });
        }

        function LoadTherapyPaymentDetails() {

            var FromDate = '2020-01-01'; //document.getElementById("dtFromDateReport").value;
            var ToDate = '2026-12-01'; //document.getElementById("dtToDateReprt").value;
            var SupplierCode = <?php echo $PaitentId; ?>; //document.getElementById("cmbSupplierCodeReport").value;
            var Period = 'Custom'; //document.getElementById("cmbPeriod").value;


            var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate +
                "&SupplierCode=" + SupplierCode + "&Period=" + Period;

            $.ajax({
                url: "../TPM/Load/LoadTherapyPaymentList_TV.php",
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
                    url: "../TPM/Save/UpdateOutstandingPayment.php",
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
                    url: "../TPM/Save/UpdateTherapyPayment.php",
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
                url: "../TPM/Load/LoadPaitentTransaction.php",
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
        </script>


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





                function SaveConsultationCancel() {
                    var Remarks = document.getElementById("txtConsultationCancelRemarks").value;
                    var RefundAmount = document.getElementById("txtConsultingRefundAmount").value;
                    var PaitentID = document.getElementById("txtPaitentID").value;
                    var TokenNo = document.getElementById("txtTokenID").value;
                    var InvoiceNo = document.getElementById("txtInvoiceNoToken").value;

                    var datas = "&Remarks=" + encodeURIComponent(Remarks) +
                        "&RefundAmount=" + encodeURIComponent(RefundAmount) +
                        "&PaitentID=" + encodeURIComponent(PaitentID) +
                        "&InvoiceNo=" + encodeURIComponent(InvoiceNo) +
                        "&TokenNo=" + encodeURIComponent(TokenNo);

                    $.ajax({
                        url: "Save/SaveCancelConsultation.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {


                            if (data == 1) {
                                // windows.location('TokenDetails.php?MID=31');
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Token Cancelled Sucessfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                // window.location.assign("TokenDetails.php?MID=31");
                                setTimeout(function() {
                                    window.location.href =
                                        "TokenDetails.php?MID=31"; //will redirect to your blog page (an ex: blog.html)
                                }, 1500); //will call the function after 2 secs.



                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'warning',
                                    title: 'Unable to cancel Token, Please try again!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                            }





                        }
                    });
                }


                function LoadConsultationStatus() {

                    var InvoiceNo = document.getElementById("txtInvoiceNoToken").value;
                    var datas = "&InvoiceNo=" + InvoiceNo;
                    $.ajax({
                        url: "Load/LoadConsultationStatus.php",
                        method: "POST",
                        data: datas,
                        dataType: "json",
                        success: function(data) {
                            if (data[2] == '1') {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'warning',
                                    title: 'This token is already Cancelled',
                                    showConfirmButton: true,
                                    timer: 2500
                                })
                            } else {

                                $('#modalConsultingCancel').modal('show');

                                $("#txtConsultationStatus").val(data[2]);
                                $("#txtConsultingPaidAmount").val(data[0]);
                                $("#txtConsultingRefundAmount").val(data[0]);

                            }


                        }
                    });

                }


                function LoadCaseHistoryCurrent() {
                    var InvoiceNo = document.getElementById("txtInvoiceNoToken").value;
                    var datas = "&InvoiceNo=" + InvoiceNo;
                    $.ajax({
                        url: "Load/LoadCaseHistoryCurrent.php",
                        method: "POST",
                        data: datas,
                        dataType: "json",
                        success: function(data) {
                            $("#txtHeight").val(data[0]);
                            $("#txtWeight").val(data[1]);
                            $("#txtPulse").val(data[2]);
                            $("#txtBP").val(data[3]);
                            $("#txtTemperature").val(data[4]);
                            $("#txtSkinHairNail").val(data[5]);
                            $("#txtDietChart").val(data[6]);
                            $("#txtPathologyComments").val(data[7]);
                            document.getElementById("dtNextAppointmentCaseHistory").value = data[8];
                            $("#txtCaseHistoryAdded").val(data[9]);
                            $("#txtRemarksNewHistory").val(data[10]);



                            // $("#dtNextAppointmentCaseHistory").val(data[8]);

                        }
                    });
                    LoadCaseHistoryPast();
                }



                function LoadCaseHistoryPast() {

                    var PaitentID = document.getElementById("txtPaitentID").value;
                    var InvoiceNo = document.getElementById("txtInvoiceNoToken").value;


                    var datas = "&PaitentID=" + PaitentID + "&InvoiceNo=" + InvoiceNo;
                    // alert(datas);
                    $.ajax({
                        url: "Load/LoadCaseHistoryPast.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {
                            // alert(data);
                            $('#DivPaitentCasSheet').html(data);


                        }
                    });


                }



                function UpdateCaseHistory() {

                    var Height = document.getElementById("txtHeight").value;
                    var Weight = document.getElementById("txtWeight").value;
                    var Pulse = document.getElementById("txtPulse").value;
                    var BP = document.getElementById("txtBP").value;


                    var Temperature = document.getElementById("txtTemperature").value;

                    var SkinHairNail = document.getElementById("txtSkinHairNail").value;

                    var Compliant = ''; // document.getElementById("txtCompliant").value;

                    var PresentIllness = document.getElementById("txtPresentIllness").value;
                    var PastIllness = document.getElementById("txtPastIllness").value;


                    var Diagnosis = document.getElementById("txtDiagnosis").value;
                    var Medicine = document.getElementById("txtMedicine").value;
                    var Advice = document.getElementById("txtDietChart").value;
                    var TestRequired = document.getElementById("txtPathologyComments").value;



                    var PaitentID = document.getElementById("txtPaitentID").value;
                    var TokenNo = document.getElementById("txtTokenID").value;

                    var InvoiceNo = document.getElementById("txtInvoiceNoToken").value;
                    var NextAppointment = document.getElementById("dtNextAppointmentCaseHistory").value;


                    var datas = "&Height=" + encodeURIComponent(Height) +
                        "&Weight=" + encodeURIComponent(Weight) +
                        "&Pulse=" + encodeURIComponent(Pulse) +
                        "&BP=" + encodeURIComponent(BP) +
                        "&Temperature=" + encodeURIComponent(Temperature) +
                        "&SkinHairNail=" + encodeURIComponent(SkinHairNail) +
                        "&Compliant=" + encodeURIComponent(Compliant) +
                        "&PresentIllness=" + encodeURIComponent(PresentIllness) +
                        "&PastIllness=" + encodeURIComponent(PastIllness) +
                        "&Diagnosis=" + encodeURIComponent(Diagnosis) +
                        "&Medicine=" + encodeURIComponent(Medicine) +
                        "&Advice=" + encodeURIComponent(Advice) +
                        "&TestRequired=" + encodeURIComponent(TestRequired) +
                        "&PaitentID=" + encodeURIComponent(PaitentID) +
                        "&TokenNo=" + encodeURIComponent(TokenNo) +
                        "&NextAppointment=" + encodeURIComponent(NextAppointment) +
                        "&InvoiceNo=" + encodeURIComponent(InvoiceNo);

                    $.ajax({
                        url: "Save/UpdateCasehHistory.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {

                            if (data == 1) {
                                // windows.location('TokenDetails.php?MID=31');
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Case History Updated',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                // window.location.assign("TokenDetails.php?MID=31");

                                //   setTimeout("location.reload(true);", 1500);




                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'warning',
                                    title: 'Unable to add Case History, Please try again!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                            }





                        }
                    });
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


                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Refund to Customer</h4>
                    </div>
                    <div class="modal-body">

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
                                $sqli = "SELECT paitentid,concat(paitentname,' - ', mobileno) as Mobile FROM   `paitentmaster` order by paitentname";
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
                            <h4 class="panel-title">Case History View

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button class='btn btn-warning btn-md' onclick='PrintPrescription()'>Print</button>



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
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <div class="panel-body">



                            <div class="col-md-12">
                                <input type='hidden' id='txtQuery' name='txtQuery' />

                                <input type='hidden' id='txtTokenID' name='txtTokenID' value='<?php echo $TokenID ?>' />
                                <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' />

                                <input type='hidden' id='txtPatientCode' name='txtPatientCode' />


                                <input type='hidden' name='txtIDforClosure' id='txtIDforClosure' />


                                <input type='hidden' id='txtInvoiceNoToken' name='txtInvoiceNoToken'
                                    value='<?php echo $InvoiceNo ?>' />

                                <input type='hidden' id='txtCaseHistoryAdded' name='txtCaseHistoryAdded' />






                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="default-tab-1">

                                        <div class="col-md-12">


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
                                                <input type='text' id='txtPaitentID' name='txtPaitentID'
                                                    value='<?php echo $PaitentId ?>' />


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

                                            function AddConceptPaitentMapping(x) {

                                                var ConceptNameID = x;
                                                if (ConceptNameID == '0') {
                                                    var ConceptName = 'Symptoms'
                                                    var ConceptID = document.getElementById("cmbSymptoms").value;
                                                } else if (ConceptNameID == '6') {
                                                    var ConceptName = 'Disease'
                                                    var ConceptID = document.getElementById("cmbDisease").value;
                                                } else if (ConceptNameID == '1') {
                                                    var ConceptName = 'Diagnosis'
                                                    var ConceptID = document.getElementById("cmbDiagnosis").value;
                                                } else if (ConceptNameID == '5') {
                                                    var ConceptName = 'Acupoints'
                                                    var ConceptID = document.getElementById("cmbAcupuncture").value;
                                                } else if (ConceptNameID == '2') {
                                                    var ConceptName = 'Medicine'
                                                    var ConceptID = document.getElementById("cmbMedicine").value;
                                                } else if (ConceptNameID == '3') {
                                                    var ConceptName = 'Therapy'
                                                    var ConceptID = document.getElementById("cmbTherapy").value;
                                                } else if (ConceptNameID == '4') {
                                                    var ConceptName = 'Pathology'
                                                    var ConceptID = document.getElementById("cmbPathology").value;
                                                }

                                                // var DiseaseID = document.getElementById("cmbDisease").value;
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;

                                                if (PaitentID == "") {
                                                    swal("Alert!", "Kindly provide Disease Name!", "warning");
                                                } else {
                                                    var datas = "&ConceptID=" + ConceptID +
                                                        "&PaitentID=" + PaitentID +
                                                        "&UniqueID=" + UniqueID +
                                                        "&ConceptName=" + ConceptName;

                                                    $.ajax({
                                                        url: "Save/PaitentDiseaseMapping/SaveConceptMapping.php",
                                                        method: "POST",
                                                        data: datas,
                                                        success: function(data) {

                                                            LoadAllConcepts();
                                                        }
                                                    });
                                                }
                                            }

                                            function SaveNewSymptoms() {
                                                var NewSymptoms = document.getElementById("txtNewSymptoms").value;
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;
                                                var datas = "&PaitentID=" + PaitentID +
                                                    "&UniqueID=" + UniqueID +
                                                    "&NewSymptoms=" + NewSymptoms;

                                                $.ajax({
                                                    url: "Save/PaitentDiseaseMapping/SaveNewSymptoms.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        document.getElementById("txtNewSymptoms").value =
                                                            '';
                                                        LoadAllConcepts();
                                                        HideNewSymptoms();

                                                    }
                                                });

                                            }

                                            function SaveNewDisease() {
                                                var NewDisease = document.getElementById("txtNewDisease").value;
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;
                                                var datas = "&PaitentID=" + PaitentID +
                                                    "&UniqueID=" + UniqueID +
                                                    "&NewDisease=" + NewDisease;

                                                $.ajax({
                                                    url: "Save/PaitentDiseaseMapping/SaveNewDisease.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        document.getElementById("txtNewDisease").value =
                                                            '';
                                                        LoadAllConcepts();
                                                        HideNewDisease();

                                                    }
                                                });

                                            }

                                            function SaveNewDiagnosis() {
                                                var NewDiagnosis = document.getElementById("txtNewDiagnosis").value;
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;
                                                var datas = "&PaitentID=" + PaitentID +
                                                    "&UniqueID=" + UniqueID +
                                                    "&NewDiagnosis=" + NewDiagnosis;

                                                $.ajax({
                                                    url: "Save/PaitentDiseaseMapping/SaveNewDiagnosis.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        document.getElementById("txtNewDiagnosis").value =
                                                            '';
                                                        LoadAllConcepts();
                                                        HideNewDiagnosis();
                                                    }
                                                });

                                            }

                                            function SaveNewAcupunture() {
                                                var NewAcupunture = document.getElementById("txtNewAcupunture").value;
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;
                                                var datas = "&PaitentID=" + PaitentID +
                                                    "&UniqueID=" + UniqueID +
                                                    "&NewAcupunture=" + NewAcupunture;

                                                $.ajax({
                                                    url: "Save/PaitentDiseaseMapping/SaveNewAcupunture.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        document.getElementById("txtNewAcupunture").value =
                                                            '';
                                                        LoadAllConcepts();
                                                        HideNewAcupunture();
                                                    }
                                                });

                                            }


                                            function SaveNewPathology() {
                                                var NewPathology = document.getElementById("txtNewPathology").value;
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;
                                                var datas = "&PaitentID=" + PaitentID +
                                                    "&UniqueID=" + UniqueID +
                                                    "&NewPathology=" + NewPathology;

                                                $.ajax({
                                                    url: "Save/PaitentDiseaseMapping/SaveNewPathology.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        document.getElementById("txtNewPathology").value =
                                                            '';
                                                        LoadAllConcepts();
                                                        HideNewPathology();
                                                    }
                                                });

                                            }

                                            function LoadAllConcepts() {
                                                LoadSymptoms();
                                                LoadDiesase();
                                                LoadDiagnosis();
                                                LoadTherapy();
                                                LoadPathalogy();
                                                LoadMedicine();
                                                LoadAcuPoints();
                                                LoadDietDetails();

                                                LoadSurgeryHistory();
                                                LoadMedicineHistory();


                                            }


                                            function SaveMedicineCalc() {
                                                var MappingID = document.getElementById("txtMedicineMappingID").value;
                                                var MorningQty = document.getElementById("txtMorningQty").value;
                                                var AfternoonQty = document.getElementById("txtAfterNoonQty").value;
                                                var EveningQty = document.getElementById("txtEveningQty").value;
                                                var NightQty = document.getElementById("txtNightQty").value;
                                                var Condition = document.getElementById("cmbCondition").value;
                                                var Duration = document.getElementById("txtDuration").value;
                                                var datas = "&MappingID=" + MappingID +
                                                    "&MorningQty=" + MorningQty +
                                                    "&AfternoonQty=" + AfternoonQty +
                                                    "&EveningQty=" + EveningQty +
                                                    "&NightQty=" + NightQty +
                                                    "&Condition=" + Condition +
                                                    "&Duration=" + Duration;


                                                $.ajax({
                                                    url: "Save/PaitentDiseaseMapping/SaveMedicineCalculation.php",
                                                    method: "POST",
                                                    data: datas,
                                                    dataType: "json",
                                                    success: function(data) {
                                                        LoadMedicine();

                                                    }
                                                });

                                            }

                                            function SaveTherapyCalc() {
                                                var MappingID = document.getElementById("txtTherapyMappingID").value;
                                                var Sittings = document.getElementById("txtTherapySittings").value;

                                                var Condition = document.getElementById("cmbConditionTherapy").value;
                                                var datas = "&MappingID=" + MappingID +
                                                    "&Sittings=" + Sittings +
                                                    "&Condition=" + Condition;


                                                $.ajax({
                                                    url: "Save/PaitentDiseaseMapping/SaveTherapyCalculation.php",
                                                    method: "POST",
                                                    data: datas,
                                                    dataType: "json",
                                                    success: function(data) {
                                                        LoadTherapy();

                                                    }
                                                });

                                            }






                                            function LoadMedicineCalc(x) {
                                                var MappingID = x;
                                                var datas = "&MappingID=" + MappingID;
                                                $.ajax({
                                                    url: "Load/PaitentDiseaseMapping/LoadMedicineCalculation.php",
                                                    method: "POST",
                                                    data: datas,
                                                    dataType: "json",
                                                    success: function(data) {

                                                        $("#txtMedicineMappingID").val(data[0]);
                                                        $("#spnMedicine").text(data[1]);
                                                        $("#txtMorningQty").val(data[2]);
                                                        $("#txtAfterNoonQty").val(data[3]);
                                                        $("#txtEveningQty").val(data[4]);
                                                        $("#txtNightQty").val(data[5]);
                                                        $("#cmbCondition").val(data[6]);
                                                        $("#txtDuration").val(data[7]);

                                                    }
                                                });

                                            }

                                            function LoadTherapyCalc(x) {
                                                var MappingID = x;
                                                var datas = "&MappingID=" + MappingID;
                                                $.ajax({
                                                    url: "Load/PaitentDiseaseMapping/LoadTherapyCalculation.php",
                                                    method: "POST",
                                                    data: datas,
                                                    dataType: "json",
                                                    success: function(data) {

                                                        $("#txtTherapyMappingID").val(data[0]);
                                                        $("#spnTherapy").text(data[1]);
                                                        $("#txtTherapySittings").val(data[2]);
                                                        $("#cmbConditionTherapy").val(data[3]);

                                                    }
                                                });

                                            }

                                            function LoadSurgeryHistory() {
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;

                                                var datas = "&PaitentID=" + PaitentID + "&UniqueID=" + UniqueID
                                                $.ajax({
                                                    url: "Load/PaitentDiseaseMapping/LoadSurgery.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        $('#DivSurgeryList').html(data);
                                                    }
                                                });
                                            }

                                            function LoadMedicineHistory() {
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;

                                                var datas = "&PaitentID=" + PaitentID + "&UniqueID=" + UniqueID
                                                $.ajax({
                                                    url: "Load/PaitentDiseaseMapping/LoadMedicineHistory.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        $('#DivMedicineHistoryList').html(data);
                                                    }
                                                });
                                            }



                                            function LoadDietDetails() {
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;

                                                var datas = "&PaitentID=" + PaitentID + "&UniqueID=" + UniqueID;
                                                $.ajax({
                                                    url: "Load/PaitentDiseaseMapping/LoadDietDetails.php",
                                                    method: "POST",
                                                    data: datas,
                                                    dataType: "json",
                                                    success: function(data) {

                                                        $("#txtDietChart").val(data[0]);

                                                    }
                                                });
                                            }


                                            function LoadSymptoms() {
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;

                                                var datas = "&PaitentID=" + PaitentID + "&UniqueID=" + UniqueID
                                                $.ajax({
                                                    url: "Load/PaitentDiseaseMapping/LoadSymptomsList.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        $('#DivSymptomsList').html(data);
                                                    }
                                                });
                                            }

                                            function LoadDiesase() {
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;

                                                var datas = "&PaitentID=" + PaitentID + "&UniqueID=" + UniqueID
                                                $.ajax({
                                                    url: "Load/PaitentDiseaseMapping/LoadDiseaseList.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        $('#DivDiseaseList').html(data);
                                                    }
                                                });
                                            }


                                            function LoadDiagnosis() {
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;

                                                var datas = "&PaitentID=" + PaitentID + "&UniqueID=" + UniqueID

                                                $.ajax({
                                                    url: "Load/PaitentDiseaseMapping/LoadDiagnosisList.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        $('#DivDiagnosisList').html(data);
                                                    }
                                                });
                                            }

                                            function LoadAcuPoints() {
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;

                                                var datas = "&PaitentID=" + PaitentID + "&UniqueID=" + UniqueID

                                                $.ajax({
                                                    url: "Load/PaitentDiseaseMapping/LoadAcupuntureList.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        $('#DivAcupuntureList').html(data);
                                                    }
                                                });
                                            }

                                            function LoadMedicine() {
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;

                                                var datas = "&PaitentID=" + PaitentID + "&UniqueID=" + UniqueID

                                                $.ajax({
                                                    url: "Load/PaitentDiseaseMapping/LoadMedicineList.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        $('#DivMedicineList').html(data);
                                                    }
                                                });
                                            }

                                            function LoadTherapy() {
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;

                                                var datas = "&PaitentID=" + PaitentID + "&UniqueID=" + UniqueID

                                                $.ajax({
                                                    url: "Load/PaitentDiseaseMapping/LoadTherapyList.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        $('#DivTherapyList').html(data);
                                                    }
                                                });
                                            }

                                            function LoadPathalogy() {
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;

                                                var datas = "&PaitentID=" + PaitentID + "&UniqueID=" + UniqueID

                                                $.ajax({
                                                    url: "Load/PaitentDiseaseMapping/LoadPathologyList.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        $('#DivPathologyList').html(data);
                                                    }
                                                });
                                            }

                                            function AutoSuggestionSymptoms() {
                                                LoadGIF();

                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;


                                                var datas = "&PaitentID=" + PaitentID + "&UniqueID=" + UniqueID;
                                                $.ajax({
                                                    url: "Save/PaitentDiseaseMapping/UpdateAutoSuggesiton_Symptoms.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        LoadAllConcepts();


                                                    }
                                                });

                                            }

                                            function AutoSuggestionDiagnosis() {
                                                LoadGIF();

                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;


                                                var datas = "&PaitentID=" + PaitentID + "&UniqueID=" + UniqueID;
                                                $.ajax({
                                                    url: "Save/PaitentDiseaseMapping/UpdateAutoSuggesiton_Diagnosis.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        LoadAllConcepts();


                                                    }
                                                });

                                            }

                                            function AutoSuggestionDisease() {
                                                LoadGIF();

                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;


                                                var datas = "&PaitentID=" + PaitentID + "&UniqueID=" + UniqueID;
                                                $.ajax({
                                                    url: "Save/PaitentDiseaseMapping/UpdateAutoSuggesiton_Disease.php",
                                                    method: "POST",
                                                    data: datas,
                                                    success: function(data) {
                                                        LoadAllConcepts();


                                                    }
                                                });

                                            }


                                            function ShowNewSymptoms() {
                                                var DivSymptoms = document.getElementById("DivNewSymptoms");
                                                DivSymptoms.style.display = "inline-block";
                                            }

                                            function HideNewSymptoms() {
                                                var DivSymptoms = document.getElementById("DivNewSymptoms");
                                                DivSymptoms.style.display = "none";
                                            }

                                            function ShowNewDiesase() {
                                                var DivDiesase = document.getElementById("DivNewDiesase");
                                                DivDiesase.style.display = "inline-block";
                                            }

                                            function HideNewDiesase() {
                                                var DivDiesase = document.getElementById("DivNewDiesase");
                                                DivDiesase.style.display = "none";
                                            }

                                            function ShowNewDiagnosis() {
                                                var DivDiagnosis = document.getElementById("DivNewDiagnosis");
                                                DivDiagnosis.style.display = "inline-block";
                                            }

                                            function HideNewDiagnosis() {
                                                var DivDiagnosis = document.getElementById("DivNewDiagnosis");
                                                DivDiagnosis.style.display = "none";
                                            }

                                            function ShowNewAcupunture() {
                                                var DivAcupunture = document.getElementById("DivNewAcupunture");
                                                DivAcupunture.style.display = "inline-block";
                                            }

                                            function HideNewAcupunture() {
                                                var DivAcupunture = document.getElementById("DivNewAcupunture");
                                                DivAcupunture.style.display = "none";
                                            }

                                            function ShowNewPathology() {
                                                var DivPathology = document.getElementById("DivNewPathology");
                                                DivPathology.style.display = "inline-block";
                                            }

                                            function HideNewPathology() {
                                                var DivPathology = document.getElementById("DivNewPathology");
                                                DivPathology.style.display = "none";
                                            }


                                            function LoadGIF() {
                                                document.getElementById("loading").style.display = "block";
                                                setTimeout(function() {
                                                    document.getElementById("loading").style.display = "none";
                                                }, 5000);
                                            }






                                            function PrintPrescription() {
                                                var PaitentID = document.getElementById("txtPaitentID").value;
                                                var UniqueID = document.getElementById("txtInvoiceNoToken").value;

                                                var str1 = 'CaseSheetPrint/CaseSheetPrint.php?P=';
                                                var str2 = PaitentID;
                                                var str3 = '&UID=';
                                                var str4 = UniqueID;
                                                var BillPrintURL = str1.concat(str2, str3, str4);
                                                window.open(BillPrintURL, '_blank');
                                            }
                                            </script>
                                        </body>
                                        <label><u><b>Document List</b></u></label>
                                        <div id='DivDocumentList'> </div>





                                    </div>



                                    <div class="row">

                                        <div class="panel panel-inverse">
                                            <div class="panel-body">
                                                <div class="col-md-2">
                                                    <table>
                                                        <tr>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Height (CM)
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="number" class="form-control" id="txtHeight"
                                                                    name='txtHeight' placeholder="" />
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <br>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td>Weight (KG)</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="number" class="form-control" id="txtWeight"
                                                                    name='txtWeight' placeholder="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <br>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td>Pulse (bpm)</td>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="number" class="form-control" id="txtPulse"
                                                                    name='txtPulse' placeholder="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <br>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td>BP (mmHg)</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control" id="txtBP"
                                                                    name='txtBP' placeholder="120 / 80" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <br>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td>Temperature (F)</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="number" class="form-control"
                                                                    id="txtTemperature" name='txtTemperature'
                                                                    placeholder="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <br>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td>Skin / Hair / Nail</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control"
                                                                    id="txtSkinHairNail" name='txtSkinHairNail'
                                                                    placeholder="" />
                                                            </td>
                                                        </tr>
                                                    </table>



                                                </div>

                                                <style>
                                                .panel1 {
                                                    margin-bottom: 20px;
                                                    background-color: #fff;
                                                    border: 1px solid transparent;
                                                    border-radius: 4px;
                                                    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
                                                    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
                                                }

                                                .panel-danger,
                                                .panel-danger>.panel-heading,
                                                .panel-default,
                                                .panel-default>.panel-heading,
                                                .panel-info>.panel-heading,
                                                .panel-primary,
                                                .panel-primary>.panel-heading,
                                                .panel-success,
                                                .panel-success>.panel-heading,
                                                .panel-warning,
                                                .panel-warning>.panel-heading,
                                                .well blockquote {
                                                    border-color: #ddd;
                                                }
                                                </style>

                                                <div class="panel1 panel-primary col-md-10">
                                                    <div class="panel-heading">

                                                        <h4 class="panel-title">Surgery and Medicine History

                                                        </h4>
                                                    </div>
                                                    <div class="panel1 panel-primary col-md-6">

                                                        <div class="panel-body">
                                                            <p><u>Surgery History</u></p>

                                                            <div id='DivSurgeryList'></div>

                                                        </div>

                                                    </div>


                                                    <div class="panel1 panel-primary col-md-6">

                                                        <div class="panel-body">


                                                            <P><u>Medicine History</u></p>

                                                            <div id='DivMedicineHistoryList'></div>

                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-10">


                                                    <div class="panel1 panel-primary">
                                                        <div class="panel-heading">

                                                            <h4 class="panel-title">Diesase

                                                            </h4>
                                                        </div>
                                                        <div class="panel-body">


                                                            <div id='DivDiseaseList'></div>

                                                        </div>

                                                    </div>

                                                    <div class="panel1 panel-primary">
                                                        <div class="panel-heading">

                                                            <h4 class="panel-title">Symptoms

                                                            </h4>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div id='DivSymptomsList'></div>

                                                        </div>

                                                    </div>


                                                    <div class="panel1 panel-primary">
                                                        <div class="panel-heading">

                                                            <h4 class="panel-title">Diagnosis

                                                            </h4>
                                                        </div>
                                                        <div class="panel-body">

                                                            <div id='DivDiagnosisList'></div>

                                                        </div>

                                                    </div>





                                                    <div class="panel1 panel-primary">
                                                        <div class="panel-heading">

                                                            <h4 class="panel-title">Acupunture Points

                                                            </h4>
                                                        </div>
                                                        <div class="panel-body">


                                                            <div id='DivAcupuntureList'></div>

                                                        </div>

                                                    </div>



                                                    <div class="panel1 panel-primary">
                                                        <div class="panel-heading">

                                                            <h4 class="panel-title">Medicines
                                                            </h4>
                                                        </div>
                                                        <div class="panel-body">


                                                            <div id='DivMedicineList'></div>

                                                        </div>

                                                    </div>





                                                    <div class="panel1 panel-primary">
                                                        <div class="panel-heading">

                                                            <h4 class="panel-title">Therapy
                                                            </h4>
                                                        </div>
                                                        <div class="panel-body">

                                                            <div id='DivTherapyList'></div>

                                                        </div>

                                                    </div>






                                                    <div class="panel1 panel-primary">
                                                        <div class="panel-heading">

                                                            <h4 class="panel-title">Investigation / Pathology

                                                            </h4>
                                                        </div>
                                                        <div class="panel-body">


                                                            <div id='DivPathologyList'></div>
                                                            <textarea id='txtPathologyComments'
                                                                name='txtPathologyComments'
                                                                class='form-control'></textarea>

                                                        </div>

                                                    </div>


                                                    <div class="panel1 panel-primary">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">Diet / Advice
                                                            </h4>
                                                        </div>
                                                        <div class="panel-body">
                                                            <textarea id='txtDietChart' name='txtDietChart'
                                                                class='form-control'></textarea>

                                                        </div>

                                                    </div>

                                                    <div class="panel1 panel-primary">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">Next Appointment
                                                            </h4>
                                                        </div>
                                                        <div class="panel-body">

                                                            <input disabled style='width:150px' type='date'
                                                                class='form-control' id='dtNextAppointmentCaseHistory'
                                                                name='dtNextAppointmentCaseHistory' />

                                                            <label>Remarks</label>
                                                            <input disabled type='text' id='txtRemarksNewHistory'
                                                                name='txtRemarksNewHistory' class='form-control'>

                                                        </div>

                                                    </div>







                                                    <div style='display:none'>
                                                        H/O Present Illness
                                                        <textarea id='txtPresentIllness' name='txtPresentIllness'
                                                            class='form-control'></textarea>

                                                        <textarea id=' txtCompliant' name='txtCompliant'
                                                            class='form-control'></textarea>
                                                        H/O Past Illness
                                                        <textarea id='txtPastIllness' name='txtPastIllness'
                                                            class='form-control'></textarea>
                                                        Diagnosis
                                                        <textarea id='txtDiagnosis' name='txtDiagnosis'
                                                            class='form-control'></textarea>
                                                        Rx
                                                        <textarea id='txtMedicine' name='txtMedicine'
                                                            class='form-control'></textarea>

                                                        Advice
                                                        <textarea id='txtAdvice' name='txtAdvice'
                                                            class='form-control'></textarea>

                                                        Tests Required
                                                        <textarea id='txtTestRequired' name='txtTestRequired'
                                                            class='form-control'></textarea>

                                                    </div>


                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                        Past History

                                        <div class="col-md-12">
                                            <div id='DivPaitentCasSheet'> </div>

                                        </div>


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