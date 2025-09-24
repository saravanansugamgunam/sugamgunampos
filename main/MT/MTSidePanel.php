<title>Sugamgunam - Marketing</title>
<?php



$GroupID = $_SESSION['SESS_GROUP_ID'];
$MenuID = $_GET['MID'];
?>
<ul class="nav">
    <li class="has-sub <?php if ($MenuID == 1) {
                            echo "active";
                        } ?>">
        <a href="index.php?MID=1">
            <i class="fa fa-home"></i>
            <span>Home</span>
        </a>

    </li>

    <li class="has-sub <?php if (
                            $MenuID == 2 || $MenuID == 3
                        ) {
                            echo "active";
                        } ?>">
        <a href="javascript:;">
            <i class="fa fa-flag"></i>
            <span>Enquiry</span>
        </a>
        <ul class="sub-menu">

            <li class="<?php if ($MenuID == 3) {
                            echo "active";
                        } ?>"><a href="LeadManagement.php?MID=3">Lead Management</a>
            </li>


            <li class="<?php if ($MenuID == 3) {
                            echo "active";
                        } ?>"><a href="EventsBookingRegister.php?MID=3">Events Booking Register</a>
            </li>


        </ul>
    </li>


    <li class="has-sub <?php if ($MenuID == 5 || $MenuID == 6 || $MenuID == 7  ) {
                            echo "active";
                        } ?>">
        <a href="javascript:;">
            <i class="fa fa-users"></i>
            <span>Referal Management</span>
        </a>

        <ul class="sub-menu">
            <li class="<?php if ($MenuID == 5) {
                                    echo "active";
                                } ?>"><a href="ReferenceMaster.php?MID=5">Reference Master</a></li>
            <li class="<?php if ($MenuID == 6) {
                                    echo "active";
                                } ?>"><a href="ReferalPerformance.php?MID=6">Reference Performance</a></li>
            <li class="<?php if ($MenuID == 7) {
                                    echo "active";
                                } ?>"><a href="ReferalShare.php?MID=7">Reference Performance</a></li>



        </ul>

    </li>








    <!-- begin sidebar minify button -->
    <li>
        <a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify">
            <i class="fa fa-angle-double-left"></i>
        </a>
    </li>
    <!-- end sidebar minify button -->
</ul>