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
    $position=$_SESSION["SESS_LAST_NAME"]; 
	 session_cache_limiter(FALSE);
    session_start();
  
    ?>
  <head>
    <meta charset="utf-8" />
    <title>Valviyal Academy</title>
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
    <link href="../assets/Custom/sweetalert.css" rel="stylesheet"/>
    <script src="../assets/Custom/sweetalert2.min.js"></script>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
    <style>
      body {
      background: #f5f5f5 url('../assets/img/bg.png') left top repeat;
      }
      #f1_upload_process{
      z-index:100;
      visibility:hidden;
      position:absolute;
      text-align:center;
      width:400px;
      }
      .msg {
      text-align:left;
      color:#666;
      background-repeat: no-repeat;
      margin-left:30px;
      margin-right:30px;
      padding:5px;
      padding-left:30px;
      }
      .emsg {
      text-align:left;
      margin-left:30px;
      margin-right:30px;
      color:#666;
      background-repeat: no-repeat;
      padding:5px;
      padding-left:30px;
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
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
      <!-- begin #header -->
      <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <!-- begin container-fluid -->
        <div class="container-fluid">
          <!-- begin mobile sidebar expand / collapse button -->
          <div class="navbar-header">
            <a href="HomeAG.php" class="navbar-brand">
            <img src="../assets/img/logo.png" class="media-object"   width="150" alt="" />
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
							
							<i class="fa fa-bell-o"></i><span class="label">5</span>
						</a>
            </li>
            
            <li class="dropdown navbar-user">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../assets/img/user-13.jpg" alt="" />
              <span class="hidden-xs">
               <?php echo $_SESSION['SESS_FIRST_NAME']; ?>
              </span>
              <b class="caret"></b>
              </a>
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
          <ul class="nav">
            <li class="has-sub">
              <a href="javascript:;">
              <i class="fa fa-users"></i>
              <span>Student Management</span>
              </a>
			  <ul class="sub-menu">
							<li><a href="page_blank.html">Add Student</a></li>
							<li><a href="page_with_footer.html">Student List</a></li>
							<li><a href="page_with_footer.html">Student Batch Mapping</a></li>
						
						</ul>
            </li>
			  <li class="has-sub active">
              <a href="javascript:;">
              <i class="fa fa-sitemap"></i>
              <span>Course Management</span>
              </a>
			  <ul class="sub-menu">
							<li  class="active"><a href="AddCourse.php">Add New Course</a></li>
							<li><a href="page_with_footer.html">Add Batch</a></li>
							<li><a href="page_with_footer.html">Course List</a></li>
							<li><a href="page_with_footer.html">Batch List</a></li>
						
						</ul>
            </li>
			
			<li class="has-sub">
              <a href="javascript:;">
              <i class="fa fa-inr"></i>
              <span>Fees Management</span>
              </a>
			  <ul class="sub-menu">
							<li><a href="page_blank.html">Fees Collection</a></li>
							<li><a href="page_with_footer.html">Fees Type</a></li>
							<li><a href="page_with_footer.html">Payment Mode</a></li>
							<li><a href="page_with_footer.html">Payment Register List</a></li>
						
						</ul>
            </li>
			
			<li class="has-sub">
              <a href="javascript:;">
              <i class="fa fa-inbox"></i>
              <span>Tutor Management</span>
              </a>
			  <ul class="sub-menu">
							<li><a href="page_blank.html">Add Tutor</a></li>
							<li><a href="page_with_footer.html">Tutor Payment</a></li>
							
						</ul>
            </li>
			
			<li class="has-sub">
              <a href="javascript:;">
              <i class="fa fa-inbox"></i>
              <span>Class Management</span>
              </a>
			  <ul class="sub-menu">
							<li><a href="page_blank.html">Active Classes</a></li>
							<li><a href="page_with_footer.html">Student Attendance</a></li>
							
						</ul>
            </li>
			
            
            <li>
              <a onclick="go_full_screen()">
              <i class="fa fa-2x fa-arrows-alt"></i>
              <span>Full screen</span>
              </a>
            </li>
            <!-- begin sidebar minify button -->
            <li>
              <a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify">
              <i class="fa fa-angle-double-left"></i>
              </a>
            </li>
            <!-- end sidebar minify button -->
          </ul>
          <!-- end sidebar nav -->
       
        <!-- end sidebar scrollbar -->
      </div> 
      <!-- end #sidebar -->
      <!-- begin #content -->
 <div id="content" class="content">
        <div class="row">
			    <!-- begin col-6 -->
			   <div class="col-md-12">
			        <!-- begin panel -->
                   <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                           
                            <h4 class="panel-title">Course Details</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Course Name</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Default input" />
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="col-md-3 control-label">Course Duration</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Default input" />
                                    </div>
									<div class="col-md-2">
                                        <select class="form-control">
                                            <option>Day</option>
                                            <option>Week</option>
                                            <option>Month</option>
                                            <option>Year</option>
                                            
                                        </select>
                                    </div>
                                </div>
								 <div class="form-group">
                                    <label class="col-md-3 control-label">Course Fee</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Default input" />
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="col-md-3 control-label">Course Description</label>
                                    <div class="col-md-4">
                                        <textarea class="form-control" placeholder="Textarea" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Disabled Input</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Disabled input" disabled />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Select</label>
                                    <div class="col-md-9">
                                        <select class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Select (multiple)</label>
                                    <div class="col-md-9">
                                        <select multiple class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Checkbox</label>
                                    <div class="col-md-9">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="" />
                                                Checkbox Label 1
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="" />
                                                Checkbox Label 2
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Inline Checkbox</label>
                                    <div class="col-md-9">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="" />
                                            Checkbox Label 1
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="" />
                                            Checkbox Label 2
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Radio Button</label>
                                    <div class="col-md-9">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" value="option1" checked />
                                                Radio option 1
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" value="option2" />
                                                Radio option 2
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Inline Radio Button</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" value="option1" checked />
                                            Radio option 1
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" value="option2" />
                                            Radio option 2
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group has-success has-feedback">
                                    <label class="col-md-3 control-label">Input with Success</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" />
                                        <span class="fa fa-check form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group has-warning has-feedback">
                                    <label class="col-md-3 control-label">Input with Warning</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" />
                                        <span class="fa fa-warning form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group has-error has-feedback">
                                    <label class="col-md-3 control-label">Input with Error</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" />
                                        <span class="fa fa-times form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Submit</label>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-sm btn-success">Submit Button</button>
                                    </div>
                                </div>
                            </form>
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
    	Inbox.init();
    	FormPlugins.init(); 
    FormSliderSwitcher.init();
	FormWizard.init();
    });
  </script>
  </body>
  <!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->
</html>