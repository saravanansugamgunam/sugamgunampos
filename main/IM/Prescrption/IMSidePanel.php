<title>Sugamgunam - Inventory</title>

<?php


// Max Menu ID = 65



$GroupID = $_SESSION['SESS_GROUP_ID'];
$MenuID = $_GET['MID'];
$userid = $_SESSION['SESS_MEMBER_ID'];
?>
<ul class="nav">
    <li class="has-sub <?php if ($MenuID == 1) {
                            echo "active";
                        } ?>">
        <a href="index.php?MID=1">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
        </a>

    </li>


    <?php
    if ($GroupID == '3') {
    ?>
        <li class="has-sub <?php if ($MenuID == 7 || $MenuID == 46 || $MenuID == 50 || $MenuID == 52 || $MenuID == 53 || $MenuID == 54) {
                                echo "active";
                            } ?>">
            <a href="javascript:;">
                <i class="fa fa-dropbox"></i>
                <span>Stock</span>
            </a>
            <ul class="sub-menu">

                <li class="<?php if ($MenuID == 7) {
                                echo "active";
                            } ?>"><a href="StockReport.php?MID=7">Stock Report</a>
                </li>





            </ul>
        </li>

    <?php
    } else {
    ?>



        <?php


        if ($GroupID == 1) {
        ?>
            <li class="has-sub <?php if ($MenuID == 2 || $MenuID == 3 || $MenuID == 4 || $MenuID == 17  || $MenuID == 18  || $MenuID == 28  || $MenuID == 29  || $MenuID == 30   || $MenuID == 38   || $MenuID == 39   || $MenuID == 45) {
                                    echo "active";
                                } ?>">
                <a href="javascript:;">
                    <i class="fa fa-sitemap"></i>
                    <span>Master</span>
                </a>


                <ul class="sub-menu">
                    <li class="<?php if ($MenuID == 2) {
                                    echo "active";
                                } ?>"><a href="AddCategory.php?MID=2">Add Category</a></li>
                    <li class="<?php if ($MenuID == 3) {
                                    echo "active";
                                } ?>"><a href="AddProduct.php?MID=3">Add Product </a></li>
                    <li class="<?php if ($MenuID == 4) {
                                    echo "active";
                                } ?>"><a href="AddSupplier.php?MID=4">Add Supplier </a>
                    </li>
                    <li class="<?php if ($MenuID == 18) {
                                    echo "active";
                                } ?>"><a href="AddPaitent.php?MID=18">Add Patient </a>
                    </li>

                    <li class="<?php if ($MenuID == 45) {
                                    echo "active";
                                } ?>"><a href="AddCourier.php?MID=45">Add Courier </a>
                    </li>

                    <li class="<?php if ($MenuID == 28) {
                                    echo "active";
                                } ?>"><a href="AddEnquiredFor.php?MID=28">Add Enquiry </a>
                    </li>
                    <li class="<?php if ($MenuID == 29) {
                                    echo "active";
                                } ?>"><a href="AddEnquiryType.php?MID=29">Add Enquiry Type
                        </a></li>
                    <li class="<?php if ($MenuID == 30) {
                                    echo "active";
                                } ?>"><a href="AddReferedBy.php?MID=30">Add Enquiry
                            Reference </a></li>


                </ul>
            </li>
        <?php
        } else if ($userid == 24 || $userid == 28) { ?>
            <li class="has-sub <?php if ($MenuID == 2 || $MenuID == 3 || $MenuID == 4 || $MenuID == 17  || $MenuID == 18  || $MenuID == 28  || $MenuID == 29  || $MenuID == 30   || $MenuID == 38   || $MenuID == 39   || $MenuID == 45) {
                                    echo "active";
                                } ?>">
                <a href="javascript:;">
                    <i class="fa fa-sitemap"></i>
                    <span>Master</span>
                </a>


                <ul class="sub-menu">
                    <li class="<?php if ($MenuID == 3) {
                                    echo "active";
                                } ?>"><a href="AddProduct.php?MID=3">Add Product </a></li>

                </ul>
            </li>
        <?php }


        if ($GroupID == '1') {
        ?>
            <li class="has-sub <?php if ($MenuID == 5 || $MenuID == 6 || $MenuID == 19 || $MenuID == 16) {
                                    echo "active";
                                } ?>">
                <a href="javascript:;">
                    <i class="fa fa-inr"></i>
                    <span>Purchase</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php if ($MenuID == 5) {
                                    echo "active";
                                } ?>"><a href="PurchaseEntry.php?MID=5">Purchase Entry</a>
                    </li>
                    <li class="<?php if ($MenuID == 16) {
                                    echo "active";
                                } ?>"><a href="PurchaseReturn.php?MID=16">Purchase
                            Return</a></li>
                    <li class="<?php if ($MenuID == 6) {
                                    echo "active";
                                } ?>"><a href="PurchaseRegister.php?MID=6">Purchase
                            Register</a></li>
                    <li class="<?php if ($MenuID == 19) {
                                    echo "active";
                                } ?>"><a href="PurchaseReturnRegister.php?MID=19">Purchase
                            Return Register</a></li>
                </ul>
            </li>
        <?php
        } else {
        ?>



        <?php
        }

        if ($LocationCode == '0' || $LocationCode == '1' || $LocationCode == '2' || $LocationCode == '3') {
        ?>
            <li class="has-sub <?php if ($MenuID == 24 || $MenuID == 43 || $MenuID == 33) {
                                    echo "active";
                                } ?>">
                <a href="javascript:;">
                    <i class="fa fa-user"></i>
                    <span>Paitent</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php if ($MenuID == 24) {
                                    echo "active";
                                } ?>"><a href="PaitentPreorder.php?MID=24">Paitent Pre
                            Order</a></li>
                    <li class="<?php if ($MenuID == 43) {
                                    echo "active";
                                } ?>"><a href="CustomerPreOrderList.php?MID=43">Paitent
                            Pre Order List</a></li>
            </li>

</ul>
</li>
<?php
        } else {
?>
<?php
        }

        if ($LocationCode == '0' || $LocationCode == '1') {
?>
    <li class="has-sub <?php if ($MenuID == 35 || $MenuID == 48) {
                            echo "active";
                        } ?>">
        <a href="javascript:;">
            <i class="fa fa-cubes"></i>
            <span>Supplier</span>
        </a>
        <ul class="sub-menu">
            <li class="<?php if ($MenuID == 35) {
                            echo "active";
                        } ?>"><a href="SupplierPreOrder.php?MID=35">Supplier Pre
                    Order</a></li>

            <li class="<?php if ($MenuID == 48) {
                            echo "active";
                        } ?>"><a href="SupplierPreOrderList.php?MID=48">Supplier Pre
                    List</a></li>

        </ul>
    </li>
<?php
        } else {
?>
<?php
        }

?>

<li class="has-sub <?php if ($MenuID == 7 || $MenuID == 46 || $MenuID == 50 || $MenuID == 52 || $MenuID == 53 || $MenuID == 54  || $MenuID == 65) {
                        echo "active";
                    } ?>">
    <a href="javascript:;">
        <i class="fa fa-dropbox"></i>
        <span>Stock</span>
    </a>
    <ul class="sub-menu">
        <?php
        if ($GroupID == '1') {
        ?>
            <li class="<?php if ($MenuID == 7) {
                            echo "active";
                        } ?>"><a href="StockReportOverall.php?MID=7">Stock Report</a>
            </li>
            <li class="<?php if ($MenuID == 46) {
                            echo "active";
                        } ?>"><a href="BarcodeHistory.php?MID=46">Barcode History</a>
            </li>
            <li class="<?php if ($MenuID == 65) {
                            echo "active";
                        } ?>"><a href="StockAdjustmentRegister.php?MID=65">Stock Adjustment Log</a>
            </li>

            <li class="<?php if ($MenuID == 50) {
                            echo "active";
                        } ?>"><a href="ProductLoss.php?MID=50">Product Loss Entry</a>
            </li>

            <li class="<?php if ($MenuID == 52) {
                            echo "active";
                        } ?>"><a href="StockTaking.php?MID=52">Stock Taking</a></li>
            <li class="<?php if ($MenuID == 53) {
                            echo "active";
                        } ?>"><a href="StockTakeClosing.php?MID=53">Stock Take
                    Closing</a></li>
            <li class="<?php if ($MenuID == 54) {
                            echo "active";
                        } ?>"><a href="StockTakeReport.php?MID=54">Stock Take
                    Report</a></li>



        <?php
        } else {
        ?>
            <li class="<?php if ($MenuID == 7) {
                            echo "active";
                        } ?>"><a href="StockReport.php?MID=7">Stock Report</a></li>
            <li class="<?php if ($MenuID == 46) {
                            echo "active";
                        } ?>"><a href="BarcodeHistory.php?MID=46">Barcode History</a>
            </li>

            <li class="<?php if ($MenuID == 65) {
                            echo "active";
                        } ?>"><a href="StockAdjustmentRegister.php?MID=65">Stock Adjustment Log</a>
            </li>

            <li class="<?php if ($MenuID == 52) {
                            echo "active";
                        } ?>"><a href="StockTaking.php?MID=52">Stock Taking</a></li>
            <li class="<?php if ($MenuID == 53) {
                            echo "active";
                        } ?>"><a href="StockTakeClosing.php?MID=53">Stock Take
                    Closing</a></li>
        <?php
        }
        ?>

    </ul>
</li>

<li class="has-sub <?php if (
                        $MenuID == 8 || $MenuID == 21 || $MenuID == 9 || $MenuID == 25  ||
                        $MenuID == 22 || $MenuID == 51 || $MenuID == 58  || $MenuID == 61 || $MenuID == 62 || $MenuID == 63
                    ) {
                        echo "active";
                    } ?>">
    <a href="javascript:;">
        <i class="fa fa-shopping-cart"></i>
        <span>Sales</span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($MenuID == 62) {
                        echo "active";
                    } ?>"><a href="Billing.php?MID=62">Billing Seperate
                Delivery</a></li>




        <li class="<?php if ($MenuID == 51) {
                        echo "active";
                    } ?>"><a href="OpenBilling.php?MID=51">Open Bill</a></li>

        <li class="<?php if ($MenuID == 61) {
                        echo "active";
                    } ?>"><a href="DeliveryManagement.php?MID=61">Delivery</a>
        <li class="<?php if ($MenuID == 63) {
                        echo "active";
                    } ?>"><a href="DeliveryModificationLog.php?MID=63">Delivery
                Modification Log</a></li>

</li>

<?php
        if ($GroupID == '1') {
?>
    <li class="<?php if ($MenuID == 8) {
                    echo "active";
                } ?>"><a href="BillingBarcode.php?MID=8">Billing</a></li>
    <li hidden class="<?php if ($MenuID == 21) {
                            echo "active";
                        } ?>"><a href="FreeBilling.php?MID=21">Free Bill</a>
    </li>
<?php
        }

?>

<li class="<?php if ($MenuID == 51) {
                echo "active";
            } ?>"><a href="BillingEstimate.php?MID=58">Estimate </a></li>



<li hidden class="<?php if ($MenuID == 22) {
                        echo "active";
                    } ?>"><a href="CourierBilling.php?MID=22">Courier
        Bill</a></li>

<li class="<?php if ($MenuID == 26) {
                echo "active";
            } ?>"><a href="BillSearch.php?MID=26">Bill Search</a></li>

<li class="<?php if ($MenuID == 9) {
                echo "active";
            } ?>"><a href="OutstandingRegister.php?MID=9">Outstanding
        Details</a></li>
<li class="<?php if ($MenuID == 25) {
                echo "active";
            } ?>"><a href="LiabilityRegister.php?MID=25">Liability
        Details</a></li>


</ul>
</li>

<li class="has-sub <?php if ($MenuID == 10  || $MenuID == 11  || $MenuID == 20 || $MenuID == 23 ||  $MenuID == 44 ||  $MenuID == 64) {
                        echo "active";
                    } ?>">
    <a href="javascript:;">
        <i class="fa fa-table"></i>
        <span>Reports</span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($MenuID == 11) {
                        echo "active";
                    } ?>"><a href="OutstandingReceiptRegister.php?MID=11">Outstanding Collection Report </a></li>

        <li class="<?php if ($MenuID == 10) {
                        echo "active";
                    } ?>"><a href="SalesRegister.php?MID=10">Sales Report</a></li>
        <li class="<?php if ($MenuID == 20) {
                        echo "active";
                    } ?>"><a href="SalesReturnRegister.php?MID=20">Sales Return
        <li class="<?php if ($MenuID == 64) {
                        echo "active";
                    } ?>"><a href="EstimateRegister.php?MID=64">Estimate Report


                Report</a></li>

        <?php if ($GroupID == '1') { ?>
            <li class="<?php if ($MenuID == 23) {
                            echo "active";
                        } ?>"><a href="DoctorSalesRegister.php?MID=23">Doctor
                    Analysis Report</a></li>
        <?php } ?>


        <li class="<?php if ($MenuID == 34) {
                        echo "active";
                    } ?>"><a href="CourierRegister.php?MID=34">Courier
                Statement</a></li>
        <li class="<?php if ($MenuID == 44) {
                        echo "active";
                    } ?>"><a href="PaitentTransaction.php?MID=44">Paitent
                Transaction</a></li>
        <li class="<?php if ($MenuID == 47) {
                        echo "active";
                    } ?>"><a href="CancelledBillRegister.php?MID=47">Cancell
                Register</a></li>

    </ul>
</li>

<li class="has-sub <?php if ($MenuID == 12 || $MenuID == 13 || $MenuID == 14 || $MenuID == 15) {
                        echo "active";
                    } ?>">
    <a href="javascript:;">
        <i class="fa fa-truck"></i>
        <span>Stock Transfer</span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($MenuID == 12) {
                        echo "active";
                    } ?>"><a href="STI.php?MID=12">Transfer IN</a></li>
        <li class="<?php if ($MenuID == 13) {
                        echo "active";
                    } ?>"><a href="STIRegister.php?MID=13">Transfer IN
                Register</a></li>
        <li class="<?php if ($MenuID == 14) {
                        echo "active";
                    } ?>"><a href="STO.php?MID=14">Transfer OUT</a></li>
        <li class="<?php if ($MenuID == 15) {
                        echo "active";
                    } ?>"><a href="STORegister.php?MID=15">Transfer OUT
                Register</a></li>


    </ul>
</li>



<?php
        if ($GroupID == '1') {
?>

    <li class="has-sub <?php if ($MenuID == 27 || $MenuID == 59 || $MenuID == 60) {
                            echo "active";
                        } ?>">
        <a href="javascript:;">
            <i class="fa fa-bullhorn"></i>
            <span>Communication</span>
        </a>
        <ul class="sub-menu">
            <li class="<?php if ($MenuID == 27) {
                            echo "active";
                        } ?>"><a href="BulkSMS.php?MID=27">Bulk SMS</a></li>

            <li class="<?php if ($MenuID == 59) {
                            echo "active";
                        } ?>"><a href="BulkEmail.php?MID=59">Add Bulk Email</a></li>

            <li class="<?php if ($MenuID == 60) {
                            echo "active";
                        } ?>"><a href="BulkEmailList.php?MID=60">Send Bulk Email</a>
            </li>
        </ul>

    </li>
<?php
        }
    }
?>




<!-- begin sidebar minify button -->
<li>
    <a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify">
        <i class="fa fa-angle-double-left"></i>
    </a>
</li>
<!-- end sidebar minify button -->
</ul>