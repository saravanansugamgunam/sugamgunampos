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

    $Invoice=$_GET['invoice'];
 
	  $res = $connection->query("  SELECT DATE_FORMAT(a.addedon,'%d-%m-%Y'),a.NAME,a.mobileno,
 
      DATE_FORMAT(a.appointmentdate,'%d-%m-%Y'),
      IF(appointmenttime*1>900,'Morning Session','Evening Session') AS AppointmeSession,
       c.username,
      
      IF(b.paymentamount=500,'NEW REGISTRATION + CONSULTING', 'FOLLOW UP CONSULTING') AS Consultation,
      b.paymentamount,
      e.tokennumber,d.consultationuniquebill,e.onlinetokenflag
       FROM  onlinetransactionmapping AS a 
      LEFT JOIN onlinetransaction AS b ON a.orderid=b.orderid
      JOIN usermaster AS c ON a.doctorcode=c.userid
      JOIN consultingbillmaster AS d ON a.orderid=d.onlineorder
      JOIN tokenmaster AS e ON d.consultationuniquebill=e.invoicenumber WHERE 
      a.orderid='$Invoice';"); 
             
      while($data = mysqli_fetch_row($res))
      { 
      $BookintDate=$data[0];
      $Name=ucwords(strtolower($data[1]));
      $Mobileno=$data[2]; 
      $AppointmentDate=$data[3];  
      $Session=$data[4]; 
      $Doctor=$data[5]; 
      $Consultation =$data[6]; 
      $Payment =$data[7]; 
      $TokenNo=$data[8];
      $ConsultintUniqueNo=$data[9];
      $TokenReceiptStatus=$data[10];
       
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

<body onload="Reset();">
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
            <?php include("CLMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->

        <script>
       
   

        function ConfirmOnlineToken() {
            var Invoice = document.getElementById("txtUniqueNo").value;
             
                    var datas = "&Invoice=" + Invoice ;

                    $.ajax({
                        url: "Save/ConfirmOnlineToken.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {
                           
                            if(data==1)
                            {
                                swal("Success!", "Token Confirmed", "success");
                            setTimeout(function() {
                                redirect();
                            }, 1000);
                            }
                            else
                            {
                                swal("Warning!", "Unable to Confirm Token", "warning");
                            
                            }
                        
                        }
                    });
                 
            } 

            function redirect() {
            var Invoice = document.getElementById("txtUniqueNo").value;
            var str1 = "SaleBillView.php?invoice=";
            var str2 = Invoice;
            var str3 = "";
            var BillPrintURL = str1.concat(str2, str3);
            // alert(BillPrintURL);
            // window.location.href = BillPrintURL;
            window.open(BillPrintURL);
        }

  
        </script>




        <style>
        .bootstrap-select:not([class*="span"]):not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 320px;
        }
        </style>



        <div class="modal fade" id="ModalModifyProduct" name="ModalModifyProduct">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Modify Product </h4>
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->

                            <div class="panel-body">
                                <form class="form-horizontal">

                                    <div class="form-group">
                                        <label class="col-md-3 control-label"><b><span
                                                    id='spnProductName'></span></b></label>
                                        <div class="col-md-3">
                                            <input type="hidden" class="form-control" placeholder=""
                                                id='txtModifyProductCode' name='txtModifyProductCode' />

                                            <input type="text" class="form-control" placeholder="" id='txtModifiedQty'
                                                name='txtModifiedQty' />


                                            <input type="hidden" class="form-control" placeholder="" id='txtActualQty'
                                                name='txtActualQty' />

                                        </div>
                                        <div class="col-md-3">
                                            <i style="color:red" class='fa fa-2x fa-trash' title='View'
                                                onclick='ClearQty()'></i>

                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-5">
                            <input type="button" id='btnSave' class="btn btn-sm btn-success" onClick="UpdateItemQty();"
                                value='Update'>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="content" class="content">
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-5">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">

                            <h4 class="panel-title">Online Booking Details</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
                            
                                    <input type='hidden' id='txtUniqueNo' name='txtUniqueNo'
                                    value='<?php echo $ConsultintUniqueNo; ?>' />

                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Order ID</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtInvoiceNo'
                                            name='txtInvoiceNo' disabled value='<?php echo $Invoice;?>' />

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Booking Date</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='dtBookingDate'
                                            name='dtBookingDate' value='<?php echo $BookintDate; ?>' disabled />
                                    </div>

                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Name</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtPaitentName'
                                            name='txtPaitentName' disabled value='<?php echo $Name;?>' />

                                    </div>

                                </div>

                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Mobile No</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtMobileNo'
                                            name='txtMobileNo' disabled value='<?php echo $Mobileno;?>' />

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Appointment Date</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='dtAppointmentDate'
                                            name='dtAppointmentDate' value='<?php echo $AppointmentDate; ?>' disabled />
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Session</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtSession'
                                            name='txtSession' value='<?php echo $Session; ?>' disabled />
                                    </div>

                                </div>




                                <div class="form-group">
                                    <label class="col-md-3 control-label">Doctor</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtDoctor'
                                            name='txtDoctor' value='<?php echo $Doctor;?>' disabled />
 
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Consultation Type</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtConsultationType'
                                            name='txtConsultationType' value='<?php echo $Consultation;?>' disabled />
 
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Paid Amount</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtPaidAmount'
                                            name='txtPaidAmount' disabled value='<?php echo $Payment;?>' />

                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Token Number</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtTokenNo'
                                            name='txtTokenNo' disabled value='<?php echo $TokenNo;?>' />

                                    </div>

                                </div>
 
<center>
<label class="radio-inline">

<a class="btn btn-success  btn-sm" onclick='ConfirmOnlineToken();'>Confirm</a>
 
     

</label>
</center>
                                



                                <div class="form-group">
                                    <label class="col-md-3 control-label"> </label>
                                    <div class="col-md-9">


                                    </div>
                                </div>
                            </form>
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