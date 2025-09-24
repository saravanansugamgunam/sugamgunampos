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

    <style>;
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

 
function SaveMessage() {
            var nicE = new nicEditors.findEditor('txtMessage');
            Message = nicE.getContent();
            document.getElementById("txtConvertedMessage").value = Message;
            var Subject = document.getElementById("txtSubject").value;

            var UniqueID = document.getElementById("txtUniqueID").value;
            var Attachment = '-';
            var len = Message.length;
    
            if(len==1 || Subject == '' )
            {
              swal("Alert!", "Kindly Fill the dtails", "warning"); 
            }
            else
            {
 
            var datas = "&Message=" + Message + "&Attachment=" + Attachment + "&UniqueID=" + UniqueID + "&Subject=" + Subject ;
            
            $.ajax({
                url: "Save/SaveBulkEmail.php",
                method: "POST",
                data: datas,
                success: function(data) {
                
                  swal("Success!", "Message Saved", "success");

                  setTimeout(function() {
    location.reload();
}, 2000);
                }
            });

        }}
 
        </script>

         

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

                                
                                    <label class="col-md-1 control-label">Message</label>
 
                                    <input type='text' class="form-control" name="txtSubject" id="txtSubject" placeholder='Subject' />
                                    <br>
                                        <textarea class="form-control" name="txtMessage" id="txtMessage" rows="5"> </textarea>

                                        <textarea style='display:none' class="form-controlr" name="txtConvertedMessage"
                                            id="txtConvertedMessage" > </textarea>

 
                                            <form id="uploadForm" enctype="multipart/form-data" method="post"> 
  
                                                <div class="col-md-6" style='  margin-left: -20px;'>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>Attachment </label>
                                                            <input type="file" class="form-control" name="file"
                                                                id="fileupload">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-4">
                                                            <label>&nbsp;</label>
                                                            <input type="submit" name="submit" value="Upload"
                                                                class="btn btn-primary form-control m-r-5" />
                                                        </div>
                                                    </div>
                                                </div>
   <br>   <br>   <br>
                                                <input type='hidden' id='txtUniqueID' name='txtUniqueID'  />

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
                                                   var UniqueidRecreate = document.getElementById("txtUniqueID").value;

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

                                                            document.getElementById("txtUniqueID").value=UniqueidRecreate;
                                                            //alert(resp);
                                                            document.getElementById(
                                                                "txtQuery").value = resp;

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


                                        
<div class="form-group">
    <label class="col-md-3 control-label"> </label>
    <div class="col-md-9">
        <input type="button" class="btn btn-sm btn-success" onClick="SaveMessage();" value='Save Message'>
        <input type="button" class="btn btn-sm btn-warning" onClick="Reset();" value='Clear'>
    </div>
</div>  
                                    </div>
                                    

                                    </div>
                                    <div class="tab-pane fade" id="default-tab-6">

                                        <div class="row">
                                            <input type='hidden' id='txtTherapyID' name='txtTherapyID' />
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label> Date</label><br>
                                                    <input type="date" class="form-control" placeholder=""
                                                        id='dtTherapyDate' name='dtTherapyDate' />

                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label> Assign to Doctor</label><br>
                                                    <select class="form-control" id='cmbTherapyDoctor'
                                                        name='cmbTherapyDoctor' data-style="btn-white">
                                                        <option selected></option>

                                                        <?php  
                            $sqli = "SELECT userid,username FROM usermaster";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value='.$row['userid'].'>'.$row['username'].'</option>';
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
                                                        name='cmbTherapyName' data-style="btn-white">
                                                        <option selected></option>

                                                        <?php  
                            $sqli = " SELECT consultationid,consultationname FROM  consultationmaster WHERE activestatus ='Active' and consultingtype='Therapy'";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value='.$row['consultationid'].'>'.$row['consultationname'].'</option>';
                              }	
                            ?>
                                                    </select>

                                                </div>
                                            </div>


                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Sitting</label><br>
                                                    <input type="number" class="form-control" id='txtSittings' name='txtSittings'
                                                    value=1   />
                                                </div>
                                            </div>


                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <br>
                                                    <div class="controls">
                                                        <input type="button" class="btn btn-sm btn-success"
                                                            onclick="AddRecomendedTherapy();" value='Add' />
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