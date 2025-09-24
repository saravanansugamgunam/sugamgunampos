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
    // $position=$_SESSION["SESS_LAST_NAME"]; 
	 session_cache_limiter(FALSE);
    session_start();
	   $LocationCode = $_SESSION['SESS_LOCATION'];
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
	
  <div id="myModalReturn" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Doctor</h4>
      </div>
	  <style>
	  .dt { 
    border: 1px dotted #000000; 
    outline:0; 
    height:25px; 
    width: 150px; 
  } 
	  </style>
      <div class="modal-body"> 
	  						<input hidden='text' id='txtDoctorID' name='txtDoctorID' />
	  						<label></label>
							
							<input hidden='text' id='txtDoctorStatus' name='txtDoctorStatus' />
                              <br>
							  
							  <table>
							  <tr>
							  <td>Doctor</td><td><input type='text' id='txtDoctorUpdatedName' name='txtDoctorUpdatedName' /></td>
							  </tr>
							   <td><br></td>
							  <tr>
							  <td>Mobile No</td><td><input type='text' id='txtDoctorUpdatedMobileNo' name='txtDoctorUpdatedMobileNo' /></td>
							  </tr>
							   <td><br></td><td></td><td>&nbsp;&nbsp;&nbsp;Edit Gender</td>
							  <tr>
							  <td>Gender</td>
							  
							  <td> <input type='text' id='txtDoctorUpdatedGender' name='txtDoctorUpdatedGender'  disabled /></td>
							  
							  
							  <td>&nbsp;&nbsp;
							  <select id='cmbGenderEdit' name='cmbGenderEdit'>
							  <option value="-" ></option>
							  <option value="Male" >Male</option>
							  <option value="Female">Female</option> 
							  </select> 
							  </td>
							  </tr>
							  <td><br></td><td></td><td>&nbsp;&nbsp;&nbsp;Edit DOB</td>
							  <tr>
							  <td>DOB</td>
							  
							  <td><input type='text' id='txtDoctorUpdatedDOB' name='txtDoctorUpdatedDOB' disabled /></td>
							  
							  <td>&nbsp;&nbsp;&nbsp;<input class='dt' type='date' id='dbDOBEdit' name='dbDOBEdit'/></td>
							  </tr>
							  <td><br></td>
							  <tr>
							  <td>Email ID</td><td><input type='text' id='txtDoctorUpdatedEmail' name='txtDoctorUpdatedEmail' /></td>
							  </tr>
							  <td><br></td> 
							  <td>Sa</td><td><input type='text' id='txtDoctorUpdatedEmail' name='txtDoctorUpdatedEmail' /></td>
							  
							  <tr>
							  <td><br></td>
							  </tr>
							  <tr>
							  <td><label class="col-md-1 control-label">Status</label></td>
							  <td><label class="radio-inline">
                                            <input type="radio" id='rdActive' name="rdDoctorStatus" value="Active" checked />
                                           Active
                                        </label>
                                        <label class="radio-inline">
                                           <input type="radio" id='rdInActive' name="rdDoctorStatus" value="In Active " />
                                           In Active
                                        </label></td>
							  </tr>
							  </table> 
      </div>
	  
      <div class="modal-footer">
        <button type	="button" class="btn btn-info" onclick="UpdateDoctor();"  data-dismiss="modal">Update</button>
		<button type	="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="ModalAddFamily" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Family Member</h4>
      </div>
	  
      <div class="modal-body"> 
	  						  
                              <br>
							  
							  <table>
							  <tr>
							  <td>Family Member Name &nbsp;&nbsp;</td><td><input type='text' id='txtFamilyMemberName' name='txtFamilyMemberName' /></td>
							  </tr>
							   <td><br></td>
							  <tr>
							  <td>Sex</td><td>
							  <select id='cmbFamilyMemberSex' name='cmbFamilyMemberSex'>
							  <option value="Male">Male</option>
							  <option value ="Female" >Female</option>
							  </select>
							  
							  </tr> 
							  <td><br></td>
							  <tr>
							  <td>DOB</td><td><input type='date' id='dtFamilyMemberDOB' name='dtFamilyMemberDOB' /></td>
							  </tr>  
							   <td><br></td>
							  <tr>
							  <td>Email ID</td><td><input type='text' id='txtFamilyMemberEmail' name='txtFamilyMemberEmail' /></td>
							  </tr>
							   <td><br></td>
							  <tr>
							  <td>Relation</td><td>
							  
							  <select id='cmbFamilyMemberRelation' name='cmbFamilyMemberRelation'>
							  <option value="Mother" >Mother</option>
							  <option value ="Father" >Father</option>
							  <option value ="Husband" >Husband</option>
							  <option value ="Wife" >Wife</option>
							  <option value ="Brother" >Brother</option>
							  <option value ="Sister" >Sister</option>
							  <option value ="Son" >Son</option>
							  <option value ="Daughter" >Daughter</option>
							  <option value ="Grand Father" >Grand Father</option>
							  <option value ="Grand Mother" >Grand Mother</option>
							  </select>
							  
							  </td>
							  </tr>
							  
							  <tr>
							  <td><br></td>
							  </tr>
							  
							  </table>
							 
      </div>
	  
      <div class="modal-footer">
        <button type="button" class="btn btn-info" onclick="AddFamilyMember();"  data-dismiss="modal">Update</button>
		<button type	="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
function UpdateDoctor()
{
        var DoctorStatus = $("input[name='rdDoctorStatus']:checked").val();
		var UpdatedDoctorName = document.getElementById("txtDoctorUpdatedName").value;
		var UpdatedDoctorEmail = document.getElementById("txtDoctorUpdatedEmail").value;
		var Updatedmobileno = document.getElementById("txtDoctorUpdatedMobileNo").value;
		var DoctorID = document.getElementById("txtDoctorID").value;
		
		var UpdateGender = document.getElementById("cmbGenderEdit").value; 
		var UpdateDOB = document.getElementById("dbDOBEdit").value;
		 
		
		var datas = "&DoctorID=" + encodeURIComponent(DoctorID) +
                "&UpdatedDoctorName=" + encodeURIComponent(UpdatedDoctorName)+
                "&UpdatedDoctorEmail=" + encodeURIComponent(UpdatedDoctorEmail)+
                "&Updatedmobileno=" + encodeURIComponent(Updatedmobileno)+
				"&DoctorStatus=" + encodeURIComponent(DoctorStatus)+
				"&NewGender=" + encodeURIComponent(UpdateGender)+
				"&UpdateDOB=" + encodeURIComponent(UpdateDOB);	
	  	  
		 $.ajax({
		   url:"Save/UpdateDoctor.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		   
		 if(data=="Added Successfuly")
		 {
			  swal("Doctor!", data, "success");
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
</script>

    
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
          <?php include("CLMSidePanel.php") ?>
      </div> 
      <!-- end #sidebar -->
      <!-- begin #content -->
	  <script>
  function SaveDoctor()
	  { 
	 
	   var mobileno = document.getElementById("txtmobileno").value;
	   var DoctorEmail	 = document.getElementById("txtDoctorEmail").value;
	   var Doctor = document.getElementById("txtDoctor").value; 
	   var AlternateNo = document.getElementById("txtAlternateNo").value;
	   var Sex = document.getElementById("cmbSex").value;
	   var DOB = document.getElementById("dtDob").value;
	   var MaritalStatus = document.getElementById("cmbMaritalStatus").value;
	   var PreviousOrg = document.getElementById("txtPrevOrg").value;
	   var Qualification = document.getElementById("txtQualification").value;
	   var ReferenceNo = document.getElementById("txtReferenceNo").value;
	   var Address = document.getElementById("txtAddress").value;
	   var DOJ = document.getElementById("dtDoj").value; 
	   var Salary = document.getElementById("txtSalary").value; 
	  	
	  if (Doctor=="" || mobileno=="" )
	  {
			
	  swal("Alert!", "Kindly provide valid details!", "warning");
		  
	  }
	  else
	  {
var datas = "&Doctor="+Doctor+
			"&DoctorEmail="+DoctorEmail+
			"&mobileno="+mobileno+
			"&AlternateNo="+AlternateNo+
			"&Sex="+Sex+
			"&DOB="+DOB+
			"&MaritalStatus="+MaritalStatus+
			"&PreviousOrg="+PreviousOrg+
			"&Qualification="+Qualification+
			"&ReferenceNo="+ReferenceNo+
			"&Address="+Address+
			"&Salary="+Salary+
			"&DOJ="+DOJ;


			
	  	  // alert(datas);
		 $.ajax({
		   url:"Save/SaveDoctor.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		   
		 if(data==1)
		 {
			  swal("Doctor!", "Added Sucessfuly", "success");
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
	  
	  
	   
	    function LoadDoctor()
	  { 
	 var Dumy = 0;
	    
var datas = "&Dumy="+Dumy;	
	  	  
		 $.ajax({
		   url:"Load/LoadDoctorDetails.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		   // alert(data);
		  $( '#DivDoctor' ).html(data);
		 
		
		   }
		  });
	  }
		  
	  function LoadDoctorStatus(a)
	  {
		    // document.getElementById("txtDoctorID").value=a;
		    // document.getElementById("txtDoctorName").value=b;
		  // document.getElementById("txtDoctor").value=c;
		  
		  // alert(a);
		  // alert(b);
		  // alert(c);
		  
	  }
	  function GetValeForEdit()
	  {
		  
		var CustomerCode = document.getElementById('txtCustomerCode').value;
		var datas = "&CustomerCode="+CustomerCode;	
	    // alert(datas);
		 $.ajax({
		   url:"Load/LoadCustomerDetailsService.php",
		   method:"POST",
		   data:datas,	
		   dataType:"json",
		   success:function(data)
		   {	
		    
		   $("#txtEditCustomerName").val(data[0]);
		   $("#txtEditCustomerMobile").val(data[1]); 
		   $("#txtEditCustomerArea").val(data[2]); 
		   $("#txtEditCustomerAddress").val(data[3]); 
		   $("#txtEditCustomerCity").val(data[4]); 
		   $("#txtEditCustomerPincode").val(data[5]); 
		   
		   	
		   }
		  });  
	  }

	  function GetRowID(x)
	  {
	 
        var row = x.parentNode.rowIndex;
		document.getElementById("txtDoctorID").value = document.getElementById("indextable").rows[row].cells.namedItem("DoctorID").innerHTML; 
		document.getElementById("txtDoctorUpdatedName").value = document.getElementById("indextable").rows[row].cells.namedItem("Doctor").innerHTML;
		document.getElementById("txtDoctorUpdatedEmail").value = document.getElementById("indextable").rows[row].cells.namedItem("DoctorEmail").innerHTML;
		document.getElementById("txtDoctorUpdatedMobileNo").value = document.getElementById("indextable").rows[row].cells.namedItem("mobileno").innerHTML;
		document.getElementById("txtDoctorUpdatedGender").value = document.getElementById("indextable").rows[row].cells.namedItem("DoctorGender").innerHTML;
		document.getElementById("txtDoctorUpdatedDOB").value = document.getElementById("indextable").rows[row].cells.namedItem("DoctorDOB").innerHTML;
		 
	  }
	  
	 
	  function Reset()
	  {
		document.getElementById("txtDoctor").value=""; 
		document.getElementById("txtmobileno").value=""; 
		document.getElementById("txtDoctorEmail").value="";  
		document.getElementById("txtAlternateNo").value=""; 
		document.getElementById("txtReferenceNo").value=""; 
		document.getElementById("dtDob").value=""; 
		document.getElementById("dtDoj").value=""; 
		document.getElementById("txtAddress").value=""; 
		document.getElementById("cmbSex").value=""; 
		document.getElementById("cmbMaritalStatus").value=""; 
		document.getElementById("txtPrevOrg").value=""; 
		 
		 
	   
		 
	LoadDoctor();
	  }
	  
  </script>
	
 <div id="content" class="content">
        <div class="row">
			    <!-- begin col-6 -->
			   <div class="col-md-12">
			        <!-- begin panel -->
                   <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Doctor</h4>
                        </div>
                           
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-1 control-label">Mobile</label>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" placeholder="Mobile No" 
										id='txtmobileno' name='txtmobileno' />
                                    </div>
                                 
                                    <label class="col-md-1 control-label">Name</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Name" id='txtDoctor' name='txtDoctor' />
                                    </div>
                                
                                    <label class="col-md-1 control-label">EmailID</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Email Id" id='txtDoctorEmail' name='txtDoctorEmail' />
                                    </div>
                                </div> 
								
								<div class="form-group">
                                   
                                 
                                    <label class="col-md-1 control-label">Alternate No</label>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" placeholder="Alternate no" id='txtAlternateNo' name='txtAlternateNo' />
                                    </div>
									
									
                                    <label class="col-md-1 control-label">Gender</label>
                                    <div class="col-md-1">
                                        <select class="form-control" id='cmbSex' name ='cmbSex'>
										<option value='-'>-</option>
										<option value ='Male'>M</option>
										<option value ='Female'>F</option>
										
										</select>
                                    </div>
                                 
                                    <label class="col-md-1 control-label">DOB</label>
                                    <div class="col-md-2">
                                        <input type="date" class="form-control"  id='dtDob' name='dtDob' />
                                    </div>
									
                                    
                                    <label class="col-md-1 control-label">Marital Status</label>
                                    <div class="col-md-2">
                                        <select class="form-control" id='cmbMaritalStatus' name ='cmbMaritalStatus'>
										<option value='-'>-</option>
										<option value ='Married'>Married</option>
										<option value ='UnMarried'>Un Married</option>
										
										</select>
                                    </div>
									
                                </div>
								
								<div class="form-group">
								 <label class="col-md-1 control-label">Prev. Org.</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Prev. Org." 
										id='txtPrevOrg' name='txtPrevOrg' />
                                    </div>
                                
                                    <label class="col-md-1 control-label">Qualification</label>
                                    <div class="col-md-3">
									<input type="text" class="form-control" 
									placeholder="Refered by" id='txtQualification' name='txtQualification' />
                                    </div>
									
									
                                    <label class="col-md-1 control-label">Reference</label>
                                    <div class="col-md-3">
									<input type="text" class="form-control" placeholder="Refered by" 
									id='txtReferenceNo' name='txtReferenceNo' />
                                    </div>
									 
                                </div>
								
								
								<div class="form-group"> 
								
                                    <label class="col-md-1 control-label">DOJ </label>
                                    <div class="col-md-2">
                                        <input type="date" class="form-control"  id='dtDoj' name='dtDoj' />
                                    </div>
									
									
                                    <label class="col-md-1 control-label">Salary</label>
                                    <div class="col-md-3">
									<input type="number" class="form-control" placeholder="Salary" 
									id='txtSalary' name='txtSalary' />
                                    </div>
									
									
									
                                    <label class="col-md-1 control-label">Address</label>
                                    <div class="col-md-3">
									<textarea class="form-control" id='txtAddress' name='txtAddress' ></textarea> 
                                    </div>
									
                                </div>
							 
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> </label>
                                    <div class="col-md-9">
                                        <input type="button"  class="btn btn-sm btn-success" onclick= "SaveDoctor();" value='Save'> 	
                                         <input type="button"  class="btn btn-sm btn-warning" onclick= "Reset();" value='Cancel'> 	
                                    </div>
                                </div>
                            </form>
						</div>
                    </div>
					   </div>
					   <div class="col-md-12">
					  <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Doctor List</h4>
                        </div>
                           
                        <div class="panel-body">
                            <form class="form-horizontal">
                               <div id ="DivDoctor" style="display: ;"></div>
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
     
    });
  </script>
  </body>
  <!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->
</html>