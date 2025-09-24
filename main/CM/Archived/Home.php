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
    
    session_cache_limiter(FALSE);
    session_start();
    
    
     // if(isset($_SESSION['RMS_EmployeeID']))
    // {
 
    
    // }
    // else
    // {
 
    // $url='index.php';
    // echo '
    // <META HTTP-EQUIV=REFRESH CONTENT=".1; '.$url.'">';
    // }
    
    ?>
  <head>
    <meta charset="utf-8" />
    <title>RMS | Task Management</title>
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
    <script language="javascript" type="text/javascript">
      <!-- Upload Annexures 
      function startUpload(){
      
      
      document.getElementById('f1_upload_process').style.visibility = 'visible';
      
      document.getElementById('f1_upload_form').style.visibility = 'hidden';
      return true;
      
      }
      
      function stopUpload(success){
      
      var result = '';
      var Id = document.getElementById("txtObservationIDforUploadAttachment").value;
      
      if (success == 1){
      
         result = '<div class="myDiv"><span class="msg">The file was uploaded successfully!<\/span></div><br/> ';
      
      LoadAttachments();
      
      }
      else {
         result = '<span class="emsg">There was an error during file upload!<\/span><br/> ';
      LoadAttachments();
       
      }
      document.getElementById('f1_upload_process').style.visibility = 'hidden';
      document.getElementById('f1_upload_form').innerHTML = result + '<label>File: <input  class=" form-control" name="myfile" id="myfile" type="file"  size="30" /><\/label><label><input  class=" form-control" type="submit" name="submitBtn" class="sbtn" value="Upload" /><\/label>';
      document.getElementById('f1_upload_form').style.visibility = 'visible'; 
      document.getElementById("txtDocumentDisplayName").value = '';
      document.getElementById("txtDocumentDisplayName").focus();
      return true;   
      
      LoadTask();
      }
      
      function makeFileList() {
      var input = document.getElementById("myfile");
      var ul = document.getElementById("fileList");
      while (ul.hasChildNodes()) {
      ul.removeChild(ul.firstChild);
      }
      for (var i = 0; i < input.files.length; i++) {
      var li = document.createElement("li");
      li.innerHTML = input.files[i].name;
      ul.appendChild(li);
      }
      if(!ul.hasChildNodes()) {
      var li = document.createElement("li");
      li.innerHTML = 'No Files Selected';
      ul.appendChild(li);
      }
      }
        
      function LoadAttachments()
      {
       
      var Id = document.getElementById("txtObservationIDforUploadAttachment").value;
      
      
      // var Id = document.getElementById("txtObservationIDforUploadAttachment").value;  
      var Type = "Approval";
      // var FilterPeriod = document.getElementById("txtPeriod").value;// $("#txtperiod").val(); //document.getElementById("txtperiod").value; 
      var datas = "&Id="+Id+"&Type="+Type;
      
      
      $.ajax({
      method: 'POST',
      url:"loadattachments.php",
      data:datas,
      success:function(response)
      {
      // var ajaxDisplay = document.getElementById(divid);
         // ajaxDisplay.innerHTML = html;
      //alert (response);
      $( '#display_attachment_details' ).html(response);
      }
      });
      
      LoadTask();
      }
      
    </script>
  </head>
  <body onload ="LoadTaskSummary();CustomColumnLoad();">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in">
      <span class="spinner"></span>
    </div>
    <!-- end #page-loader -->
    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed in page-sidebar-minified">
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
            <?php if($ColumnCustomization=='1')
              {
               ?>
            <li class="dropdown navbar-user">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="modal" data-target="#ModalSettings">
              <img src="../assets/img/Settings.png" alt="" />
              </a>
            </li>
            <?php
              }
              
               ?>
            <li class="dropdown navbar-user">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../assets/img/user-13.jpg" alt="" />
              <span class="hidden-xs">
              <?php echo $_SESSION["RMS_EmployeeName"]; ?>
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
      <script>
        $(document).ready(function(){
          $(document).ajaxStart(function(){
        	$("#wait").css("display", "block");
          });
          $(document).ajaxComplete(function(){
        	$("#wait").css("display", "none");
          });
           
        });
      </script>
      <div id="wait" style="display:none;width:69px;height:189px;border:1px grey;position:absolute;top:50%;left:50%;padding:2px; z-index: 1000;">
        <img src='../assets/img/demo_wait.gif' width="64" height="64" />
        <br>Loading...
      </div>
      <!-- begin #sidebar -->
      <div id="sidebar" class="sidebar">
        <!-- begin sidebar scrollbar -->
        <div data-scrollbar="true" data-height="100%">
          <!-- begin sidebar user -->
          <!-- end sidebar user -->
          <!-- begin sidebar nav -->
          <ul class="nav">
            <li class="has-sub active">
              <a href="HomeAG.php">
              <i class="fa fa-inbox"></i>
              <span>Task Management</span>
              </a>
            </li>
            <li class="has-sub">
              <a href="CalendarView.php">
              <i class="fa fa-calendar"></i>
              <span>Calendar</span>
              </a>
            </li>
            <li class="has-sub">
              <a href="TaskSummaryAG.php">
              <i class="fa fa-history"></i>
              <span>Routine Summary</span>
              </a>
            </li>
            <li class="has-sub">
              <a href="Attendance.php">
              <i class="fa fa-hand-o-up"></i>
              <span>Attendance</span>
              </a>
            </li>
            <li style="display;" class="has-sub">
              <a href="DashboardAG.php">
              <i class="fa fa-dashboard "></i>
              <span>Dashboard</span>
              </a>
            </li>
            <li style="display;" class="has-sub">
              <a href="Masters.php">
              <i class="fa fa-plus-square"></i>
              <span>Masters</span>
              </a>
            </li>
            <li>
              <a onclick="go_full_screen()">
              <i class="fa fa-2x fa-arrows-alt"></i>
              <span style="color:white; font-size:13px;">Full screen</span>
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
        </div>
        <!-- end sidebar scrollbar -->
      </div>
      <div class="sidebar-bg"></div>
      <!-- end #sidebar -->
      <!-- begin #content -->
      <div id="content" class="content content-full-width">
        <div class="p-20">
          <!-- begin row -->
          <div class="row">
            <div id="modalTag" name ="modalTag" class="modal" data-easein="perspectiveRightIn" tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
              <div id="modalTag1" class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                    </button>
                    <h5 class="modal-title">
                      Task: 
                      <b>
                      <span id="spntask"></span>
                      </b>
                      <br>
                    </h5>
                  </div>
                  <div class="modal-body">
                    <P>
                      <!-- begin panel -->
                    <div class="panel panel-default " >
                      <div data-scrollbar="false" data-height="250px">
                        <ul class="nav nav-tabs nav-tabs-default ">
                          <?php 
                            if ($SpecialAccess==1)
                            {
                             echo "  
                            										<li class=''>
                            											<a href='#nav-tab2-1' data-toggle='tab'>Modify Task</a>
                            										</li>
																	
																	<li class=''>
                            											<a href='#nav-tab2-7' data-toggle='tab'>Modify Category</a>
                            										</li>
																	
                            										<li class=''>
                            											<a href='#nav-tab2-2' data-toggle='tab'>Change Date</a>
                            										</li>
                            										<li class=''>
                            											<a href='#nav-tab2-3' data-toggle='tab'>Add Tags</a>
                            										</li>
                            										<li class=''>
                            											<a href='#nav-tab2-4' data-toggle='tab'>Change Processowner</a>
                            										</li>
                            										<li class=''>
                            											<a href='#nav-tab2-5' data-toggle='tab'>Is Commited ?</a>
                            										</li>
                            										<li class='' onclick='LoadTotalTimeSpent();'>
                            											<a href='#nav-tab2-6' data-toggle='tab'>Time Log</a>
                            										</li> 
																	 ";
                            
                            }
                            else
                            {
                            echo "  
                            										<li class=''>
                            											<a href='#nav-tab2-1' data-toggle='tab'>Modify Task</a>
                            										</li>
                            										<li class=''>
                            											<a href='#nav-tab2-3' data-toggle='tab'>Add Tags</a>
                            										</li>
                            										<li class='' onclick='LoadTotalTimeSpent();'>
                            											<a href='#nav-tab2-6' data-toggle='tab'>Time Log</a>
                            										</li> ";
                            }
                            ?>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane fade" id="nav-tab2-1">
                            <div class="panel panel-inverse" >
                              <label>Existing Task description </label>
                              <br>
                              <b>
                              <span id="spnOldtask"></span>
                              </b>
                              <br>
                            </div>
                            <br>
                            <label>
                            <b>New task description</b>
                            </label>
                            <div class="md-form">
                              <i class="fas fa-pencil-alt prefix"></i>
                              <textarea type="text" id="txtModifiedTaskDescription" name="txtModifiedTaskDescription" class="md-textarea form-control"  rows="2" placeholder ='Task'></textarea>
                            </div>
                            <br>
                            <hr>
                            <button class="btn btn-primary" onclick="ChangeTask();">
                            Modify Task
                            </button>
                            <br>
                          </div>
						  
						  <div class="tab-pane fade" id="nav-tab2-7">
                            <div class="panel panel-inverse" >
                              <label>Existing Category </label>
                              <br>
                              <b>
                              <span id="spnExistingCategory"></span> 
                              </b>
                              <br>
                            </div>
                            <br>
                            <label>
                            <b>New Category</b>
                            </label>
                            <div class="md-form">
							 <div style='width: 250px;'>
                                    <select  class="form-control selectpicker" id="SelectModifyCategory"  name="SelectModifyCategory"  data-size="10" data-live-search="true" data-style="btn-white">
                                      <option value="" selected>Select Category</option>
                                      <?php  
                                        $CompanyID = $_SESSION["RMS_CompanyID"];
                                        $sqli = "SELECT categoryid,category FROM  categorymaster  WHERE clientid ='$CompanyID'";
                                        
                                        
                                        $result = mysqli_query($connection, $sqli);
                                        while ($row = mysqli_fetch_array($result)) {
                                        # code...
                                        echo '
                                        		<option  value='.$row['categoryid'].'> '.$row['category'].' </option>';
                                        }	
                                        ?>
                                    </select>
                                  </div>
                             
                            </div>
                            <br>
                            <hr>
                            <button class="btn btn-primary" onclick="ChangeCategory();">
                            Modify Category
                            </button>
                            <br>
                          </div>
						  
                          <div class="tab-pane fade" id="nav-tab2-2">
                            <div class="panel panel-inverse" >
                              <label>
                              <b>Revised Due Date</b>
                              </label>
                              <div data-scrollbar="true" data-height="40px">
                                <input class="date form-control" id="dtChangeTimeLine" name ="dtChangeTimeLine" style="width: 150px;"  type="text">
                              </div>
                            </div>
                            <div class="md-form">
                              <i class="fas fa-pencil-alt prefix"></i>
                              <textarea type="text" id="txtRemarksTimelineChange" name="txtRemarksTimelineChange" class="md-textarea form-control"  rows="2" placeholder ='Comments'></textarea>
                            </div>
                            <br>
                            <hr>
                            <button class="btn btn-primary" data-dismiss="modal"  onclick="ChangeTimeLine();">
                            Change Due date
                            </button>
                            <br>
                          </div>
                          <div class="tab-pane fade" id="nav-tab2-3">
                            <label>
                            <b>Tags</b>
                            </label>
                            <br>
                            <br>
                            <span id="spnTags"></span>
                            <br>
                            <br>
                            <td>
                              <div style='width: 250px;'>
                                <select  class="form-control selectpicker" id="cmbAddModTags" multiple name="cmbAddModTags"  data-size="10" data-live-search="true" data-style="btn-success">
                                  <option value="" selected>-</option>
                                  <?php  
                                    $CompanyID = $_SESSION["RMS_CompanyID"];
                                    $sqli = " SELECT tagname  FROM tagmaster WHERE clientid ='$CompanyID'";
                                    
                                    $result = mysqli_query($connection, $sqli);
                                    while ($row = mysqli_fetch_array($result)) {
                                    # code...
                                    echo '
                                    <option  value="'.$row['tagname'].'"> '.$row['tagname'].' </option>';
                                    }	
                                    ?>
                                </select>
                              </div>
                            </td>
                            <br>
                            <hr>
                            <button class="btn btn-primary" onclick="AddTags()">
                            Add Tags
                            </button>
                            <br>
                          </div>
                          <div class="tab-pane fade" id="nav-tab2-4">
                            <br>
                            <label>Old Processowner:</label>
                            <b>
                            <span id="spnOldProcessowner"></span>
                            </b>
                            <br>
                            <br>
                            <label>New Processowner: </label>
                            <select  class="form-control selectpicker" id="cmbModProcessowner"  name="cmbModProcessowner"  data-size="10" data-live-search="true" data-style="btn-white">
                              <option value="" selected>Select Processowner</option>
                              <?php  
                                $CompanyID = $_SESSION["RMS_CompanyID"];
                                $sqli = " SELECT a.userid,a.username FROM usermaster AS a JOIN companyusermapping AS b ON 
                                a.userid =b.userid WHERE b.companyid ='$ClientCode'";
                                
                                $result = mysqli_query($connection, $sqli);
                                while ($row = mysqli_fetch_array($result)) {
                                # code...
                                echo '
                                <option  value='.$row['userid'].'> '.$row['username'].' </option>';
                                }	
                                ?>
                            </select>
                            <br>
                            <hr>
                            <button class="btn btn-primary" onclick="ChangeProcessowner()">
                            Change Processowner
                            </button>
                            <br>
                          </div>
                          <div class="tab-pane fade" id="nav-tab2-5">
                            <div class="panel panel-inverse" >
                              <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
                              <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
                              Commited: &nbsp;&nbsp;  
                              <style>
                                .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
                                .toggle.ios .toggle-handle { border-radius: 20px; }
                              </style>
                              <input type="checkbox" name='rdCommited' id='rdCommited'  checked data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No">
                              &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp; 	 	On Hold: &nbsp;&nbsp;  
                              <style>
                                .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
                                .toggle.ios .toggle-handle { border-radius: 20px; }
                              </style>
                              <input type="checkbox" name='rdOnHold' id='rdOnHold'  data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No">
                            </div>
                            <br>
                            <hr>
                            <button class="btn btn-primary" onclick="SaveCommitedOnHoldStatus();">
                            Change Status
                            </button>
                            <br>
                          </div>
                          <script type="text/javascript">
                            // From: http://www.webdeveloper.com/forum/showthread.php?273699-add-2-fields-containing-time-values-in-hh-mm-format&daysprune=30
                            
                            Number.prototype.padDigit = function() { return (this < 10) ? '0'+this : ''+this; }
                            
                            function timeAddSub(id1, id2, flag) {  // flag=true to add values and flag=false to subtract values
                              var tt1 = document.getElementById(id1).value;  if (tt1 == '') { return ''; }
                              var t1 = tt1.split(':');
                              var tt2 = document.getElementById(id2).value;  if (tt2 == '') { return ''; }
                              var t2 = tt2.split(':');
                              tt1 = Number(t1[0])*60+Number(t1[1]);
                              tt2 = Number(t2[0])*60+Number(t2[1]);
                              var diff = 0;  if (flag) { diff = tt1 + tt2; } else { diff = tt1 - tt2; }
                              t1[0] = Math.abs(Math.floor(parseInt(diff / 60))).padDigit();  // form hours
                              t1[1] = Math.abs(diff % 60).padDigit();                        // form minutes
                              var tt1 = '';  if (diff < 0) { tt1 = '-'; }                    // check for negative value
                              return tt1+t1.join(':');
                            }
                            
                            																																																	
                          </script>
                          </script>
                          <div class="tab-pane fade" id="nav-tab2-6">
                            Total Time Spent So far: &nbsp; 
                            <b>
                            <span id="sptTotalTimeSpent"></span>
                            </b>  Hrs
                            <br>
                            <br>
                            Start Time
                            <input class="form-control"  style='width: 150px;' type="time" name="dtStartTime" id="dtStartTime" />
                            End Time
                            <input class="form-control"  style='width: 150px;' type="time" name="dtEndTime"  id="dtEndTime" 
                              onchange="document.getElementById('timeSum').value = timeAddSub('dtEndTime','dtStartTime',false)" />
                            <br>Total Time Spent: 
                            <input disabled id="timeSum" value="" size="5"> Hrs
                            <br>
                            <hr>
                            <button class="btn btn-primary" onclick="SaveTimeLog()">
                            Save
                            </button>
                            <br>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end panel -->
                    </P>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="ModalSettings" role="dialog" >
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Settings</h5>
                  </div>
                  <div class="modal-body">
                    <script>
                      function CustomColumnLoad() {
                       
                      var Cl1= document.getElementById('txtColumn1').value;
                      var Cl2= document.getElementById('txtColumn2').value;
                      var Cl3= document.getElementById('txtColumn3').value;
                      var Cl4= document.getElementById('txtColumn4').value;
                      var Cl5= document.getElementById('txtColumn5').value;
                      var Cl6= document.getElementById('txtColumn6').value;
                      var Cl7= document.getElementById('txtColumn7').value;
                      var Cl8= document.getElementById('txtColumn8').value;
                      var Cl9= document.getElementById('txtColumn9').value;
                      var Cl10= document.getElementById('txtColumn10').value;
                      var Cl11= document.getElementById('txtColumn11').value;
                      var Cl12= document.getElementById('txtColumn12').value;
                      var Cl13= document.getElementById('txtColumn13').value;
                      var Cl14= document.getElementById('txtColumn14').value;
                      var Cl15= document.getElementById('txtColumn15').value;
                      var Cl16= document.getElementById('txtColumn16').value;
                      // alert(1);
                      if (Cl1=='true')
                      {
                      $('#chkClient').prop('checked',true);
                      $('.Client').toggleClass('hide');
                      
                      }
                      else
                      {
                      $('#chkClient').prop('checked',false);
                      $('.Client').toggleClass('hide');
                      
                      }
                      if (Cl12=='true')
                      {
                      $('#chkDepartment').prop('checked',true);
                      $('.Department').toggleClass('hide');
                      }
                      else
                      {
                      $('#chkDepartment').prop('checked',false);
                      $('.Department').toggleClass('hide');
                      }
                      if (Cl3=='true')
                      {
                      $('#chkLocation').prop('checked',true);
                      $('.Location').toggleClass('hide');
                      }
                      else
                      {
                      $('#chkLocation').prop('checked',false);
                      $('.Location').toggleClass('hide');
                      }
                      if (Cl4=='true')
                      {
                      $('#chkProject').prop('checked',true);
                      $('.Project').toggleClass('hide');
                      }
                      else
                      {
                      $('#chkProject').prop('checked',false);
                      $('.Project').toggleClass('hide');
                      }
                      if (Cl5=='true')
                      {
                      $('#chkSubProject').prop('checked',true);
                      $('.SubProject').toggleClass('hide');
                      }
                      else
                      {
                      $('#chkSubProject').prop('checked',false);
                      $('.SubProject').toggleClass('hide');
                      }
                      if (Cl6=='true')
                      {
                      $('#chkCategory').prop('checked',true);
                      $('.Category').toggleClass('hide');
                      }
                      else
                      {
                      $('#chkCategory').prop('checked',false)
                      $('.Category').toggleClass('hide');
                      }
                      if (Cl7=='true')
                      {
                      $('#chkRecurrance').prop('checked',true);
                      $('.Recurrance').toggleClass('hide');
                      }
                      else
                      {
                      $('#chkRecurrance').prop('checked',false);
                      $('.Recurrance').toggleClass('hide');
                      }
                      if (Cl8=='true')
                      {
                      $('#chkTaskCode').prop('checked',true);
                      $('.TaskCode').toggleClass('hide');
                      }
                      else
                      {
                      $('#chkTaskCode').prop('checked',false);
                      $('.TaskCode').toggleClass('hide');
                      }
                      if (Cl9=='true')
                      {
                      $('#chkTask').prop('checked',true);
                      // $('.chkTask').toggleClass('hide');
                      
                      $('.chkTask').toggle('hide');
                      // alert("v");
                      
                      }
                      else
                      {
                      $('#chkTask').prop('checked',false);
                      // $('.chkTask').toggleClass('hide');
                      // alert("h");
                      
                      }
                      if (Cl10=='true')
                      {
                      $('#chkDueDate').prop('checked',true);
                      $('.DueDate').toggleClass('hide');
                      }
                      else
                      {
                      $('#chkDueDate').prop('checked',false);
                      $('.DueDate').toggleClass('hide');
                      }
                      if (Cl11=='true')
                      {
                      $('#chkAge').prop('checked',true);
                      $('.Age').toggleClass('hide');
                      }
                      else
                      {
                      $('#chkAge').prop('checked',false);
                      $('.Age').toggleClass('hide');
                      }
                      if (Cl12=='true')
                      {
                      $('#chkPriority').prop('checked',true);
                      $('.Priority').toggleClass('hide');
                      }
                      else
                      {
                      $('#chkPriority').prop('checked',false);
                      $('.Priority').toggleClass('hide');
                      }
                      
                      if (Cl13=='true')
                      {
                      $('#chkProcessowner').prop('checked',true);
                      $('.ProcessOwner').toggleClass('hide');
                      }
                      else
                      {
                      $('#chkProcessowner').prop('checked',false);
                      $('.ProcessOwner').toggleClass('hide');
                      }
                      if (Cl14=='true')
                      {
                      $('#chkLeader').prop('checked',true);
                      $('.Leader').toggleClass('hide');
                      }
                      else
                      {
                      $('#chkLeader').prop('checked',false);
                      $('.Leader').toggleClass('hide');
                      }
                      if (Cl15=='true')
                      {
                      $('#chkCreatedBy').prop('checked',true);
                      $('.CreatedBy').toggleClass('hide');
                      }
                      else
                      {
                      $('#chkCreatedBy').prop('checked',false);
                      $('.CreatedBy').toggleClass('hide');
                      }
                      if (Cl16=='true')
                      {
                      $('#chkRemarks').prop('checked',true);
                      $('.Remarks').toggleClass('hide');
                      }
                      else
                      {
                      $('#chkRemarks').prop('checked',false);
                      $('.Remarks').toggleClass('hide');
                      }
                      // alert(2);
                      }
                      
                      function SaveCustomColumns()
                      {
                      var Cl1 = document.getElementById("chkClient").checked;
                      var Cl2 = document.getElementById("chkDepartment").checked;
                      var Cl3 = document.getElementById("chkLocation").checked;
                      var Cl4 = document.getElementById("chkProject").checked;
                      var Cl5 = document.getElementById("chkSubProject").checked;
                      var Cl6 = document.getElementById("chkCategory").checked;
                      var Cl7 = document.getElementById("chkRecurrance").checked;
                      var Cl8 = document.getElementById("chkTaskCode").checked;
                      var Cl9 = document.getElementById("chkTask").checked;
                      var Cl10 = document.getElementById("chkDueDate").checked;
                      var Cl11 = document.getElementById("chkAge").checked;
                      var Cl12 = document.getElementById("chkPriority").checked;
                      var Cl13 = document.getElementById("chkProcessowner").checked;
                      var Cl14 = document.getElementById("chkLeader").checked;
                      var Cl15 = document.getElementById("chkCreatedBy").checked;
                      var Cl16 = document.getElementById("chkRemarks").checked;
                      
                      if (Cl1) 
                      { 
                      document.getElementById('txtColumn1').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn1').value='false'; 
                      } 
                      // alert(3);
                      if (Cl2) 
                      { 
                      document.getElementById('txtColumn2').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn2').value='false'; 
                      } 
                      if (Cl3) 
                      { 
                      document.getElementById('txtColumn3').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn3').value='false'; 
                      } 
                      if (Cl4) 
                      { 
                      document.getElementById('txtColumn4').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn4').value='false'; 
                      } 
                      if (Cl5) 
                      { 
                      document.getElementById('txtColumn5').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn5').value='false'; 
                      } 
                      if (Cl6) 
                      { 
                      document.getElementById('txtColumn6').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn6').value='false'; 
                      } 
                      if (Cl7) 
                      { 
                      document.getElementById('txtColumn7').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn7').value='false'; 
                      } 
                      if (Cl8) 
                      { 
                      document.getElementById('txtColumn8').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn8').value='false'; 
                      } 
                      if (Cl9) 
                      { 
                      document.getElementById('txtColumn9').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn9').value='false'; 
                      } 
                      if (Cl10) 
                      { 
                      document.getElementById('txtColumn10').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn10').value='false'; 
                      } 
                      if (Cl11) 
                      { 
                      document.getElementById('txtColumn11').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn11').value='false'; 
                      } 
                      if (Cl12) 
                      { 
                      document.getElementById('txtColumn12').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn12').value='false'; 
                      } 
                      if (Cl13) 
                      { 
                      document.getElementById('txtColumn13').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn13').value='false'; 
                      } 
                      if (Cl14) 
                      { 
                      document.getElementById('txtColumn14').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn14').value='false'; 
                      } 
                      if (Cl15) 
                      { 
                      document.getElementById('txtColumn15').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn15').value='false'; 
                      } 
                      if (Cl16) 
                      { 
                      document.getElementById('txtColumn16').value='true'; 
                      }
                      else 
                      { 
                      document.getElementById('txtColumn16').value='false'; 
                      } 
                      
                      // alert(4);
                      
                      var datas = "&Cl1="+Cl1+ 
                      "&Cl2="+Cl2+ 
                      "&Cl3="+Cl3+ 
                      "&Cl4="+Cl4+ 
                      "&Cl5="+Cl5+ 
                      "&Cl6="+Cl6+ 
                      "&Cl7="+Cl7+ 
                      "&Cl8="+Cl8+ 
                      "&Cl9="+Cl9+ 
                      "&Cl10="+Cl10+ 
                      "&Cl11="+Cl11+ 
                      "&Cl12="+Cl12+ 
                      "&Cl13="+Cl13+ 
                      "&Cl14="+Cl14+ 
                      "&Cl15="+Cl15+ 
                      "&Cl16="+Cl16;		
                      
                      // alert(datas);						 
                      $.ajax
                      ({
                      type: "POST",
                      url: "SaveCustomColumn.php",
                      data: datas,
                      success: function(response)
                      { 	 
                      // document.getElementById("txtQueryCheck").value = response;
                      alert(response);
                      
                      } 
                      });
                      } 
                      
                      
                    </script>
                    <script>
                      $(function () {
                      $("input:checkbox:not(:checked)").each(function() {
                      var column = "table ." + $(this).attr("name");
                      $(column).hide();
                      });
                      
                      $("input:checkbox").click(function(){
                      var column = "table ." + $(this).attr("name");
                      $(column).toggle();
                      });
                      });
                      
                      
                      
                    </script>
                    <style>
                      .hide {
                      display: none;
                      }
                    </style>
                    <script>
                      window.toggleColumn = function() {
                      	
                       $('.yclass').toggleClass('hide');
                       
                      };
                    </script>
                    <script>
                      function HideColumn() {
                      
                      $('.chkTask').toggle('hide');
                      
                      };
                    </script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                    <table hidden style="  border-collapse: collapse;  border: 1px solid black;" >
                      <tbody>
                        <tr>
                          <td>Home Screen</td>
                          <td>
                            <input type="checkbox" checked data-toggle="toggle" data-on="Summary" data-off="Detail" data-onstyle="success" data-offstyle="info" data-width="150">
                          </td>
                          <td>Save</td>
                        </tr>
                        <tr>
                          <td>
                            <br>
                          </td>
                        </tr>
                        <tr>
                          <td>Default view </td>
                          <td>
                            <input type="checkbox" checked data-toggle="toggle" data-on="With Overdue" data-off="Without Overdue" data-onstyle="danger" data-offstyle="success" data-width="150">
                          </td>
                          <td>Save</td>
                        </tr>
                      </tbody>
                    </table>
                    <div id="grpChkBox">
                      <table style="  border-collapse: collapse;  width: 100%;" >
                        <tbody>
                          <tr>
                            <td col>Customize Filter</td>
                            <td>
                              <label>
                              <input type='checkbox'  id = 'chkClient' name = 'chkClient' /> Client
                              </label>
                            </td>
                            <td>
                              <label>
                              <input type='checkbox'  id = 'chkProject' name = 'chkProject' /> Project
                              </label>
                            </td>
                            <td>
                              <label>
                              <input type='checkbox'  id = 'chkSubProject' name = 'chkSubProject' /> Sub Project
                              </label>
                            </td>
                            <td></td>
                          </tr>
                          <td col></td>
                          <td>
                            <label>
                            <input type='checkbox'  id = 'chkRecurrance' name = 'chkRecurrance' /> Recurrance
                            </label>
                          </td>
                          <td>
                            <label>
                            <input type='checkbox'  id = 'chkTask' name = 'chkTask' /> Task
                            </label>
                          </td>
                          <td>
                            <label>
                            <input type='checkbox'  id = 'chkDueDate' name = 'chkDueDate' /> Due date
                            </label>
                          </td>
                          <td></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td>
                              <label>
                              <input type='checkbox'  id = 'chkAge' name = 'chkAge' /> Age
                              </label>
                            </td>
                            <td>
                              <label>
                              <input type='checkbox'  id = 'chkProcessowner' name = 'chkProcessowner' /> ProcessOwner
                              </label>
                            </td>
                            <td>
                              <label>
                              <input type='checkbox'  id = 'chkRemarks' name = 'chkRemarks' /> Remarks
                              </label>
                            </td>
                            <td>
                              <button class="btn btn-sm btn-primary" onclick='SaveCustomColumns()'>Save</button>
                            </td>
                          </tr>
                          <tr hidden>
                            <td></td>
                            <td>
                              <label>
                              <input type='checkbox'  id = 'chkPriority' name = 'chkPriority' /> Priority
                              </label>
                            </td>
                            <td>
                              <label>
                              <input type='checkbox'  id = 'chkCategory' name = 'chkCategory' /> Category
                              </label>
                            </td>
                            <td>
                              <label>
                              <input type='checkbox'  id = 'chkTaskCode' name = 'chkTaskCode' /> Task Code
                              </label>
                            </td>
                            <td></td>
                          </tr>
                          <tr hidden>
                            <td></td>
                            <td>
                              <label>
                              <input type='checkbox'  id = 'chkDepartment' name = 'chkDepartment' /> Department
                              </label>
                            </td>
                            <td>
                              <label>
                              <input type='checkbox'  id = 'chkLocation' name = 'chkLocation' /> Location
                              </label>
                            </td>
                            <td>
                              <label>
                              <input type='checkbox'  id = 'chkLeader' name = 'chkLeader' /> Leader
                              </label>
                            </td>
                            <td>
                              <label>
                              <input type='checkbox'  id = 'chkCreatedBy' name = 'chkCreatedBy' /> Created By
                              </label>
                            </td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div style="display:none;" class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <script>
              function go_full_screen(){
                  var elem = document.documentElement;
                  if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                  } else if (elem.msRequestFullscreen) {
                    elem.msRequestFullscreen();
                  } else if (elem.mozRequestFullScreen) {
                    elem.mozRequestFullScreen();
                  } else if (elem.webkitRequestFullscreen) {
                    elem.webkitRequestFullscreen();
                  }
              }
              
              
              
                
            </script>
            <!-- begin col-2 -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
            <style>
              .modal-backdrop {
              position: fixed;
              top: 0;
              right: 0;
              bottom: 0;
              left: 0;
              z-index: 1040;
              background-color: rgba(0, 0, 0, 0.3);
              }
              #modal1{
              position: fixed;
              top: 60%;
              left: 50%;
              height:100%;
              transform: translate(-50%, -50%);
              }
              #modalTag{
              position: fixed;
              top: 60%;
              left: 50%;
              height:100%;
              width: 1200px;
              transform: translate(-50%, -50%);
              }
              #modalTag1{
              width: 900px;
              }
            </style>
            <div id="modal1" name ="modal1" class="modal" data-easein="perspectiveRightIn" tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                    </button>
                    <h5 class="modal-title">
                      Task: 
                      <b>
                      <span id="spnstatus"></span>
                      </b>
                      <br>
                      <b>
                      <span id="spn"></span>
                      </b>
                    </h5>
                  </div>
                  <div class="modal-body">
                    <P>
                      <!-- begin panel -->
                    <div class="panel panel-inverse" >
                      <div data-scrollbar="true" data-height="225px">
                        <ul class="chats">
                          <div id="display_comments" class="email-content"  ></div>
                        </ul>
                      </div>
                    </div>
                    <!-- end panel -->
                    </P>
                  </div>
                  <div class="modal-footer">
                    <div class="md-form">
                      <i class="fas fa-pencil-alt prefix"></i>
                      <textarea type="text" id="txtComments" name="txtComments" class="md-textarea form-control"  rows="3" placeholder ='Comments'></textarea>
                    </div>
                    <br>
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">
                    Close
                    </button>
                    <button class="btn btn-primary" onclick="SaveComments();">
                    Add Comment
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end col-2 -->
            <!-- begin col-10 -->
            <div class="modal fade" id="AttachmentModal"   role="dialog" aria-labelledby="AttachmentModalLabel" aria-hidden="true" style="padding: 0 20px 10px !important; ">
              <div class="modal-dialog  modal-lg" style="width:500px;" >
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="AttachmentModalLabel">Upload Files</h4>
                  </div>
                  <div class="modal-body"  style="padding: 0 20px 0px !important; ">
                    <div id="container">
                      <div id="content">
                        <form action="upload.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();" >
                          <input type='hidden' id ='txtObservationIDforUploadAttachment' name ='txtObservationIDforUploadAttachment' />
                          <input type='hidden' id ='txtSelectedRowForUploadAttachment' name ='txtSelectedRowForUploadAttachment' />
                          <label>Annexure Name: </label>
                          <input  class=" form-control" type ='text' id='txtDocumentDisplayName'  name='txtDocumentDisplayName' />
                          <p id="f1_upload_process" >Loading...
                            <br/>
                            <img src="loader.gif" />
                            <br/>
                          </p>
                          <p id="f1_upload_form" align="left">
                            <br/>
                            <label>File: 
                            <input name="myfile" id="myfile" type="file"  class=" form-control"  size="30" />
                            </label>
                            <label>
                            <input  class=" form-control" type="submit" name="submitBtn"  class="sbtn" value="Upload" />
                            </label>
                          </p>
                          <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                        </form>
                      </div>
                      <!--   <form action="upload.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();" ><input type='text' id ='txtObservationIDforUploadAttachment' name ='txtObservationIDforUploadAttachment' /><input type='text' id ='txtSelectedRowForUploadAttachment' name ='txtSelectedRowForUploadAttachment' /><label>Annexure Name: </label><input  class=" form-control" type ='text' id='txtDocumentDisplayName'  name='txtDocumentDisplayName' /><p id="f1_upload_process" >Loading...<br/><img src="loader.gif" /><br/></p><p id="f1_upload_form" align="left"><br/><label>File: <input name="myfile" id="myfile" type="file"  class=" form-control"  size="30" /></label><label><input  class=" form-control" type="submit" name="submitBtn"  class="sbtn" value="Upload" /></label></p><iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe></form> -->
                    </div>
                  </div>
                  <div class="modal-footer">
                    <div id="display_attachment_details"  class="form-group col-md-6"></div>
                  </div>
                </div>
              </div>
            </div>
            <form method="post" id="AddTask">
              <div class="col-md-10">
                <div class="modal fade" id="modal-dialog">
                  <div class="modal-dialog " style="width:800px;">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Add Task</h4>
                      </div>
                      <div class="modal-body">
                        <textarea rows="2" cols="30" id="TaskDescrtiption" name="TaskDescrtiption" class="form-control" placeholder="Task Discription" ></textarea>
                        <div class="radio" style="display:none;">
                          <label title ="Task which will not accumulated" >
                          <input type="radio" name="rdIsAccumulated"  id="rdNonAccumulated" value="NonAccumulated" onclick="FindIsAccumuatedTask(this.value)" /> Non-Accumulated Task 
                          </label>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <label  title ="Task which will get accumulated">
                          <input type="radio" name="rdIsAccumulated" id="rdAccumulated" value="Accumulated" onclick="FindIsAccumuatedTask(this.value)" /> Accumulated Task
                          </label>
                          <input type ='text' id='txtAccumulated' name ='txtAccumulated' value ='No' />
                        </div>
                        <script>
                          function LoadTaskSummary()
                          {
                          	 
                          	var SummaryFilter = document.querySelector('input[name="rdSummaryName"]:checked').value;
                          		var DisplayType = document.querySelector('input[name="rdDisplayType"]:checked').value;
                          		 var ProjectStage= document.getElementById("cmbProjectStageSummary").value; 
                          		 if (ProjectStage=="0")
                          		 {
                          			 ProjectStage='%';
                          		 }
                          		 
                          		 
                          	 var datas = "&SummaryFilter="+SummaryFilter+"&ProjectStage="+ProjectStage+"&DisplayType="+DisplayType;
                          	 
                          	
                          	 $.ajax({
                             method: 'post',
                             url:"LoadTaskSummaryAG.php",
                             data:datas,
                             success:function(response)
                             {
                          	     //alert(response);
                               // var ajaxDisplay = document.getElementById(divid);
                                   // ajaxDisplay.innerHTML = html;
                          		 $( '#display_Summary' ).html(response);
                             }
                            });
                            
                             LoadSummaryData_Initial();
                             LoadClientFilter();
                             LoadProjectFilter();
                             LoadSubProjectFilter();
                             LoadCategoryFilter();
                             LoadProcessownerFilter();
                             LoadFrequencyFilter();
                             }	
                          
                          function ResetFilterItems()
                          {
                          		 document.getElementById("txtTotalFilterSequence").value=0;
                          		 document.getElementById("txtClientSequence").value=0;
                          		 document.getElementById("txtProjectSequence").value=0;
                          		 document.getElementById("txtSubProjectSequence").value=0;
                          		 document.getElementById("txtCategorySequence").value=0;
                          		document.getElementById("txtProcessOwnerSequence").value=0;
                          		document.getElementById("txtLeaderSequence").value=0;
                          		 document.getElementById("txtFrequencySequence").value=0;
                          		 
                          		  document.getElementById("txtClientID").value='All';
                          		  document.getElementById("txtProcessownerID").value='All';
                          		  document.getElementById("txtCategoryID").value='All';
                          	     document.getElementById("txtSubProjectID").value='All';
                          		  document.getElementById("txtTag").value='All';
                          		  document.getElementById("txtFrequency").value='All';
                          		  document.getElementById("txtProjectID").value='All';
                          				
                          				
                          		 // LoadFilterItems();
                          		 // document.getElementById("cmbClient").selectedIndex = 1;
                          		 // alert(1); 
                          		  $('.selectpicker').selectpicker('deselectAll');
                          		  LoadFilterItems();
                          		  LoadTask(); 
                          	
                          }
                           
                          function LoadFilterItems()
                          {
                          				var SelectedCompany = document.getElementById("txtClientID").value;
                          				var SelectedProcessOwner = document.getElementById("txtProcessownerID").value;
                          				var SelectedWorkCategory = document.getElementById("txtCategoryID").value;
                          				var SelectedSubProject = document.getElementById("txtSubProjectID").value;
                          				var SelectedTags = document.getElementById("txtTag").value;
                          				var Frequency = document.getElementById("txtFrequency").value;
                          				var SelectedProject = document.getElementById("txtProjectID").value;
                          				
                          				
                          				var OverallSequenceNo = Number(document.getElementById("txtTotalFilterSequence").value);
                          				var ClientSequence = Number(document.getElementById("txtClientSequence").value);
                          				var ProjectSequence = Number(document.getElementById("txtProjectSequence").value);
                          				var SubProjectSequence = Number(document.getElementById("txtSubProjectSequence").value);
                          				var CategorySequence = Number(document.getElementById("txtCategorySequence").value);
                          				var ProcessOwnerSequence = Number(document.getElementById("txtProcessOwnerSequence").value);
                          				var LeaderSequence = Number(document.getElementById("txtLeaderSequence").value);
                          				var FrequencySequence = Number(document.getElementById("txtFrequencySequence").value);
                          				
                          				if (ClientSequence < OverallSequenceNo && ClientSequence==0)
                          				{
                          									document.getElementById("txtClientSequence").value=0;
                          				}
                          				if (ProjectSequence < OverallSequenceNo && ProjectSequence==0)
                          				{
                          									document.getElementById("txtProjectSequence").value=0;
                          				}
                          				if (SubProjectSequence < OverallSequenceNo && SubProjectSequence==0)
                          				{
                          									document.getElementById("txtSubProjectSequence").value=0;
                          				}
                          				if (CategorySequence < OverallSequenceNo && CategorySequence==0)
                          				{
                          									document.getElementById("txtCategorySequence").value=0;
                          				}
                          				if (ProcessOwnerSequence < OverallSequenceNo && ProcessOwnerSequence==0)
                          				{
                          									document.getElementById("txtProcessOwnerSequence").value=0;
                          				}
                          				if (LeaderSequence < OverallSequenceNo && LeaderSequence==0)
                          				{
                          									document.getElementById("txtLeaderSequence").value=0;
                          				}
                          				if (FrequencySequence < OverallSequenceNo  && FrequencySequence==0)
                          				{
                          									document.getElementById("txtFrequencySequence").value=0;
                          				}
                          				
                          				 
                             
                          				
                          				if (ClientSequence > OverallSequenceNo)
                          				{
                          									document.getElementById("txtClientSequence").value=0;
                          									document.getElementById("txtClientID").value='All';
                          									
                          				}
                          				if (ProjectSequence > OverallSequenceNo)
                          				{
                          									document.getElementById("txtProjectSequence").value=0;
                          									document.getElementById("txtProjectID").value='All';
                          									 
                          				}
                          				if (SubProjectSequence > OverallSequenceNo)
                          				{
                          									document.getElementById("txtSubProjectSequence").value=0;
                          									document.getElementById("txtSubProjectID").value='All';
                          									  
                          				}
                          				if (CategorySequence > OverallSequenceNo)
                          				{
                          									document.getElementById("txtCategorySequence").value=0;
                          									document.getElementById("txtCategoryID").value='All';
                          									 
                          				}
                          				if (ProcessOwnerSequence > OverallSequenceNo)
                          				{
                          									document.getElementById("txtProcessOwnerSequence").value=0;
                          									document.getElementById("txtProcessownerID").value='All';
                          									 
                          				}
                          				if (LeaderSequence > OverallSequenceNo)
                          				{
                          									document.getElementById("txtLeaderSequence").value=0;
                          									document.getElementById("txtLeaderID").value='All';
                          				}
                          				if (FrequencySequence > OverallSequenceNo)
                          				{
                          									document.getElementById("txtFrequencySequence").value=0;
                          									document.getElementById("txtFrequency").value='All';
                          									 
                          				}
                            
                           
                          				if (document.getElementById("txtClientSequence").value==0)
                          				{
                          					 
                          					LoadClientFilter();
                          				}
                          				else
                          				{
                          						// alert("No Cliett");
                          				}
                          				
                          				if (document.getElementById("txtProjectSequence").value==0)
                          				{
                          					 
                          					LoadProjectFilter();
                          				}
                          				else
                          				{
                          					 
                          				}
                          				
                          				if (document.getElementById("txtSubProjectSequence").value==0)
                          				{
                          					 
                          					LoadSubProjectFilter();
                          				}
                          				else
                          				{
                          					 
                          				}
                          				
                          				if (document.getElementById("txtCategorySequence").value==0)
                          				{
                          					 
                          					LoadCategoryFilter();
                          				}
                          				else
                          				{
                          					 
                          				}
                          				
                          				if (document.getElementById("txtProcessOwnerSequence").value==0)
                          				{
                          					 
                          					LoadProcessownerFilter();
                          				}
                          				else
                          				{
                          					 
                          				}
                          				
                          				if (document.getElementById("txtLeaderSequence").value==0)
                          				{
                          					 
                          					
                          				}
                          				else
                          				{
                          					 
                          				}
                          				
                          				if (document.getElementById("txtFrequencySequence").value==0)
                          				{
                          					 
                          					LoadFrequencyFilter();
                          				}
                          				else
                          				{
                          					 
                          				}
                          				
                          				// if (SelectedCompany=='All')
                          				// {
                          				     
                          					// LoadClientFilter();
                          					// alert("Client");
                          				// }
                          				// if (SelectedProject=='All')
                          				// {
                          					// LoadProjectFilter();
                          					// alert("Project");
                          				// }
                          				// if (SelectedSubProject=='All')
                          				// {
                          					// LoadSubProjectFilter();
                          					// alert("Sub Project");
                          				// }
                          				// if (SelectedWorkCategory=='All')
                          				// {
                          					// LoadCategoryFilter();
                          					// alert("Category");
                          				// }
                          				// if (SelectedProcessOwner=='All')
                          				// {
                          					// LoadProcessownerFilter();
                          					// alert("ProcessOwner");
                          				// }
                          				 
                          				// if (Frequency=='All')
                          				// {
                          					// LoadFrequencyFilter();
                          					// alert("Frequency");
                          				// }
                          								
                          }
                          
                          
                          function LoadClientFilter()
                          {
                          				var SelectedCompany = document.getElementById("txtClientID").value;
                          				var SelectedProcessOwner = document.getElementById("txtProcessownerID").value;
                          				var SelectedWorkCategory = document.getElementById("txtCategoryID").value;
                          				var SelectedSubProject = document.getElementById("txtSubProjectID").value;
                          				var SelectedTags = document.getElementById("txtTag").value;
                          				var Frequency = document.getElementById("txtFrequency").value;
                          				var SelectedProject = document.getElementById("txtProjectID").value;
                          				var TaskType = document.querySelector('input[name="rdRoutineProjectSelection"]:checked').value;
                          				
                          				 
                          				 var ProjectStage= document.getElementById("txtProjectStage").value; 
                          				  if($("#chkIncludeCompletedTask").is(':checked'))
                                                                    {
                                                                      var IncludeCompletedTask = 'Yes';
                                                                    }else{
                                                                      var IncludeCompletedTask = 'No';
                                                                    }
                          				  if($("#chkWithOverdue").is(':checked'))
                                                                    {
                                                                      var IncludeOverDueTask = 'Yes';
                                                                    }else{
                                                                      var IncludeOverDueTask = 'No';
                                                                    }					  
                          				
                          				 var datas = "&Client="+encodeURIComponent(SelectedCompany)+ 
                          						 "&AssignedTo="+encodeURIComponent(SelectedProcessOwner)+
                          						 "&Category="+encodeURIComponent(SelectedWorkCategory)+
                          						 "&SubProjectId="+encodeURIComponent(SelectedSubProject)+
                          						 "&SelectedTags="+encodeURIComponent(SelectedTags)+
                          						 "&Recurrance="+Frequency+ 
                          						 "&IncludeCompletedTask="+IncludeCompletedTask+
                          						 "&IncludeOverDueTask="+IncludeOverDueTask+
                          						 "&ProjectStage="+ProjectStage+
                          						 "&ProjectId="+encodeURIComponent(SelectedProject)+
                          						 "&TaskType="+encodeURIComponent(TaskType);			 
                          						  
                          $.ajax
                          ({
                          type: "POST",
                          url: "LoadClientFilter.php",
                          data: datas,
                          success: function(response)
                          { 	 
                          // document.getElementById("txtQueryCheck").value = response;
                            $("#DivLoadClientFilter").html(response);  
                          } 
                          });
                          }
                          
                          function LoadProcessownerFilter()
                          {
                          				var SelectedCompany = document.getElementById("txtClientID").value;
                          				var SelectedProcessOwner = document.getElementById("txtProcessownerID").value;
                          				var SelectedWorkCategory = document.getElementById("txtCategoryID").value;
                          				var SelectedSubProject = document.getElementById("txtSubProjectID").value;
                          				var SelectedTags = document.getElementById("txtTag").value;
                          				var Frequency = document.getElementById("txtFrequency").value;
                          				var SelectedProject = document.getElementById("txtProjectID").value;
                          				var TaskType = document.querySelector('input[name="rdRoutineProjectSelection"]:checked').value;
                          				
                          				 
                          				 var ProjectStage= document.getElementById("txtProjectStage").value; 
                          					  if($("#chkIncludeCompletedTask").is(':checked'))
                                                                    {
                                                                      var IncludeCompletedTask = 'Yes';
                                                                    }else{
                                                                      var IncludeCompletedTask = 'No';
                                                                    }			
                          						 if($("#chkWithOverdue").is(':checked'))
                                                                    {
                                                                      var IncludeOverDueTask = 'Yes';
                                                                    }else{
                                                                      var IncludeOverDueTask = 'No';
                                                                    }
                          				
                          				 var datas = "&Client="+encodeURIComponent(SelectedCompany)+ 
                          						 "&AssignedTo="+encodeURIComponent(SelectedProcessOwner)+
                          						 "&Category="+encodeURIComponent(SelectedWorkCategory)+
                          						 "&SubProjectId="+encodeURIComponent(SelectedSubProject)+
                          						 "&SelectedTags="+encodeURIComponent(SelectedTags)+
                          						 "&Recurrance="+Frequency+ 
                          						 "&IncludeCompletedTask="+IncludeCompletedTask+
                          						 "&IncludeOverDueTask="+IncludeOverDueTask+
                          						 "&ProjectStage="+ProjectStage+
                          						 "&ProjectId="+encodeURIComponent(SelectedProject)+
                          						 "&TaskType="+encodeURIComponent(TaskType);		
                          
                          // alert(datas);						 
                          $.ajax
                          ({
                          type: "POST",
                          url: "LoadProcessownerFilter.php",
                          data: datas,
                          success: function(response)
                          { 	 
                           // document.getElementById("txtQueryCheck").value = response;
                           
                            $("#DivLoadProcessownerFilter").html(response);  
                          } 
                          });
                          }
                          
                          function LoadCategoryFilter()
                          {
                          				var SelectedCompany = document.getElementById("txtClientID").value;
                          				var SelectedProcessOwner = document.getElementById("txtProcessownerID").value;
                          				var SelectedWorkCategory = document.getElementById("txtCategoryID").value;
                          				var SelectedSubProject = document.getElementById("txtSubProjectID").value;
                          				var SelectedTags = document.getElementById("txtTag").value;
                          				var Frequency = document.getElementById("txtFrequency").value;
                          				var SelectedProject = document.getElementById("txtProjectID").value;
                          				var TaskType = document.querySelector('input[name="rdRoutineProjectSelection"]:checked').value;
                          				
                          				  
                          				 var ProjectStage= document.getElementById("txtProjectStage").value; 
                          					  if($("#chkIncludeCompletedTask").is(':checked'))
                                                                    {
                                                                      var IncludeCompletedTask = 'Yes';
                                                                    }else{
                                                                      var IncludeCompletedTask = 'No';
                                                                    }	
                          					if($("#chkWithOverdue").is(':checked'))
                                                                    {
                                                                      var IncludeOverDueTask = 'Yes';
                                                                    }else{
                                                                      var IncludeOverDueTask = 'No';
                                                                    }
                          				
                          				 var datas = "&Client="+encodeURIComponent(SelectedCompany)+ 
                          						 "&AssignedTo="+encodeURIComponent(SelectedProcessOwner)+
                          						 "&Category="+encodeURIComponent(SelectedWorkCategory)+
                          						 "&SubProjectId="+encodeURIComponent(SelectedSubProject)+
                          						 "&SelectedTags="+encodeURIComponent(SelectedTags)+
                          						 "&Recurrance="+Frequency+ 
                          						 "&IncludeCompletedTask="+IncludeCompletedTask+
                          						 "&IncludeOverDueTask="+IncludeOverDueTask+
                          						 "&ProjectStage="+ProjectStage+
                          						 "&ProjectId="+encodeURIComponent(SelectedProject)+
                          						 "&TaskType="+encodeURIComponent(TaskType);			 
                          $.ajax
                          ({
                          type: "POST",
                          url: "LoadCategory.php",
                          data: datas,
                          success: function(response)
                          { 	 
                            $("#DivLoadCategoryFilter").html(response);  
                          } 
                          });
                          }
                          
                          function LoadProjectFilter()
                          {
                          				var SelectedCompany = document.getElementById("txtClientID").value;
                          				var SelectedProcessOwner = document.getElementById("txtProcessownerID").value;
                          				var SelectedWorkCategory = document.getElementById("txtCategoryID").value;
                          				var SelectedSubProject = document.getElementById("txtSubProjectID").value;
                          				var SelectedTags = document.getElementById("txtTag").value;
                          				var Frequency = document.getElementById("txtFrequency").value;
                          				var SelectedProject = document.getElementById("txtProjectID").value;
                          				var TaskType = document.querySelector('input[name="rdRoutineProjectSelection"]:checked').value;
                          				
                          				 
                          				 var ProjectStage= document.getElementById("txtProjectStage").value; 
                          					  if($("#chkIncludeCompletedTask").is(':checked'))
                                                                    {
                                                                      var IncludeCompletedTask = 'Yes';
                                                                    }else{
                                                                      var IncludeCompletedTask = 'No';
                                                                    }					   
                          						if($("#chkWithOverdue").is(':checked'))
                                                                    {
                                                                      var IncludeOverDueTask = 'Yes';
                                                                    }else{
                                                                      var IncludeOverDueTask = 'No';
                                                                    }
                          				 var datas = "&Client="+encodeURIComponent(SelectedCompany)+ 
                          						 "&AssignedTo="+encodeURIComponent(SelectedProcessOwner)+
                          						 "&Category="+encodeURIComponent(SelectedWorkCategory)+
                          						 "&SubProjectId="+encodeURIComponent(SelectedSubProject)+
                          						 "&SelectedTags="+encodeURIComponent(SelectedTags)+
                          						 "&Recurrance="+Frequency+ 
                          						 "&IncludeCompletedTask="+IncludeCompletedTask+
                          						 "&IncludeOverDueTask="+IncludeOverDueTask+
                          						 "&ProjectStage="+ProjectStage+
                          						 "&ProjectId="+encodeURIComponent(SelectedProject)+
                          						 "&TaskType="+encodeURIComponent(TaskType);		
                          //alert(datas);						 
                          $.ajax
                          ({
                          type: "POST",
                          url: "LoadProjectFilter.php",
                          data: datas,
                          success: function(response)
                          { 	 
                            $("#DivLoadProjectFilter").html(response);  
                          } 
                          });
                          }
                          
                          
                          
                          function LoadSubProjectFilter()
                          {
                          				var SelectedCompany = document.getElementById("txtClientID").value;
                          				var SelectedProcessOwner = document.getElementById("txtProcessownerID").value;
                          				var SelectedWorkCategory = document.getElementById("txtCategoryID").value;
                          				var SelectedSubProject = document.getElementById("txtSubProjectID").value;
                          				var SelectedTags = document.getElementById("txtTag").value;
                          				var Frequency = document.getElementById("txtFrequency").value;
                          				var SelectedProject = document.getElementById("txtProjectID").value;
                          				var TaskType = document.querySelector('input[name="rdRoutineProjectSelection"]:checked').value;
                          				
                          				 
                          				 var ProjectStage= document.getElementById("txtProjectStage").value; 
                          					  if($("#chkIncludeCompletedTask").is(':checked'))
                                                                    {
                                                                      var IncludeCompletedTask = 'Yes';
                                                                    }else{
                                                                      var IncludeCompletedTask = 'No';
                                                                    }					   
                          						if($("#chkWithOverdue").is(':checked'))
                                                                    {
                                                                      var IncludeOverDueTask = 'Yes';
                                                                    }else{
                                                                      var IncludeOverDueTask = 'No';
                                                                    }
                          										  
                          				 var datas = "&Client="+encodeURIComponent(SelectedCompany)+ 
                          						 "&AssignedTo="+encodeURIComponent(SelectedProcessOwner)+
                          						 "&Category="+encodeURIComponent(SelectedWorkCategory)+
                          						 "&SubProjectId="+encodeURIComponent(SelectedSubProject)+
                          						 "&SelectedTags="+encodeURIComponent(SelectedTags)+
                          						 "&Recurrance="+Frequency+ 
                          						 "&IncludeCompletedTask="+IncludeCompletedTask+
                          						 "&IncludeOverDueTask="+IncludeOverDueTask+
                          						 "&ProjectStage="+ProjectStage+
                          						 "&ProjectId="+encodeURIComponent(SelectedProject)+
                          						 "&TaskType="+encodeURIComponent(TaskType);		 
                          $.ajax
                          ({
                          type: "POST",
                          url: "LoadSubProjectFilter.php",
                          data: datas,
                          success: function(response)
                          { 	 
                            $("#DivLoadSubProjectFilter").html(response);  
                          } 
                          });
                          }
                          
                          
                          function LoadFrequencyFilter()
                          {
                          				var SelectedCompany = document.getElementById("txtClientID").value;
                          				var SelectedProcessOwner = document.getElementById("txtProcessownerID").value;
                          				var SelectedWorkCategory = document.getElementById("txtCategoryID").value;
                          				var SelectedSubProject = document.getElementById("txtSubProjectID").value;
                          				var SelectedTags = document.getElementById("txtTag").value;
                          				var Frequency = document.getElementById("txtFrequency").value;
                          				var SelectedProject = document.getElementById("txtProjectID").value;
                          				var TaskType = document.querySelector('input[name="rdRoutineProjectSelection"]:checked').value;
                          				
                          				 
                          				 var ProjectStage= document.getElementById("txtProjectStage").value; 
                          					  if($("#chkIncludeCompletedTask").is(':checked'))
                                                                    {
                                                                      var IncludeCompletedTask = 'Yes';
                                                                    }else{
                                                                      var IncludeCompletedTask = 'No';
                                                                    }					   
                          						if($("#chkWithOverdue").is(':checked'))
                                                                    {
                                                                      var IncludeOverDueTask = 'Yes';
                                                                    }else{
                                                                      var IncludeOverDueTask = 'No';
                                                                    }
                          				 var datas = "&Client="+encodeURIComponent(SelectedCompany)+ 
                          						 "&AssignedTo="+encodeURIComponent(SelectedProcessOwner)+
                          						 "&Category="+encodeURIComponent(SelectedWorkCategory)+
                          						 "&SubProjectId="+encodeURIComponent(SelectedSubProject)+
                          						 "&SelectedTags="+encodeURIComponent(SelectedTags)+
                          						 "&Recurrance="+Frequency+ 
                          						 "&IncludeCompletedTask="+IncludeCompletedTask+
                          						 "&IncludeOverDueTask="+IncludeOverDueTask+
                          						 "&ProjectStage="+ProjectStage+
                          						 "&ProjectId="+encodeURIComponent(SelectedProject)+
                          						 "&TaskType="+encodeURIComponent(TaskType);		
                          $.ajax
                          ({
                          type: "POST",
                          url: "LoadFrequencyFilter.php",
                          data: datas,
                          success: function(response)
                          { 	 
                            $("#DivLoadFrequencyFilter").html(response);  
                          } 
                          });
                          }
                           
                                                                     
                                                                     
                                                                     			 
                          function LoadSummaryData_Initial()
                                                                    {  
                                                                    
                                                                     var Frequency="All";
                          										   var SelectedCompany="All";
                          										   var SelectedLeadBy="All";
                          										   var SelectedProcessOwner="All";
                          										   var SelectedWorkCategory="All";
                          										   var SelectedSubProject="All";
                          										   var SelectedTags="";
                          										   var IncludeCompletedTask = 'No';
                          										     	 var IncludeOverDueTask = 'Yes';
                          										   var SelectedProject="All";
                          										   var ProjectStage= document.getElementById("cmbProjectStageSummary").value; 
                                                                     var SummaryFilter = document.querySelector('input[name="rdReportSelection"]:checked').value;
                          										   var CommitedStatus = 'All';
                          											var HoldStatus = 'All';
                          											var TaskType = document.querySelector('input[name="rdRoutineProjectSelection"]:checked').value;
                          											  
                          											  var CommitedStatusAll =$('#swCommitedAll').prop('checked')
                          											  var CommitedStatusNo =$('#swCommitedNo').prop('checked')
                          											  var CommitedStatusYes =$('#swCommitedYes').prop('checked')
                          											  var OnHoldAll =$('#OnHoldAll').prop('checked')
                          											  var OnHoldNo =$('#OnHoldNo').prop('checked')
                          											  var OnHoldYes =$('#OnHoldYes').prop('checked')
                          											   
                          											  if (CommitedStatusAll==true)
                          											  {
                          												  CommitedStatus='All';
                          											  }
                          											  else if (CommitedStatusYes==true)
                          											  {
                          												  CommitedStatus='1';
                          											  }
                          											  else if (CommitedStatusNo==true)
                          											  {
                          												  CommitedStatus='0';
                          											  } 
                          											  
                          											  if (OnHoldAll==true)
                          											  {
                          												  HoldStatus='All';
                          											  }
                          											  else if (OnHoldYes==true)
                          											  {
                          												  HoldStatus='1';
                          											  }
                          											  else if (OnHoldNo==true)
                          											  {
                          												  HoldStatus='0';
                          											  }
                          												
                          											 
                          												
                          											if (ProjectStage=="0")
                          											{
                          												ProjectStage="%";
                          											}
                          											 
                          												  
                                                                     var view = "view";
                                                                     var FilterPeriod = document.getElementById("txtPeriod").value;// $("#txtperiod").val();  
                          											 
                          											 if (SummaryFilter=="Summary")
                          	 {
                          		FilterPeriod="All";
                          		IncludeCompletedTask='No';
                          	 }
                          	 else
                          	 {
                          		 FilterPeriod=FilterPeriod;
                          	 } 
                          	 
							 var CustomDate = '2019/01/01';
                          											
                          											//document.getElementById("txtperiod").value;
                           var datas = "&FilterPeriod="+FilterPeriod+
                                                                    			 "&Company="+encodeURIComponent(SelectedCompany)+
                                                                    			 "&LeadBy="+encodeURIComponent(SelectedLeadBy)+
                                                                    			 "&ProcessOwner="+encodeURIComponent(SelectedProcessOwner)+
                                                                    			 "&WorkCategory="+encodeURIComponent(SelectedWorkCategory)+
                                                                    			 "&SelectedSubProject="+encodeURIComponent(SelectedSubProject)+
                                                                    			 "&SelectedTags="+encodeURIComponent(SelectedTags)+
                                                                    			 "&Frequency="+Frequency+
                                                                    			 "&ProjectStage="+ProjectStage+
                                                                    			 "&IncludeCompletedTask="+IncludeCompletedTask+
                                                                    			 "&IncludeOverDueTask="+IncludeOverDueTask+
                                                                    			 "&CommitedStatus="+CommitedStatus+
                                                                    			 "&HoldStatus="+HoldStatus+
																				  "&CustomDate="+CustomDate+
                                                                    			 "&Project="+encodeURIComponent(SelectedProject)+
                          													 "&TaskType="+encodeURIComponent(TaskType);
                          													 
                                                                  
                                                                    // alert(datas);
                                                                     $.ajax({
                                                                      method: 'post',
                                                                      url:"LoadSummaryDetailsAG.php",
                                                                      data:datas,
                                                                       dataType: "json",
                                                                      success:function(response)
                                                                      {
                          												 
                          												  // document.getElementById("txtQueryCheck").value = response; 
                          												
                                                                       console.log(response);
                                                                     
                                                                        $("#SummaryCompany").text(response[0]['Company']);
                                                                        $("#SummaryTask").text(response[0]['Task']);
                                                                        $("#SummaryProcessOwner").text(response[0]['ProcessOwner']);
                                                                        $("#SummaryLeaders").text(response[0]['TotalLeader']);
                                                                        $("#SummaryEventDays").text(response[0]['TotalDays']);
                                                                        $("#SummaryMonth").text(response[0]['TotalMonth']);
                                                                       
                                                                    	 $("#SummaryProject").text(response[0]['TotalProject']);
                                                                    	 $("#SummaryWorkCount").text(response[0]['TotalCategory']);
                                                                    	 $("#SummarySubProject").text(response[0]['TotalSubProject']);
                                                                      
                                                                      }
                                                                     });
                                                                    }
                          										  
                          										   
                          										  
                          										  
                          										  function GetClientID()
                          										  {
                          											  var OverallSequenceNo = Number(document.getElementById("txtTotalFilterSequence").value);
                          											   
                          											  var Company=document.getElementById("cmbClient");
                                                                     var Arr_Company = []; 
                                                                         for (var i = 0; i < Company.options.length; i++) {
                                                                    	  
                                                                            if(Company.options[i].selected ==true){
                                                                    		  
                                                                                 // alert("'" + x.options[i].value + "'" );
                                                                    		  Arr_Company.push(Company.options[i].value);
                                                                    		    
                                                                             }
                                                                         }
                                                                      var SelectedCompany = "'" + Arr_Company.join("','")+ "'"
                          											//alert(SelectedCompany); 
                          										   var ClientSequence = Number(document.getElementById("txtClientSequence").value);
                          											if (SelectedCompany=="''")
                          											{
                          												document.getElementById("txtClientID").value= 'All';
                          											
                          												OverallSequenceNo=ClientSequence-1;
                          												document.getElementById("txtTotalFilterSequence").value=OverallSequenceNo;
                          												document.getElementById("txtClientSequence").value = 0; 
                          											}
                          											else
                          											{
                          												document.getElementById("txtClientID").value= SelectedCompany;
                          												if (ClientSequence<=0)
                          												{
                          												 document.getElementById("txtClientSequence").value =  OverallSequenceNo +1;
                          												document.getElementById("txtTotalFilterSequence").value =  OverallSequenceNo +1;
                          												} 
                          											} 
                          											LoadFilterItems();
                          										  }
                          										  
                          										    function GetProjectID()
                          										  {
                          											var OverallSequenceNo =Number(document.getElementById("txtTotalFilterSequence").value);
                                                                      var Project=document.getElementById("cmbProject");
                                                                     var Arr_Project = []; 
                                                                         for (var i = 0; i < Project.options.length; i++) {
                                                                    	  
                                                                            if(Project.options[i].selected ==true){ 
                                                                    		  Arr_Project.push(Project.options[i].value);
                                                                    		    
                                                                             }
                                                                         }
                                                                      var SelectedProject = "'" + Arr_Project.join("','")+ "'" 
                          											 var ProjectSequence = Number(document.getElementById("txtProjectSequence").value);
                          											
                          											if (SelectedProject=="''")
                          											{
                          												document.getElementById("txtProjectID").value= 'All';
                          												
                          												OverallSequenceNo=ProjectSequence-1;
                          												document.getElementById("txtTotalFilterSequence").value=OverallSequenceNo;
                          												document.getElementById("txtProjectSequence").value = 0; 
                          											}
                          											else
                          											{
                          												document.getElementById("txtProjectID").value= SelectedProject;
                          												if (ProjectSequence<=0)
                          												{
                          												 document.getElementById("txtProjectSequence").value =  OverallSequenceNo +1;
                          												document.getElementById("txtTotalFilterSequence").value =  OverallSequenceNo +1;
                          												} 
                          											}
                          											LoadFilterItems();
                          										  }
                          										  
                          										  function GetSubProjectID()
                          											{
                          												var OverallSequenceNo =Number(document.getElementById("txtTotalFilterSequence").value);
                          												 var SubProject=document.getElementById("cmbSubProject");
                                                                     var Arr_SubProject = []; 
                                                                         for (var i = 0; i < SubProject.options.length; i++) {
                                                                    	  
                                                                            if(SubProject.options[i].selected ==true){ 
                                                                    		  Arr_SubProject.push(SubProject.options[i].value);
                                                                    		    
                                                                             }
                                                                         }
                                                                      var SelectedSubProject = "'" + Arr_SubProject.join("','")+ "'" 
                          											 var SubProjectSequence = Number(document.getElementById("txtSubProjectSequence").value);
                          											
                          											if (SelectedSubProject=="''")
                          											{
                          												// alert(1);
                          												document.getElementById("txtSubProjectID").value= 'All';
                          												OverallSequenceNo=SubProjectSequence-1;
                          												document.getElementById("txtTotalFilterSequence").value=OverallSequenceNo;
                          												document.getElementById("txtSubProjectSequence").value = 0; 
                          											}
                          											else
                          											{
                          												// alert(2);
                          												document.getElementById("txtSubProjectID").value= SelectedSubProject;
                          												if (SubProjectSequence<=0)
                          												{
                          												 document.getElementById("txtSubProjectSequence").value =  OverallSequenceNo +1;
                          												document.getElementById("txtTotalFilterSequence").value =  OverallSequenceNo +1;
                          												} 
                          											}
                          											LoadFilterItems();
                          											}
                          										   function GetProcessOwnerID()
                          										  {
                          											   var OverallSequenceNo =Number(document.getElementById("txtTotalFilterSequence").value);
                          											   
                          											 var ProcessOwner=document.getElementById("cmbProcessOwner");
                                                                     var Arr_cmbProcessOwner = []; 
                                                                         for (var i = 0; i < ProcessOwner.options.length; i++) {
                                                                    	  
                                                                            if(ProcessOwner.options[i].selected ==true){
                                                                    		  
                                                                                 // alert("'" + x.options[i].value + "'" );
                                                                    		  Arr_cmbProcessOwner.push(ProcessOwner.options[i].value);
                                                                    		    
                                                                             }
                                                                         }
                                                                      var SelectedProcessOwner = "'" + Arr_cmbProcessOwner.join("','")+ "'"
                          											 var ProcessOwnerSequence = Number(document.getElementById("txtProcessOwnerSequence").value);
                          											if (SelectedProcessOwner=="''")
                          											{
                          												document.getElementById("txtProcessownerID").value= 'All';
                          												OverallSequenceNo=ProcessOwnerSequence-1;
                          												document.getElementById("txtTotalFilterSequence").value=OverallSequenceNo;
                          												document.getElementById("txtProcessOwnerSequence").value = 0; 
                          											}
                          											else
                          											{
                          												document.getElementById("txtProcessownerID").value= SelectedProcessOwner;
                          												if (ProcessOwnerSequence<=0)
                          												{
                          												 document.getElementById("txtProcessOwnerSequence").value =  OverallSequenceNo +1;
                          												document.getElementById("txtTotalFilterSequence").value =  OverallSequenceNo +1;
                          												} 
                          											}
                          											 	LoadFilterItems();
                          										  }
                          										  
                          										   function GetCategoryID()
                          										  {
                          											 var OverallSequenceNo =Number(document.getElementById("txtTotalFilterSequence").value);
                          										   var WorkCategory=document.getElementById("cmbCategory");
                                                                     var Arr_WorkCategory = []; 
                                                                         for (var i = 0; i < WorkCategory.options.length; i++) {
                                                                    	  
                                                                            if(WorkCategory.options[i].selected ==true){
                                                                    		  
                                                                                 // alert("'" + x.options[i].value + "'" );
                                                                    		  Arr_WorkCategory.push(WorkCategory.options[i].value);
                                                                    		    
                                                                             }
                                                                         }
                                                                      var SelectedWorkCategory = "'" + Arr_WorkCategory.join("','")+ "'" 
                          											 var CategorySequence = Number(document.getElementById("txtCategorySequence").value);
                          											if (SelectedWorkCategory=="''")
                          											{
                          												document.getElementById("txtCategoryID").value= 'All';
                          												OverallSequenceNo=CategorySequence-1;
                          												document.getElementById("txtTotalFilterSequence").value=OverallSequenceNo;
                          												document.getElementById("txtCategorySequence").value = 0; 
                          												
                          											}
                          											else
                          											{
                          												document.getElementById("txtCategoryID").value= SelectedWorkCategory;
                          												if (CategorySequence<=0)
                          												{
                          												 document.getElementById("txtCategorySequence").value =  OverallSequenceNo +1;
                          												document.getElementById("txtTotalFilterSequence").value =  OverallSequenceNo +1;
                          												}
                          												
                          											}
                          												LoadFilterItems();
                          										  }
                          										  
                          										  function GetFrequency()
                          											{
                          												 var OverallSequenceNo =Number(document.getElementById("txtTotalFilterSequence").value);
                          											
                          											var Frequency=document.getElementById("cmbFrequency");
                                                                     var Arr_Frequency = []; 
                                                                         for (var i = 0; i < Frequency.options.length; i++) {
                                                                    	  
                                                                            if(Frequency.options[i].selected ==true){
                                                                    		  
                                                                                 // alert("'" + x.options[i].value + "'" );
                                                                    		  Arr_Frequency.push(Frequency.options[i].value);
                                                                    		    
                                                                             }
                                                                         }
                                                                      var SelectedFrequency = "'" + Arr_Frequency.join("','")+ "'" 
                          											
                          											 var CategorySequence = Number(document.getElementById("txtFrequencySequence").value);
                          											if (SelectedFrequency=="''")
                          											{
                          												document.getElementById("txtFrequency").value= 'All';
                          												OverallSequenceNo=CategorySequence-1;
                          												document.getElementById("txtTotalFilterSequence").value=OverallSequenceNo;
                          												document.getElementById("txtFrequencySequence").value = 0; 
                          												
                          											}
                          											else
                          											{
                          												document.getElementById("txtFrequency").value= SelectedFrequency;
                          												if (CategorySequence<=0)
                          												{
                          												 document.getElementById("txtFrequencySequence").value =  OverallSequenceNo +1;
                          												document.getElementById("txtTotalFilterSequence").value =  OverallSequenceNo +1;
                          												}
                          												
                          											}
                          												LoadFilterItems();
                          											}
                            
                          										
                          										  
                           											
                          											
                          											function GetTag()
                          											{
                          												var Tag=document.getElementById("cmbTag");
                                                                     var Arr_Tag = []; 
                                                                         for (var i = 0; i < Tag.options.length; i++) {
                                                                    	  
                                                                            if(Tag.options[i].selected ==true){
                                                                    		  
                                                                                 // alert("'" + x.options[i].value + "'" );
                                                                    		  Arr_Tag.push(Tag.options[i].value);
                                                                    		    
                                                                             }
                                                                         }
                                                                      var SelectedTags = "" + Arr_Tag.join(",")+ ""
                          											document.getElementById("txtTag").value= SelectedTags;
                          											
                          											}
                          											
                          											
                          											function GetLeaderID()
                          											{
                          												 var OverallSequenceNo =Number(document.getElementById("txtTotalFilterSequence").value);
                          												 
                          											var LeadBy=document.getElementById("cmbLeadBy");
                                                                     var Arr_LeadBy = []; 
                                                                         for (var i = 0; i < LeadBy.options.length; i++) {
                                                                    	  
                                                                            if(LeadBy.options[i].selected ==true){
                                                                    		  
                                                                                 // alert("'" + x.options[i].value + "'" );
                                                                    		  Arr_LeadBy.push(LeadBy.options[i].value);
                                                                    		    
                                                                             }
                                                                         }
                                                                      var SelectedLeadBy = "'" + Arr_LeadBy.join("','")+ "'"
                          											
                          											document.getElementById("txtLeaderID").value= SelectedLeadBy; 
                          											
                          											}
                          											
                          											
                          											
                          											function GetProjectStatge()
                          											{
                          												 var ProjectStage= document.getElementById("cmbProjectStage").value;   
                          												 document.getElementById("txtProjectStage").value= ProjectStage;
                          												 LoadFilterItems();
                          											}
                          											
                          											
                          											
                          											
                          											function GetProjectStatgeSummary()
                          											{
                          												 var ProjectStage= document.getElementById("cmbProjectStageSummary").value;   
                          												 document.getElementById("txtProjectStageSummary").value= ProjectStage;
                          												 LoadFilterItems();
                          											}
                          											
                          											
																	function GetCustomDate()
																	{
																	var CustomDate =  document.getElementById("dtCustomDate").value;
																	//var CustomDate = "03-11-2014";
																	var newdate = CustomDate.split("-").reverse().join("-");
																	alert(newdate);
																	}
																	
																	
                          										  
                          										   function LoadTask()
                                                                    {
                          											  
                                                                     document.getElementById("TaskDescrtiption").value=''; 
                                                                     document.getElementById("TaskDescrtiption").select();
                                                                     document.getElementById("TaskDescrtiption").focus(); 
                                                                     
                                                                      
                                                                     if($("#chkIncludeCompletedTask").is(':checked'))
                                                                    {
                                                                      var IncludeCompletedTask = 'Yes';
                                                                    }else{
                                                                      var IncludeCompletedTask = 'No';
                                                                    }
                                                                    
                          										  if($("#chkWithOverdue").is(':checked'))
                                                                    {
                                                                      var IncludeOverDueTask = 'Yes';
                                                                    }else{
                                                                      var IncludeOverDueTask = 'No';
                                                                    }
                          										 
                                                                     var view = "view";
                                                                     var FilterPeriod = document.getElementById("txtPeriod").value;// $("#txtperiod").val(); 
                          					  var TaskType = document.querySelector('input[name="rdRoutineProjectSelection"]:checked').value;
                          										 
                          										 
                          											var SelectedCompany = document.getElementById("txtClientID").value;
                          											var SelectedLeadBy = document.getElementById("txtLeaderID").value;
                          											var SelectedProcessOwner = document.getElementById("txtProcessownerID").value;
                          											var SelectedSubProject = document.getElementById("txtSubProjectID").value;
                          											var SelectedWorkCategory = document.getElementById("txtCategoryID").value;
                          											var ProjectStage = document.getElementById("txtProjectStage").value;
                          											var SelectedTags = document.getElementById("txtTag").value;
                          											var Frequency = document.getElementById("txtFrequency").value;
                          											var SelectedProject = document.getElementById("txtProjectID").value;
                          											var CommitedStatus = 'All';
                          											var HoldStatus = 'All';
                          											var CustomDate =  document.getElementById("dtCustomDate").value;
                          											 
																	
																	


                          											  var CommitedStatusAll =$('#swCommitedAll').prop('checked')
                          											  var CommitedStatusNo =$('#swCommitedNo').prop('checked')
                          											  var CommitedStatusYes =$('#swCommitedYes').prop('checked')
                          											  var OnHoldAll =$('#OnHoldAll').prop('checked')
                          											  var OnHoldNo =$('#OnHoldNo').prop('checked')
                          											  var OnHoldYes =$('#OnHoldYes').prop('checked')
                          											   
                          											  if (CommitedStatusAll==true)
                          											  {
                          												  CommitedStatus='All';
                          											  }
                          											  else if (CommitedStatusYes==true)
                          											  {
                          												  CommitedStatus='1';
                          											  }
                          											  else if (CommitedStatusNo==true)
                          											  {
                          												  CommitedStatus='0';
                          											  } 
                          											  
                          											  if (OnHoldAll==true)
                          											  {
                          												  HoldStatus='All';
                          											  }
                          											  else if (OnHoldYes==true)
                          											  {
                          												  HoldStatus='1';
                          											  }
                          											  else if (OnHoldNo==true)
                          											  {
                          												  HoldStatus='0';
                          											  }
																	  
																	  if (CustomDate=="")
																	  {
																		  CustomDate = '2019/01/01';
																	  }
																	  else
																	  { 
																		  CustomDate = CustomDate.split("-").reverse().join("-");
																	  }
																	   
                          												
															
                          											
                                                                     var datas = "&FilterPeriod="+FilterPeriod+
                                                                    			 "&Company="+encodeURIComponent(SelectedCompany)+
                                                                    			 "&LeadBy="+encodeURIComponent(SelectedLeadBy)+
                                                                    			 "&ProcessOwner="+encodeURIComponent(SelectedProcessOwner)+
                                                                    			 "&WorkCategory="+encodeURIComponent(SelectedWorkCategory)+
                                                                    			 "&SelectedSubProject="+encodeURIComponent(SelectedSubProject)+
                                                                    			 "&SelectedTags="+encodeURIComponent(SelectedTags)+
                                                                    			 "&Frequency="+Frequency+
                                                                    			 "&ProjectStage="+ProjectStage+
                                                                    			 "&IncludeCompletedTask="+IncludeCompletedTask+
                                                                    			 "&IncludeOverDueTask="+IncludeOverDueTask+
                                                                    			 "&CommitedStatus="+CommitedStatus+
                                                                    			 "&HoldStatus="+HoldStatus+
																				 "&CustomDate="+CustomDate+
                                                                    			 "&Project="+encodeURIComponent(SelectedProject)+
                          													 "&TaskType="+encodeURIComponent(TaskType);
                          													 
                                                                   // alert("Load Task");
                                                                      // alert(datas);
                                                                     if (FilterPeriod!="Completed")
                                                                     {
                                                                     $.ajax({
                                                                      method: 'post',
                                                                      url:"LoadTaskAG.php",
                                                                      data:datas,
                                                                      success:function(response)
                                                                      {
                          												 
                                                                         //alert(response);
                                                                        // var ajaxDisplay = document.getElementById(divid);
                                                                            // ajaxDisplay.innerHTML = html;
                                                                    	 $( '#display_info' ).html(response);
                                                                      }
                                                                     });
                                                                     }
                                                                     else
                                                                     {
                                                                     
                                                                      $.ajax({
                                                                      method: 'post',
                                                                      url:"CompletedTaskAG.php",
                                                                      data:datas,
                                                                      success:function(response)
                                                                      {
                                                                        // var ajaxDisplay = document.getElementById(divid);
                                                                            // ajaxDisplay.innerHTML = html;
                                                                    	 $( '#display_info' ).html(response);
                                                                      }
                                                                     });
                                                                     
                                                                     
                                                                    }
                          										  // alert(1)
                                                                     LoadSummaryDetailsAG();
                          										 
                                                                    }
                          										  
                          										    function LoadSummaryDetailsAG()
                                                                    {
                          											  
                                                                       
                          											var SelectedCompany = document.getElementById("txtClientID").value;
                          											var SelectedLeadBy = document.getElementById("txtLeaderID").value;
                          											var SelectedProcessOwner = document.getElementById("txtProcessownerID").value;
                          											var SelectedSubProject = document.getElementById("txtSubProjectID").value;
                          											var SelectedWorkCategory = document.getElementById("txtCategoryID").value;
                          											var ProjectStage = document.getElementById("txtProjectStage").value;
                          											var SelectedTags = document.getElementById("txtTag").value;
                          											var Frequency = document.getElementById("txtFrequency").value;
                          											var SelectedProject = document.getElementById("txtProjectID").value;
                          											  var FilterPeriod = document.getElementById("txtPeriod").value;// $("#txtperiod").val(); 
																	  
																	  var CustomDate =  document.getElementById("dtCustomDate").value;
                          											
                                                                     var SummaryFilter = document.querySelector('input[name="rdReportSelection"]:checked').value;
                          										   var TaskType = document.querySelector('input[name="rdRoutineProjectSelection"]:checked').value;
                          										   
                          										     if($("#chkIncludeCompletedTask").is(':checked'))
                                                                    {
                                                                      var IncludeCompletedTask = 'Yes';
                                                                    }else{
                                                                      var IncludeCompletedTask = 'No';
                                                                    }
                          										  
                          										  if($("#chkWithOverdue").is(':checked'))
                                                                    {
                                                                      var IncludeOverDueTask = 'Yes';
                                                                    }else{
                                                                      var IncludeOverDueTask = 'No';
                                                                    }
                          										  
                          										  
                          										  
                          										  
                          											   if (SummaryFilter=="Summary")
                          	 {
                          		FilterPeriod="All";
                          		IncludeCompletedTask='Yes';
                          	 }
                          	 else
                          	 {
                          		 FilterPeriod=FilterPeriod;
                          	 } 
                          	 
                          	 var CommitedStatus = 'All';
                          											var HoldStatus = 'All';
                          											
                          											  
                          											  var CommitedStatusAll =$('#swCommitedAll').prop('checked')
                          											  var CommitedStatusNo =$('#swCommitedNo').prop('checked')
                          											  var CommitedStatusYes =$('#swCommitedYes').prop('checked')
                          											  var OnHoldAll =$('#OnHoldAll').prop('checked')
                          											  var OnHoldNo =$('#OnHoldNo').prop('checked')
                          											  var OnHoldYes =$('#OnHoldYes').prop('checked')
                          											   
                          											  if (CommitedStatusAll==true)
                          											  {
                          												  CommitedStatus='All';
                          											  }
                          											  else if (CommitedStatusYes==true)
                          											  {
                          												  CommitedStatus='1';
                          											  }
                          											  else if (CommitedStatusNo==true)
                          											  {
                          												  CommitedStatus='0';
                          											  } 
                          											  
                          											  if (OnHoldAll==true)
                          											  {
                          												  HoldStatus='All';
                          											  }
                          											  else if (OnHoldYes==true)
                          											  {
                          												  HoldStatus='1';
                          											  }
                          											  else if (OnHoldNo==true)
                          											  {
                          												  HoldStatus='0';
                          											  }
																	  
																	  if (CustomDate=="")
																	  {
																		  CustomDate = '2019/01/01';
																	  }
																	  else
																	  { 
																		  CustomDate = CustomDate.split("-").reverse().join("-");
																	  }
																	  
                          	 
                                                                       var datas = "&FilterPeriod="+FilterPeriod+
                                                                    			 "&Company="+encodeURIComponent(SelectedCompany)+
                                                                    			 "&LeadBy="+encodeURIComponent(SelectedLeadBy)+
                                                                    			 "&ProcessOwner="+encodeURIComponent(SelectedProcessOwner)+
                                                                    			 "&WorkCategory="+encodeURIComponent(SelectedWorkCategory)+
                                                                    			 "&SelectedSubProject="+encodeURIComponent(SelectedSubProject)+
                                                                    			 "&SelectedTags="+encodeURIComponent(SelectedTags)+
                                                                    			 "&Frequency="+Frequency+
                                                                    			 "&ProjectStage="+ProjectStage+
                          													  "&CommitedStatus="+CommitedStatus+
                                                                    			 "&HoldStatus="+HoldStatus+
																				  "&CustomDate="+CustomDate+
                                                                    			 "&IncludeCompletedTask="+IncludeCompletedTask+
                                                                    			 "&IncludeOverDueTask="+IncludeOverDueTask+
                                                                    			 "&Project="+encodeURIComponent(SelectedProject)+
                          													 "&TaskType="+encodeURIComponent(TaskType);
                          													  
                          											 // document.getElementById("txtQueryCheck").value = datas; 
                                                                     $.ajax({
                                                                      method: 'post',
                                                                      url:"LoadSummaryDetailsAG.php",
                                                                      data:datas,
                                                                       dataType: "json",
                                                                      success:function(response)
                                                                      {
                          												
                          												// document.getElementById("txtQueryCheck").value = response; 
                          												 
                                                                       console.log(response);
                          											 
                          								                                           
                                                                        $("#SummaryCompany").text(response[0]['Company']);
                          											 
                                                                        $("#SummaryTask").text(response[0]['Task']);
                                                                        $("#SummaryProcessOwner").text(response[0]['ProcessOwner']);
                                                                        $("#SummaryLeaders").text(response[0]['TotalLeader']);
                                                                        $("#SummaryEventDays").text(response[0]['TotalDays']);
                                                                        $("#SummaryMonth").text(response[0]['TotalMonth']);
                                                                       
                                                                    	 $("#SummaryProject").text(response[0]['TotalProject']);
                                                                    	 $("#SummaryWorkCount").text(response[0]['TotalCategory']);
                                                                    	 $("#SummarySubProject").text(response[0]['TotalSubProject']);
                                                                      
                                                                    
                                                                      }
                                                                     });
                                                                  
                                                                    }
                          										  
                                                                      
                                                                    function GetComments(x)
                                                                    {
                                                                     document.getElementById("txtSelectedRow").value = x.parentNode.rowIndex;
                                                                     var row = document.getElementById("txtSelectedRow").value;
                          										   
                          	   // document.getElementById("spnstatus").textContent=document.getElementById("indextable").rows[row].cells[3].innerHTML; 
                          	   // document.getElementById("txtTaskID").value= document.getElementById("indextable").rows[row].cells[0].innerHTML; 
                          	   // var  SelectedTaskID= document.getElementById("indextable").rows[row].cells[0].innerHTML;
                          
                          	   document.getElementById("spnstatus").textContent=document.getElementById("indextable").rows[row].cells.namedItem("tblTask").innerHTML;
                          	   document.getElementById("txtTaskID").value= document.getElementById("indextable").rows[row].cells.namedItem("tblTaskId").innerHTML;
                          	   var  SelectedTaskID= document.getElementById("indextable").rows[row].cells.namedItem("tblTaskId").innerHTML;
                          	   
                          	   //alert(SelectedTaskID);
                                                                     var FilterPeriod = document.getElementById("txtPeriod").value;// $("#txtperiod").val(); //document.getElementById("txtperiod").value; 
                                                                     var datas = "&FilterPeriod="+FilterPeriod+"&SelectedTaskID="+SelectedTaskID;
                                                                     
                                                                     $.ajax({
                                                                      method: 'post',
                                                                      url:"loadremarks.php",
                                                                      data:datas,
                                                                      success:function(response)
                                                                      {
                                                                        // var ajaxDisplay = document.getElementById(divid);
                                                                            // ajaxDisplay.innerHTML = html;
                                                                    	 $( '#display_comments' ).html(response);
                                                                      }
                                                                     });
                                                                     
                                                                    }
                                                                    
                                                                    function GetCommentsAfterSave()
                                                                    {
                                                                    document.getElementById("txtComments").value=''; 
                                                                    var  SelectedTaskID= document.getElementById("txtTaskID").value; 
                                                                     var FilterPeriod = document.getElementById("txtPeriod").value;// $("#txtperiod").val(); //document.getElementById("txtperiod").value; 
                                                                     var datas = "&FilterPeriod="+FilterPeriod+"&SelectedTaskID="+SelectedTaskID;
                                                                     ////alert ("after save");
                                                                     
                                                                     $.ajax({
                                                                      method: 'post',
                                                                      url:"loadremarks.php",
                                                                      data:datas,
                                                                      success:function(response)
                                                                      {
                                                                        // var ajaxDisplay = document.getElementById(divid);
                                                                            // ajaxDisplay.innerHTML = html;
                                                                    	 $( '#display_comments' ).html(response);
                                                                      }
                                                                     });
                                                                     
                                                                    }
                                                                    
                                                                    function ActivateMenu(x) {
                                                                     var mnu = x.id;
                                                                      // //alert(mnu);
                                                                      
                                                                      if (mnu ==="mnuAll")
                                                                      {
                                                                      document.getElementById("txtPeriod").value ='All';
                                                                       $('#mnuAll').addClass("active");
                                                                       $('#mnuToday').removeClass("active");
                                                                       $('#mnuTomorrow').removeClass("active");
                                                                       $('#mnuNext7Days').removeClass("active");
                                                                       $('#mnu30Days').removeClass("active");
                                                                       $('#mnuArchive').removeClass("active");
                                                                       $('#mnuCompleted').removeClass("active");
                                                                       document.getElementById("endTimeLabel").className = ''; 
                                                                      
                                                                    
                                                                      }
                                                                       if (mnu ==="mnuToday")
                                                                      {
                                                                      document.getElementById("txtPeriod").value ='Today';
                                                                       $('#mnuAll').removeClass("active");
                                                                       $('#mnuToday').addClass("active");
                                                                       $('#mnuTomorrow').removeClass("active");
                                                                       $('#mnuNext7Days').removeClass("active");
                                                                       $('#mnu30Days').removeClass("active");
                                                                       $('#mnuArchive').removeClass("active");
                                                                       $('#mnuCompleted').removeClass("active");
                                                                        document.getElementById("endTimeLabel").className = 'hidden'; 
                                                                      }
                                                                      
                                                                       if (mnu ==="mnuTomorrow")
                                                                      {
                                                                      document.getElementById("txtPeriod").value ='Tomorrow';
                                                                      $('#mnuAll').removeClass("active");
                                                                       $('#mnuToday').removeClass("active");
                                                                       $('#mnuTomorrow').addClass("active");
                                                                       $('#mnuNext7Days').removeClass("active");
                                                                       $('#mnu30Days').removeClass("active");
                                                                       $('#mnuArchive').removeClass("active");
                                                                       $('#mnuCompleted').removeClass("active"); 
                                                                        document.getElementById("endTimeLabel").className = 'hidden'; 
                                                                      }
                                                                      if (mnu ==="mnuNext7Days")
                                                                      {
                                                                      document.getElementById("txtPeriod").value ='Next7Days';
                                                                         $('#mnuAll').removeClass("active");
                                                                       $('#mnuToday').removeClass("active");
                                                                       $('#mnuTomorrow').removeClass("active");
                                                                       $('#mnuNext7Days').addClass("active");
                                                                       $('#mnu30Days').removeClass("active");
                                                                       $('#mnuArchive').removeClass("active");
                                                                       $('#mnuCompleted').removeClass("active"); 
                                                                        document.getElementById("endTimeLabel").className = 'hidden'; 
                                                                      }
                                                                       if (mnu ==="mnuCompleted")
                                                                      {
                                                                      document.getElementById("txtPeriod").value ='Completed';
                                                                       $('#mnuAll').removeClass("active");
                                                                       $('#mnuToday').removeClass("active");
                                                                       $('#mnuTomorrow').removeClass("active");
                                                                       $('#mnuNext7Days').removeClass("active");
                                                                       $('#mnu30Days').removeClass("active");
                                                                       $('#mnuArchive').removeClass("active");
                                                                       $('#mnuCompleted').addClass("active");
                                                                        document.getElementById("endTimeLabel").className = 'hidden'; 
                                                                      }
                                                                          
                                                                       
                                                                      LoadTask();
                                                                      
                                                                    }
                                                                    
                          										  function LoadFilter(e)
                          										  {
                          											  
                          											   document.getElementById("txtPeriod").value = e.target.value;
                          											   var Filter = document.getElementById("txtPeriod").value;
                          											
                           
                          										  
                          										  
                          											   if (Filter=="All")
                          											   {
                          												    document.getElementById("endTimeLabel").className = ''; 
                          												    document.getElementById("Disp_WithOverdue").className = ''; 
																			 $('.tdCustomDate').hide();
																		     $('.tdCustomDateApply').hide();
                          											   }
                          											   else if (Filter=="Overdue")
                          											   {
                          												    document.getElementById("endTimeLabel").className = 'hidden'; 
                          												    document.getElementById("Disp_WithOverdue").className = 'hidden'; 
																			 $('.tdCustomDate').hide();
																		     $('.tdCustomDateApply').hide();
                          											   }
                          											   else if (Filter=="Completed")
                          											   {
                          												    document.getElementById("endTimeLabel").className = 'hidden'; 
                          												    document.getElementById("Disp_WithOverdue").className = 'hidden'; 
																			 $('.tdCustomDate').hide();
																		     $('.tdCustomDateApply').hide();
                          											   }
																	   else if (Filter=="Custom")
                          											   {
																		     $('.tdCustomDate').toggle();
																		     $('.tdCustomDateApply').toggle();
																			 
																			 document.getElementById("endTimeLabel").className = 'hidden'; 
                          												    document.getElementById("Disp_WithOverdue").className = ''; 
                          											   }
                          											   else
                          											   {
                          												   document.getElementById("endTimeLabel").className = 'hidden'; 
                          												   document.getElementById("Disp_WithOverdue").className = ''; 
																		   $('.tdCustomDate').hide();
																		     $('.tdCustomDateApply').hide();
                          											   }
                          										   
                          											  
                          											   
                          											   
                          											   LoadTask();
                          										  }
                          										  
                          										   
                          										   
                          										function GetRowAddress(x)
                          										{
                          										document.getElementById("txtSelectedRow").value = x.parentNode.rowIndex; 
                          										var row = document.getElementById("txtSelectedRow").value;
                          // document.getElementById("spntask").textContent=document.getElementById("indextable").rows[row].cells[3].innerHTML; 
                          // document.getElementById("spnOldtask").textContent=document.getElementById("indextable").rows[row].cells[3].innerHTML;  
                          // document.getElementById("spnTags").textContent=document.getElementById("indextable").rows[row].cells[16].innerHTML; 
                          // document.getElementById("spnOldProcessowner").textContent=document.getElementById("indextable").rows[row].cells[14].innerHTML; 
                          // document.getElementById("txtTaskID").value= document.getElementById("indextable").rows[row].cells[0].innerHTML;
                          
                          document.getElementById("spntask").textContent=document.getElementById("indextable").rows[row].cells.namedItem("tblTask").innerHTML;
                          document.getElementById("spnOldtask").textContent=document.getElementById("indextable").rows[row].cells.namedItem("tblTask").innerHTML;  
                          document.getElementById("spnTags").textContent=document.getElementById("indextable").rows[row].cells.namedItem("tblTag").innerHTML;
                          document.getElementById("spnOldProcessowner").textContent=document.getElementById("indextable").rows[row].cells.namedItem("tblProcessOwner").innerHTML; 
                          document.getElementById("txtTaskID").value= document.getElementById("indextable").rows[row].cells.namedItem("tblTaskId").innerHTML;
						   document.getElementById("spnExistingCategory").textContent=document.getElementById("indextable").rows[row].cells.namedItem("tblCategory").innerHTML; 
                          
                          
                          
                                                                  }
                          										
                          											 
                          											
                          										  function ChangeTimeLine()
                          										  {
                          											 // alert(1); 
                          											   var row = document.getElementById("txtSelectedRow").value;
                                                                       var UpdateType = 'SaveComments';
                                                                       var DuedateChangeComments = document.getElementById("txtRemarksTimelineChange").value;
                                                                       var NewTimeLine = document.getElementById("dtChangeTimeLine").value; 
                                                                      // alert(2);
                                                                     // var  CurrentStatus = document.getElementById("indextable").rows[row].cells[1].innerHTML;
                                                                     // var  OldDueDate = document.getElementById("indextable").rows[row].cells[8].innerHTML;
                          										    //  var SelectedTaskID=document.getElementById("indextable").rows[row].cells[0].innerHTML;
                          											 //document.getElementById("myTable").rows[2].cells.namedItem("myTd1").innerHTML
                          										   
                          				   var CurrentStatus = document.getElementById("indextable").rows[row].cells.namedItem("tblTaskStatus").innerHTML;
                          				   var OldDueDate = document.getElementById("indextable").rows[row].cells.namedItem("tblDueDate").innerHTML; 
                          				   var SelectedTaskID=document.getElementById("indextable").rows[row].cells.namedItem("tblTaskId").innerHTML;
                          											    
                          											     
                                                                      if (CurrentStatus == "Completed")
                                                                      {
                                                                    	 alert ("You have already completed this task, not allowed to change date");
                                                                      }
                                                                      else if(NewTimeLine=="")
                          											{
                          												alert("Kindly provide the revised Timeline");
                          											}
                          											else
                                                                      {
                                                                    	   var datas = "&SelectedTaskID="+SelectedTaskID+"&OldDueDate="+OldDueDate+"&NewTimeLine="+NewTimeLine+"&DuedateChangeComments="+DuedateChangeComments;
                                                                    // alert(datas);
                                                                     $.ajax({
                                                                       url:"ChangeDueDate.php",
                                                                       method:"POST",
                                                                       data:datas,
                                                                       success:function(data)
                                                                       {
                                                                      //  $('#AddTask')[0].reset();
                                                                      ////alert("OK");
                                                                       // alert(data);
                                                                        document.getElementById("txtRemarksTimelineChange").value="";
                          											  document.getElementById("dtChangeTimeLine").value="";
                                                                     LoadTask();
                                                                    
                                                                       }
                                                                      });
                                                                      } 
                          										  }
                          										  
                          										   function ChangeTask()
                          										  {
                          											 // alert(1); 
                          											   var row = document.getElementById("txtSelectedRow").value;
                                                                       var UpdateType = 'SaveComments';
                                                                       var ModifiedTask = document.getElementById("txtModifiedTaskDescription").value;
                                                                    
                                                            // var OldTask =document.getElementById("indextable").rows[row].cells[3].innerHTML; 
                                                            // var CurrentStatus = document.getElementById("indextable").rows[row].cells[1].innerHTML;
                                                            // var SelectedTaskID=document.getElementById("indextable").rows[row].cells[0].innerHTML;
                          								  
                          					  var OldTask =document.getElementById("indextable").rows[row].cells.namedItem("tblTask").innerHTML; 
                          					  var CurrentStatus = document.getElementById("indextable").rows[row].cells.namedItem("tblTaskStatus").innerHTML;
                          					  var SelectedTaskID=document.getElementById("indextable").rows[row].cells.namedItem("tblTaskId").innerHTML;
                          											     
                                                                      if (CurrentStatus == "Completed")
                                                                      {
                                                                    	 alert ("You have already completed this task, not allowed to change date");
                                                                      }
                                                                      else if (ModifiedTask =="")
                                                                      {
                          												 alert ("You Must add new task to save");
                          											}
                          											else
                          											{
                                                                    	   var datas = "&SelectedTaskID="+SelectedTaskID+"&OldTask="+OldTask+"&ModifiedTask="+ModifiedTask;
                                                                   //alert(datas);
                                                                     $.ajax({
                                                                       url:"ChangeTask.php",
                                                                       method:"POST",
                                                                       data:datas,
                                                                       success:function(data)
                                                                       {
                                                                      //  $('#AddTask')[0].reset();
                                                                      ////alert("OK");
                                                                       // alert(data);
                                                                        document.getElementById("txtModifiedTaskDescription").value="";
                          											  document.getElementById("spnOldtask").textContent= ModifiedTask;
                          											  document.getElementById("spntask").textContent= ModifiedTask;
                          											  
                                                                     LoadTask();
                                                                    
                                                                       }
                                                                      });
                                                                      } 
                          										  }
                          										  
                          										  
                          										   function SaveCommitedOnHoldStatus()
                          										  {
                          											 // alert(1); 
                          											   var row = document.getElementById("txtSelectedRow").value;
                                                                       var UpdateType = 'SaveCommitedStatus';
                                                                       // var CommitedStatus = $("input[name='rdCommited']:checked").val();
                                                                       var CommitedStatus =$('#rdCommited').prop('checked')
                                                                       var OnHoldStatus =$('#rdOnHold').prop('checked')
                                                                       // var OnHoldStatus = $("input[name='rdOnHold']:checked").val();
                                                                     
                          										  if (CommitedStatus==true)
                          													{
                          														CommitedStatus=1;
                          														  
                          													}
                          													else
                          													{
                          														CommitedStatus=0;  
                          													}
                          													
                          													if (OnHoldStatus==true)
                          													{
                          														OnHoldStatus=1;
                          														  
                          													}
                          													else
                          													{
                          														OnHoldStatus=0;  
                          													}
                          													
                                                     // var SelectedTaskID=document.getElementById("indextable").rows[row].cells[0].innerHTML;
                          						   // var CurrentStatus = document.getElementById("indextable").rows[row].cells[1].innerHTML;
                          						   
                          			var SelectedTaskID=document.getElementById("indextable").rows[row].cells.namedItem("tblTaskId").innerHTML;
                          			var CurrentStatus = document.getElementById("indextable").rows[row].cells.namedItem("tblTaskStatus").innerHTML;
                          						   
                                                                      if (CurrentStatus == "Completed")
                                                                      {
                                                                    	 alert ("You have already completed this task, not allowed to change date");
                                                                      }
                                                                      else
                                                                      {
                                                                    	   var datas = "&SelectedTaskID="+SelectedTaskID+"&CommitedStatus="+CommitedStatus+"&OnHoldStatus="+OnHoldStatus;
                                                                   //alert(datas);
                                                                     $.ajax({
                                                                       url:"ChangeCommitedStatus.php",
                                                                       method:"POST",
                                                                       data:datas,
                                                                       success:function(data)
                                                                       {
                                                                      //  $('#AddTask')[0].reset();
                                                                      ////alert("OK");
                                                                       // alert(data);
                                                                        
                                                                     LoadTask();
                                                                    
                                                                       }
                                                                      });
                                                                      } 
                          										  }
                          										  
                          										  
                          										    function ChangeProcessowner()
                          										  {
                          											 // alert(1); 
                          											   var row = document.getElementById("txtSelectedRow").value;
                                                                     
                          		   // var  CurrentStatus = document.getElementById("indextable").rows[row].cells[1].innerHTML; 
                          		   // var  OldProcessownerID = document.getElementById("indextable").rows[row].cells[17].innerHTML;
                          		   // var SelectedTaskID=document.getElementById("indextable").rows[row].cells[0].innerHTML;
                          		   
                          		var  CurrentStatus = document.getElementById("indextable").rows[row].cells.namedItem("tblTaskStatus").innerHTML;
                          	    var  OldProcessownerID = document.getElementById("indextable").rows[row].cells.namedItem("tblProcessOwnerID").innerHTML;
                                  var SelectedTaskID=document.getElementById("indextable").rows[row].cells.namedItem("tblTaskId").innerHTML;
                          
                                                                     
                          										 //  alert(OldProcessownerID);
                          										    var SelectedProcessOwner=document.getElementById("cmbModProcessowner").value;
                                                                      
                                                                         
                          											     
                                                                      if (CurrentStatus == "Completed")
                                                                      {
                                                                    	 alert ("You have already completed this task, not allowed to change date");
                                                                      }
                                                                      else
                                                                      {
                                                                    	   var datas = "&SelectedTaskID="+SelectedTaskID+"&SelectedProcessOwner="+SelectedProcessOwner+"&OldProcessownerID="+OldProcessownerID;
                                                                   //alert(datas);
                                                                     $.ajax({
                                                                       url:"ChangeProcessowner.php",
                                                                       method:"POST",
                                                                       data:datas,
                                                                       success:function(data)
                                                                       {
                                                                      //  $('#AddTask')[0].reset();
                                                                      ////alert("OK");
                                                                    //    alert(data);
                                                                        
                                                                     LoadTask();
                                                                    
                                                                       }
                                                                      });
                                                                      } 
                          										  }
																  
																     function ChangeCategory()
                          										  {
                          											 // alert(1); 
                          											   var row = document.getElementById("txtSelectedRow").value;
                                                                     
                          		   // var  CurrentStatus = document.getElementById("indextable").rows[row].cells[1].innerHTML; 
                          		   // var  OldProcessownerID = document.getElementById("indextable").rows[row].cells[17].innerHTML;
                          		   // var SelectedTaskID=document.getElementById("indextable").rows[row].cells[0].innerHTML;
                          		    	var  CurrentStatus = document.getElementById("indextable").rows[row].cells.namedItem("tblTaskStatus").innerHTML;
                                  var SelectedTaskID=document.getElementById("indextable").rows[row].cells.namedItem("tblTaskId").innerHTML;
                          
                                                                     
                          										 //  alert(OldProcessownerID);
                          										    var ModifiedCategory=document.getElementById("SelectModifyCategory").value;
                                                                      
                                                                         
                          											     
                                                                      if (CurrentStatus == "Completed")
                                                                      {
                                                                     
																		 
																		  swal("Alert!", "You have already completed this task, not allowed to change date!!", "warning");
                                                                      }
																	  else if(ModifiedCategory=='')
																	  {
																		   swal("Alert!", "Kindly select new category!!", "warning");
															 
																	  }
																	  
                                                                      else
                                                                      {
                                                                    	   var datas = "&SelectedTaskID="+SelectedTaskID+"&CategoryID="+ModifiedCategory;
                                                                   //alert(datas);
                                                                     $.ajax({
                                                                       url:"ChangeCategory.php",
                                                                       method:"POST",
                                                                       data:datas,
                                                                       success:function(data)
                                                                       {
                                                                      //  $('#AddTask')[0].reset();
                                                                      ////alert("OK");
                                                                    //    alert(data);
                                                                        
                                                                     LoadTask();
                                                                    
                                                                       }
                                                                      });
                                                                      } 
                          										  }
																  
                          										  
                          										    
                          										   function SaveTimeLog()
                          										  { 
                          										 
                          										   var row = document.getElementById("txtSelectedRow").value;
                          				 var SelectedTaskID=document.getElementById("indextable").rows[row].cells.namedItem("tblTaskId").innerHTML;
                          										  
                          										    var StartTime =document.getElementById("dtStartTime").value;
                          										    var EndTime =document.getElementById("dtEndTime").value;
                          											 
                          										    var TotalTime=document.getElementById("timeSum").value;
                                                                       
                          										  if (TotalTime=="" || TotalTime =="0")
                          										  {
                          											  
                          											   swal("Alert!", "Kindly provide valid start and end time!", "warning");
                          											  
                          										  }
                          										  else
                          										  {
                          						 var datas = "&SelectedTaskID="+SelectedTaskID+"&StartTime="+StartTime+"&EndTime="+EndTime+"&TotalTime="+TotalTime;	
                                                                  
                                                                     $.ajax({
                                                                       url:"SaveTimeLog.php",
                                                                       method:"POST",
                                                                       data:datas,
                                                                       success:function(data)
                                                                       {
                                                                      //  $('#AddTask')[0].reset();
                                                                      ////alert("OK");
                          											document.getElementById("dtStartTime").value="";
                          											document.getElementById("dtEndTime").value="";
                          											document.getElementById("timeSum").value="";
                                                                       
                                                                     LoadTotalTimeSpent();
                                                                    
                                                                       }
                                                                      });
                          										  }
                                                                      
                          										  }
                          										 
                          										  function LoadTotalTimeSpent()
                          										  {  
                          										   var row = document.getElementById("txtSelectedRow").value;
                          			  var SelectedTaskID=document.getElementById("indextable").rows[row].cells.namedItem("tblTaskId").innerHTML;
                          										   
                          										var datas = "&SelectedTaskID="+SelectedTaskID;	
                                                                  
                                                                     $.ajax({
                                                                       url:"TotalTimeSpent.php",
                                                                       method:"POST",
                                                                       data:datas,
                          											 dataType: "json",                                             
                          											 success:function(response)
                                                                       {
                          												  console.log(response);
                          												  
                          												  
                                                                         document.getElementById("sptTotalTimeSpent").textContent= response[0]['TotalTime'];
                                                                       }
                                                                      });
                                                                      
                          										  }
                          										  
                          										  
                          										  function AddTags()
                          										  {
                          										// alert(1); 
                          											var row = document.getElementById("txtSelectedRow").value; 
                                    var SelectedTaskID=document.getElementById("indextable").rows[row].cells.namedItem("tblTaskId").innerHTML;
                          											    
                          										   var Tag=document.getElementById("cmbAddModTags");
                                                                     var Arr_Tag = []; 
                                                                     for (var i = 0; i < Tag.options.length; i++) {
                                                                    	      if(Tag.options[i].selected ==true){
                                                                    		  
                                                                                 // alert("'" + x.options[i].value + "'" );
                                                                    		  Arr_Tag.push(Tag.options[i].value);
                                                                    		    
                                                                             }
                                                                         }
                                                                      var SelectedTags = "" + Arr_Tag.join(",")+ ""
                          											// alert(SelectedTags); 
                          												 
                                                                    	   var datas = "&SelectedTaskID="+SelectedTaskID+"&SelectedTags="+SelectedTags;
                                                                    // alert(datas);
                                                                     $.ajax({
                                                                       url:"AddTags.php",
                                                                       method:"POST",
                                                                       data:datas,
                                                                       success:function(data)
                                                                       {
                                                                      //  $('#AddTask')[0].reset();
                                                                      ////alert("OK");
                                                                       // alert(data);
                                                                        
                                                                     LoadTask();
                                                                    
                                                                       }
                                                                      });
                                                                      } 
                          										  
                          										  
                          										 
                          										  
                                                                    function SaveComments(){
                                                                        
                                                                       var row = document.getElementById("txtSelectedRow").value;
                                                                       var UpdateType = 'SaveComments';
                                                                       var Comments = document.getElementById("txtComments").value;
                                                                      
                                          var  CurrentStatus = document.getElementById("indextable").rows[row].cells.namedItem("tblTaskStatus").innerHTML;
                                                                         var SelectedTaskID= document.getElementById("txtTaskID").value;  
                                                                      if (CurrentStatus == "Completed")
                                                                      {
                                                                    	  //alert ("You have already completed this task, not allowed to give comments");
                                                                      }
                                                                      else
                                                                      {
                                                                    	   var datas = "&SelectedTaskID="+SelectedTaskID+"&CurrentStatus="+CurrentStatus+"&UpdateType="+UpdateType+"&Comments="+encodeURIComponent(Comments);
                                                                     //alert (datas);
                                                                     $.ajax({
                                                                       url:"SaveTaskAG.php",
                                                                       method:"POST",
                                                                       data:datas,
                                                                       success:function(data)
                                                                       {
                                                                      //  $('#AddTask')[0].reset();
                                                                      ////alert("OK");
                                                                      // alert("Save");
                                                                        GetCommentsAfterSave();
                                                                     LoadTask();
                                                                    
                                                                       }
                                                                      });
                                                                      } 
                                                                    }
                                                                    
                                                                    function CompleteTask(x)
																	{
                                                                       
                                                                      document.getElementById("txtSelectedRow").value = x.parentNode.rowIndex;
                                                                       var row = document.getElementById("txtSelectedRow").value;
                                                                       var UpdateType = 'CompleteTask';
                          	// document.getElementById("txtTaskID").value= document.getElementById("indextable").rows[row].cells[0].innerHTML;
                          	// var SelectedTaskID= document.getElementById("indextable").rows[row].cells[0].innerHTML;	 
                          	// var  CurrentStatus = document.getElementById("indextable").rows[row].cells[1].innerHTML; 
                          	// var TaskType= document.getElementById("indextable").rows[row].cells[4].innerHTML;	 
                          	// var TaskRecurrance= document.getElementById("indextable").rows[row].cells[5].innerHTML;	 
                          	// var TaskRecurrance_l2= document.getElementById("indextable").rows[row].cells[6].innerHTML;	 
                          	// var Condition= document.getElementById("indextable").rows[row].cells[7].innerHTML;	 
                          	// var CurrentDueDate= document.getElementById("indextable").rows[row].cells[8].innerHTML;	 
							
                          	
                          		document.getElementById("txtTaskID").value= document.getElementById("indextable").rows[row].cells.namedItem("tblTaskId").innerHTML;
                          	var SelectedTaskID= document.getElementById("indextable").rows[row].cells.namedItem("tblTaskId").innerHTML;
                          	var CurrentStatus = document.getElementById("indextable").rows[row].cells.namedItem("tblTaskStatus").innerHTML;
                          	var TaskType= document.getElementById("indextable").rows[row].cells.namedItem("tblTaskType").innerHTML;	 
                          	var TaskRecurrance= document.getElementById("indextable").rows[row].cells.namedItem("tblRecurrance").innerHTML; 
                          	var TaskRecurrance_l2= document.getElementById("indextable").rows[row].cells.namedItem("tblRecurrance_l2").innerHTML; 
                          	var Condition= document.getElementById("indextable").rows[row].cells.namedItem("tblConditionString").innerHTML; 
                          	var CurrentDueDate= document.getElementById("indextable").rows[row].cells.namedItem("tblDueDate").innerHTML;
                          	
                          	
                                                                       var Comments = document.getElementById("txtComments").value;
                                                                      
                                                                     // alert(Condition);
                                                                     var datas = "&SelectedTaskID="+SelectedTaskID+"&CurrentStatus="+CurrentStatus+"&UpdateType="+UpdateType+"&TaskType="+TaskType+"&TaskRecurrance="+TaskRecurrance+"&TaskRecurrance_l2="+TaskRecurrance_l2+"&Condition="+Condition+"&CurrentDueDate="+CurrentDueDate+"&Comments="+Comments;
                                                                   //alert (datas);
                                                                     $.ajax({
                                                                       url:"SaveTaskAG.php",
                                                                       method:"POST",
                                                                       data:datas,
                                                                       success:function(data)
                                                                       {
                                                                      //  $('#AddTask')[0].reset();
                          											  // alert (data);
                                                                       //alert("Task Completed");
																	   
																	   
                          											swal("Hi <?php echo $_SESSION["RMS_EmployeeName"]; ?> Good job!", "You completed the task!", "success");
                          											 
																	 
                                                                         LoadTask();
                                                                       }
                                                                      });
                                                                      
                                                                      
                                                                    }
                                                                    
                                                                     
                                                                    
                                                                    $(document).ready(function(){
                                                                     
                                                                     
                                                                     $('#AddTask').on('submit', function(event){
                                                                     event.preventDefault();
                                                                     if($('#TaskDescrtiption').val() != '')
                                                                     {
                                                                      var form_data = $(this).serialize();
                                                                      $.ajax({
                                                                       url:"addtask.php",
                                                                       method:"POST",
                                                                       data:form_data,
                                                                       success:function(data)
                                                                       {
                                                                        $('#AddTask')[0].reset();
                                                                        LoadTask();
                                                                       }
                                                                      });
                                                                     }
                                                                     else
                                                                     {
                                                                      //alert("Enter the Task Details");
                                                                     }
                                                                    });
                                                                    
                                                                    
                                                                      // $('#CompleteTask').on('click', function(event){
                                                                     // event.preventDefault();
                                                                     // document.getElementById("txtSelectedRow").value = x.parentNode.rowIndex;
                                                                      // var row = document.getElementById("txtSelectedRow").value;
                                                                      // document.getElementById("txtSelectedRow").value=document.getElementById("indextable").rows[row].cells[0].innerHTML;   
                                                                      
                                                                      // var indextableforID =  document.getElementById("indextable").rows[row].cells[0].innerHTML;   
                                                                      // //alert(indextableforID);
                                                                      
                                                                      
                                                                     // var form_data = $(this).serialize();
                                                                      // $.ajax({
                                                                       // url:"addtask.php",
                                                                       // method:"POST",
                                                                       // data:form_data,
                                                                       // success:function(data)
                                                                       // {
                                                                        // $('#AddTask')[0].reset();
                                                                        // LoadTask();
                                                                       // }
                                                                      // });
                                                                      
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    });
                                                                 
                          																																																										
                        </script>
                        <script type="text/javascript"> 
                          // $(document).ready(function(){
                          // $("#TimeLine").click(function(){
                          // $("p.TimeLine").toggle(250);
                          // $("p.Project").hide();
                          // $("p.Assign").hide();
                          // $("p.Priority").hide();
                          
                          // });
                          
                          // $("#Project").click(function(){
                          // $("p.Project").toggle(250);
                          // $("p.TimeLine").hide();
                          // $("p.Assign").hide();
                          // $("p.Priority").hide();
                          // });
                          
                          // $("#Assign").click(function(){
                          // $("p.Assign").toggle(250);
                          // $("p.TimeLine").hide();
                          // $("p.Project").hide();
                          // $("p.Priority").hide();
                          // });
                          
                          // $("#Priority").click(function(){
                          // $("p.Priority").toggle(250);
                          // $("p.TimeLine").hide();
                          // $("p.Project").hide();
                          // $("p.Assign").hide();
                          // });
                          
                          // });
                          
                          
                          function checkInput(textbox) {
                          var textInput = document.getElementById(textbox).value;
                          
                          ////alert(textInput); 
                          }
                          
                          function ViewDueDate() {
                          var DivDueDate = document.getElementById("DivDueDate");
                          var DivProject = document.getElementById("DivProject");
                          var DivAssign = document.getElementById("DivAssign");
                          var DivPriority = document.getElementById("DivPriority");
                          
                          if (DivDueDate.style.display === "none") {
                          DivDueDate.style.display = "block";
                          DivProject.style.display = "none";
                          DivAssign.style.display = "none";
                          DivPriority.style.display = "none";	
                          } else {
                          DivDueDate.style.display = "none"; 
                          }
                          }
                          
                          function ViewProject() {
                          var DivDueDate = document.getElementById("DivDueDate");
                          var DivProject = document.getElementById("DivProject");
                          var DivAssign = document.getElementById("DivAssign");
                          var DivPriority = document.getElementById("DivPriority");
                          
                          if (DivProject.style.display === "none") {
                          DivDueDate.style.display = "none";
                          DivProject.style.display = "block";
                          DivAssign.style.display = "none";
                          DivPriority.style.display = "none";	
                          } else {
                          DivProject.style.display = "none"; 
                          }
                          }
                          
                          function ViewAssign() {
                          var DivDueDate = document.getElementById("DivDueDate");
                          var DivProject = document.getElementById("DivProject");
                          var DivAssign = document.getElementById("DivAssign");
                          var DivPriority = document.getElementById("DivPriority");
                          
                          if (DivAssign.style.display === "none") {
                          DivDueDate.style.display = "none";
                          DivProject.style.display = "none";
                          DivAssign.style.display = "block";
                          DivPriority.style.display = "none";	
                          } else {
                          DivAssign.style.display = "none"; 
                          }
                          }
                          
                          function ViewPriority() {
                          var DivDueDate = document.getElementById("DivDueDate");
                          var DivProject = document.getElementById("DivProject");
                          var DivAssign = document.getElementById("DivAssign");
                          var DivPriority = document.getElementById("DivPriority");
                          
                          if (DivPriority.style.display === "none") {
                          DivDueDate.style.display = "none";
                          DivProject.style.display = "none";
                          DivAssign.style.display = "none";
                          DivPriority.style.display = "block";	
                          } else {
                          DivPriority.style.display = "none"; 
                          }
                          }
                          
                          
                        </script>
                        <style> .example-table td { padding: 10px; }
                          .speech-bubble {
                          position: relative;
                          background: #ffffff;
                          border: 1px solid transparent;
                          border-color: #e6c8c8;
                          border-radius: .4em;
                          width: 240px;
                          height: 80px;
                          padding: 10px;
                          }
                          .speech-bubble:after {
                          content: '';
                          position: absolute;
                          top: 0;
                          left: 8%;
                          width: 0;
                          height: 0;
                          border: 10px solid transparent;
                          border-bottom-color: #e6c8c8;
                          border-top: 0;
                          margin-left: -10px;
                          margin-top: -10px;
                          }
                        </style>
                        <div class="panel-body">
                          <table style="table-layout:fixed";>
                            <thead>
                              <tr>
                                <td>
                                  <div style='width: 75px;'>
                                    Client
                                  </div>
                                </td>
                                <td>
                                  <div style='width: 250px;'>
                                    <select  class="form-control selectpicker" id="SelectClient"  name="SelectClient"  data-size="10" data-live-search="true" data-style="btn-white">
                                      <option value="" selected>Select Client</option>
                                      <?php  
                                        $sqli = "  SELECT clientid,childcompany FROM  clientmaster  WHERE clientcode ='$ClientCode'";
                                        $result = mysqli_query($connection, $sqli); 
                                         while ($row = mysqli_fetch_array($result)) {
                                        # code...
                                        
                                         echo '
                                        																																														<option value='.$row['clientid'].'>'.$row['childcompany'].'</option>';
                                          }	
                                        ?>
                                    </select>
                                  </div>
                                </td>
                                <td>
                                  <div style='width: 75px;'>
                                    &nbsp;&nbsp;&nbsp;&nbsp; Project
                                  </div>
                                </td>
                                <td>
                                  <div style='width: 250px;'>
                                    <select  class="form-control selectpicker" id="SelectProject"  name="SelectProject"  data-size="10" data-live-search="true" data-style="btn-white">
                                      <option value="" selected>Select Project</option>
                                      <?php   
                                        $CompanyID = $_SESSION["RMS_CompanyID"];
                                        $sqli = "SELECT projectid,projectname FROM  projectmaster  WHERE companyid ='$CompanyID' AND projectstatus='Active'";
                                        
                                        $result = mysqli_query($connection, $sqli);
                                        
                                        while ($row = mysqli_fetch_array($result)) {
                                        # code...
                                        
                                        echo '
                                        																																																									<option value='.$row['projectid'].'>'.$row['projectname'].'</option>';
                                        }	
                                        ?>
                                    </select>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div style='width: 75px;'>
                                    Sub Project
                                  </div>
                                </td>
                                <td>
                                  <div style='width: 250px;'>
                                    <select  class="form-control selectpicker" id="SelectSubProject"  name="SelectSubProject"  data-size="10" data-live-search="true" data-style="btn-white">
                                      <option value="" selected>Select Subproject</option>
                                      <?php  
                                        $CompanyID = $_SESSION["RMS_CompanyID"];
                                        $sqli = "SELECT subprojectid,subproject FROM subprojectmaster WHERE subprojectstatus ='Active' and clientid ='$CompanyID'";
                                        
                                        $result = mysqli_query($connection, $sqli);
                                        while ($row = mysqli_fetch_array($result)) {
                                        # code...
                                        echo '
                                        		<option  value='.$row['subprojectid'].'> '.$row['subproject'].' </option>';
                                        }	
                                        ?>
                                    </select>
                                  </div>
                                </td>
                                <td>
                                  <div style='width: 75px;'>
                                    &nbsp;&nbsp;&nbsp;&nbsp;Category
                                  </div>
                                </td>
                                <td>
                                  <div style='width: 250px;'>
                                    <select  class="form-control selectpicker" id="SelectCategory"  name="SelectCategory"  data-size="10" data-live-search="true" data-style="btn-white">
                                      <option value="" selected>Select Category</option>
                                      <?php  
                                        $CompanyID = $_SESSION["RMS_CompanyID"];
                                        $sqli = "SELECT categoryid,category FROM  categorymaster  WHERE clientid ='$CompanyID'";
                                        
                                        
                                        $result = mysqli_query($connection, $sqli);
                                        while ($row = mysqli_fetch_array($result)) {
                                        # code...
                                        echo '
                                        		<option  value='.$row['categoryid'].'> '.$row['category'].' </option>';
                                        }	
                                        ?>
                                    </select>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div style='width: 75px;'>
                                    Process Owner
                                  </div>
                                </td>
                                <td>
                                  <div style='width: 250px;'>
                                    <select  class="form-control selectpicker" id="SelectAssignedTo"  name="SelectAssignedTo"  data-size="10" data-live-search="true" data-style="btn-white">
                                      <option value="" selected>Select Processowner</option>
                                      <?php  
                                        $CompanyID = $_SESSION["RMS_CompanyID"];
                                        $sqli = " SELECT a.userid,a.username FROM usermaster AS a JOIN companyusermapping AS b ON 
                                        a.userid =b.userid WHERE b.companyid ='$ClientCode'";
                                        
                                        $result = mysqli_query($connection, $sqli);
                                        while ($row = mysqli_fetch_array($result)) {
                                        # code...
                                        echo '
                                        		<option  value='.$row['userid'].'> '.$row['username'].' </option>';
                                        }	
                                        ?>
                                    </select>
                                  </div>
                                </td>
                                <td>
                                  <div style='width: 75px;'>
                                    &nbsp;&nbsp;&nbsp;&nbsp;Est.Time 
                                  </div>
                                </td>
                                <td>
                                  <div style='width: 150px;float:left;'>
                                    <select  class="form-control selectpicker" id="SelectEstimatedTime"  name="SelectEstimatedTime"  data-size="10" data-live-search="true" data-style="btn-white">
                                      <option value="0">0</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                  </div>
                                  <div style="float:left">
                                    <label>
                                    <br>&nbsp;&nbsp; (fibonacci) 
                                    </label>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div style='width: 75px;'>
                                    Tag
                                  </div>
                                </td>
                                <td>
                                  <div style='width: 250px;'>
                                    <select  class="form-control selectpicker" id="SelectTags" multiple name="SelectTags"  data-size="10" data-live-search="true" data-style="btn-white">
                                      <option value="" selected>-</option>
                                      <?php  
                                        $CompanyID = $_SESSION["RMS_CompanyID"];
                                        $sqli = " SELECT tagname  FROM tagmaster WHERE clientid ='$CompanyID'";
                                        
                                        $result = mysqli_query($connection, $sqli);
                                        while ($row = mysqli_fetch_array($result)) {
                                        # code...
                                        echo '
                                        			<option  value="'.$row['tagname'].'"> '.$row['tagname'].' </option>';
                                        }	
                                        ?>
                                    </select>
                                  </div>
                                </td>
                                <td>
                                  <div style='width: 75px;'>
                                    &nbsp;&nbsp;&nbsp;&nbsp;Priority
                                  </div>
                                </td>
                                <td>
                                  <div style='width: 250px;'>
                                    <label class="radio-inline">
                                    <input type="radio" name="rdPriority" id='rdPriority_L' value="L" checked />
                                    L
                                    </label>
                                    <label class="radio-inline">
                                    <input type="radio" name="rdPriority" id='rdPriority_M' value="M" />
                                    M
                                    </label>
                                    <label class="radio-inline">
                                    <input type="radio" name="rdPriority" id='rdPriority_H' value="H" />
                                    H
                                    </label>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div style='width: 75px;'>
                                    Due Date
                                  </div>
                                </td>
                                <td>
                                  <div style='width: 250px;'>
                                    <br>
                                    <label>
                                    <input type="radio" name="rdRoutineType" id="rdRoutineType_OneTime" onclick="SelectedTaskType(this.value); findselected(this.value);"  value="OneTime" checked />
                                    One Time Task
                                    </label> &nbsp;&nbsp;
                                    <label >
                                    <input type="radio" name="rdRoutineType" id="rdRoutineType_Routine" onclick="SelectedTaskType(this.value)"  value="Routine" />
                                    Routine Task
                                    </label>
                                    <input class="date form-control" id="dtTimeline" name ="dtTimeline" style="width: 150px;"  onchange="checkInput('dtTimeline');" type="text">
                                  </div>
                                </td>
                              </tr>
                            </thead>
                          </table>
                          <div  style="display: none;">
                            <td>
                              <div style='width: 75px;'>
                                Billable ?
                              </div>
                            </td>
                            <td>
                              <div style='width: 250px;'>
                                No&nbsp;&nbsp;
                                <input type="checkbox" data-render="switchery" name='rdBillable' id='rdBillable' data-theme="default"  />
                                &nbsp;&nbsp;Yes
                              </div>
                            </td>
                          </div>
                          <div id="DivDueDate" style="display: block; margin-left:5px;">
                            <style>
                              .vl {
                              border-left: 1px solid #eeeeee;
                              height: 175px;
                              position: absolute;
                              left: 25%;
                              margin-left: -3px;
                              top: 50;
                              }
                              .ManualInput {
                              border-style: solid;
                              border-radius: 5px; 
                              border-width: 1px;
                              border-color: #CCCCCC;
                              background-color: #FFFFFF;
                              text-align: center;
                              }
                              .ManualSelect {
                              border-style: solid;
                              border-radius: 5px; 
                              border-width: 1px;
                              border-color: #CCCCCC;
                              background-color: #FFFFFF;
                              text-align: center;
                              }
                              .ManualDate {
                              border-style: solid;
                              border-radius: 5px; 
                              border-width: 1px;
                              border-color: #CCCCCC;
                              background-color: #FFFFFF;
                              text-align: left;
                              }
                            </style>
                            <script type="text/javascript">
                              function toggleTextbox(opt)
                              {
                                  if (opt == 'F')
                                      document.getElementById('txtText').disabled = false;
                                  else
                                      document.getElementById('txtText').disabled = true;
                              } 
                            </script>
                            <script>
                              function ViewPriority() {
                                var DivDueDate = document.getElementById("DivDueDate");
                                var DivProject = document.getElementById("DivProject");
                                var DivAssign = document.getElementById("DivAssign");
                                var DivPriority = document.getElementById("DivPriority");
                                
                                if (DivPriority.style.display === "none") {
                                  DivDueDate.style.display = "none";
                              	DivProject.style.display = "none";
                              	DivAssign.style.display = "none";
                              	DivPriority.style.display = "block";	
                                } else {
                                  DivPriority.style.display = "none"; 
                                }
                              }
                              
                              
                              
                              
                              function SelectedTaskType(SelecteTaskType) {
                              	 var TaskType = SelecteTaskType;
                              	  var DivRoutineBreakup = document.getElementById("DivRoutineBreakup");
                              	  if(TaskType=="Routine")
                              	  {
                              		  DivRoutineBreakup.style.display = "block";
                              		   document.getElementById('dtTimeline').disabled = true;
                              		   
                              		   // alert(1);
                              	  }
                              	  else
                              	  {
                              		 //xxxxxxxxxxxxxxxxxxxxx 
                              		   
                              	
                              		  DivRoutineBreakup.style.display = "none";
                              		   document.getElementById('dtTimeline').disabled = false;
                              		  
                              	
                              		  //  alert(2);
                              	  } 
                              }
                              
                               
                                function SaveIncidentalTask()
                                {
                              	  
                              	 var TaskDescrtiption= document.getElementById("TaskDescrtiption").value; 
                              	 
                              	 var SelectClient = document.getElementById("SelectClient").value;  
                              	 var SelectedProject = document.getElementById("SelectProject").value;  
                              
                              	 var SelectedSubProject = document.getElementById("SelectSubProject").value;  
                              
                              	 var SelectCategory = document.getElementById("SelectCategory").value;  
                              	 var SelectEstimatedTime = document.getElementById("SelectEstimatedTime").value;   
                                   var SelectedAssignedTo= document.getElementById("SelectAssignedTo").value;  
                              
                                 var PriorityValue = $("input[name='rdPriority']:checked").val();
                              var BillableStatus = $("input[name='rdBillable']:checked").val();
                              if (BillableStatus=='on')
                              {
                              BillableStatus=1;
                              
                              }
                              else
                              {
                              BillableStatus=0;  
                              }
                              
                              
                              var Tags=document.getElementById("SelectTags");
                              var Arr_Tags = []; 
                              for (var i = 0; i < Tags.options.length; i++) {
                              
                                if(Tags.options[i].selected ==true){
                              
                                     // alert("'" + x.options[i].value + "'" );
                              Arr_Tags.push(Tags.options[i].value);
                              
                                 }
                              }
                              var SelectedTags = "" + Arr_Tags.join(",")+ ""
                              
                              
                              	 var Timeline =  document.getElementById("dtTimeline").value;  
                              	   
                              	  if (TaskDescrtiption=="" || SelectCategory=="")
                              	  {
                              		  //alert("Enter the task details");
                              swal("Alert!", "Enter all required details !", "warning");
                              
                              	  }
                              	  else
                              	  {
                              	  
                              	  var datas = "&TaskDescrtiption="+encodeURIComponent(TaskDescrtiption)+
                              "&SelectClient="+encodeURIComponent(SelectClient)+
                              "&SelectedProject="+encodeURIComponent(SelectedProject)+
                              "&SelectedSubProject="+encodeURIComponent(SelectedSubProject)+
                              "&SelectCategory="+encodeURIComponent(SelectCategory)+
                              "&SelectEstimatedTime="+encodeURIComponent(SelectEstimatedTime)+
                              "&SelectedAssignedTo="+encodeURIComponent(SelectedAssignedTo)+
                              "&SelectedTags="+encodeURIComponent(SelectedTags)+
                              "&BillableStatus="+encodeURIComponent(BillableStatus)+
                              "&PriorityValue="+encodeURIComponent(PriorityValue)+
                              "&Timeline="+Timeline;
                              	//  //alert (datas);
                              	 $.ajax({
                                  url:"AddTaskAG.php",
                                  method:"POST",
                                  data:datas,
                                  success:function(data)
                                  {
                                   //$('#AddTask')[0].reset();
                                 //alert(data);
                                   LoadTask();
                                  }
                                 });
                              	  } 
                              	  
                              	   
                              	  
                                // $('#AddTask').on('submit', function(event){
                                // event.preventDefault();
                                // if($('#TaskDescrtiption').val() != '')
                                // {
                                 // var form_data = $(this).serialize();
                                 // $.ajax({
                                  // url:"addtask.php",
                                  // method:"POST",
                                  // data:form_data,
                                  // success:function(data)
                                  // {
                                   // $('#AddTask')[0].reset();
                                   // LoadTask();
                                  // }
                                 // });
                                // }
                                // else
                                // {
                                 // //alert("Enter the Task Details");
                                // }
                               // });
                                }
                               
                               
                               
                               
                              function FindDailyCondition(Condition)
                               
                              {
                              	
                              	var DailyCondition = Condition;
                              	////alert (DailyCondition);
                              	if (DailyCondition =="D")
                              	{
                              		document.getElementById("txtDailyValue").value= 'D';
                              	}
                              	else
                              	{
                              		document.getElementById("txtDailyValue").value= 'W';
                              	}
                              	 
                              }
                               
                              function  FindDailyRecurrance(Recurrance)
                              { 
                              	var DailyRecurrance = Recurrance;
                              	////alert (DailyRecurrance);
                              	if (DailyRecurrance =="Daily_NoEnd")
                              	{
                              		document.getElementById("txtDailyRecurranceRange").value= 'NoEnd';
                              	}
                              	else if (DailyRecurrance =="Daily_EndBy")
                              	{
                              		document.getElementById("txtDailyRecurranceRange").value= 'EndBy';
                              	}
                              	else
                              	{
                              		document.getElementById("txtDailyRecurranceRange").value= 'EndAfter';
                              	}
                              	
                              } 
                              
                              
                              function FindIsAccumuatedTask(x)
                               
                              {
                              	//alert(x);
                              	var Accumulated = x;
                              	////alert (DailyCondition);
                              	if (Accumulated =="NonAccumulated")
                              	{
                              		document.getElementById("txtAccumulated").value= 'No';
                              	}
                              	else
                              	{
                              		document.getElementById("txtAccumulated").value= 'Yes';
                              	}
                              	 
                              }
                              
                              function FindIsCommited(x)
                               
                              {
                              	//alert(x);
                              	var CommitedStatus = x;
                              	////alert (DailyCondition);
                              	if (CommitedStatus =="Commited")
                              	{
                              		document.getElementById("txtCommitedStatus").value= 'Yes';
                              	}
                              	else
                              	{
                              		document.getElementById("txtCommitedStatus").value= 'No';
                              	}
                              	 
                              }
                              function FindIsOnHold(x)
                               
                              {
                              	//alert(x);
                              	var OnHoldStatus = x;
                              	////alert (DailyCondition);
                              	if (OnHoldStatus =="Yes")
                              	{
                              		document.getElementById("txtOnHoldStatus").value= 'Yes';
                              	}
                              	else
                              	{
                              		document.getElementById("txtOnHoldStatus").value= 'No';
                              	}
                              	 
                              }
                              
                              
                              
                              function SaveDailyTask()
                              {
                              	var Condition= 'Daily';
                              	////alert("Daily");
                              	var DailyCondition =document.getElementById("txtDailyValue").value;
                              	var DailyRecurrance = document.getElementById("txtDailyRecurranceRange").value
                              
                              //alert(1);
                              	 var TaskDescrtiption= document.getElementById("TaskDescrtiption").value; 
                              	 
                              	 var SelectClient = document.getElementById("SelectClient").value;  
                              	 var SelectedProject = document.getElementById("SelectProject").value;  
                              
                              	 var SelectedSubProject = document.getElementById("SelectSubProject").value;  
                              // alert(2);
                              	 var SelectCategory = document.getElementById("SelectCategory").value;  
                              	 var SelectEstimatedTime = document.getElementById("SelectEstimatedTime").value;   
                                   var SelectedAssignedTo= document.getElementById("SelectAssignedTo").value;  
                              
                                 var PriorityValue = $("input[name='rdPriority']:checked").val();
                              
                              var Tags=document.getElementById("SelectTags");
                              var Arr_Tags = []; 
                              for (var i = 0; i < Tags.options.length; i++) {
                              
                                if(Tags.options[i].selected ==true){
                              
                                     // alert("'" + x.options[i].value + "'" );
                              Arr_Tags.push(Tags.options[i].value);
                              
                                 }
                              }
                              var SelectedTags = "'" + Arr_Tags.join("','")+ "'"
                              
                              var BillableStatus = $("input[name='rdBillable']:checked").val();
                              if (BillableStatus=='on')
                              {
                              BillableStatus=1;
                              
                              }
                              else
                              {
                              BillableStatus=0;  
                              }
                              
                              
                              
                              	 
                                   var IsAccumulated = document.getElementById("txtAccumulated").value;  
                              	   
                              	  //alert(IsAccumulated);
                              	 //   alert(3);
                              	 if (DailyRecurrance =="NoEnd")
                              	 {
                              		 var TaskEndAt = '1900/01/01';
                              		 var NoofOccurances ='0';
                              	 }
                              	 else if (DailyRecurrance =="EndBy")
                              	 {
                              		 var TaskEndAt =  document.getElementById("dtEndDate_Daily").value;  
                              		 var NoofOccurances ='0';
                              	 }
                              	 else
                              	 {
                              		 var TaskEndAt =   '1900/01/01';
                              		 var NoofOccurances = document.getElementById("txtEndafter_Daily").value;  
                              	 }
                              	  if (TaskDescrtiption=="" || SelectCategory=="")
                              	  {
                              		    swal("Alert!", "Enter all required details !", "warning");
                              	  }
                              	  else
                              	  {
                              // alert(4);
                              
                              
                              
                              
                              var datas = "&TaskDescrtiption="+encodeURIComponent(TaskDescrtiption)+
                              "&DailyCondition="+DailyCondition+
                              "&DailyRecurrance="+DailyRecurrance+
                              "&SelectClient="+encodeURIComponent(SelectClient)+
                              "&SelectedProject="+encodeURIComponent(SelectedProject)+
                              "&SelectedSubProject="+encodeURIComponent(SelectedSubProject)+
                              "&SelectCategory="+encodeURIComponent(SelectCategory)+
                              "&SelectEstimatedTime="+encodeURIComponent(SelectEstimatedTime)+
                              "&SelectedAssignedTo="+encodeURIComponent(SelectedAssignedTo)+
                              "&SelectedTags="+encodeURIComponent(SelectedTags)+
                              "&BillableStatus="+encodeURIComponent(BillableStatus)+
                              "&PriorityValue="+encodeURIComponent(PriorityValue) ;
                              
                              
                              	 // var datas = "&DailyCondition="+DailyCondition+"&DailyRecurrance="+DailyRecurrance+"&SelectedProject="+SelectedProject+"&SelectedAssignedTo="+SelectedAssignedTo+"&SelectedPriority="+SelectedPriority+"&TaskEndAt="+TaskEndAt+"&NoofOccurances="+NoofOccurances+"&TaskDescrtiption="+TaskDescrtiption+"&IsAccumulated="+IsAccumulated;
                              
                              //  alert(datas);
                              	 $.ajax({
                                  url:"AddDailyTaskAG.php",
                                  method:"POST",
                                  data:datas,
                                  success:function(data)
                                  {
                                  // $('#AddTask')[0].reset();
                                   //alert(data);
                                   LoadTask();
                                  }
                                 });
                              	  }   
                              }
                              
                              
                              
                              function FindWeeklyCondition(Condition)
                               {
                              	 // document.getElementById("txtWeekSunday").value= '0';
                              	 // document.getElementById("txtWeekMonday").value= '0';
                              	 // document.getElementById("txtWeekTuesday").value= '0';
                              	 // document.getElementById("txtWeekWednesday").value= '0';
                              	 // document.getElementById("txtWeekThursday").value= '0';
                              	 // document.getElementById("txtWeekFriday").value= '0';
                              	 // document.getElementById("txtWeekSaturday").value= '0';
                              	 
                              	// if(document.getElementById("Weekly_Sunday").checked)
                              	// {
                              		// //alert ('Checked');
                              		// document.getElementById("txtWeekSunday").value= '1';
                              	// }
                              	// else
                              	// {
                              		// //alert ('UnChecked');
                              		// document.getElementById("txtWeekSunday").value= '0';
                              	// }
                              	// if(document.getElementById("Weekly_Monday").checked)
                              	// { document.getElementById("txtWeekMonday").value= '1';	}
                              	// else
                              	// { document.getElementById("txtWeekMonday").value= '0';	}
                              	// if(document.getElementById("Weekly_Tuesday").checked)
                              	// { document.getElementById("txtWeekTuesday").value= '1';	}
                              	// else
                              	// { document.getElementById("txtWeekTuesday").value= '0';	}
                              	// if(document.getElementById("Weekly_Wednesday").checked)
                              	// { document.getElementById("txtWeekWednesday").value= '1';	}
                              	// else
                              	// { document.getElementById("txtWeekWednesday").value= '0';	}
                              	// if(document.getElementById("Weekly_Thursday").checked)
                              	// { document.getElementById("txtWeekThursday").value= '1';	}
                              	// else
                              	// { document.getElementById("txtWeekThursday").value= '0';	}
                              	// if(document.getElementById("Weekly_Friday").checked)
                              	// { document.getElementById("txtWeekFriday").value= '1';	}
                              	// else
                              	// { document.getElementById("txtWeekFriday").value= '0';	}
                              	// if(document.getElementById("Weekly_Saturday").checked)
                              	// { document.getElementById("txtWeekSaturday").value= '1';	}
                              	// else
                              	// { document.getElementById("txtWeekSaturday").value= '0';	}
                              	
                               
                              var checkboxes = document.getElementsByName('WeeklyCheckBox[]');
                              var vals = "";
                              for (var i=0, n=checkboxes.length;i
                              																<n;i++) 
                              {
                                  if (checkboxes[i].checked) 
                                  {
                                      vals += ","+checkboxes[i].value;
                                  }
                              }
                              if (vals) vals = vals.substring(1);
                              ////alert (vals);
                              document.getElementById("txtWeekCondition").value =vals; 
                               
                              	 
                              }
                              
                              function  FindWeeklyRecurrance(Recurrance)
                              { 
                              	var WeeklyRecurrance = Recurrance;
                              	////alert (WeeklyRecurrance);
                              	if (WeeklyRecurrance =="Weekly_NoEnd")
                              	{
                              		document.getElementById("txtWeeklyRecurranceRange").value= 'NoEnd';
                              	}
                              	else if (WeeklyRecurrance =="Weekly_EndBy")
                              	{
                              		document.getElementById("txtWeeklyRecurranceRange").value= 'EndBy';
                              	}
                              	else
                              	{
                              		document.getElementById("txtWeeklyRecurranceRange").value= 'EndAfter';
                              	}
                              	
                              } 
                              
                                                                              
                              function SaveWeeklyTask()
                              {
                              	var Condition= 'Weekly';
                              	// alert("Weekly");
                              	 
                              	var WeeklyCondition =document.getElementById("txtWeekCondition").value;
                              	
                              	var WeeklyRecurrance = document.getElementById("txtWeeklyRecurranceRange").value;
                              	
                              	var TaskDescrtiption= document.getElementById("TaskDescrtiption").value; 
                              	 //alert(1);
                              	 var SelectClient = document.getElementById("SelectClient").value;  
                              	 var SelectedProject = document.getElementById("SelectProject").value;  
                              
                              	 var SelectedSubProject = document.getElementById("SelectSubProject").value;  
                              
                              	 var SelectCategory = document.getElementById("SelectCategory").value;  
                              	 var SelectEstimatedTime = document.getElementById("SelectEstimatedTime").value;   
                                   var SelectedAssignedTo= document.getElementById("SelectAssignedTo").value;  
                              
                              var SelectedPriority = $("input[name='rdPriority']:checked").val();
                              var BillableStatus = $("input[name='rdBillable']:checked").val();
                              if (BillableStatus=='on')
                              {
                              BillableStatus=1;
                              
                              }
                              else
                              {
                              BillableStatus=0;  
                              }
                              
                              
                              //alert(2);
                              var Tags=document.getElementById("SelectTags");
                              var Arr_Tags = []; 
                              for (var i = 0; i < Tags.options.length; i++) {
                              
                                if(Tags.options[i].selected ==true){
                              
                                     // alert("'" + x.options[i].value + "'" );
                              Arr_Tags.push(Tags.options[i].value);
                              
                                 }
                              }
                              var SelectedTags = "'" + Arr_Tags.join("','")+ "'"
                              //alert(3);
                              	  
                              	 if (WeeklyRecurrance =="NoEnd")
                              	 {
                              		 var TaskEndAt = '1900/01/01';
                              		 var NoofOccurances ='0';
                              	 }
                              	 else if (WeeklyRecurrance =="EndBy")
                              	 {
                              		 var TaskEndAt =  document.getElementById("dtEndDate_Weekly").value;  
                              		 var NoofOccurances ='0';
                              	 }
                              	 else
                              	 {
                              		 var TaskEndAt =   '1900/01/01';
                              		 var NoofOccurances = document.getElementById("txtEndafter_Weekly").value;  
                              	 }
                              	 // alert(4);
                              	 
                              	   if (TaskDescrtiption=="" || SelectCategory=="")
                              	  {
                              		    swal("Alert!", "Enter all required details !", "warning");
                              	  }
                              	  else
                              	  {
                              // alert(5);
                              var datas = "&TaskDescrtiption="+encodeURIComponent(TaskDescrtiption)+
                              "&WeeklyCondition="+WeeklyCondition+
                              "&WeeklyRecurrance="+WeeklyRecurrance+
                              "&SelectClient="+encodeURIComponent(SelectClient)+
                              "&SelectedProject="+encodeURIComponent(SelectedProject)+
                              "&SelectedSubProject="+encodeURIComponent(SelectedSubProject)+
                              "&SelectCategory="+encodeURIComponent(SelectCategory)+
                              "&SelectEstimatedTime="+encodeURIComponent(SelectEstimatedTime)+
                              "&SelectedAssignedTo="+encodeURIComponent(SelectedAssignedTo)+
                              "&SelectedTags="+encodeURIComponent(SelectedTags)+
                              "&BillableStatus="+encodeURIComponent(BillableStatus)+
                              "&SelectedPriority="+encodeURIComponent(SelectedPriority);
                              //  alert(datas);
                              	 // var datas = "&WeeklyCondition="+WeeklyCondition+"&WeeklyRecurrance="+WeeklyRecurrance+"&TaskEndAt="+TaskEndAt+"&NoofOccurances="+NoofOccurances+"&TaskDescrtiption="+TaskDescrtiption+"&SelectedProject="+SelectedProject+"&SelectedAssignedTo="+SelectedAssignedTo+"&SelectedPriority="+SelectedPriority;
                              	 //alert (datas);
                              	 $.ajax({
                                  url:"addWeeklytask.php",
                                  method:"POST",
                                  data:datas,
                                  success:function(data)
                                  {
                                  // $('#AddTask')[0].reset();
                                 // //alert("OK");
                                 // //alert (data);
                                   LoadTask();
                                  }
                                 });
                              	  }   
                              }
                              
                               
                              function FindMonthlyCondition(Condition)
                               
                              {
                              	
                              	var MonthlyCondition = Condition;
                              	////alert (DailyCondition);
                              	if (MonthlyCondition =="Monthly_Date")
                              	{
                              		document.getElementById("txtMonthlyDate").disabled = false;
                              		document.getElementById("txtMonthlyDateNumberofMonth").disabled = false;
                              		document.getElementById("txtMonthlyDate").value='1';
                              		document.getElementById("txtMonthlyDateNumberofMonth").value='1';
                              		document.getElementById("txtMonthlyDate").select();
                              		document.getElementById("txtMonthlyDate").focus();
                              		document.getElementById("SelectMonthly_WeekOrder").disabled = true;
                              		document.getElementById("SelectMonthly_Day").disabled = true;
                              		document.getElementById("txtMonthlyDayNumberofMonth").disabled = true;
                              		document.getElementById("txtMonthlyDayNumberofMonth").value='';
                              		document.getElementById("txtMonthlyValue").value='D';
									
                              	}
                              	else
                              	{
									
                              		document.getElementById("SelectMonthly_WeekOrder").disabled = false;
                              		document.getElementById("SelectMonthly_Day").disabled = false;
                              		document.getElementById("txtMonthlyDayNumberofMonth").disabled = false;
                              		document.getElementById("txtMonthlyDayNumberofMonth").value='1';
                              		document.getElementById("SelectMonthly_WeekOrder").focus();
                              		document.getElementById("txtMonthlyDate").disabled = true;
                              		document.getElementById("txtMonthlyDateNumberofMonth").disabled = true;
                              		document.getElementById("txtMonthlyDate").value='';
                              		document.getElementById("txtMonthlyDateNumberofMonth").value='';
                              		document.getElementById("txtMonthlyValue").value='W';
                              	}
                              	 
                              }
                              
                              function  FindMonthlyRecurrance(Recurrance)
                              { 
                              	var MonthlyRecurrance = Recurrance;
                              	////alert (WeeklyRecurrance);
                              	if (MonthlyRecurrance =="Monthly_NoEnd")
                              	{
                              		document.getElementById("txtMonthlyRecurranceRange").value= 'NoEnd';
                              	}
                              	else if (MonthlyRecurrance =="Monthly_EndBy")
                              	{
                              		document.getElementById("txtMonthlyRecurranceRange").value= 'EndBy';
                              	}
                              	else
                              	{
                              		document.getElementById("txtMonthlyRecurranceRange").value= 'EndAfter';
                              	}
                              	
                              } 
                               
                               
                              function SaveMonthlyTask()
                              {
                              	var Condition= 'Monthly';
                              	////alert("Daily");
                              	var M_Condition =document.getElementById("txtMonthlyValue").value;
                              	
                              	
                              	var M_Date =document.getElementById("txtMonthlyDate").value;
                              	var M_DateMonthFrequency =document.getElementById("txtMonthlyDateNumberofMonth").value;
                              	
                              	var M_WeekOrder =document.getElementById("SelectMonthly_WeekOrder").value;
                              	var M_DayName =document.getElementById("SelectMonthly_Day").value;
                              	var M_DayMonthFrequency =document.getElementById("txtMonthlyDayNumberofMonth").value;
                              	
                              	  
                              	var M_Recurrance = document.getElementById("txtMonthlyRecurranceRange").value
                              	
                              	var TaskDescrtiption= document.getElementById("TaskDescrtiption").value; 
                              	// alert(1);
                              	 var SelectClient = document.getElementById("SelectClient").value;  
                              	 var SelectedProject = document.getElementById("SelectProject").value;  
                              
                              	 var SelectedSubProject = document.getElementById("SelectSubProject").value;  
                              
                              	 var SelectCategory = document.getElementById("SelectCategory").value;  
                              	 var SelectEstimatedTime = document.getElementById("SelectEstimatedTime").value;   
                                   var SelectedAssignedTo= document.getElementById("SelectAssignedTo").value;  
                              
                              var SelectedPriority = $("input[name='rdPriority']:checked").val();
                              var BillableStatus = $("input[name='rdBillable']:checked").val();
                              if (BillableStatus=='on')
                              {
                              BillableStatus=1;
                              
                              }
                              else
                              {
                              BillableStatus=0;  
                              }
                              
                              //alert(2);
                              var Tags=document.getElementById("SelectTags");
                              var Arr_Tags = []; 
                              for (var i = 0; i < Tags.options.length; i++) {
                              
                                if(Tags.options[i].selected ==true){
                              
                                     // alert("'" + x.options[i].value + "'" );
                              Arr_Tags.push(Tags.options[i].value);
                              
                                 }
                              }
                              var SelectedTags = "'" + Arr_Tags.join("','")+ "'"
                              
                              
                              	  
                              	 if (M_Recurrance =="NoEnd")
                              	 {
                              		 var TaskEndAt = '1900/01/01';
                              		 var NoofOccurances ='0';
                              	 }
                              	 else if (M_Recurrance =="EndBy")
                              	 {
                              		 var TaskEndAt =  document.getElementById("dtEndDate_Monthly").value;  
                              		 var NoofOccurances ='0';
                              	 }
                              	 else
                              	 {
                              		 var M_Recurrance =   '1900/01/01';
                              		 var NoofOccurances = document.getElementById("txtEndafter_Monthly").value;  
                              	 }
                              	  
                              	   if (TaskDescrtiption=="" || SelectCategory=="")
                              	  {
                              		    swal("Alert!", "Enter all required details !", "warning");
                              	  }
                              	  else
                              	  {
                              		  
                              	 // var datas = "&M_Condition="+M_Condition+"&M_Date="+M_Date+"&M_DateMonthFrequency="+M_DateMonthFrequency+"&M_WeekOrder="+M_WeekOrder+"&M_DayName="+M_DayName+"&M_DayMonthFrequency="+M_DayMonthFrequency+"&M_Recurrance="+M_Recurrance+"&TaskEndAt="+TaskEndAt+"&NoofOccurances="+NoofOccurances+"&TaskDescrtiption="+TaskDescrtiption+"&SelectedProject="+SelectedProject+"&SelectedAssignedTo="+SelectedAssignedTo+"&SelectedPriority="+SelectedPriority;
                              
                              var datas = "&TaskDescrtiption="+encodeURIComponent(TaskDescrtiption)+
                              "&M_Condition="+M_Condition+
                              "&M_Date="+M_Date+
                              "&M_DateMonthFrequency="+M_DateMonthFrequency+
                              "&M_WeekOrder="+M_WeekOrder+
                              "&M_DayName="+M_DayName+
                              "&M_DayMonthFrequency="+M_DayMonthFrequency+
                              "&M_Recurrance="+M_Recurrance+ 
                              "&SelectClient="+encodeURIComponent(SelectClient)+
                              "&SelectedProject="+encodeURIComponent(SelectedProject)+
                              "&SelectedSubProject="+encodeURIComponent(SelectedSubProject)+
                              "&SelectCategory="+encodeURIComponent(SelectCategory)+
                              "&SelectEstimatedTime="+encodeURIComponent(SelectEstimatedTime)+
                              "&SelectedAssignedTo="+encodeURIComponent(SelectedAssignedTo)+
                              "&SelectedTags="+encodeURIComponent(SelectedTags)+
                              "&BillableStatus="+encodeURIComponent(BillableStatus)+
                              "&SelectedPriority="+encodeURIComponent(SelectedPriority);
                              //  alert(datas);
                              
                              
                              	//  //alert (datas);
                              	 $.ajax({
                                  url:"addMonthlytask.php",
                                  method:"POST",
                                  data:datas,
                                  success:function(data)
                                  {
                                  // $('#AddTask')[0].reset();
                                  //alert(data);
                                   LoadTask();
                                  }
                                 }); 
                              	  }
                              }
                               
                              function FindQuarterlyCondition(Condition)
                               
                              {
                              	
                              	var QuarterlyCondition = Condition;
                              	////alert (DailyCondition);
                              	if (QuarterlyCondition =="Quarterly_Date")
                              	{
                              		document.getElementById("txtQuarterlyDate").disabled = false; 
                              		document.getElementById("dtQuarterlyTimeLine").disabled = false; 
                              		document.getElementById("txtQuarterlyDate").value='1'; 
                              		document.getElementById("txtQuarterlyDate").select();
                              		document.getElementById("txtQuarterlyDate").focus();
                              		
                              		document.getElementById("SelectQuarterly_WeekOrder").disabled = true;
                              		document.getElementById("SelectQuarterly_Day").disabled = true;
                              		 
                              		document.getElementById("txtQuarterlyValue").value='D';
                              		////alert ("D");
                              		
                              	}
                              	else
                              	{
                              		
                              		document.getElementById("txtQuarterlyDate").disabled = true; 
									document.getElementById("dtQuarterlyTimeLine").disabled = true; 
                              		document.getElementById("txtQuarterlyDate").value=''; 
                              		 
                              		document.getElementById("SelectQuarterly_WeekOrder").disabled = false;
                              			
                              		document.getElementById("SelectQuarterly_WeekOrder").focus();
                              		
                              		document.getElementById("SelectQuarterly_Day").disabled = false;
                              		 
                              		document.getElementById("txtQuarterlyValue").value='W';
                              	////alert ("W"); 
                              	}
                              	 
                              }
                              
                              function  FindQuarterlyRecurrance(Recurrance)
                              { 
                              	var QuarterlyRecurrance = Recurrance;
                              	////alert (WeeklyRecurrance);
                              	if (QuarterlyRecurrance =="Quarterly_NoEnd")
                              	{
                              		document.getElementById("txtQuarterlyRecurranceRange").value= 'NoEnd';
                              	}
                              	else if (QuarterlyRecurrance =="Quarterly_EndBy")
                              	{
                              		document.getElementById("txtQuarterlyRecurranceRange").value= 'EndBy';
                              	}
                              	else
                              	{
                              		document.getElementById("txtQuarterlyRecurranceRange").value= 'EndAfter';
                              	}
                              	
                              } 
                               
                               
                              function SaveQuarterlyTask()
                              {
                              	var Condition= 'Quarterly';
                              	////alert("Daily");
                              	var Q_Condition =document.getElementById("txtQuarterlyValue").value;
                              	 
                              	var Q_Date =document.getElementById("txtQuarterlyDate").value;
                              	 
                              	
                              	var Q_WeekOrder =document.getElementById("SelectQuarterly_WeekOrder").value;
                              	var Q_DayName =document.getElementById("SelectQuarterly_Day").value; 
                              	  
                              	var Q_Recurrance = document.getElementById("txtQuarterlyRecurranceRange").value
                              	
                              	 var TaskDescrtiption= document.getElementById("TaskDescrtiption").value; 
                              	// alert(1);
                              	 var SelectClient = document.getElementById("SelectClient").value;  
                              	 var SelectedProject = document.getElementById("SelectProject").value;  
                              
                              	 var SelectedSubProject = document.getElementById("SelectSubProject").value;  
                              
                              	 var SelectCategory = document.getElementById("SelectCategory").value;  
                              	 var SelectEstimatedTime = document.getElementById("SelectEstimatedTime").value;   
                                   var SelectedAssignedTo= document.getElementById("SelectAssignedTo").value;  
                                   var dtQuarterlyTimeLine= document.getElementById("dtQuarterlyTimeLine").value;  
                              
                              var SelectedPriority = $("input[name='rdPriority']:checked").val();
                              var BillableStatus = $("input[name='rdBillable']:checked").val();
                              if (BillableStatus=='on')
                              {
                              BillableStatus=1;
                              
                              }
                              else
                              {
                              BillableStatus=0;  
                              }
                              
                              //alert(2);
                              var Tags=document.getElementById("SelectTags");
                              var Arr_Tags = []; 
                              for (var i = 0; i < Tags.options.length; i++) {
                              
                                if(Tags.options[i].selected ==true){
                              
                                     // alert("'" + x.options[i].value + "'" );
                              Arr_Tags.push(Tags.options[i].value);
                              
                                 }
                              }
                              var SelectedTags = "'" + Arr_Tags.join("','")+ "'"
                                
                              	  
                              	 if (Q_Recurrance =="NoEnd")
                              	 {
                              		 var TaskEndAt = '1900/01/01';
                              		 var NoofOccurances ='0';
                              	 }
                              	 else if (Q_Recurrance =="EndBy")
                              	 {
                              		 var TaskEndAt =  document.getElementById("dtEndDate_Quarterly").value;  
                              		 var NoofOccurances ='0';
                              	 }
                              	 else
                              	 {
                              		 var Q_Recurrance =   '1900/01/01';
                              		 var NoofOccurances = document.getElementById("txtEndafter_Quarterly").value;  
                              	 }
                              	  
                              	   if (TaskDescrtiption=="" || SelectCategory=="")
                              	  {
                              		    swal("Alert!", "Enter all required details !", "warning");
                              	  }
                              	  else
                              	  {
                              		  
                              	 var datas = "&TaskDescrtiption="+encodeURIComponent(TaskDescrtiption)+"&Q_Condition="+Q_Condition+"&Q_Date="+Q_Date+"&Q_WeekOrder="+Q_WeekOrder+"&Q_DayName="+Q_DayName+"&Q_Recurrance="+Q_Recurrance+"&TaskEndAt="+TaskEndAt+"&NoofOccurances="+NoofOccurances+ "&SelectClient="+encodeURIComponent(SelectClient)+
                              "&SelectedProject="+encodeURIComponent(SelectedProject)+
                              "&SelectedSubProject="+encodeURIComponent(SelectedSubProject)+
                              "&SelectCategory="+encodeURIComponent(SelectCategory)+
                              "&SelectEstimatedTime="+encodeURIComponent(SelectEstimatedTime)+
                              "&SelectedAssignedTo="+encodeURIComponent(SelectedAssignedTo)+
                              "&SelectedTags="+encodeURIComponent(SelectedTags)+
                              "&BillableStatus="+encodeURIComponent(BillableStatus)+
                              "&SelectedPriority="+encodeURIComponent(SelectedPriority)+
							  "&dtQuarterlyTimeLine="+dtQuarterlyTimeLine;
                              	//  //alert (datas);
                              	 $.ajax({
                                  url:"addQuarterlytask.php",
                                  method:"POST",
                                  data:datas,
                                  success:function(data)
                                  {
                                  // $('#AddTask')[0].reset();
                                  alert(data);
                                   LoadTask();
                                  }
                                 }); 
                              	  }
                              }
                              
                              
                              
                              function FindHalfYearlyCondition(Condition)
                               
                              {
                              	
                              	var HalfYearlyCondition = Condition;
                              	////alert(HalfYearlyCondition);
                              	////alert (DailyCondition);
                              	if (HalfYearlyCondition =="Halfyearly_Date")
                              	{
                              		document.getElementById("txtHalfyearlyDate").disabled = false; 
                              		document.getElementById("txtHalfyearlyDate").value='1'; 
                              		document.getElementById("txtHalfyearlyDate").select();
                              		document.getElementById("txtHalfyearlyDate").focus();
                              		
                              		document.getElementById("SelectHalfyearly_WeekOrder").disabled = true;
                              		document.getElementById("SelectHalfyearly_Day").disabled = true;
                              		 
                              		document.getElementById("txtHalfyearlyValue").value='D';
                              		////alert ("d");
                              		
                              	}
                              	else
                              	{
                              		
                              		document.getElementById("txtHalfyearlyDate").disabled = true; 
                              		document.getElementById("txtHalfyearlyDate").value=''; 
                              		
                              		
                              		document.getElementById("SelectHalfyearly_WeekOrder").disabled = false;
                               
                              		document.getElementById("SelectHalfyearly_WeekOrder").focus();
                              		document.getElementById("SelectHalfyearly_Day").disabled = false;
                              		 
                              		document.getElementById("txtHalfyearlyValue").value='W';
                              		
                              		 ////alert ("W");
                              	}
                              	 
                              }
                              
                              function  FindHalfYearlyRecurrance(Recurrance)
                              { 
                              	var HalfYearlyRecurrance = Recurrance;
                              	////alert (WeeklyRecurrance);
                              	if (HalfYearlyRecurrance =="Halfyearly_NoEnd")
                              	{
                              		document.getElementById("txtHalfyearlyRecurranceRange").value= 'NoEnd';
                              	}
                              	else if (HalfYearlyRecurrance =="Halfyearly_EndBy")
                              	{
                              		document.getElementById("txtHalfyearlyRecurranceRange").value= 'EndBy';
                              	}
                              	else
                              	{
                              		document.getElementById("txtHalfyearlyRecurranceRange").value= 'EndAfter';
                              	}
                              	
                              } 
                               
                               
                              function SaveHalfYearlyTask()
                              {
                              	var Condition= 'HalfYearly';
                               
                              	var H_Condition =document.getElementById("txtHalfyearlyValue").value;
                              	 
                              	var H_Date =document.getElementById("txtHalfyearlyDate").value;
                              	   
                              	
                              	var H_WeekOrder =document.getElementById("SelectHalfyearly_WeekOrder").value;
                              	var H_DayName =document.getElementById("SelectHalfyearly_Day").value; 
                              	   
                              	var H_Recurrance = document.getElementById("txtHalfyearlyRecurranceRange").value
                              	 
                              	  var TaskDescrtiption= document.getElementById("TaskDescrtiption").value; 
                              	// alert(1);
                              	 var SelectClient = document.getElementById("SelectClient").value;  
                              	 var SelectedProject = document.getElementById("SelectProject").value;  
                              
                              	 var SelectedSubProject = document.getElementById("SelectSubProject").value;  
                              
                              	 var SelectCategory = document.getElementById("SelectCategory").value;  
                              	 var SelectEstimatedTime = document.getElementById("SelectEstimatedTime").value;   
                                   var SelectedAssignedTo= document.getElementById("SelectAssignedTo").value;  
                              
                              var SelectedPriority = $("input[name='rdPriority']:checked").val(); 
							  
                              var BillableStatus = $("input[name='rdBillable']:checked").val();
                              if (BillableStatus=='on')
                              {
                              BillableStatus=1;
                              
                              }
                              else
                              {
                              BillableStatus=0;  
                              }
                              
                                
                              var Tags=document.getElementById("SelectTags");
                              var Arr_Tags = []; 
                              for (var i = 0; i < Tags.options.length; i++) {
                              
                                if(Tags.options[i].selected ==true){
                              
                                     // alert("'" + x.options[i].value + "'" );
                              Arr_Tags.push(Tags.options[i].value);
                              
                                 }
                              }
                              var SelectedTags = "'" + Arr_Tags.join("','")+ "'"
                              	  
                              	 if (H_Recurrance =="NoEnd")
                              	 {
                              		 var TaskEndAt = '1900/01/01';
                              		 var NoofOccurances ='0';
                              	 }
                              	 else if (H_Recurrance =="EndBy")
                              	 {
                              		 var TaskEndAt =  document.getElementById("dtEndDate_Halfyearly").value;  
                              		 var NoofOccurances ='0';
                              	 }
                              	 else
                              	 {
                              		 var H_Recurrance =   '1900/01/01';
                              		 var NoofOccurances = document.getElementById("txtEndafter_Halfyearly").value;  
                              	 }
								 
                              	  
                              	   if (TaskDescrtiption=="" || SelectCategory=="")
                              	  {
                              		    swal("Alert!", "Enter all required details !", "warning");
                              	  }
                              	  else
                              	  {
                              		   
                              	 var datas = "&TaskDescrtiption="+encodeURIComponent(TaskDescrtiption)+"&H_Condition="+H_Condition+"&H_Date="+H_Date+"&H_WeekOrder="+H_WeekOrder+"&H_DayName="+H_DayName+"&H_Recurrance="+H_Recurrance+"&TaskEndAt="+TaskEndAt+"&NoofOccurances="+NoofOccurances+ "&SelectClient="+encodeURIComponent(SelectClient)+
                              "&SelectedProject="+encodeURIComponent(SelectedProject)+
                              "&SelectedSubProject="+encodeURIComponent(SelectedSubProject)+
                              "&SelectCategory="+encodeURIComponent(SelectCategory)+
                              "&SelectEstimatedTime="+encodeURIComponent(SelectEstimatedTime)+
                              "&SelectedAssignedTo="+encodeURIComponent(SelectedAssignedTo)+
                              "&SelectedTags="+encodeURIComponent(SelectedTags)+
                              "&BillableStatus="+encodeURIComponent(BillableStatus)+
                              "&SelectedPriority="+encodeURIComponent(SelectedPriority);
                              	 
                              	 $.ajax({
                                  url:"addHalfYearlytask.php",
                                  method:"POST",
                                  data:datas,
                                  success:function(data)
                                  {
                                  // $('#AddTask')[0].reset();
                                  //document.getElementById("txtQueryCheck").value =data;
                                    LoadTask();
                                  }
                                 }); 
                              	  }
                              }
                              
                              
                              
                              
                              function FindYearlyCondition(Condition)
                               
                              {
                              	
                              	var YearlyCondition = Condition;
                              	////alert(YearlyCondition);
                              	////alert (DailyCondition);
                              	if (YearlyCondition =="Yearly_Date")
                              	{
                              		document.getElementById("txtYearlyDate").disabled = false; 
                              		document.getElementById("SelectYearly_Month").disabled = false;
                              		document.getElementById("txtYearlyDate").value='1'; 
                              		document.getElementById("txtYearlyDate").select();
                              		document.getElementById("txtYearlyDate").focus();
                              		
                              		document.getElementById("SelectYearly_WeekOrder").disabled = true;
                              		document.getElementById("SelectYearly_Day").disabled = true;
                              		document.getElementById("SelectYearly_MonthforWeek").disabled = true;
                              		 
                              		document.getElementById("txtYearlyValue").value='D';
                              		////alert ("d");
                              		
                              	}
                              	else
                              	{
                              		
                              		document.getElementById("txtYearlyDate").disabled = true; 
                              		document.getElementById("SelectYearly_Month").disabled = true;
                              		document.getElementById("txtYearlyDate").value=''; 
                              		
                              		
                              		document.getElementById("SelectYearly_WeekOrder").disabled = false;
                              		 
                              		document.getElementById("SelectYearly_MonthforWeek").disabled = false;
                               
                              		document.getElementById("SelectYearly_WeekOrder").focus();
                              		document.getElementById("SelectYearly_Day").disabled = false;
                              		 
                              		document.getElementById("txtYearlyValue").value='W';
                              		
                              		// //alert ("W");
                              	}
                              	 
                              }
                              
                              function  FindYearlyRecurrance(Recurrance)
                              { 
                              	var YearlyRecurrance = Recurrance;
                              	////alert (WeeklyRecurrance);
                              	if (YearlyRecurrance =="Yearly_NoEnd")
                              	{
                              		document.getElementById("txtYearlyRecurranceRange").value= 'NoEnd';
                              	}
                              	else if (YearlyRecurrance =="Yearly_EndBy")
                              	{
                              		document.getElementById("txtYearlyRecurranceRange").value= 'EndBy';
                              	}
                              	else
                              	{
                              		document.getElementById("txtYearlyRecurranceRange").value= 'EndAfter';
                              	}
                              	
                              } 
                               
                                
                               
                              function SaveYearlyTask()
                              {
                              	var Condition= 'Yearly';
                              
                              	var Y_Condition =document.getElementById("txtYearlyValue").value;
                              	 	 //alert(Y_Condition);
                              	var Y_Date =document.getElementById("txtYearlyDate").value;
                              	 
                              	
                              	var Y_WeekOrder =document.getElementById("SelectYearly_WeekOrder").value;
                              	var Y_DayName =document.getElementById("SelectYearly_Day").value; 
                              	var Y_Month =document.getElementById("SelectYearly_Month").value; 
                              	var Y_MonthforWeek =document.getElementById("SelectYearly_MonthforWeek").value; 
                              	  
                              	var Y_Recurrance = document.getElementById("txtYearlyRecurranceRange").value
                              	
                              	                               	 var TaskDescrtiption= document.getElementById("TaskDescrtiption").value; 
                              	// alert(1);
                              	 var SelectClient = document.getElementById("SelectClient").value;  
                              	 var SelectedProject = document.getElementById("SelectProject").value;  
                              
                              	 var SelectedSubProject = document.getElementById("SelectSubProject").value;  
                              
                              	 var SelectCategory = document.getElementById("SelectCategory").value;  
                              	 var SelectEstimatedTime = document.getElementById("SelectEstimatedTime").value;   
                                   var SelectedAssignedTo= document.getElementById("SelectAssignedTo").value;  
                              
                              var SelectedPriority = $("input[name='rdPriority']:checked").val();
                              var BillableStatus = $("input[name='rdBillable']:checked").val();
                              if (BillableStatus=='on')
                              {
                              BillableStatus=1;
                              
                              }
                              else
                              {
                              BillableStatus=0;  
                              }
                              
                              //alert(2);
                              var Tags=document.getElementById("SelectTags");
                              var Arr_Tags = []; 
                              for (var i = 0; i < Tags.options.length; i++) {
                              
                                if(Tags.options[i].selected ==true){
                              
                                     // alert("'" + x.options[i].value + "'" );
                              Arr_Tags.push(Tags.options[i].value);
                              
                                 }
                              }
                              var SelectedTags = "'" + Arr_Tags.join("','")+ "'"  
                              	  
                              	 if (Y_Recurrance =="NoEnd")
                              	 {
                              		 var TaskEndAt = '1900/01/01';
                              		 var NoofOccurances ='0';
                              	 }
                              	 else if (Y_Recurrance =="EndBy")
                              	 {
                              		 var TaskEndAt =  document.getElementById("dtEndDate_Yearly").value;  
                              		 var NoofOccurances ='0';
                              	 }
                              	 else
                              	 {
                              		 var Y_Recurrance =   '1900/01/01';
                              		 var NoofOccurances = document.getElementById("txtEndafter_Yearly").value;  
                              	 }
                              	  
                              	  if (TaskDescrtiption=="" || SelectCategory=="")
                              	  {
                              		    swal("Alert!", "Enter all required details !", "warning");
                              	  }
                              	  else
                              	  {
                              		  
                              	 var datas = "&TaskDescrtiption="+TaskDescrtiption+"&Y_Condition="+Y_Condition+"&Y_Date="+Y_Date+"&Y_WeekOrder="+Y_WeekOrder+"&Y_DayName="+Y_DayName+"&Y_Month="+Y_Month+"&Y_MonthforWeek="+Y_MonthforWeek+"&Y_Recurrance="+Y_Recurrance+"&TaskEndAt="+TaskEndAt+"&NoofOccurances="+NoofOccurances+"&SelectClient="+encodeURIComponent(SelectClient)+
                              "&SelectedProject="+encodeURIComponent(SelectedProject)+
                              "&SelectedSubProject="+encodeURIComponent(SelectedSubProject)+
                              "&SelectCategory="+encodeURIComponent(SelectCategory)+
                              "&SelectEstimatedTime="+encodeURIComponent(SelectEstimatedTime)+
                              "&SelectedAssignedTo="+encodeURIComponent(SelectedAssignedTo)+
                              "&SelectedTags="+encodeURIComponent(SelectedTags)+
                              "&BillableStatus="+encodeURIComponent(BillableStatus)+
                              "&SelectedPriority="+encodeURIComponent(SelectedPriority);
                              	//  //alert (datas);
                              	 $.ajax({
                                  url:"addYearlytask.php",
                                  method:"POST",
                                  data:datas,
                                  success:function(data)
                                  {
                                  // $('#AddTask')[0].reset();
                                  //alert(data);
                                   LoadTask();
                                  }
                                 }); 
                              	  }
                              }
                              
                               
                              function findselected(SelectedPeriod) { 
                              
                                  var result = SelectedPeriod; //document.querySelector(SelectedPeriod).value;
                              	var DivDaily = document.getElementById("DivDaily");
                              	var DivWeekly = document.getElementById("DivWeekly");
                              	var DivMonthly = document.getElementById("DivMonthly");
                                  var DivQuarterly = document.getElementById("DivQuarterly");
                                  var DivHalfyearly = document.getElementById("DivHalfyearly");
                                  var DivYearly = document.getElementById("DivYearly");
                                
                                
                                  if(result=="Daily"){
                              
                                      // document.getElementById("inputtext").setAttribute('disabled', true);
                              	DivDaily.style.display = "block";
                              	DivWeekly.style.display = "none";
                              	DivMonthly.style.display = "none";
                              	DivQuarterly.style.display = "none";
                              	DivHalfyearly.style.display = "none";
                              	DivYearly.style.display = "none";
                              	document.getElementById("txtRecurrance").value= 'Daily';
                              	document.getElementById("btnDailyTask").style.display = '';
                              	document.getElementById("btnMonthlyTask").style.display = 'none';
                              	document.getElementById("btnWeeklyTask").style.display = 'none';
                              	document.getElementById("btnQuarterlyTask").style.display = 'none';
                              	document.getElementById("btnHalYearlyTask").style.display = 'none';
                              	document.getElementById("btnYearlyTask").style.display = 'none';
                              	document.getElementById("btnIncidentalTaskTask").style.display = 'none';
                              	
                                  }
                                  else 
                              	if(result=="Weekly")
                              	{
                                      //document.getElementById("inputtext").removeAttribute('disabled');
                              	 DivDaily.style.display = "none";
                              	DivWeekly.style.display = "block";
                              	DivMonthly.style.display = "none";
                              	DivQuarterly.style.display = "none";
                              	DivHalfyearly.style.display = "none";
                              	DivYearly.style.display = "none";
                              	document.getElementById("txtRecurrance").value= 'Weekly';
                              	document.getElementById("btnDailyTask").style.display = 'none';
                              	document.getElementById("btnMonthlyTask").style.display = 'none';
                              	document.getElementById("btnWeeklyTask").style.display = '';
                              	document.getElementById("btnQuarterlyTask").style.display = 'none';
                              	document.getElementById("btnHalYearlyTask").style.display = 'none';
                              	document.getElementById("btnYearlyTask").style.display = 'none';
                              	document.getElementById("btnIncidentalTaskTask").style.display = 'none';
                                  }
                              	else 
                              	if(result=="Monthly")
                              	{
                                      //document.getElementById("inputtext").removeAttribute('disabled');
                              	 DivDaily.style.display = "none";
                              	DivWeekly.style.display = "none";
                              	DivMonthly.style.display = "block";
                              	DivQuarterly.style.display = "none";
                              	DivHalfyearly.style.display = "none";
                              	DivYearly.style.display = "none";
                              	document.getElementById("txtRecurrance").value= 'Monthly';
                              	document.getElementById("btnDailyTask").style.display = 'none';
                              	document.getElementById("btnMonthlyTask").style.display = '';
                              	document.getElementById("btnWeeklyTask").style.display = 'none';
                              	document.getElementById("btnQuarterlyTask").style.display = 'none';
                              	document.getElementById("btnHalYearlyTask").style.display = 'none';
                              	document.getElementById("btnYearlyTask").style.display = 'none';
                              	document.getElementById("btnIncidentalTaskTask").style.display = 'none';
                                  }
                              	else
                              	if(result=="Quarterly")
                              	{
                                      //document.getElementById("inputtext").removeAttribute('disabled');
                              	 DivDaily.style.display = "none";
                              	DivWeekly.style.display = "none";
                              	DivMonthly.style.display = "none";
                              	DivQuarterly.style.display = "block";
                              	DivHalfyearly.style.display = "none";
                              	DivYearly.style.display = "none";
                              	document.getElementById("txtRecurrance").value= 'Quarterly';
                              	document.getElementById("btnDailyTask").style.display = 'none';
                              	document.getElementById("btnMonthlyTask").style.display = 'none';
                              	document.getElementById("btnWeeklyTask").style.display = 'none';
                              	document.getElementById("btnQuarterlyTask").style.display = '';
                              	document.getElementById("btnHalYearlyTask").style.display = 'none';
                              	document.getElementById("btnYearlyTask").style.display = 'none';
                              	document.getElementById("btnIncidentalTaskTask").style.display = 'none';
                                  }
                              	else
                              	if(result=="HalfYearly")
                              	{
                                      //document.getElementById("inputtext").removeAttribute('disabled');
                              	 DivDaily.style.display = "none";
                              	DivWeekly.style.display = "none";
                              	DivMonthly.style.display = "none";
                              	DivQuarterly.style.display = "none";
                              	DivHalfyearly.style.display = "block";
                              	DivYearly.style.display = "none";
                              	document.getElementById("txtRecurrance").value= 'HalfYearly';
                              	document.getElementById("btnDailyTask").style.display = 'none';
                              	document.getElementById("btnMonthlyTask").style.display = 'none';
                              	document.getElementById("btnWeeklyTask").style.display = 'none';
                              	document.getElementById("btnQuarterlyTask").style.display = 'none';
                              	document.getElementById("btnHalYearlyTask").style.display = '';
                              	document.getElementById("btnYearlyTask").style.display = 'none';
                              	document.getElementById("btnIncidentalTaskTask").style.display = 'none';
                                  }
                              	else
                              	if(result=="Yearly")
                              	{
                                      //document.getElementById("inputtext").removeAttribute('disabled');
                              	 DivDaily.style.display = "none";
                              	DivWeekly.style.display = "none";
                              	DivMonthly.style.display = "none";
                              	DivQuarterly.style.display = "none";
                              	DivHalfyearly.style.display = "none";
                              	DivYearly.style.display = "block";
                              	document.getElementById("txtRecurrance").value= 'Yearly';
                              	document.getElementById("btnDailyTask").style.display = 'none';
                              	document.getElementById("btnMonthlyTask").style.display = 'none';
                              	document.getElementById("btnWeeklyTask").style.display = 'none';
                              	document.getElementById("btnQuarterlyTask").style.display = 'none';
                              	document.getElementById("btnHalYearlyTask").style.display = 'none';
                              	document.getElementById("btnYearlyTask").style.display = '';
                              	document.getElementById("btnIncidentalTaskTask").style.display = 'none';
                                  }
                              	else
                              	if(result=="OneTime")
                              	{
                                      //document.getElementById("inputtext").removeAttribute('disabled');
                              	 DivDaily.style.display = "none";
                              	DivWeekly.style.display = "none";
                              	DivMonthly.style.display = "none";
                              	DivQuarterly.style.display = "none";
                              	DivHalfyearly.style.display = "none";
                              	DivYearly.style.display = "none"; 
                              	document.getElementById("btnDailyTask").style.display = 'none';
                              	document.getElementById("btnMonthlyTask").style.display = 'none';
                              	document.getElementById("btnWeeklyTask").style.display = 'none';
                              	document.getElementById("btnQuarterlyTask").style.display = 'none';
                              	document.getElementById("btnHalYearlyTask").style.display = 'none';
                              	document.getElementById("btnYearlyTask").style.display = 'none';
                              	document.getElementById("btnIncidentalTaskTask").style.display = '';
                                  }
                              }
                              
                              
                              function GetPointID(x)
                              {
                              var SelectedColumn = x.cellIndex;
                              var SelectedRow = x.parentNode.rowIndex;
                              
                              //var Id = document.getElementById("indextable").rows[SelectedRow].cells[0].innerHTML;  
                              var Id = document.getElementById("indextable").rows[SelectedRow].cells.namedItem("tblTaskId").innerHTML; 
                              document.getElementById("txtObservationIDforUploadAttachment").value = Id;
                              document.getElementById("txtSelectedRowForUploadAttachment").value = SelectedRow; 
                              LoadAttachments();
                              
                              
                              }
							  
							  function UpdateLastReviewDate(x)
							  {
								   
                              var SelectedColumn = x.cellIndex;
                              var SelectedRow = x.parentNode.rowIndex;
                               
                              // var Id = document.getElementById("indextable").rows[SelectedRow].cells[0].innerHTML; 
                              var Id = document.getElementById("indextable").rows[SelectedRow].cells.namedItem("tblTaskId").innerHTML;
                               // alert (Id);
                              var datas = "&Id="+Id;
                              //alert(datas);
                              $.ajax({
                              method: 'POST',
                              url:"UpdateReviewDate.php",
                              data:datas,
                              success:function(response)
                              {
                              
                              //  alert(response);
                              //document.getElementById("indextable").deleteRow(SelectedRow);
                             
                              LoadTask();
                              }
                              });
                              
                              
							  }
							  
                              
                              function DeleteConfirmation(x){
                              
                              swal({
                              title: "Are you sure?",
                              text: "Want to delete the selected point !", 
                              icon: "warning",
                              buttons: true,
                              dangerMode: true,
                              // dangerMode: true,
                              })
                              .then((willDelete) => {
                              if (willDelete) {
                              
                              var SelectedColumn = x.cellIndex;
                              var SelectedRow = x.parentNode.rowIndex;
                              
                              
                              // var Id = document.getElementById("indextable").rows[SelectedRow].cells[0].innerHTML; 
                              var Id = document.getElementById("indextable").rows[SelectedRow].cells.namedItem("tblTaskId").innerHTML;
                              //alert (Id);
                              var datas = "&Id="+Id;
                              //alert(datas);
                              $.ajax({
                              method: 'POST',
                              url:"DeleteTask.php",
                              data:datas,
                              success:function(response)
                              {
                              
                              //  alert(response);
                              //document.getElementById("indextable").deleteRow(SelectedRow);
                              swal("Deleted!", "Selected point has been deleted.", "success");
                              LoadTask();
                              }
                              });
                              
                              
                              // swal("Selected task has been deleted!", {
                              // icon: "success",
                              // });
                              }
                              else {
                              
                              }
                              });
                              
                              }
                              
                              
                              																
                            </script>
                            <div class="form-group" name="DivRoutineBreakup" id="DivRoutineBreakup" style="display:none;" >
                              <hr>
                              <input type ='hidden' id='txtRecurrance' name ='txtRecurrance' />
                              <div class="col-md-4 col-sm-4">
                                <div class="radio">
                                  <label>
                                  <input type="radio" name="rdSelect" id="rdSelectDaily" value="Daily" onclick="findselected(this.value)"  data-parsley-required="true" /> Daily
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                  <input type="radio" name="rdSelect" id="rdSelectWeekly" value="Weekly" onclick="findselected(this.value)"/> Weekly
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                  <input type="radio" name="rdSelect" id="rdSelectMonthly" value="Monthly"  onclick="findselected(this.value)"/> Monthly
                                  </label>
                                </div>
                                <div class="radio" style="display:;">
                                  <label>
                                  <input type="radio" name="rdSelect" id="rdSelectQuarterly" value="Quarterly"  onclick="findselected(this.value)"/> Quarterly
                                  </label>
                                </div>
                                <div class="radio" style="display:;">
                                  <label>
                                  <input type="radio" name="rdSelect" id="rdSelectHalfYearly"  value="HalfYearly" onclick="findselected(this.value)"  /> Half Yearly
                                  </label>
                                </div>
                                <div class="radio" style="display:;">
                                  <label>
                                  <input type="radio" name="rdSelect" id="rdSelectYearly" value="Yearly"  onclick="findselected(this.value)" /> Yearly
                                  </label>
                                </div>
                              </div>
                              <div class="vl"></div>
                              <!---- Daily --->
                              <div  id ="DivDaily" class="col-xs-8" style="left: -10% ;   display: none;" >
                                <input type ='hidden' id='txtDailyValue' name ='txtDailyValue' />
                                <input type ='hidden' id='txtDailyRecurranceRange' name ='txtDailyRecurranceRange'  value='NoEnd' />
                                <div class="radio">
                                  <label>
                                  <input type="radio" name="rdDaily" value="D" id="rdDaily_Daily" onclick="FindDailyCondition(this.value)" /> Every Day
                                </div>
                                </label>
                                <div class="radio">
                                  <label>
                                  <input type="radio" name="rdDaily" id="rdDaily_Weekday" value="W" onclick="FindDailyCondition(this.value)" /> Every Weekday
                                  </label>
                                </div>
                                <div style="display:none;">
                                  <legend></legend>
                                  <div class="radio">
                                    <h6>
                                      <b> Range of Recurrance</b>
                                    </h6>
                                    <label>
                                    <input type="radio" name="rdDaily_Recurrance" value="Daily_NoEnd" id="rdDaily_Recurrance_NoEnd" onclick="FindDailyRecurrance(this.value)" checked data-parsley-required="true" /> No End 
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                    <input type="radio" name="rdDaily_Recurrance" id="rdDaily_Recurrance_EndBy" value="Daily_EndBy" onclick="FindDailyRecurrance(this.value)" /> End by
                                    <input class="date ManualDate" id="dtEndDate_Daily" name ="dtEndDate_Daily" style="width: 150px;" onchange="checkInput('dtEndDate_Daily');" type="text"  size="5"  >
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                    <input type="radio" name="rdDaily_Recurrance" id="rdDaily_Recurrance_EndAfter" value="Daily_EndAfter" onclick="FindDailyRecurrance(this.value)" /> End after
                                    <input type="text" id="txtEndafter_Daily" name="txtEndafter_Daily" maxlength="3"  size="3"  class="ManualInput" /> occurrences
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <!--------- Weekly ----->
                              <div id ="DivWeekly" class="col-xs-8" style="left: -10% ;   display: none ;" >
                                <input type ='hidden' id='txtWeekCondition' name ='txtWeekCondition' />
                                <input type ='hidden' id='txtWeeklyRecurranceRange' name ='txtWeeklyRecurranceRange' value='NoEnd' />
                                <table>
                                  <tr>
                                    <td Style="padding: 5px;">
                                      <label class="checkbox-inline">
                                      <input type="radio" name="WeeklyCheckBox[]" id="WeeklyCheckBox[]" value="Sun" onclick="FindWeeklyCondition(this.value)"/>SUN
                                      </label>
                                    </td>
                                    <td Style="padding: 5px;">
                                      <label class="checkbox-inline">
                                      <input type="radio" name="WeeklyCheckBox[]" id="WeeklyCheckBox[]" value="Mon" onclick="FindWeeklyCondition(this.value)" />MON
                                      </label>
                                    </td>
                                    <td Style="padding: 5px;">
                                      <label class="checkbox-inline">
                                      <input type="radio" name="WeeklyCheckBox[]" id="WeeklyCheckBox[]" value="Tue" onclick="FindWeeklyCondition(this.value)" />TUE
                                      </label>
                                    </td>
                                    <td Style="padding: 5px;">
                                      <label class="checkbox-inline">
                                      <input type="radio" name="WeeklyCheckBox[]" id="WeeklyCheckBox[]" value="Wed" onclick="FindWeeklyCondition(this.value)" />WED
                                      </label>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td Style="padding: 5px;">
                                      <label class="checkbox-inline">
                                      <input type="radio" name="WeeklyCheckBox[]" id="WeeklyCheckBox[]" value="Thu" onclick="FindWeeklyCondition(this.value)" />THU
                                      </label>
                                    </td>
                                    <td Style="padding: 5px;">
                                      <label class="checkbox-inline">
                                      <input type="radio" name="WeeklyCheckBox[]" id="WeeklyCheckBox[]" value="Fri" onclick="FindWeeklyCondition(this.value)" />FRI
                                      </label>
                                    </td>
                                    <td Style="padding: 5px;">
                                      <label class="checkbox-inline">
                                      <input type="radio" name="WeeklyCheckBox[]" id="WeeklyCheckBox[]" value="Sat" onclick="FindWeeklyCondition(this.value)" />SAT
                                      </label>
                                    </td>
                                    <td></td>
                                  </tr>
                                </table>
                                <div style="display:none;">
                                  <legend></legend>
                                  <div class="radio">
                                    <h6>
                                      <b> Range of Recurrance</b>
                                    </h6>
                                    <label>
                                    <input type="radio" name="rdWeekly_Recurrance" value="Weekly_NoEnd" id="rdWeekly_Recurrance_NoEnd"  onclick="FindWeeklyRecurrance(this.value)" checked data-parsley-required="true" /> No End 
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                    <input type="radio" name="rdWeekly_Recurrance" id="rdWeekly_Recurrance_EndBy" value="Weekly_EndBy" onclick="FindWeeklyRecurrance(this.value)" /> End by
                                    <input class="date ManualDate" id="dtEndDate_Weekly" name ="dtEndDate_Weekly" style="width: 150px;" onchange="checkInput('dtEndDate_Weekly');" type="text"  size="5"  >
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                    <input type="radio" name="rdWeekly_Recurrance" id="rdWeekly_Recurrance_EndAfter" value="Weekly_EndAfter" onclick="FindWeeklyRecurrance(this.value)" /> End after
                                    <input type="text" id="txtEndafter_Weekly" name="txtEndafter_Weekly" maxlength="3"  size="3"  class="ManualInput" /> occurrences
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <!--------- Monthly ----->
                              <div id ="DivMonthly" class="col-xs-8" style="left: -10% ;   display: none ;" >
                                <input type ='hidden' id='txtMonthlyValue' name ='txtMonthlyValue' value='D' />
                                <input type ='hidden' id='txtMonthlyRecurranceRange' name ='txtMonthlyRecurranceRange' value='NoEnd' />
                                <table style="left: -30%;">
                                  <tr>
                                    <td  Style="padding: 1x;">
                                      <div class="radio">
                                        <label>
                                        <input type="radio" name="rdMonthlyCondition" value="Monthly_Date" id="rdMonthlyCondition" onclick="FindMonthlyCondition(this.value)"  />Date 
                                        </label>
                                      </div>
                                    </td>
                                    <td>
                                      <label>
                                      <input type="text"  maxlength="2"  size="2" name="txtMonthlyDate" id="txtMonthlyDate" class="ManualInput" disabled />  of every 
                                      <input type="text"  maxlength="2"  size="2" name="txtMonthlyDateNumberofMonth" id="txtMonthlyDateNumberofMonth" class="ManualInput" value ='1' disabled /> month(s)
                                      </label>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td  Style="padding: 0px;">
                                      <div class="radio">
                                        <label>
                                        <input type="radio" name="rdMonthlyCondition" id="rdMonthlyCondition" value="Monthly_Day" id="radio-required" onclick="FindMonthlyCondition(this.value)" />The 
                                        </label>
                                      </div>
                                    </td>
                                    <td>
                                      <select class="ManualSelect" name="SelectMonthly_WeekOrder" id="SelectMonthly_WeekOrder" disabled >
                                        <option value="First" selected>1st</option>
                                        <option value="Second">2nd</option>
                                        <option value="Third">3rd</option>
                                        <option value="Fourth">4th</option>
                                        <option value="Last">Last</option>
                                      </select>
                                      <select class="ManualSelect" name="SelectMonthly_Day" id="SelectMonthly_Day" disabled>
                                        <option value="Sun" >Sunday</option>
                                        <option value="Mon" selected>Monday</option>
                                        <option value="Tue">Tuesday</option>
                                        <option value="Wed">Wednesday</option>
                                        <option value="Thu">Thursday</option>
                                        <option value="Fri">Friday</option>
                                        <option value="Sat">Saturday</option>
                                      </select>
                                      of every  
                                      <input type="text"  maxlength="2"  size="2" name="txtMonthlyDayNumberofMonth" id="txtMonthlyDayNumberofMonth" class="ManualInput"  value='1' disabled /> month(s)
                                    </td>
                                  </tr>
                                </table>
                                <div style="display:none;">
                                  <legend></legend>
                                  <div class="radio">
                                    <h6>
                                      <b> Range of Recurrance</b>
                                    </h6>
                                    <label>
                                    <input type="radio" name="rdMonthly_Recurrance" value="Monthly_NoEnd" id="rdMonthly_Recurrance_NoEnd" onclick="FindMonthlyRecurrance(this.value)" checked data-parsley-required="true" /> No End 
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                    <input type="radio" name="rdMonthly_Recurrance" id="rdMonthly_Recurrance_EndBy" value="Monthly_EndBy" onclick="FindMonthlyRecurrance(this.value)" /> End by
                                    <input class="date ManualDate" id="dtEndDate_Monthly" name ="dtEndDate_Monthly" style="width: 150px;" onchange="checkInput('dtEndDate_Monthly');" type="text"  size="5"  >
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                    <input type="radio" name="rdMonthly_Recurrance" id="rdMonthly_Recurrance_EndAfter" value="Monthly_EndAfter" onclick="FindMonthlyRecurrance(this.value)" /> End after
                                    <input type="text" id="txtEndafter_Monthly" name="txtEndafter_Monthly" maxlength="3"  size="3"  class="ManualInput" /> occurrences
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <!--------- Quarterly ----->
                              <div id ="DivQuarterly" class="col-xs-8" style="left: -10% ; display: none ;" >
                                <input type ='hidden' id='txtQuarterlyValue' name ='txtQuarterlyValue' value='D' />
                                <input type ='hidden' id='txtQuarterlyRecurranceRange' name ='txtQuarterlyRecurranceRange' value='NoEnd' />
                                <table style="left: -30%;">
                                  <tr>
                                    <td  Style="padding: 1x;">
									 
									  
									 
									  
									  
                                      <div class="radio">
                                        <label>
                                        <input type="radio" name="rdQuarterly_Condition" value="Quarterly_Date" id="rdQuarterly_Condition"  onclick="FindQuarterlyCondition(this.value)" />Date &nbsp;&nbsp; 
                                        </label>
                                      </div>
                                    </td>
                                    <td>
									<input class="date ManualInput" id="dtQuarterlyTimeLine" name ="dtQuarterlyTimeLine" style="width: 100px;"  onchange="checkInput('dtQuarterlyTimeLine');" type="text" disabled>&nbsp; of every 3 months
									
                                      <label hidden>
                                      <input type="text"  maxlength="2"  size="2" name="txtQuarterlyDate" id="txtQuarterlyDate" class="ManualInput" disabled />  of every Quarter
                                      </label>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td  Style="padding: 0px;">
                                      <div class="radio">
                                        <label>
                                        <input type="radio" name="rdQuarterly_Condition" id="rdQuarterly_Condition" value="Quarterly_Day" onclick="FindQuarterlyCondition(this.value)" />The 
                                        </label>
                                      </div>
                                    </td>
                                    <td>
                                      <select class="ManualSelect" name="SelectQuarterly_WeekOrder" id="SelectQuarterly_WeekOrder" disabled>
                                        <option value="First" selected>1st</option>
                                        <option value="Second">2nd</option>
                                        <option value="Third">3rd</option>
                                        <option value="Fourth">4th</option>
                                        <option value="Last">Last</option>
                                      </select>
                                      <select class="ManualSelect" name="SelectQuarterly_Day" id="SelectQuarterly_Day" disabled>
                                        <option value="Sun" >Sunday</option>
                                        <option value="Mon" selected>Monday</option>
                                        <option value="Tue">Tuesday</option>
                                        <option value="Wed">Wednesday</option>
                                        <option value="Thu">Thursday</option>
                                        <option value="Fri">Friday</option>
                                        <option value="Sat">Saturday</option>
                                      </select>
                                      of every 3 months
                                    </td>
                                  </tr>
                                </table>
                                <div style="display:none;">
                                  <legend></legend>
                                  <div class="radio">
                                    <h6>
                                      <b> Range of Recurrance</b>
                                    </h6>
                                    <label>
                                    <input type="radio" name="rdQuarterly_Recurrance" value="Quarterly_NoEnd" id="rdQuarterly_Recurrance_NoEnd" onclick="FindQuarterlyRecurrance(this.value)" checked data-parsley-required="true" /> No End 
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                    <input type="radio" name="rdQuarterly_Recurrance" id="rdQuarterly_Recurrance_EndBy" value="Quarterly_EndBy" onclick="FindQuarterlyRecurrance(this.value)" /> End by
                                    <input class="date ManualDate" id="dtEndDate_Quarterly" name ="dtEndDate_Quarterly" style="width: 150px;" onchange="checkInput('dtEndDate_Quarterly');" type="text"  size="5"  >
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                    <input type="radio" name="rdQuarterly_Recurrance" id="rdQuarterly_Recurrance_EndAfter" value="Quarterly_EndAfter" onclick="FindQuarterlyRecurrance(this.value)" /> End after
                                    <input type="text" id="txtEndafter_Quarterly" name="txtEndafter_Quarterly" maxlength="3"  size="3"  class="ManualInput" /> occurrences
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <!--------- Half Yearly ----->
                              <div id ="DivHalfyearly" class="col-xs-8" style="left: -10% ;   display: none ;" >
                                <input type ='hidden' id='txtHalfyearlyValue' name ='txtHalfyearlyValue' value='D' />
                                <input type ='hidden' id='txtHalfyearlyRecurranceRange' name ='txtHalfyearlyRecurranceRange' value='NoEnd' />
                                <table style="left: -30%;">
                                  <tr>
                                    <td  Style="padding: 1x;">
                                      <div class="radio">
                                        <label>
                                        <input type="radio" name="rdHalfyearly_Condition" value="Halfyearly_Date" id="rdHalfyearly_Condition" onclick="FindHalfYearlyCondition(this.value)"  />Date 
                                        </label>
                                      </div>
                                    </td>
                                    <td>
                                      <label>
                                      <input type="text"  maxlength="2"  size="2" name="txtHalfyearlyDate" id="txtHalfyearlyDate" class="ManualInput" disabled />  of every Half year
                                      </label>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td  Style="padding: 0px;">
                                      <div class="radio">
                                        <label>
                                        <input type="radio" name="rdHalfyearly_Condition" id="rdHalfyearly_Condition" value="Halfyearly_Day"  onclick="FindHalfYearlyCondition(this.value)" />The 
                                        </label>
                                      </div>
                                    </td>
                                    <td>
                                      <select class="ManualSelect" name="SelectHalfyearly_WeekOrder" id="SelectHalfyearly_WeekOrder" disabled>
                                        <option value="First" selected>1st</option>
                                        <option value="Second">2nd</option>
                                        <option value="Third">3rd</option>
                                        <option value="Fourth">4th</option>
                                        <option value="Last">Last</option>
                                      </select>
                                      <select class="ManualSelect" name="SelectHalfyearly_Day" id="SelectHalfyearly_Day" disabled>
                                        <option value="Sun" >Sunday</option>
                                        <option value="Mon" selected>Monday</option>
                                        <option value="Tue">Tuesday</option>
                                        <option value="Wed">Wednesday</option>
                                        <option value="Thu">Thursday</option>
                                        <option value="Fri">Friday</option>
                                        <option value="Sat">Saturday</option>
                                      </select>
                                      of every Half Year
                                    </td>
                                  </tr>
                                </table>
                                <div style="display:none;">
                                  <legend></legend>
                                  <div class="radio">
                                    <h6>
                                      <b> Range of Recurrance</b>
                                    </h6>
                                    <label>
                                    <input type="radio" name="rdHalfyearly_Recurrance" value="Halfyearly_NoEnd" id="rdHalfyearly_Recurrance" onclick="FindHalfYearlyRecurrance(this.value)" checked data-parsley-required="true" /> No End 
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                    <input type="radio" name="rdHalfyearly_Recurrance" id="rdHalfyearly_Recurrance" value="Halfyearly_EndBy" onclick="FindHalfYearlyRecurrance(this.value)" /> End by
                                    <input class="date ManualDate" id="dtEndDate_Halfyearly" name ="dtEndDate_Halfyearly" style="width: 150px;" onchange="checkInput('dtEndDate_Halfyearly');" type="text"  size="5"  >
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                    <input type="radio" name="rdHalfyearly_Recurrance" id="rdHalfyearly_Recurrance" value="Halfyearly_EndAfter" onclick="FindHalfYearlyRecurrance(this.value)" /> End after
                                    <input type="text" id="txtEndafter_Halfyearly" name="txtEndafter_Halfyearly" maxlength="3"  size="3"  class="ManualInput" /> occurrences
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <!--------- Yearly ----->
                              <div id ="DivYearly" class="col-xs-8" style="left: -10% ;   display: none ;" >
                                <input type ='hidden' id='txtYearlyValue' name ='txtYearlyValue' value='D' />
                                <input type ='hidden' id='txtYearlyRecurranceRange' name ='txtYearlyRecurranceRange' value='NoEnd' />
                                <table style="left: -30%;">
                                  <tr>
                                    <td  Style="padding: 1x;">
                                      <div class="radio">
                                        <label>
                                        <input type="radio" name="rdYearly_Condition" value="Yearly_Date" id="rdYearly_Condition" onclick="FindYearlyCondition(this.value)"   />Date 
                                        </label>
                                      </div>
                                    </td>
                                    <td>
                                      <label>
                                        <input type="text"  maxlength="2"  size="2" name="txtYearlyDate" id="txtYearlyDate" class="ManualInput" disabled />  of every 
                                        <select class="ManualSelect" name="SelectYearly_Month" id="SelectYearly_Month" disabled>
                                          <option value="Jan" selected>Jan</option>
                                          <option value="Feb">Feb</option>
                                          <option value="Mar">Mar</option>
                                          <option value="Apr">Apr</option>
                                          <option value="May">May</option>
                                          <option value="Jun">Jun</option>
                                          <option value="Jul">Jul</option>
                                          <option value="Aug">Aug</option>
                                          <option value="Sep">Sep</option>
                                          <option value="Oct">Oct</option>
                                          <option value="Nov">Nov</option>
                                          <option value="Dec">Dec</option>
                                        </select>
                                      </label>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td  Style="padding: 0px;">
                                      <div class="radio">
                                        <label>
                                        <input type="radio" name="rdYearly_Condition" id="rdYearly_Condition" value="Yearly_Day" onclick="FindYearlyCondition(this.value)"   />The 
                                        </label>
                                      </div>
                                    </td>
                                    <td>
                                      <select class="ManualSelect" name="SelectYearly_WeekOrder" id="SelectYearly_WeekOrder" disabled>
                                        <option value="First" selected>1st</option>
                                        <option value="Second">2nd</option>
                                        <option value="Third">3rd</option>
                                        <option value="Fourth">4th</option>
                                        <option value="Last">Last</option>
                                      </select>
                                      <select class="ManualSelect" name="SelectYearly_Day" id="SelectYearly_Day" disabled>
                                        <option value="Sun" >Sunday</option>
                                        <option value="Mon" selected>Monday</option>
                                        <option value="Tue">Tuesday</option>
                                        <option value="Wed">Wednesday</option>
                                        <option value="Thu">Thursday</option>
                                        <option value="Fri">Friday</option>
                                        <option value="Sat">Saturday</option>
                                      </select>
                                      of 
                                      <select class="ManualSelect" name="SelectYearly_MonthforWeek" id="SelectYearly_MonthforWeek" disabled>
                                        <option value="Jan" selected>Jan</option>
                                        <option value="Feb">Feb</option>
                                        <option value="Mar">Mar</option>
                                        <option value="Apr">Apr</option>
                                        <option value="May">May</option>
                                        <option value="Jun">Jun</option>
                                        <option value="Jul">Jul</option>
                                        <option value="Aug">Aug</option>
                                        <option value="Sep">Sep</option>
                                        <option value="Oct">Oct</option>
                                        <option value="Nov">Nov</option>
                                        <option value="Dec">Dec</option>
                                      </select>
                                    </td>
                                  </tr>
                                </table>
                                <div style="display:none;">
                                  <legend></legend>
                                  <div class="radio">
                                    <h6>
                                      <b> Range of Recurrance</b>
                                    </h6>
                                    <label>
                                    <input type="radio" name="rdYearly_Recurrance" value="Yearly_NoEnd" id="rdYearly_Recurrance" checked data-parsley-required="true" onclick="FindYearlyRecurrance(this.value)" /> No End 
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                    <input type="radio" name="rdYearly_Recurrance" id="rdYearly_Recurrance" value="Yearly_EndBy" onclick="FindYearlyRecurrance(this.value)" /> End by
                                    <input class="date ManualDate" id="dtEndDate_Yearly" name ="dtEndDate_Yearly" style="width: 150px;" onchange="checkInput('dtEndDate_Yearly');" type="text"  size="5"  >
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                    <input type="radio" name="rdYearly_Recurrance" id="rdYearly_Recurrance" value="Yearly_EndAfter" onclick="FindYearlyRecurrance(this.value)" /> End after
                                    <input type="text" id="txtEndafter_Yearly" name="txtEndafter_Yearly" maxlength="3"  size="3"  class="ManualInput" /> occurrences
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <script type="text/javascript"> 
                            $('.date').datepicker({
                                format: 'dd-mm-yyyy',
                             autoclose: true
                              
                              });
                          </script>
                          <style>
                            #talkbubble {
                            width: 120px;
                            height: 60px;
                            position: relative;
                            -moz-border-radius: 5px;
                            -webkit-border-radius: 5px;
                            border-radius: 5px;
                            text-align: center;
                            vertical-align: middle;
                            padding: .1% 0%;
                            }
                            .rectangle {
                            height: 50px;
                            width: 100px;
                            background-color: #555;
                            }kground-color: #555;
                            }
                            .hidden{
                            visibility:hidden;
                            }
                          </style>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="button" name="btnIncidentalTaskTask" id="btnIncidentalTaskTask" onclick= "SaveIncidentalTask();" class="btn btn-info" value="Add Task" style="display:" />
                        <input type="button" name="btnDailyTask" id="btnDailyTask" onclick= "SaveDailyTask();" class="btn btn-info" value="Add Daily Task" style="display:none;"/>
                        <input type="button" name="btnWeeklyTask" id="btnWeeklyTask" onclick= "SaveWeeklyTask();" class="btn btn-info" value="Add Weekly Task" style="display:none;"/>
                        <input type="button" name="btnMonthlyTask" id="btnMonthlyTask" onclick= "SaveMonthlyTask();" class="btn btn-info" value="Add Monthly Task" style="display:none;"/>
                        <input type="button" name="btnQuarterlyTask" id="btnQuarterlyTask" onclick= "SaveQuarterlyTask();" class="btn btn-info" value="Add Quarterly Task" style="display:none;"/>
                        <input type="button" name="btnHalYearlyTask" id="btnHalYearlyTask" onclick= "SaveHalfYearlyTask();" class="btn btn-info" value="Add Half Yearly Task" style="display:none;"/>
                        <input type="button" name="btnYearlyTask" id="btnYearlyTask" onclick= "SaveYearlyTask();" class="btn btn-info" value="Add Yearly Task" style="display:none;"/>
                        <a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">Close</a>
                      </div>
                    </div>
                  </div>
                </div>
                <input type ='hidden' id ='txtSelectedRow' name ='txtSelectedRow' />
                <input type ='hidden' id ='txtTaskID' name ='txtTaskID' />
                <input type ='hidden' id ='txtPeriod' name ='txtPeriod' value ='Today' />
                <input type ='hidden' id ='txtQueryCheck' name ='txtQueryCheck' value ='' />
                <input type ='hidden' id ='txtProjectID' name ='txtProjectID' value ='All' />
                <input type ='hidden' id ='txtSubProjectID' name ='txtSubProjectID' value ='All' />
                <input type ='hidden' id ='txtClientID' name ='txtClientID' value ='All' />
                <input type ='hidden' id ='txtCategoryID' name ='txtCategoryID' value ='All' />
                <input type ='hidden' id ='txtProcessownerID' name ='txtProcessownerID' value ='All' />
                <input type ='hidden' id ='txtTag' name ='txtTag' value ='All' />
                <input type ='hidden' id ='txtLeaderID' name ='txtLeaderID' value ='All' />
                <input type ='hidden' id ='txtFrequency' name ='txtFrequency' value ='All' />
                <input type ='hidden' id ='txtProjectStage' name ='txtProjectStage' value ='All' />
                <input type ='hidden' id ='txtProjectStageSummary' name ='txtProjectStageSummary' value ='All' />
                <input type ='hidden' id ='txtTotalFilterSequence' name ='txtTotalFilterSequence' value =0 />
                <input type ='hidden' id ='txtClientSequence' name ='txtClientSequence' value =0 />
                <input type ='hidden' id ='txtProjectSequence' name ='txtProjectSequence' value =0 />
                <input type ='hidden' id ='txtSubProjectSequence' name ='txtSubProjectSequence' value =0 />
                <input type ='hidden' id ='txtCategorySequence' name ='txtCategorySequence' value =0 />
                <input type ='hidden' id ='txtProcessOwnerSequence' name ='txtProcessOwnerSequence' value =0 />
                <input type ='hidden' id ='txtTagSequence' name ='txtTagSequence' value =0 />
                <input type ='hidden' id ='txtLeaderSequence' name ='txtLeaderSequence' value =0 />
                <input type ='hidden' id ='txtFrequencySequence' name ='txtFrequencySequence' value =0 />
                <style>
                  .toggler {
                  width: 260px;
                  height: auto;
                  overflow:scroll;
                  overflow-x:hidden;
                  overflow-y:scroll;
                  float: right;
                  z-index: 2;
                  position: fixed;
                  }
                  #button {
                  padding: .5em 1em;
                  text-decoration: none;
                  }
                  #effect {
                  position: relative;
                  width: 240px;
                  height: auto;
                  padding: 0.4em;
                  }
                  #effect h5 {
                  margin: 0;
                  padding: 0.4em;
                  text-align: center;
                  }0
                </style>
                <script>
                  $( function() {
                    // run the currently selected effect
                    function runEffect() {
                      // get effect type from
                      // var selectedEffect = $( "#effectTypes" ).val();
                    
                      var selectedEffect = "slide";
                  
                  
                      // Most effect types need no options passed by default
                      var options = {};
                      // some effects have required parameters
                      if ( selectedEffect === "scale" ) {
                        options = { percent: 50 };
                      } else if ( selectedEffect === "size" ) {
                        options = { to: { width: 200, height: 60 } };
                      }
                  
                      // Run the effect
                      $( "#effect" ).toggle( selectedEffect, options, 500 );
                    };
                  
                    // Set effect from select menu value
                    $( "#btnOpenFilter" ).on( "click", function() {
                  var x = document.getElementById("DivFilter");
                    if (x.style.display === "none") {
                    x.style.display = "block";
                  } else {
                    x.style.display = "none";
                  }
                  
                  
                      //	 runEffect();
                    });
                  } );
                </script>
                <style>
                  .modal.left .modal-dialog,
                  .modal.right .modal-dialog {
                  position: fixed;
                  margin: auto;
                  width: 360px;
                  height: 100%;
                  background-color: blue;
                  -webkit-transform: translate3d(0%, 0, 0);
                  -ms-transform: translate3d(0%, 0, 0);
                  -o-transform: translate3d(0%, 0, 0);
                  transform: translate3d(0%, 0, 0);
                  }
                  .modal.left .modal-content,
                  .modal.right .modal-content {
                  height: 100%;
                  overflow-y: auto;
                  background-color: #e9ebef;
                  }
                  .modal.left .modal-body,
                  .modal.right .modal-body {
                  padding: 15px 15px 80px;
                  }
                  /*Left*/
                  .modal.left.fade .modal-dialog{
                  left: -320px;
                  -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
                  -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
                  -o-transition: opacity 0.3s linear, left 0.3s ease-out;
                  transition: opacity 0.3s linear, left 0.3s ease-out;
                  }
                  .modal.left.fade.in .modal-dialog{
                  left: 0;
                  }
                  /*Right*/
                  .modal.right.fade .modal-dialog {
                  right: -320px;
                  -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
                  -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
                  -o-transition: opacity 0.3s linear, right 0.3s ease-out;
                  transition: opacity 0.3s linear, right 0.3s ease-out;
                  }
                  .modal.right.fade.in .modal-dialog {
                  right: 0;
                  }
                  /* ----- MODAL STYLE ----- */
                  .modal-content {
                  border-radius: 0;
                  border: none;
                  }
                  .modal-header {
                  border-bottom-color: #EEEEEE;
                  background-color: #FAFAFA;
                  }
                  .demo {
                  padding-top: 60px;
                  padding-bottom: 110px;
                  }
                  .btn-demo {
                  margin: 15px;
                  padding: 10px 15px;
                  border-radius: 0;
                  font-size: 16px;
                  background-color: #FFFFFF;
                  }
                  .btn-demo:focus {
                  outline: 0;
                  }
                  .demo-footer {
                  position: fixed;
                  bottom: 0;
                  width: 100%;
                  padding: 15px;
                  background-color: #212121;
                  text-align: center;
                  }
                  .demo-footer > a {
                  text-decoration: none;
                  font-weight: bold;
                  font-size: 16px;
                  color: #fff;
                  }
                </style>
                <link rel="stylesheet" type="text/css" href="../assets/Custom/3Switch.css" />
                <div class="modal right fade" id="modal-alert">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5>
                          <b>Filters</b>
                        </h5>
                      </div>
                      <div class="modal-body scrollbar-width-none">
                        <div id="DivLoadClientFilter" class="DivLoadClientFilter"></div>
                        <div id="DivLoadProjectFilter" class="DivLoadProjectFilter"></div>
                        <div id="DivLoadSubProjectFilter" class="DivLoadSubProjectFilter"></div>
                        <div id="DivLoadCategoryFilter" class="DivLoadCategoryFilter"></div>
                        <div id="DivLoadProcessownerFilter" class="DivLoadProcessownerFilter"></div>
                        <div id="DivLoadFrequencyFilter" class="DivLoadFrequencyFilter"></div>
                        <label> Tag</label>
                        <select class="form-control selectpicker" id="cmbTag" name="cmbTag" onchange="GetTag();" data-size="10" data-live-search="true" data-style="btn-primary">
                          <option value='All'>All</option>
                          <?php  
                            $sqli = " SELECT tagid, tagname FROM tagmaster WHERE clientid ='$ClientCode'";
                            $result = mysqli_query($connection, $sqli);
                            
                            
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                            
                             echo '
                            																																								<option value="'.$row['tagname'].'">'.$row['tagname'].'</option>';
                              }	
                            ?>
                        </select>
                        <fieldset>
                          <label>
                            Commited
                            <div class="switch-toggle switch-candy">
                              <input id="swCommitedAll" name="swCommited" type="radio" checked>
                          <label for="swCommitedAll" onclick="">All</label>
                          <input id="swCommitedYes" name="swCommited" type="radio">
                          <label for="swCommitedYes" onclick="">Yes</label>
                          <input id="swCommitedNo" name="swCommited" type="radio">
                          <label for="swCommitedNo" onclick="">No</label>
                          <a></a>
                          </div>
                          </label>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <label>
                            On Hold
                            <div class="switch-toggle switch-candy">
                              <input id="OnHoldAll" name="SwOnHold" type="radio" checked>
                          <label for="OnHoldAll" onclick="">All</label>
                          <input id="OnHoldYes" name="SwOnHold" type="radio">
                          <label for="OnHoldYes" onclick="">Yes</label>
                          <input id="OnHoldNo" name="SwOnHold" type="radio">
                          <label for="OnHoldNo" onclick="">No</label>
                          <a></a>
                          </div>
                          </label>
                        </fieldset>
                        <a href="#" class="btn btn-sm btn-success" onclick="LoadTask()">
                        <i class="fa fa-plus m-r-5"></i>Apply
                        </a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" class="btn btn-sm btn-danger" onclick="ResetFilterItems()">
                        <i class="fa fa-times m-r-5"></i>Reset Filter
                        </a>
                        <div  style="display:none;">
                          <label> Lead By</label>
                          <br>
                          <select class="form-control selectpicker" id="cmbLeadBy" name="cmbLeadBy" multiple data-size="10" data-live-search="true" data-style="btn-primary">
                          <?php  
                            $sqli = "  SELECT userid, teamleadname FROM teamleadermaster WHERE clientcode='$ClientCode'";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                            
                             echo '
                            																																													<option value='.$row['userid'].'>'.$row['teamleadname'].'</option>';
                              }	
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div  class="col-md-12" style="left:-20px;">
                  <div id="talkbubble" class="col-sm-2" style="background: #d0eef7;">
                    <p id="SummaryCompany" style="font-size:20px"></p>
                    <!--  <p  class="dropdown" id="SummaryCompany"  style="font-size:20px" class="dropdown-toggle" data-toggle="dropdown"></p><ul class="dropdown-menu animated fadeInDown" ><li class="arrow"></li><li><a href="logout.php">Log Out</a></li><li><a href="logout.php">Log Out</a></li><li><a href="logout.php">Log Out</a></li><li><a href="logout.php">Log Out</a></li><li><a href="logout.php">Log Out</a></li><li><a href="logout.php">Log Out</a></li><li><a href="logout.php">Log Out</a></li><li><a href="logout.php">Log Out</a></li></ul>
                      -->
                    <b>Client (s)</b>
                  </div>
                  <div id="talkbubble" class="col-md-2" style="background: #77b7ff; left:10px;">
                    <p id="SummaryProject" style="font-size:20px"></p>
                    <b>Project (s)</b>
                  </div>
                  <div id="talkbubble" class="col-md-2" style="background: #6ebeec; left:20px;">
                    <p id="SummarySubProject" style="font-size:20px"></p>
                    <b>SubProject (s)</b>
                  </div>
                  <div id="talkbubble" class="col-md-2" style="background: #a1ddef; left:30px;">
                    <p id="SummaryWorkCount" style="font-size:20px"></p>
                    <b>Category (s)</b>
                  </div>
                  <div id="talkbubble" class="col-md-2" style="background: #f9e58d; left:40px;">
                    <p id="SummaryTask" style="font-size:20px"></p>
                    <b>Task (s)</b>
                  </div>
                  <div id="talkbubble" class="col-md-2" style="background: #fcf4cf; left:50px;">
                    <p id="SummaryProcessOwner" style="font-size:20px"></p>
                    <b>Processowner (s)</b>
                  </div>
                  <div style="display:none;">
                    <div id="talkbubble" class="col-md-2" style="background: #f2e8f0;  left:10px;">
                      <p id="SummaryMonth"  style="font-size:20px"></p>
                      <b>Month (s)</b>
                    </div>
                    <div id="talkbubble" class="col-md-2" style="background: #e4d2e0; left:20px;">
                      <p id="SummaryEventDays" style="font-size:20px"></p>
                      <b>Event Day (s)</b>
                    </div>
                    <div id="talkbubble" class="col-md-2" style="background: #f9e58d; left:60px;">
                      <p id="SummaryLeaders" style="font-size:20px"></p>
                      <b>Leader (s)</b>
                    </div>
                    <div id="talkbubble" class="col-md-2" style="background: #f8b5b5; left:60px;">
                      <p  style="font-size:20px"> 0
                      </p>
                      <b>W/O Processowner</b>
                    </div>
                    <div id="talkbubble" class="col-md-2" style="background: #f8b5b5; left:70px;">
                      <p  style="font-size:20px"> 0
                      </p>
                      <b>W/O Project</b>
                    </div>
                  </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <script>
                  function ViewDetails() { 
                  var DivDetailPeriodFilter = document.getElementById("DivDetailPeriodFilter"); 
                  var DivSummaryFilter = document.getElementById("DivSummaryFilter"); 
                  
                  var display_Summary = document.getElementById("display_Summary"); 
                  var display_info= document.getElementById("display_info"); 
                  var myChart = document.getElementById("myChart"); 
                  
                  $('#cmbProjectStageSummary').hide();
                  
                  
                  // alert("AllFiltered");
                  
                  DivDetailPeriodFilter.style.display = "block"; 
                  DivSummaryFilter.style.display = "none"; 
                  myChart.style.display = "none";	
                  display_Summary.style.display = "none";
                  display_info.style.display = "block";
                  
                  
                  
                  
                  }
                  function ViewSummary() {
                  
                  var DivDetailPeriodFilter = document.getElementById("DivDetailPeriodFilter");
                  
                  var DivSummaryFilter = document.getElementById("DivSummaryFilter"); 
                  var display_Summary = document.getElementById("display_Summary"); 
                  var display_info= document.getElementById("display_info"); 
                  var myChart = document.getElementById("myChart"); 
                  
                  DivDetailPeriodFilter.style.display = "none";
                  
                  DivSummaryFilter.style.display = "block";	 	
                  myChart.style.display = "block";	
                  display_Summary.style.display = "block";
                  display_info.style.display = "none";
                  $('#cmbProjectStageSummary').show();
                  
                  }
                  
                </script>
                <div class="form-group" class="col-md-12">
                  <div class='form-group'>
                    <label class='radio-inline'>
                    <input type='radio' name='rdReportSelection' value='Summary' onclick ='LoadTaskSummary(); ViewSummary();' checked />
                    Summary
                    </label>
                    <label class='radio-inline'>
                    <input type='radio' name='rdReportSelection' value='Detail' onclick ='LoadTask();ViewDetails();' />
                    Detail
                    </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select  class="SelectStage" id="cmbProjectStageSummary"  name="cmbProjectStageSummary" data-size="10" data-live-search="true" data-style="btn-success" onchange="LoadTaskSummary();">
                      <option value="0">All</option>
                      <option value="1">Lead</option>
                      <option value="2" >Project</option>
                      <option value="3">CRM</option>
                    </select>
                  </div>
                  <div  style="display:none ;" id='DivDetailPeriodFilter'>
                    <div style="float:left">
                      <style>
                        .SelectStage {
                        border-style: solid;
                        border-radius: 4px; 
                        border-width: 1px;
                        border-color: #CCCCCC;
                        background-color: #FFFFFF;
                        text-align: center;
                        padding: .5em 1em; 
                        }
                        .SelectPeriod {
                        border-style: solid;
                        border-radius: 4px; 
                        border-width: 1px;
                        border-color: #CCCCCC;
                        background-color: #00acac;
                        text-align: center;
                        color:white;
                        padding: .5em 1em; 
                        }
                        .SelectPeriod option {
                        background-color: white;
                        padding: 4px 4px 4px 4px;
                        color:black;
                        }
                        #btnAddTask {
                        padding: .5em 1em;
                        background-color: #348fe2;
                        text-decoration: none;
                        }
                      </style>
                      <table>
                        <tr>
                          <td>
                            <label class='radio-inline'>
                            <input type='radio' name='rdRoutineProjectSelection' value='All' onclick ='LoadFilterItems(); LoadTask();' checked />
                            All
                            </label>
                            <label class='radio-inline'>
                            <input type='radio' name='rdRoutineProjectSelection' value='Routine' onclick ='LoadFilterItems(); LoadTask();' />
                            Routine
                            </label>
                            <label class='radio-inline'>
                            <input type='radio' name='rdRoutineProjectSelection' value='OneTime' onclick ='LoadFilterItems(); LoadTask();' />
                            Project
                            </label>
                          </td>
                          <td>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            <select  class="SelectStage" id="cmbProjectStage"  name="cmbProjectStage"  data-size="10" data-live-search="true" data-style="btn-success" onchange="GetProjectStatge();LoadTask()">
                              <option value="All">All</option>
                              <option value="1">Lead</option>
                              <option value="2" >Project</option>
                              <option value="3">CRM</option>
                            </select>
                          </td>
                          <td>
                            &nbsp;&nbsp;   
                            <select  class="form SelectPeriod" id="SelectFilter"  name="SelectFilter"  data-size="10" data-live-search="true" data-style="btn-success" onchange="LoadFilter(event)">
                              <option value="Today">Today</option>
                              <option value="Tomorrow" >Tomorrow</option>
                              <option value="Next7Days">Next 7 Days</option>
                              <option value="Completed">Completed</option>
                              <option value="Overdue">Overdue</option>
                              <option value="All">All</option>
                              <option value="Custom">Custom</option>
							  
							   
                            </select>
                          </td>
						 
						  
						  <td class='tdCustomDate' hidden>
						  <div class="input-group date" id="datepicker-disabled-past" data-date-format="dd-mm-yyyy" data-date-start-date="Date.default" style="max-width: 140px;">
                      <input type="text" class="form-control" placeholder="Date" id="dtCustomDate"
name ="dtCustomDate" 	/>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										
                                        </div>
										
						  </td>
						  <td class='tdCustomDateApply' hidden>
						  	<button  class="btn btn-success m-r-5 m-b-5" onclick="GetCustomDate();LoadTask();"  >Apply</button>
						  </td>
                          <td>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            <a href="#modal-dialog" class="btn btn-sm btn-primary" data-toggle="modal" id='btnAddTask'>
                            <i class="fa fa-plus m-r-5"></i>Add New task
                            </a>
                          </td>
                          <td>&nbsp;&nbsp;&nbsp;&nbsp; 
                            <span id="Disp_WithOverdue" class="">
                            <label>
                            <input type="checkbox" id='chkWithOverdue' name='chkWithOverdue'  value="" checked  onclick="LoadTask();" style="left:70px;" />
                            With Overdue
                            </label>
                            </span>
                          </td>
                          <td>
                            <span id="endTimeLabel" class="hidden"> 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label>
                            <input type="checkbox" id='chkIncludeCompletedTask' name='chkIncludeCompletedTask'  value=""  onclick="LoadTask();" style="left:70px;" />
                            With Completed
                            </label>
                            </span>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <style>
                      #btnOpenFilter {
                      padding: .5em .2em;
                      text-decoration: none;
                      background-color: #28a8ea;
                      }
                      #foo {
                      position: fixed;
                      right: 50px; 
                      }
                    </style>
                    <section id ="foo">
                      <a href="#modal-alert"  data-toggle="modal">
                      <button id="btnOpenFilter"  class="ui-state-default ui-corner-all" >
                      <i style="color:white;" class="fa fa-filter m-r-5" ></i>
                      </a>
                      </button>
                      </a> 
                      &nbsp;&nbsp;  
                      <input class='ui-state-default ui-corner-all' type='text'  id='txtSearchTask' name ='txtSearchTask' placeholder ='Search..' />
                    </section>
                  </div>
                </div>
                <div class="form-group" class="col-md-12">
                  <div  style="display:block ;" id='DivSummaryFilter'>
                    &nbsp;&nbsp;  &nbsp;  
                    <label class='radio-inline'>
                    <input type='radio' name='rdSummaryName' value='Stage' onclick ='LoadTaskSummary()' checked />
                    By Stage
                    </label>
                    <label class='radio-inline'>
                    <input type='radio' name='rdSummaryName' value='Client'  onclick ='LoadTaskSummary()'/>
                    By Client
                    </label>
                    <label class='radio-inline'>
                    <input type='radio' name='rdSummaryName' value='Project' onclick ='LoadTaskSummary()' />
                    By Project
                    </label>
                    <label class='radio-inline'>
                    <input type='radio' name='rdSummaryName' value='Processowner'  onclick ='LoadTaskSummary()'/>
                    By Processowner
                    </label>
                    <label>
                    &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; | &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; 
                    </label>
                    <label class='radio-inline'>
                    <input type='radio' name='rdDisplayType' value='NumberOnly'  onclick ='LoadTaskSummary()' checked/>
                    Only Numbers
                    </label>
                    <label class='radio-inline'>
                    <input type='radio' name='rdDisplayType' value='All'  onclick ='LoadTaskSummary()' />
                    Numbers with %
                    </label>
                    <div class="form-group" style="float:right;">
                      <input class='ui-state-default ui-corner-all' type='text'  style="left:70px;"  type='text'    id='txtSearchTaskSummary' name ='txtSearchTaskSummary' placeholder ='Search..' />
                    </div>
                  </div>
                </div>
              </div>
              <style> 
                #txtSearchTask {
                padding: .5em 1em; 
                background-color: white;
                }
                #txtSearchTaskSummary {
                padding: .5em 1em; 
                background-color: white;
                }
                .tbltask  i.fa {  display: none;}
                .tbltask  tr:hover i.fa {display: inline-block;}  
                .stuck {
                position: fixed;
                overflow-y:scroll;
                max-height: 70%;
                width: 95%;
                top: 35%;
                }
              </style>
              <div class="container-fluid">
                <div class="row">
                  <div class="row">
                    <div   id="display_info" style="display:none;" class="email-content stuck"  ></div>
                  </div>
                  <div class="col-xs-8">
                    <div   id="display_Summary" style="width:850px;" class="email-content stuck"  ></div>
                  </div>
                  <div class="col-xs-2">
                    <!-- <div id='myChart'></div> -->
                    <?php
                      $LoggedUserID = $_SESSION["RMS_EmployeeID"];
                      $ClientCode=$_SESSION["RMS_CompanyID"];
                      
                      
                      $query = "CALL OverDueTask($ClientCode,$LoggedUserID)";
                      $result = mysqli_query($connection, $query);
                       
                      while( $AgeData = mysqli_fetch_row($result))  
                      {
                      
                      
                      $Age0to15=$AgeData[0];
                      $Age16to30=$AgeData[1];
                      $Age31to60=$AgeData[2];
                      $AgeAbove60=$AgeData[3];
                      
                      }
                      ?>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                    <body>
                      <div style="width: 400px;" id="myChart" class="email-content stuck"  >
                        <canvas id="pie-chart"></canvas>
                      </div>
                      <script>
                        new Chart(document.getElementById("pie-chart"), {
                            type: 'pie',
                        	
                            data: {
                              labels:  ["0 to 15 Days", "16 to 30 Days", "31 to 60 Days", "Above 60 Days"],
                              datasets: [{
                        		   fill: true,
                                label: "Overdue Task by Age",
                                backgroundColor: ["#9bc2e6", "#ffe699","#ff9933","#ff0000"],
                        		borderColor:	['#e8e8ff', '#e8e8ff','#e8e8ff', '#e8e8ff'],
                                data: [
                        																																																																															<?php echo "$Age0to15,$Age16to30,$Age31to60,$AgeAbove60"; ?>]
                              }]
                            },
                            options: {
                              title: {
                                display: true,
                                text: 'Overdue Task by Age'
                              },
                        	    
                        	   
                            legend: {
                              display: true,
                              position: "bottom",
                              labels: {
                                fontColor: "#333",
                                fontSize: 9
                              }
                            },
                        	 tooltips: {
                        			callbacks: {
                        				label: function(tooltipItem, data) {
                        					var allData = data.datasets[tooltipItem.datasetIndex].data;
                        					var tooltipLabel = data.labels[tooltipItem.index];
                        					var tooltipData = allData[tooltipItem.index];
                        					var total = 0;
                        					for (var i in allData) {
                        						total += allData[i];
                        					}
                        					var tooltipPercentage = Math.round((tooltipData / total) * 100);
                        					return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
                        				}
                        			}
                        		} ,
                        		
                        		 plugins: {
                                  labels: {
                                    render: 'label'
                                  }
                                }
                        		 
                        		
                        	  
                            }
                        });
                        
                        
                        
                        																																																																														
                      </script>
  </body>
  <script src="../assets/Custom/zingchart.min.js"></script>
  <script>
    var myConfig = {
    	type: "pie", 
    	backgroundColor: "white",
    "scale-r":{
       "ref-angle":270 //relative to the starting 90 degree position.
     },
       
    	plot: {
    	  borderColor: "grey", 
    	  borderWidth: 1,
      "line-style":"dotted",
    	  // slice: 90,
    	  valueBox: {
    	    placement: 'in',
    	fontSize: '10',
    	 fontColor: "black",
    	    // text: '%t\n %v (%npv%)',
    	    text: '%t\n  %node-value (%npv%)',
    	 "decimals": 0,
    	    fontFamily: "Calibri"
    	  },
    	  tooltip:{
    	    fontSize: '10',
    	 "font-weight":"normal",
    	    fontFamily: "Open Sans",
    	    padding: "5 10",
    	    text: "%npv%"
    	  },
    	  animation:{
         effect: 2, 
         method: 5,
         speed: 500,
         sequence: 1
       }
    	},
    	source: {
    	 // text: 'gs.statcounter.com',
    	  fontColor: "#8e99a9",
    	  fontFamily: "Open Sans"
    	},
    	title: {
    	  fontColor: "black",
    	  text: 'Overdue Task by Age',
    	  align: "left",
    	  offsetX: 10,
    	  fontFamily: "Open Sans",
    	  fontSize: 12
    	},
    	subtitle: {
    	  offsetX: 10,
    	  offsetY: 10,
    	  fontColor: "#8e99a9",
    	  fontFamily: "Open Sans",
    	  fontSize: "16",
    	  
    	  align: "left"
    	},
    
    	plotarea: {
    	  margin: "0 0 0 0"  
    	},
    series :  
    
    [
    	{
    		values : [
    																																																																													<?php echo $Age0to15; ?> ],
    		text: "0 to 15 Days",
    		
    	  backgroundColor: '#9bc2e6',
    	},
    	{
    	  values: [
    																																																																													<?php echo $Age16to30; ?> ],
    	  text: "16 to 30 Days",
    	  backgroundColor: '#ffe699'
    	},
    	{
    	  values: [
    																																																																													<?php echo $Age31to60; ?> ],
    	  text: '31 to 60 Days',
    	  backgroundColor: '#ff9933'
    	},
    	{
    	  text: '> 60 Days',
    	  values: [
    																																																																													<?php echo $AgeAbove60; ?> ],
    	  backgroundColor: '#ff0000'
    	}
    	  
    ]
    };
    
    zingchart.render({ 
    id : 'myCharsst', 
    data : myConfig, 
    height: 400, 
    width: 325 
    });
    																																																																												
  </script>
  </div>
  </div>
  </div>
  </div>
  </form>
  <!-- end col-10 -->
  </div>
  <!-- end row -->
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
  <script src="../assets/js/apps.min.js"></script>
  <!-- ================== END PAGE LEVEL JS ================== -->
  <script>
    $(document).ready(function() {
    	App.init();
    	Inbox.init();
    	FormPlugins.init(); 
    FormSliderSwitcher.init();
    });
  </script>
  </body>
  <!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->
</html>