
<?php
include('../connect.php');
$LocationCode = $_SESSION['SESS_LOCATION']; 
$LocationName = $_SESSION['SESS_LOCATIONNAME'];  
?>

				<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php"><b>Point Of Sales -  <?php echo $LocationName; echo " [".$_SESSION['SESS_FIRST_NAME']."]"; ?></b></a>
          <div class="nav-collapse collapse">
            <ul class="nav pull-right">
             
              <li><a href="passwordchange.php"><font color="yellow"><i class="icon-key"></i> </font></a></li>
			  <li><a href="../index.php"><font color="red"><i class="icon-off"></i></font></a></li>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	