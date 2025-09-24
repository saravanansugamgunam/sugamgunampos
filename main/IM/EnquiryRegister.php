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
	<link href="../assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
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
	<link href="assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
    <!-- ================== END BASE JS ================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	
	
	 
    <link href="../assets/Custom/sweetalert.css" rel="stylesheet"/>
    <script src="../assets/Custom/sweetalert2.min.js"></script>
	<script src="../assets/Custom/IndexTable.js"></script>
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
	  html, body{
  padding: 0 !important;
}

.modal {
    overflow-y: auto;
}

.modal-open {
    overflow: auto;
}

.modal-open[style] {
    padding-right: 0px !important;
}
    </style>
     
  </head> 
   <div id="myModalReturn" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Enquiry</h4>
      </div>
	  
      <div class="modal-body"> 
	  						<input hidden='text' id='txtEnquiryIDUpdate' name='txtEnquiryIDUpdate' />
	  						<label></label>
							 
                              <br>
							  
							  <table>
							  <tr>
							  <td>Name</td><td><input type='text' size="50" id='txtEnquiryUpdatedName' name='txtEnquiryUpdatedName' /></td>
							  </tr>
							  <tr>
							  <td><br></td>
							  </tr>
							  
							   <tr>
							  <td>Mobile</td><td><input type='text'  size="50" id='txtEnquiryUpdatedMobile' name='txtEnquiryUpdatedMobile' /></td>
							  </tr>
							  <tr>
							  <td><br></td>
							  </tr>
							  
							   <tr>
							  <td>Email</td><td><input type='text'  size="50" id='txtEnquiryUpdatedEmail' name='txtEnquiryUpdatedEmail' /></td>
							  </tr>
							  <tr>
							  <td><br></td>
							  </tr>
							  
							   <tr>
							  <td>Address</td><td>
							  <textarea id='txtEnquiryUpdatedAddress'  size="50" name='txtEnquiryUpdatedAddress'></textarea>
							   </td>
							  </tr>
							  <tr>
							  <td><br></td>
							  </tr>
							  
							   <tr>
							  <td>Remarks</td><td>
							  <textarea id='txtEnquiryUpdatedRemarks' name='txtEnquiryUpdatedRemarks'></textarea>
							   </td>
							  </tr>
							  <tr>
							  <td><br></td>
							  </tr>
							  
							   <td>Enquiry For</td><td>
							    <select class="form-control " id='cmbEnquiryFor' name='cmbEnquiryFor'  data-style='btn-white' >
							  <option></option> 
							 <?php  
                            $sqli = "SELECT enquiryid, enquiry  FROM  enquirymaster where enquirystatus='Active' order by 2";
							      echo '<option value="0" selected>-</option>';
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                       
                             echo ' <option value="'.$row['enquiryid'].'">'.$row['enquiry'].'</option>';
                              }	
                            ?>
                                            
                                        </select>
										</td>
							  </tr>
							  <tr>
							  <td><br></td>
							  </tr>
							  
							   <td>Enquiry Thru</td><td>
							   
							    <select class="form-control " id='cmbRefference' name='cmbRefference'  data-style='btn-white' >
							  <option></option> 
							 <?php  
                            $sqli = "SELECT enquirytypeid, enquirytype  FROM  enquirytypemaster where enquirytypestatus='Active'  order by 2";
                            $result = mysqli_query($connection, $sqli); 
							 echo '<option value="0" selected>-</option>';
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value="'.$row['enquirytypeid'].'">'.$row['enquirytype'].'</option>';
                              }	
                            ?>
                                            
                                        </select>
										</td>
							  </tr>
							  <tr>
							  <td><br></td>
							  </tr>
							  
							  
							  
							  <tr>
							  <td><label class="col-md-1 control-label">Status</label></td>
							  <td><label class="radio-inline">
                                            <input type="radio" id='rdActive' name="rdEnquiryStatus" value="Active" checked />
                                           Active
                                        </label>
                                        <label class="radio-inline">
                                           <input type="radio" id='rdInActive' name="rdEnquiryStatus" value="In Active " />
                                           In Active
                                        </label></td>
							  </tr>
							  </table>
							 
      </div>
	  
      <div class="modal-footer">
        <button type	="button" class="btn btn-info" onclick="UpdateEnquiry();"  data-dismiss="modal">Update</button>
		<button type	="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModalCancel" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Invoice Cancellation</h4>
      </div>
	  
      <div class="modal-body"> 
	  						<input type='hidden' id='txtCancelInvoiceNo' name='txtCancelInvoiceNo' /> 
                             
							 <h2 style="color: red;">Are you sure want to canell the bill? </h2>
							 <br>
                       <label>Admin Password:</label>&nbsp;&nbsp;&nbsp;
					   <input type='password' id='txtAdminPassword' name='txtAdminPassword' /> 
                             
			  
					    
      </div>
	  
	  
	   
      <div class="modal-footer">
        <button type	="button" class="btn btn-danger" onclick="CancellBill();"  data-dismiss="modal">Cancel</button>
		<button type	="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="myModalCourierTracking" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Courier Details</h4>
      </div>
	  
      <div class="modal-body"> 
	  
	  						<input type='hidden' id='txtCourierInvoiceNo' name='txtCourierInvoiceNo' />
							
							 <label>Courier Date</label>&nbsp;&nbsp;&nbsp;
					   <input class="form-control" type='date' id='txtCourierDate' name='txtCourierDate' /> 
					   
							<label>Courier</label>&nbsp;&nbsp;&nbsp;
					   <select class="form-control" id='cmbCourier' name='cmbCourier' > 
					   
					   <option value='Professional Couriers'>Professional Couirier</option>
					   <option value='Post Office'>Post Office</option>
					   <option value='Others'>Others</option>
					   
					   </select>
					   <br>
					   
					   <label>Reference Number</label>&nbsp;&nbsp;&nbsp;
					   <input class="form-control" type='text' id='txtCourierReference' name='txtCourierReference' /> 
					   <br>
					   
					   <label>Remarks</label>&nbsp;&nbsp;&nbsp;
					   <textarea class="form-control" id='txtCourierRemarks' name='txtCourierRemarks'></textarea>
					    
					    
      </div>
	    
	   
      <div class="modal-footer">
        <button type	="button" class="btn btn-success" onclick="SaveCourierDetails();"  data-dismiss="modal">Save</button>
		<button type	="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModalCourierTrackingDetails" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Courier Tracking Details</h4>
      </div>
	  
      <div class="modal-body"> 
	  
	  						<input type='hidden' id='txtCourierTrackingInvoiceNo' name='txtCourierTrackingInvoiceNo' />
							
							 <label>Courier Date</label>&nbsp;&nbsp;&nbsp;
					   <input class="form-control" type='text' id='txtCourierTrackingDate' name='txtCourierTrackingDate' /> 
					   
							<label>Courier</label>&nbsp;&nbsp;&nbsp;
					   <input class="form-control" type='text' id='txtCourierTrackingName' name='txtCourierTrackingName' />
					   <br>
					   
					   <label>Reference Number</label>&nbsp;&nbsp;&nbsp;
					   <input class="form-control" type='text' id='txtCourierTrackingReference' name='txtCourierTrackingReference' /> 
					   <br>
					   
					   <label>Remarks</label>&nbsp;&nbsp;&nbsp;
					   <textarea class="form-control" id='txtCourierTrackingRemarks' name='txtCourierTrackingRemarks'></textarea>
					    
					    
      </div>
	    
	   
      <div class="modal-footer"> 
		<button type	="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


  <body>
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in">
      <span class="spinner"></span>
    </div>
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
 <div id="content" class="content">
        <div class="row">
			    <!-- begin col-6 -->
				 <script>
				 
				 $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
}); 


 function GetRowID(x)
	  {
	 
        var row = x.parentNode.rowIndex;
		 
		document.getElementById("txtEnquiryIDUpdate").value = document.getElementById("data-table").rows[row].cells.namedItem("EnquiryID").innerHTML;
		
		document.getElementById("txtEnquiryUpdatedName").value = document.getElementById("data-table").rows[row].cells.namedItem("EnquiryName").innerHTML;
		 
		document.getElementById("txtEnquiryUpdatedMobile").value = document.getElementById("data-table").rows[row].cells.namedItem("EnquiryMobile").innerHTML;
		
		document.getElementById("txtEnquiryUpdatedEmail").value = document.getElementById("data-table").rows[row].cells.namedItem("EnquiryEmail").innerHTML;
		document.getElementById("txtEnquiryUpdatedAddress").value = document.getElementById("data-table").rows[row].cells.namedItem("EnquiryAddress").innerHTML;
		document.getElementById("txtEnquiryUpdatedRemarks").value = document.getElementById("data-table").rows[row].cells.namedItem("EnquiryRemarks").innerHTML;

	  }


    function printDiv() {
        var divToPrint = document.getElementById('DivPrint');
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
		
		  
		
   }
   function exportF(elem) {
  var table = document.getElementById("data-table");
  var html = table.outerHTML;
  var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
  elem.setAttribute("href", url);
  elem.setAttribute("download", "export.xls"); // Choose the file name
  return false;
}

  function LoadEnquiryRegister()
	  {
		  // alert(1);
		var EnquiryType = document.getElementById("cmbEnquiryType").value;   
		 
		var datas = "&EnquiryType="+EnquiryType; 
	 // alert(datas);
		 $.ajax({
		   url:"Load/LoadEnquiryDetails.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		     // alert(data);
		    $( '#DivPaymentHistory' ).html(data);
			 
		
		   }
		  }); 
	  }
	   
	    function LoadSalesReportTotal()
	  {
		  
	var FromDate = document.getElementById("dtFromDate").value;   
		var ToDate = document.getElementById("dtToDate").value;   
		var Type = document.getElementById("cmbType").value;   
		var BillMode = document.getElementById("cmbEnquiryType").value;   
		 
		var datas = "&FromDate="+FromDate+"&ToDate="+ToDate+"&Type="+Type+"&BillMode="+BillMode;  
	  	    // alert(datas);
		 $.ajax({
		   url:"Load/LoadSalesReportTotal.php",
		   method:"POST",
		   data:datas,	
		   dataType:"json",
		   success:function(data)
		   {		
		     // alert(data);
		   $("#txtCash").val(data[0]);  
		   $("#txtCard").val(data[1]);  
		   $("#txtOthers").val(data[2]);  
		   $("#txtTotalSale").val(data[3]);  
		
		   }
		  });
	  } 
	  function LoadCancelBillDetail(x)
	  {
		  document.getElementById("txtCancelInvoiceNo").value = x; 
		  document.getElementById("txtCourierInvoiceNo").value = x;  
	  }
	  
	  function LoadCourierDetails(x)
  {
	 
        var CourierTrackingInvoiceNo = x;
		document.getElementById("txtCourierTrackingInvoiceNo").value = x; 
		var datas = "&CourierTrackingInvoiceNo="+CourierTrackingInvoiceNo;	
	  	    // alert(datas);
		 $.ajax({
		   url:"Load/LoadCourierDetails.php",
		   method:"POST",
		   data:datas,	
		   dataType:"json",
		   success:function(data)
		   {		
		     // alert(data);
		   $("#txtCourierTrackingDate").val(data[0]);  
		   $("#txtCourierTrackingName").val(data[1]);  
		   $("#txtCourierTrackingReference").val(data[2]);  
		   $("#txtCourierTrackingRemarks").val(data[3]);  
		
		   }
		  });
  
  }
	  
 function LoadItemDetails(x)
  {
	  ReturnInvoiceNo();
        var Invoice = x;
		document.getElementById("txtInvoiceNo").value = x; 
		var datas = "&Invoice="+Invoice;	
	  	  // alert(datas);
		 $.ajax({
		   url:"Load/LoadProductListReturn.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	 
			
		    $( '#DivProductListReturn' ).html(data);
			
		
		   }
		  });
  
  }
  
    function ReturnInvoiceNo()
	  {
		      
var ReturnInvoiceNo =new Date().getTime(); 
document.getElementById("txtReturnInvoiceNo").value=ReturnInvoiceNo;
 
	  }
	  
  
  function ReturnItems()
  {
 
		var InvoiceNo = document.getElementById("txtInvoiceNo").value;  
		var ReturnInvoice = document.getElementById("txtReturnInvoiceNo").value;  
		var ItemID = document.getElementById("txtItemId").value;  
		var datas = "&InvoiceNo="+InvoiceNo+"&ReturnInvoice="+ReturnInvoice+"&ItemID="+ItemID;	
	 
		  if (ItemID=='' || ReturnInvoice=='')
		  {
			   swal("Alert!", 'Kindly select any item', "warning");
		  }
		  
			  else
			  {
				   $.ajax({
		   url:"Delete/ReturnBill.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		 
			 // swal("Alert!", 'Selected item returned', "success"); 
			 swal("Alert!", data, "success"); 
		
		   }
		  });
			  }
			  
		LoadSalesReport();
  
  }
   
   function UpdateEnquiry()
   {
	   var EnquiryID = document.getElementById("txtEnquiryIDUpdate").value;  
	   var EnquiryUpdateMobile = document.getElementById("txtEnquiryUpdatedMobile").value;  
	   var EnquiryUpdateEmail = document.getElementById("txtEnquiryUpdatedEmail").value;  
	   var EnquiryUpdateAddress = document.getElementById("txtEnquiryUpdatedAddress").value;  
	   var EnquiryUpdatedName = document.getElementById("txtEnquiryUpdatedName").value;  
	   var EnquiryUpdateRemarks = document.getElementById("txtEnquiryUpdatedRemarks").value;  
	   var EnquiryUpdateEnquiryFor = document.getElementById("cmbEnquiryFor").value;  
	   var EnquiryUpdateReference = document.getElementById("cmbRefference").value;  
	    var EnquiryStatus = $("input[name='rdEnquiryStatus']:checked").val();
	    // alert(1);
		if (EnquiryID =='' || EnquiryUpdateMobile =='')
{
	swal("Alert!", "Please provide all details", "warning");
}
else
{
	var datas = "&EnquiryID="+EnquiryID+"&EnquiryUpdateMobile="+EnquiryUpdateMobile+"&EnquiryUpdateEmail="+EnquiryUpdateEmail+"&EnquiryUpdateAddress="+EnquiryUpdateAddress+"&EnquiryUpdateRemarks="+EnquiryUpdateRemarks+"&EnquiryUpdateEnquiryFor="+EnquiryUpdateEnquiryFor+"&EnquiryUpdateReference="+EnquiryUpdateReference+"&EnquiryUpdatedName="+EnquiryUpdatedName+"&EnquiryStatus="+EnquiryStatus;	
	  	  // alert(datas);
		 $.ajax({
		   url:"Save/UpdateEnquiryDetails.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		 // alert(data);
		 
		  swal("Enquiry!", data, "success");
			
		    // $( '#DivSelectedProductListReturn' ).html(data);
			
		
		   }
		  });
	LoadEnquiryRegister();
}
	   
	   
   }
   
  
  function CancellBill()
  {
	 
  var Invoice = document.getElementById("txtCancelInvoiceNo").value;  
  var Password = document.getElementById("txtAdminPassword").value;
  
	if (Password !='Admin2Cancel')
{
	swal("Alert!", "Admin password not matchihg", "warning");
}
else
{
		var datas = "&Invoice="+Invoice;	
	  	  // alert(datas);
		 $.ajax({
		   url:"Delete/CancelBill.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		 // alert(data);
		 
		  swal("Alert!", data, "warning");
			
		    // $( '#DivSelectedProductListReturn' ).html(data);
			
		
		   }
		  });
}
document.getElementById("txtAdminPassword").value="";

LoadSalesReport();
  }
  

function GetBillDetail(x){
                              
                        
                              var SelectedColumn = x.cellIndex;
                              var SelectedRow = x.parentNode.rowIndex;
                              
                              
                              // var Id = document.getElementById("indextable").rows[SelectedRow].cells[0].innerHTML; 
                              var STOID = document.getElementById("data-table").rows[SelectedRow].cells.namedItem("InvoiceNo").innerHTML;
                              //alert (Id);
                              var datas = "&STOID="+STOID;
                               // alert(datas);
                              $.ajax({
                              method: 'POST',
                              url:"SaleBillView.php",
                              data:datas,
                              success:function(response)
                              {
                              
                             // alert(response);
                               
                             
                              }
                              });
                              
                              
                              
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
	   
	    
	   function LoadCustomerDatabase()
	  {
		  
		  LoadEnquiryRegister();
		  var  EnquiryType= document.getElementById("cmbEnquiryType").value;
		 
		var datas = "&EnquiryType="+EnquiryType;	
	   // alert(datas);
		 $.ajax({
		   url:"Load/LoadSMSEnquiry.php",
		   method:"POST",
		   data:datas,	
		   dataType:"json",
		   success:function(data)
		   {	
		    
		   $("#txtAllMobileNo").val(data[0]);
		  
		
		   }
		  });
	  }
	  
	  
	  	
	function countChar(val) {
        var len = val.value.length;
		
		var TotalLen = " Count: ".concat(len);
        if (len >= 500) {
          val.value = val.value.substring(0, 500);
        } else {
          $('#charNum').text(TotalLen);
        }
      };
	  
	  
 


</script>


<div class="modal fade" id="modalEmail">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">Email To</h4>
										</div>
										<div class="modal-body">
											<label>
											Email ID*
											</label>
											 <input class="form-control" style='width: 350px;' type="text" name="txtEmail" id="txtEmail" />
											 <br>
											  
									
											 <textarea class="form-control" rows=10 id='txtEmailContent' name='txtEmailContent'  ></textarea>
											 
										 
										</div>
										<div class="modal-footer">
											<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
						  
						 <a  href="javascript:;" type='submit' onclick='SendEmail();' class='btn btn-sm btn-success'>Send</a>  
										</div>
									</div>
								</div>
							</div>
							
							<div class="modal fade" id="modalSMS">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">SMS</h4>
										</div>
										<div class="modal-body">
											<label>
											Mobile No*
											</label>
											 <input class="form-control" style='width: 350px;' type="text" name="txtMobileNo" id="txtMobileNo" />
											 <br>
											  
									
											 <textarea class="form-control" rows=10 id='txtSMSContent' name='txtSMSContent'  ></textarea>
											 
										 
										</div>
										<div class="modal-footer">
											<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
						  
						 <a  href="javascript:;" type='submit' onclick='SendEmail();' class='btn btn-sm btn-success'>Send</a>  
										</div>
									</div>
								</div>
							</div>
							
							<div class="modal fade" id="modalBulkSMS">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">SMS</h4>
										</div>
										<div class="modal-body">
											 
											   
                                       <textarea class="form-control" placeholder="Mobile No with comma seperated" id='txtAllMobileNo' name ='txtAllMobileNo'  rows="5" style="display:none;" ></textarea>
                                    
											   
                                       <textarea class="form-control" placeholder="Message" id='txtMessage' name ='txtMessage'  rows="5"  onkeyup="countChar(this)"></textarea>
									    <div><i>160 Char is counted as 1 SMS</i></div>
										<div id="charNum"></div>
                                     
									 
										 
										</div>
										<div class="modal-footer">
											<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
						  
						 <a  href="javascript:;" type='submit' onclick='SendSMS();' class='btn btn-sm btn-success'>Send</a>  
										</div>
									</div>
								</div>
							</div>




  <div class="col-md-12">
			       
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                         <script>
						 $(document).ready(function () {
    $('#dtFromDate').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true
    });

    //Alternativ way
    $('#dtToDate').datepicker({
      format: "dd/mm/yyyy"
    }).on('change', function(){
        $('.datepicker').hide();
    });
});
                         </script>
						 <div class="panel-heading">
						    <h5 class="panel-title">Enquiry Register
							 
							  </h5> 
							 </div>
                        <div class="panel-body">
                            
							  <div class="form-group">
							  
							    
                                    <div class="col-md-8">
                                      
                                               
												<select style='border-radius: 4px; padding: 5px;' id='cmbEnquiryType' name ='cmbEnquiryType'>
											  <?php  
                            $sqli = "SELECT enquiryid, enquiry  FROM  enquirymaster where enquirystatus='Active' order by 2";
							      echo '<option value="%" selected>All</option>';
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                       
                             echo ' <option value="'.$row['enquiryid'].'">'.$row['enquiry'].'</option>';
                              }	
                            ?>
											 
											</select>
											&nbsp;&nbsp;&nbsp;
                                         <input type="button"  class="btn btn-sm btn-info" onclick="LoadEnquiryRegister();"  value='View'>
										 &nbsp;&nbsp;
										 <a href='#modalBulkSMS' type="button"  class="btn btn-sm btn-warning" onclick='LoadCustomerDatabase();' data-toggle='modal'>Send Bulk SMS
									   </a>
									    
                                    </div>
									
				 
                                </div>
								
                           
							 
                </div>
                </div>
                </div>
				
			 
				 
			   <div class="col-md-12" >
			       
			        <!-- begin panel -->
                    <div class="panel panel-success">
                      
						   
                        <div class="panel-body">
						
                            
							 
                               <div id="DivPaymentHistory"></div>  
                            
                        </div>
                        </div>
                    </div>
                    <!-- end panel -->
                
                    <!-- end panel -->
                </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
		     
                     
   
 
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
	<script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
	<script src="../assets/plugins/DataTables/js/dataTables.tableTools.js"></script>
	<script src="../assets/plugins/DataTables/js/dataTables.colVis.js"></script>
	<script src="../assets/js/table-manage-colvis.demo.min.js"></script>
	<script src="../assets/js/table-manage-tabletools.demo.min.js"></script>
	<script src="../assets/js/table-manage-combine.demo.min.js"></script>
	
  <script src="../assets/js/apps.min.js"></script>
  <!-- ================== END PAGE LEVEL JS ================== -->
  <script>
    $(document).ready(function() {
    	App.init();
    	Inbox.init();
    	FormPlugins.init(); 
    FormSliderSwitcher.init();
	FormWizard.init(); 
	
	TableManageFixedColumns.init();
	 
    });
  </script>
  </body>
  <!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->
</html>