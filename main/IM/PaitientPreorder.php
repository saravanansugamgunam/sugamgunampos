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
	  
	  
		<link rel="stylesheet" type="text/css" href="../assets/css/component.css" />
		<script src="../assets/js/modernizr.custom.js"></script>
		
	  
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
	  
	   html, body{
  padding: 0 !important;
}
  
	  .modal {
    overflow-y: auto;
}
  
    </style>
     
  </head>
  
  
	
							
							
  

  <body onload="LoadTodayProductList();">
  
  
  <div class="modal fade" id="modal-dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">Order Cancellation</h4>
										</div>
										<div class="modal-body">
											<input type='hidden' id='txtOrderNo' name='txtOrderNo' />  <label>
						 <font color="black"> Reason for Cancellation</font>
						
						 </label>
						 <br>
		 <textarea class="form-control" id='txtStatusRemarks' name ='txtStatusRemarks'  row ='5' ></textarea>											
										</div>
										<div class="modal-footer">
										<a href="javascript:;" class="btn btn-sm btn-warning" onclick='UpdateOrderStatus();' data-dismiss="modal">Cancel Order</a>
											<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal" >Close</a>
											
										</div>
									</div>
								</div>
							</div>
							
							
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
	  
	 
	  
  function SavePaitentOrder()
	  { 
	 
	   var PaitentCode = document.getElementById("cmbPaitient").value;   
	   var ProductCode = document.getElementById("cmbProductCode").value;   
	   var OrderDate = document.getElementById("dtOrderDate").value;   
	   var OrderQty = document.getElementById("txtOrderQty").value;   
	   var Remarks = document.getElementById("txtRemarks").value;   
	   var Advance = document.getElementById("txtAdvanceAmount").value;   
	   var DeliveryMode = document.getElementById("cmbDeliveryMode").value;   
	  
	   
	    
	  if (PaitentCode=="" || ProductCode=="" || OrderDate=="" || OrderQty==""   )
	  {
			
	  swal("Alert!", " Fill All details", "warning");
		  
	  }
	  else
	  {
		 
	  var datas = "&PaitentCode="+PaitentCode+"&ProductCode="+ProductCode+"&OrderDate="+OrderDate+"&OrderQty="+OrderQty+"&Remarks="+Remarks+"&Advance="+Advance+"&DeliveryMode="+DeliveryMode;		  	
	  	    // alert(datas);
		 $.ajax({
		   url:"Save/SavePaitientOrder.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		    
		   // swal(data);
		 if(data == 1)
		 {
			  
			  swal("Customer Order!", "Added Sucessfully", "success");
			   LoadTodayProductList();
			   Reset();
		 }
		 else
		 {
			   swal("Alert!", data, "warning");
			   LoadTodayProductList();
			   Reset();
		 }
		 
		
		   }
		  });
	  }
		  
	  }
	  
	  
	  	  
  function UpdateOrderStatus()
	  { 
	 
	   var OrderNo = document.getElementById("txtOrderNo").value;     
	   var RevisedRemarks = document.getElementById("txtStatusRemarks").value;   
 
	    
	  if (OrderNo=="" || RevisedRemarks==""  )
	  {
			
	  swal("Alert!", " Fill All details", "warning");
		  
	  }
	  else
	  {
		 
	  var datas = "&OrderNo="+OrderNo+"&RevisedRemarks="+RevisedRemarks;		  	
	  	    // alert(datas);
		 $.ajax({
		   url:"Save/UpdatePaitientOrder.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		    
		   // swal(data);
		 if(data == 1)
		 {
			  
			  swal("Customer Order!", "Added Sucessfully", "success");
			   LoadTodayProductList();
			   Reset();
		 }
		 else
		 {
			   swal("Alert!", data, "warning");
			   LoadTodayProductList();
			   Reset();
		 }
		 
		
		   }
		  });
	  }
		  
	  }
	  
	  
	  
	  
	  function Reset()
	  {
		    
		      document.getElementById("txtOrderQty").value='';
		      document.getElementById("txtRemarks").value='';
		      document.getElementById("txtStatusRemarks").value='';
		     
		       $("#cmbProductCode").val('default');
				$("#cmbProductCode").selectpicker("refresh");
				 
				document.getElementById("cmbProductCode").focus();
	  }
	  
	  
	  
	  function CalculateTotal()
	  {
		      var Qty = document.getElementById("txtPurchaseQty").value;
		      var Rate = document.getElementById("txtRate").value;
		      var MRP = document.getElementById("txtMRP").value;
			  var TotalAmount = Qty * Rate;
			  document.getElementById("txtTotalAmount").value=TotalAmount; 
			  document.getElementById("txtProfit").value=MRP-Rate;  
	  }
	  
	  function LoadTodayProductList()
	  {
		  
		var ProductCode = document.getElementById("cmbProductCode").value;
		var OrderStatus = document.querySelector('input[name="rdOrderStatus"]:checked').value;
	 
		var datas = "&ProductCode="+ProductCode+"&OrderStatus="+OrderStatus; 
	 // alert(datas);
		 $.ajax({
		   url:"Load/LoadPatientOrderDetails.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		   // alert(data);
		    $( '#DivOrderDetails' ).html(data);
			 
		
		   }
		  });
	  }
	   
	   function LoadOrderID(x)
	  {
		   
		 document.getElementById("txtOrderNo").value=x;
		 
	  }
	  
	  </script>
	   <script type="text/javascript">
$(document).ready(function()
{   
    $(".monthPicker").datepicker({
        dateFormat: 'MM yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,

        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
        }
    });

    $(".monthPicker").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
});

  
</script>
 
  <style>
  .bootstrap-select:not([class*="span"]):not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
    width: 250px;
}
  </style>
	
	 
									
									
 <div id="content" class="content">
 
 
        <div class="row">
			    <!-- begin col-6 -->
			  
                   <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                           
                            <h4 class="panel-title">Paitient Order Details</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
							
							<table>
			   <tr>
			   <td>
			   Paitient
			   </td>
			   <td>
			   &nbsp;
			   </td>
			   <td>
			   Date
			   </td>
			   <td>
			   &nbsp;
			   </td>
			   <td>
			   Product
			   </td>
			   <td>
			   &nbsp;
			   </td>
			   <td>
			   Qty
			   </td>
			   <td>
			   &nbsp;
			   </td>
			   <td>
			   Advance
			   </td>
			   <td>
			   &nbsp;
			   </td>
			   <td>
			   Delv. Mode
			   </td>
			   <td>
			   &nbsp;
			   </td>
			   <td>
			   Remarks
			   </td>
			   
			   
			   </tr>
			   <tr>
			   <td>
			    <select class="selectpicker" data-show-subtext="true" data-live-search="true" data-style="btn-white" id='cmbPaitient' name='cmbPaitient'  style="width: 100px;">
							<option selected></option> 
							 <?php  
                            $sqli = "SELECT paitentid, CONCAT(mobileno, ' [',paitentname,']') AS paitentname FROM `paitentmaster` ";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value='.$row['paitentid'].'>'.$row['paitentname'].'</option>';
                              }	
                            ?>
      </select>
			   </td>
			   <td>
			   &nbsp;
			   </td>
			   <td width='1%'>
			    <input type="date" class="form-control" placeholder="" id='dtOrderDate' name='dtOrderDate'  
				style="width:150px"  />
			   </td>
			   <td>
			   &nbsp;
			   </td>
			   <td>
			   <select class="selectpicker" data-show-subtext="true" data-live-search="true" data-style="btn-white" id='cmbProductCode' name='cmbProductCode' onchange="LoadProductDetails(); " style="width: 100px;">
	   <option selected></option> 
							 <?php  
                            $sqli = "SELECT productid,CONCAT(productshortcode,'-',productname) as Product FROM `productmaster` WHERE STATUS='Active'";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value='.$row['productid'].'>'.$row['Product'].'</option>';
                              }	
				?>
			  </select>
			   </td>
			   <td>
			   &nbsp;
			   </td>
			   <td> 
			   <input type="text" class="form-control"  id='txtOrderQty' name='txtOrderQty' 
				size ="4" maxlength="4" />
			   </td>
			   <td>
			   &nbsp;
			   </td>
			    <td>
			   <input type="text" class="form-control" placeholder="" id='txtAdvanceAmount' name='txtAdvanceAmount' size ="5" maxlength="5"  />
			   </td>
			   <td>
			   &nbsp;
			   </td>
			    <td>
				 
										
										
			    <select class="form-control"  style="width: 100px;" id='cmbDeliveryMode' name ='cmbDeliveryMode'>
			    <option selected value='Counter'>Counter</option> 
			    <option value='Courier'>Courier</option>  
			    <option value='SomeOne'>Some one</option>  
			    </select>
			   </td>
			   
			   <td>
			   &nbsp;
			   </td>
			   <td>
			    <textarea row='10' col='10' class="form-control" placeholder="Remarks" id='txtRemarks'
			 name='txtRemarks'> </textarea>
			   </td>
			   <td>
			   &nbsp;
			   </td>
			   <td>
			   <input type="button"  class="btn btn-sm btn-success" onClick="SavePaitentOrder();" value='Save'> 	
                                         <input type="button"  class="btn btn-sm btn-warning" onClick="Reset();" value='Clear'> 
			   </td>
			 
			   </tr>
			   
			   </table>
			   
							 
                            </form>
						</div>
                     
                </div>
				<div class="col-md-12">
				<div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                           
                            <h4 class="panel-title">Total Orders
						<tr>
			 

			<td> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp&nbsp;&nbsp; </td>
			
			<label class="radio-inline" style="color: white;">
			<input style="color: white;" type="radio" name="rdOrderStatus" id="rdOpen"  value="Open" checked  onclick="LoadTodayProductList();"  />
			Open
			</label></td>
			<td><label class="radio-inline" style="color: white;">
			<input style="color: white;" type="radio" name="rdOrderStatus" id="rdPurchased"  value="Purchased"   onclick="LoadTodayProductList();"  />
			Purchased
			</label></td>
			<td><label class="radio-inline" style="color: white;">
			<input style="color: white;" type="radio" name="rdOrderStatus" id="rdDelivered"  value="Delivered"   onclick="LoadTodayProductList();"  />
			Delivered
			</label></td>
			<td><label class="radio-inline" style="color: white;">
			<input style="color: white;" type="radio" name="rdOrderStatus" id="rdCancelled"  value="Cancelled"   onclick="LoadTodayProductList();"  />
			Cancelled
			</label></td>
			  
</tr>
</h4>
                        </div>
                        <div class="panel-body"> 
						  <div data-scrollbar="true" data-height="510px">
                        <ul class="chats">
						 
						 
                          <div id="DivOrderDetails" class="email-content"  ></div>
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
	
	<script src="../assets/js/classie.js"></script>
		<script src="../assets/js/modalEffects.js"></script>
		
		
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