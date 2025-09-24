<title>Sugamgunam - Therapy</title>
<?php


// Max Menu ID = 67;

$GroupID = $_SESSION['SESS_GROUP_ID'];
$MenuID = $_GET['MID'];
?>
<ul class="nav">
    <li class="has-sub <?php if ($MenuID == 1) {
                            echo "active";
                        } ?>">
        <a href="index.php?MID=1">
            <i class="fa fa-dashboard"></i>
            <span>Home</span>
        </a>

    </li>



    <?php if ($GroupID == 1) {
    ?>

    <li class="has-sub <?php if ($MenuID == 2 || $MenuID == 3 || $MenuID == 4 || $MenuID == 5 || $MenuID == 25) {
                                echo "active";
                            } ?>">
        <a href="javascript:;">
            <i class="fa fa-sitemap"></i>
            <span>Master</span>
        </a>


        <ul class="sub-menu">


            <li class="<?php if ($MenuID == 25) {
                                echo "active";
                            } ?>"><a href="AddConsultationType.php?MID=25">Add
                    Therapy Type </a></li>

        </ul>
    </li>


    <li class="has-sub <?php if ($MenuID == 30   || $MenuID == 56  || $MenuID == 57 
      || $MenuID == 61 || $MenuID == 64 || $MenuID == 68) {
                                echo "active";
                            } ?>">
        <a href="javascript:;">
            <i class="fa fa-leaf"></i>
            <span>Therapy Management</span>
        </a>
        <ul class="sub-menu">

            <li class="<?php if ($MenuID == 57) {
                                echo "active";
                            } ?>"><a href="DoctorTimeAllocation.php?MID=57">Time
                    Allocation</a></li>

            <li class="<?php if ($MenuID == 67) {
                                echo "active";
                            } ?>"><a href="TherapyTherapistMapping.php?MID=67">Therapist Mapping
                </a></li>


            <li class="<?php if ($MenuID == 30) {
                                echo "active";
                            } ?>"><a href="TherapyBookingPaitentDetails.php?MID=30">Therapy
                    Booking</a></li>
                    
                      <li class="<?php if ($MenuID == 68) {
                                echo "active";
                            } ?>"><a href="Therapy_autolist.php?MID=68">Therapy
                    Recomendation</a></li>


        </ul>
    </li>



    <li class="has-sub <?php if (
                                $MenuID == 60 ||  $MenuID == 52  || $MenuID == 62  || $MenuID == 63
                                || $MenuID == 64 || $MenuID == 65 || $MenuID == 66  
                            ) {
                                echo "active";
                            } ?>">
        <a href="javascript:;">
            <i class="fa fa-table"></i>
            <span>Reports</span>
        </a>
        <ul class="sub-menu">
            <li class="<?php if ($MenuID == 62) {
                                echo "active";
                            } ?>"><a href="CalendarView.php?MID=62&sts=P&emp=0">Calendar View</a></li>


            <li class="<?php if ($MenuID == 60) {
                                echo "active";
                            } ?>"><a href="TherapyPaymentRegister.php?MID=60">Therapy Payment
                    Register</a></li>

            <li class="<?php if ($MenuID == 64) {
                                echo "active";
                            } ?>"><a href="TherapyRescheduleRegister.php?MID=64">Therapy
                    Reschedule Register</a></li>


            <li class="<?php if ($MenuID == 63) {
                                echo "active";
                            } ?>"><a href="TherapyRegister.php?MID=63">Therapist List</a></li>

            <li class="<?php if ($MenuID == 66) {
                                echo "active";
                            } ?>"><a href="TherapyCallList.php?MID=66">Therapist Call List</a></li>


            <li class="<?php if ($MenuID == 65) {
                                echo "active";
                            } ?>"><a href="TherapyRegister_performance.php?MID=65">Therapy Performance Report</a></li>



        </ul>
    </li>



    <?php
    } else {
    ?>




    <li class="has-sub <?php if (
                                $MenuID == 30
                                || $MenuID == 56   || $MenuID == 61  || $MenuID == 57  
                                || $MenuID == 30  || $MenuID == 67  || $MenuID == 68
                            ) {
                                echo "active";
                            } ?>">
        <a href="javascript:;">
            <i class="fa fa-leaf"></i>
            <span>Therapy Management</span>
        </a>
        <ul class="sub-menu">

            <li class="<?php if ($MenuID == 57) {
                                echo "active";
                            } ?>"><a href="DoctorTimeAllocation.php?MID=57">Time
                    Allocation</a></li>

            <li class="<?php if ($MenuID == 67) {
                                echo "active";
                            } ?>"><a href="TherapyTherapistMapping.php?MID=67">Therapist Mapping
                </a></li>

            <li class="<?php if ($MenuID == 30) {
                                echo "active";
                            } ?>"><a href="TherapyBookingPaitentDetails.php?MID=30">Therapy
                    Booking</a></li>
                    
                      <li class="<?php if ($MenuID == 68) {
                                echo "active";
                            } ?>"><a href="Therapy_autolist.php?MID=68">Therapy
                    Recomendation</a></li>

        </ul>
    </li>







    <li class="has-sub <?php if (
                                $MenuID == 60 ||  $MenuID == 52  || $MenuID == 62 || $MenuID == 63
                                || $MenuID == 64
                            ) {
                                echo "active";
                            } ?>">
        <a href="javascript:;">
            <i class="fa fa-table"></i>
            <span>Reports</span>
        </a>
        <ul class="sub-menu">
            <li class="<?php if ($MenuID == 62) {
                                echo "active";
                            } ?>"><a href="CalendarView.php?MID=62&sts=P&emp=0">Calendar View</a></li>


            <li class="<?php if ($MenuID == 60) {
                                echo "active";
                            } ?>"><a href="TherapyPaymentRegister.php?MID=60">Therapy Payment
                    Register</a></li>

            <li class="<?php if ($MenuID == 64) {
                                echo "active";
                            } ?>"><a href="TherapyRescheduleRegister.php?MID=64">Therapy
                    Reschedule Register</a></li>




            <li class="<?php if ($MenuID == 63) {
                                echo "active";
                            } ?>"><a href="TherapyRegister.php?MID=63">Therapy
                    List</a></li>


        </ul>
    </li>
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