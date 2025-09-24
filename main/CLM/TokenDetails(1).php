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
// $position = $_SESSION["SESS_LAST_NAME"];
session_cache_limiter(FALSE);
session_start();
$LocationCode = $_SESSION['SESS_LOCATION'];
$GroupID = $_SESSION['SESS_GROUP_ID'];
$UserName = $_SESSION['SESS_FIRST_NAME'];
$UserID = $_SESSION['SESS_MEMBER_ID'];

// $DoctorName = $_SESSION['SESS_DOCTORNAME'];





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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
                    <h4 class="modal-title">Change Doctor</h4>
                </div>

                <div class="modal-body">
                    <label>Select Doctor</label>
                    <br>
                    <select style='border-radius: 4px; padding: 5px;' id='cmbEditDoctor' name='cmbEditDoctor'
                        onchange='GetTokenNewNumber()'>
                        <option value='0'>-</option>
                        <?php
                        $sqli = "SELECT userid,username FROM usermaster where designationid='9' and  activestatus='Active'";
                        $result = mysqli_query($connection, $sqli);
                        while ($row = mysqli_fetch_array($result)) {
                            # code...

                            echo ' <option value=' . $row['userid'] . '>' . $row['username'] . '</option>';
                        }
                        ?>

                    </select>


                    <input type='hidden' id='txtTokenNo' name='txtTokenNo' />
                    <input type='hidden' id='txtNewTokenNo' name='txtNewTokenNo' />

                    <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' />

                    <label></label>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" onclick="UpdateDoctor();"
                        data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script>
    function GetTokenNo(x, y) {
        document.getElementById("txtTokenNo").value = x;
        document.getElementById("txtInvoiceNo").value = y;
    }

    function GetTokenNewNumber() {
        var Dummy = 1;
        var DoctorCode = document.getElementById("cmbEditDoctor").value;
        var LocationCode = 3; //document.getElementById("cmbLocationAdmin").value;

        var datas = "&LocationCode=" + LocationCode + "&DoctorCode=" + DoctorCode;

        $.ajax({
            url: "Load/LoadTokenNo.php",
            method: "POST",
            data: datas,
            dataType: "json",
            success: function(data) {

                $("#txtNewTokenNo").val(data[0]);
            }
        });
    }

    function UpdateDoctor() {
        var Group = document.getElementById("txtGroupID").value;
        var TokenID = document.getElementById("txtTokenNo").value;
        var DoctorID = document.getElementById("cmbEditDoctor").value;
        var InvoiceNo = document.getElementById("txtInvoiceNo").value;
        var NewToken = document.getElementById("txtNewTokenNo").value;

        if (Group == '1') {
            var LocationCode = document.getElementById("cmbLocation").value;
        } else {
            var LocationCode = document.getElementById("txtLocationCode").value;
        }


        if (DoctorID == 0) {
            swal("Kindly Select the Doctor", "Warning", "warning")
        } else {
            var datas = "&DoctorID=" + encodeURIComponent(DoctorID) +
                "&TokenID=" + encodeURIComponent(TokenID) +
                "&InvoiceNo=" + encodeURIComponent(InvoiceNo) +
                "&NewToken=" + encodeURIComponent(NewToken) +
                "&LocationCode=" + encodeURIComponent(LocationCode);


            $.ajax({
                url: "Save/UpdateChangeDctor.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);

                    if (data == 1) {
                        Reset();
                        swal("Doctor Reassigned !", "Sucessfully", "success");

                    } else {
                        Reset();
                        swal("Alert!", 'Error Assiging Doctor', "warning");

                    }

                }
            });
        }


    }

    function PlaySound(x) {
        var TokenID = x;
        var UserID = <?php echo $UserID; ?>;
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
    
     

        function PlaySoundGeneral() {
 
            var audio = document.getElementById("audioGeneralMale");
            audio.play();
        }


        function PlaySoundAdmin() {

            var audio = document.getElementById("audioAdminMale");
            audio.play();
        }


        function PlaySoundTherapist() {

            var audio = document.getElementById("audioTherapistMale");
            audio.play();
        }


        function PlaySoundPharmasist() {

            var audio = document.getElementById("audioPharmacistMale");
            audio.play();
        }


        function PlaySoundGeneralFemale() {
          

            var audio = document.getElementById("audioGeneralFemale");
            audio.play();
        }


        function PlaySoundAdminFemale() {

            var audio = document.getElementById("audioAdminFemale");
            audio.play();
        }


        function PlaySoundTherapistFemale() {

            var audio = document.getElementById("audioTherapistFemale");
            audio.play();
        }


        function PlaySoundPharmasistFemale() {

            var audio = document.getElementById("audioPharmacistFemale");
            audio.play();
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

                   

<?php if($UserID==30)
{ ?>
    <li class="dropdown navbar-user">


                        <a href="javascript:;" data-toggle="dropdown" title='Call Receiptionist'
                            class="dropdown-toggle f-s-14" onclick='PlaySoundGeneralFemale()'>


                            <i class="fa fa-bell"></i>
                        </a>


                    </li>


                    <li class="dropdown navbar-user">





                        <a href="javascript:;" data-toggle="dropdown" title='Call Admin' class="dropdown-toggle f-s-14"
                            onclick='PlaySoundAdminFemale()'>


                            <i class="fa fa-user"></i>
                        </a>


                    </li>


                    <li class="dropdown navbar-user">


                        <a href="javascript:;" data-toggle="dropdown" title='Call Therapist'
                            class="dropdown-toggle f-s-14" onclick='PlaySoundTherapistFemale()'>


                            <i class="fa fa-users"></i>
                        </a>


                    </li>
                    
                    

                    <li class="dropdown navbar-user">


                        <a href="javascript:;" data-toggle="dropdown" title='Call Pharmacist'
                            class="dropdown-toggle f-s-14" onclick='PlaySoundPharmasistFemale()'>


                            <i class="fa fa-ban"></i>
                        </a>


                    </li>
<?php }
else

{  ?>
    <li class="dropdown navbar-user">


                        <a href="javascript:;" data-toggle="dropdown" title='Call Receiptionist'
                            class="dropdown-toggle f-s-14" onclick='PlaySoundGeneral()'>


                            <i class="fa fa-bell"></i>
                        </a>


                    </li>


                    <li class="dropdown navbar-user">





                        <a href="javascript:;" data-toggle="dropdown" title='Call Admin' class="dropdown-toggle f-s-14"
                            onclick='PlaySoundAdmin()'>


                            <i class="fa fa-user"></i>
                        </a>


                    </li>


                    <li class="dropdown navbar-user">


                        <a href="javascript:;" data-toggle="dropdown" title='Call Therapist'
                            class="dropdown-toggle f-s-14" onclick='PlaySoundTherapist()'>


                            <i class="fa fa-users"></i>
                        </a>


                    </li>
                    
                    

                    <li class="dropdown navbar-user">


                        <a href="javascript:;" data-toggle="dropdown" title='Call Pharmacist'
                            class="dropdown-toggle f-s-14" onclick='PlaySoundPharmasist()'>


                            <i class="fa fa-ban"></i>
                        </a>


                    </li>
<?php }
?>
                    


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
        function LoadTokenDetails() {

            var Group = document.getElementById("txtGroupID").value;
            var DoctorCode = document.getElementById("cmbDoctor").value;
            var TokenStatus = $("input[name='rdTokenStatus']:checked").val();

            if (Group == '1') {
                var Location = document.getElementById("cmbLocation").value;
            } else {
                var Location = document.getElementById("txtLocationCode").value;
            }


            var datas = "&Location=" + Location + "&TokenStatus=" + TokenStatus + "&DoctorCode=" + DoctorCode;

            $.ajax({
                url: "Load/LoadTokenDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivToken').html(data);


                }
            });
        }


        function SaveConsultingClosure(x, y, z) {
            var RefundStatus = '';
            var Remarks = '';
            var RefundAmount = 0;
            var PaitentID = x;
            var InvoiceNo = y;
            var TokenNo = z;
            var NextAppointment = '';
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


        function GetRowID(x) {

            var row = x.parentNode.rowIndex;
            document.getElementById("txtDoctorID").value = document.getElementById("indextable").rows[row].cells
                .namedItem("DoctorID").innerHTML;
            document.getElementById("txtDoctorUpdatedName").value = document.getElementById("indextable").rows[row]
                .cells.namedItem("Doctor").innerHTML;
            document.getElementById("txtDoctorUpdatedMobile").value = document.getElementById("indextable").rows[
                    row]
                .cells.namedItem("mobileno").innerHTML;
            document.getElementById("txtDoctorStatus").value = document.getElementById("indextable").rows[row].cells
                .namedItem("DoctorStatus").innerHTML;

        }


        function Reset() {
            LoadTokenDetails();
        }
        </script>

        <div id="content" class="content">
            <div class="row">

                <!-- begin col-6 -->
                <div class="col-md-12">
                    <input type='hidden' id='txtGroupID' name='txtGroupID' value='<?php echo $GroupID; ?>' />
                    <input type='hidden' id='txtLocationCode' name='txtLocationCode'
                        value='<?php echo $LocationCode; ?>' />
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Token List

                                <img src="../assets/img/newtokenlegend.png" width='350' style='float:right' />
                            </h4>


                        </div>

                        <div class="panel-body">

                            <input type='hidden' id='te' name='e' />
                            <?php
                            if ($GroupID == '1') {
                            ?>

                            <select style='border-radius: 4px; padding: 5px;' id='cmbLocation' name='cmbLocation'>
                                <option value="All" selected>All Location</option>
                                <?php
                                    $sqli = "SELECT locationcode,locationname FROM locationmaster";
                                    $result = mysqli_query($connection, $sqli);
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo ' <option value=' . $row['locationcode'] . '>' . $row['locationname'] . '</option>';
                                    }
                                    ?>

                            </select>
                            <?php
                            } else {
                            }

                            ?>
                            &nbsp;&nbsp;&nbsp;



                            <select style='border-radius: 4px; padding: 5px;' id='cmbDoctor' name='cmbDoctor'
                                onchange='LoadTokenDetails();'>

                                <?php
                                echo "<option value ='$UserID' selected>$UserName</option>";

                                $sqli = "SELECT userid,username FROM usermaster where designationid='9' and
                              activestatus='Active' and userid not in('$UserID') ";
                                $result = mysqli_query($connection, $sqli);
                                while ($row = mysqli_fetch_array($result)) {
                                    # code...

                                    echo ' <option value=' . $row['userid'] . '>' . $row['username'] . '</option>';
                                }
                                ?>


                            </select>

                            &nbsp;&nbsp;&nbsp;


                            <label class="radio-inline">
                                <input type="radio" name="rdTokenStatus" value="Open" checked
                                    onclick="LoadTokenDetails();" />
                                Open
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="rdTokenStatus" value="Completed"
                                    onclick="LoadTokenDetails();" />
                                Completed
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="rdTokenStatus" value="Cancelled"
                                    onclick="LoadTokenDetails();" />
                                Cancelled
                            </label>


                            <hr>

                            <div id='DivToken'> </div>
                            <!-- end col-3 -->
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
    
    <audio id="audioGeneralMale" src="Sound\MaleReceptionist.mp3"></audio>
                <audio id="audioAdminMale" src="Sound\MaleAdmin.mp3"></audio>
                <audio id="audioTherapistMale" src="Sound\MaleTherapist.mp3"></audio>
                <audio id="audioPharmacistMale" src="Sound\MalePharmacist.mp3"></audio>
                
                
                <audio id="audioGeneralFemale" src="Sound\FemaleReceptionist.mp3"></audio>
                <audio id="audioAdminFemale" src="Sound\FemaleAdmin.mp3"></audio>
                <audio id="audioTherapistFemale" src="Sound\FemaleTherapist.mp3"></audio>
                <audio id="audioPharmacistFemale" src="Sound\FemalePharmacist.mp3"></audio>



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