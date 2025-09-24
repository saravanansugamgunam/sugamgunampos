<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8">
  <![endif]-->
<!--[if !IE]>
  <!-->
<html lang="en">
<!--
    	<![endif]-->
<?php 
  
    include("../connect.php");
    // $position=$_SESSION["SESS_LAST_NAME"]; 
	 session_cache_limiter(FALSE);
    session_start();
	   $LocationCode = $_SESSION['SESS_LOCATION'];
   $LocationName = $_SESSION['SESS_LOCATIONNAME'];
   $GroupID = $_SESSION['SESS_GROUP_ID'];
  $EmployeeCode=$_GET['SID'];
    ?>

<head>
    <meta charset="utf-8" />
    <title>Valviyal Academy</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="../assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../assets/css/animate.min.css" rel="stylesheet" />
    <link href="../assets/css/style.min.css" rel="stylesheet" />
    <link href="../assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="../assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->
    <!-- ================== BEGIN BASE JS ================== -->
    <link href="../assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
    <link href="../assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
    <link href="../assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="../assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="../assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
    <link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <script src="../assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="../assets/Custom/sweetalert.css" rel="stylesheet" />
    <script src="../assets/Custom/sweetalert2.min.js"></script>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
    <style>
    body {
        background: #f5f5f5 url('../assets/img/bg.png') left top repeat;
    }

    #f1_upload_process {
        z-index: 100;
        visibility: hidden;
        position: absolute;
        text-align: center;
        width: 400px;
    }

    .msg {
        text-align: left;
        color: #666;
        background-repeat: no-repeat;
        margin-left: 30px;
        margin-right: 30px;
        padding: 5px;
        padding-left: 30px;
    }

    .emsg {
        text-align: left;
        margin-left: 30px;
        margin-right: 30px;
        color: #666;
        background-repeat: no-repeat;
        padding: 5px;
        padding-left: 30px;
    }
    </style>

</head>

<body onload='LoadDocumentList()'>
    <!-- begin #page-loader -->

    <!-- end #page-loader -->
    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-minified page-header-fixed">
        <!-- begin #header -->
        <div id="header" class="header navbar navbar-default navbar-fixed-top">
            <!-- begin container-fluid -->
            <div class="container-fluid">
                <!-- begin mobile sidebar expand / collapse button -->
                <div class="navbar-header">
                    <a href="../index.php" class="navbar-brand">
                        <img src="../assets/img/logo.png" class="media-object" width="150" alt="" />
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

        <div id="wait"
            style="display:none;width:69px;height:189px;border:1px grey;position:absolute;top:50%;left:50%;padding:2px; z-index: 1000;">
            <img src='../assets/img/demo_wait.gif' width="64" height="64" />
            <br>Loading...
        </div>
        <!-- begin #sidebar -->
        <div id="sidebar" class="sidebar">
            <?php include("AMSidePanel.php") ?>
        </div>
        <!-- end #sidebar -->
        <!-- begin #content -->
        <script>
        function LoadProfile() {

        }

        function LoadCourseDetails() {}

        function LoadPaymentHistory() {}

        function LoadPayementSchedule() {}
        </script>
        <?php
	 

	  $res = $connection->query(" 
      SELECT username,mobileno,'-',emailid,gender,DATE_FORMAT(dob, '%d-%b-%Y') AS dob,maritalstatus,
      DATE_FORMAT(doj, '%d-%b-%Y') AS dob,salary,qualification,yoe,biometricid,designation,
      CONCAT(address1) AS address ,photopath,
      (SELECT groupname FROM pos_usergroupmapping  AS a JOIN pos_groupmaster AS b ON a.groupid=b.groupid 
      WHERE a.userid ='$EmployeeCode' limit 1) as Groupname
      FROM usermaster  AS a LEFT JOIN designationmaster AS b ON a.designationid=b.id
 WHERE userid ='$EmployeeCode';"); 
	   
while($data = mysqli_fetch_row($res))
{ 
$Name=$data[0];
$MobileNo=$data[1];
$AltMobileNo=$data[2]; 
$EmailID=$data[3]; 
$Gender=$data[4];
$DOB=$data[5]; 
$MaritalStatus=strtoupper($data[6]); 
$DOJ=$data[7];

$Salary=$data[8];
$Qualification=strtoupper($data[9]);
$YOE=$data[10];
$BiometricID=$data[11];
$Designation=strtoupper($data[12]);
$Address=strtoupper($data[13]);
$PhotoPath=$data[14];
$GroupName=strtoupper($data[15]);
 
 

}



	?>
        <div id="content" class="content">
            <div class="row">



                <div class="modal fade" id="modal-Biometric">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Add Biometric</h4>
                                <input type='hidden' id='UserID' name='UserID' value="<?php echo $EmployeeCode; ?>" />
                            </div>
                            <div class="modal-bod">
                                <div class="col-md-12">
                                    <!-- begin panel -->

                                    <div class="panel-body">
                                        <form class="form-horizontal">



                                            <style type="text/css">
                                            .img {
                                                min-width: 125px;
                                                min-height: 155px;
                                                width: 125px;
                                                height: 155px;
                                                border: 1px solid #CCC;
                                                border-radius: 4px;
                                                box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset;
                                                background-color: #FFFFFF;
                                            }
                                            </style>
                                            <script src="jquery-1.8.2.js"></script>
                                            <script src="mfs100-9.0.2.6.js"></script>

                                            <script
                                                src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
                                            </script>


                                            <script>
                                            function GetBiometric() {
                                                // var UserID = document.getElementById("txtInvoiceNo").value;
                                                var UserID = 1;

                                                var datas = "&UserID=" + UserID;
                                                // alert(datas);
                                                $.ajax({
                                                    url: "LoadBiometric.php",
                                                    method: "POST",
                                                    data: datas,
                                                    dataType: "json",
                                                    success: function(data) {
                                                        // alert(data);
                                                        $("#txtIsoTemplate").val(data[0]);

                                                    }
                                                });

                                            }
                                            </script>

</body>

</html>




</form>
</div>

</div>
</div>
<div class="modal-footer">
    <a href="javascript:;" class="btn btn-sm btn-warning" onclick="return GetInfo()">Device Status</a>

    <a href="javascript:;" class="btn btn-sm btn-danger" onclick="return Capture()">Capture</a>
    <a href="javascript:;" class="btn btn-sm btn-success" onclick="SaveBiometric()">Save</a>

</div>
</div>
</div>
</div>




<div class="profile-container">
    <!-- begin profile-section -->
    <div class="profile-section">
        <!-- begin profile-left -->
        <div class="profile-left">
            <!-- begin profile-image -->
            <div class="profile-image">
                <?php if($PhotoPath=='-')
						{
							echo "<img src='../../assets/img/profile-cover.jpg' />";
						}
						else
						{
							echo "<img src='".$PhotoPath."' style='width: 200px;  object-fit: fill;' />";
						}
						?>


                <i class="fa fa-user hide"></i>
            </div>

            <!-- end profile-image -->
            <div class="m-b-10">

                <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
                <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
                <script type="text/javascript">
                $(document).ready(function(e) {
                    $("#uploadFormimg").on('submit', (function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: "uploadprofile.php",
                            type: "POST",
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(data) {
                                $("#targetLayer").html(data);
                                location.reload();
                            },
                            error: function() {
                                location.reload();
                            }
                        });
                    }));
                });
                </script>
                <script>
                function SaveLocationMapping() {
                    var UserID = <?php echo $EmployeeCode; ?>;
                    var Location = document.getElementById("cmbLocation").value;



                    var datas = "&UserID=" + UserID + "&Location=" + Location;
                    // alert(datas);
                    $.ajax({
                        url: "Save/SaveLocationMapping.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {

                            if (data == 1) {

                                swal("Sucess !", "Location mapping done sucessfully!",
                                    "success");
                                setTimeout(function() {
                                    location.reload()
                                }, 1000);
                            } else {
                                // 
                                swal("Alert!", "Kindly provide valid details!",
                                    "warning");
                                setTimeout(function() {
                                    location.reload()
                                }, 1000);
                            }


                        }
                    });
                }

                function SaveGroupMapping() {
                    var UserID = <?php echo $EmployeeCode; ?>;
                    var Group = document.getElementById("cmbGroup").value;



                    var datas = "&UserID=" + UserID + "&Group=" + Group;
                    // alert(datas);
                    $.ajax({
                        url: "Save/SaveGroupMapping.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {

                            if (data == 1) {

                                swal("Sucess !", "Group mapping done sucessfully",
                                    "success");
                                setTimeout(function() {
                                    location.reload()
                                }, 1000);
                            } else {

                                swal("Alert!", "Kindly provide valid details!",
                                    "warning");
                                setTimeout(function() {
                                    location.reload()
                                }, 1000);
                            }


                        }
                    });
                }





                function DeleteLocationMapping(x) {
                    var Locationcode = x;
                    var UserID = <?php echo $EmployeeCode; ?>;
                    var datas = "&Locationcode=" + Locationcode + "&UserID=" + UserID;
                    // alert(datas);
                    $.ajax({
                        url: "Save/DeleteLocationMapping.php",
                        method: "POST",
                        data: datas,
                        success: function(data) {

                            if (data == 1) {

                                swal("Sucess !", "Location Mapping altered",
                                    "success");
                                setTimeout(function() {
                                    location.reload()
                                }, 1000);
                            } else {
                                // 
                                swal("Alert!", "Unable to alter location mapping",
                                    "warning");
                                setTimeout(function() {
                                    location.reload()
                                }, 1000);
                            }


                        }
                    });
                }

                function LoadDocumentList() {
            var Dumy = 0;
            var EmployeeCode = <?php echo $EmployeeCode; ?>;

            var datas = "&EmployeeCode=" + EmployeeCode;

            $.ajax({
                url: "Load/LoadDocumentList.php",
                method: "POST",
                data: datas,
                success: function(data) {

                    $('#DivDocumentList').html(data);


                }
            });
        }


                </script>

                <div class="bgColor">
                    <form id="uploadFormimg" action="uploadprofile.php" method="post">
                        <input type='hidden' id='txtEmployeeCodeImage' name='txtEmployeeCodeImage'
                            value='<?php echo $EmployeeCode; ?>' />
                        <div id="targetLayer">No Image</div>
                        <div id="uploadFormLayer">

                            <input name="userImage" id="userImage" type="file"
                                class="inputFile btn btn-warning btn-block btn-sm" /><br />
                            <input type="submit" value="Submit" class="btnSubmit btn btn-info btn-block btn-sm" />
                    </form>
                </div>
            </div>
        </div>

        <!-- end profile-highlight -->

        <div class="modal fade" id="modal-LocationMapping">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Location Mapping</h4>
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->

                            <div class="panel-body">
                                <form class="form-horizontal">

                                    <div class="form-group">
                                        <label class=" control-label">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Location</label>
                                        <div class="col-md-12">
                                            <select class='form-control' id='cmbLocation' name='cmbLocation'>

                                                <?php 
 
						$sqli = "select  locationcode,locationname  from locationmaster where activestatus ='Active' ";
					 
					$result = mysqli_query($connection, $sqli);
					 while ($row = mysqli_fetch_array($result)) {
					 		# code...
					 	echo '<option value ='.$row['locationcode'].'>'.$row['locationname'].'</option>'; 
                    }
                     ?>
                                            </select>
                                        </div>

                                    </div>


                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <a href="javascript:;" class="btn btn-sm btn-success" onclick="SaveLocationMapping();">Save</a>
                        <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modal-GroupMapping">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Group Mapping</h4>
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <!-- begin panel -->

                            <div class="panel-body">
                                <form class="form-horizontal">



                                    <div class="form-group">
                                        <label class=" control-label">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Group</label>
                                        <div class="col-md-12">
                                            <select class='form-control' id='cmbGroup' name='cmbGroup'>

                                                <?php 
 
						$sqli = "SELECT groupid,groupname FROM pos_groupmaster WHERE groupstatus ='Active'";
					 
					$result = mysqli_query($connection, $sqli);
					 while ($row = mysqli_fetch_array($result)) {
					 		# code...
					 	echo '<option value ='.$row['groupid'].'>'.$row['groupname'].'</option>'; 
                    }
                     ?>
                                            </select>
                                        </div>

                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <a href="javascript:;" class="btn btn-sm btn-success" onclick="SaveGroupMapping();">Save</a>
                        <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>





        <?php
      
      echo "Group Name :";
      echo "<b>";
      echo $GroupName;
      echo "<button class='btn btn-xs btn-info'>
      <a href='#modal-GroupMapping' data-toggle='modal' >
      <i class='fa fa-2x fa-pencil'></i></a> </button>";
      echo "</b>";

      $result = mysqli_query($connection, " 
      SELECT locationcode,locationname FROM uselocationmapping AS a JOIN locationmaster AS b ON 
      a.locationid=b.locationcode WHERE userid ='$EmployeeCode'
      AND activestatus ='Active'");
 
 
       echo" <table id='data-table' border='1' style='border-collapse:collapse;' class='table table-striped table-bordered'
            width='100%'>
            <thead>
                <tr>
                    <th width='%'>Sno</th>
                    <th width='%' hidden>Code</th>
                    <th width='%'> Location</th>
                    <th width='%'><button class='btn btn-xs btn-info'>
                            <a href='#modal-LocationMapping' data-toggle='modal' style='color:white'>
                                Edit</a> </button></th>

                </tr>
            </thead>
            <tbody id='myTable'>";
            $SerialNo = 1;
            while($data = mysqli_fetch_row($result))
            {
              echo "
              <tr>
              
              <td width='%'>$SerialNo</td>  
              <td width='%' hidden>$data[0]</td>  
               <td width='%'>$data[1]</td>  
               <td width='%' onclick='DeleteLocationMapping($data[0])'  style='color:red'  ><i class='fa fa-2x fa-trash' style='cursor:pointer'></i></td>";
               echo "</tr>"; 
               $SerialNo=$SerialNo+1;    
            }
                echo"
            </tbody>
        </table>";
        ?>



    </div>
    <!-- end profile-left -->
    <!-- begin profile-right -->
    <div class="profile-right">
        <!-- begin profile-info -->
        <div class="profile-info">
            <!-- begin table -->
            <div class="table-responsive">
                <table class="table table-profile">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                <h4><?php echo $Name; ?></h4>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr class="divider">
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td class="field">Mobile</td>
                            <td><i class="fa fa-mobile fa-lg m-r-5"></i> <?php echo $MobileNo; ?> </td>

                        </tr>
                        <tr>
                            <td class="field">Alt. Mobile</td>
                            <td><i class="fa fa-mobile fa-lg m-r-5"></i> <?php echo $AltMobileNo; ?> </td>

                        </tr>
                        <tr>
                            <td class="field">Email</td>
                            <td>
                                <?php echo $EmailID; ?></td>

                        </tr>
                        <tr>
                            <td class="field">Gender</td>
                            <td> <?php echo $Gender; ?> </td>

                        </tr>
                        <tr>
                            <td class="field">DOB</td>
                            <td><?php echo $DOB; ?></td>

                        </tr>
                        <tr>
                            <td class="field">Martital Status</td>
                            <td> <?php echo $MaritalStatus; ?></td>

                        </tr>
                        <tr>
                            <td class="field">Designation</td>
                            <td> <?php echo $Designation; ?></td>

                        </tr>
                        <tr>
                            <td class="field">Date of Joining</td>
                            <td> <?php echo $DOJ; ?></td>

                        </tr>
                        <tr>
                            <td class="field">Salary</td>
                            <td> <?php echo $Salary; ?></td>

                        </tr>

                        <tr>
                            <td class="field">Qualification</td>
                            <td> <?php echo $Qualification; ?></td>

                        </tr>
                        <tr>
                            <td class="field">Year of Exp</td>
                            <td> <?php echo $YOE; ?></td>

                        </tr>

                        <tr>
                            <td class="field">Address</td>
                            <td><?php echo $Address; ?></td>
                        </tr>

                        <tr>
                            <td class="field">Appointment Letter</td>
                            <td><a href='AppointmentOrder.php?MID=4&ei=<?php echo $EmployeeCode; ?>'>
                                    <i class='fa fa-2x fa-eye'></i></a></td>
                        </tr>


                    </tbody>
                </table>
            </div>
            <!-- end table -->
        </div>
        <!-- end profile-info -->
    </div>
    <!-- end profile-right -->
</div>
<!-- end profile-section -->
<!-- begin profile-section -->
<div class="profile-section">


    <!-- begin row -->
    <div class="row">
        <!-- begin col-4 -->
        <div class="col-md-5">
            <h4 class="title">Promotion History</h4>
            <!-- begin scrollbar -->
            <div data-scrollbar="true" data-height="280px" class="bg-silver">
                <!-- begin chats -->
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>S. No</th>
                            <th>Batch</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
	
	
	  $res = $connection->query("  
      SELECT DATE_FORMAT(promotedate, '%d-%b-%Y') AS promotedate,
      oldsalary,newsalary,b.designation,c.designation FROM promotiondetails AS a 
      JOIN designationmaster AS b ON a.olddesignation= b.id 
      JOIN designationmaster AS c ON a.newdesignation= c.id
       WHERE a.employeecode = '$EmployeeCode' ;"); 
	   $Sno = 1; 
				while($row = mysqli_fetch_row($res))
					{
						
				?>
                        <tr class="record">
                            <td><?php echo $Sno; ?></td>
                            <td><?php echo $row[0]; ?></td>
                            <td><?php echo $row[1]; ?></td>
                            <td><?php echo $row[2]; ?></td>
                            <td><?php echo $row[3]; ?></td>
                            <td><?php echo $row[4]; ?></td>


                        </tr>
                        <?php
				$Sno=$Sno+1;
					}



	?>
                    </tbody>
                </table>
                <!-- end chats -->
            </div>
            <!-- end scrollbar -->
        </div>
        <!-- end col-4 -->
        <!-- begin col-4 -->
        <div class="col-md-4">
            <h4 class="title">Salary History</h4>
            <!-- begin scrollbar -->
            <div data-scrollbar="true" data-height="280px" class="bg-silver">
                <!-- begin chats -->
                <table class="table table-condensed">
                    <thead>
                        <tr>

                            <th>S. No</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
	
	
	  $res = $connection->query("  SELECT a.id,DATE_FORMAT(a.salarydate, '%d-%b-%y') AS salarydate,salarytype,
      SUM(amount) FROM salarypaymentdetails  AS a JOIN usermaster AS b ON 
      a.employeecode=b.userid WHERE a.employeecode ='$EmployeeCode'  
       GROUP BY  DATE_FORMAT(a.salarydate, '%d-%b-%y'),
      salarytype, a.id ORDER BY salarydate DESC    ;"); 
	   $Sno = 1; 
				while($row = mysqli_fetch_row($res))
					{
						
				?>
                        <tr class="record">
                            <td><?php echo $Sno; ?></td>
                            <td hidden><?php echo $row[0]; ?></td>
                            <td><?php echo $row[1]; ?></td>
                            <td><?php echo $row[2]; ?></td>
                            <td><?php echo $row[3]; ?></td>
                            <td><a href='SalarySlip.php?SID=<?php echo $row[0]; ?>' target='_blank' ?>
                                    <i class='fa fa-print  fa-lg m-r-5'></i></a> </td>


                        </tr>
                        <?php
				$Sno=$Sno+1;
					}



	?>
                    </tbody>
                </table>
                <!-- end chats -->
            </div>
            <!-- end scrollbar -->
        </div>
        <!-- end col-4 -->
        <!-- begin col-4 -->

        <div class="modal fade" id="modalDocumentLoad" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">


                        <h4 class="modal-title">Upload Documents</h4>
                    </div>
                    <div class="modal-bod">
                        <div class="col-md-12">
                            <form id="upload" enctype="multipart/form-data" method="post">
                                <script type="text/javascript"
                                    src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                                <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous">
                                </script>

                                <p id="msg"></p>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <label>Annexure </label>
                                            <input type='text' class="form-control" id='txtDocumentName'
                                                name='txtDocumentName' />

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>File </label>
                                            <input type="file" class="form-control" name="file" id="file">

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label> <br> <br> </label>

                                            <input type="submit" name="uploadd" id='uploadd' value="Upload"
                                                class="btn btn-primary  m-r-5" />

                                        </div>
                                    </div>
                                </div>

                                <input type='hidden' id='txtEmployeeCode' name='txtEmployeeCode'
                                    value="<?php echo $EmployeeCode; ?>" />
                                <script type="text/javascript">
                                $(document).ready(function(e) {
                                    // e.preventDefault();
                                    $('#upload').on('submit', function() {
                                        //e.preventDefault();
                                        var file_data = $('#file').prop('files')[0];
                                        var form_data = new FormData();
                                        var DocName = document.getElementById("txtDocumentName").value;
                                        form_data.append('file', file_data);
                                        var datas = form_data;


                                        $.ajax({
                                            url: "upload.php", // point to server-side PHP script 
                                            dataType: 'text', // what to expect back from the PHP script
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            data: new FormData(this),
                                            type: 'post',
                                            success: function(response) {
                                                $('#msg').html(
                                                    response
                                                ); // display success response from the PHP script
                                            },
                                            error: function(response) {
                                                $('#msg').html(
                                                    response
                                                ); // display error response from the PHP script
                                            }
                                        });
                                    });
                                });
                                </script>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">


                        <a href="javascript:;" class="btn btn-sm btn-warning" onclick="Reset();"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <h4 class="title">Documents

                <a href='#modalDocumentLoad' class='btn btn-sm btn-success  ' data-toggle='modal'>+</a>
            </h4>

            <!-- xxxxxxxxxxxxxxxxxxxxxxxxx -->




           

 


            <!-- begin scrollbar -->
            <div data-scrollbar="true" data-height="280px" class="bg-silver">
                <!-- begin todolist -->
                <div id='DivDocumentList'> </div>
                <!-- end todolist -->
            </div>
            <!-- end scrollbar -->
        </div>
        <!-- end col-4 -->
    </div>
    <!-- end row -->
</div>
<!-- end profile-section -->
</div>
<!-- end profile-container -->
</div>

</div>

<!-- end row -->
</div>





<!-- end #content -->
<!-- begin theme-panel -->
<!-- end theme-panel -->
<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top">
    <i class="fa fa-angle-up"></i>
</a>
<!-- end scroll to top btn -->
</div>
<!-- end page container -->
<!-- ================== BEGIN BASE JS ================== -->
<script src="../assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="../assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="../assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
  <script src="../assets/crossbrowserjs/html5shiv.js"></script>
  <script src="../assets/crossbrowserjs/respond.min.js"></script>
  <script src="../assets/crossbrowserjs/excanvas.min.js"></script>
  <![endif]-->
<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="../assets/js/inbox.demo.min.js"></script>
<script src="../assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="../assets/plugins/bootstrap-daterangepicker/moment.js"></script>
<script src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="../assets/js/form-plugins.demo.min.js"></script>
<script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="../assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<script src="../assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="../assets/plugins/masked-input/masked-input.min.js"></script>
<script src="../assets/plugins/password-indicator/js/password-indicator.js"></script>
<script src="../assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
<script src="../assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
<script src="../assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
<script src="../assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="../assets/plugins/switchery/switchery.min.js"></script>
<script src="../assets/plugins/powerange/powerange.min.js"></script>
<script src="../assets/js/form-slider-switcher.demo.min.js"></script>
<script src="../assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
<script src="../assets/js/form-wizards.demo.min.js"></script>
<script src="../assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
$(document).ready(function() {
    App.init();
    Inbox.init();
    FormPlugins.init();
    FormSliderSwitcher.init();
    FormWizard.init();
});
</script>
</body>
<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->

</html>