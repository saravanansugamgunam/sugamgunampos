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
	   $LocationCode = $_SESSION['SESS_LOCATION'];
	   $GroupID = $_SESSION['SESS_GROUP_ID'];
  
  
if(isset($_SESSION['SESS_LOCATION']))
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

    <style>
    .modal-window {
        position: fixed;
        background-color: rgba(200, 200, 200, 0.75);
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 999;
        opacity: 0;
        pointer-events: none;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
    }

    .modal-window:target {
        opacity: 1;
        pointer-events: auto;
    }

    .modal-window>div {
        width: 700px;
        position: relative;
        margin: 10% auto;
        padding: 2rem;
        background: #fff;
        color: #444;
    }

    .modal-window header {
        font-weight: bold;
    }

    .modal-close {
        color: black;
        line-height: 50px;
        font-size: large;
        position: absolute;
        right: 0;
        text-align: center;
        top: 0;
        width: 70px;
        text-decoration: none;
    }

    .modal-closebutton {
        color: #aaa;
        line-height: 50px;
        font-size: 80%;
        position: absolute;
        right: 0;
        text-align: center;
        top: 50;
        width: 70px;
        text-decoration: none;
    }

    .modal-close:hover {
        color: #000;
    }

    .modal-window h1 {
        font-size: 150%;
        margin: 0 0 15px;
    }
    </style>

</head>

<body onload="LoadInvoiceNo();">
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

        <script>
        function SavePaitentPreOrderItems() {

            var Currentstock = document.getElementById("txtCurrentStock").value;
            var BillQty = document.getElementById("txtQty").value;
            var STOUniqueNo = document.getElementById("txtInvoiceNo").value; //
            var ProductCode = document.getElementById("cmbProductCode").value;

            var Qty = document.getElementById("txtQty").value;
            // alert(1);
            var Shortcode = document.getElementById("txtShortcode").value; //
            // alert(1);
            var Category = document.getElementById("txtCategory").value; //

            var ProductName = document.getElementById("txtProductName").value; //
            var MRP = document.getElementById("txtMRP").value;
            var DiscountAmount = document.getElementById("txtDiscAmount").value;
            var TotalAmount = document.getElementById("txtTotalAmount").value;
            var ProfitAmount = document.getElementById("txtProfitAmount").value; //
            var BatchCode = document.getElementById("txtBatchcode").value; //
            var Currentstock = document.getElementById("txtCurrentStock")
                .value; //                                                            
            var PaitentID = document.getElementById("cmbPaitent").value;
            var Rate = document.getElementById("txtRate").value;
            var LocationCode = document.getElementById("cmbLocationAdmin").value;

			

            // alert(2);                                                                                                                                         
            if (STOUniqueNo == "" || PaitentID == "") {

                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {
                // alert(3);
                var datas = "&STOUniqueNo=" + STOUniqueNo + "&ProductCode=" + ProductCode + "&Qty=" + Qty +
                    "&Shortcode=" + Shortcode + "&Shortcode=" + Shortcode +
                    "&Category=" + Category + "&ProductName=" + ProductName + "&MRP=" + MRP + "&DiscountAmount=" +
                    DiscountAmount +
                    "&TotalAmount=" + TotalAmount + "&ProfitAmount=" + ProfitAmount + "&BatchCode=" + BatchCode +
                    "&Currentstock=" + Currentstock + "&PaitentID=" + PaitentID + "&Rate=" + Rate + "&LocationCode=" + LocationCode;
                // alert(datas);
                $.ajax({
                    url: "Save/SavePaitentPreOrderItems.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                      //  swal(data);
                        if (data == "Added Successfuly") {

                            LoadProductList()
                            Reset();
                        } else {
                            // swal("Alert!", data, "warning");
                            LoadProductList()
                            Reset();
                        }


                    }
                });
            }


        }





        function SavePreOrderMaster() {

            var STOUniqueNo = document.getElementById("txtInvoiceNo").value;

            var PaitentID = document.getElementById("cmbPaitent").value;
            var DeliveryMode = document.getElementById("cmbDeliveryMode").value;
            var PaymentMode = document.getElementById("cmbPaymentMode").value;
            var AdvanceAmount = document.getElementById("txtPaymentAmount").value;
            var Remarks = document.getElementById("txtOrderRemarks").value;
			var LocationCode = document.getElementById("cmbLocationAdmin").value;



            if (STOUniqueNo == "" || PaitentID == "") {

                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {
                // alert(3);
                var datas = "&STOUniqueNo=" + STOUniqueNo + "&PaitentID=" + PaitentID + "&DeliveryMode=" +
                    DeliveryMode + "&PaymentMode=" + PaymentMode + "&AdvanceAmount=" + AdvanceAmount +
					 "&Remarks=" + Remarks + "&LocationCode=" + LocationCode;
                // alert(datas);
                $.ajax({
                    url: "Save/SavePaitentOrderMaster.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        if (data == 1) {
                            swal("Order Saved!", "Paitent Order Saved Sucessfully", "success");

                            setTimeout(function() {
                                window.location.reload(1);
                            }, 2000);

                            // swal(data);


                            // setTimeout(function() { window.location=window.location;},1000);

                            // history.pushState("", "", "www.mysamplepage.net/index.php/?page=index");
                        } else {
                            // swal("Alert!", "Error Saving Order", "warning");
                            swal("Alert!", data, "warning");
                            // Reset();
                        }


                    }
                });
            }
        }



        function Reset() {

            document.getElementById("txtQty").value = "";
            document.getElementById("txtShortcode").value = "";
            document.getElementById("txtCategory").value = "";
            document.getElementById("txtProductName").value = "";
            document.getElementById("txtMRP").value = "";
            document.getElementById("txtDiscAmount").value = "";
            document.getElementById("txtTotalAmount").value = "";
            document.getElementById("txtProfitAmount").value = "";
            document.getElementById("txtBatchcode").value = "";
            document.getElementById("txtCurrentStock").value = "";
            document.getElementById("txtRate").value = "";
            document.getElementById("txtTotalAmount").value = "";
            $("#cmbProductCode").val('default');
            $("#cmbProductCode").selectpicker("refresh");


        }


        function CalculateTotal() {
            var Qty = document.getElementById("txtQty").value;
            var MRP = document.getElementById("txtMRP").value;
            var Rate = document.getElementById("txtRate").value;

            var DiscPercent = document.getElementById("txtDiscPercent").value;

            var GrossAmount = (Qty * MRP)
            var DiscountAmount = GrossAmount * (DiscPercent / 100);
            var TotalAmount = GrossAmount - DiscountAmount;
            var Profit = TotalAmount - (Qty * Rate);

            document.getElementById("txtTotalAmount").value = TotalAmount;
            document.getElementById("txtDiscAmount").value = DiscountAmount;
            document.getElementById("txtProfitAmount").value = Profit;
        }

        function ClearTotalAmount() {
            document.getElementById("txtTotalAmount").value = 0;
        }

        function LoadInvoiceNo() {

            var InvoiceNo = new Date().getTime();
            document.getElementById("txtInvoiceNo").value = InvoiceNo;
            LoadProductList();

        }

        function CheckStockQty() {
            var Currentstock = document.getElementById("txtCurrentStock").value;
            var BillQty = document.getElementById("txtQty").value;

            if (BillQty > Currentstock) {
                swal("Alert!", "Bill Qty should not above current stock", "warning");
                document.getElementById("txtQty").value = "";
                document.getElementById("txtQty").focus();
            }

        }

        function LoadProductDetails() {

            var StockItemID = document.getElementById("cmbProductCode").value;
            var datas = "&StockItemID=" + StockItemID;
            // alert(datas);
            $.ajax({
                url: "Load/LoadProductDetailsPreOrder.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#txtShortcode").val(data[0]);
                    $("#txtProductName").val(data[1]);
                    $("#txtBatchcode").val(data[2]);

                    $("#txtCurrentStock").val(data[4]);
                    $("#txtRate").val(data[5]);
                    $("#txtCategory").val(data[6]);
                    $("#txtMRP").val(data[7]);
                    $("#txtLocationCode").val(data[8]);

                    document.getElementById("txtQty").focus();


                }
            });
        }


        function LoadInvoiceTotal() {

            var STOUniqueNo = document.getElementById("txtInvoiceNo").value;
            var datas = "&STOUniqueNo=" + STOUniqueNo;
            // alert(datas);
            $.ajax({
                url: "Load/LoadSTOTotal.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {
                    // alert(data);
                    $("#txtNettAmount").val(data[0]);
                    $("#txtTotalProfitAmount").val(data[1]);
                    $("#txtTotalSaleQty").val(data[2]);
                    $("#txtTotalDiscountAmount").val(data[3]);

                }
            });
        }



        function LoadPaitentDetails() {

            var MobileNo = document.getElementById("txtMobileNo").value;
            var datas = "&MobileNo=" + MobileNo;
            // alert(datas);
            $.ajax({
                url: "Load/LoadPaitentDetails.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#txtName").val(data[0]);
                    $("#txtPaitentCode").val(data[1]);
                    var PaitentCode = document.getElementById("txtPaitentCode").value;
                    if (PaitentCode == "") {
                        // alert("new");
                    } else {

                        // alert("old");
                        document.getElementById("cmbProductCode").focus();
                    }

                }
            });
        }



        function LoadProductList() {

            var STOUniqueNo = document.getElementById("txtInvoiceNo").value;
            var datas = "&STOUniqueNo=" + STOUniqueNo;
            // alert(datas);
            $.ajax({
                url: "Load/LoadPreorderItems.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivTutorList').html(data);


                }
            });
            LoadInvoiceTotal();

        }

        function SavePaymentDetails() {

            var Invoice = document.getElementById("txtInvoiceNo").value;
            var PaitentCode = document.getElementById("txtPaitentCode").value;
            var PaymentMode = document.getElementById("cmbPaymentMode").value;
            var PaymentAmount = document.getElementById("txtPaymentAmount").value;
            var NettAmount = document.getElementById("txtNettAmount").value;

            if (PaymentMode == "" || PaymentAmount == "" || PaymentAmount == 0 || NettAmount == 0 || NettAmount == "") {

                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {
                var datas = "&PaymentMode=" + PaymentMode + "&Invoice=" + Invoice + "&PaitentCode=" + PaitentCode +
                    "&PaymentAmount=" + PaymentAmount;
                // alert(datas);
                $.ajax({
                    url: "Save/SavePaymentDetails.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        // alert(data);
                        LoadPaymentDetails();
                    }
                });
            }
            document.getElementById("cmbPaymentMode").value = "";
            document.getElementById("txtPaymentAmount").value = "";
        }

        function LoadPaymentDetails() {

            var Invoice = document.getElementById("txtInvoiceNo").value;
            var datas = "&Invoice=" + Invoice;
            // alert(datas);
            $.ajax({
                url: "Load/LoadPaymentDetails.php",
                method: "POST",
                data: datas,
                success: function(data) {


                    $('#DivPaymentList').html(data);


                }
            });
            LoadPaymentTotal();

        }

        function DeletePaymentItem() {
            var PaymentID = document.getElementById("txtPaymentID").value;
            var datas = "&PaymentID=" + PaymentID;
            // alert(datas);
            $.ajax({
                url: "Delete/DeletePaymentItem.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    alert(data);

                }
            });
            LoadPaymentDetails();
        }

        function LoadPaymentTotal() {

            var Invoice = document.getElementById("txtInvoiceNo").value;
            var NettAmount = document.getElementById("txtNettAmount").value;
            var datas = "&Invoice=" + Invoice;
            // alert(datas);
            $.ajax({
                url: "Load/LoadPaymentTotal.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {
                    // alert(data);
                    $("#txtTotalPayment").val(data[0]);
                    $("#txtBalance").val(data[2]);
                }
            });
            // CalculatePaymentTotal();
        }

        function GetPointID(x) {
            var SelectedColumn = x.cellIndex;
            var SelectedRow = x.parentNode.rowIndex;

            var Id = document.getElementById("tblPaymentItems").rows[SelectedRow].cells[1].innerHTML;
            document.getElementById("txtPaymentID").value = Id;
            DeletePaymentItem();
        }
        </script>

        <div id="content" class="content">

            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-12">
                    <div id='ModalProject' class='modal-window'>
                        <div>
                            <a href='#modal-close' title='Close' class='modal-close'>&times;</a>


                            <h1>Payment</h1>

                            <hr>

                            <div class="col-md-2">


                                <div class="form-group">
                                    <label>Delv. Mode</label>
                                    <select class="form-control" style="width: 100px;" id='cmbDeliveryMode'
                                        name='cmbDeliveryMode'>
                                        <option selected value='Counter'>Counter</option>
                                        <option value='Courier'>Courier</option>
                                        <option value='SomeOne'>Some one</option>
                                    </select>



                                </div>
                            </div>

                            <div class="col-md-5">


                                <div class="form-group">
                                    <label>Payment Mode</label>
                                    <select class="form-control" id='cmbPaymentMode' name='cmbPaymentMode'>
                                        <option></option>
                                        <?php  
                            $sqli = "  SELECT paymentmodecode, paymentmode FROM paymentmodemaster WHERE activestatus='Active'";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value='.$row['paymentmodecode'].'>'.$row['paymentmode'].'</option>';
                              }	
                            ?>

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Advance</label>
                                    <input type="number" name="txtPaymentAmount" id="txtPaymentAmount" placeholder=""
                                        class="form-control" />
                                    <input type="hidden" name="txtPaymentID" id="txtPaymentID" placeholder=""
                                        class="form-control" />

                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div>
                                <label>Remarks</label>
                                <textarea class="form-control" id='txtOrderRemarks' name='txtOrderRemarks'></textarea>
                            </div>






                            <hr>

                            <a href='#modal-close' title='Close'><input type="button" class="btn btn-sm btn-success"
                                    data-dismiss='modal-close' onclick="SavePreOrderMaster();" value='Save'></a>

                            <br>
                            <br>
                        </div>


                    </div>
                </div>


                <div class="modal fade" id="ModalPreOrderMaster">
                    <div class="modal-dialog  modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Saved Address</h4>
                            </div>
                            <div class="modal-body">
                                <div data-scrollbar="true" data-height="200px">

                                    <ul class="chats">

                                        <div id='DivAddres'> </div>

                                    </ul>
                                </div>



                            </div>
                            <div class="modal-footer">
                                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title">Paitient Order Details</h4>
                    </div>
                    <div class="panel-body">


                        <div>
                            <fieldset>

                                <div class="row">
                                    <!-- begin col-4 -->
                                    <input type="hidden" name="txtInvoiceNo" id="txtInvoiceNo" placeholder=""
                                        class="form-control" />


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Location</label>




                                            <?php 
                                  if($GroupID=='1')
                                  {
                                    ?>
                                            <select class="form-control"
                                                style='border-radius: 4px; padding: 5px; text-align: left;'
                                                id='cmbLocationAdmin' name='cmbLocationAdmin'
                                                onchange='HideCourierDetails()' style="width: 150px;">
                                                <?php  
                    $sqli = "SELECT locationcode,locationname FROM locationmaster where activestatus='Active'";
                    $result = mysqli_query($connection, $sqli); 
                     while ($row = mysqli_fetch_array($result)) {
                        # code...
                  
                     echo ' <option value='.$row['locationcode'].'>'.$row['locationname'].'</option>';
                      }	
                    ?>
                                            </select>
                                            <?php
                                  }
                                  else
                                  { ?>
                                            <select class="form-control"
                                                style='border-radius: 4px; padding: 5px; text-align: left;'
                                                id='cmbLocationAdmin' name='cmbLocationAdmin' onchange='HideCourierDetails()'
                                                style="width: 150px;">
                                                <?php  
                    $sqli = "SELECT locationcode,locationname FROM locationmaster where activestatus='Active' and 
                    locationcode ='$LocationCode'";
                    $result = mysqli_query($connection, $sqli); 
                     while ($row = mysqli_fetch_array($result)) {
                        # code...
                  
                     echo ' <option value='.$row['locationcode'].'>'.$row['locationname'].'</option>';
                      }	
                    ?>
                                            </select>
                                            <?php }
                                  ?>



                                        </div>
                                    </div>



                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Paitent</label>
                                            <select class="selectpicker form-control" data-show-subtext="true"
                                                data-live-search="true" data-style="btn-white" id='cmbPaitent'
                                                name='cmbPaitent' style="width:150px;">
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
                                        </div>
                                    </div>



                                    <div class="col-md-3" style="margin-left:-0%;">
                                        <div class="form-group">
                                            <label> Product</label>
                                            <select class="selectpicker form-control" data-show-subtext="true"
                                                data-live-search="true" data-style="btn-white" id='cmbProductCode'
                                                name='cmbProductCode'
                                                onchange="LoadProductDetails();ClearTotalAmount();"
                                                style="width: 650px;">
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

                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="text" name="txtQty" id="txtQty" placeholder=""
                                                class="form-control" onkeyup="CalculateTotal();" />
                                        </div>
                                    </div>

                                    <div style='display:none;'>
                                        <div class="col-md-1" style="margin-left:-0%;">
                                            <div class="form-group">
                                                <label>MRP</label>
                                                <input style="background-color:white;" type="text" name="txtMRP"
                                                    id="txtMRP" placeholder="" class="form-control"
                                                    onchange="CalculateTotal();" disabled />
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Cr. Stock</label>
                                                <input style="background-color:white;" type="text"
                                                    name="txtCurrentStock" id="txtCurrentStock" placeholder=""
                                                    class="form-control" disabled />
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Total Amt.</label>
                                                <input style="background-color:white;" type="text" name="txtTotalAmount"
                                                    id="txtTotalAmount" placeholder="" class="form-control" disabled />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <br>
                                            <div class="controls">
                                                <input type="button" class="btn btn-sm btn-success"
                                                    onclick="SavePaitentPreOrderItems();" value='Add'>
                                                <input type="button" class="btn btn-sm btn-warning" onclick="Reset();"
                                                    value='Clear'>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="row">


                                    <input style="background-color:white;" type="hidden" name="txtShortcode"
                                        id="txtShortcode" placeholder="" class="form-control" disabled />
                                    <input style="background-color:white;" type="hidden" name="txtCategory"
                                        id="txtCategory" placeholder="" class="form-control" disabled />
                                    <input style="background-color:white;" type="hidden" name="txtProductName"
                                        id="txtProductName" placeholder="" class="form-control" disabled />
                                    <input style="background-color:white;" type="hidden" name="txtBatchcode"
                                        id="txtBatchcode" placeholder="" class="form-control" disabled />
                                    <input style="background-color:white;" type="hidden" name="txtProfitAmount"
                                        id="txtProfitAmount" placeholder="" class="form-control" disabled />

                                    <input style="background-color:white;" type="hidden" name="txtRate" id="txtRate"
                                        placeholder="" class="form-control" disabled />
                                    <input style="background-color:white;" type="hidden" name="txtLocationCode"
                                        id="txtLocationCode" placeholder="" class="form-control" disabled />
                                    <input type="hidden" name="txtDiscPercent" id="txtDiscPercent" placeholder=""
                                        class="form-control" value=0 onkeyup="CalculateTotal();" />
                                    <input type="hidden" name="txtDiscAmount" id="txtDiscAmount" placeholder=""
                                        class="form-control" value=0 onkeyup="CalculateTotal();" />

                                </div>





                            </fieldset>
                        </div>

                        <div class="col-md-12">
                            <!-- begin panel -->
                            <div class="panel panel-inverse" data-sortable-id="form-stuff-1">

                                <div class="panel-body">

                                    <div data-scrollbar="true" data-height="250px">

                                        <ul class="chats">


                                            <div id="DivTutorList" class="email-content"></div>

                                        </ul>
                                    </div>
                                    <br>


                                    <table style="position: relative; float:right;">
                                        <tr>
                                            <td>

                                                <input style="text-align: right;" type="hidden" class="form-control"
                                                    placeholder="" id='txtTotalDiscountAmount'
                                                    name='txtTotalDiscountAmount' />

                                                <input style="text-align: right;" type="hidden" class="form-control"
                                                    placeholder="" id='txtTotalProfitAmount'
                                                    name='txtTotalProfitAmount' />

                                            </td>

                                            <td>
                                                <a href="#ModalProject" data-toggle="modal"
                                                    class="btn btn-sm btn-success" onclick='this.disabled=true;'>
                                                    Create Order</a>

                                            </td>
                                            <td> &nbsp;&nbsp;&nbsp; <input type="button" class="btn btn-sm btn-warning"
                                                    onclick="window.location.reload();" value='Cancel'>
                                            </td>
                                        <tr>
                                            <table>


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