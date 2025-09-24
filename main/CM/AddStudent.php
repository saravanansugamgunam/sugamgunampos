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
  <body onload="Reset();">
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
            <a href="../index.php" class="navbar-brand">
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
                  <a href="../../index.php">Log Out</a>
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
     <?php include("CMSidePanel.php") ?>
      </div>
      <!-- end #sidebar -->
      <!-- begin #content -->
	  
	  <script>
  function SaveStudent()
	  { 
	 
	   var Name = document.getElementById("txtName").value;
	   var Gender = document.getElementById("cmbGender").value;
	   var DOB = document.getElementById("dtDOB").value;
	   var MaritalStatus = document.getElementById("cmbMaritalStatus").value;
	   var Occupation = document.getElementById("txtOccupation").value;
	   var GaurdianName = document.getElementById("txtGaurdianName").value;
	   var MobileNo = document.getElementById("txtMobileNo").value;
	   var AlternateMobileNo = document.getElementById("txtAlternateNo").value;
	   var EmailID = document.getElementById("txtEmail").value;
	   var TempAddress = document.getElementById("txtTempAddress").value;
	   var Address = document.getElementById("txtAddress").value;
	   var Referedby = document.getElementById("txtReferedby").value;
	   var Qualification = document.getElementById("txtQualification").value;
	
	  if (Name=="" || MobileNo =="")
	  {
			
	  swal("Alert!", "Kindly provide valid details!", "warning");
		  
	  }
	  else
	  {
var datas = "&Name="+Name+"&Gender="+Gender+"&DOB="+DOB+"&MaritalStatus="+MaritalStatus+"&Occupation="+Occupation
			+"&GaurdianName="+GaurdianName+"&MobileNo="+MobileNo+"&AlternateMobileNo="+AlternateMobileNo+"&EmailID="+EmailID
			+"&TempAddress="+TempAddress+"&Address="+Address+"&Referedby="+Referedby+"&Qualification="+Qualification;	
	  	  
		 $.ajax({
		   url:"Save/SaveStudent.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		   
		 if(data=="New Student Added Successfuly")
		 {
			  swal("Student!", data, "success");
			   window.location.reload();
		 }
		 else
		 {
			   swal("Alert!", data, "warning");
			   Reset();
		 }
		 
		
		   }
		  });
	  }
		  
	  }
	  function Reset()
	  {
		 document.getElementById("txtName").value="";
	    document.getElementById("cmbGender").value="";
	   document.getElementById("dtDOB").value="";
	    document.getElementById("cmbMaritalStatus").value="";
	    document.getElementById("txtOccupation").value="";
	    document.getElementById("txtGaurdianName").value="";
	   document.getElementById("txtMobileNo").value="";
	    document.getElementById("txtAlternateNo").value="";
	    document.getElementById("txtEmail").value="";
	   document.getElementById("txtTempAddress").value="";
	   document.getElementById("txtAddress").value="";
	    document.getElementById("txtReferedby").value="";
	   document.getElementById("txtQualification").value="";
	
	  }
	  
  </script>
  
 <div id="content" class="content">
        <div class="row">
			    <!-- begin col-6 -->
			   <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                           
                            <h4 class="panel-title">Student Details</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST">
								<div id="wizard">
									<ol>
										<li>
										    Identification 
										     
										</li>
										<li>
										    Contact Information
												
										</li>
										 
									</ol>
									<!-- begin wizard step-1 -->
									<div>
                                        <fieldset>
                                            <legend class="pull-left width-full">Identification</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
													<div class="form-group">
														<label>Name</label>
														<input type="text" name="txtName" id="txtName" placeholder="Name" class="form-control" />
													</div>
                                                </div>
												
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
													<div class="form-group">
														<label>Gender</label>
														<Select name="cmbGender"  id="cmbGender" class="form-control" />
														<option>Male</option>
														<option>Female</option>
														<option>Others</option>
														</select>
													</div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
													<div class="form-group">
														<label>Date of Birth</label>
														<input type="date" name="dtDOB" id="dtDOB" placeholder="Smith" class="form-control" />
													</div>
                                                </div>
                                                <!-- end col-4 -->
                                            </div>
											
											<div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
													<div class="form-group">
														<label>Marital Status</label>
														<Select name="cmbMaritalStatus" id="cmbMaritalStatus"  class="form-control" />
														<option>Un Married</option>
														<option>Married</option>
														<option>Widow</option>
														</select>
													</div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
													<div class="form-group">
														<label>Occupation</label>
														<input type="text" name="txtOccupation" id="txtOccupation" placeholder="Occupation" class="form-control" />
													</div>
                                                </div>
												 <div class="col-md-4">
													<div class="form-group">
														<label>Father / Husband / Gaurdian Name</label>
														<input type="text" name="txtGaurdianName"  id="txtGaurdianName" placeholder="Gaurdian" class="form-control" />
													</div>
                                                </div>
												
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                               
                                                <!-- end col-4 -->
                                            </div>
											
                                            <!-- end row -->
										</fieldset>
									</div>
									<!-- end wizard step-1 -->
									<!-- begin wizard step-2 -->
									<div>
										<fieldset>
											<legend class="pull-left width-full">Contact Information</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
													<div class="form-group">
														<label>Mobile Number</label>
														<input type="number" id="txtMobileNo" name="txtMobileNo"  placeholder="" class="form-control" />
													</div>
                                                </div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Alternate Number</label>
														<input type="text" name="txtAlternateNo"  id="txtAlternateNo" placeholder="" class="form-control" />
													</div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
													<div class="form-group">
														<label>Email Address</label>
														<input type="text" name="txtEmail"  id="txtEmail" placeholder="someone@example.com" class="form-control" />
													</div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>
											 <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
													<div class="form-group">
														<label>Temporary Address</label>
														<textarea class="form-control" placeholder="Temporary Address" rows="3" id='txtTempAddress' name ='txtTempAddress'></textarea>
													</div>
                                                </div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Permenant Address</label>
														<textarea class="form-control" placeholder="Permenant Address" rows="3" id='txtAddress' name ='txtAddress'></textarea>
													</div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-2">
													<div class="form-group">
														<label>Refered By</label>
														<input type="text" name="txtReferedby" id="txtReferedby"  placeholder="Refered By" class="form-control" />
													</div>
                                                </div>
												 <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Qualification</label>
                                                        <div class="controls">
                                                            <input type="text" name="txtQualification"   id="txtQualification" placeholder="Qualifiation" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>
											<div class="row">
                                                <!-- begin col-4 -->
                                                 
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                 
												 <div class="col-md-2">
                                                    <div class="form-group">
                                                        <br>
                                                        <div class="controls">
                                                         <input type="button"  class="btn btn-sm btn-success" onclick= "SaveStudent();" value='Save'>
														  <input type="button"  class="btn btn-sm btn-warning" onclick= "Reset();" value='Cancel'> 	
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                 
                                                <!-- end col-6 -->
                                            </div>
											 
                                            <!-- end row -->
										</fieldset>
									</div>
									
									<!-- end wizard step-2 -->
									<!-- begin wizard step-3 -->
									 
									<!-- end wizard step-4 -->
								</div>
							</form>
                        </div>
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