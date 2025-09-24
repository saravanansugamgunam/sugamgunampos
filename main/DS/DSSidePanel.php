<title>Sugamgunam - Diagnosis</title>
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
    <li class="has-sub <?php if ($MenuID == 2 || $MenuID == 34) {
                                echo "active";
                            } ?>">
        <a href="javascript:;">
            <i class="fa fa-sitemap"></i>
            <span>Master</span>
        </a>


        <ul class="sub-menu">

            <li class="<?php if ($MenuID == 2) {
                                echo "active";
                            } ?>"><a href="AddDiagnosis.php?MID=2">Add Diagnosis </a></li>
            <li class="<?php if ($MenuID == 34) {
                                echo "active";
                            } ?>"><a href="AddDiagnosticCenter.php?MID=34">Add Diagnostic Center
                </a></li>

        </ul>
    </li>


    <li class="has-sub <?php if (
                                $MenuID == 5 || $MenuID == 6  || $MenuID == 7  || $MenuID == 29 ||
                                $MenuID == 25 || $MenuID == 26 || $MenuID == 27 || $MenuID == 30 || $MenuID == 31 || $MenuID == 32 || $MenuID == 33
                                || $MenuID == 45  || $MenuID == 46 || $MenuID == 35
                            ) {
                                echo "active";
                            } ?>">
        <a href="javascript:;">
            <i class="fa fa-tint"></i>
            <span>Diagnosis</span>
        </a>
        <ul class="sub-menu">
            
              <li class="<?php if ($MenuID == 45) {
                                echo "active";
                            } ?>"><a href="https://sugamgunam.com/pos/ThyroidCamp.php">Thyroid Free Camp</a></li>


              <li class="<?php if ($MenuID == 46) {
                                echo "active";
                            } ?>"><a href="https://sugamgunam.com/pos/main/CLM/CampBooking.php">Thyroid Camp Register</a></li>


            <li class="<?php if ($MenuID == 5) {
                                echo "active";
                            } ?>"><a href="DiagnosisEntry.php?MID=5">Diagnosis Entry</a></li>

            <li class="<?php if ($MenuID == 7) {
                                echo "active";
                            } ?>"><a href="DiagnosisCollection.php?MID=7">Diagnosis Report</a>
            </li>

            <li class="<?php if ($MenuID == 25) {
                                echo "active";
                            } ?>"><a href="DiagnosticCenterShare.php?MID=25">Diagnosis Center Share</a>
            </li>
            
              <li class="<?php if ($MenuID == 34) {
                                echo "active";
                            } ?>"><a href="DiagnosisReconcileation.php?MID=35">Diagnosis Reconcileation Register</a>
            </li>





        </ul>
    </li>

    <?php
    } else {
    ?>

    <li class="has-sub <?php if ($MenuID == 2) {
                                echo "active";
                            } ?>">
        <a href="javascript:;">
            <i class="fa fa-sitemap"></i>
            <span>Master</span>
        </a>


        <ul class="sub-menu">

            <li class="<?php if ($MenuID == 2) {
                                echo "active";
                            } ?>"><a href="AddDiagnosis.php?MID=2">Add Diagnosis </a></li>

        </ul>
    </li>


    <li class="has-sub <?php if (
                                $MenuID == 5 || $MenuID == 6  || $MenuID == 7  || $MenuID == 29 ||
                                $MenuID == 25 || $MenuID == 26 || $MenuID == 27 || $MenuID == 30 || $MenuID == 31 || $MenuID == 32 || $MenuID == 33
                                || $MenuID == 45 || $MenuID == 35
                            ) {
                                echo "active";
                            } ?>">
        <a href="javascript:;">
            <i class="fa fa-tint"></i>
            <span>Diagnosis</span>
        </a>
        <ul class="sub-menu">
                 <li class="<?php if ($MenuID == 45) {
                                echo "active";
                            } ?>"><a href="https://sugamgunam.com/pos/ThyroidCamp.php">Thyroid Free Camp</a></li>
                            
                            
              <li class="<?php if ($MenuID == 46) {
                                echo "active";
                            } ?>"><a href="https://sugamgunam.com/pos/main/CLM/CampBooking.php">Thyroid Camp Register</a></li>



            <li class="<?php if ($MenuID == 5) {
                                echo "active";
                            } ?>"><a href="DiagnosisEntry.php?MID=5">Diagnosis Entry</a></li>

            <li class="<?php if ($MenuID == 7) {
                                echo "active";
                            } ?>"><a href="DiagnosisCollection.php?MID=7">Diagnosis Report</a>
            </li>
            
              <li class="<?php if ($MenuID == 34) {
                                echo "active";
                            } ?>"><a href="DiagnosisReconcileation.php?MID=35">Diagnosis Reconcileation Register</a>
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