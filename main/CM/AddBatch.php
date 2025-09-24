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
  <body onload="LoadBatchList();">
    <!-- begin #page-loader -->
    
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
  function SaveBatch()
	  { 
	  
		
	   var CourseFee = document.getElementById("txtCourseFeeAmount").value;
	   var BatchName = document.getElementById("txtBatchName").value;
	   var BatchCommences = document.getElementById("txtBatchCommence").value;
	   var BatchFee = document.getElementById("txtBatchFeeAmount").value;
	   var BatchDescription = document.getElementById("txtBatchDescription").value; 
	   var CourseCode = document.getElementById("cmbCourseName").value; 
	
	  if (BatchName=="" || CourseFee =="" || BatchCommences=="" || BatchFee=="" || CourseCode=="" )
	  {
			
	  swal("Alert!", "Kindly provide valid details!", "warning");
		  
	  }
	  else
	  {
var datas = "&CourseFee="+CourseFee+"&CourseCode="+CourseCode+"&BatchName="+BatchName+"&BatchCommences="+BatchCommences+"&BatchFee="+BatchFee+"&BatchDescription="+BatchDescription;	
	  	  
		 $.ajax({
		   url:"Save/SaveBatch.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		   
		 if(data=="New Batch Added Successfuly")
		 {
			  swal("Batch!", data, "success");
			   Reset();
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
		document.getElementById("txtCourseFeeAmount").value="";
	   document.getElementById("txtBatchName").value=""; 
	   document.getElementById("txtBatchCommence").value="";
	    document.getElementById("txtBatchFeeAmount").value="";
	    document.getElementById("txtBatchDescription").value="";
	    document.getElementById("cmbCourseName").value="";
	
	  }
	  function LoadCourseFees()
	  {
		  
		var CourseCode = document.getElementById("cmbCourseName").value;
		var datas = "&CourseCode="+CourseCode;	
	  	  
		 $.ajax({
		   url:"Load/LoadCourseFee.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		   
		  document.getElementById("txtCourseFeeAmount").value=data;
		  document.getElementById("txtBatchFeeAmount").value=data;
		
		   }
		  });
	  }
	  
	  
	   
	   function LoadBatchList()
	  {
		  
		var ID = 1;
		var datas = "&ID="+ID;	
	  	  // alert(datas);
		 $.ajax({
		   url:"Load/LoadBatchList.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		   // alert(data);
		    $( '#DivBatchList' ).html(data);
			 
		
		   }
		  });
	  }
	  
  </script>
	
 <div id="content" class="content">
        <div class="row">
			    <!-- begin col-6 -->
			   <div class="col-md-8">
			        <!-- begin panel -->
                   <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                           
                            <h4 class="panel-title">Batch Details</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
							<div class="form-group">
                                    <label class="col-md-3 control-label">Course </label>
                                     
									<div class="col-md-5">
							<select class="form-control" id='cmbCourseName' name='cmbCourseName' onchange="LoadCourseFees();">
							  <option></option> 
							 <?php  
                            $sqli = "  SELECT coursecode, coursename FROM coursemaster WHERE activestatus='Active'";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value='.$row['coursecode'].'>'.$row['coursename'].'</option>';
                              }	
                            ?>
                                            
                                        </select>
										
                                    </div>  
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" placeholder="Course Fees" id='txtCourseFeeAmount' name ='txtCourseFeeAmount' disabled />
                                    </div>
                                
                                </div>
								 
                                <div class="form-group">
                                    <label class="col-md-3 control-label">	Batch Name</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" placeholder="Batch Name" id='txtBatchName' name='txtBatchName' />
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="col-md-3 control-label">Batch Commences on</label>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control" placeholder="Duration" id='txtBatchCommence' name='txtBatchCommence'/>
                                    </div> 
									  <label class="col-md-2 control-label">Revised Fee</label>
									 <div class="col-md-3">
                                        <input type="number" class="form-control" placeholder="Fees amount" id='txtBatchFeeAmount' name ='txtBatchFeeAmount' />
                                    </div>
                                </div>
								 	
								<div class="form-group">
                                    <label class="col-md-3 control-label">Batch Description</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" placeholder="Batch Description" 
										rows="2" id='txtBatchDescription' name ='txtBatchDescription'></textarea>
                                    </div>
                                </div>
                                 
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> </label>
                                    <div class="col-md-9">
                                        <input type="button"  class="btn btn-sm btn-success" onclick= "SaveBatch();" value='Save'> 	
                                         <input type="button"  class="btn btn-sm btn-warning" onclick= "Reset();" value='Cancel'> 	
                                    </div>
                                </div>
                            </form>
						</div>
                    </div>
                    <!-- end panel -->
                </div>
                    <!-- end panel -->
					
					
				<div class="col-md-12">
			        <!-- begin panel -->
                   <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                         
                        <div class="panel-body">
                             <div data-scrollbar="true" data-height="210px">
                        <ul class="chats">
						 
						 
                          <div id="DivBatchList" class="email-content"  ></div>
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