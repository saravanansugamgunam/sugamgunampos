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
    $position=$_SESSION["SESS_LAST_NAME"]; 
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
	<link href="../assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
    <link href="../assets/css/theme/default.css" rel="stylesheet" id="theme" />
		<link href="../assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <script src="../assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
	  
    <link href="../assets/Custom/sweetalert.css" rel="stylesheet"/>
    <script src="../assets/Custom/sweetalert2.min.js"></script>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
	  <link rel="stylesheet" href="../assets/Custom/masking-input.css"/>
	  
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
  <body onload="LoadDefaultDatabase();">
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
          <?php include("IMSidePanel.php") ?>
      </div> 
      <!-- end #sidebar -->
      <!-- begin #content -->
	  <script>
  
	  
	  
	  function Reset()
	  {
		   
		      // document.getElementById("cmbProductCode").value='';
		      document.getElementById("txtCustomMobileno").value='';
		      document.getElementById("txtMessage").value=''; 
				document.getElementById("txtCustomMobileno").focus();
	  }
	  
	 function SendSMS()
	 {
		 
		var Message= document.getElementById("txtMessage").value; 
		 
		 
		  if ($("#rdCustomNumber").is(":checked")) {
             var  MobileNo= document.getElementById("txtCustomMobileno").value;
            } else {
			var  MobileNo= document.getElementById("txtAllMobileNo").value; 
			 
		    }
			 
			
	 if(MobileNo=="" || Message =="")
	 {
		 alert("Kindly Provide Mobile No and Message");
	 }
	 else
	 {
	 
		 var datas = "&MobileNo="+MobileNo+"&Message="+Message;	
	  	    // alert(datas); 
		 $.ajax({
		   url:"sendsms.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		    alert(data);
		   Reset();
		   }
		  }); 
	 }
	 }
	   
	    
	   function LoadDefaultDatabase()
	  {
		  
		var ProductCode = "-";
		var datas = "&ProductCode="+ProductCode;	
	   // alert(datas);
		 $.ajax({
		   url:"Load/LoadSMSDatabaes.php",
		   method:"POST",
		   data:datas,	
		   dataType:"json",
		   success:function(data)
		   {	
		    
		   $("#txtAllMobileNo").val(data[0]);
		  
		
		   }
		  });
	  }
	  
	   $(function () {
        $("input[name='rdDataBaseType']").click(function () {
            if ($("#rdCustomNumber").is(":checked")) {
                $("#txtCustomMobileno").removeAttr("disabled");
                $("#txtCustomMobileno").focus();
            } else {
                $("#txtCustomMobileno").attr("disabled", "disabled");
				 document.getElementById("txtCustomMobileno").value='';
				
            }
        });
    });
	
	function countChar(val) {
        var len = val.value.length;
		
		var TotalLen = "Message Count: ".concat(len);
        if (len >= 500) {
          val.value = val.value.substring(0, 500);
        } else {
          $('#charNum').text(TotalLen);
        }
      };
	  
	  </script>
	   
 
  <style>
  .bootstrap-select:not([class*="span"]):not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
    width: 320px;
}
  </style>
	
 <div id="content" class="content">
        <div class="row">
			    <!-- begin col-6 -->
			   <div class="col-md-8">
			        <!-- begin panel -->
                   <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                           
                            <h4 class="panel-title">Bulk SMS</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
							
							<div class="form-group">
								<label class="col-md-3 control-label">To</label>
								<div class="col-md-6">
								 <label class="radio-inline">
									<input type="radio" name="rdDataBaseType" id='rdCustomNumber' value="CustomNumber" checked />
									Specific Paitents
								</label>
								<label class="radio-inline">
								<input type="radio" name="rdDataBaseType" id='rdAllNumber' value="AllNumber"  />
									All Paitents
									
									
								</label>
                                
                                </div>
                                </div>
								
								<div style='display:none;' class="form-group">
                                   <label class="col-md-3 control-label">All Database</label>
                                   
									 <div class="col-md-8">
                                       <textarea class="form-control" placeholder="Mobile No with comma seperated" id='txtAllMobileNo' name ='txtAllMobileNo'  rows="5"></textarea>
                                    </div> 
									 
                                </div>
								<div class="form-group">
                                   <label class="col-md-3 control-label">Custom Numbers</label>
                                   
									 <div class="col-md-8">
                                       <textarea class="form-control" placeholder="Mobile No with comma seperated" id='txtCustomMobileno' name ='txtCustomMobileno'  rows="5"></textarea>
                                    </div> 
									 
                                </div>
								
								<div class="form-group">
                                   <label class="col-md-3 control-label">Message</label>
                                   
									 <div class="col-md-8">
                                       <textarea class="form-control" placeholder="Message" id='txtMessage' name ='txtMessage'  rows="5"  onkeyup="countChar(this)"></textarea>
									    <div><i>160 Char is counted as 1 SMS</i></div>
										<div id="charNum"></div>
                                    </div> 
									
									 
                                </div>
								 
									
								
								 
								  
								  
                                 
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> </label>
                                    <div class="col-md-9"> 	
                                         <input type="button"  class="btn btn-sm btn-success" onClick="SendSMS();" value='Send'> 	
                                         <input type="button"  class="btn btn-sm btn-warning" onClick="Reset();" value='Clear'> 	
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
  
      
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> 	
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