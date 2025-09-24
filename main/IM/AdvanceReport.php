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
   $LocationName = $_SESSION['SESS_LOCATIONNAME'];
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

    ?>

<head>
    <meta charset="utf-8" />
    <title>SugamGunam</title>
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
    <script src="../assets/plugins/pace/pace.min.js"></script>

    <script
        src="https://webdamn.com/demo/export-html-table-data-excel-csv-jquery-php-mysql-demo/tableExport/tableExport.js">
    </script>
    <script
        src="https://webdamn.com/demo/export-html-table-data-excel-csv-jquery-php-mysql-demo/tableExport/jquery.base64.js">
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

    html,
    body {
        padding: 0 !important;
    }

    .modal {
        overflow-y: auto;
    }

    .modal-open {
        overflow: auto;
    }

    .modal-open[style] {
        padding-right: 0px !important;
    }
    </style>

</head>

<body>
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
            <?php include("IMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->
        <div id="content" class="content">
            <div class="row">
                <!-- begin col-6 -->
                <script>
                function printDiv() {
                    var divToPrint = document.getElementById('DivAdvanceRegister');
                    newWin = window.open("");
                    newWin.document.write(divToPrint.outerHTML);
                    newWin.print();
                    newWin.close();
                }
 


                function exportF(elem) {
                    var table = document.getElementById("data-table");
                    var html = table.outerHTML;
                    var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
                    elem.setAttribute("href", url);
                    elem.setAttribute("download", "export.xls"); // Choose the file name
                    return false;
                }


                function LoadAdvanceRegister() {
                    

                    var ToDate = document.getElementById("dtToDateReprt").value;
                    var FromDate = document.getElementById("dtFromDateReport").value;
                   
                    var datas = "&ToDate=" + ToDate + "&FromDate=" + FromDate;
                    // alert(datas);
                    $.ajax({
                        url: "Load/LoadAdvanceRegister.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {

                            $('#DivAdvanceRegister').html(data);

                        }
                    });
                }

                 
                </script>


                <div class="col-md-12">
                    <input type="hidden" name="txtType" id="txtType" />
                    <input type="hidden" name="txtQuantityFilter" id="txtQuantityFilter" />
                    <input type="hidden" name="txtExcludeStock" id="txtExcludeStock" />


                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">

                            <h4 class="panel-title">Advance Report
                            </h4>

                        </div>

                        <div class="panel-body" style="width: 100%€;  ">

                            <div class="form-group">

                                <label class="radio-inline">
                                    From
                                    <input type="date" class='form-control' name="dtFromDateReport"
                                        id='dtFromDateReport' value='<?php echo date('Y-m-d'); ?>'  />

                                </label>
                                <label class="radio-inline">
                                    To
                                    <input type="date" class='form-control' name="dtToDateReprt" id='dtToDateReprt' 
                                    value='<?php echo date('Y-m-d'); ?>' />

                                </label>
                                
                                <label class="radio-inline">
                                    &nbsp;
                                <input type="button" class='form-control btn-success   ' name="dtToDateReprt" id='dtToDateReprt' 
                                    value='View' onclick='LoadAdvanceRegister();' /> 
                                </label>

                                <label class="radio-inline">
                                    &nbsp; 

                                    <input type="hidden" class='fa  fa-print form-control btn-primary  ' name="dtToDateReprt" id='dtToDateReprt' 
                                    value='Print' onclick='printDiv();' /> 
                                </label>

 
                            </div>

                            <div id="DivAdvanceRegister" class="email-content"></div>

                        </div>


                    </div>
                </div>
            </div>
            <!-- end panel -->

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
    <script src="../assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
    <script src="../assets/js/form-wizards.demo.min.js"></script>

    <script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
    <script src="../assets/js/table-manage-default.demo.min.js"></script>

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