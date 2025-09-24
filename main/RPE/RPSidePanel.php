<?php


// Max Menu ID = 26;

$GroupID = $_SESSION['SESS_GROUP_ID'];
$MenuID = $_GET['MID'];
?>
<ul class="nav">


    <li class="has-sub <?php if ($MenuID == 1) {
                        echo "active";
                      } ?>">
        <a href="index.php?MID=1">
            <i class="fa fa-line-chart"></i>
            <span>Dashboard</span>
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