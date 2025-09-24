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
if (isset($_SESSION['SESS_LAST_NAME'])) {
    //echo 'Session Active';

} else {
    //echo 'Session In Active';
    $url = '../../index.php';
    echo '
    <META HTTP-EQUIV=REFRESH CONTENT=".1; ' . $url . '">';
}
 

$connection1 = mysqli_connect('193.203.184.82','u392932087_9xUYb','9YEzdL97VU') or die(mysqli_error());
$database1 = mysqli_select_db($connection1,'u392932087_7Pdl3') or die(mysqli_error());

 

 
$OrderID = $_GET['orderid'];


$res = $connection1->query("  
SELECT o.id AS o_id, p.id AS p_id, o.*, b.id AS b_id, b.order_id AS b_order_id, b.address_type AS b_address_type, 
b.first_name AS billing_first_name, b.last_name AS billing_last_name, b.company AS billing_company, 
b.address_1 AS billing_address_1, b.address_2 AS billing_address_2, b.city AS billing_city, b.state AS billing_state,
 b.postcode AS billing_postcode, b.country AS billing_country, b.email AS billing_email, b.phone AS billing_phone, 
 s.id AS s_id, s.order_id AS s_order_id, s.address_type AS s_address_type, s.first_name AS shipping_first_name, 
 s.last_name AS shipping_last_name, s.company AS shipping_company, 
 
CONCAT(IFNULL(s.address_1,''),',',IFNULL(s.address_2,''),',', IFNULL(s.city,''),',', IFNULL(s.state,''),',', IFNULL(s.postcode,''),',', IFNULL(s.country,'')),
 
 s.email AS s_email, s.phone AS shipping_phone, p.*
FROM wp_wc_orders o
LEFT JOIN wp_wc_order_addresses b
ON b.order_id = o.id
AND b.address_type = 'billing'
LEFT JOIN wp_wc_order_addresses s
ON s.order_id = o.id
AND s.address_type = 'shipping'
LEFT JOIN wp_wc_order_operational_data p
ON p.order_id = o.id
WHERE o.id IN ( '$OrderID' )

");



while ($data = mysqli_fetch_row($res)) {

    $OrderID = $data[0];
    $OrderStatus = $data[3];
    $OrderValue = $data[7];
    $OrderEmailID = $data[9];
    $OrderDate = $data[10];
    $OrderPaymentMode = $data[14];
    $CustomerName = $data[22];
    $OrderAddress = $data[39];
    $CustomerMobileNo = $data[32];
    $OrderShippingAmount = $data[61]; 
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
    <!-- ================== END BASE JS ================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link href="../assets/Custom/sweetalert.css" rel="stylesheet" />
    <script src="../assets/Custom/sweetalert2.min.js"></script>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../assets/Custom/masking-input.css" />

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

<body onload="LoadProductDetails();">
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
            <?php include("CLMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->




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

                            <h4 class="panel-title">Order Details</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Order ID</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtInvoiceNo'
                                            name='txtInvoiceNo' disabled value='<?php   echo $OrderID; ?>' />

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Order Date</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='dtBookingDate'
                                            name='dtBookingDate' value='<?php echo  $OrderDate; ?>' disabled />
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Customer Name</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtPaitentName'
                                            name='txtPaitentName' disabled value='<?php  echo  $CustomerName;  ?>' />

                                    </div>

                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Mobile No</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtMobileNo'
                                            name='txtMobileNo' disabled value='<?php  echo $CustomerMobileNo;  ?>' />

                                    </div>

                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Email ID</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtMobileNo'
                                            name='txtMobileNo' disabled value='<?php  echo $OrderEmailID;  ?>' />

                                    </div>

                                </div>


                                <div class="form-group">
                                    <label class="col-md-1 control-label">Address</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" placeholder="" id='txtMobileNo'
                                            name='txtMobileNo' disabled value='<?php  echo $OrderAddress;  ?>' />



                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Payment Mode</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtMobileNo'
                                            name='txtMobileNo' disabled value='<?php  echo $OrderPaymentMode;  ?>' />

                                    </div>

                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Shipping Charges</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtMobileNo'
                                            name='txtMobileNo' disabled value='<?php  echo $OrderShippingAmount;  ?>' />

                                    </div>

                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Order Amount</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="" id='txtMobileNo'
                                            name='txtMobileNo' disabled value='<?php  echo $OrderValue;  ?>' />

                                    </div>

                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label"> </label>
                                    <div class="col-md-9">


                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>





                <div class="col-md-5">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">

                            <h4 class="panel-title">Product Details</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th class='sno' style="  border-bottom: 1px solid black;">#</th>
                                            <th class="description" style="  border-bottom: 1px solid black;">
                                                Description</th>
                                            <th class="price" style="  border-bottom: 1px solid black;">Barcode</th>
                                            <th class="price" style="  border-bottom: 1px solid black;">Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                    $result = mysqli_query($connection1, "   
		
SELECT order_item_name AS Product,sku AS Barcode,c.meta_value AS 'Order Qty' FROM `wp_woocommerce_order_itemmeta`  AS a JOIN 

(SELECT product_id,sku FROM `wp_wc_product_meta_lookup` WHERE product_id IN (
SELECT meta_value FROM `wp_woocommerce_order_itemmeta` WHERE order_item_id IN (  
SELECT order_item_id FROM `wp_woocommerce_order_items` WHERE order_id='$OrderID') 
AND meta_key ='_product_id')) AS b ON a.meta_value=b.product_id 
JOIN (
SELECT order_item_id,meta_value FROM `wp_woocommerce_order_itemmeta` WHERE order_item_id IN (  
SELECT order_item_id FROM `wp_woocommerce_order_items` WHERE order_id='$OrderID') 
AND meta_key  IN('_qty')) AS c  ON a.order_item_id=c.order_item_id

JOIN wp_woocommerce_order_items AS d ON a.order_item_id=d.order_item_id
WHERE a.order_item_id IN (  
SELECT order_item_id FROM `wp_woocommerce_order_items` WHERE order_id='$OrderID') 
AND meta_key  IN('_product_id')

    
	 ");

                    $Sno = 1;
                    while ($row = mysqli_fetch_row($result)) {

                    ?>

                                        <tr>
                                            <td class='sno'><?php echo $Sno; ?></td>
                                            <td class="description"><?php echo $row[0]; ?></td>
                                            <td class="Bacode"><?php echo $row[1]; ?></td>
                                            <td class="Qty"><?php echo $row[2]; ?></td>
                                        </tr>
                                        <?php
                        $Sno = $Sno + 1;
                    }
                    ?>

                                    </tbody>
                                </table>


                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>

            </div>

            <!-- end col-12 -->



        </div>




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


    <script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
    <script src="../assets/js/table-manage-default.demo.min.js"></script>



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
    <script src="../assets/js/form-plugins.demo.min.js"></script>



    <script src="../assets/Custom/masking-input.js" data-autoinit="true"></script>
    <script src="../assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
    $(document).ready(function() {
        App.init();
        Inbox.init();
        FormPlugins.init();
        FormSliderSwitcher.init();
        TableManageDefault.init();
        FormWizard.init();
    });
    </script>
</body>
<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->

</html>