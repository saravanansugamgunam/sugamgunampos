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
        <h4 class="modal-title">Invoice Return</h4>
      </div>
	  
      <div class="modal-body"> 
	  						<input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' />
	  						<input type='hidden' id='txtReturnInvoiceNo' name='txtReturnInvoiceNo' />
                             <div data-scrollbar="true" data-height="250px">  
                        <ul class="chats">
						  
                          <div id="DivProductListReturn" class="email-content"  ></div>
						  
                        </ul>
                      </div>
			  
					    
      </div>
	  
	  
	   
      <div class="modal-footer">
        <button type	="button" class="btn btn-danger" onclick="ReturnItems();"  data-dismiss="modal">Return</button>
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
           <?php include("FMSidePanel.php") ?>
      </div> 
      <!-- end #sidebar -->
      <!-- begin #content -->
 <div id="content" class="content">
        <div class="row">
			    <!-- begin col-6 -->
				 <script>
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

  function LoadSalesReport()
	  {
		  // alert(1);
		var FromDate = document.getElementById("dtFromDate").value;   
		var ToDate = document.getElementById("dtToDate").value;   
		var Type = document.getElementById("cmbType").value;   
		var Group = document.getElementById("txtGroupID").value;   
		var Ledger = document.getElementById("cmbLedger").value;   
		var Category = '19';  
		var PaymentType = document.getElementById("cmbPaymentType").value;   
		var PaymentModeStatus = 'No'; 
		var ExpenseIncomeFilter = document.getElementById("cmbExpenseIncome").value;   
		   // alert(Group);
		if(Group =='1')
		{
		var Location = document.getElementById("cmbLocation").value;   
		}
		
		else
		{
			var Location = document.getElementById("txtLocationCode").value;   
		}
		 
		
		 
		var datas = "&FromDate="+FromDate+"&ToDate="+ToDate+"&Type="+Type+"&Location="+Location+"&Ledger="+Ledger+"&Category="+Category+"&PaymentModeStatus="+PaymentModeStatus+"&PaymentType="+PaymentType+"&ExpenseIncomeFilter="+ExpenseIncomeFilter; 
	 // alert(datas);
		 $.ajax({
		   url:"Load/LoadBalanceSheetCash.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		     // alert(data);
		    $( '#DivPaymentHistory' ).html(data);
			 
		
		   }
		  });
		  LoadSalesReportTotal();
	  }
	   
	    function LoadSalesReportTotal()
	  {
		  
	var FromDate = document.getElementById("dtFromDate").value;   
		var ToDate = document.getElementById("dtToDate").value;   
		var Type = document.getElementById("cmbType").value;   
		if(Group =='1')
		{
		var Location = document.getElementById("cmbLocation").value;   
		}
		
		else
		{
			var Location = document.getElementById("txtLocationCode").value;   
		}
		 
		var datas = "&FromDate="+FromDate+"&ToDate="+ToDate+"&Type="+Type+"&Location="+Location;  
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
                              
                             alert(response);
                               
                             
                              }
                              });
                              
                              
                              
                              }
	  
	  function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("txtItemSearch");
  SelectionCriteria = document.getElementById("cmbSelectionCriteria").value;
  filter = input.value.toUpperCase();
  table = document.getElementById("tblItemwise");
  tr = table.getElementsByTagName("tr");
  
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[SelectionCriteria];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
  // alert(1);
} 


</script>

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
						    <h5 class="panel-title">Balance Sheet
							
							  </h5> 
							 </div>
                        <div class="panel-body">
                            
							 
							  <input type='hidden' id='txtGroupID' name ='txtGroupID' value ='<?php echo $GroupID; ?>' />
				<input type='hidden' id='txtLocationCode' name ='txtLocationCode' value ='<?php echo $LocationCode; ?>' />
				
				
							  <div class="form-group">
							  
							    
                                    <div class="col-md-12">
                                      
                                               <input type="text" class="" placeholder="From" id="dtFromDate" style='border-radius: 4px; padding: 5px;'>
                                            <span> &nbsp;&nbsp;&nbsp; to &nbsp;&nbsp;&nbsp; </span>
                                            <input type="text" class="" placeholder="To" id="dtToDate" style='border-radius: 4px; padding: 5px;'>
											&nbsp;&nbsp;&nbsp; 
											<select  style='border-radius: 4px; padding: 5px;' id='cmbType' name ='cmbType' >
											 <option value='All' selected >All</option> 
											 <option value='Inventory' >Inventory</option> 
											 <option value='Clinic' >Clinic</option> 
											 
											 <option value='Course'>Course</option> 
											 
											</select>  
								 
											&nbsp;&nbsp;&nbsp;
											<select  style='border-radius: 4px; padding: 5px;' id='cmbLedger' name ='cmbLedger' >
											 <option value='All' selected >All</option> 
											 <option value='-' >-</option> 
											  <?php
											$sqli = "SELECT ledgername FROM accountingledger where cashledger ='Cash'";
											$result = mysqli_query($connection, $sqli); 
											 while ($row = mysqli_fetch_array($result)) {
									  echo ' <option value="'.$row['ledgername'].'">'.$row['ledgername'].'</option>';
											  }	
											?>
										
											 
											</select>
											&nbsp;&nbsp;&nbsp;
											 
											<?php 
											if($GroupID=='1')
											{
											?>
											
											<select style='border-radius: 4px; padding: 5px;' id='cmbLocation' name ='cmbLocation'>
											   <option value="All" selected>All Location</option> 
						 <?php
                            $sqli = "SELECT locationcode,locationname FROM locationmaster";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                      echo ' <option value='.$row['locationcode'].'>'.$row['locationname'].'</option>';
                              }	
                            ?>
											 
						</select>
						<?php
						}
						else
						{
						}
						
						?>
						&nbsp;&nbsp;&nbsp;
						
				<select  style='border-radius: 4px; padding: 5px;' id='cmbExpenseIncome' name ='cmbExpenseIncome' >
						 <option value='All' selected >All</option> 
						 <option value='Income' >Income</option> 
						 <option value='Expense' >Expense</option> 
						  
						</select> 
						
					 <input type="button"  class="btn btn-sm btn-info" onclick="LoadSalesReport();"  value='View'>
				</div>
									
				 
                                </div>
								
                           
							 
                </div>
                </div>
                </div>
				
				
				 <script>
				 function printData()
{
   var divToPrint=document.getElementById("tblItemwise");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
 
 
 function PrintReport() {
	    var CurrentDate=new Date()
        var contents = $("#DivStockReport").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>Balance Sheet</title>');
        frameDoc.document.write(CurrentDate);
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    } 
				 </script>
				  
			   <div class="col-md-12" >
			       
			        <!-- begin panel -->
                    <div class="panel panel-success">
                        <div class="panel-heading">
                             
                            <h4 class="panel-title">Details 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							<select id='cmbPaymentType' name='cmbPaymentType' 
							style="color:black;" onchange='LoadSalesReport()'>
							<option value ='%' >All</option>
							<?php
                            $sqli = "SELECT paymentmodecode,paymentmode FROM paymentmodemaster WHERE activestatus ='Active'";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
							echo ' <option value='.$row['paymentmodecode'].'>'.$row['paymentmode'].'</option>';
                              }	
                            ?>
							</select>
							
							<input type="hidden"  class="btn btn-sm btn-info btn-xs" onclick= "printDiv();" value='Print'>
							&nbsp;&nbsp;&nbsp;&nbsp;
							 <button hidden class="btn btn-sm btn-info btn-xs" > <a style="color: white;" 
							 onclick="PrintReport();">Print</a> </button> 
							  </h4> 
							 
							
                        </div> 
						   
                        <div class="panel-body">
						
                            <div class="table-responsive" id='DivStockReport'>
							 
                               <div id="DivPaymentHistory"></div>  
                            </div>
							
							
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