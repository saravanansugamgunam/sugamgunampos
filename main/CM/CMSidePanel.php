<?php 


// Max Menu ID = 18;
    
 $GroupID = $_SESSION['SESS_GROUP_ID'];
$MenuID=$_GET['MID'];
?>
 <ul class="nav">
 <li class="has-sub <?php if($MenuID==18) { echo "active"; } ?>">
              <a href="index.php?MID=18">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
			 
            </li> 
			<li class="has-sub <?php if($MenuID==1 || $MenuID==2 ) { echo "active"; } ?>">
			
              <a href="javascript:;">
              <i class="fa fa-sitemap"></i>
              <span>Course Management</span>
              </a>
			  <ul class="sub-menu">
					  <li class="<?php if($MenuID==1) { echo "active"; } ?>"><a href="AddCourse.php?MID=1">Add Course</a></li>
					  <li class="<?php if($MenuID==2) { echo "active"; } ?>"><a href="AddBatch.php?MID=2">Add Batch</a></li> 
						</ul>
            </li>
				
            <li class="has-sub <?php if($MenuID==3 || $MenuID==4 || $MenuID==5 ) { echo "active"; } ?>">
              <a href="javascript:;">
              <i class="fa fa-users"></i>
              <span>Student Management</span>
              </a>
			  <ul class="sub-menu">
					<li class="<?php if($MenuID==3) { echo "active"; } ?>"><a href="AddStudent.php?MID=3">Add Student</a></li>
					<li class="<?php if($MenuID==4) { echo "active"; } ?>"><a href="StudentList.php?MID=4">Student List</a></li> 
					<li class="<?php if($MenuID==5) { echo "active"; } ?>"><a href="BatchMapping.php?MID=5">Student Batch Mapping</a></li>  
			  </ul>
            </li>
			
			<li class="has-sub  <?php if($MenuID==6 || $MenuID==7 || $MenuID==8  || $MenuID==9  || $MenuID==17 ) { echo "active"; } ?>">
              <a href="javascript:;">
              <i class="fa fa-inr"></i>
              <span>Fees Management</span>
              </a>
			  <ul class="sub-menu">
					<li class="<?php if($MenuID==6) { echo "active"; } ?>"><a href="StudentPayment.php?MID=6">Fees Collection</a></li>
					<li class="<?php if($MenuID==7) { echo "active"; } ?>"><a href="javascript:;">Fees Type</a></li>
					<li class="<?php if($MenuID==8) { echo "active"; } ?>"><a href="AddPaymentmode.php?MID=8">Payment Mode</a></li>
					<li class="<?php if($MenuID==9) { echo "active"; } ?>"><a href="StudentPaymentRegister.php?MID=9">Collection Register</a></li>
					<li class="<?php if($MenuID==17) { echo "active"; } ?>"><a href="DueRegister.php?MID=17">Due Register</a></li>
					 
						</ul>
            </li>
			
			<li class="has-sub  <?php if($MenuID==10 || $MenuID==11 || $MenuID==12  ) { echo "active"; } ?>">
              <a href="javascript:;">
              <i class="fa fa-inbox"></i>
              <span>Tutor Management</span>
              </a>
			  <ul class="sub-menu">
					<li class="<?php if($MenuID==10) { echo "active"; } ?>"><a href="AddTutor.php?MID=10">Add Tutor</a></li>
					<li class="<?php if($MenuID==11) { echo "active"; } ?>"><a href="TutorPayment.php?MID=11">Tutor Payment</a></li>
					<li class="<?php if($MenuID==12) { echo "active"; } ?>"><a href="PaymentRegister.php?MID=12">Payment Register</a></li>
					 
						</ul>
            </li>
			
			<li class="has-sub <?php if($MenuID==13 || $MenuID==14 ) { echo "active"; } ?>">
              <a href="javascript:;">
              <i class="fa fa-inbox"></i>
              <span>Class Management</span>
              </a>
			  <ul class="sub-menu">
					<li class="<?php if($MenuID==13) { echo "active"; } ?>"><a href="StudentAttendancePunch.php?MID=13">Student Attendance</a></li>
					<li class="<?php if($MenuID==14) { echo "active"; } ?>"><a href="javascript:;">Tutor Attendance</a></li>
					<li class="<?php if($MenuID==15) { echo "active"; } ?>"><a href="javascript:;">Tutor Clas Mapping</a></li>
					<li class="<?php if($MenuID==16) { echo "active"; } ?>"><a href="javascript:;">Active Class</a></li>
					
						 
						</ul>
            </li>
            
            
            <li class="has-sub <?php if($MenuID==31 || $MenuID==32 ) { echo "active"; } ?>">
        <a href="javascript:;">
            <i class="fa fa-phone"></i>
            <span>Enquiry</span>
        </a>
        <ul class="sub-menu">
            <li class="<?php if($MenuID==31) { echo "active"; } ?>"><a href="EnquiryEntry.php?MID=31">Enquiry</a></li>
            <li class="<?php if($MenuID==32) { echo "active"; } ?>"><a href="EnquiryRegister.php?MID=32">Enquiry
                    Register</a></li>


        </ul>
    </li>
    
			
			<li class="has-sub <?php if($MenuID==36 || $MenuID==37  || $MenuID==42 ) { echo "active"; } ?>">
              <a href="javascript:;">
              <i class="fa fa-book"></i>
              <span>Accounting</span>
              </a>
			  <ul class="sub-menu">
							<li class="<?php if($MenuID==36) { echo "active"; } ?>"><a href="IncomeExpenseEntry.php?MID=36">Income & Expense Entry</a></li>
							<?php
							  if ($GroupID=='1')
			 {
				 ?>
							<li class="<?php if($MenuID==42) { echo "active"; } ?>"><a href="DayClosing.php?MID=42">Day Closing</a></li>
							<li class="<?php if($MenuID==37) { echo "active"; } ?>"><a href="BalanceSheet.php?MID=37">Balance Sheet</a></li> 
			 <?php 
			 }
							?>
							
							
							 
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