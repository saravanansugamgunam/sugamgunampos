  
  <?php 
  
    include("../connect.php"); 
	 session_cache_limiter(FALSE);
    session_start();
	
	$PaitentId=$_GET['PID'];
	$TokenID=$_GET['TID'];
	$InvoiceNo=$_GET['INV'];
	$TokenStatus=$_GET['S'];
	 
	
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
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="html2canvas.js"></script>
<style>
 
</style>
<link href="Prescription/assets/jquery.signaturepad.css" rel="stylesheet">
<!--[if lt IE 9]><script src="Prescription/assets/flashcanvas.js"></script><![endif]-->
 
<body onload ='LoadPaitentDetails();'>
   
<style>
.inside{
    font-size:12px;     
    border-color:#ff3366;
    border-size: 1px;
    border-style: solid;
    width: 300px;
    height: 50px;
    float: right;
    margin-right: 100px;
}
</style>
 
      <!-- begin #header -->
      <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <!-- begin container-fluid -->
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
       
      <!-- begin #sidebar -->
      <div id="sidebar" class="sidebar">
        <!-- begin sidebar scrollbar --> 
          <!-- begin sidebar user -->
          <!-- end sidebar user -->
          <!-- begin sidebar nav -->
          <?php include("CLMSidePanel.php") ?>
      </div> 
	  
<div style="position:relative;width:100px;left:250px;top:100px;   z-index: 100;">
 Doctor: &nbsp;&nbsp; <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" data-style="btn-white" id='cmbDoctor' name='cmbDoctor'  style="width:150px;">
	   <option selected></option> 
     <?php  
                            $sqli = "SELECT userid,username FROM usermaster where designationid='9' and  activestatus='Active'";
                            $result = mysqli_query($connection, $sqli); 
                             while ($row = mysqli_fetch_array($result)) {
                            	# code...
                          
                             echo ' <option value='.$row['userid'].'>'.$row['username'].'</option>';
                              }	
                            ?>
      </select>
</div>	  
<br> 
<br> 
 
 
	  
                                          <br>
										  
							 
							 <?php 
							  if($TokenStatus=='O')
							{
								echo "<lable>Status: <b>Open</b></lable>";
							}
							else if($TokenStatus=='C')
							{
								echo "<lable>Status: <b>Completed</b></lable>";
							}
							else if($TokenStatus=='X')
							{
								echo "<lable>Status: <b>Cancelled</b></lable>";
							}
							?>
							


 
 
  
<div class="sigPad" id="smoothed" name="smoothed" style="position:relative;width:1000px;left:250px; ">
 
<ul class="sigNav"> 
<li > <button id="btn-Preview-Image" style="background-color: #008acd;
  color: white;
  font-size: 15px;
  padding: 10px 10px;
  border-radius: 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  bottom: 0.2em; 
  position: absolute;
  right: 14%; 
  line-height: 1.375;
  " >Confirm</button> 
  
   <button id="btn-Convert-Html2Image" style="background-color: #35ce30;
  color: white;
  font-size: 15px;
  padding: 10px 10px;
  border-radius: 5px;
  text-align: center;
  text-decoration: none; 
  display: none;
  bottom: 0.2em; 
  position: absolute;
  right: 14%; 
  line-height: 1.375;"  >Upload</button> 
  
<a  class="clearButton" href="#clear" style="background-color: #e36e1f;
  color: white;
  font-size: 15px;
 padding: 4px 10px;
  border-radius: 5px;
  text-align: center;
  text-decoration: none;
    right: 7%; 
  display: inline-block;" onclick='Reload();'>Clear</a>
  
<button  style="background-color: #54616f;
  color: white;
  font-size: 15px;
  padding: 10px 10px;
  border-radius: 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  bottom: 0.2em; 
  position: absolute;
  right: 0%; 
  line-height: 1.375;
  " onclick='GoBack();'>Back</button> 
  
  
  
  </li>
</ul>

<div id="html-content-holder" style="width:1000px; border: 1px solid #666;" >
       
<canvas class="pad" width="1000" height="450"></canvas>
<input type="hidden" id ='output-2' name="output-2" class="output" />
<input type="hidden" id ='txtReadyUpload' name="txtReadyUpload"  value='0' />
 
</div> 

	 
    </div>
	<br> 
	 
   
    
	 

    <div style='display:none;' id="previewImage">
    </div>
	 <img id="myImg" hidden width="107" height="98">  
	 <input type='hidden' id='txtPaitentID' name='txtPaitentID' value='<?php echo $PaitentId ?>' />
<input type='hidden' id='txtTokenID' name='txtTokenID' value='<?php echo $TokenID ?>' />
<input type='hidden' id='txtInvoiceNo' name='txtInvoiceNo' value='<?php echo $InvoiceNo ?>' />
   
   
<script>

  function LoadPaitentDetails()
	  { 
	 var Dumy = 0;
	var PaitentID = document.getElementById("txtPaitentID").value;
	var TokenNo = document.getElementById("txtTokenID").value;
	    
var datas = "&PaitentID="+PaitentID+"&TokenNo="+TokenNo;	
	  	  
		 $.ajax({
		   url:"Load/LoadPaitentDetailsforHistory.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	
		   
		  $( '#DivPaitentDetails' ).html(data);
		 
		
		   }
		  });
	  } 
	  
	  


$(document).ready(function(){
 
var element = $("#html-content-holder"); // global variable
var getCanvas; // global variable

 
    $("#btn-Preview-Image").on('click', function () {
		// alert(1);
         html2canvas(element, {
         onrendered: function (canvas) {
			  //alert(1);
			 var ImageConverted = document.getElementById("output-2").value;
			 var UploadButton = document.getElementById("btn-Convert-Html2Image");
			 var ConfirmButton = document.getElementById("btn-Preview-Image");
			  
			 if (ImageConverted=='')
	 {
		 alert("Please wirte the prescription");
			UploadButton.style.display = "none";		 
			ConfirmButton.style.display = "block";		 
	 }
	 else
	 {
                $("#previewImage").append(canvas);
                getCanvas = canvas;
				document.getElementById("txtReadyUpload").value=1;
				UploadButton.style.display = "block";	
				ConfirmButton.style.display = "none";	
				
	 }
             }
         });
    });

	$("#btn-Convert-Html2Image").on('click', function () {
    var imgageData = getCanvas.toDataURL("image/png"); 
	 document.getElementById("myImg").src = imgageData; 
	Upload();
	// Reload();
	  
	
 


	 
    // Now browser starts downloading it instead of just showing it
	
	
  //  var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
  //  $("#btn-Convert-Html2Image").attr("download", "your_pic_name.png").attr("href", newData);
	
	
	});

});
 

function Reload()
{
	location.reload();
	
}

function GoBack()
{
	var PaitentID = document.getElementById("txtPaitentID").value;
		var TokenID = document.getElementById("txtTokenID").value;
		var InvoiceNo = document.getElementById("txtInvoiceNo").value; 
		var URL1 = 'ConsultingView.php?PID='; 
		var URL2 = PaitentID; 
		var URL3 = '&INV='; 
		var URL4 = InvoiceNo; 
		var URL5 = '&TID='; 
		var URL6 = TokenID; 
		var URL7 = '&S=O&MID=31'; 
		var URL = URL1.concat(URL2,URL3,URL4,URL5,URL6,URL7);
		
		
	window.location=URL;
}
function Upload()
{
     
	var base64image = $('#myImg').attr('src');
	var userid = document.getElementById("cmbDoctor").value;
	var PaitentID = document.getElementById("txtPaitentID").value;
	 
	
	var datas = "&base64image="+base64image+"&PaitentID="+PaitentID+"&userid="+userid;
	var ImageConverted = document.getElementById("txtReadyUpload").value;
	// alert(ImageConverted);
	 if (ImageConverted==0 || userid=='' )
	 {
		 alert("Please select doctor and wirte the prescription");	
	 }
	 else
	 {
		  $.ajax({
		   url:"PrescriptionUpload.php",
		   method:"POST",
		   data:datas,
		   success:function(data)
		   {	 
		// alert(data);
		alert("Prescription Uploaded Sucessfully");
		   }
		  });
		  
		  	var PaitentID = document.getElementById("txtPaitentID").value;
		var TokenID = document.getElementById("txtTokenID").value;
		var InvoiceNo = document.getElementById("txtInvoiceNo").value; 
		var URL1 = 'PaitentHistory.php?PID='; 
		var URL2 = PaitentID; 
		var URL3 = '&INV='; 
		var URL4 = InvoiceNo; 
		var URL5 = '&TID='; 
		var URL6 = TokenID; 
		var URL7 = '&S=O&MID=31'; 
		var URL = URL1.concat(URL2,URL3,URL4,URL5,URL6,URL7);
		
		
	window.location=URL;
	 
	 
	 }
	 
	
	
		  
}
</script>



</form> 

 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="Prescription/assets/numeric-1.2.6.min.js"></script> 
<script src="Prescription/assets/bezier.js"></script> 
<script src="Prescription/jquery.signaturepad.js"></script> 
<script>
try {
  fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
    return true;
  }).catch(function(e) {
    var carbonScript = document.createElement("script");
    carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
    carbonScript.id = "_carbonads_js";
    document.getElementById("carbon-block").appendChild(carbonScript);
  });
} catch (error) {
  console.log(error);
}
</script>
<script>
    $(document).ready(function() {
      $('#linear').signaturePad({drawOnly:true, lineTop:200});
      $('#smoothed').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:500});
      $('#smoothed-variableStrokeWidth').signaturePad({drawOnly:true, drawBezierCurves:true, variableStrokeWidth:true, lineTop:200});
    });
  </script> 
<script src="Prescription/assets/json2.min.js"></script>
   </div>

</body>
