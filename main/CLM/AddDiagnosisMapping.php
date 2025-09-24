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
     ob_start();
    include("../../connect.php");
    // $position=$_SESSION["SESS_LAST_NAME"]; 
	 session_cache_limiter(FALSE);
    session_start(); 
   $LocationCode = $_SESSION['SESS_LOCATION'];
      if(isset($_SESSION['SESS_LAST_NAME']))
    {
    //echo 'Session Active';
    
    }
    else
    {
    //echo 'Session In Active';
    $url='../../index.php';
    echo '
    <META HTTP-EQUIV=REFRESH CONTENT=".1; '.$url.'">';
    }   
    
    
    $DiseaseID=$_GET['ID'];


    $res = $connection->query(" 
    SELECT diseaseid,disease FROM diseasemaster WHERE diseaseid ='$DiseaseID' ;"); 
          
   while($data = mysqli_fetch_row($res))
   {
    
   $DiseaseName=$data[1]; 
   }

   
    ?>

<head>
    <meta charset="utf-8" />

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
    <link href="../assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
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

<body onload="LoadAllConcepts();">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in">
        <span class="spinner"></span>
    </div>
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
                        <a href="../logout.php">Log Out</a>
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
        <div id="sidebar" class="sidebar">
            <?php include("CLMSidePanel.php") ?>
        </div>

        <script>
        function LoadAllConcepts() {
            LoadSymptoms();
            LoadDiagnosis();
            LoadMedicine();
            LoadTherapy();
            LoadPathology();
            LoadDietMapping();
            LoadAcuPoints();
        }

        function LoadSymptoms() {
            var DiseaseID = document.getElementById("cmbDisease").value;
            var datas = "&DiseaseID=" + DiseaseID;
            $.ajax({
                url: "Load/LoadMappingSymptomsList.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivSymptomsList').html(data);
                }
            });
        }

        function LoadDiagnosis() {
            var DiseaseID = document.getElementById("cmbDisease").value;
            var datas = "&DiseaseID=" + DiseaseID;
            $.ajax({
                url: "Load/LoadMappingDiagnosisList.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivDiagnosisList').html(data);
                }
            });
        }

        function LoadMedicine() {
            var DiseaseID = document.getElementById("cmbDisease").value;
            var datas = "&DiseaseID=" + DiseaseID;
            $.ajax({
                url: "Load/LoadMappingMedicineList.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivMedicineList').html(data);
                }
            });
        }

        function LoadTherapy() {
            var DiseaseID = document.getElementById("cmbDisease").value;
            var datas = "&DiseaseID=" + DiseaseID;
            $.ajax({
                url: "Load/LoadMappingTherapyList.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivTherapyList').html(data);
                }
            });
        }

        function LoadPathology() {
            var DiseaseID = document.getElementById("cmbDisease").value;
            var datas = "&DiseaseID=" + DiseaseID;
            $.ajax({
                url: "Load/LoadMappingPathologyList.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivPathologyList').html(data);
                }
            });
        }

        function LoadAcuPoints() {
            var DiseaseID = document.getElementById("cmbDisease").value;
            var datas = "&DiseaseID=" + DiseaseID;
            $.ajax({
                url: "Load/LoadMappingAcuPointsList.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    $('#DivAcuPointsList').html(data);
                }
            });
        }


        function LoadDietMapping() {
            var DiseaseID = document.getElementById("cmbDisease").value;
            var datas = "&DiseaseID=" + DiseaseID;

            $.ajax({
                url: "Load/LoadMappingDietList.php",
                method: "POST",
                data: datas,
                dataType: "json",
                success: function(data) {

                    $("#txtDiet").val(data[0]);
                }
            });
        }





        function AddConcept(x) {
            var ConceptNameID = x;
            if (ConceptNameID == '0') {
                var ConceptName = 'Symptoms'
                var ConceptID = document.getElementById("cmbSymptoms").value;
            } else if (ConceptNameID == '1') {
                var ConceptName = 'Diagnosis'
                var ConceptID = document.getElementById("cmbDiagnosis").value;
            } else if (ConceptNameID == '2') {
                var ConceptName = 'Medicine'
                var ConceptID = document.getElementById("cmbMedicine").value;
            } else if (ConceptNameID == '3') {
                var ConceptName = 'Therapy'
                var ConceptID = document.getElementById("cmbTherapy").value;
            } else if (ConceptNameID == '4') {
                var ConceptName = 'Pathology'
                var ConceptID = document.getElementById("cmbPathology").value;
            } else if (ConceptNameID == '5') {
                var ConceptName = 'Acupoints'
                var ConceptID = document.getElementById("cmbAcuPoints").value;
            }

            var DiseaseID = document.getElementById("cmbDisease").value;

            if (DiseaseID == "") {
                swal("Alert!", "Kindly provide Disease Name!", "warning");
            } else {
                var datas = "&ConceptID=" + ConceptID +
                    "&DiseaseID=" + DiseaseID +
                    "&ConceptName=" + ConceptName;

                $.ajax({
                    url: "Save/SaveConceptMapping.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        LoadAllConcepts();
                    }
                });
            }
        }


        function AddDietMapping() {

            var DiseaseID = document.getElementById("cmbDisease").value;
            var Diet = document.getElementById("txtDiet").value;

            if (DiseaseID == "") {
                swal("Alert!", "Kindly provide Disease Name!", "warning");
            } else {
                var datas = "&Diet=" + Diet +
                    "&DiseaseID=" + DiseaseID;
                alert(datas);
                $.ajax({
                    url: "Save/SaveConceptDietMapping.php",
                    method: "POST",
                    data: datas,
                    success: function(data) {
                        LoadDietMapping();
                    }
                });
            }
        }

        function DeleteConceptItem(x) {
            var MappingId = x;
            var datas = "&MappingId=" + MappingId;

            $.ajax({
                url: "Delete/DeleteMappingItem.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    LoadAllConcepts();
                }
            });
        }
        </script>


        <div id="content" class="content">
            <div class="col-md-12">

                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading form-inline">

                        <h4 class="panel-title">Diagnosis Concept Mapping
                        </h4>

                    </div>
                    <h3> &nbsp;&nbsp;&nbsp;&nbsp; <u><?php echo  $DiseaseName; ?></u></h3>
                    <input type='hidden' name='cmbDisease' id='cmbDisease' value='<?php echo  $DiseaseID; ?>' />
                    <div class="panel-body">

                        <div class="col-md-12">
                            <!-- begin panel -->
                            <div class="panel-body">



                                <div class="row">

                                    <div class="panel panel-danger  col-md-4">
                                        <div class="panel-heading">

                                            <h4 class="panel-title">Symptoms&nbsp;&nbsp;&nbsp;&nbsp;

                                            </h4>

                                        </div>

                                        <div class="panel-body">
                                            <div class="form-inline">
                                                <select class="selectpicker" data-show-subtext="true"
                                                    data-live-search="true" data-style="btn-white" id='cmbSymptoms'
                                                    name='cmbSymptoms'>
                                                    <option selected></option>

                                                    <?php
                                                    $sqli = "SELECT symptomsid, symptoms FROM   `symptomsmaster` order by symptoms ";
                                                    $result = mysqli_query($connection, $sqli);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        # code...

                                                        echo ' <option value=' . $row['symptomsid'] . '>' . $row['symptoms'] . '</option>';
                                                    }
                                                    ?>
                                                </select> <button class='btn btn-sm btn-danger'
                                                    onclick='AddConcept(0);'>+</button>
                                            </div>
                                            <div id='DivSymptomsList'></div>

                                        </div>

                                    </div>


                                    <div class="panel panel-primary  col-md-4">
                                        <div class="panel-heading">

                                            <h4 class="panel-title">Deficiency&nbsp;&nbsp;&nbsp;&nbsp;

                                            </h4>

                                        </div>

                                        <div class="panel-body">
                                            <div class="form-inline">
                                                <select class="selectpicker" data-show-subtext="true"
                                                    data-live-search="true" data-style="btn-white" id='cmbDiagnosis'
                                                    name='cmbDiagnosis'>
                                                    <option selected></option>

                                                    <?php
                                                    $sqli = "SELECT diagnosisid, diagnosis FROM   `diagnosismaster` order by diagnosis ";
                                                    $result = mysqli_query($connection, $sqli);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        # code...

                                                        echo ' <option value=' . $row['diagnosisid'] . '>' . $row['diagnosis'] . '</option>';
                                                    }
                                                    ?>
                                                </select> <button class='btn btn-sm btn-success'
                                                    onclick='AddConcept(1);'>+</button>
                                            </div>
                                            <div id='DivDiagnosisList'></div>
                                        </div>

                                    </div>

                                    <div class="panel panel-success  col-md-4">
                                        <div class="panel-heading">

                                            <h4 class="panel-title">Medicine&nbsp;&nbsp;&nbsp;&nbsp;

                                            </h4>

                                        </div>

                                        <div class="panel-body">

                                            <div class="form-inline">
                                                <select class="selectpicker" data-show-subtext="true"
                                                    data-live-search="true" data-style="btn-white" id='cmbMedicine'
                                                    name='cmbMedicine'>
                                                    <option selected></option>

                                                    <?php
                                                    $sqli = "SELECT productid,CONCAT(productshortcode,': ' ,productname) AS product FROM  
                                                    productmaster WHERE status='Active' ORDER BY productshortcode";
                                                    $result = mysqli_query($connection, $sqli);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        # code...

                                                        echo ' <option value=' . $row['productid'] . '>' . $row['product'] . '</option>';
                                                    }
                                                    ?>
                                                </select> <button class='btn btn-sm btn-primary'
                                                    onclick='AddConcept(2);'>+</button>
                                            </div>
                                            <div id='DivMedicineList'></div>
                                        </div>

                                    </div>



                                </div>




                                <div class="row">



                                    <div class="panel panel-danger  col-md-4">
                                        <div class="panel-heading">

                                            <h4 class="panel-title">Therapy&nbsp;&nbsp;&nbsp;&nbsp;

                                            </h4>

                                        </div>

                                        <div class="panel-body">
                                            <div class="form-inline">
                                                <select class="selectpicker" data-show-subtext="true"
                                                    data-live-search="true" data-style="btn-white" id='cmbTherapy'
                                                    name='cmbTherapy'>
                                                    <option selected></option>

                                                    <?php
                                                    $sqli = "SELECT consultationid,consultationname FROM consultationmaster  WHERE consultingtype ='Therapy' 
                                                     AND  activestatus='Active' ORDER BY consultationname";
                                                    $result = mysqli_query($connection, $sqli);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        # code...

                                                        echo ' <option value=' . $row['consultationid'] . '>' . $row['consultationname'] . '</option>';
                                                    }
                                                    ?>
                                                </select> <button class='btn btn-sm btn-danger'
                                                    onclick='AddConcept(3);'>+</button>
                                            </div>
                                            <div id='DivTherapyList'></div>
                                        </div>

                                    </div>


                                    <div class="panel panel-primary  col-md-4">
                                        <div class="panel-heading">

                                            <h4 class="panel-title">Acupunture Points&nbsp;&nbsp;&nbsp;&nbsp;

                                            </h4>

                                        </div>

                                        <div class="panel-body">

                                            <div class="form-inline">
                                                <select class="selectpicker" data-show-subtext="true"
                                                    data-live-search="true" data-style="btn-white" id='cmbAcuPoints'
                                                    name='cmbAcuPoints'>
                                                    <option selected></option>

                                                    <?php
                                                    $sqli = "SELECT acuid, acupoints FROM   `acupuncturepoints` order by acupoints ";
                                                    $result = mysqli_query($connection, $sqli);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        # code...

                                                        echo ' <option value=' . $row['acuid'] . '>' . $row['acupoints'] . '</option>';
                                                    }
                                                    ?>
                                                </select> <button class='btn btn-sm btn-primary'
                                                    onclick='AddConcept(5);'>+</button>
                                            </div>
                                            <div id='DivAcuPointsList'></div>
                                        </div>

                                    </div>



                                    <div class="panel panel-success  col-md-4">
                                        <div class="panel-heading">

                                            <h4 class="panel-title">Pathalogy / Test&nbsp;&nbsp;&nbsp;&nbsp;

                                            </h4>

                                        </div>

                                        <div class="panel-body">
                                            <div class="form-inline">
                                                <select class="selectpicker" data-show-subtext="true"
                                                    data-live-search="true" data-style="btn-white" id='cmbPathology'
                                                    name='cmbPathology'>
                                                    <option selected></option>

                                                    <?php
                                                    $sqli = "SELECT  pathologyid,pathology FROM `pathologymaster` ORDER BY pathology";
                                                    $result = mysqli_query($connection, $sqli);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        # code...

                                                        echo ' <option value=' . $row['pathologyid'] . '>' . $row['pathology'] . '</option>';
                                                    }
                                                    ?>
                                                </select> <button class='btn btn-sm btn-success'
                                                    onclick='AddConcept(4);'>+</button>
                                            </div>
                                            <div id='DivPathologyList'></div>

                                        </div>

                                    </div>

                                </div>


                                <div class="row">
                                    <div class="panel panel-warning  col-md-12">
                                        <div class="panel-heading">

                                            <h4 class="panel-title">Diet&nbsp;&nbsp;&nbsp;&nbsp;

                                            </h4>

                                        </div>

                                        <div class="panel-body">
                                            <textarea class='form-control' rows=5
                                                placeholder='Mixed Greens Vegtables,Seafood' id='txtDiet'
                                                name='txtDiet'></textarea>
                                            <button onclick='AddDietMapping()'
                                                class='btn btn-sm btn-warning'>Add</button>

                                        </div>

                                    </div>



                                </div>








                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- end panel -->

            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->
    </div>

    </div>
    </div>
    </div>

    <!-- end col-10 -->
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
    <script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
    <script src="../assets/plugins/DataTables/js/dataTables.fixedColumns.js"></script>
    <script src="../assets/js/table-manage-fixed-columns.demo.min.js"></script>
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
    <script src="../assets/plugins/DataTables/js/jquery.dataTables.js"></script>
    <script src="../assets/plugins/DataTables/js/dataTables.tableTools.js"></script>
    <script src="../assets/plugins/DataTables/js/dataTables.colVis.js"></script>
    <script src="../assets/js/table-manage-colvis.demo.min.js"></script>
    <script src="../assets/js/table-manage-tabletools.demo.min.js"></script>
    <script src="../assets/js/table-manage-combine.demo.min.js"></script>

    <script src="../assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
    $(document).ready(function() {
        App.init();
        Inbox.init();
        FormPlugins.init();


    });
    </script>
</body>
<!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->

</html>