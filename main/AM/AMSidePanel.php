<?php 


// Max Menu ID = 30;
    
 $GroupID = $_SESSION['SESS_GROUP_ID'];
$MenuID=$_GET['MID'];

$userid = $_SESSION['SESS_MEMBER_ID'];
?>
<ul class="nav">
    <li class="has-sub <?php if($MenuID==1) { echo "active"; } ?>">
        <a href="index.php?MID=1">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
        </a>

    </li>


    <li class="has-sub <?php if($MenuID==2  ) { echo "active"; } ?>">
        <a href="javascript:;">
            <i class="fa fa-sitemap"></i>
            <span>Master</span>
        </a>



    </li>


    <li class="has-sub <?php if($MenuID==3 || $MenuID==4 || $MenuID==27 || $MenuID==5 || 
    $MenuID==6 || $MenuID==15 || $MenuID==7 || $MenuID==9 || $MenuID==10 || $MenuID==30   || $MenuID==91 ) { echo "active"; } ?>">
        <a href="javascript:;">
            <i class="fa fa-users"></i>
            <span>HR</span>
        </a>
        <ul class="sub-menu">
            <li class="<?php if($MenuID==3) { echo "active"; } ?>"><a href="AddDesignation.php?MID=3">Add Designation
                </a></li>

            <?php  if ($userid == 22 || $userid == 13  || $userid == 30  || $userid == 67
              || $userid == 70  || $userid == 91)
              {?>
            <li class="<?php if($MenuID==4) { echo "active"; } ?>"><a href="AddStaff.php?MID=4">Staff Profile </a></li>

            <?php } ?>


            <li class="<?php if($MenuID==30) { echo "active"; } ?>"><a href="PermissionLog.php?MID=30">
                    Leave & Permission</a></li>



            <li class="<?php if($MenuID==27) { echo "active"; } ?>"><a href="MonthlyAttendance.php?MID=27">
                    Monthly Attendance</a></li>


            <li class="<?php if($MenuID==5) { echo "active"; } ?>"><a href="AttendanceRegister.php?MID=5">Attendance
                    Register</a></li>
            <li class="<?php if($MenuID==6) { echo "active"; } ?>"><a href="AttendanceLog.php?MID=6">Biometric Log</a>
            </li>
            <li class="<?php if($MenuID==15) { echo "active"; } ?>"><a href="Promotions.php?MID=15">Promotions</a>
            </li>




        </ul>
    </li>





    <li class="has-sub <?php if($MenuID==28 || $MenuID==29 ) { echo "active"; } ?>">
        <a href="javascript:;">
            <i class="fa fa-list"></i>
            <span>Performance Management</span>
        </a>


        <ul class="sub-menu">
            <li class="<?php if($MenuID==28) { echo "active"; } ?>"><a href="RoutineManagement.php?MID=28">
                    Routine Managemnt </a></li>

            <li class="<?php if($MenuID==29) { echo "active"; } ?>"><a href="SalePerformance.php?MID=29">
                    Sale Performance </a></li>
        </ul>

    </li>


    <li class="has-sub <?php if($MenuID==11 || $MenuID==12 ) { echo "active"; } ?>">
        <a href="javascript:;">
            <i class="fa fa-cogs"></i>
            <span>Configuration</span>
        </a>

    </li>




    <!-- begin sidebar minify button -->
    <li>
        <a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify">
            <i class="fa fa-angle-double-left"></i>
        </a>
    </li>
    <!-- end sidebar minify button -->
</ul>