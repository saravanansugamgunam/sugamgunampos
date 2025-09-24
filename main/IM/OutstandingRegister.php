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
    <!-- ================== END BASE JS ================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="../assets/Custom/sweetalert.css" rel="stylesheet" />
    <script src="../assets/Custom/sweetalert2.min.js"></script>
    <script src="../assets/Custom/IndexTable.js"></script>
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

    html,
    body {
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
<div id="myModalPayment" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Outstanding Payment</h4>
            </div>
            <script>
            function Payment(x) {
                var SelectedColumn = x.cellIndex;
                var SelectedRow = x.parentNode.rowIndex;
                // alert(SelectedRow);
                var PaitientName = document.getElementById("tblOutstanding").rows[SelectedRow].cells[3].innerHTML;
                var PatientCode = document.getElementById("tblOutstanding").rows[SelectedRow].cells[1].innerHTML;
                var MobileNo = document.getElementById("tblOutstanding").rows[SelectedRow].cells[4].innerHTML;
                // trim()
                // alert(SelectedRow);
                var TotalOutstanding = document.getElementById("tblOutstanding").rows[SelectedRow].cells[6].innerHTML;
                document.getElementById("txtMobile").value = MobileNo;
                document.getElementById("txtPaitentName").value = PaitientName;
                document.getElementById("txtTotalOutstanding").value = TotalOutstanding;
                document.getElementById("txtPatientCode").value = PatientCode.trim();

                var datas = "&TotalOutstanding=" + TotalOutstanding;
                // alert(datas);


            }

            function CalculateBalance() {

                var total = parseInt(document.getElementById("txtTotalOutstanding").value);
                var val2 = parseInt(document.getElementById("txtTotalPayment").value);

                // to make sure that they are numbers
                if (!total) {
                    total = 0;
                }
                if (!val2) {
                    val2 = 0;
                }

                var ansD = document.getElementById("txtNewBalance");
                ansD.value = total - val2;
            }

            function LoadInvoiceNo() {

                var InvoiceNo = new Date().getTime();
                document.getElementById("txtInvoiceNo").value = InvoiceNo;


            }

            function SavePayment() {
                LoadInvoiceNo();
                // alert(1);
                var OldBalance = document.getElementById("txtTotalOutstanding").value;
                var Payment = document.getElementById("txtTotalPayment").value;
                var NewBalance = document.getElementById("txtNewBalance").value;
                var InvoiceNo = document.getElementById("txtInvoiceNo").value;
                var PatientCode = document.getElementById("txtPatientCode").value;
                var PaymentMode = document.getElementById("cmbPaymentMode").value;
                var PaymentDate = document.getElementById("dtOutstandingPaymentDate").value;
                var LocationCode = document.getElementById("cmbLocationAdmin").value;
                
                // alert(2);
                if (PaymentDate == "" || PatientCode == "" || PaymentMode == "" || NewBalance == "" || Payment == "" ||
                    Payment == 0) {
                    swal("Kindly select payment mode");
                } else if (NewBalance < 0) {
                    swal("Balance should not be Less than Zero");
                } else {
                    var datas = "&PatientCode=" + PatientCode + "&PaymentMode=" + PaymentMode + "&PaymentDate=" +
                        PaymentDate + "&OldBalance=" + OldBalance + "&Payment=" + Payment + "&NewBalance=" +
                        NewBalance + "&InvoiceNo=" + InvoiceNo + "&LocationCode=" + LocationCode;
                    // alert(datas);
                    $.ajax({
                        url: "Save/SaveOutstandingPayment.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {
                            // swal(data);
                            swal("Payment Saved");
                            window.location.reload();

                        }
                    });
                }


            }

            function printDiv() {
                var divToPrint = document.getElementById('DivPrint');
                newWin = window.open("");
                newWin.document.write(divToPrint.outerHTML);
                newWin.print();
                newWin.close();
            }
            </script>


            <div class="modal-body">
                <input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' />
                <input type='hidden' id='txtPatientCode' name='txtPatientCode' />
                <div>
                    <table>
                        <tr>
                            <td>Payment Date</td>
                            <td><input type='date' id='dtOutstandingPaymentDate' name='dtOutstandingPaymentDate'
                                    style="width: 150px; height:30px; padding-top:6px;
                                     padding-bottom: 4px; margin-right: 4px; font-size:15px; border-radius: 4px;"
                                      value='<?php echo date('Y-m-d');?>' />
                            </td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>

                        <tr>
                            <td>Location</td>
                            <td><?php 
                                  if($GroupID=='1')
                                  {
                                    ?>
                                    <select class="form-control"
                                    style='border-radius: 4px; padding: 5px; text-align: left;' id='cmbLocationAdmin'
                                    name='cmbLocationAdmin' onchange='HideCourierDetails()' style="width: 150px;">
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
                                    style='border-radius: 4px; padding: 5px; text-align: left;' id='cmbLocationAdmin'
                                    name='cmbLocationAdmin' onchange='HideCourierDetails()' style="width: 150px;">
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
                            </td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>


                        <tr>
                            <td>Paitent Name &nbsp;&nbsp;</td>

                            <td><input type='text' id='txtPaitentName' name='txtPaitentName'
                                    style="width: 150px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px; border-radius: 4px;"
                                    disabled /></td>
                            <td>Mobile &nbsp;&nbsp;</td>

                            <td><input type='text' id='txtMobile' name='txtMobile'
                                    style="width: 150px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px; border-radius: 4px;"
                                    disabled /></td>
                        </tr>

                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>Total Outstanding &nbsp;&nbsp;</td>

                            <td><input type='text' id='txtTotalOutstanding' name='txtTotalOutstanding'
                                    style="width: 150px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px; border-radius: 4px;"
                                    disabled /></td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>Payment Mode</td>
                            <td><select id='cmbPaymentMode' name='cmbPaymentMode' onchange='focusamount();'
                                    style="width: 150px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px; border-radius: 4px;">
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
                            </td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>Total Payment&nbsp;&nbsp;</td>
                            <td><input type='number' id='txtTotalPayment' name='txtTotalPayment'
                                    style="width: 150px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px; border-radius: 4px;"
                                    required onkeyup="CalculateBalance()" value=0 /></td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td>Balance&nbsp;&nbsp;</td>
                            <td><input type='text' id='txtNewBalance' name='txtNewBalance'
                                    style="width: 150px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px; border-radius: 4px;"
                                    disabled /></td>
                        </tr>

                    </table>




                </div>

                <br>


                <button type="button" class="btn btn-success" onclick='SavePayment();'>Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>

    </div>
</div>


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
                <hr>

            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>

                <a href="javascript:;" type='submit' onclick='SendEmail();' class='btn btn-sm btn-success'>Send</a>
            </div>
        </div>
    </div>
</div>




<body onload="LoadOutstandingReport();">
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
                function exportF(elem) {
                    var table = document.getElementById("data-table");
                    var html = table.outerHTML;
                    var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
                    elem.setAttribute("href", url);
                    elem.setAttribute("download", "export.xls"); // Choose the file name
                    return false;
                }

                function LoadOutstandingReport() {

                    var Type = 'Detail';

                    var datas = "&Type=" + Type;
                    // alert(datas);
                    $.ajax({
                        url: "Load/LoadOutstandingReport.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {
                            // alert(data);
                            $('#DivPaymentHistory').html(data);


                        }
                    });
                    LoadOutstandingReportTotal();
                }

                function LoadOutstandingReportTotal() {

                    var Type = 'Detail';

                    var datas = "&Type=" + Type;
                    // alert(datas);
                    $.ajax({
                        url: "Load/LoadOutstandingReportTotal.php",
                        method: "POST",
                        data: datas,
                        dataType: "json",
                        success: function(data) {
                            // alert(data); 
                            $("#txtTotalSale").val(data[0]);

                        }
                    });
                }

                function LoadItemDetails(x) {
                    var Invoice = x;
                    document.getElementById("txtInvoiceNo").value = x;
                    var datas = "&Invoice=" + Invoice;
                    alert(datas);
                    $.ajax({
                        url: "Load/LoadProductListReturn.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {

                            $('#DivProductListReturn').html(data);


                        }
                    });

                }

                function LoadSelectedItemDetails() {


                    var Invoice = document.getElementById("txtInvoiceNo").value;
                    var datas = "&Invoice=" + Invoice;
                    // alert(datas);
                    $.ajax({
                        url: "Load/LoadProductListSelectedReturn.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {


                            $('#DivSelectedProductListReturn').html(data);


                        }
                    });

                }

                function CancellBill(x) {
                    var ItemID = x;
                    var Invoice = document.getElementById("txtInvoiceNo").value;
                    var datas = "&Invoice=" + Invoice;
                    // alert(datas);
                    $.ajax({
                        url: "Delete/CancelBill.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {
                            alert(data);

                            // $( '#DivSelectedProductListReturn' ).html(data);


                        }
                    });
                }


                function GetBillDetail(x) {


                    var SelectedColumn = x.cellIndex;
                    var SelectedRow = x.parentNode.rowIndex;


                    // var Id = document.getElementById("indextable").rows[SelectedRow].cells[0].innerHTML; 
                    var STOID = document.getElementById("data-table").rows[SelectedRow].cells.namedItem("InvoiceNo")
                        .innerHTML;
                    //alert (Id);
                    var datas = "&STOID=" + STOID;
                    // alert(datas);
                    $.ajax({
                        method: 'POST',
                        url: "SaleBillView.php",
                        data: datas,
                        success: function(response) {

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



                function SendSMS(x) {
                    // alert(1);
                    var row = x.parentNode.rowIndex;
                    // alert(row);
                    var MobileNo = document.getElementById("tblOutstanding").rows[row].cells.namedItem("MobileNo")
                        .innerHTML;
                    var TotalValue = document.getElementById("tblOutstanding").rows[row].cells.namedItem("Outstanding")
                        .innerHTML;
                    var PatientName = document.getElementById("tblOutstanding").rows[row].cells.namedItem(
                        "PaitientName").innerHTML;
                    // var MobileNo = 9884589943; 
                    // alert(MobileNo);
                    var M1 = "Dear ";
                    var M2 = PatientName;
                    var M3 = " we would like to remind you that the amount Rs.";
                    var M4 =
                        " was due for payment. Looking forward to receiving your payment, SUGAMGUNAM. Cell:9176606308.";
                    var M4 = " Google Pay no: 9488228603.";

                    var Message = M1.concat(M2, ",", M3, TotalValue, M4)

                    // var M3  = ", Thanks for trust in SugamGunam, Chetpet";
                    // var Message  =   M1.concat('Rs.',TotalValue,M2);
                    // alert(Message);
                    var datas = "&MobileNo=" + MobileNo + "&Message=" + Message;
                    // alert(datas); 
                    $.ajax({
                        url: "sendsms.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {
                            alert(data);

                        }
                    });
                }

                function GetID(x) {
                    // alert(1);
                    var row = x.parentNode.rowIndex;

                    // document.getElementById("txtMobileforEmail").value = document.getElementById("tblOutstanding").rows[row].cells.namedItem("MobileNo").innerHTML;

                    document.getElementById("txtMobileforEmail").value = document.getElementById("tblOutstanding").rows[
                        row].cells.namedItem("MobileNo").innerHTML;
                    // alert(tet); 
                    document.getElementById("txtOutstandingforEmail").value = document.getElementById("tblOutstanding")
                        .rows[row].cells.namedItem("Outstanding").innerHTML;
                    document.getElementById("txtPaitentNameforEmail").value = document.getElementById("tblOutstanding")
                        .rows[row].cells.namedItem("PaitientName").innerHTML;

                    document.getElementById("txtEmail").value = document.getElementById("tblOutstanding").rows[row]
                        .cells.namedItem("OutstandingEmail").innerHTML;

                }

                function SendEmail() {
                    var EmaiID = document.getElementById("txtEmail").value;
                    var MobileNo = document.getElementById("txtMobileforEmail").value;
                    var OutstandingAmount = document.getElementById("txtOutstandingforEmail").value;
                    var PaitentName = document.getElementById("txtPaitentNameforEmail").value;

                    if (EmaiID == "") {
                        alert("Kindly provide Email ID");
                    } else {

                        var datas = "&EmaiID=" + EmaiID + "&MobileNo=" + MobileNo + "&OutstandingAmount=" +
                            OutstandingAmount + "&PaitentName=" + PaitentName;

                        $.ajax({
                            url: "sendemail_outstanding.php",
                            method: "POST",
                            data: datas,
                            success: function(data) {
                                alert(data);

                            }
                        });
                    }
                }
                </script>


                <div class="col-md-12">

                    <input type='hidden' name='txtMobileforEmail' id='txtMobileforEmail' />
                    <input type='hidden' name='txtOutstandingforEmail' id='txtOutstandingforEmail' />
                    <input type='hidden' name='txtPaitentNameforEmail' id='txtPaitentNameforEmail' />
                    <!-- begin panel -->
                    <div class="panel panel-success">
                        <div class="panel-heading">

                            <h4 class="panel-title">Outstanding Report&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-2x fa-print" onclick="printDiv();"></i>

                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <!-- <button hidden class="btn btn-sm btn-info btn-xs" > <a style="color: white;" onclick="exportF(this)">Export</a> </button> -->
                            </h4>


                        </div>

                        <div class="panel-body">

                            <div class="table-responsive" id='DivStockReport'>

                                <table>
                                    <tr>

                                        <td><b>Total Outstanding</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td><b><input style='border-radius: 4px; padding: 5px; text-align: right;'
                                                    size="15" type='text' id='txtTotalSale' name='txtTotalSale' /></b>
                                        </td>

                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<input
                                                style='border-radius: 4px; padding: 5px; text-align: left;' id='myInput'
                                                name='myInput' placeholder='Search...' /></b></td>

                                    </tr>

                                </table>
                                <br>
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