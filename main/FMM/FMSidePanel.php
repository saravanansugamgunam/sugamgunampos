<title>Sugamgunam - Finance</title>
<?php


// Max Menu ID = 33;

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

    <?php if ($GroupID == 1) {
    ?>
    <li class="has-sub <?php if ($MenuID == 2 || $MenuID == 3   || $MenuID == 28) {
                                echo "active";
                            } ?>">
        <a href="javascript:;">
            <i class="fa fa-sitemap"></i>
            <span>Master</span>
        </a>


        <ul class="sub-menu">

            <li class="<?php if ($MenuID == 2) {
                                echo "active";
                            } ?>"><a href="AddCategory.php?MID=2">Add
                    Category(Accounts) </a></li>
            <li class="<?php if ($MenuID == 3) {
                                echo "active";
                            } ?>"><a href="AddLedger.php?MID=3">Add Ledger </a></li>
            <li class="<?php if ($MenuID == 28) {
                                echo "active";
                            } ?>"><a href="AddPaymentMode.php?MID=28">Add Paymentmode
                </a></li>

        </ul>
    </li>


    <li class="has-sub <?php if (
                                $MenuID == 5 || $MenuID == 6  || $MenuID == 7  || $MenuID == 29 ||
                                $MenuID == 25 || $MenuID == 26 || $MenuID == 27 || $MenuID == 30 || $MenuID == 31 || $MenuID == 32 || $MenuID == 33
                            ) {
                                echo "active";
                            } ?>">
        <a href="javascript:;">
            <i class="fa fa-inr"></i>
            <span>Accounting</span>
        </a>
        <ul class="sub-menu">
            <li class="<?php if ($MenuID == 29) {
                                echo "active";
                            } ?>"><a href="AdvanceEntry.php?MID=29">Advance
                    Payment</a></li>
            <li class="<?php if ($MenuID == 30) {
                                echo "active";
                            } ?>"><a href="AdvanceReport.php?MID=30">Advance
                    Report</a></li>
            <li class="<?php if ($MenuID == 31) {
                                echo "active";
                            } ?>"><a href="DoctorShare.php?MID=31">Doctor Share</a>
            </li>
            <li class="<?php if ($MenuID == 32) {
                                echo "active";
                            } ?>"><a href="SalaryIssue.php?MID=32">Pay Salary</a></li>


            <li class="<?php if ($MenuID == 5) {
                                echo "active";
                            } ?>"><a href="IncomeExpenseEntry.php?MID=5">Income &
                    Expense Entry</a></li>

            <li class="<?php if ($MenuID == 6) {
                                echo "active";
                            } ?>"><a href="BalanceSheet.php?MID=6">Balance Sheet</a>
            </li>


            <li class="<?php if ($MenuID == 34) {
                                echo "active";
                            } ?>"><a href="CashSettlement_med.php?MID=34">Cash
                    Settlement - Medicine</a></li>
            <li class="<?php if ($MenuID == 35) {
                                echo "active";
                            } ?>"><a href="CashSettlement_the.php?MID=35">Cash
                    Settlement - Consulting & Therapy</a></li>




            <li class="<?php if ($MenuID == 25) {
                                echo "active";
                            } ?>"><a href="DayClosing.php?MID=25">Day Closing
                    (Cash)</a></li>
            <li class="<?php if ($MenuID == 26) {
                                echo "active";
                            } ?>"><a href="DayClosingOthers.php?MID=26">Day Closing
                    (Others)</a></li>

            <li class="<?php if ($MenuID == 7) {
                                echo "active";
                            } ?>"><a href="SupplierPaymentRegister.php?MID=7">Supplier
                    Payment Register</a></li>
            <li class="<?php if ($MenuID == 27) {
                                echo "active";
                            } ?>"><a href="SupplierOutstanding.php?MID=27">Supplier
                    Outstanding</a></li>


        </ul>
    </li>




    <?php
    } else {
    ?>

    <li class="has-sub <?php if ($MenuID == 2 || $MenuID == 3) {
                                echo "active";
                            } ?>">
        <a href="javascript:;">
            <i class="fa fa-sitemap"></i>
            <span>Master</span>
        </a>

        <ul class="sub-menu">

            <li class="<?php if ($MenuID == 2) {
                                echo "active";
                            } ?>"><a href="AddCategory.php?MID=2">Add
                    Category(Accounts) </a></li>
            <li class="<?php if ($MenuID == 3) {
                                echo "active";
                            } ?>"><a href="AddLedger.php?MID=3">Add Ledger </a></li>

        </ul>
    </li>

    <!-- <li class="has-sub <?php if ($MenuID == 5) {
                                    echo "active";
                                } ?>">
              <a href="javascript:;">
              <i class="fa fa-inr"></i>
              <span>Accounting</span>
              </a>
			  <ul class="sub-menu">
							<li class="<?php if ($MenuID == 5) {
                                            echo "active";
                                        } ?>"><a href="IncomeExpenseEntry.php?MID=5">Income & Expense Entry</a></li>
						 
				</ul>
            </li> -->


    <?php
    }

    if ($GroupID == 2) {
    ?>
    <li class="has-sub <?php if (
                                $MenuID == 5 || $MenuID == 6  || $MenuID == 7  || $MenuID == 25 ||
                                $MenuID == 26 || $MenuID == 27  || $MenuID == 29 || $MenuID == 30  || $MenuID == 33
                            ) {
                                echo "active";
                            } ?>">
        <a href="javascript:;">
            <i class="fa fa-inr"></i>
            <span>Accounting</span>
        </a>
        <ul class="sub-menu">


            <li class="<?php if ($MenuID == 5) {
                                echo "active";
                            } ?>"><a href="IncomeExpenseEntry.php?MID=5">Income &
                    Expense Entry</a></li>

            <li class="<?php if ($MenuID == 6) {
                                echo "active";
                            } ?>"><a href="BalanceSheet.php?MID=6">Balance Sheet</a>
            </li>
           
           
            <li class="<?php if ($MenuID == 34) {
                                echo "active";
                            } ?>"><a href="CashSettlement_med.php?MID=34">Cash
                    Settlement - Medicine</a></li>
            <li class="<?php if ($MenuID == 35) {
                                echo "active";
                            } ?>"><a href="CashSettlement_the.php?MID=35">Cash
                    Settlement - Consulting & Therapy</a></li>



            <li class="<?php if ($MenuID == 25) {
                                echo "active";
                            } ?>"><a href="DayClosing.php?MID=25">Day Closing
                    (Cash)</a></li>
            <li class="<?php if ($MenuID == 26) {
                                echo "active";
                            } ?>"><a href="DayClosingOthers.php?MID=26">Day Closing
                    (Others)</a></li>




        </ul>
    </li>
    <?php
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