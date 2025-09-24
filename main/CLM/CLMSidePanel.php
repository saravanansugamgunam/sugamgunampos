<title>Sugamgunam - Consulting</title>
<?php


// Max Menu ID = 64;

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



    <li class="has-sub <?php if ($MenuID == 43 || $MenuID == 55) {
                            echo "active";
                        } ?>">
        <a href="javascript:;">
            <i class="fa fa-table"></i>
            <span>Dashboard</span>
        </a>

        <ul class="sub-menu">

            <li class="<?php if ($MenuID == 43) {
                            echo "active";
                        } ?>"><a href="Dashboard.php?MID=43">Dashboard </a></li>


        </ul>

    </li>
    <?php if ($GroupID == 1) {
    ?>
        <li class="has-sub <?php if ($MenuID == 2 || $MenuID == 3 || $MenuID == 4 || $MenuID == 5 || $MenuID == 25  || $MenuID == 82 || $MenuID == 83) {
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
                        Consultation Type </a></li>
                        
                          <li class="<?php if ($MenuID == 82) {
                                echo "active";
                            } ?>"><a href="AddTag.php?MID=82">Add
                    Tag </a></li>

            <li class="<?php if ($MenuID == 83) {
                                echo "active";
                            } ?>"><a href="AddProfession.php?MID=83">Add
                    Profession </a></li>



            </ul>
        </li>






    <li class="has-sub <?php if (
                                $MenuID == 70 || $MenuID == 71 || $MenuID == 72 ||
                                $MenuID == 73  || $MenuID == 74 || $MenuID == 75 || $MenuID == 76 
                                || $MenuID == 77|| $MenuID == 78 || $MenuID == 79 || $MenuID == 100
                            ) {
                                echo "active";
                            } ?>">
        <a href="javascript:;">
            <i class="fa fa-shield"></i>
            <span>Disease Management</span>
        </a>
        <ul class="sub-menu">
            
              <li class="<?php if ($MenuID == 77) {
                                echo "active";
                            } ?>"><a href="AddMedicineConditon.php?MID=77">Med. Condition</a></li>


            <li class="<?php if ($MenuID == 78) {
                                echo "active";
                            } ?>"><a href="AddTherapyConditons.php?MID=78">Thy. Condition</a></li>


            <li class="<?php if ($MenuID == 79) {
                                echo "active";
                            } ?>"><a href="AddPrescriptionDuraition.php?MID=79">Prescription Duration</a></li>

<li class="<?php if ($MenuID == 100) {
                                echo "active";
                            } ?>"><a href="AddAlternateMedicine.php?MID=100">Manage Alternate Medicine</a></li>


   <li class="<?php if ($MenuID == 72) {
                                echo "active";
                            } ?>"><a href="AddDisease.php?MID=72">Disease Management</a>
            </li>
            
            <li class="<?php if ($MenuID == 70) {
                                echo "active";
                            } ?>"><a href="AddSymptoms.php?MID=70">Symptoms Management</a></li>

            <li class="<?php if ($MenuID == 71) {
                                echo "active";
                            } ?>"><a href="AddDiagnosis.php?MID=71">
                    Deficiency Management</a></li>
                    
                       <li class="<?php if ($MenuID == 76) {
                                echo "active";
                            } ?>"><a href="Addaccupoints.php?MID=76">Acu Points Management</a>
            </li>

           
            <li class="<?php if ($MenuID == 73) {
                                echo "active";
                            } ?>"><a href="AddPathology.php?MID=73">Pathology Management</a>
            </li>
            <li class="<?php if ($MenuID == 74) {
                                echo "active";
                            } ?>"><a href="DiseaseConceptList.php?MID=74">Diseas Concept Mapping</a>
            </li>


        </ul>
    </li>






        <li class="has-sub <?php if (
                                $MenuID == 6 || $MenuID == 7 || $MenuID == 8 || $MenuID == 26
                                || $MenuID == 31 || $MenuID == 51 || $MenuID == 54 || $MenuID == 60  || $MenuID == 63  || $MenuID == 62   || $MenuID == 64  || $MenuID == 65 
                                || $MenuID == 67
                            ) {
                                echo "active";
                            } ?>">
            <a href="javascript:;">
                <i class="fa fa-wheelchair"></i>
                <span>Consultation Entry</span>
            </a>
            <ul class="sub-menu">
                <li class="<?php if ($MenuID == 26) {
                                echo "active";
                            } ?>"><a href="BillingNew.php?MID=26">Consultation Bill - Today</a>
                </li>

                <li class="<?php if ($MenuID == 62) {
                                echo "active";
                            } ?>"><a href="BillingPostDate.php?MID=62">Consultation Bill - Post Date</a>
                </li>

                <li class="<?php if ($MenuID == 63) {
                                echo "active";
                            } ?>"><a href="ConsultationRegisterNonClosed.php?MID=63">Reschedule Consulting</a>
                </li>


                <li class="<?php if ($MenuID == 51) {
                                echo "active";
                            } ?>"><a href="OpenBilling.php?MID=51">Open Bill</a></li>

                <li class="<?php if ($MenuID == 60) {
                                echo "active";
                            } ?>"><a href="OnlineConsultingSetting.php?MID=60">Online Consultation Setup</a></li>


                <li class="<?php if ($MenuID == 31) {
                                echo "active";
                            } ?>"><a href="TokenDetails.php?MID=31">Today's Token</a>
                </li>
                
                 
                
          <li class="<?php if ($MenuID == 64) {
                    echo "active";
                } ?>"><a href="CasesheetAnalysis.php?MID=64">Case Sheet Analysis</a>
            </li>
  <li class="<?php if ($MenuID == 67) {
                    echo "active";
                } ?>"><a href="ReviewStatus.php?MID=67">Patient Review Report</a>
            </li>




                <li class="<?php if ($MenuID == 54) {
                                echo "active";
                            } ?>"><a href="RefundRegister.php?MID=54">Refund
                        Register</a></li>
                <li hidden class="<?php if ($MenuID == 8) {
                                        echo "active";
                                    } ?>"><a href="PaitentHistory.php?MID=8">Paitient
                        History</a></li>
            </ul>
        </li>






        <li class="has-sub <?php if (
                                $MenuID == 27 || $MenuID == 29 || $MenuID == 52 ||
                                $MenuID == 58  || $MenuID == 59 || $MenuID == 61 || $MenuID == 101
                            ) {
                                echo "active";
                            } ?>">
            <a href="javascript:;">
                <i class="fa fa-table"></i>
                <span>Reports</span>
            </a>
            <ul class="sub-menu">

                <li class="<?php if ($MenuID == 27) {
                                echo "active";
                            } ?>"><a href="SalesRegister.php?MID=27">Consultation
                        Report</a></li>

                <li class="<?php if ($MenuID == 59) {
                                echo "active";
                            } ?>"><a href="OnlineBookingRegister.php?MID=59">
                        Online Registration</a></li>

                <li class="<?php if ($MenuID == 52) {
                                echo "active";
                            } ?>"><a href="PaitentSearch.php?MID=52">Bill Search</a>
                </li>
                <li class="<?php if ($MenuID == 58) {
                                echo "active";
                            } ?>"><a href="PaitentSearchDiscount.php?MID=57">Discount Paitents</a>
                </li>
                <li class="<?php if ($MenuID == 61) {
                                echo "active";
                            } ?>"><a href="CalendarView.php?MID=61">Appointment Calendar</a>
                </li>
                <li class="<?php if ($MenuID == 101) {
                                echo "active";
                            } ?>"><a href="SpecialMedicineList.php?MID=101">Special Medicine List</a>
                </li>

                <li class="<?php if ($MenuID == 29) {
                                echo "active";
                            } ?>"><a href="CancelledBillRegister.php?MID=29">Cancelled
                        Report</a></li>
                           
            

            </ul>
        </li>





        <li class="has-sub <?php if ($MenuID == 44 || $MenuID == 45 || $MenuID == 46) {
                                echo "active";
                            } ?>">
            <a href="javascript:;">
                <i class="fa fa-cogs"></i>
                <span>Room Settings</span>
            </a>
            <ul class="sub-menu">
                <li class="<?php if ($MenuID == 44) {
                                echo "active";
                            } ?>"><a href="RoomSetting.php?MID=44">Room Settings</a>
                </li>
              

            </ul>
        </li>
        
         <li class="has-sub <?php if ($MenuID == 80 || $MenuID == 81) {
                                echo "active";
                            } ?>">
            <a href="javascript:;">
                <i class="fa fa-cogs"></i>
                <span>Free Camp</span>
            </a>
            <ul class="sub-menu">
                <li class="<?php if ($MenuID == 80) {
                                echo "active";
                            } ?>"><a href="https://sugamgunam.com/pos/ThyroidCamp.php?MID=80" target=”_blank”>Free Camp Entry</a>
                </li>
                <li class="<?php if ($MenuID ==81) {
                                echo "active";
                            } ?>"><a href="CampBooking.php?MID=81">Camp Booking Register</a>
                </li>
             

            </ul>
        </li>

    <?php
    }
    
    else if ($GroupID == 3) {
    ?>
        <li class="has-sub <?php if ($MenuID == 2 || $MenuID == 3 || $MenuID == 4 || $MenuID == 5 || $MenuID == 25) {
                                echo "active";
                            } ?>">
            <a href="javascript:;">
                <i class="fa fa-sitemap"></i>
                <span>Master</span>
            </a>
 
        </li>


        <li class="has-sub <?php if (
                                $MenuID == 6 || $MenuID == 7 || $MenuID == 8 || $MenuID == 26
                                || $MenuID == 31 || $MenuID == 51 || $MenuID == 54 || $MenuID == 60  || $MenuID == 63  || $MenuID == 62 || $MenuID == 65
                            ) {
                                echo "active";
                            } ?>">
            <a href="javascript:;">
                <i class="fa fa-wheelchair"></i>
                <span>Consultation Entry</span>
            </a>
            <ul class="sub-menu">
                <li class="<?php if ($MenuID == 26) {
                                echo "active";
                            } ?>"><a href="BillingNew.php?MID=26">Consultation Bill - Today</a>
                </li>

                <li class="<?php if ($MenuID == 62) {
                                echo "active";
                            } ?>"><a href="BillingPostDate.php?MID=62">Consultation Bill - Post Date</a>
                </li>
                  <li class="<?php if ($MenuID == 51) {
                                echo "active";
                            } ?>"><a href="OpenBilling.php?MID=51">Open Bill</a></li>


                <li class="<?php if ($MenuID == 63) {
                                echo "active";
                            } ?>"><a href="ConsultationRegisterNonClosed.php?MID=63">Reschedule Consulting</a>
                </li>


            
                

                <li class="<?php if ($MenuID == 31) {
                                echo "active";
                            } ?>"><a href="TokenDetails.php?MID=31">Today's Token</a>
                </li>
                 
                <li hidden class="<?php if ($MenuID == 8) {
                                        echo "active";
                                    } ?>"><a href="PaitentHistory.php?MID=8">Paitient
                        History</a></li>
            </ul>
        </li>






        <li class="has-sub <?php if (
                                $MenuID == 27 || $MenuID == 29 || $MenuID == 52 ||
                                $MenuID == 58  || $MenuID == 59 || $MenuID == 61 || $MenuID == 101
                            ) {
                                echo "active";
                            } ?>">
            <a href="javascript:;">
                <i class="fa fa-table"></i>
                <span>Reports</span>
            </a>
            <ul class="sub-menu">

                <li class="<?php if ($MenuID == 27) {
                                echo "active";
                            } ?>"><a href="SalesRegister.php?MID=27">Consultation
                        Report</a></li>

              

                <li class="<?php if ($MenuID == 52) {
                                echo "active";
                            } ?>"><a href="PaitentSearch.php?MID=52">Bill Search</a>
                </li>
              
                <li class="<?php if ($MenuID == 61) {
                                echo "active";
                            } ?>"><a href="CalendarView.php?MID=61">Appointment Calendar</a>
                </li>

                 
                <li class="<?php if ($MenuID == 101) {
                                echo "active";
                            } ?>"><a href="SpecialMedicineList.php?MID=101">Special Medicine List</a>
                </li>

            </ul>
        </li>
        
         <li class="has-sub <?php if ($MenuID == 80 || $MenuID == 81) {
                                echo "active";
                            } ?>">
            <a href="javascript:;">
                <i class="fa fa-cogs"></i>
                <span>Free Camp</span>
            </a>
            <ul class="sub-menu">
                <li class="<?php if ($MenuID == 80) {
                                echo "active";
                            } ?>"><a href="https://sugamgunam.com/pos/ThyroidCamp.php?MID=80" target=”_blank”>Free Camp Entry</a>
                </li>
                <li class="<?php if ($MenuID ==81) {
                                echo "active";
                            } ?>"><a href="CampBooking.php?MID=81">Camp Booking Register</a>
                </li>
             

            </ul>
        </li>



 

    <?php
    }
    
    else if($GroupID == 2) {
    ?>

        <li class="has-sub <?php if (
                                $MenuID == 26 || $MenuID == 31 || $MenuID == 54
                                || $MenuID == 8  || $MenuID == 60  || $MenuID == 62 || $MenuID == 63  || $MenuID == 64
                            ) {
                                echo "active";
                            } ?>">
            <a href="javascript:;">
                <i class="fa fa-wheelchair"></i>
                <span>Patient Entry</span>
            </a>
            <ul class="sub-menu">

                <li class="<?php if ($MenuID == 26) {
                                echo "active";
                            } ?>"><a href="BillingNew.php?MID=26">Consultation Bill - Today</a>
                </li>

                <li class="<?php if ($MenuID == 62) {
                                echo "active";
                            } ?>"><a href="BillingPostDate.php?MID=62">Consultation Bill - Post Date</a>
                </li>
                
                 <li class="<?php if ($MenuID == 51) {
                                echo "active";
                            } ?>"><a href="OpenBilling.php?MID=51">Open Bill</a></li>

                <li class="<?php if ($MenuID == 63) {
                                echo "active";
                            } ?>"><a href="ConsultationRegisterNonClosed.php?MID=63">Reschedule Consulting</a>
                </li>




                <li class="<?php if ($MenuID == 60) {
                                echo "active";
                            } ?>"><a href="OnlineConsultingSetting.php?MID=60">Online Consultation Setup</a></li>

                <li class="<?php if ($MenuID == 54) {
                                echo "active";
                            } ?>"><a href="RefundRegister.php?MID=54">Refund
                        Register</a></li>
                <li class="<?php if ($MenuID == 31) {
                                echo "active";
                            } ?>"><a href="TokenDetails.php?MID=31">Token List</a>
                </li>
                
                    <li class="<?php if ($MenuID == 64) {
                    echo "active";
                } ?>"><a href="CasesheetAnalysis.php?MID=64">Case Sheet Analysis</a>
            </li>

                <li hidden class="<?php if ($MenuID == 8) {
                                        echo "active";
                                    } ?>"><a href="PatientHistory.php?MID=8">Paitient
                        History</a></li>
                        
                        
            </ul>
        </li>







        <li class="has-sub <?php if ($MenuID == 27 || $MenuID == 52 || 
        $MenuID == 59 || $MenuID == 61 || $MenuID == 101) {
                                echo "active";
                            } ?>">
            <a href="javascript:;">
                <i class="fa fa-table"></i>
                <span>Reports</span>
            </a>
            <ul class="sub-menu">

                <li class="<?php if ($MenuID == 27) {
                                echo "active";
                            } ?>"><a href="SalesRegister.php?MID=27">Consultation
                        Report</a></li>
                <li class="<?php if ($MenuID == 59) {
                                echo "active";
                            } ?>">
                    <a href="OnlineBookingRegister.php?MID=59">
                        Online Registration</a>
                </li>
                <li class="<?php if ($MenuID == 52) {
                                echo "active";
                            } ?>"><a href="PaitentSearch.php?MID=52">Bill Search</a>
                </li>

                <li class="<?php if ($MenuID == 61) {
                                echo "active";
                            } ?>"><a href="CalendarView.php?MID=61">Appointment Calendar</a>
                </li>
                <li class="<?php if ($MenuID == 101) {
                                echo "active";
                            } ?>"><a href="SpecialMedicineList.php?MID=101">Special Medicine List</a>
                </li>

            </ul>
        </li>
        
          
         <li class="has-sub <?php if ($MenuID == 80 || $MenuID == 81) {
                                echo "active";
                            } ?>">
            <a href="javascript:;">
                <i class="fa fa-cogs"></i>
                <span>Free Camp</span>
            </a>
            <ul class="sub-menu">
                <li class="<?php if ($MenuID == 80) {
                                echo "active";
                            } ?>"><a href="https://sugamgunam.com/pos/ThyroidCamp.php?MID=80" target=”_blank”>Free Camp Entry</a>
                </li>
                <li class="<?php if ($MenuID ==81) {
                                echo "active";
                            } ?>"><a href="CampBooking.php?MID=81">Camp Booking Register</a>
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