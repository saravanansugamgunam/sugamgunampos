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
    <link href="../assets/Custom/sweetalert.css" rel="stylesheet" />
    <script src="../assets/Custom/sweetalert2.min.js"></script>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
    <style>
    body {
        background: #f5f5f5 url('../assets/img/bg.png') left top repeat;
    }

    #f1_upload_process {
        z-index: 100;
        visibility: hidden;
        position: absolute;
        text-align: center;
        width: 400px;
    }

    .msg {
        text-align: left;
        color: #666;
        background-repeat: no-repeat;
        margin-left: 30px;
        margin-right: 30px;
        padding: 5px;
        padding-left: 30px;
    }

    .emsg {
        text-align: left;
        margin-left: 30px;
        margin-right: 30px;
        color: #666;
        background-repeat: no-repeat;
        padding: 5px;
        padding-left: 30px;
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
                    <a href="../index.php" class="navbar-brand">
                        <img src="../assets/img/logo.png" class="media-object" width="150" alt="" />
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

        <div id="wait"
            style="display:none;width:69px;height:189px;border:1px grey;position:absolute;top:50%;left:50%;padding:2px; z-index: 1000;">
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

                function LoadSTIItemDetails(x) {

                    var STOID = x;
                    var datas = "&STOID=" + STOID;

                    $.ajax({
                        method: 'POST',
                        url: "Load/LoadSTIProductList.php",
                        data: datas,
                        success: function(response) {

                            $('#DivProductListReturn').html(response);
                        }
                    });

                }

                function CheckReceipt(x) {
                    var SelectedColumn = x.cellIndex;
                    var SelectedRow = x.parentNode.rowIndex;
                    var STOID = document.getElementById("data-table").rows[SelectedRow].cells.namedItem("STOID")
                        .innerHTML;
                    var STOFROMID = document.getElementById("data-table").rows[SelectedRow].cells
                        .namedItem("STOFROMID").innerHTML;
                    document.getElementById("txtSTOID").value = STOID;
                    document.getElementById("txtSTOFROMID").value = STOFROMID;


                    var datas = "&STOID=" + STOID;

                    $.ajax({
                        url: "Load/CheckSTIReceiptStatus.php",
                        method: "POST",
                        data: datas,
                        dataType: "json",
                        success: function(data) {
                            if (data[0] == 1) {
                                alert('Already Received');
                            } else {
                                ReceiveConfirmation(x)

                            }

                        }
                    });

                }

                function ReceiveConfirmation(x) {

                    swal({
                            title: "Are you sure?",
                            text: "Want to Receive the selected STI !",
                            icon: "warning",
                            buttons: ["No", "Yes"],
                            dangerMode: false,
                            // dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {

                                // var SelectedColumn = x.cellIndex;
                                // var SelectedRow = x.parentNode.rowIndex;


                                // var Id = document.getElementById("indextable").rows[SelectedRow].cells[0].innerHTML; 
                                // var STOID = document.getElementById("data-table").rows[SelectedRow].cells.namedItem("STOID").innerHTML;
                                // var STOFROMID = document.getElementById("data-table").rows[SelectedRow].cells.namedItem("STOFROMID").innerHTML;
                                //alert (Id);

                                var STOID = document.getElementById("txtSTOID").value;
                                var STOFROMID = document.getElementById("txtSTOFROMID").value;



                                var datas = "&STOID=" + STOID + "&STOFROMID=" + STOFROMID;
                                // alert(datas);
                                $.ajax({
                                    method: 'POST',
                                    url: "Save/SaveSTI.php",
                                    data: datas,
                                    success: function(response) {

                                        // alert(response);
                                        //document.getElementById("indextable").deleteRow(SelectedRow);

                                        swal(response);

                                        // swal("Received!", "Selected stock receviced.", "success");


                                        setTimeout(function() {
                                            window.location = window.location;
                                        }, 1000);
                                        LoadSTIItemDetails();
                                    }
                                });


                                // swal("Selected task has been deleted!", {
                                // icon: "success",
                                // });
                            } else {

                            }
                        });

                }
                </script>

                <div id="STIItemList" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Invoice Return</h4>
                            </div>

                            <div class="modal-body">
                                <input type='hidden' disabled id='txtInvoiceNo' name='txtInvoiceNo' />
                                <input type='hidden' disabled id='txtReturnInvoiceNo' name='txtReturnInvoiceNo' />
                                <div data-scrollbar="true" data-height="450px">
                                    <ul class="chats">

                                        <div id="DivProductListReturn" class="email-content"></div>

                                    </ul>
                                </div>


                            </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" onclick="ReturnItems();"
                                    data-dismiss="modal">Return</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-12">

                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">

                            <h4 class="panel-title">Pending STI

                            </h4>


                        </div>

                        <input type='hidden' id='txtSTOID' name='txtSTOID'>
                        <input type='hidden' id='txtSTOFROMID' name='txtSTOFROMID'>

                        <div class="panel-body">
                            <div class="table-responsive" id='DivStockReport'>

                                <?php 
								$result = mysqli_query($connection, "  

 SELECT DATE_FORMAT(stodate,'%d-%m-%Y') STODate,stouniqueno,fromlocation,c.locationname AS `From`, b.locationname AS `To` ,stoqty,nettamount FROM  `stomaster` AS a JOIN locationmaster AS b ON a.tolocation=b.locationcode JOIN locationmaster AS c ON a.fromlocation=c.locationcode
 WHERE receiptstatus ='Not Received' and tolocation = '$LocationCode' ");

 //echo "<table id='tblProject' class='tblMasters'>";
  echo "  <table id='data-table'  border='1' style='border-collapse:collapse;'  class='table table-striped table-bordered' width='100%'>";
echo " <thead><tr>  
		<th  width='%'>S.No</th>     
		<th width='%'> Date </th>    	
		<th hidden width='%'> UniqueNo</th>    
		<th hidden width='%'> fromcode</th>    
		<th width='%'> From </th>    
		<th width='%'>  To </th>        
		<th width='%'>  Qty </th>    
		<th width='%'>  Value </th>    
		<th width='%'>View  </th>     
		<th width='%'>Receive  </th>     
		 
		</tr> </thead> <tbody>";

 $SerialNo = 1;
while($data = mysqli_fetch_row($result))
{
  echo "
  <tr>
  <td width='%'>$SerialNo</td>
  <td width='%'>$data[0]</td>
  <td hidden id ='STOID'  width='%'>$data[1]</td>  
   <td hidden width='%'  id ='STOFROMID'>$data[2]</td>   
   <td width='%'>$data[3]</td>   
   <td width='%'>$data[4]</td>     
   <td width='%'>$data[5]</td>     
   <td width='%'>$data[6]</td>    
   <td align='center'   width='%'> <a href='STIView.php?stoid=$data[1]' target='_blank' ?><i class='fa fa-2x fa-eye'
                                    title='View' style='color:blue;'></i></a></td>


                                <td align='center' onclick='CheckReceipt(this)' width='%'><a href='javascript:;'><i
                                            class='fa fa-2x fa-plus-square' title='Receive Stock'
                                            style='color:#49c1ec;'></i></a></td>

                                </tr>";
                                $SerialNo=$SerialNo+1;
                                }
                                echo "</tbody>
                                </table>";
                                ?>

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