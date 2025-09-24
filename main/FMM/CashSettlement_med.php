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

<body onload="LoadDenominationDetails(); LoadDayCloseList();">
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
            <?php include("FMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->

        <script>
        function myFunction() {
            document.getElementById('dtEntryDate').value = Date();
        }



        function SaveDayClose() {


            var DayCloseDate = document.getElementById("dtEntryDate").value;
            var OpeningBalance = document.getElementById("txtOpeningBalance").value;
            var AvailableCash = document.getElementById("txtAvailableCash").value;
            var HandoverCash = document.getElementById("txtHandovercash").value;
            var ClosingBalance = document.getElementById("txtClosingBalance").value;
            var Remarks = document.getElementById("txtRemarks").value;
            var Location = document.getElementById("cmbLocation").value;
            var PettyCashOpening = document.getElementById("txtOpeningPettyCash").value;
            var PettyCashOpening = document.getElementById("txtOpeningPettyCash").value;
            var ClosingCash = document.getElementById("txtClosingCash").value;

            // alert(Ledger);

            if (DayCloseDate == "" || ClosingBalance == "" || HandoverCash == "") {

                swal("Alert!", " Fill All details", "warning");

            } else {

                var datas = "&DayCloseDate=" + DayCloseDate + "&OpeningBalance=" + OpeningBalance + "&AvailableCash=" +
                    AvailableCash + "&HandoverCash=" + HandoverCash + "&ClosingBalance=" + ClosingBalance +
                    "&Remarks=" + Remarks + "&Location=" + Location + "&OpeningCash=" + OpeningCash + "&ClosingCash=" +
                    ClosingCash;
                // alert(datas);
                $.ajax({
                    url: "Save/SaveDayClosing_med.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == 1) {

                            swal("Day Closed Sucessfully", "success");
                            // swal(data);
                            // LoadDayCloseList();
                            Reset();
                        } else {
                            swal("Alert!", data, "warning");

                            Reset();
                        }


                    }
                });
            }

        }


        function Reset() {

            setTimeout(function() {
                window.location.reload(1);
            }, 1000);

        }


        function LoadDayCloseList() {

            var FromDate = document.getElementById("dtFromDate").value;
            var ToDate = document.getElementById("dtToDate").value;
            var Location = document.getElementById("cmbLocation").value;
            var Dummy = "Dummy";
            var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate + "&Location=" + Location;
            // alert(datas);
            $.ajax({
                url: "Load/LoadCashClosingHistory.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivPaymentHistory').html(data);


                }
            });
        }

        function PrintDenomination() {
            var DayCloseDate = document.getElementById("dtEntryDate").value;
            var Location = document.getElementById("cmbLocation").value;

            var datas = "&DayCloseDate=" + DayCloseDate + "&Location=" + Location;

            var Invoice = document.getElementById("txtClosingID").value;

            if (Invoice > 0) {


                var str1 = "ReceiptPrint.php?invoice=";
                var str2 = Invoice;
                var str3 = "";
                var BillPrintURL = str1.concat(str2, str3);

                // alert(BillPrintURL);
                // window.location.href = BillPrintURL;
                window.open(BillPrintURL);
            } else {
                alert("Kindly save the denomination and then Print")
            }
        }



        function LoadDenominationDetails() {
            var DayCloseDate = document.getElementById("dtEntryDate").value;
            var Location = document.getElementById("cmbLocation").value;


            var datas = "&DayCloseDate=" + DayCloseDate + "&Location=" + Location;

            if (DayCloseDate == "") {
                swal("Alert!", "Kindly select the date", "warning");
            } else {
                $.ajax({
                    url: "Load/LoadDenomination_med.php",
                    method: "POST",
                    data: datas,
                    dataType: "json",
                    success: function(data) {
                        var CloseStatus = data[0];


                        if (CloseStatus > 0) {
                            document.getElementById('btnSave').style.visibility = 'hidden';
                            document.getElementById("txt2000").value = data[1];
                            document.getElementById("txt500").value = data[2];
                            document.getElementById("txt200").value = data[3];
                            document.getElementById("txt100").value = data[4];
                            document.getElementById("txt50").value = data[5];
                            document.getElementById("txt20").value = data[6];
                            document.getElementById("txt10").value = data[7];
                            document.getElementById("txtCoins").value = data[8];
                            document.getElementById("txtMedicineCash").value = data[9];
                            document.getElementById("txtConsultingCash").value = data[10];
                            document.getElementById("txtTherapyCash").value = data[11];
                            document.getElementById("txtOtherCash").value = data[12];
                            document.getElementById("txtGrossCash").value = data[13];
                            document.getElementById("txtExpense").value = data[14];
                            document.getElementById("txtNettCash").value = data[15];
                            document.getElementById("txtCashinHand").value = data[16];
                            document.getElementById("txtDifference").value = data[17];
                            document.getElementById("txtRemarks").value = data[18];
                            document.getElementById("txtEnteredBy").value = data[19];
                            document.getElementById("txtClosingID").value = data[20];
                            document.getElementById("txtOpeningPettyCash").value = data[21];
                            document.getElementById("txtTodayPettyCash").value = data[22];
                            document.getElementById("txtPettyCashDiff").value = data[23];



                        } else {
                            LoadOpeningBalance();
                            document.getElementById('btnSave').style.visibility = 'visible';
                            document.getElementById("txt2000").value = '';
                            document.getElementById("txt500").value = '';
                            document.getElementById("txt200").value = '';
                            document.getElementById("txt100").value = '';
                            document.getElementById("txt50").value = '';
                            document.getElementById("txt20").value = '';
                            document.getElementById("txt10").value = '';
                            document.getElementById("txtCoins").value = '';

                            document.getElementById("txtCashinHand").value = '';
                            document.getElementById("txtDifference").value = '';
                            document.getElementById("txtRemarks").value = '';
                            document.getElementById("txtClosingID").value = '';



                            document.getElementById("txtEnteredBy").value =
                                '<?php echo $_SESSION['SESS_FIRST_NAME']; ?>';




                            // swal("Alert!", "Already Closed, or Previous date not allowed", "warning");
                            // Reset();
                            // document.getElementById("txtOpeningBalance").value = data[0];
                        }


                    }
                });
            }
        }





        function LoadOpeningBalance() {
            var DayCloseDate = document.getElementById("dtEntryDate").value;
            var Location = document.getElementById("cmbLocation").value;

            var datas = "&DayCloseDate=" + DayCloseDate + "&Location=" + Location;

            if (DayCloseDate == "") {
                swal("Alert!", "Kindly select the date", "warning");
            } else {


                $.ajax({
                    url: "Load/LoadCashBalance_med.php",
                    method: "POST",
                    data: datas,
                    dataType: "json",
                    success: function(data) {

                        // var CloseStatus = data[2];
                        // // alert(CloseStatus);
                        document.getElementById("txtConsultingCash").value = 0;
                        document.getElementById("txtTherapyCash").value = 0;

                        // if (CloseStatus == "1") {
                        document.getElementById("txtMedicineCash").value = data[0];
                        document.getElementById("txtOtherCash").value = data[1];
                        document.getElementById("txtExpense").value = data[2];
                        document.getElementById("txtNettCash").value = data[3];
                        document.getElementById("txtOpeningPettyCash").value = data[4];
                        document.getElementById("txtTodayPettyCash").value = data[4];
                        document.getElementById("txtPettyCashDiff").value = 0;


                    }
                });
            }
        }





        function CalculateClosingBalance() {

            var OpeningBalance = parseInt(document.getElementById("txtOpeningBalance").value);
            var AvailableCash = parseInt(document.getElementById("txtAvailableCash").value);
            var HandoverCash = parseInt(document.getElementById("txtHandovercash").value);
            var ClosingBalance = OpeningBalance + AvailableCash - HandoverCash;
            document.getElementById("txtClosingBalance").value = ClosingBalance;


        }




        function printDiv() {
            var divToPrint = document.getElementById('DivPaymentHistory');
            var d = new Date();
            var htmlToPrint = '' +
                '<style type="text/css">' +
                'table th, table td {' +
                'border:1px solid #000;' +
                'padding;0.5em;' +
                '}' +
                '</style>' +
                '<h4>Day Close report</h4>' +
                '';
            htmlToPrint += divToPrint.outerHTML;
            newWin = window.open("");
            newWin.document.write(htmlToPrint);
            newWin.print();
            newWin.close();

        }

        function CalculateDenomination() {
            var Note2000 = document.getElementById('txt2000').value;
            var Note500 = document.getElementById('txt500').value;
            var Note200 = document.getElementById('txt200').value;
            var Note100 = document.getElementById('txt100').value;
            var Note50 = document.getElementById('txt50').value;
            var Note20 = document.getElementById('txt20').value;
            var Note10 = document.getElementById('txt10').value;
            var NoteCoins = document.getElementById('txtCoins').value;

            var CashonHand = document.getElementById('txtCashinHand').value;
            var GrossCash = document.getElementById('txtGrossCash').value;
            var Expense = document.getElementById('txtExpense').value;
            var NettCash = document.getElementById('txtNettCash').value;



            var TotalCash = 0;
            var Difference = 0;

            TotalCash = (Note2000 * 2000) + (Note500 * 500) + (Note200 * 200) + (Note100 * 100) + (Note50 * 50) + (
                Note20 * 20) + (Note10 * 10) + (NoteCoins * 1);
            document.getElementById('txtCashinHand').value = TotalCash;
            Difference = NettCash - TotalCash;
            document.getElementById('txtDifference').value = Difference;

            if (Difference < 0) {
                document.getElementById("txtDifference").style.backgroundColor = "red";
            } else if (Difference == 0) {
                document.getElementById("txtDifference").style.backgroundColor = "green";
            }



        }

        function SaveCashClosing() {

            var Note2000 = document.getElementById('txt2000').value;
            var Note500 = document.getElementById('txt500').value;
            var Note200 = document.getElementById('txt200').value;
            var Note100 = document.getElementById('txt100').value;
            var Note50 = document.getElementById('txt50').value;
            var Note20 = document.getElementById('txt20').value;
            var Note10 = document.getElementById('txt10').value;
            var NoteCoins = document.getElementById('txtCoins').value;

            var CashonHand = document.getElementById('txtCashinHand').value;
            var GrossCash = document.getElementById('txtGrossCash').value;
            var Expense = document.getElementById('txtExpense').value;
            var NettCash = document.getElementById('txtNettCash').value;
            var Remarks = document.getElementById("txtRemarks").value;
            var Location = document.getElementById("cmbLocation").value;
            var MedCash = document.getElementById("txtMedicineCash").value;
            var ConCash = document.getElementById("txtConsultingCash").value;
            var TheCash = document.getElementById("txtTherapyCash").value;
            var OthCash = document.getElementById("txtOtherCash").value;
            var DayCloseDate = document.getElementById("dtEntryDate").value;
            var CashDifference = document.getElementById("txtDifference").value;
            var PettycashOpening = document.getElementById("txtOpeningPettyCash").value;
            var PettycashClosing = document.getElementById("txtTodayPettyCash").value;
            var PettyCashDifference = document.getElementById("txtPettyCashDiff").value;



            if (DayCloseDate == "" || CashDifference == '') {

                swal("Alert!", " Fill All details", "warning");

            } else {

                var datas = "&Note2000=" + Note2000 + "&Note500=" + Note500 +
                    "&Note200=" + Note200 + "&Note100=" + Note100 + "&Note50=" + Note50 +
                    "&Note20=" + Note20 + "&Note10=" + Note10 + "&NoteCoins=" + NoteCoins +
                    "&CashonHand=" + CashonHand + "&GrossCash=" + GrossCash + "&Expense=" + Expense +
                    "&MedCash=" + MedCash + "&ConCash=" + ConCash + "&TheCash=" + TheCash + "&OthCash=" + OthCash +
                    "&NettCash=" + NettCash + "&Remarks=" + Remarks + "&Location=" + Location + "&DayCloseDate=" +
                    DayCloseDate + "&CashDifference=" + CashDifference +
                    "&PettycashOpening=" + PettycashOpening + "&PettycashClosing=" + PettycashClosing +
                    "&PettyCashDifference=" + PettyCashDifference;
                // alert(datas);
                $.ajax({
                    url: "Save/SaveCashClosing_med.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        if (data == 1) {

                            swal("success!", "Cash Closing Completed", "success");
                            // swal(data);
                            // LoadDayCloseList();
                            Reset();
                        } else {
                            swal("Alert!", "Unable to Close Cash", "warning");

                            Reset();
                        }

                    }
                });
            }

        }

        function CalculatePettyCash() {

            var OpeningCash = document.getElementById("txtOpeningPettyCash").value;
            var ClosingCash = document.getElementById("txtTodayPettyCash").value;
            document.getElementById("txtPettyCashDiff").value = OpeningCash * 1 - ClosingCash * 1;
        }
        </script>


        <style>
        .bootstrap-select:not([class*="span"]):not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 320px;
        }
        </style>

        <div id="content" class="content">
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-5">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">

                            <h4 class="panel-title">Cash Details - Medicine
                                <input type='hidden' name='txtClosingID' id='txtClosingID' />
                                <input type='text' name='txtEnteredBy' id='txtEnteredBy'
                                    style='float:right;color:black;' value='<?php echo $_SESSION['SESS_FIRST_NAME']; ?>'
                                    disabled />
                            </h4>

                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> Location</label>
                                    <div class="col-md-3">
                                        <select style='border-radius: 4px; padding: 5px;' id='cmbLocation'
                                            name='cmbLocation' onchange='LoadDayCloseList(); LoadOpeningBalance();'>

                                            <?php
                                            $sqli = "SELECT locationcode,locationname FROM locationmaster where locationcode='3'";
                                            $result = mysqli_query($connection, $sqli);
                                            while ($row = mysqli_fetch_array($result)) {
                                                # code...

                                                echo ' <option value=' . $row['locationcode'] . '>' . $row['locationname'] . '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <label class="col-md-1 control-label">Date</label>

                                    <div class="col-md-4">
                                        <input type="hidden" class="form-control" placeholder="" id='txtEntryDate'
                                            name='txtEntryDate' />
                                        <input type="date" class="form-control" id="dtEntryDate" name="dtEntryDate"
                                            value='<?php echo date('Y-m-d'); ?>'>

                                    </div>
                                    <input type='button' class="btn btn-sm btn-info" value='Load'
                                        onclick='LoadDenominationDetails(); LoadDayCloseList();' />



                                </div>

                                <div style='display:none;'>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"> Gross Cash</label>
                                        <div class="col-md-8">

                                            <input type="number" class="form-control" placeholder="" id='txtGrossCash'
                                                name='txtGrossCash' disabled style='text-align:right;'
                                                onkeyup="CalculateClosingBalance()" />


                                        </div>

                                    </div>
                                </div>






                                <div class="form-group">

                                    <div class="col-md-3">

                                        <input type="hidden" class="form-control" placeholder="" id='txtConsultingCash'
                                            name='txtConsultingCash' disabled style='text-align:right;' />

                                    </div>
                                    <div class="col-md-3">

                                        <input type="hidden" class="form-control" placeholder="" id='txtTherapyCash'
                                            name='txtTherapyCash' disabled style='text-align:right;' />

                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-md-4">
                                        <label class="col-md-3 control-label">Opening</label>
                                        <input type="number" class="form-control" placeholder=""
                                            id='txtOpeningPettyCash' name='txtOpeningPettyCash' disabled
                                            style='text-align:right;' />

                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-md-3 control-label">Petty&nbsp;Cash</label>
                                        <input type="number" class="form-control" placeholder="" id='txtTodayPettyCash'
                                            name='txtTodayPettyCash' style='text-align:right;'
                                            onblur='CalculatePettyCash()' />

                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-md-3 control-label">Diff</label>
                                        <input type="number" class="form-control" placeholder="" id='txtPettyCashDiff'
                                            name='txtPettyCashDiff' disabled style='text-align:right;' />

                                    </div>
                                </div>

                                <hr>



                                <div style='width:100%'>


                                    <div style='float:left;width:50%'>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Med</label>
                                            <div class="col-md-8">

                                                <input type="number" class="form-control" placeholder=""
                                                    id='txtMedicineCash' name='txtMedicineCash' disabled
                                                    style='text-align:right;' />

                                            </div>
                                        </div>





                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Other Cash</label>
                                            <div class="col-md-8">

                                                <input type="number" class="form-control" placeholder=""
                                                    id='txtOtherCash' name='txtOtherCash' disabled
                                                    style='text-align:right;' />


                                            </div>

                                        </div>




                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Expense</label>
                                            <div class="col-md-8">

                                                <input type="number" class="form-control" placeholder="" id='txtExpense'
                                                    name='txtExpense' onkeyup="CalculateClosingBalance()"
                                                    style='text-align:right;' disabled />

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Total Cash</label>
                                            <div class="col-md-8">

                                                <input type="number" class="form-control" placeholder=""
                                                    id='txtNettCash' name='txtNettCash' disabled
                                                    onkeyup="CalculateClosingBalance()" style='text-align:right;' />

                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Avbl. Cash</label>
                                            <div class="col-md-8">
                                                <b>
                                                    <input type="number" class="form-control" placeholder=""
                                                        id='txtCashinHand' name='txtCashinHand' disabled
                                                        onkeyup="CalculateClosingBalance()"
                                                        style='text-align:right;background-color:#b9d6f1;  color: black;' />
                                                </b>
                                            </div>
                                        </div>







                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Difference</label>
                                            <div class="col-md-8">
                                                <b>
                                                    <input type="number" class="form-control" placeholder=""
                                                        id='txtDifference' name='txtDifference'
                                                        onkeyup="CalculateClosingBalance()" disabled
                                                        style='text-align:right;background-color:red;  color: white;' />
                                                </b>
                                            </div>
                                        </div>


                                    </div>
                                    <div style='float:right;;width:50%'>
                                        <b><u>Denomination</b></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <b><u>Count</b></u>
                                        <table class=' '>



                                            <tr>
                                                <td>2000 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x </td>
                                                <td style='width:50%'><input type="number" class="form-control"
                                                        placeholder="" id='txt2000' name='txt2000'
                                                        onkeyup="CalculateDenomination()"
                                                        style='text-align:center;width:70%' ;' />
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>500 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x
                                                </td>
                                                <td style='width:50%'><input type="number" class="form-control"
                                                        placeholder="" id='txt500' name='txt500'
                                                        onkeyup="CalculateDenomination()"
                                                        style='text-align:center;width:70%' ;' />
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>200
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x
                                                </td>
                                                <td style='width:50%'><input type="number" class="form-control"
                                                        placeholder="" id='txt200' name='txt200'
                                                        onkeyup="CalculateDenomination()"
                                                        style='text-align:center;width:70%' ;' />
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>100 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x
                                                </td>
                                                <td style='width:50%'><input type="number" class="form-control"
                                                        placeholder="" id='txt100' name='txt100'
                                                        onkeyup="CalculateDenomination()"
                                                        style='text-align:center;width:70%' ;' />
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>50
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x
                                                </td>
                                                <td style='width:50%'><input type="number" class="form-control"
                                                        placeholder="" id='txt50' name='txt50'
                                                        onkeyup="CalculateDenomination()"
                                                        style='text-align:center;width:70%' ;' />
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>20&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x
                                                </td>
                                                <td style='width:50%'><input type="number" class="form-control"
                                                        placeholder="" id='txt20' name='txt20'
                                                        onkeyup="CalculateDenomination()"
                                                        style='text-align:center;width:70%' ;' />
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>10
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x
                                                </td>
                                                <td style='width:50%'><input type="number" class="form-control"
                                                        placeholder="" id='txt10' name='txt10'
                                                        onkeyup="CalculateDenomination()"
                                                        style='text-align:center;width:70%' ;' />
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Coins &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x</td>
                                                <td style='width:50%'><input type="number" class="form-control"
                                                        placeholder="" id='txtCoins' name='txtCoins'
                                                        onkeyup="CalculateDenomination()"
                                                        style='text-align:center;width:70%' ; />
                                                </td>
                                            </tr>


                                        </table>
                                    </div>


                                </div>




                                <div class="form-group">
                                    <label class="col-md-2 control-label">Remarks.</label>

                                    <div class="col-md-6">
                                        <textarea id='txtRemarks' name='txtRemarks' row='5'
                                            class="form-control"></textarea>
                                    </div>
                                </div>







                                <div class="form-group">
                                    <label class="col-md-3 control-label"> </label>
                                    <div class="col-md-9">
                                        <input type="button" class="btn btn-sm btn-success" id='btnSave'
                                            onClick="SaveCashClosing();" value='Save'>
                                        <input type="button" class="btn btn-sm btn-warning" onClick="Reset();"
                                            value='Clear'>
                                        <input type="button" class="btn btn-sm btn-info" onClick="PrintDenomination();"
                                            value='Print'>
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

                            <h4 class="panel-title">Cash Closing Statement</h4>

                        </div>
                        <div class="panel-body">
                            <input type='date' id='dtFromDate' name='dtFromDate' value='<?php echo date('Y-m-d'); ?>'
                                style='height: 2.2em;' />
                            <input type='date' id='dtToDate' name='dtToDate' value='<?php echo date('Y-m-d'); ?>'
                                style='height: 2.2em;' />

                            <input type="button" class="btn btn-sm btn-success" onClick="LoadDayCloseList();"
                                value='Load'>
                            <input type="button" class="btn btn-sm btn-success" onClick="printDiv();" value='Print'>
                            <div data-scrollbar="true" data-height="510px">
                                <ul class="chats">


                                    <div id="DivPaymentHistory" class="email-content"></div>
                                </ul>
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