<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8">
  <![endif]-->
  <!--[if !IE]>
  <!-->
    <html lang="en">
    	<!--
    	<![endif]-->
		 <meta http-equiv="refresh" content="5" />
  <?php 
  
    include("../connect.php"); 
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

    ?>
  <head>
    <meta charset="utf-8" />
    <title>SugamGunam</title>
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
    <link href="../assets/Custom/sweetalert.css" rel="stylesheet"/>
    <script src="../assets/Custom/sweetalert2.min.js"></script>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../assets/Custom/nicEdit.js"></script>
	
	<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
 
  </head>
  <body onload ='LoadTokenDisplay()'>
  
  
    <?php 
	  
	  
	  $res = $connection->query("SELECT tokendisplayroom1,tokendisplayroom2 FROM tokensettings"); 
	   
while($data = mysqli_fetch_row($res))
{

$Room1Caption=$data[0];
$Room2Caption=$data[1];
 
 


}

	  ?>
	  
	  
	  
  <style>
  html, body {
  height: 100%;
  margin: 0;
}

.column {
  float: left;
  width: 50%;
  padding: 10px; 
   
} 

/* Clear floats after the columns */
.row:after { 
  display: table;
  clear: both;
}
.full-height {
  height: 100%;
  background: yellow;
}

  </style>
  
  <script>
   
  


  function LoadTokenDisplay()
  {
	  // alert(1);
	  LoadNextTokenDisplay1();
	  // alert(2);
	  LoadNextTokenDisplay2();
	  // alert(3);
	  LoadTokenDisplay1();
	  // alert(4);
	  LoadTokenDisplay2();
	  // alert(5);
  }
  function LoadTokenDisplay1()
  {
	   var Dumy = 0;
	 
	    
var datas = "&Dumy="+Dumy;	
	  	  
		 $.ajax({
		   url:"Load/LoadTokenDisplay1.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		   
		  $( '#DivTokenList1' ).html(data);
		 
		
		   }
		  });
  }
  
  function LoadTokenDisplay2()
  {
	   var Dumy = 0;
	 
	    
var datas = "&Dumy="+Dumy;	
	  	  
		 $.ajax({
		   url:"Load/LoadTokenDisplay2.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		   
		  $( '#DivTokenList2' ).html(data);
		 
		
		   }
		  });
  }
  
  function LoadNextTokenDisplay1()
  {
	  var Dumy = 0;
 var datas = "&Dumy="+Dumy;	
	  	  // alert(datas);
		 $.ajax({
		   url:"Load/LoadTokenNumberforDisplay1.php",
		   method:"POST",
		   data:datas,
		   dataType:"json",
		   success:function(data)
		   {	
		     // alert(data);
		    // document.getElementById("pNextTokenNo1").innerHTML = data;
		 
			if(data=='')
			{
				 
			}
else
{
	
		   document.getElementById("pNextTokenNo1").innerHTML = data[0];
		   document.getElementById("pNextTokenName1").innerHTML = data[1];
		   document.getElementById("pRoomName1").innerHTML = data[2];
}	
			 
		
		   }
		  });
  }
  function LoadNextTokenDisplay2()
  {
	  
	  var Dumy = 0;
	 
	    
var datas = "&Dumy="+Dumy;	
	  	  // alert(datas);
		 $.ajax({
		   url:"Load/LoadTokenNumberforDisplay2.php",
		   method:"POST",
		   data:datas,
		   dataType:"json",
		   success:function(data)
		   {	
		   // alert(data);
		    // document.getElementById("pNextTokenNo1").innerHTML = data;
		 
			if(data=='')
			{
				 
			}
else
{
		
		   document.getElementById("pNextTokenNo2").innerHTML = data[0];
		   document.getElementById("pNextTokenName2").innerHTML = data[1];
		   document.getElementById("pRoomName2").innerHTML = data[2];
			 
}
		   }
		  });
  }
  
  </script>
  
  
  <center>
  <br><img src='../assets/img/sugamgunamlogo.png' width="250"  /> 
  </center>
  <br>
  <div class="row full-height">
  
  
  <div class="column full-height" style="background-color:#53c0cb;">
    <center>
	<p  style='font-size: 40px;'>&nbsp;&nbsp; <b>
	<span  style='font-size: 40px;'><?php echo $Room1Caption; ?> </span></b> </p> 
  
	</center>
	 
	<hr>
	<p style='font-size: 40px;'>&nbsp;&nbsp; 
	<span id='pNextTokenNo1' style='font-size: 40px;'></span></p>
	
	<p style='font-size: 40px;'>&nbsp;&nbsp; 
	<span id='pNextTokenName1' style='font-size: 40px;'> </span></p>
	
	<div id='DivTokenList1'> </div>
  </div>
  
  
  <div class="column full-height" style="background-color:#9bd3f7;">
    <center>
	<p  style='font-size: 40px;'>&nbsp;&nbsp; <b>
	<span  style='font-size: 40px;'> <?php echo $Room2Caption; ?> </span></b> </p> 
  
	</center>
	 
	<hr>
	<p style='font-size: 40px;'>&nbsp;&nbsp;  
	<span id='pNextTokenNo2' style='font-size: 40px;'></span></p>
	
	<p style='font-size: 40px;'>&nbsp;&nbsp;  
	<span id='pNextTokenName2' style='font-size: 40px;'> </span></p>
	
	<div id='DivTokenList2'> </div>
  </div>
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
     
    });
  </script>
  </body>
  <!-- Mirrored from seantheme.com/color-admin-v1.7/admin/html/email_inbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Apr 2015 10:54:42 GMT -->
</html>
