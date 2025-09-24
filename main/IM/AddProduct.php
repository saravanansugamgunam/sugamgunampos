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
if (isset($_SESSION['SESS_LAST_NAME'])) {
    //echo 'Session Active';

} else {
    //echo 'Session In Active';
    $url = '../../index.php';
    echo '
    <META HTTP-EQUIV=REFRESH CONTENT=".1; ' . $url . '">';
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
    <link href="../assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <link href="../assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
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
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
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

<body onload="Reset();">
    <!-- begin #page-loader -->

    <div id="myModalEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Product</h4>
                </div>

                <div class="modal-body">
                    <input hidden='text' id='txtProductID' name='txtProductID' />


                    <input hidden='text' id='txtProductStatus' name='txtProductStatus' />
                    <br>

                    <table>
                        <tr>
                            <td>Product</td>
                            <td><input type='text' class="form-control" id='txtProductUpdatedName'
                                    name='txtProductUpdatedName' style="text-transform:uppercase" /></td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>

                        <tr>
                            <td>Short Code</td>
                            <td><input type='text' class="form-control" id='txtShortcodeUpdate'
                                    name='txtShortcodeUpdate' style="text-transform:uppercase" /></td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>


                        <tr>
                            <td>GST %</td>
                            <td>
                                <select class="form-control" id='cmbGSTUpdatName' name='cmbGSTUpdatName'>
                                    <option></option>
                                    <?php
                                    $sqli = "  SELECT gstpercentage,gstname FROM gstmaster  WHERE activestatus ='Active' ORDER BY 1 ";
                                    $result = mysqli_query($connection, $sqli);
                                    while ($row = mysqli_fetch_array($result)) {
                                        # code...

                                        echo ' <option value="' . $row['gstpercentage'] . '">' . $row['gstname'] . '</option>';
                                    }
                                    ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>

                        <tr>
                            <td>HSN Code</td>
                            <td><input type='text' class="form-control" id='txtHSNCodeUpdateName'
                                    name='txtHSNCodeUpdateName' style="text-transform:uppercase" /></td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>


                        <tr>
                            <td>Barcode</td>
                            <td><input type='text' class="form-control" disabled id='txtBarcodeUpdate'
                                    name='txtBarcodeUpdate' style="text-transform:uppercase" /></td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>





                        <tr>
                            <td>Weight</td>
                            <td><input type='number' class="form-control" id='txtWeightUpdate' name='txtWeightUpdate' />
                            </td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>MRP Product</td>

                            <td>

                                <select class="form-control" id='cmbisMRPUpdate' name='cmbisMRPUpdate'>
                                    <option value=0>No</option>
                                    <option value=1>Yes</option>

                                </select>

                            </td>
                        </tr>

                        <tr>
                            <td><br></td>
                        </tr>


                        <tr>
                            <td><label class="col-md-1 control-label">Status</label></td>
                            <td><label class="radio-inline">
                                    <input type="radio" id='rdActive' name="rdProductStatus" value="Active" checked />
                                    Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" id='rdInActive' name="rdProductStatus" value="In Active " />
                                    In Active
                                </label>
                            </td>
                        </tr>
                    </table>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" onclick="UpdateProduct();"
                        data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <script>
    function GetRowID(x) {

        var row = x.parentNode.rowIndex;
        document.getElementById("txtProductID").value = document.getElementById("data-table").rows[row].cells.namedItem(
            "ProductID").innerHTML;
        document.getElementById("txtProductUpdatedName").value = document.getElementById("data-table").rows[row].cells
            .namedItem("Product").innerHTML;
        document.getElementById("txtProductStatus").value = document.getElementById("data-table").rows[row].cells
            .namedItem("ProductStatus").innerHTML;


        document.getElementById("txtHSNCodeUpdateName").value = document.getElementById("data-table").rows[row].cells
            .namedItem("HSNCodeUpdateName").innerHTML;


        document.getElementById("txtBarcodeUpdate").value = document.getElementById("data-table").rows[row].cells
            .namedItem("Barcode").innerHTML;


        document.getElementById("txtShortcodeUpdate").value = document.getElementById("data-table").rows[row].cells
            .namedItem("ShortCode").innerHTML;



        document.getElementById("cmbGSTUpdatName").value = document.getElementById("data-table").rows[row].cells
            .namedItem("GSTUpdatName").innerHTML;

        document.getElementById("txtWeightUpdate").value = document.getElementById("data-table").rows[row].cells
            .namedItem("Weight").innerHTML;


        document.getElementById("cmbisMRPUpdate").value = document.getElementById("data-table").rows[row].cells
            .namedItem("isMRP").innerHTML;


    }


    function UpdateProduct() {
        var ProductStatus = $("input[name='rdProductStatus']:checked").val();
        var UpdatedProductName = document.getElementById("txtProductUpdatedName").value;
        var ProductID = document.getElementById("txtProductID").value;
        var HSNName = document.getElementById("txtHSNCodeUpdateName").value;
        var GSTPercent = document.getElementById("cmbGSTUpdatName").value;
        var ShortCode = document.getElementById("txtShortcodeUpdate").value;
        var Weight = document.getElementById("txtWeightUpdate").value;
        var IsMRPUpdate = document.getElementById("cmbisMRPUpdate").value;
        var BarcodeUpdate = document.getElementById("txtBarcodeUpdate").value;

        var datas = "&ProductID=" + encodeURIComponent(ProductID) +
            "&UpdatedProductName=" + encodeURIComponent(UpdatedProductName) +
            "&HSNName=" + encodeURIComponent(HSNName) +
            "&GSTPercent=" + encodeURIComponent(GSTPercent) +
            "&ShortCode=" + encodeURIComponent(ShortCode) +
            "&Weight=" + encodeURIComponent(Weight) +
            "&BarcodeUpdate=" + encodeURIComponent(BarcodeUpdate) +
            "&IsMRPUpdate=" + encodeURIComponent(IsMRPUpdate) +

            "&ProductStatus=" + encodeURIComponent(ProductStatus);

        $.ajax({
            url: "Save/UpdateProduct.php",
            method: "POST",
            data: datas,
            success: function(data) {

                // swal(data);
                if (data == 1) {
                    swal("Product!", "Product updated sucessfully", "success");
                    Reset();
                } else {
                    swal("Alert!", "Error updating product", "warning");
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
        function SaveProduct() {

            var ShortCode = document.getElementById("txtProductCode").value;
            var ProductName = document.getElementById("txtProductName").value;
            var Category = document.getElementById("cmbCategory").value;
            var MRP = document.getElementById("txtMRP").value;

            var HSN = document.getElementById("txtHSNCode").value;
            var GST = document.getElementById("cmbGST").value;
            var Weight = document.getElementById("txtWeight").value;
            var IsMRP = document.getElementById("cmbisMRP").value;
            var Barcode = document.getElementById("txtBarcode").value;
            var ApplicationType = document.getElementById("cmbApplicationType").value;
            var MedicineBase = document.getElementById("cmbMedicineBase").value;
            var ProductType = document.getElementById("cmbProductType").value;



            if (ShortCode == "" || ProductName == "" || Category == "" || GST == "") {

                swal("Alert!", "Kindly provide valid details!", "warning");

            } else {
                var datas = "&ShortCode=" + ShortCode + "&ProductName=" + ProductName +
                    "&Category=" + Category +
                    "&GST=" + GST +
                    "&HSN=" + HSN +
                    "&Weight=" + Weight +
                    "&IsMRP=" + IsMRP +
                    "&Barcode=" + Barcode +
                    "&ApplicationType=" + ApplicationType +
                    "&MedicineBase=" + MedicineBase +
                    "&ProductType=" + ProductType +
                    "&MRP=" + MRP;

                $.ajax({
                    url: "Save/SaveProduct.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {


                        if (data == 1) {
                            swal("Product!", "Added Sucessfully", "success");
                            Reset();
                        } else {
                            swal("Alert!", "Error Adding Product", "warning");
                            Reset();
                        }


                    }
                });
            }

        }

        function Reset() {

            var ShortCode = document.getElementById("txtProductCode").value;
            var ProductName = document.getElementById("txtProductName").value;
            var Category = document.getElementById("cmbCategory").value;
            var MRP = document.getElementById("txtMRP").value;

            document.getElementById("txtProductCode").value = "";
            document.getElementById("txtProductName").value = "";
            document.getElementById("cmbCategory").value = "";
            document.getElementById("txtMRP").value = "";
            document.getElementById("txtHSNCode").value = "";
            document.getElementById("txtWeight").value = "";

            LoadProductList();
        }

        function LoadProductList() {

            var Category = '%';
            var WeightStatus = document.getElementById("cmbWeightStatus").value;
            var ActiveStatus = document.getElementById("cmbActiveStatus").value; 
            var ID = 1;
            var datas = "&Category=" + Category + "&WeightStatus=" + WeightStatus + 
            "&ActiveStatus=" + ActiveStatus;
            // alert(datas);
            $.ajax({
                url: "Load/LoadProductList.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivTutorList').html(data);


                }
            });
        }

        function FilterProductList() {

            var Category = document.getElementById("cmbCategory").value;
            var WeightStatus = document.getElementById("cmbWeightStatus").value;
            var ActiveStatus = document.getElementById("cmbActiveStatus").value;
            var ID = 1;
            var datas = "&Category=" + Category + "&WeightStatus=" + WeightStatus + "&ActiveStatus=" + ActiveStatus;
            // alert(datas);
            $.ajax({
                url: "Load/LoadProductList.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    // alert(data);
                    $('#DivTutorList').html(data);


                }
            });
        }

        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('data-table');
            var wb = XLSX.utils.table_to_book(elt, {
                sheet: "sheet1"
            });
            return dl ?
                XLSX.write(wb, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                }) :
                XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
        }
        </script>

<?php
include '../connect.php'; // Ensure database connection

// Fetch categories
$categoryOptions = "";
$sql = "SELECT id, name FROM category WHERE categorystatus='Active'";
$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $categoryOptions .= "<option value='{$row['name']}'>{$row['name']}</option>";
}
$stmt->close();

// Fetch GST options
$gstOptions = "";
$sql = "SELECT gstpercentage, gstname FROM gstmaster WHERE activestatus ='Active' ORDER BY 1";
$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $gstOptions .= "<option value='{$row['gstpercentage']}'>{$row['gstname']}</option>";
}
$stmt->close();
?>


        <div id="content" class="content">
            <div class="row">
                <!-- begin col-6 -->
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">

                            <h4 class="panel-title">Product
                                <button class='btn btn-xs btn-warning' onclick="ExportToExcel('xlsx')"
                                    style='float:right;'>Export table to excel</button>

                            </h4>


                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">


                            <div class="row mb-3">
            <div class="col-md-2">
                <label>Category:</label>
                <select class="form-control" id="cmbCategory" name="cmbCategory" required>
                    <option value="">Select Category</option>
                    <?= $categoryOptions; ?>
                </select>
            </div>

            <div class="col-md-2">
                <label>Medicine Base:</label>
                <select class="form-control" id="cmbMedicineBase" name="cmbMedicineBase">
                    <option value="Siddha">Siddha</option>
                    <option value="Ayurvedha">Ayurvedha</option>
                    <option value="Homeopathy">Homeopathy</option>
                    <option value="Unanni">Unanni</option>
                    <option value="Allopathy">Allopathy</option>
                </select>
            </div>

            <div class="col-md-2">
                <label>Product Type:</label>
                <select class="form-control" id="cmbProductType" name="cmbProductType">
                    <option value="Raw Material">Raw Material</option>
                    <option value="Finished Goods">Finished Goods</option>
                    <option value="Label Material">Label Material</option>
                    <option value="Packing Material">Packing Material</option> 
                </select>
            </div>

            <div class="col-md-2">
                <label>Short Code:</label>
                <input type="text" name="txtProductCode" id="txtProductCode" class="form-control text-uppercase">
            </div>
            <div class="col-md-4">
                <label>Product Name:</label>
                <input type="text" id="txtProductName" name="txtProductName" class="form-control text-uppercase" required>
            </div>
            
            <div class="col-md-2">
                <label>GST %:</label>
                <select class="form-control" id="cmbGST" name="cmbGST" required>
                    <option value="">Select GST</option>
                    <?= $gstOptions; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label>HSN Code:</label>
                <input type="text" id="txtHSNCode" name="txtHSNCode" class="form-control text-uppercase" required>
            </div>
       

 
            
            <div class="col-md-2">
                <label>Weight Status:</label>
                <select class="form-control" id="cmbWeightStatus" name="cmbWeightStatus">
                    <option value="%">All</option>
                    <option value="Yes">With Weight</option>
                    <option value="No">W/O Weight</option>
                </select>
            </div>

            <div class="col-md-2">
                <label>Weight (Gms):</label>
                <input type="number" id="txtWeight" name="txtWeight" class="form-control">
            </div>
            <div class="col-md-2">
                <label>MRP Product:</label>
                <select class="form-control" id="cmbisMRP" name="cmbisMRP">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <div class="col-md-2">
                <label>Application Type:</label>
                <select class="form-control" id="cmbApplicationType" name="cmbApplicationType">
                    <option value="IntExt">Multi Purpose</option>
                    <option value="Internal">Internal</option>
                    <option value="External">External</option>
                </select>
            </div>
        </div>
 
        <div class="row mb-3">
       
           
          
            </div>
 
 <div class="row mb-3">
            <div class="col-md-2">
                <label>Status:</label>
                <select class="form-control" id="cmbActiveStatus" name="cmbActiveStatus">
                    <option value="%">All</option>
                    <option value="Active">Active</option>
                    <option value="InActive">Inactive</option>
                </select>
            </div>   
            <div class="col-md-2">
                <label>Barcode:</label>
                <input type="text" id="txtBarcode" name="txtBarcode" class="form-control text-uppercase" disabled>
            </div>
           
            <div class="col-md-4">
                <label>Actions:</label><br>
                <button type="button"  onclick="SaveProduct();" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-warning" onclick="Reset();">Cancel</button>
            </div>
        </div>

                                <div class="form-group" style="display:none;">
                                    <label class="col-md-3 control-label">MRP</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="" id='txtMRP' name='txtMRP'
                                            value=0 />
                                    </div>

                                </div>


                            </form>
                        </div>
                    </div>



                    <!-- end panel -->
                </div>

                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">

                        <div class="panel-body">
                            <div data-scrollbar="true" data-height="350px">
                                <ul class="chats">


                                    <div id="DivTutorList" class="email-content"></div>
                                </ul>
                            </div>

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
    <script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
    <script src="../assets/js/table-manage-default.demo.min.js"></script>
    <script src="../assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
    $(document).ready(function() {
        App.init();
        Inbox.init();
        FormPlugins.init();
        TableManageDefault.init();

    });
    </script>
</body>
<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->

</html>