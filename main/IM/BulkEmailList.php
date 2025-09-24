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

    <link href="../assets/plugins/summernote/summernote.css" rel="stylesheet" />


    <link href="../assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
    <link href="../assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <link href="../assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <script src="../assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../assets/Custom/NiceEditor.js" type="text/javascript"></script>


    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <!-- Core build with no theme, formatting, non-essential modules -->
    <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
    <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>


    <link href="../assets/Custom/sweetalert.css" rel="stylesheet" />
    <script src="../assets/Custom/sweetalert2.min.js"></script>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../assets/Custom/masking-input.css" />

    <style>
    ;

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


    <script type="text/javascript">
    bkLib.onDomLoaded(function() {

            new nicEditor({
                buttonList: ['bold', 'italic', 'underline', 'left', 'center', 'right', 'justify', 'ol',
                    'ul', 'forecolor', 'bgcolor', 'fontSize', 'fontFamily'
                ]
            }).panelInstance('txtMessage');
            $('.nicEdit-panelContain').parent().width('100%');
            $('.nicEdit-panelContain').parent().next().width('98%');
            $('.nicEdit-main').width('98%');
            $('.nicEdit-main').height('140px');
        }

    );


    bkLib.onDomLoaded(function() {

            new nicEditor({
                buttonList: ['bold', 'italic', 'underline', 'left', 'center', 'right', 'justify', 'ol',
                    'ul', 'forecolor', 'bgcolor', 'fontSize', 'fontFamily'
                ]
            }).panelInstance('txtObservation');
        }

    );
    </script>

</head>

<body onload="LoadInvoiceNo()();">
    <!-- begin #page-loader -->

    <!-- end #page-loader -->
    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar page-header-fixed">
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
        function LoadDocumentList() {
            var Dumy = 0;
            var PaitentID = document.getElementById("UniqueID").value;

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

        function Reset() {
            LoadDocumentList();
        }

        function LoadInvoiceNo() {

            var InvoiceNo = new Date().getTime();
            document.getElementById("txtUniqueID").value = InvoiceNo;


        }


        function SendMessage() {
          
            var MessageID =  document.getElementById("txtUniqueMessageID").value; 
            var UniqueID = document.getElementById("txtUniqueID").value;
            var MailTo = document.getElementById("cmbMailTo").value;
 
            if (MessageID == '' || UniqueID=='') {
                swal("Alert!", "Unable to Send Email", "warning");

            } else {


                var datas = "&MessageID=" + MessageID + "&MailTo=" + MailTo + "&UniqueID=" + UniqueID;
 
                $.ajax({
                    url: "Save/SaveBulkEmailSend.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {

                        swal("Success!", "Message Sent to Users", "success");

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                });

            }
        }
        </script>


        <style>
        .modal-window {
            position: fixed;
            background-color: rgba(200, 200, 200, 0.75);
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 999;
            opacity: 0;
            pointer-events: none;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;
        }

        .modal-window:target {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-window>div {
            width: 900px;
            position: relative;
            margin: 5% auto;
            padding: 1rem;
            background: #fff;
            color: #444;
        }

        .modal-window header {
            font-weight: bold;
        }

        .modal-close {
            color: black;
            line-height: 50px;
            font-size: large;
            position: absolute;
            right: 0;
            text-align: center;
            top: 0;
            width: 70px;
            text-decoration: none;
        }

        .modal-closebutton {
            color: #aaa;
            line-height: 50px;
            font-size: 80%;
            position: absolute;
            right: 0;
            text-align: center;
            top: 50;
            width: 70px;
            text-decoration: none;
        }

        .modal-close:hover {
            color: #000;
        }

        .modal-window h1 {
            font-size: 150%;
            margin: 0 0 15px;
        }

        .swal-button {
            padding: 7px 19px;
            border-radius: 2px;
            background-color: #4962B3;
            font-size: 12px;
            border: 1px solid #3e549a;
            text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
        }

        .vl {
            border-left: 1px solid #ccd0d4;
            height: 180px;
            position: absolute;
            left: 75%;
            margin-left: -15px;
            top: 20;
        }
        </style>

<script>
     function LoadEmailDetails(x) {
        
            var UniqueID = x; 

            var datas = "&UniqueID=" + UniqueID;
            document.getElementById("txtUniqueMessageID").value=UniqueID;
            $.ajax({
                url: "Load/LoadEmailDetails.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#txtSubject").html(data[0]);
                    $("#txtEmail").html(data[1]);
                    $("#txtAttachment").html(data[2]);  
                }
            });
        }
</script>

        <div id='ModalProject' class='modal-window'>
            <div class="row">

                <a href='#modal-close' title='Close' class='modal-close'>&times;</a>
                <input type='hidden' id='txtUniqueMessageID' name='txtUniqueMessageID' />
                <input type='hidden' id='txtUniqueID' name='txtUniqueID' />
                <h1>Mail
                </h1>



                <hr>

                <table>
                    <tr>
                        <td>Mail To</td>
                    </tr>
                    <tr>
                        <td> <select class="form-control" id='cmbMailTo' name='cmbMailTo' onchange='focusamount();'>
                                <option value=0>All</option>
                                <option value=1>Paitents</option>
                                <option value=2>Students</option>
                            </select> </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td>  <button class='btn btn-success' onclick='SendMessage()'> Send</button> </td>

                </table>


                <hr>
                <div class="col-md-12">
                    <div data-scrollbar="true" data-height="300px">

                        <ul class="chats">

                            <label> <u>Mail Details</u> </label>
 <br>
                           <b>Subject:</b><p id='txtSubject'></p>
                           <b>Message:</b><p id='txtEmail'></p>
                           <b>Attachment:</b><p id='txtAttachment'></p> 
 


                        </ul>
                    </div>
                    <br>
 

                </div>
                <br>
                <br>

                <br>


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


                            </h4>
                        </div>


                        <div class="panel-body">

                            <div class="col-md-12">
                                <br>

                                <?php        
$result = mysqli_query($connection, "
SELECT a.id,subject,LEFT(message,5),concat('../../',IFNULL(path,'-')),status FROM bulkemail  AS a 
LEFT JOIN bulkemailattachment AS b ON a.uniqueid=b.uniqueid");
 //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table class='table table-fixed table-striped' id='indextable' name='tblDoctorMaster'   >";
echo " <thead><tr>  
		<th>S. No</th>  
		<th hidden>Code</th>    
		<th width='%'>Subject</a></th>     
		<th width='%'>Message</a></th>     
		<th width='%'>Attachment</a></th>     
		<th width='%'>Status</a></th>   
		<th width='%'>Send</a></th>   
		</tr> </thead> <tbody id='ProjectTable'>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='10%'>$SerialNo</td>
  <td hidden id='DoctorID'>$data[0]</td>
  <td id='Doctor' width='%'>$data[1]</td>  
  <td id='Doctor' width='%'>$data[2]...</td> 
  <td id='mobileno' width='%'><a href='$data[3]' target='_blank'>Open</a></td>   
 
  <td id='Doctor' width='%'>$data[4]</td> 
  <td width='%' onclick='LoadEmailDetails($data[0])'> <a href='#ModalProject' class='btn btn-sm btn-danger btn-xs' >View</a></td>  
  
  
  </tr>";
   
  
  //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
  //echo "<br>";
 $SerialNo=$SerialNo+1; 
}
echo "</tbody></table>";
?>


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