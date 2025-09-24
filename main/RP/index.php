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
    <link href="../assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
    <link href="../assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
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

<body onload="LoadCardData();">
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

        <div id="wait" style="display:none;width:69px;height:189px;border:1px grey;position:absolute;top:50%;left:50%;padding:2px; z-index: 1000;">
            <img src='../assets/img/demo_wait.gif' width="64" height="64" />
            <br>Loading...
        </div>
        <!-- begin #sidebar -->
        <div id="sidebar" class="sidebar">
            <!-- begin sidebar scrollbar -->
            <!-- begin sidebar user -->
            <!-- end sidebar user -->
            <!-- begin sidebar nav -->
            <?php include("RPSidePanel.php") ?>
            <!-- end sidebar nav -->

            <!-- end sidebar scrollbar -->
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->
        <?php


        $res = $connection->query(" SELECT 
(SELECT ROUND(SUM(nettamount),0) AS Sales  FROM salemaster WHERE transactiontype IN ('Sale','Return') 
AND  saledate BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND LAST_DAY(NOW())) AS Sale,
(SELECT SUM(saleqty)  FROM salemaster WHERE transactiontype IN ('Sale','Return') 
AND  saledate BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND LAST_DAY(NOW())) AS SaleQty,
(SELECT ROUND(SUM(totalamount),0)  FROM purchaseitems WHERE  invoicedate BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND LAST_DAY(NOW())) AS Purchase;");

        while ($data = mysqli_fetch_row($res)) {

            $Sales = number_format($data[0]);
            $SalesQty = number_format($data[1]);
            $Purchase = number_format($data[2]);
        }

        ?>

        <script>
            $(document).ready(function() {
                $('#dtFromDate').datepicker({
                    format: "dd/mm/yyyy",
                    autoclose: true
                });

                //Alternativ way
                $('#dtToDate').datepicker({
                    format: "dd/mm/yyyy"
                }).on('change', function() {
                    $('.datepicker').hide();
                });
            });

            function LoadCashCardSTransaction() {
                // alert(1);
                var FromDate = document.getElementById("dtFromDate").value;
                var ToDate = document.getElementById("dtToDate").value;

                var Type = 'Detail';


                var Group = document.getElementById("txtGroupID").value;
                // alert(Group);
                if (Group == '1') {
                    var Location = document.getElementById("cmbLocation").value;
                } else {
                    var Location = document.getElementById("txtLocationCode").value;
                }



                var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate + "&Type=" + Type + "&Location=" + Location;

                // alert(datas);
                $.ajax({
                    url: "Load/LoadDashboardCashCardTransaction.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        $('#DivCashCardTransaction').html(data);


                    }
                });


            }



            function LoadDashboardDaySummary() {
                // alert(1);
                var FromDate = document.getElementById("dtFromDate").value;
                var ToDate = document.getElementById("dtToDate").value;

                var Type = 'Detail';


                var Group = document.getElementById("txtGroupID").value;
                // alert(Group);
                if (Group == '1') {
                    var Location = document.getElementById("cmbLocation").value;
                } else {
                    var Location = document.getElementById("txtLocationCode").value;
                }



                var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate + "&Type=" + Type + "&Location=" + Location;

                // alert(datas);
                $.ajax({
                    url: "Load/LoadDashboardDaySummary.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        $('#DivDaySummary').html(data);

                    }
                });
                LoadDashboardDaySummaryConsulting();
                LoadDashboardDaySummaryTherapy();
            }

            function LoadDashboardDaySummaryConsulting() {
                // alert(1);
                var FromDate = document.getElementById("dtFromDate").value;
                var ToDate = document.getElementById("dtToDate").value;

                var Type = 'Detail';


                var Group = document.getElementById("txtGroupID").value;
                // alert(Group);
                if (Group == '1') {
                    var Location = document.getElementById("cmbLocation").value;
                } else {
                    var Location = document.getElementById("txtLocationCode").value;
                }



                var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate + "&Type=" + Type + "&Location=" + Location;

                // alert(datas);
                $.ajax({
                    url: "Load/LoadDashboardDaySummaryConsulting.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        $('#DivDaySummaryConsulting').html(data);


                    }
                });

            }


            function LoadDashboardDaySummaryTherapy() {
                // alert(1);
                var FromDate = document.getElementById("dtFromDate").value;
                var ToDate = document.getElementById("dtToDate").value;

                var Type = 'Detail';


                var Group = document.getElementById("txtGroupID").value;
                // alert(Group);
                if (Group == '1') {
                    var Location = document.getElementById("cmbLocation").value;
                } else {
                    var Location = document.getElementById("txtLocationCode").value;
                }



                var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate + "&Type=" + Type + "&Location=" + Location;

                // alert(datas);
                $.ajax({
                    url: "Load/LoadDashboardDaySummaryTherapy.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        $('#DivDaySummaryTherapy').html(data);


                    }
                });

            }









            function LoadDatewiseTransaction() {
                // alert(1);
                var FromDate = document.getElementById("dtFromDate").value;
                var ToDate = document.getElementById("dtToDate").value;

                var Type = 'Detail';


                var Group = document.getElementById("txtGroupID").value;
                // alert(Group);
                if (Group == '1') {
                    var Location = document.getElementById("cmbLocation").value;
                } else {
                    var Location = document.getElementById("txtLocationCode").value;
                }



                var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate + "&Type=" + Type + "&Location=" + Location;

                // alert(datas);
                $.ajax({
                    url: "Load/LoadDashboardDatewiseTransations.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        $('#DivDatewiseTransaction').html(data);


                    }
                });

            }

            function LoadBalanceSheet() {
                // alert(1);
                var FromDate = document.getElementById("dtFromDate").value;
                var ToDate = document.getElementById("dtToDate").value;
                var PaymentMode = document.getElementById("cmbPaymentModeStatus").value;
                var SelectedPaymentType = '%';

                var Group = document.getElementById("txtGroupID").value;
                // alert(Group);
                if (Group == '1') {
                    var Location = document.getElementById("cmbLocation").value;
                } else {
                    var Location = document.getElementById("txtLocationCode").value;
                }


                var Type = 'Detail';

                var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate + "&Type=" + Type + "&Location=" + Location +
                    "&PaymentMode=" + PaymentMode + "&SelectedPaymentType=" + SelectedPaymentType;

                // alert(datas);
                $.ajax({
                    url: "Load/LoadDashboardBalanceSheet.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        $('#DivBalanceSheet').html(data);


                    }
                });
                LoadCashBalance()
            }


            function LoadCashBalance() {
                // alert(1);
                var FromDate = document.getElementById("dtFromDate").value;
                var ToDate = document.getElementById("dtToDate").value;
                var PaymentMode = 'Yes';
                var SelectedPaymentType = '12';

                var Group = document.getElementById("txtGroupID").value;
                // alert(Group);
                if (Group == '1') {
                    var Location = document.getElementById("cmbLocation").value;
                } else {
                    var Location = document.getElementById("txtLocationCode").value;
                }


                var Type = 'Detail';

                var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate + "&Type=" + Type + "&Location=" + Location +
                    "&PaymentMode=" + PaymentMode + "&SelectedPaymentType=" + SelectedPaymentType;

                // alert(datas);
                $.ajax({
                    url: "Load/LoadDashboardBalanceSheet.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        $('#DivTotalCashSummary').html(data);


                    }
                });

            }







            function LoadBalanceSheetforPaymentMode(x) {
                // alert(1);
                var FromDate = document.getElementById("dtFromDate").value;
                var ToDate = document.getElementById("dtToDate").value;
                var PaymentMode = document.getElementById("cmbPaymentModeStatus").value;
                var SelectedPaymentType = x;

                var Group = document.getElementById("txtGroupID").value;
                // alert(Group);
                if (Group == '1') {
                    var Location = document.getElementById("cmbLocation").value;
                } else {
                    var Location = document.getElementById("txtLocationCode").value;
                }


                var Type = 'Detail';

                var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate + "&Type=" + Type + "&Location=" + Location +
                    "&PaymentMode=" + PaymentMode + "&SelectedPaymentType=" + SelectedPaymentType;

                // alert(datas);
                $.ajax({
                    url: "Load/LoadDashboardBalanceSheet.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        $('#DivBalanceSheet').html(data);


                    }
                });

            }

            function LoadBillDetails() {
                // alert(1);
                var FromDate = document.getElementById("dtFromDate").value;
                var ToDate = document.getElementById("dtToDate").value;
                var PaymentMode = document.getElementById("cmbPaymentModeStatus").value;
                var SelectedPaymentType = 1;

                var Group = document.getElementById("txtGroupID").value;
                // alert(Group);
                if (Group == '1') {
                    var Location = document.getElementById("cmbLocation").value;
                } else {
                    var Location = document.getElementById("txtLocationCode").value;
                }


                var Type = 'Detail';

                var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate + "&Type=" + Type + "&Location=" + Location +
                    "&PaymentMode=" + PaymentMode + "&SelectedPaymentType=" + SelectedPaymentType;

                $.ajax({
                    url: "Load/LoadDashboardBillDetails.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        $('#DivBillList').html(data);


                    }
                });

            }

            function LoadBillDetailsConsulting() {
                // alert(1);
                var FromDate = document.getElementById("dtFromDate").value;
                var ToDate = document.getElementById("dtToDate").value;
                var PaymentMode = document.getElementById("cmbPaymentModeStatus").value;
                var SelectedPaymentType = 1;

                var Group = document.getElementById("txtGroupID").value;
                // alert(Group);
                if (Group == '1') {
                    var Location = document.getElementById("cmbLocation").value;
                } else {
                    var Location = document.getElementById("txtLocationCode").value;
                }


                var Type = 'Detail';

                var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate + "&Type=" + Type + "&Location=" + Location +
                    "&PaymentMode=" + PaymentMode + "&SelectedPaymentType=" + SelectedPaymentType;

                $.ajax({
                    url: "Load/LoadDashboardBillDetailsConsulting.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        $('#DivBillListConsulting').html(data);


                    }
                });

            }


            function LoadBillDetailsTherapy() {
                // alert(1);
                var FromDate = document.getElementById("dtFromDate").value;
                var ToDate = document.getElementById("dtToDate").value;
                var PaymentMode = document.getElementById("cmbPaymentModeStatus").value;
                var SelectedPaymentType = 1;

                var Group = document.getElementById("txtGroupID").value;
                // alert(Group);
                if (Group == '1') {
                    var Location = document.getElementById("cmbLocation").value;
                } else {
                    var Location = document.getElementById("txtLocationCode").value;
                }


                var Type = 'Detail';

                var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate + "&Type=" + Type + "&Location=" + Location +
                    "&PaymentMode=" + PaymentMode + "&SelectedPaymentType=" + SelectedPaymentType;

                $.ajax({
                    url: "Load/LoadDashboardBillDetailsTherapy.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        $('#DivBillListTherapy').html(data);


                    }
                });

            }




            function LoadCardData() {

                var FromDate = document.getElementById("dtFromDate").value;
                var ToDate = document.getElementById("dtToDate").value;

                var Group = document.getElementById("txtGroupID").value;
                // alert(Group);
                if (Group == '1') {
                    var Location = document.getElementById("cmbLocation").value;
                } else {
                    var Location = document.getElementById("txtLocationCode").value;
                }


                var Type = 'Detail';

                var datas = "&FromDate=" + FromDate + "&ToDate=" + ToDate + "&Type=" + Type + "&Location=" + Location;
                // alert(datas);
                $.ajax({
                    url: "Load/DashboardTotal.php",
                    method: "POST",
                    data: datas,
                    dataType: "json",
                    success: function(data) {
                        // alert(data);
                        document.getElementById("pSales").innerHTML = data[0];
                        document.getElementById("pConsultation").innerHTML = data[1];
                        document.getElementById("pExpenses").innerHTML = data[2];
                        document.getElementById("pOutstanding").innerHTML = data[3];
                        document.getElementById("pTotalIncome").innerHTML = data[4];
                        document.getElementById("pNettAmount").innerHTML = data[6];
                        document.getElementById("pTherapy").innerHTML = data[5];

                    }
                });
                LoadCashCardSTransaction();
                LoadBalanceSheet();
                LoadDashboardDaySummary();
            }
        </script>



        <div id="ModalBillDetails" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Discount Bill Details - Inventory</h4>
                    </div>

                    <div class="modal-body">

                        <div id='DivBillList'></div>


                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <div id="ModalBillDetailsConsulting" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Discount Bill Details - Consulting</h4>
                    </div>

                    <div class="modal-body">

                        <div id='DivBillListConsulting'></div>


                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <div id="ModalBillDetailsTherapy" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Discount Bill Details - Therapy</h4>
                    </div>

                    <div class="modal-body">

                        <div id='DivBillListTherapy'></div>


                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <div id="content" class="content">

            <input type='hidden' id='txtGroupID' name='txtGroupID' value='<?php echo $GroupID; ?>' />
            <input type='hidden' id='txtLocationCode' name='txtLocationCode' value='<?php echo $LocationCode; ?>' />


            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-12">

                    <?php if ($GroupID == '1') {
                        $Visibility1 = 'text';
                        $Visibility2 = '';
                        $Visibility3 = 'button';
                    } else {
                        $Visibility1 = 'hidden';
                        $Visibility2 = 'hidden';
                        $Visibility3 = 'hidden';
                    }
                    ?>

                    <input type="<?php echo $Visibility1; ?>" class="" placeholder="From" id="dtFromDate" style='border-radius: 4px; padding: 5px;' />
                    <span <?php echo $Visibility2; ?>> &nbsp;&nbsp;&nbsp; to &nbsp;&nbsp;&nbsp; </span>
                    <input type="<?php echo $Visibility1; ?>" class="" placeholder="To" id="dtToDate" style='border-radius: 4px; padding: 5px;' />

                    &nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;


                    <select style='border-radius: 4px; padding: 5px;' id='cmbLocation' name='cmbLocation' <?php echo $Visibility2; ?>>
                        <option selected value='-'>All</option>

                        <?php
                        $sqli = "SELECT locationcode, locationname FROM locationmaster where activestatus='Active' ";
                        $result = mysqli_query($connection, $sqli);
                        while ($row = mysqli_fetch_array($result)) {
                            # code...

                            echo ' <option value=' . $row['locationcode'] . '>' . $row['locationname'] . '</option>';
                        }
                        ?>
                    </select>

                    &nbsp;&nbsp;&nbsp;



                    <input type="<?php echo $Visibility3; ?>" class="btn btn-sm btn-info" onclick="LoadCardData();" value='View'>


                    <br>
                    <br>

                    <div class="col-md-2 col-sm-6">
                        <div class="widget widget-stats bg-green">

                            <div class="stats-info">
                                <h4>Inventory Sales</h4>
                                <p id='pSales'>0</p>
                            </div>
                            <div class="stats-link">
                                <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <div class="widget widget-stats bg-blue">
                            <div class="stats-info">
                                <h4>Consulting </h4>
                                <p id='pConsultation'>0</p>
                            </div>
                            <div class="stats-link">
                                <a href="javascript:;">View Detail <i class="fa fa-usersarrow-circle-o-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <div class="widget widget-stats bg-blue">
                            <div class="stats-info">
                                <h4> Therapy</h4>
                                <p id='pTherapy'>0</p>
                            </div>
                            <div class="stats-link">
                                <a href="javascript:;">View Detail <i class="fa fa-usersarrow-circle-o-right"></i></a>
                            </div>
                        </div>
                    </div>








                    <div class="col-md-2 col-sm-6">
                        <div class="widget widget-stats bg-green">
                            <div class="stats-info">
                                <h4><b>Total Income</b></h4>
                                <p id='pTotalIncome'>p</p>
                            </div>
                            <div class="stats-link">
                                <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-2 col-sm-6">
                        <div class="widget widget-stats bg-purple">
                            <div class="stats-info">
                                <h4><b>Total Expense</b></h4>
                                <p id='pExpenses'>-</p>
                            </div>
                            <div class="stats-link">
                                <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                            </div>
                        </div>
                    </div>




                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-2 col-sm-6">
                        <div class="widget widget-stats bg-orange">
                            <div class="stats-info">
                                <h4>Nett Income</h4>
                                <p id='pNettAmount'>0</p>
                            </div>
                            <div class="stats-link">
                                <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-1 col-sm-6" style='display:none'>
                        <div class="widget widget-stats bg-red">
                            <div class="stats-info">
                                <h4>Outstanding</h4>
                                <p id='pOutstanding'>0</p>
                            </div>
                            <div class="stats-link">
                                <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- end col-3 -->
                <!-- begin col-3 -->

                <!-- end col-3 -->
                <!-- begin col-3 -->
                <div class="row">

                    <div class="col-md-3">
                        <div class=" panel panel-inverse">
                            <div class="panel-heading">

                                <h4 class="panel-title">Day Summary - Inventory</h4>
                            </div>
                            <div class="panel-body">

                                <div id='DivDaySummary'></div>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class=" panel panel-inverse">
                            <div class="panel-heading">

                                <h4 class="panel-title">Day Summary - Consulting</h4>
                            </div>
                            <div class="panel-body">

                                <div id='DivDaySummaryConsulting'></div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class=" panel panel-inverse">
                            <div class="panel-heading">

                                <h4 class="panel-title">Day Summary - Therapy</h4>
                            </div>
                            <div class="panel-body">

                                <div id='DivDaySummaryTherapy'></div>

                            </div>
                        </div>
                    </div>





                    <div class="col-md-3">
                        <div class=" panel panel-inverse">
                            <div class="panel-heading">

                                <h4 class="panel-title">Cash Card Summary & Balance Sheet</h4>
                            </div>
                            <div class="panel-body">

                                <div id='DivCashCardTransaction'></div>
                                <hr>

                                <h4 class="panel-title">Balance Sheet </h4>
                                <select id='cmbPaymentModeStatus' name='cmbPaymentModeStatus' style="color:black;" onchange='LoadBalanceSheet()'>
                                    <option value='No'>Without Payment Mode</option>
                                    <option value='Yes'>With Payment Mode</option>
                                </select>

                                <div id='DivBalanceSheet'></div>

                                <hr>
                                <h4 class="panel-title">Total Cash Summary </h4>

                                <div id='DivTotalCashSummary'></div>



                            </div>
                        </div>
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
                <script src="../assets/js/dashboard.min.js"></script>
                <script src="../assets/js/apps.min.js"></script>
                <!-- ================== END PAGE LEVEL JS ================== -->
                <script>
                    $(document).ready(function() {
                        App.init();
                        Inbox.init();
                        FormPlugins.init();
                        FormSliderSwitcher.init();
                        Dashboard.init();
                    });
                </script>
</body>
<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->

</html>