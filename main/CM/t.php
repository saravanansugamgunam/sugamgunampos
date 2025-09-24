<div class="container-fluid">
          <!-- begin mobile sidebar expand / collapse button -->
          <div class="navbar-header">
            <a href="../index.php" class="navbar-brand">
            <img src="../assets/img/logo.png" class="media-object"   width="150" alt="" />
            </a>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
          </div>
          <!-- end mobile sidebar expand / collapse button -->
          <!-- begin header navigation right -->
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown navbar-user">
             <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
							
							<i class="fa fa-bell-o"></i> 
						</a>
            </li>
            
            <li class="dropdown navbar-user">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../assets/img/user-13.jpg" alt="" />
              <span class="hidden-xs">
               <?php echo $_SESSION['SESS_FIRST_NAME']; ?>
              </span>
               
              </a>
			   <li class="divider"></li>
				<li>
                  <a href="../../index.php">Log Out</a>
                </li>
              <ul class="dropdown-menu animated fadeInLeft">
                <li class="arrow"></li>
                <li>
                  <a href="PasswordChange.php">Change Password</a>
                </li> 
				 <li class="divider"></li>
				<li>
                  <a href="logout.php">Log Out</a>
                </li>
              </ul>
            </li>
          </ul>
          <!-- end header navigation right -->
        </div>
        <!-- end container-fluid -->
      </div>
      <!-- end #header -->
      
      <div id="wait" style="display:none;width:69px;height:189px;border:1px grey;position:absolute;top:50%;left:50%;padding:2px; z-index: 1000;">
        <img src='../assets/img/demo_wait.gif' width="64" height="64" />
        <br>Loading...
      </div>
      <!-- begin #sidebar -->
      <div id="sidebar" class="sidebar">
        <!-- begin sidebar scrollbar --> 
          <!-- begin sidebar user -->
          <!-- end sidebar user -->
          <!-- begin sidebar nav -->
          <ul class="nav">
 <li class="has-sub active">
              <a href="index.php">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
			 
            </li>
			
		    <li class="has-sub">
              <a href="javascript:;">
              <i class="fa fa-sitemap"></i>
              <span>Course Management</span>
              </a>
			  <ul class="sub-menu">
							<li><a href="AddCourse.php">Add New Course</a></li>
							<li><a href="AddBatch.php">Add Batch</a></li>
						
						</ul>
            </li>
			
            <li class="has-sub">
              <a href="javascript:;">
              <i class="fa fa-users"></i>
              <span>Student Management</span>
              </a>
			  <ul class="sub-menu">
							<li><a href="AddStudent.php">Add Student</a></li>
							<li><a href="StudentList.php">Student List</a></li>
							<li><a href="BatchMapping.php">Student Batch Mapping</a></li>
						
						</ul>
            </li>
			
			
			<li class="has-sub">
              <a href="javascript:;">
              <i class="fa fa-inr"></i>
              <span>Fees Management</span>
              </a>
			  <ul class="sub-menu">
							<li><a href="StudentPayment.php">Fees Collection</a></li>
							<li><a href="javascript:;">Fees Type</a></li>
							<li><a href="AddPaymentmode.php">Payment Mode</a></li>
							<li><a href="StudentPaymentRegister.php">Collection Register</a></li> 
						</ul>
            </li>
			
			<li class="has-sub">
              <a href="javascript:;">
              <i class="fa fa-inbox"></i>
              <span>Tutor Management</span>
              </a>
			  <ul class="sub-menu">
							<li><a href="AddTutor.php">Add Tutor</a></li>
							<li><a href="TutorPayment.php">Tutor Payment</a></li>
							<li><a href="PaymentRegister.php">Payment Register</a></li> 
							
						</ul>
            </li>
			
			<li class="has-sub">
              <a href="javascript:;">
              <i class="fa fa-inbox"></i>
              <span>Class Management</span>
              </a>
			  <ul class="sub-menu">
							<li><a href="javascript:;">Active Classes</a></li>
							<li><a href="javascript:;">Student Attendance</a></li>
							
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