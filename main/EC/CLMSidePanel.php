<title>Sugamgunam - Ecommerce</title>
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


    <li class="has-sub <?php if (
                                $MenuID == 2 ||  $MenuID == 3  || $MenuID == 4 || $MenuID == 5
                                || $MenuID == 6
                            ) {
                                echo "active";
                            } ?>">
        <a href="javascript:;">
            <i class="fa fa-table"></i>
            <span>Reports</span>
        </a>
        <ul class="sub-menu">

            <li class="<?php if ($MenuID == 1) {
                                echo "active";
                            } ?>"><a href="OrderList.php?MID=1">Order List</a></li>

            <li class="<?php if ($MenuID == 2) {
                                echo "active";
                            } ?>"><a href="ProductList.php?MID=2">Product List</a></li>



        </ul>
    </li>
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