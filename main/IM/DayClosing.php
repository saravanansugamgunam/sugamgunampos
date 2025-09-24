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
  <body onload="getDate();LoadOpeningBalance(); LoadIncomeExpenseList();">
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
	 
	 function myFunction() {
document.getElementById('dtEntryDate').value= Date();
}
	 
	

	  function SaveDayClose()
	  { 
	  
	        
	   var DayCloseDate = document.getElementById("dtEntryDate").value;    
	   var OpeningBalance = document.getElementById("txtOpeningBalance").value;    
	   var AvailableCash = document.getElementById("txtAvailableCash").value;   
	   var HandoverCash = document.getElementById("txtHandovercash").value;   
	   var ClosingBalance = document.getElementById("txtClosingBalance").value;   
	   var Remarks = document.getElementById("txtRemarks").value;   
	   var Location = document.getElementById("cmbLocation").value;   
	        
	    // alert(Ledger);
	    
	  if (DayCloseDate=="" || ClosingBalance=="" || HandoverCash=="" )
	  {
			
	  swal("Alert!", " Fill All details", "warning");
		  
	  }
	  else
	  {
		 
	  var datas = "&DayCloseDate="+DayCloseDate+"&OpeningBalance="+OpeningBalance+"&AvailableCash="+AvailableCash+"&HandoverCash="+HandoverCash+"&ClosingBalance="+ClosingBalance+"&Remarks="+Remarks+"&Location="+Location;		  	
	  	        // alert(datas);
		 $.ajax({
		   url:"Save/SaveDayClosing.php",
		   method:"POST",
		   data:datas,		   
		   success:function(data)
		   {	
		     
		 if(data == 1)
		 {
			  
			  swal("Day Closed Sucessfully", "success");
			  // swal(data);
			   // LoadIncomeExpenseList();
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
		   
	 
	   
		      // document.getElementById("dtEntryDate").value='';
		      document.getElementById("txtOpeningBalance").value='';
		      document.getElementById("txtAvailableCash").value='';
		      document.getElementById("txtHandovercash").value='';
		      document.getElementById("txtClosingBalance").value='';
		      document.getElementById("txtRemarks").value='';
		     
				LoadIncomeExpenseList();
	  }
	  
	 
	  function LoadIncomeExpenseList()
	  {
		   
		  var Location = document.getElementById("cmbLocation").value;  
		var Dummy = "Dummy";
		var datas = "&Location="+Location; 
	 // alert(datas);
		 $.ajax({
		   url:"Load/LoadDayClosing.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		   // alert(data);
		    $( '#DivPaymentHistory' ).html(data);
			 
		
		   }
		  });
	  }
	  
	  
	   function LoadOpeningBalance()
	  {
		  var DayCloseDate = document.getElementById("dtEntryDate").value;  
		  var Location = document.getElementById("cmbLocation").value;  
		   
		var datas = "&DayCloseDate="+DayCloseDate+"&Location="+Location; 
	 
	 if(DayCloseDate=="")
	 {
	  swal("Alert!", "Kindly select the date", "warning");
	 }
	 else
	 {
		 
	 
	  $.ajax({
		   url:"Load/LoadOpeningBalance.php",
		   method:"POST",
		   data:datas,	
		   dataType:"json",
		   success:function(data)
		   {		 
		    
		    var CloseStatus =data[2];
			// alert(CloseStatus);
			if(CloseStatus=="1")
			{
				   document.getElementById("txtOpeningBalance").value = data[0];
		   document.getElementById("txtAvailableCash").value = data[1]; 
			}
			else
			{
				
				 swal("Alert!", "Already Closed, or Previous date not allowed", "warning");
				Reset();
				document.getElementById("txtOpeningBalance").value = data[0];
			}
			 
		
		   }
		  });
	 }
	  }
	  
	  
	  
	   function CalculateClosingBalance()
	  {
		    
		var OpeningBalance =  parseInt(document.getElementById("txtOpeningBalance").value);
		var AvailableCash =  parseInt(document.getElementById("txtAvailableCash").value);
		var HandoverCash =  parseInt(document.getElementById("txtHandovercash").value);
		var ClosingBalance =  OpeningBalance + AvailableCash - HandoverCash;
		 document.getElementById("txtClosingBalance").value=ClosingBalance;
		 
			  
	  
	  }
	  
	 
	 function getDate(){
    // var today = new Date();

// document.getElementById("txtEntryDate").value = 
// ('0' + today.getDate()).slice(-2) + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + today.getFullYear();
 
 // document.getElementById("dtEntryDate").value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);

 

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
                           
                            <h4 class="panel-title">Day Closing</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
							 
							 <div class="form-group">
                                    <label class="col-md-3 control-label"> Location</label>
                                    <div class="col-md-6">
									<select style='border-radius: 4px; padding: 5px;' id='cmbLocation' name ='cmbLocation' onchange='LoadIncomeExpenseList(); LoadOpeningBalance();'>
										 
						 <?php
                            $sqli = "SELECT locationcode,locationname FROM locationmaster";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value='.$row['locationcode'].'>'.$row['locationname'].'</option>';
                              }	
                            ?>
											 
											</select>
                                    </div>
                                </div>
								
								
								
								<div class="form-group">
                                   <label class="col-md-3 control-label">Date</label>
                                   
									 <div class="col-md-6">
                                         <input type="hidden"  class="form-control" placeholder="" id='txtEntryDate' name='txtEntryDate'/>
						 <input type="date"    class="form-control" id="dtEntryDate" 
                      name="dtEntryDate">
					  
                                    </div> 
									 <input type ='button' class="btn btn-sm btn-info" value ='Load' 
									 onclick='LoadOpeningBalance(); LoadIncomeExpenseList();'/>
                                   
								 
									 
                                </div>
								
									
								<div class="form-group">
                                    <label class="col-md-3 control-label"> Op. Balance</label>
                                    <div class="col-md-6">
									
									   <input type="text" class="form-control" placeholder="" id='txtOpeningBalance' name='txtOpeningBalance' disabled />
	   
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label class="col-md-3 control-label"> Aval. Cash</label>
                                    <div class="col-md-6">
									
									   <input type="text" class="form-control" placeholder="" id='txtAvailableCash' name='txtAvailableCash' disabled />
	   
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label class="col-md-3 control-label"> Handover Cash</label>
                                    <div class="col-md-6">
									
									   <input type="number" class="form-control" placeholder="" id='txtHandovercash' name='txtHandovercash' onkeyup="CalculateClosingBalance()" />
	   
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label class="col-md-3 control-label"> Closing Balance</label>
                                    <div class="col-md-6">
									
									   <input type="number" class="form-control" placeholder="" id='txtClosingBalance' name='txtClosingBalance' onkeyup="CalculateClosingBalance()"  disabled/>
	   
                                    </div>
                                </div>
							 
                                
								
								<div class="form-group">
                                    <label class="col-md-3 control-label">Remarks.</label>
                                   
									 <div class="col-md-6">
                                       <textarea id='txtRemarks' name='txtRemarks' row='5'  class="form-control" ></textarea>
                                    </div> 
                                </div>
								
								
								 
								  
                                 
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> </label>
                                    <div class="col-md-9"> 	
                                         <input type="button"  class="btn btn-sm btn-success" onClick="SaveDayClose();" value='Save'> 	
                                         <input type="button"  class="btn btn-sm btn-warning" onClick="Reset();" value='Clear'> 	
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
                           
                            <h4 class="panel-title">Day Closing Statement</h4>
                        </div>
                        <div class="panel-body"> 
						  <div data-scrollbar="true" data-height="510px">
                        <ul class="chats">
						 
						 
                          <div id="DivPaymentHistory" class="email-content"  ></div>
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